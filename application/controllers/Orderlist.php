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
    }



    public function sort_show()
	{

		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}



		$scm_code = $this->input->post('distribution_sort');
		$this->data['distribution'] = $this->Orderlist_model->get_rows('distribution',array('scm_code'=>$scm_code));
		$this->data['products_details'] = $this->Orderlist_model->all_rows('product');
		// echo '<pre>';print_r($this->data['products_details']);die;
		// $order_distributor = $this->input->post('distribution_sort');
		// print_r($order_distributor);die;

		$this->data['permission'] = $this->permission;
		$this->data['title'] = 'View Show';
		$this->load->template('orderlist/show',$this->data);
	}


	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Module';
		$this->data['distributions'] = $this->Orderlist_model->all_rows('distribution');
		// print_r($this->data['orderlist_model']);die;
		$this->load->template('orderlist/orderlist_sort',$this->data);
	}




}