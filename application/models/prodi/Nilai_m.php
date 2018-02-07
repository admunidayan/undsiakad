<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nilai_m extends CI_Model {
	
	public function get_mhs($id){
		$this->db->where('id_mhs',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function get_mk($id){
		$this->db->where('id_matakuliah',$id);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	public function get_remed($id){
		$this->db->where('id_matakuliah',$id);
		$query = $this->db->get('atur_matkul');
		return $query->row();
	}
	public function insert_khs($data){
		$this->db->insert('khs',$data);
	}
	public function edit_khs($id,$data){
		$this->db->where('id_khs',$id);
		$this->db->update('khs',$data);
	}
	public function delete_khs($id){
		$this->db->where('id_khs',$id);
		$this->db->delete('khs');
	}
}
