<?php 

class Grn_model extends MY_Model
{
	public function get_data($order,$id = null)
	{
		$this->db->select("od.order_id,d.scm_name,p.product_name,od.orders,sum(fo.orders) as sent, sum(fo.receive_quantity) as receive")
				 ->from('orders o')
				 ->join('order_detail od', 'od.order_id = o.id')
				 ->join('product p', 'p.product_code = od.pack_code')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code')
				 ->join('finance_order fo', 'od.order_id = fo.order_id and fo.scm_code = p.scm_product_code', 'left')
				 ->join('factory fa', 'fa.scm_order_no = fo.scm_no and fa.dc_no = fo.dc_no', 'left')
				 ->where('o.id', $order)
				 ->group_by('od.id');
		if ($id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}
}