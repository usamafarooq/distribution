<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factory extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Factory_model');
        $this->module = 'Factory';
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
		$this->data['title'] = 'Factory';
		if ( $this->permission['view_all'] == '1'){
			
		$this->data['index_data'] = $this->Factory_model->order_index();
		$this->data['distribution_code'] = $this->Factory_model->all_rows('distribution');
				}
		elseif ($this->permission['view'] == '1') {
			$this->data['index_data'] = $this->Factory_model->order_index_single($this->id);
		}
		$this->data['permission'] = $this->permission;
		// print_r($this->data['index_data']);die;
		$this->load->template('factory/index',$this->data); 
		
    }




     public function export_csv_file()
	{

	    $delimiter = ",";
	    $filename = "names.csv";
	    $f = fopen('php://memory', 'w');
	    $fields = array('SCM Code','Order Id','Qty1','Qty2','Qty3','Remarks','Dc_no');

	    $Remarks = '';
	    $Dc_no = '';
	    $hardcode = '00000';
		fputcsv($f,$fields, $delimiter);

		$this->db->select('orders.*,product.scm_product_code')
		->from('orders')
		->join('product', 'orders.pak_code = product.product_code');
		$result = $this->db->get()->result_array();

		// echo '<pre>';print_r($result);die;                         

		foreach($result as $row){
			
		$lineData = array($row['distribution_code'],$row['id'],$row['order_field'],$row['order_field2'],$row['order_field3'],$Remarks,$Dc_no);
		// echo '<pre>';print_r($lineData);die;
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

					
					echo '<pre>';print_r($data);

					if ($data[0] != 'SCM Order No') {
						
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'scm_order_no' => $data[0],
							'dc_no' => $data[1],
							'date' => $data[2],
							'cn' => $data[3],
							'kg' => $data[4],
							'cartons' => $data[5],
							'packs' => $data[6],
								);
				
				}}
			$data_response = $this->Factory_model->insert_batch('factory',$products_insert);
				fclose($handle);
				if ($data_response) {
				redirect('factory');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}




}