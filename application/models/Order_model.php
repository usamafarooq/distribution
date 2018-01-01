<?php 

class Order_model extends MY_Model
{
	


	public function order_detail($id = null)
	{
		$this->db->select('distribution.scm_name,order_table.Packcode,order_table.Datename,order_table.Sales,order_table.id,product.product_name,order_table.Closing')
				 ->from('distribution')
				 ->join('order_table', 'distribution.scm_code = order_table.Distribution_code')
				 ->join('product', 'product.product_code = order_table.Packcode')
				 ->group_by('order_table.id'); 
		return $this->db->get()->result_array();
	}




}