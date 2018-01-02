<?php 


class Distribution_model extends MY_Model
{
	public function view_data_index($id=null,$user_id=null)
	{
		$this->db->select('users.*,distribution.*')
				 ->from('users')
				 ->join('distribution','users.id = distribution.distribution_id');
		if ($id != null) {
			$this->db->where('distribution.id',$id);
		}
		if ($user_id != null) {
			$this->db->where('distribution.user_id',$id);
		}
		return $this->db->get()->result_array();
	}



}



