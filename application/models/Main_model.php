<?php 

class Main_model extends MY_Model
{
	public function get_menu($role)
	{
		$this->db->select('m.*')
				 ->from('modules m')
				 ->join('permission p', 'p.module_id = m.id')
				 ->where('p.user_type_id', $role)
				 ->where('(p.view = 1 or p.view_all = 1)')
				 ->group_by('m.id')
				 ->order_by('m.sort');
		return $this->db->get()->result_array();
	}

	public function get_user_permission($module,$role)
	{
		$this->db->select('p.*')
				 ->from('permission p')
				 ->join('modules m','m.id = p.module_id')
				 ->where('m.main_name',$module)
				 ->where('p.user_type_id',$role);
		return $this->db->get()->row_array();
	}
}