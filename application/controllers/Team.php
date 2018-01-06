<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Team_model');
		$this->module = 'team';
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
		$this->data['title'] = 'Teams';
		if ( $this->permission['view_all'] == '1'){
			$this->data['teams'] = $this->Team_model->all_rows('team');
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['teams'] = $this->Team_model->get_rows('team',array('user_id'=>$this->id));
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('team/index',$this->data);
	}

	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Team';
		$this->load->template('team/create',$this->data);
	}

	public function insert()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$data['user_id'] = $this->session->userdata('user_id');
		$id = $this->Team_model->insert('team',$data);
		if ($id) {
			redirect('team');
		}
	}

	public function edit($id)
	{
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Team';
		$this->data['team'] = $this->Team_model->get_row_single('team',array('id'=>$id));
		$this->load->template('team/edit',$this->data);
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
		$id = $this->Team_model->update('team',$data,array('id'=>$id));
		if ($id) {
			redirect('team');
		}
	}


	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Team_model->delete('team',array('id'=>$id));
		redirect('team');
	}


}