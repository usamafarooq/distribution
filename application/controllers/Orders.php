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
			
		$this->data['index_data'] = $this->Orders_model->order_index();
		$this->data['distribution_code'] = $this->Orders_model->all_rows('distribution');
		

		}
		elseif ($this->permission['view'] == '1') {
			$this->data['index_data'] = $this->Orders_model->order_index_single($this->id);

		}
		$this->data['permission'] = $this->permission;
		// print_r($this->data['index_data']);die;
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
		$this->data['distribution'] = $this->Orders_model->get_row_single('distribution',array('scm_code'=>$scm_code));

		// print_r($scm_code);die;

		if ( $this->pro_permission['view_all'] == '1'){
			$this->data['products_details'] = $this->Orders_model->all_rows('product');
 		$first_date  =  date('Y-m-01', strtotime("-3 month"));
 		$last_date  =  date('Y-m-t', strtotime("-1 month"));

 		// echo '<pre>';print_r($last_date);die;

		$this->data['product_data_sort'] = $this->Orders_model->index_data($scm_code,$first_date,$last_date);

		// echo '<pre>';print_r($this->data['product_data_sort']);die;

		

		}
		elseif ($this->pro_permission['view'] == '1') {


$first_date  =  date('Y-m-01', strtotime("-3 month"));
 		$last_date  =  date('Y-m-t', strtotime("-1 month"));


	$this->data['product_data_sort'] = $this->Orders_model->index_data_single($this->id,$scm_code,$first_date,$last_date);

	// print_r($this->data['product_data_sort']);die;


		}
		$this->data['permission'] = $this->permission;
		$this->data['title'] = 'Create Order';
		$this->load->template('orders/create',$this->data);
	}


	public function edit($id)
	{
		
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}

		$this->data['title'] = 'Edit Products';
		$this->data['team'] = $this->Orders_model->all_rows('team');
		$this->data['order'] = $this->Orders_model->get_row_single('orders',array('id'=>$id));

		// print_r($this->data['orders']);die;


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
	    $filename = "names.csv";
	    $f = fopen('php://memory', 'w');
	    $fields = array('Distributor Code','Distributor Name','Products','SCM Product Code','LMS Pack Code','First Month','Second Month','Third Month','Month Average Sale','Intransit','Closing','Closing Stock','Average Of Closing Stock','Order1','Order2','Order3','Order Quantity','Growth','Packs Carton');
		fputcsv($f,$fields, $delimiter);
		$index_data = $this->Orders_model->order_index_csv($strat_date,$end_date,$distribution_code);	
		$intransit = 0;
                                       
		// echo '<pre>';print_r($index_data);die;

		foreach($index_data as $row){

		$month = $row['MONTH'];
 		$data_month = explode(",",$month);
 		$sale = explode(",",$row['sale']);
		$avg_sum = 0;
		// $order = array();
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
		// print_r($order);die;

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
		}}

	public function submit_data_order()
	{
		
		$product_data = [];
		$data = $this->input->post();
		$data_size = sizeof($data['distribution_code_order']);
		$data_size = $data_size - 1;
		for ($x = 0; $x <= $data_size; $x++) {
		
			// if(empty($data['order_field'][$x])){
			// 	unset($data['order_field'][$x]);
			// }
			// if(empty($data['order_field2'][$x])){
			// 	unset($data['order_field2'][$x]);
			// }
			// if(empty($data['order_field3'][$x])){
			// 	unset($data['order_field3'][$x]);
			// }
			// if(empty($data['growth'][$x])){
			// 	unset($data['growth'][$x]);
			// }
			// if(empty($data['carton'][$x])){
			// 	unset($data['carton'][$x]);
			// }

			if( !empty($data['order_field'][$x] ))
			{
				$product_data[] = array(
				'distribution_code' =>$data['distribution_code_order'][$x],
				'pak_code'=>$data['scm_product_order'][$x],
				'order_field'=>$data['order_field'][$x],
				'order_field2'=>$data['order_field2'][$x],
				'order_field3'=>$data['order_field3'][$x],
				'growth'=>$data['growth'][$x],
				'carton'=>$data['carton'][$x],
				'date'=>date("Y-m-d"),
				'user_id'=>$this->id,
				);
			}
		}

		$data_inserted = $this->Orders_model->insert_batch('orders',$product_data);
		redirect('home');
	}







	public function test()
	{
		// $result = $this->db->query("SELECT product.*, group_concat(s.sale separator ',') as sale, group_concat(s.month separator
		//  ',') as month FROM product left join (select sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month from sales where sales.distribution_code = 000449 and sales.date >= DATE('2017-10-01') and sales.date <= DATE('2017-12-31') GROUP BY MONTH(sales.date)) as s on s.packcode = product.product_code GROUP by product.id")->result_array();
		// echo '<pre>';print_r($result);die;

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

echo '<pre>';print_r($data);die;


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
				}}
				fclose($handle);
				if ($data_response) {
				redirect('orders');
				}
			}
		}
		else
		{
			echo 'This File Is Not Supported';die();
		}
	}







}