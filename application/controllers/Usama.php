<?php
		    class Usama extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Usama_model');
	        $this->module = 'usama';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Usama';
			if ( $this->permission['view_all'] == '1'){
				$this->data['usama'] = $this->Usama_model->all_rows('usama');
			}
			elseif ($this->permission['view'] == '1') {
				$this->data['usama'] = $this->Usama_model->get_rows('usama',array('user_id'=>$this->id));
			}
			$this->data['permission'] = $this->permission;
			$this->load->template('usama/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Usama';
			$this->load->template('usama/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');
			$id = $this->Usama_model->insert('usama',$data);
			if ($id) {
				redirect('usama');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Usama';
			$this->data['usama'] = $this->Usama_model->get_row_single('usama',array('id'=>$id));
			$this->load->template('usama/edit',$this->data);
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
			$id = $this->Usama_model->update('usama',$data,array('id'=>$id));
			if ($id) {
				redirect('usama');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Usama_model->delete('usama',array('id'=>$id));
			redirect('usama');
		}}