<?php 

class Orders_model extends MY_Model
{
	

	function order_index()
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) GROUP BY o.id


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






}
