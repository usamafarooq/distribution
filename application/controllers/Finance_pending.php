<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_pending extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('finance_pending_model');
        $this->module = 'finance_pending';
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
            $this->data['orders'] = $this->finance_pending_model->get_data();
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['orders'] = $this->finance_pending_model->get_data($this->id);
        }
        //print_r($this->data['orders']);die;
        $this->data['permission'] = $this->permission;
        $this->load->template('finance_pending/index',$this->data);
    }

    public function view($id)
    {
        $this->data['title'] = 'Panding Orders';
        if ( $this->permission['view_all'] == '1'){
            $this->data['orders'] = $this->finance_pending_model->get_detail($id);
        }
        elseif ($this->permission['view'] == '1') {
            $this->data['orders'] = $this->finance_pending_model->get_detail($id,$this->id);
        }
        $this->data['id'] = $id;
        //echo '<pre>';print_r($this->data['orders']);die;
        $this->load->template('finance_pending/view',$this->data);
        //$data = $this->pending_order_model->get_detail($id);
        //echo '<pre>';print_r($this->data['orders']);
    }

    public function export_csv_file($id)
    {
        $data = $this->finance_pending_model->get_csv_data($id);
        //echo '<pre>';print_r($data);die;
        $delimiter = ",";
        $filename = "Finance.csv";
        $f = fopen('php://memory', 'w');
     //    $fields = array('dcode','system-code','','','scm-product-code','qty','financecode-hardcoded');
        // fputcsv($f,$fields, $delimiter);
        foreach($data as $row){
        //$total = $row['order_field'] + $row['order_field2'] + $row['order_field3'];
            $lineData = array();
            foreach ($row as $key => $value) {
                if ($key == 'scm-product-code') {
                    $lineData[] = '="'.$row[$key].'"';
                }
                else{
                    $lineData[] = $row[$key];
                }
            }
        //$lineData = array($row['distribution_code'],$row['id'],$blank1,$blank2,$row['scm_product_code'],$total,$hardcode);
        // echo '<pre>';print_r($lineData);die;
            fputcsv($f,$lineData, $delimiter);
        }
        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fpassthru($f);
        //echo '<pre>';print_r($data);
    }

    public function submit($id)
    {
        $id = $this->finance_pending_model->update('pending_orders',array('status'=>1),array('id'=>$id));
        redirect('finance_pending');
    }

    public function import()
    {
        $mimes = array('application/vnd.ms-excel','text/csv','text/tsv');
        if(in_array($_FILES['csv_name']['type'],$mimes))
        {
            if(!empty($_FILES))
            {
                $products_insert = [];
                $handle = fopen($_FILES['csv_name']['tmp_name'], "r");
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (!empty($data[0]) && $data[0] != 'SCM Pack Code') {
                        //echo '<pre>';print_r($data);echo '</pre>';
                        $o_id = $data[6];
                        $o_id = explode('_', $o_id);
                        $order_id = $o_id[0];
                        $p_id = $o_id[1];
                        $products_insert[] = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'scm_code' => $data[0],
                            'order_id' => $order_id,
                            'scm_no' => $data[4],
                            'orders'=>$data[2],
                            'batch' => $data[1],
                            'remarks' => $data[5],
                            'dc_no' => $data[3],
                        );
                        $this->finance_pending_model->update('pending_orders',array('status'=>1),array('id'=>$p_id));
                    }
                }
                $data_response = $this->finance_pending_model->insert_batch('finance_order',$products_insert);
                fclose($handle);
                if ($data_response) {
                    redirect('finance_pending');
                }
            }
        }
        else
        {
            echo 'This File Is Not Supported';die();
        }
    }
}