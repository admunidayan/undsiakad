<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kelulusan_m extends CI_Model {
	
	public function get_id_prodi($id){
		$this->db->where('kode_prodi',$id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	function jumlah($id,$string){
		if (!empty($string)) {
			$this->db->like('npm',$string);
			$this->db->or_like('nama',$string);
		}
		$this->db->where('kode_jurusan', $id);
		return $this->db->get('kelulusan')->num_rows();
	}
	public function searcing_data($sampai,$dari,$id,$string){
		if (!empty($string)) {
			$this->db->like('npm',$string);
			$this->db->or_like('nama',$string);
		}
		$this->db->order_by('id_kelulusan','desc');
		$this->db->where('kode_jurusan',$id);
		$query = $this->db->get('kelulusan',$sampai,$dari);
		return $query->result();
	}
	public function angkatan($npm){
		$this->db->select('angkatan');
		$this->db->where('npm',$npm);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function jnskel($id){
		$this->db->where('id_jns_keluar',$id);
		$query = $this->db->get('jenis_keluar');
		return $query->row();
	}
}
