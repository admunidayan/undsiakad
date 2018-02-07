<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ta_m extends CI_Model {
	public function getdtta(){
		$this->db->select('*');
		$this->db->from('tahun_ajaran');
		$this->db->order_by('k_index_ta', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
}
