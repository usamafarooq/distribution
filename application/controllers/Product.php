<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->module = 'product';
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
		$this->data['title'] = 'Product';
		if ( $this->permission['view_all'] == '1'){
			$this->data['products'] = $this->Product_model->all_rows('product');
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['products'] = $this->Product_model->get_rows('product',array('user_id'=>$this->id));
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('product/index',$this->data);
	}

	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Products';
		$this->data['team'] = $this->Product_model->all_rows('team');
		$this->load->template('product/create',$this->data);
	}

	public function insert()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$data['user_id'] = $this->session->userdata('user_id');
		$id = $this->Product_model->insert('product',$data);
		if ($id) {

		$this->session->set_flashdata('insert', true);
		redirect('product');
		}
	}

	public function edit($id)
	{
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Products';
		$this->data['team'] = $this->Product_model->all_rows('team');
		$this->data['product'] = $this->Product_model->get_row_single('product',array('id'=>$id));
		$this->load->template('product/edit',$this->data);
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
		$id = $this->Product_model->update('product',$data,array('id'=>$id));
		if ($id) {

		$this->session->set_flashdata('update', true);


			redirect('product');
		}
	}

	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Product_model->delete('product',array('id'=>$id));
		redirect('product');
	}

	public function export_csv_file()
	{
	    $delimiter = ",";
	    $filename = "names.csv";
	    $f = fopen('php://memory', 'w');
		$products_csv_upload = $this->Product_model->all_rows('product');		
		foreach($products_csv_upload as $row){
			$lineData = array($row['product_name'],$row['description'],$row['product_code'],$row['team'],$row['scm_product_code'],$row['tp_product']);
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
						$data_value = $data[2];
						$column = 'product_code';
						$table_data = 'product';
						$product_code_ckeck = $this->Product_model->view_scm_code_ckeck($column,$data_value,$table_data);	
						if (empty($product_code_ckeck)) {
						$data_value = $data[4];
						$column = 'scm_product_code';
						$table_data = 'product';
						$scm_product_code = $this->Product_model->view_scm_code_ckeck($column,$data_value,$table_data);
						if (empty($scm_product_code)) {
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'product_name' => $data[0],
							'description' => $data[1],
							'product_code' => $data[2],
							'team' => $data[3],
							'scm_product_code' => $data[4],
							'tp_product' => $data[5],
								);
						$data_response = $this->Product_model->insert_batch('product',$products_insert);
								}
								else
								{
									redirect('product');
								}
						}
							else
							{
								redirect('product');
							}
					}
				}
				fclose($handle);
				if ($data_response) {
				redirect('product');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}

}

