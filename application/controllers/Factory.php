<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factory extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Factory_model');
        $this->load->model('Orders_model');
        $this->module = 'Factory';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);
        $this->dis_permission = $this->get_permission('distribution',$this->user_type);
        $this->pro_permission = $this->get_permission('product',$this->user_type);
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
        $this->load->template('factory/index',$this->data);
        
    }

    public function view($id)
    {
    	if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Factory';
		if ($this->permission['view_all'] == '1'){	
			$this->data['index_data'] = $this->Factory_model->get_data($id);
		}
		elseif ($this->permission['view'] == '1') {
			$this->data['index_data'] = $this->Factory_model->get_data($id,$this->id);
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('factory/view',$this->data); 
		
    }

    public function export_csv_file()
	{

	    $delimiter = ",";
	    $filename = "order.csv";
	    $f = fopen('php://memory', 'w');
	    //$fields = array('SCM Code','Order Id','Qty1','Qty2','Qty3','Remarks','Dc_no');
		//fputcsv($f,$fields, $delimiter);
		if ($this->permission['view_all'] == '1'){	
			$result = $this->Factory_model->get_data();
		}
		elseif ($this->permission['view'] == '1') {
			$result = $this->Factory_model->get_data($this->id);
		}
		foreach($result as $row){
			$lineData = array($row['scm_code'],$row['order_id'],$row['qty1'],$row['qty2'],$row['qty3'],$row['remarks'],$row['dc_no']);
			fputcsv($f,$lineData, $delimiter);
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
    }

    public function csv_upload()
	{
		$mimes = array('application/vnd.ms-excel','text/csv','text/tsv');
		if(in_array($_FILES['csv_name']['type'],$mimes))
		{
			if(!empty($_FILES))
			{
				$products_insert = [];
				$handle = fopen($_FILES['csv_name']['tmp_name'], "r");
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if (!empty($data[0]) && $data[0] != 'Web Order No.') {
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'order_id' => $data[0],
							'scm_order_no' => $data[1],
							'dc_no' => $data[2],
							'dc_type' => $data[3],
							'date' => date('Y-m-d', strtotime($data[4])),
							'cn' => $data[5],
							'kg' => $data[6],
							'cartons' => $data[7],
							'packs' => $data[8],
						);
					}
				}
				$data_response = $this->Factory_model->insert_batch('factory',$products_insert);
				fclose($handle);
				if ($data_response) {
					redirect('factory');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}
}