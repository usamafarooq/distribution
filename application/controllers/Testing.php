<?php
		    class Testing extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Testing_model');
	        $this->module = 'testing';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Testing';
			if ( $this->permission['view_all'] == '1'){
				$this->data['testing'] = $this->Testing_model->all_rows('testing');
			}
			elseif ($this->permission['view'] == '1') {
				$this->data['testing'] = $this->Testing_model->get_rows('testing',array('user_id'=>$this->id));
			}
			$this->data['permission'] = $this->permission;
			$this->load->template('testing/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Testing';
			$this->load->template('testing/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');
			$id = $this->Testing_model->insert('testing',$data);
			if ($id) {
				redirect('testing');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Testing';
			$this->data['testing'] = $this->Testing_model->get_row_single('testing',array('id'=>$id));
			$this->load->template('testing/edit',$this->data);
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
			$id = $this->Modules_model->update('testing',$data,array('id'=>$id));
			if ($id) {
				redirect('testing');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Testing_model->delete('testing',array('id'=>$id));
			redirect('testing');
		}}