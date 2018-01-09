<?php 

class Finance_model extends MY_Model
{
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
}