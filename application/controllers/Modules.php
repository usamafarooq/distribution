<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Modules_model');
        $this->module = 'modules';
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
		$this->data['title'] = 'Modules';
		if ( $this->permission['view_all'] == '1'){
			$this->data['modules'] = $this->Modules_model->all_rows('modules');
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['modules'] = $this->Modules_model->get_rows('modules',array('user_id'=>$this->id));
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('module/index',$this->data);
	}

	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Module';
		$this->load->template('module/create',$this->data);
	}

	public function insert()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$data['user_id'] = $this->session->userdata('user_id');
		$id = $this->Modules_model->insert('modules',$data);
		if ($id) {
			redirect('modules');
		}
	}

	public function edit($id)
	{
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Module';
		$this->data['module'] = $this->Modules_model->get_row_single('modules',array('id'=>$id));
		$this->load->template('module/edit',$this->data);
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
		$id = $this->Modules_model->update('modules',$data,array('id'=>$id));
		if ($id) {
			redirect('modules');
		}
	}

	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Modules_model->delete('modules',array('id'=>$id));
		redirect('modules');
	}

}