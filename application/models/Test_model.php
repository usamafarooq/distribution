<?php
		    class Test_model extends MY_Model{

		    	public function get_test($id = null)
				{
					$this->db->select('test.*,users.name,users.email')
							 ->from('test')->join('users', 'users.id = test.employee_id');if ($id != null) {
							$this->db->where('test.user_id', $id);
						}return $this->db->get()->result_array();
				}}