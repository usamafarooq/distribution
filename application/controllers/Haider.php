<?php
		    class Haider extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Haider_model');
	        $this->module = 'haider';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Haider';
			if ( $this->permission['view_all'] == '1'){
				$this->data['haider'] = $this->Haider_model->all_rows('haider');
			}
			elseif ($this->permission['view'] == '1') {
				$this->data['haider'] = $this->Haider_model->get_rows('haider',array('user_id'=>$this->id));
			}
			$this->data['permission'] = $this->permission;
			$this->load->template('haider/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Haider';
			$this->load->template('haider/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');
			$id = $this->Haider_model->insert('haider',$data);
			if ($id) {
				redirect('haider');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Haider';
			$this->data['haider'] = $this->Haider_model->get_row_single('haider',array('id'=>$id));
			$this->load->template('haider/edit',$this->data);
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
			$id = $this->Haider_model->update('haider',$data,array('id'=>$id));
			if ($id) {
				redirect('haider');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Haider_model->delete('haider',array('id'=>$id));
			redirect('haider');
		}}