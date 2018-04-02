<?php
		    class Intransit extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Intransit_model');
	        $this->module = 'intransit';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Intransit';
			if ( $this->permission['view_all'] == '1'){$this->data['intransit'] = $this->Intransit_model->get_intransit();}
			elseif ($this->permission['view'] == '1') {$this->data['intransit'] = $this->Intransit_model->get_intransit($this->id);}
			$this->data['permission'] = $this->permission;
			$this->load->template('intransit/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Intransit';$this->data['table_distribution'] = $this->Intransit_model->all_rows('distribution');$this->data['table_product'] = $this->Intransit_model->all_rows('product');$this->load->template('intransit/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');$id = $this->Intransit_model->insert('intransit',$data);
			if ($id) {
				redirect('intransit');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Intransit';
			$this->data['intransit'] = $this->Intransit_model->get_row_single('intransit',array('id'=>$id));$this->data['table_distribution'] = $this->Intransit_model->all_rows('distribution');$this->data['table_product'] = $this->Intransit_model->all_rows('product');$this->load->template('intransit/edit',$this->data);
		}

		public function update()
		{
			if ( $this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$id = $data['id'];
			unset($data['id']);$id = $this->Intransit_model->update('intransit',$data,array('id'=>$id));
			if ($id) {
				redirect('intransit');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Intransit_model->delete('intransit',array('id'=>$id));
			redirect('intransit');
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
					//print_r($data[0]);
					if ($data[0] != 'Distribution Code') {
						$intransit_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'Distribution' => $data[0],
							'Product' => $data[1],
							'Date' => date('Y-m-d', strtotime($data[3])),
							'Intransit' => $data[2],
						);
					}
				}
				fclose($handle);
				//print_r($products_insert);die;
				$data_response = $this->Intransit_model->insert_batch('intransit',$intransit_insert);
				if ($data_response) {
				redirect('intransit');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}

	}