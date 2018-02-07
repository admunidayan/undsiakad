<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fakultas_m extends CI_Model
{
	public function getdtjp(){

		$this->db->order_by("nm_jenj_didik", "asc");
		$sdf = $this->db->get('jenjang_pendidikan');
		return $sdf->result();
	}
	public function getdtfak(){

		$this->db->order_by("nama_fakultas", "asc");
		$sdf = $this->db->get('fakultas');
		return $sdf->result();
	}
	public function getdtta(){

		$this->db->select('*');
		$this->db->from('semester');
		$this->db->order_by('nm_smt', 'desc');
		$query = $this->db->get();

		return $query->result();
	}
	public function getdtprod(){

		$this->db->order_by("nm_lemb", "asc");
		$sdf = $this->db->get('sms');
		return $sdf->result();
	}
	public function getdtmatkul(){

		$this->db->order_by("nama_matakuliah", "asc");
		$sdf = $this->db->get('matakuliah');
		return $sdf->result();
	}
	public function getdtsemester(){

		$this->db->order_by("id_semester", "asc");
		$sdf = $this->db->get('semester');
		return $sdf->result();
	}
	public function count_mhs_prod($id_prodi){
		if ($id_prodi>0) {
			$this->db->where('id_prodi', $id_prodi);
		}
		$this->db->from('mahasiswa');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	public function count_mhs_fak($id_fakultas){
		if ($id_fakultas>0) {
			$this->db->where('id_fakultas', $id_fakultas);
		}
		$this->db->from('mahasiswa');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	public function count_prodi_fak($id_fakultas){
		$this->db->where('id_fakultas', $id_fakultas);
		$this->db->from('prodi');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	//detail fakultas
	public function detail_fak($id_fakultas){
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = fakultas.id_jenjang_pend');
		$this->db->where('id_fakultas', $id_fakultas);

		$query = $this->db->get();

		return $query;
	}
	// ambil data prodi berdasarkan fakultas
	public function getprodfak($id_fakultas){
		$this->db->where('id_fakultas', $id_fakultas);
		$sdf = $this->db->get('prodi');
		return $sdf->result();
	}
	// menampilkan jenjang pendidikan berdasarkan prodi
	public function jenpend($idkur) {
		$this->db->select('nama_jenjang_pend');
		$this->db->from('jenjang_pend');
		$this->db->where('id_jenjang_pend', $idkur);
		$query = $this->db->get();
		return $query->row();
	}
	// mahasiswa
}
