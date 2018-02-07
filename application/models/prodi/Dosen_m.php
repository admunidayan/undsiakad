<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dosen_m extends CI_Model {
	
	public function dosen_by_pord($id){
		$this->db->select('dosen_pt.*,atur_dosen.nm_mk');
		$this->db->from('dosen_pt');
		$this->db->where('kode_jurusan', $id);
		$this->db->join('atur_dosen', 'atur_dosen.id_dosen = dosen_pt.id_dosen');
		$this->db->order_by('id_thn_ajaran', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function id_prodi($id){
		$this->db->select('id_prodi');
		$this->db->where('kode_prodi',$id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	function jumlah_dosen($id,$dosen,$tahun){
		if (!empty($dosen)) {
			$this->db->like('nm_sdm',$dosen);
		}
		if (!empty($tahun)) {
			$this->db->where('id_thn_ajaran',$tahun);
		}
		// $this->db->join('atur_dosen', 'atur_dosen.id_dosen = dosen_pt.id_dosen');
		$this->db->where('kode_jurusan', $id);
		return $this->db->get('dosen_pt')->num_rows();
	}
	public function searcing_dosen($sampai,$dari,$id,$dosen,$tahun){
		$this->db->select('dosen_pt.*,atur_dosen.nm_mk,atur_dosen.id_tahun_ajaran');
		$this->db->join('atur_dosen', 'atur_dosen.id_dosen = dosen_pt.id_dosen');
		if (!empty($dosen)){$this->db->like('nm_sdm',$dosen);}
		if (!empty($tahun)){$this->db->where('id_thn_ajaran',$tahun);}
		$this->db->where('kode_jurusan', $id);
		$query = $this->db->get('dosen_pt',$sampai,$dari);
		return $query->result();
	}
	public function dosen_export_xecel(){
		$this->db->select('nidn,nm_sdm');
		// $this->db->where('kode_jurusan', $id);
		$query = $this->db->get('dosen');
		return $query->result();
	}
}
