<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Distributor_model');
        $this->load->model('Orders_model');
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
        $this->data['title'] = 'Order';
        if ( $this->permission['view_all'] == '1'){
            $this->data['index_data'] = $this->Distributor_model->get_index();
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['index_data'] = $this->Distributor_model->get_index($this->id);
        }
        $this->data['permission'] = $this->permission;
        //echo '<pre>';print_r($this->data['index_data']);die;
        $this->load->template('Distributor/index',$this->data);
        
    }


    public function view($id)
    {
    	if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		if ($this->input->post()) {
			//print_r($this->input->post());die;
			$ids = $this->input->post('id');
			$receive_quantity = $this->input->post('receive_quantity');
			$remarks = $this->input->post('remarks');
			for ($i=0; $i < sizeof($ids); $i++) { 
				if (!empty($receive_quantity[$i])) {
					$this->Distributor_model->update('finance_order',array('receive_quantity'=>$receive_quantity[$i],'distribution_remarks'=>$remarks[$i]),array('id'=>$ids[$i]));
				}
			}
		}
		$this->data['title'] = 'Distributor';
		if ($this->permission['view_all'] == '1'){
			$this->data['distributors'] = $this->Distributor_model->get_data($id);
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['distributors'] = $this->Distributor_model->get_data($id,$this->id);
		}
		$this->data['permission'] = $this->permission;
		// print_r($this->data['index_data']);die;
		$this->load->template('Distributor/view',$this->data); 
		
    }

    public function all($id)
    {
    	$query = 'UPDATE finance_order SET receive_quantity = orders WHERE order_id = '.$id;
    	$id = $this->Distributor_model->query($query);
    	//print_r($this->db->last_query());die;
    	redirect('distributor');
    }



    public function export_csv_file()
	{

	    $delimiter = ",";
	    $filename = "orders.csv";
	    $f = fopen('php://memory', 'w');
	    //$fields = array('id','SCM Order No','SCM order Name','Product Name','DC No','Date','C.N','Kg','Cartons','Packs','Receive Quantity');

	    $Remarks = '';
	    $Dc_no = '';
	    $hardcode = '00000';
		//fputcsv($f,$fields, $delimiter);
		if ($this->permission['view_all'] == '1'){
			$result = $this->Distributor_model->get_data();
		}
		elseif ($this->permission['view'] == '1') {
			$result = $this->Distributor_model->get_data($this->id);
		}

		                         

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

					if ($data[0] != 'id') {
						
						$products_insert = array(
							'receive_quantity' => $data[10],
								);

				$where_data = $data[0];
				$id = $this->Distributor_model->update('factory',$products_insert,array('id'=>$where_data));		
				
				}}

				fclose($handle);
				redirect('distributor');
				
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}








}