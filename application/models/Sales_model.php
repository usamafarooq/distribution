<?php 

class Sales_model extends MY_Model
{
	


	public function sales_detail($id = null)
	{
		$this->db->select('distribution.scm_name,sales.packcode,sales.date,sales.sales,sales.id,product.product_name,sales.closing')
				 ->from('sales')
				 ->join('distribution', 'trim("0" from distribution.dsr_code) = sales.Distribution_code')
				 ->join('product', 'product.product_code = sales.Packcode')
				 ->group_by('sales.id'); 
		return $this->db->get()->result_array();
	}




}