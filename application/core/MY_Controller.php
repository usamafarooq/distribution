<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_login();
		$this->load->model('Main_model');
		$this->data['menus'] = $this->get_modules();
	}

	public function is_login()
	{
		if (!$this->session->userdata('user_id')) {
			redirect("login");
		}
	}

	public function get_modules()
	{
		$role = $this->session->userdata('user_type');
		$menu = $this->Main_model->get_menu($role);
		return $menu;
	}

	public function get_permission($module,$role)
    {
    	$permission = $this->Main_model->get_user_permission($module,$role);
        return $permission;
    }

    public function create_module($module_name)
    {
    	$file = $_SERVER['DOCUMENT_ROOT'].'/distribution/application/models/'.ucfirst($module_name).'.php';
		if(!is_file($file)){
		    $contents = '<?php
		    ';
		    $contents .= 'class '.ucfirst($module_name).' extends MY_Model{

		    	';
		    $contents .= '}';
		    file_put_contents($file, $contents);
		}
    }

    public function create_controller($controller_name,$module_name,$tablename)
    {
    	$file = $_SERVER['DOCUMENT_ROOT'].'/distribution/application/controllers/'.ucfirst($controller_name).'.php';
		if(!is_file($file)){
		    $contents = '<?php
		    ';
		    $contents .= 'class '.ucfirst($controller_name).' extends MY_Controller{

		    	';
		    $contents .= $this->create_construct($module_name,$tablename);	
		    $contents .= $this->create_index($controller_name,$tablename,$module_name);	
		    $contents .= $this->create_create($controller_name,$tablename,$module_name);
		    $contents .= $this->create_edit($controller_name,$tablename,$module_name);	
		    $contents .= $this->create_delete($controller_name,$tablename,$module_name);	
		    $contents .= '}';
		    $contents = str_replace("%","$",$contents);
		    file_put_contents($file, $contents);
		}
    }

    public function create_construct($module_name,$tablename)
    {
    	return "public function __construct()
	    {
	        parent::__construct();
	        %this->load->model('".ucfirst($module_name)."');
	        %this->module = '".$tablename."';
	        %this->user_type = %this->session->userdata('user_type');
	        %this->id = %this->session->userdata('user_id');
	        %this->permission = %this->get_permission(%this->module,%this->user_type);
	    }";
    }

    public function create_index($controller_name,$tablename,$module_name)
    {
    	return "public function index()
		{
			if ( %this->permission['view'] == '0' && %this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			%this->data['title'] = '".ucfirst($controller_name)."';
			if ( %this->permission['view_all'] == '1'){
				%this->data['".$controller_name."'] = %this->".ucfirst($module_name)."->all_rows('".$tablename."');
			}
			elseif (%this->permission['view'] == '1') {
				%this->data['".$controller_name."'] = %this->".ucfirst($module_name)."->get_rows('".$tablename."',array('user_id'=>%this->id));
			}
			%this->data['permission'] = %this->permission;
			%this->load->template('".$controller_name."/index',%this->data);
		}";
    }

    public function create_create($controller_name,$tablename,$module_name)
    {
    	return "public function create()
		{
			if ( %this->permission['created'] == '0') 
			{
				redirect('home');
			}
			%this->data['title'] = 'Create ".ucfirst($controller_name)."';
			%this->load->template('".$controller_name."/create',%this->data);
		}
		public function insert()
		{
			if ( %this->permission['created'] == '0') 
			{
				redirect('home');
			}
			%data = %this->input->post();
			%data['user_id'] = %this->session->userdata('user_id');
			%id = %this->".ucfirst($module_name)."->insert('".$tablename."',%data);
			if (%id) {
				redirect('".$controller_name."');
			}
		}";
    }

    public function create_edit($controller_name,$tablename,$module_name)
    {
    	return "public function edit(%id)
		{
			if (%this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			%this->data['title'] = 'Edit ".ucfirst($controller_name)."';
			%this->data['".$controller_name."'] = %this->".ucfirst($module_name)."->get_row_single('".$tablename."',array('id'=>%id));
			%this->load->template('".$controller_name."/edit',%this->data);
		}

		public function update()
		{
			if ( %this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			%data = %this->input->post();
			%id = %data['id'];
			unset(%data['id']);
			%id = %this->Modules_model->update('".$tablename."',%data,array('id'=>%id));
			if (%id) {
				redirect('".$controller_name."');
			}
		}";
    }

    public function create_delete($controller_name,$tablename,$module_name)
    {
    	return "public function delete(%id)
		{
			if ( %this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			%this->".ucfirst($module_name)."->delete('".$tablename."',array('id'=>%id));
			redirect('".$controller_name."');
		}";
    }

}