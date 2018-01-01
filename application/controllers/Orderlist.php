<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderlist extends MY_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orderlist_model');
        $this->module = 'orderlist';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);
        $this->dis_permission = $this->get_permission('distribution',$this->user_type);
        $this->pro_permission = $this->get_permission('product',$this->user_type);
    }

    public function index()
	{
		if ($this->permission['view'] == '0' || $this->permission['view_all'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Distributions';
		
		if ( $this->dis_permission['view_all'] == '1'){
			$this->data['distributions'] = $this->Orderlist_model->all_rows('distribution');
		}
		elseif ($this->dis_permission['view'] == '1') {
			$this->data['distributions'] = $this->Orderlist_model->get_rows('distribution',array('user_id'=>$this->id));
		}
		$this->load->template('orderlist/orderlist_sort',$this->data);
	}

    public function create()
	{

		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$scm_code = $this->input->post('distribution_sort');
		$this->data['distribution'] = $this->Orderlist_model->get_row_single('distribution',array('scm_code'=>$scm_code));
		if ( $this->pro_permission['view_all'] == '1'){
			$this->data['products_details'] = $this->Orderlist_model->all_rows('product');
		}
		elseif ($this->pro_permission['view'] == '1') {
			$this->data['products_details'] = $this->Orderlist_model->get_rows('product',array('user_id'=>$this->id));
		}
		$this->data['permission'] = $this->permission;
		$this->data['title'] = 'View Show';
		$this->load->template('orderlist/show',$this->data);
	}

}