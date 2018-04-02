<?php
		    class Intransit_model extends MY_Model{

		    	public function get_intransit($id = null)
					{
						$this->db->select('intransit.*,distribution.scm_name,product.product_name')
								 ->from('intransit')->join('distribution', 'distribution.dsr_code = intransit.Distribution')->join('product', 'product.product_code = intransit.Product'); if ($id != null) {
								$this->db->where('intransit.user_id', $id);
							}return $this->db->get()->result_array();
					}}