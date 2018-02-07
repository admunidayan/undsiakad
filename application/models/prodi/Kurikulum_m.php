<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kurikulum_m extends CI_Model {
	public function mk_by_pord($idkur){
		$this->db->select('mata_kuliah_kurikulum.*,mata_kuliah.id,mata_kuliah.kode_mk,mata_kuliah.nm_mk,mata_kuliah_kurikulum.id AS idkur');
		$this->db->join('mata_kuliah', 'mata_kuliah.id = mata_kuliah_kurikulum.id_mk_siakad');
		$this->db->where('mata_kuliah_kurikulum.id_kurikulum_siakad',$idkur);
		$this->db->order_by('smt,sks_mk');
		$sdf = $this->db->get('mata_kuliah_kurikulum');
		return $sdf->result();
	}
	public function mhsbyprod($id){
		$this->db->where('id_prodi', $id);
		$sdf = $this->db->get('prodi');
		return $sdf->row();
	}
	public function kur_by_pord($id){
		// $this->db->select('id,nm_kurikulum_sp');
		$this->db->where('id_sms',$id);
		$this->db->order_by('nm_kurikulum_sp','desc');
		$query = $this->db->get('kurikulum');
		return $query->result();
	}
	public function detail_prodi($kode) {
		$this->db->where('kode_prodi', $kode);
		$query = $this->db->get('sms');
		return $query;
	}
	public function detail_data($tabel,$field,$id) {
		$this->db->where($field, $id);
		$query = $this->db->get($tabel);
		return $query->row();
	}
	public function getkurby($idkur) {
		$this->db->from('kurikulum');
		$this->db->where('id_kurikulum', $idkur);
		$query = $this->db->get();
		return $query->row();
	}
	function insert_kur($data){
		$this->db->insert('kurikulum', $data);
	}
	// import exel
	public function cekdatamk($value) {
		$this->db->select('kode_matakuliah');
		$this->db->from('matakuliah');
		$this->db->where('kode_matakuliah', $value);
		$query = $this->db->get();
		return $query->result();
	}
	function insert_mk_prod($data){
		$this->db->insert('matakuliah', $data);
	}
	function insert_aturmk($data){
		$this->db->insert('atur_matkul', $data);
	}
	public function dtmk($id) {
		$this->db->select('id_matakuliah');
		$this->db->where('kode_matakuliah', $id);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	public function getidmk() {
		$this->db->select('id_matakuliah');
		$this->db->from('matakuliah');
		$this->db->order_by('id_matakuliah', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	function update_kur($id,$data){
		$this->db->where('id_kurikulum', $id);
		$this->db->update('kurikulum', $data);
	}
	function delete_kur($id){
		$this->db->where('id_kurikulum', $id);
		$this->db->delete('kurikulum');
	}
	function delete_mkkur($id){
		$this->db->where('id_atur_matkul', $id);
		$this->db->delete('atur_matkul');
	}
}
