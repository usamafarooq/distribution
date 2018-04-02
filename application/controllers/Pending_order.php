<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_order extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('pending_order_model');
        $this->module = 'pending_order';
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
        $this->data['title'] = 'Panding Orders';
        if ( $this->permission['view_all'] == '1'){
            $this->data['orders'] = $this->pending_order_model->get_data();
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['orders'] = $this->pending_order_model->get_data($this->id);
        }
        $this->data['products'] = $this->pending_order_model->all_rows('product');
        //print_r($this->data['orders']);die;
        $this->data['permission'] = $this->permission;
        $this->load->template('pending_order/index',$this->data);
    }

    public function view($id)
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $pending_order = array();
            for ($i=0; $i < sizeof($data['orderid']); $i++) { 
                if ($data['qty'][$i] > 0) {
                    $pending_order[] = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'order_id' => $data['orderid'][$i],
                        'detail_id' => $data['detailid'][$i],
                        'qty' => $data['qty'][$i]
                    );
                }
            }
            $data = $this->pending_order_model->insert_batch('pending_orders',$pending_order);
            redirect('pending_order');
            //echo '<pre>';print_r($pending_order);die;
        }
        $this->data['title'] = 'Panding Orders';
        if ( $this->permission['view_all'] == '1'){
            $this->data['orders'] = $this->pending_order_model->get_detail($id);
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['orders'] = $this->pending_order_model->get_detail($id,$this->id);
        }
        $this->load->template('pending_order/view',$this->data);
        //$data = $this->pending_order_model->get_detail($id);
        //echo '<pre>';print_r($this->data['orders']);
    }

    public function product()
    {
        $id = $this->input->post('distribution_sort');
        $this->data['title'] = 'Panding Orders';
        if ( $this->permission['view_all'] == '1'){
            $this->data['orders'] = $this->pending_order_model->get_detail_product($id);
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['orders'] = $this->pending_order_model->get_detail_product($id,$this->id);
        }
        //echo '<pre>';print_r($this->data['orders']);die;
        $this->load->template('pending_order/product',$this->data);
    }

    public function submit_order()
    {
        $data = $this->input->post();
        $pending_order = array();
        for ($i=0; $i < sizeof($data['orderid']); $i++) { 
            if ($data['qty'][$i] > 0) {
                $pending_order[] = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'order_id' => $data['orderid'][$i],
                    'detail_id' => $data['detailid'][$i],
                    'qty' => $data['qty'][$i]
                );
            }
        }
        $data = $this->pending_order_model->insert_batch('pending_orders',$pending_order);
        redirect('pending_order');
    }
}