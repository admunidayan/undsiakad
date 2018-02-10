<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Export_m extends CI_Model {

	public function cekdata($value) {
		$this->db->select('nipd');
		$this->db->where('nipd', $value);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function cekdatamk($value) {
		$this->db->select('kode_matakuliah');
		$this->db->from('matakuliah');
		$this->db->where('kode_matakuliah', $value);
		$query = $this->db->get();
		return $query->result();
	}
	public function cekdatdos($value) {
		$this->db->select('npp');
		$this->db->from('dosen');
		$this->db->where('npp', $value);
		$query = $this->db->get();
		return $query->result();
	}
	function insert_mhs($data){
		$this->db->insert('mahasiswa', $data);
	}
	function insert_dosen($data){
		$this->db->insert('dosen', $data);
	}
	function insert_mhs_pt($data){
		$this->db->insert('mahasiswa_pt', $data);
	}
	function insert_mk_prod($data){
		$this->db->insert('matakuliah', $data);
	}
	function insert_aturmk($data){
		$this->db->insert('atur_matkul', $data);
	}
	public function getidmk() {
		$this->db->select('id_matakuliah');
		$this->db->from('matakuliah');
		$this->db->order_by('id_matakuliah', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	public function get_last_id() {
		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function get_id_sms($id) {
		$this->db->select('id_sms');
		$this->db->where('kode_prodi',$id);
		$query = $this->db->get('sms');
		return $query->row();
	}
	// kelas
	public function cekkls($smt,$mk,$prod) {
		$this->db->where('semester', $smt);
		$this->db->where('kode_mk', $mk);
		$this->db->where('kode_jurusan', $prod);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function getkodemk($id){
		$this->db->where('kode_matakuliah',$id);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	public function getaturmk($id){
		$this->db->where('id_matakuliah',$id);
		$query = $this->db->get('atur_matkul');
		return $query->row();
	}
	function insert_kls($data){
		$this->db->insert('kelas_kuliah', $data);
	}
	//Mahasiswa kelas
	public function cekmhskls($id,$kls){
		$this->db->where('nipd',$id);
		$this->db->where('id_kls_siakad',$kls);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	public function getmhs($id){
		$this->db->where('nipd',$id);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	function insert_mhs_kls($data){
		$this->db->insert('nilai', $data);
	}
}
