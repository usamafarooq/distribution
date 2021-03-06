<?php 

class Finance_model extends MY_Model
{

	public function get_data($id=null)
	{
		$this->db->select('o.*, d.scm_name')
				 ->from('orders o')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code');
		if ($id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}

	public function get_csv_data($id)
	{
		$this->db->select('o.distribution_code as dcode, o.id as system-code, "" as one, "" as two, p.scm_product_code as scm-product-code, od.orders as qty, "401" as financecode-hardcoded')
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->where('o.id', $id);
		return $this->db->get()->result_array();
	}

	function order_index()
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) GROUP BY o.id


			")->result_array();
	}




	function order_index_csv($strat_date,$end_date,$distribution_code)
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) where o.date <= '".$strat_date."' and o.date >= '".$end_date."' and d.scm_code = '".$distribution_code."' GROUP BY o.id


			")->result_array();
	}













	function order_index_single($user_id)
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) WHERE o.user_id = '".$user_id."' GROUP BY o.id


			")->result_array();
	}






	function index_data($scm_code=null,$first_date=null,$last_date=null)
	{

		 return $this->db->query("SELECT product.*, group_concat(s.sale separator ',') as sale, group_concat(s.month separator
		',') as month, c.closing FROM product left join (select sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing from sales where sales.distribution_code = '".$scm_code."' and sales.date >= DATE('".$first_date."') and sales.date <= DATE('".$last_date."') GROUP BY MONTH(sales.date)) as s on s.packcode = product.product_code left join (select closing, packcode from sales where distribution_code = '".$scm_code."' order by id desc limit 1) as c on c.packcode = product.product_code GROUP by product.id")->result_array();

	}




	function index_data_single($user_id,$scm_code,$first_date,$last_date)
	{

		 return $this->db->query("SELECT product.*, group_concat(s.sale separator ',') as sale, group_concat(s.month separator
		',') as month, c.closing FROM product left join (select sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing from sales where sales.distribution_code = '".$scm_code."' and sales.date >= DATE('".$first_date."') and sales.date <= DATE('".$last_date."') and sales.user_id = '".$user_id."' GROUP BY MONTH(sales.date)) as s on s.packcode = product.product_code left join (select closing, packcode from sales where distribution_code = '".$scm_code."' and sales.user_id = '".$user_id."' order by id desc limit 1) as c on c.packcode = product.product_code GROUP by product.id")->result_array();

	}



	public function get_orders($id=null)
	{
		$this->db->select('o.*,d.scm_name,p.product_name')
				 ->from('orders o')
				 ->join('distribution d', 'd.scm_code = o.distribution_code')
				 ->join('product p', 'o.pak_code = p.product_code')
				 ->group_by('o.id');
		if ($id != null) {
			$this->db->where('o.user_id',$id);
		}
		return $this->db->get()->result_array();
	}

	public function get_export_data()
	{
		$this->db->select('orders.*,product.scm_product_code')
		->from('orders')
		->join('product', 'orders.pak_code = product.product_code');
		return $this->db->get()->result_array();         
	}

}