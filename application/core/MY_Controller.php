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

}