<?php
		    class Toufeeq extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Toufeeq_model');
	        $this->module = 'toufeeq';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Toufeeq';
			if ( $this->permission['view_all'] == '1'){
				$this->data['toufeeq'] = $this->Toufeeq_model->all_rows('toufeeq');
			}
			elseif ($this->permission['view'] == '1') {
				$this->data['toufeeq'] = $this->Toufeeq_model->get_rows('toufeeq',array('user_id'=>$this->id));
			}
			$this->data['permission'] = $this->permission;
			$this->load->template('toufeeq/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Toufeeq';
			$this->load->template('toufeeq/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');
			$id = $this->Toufeeq_model->insert('toufeeq',$data);
			if ($id) {
				redirect('toufeeq');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Toufeeq';
			$this->data['toufeeq'] = $this->Toufeeq_model->get_row_single('toufeeq',array('id'=>$id));
			$this->load->template('toufeeq/edit',$this->data);
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
			$id = $this->Toufeeq_model->update('toufeeq',$data,array('id'=>$id));
			if ($id) {
				redirect('toufeeq');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Toufeeq_model->delete('toufeeq',array('id'=>$id));
			redirect('toufeeq');
		}}