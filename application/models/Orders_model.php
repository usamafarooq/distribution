<?php 

class Orders_model extends MY_Model
{
	
	/*public function order_index($id=null)
	{
		$this->db->select('closing, packcode, distribution_code')
				 ->from('sales')
				 ->order_by('id', 'desc')
				 ->limit(1);
		$c = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, "%Y-%m-01") AS DATE, sales.distribution_code')
				 ->from('sales')
				 ->group_by('MONTH(sales.date)');
		$s = $this->db->get_compiled_select();
		$this->db->select('o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ",") AS sale, GROUP_CONCAT(s.month SEPARATOR ",") AS MONTH')
				 ->from('orders o')
				 ->join('product p', 'p.product_code = o.pak_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('('.$c.')  c', 'c.packcode = p.product_code AND c.distribution_code = o.distribution_code', 'left')
				 ->join('('.$s.')  s', 's.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, "%Y-%m-01") - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, "%Y-%m-%e") - INTERVAL 1 MONTH )', 'left')
				 ->group_by('o.id');
		if ($id!=null) {
			$this->db->where('o.user_id', $id);
		}
		return $this->db->get()->result_array();
	}*/

	public function index_data($scm_code,$first_date,$last_date,$last_start,$start,$end,$user_id=null)
	{
		$this->db->select('group_concat(closing separator ",") as closing, packcode')
				 ->from('sales')
				 ->where('LTRIM(distribution_code) = LTRIM('.$scm_code.')')
				 ->where('date >= DATE("'.$first_date.'")')
				 ->where('date <= DATE("'.$last_date.'")')
				 ->order_by('id', 'desc')
				 ->group_by('packcode');
				 //->limit(1);
		$c = $this->db->get_compiled_select();
		$this->db->select('group_concat(closing separator ",") as closing, packcode')
				 ->from('sales')
				 ->where('LTRIM(distribution_code) = LTRIM('.$scm_code.')')
				 ->where('date >= DATE("'.$start.'")')
				 ->where('date <= DATE("'.$end.'")')
				 ->order_by('id', 'desc')
				 ->group_by('packcode');
				 //->limit(1);
		$cc = $this->db->get_compiled_select();
		$this->db->select("d.dsr_code,p.product_code, sum(od.orders) as total, group_concat(od.orders separator ',') as orders, concat(sum(od.orders) - sum(fo.orders)) as pending, concat(sum(fo.orders) - sum(fo.receive_quantity)) as intransit")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->where('o.date >= DATE("'.$start.'")')
				 ->where('o.date <= DATE("'.$end.'")')
				 //->group_by('od.id');
				 ->group_by(array('o.distribution_code','od.pack_code'));
		$i = $this->db->get_compiled_select();
		$this->db->select('Intransit,Distribution,Product')
				 ->from('intransit')
				 ->where('Date >= DATE("'.$last_start.'")')
				 ->where('Date <= DATE("'.$last_date.'")')
				 ->group_by(array('Distribution','Product'))
				 ->order_by('id', 'desc');
		$t = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing')
				 ->from('sales')
				 ->where('LTRIM(sales.distribution_code) = LTRIM('.$scm_code.')')
				 ->where('sales.date >= DATE("'.$first_date.'")')
				 ->where('sales.date <= DATE("'.$last_date.'")')
				 ->group_by(array("MONTH(sales.date)", "sales.packcode", "LTRIM(sales.distribution_code)"));
		$s = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing')
				 ->from('sales')
				 ->where('LTRIM(sales.distribution_code) = LTRIM('.$scm_code.')')
				 ->where('sales.date >= DATE("'.$start.'")')
				 ->where('sales.date <= DATE("'.$end.'")')
				 ->group_by(array("MONTH(sales.date)", "sales.packcode", "LTRIM(sales.distribution_code)"));
		$cs = $this->db->get_compiled_select();
		$this->db->select('product.*, group_concat(s.sale separator ",") as sale, group_concat(s.month separator
		",") as month,cs.sale as current_sale, t.Intransit, i.total, i.orders, i.pending, i.intransit as curent_intransit,SUBSTRING_INDEX(c.closing, ",", 1) as closing, SUBSTRING_INDEX(cc.closing, ",", -1) as curent_closing, (substring_index(group_concat(s.sale separator ","), ",", 1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 2), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 3), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 4), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 5), ",", -1)
       ) as total_sale, ROUND(concat((substring_index(group_concat(s.sale separator ","), ",", 1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 2), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 3), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 4), ",", -1) +
        substring_index(substring_index(concat(group_concat(s.sale separator ","), ",0"), ",", 5), ",", -1)
       ) / 3), 0) as avg, concat(t.Intransit + SUBSTRING_INDEX(c.closing, ",", 1)) as closing_stock')
				 ->from('product')
				 ->join('('.$s.') s', 's.packcode = product.product_code', 'left')
				 ->join('('.$cs.') cs', 'cs.packcode = product.product_code', 'left')
				 ->join('('.$t.') t', 't.Product = product.product_code and t.Distribution = LTRIM('.$scm_code.')', 'left')
				 ->join('('.$i.') i', 'i.product_code = product.product_code and i.dsr_code = '.$scm_code, 'left')
				 ->join('('.$c.') c', 'c.packcode = product.product_code', 'left')
				 ->join('('.$cc.') cc', 'cc.packcode = product.product_code', 'left')
				 //->where('i.sent >=', '0')
				 ->order_by('product.product_name')
				 ->group_by('product.id');
		if ($user_id!=null) {
			$this->db->where('sales.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}

	public function index_data1($scm_code,$first_date,$last_date,$last_start,$start,$end,$user_id=null)
	{
		$this->db->select("d.dsr_code,p.product_code,od.orders,sum(fo.orders) as sent, sum(fa.receive_quantity) as receive")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->join('factory fa', 'fa.scm_order_no = fo.scm_no and fa.dc_no = fo.dc_no', 'left')
				 ->group_by('od.id');
		$i = $this->db->get_compiled_select();
		$this->db->select('closing, packcode')
				 ->from('sales')
				 ->where('distribution_code = LTRIM('.$scm_code.')')
				 ->where('date >= DATE("'.$first_date.'")')
				 ->where('date <= DATE("'.$last_date.'")')
				 ->order_by('id', 'desc');
				 //->limit(1);
		$c = $this->db->get_compiled_select();
		$this->db->select('closing, packcode')
				 ->from('sales')
				 ->where('distribution_code = LTRIM('.$scm_code.')')
				 ->where('date >= DATE("'.$start.'")')
				 ->where('date <= DATE("'.$end.'")')
				 ->order_by('id', 'desc');
				 //->group_by(array("sales.packcode", "LTRIM(sales.distribution_code)"));
				 //->limit(1);
		$cc = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing')
				 ->from('sales')
				 ->where('LTRIM(sales.distribution_code) = LTRIM('.$scm_code.')')
				 ->where('sales.date >= DATE("'.$first_date.'")')
				 ->where('sales.date <= DATE("'.$last_date.'")')
				 ->group_by(array("MONTH(sales.date)", "sales.packcode", "LTRIM(sales.distribution_code)"));
		$s = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing')
				 ->from('sales')
				 ->where('LTRIM(sales.distribution_code) = LTRIM('.$scm_code.')')
				 ->where('sales.date >= DATE("'.$start.'")')
				 ->where('sales.date <= DATE("'.$end.'")')
				 ->group_by(array("MONTH(sales.date)", "sales.packcode", "LTRIM(sales.distribution_code)"));
		$cs = $this->db->get_compiled_select();
		$this->db->select('Intransit,Distribution,Product')
				 ->from('intransit')
				 ->where('Date >= DATE("'.$last_start.'")')
				 ->where('Date <= DATE("'.$last_date.'")')
				 ->group_by(array('Distribution','Product'))
				 ->order_by('id', 'desc');
		$t = $this->db->get_compiled_select();
		$this->db->select('product.*, group_concat(s.sale separator ",") as sale, group_concat(s.month separator
		",") as month, c.closing, sum(i.sent) as sent, sum(i.receive) as receive, group_concat(i.orders separator
		",") as orders, t.Intransit,cs.sale as current_sale, cc.closing as curent_closing')
				 ->from('product')
				 ->join('('.$s.') s', 's.packcode = product.product_code', 'left')
				 ->join('('.$cs.') cs', 'cs.packcode = product.product_code', 'left')
				 ->join('('.$c.') c', 'c.packcode = product.product_code', 'left')
				 ->join('('.$cc.') cc', 'cc.packcode = product.product_code', 'left')
				 ->join('('.$i.') i', 'i.product_code = product.product_code and i.dsr_code = '.$scm_code, 'left')
				 ->join('('.$t.') t', 't.Product = product.product_code and t.Distribution = LTRIM('.$scm_code.')', 'left')
				 //->where('i.sent >=', '0')
				 ->group_by('product.id');
		if ($user_id!=null) {
			$this->db->where('sales.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}

	/*public function order_index_csv($strat_date,$end_date,$distribution_code)
	{
		$this->db->select('closing, packcode, distribution_code')
				 ->from('sales')
				 ->order_by('id', 'desc')
				 ->limit(1);
		$c = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, "%Y-%m-01") AS DATE, sales.distribution_code')
				 ->from('sales')
				 ->group_by('MONTH(sales.date)');
		$s = $this->db->get_compiled_select();
		$this->db->select("o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH")
				 ->from('orders o')
				 ->join('product p', 'p.product_code = o.pak_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('('.$c.')  c', 'c.packcode = p.product_code AND c.distribution_code = o.distribution_code', 'left')
				 ->join('('.$s.')  s', "s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH )", 'left')
				 ->where('o.date <= DATE("'.$strat_date.'")')
				 ->where('o.date >= DATE("'.$end_date.'")')
				 ->where('LTRIM(d.dsr_code) = LTRIM('.$distribution_code.'))')
				 ->group_by('o.id');
		return $this->db->get()->result_array();
	}*/

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

	public function get_export_data($id)
	{
		$this->db->select("o.id,d.dsr_code,p.product_code,od.orders,sum(fo.orders) as sent, sum(fa.receive_quantity) as receive")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->join('factory fa', 'fa.scm_order_no = fo.scm_no and fa.dc_no = fo.dc_no', 'left')
				 ->group_by('od.id');
		$i = $this->db->get_compiled_select();
		$this->db->select('closing, packcode, distribution_code')
				 ->from('sales')
				 ->order_by('id', 'desc');
				 //->limit(1);
		$c = $this->db->get_compiled_select();
		$this->db->select('sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, "%Y-%m-01") AS date, sales.distribution_code')
				 ->from('sales')
				 ->group_by(array("MONTH(sales.date)", "sales.packcode", "sales.distribution_code"));
		$s = $this->db->get_compiled_select();
		$this->db->select('d.scm_name,d.dsr_code,p.product_code,p.product_name,p.scm_product_code, GROUP_CONCAT(s.sale SEPARATOR ",") AS sale, GROUP_CONCAT(s.month SEPARATOR ",") AS month, c.closing, od.orders, od.total_order, p.pack_carton, p.tp_product,o.date,od.growth,od.id as oid,sum(i.sent) as sent, sum(i.receive) as receive, group_concat(i.orders separator
		",") as de_orders')
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('('.$s.')  s', 's.packcode = p.product_code AND s.distribution_code = TRIM(LEADING "0" FROM d.dsr_code) AND s.date >=( DATE_FORMAT(o.date, "%Y-%m-01") - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, "%Y-%m-%e") - INTERVAL 1 MONTH )', 'left')
				 ->join('('.$c.')  c', 'c.packcode = p.product_code AND c.distribution_code = TRIM(LEADING "0" FROM d.dsr_code)', 'left')
				 ->join('('.$i.')  i', 'i.product_code = p.product_code and i.dsr_code = d.dsr_code and o.id != i.id', 'left')
				 ->group_by('od.id')
				 ->where('o.id', $id);
		return $this->db->get()->result_array();
	}


// 	function order_index_csv($strat_date,$end_date,$distribution_code)
// 	{
// 		return $this->db->query("
// SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) where o.date <= '".$strat_date."' and o.date >= '".$end_date."' and d.scm_code = '".$distribution_code."' GROUP BY o.id


// 			")->result_array();
// 	}


	/*function order_index()
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) GROUP BY o.id


			")->result_array();
	}*/




	













	/*function order_index_single($user_id)
	{
		return $this->db->query("
SELECT o.*, d.scm_name,d.scm_code, c.closing, p.product_name, p.product_code, p.scm_product_code, SUM( o.order_field + o.order_field2 + o.order_field3) AS total, GROUP_CONCAT(s.sale SEPARATOR ',') AS sale, GROUP_CONCAT(s.month SEPARATOR ',') AS MONTH FROM orders o JOIN product p ON p.product_code = o.pak_code JOIN distribution d ON d.scm_code = o.distribution_code LEFT JOIN( SELECT closing, packcode, distribution_code FROM sales ORDER BY id DESC LIMIT 1 ) AS c ON c.packcode = p.product_code AND c.distribution_code = o.distribution_code LEFT JOIN( SELECT sales.packcode, SUM(sales.sales) AS sale, MONTH(sales.date) AS MONTH, sales.closing, DATE_FORMAT(sales.date, '%Y-%m-01') AS DATE, sales.distribution_code FROM sales GROUP BY MONTH(sales.date) ) AS s ON s.packcode = p.product_code AND s.distribution_code = o.distribution_code AND s.date >=( DATE_FORMAT(o.date, '%Y-%m-01') - INTERVAL 3 MONTH ) AND s.date <=( DATE_FORMAT(o.date, '%Y-%m-%e') - INTERVAL 1 MONTH ) WHERE o.user_id = '".$user_id."' GROUP BY o.id


			")->result_array();
	}*/





	

	// function index_data($scm_code=null,$first_date=null,$last_date=null)
	// {

	// 	 return $this->db->query("SELECT product.*, group_concat(s.sale separator ',') as sale, group_concat(s.month separator
	// 	',') as month, c.closing FROM product left join (select sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing from sales where sales.distribution_code = '".$scm_code."' and sales.date >= DATE('".$first_date."') and sales.date <= DATE('".$last_date."') GROUP BY MONTH(sales.date)) as s on s.packcode = product.product_code left join (select closing, packcode from sales where distribution_code = '".$scm_code."' order by id desc limit 1) as c on c.packcode = product.product_code GROUP by product.id")->result_array();

	// }




	// function index_data_single($user_id,$scm_code,$first_date,$last_date)
	// {

	// 	 return $this->db->query("SELECT product.*, group_concat(s.sale separator ',') as sale, group_concat(s.month separator
	// 	',') as month, c.closing FROM product left join (select sales.packcode, sum(sales.sales) as sale, MONTH(sales.date) as month, sales.closing from sales where sales.distribution_code = '".$scm_code."' and sales.date >= DATE('".$first_date."') and sales.date <= DATE('".$last_date."') and sales.user_id = '".$user_id."' GROUP BY MONTH(sales.date)) as s on s.packcode = product.product_code left join (select closing, packcode from sales where distribution_code = '".$scm_code."' and sales.user_id = '".$user_id."' order by id desc limit 1) as c on c.packcode = product.product_code GROUP by product.id")->result_array();

	// }






}
