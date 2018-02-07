<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_m extends CI_Model
{
	public function grupuser($id){
		$this->db->select('*');
		$this->db->from('users_groups');
		$this->db->join('groups', 'groups.id = users_groups.group_id');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function cek_users($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
}
