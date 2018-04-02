<?php 

class Distributor_model extends MY_Model
{
	/*public function get_data($id=null)
	{
		$this->db->select('f.*,d.scm_name,p.product_name')
				 ->from('factory f')
				 ->join('orders o', 'f.scm_order_no = o.id')
				 ->join('distribution d', 'd.scm_code = o.distribution_code')
				 ->join('product p', 'o.pak_code = p.product_code');
		if ($id != null) {
			$this->db->where('f.user_id',$id);
		}
		return $this->db->get()->result_array();
	}*/

	public function get_data($order,$id=null){
		$this->db->select('fa.*,d.scm_name,p.product_name,f.orders,f.id,f.receive_quantity,f.distribution_remarks')
				 ->from('finance_order f')
				 ->join('orders o', 'f.order_id = o.id')
				 ->join('factory fa', 'fa.scm_order_no = f.scm_no and fa.dc_no = f.dc_no')
				 ->join('product p', 'f.scm_code = p.scm_product_code')
				 ->join('distribution d', 'o.distribution_code = d.dsr_code')
				 ->where('o.id',$order);
		if ($id!=null) {
			$this->db->where('f.user_id', $id);
		}
		return $this->db->get()->result_array();
	}

	public function get_index($id=null)
	{
		$this->db->select('f.*,o.*, d.scm_name')
				 ->from('orders o')
				 ->join('factory f', 'f.order_id = o.id')
				 ->join('distribution d', 'd.dsr_code = o.distribution_code');
		if ($id!=null) {
			$this->db->where('o.user_id', $user_id);
		}
		return $this->db->get()->result_array();
	}
}