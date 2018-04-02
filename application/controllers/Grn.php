<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grn extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('grn_model');
        $this->load->model('Orders_model');
        $this->module = 'grn';
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
        $this->data['title'] = 'Order';
        if ( $this->permission['view_all'] == '1'){
            $this->data['index_data'] = $this->Orders_model->get_data();
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['index_data'] = $this->Orders_model->get_data($this->id);
        }
        $this->data['permission'] = $this->permission;
        $this->load->template('grn/index',$this->data);
        
    }

    public function view($id)
    {
        if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
        {
            redirect('home');
        }
        $this->data['title'] = 'Distributor';
        if ($this->permission['view_all'] == '1'){
            $this->data['grn'] = $this->grn_model->get_data($id);
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['grn'] = $this->Distributor_model->get_data($id,$this->id);
        }
        $this->data['permission'] = $this->permission;
        //echo '<pre>';print_r($this->data);die;
        $this->load->template('grn/view',$this->data); 
        
    }
}