<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Distributor_model');
        $this->module = 'Distributor';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);
        $this->dis_permission = $this->get_permission('distribution',$this->user_type);
        $this->pro_permission = $this->get_permission('product',$this->user_type);
    }


    public function index()
    {
    	if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Distributor';
		if ( $this->permission['view_all'] == '1'){


		$this->db->select('factory.*,product.product_name,distribution.scm_name')
		->from('factory')
		->join('distribution', 'factory.scm_order_no = distribution.scm_code')
		->join('finance_order', 'factory.scm_order_no = finance_order.scm_code')
		->join('orders', 'finance_order.order_id = orders.id')
		->join('product', 'orders.pak_code = product.product_code');
		$this->data['distributors'] = $this->db->get()->result_array();

		// print_r($this->data['distributors']);die; 

		}
		elseif ($this->permission['view'] == '1') {
			// $this->data['index_data'] = $this->Distributor_model->order_index_single($this->id);
		}
		$this->data['permission'] = $this->permission;
		// print_r($this->data['index_data']);die;
		$this->load->template('Distributor/index',$this->data); 
		
    }



    public function export_csv_file()
	{

	    $delimiter = ",";
	    $filename = "names.csv";
	    $f = fopen('php://memory', 'w');
	    $fields = array('id','SCM Order No','SCM order Name','Product Name','DC No','Date','C.N','Kg','Cartons','Packs','Receive Quantity');

	    $Remarks = '';
	    $Dc_no = '';
	    $hardcode = '00000';
		fputcsv($f,$fields, $delimiter);

		$this->db->select('factory.*,product.product_name,distribution.scm_name')
		->from('factory')
		->join('distribution', 'factory.scm_order_no = distribution.scm_code')
		->join('finance_order', 'factory.scm_order_no = finance_order.scm_code')
		->join('orders', 'finance_order.order_id = orders.id')
		->join('product', 'orders.pak_code = product.product_code');
		$result = $this->db->get()->result_array();

		                         

		foreach($result as $row){
			
		$lineData = array($row['id'],$row['scm_order_no'],$row['scm_name'],$row['product_name'],$row['dc_no'],$row['date'],$row['cn'],$row['kg'],$row['cartons'],$row['packs'],$row['receive_quantity']);
		
			fputcsv($f,$lineData, $delimiter);
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
    }


    public function csv_upload()
	{

		$mimes = array('application/vnd.ms-excel','text/csv','text/tsv');
		if(in_array($_FILES['csv_name']['type'],$mimes))
		{
			if(!empty($_FILES))
			{

				$products_insert = [];
				$handle = fopen($_FILES['csv_name']['tmp_name'], "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

					
					// echo '<pre>';print_r($data);die;

					if ($data[0] != 'SCM Order No') {
						
						$products_insert = array(
							'receive_quantity' => $data[9],
								);

				$where_data = $data[0];
				$id = $this->Distributor_model->update('factory',$products_insert,array('scm_order_no'=>$where_data));		
				
				}}

				fclose($handle);
				redirect('factory');
				
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}








}