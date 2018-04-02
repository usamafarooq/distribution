<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Finance_model');
        $this->module = 'finance';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);

        $this->dis_permission = $this->get_permission('distribution',$this->user_type);
        $this->pro_permission = $this->get_permission('product',$this->user_type);
    }

  //   public function index()
  //   {
  //   	if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		// {
		// 	redirect('home');
		// }
		// $this->data['title'] = 'finance';
		// if ( $this->permission['view_all'] == '1'){
			
		// $this->data['index_data'] = $this->Finance_model->order_index();
		// $this->data['distribution_code'] = $this->Finance_model->all_rows('distribution');
		// 		}
		// elseif ($this->permission['view'] == '1') {
		// 	$this->data['index_data'] = $this->Finance_model->order_index_single($this->id);
		// }
		// $this->data['permission'] = $this->permission;
		// // print_r($this->data['index_data']);die;
		// $this->load->template('finance/index',$this->data);
		
  //   }





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

					
					

					if ($data[0] != 'Scm Code') {
						
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'scm_code' => $data[0],
							'order_id' => $data[1],
							'qty1' => $data[2],
							'qty2' => $data[3],
							'qty3' => $data[4],
							'remarks' => $data[5],
							'dc_no' => $data[6],
								);
				
				}}
				$data_response = $this->Finance_model->insert_batch('finance_order',$products_insert);
				fclose($handle);
				if ($data_response) {
				redirect('finance');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}











    public function export_csv_file()
	{

	    $delimiter = ",";
	    $filename = "orders.csv";
	    $f = fopen('php://memory', 'w');
	    //$fields = array('Distributor Code','Order Id','Blank1','Blank2','Scm Product Code','Qty','Hardcoded');


	    $blank1 = '';
	    $blank2 = '';
	    $hardcode = '00000';
		//fputcsv($f,$fields, $delimiter);
		$result = $this->Finance_model->get_export_data();                         

		foreach($result as $row){
		$total = $row['order_field'] + $row['order_field2'] + $row['order_field3'];
		$lineData = array($row['distribution_code'],$row['id'],$blank1,$blank2,$row['scm_product_code'],$total,$hardcode);
		// echo '<pre>';print_r($lineData);die;
			fputcsv($f,$lineData, $delimiter);
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
    }

    

    public function index()
	{
		if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Finance';
		if ( $this->permission['view_all'] == '1'){
			$this->data['orders'] = $this->Finance_model->get_data();
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['orders'] = $this->Finance_model->get_data($this->id);
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('finance/index',$this->data);
	}

	public function export($id)
	{
		$data = $this->Finance_model->get_csv_data($id);
		$delimiter = ",";
	    $filename = "Finance.csv";
	    $f = fopen('php://memory', 'w');
	 //    $fields = array('dcode','system-code','','','scm-product-code','qty','financecode-hardcoded');
		// fputcsv($f,$fields, $delimiter);
		foreach($data as $row){
		//$total = $row['order_field'] + $row['order_field2'] + $row['order_field3'];
			$lineData = array();
			foreach ($row as $key => $value) {
				if ($key == 'scm-product-code') {
					$lineData[] = '="'.$row[$key].'"';
				}
				else{
					$lineData[] = $row[$key];
				}
			}
		//$lineData = array($row['distribution_code'],$row['id'],$blank1,$blank2,$row['scm_product_code'],$total,$hardcode);
		// echo '<pre>';print_r($lineData);die;
			fputcsv($f,$lineData, $delimiter);
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
		//echo '<pre>';print_r($data);
	}

	public function import()
	{
		$mimes = array('application/vnd.ms-excel','text/csv','text/tsv');
		if(in_array($_FILES['csv_name']['type'],$mimes))
		{
			if(!empty($_FILES))
			{
				$products_insert = [];
				$handle = fopen($_FILES['csv_name']['tmp_name'], "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if (!empty($data[0]) && $data[0] != 'SCM Pack Code') {
						//echo '<pre>';print_r($data);echo '</pre>';
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'scm_code' => $data[0],
							'order_id' => $data[6],
							'scm_no' => $data[4],
							'orders'=>$data[2],
							'batch' => $data[1],
							'remarks' => $data[5],
							'dc_no' => $data[3],
						);
					}
				}
				$data_response = $this->Finance_model->insert_batch('finance_order',$products_insert);
				fclose($handle);
				if ($data_response) {
					redirect('finance');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}


}