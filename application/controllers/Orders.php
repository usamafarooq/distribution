<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model');
        $this->module = 'orders';
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
			//$this->data['index_data'] = $this->Orders_model->order_index();
			//$this->data['distribution_code'] = $this->Orders_model->all_rows('distribution');
			$this->data['index_data'] = $this->Orders_model->get_data();
		}
		elseif ($this->permission['view'] == '1') {
			//$this->data['index_data'] = $this->Orders_model->order_index($this->id);
			//$this->data['distribution_code'] = $this->Orders_model->all_rows('distribution');
			$this->data['index_data'] = $this->Orders_model->get_data($this->id);
		}
		$this->data['permission'] = $this->permission;
		$this->load->template('orders/index',$this->data);
		
    }

    public function Add()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Distributions';
		
		if ( $this->dis_permission['view_all'] == '1'){
			$this->data['distributions'] = $this->Orders_model->all_rows('distribution');
		}
		elseif ($this->dis_permission['view'] == '1') {
			$this->data['distributions'] = $this->Orders_model->get_rows('distribution',array('user_id'=>$this->id));
		}
		$this->load->template('orders/add',$this->data);
	}

    public function create()
	{

		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$scm_code = $this->input->post('distribution_sort');
		if ($this->input->post('column')) {
			$this->data['column'] = $this->input->post('column');
		}
		$first_date  =  date('Y-m-01', strtotime("-3 month"));
 		$last_date  =  date('Y-m-t', strtotime("-1 month"));
 		$last_start = date('Y-m-01', strtotime("-1 month"));
 		$start  =  date('Y-m-01');
 		$end  =  date('Y-m-t');
		$this->data['distribution'] = $this->Orders_model->get_row_single('distribution',array('dsr_code'=>$scm_code));
		if ($this->pro_permission['view_all'] == '1'){
 			
			$this->data['product_data_sort'] = $this->Orders_model->index_data($scm_code,$first_date,$last_date,$last_start,$start,$end);
		}
		elseif ($this->pro_permission['view'] == '1') {
			$this->data['product_data_sort'] = $this->Orders_model->index_data($scm_code,$first_date,$last_date,$last_start,$start,$end,$this->id);
		}
		//print_r($this->db->last_query());
		$this->data['old_orders'] = array();
		$v = array_column($this->data['product_data_sort'], 'orders');
		$v = array_unique($v);
		$v = array_filter($v);
		//echo '<pre>';print_r($v);die;
		if ($v) {
			$this->data['old_orders'] = 1;
		}
		$this->data['num_order'] = sizeof($this->Orders_model->get_rows('orders',array('distribution_code'=>$scm_code,'date >=' =>$start,'date <=' =>$end)));
		
		//echo'<pre>';print_r($this->data);die;
		//print_r($this->db->last_query());die;
		$this->data['permission'] = $this->permission;
		$this->data['title'] = 'Create Order';
		$this->load->template('orders/create',$this->data);
	}

	public function view($id)
	{
		$data = $this->Orders_model->get_export_data($id);
		//echo '<pre>';print_r($data);die;
		$delimiter = ",";
	    $filename = "orders.csv";
	    $f = fopen('php://memory', 'w');
	    $or = $data[0]['orders'];
	    $or = explode(',', $or);
	    $or = sizeof($or);
	    $fields = array('S.no','Distributor Code','Distributor Name','Products','SCM Product Code','LMS Pack Code','First Month','Second Month','Third Month','Month Average Sale','Intransit','Closing','Closing Stock','Average Of Closing Stock');
	    for ($i=0; $i < $or; $i++) { 
	    	$fields[] = 'Order';
	    }
	    $fields[] = 'Order Quantity';
	    $fields[] = 'Growth';
	    $fields[] = 'Packs Carton';
	    $fields[] = 'TP';
		fputcsv($f,$fields, $delimiter);
		$intransit = 0;
		$con = 1;
		foreach($data as $row){
			$orders = explode(',', $row['de_orders']);
			$intransit = array_sum($orders) - $row['receive'];
			$month = $row['month'];
	 		$data_month = explode(",",$month);
	 		$sale = explode(",",$row['sale']);
			$avg_sum = 0;
			for ($i = 1; $i <= 3; $i++){
				$month_key = date('m', strtotime('-'.$i.' month', strtotime($row['date'])));
		    	$key = array_search($month_key, $data_month);
		    	if ($key <= -1) {
		        	$val = '0';
		    	}
		    	else{
			        if (array_key_exists($key,$data_month)) {
			            $val = $sale[$key];
			            $avg_sum+= $val;
			        }
			        else{
			            $val = '0';
			        }
	    		}
		    	$order[$i] = $val;   
			}
			$avg_sum = $avg_sum/3;
	        $res_avg = round($avg_sum);
	        $closing_stock = $row['closing'] + $intransit;
	        $res = ($avg_sum * 2.5) - $closing_stock ; 
	        $res = round($res);
	        //$total =  $row['order_field'] + $row['order_field2'] + $row['order_field3'];
			$lineData = array($con,$row['dsr_code'],$row['scm_name'],$row['product_name'],$row['product_code'],'="'.$row['scm_product_code'].'"',$order[1],$order[2],$order[3],$res_avg,$intransit,$row['closing'],$closing_stock,$res);
			$or = explode(',', $row['orders']);
			$qty = 0;
			for ($i=0; $i < sizeof($or); $i++) { 
		    	$lineData[] = $or[$i];
		    	$qty = $qty + $or[$i];
		    }
		    $lineData[] = $qty;
	    	$lineData[] = $row['growth'];
	    	$lineData[] = $row['pack_carton'];
	    	$lineData[] = $row['tp_product'];
			fputcsv($f,$lineData, $delimiter);
			$con++;
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
	}

	public function edit($id)
	{
		
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Products';
		$this->data['product_data_sort'] = $this->Orders_model->get_export_data($id);
		//echo '<pre>';print_r($this->data['product_data_sort']);die;
		//$this->data['team'] = $this->Orders_model->all_rows('team');
		//$this->data['order'] = $this->Orders_model->get_row_single('orders',array('id'=>$id));
		$this->load->template('orders/edit',$this->data);
	}

	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Orders_model->delete('orders',array('id'=>$id));
		redirect('orders');
	}
	
	public function export_csv_file()
	{
		if( $this->input->post('dateselect') == 'weekly' )
		{
			$strat_date = date('Y-m-d 00:00:01');
			$end_date 	= date('Y-m-d 23:59:59',strtotime('-7 days'));
		}
		elseif ( $this->input->post('dateselect') == 'daily' )
		{
			$strat_date = date('Y-m-d 00:00:01');
			$end_date 	= date('Y-m-d 23:59:59');
		}
		elseif(  $this->input->post('dateselect') == 'monthly' )
		{
			$strat_date = date('Y-m-d 00:00:01');
			$end_date 	= date('Y-m-d 23:59:59',strtotime('-1 month'));
		}
		elseif( $this->input->post('dateselect') == 'quaterly')
		{
			$strat_date = date('Y-m-d 00:00:01');
			$end_date 	= date('Y-m-d 23:59:59',strtotime('-3 month'));
		}
		elseif( $this->input->post('dateselect') == 'half_year')
		{
			$strat_date 	= date('Y-m-d 00:00:01');
			$end_date 	= date('Y-m-d 23:59:59',strtotime('-6 month'));
		}
		elseif( $this->input->post('dateselect') == 'custom')
		{
			$strat_date 	= date('Y-m-d 00:00:01',strtotime($this->input->post('order_field_start')));
			$end_date 	= date('Y-m-d 23:59:59',strtotime($this->input->post('order_field_end')));
		}
	    $distribution_code = $this->input->post('distributor_select');
	    $delimiter = ",";
	    $filename = "orders.csv";
	    $f = fopen('php://memory', 'w');
	    //$fields = array('Distributor Code','Distributor Name','Products','SCM Product Code','LMS Pack Code','First Month','Second Month','Third Month','Month Average Sale','Intransit','Closing','Closing Stock','Average Of Closing Stock','Order1','Order2','Order3','Order Quantity','Growth','Packs Carton');
		//fputcsv($f,$fields, $delimiter);
		$index_data = $this->Orders_model->order_index_csv($strat_date,$end_date,$distribution_code);	
		$intransit = 0;
		foreach($index_data as $row){
			$month = $row['MONTH'];
	 		$data_month = explode(",",$month);
	 		$sale = explode(",",$row['sale']);
			$avg_sum = 0;
			for ($i = 1; $i <= 3; $i++){
				$month_key = date('m', strtotime('-'.$i.' month', strtotime($row['date'])));
		    	$key = array_search($month_key, $data_month);
		    	if ($key <= -1) {
		        	$val = '0';
		    	}
		    	else{
			        if (array_key_exists($key,$data_month)) {
			            $val = $sale[$key];
			            $avg_sum+= $val;
			        }
			        else{
			            $val = '0';
			        }
	    		}
		    	$order[$i] = $val;   
			}
			$avg_sum = $avg_sum/3;
	        $res_avg = round($avg_sum);
	        $closing_stock = $row['closing'] + $intransit;
	        $res = ($avg_sum * 2.5) - $closing_stock ; 
	        $res = round($res);
	        $total =  $row['order_field'] + $row['order_field2'] + $row['order_field3'];
			$lineData = array($row['distribution_code'],$row['scm_name'],$row['product_name'],$row['product_code'],$row['scm_product_code'],$order[1],$order[2],$order[3],$res_avg,$intransit,$row['closing'],$closing_stock,$res,$row['order_field'],$row['order_field2'],$row['order_field3'],$total,$row['growth'],$row['carton']);
				fputcsv($f,$lineData, $delimiter);
		}
   		fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="' . $filename . '";');
    	fpassthru($f);
    }

	public function update()
	{
		if ( $this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$id = $data['id_order'];
		unset($data['id_order']);
		$id = $this->Orders_model->update('orders',$data,array('id'=>$id));
		if ($id) {
			redirect('orders');
		}
	}

	public function submit_data_order()
	{
		$product_data = [];
		$data = $this->input->post();
		//echo '<pre>';print_r($data);die;
		$order = array(
			'distribution_code' => $data['distribution_code_order'][0],
			'date'=>date('Y-m-d'),
			'user_id'=>$this->session->userdata('user_id')
		);
		$id = $this->Orders_model->insert('orders',$order);
		$data_size = sizeof($data['distribution_code_order']);
		$data_size = $data_size - 1;
		for ($x = 0; $x <= $data_size; $x++) {
			//echo $data['qty'][$x];die;
			if($data['qty'][$x] > 0)
			{
				$or = implode(',', $data['order'][$data['scm_product_order'][$x]]);
				if ($or != 0) {
					$product_data[] = array(
						'order_id' =>$id,
						'pack_code'=>$data['scm_product_order'][$x],
						'total_order'=>$data['qty'][$x],
						'orders'=>$or,
						'growth'=>$data['growth'][$x],
					);
				}
			}
		}
		//echo '<pre>';print_r($product_data);die;
		$data_inserted = $this->Orders_model->insert_batch('order_detail',$product_data);
		redirect('orders');
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
					if ($data[0] != 'Distributor Code') {
						$products_insert[] = array(
							'user_id' => $this->session->userdata('user_id'),
							'distribution_code' => $data[0],
							'pak_code' => $data[3],
							'order_field' => $data[13],
							'order_field2' => $data[14],
							'order_field3' => $data[15],
							'growth' => $data[17],
							'carton' => $data[18],
							'date' => date("Y-m-d"),
						);
						$data_response = $this->Orders_model->insert_batch('orders',$products_insert);			
					}
				}
				fclose($handle);
				if ($data_response) {
					redirect('orders');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';
			die();
		}
	}
}