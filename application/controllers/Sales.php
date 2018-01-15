<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sales_model');
		$this->module = 'sales';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);
	}

	public function index()
	{
		if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Sales';
		if ( $this->permission['view_all'] == '1'){
			$this->data['orders'] = $this->Sales_model->sales_detail();
			// echo '<pre>';print_r($this->data['orders']);die;
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['orders'] = $this->Sales_model->get_rows('sales',array('user_id'=>$this->id));
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('sales/index',$this->data);
	}

	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Sales';
		$this->data['orders'] = $this->Sales_model->all_rows('sales');
		$this->data['products'] = $this->Sales_model->all_rows('product');
		$this->data['distributions'] = $this->Sales_model->all_rows('distribution');
		$this->load->template('sales/create',$this->data);
	}

	public function insert()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$data['date'] = date('Y-m-d');
		$data['user_id'] = $this->session->userdata('user_id');
		$id = $this->Sales_model->insert('sales',$data);
		if ($id) {

			$this->session->set_flashdata('insert', true);
			redirect('sales');
		}
	}

	public function edit($id)
	{
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Sales';
		$this->data['distributions'] = $this->Sales_model->all_rows('distribution');
		$this->data['products'] = $this->Sales_model->all_rows('product');
		$this->data['orders'] = $this->Sales_model->get_row_single('sales',array('id'=>$id));
		$this->load->template('sales/edit',$this->data);
	}

	public function update()
	{
		if ( $this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$id = $data['id'];
		unset($data['id']);
		$id = $this->Sales_model->update('sales',$data,array('id'=>$id));
		if ($id) {

		$this->session->set_flashdata('update', true);
		redirect('sales');
		}
	}

	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Sales_model->delete('sales',array('id'=>$id));
		redirect('sales');
	}

	public function export_csv_file()
	{
	    $delimiter = ",";
	    $filename = "order.csv";
	    $f = fopen('php://memory', 'w');
		$products_csv_upload = $this->Sales_model->all_rows('sales');
		foreach($products_csv_upload as $row){
			$lineData = array($row['Distribution_code'],$row['Packcode'],$row['Datename'],$row['Sales'],$row['Closing']);
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
					if (!empty($data[0])) {
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'Distribution_code' => $data[0],
							'Packcode' => $data[1],
							'Datename' => $data[2],
							'Sales' => $data[3],
							'Closing' => $data[4],
						);
					}
				}
				fclose($handle);
				$data_response = $this->Sales_model->insert_batch('sales',$products_insert);
				if ($data_response) {
				redirect('sales');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}
}