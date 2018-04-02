<?php 

class Finance_pending_model extends MY_Model
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
		$this->db->select("po.id, d.scm_name,p.product_name, od.orders, concat(sum(od.orders) - (CASE  WHEN sum(fo.orders) IS NULL THEN 0 WHEN sum(fo.orders) IS NOT NULL THEN sum(fo.orders) END)) as pending, po.qty")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('pending_orders po', 'po.detail_id = od.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->where('o.id',$id)
				 ->where('po.status','0')
				 //->where('o.date <= DATE("'.$end.'")')
				 //->group_by('od.id');
				 ->having('pending > 0')
				 ->group_by('po.id');
		//$i = $this->db->get_compiled_select();
		if ($user_id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}

	public function get_csv_data1($id)
	{
		$this->db->select('o.distribution_code as dcode, o.id as system-code, "" as one, "" as two, p.scm_product_code as scm-product-code, od.orders as qty, "401" as financecode-hardcoded')
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->where('o.id', $id);
		return $this->db->get()->result_array();
	}

	public function get_csv_data($id)
	{
		$this->db->select('o.distribution_code as dcode, concat(o.id, "_", po.id) as systemcode, "" as one, "" as two, p.scm_product_code as "scm-product-code", po.qty as qty, "401" as "financecode-hardcoded"')
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('pending_orders po', 'po.detail_id = od.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->where('o.id',$id)
				 ->where('po.status','0');
				 //->having('pending > 0');
				 //->group_by('po.id');
		return $this->db->get()->result_array();
	}
}