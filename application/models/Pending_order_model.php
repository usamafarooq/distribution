<?php 

class Pending_order_model extends MY_Model
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

	public function get_detail($id,$user_id=null)
	{
		$this->db->select("od.id, o.id as orderid,o.date, d.scm_name,p.product_name, od.orders, concat(sum(od.orders) - (CASE  WHEN sum(fo.orders) IS NULL THEN 0 WHEN sum(fo.orders) IS NOT NULL THEN sum(fo.orders) END)) as pending")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->where('o.id',$id)
				 //->where('o.date <= DATE("'.$end.'")')
				 //->group_by('od.id');
				 ->having('pending > 0')
				 ->group_by('od.id');
		//$i = $this->db->get_compiled_select();
		if ($user_id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}

	public function get_detail_product($id,$user_id=null)
	{
		$this->db->select("od.id, o.id as orderid,o.date, d.scm_name,p.product_name, od.orders, concat(sum(od.orders) - (CASE  WHEN sum(fo.orders) IS NULL THEN 0 WHEN sum(fo.orders) IS NOT NULL THEN sum(fo.orders) END)) as pending")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->where('od.pack_code',$id)
				 //->where('o.date <= DATE("'.$end.'")')
				 //->group_by('od.id');
				 ->having('pending > 0')
				 ->group_by('od.id');
		//$i = $this->db->get_compiled_select();
		if ($user_id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}
}