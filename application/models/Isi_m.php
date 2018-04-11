<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Isi_m extends CI_Model {
	
	public function cekprodi($id){
		$this->db->select('id_sms,kode_prodi');
		$this->db->where('id_sms',$id);
		$query = $this->db->get('sms');
		return $query->row();
	}
	public function detail_data_order($table,$field,$id){
		$this->db->where($field,$id);
		$query = $this->db->get($table);
		return $query->row();
	}
	public function ceknilai($nipd,$smt,$mk){
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	public function ceknilait($id){
		$this->db->where('id_ekuivalensi',$id);
		$query = $this->db->get('nilai_transfer');
		return $query->row();
	}
	public function cekmhs($id){
		$this->db->select('id_pd');
		$this->db->where('id_pd',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function cekmhspt($id){
		$this->db->select('id_reg_pd');
		$this->db->where('id_reg_pd',$id);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function mhs_by_mhs_pt($limit,$id){
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('mahasiswa_pt',$limit,$id);
		return $query->result();
	}
	public function mhs_by_mhs_pt_by_prodi($sms,$limit,$id){
		$this->db->where('kode_sms',$sms);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('mahasiswa_pt',$limit,$id);
		return $query->result();
	}
	public function get_list_data($tabel){
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($table);
		return $query->result();
	}
	public function get_last_id() {
		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function get_nilai($id) {
		$this->db->where('id_mhs_pt',$id);
		$query = $this->db->get('nilai');
		return $query->result();
	}
	public function get_id_kls_siakad($id) {
		$this->db->select('id,id_kls');
		$this->db->where('id_kls',$id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function cekmkkur($id){
		$this->db->select('id_kurikulum_sp');
		$this->db->where('id_kurikulum_sp',$id);
		$query = $this->db->get('mata_kuliah_kurikulum');
		return $query->row();
	}
	public function cekmkkurprod($id,$id2){
		$this->db->select('id_kurikulum_sp');
		$this->db->where('id_kurikulum_sp',$id);
		$this->db->where('id_mk',$id2);
		$query = $this->db->get('mata_kuliah_kurikulum');
		return $query->row();
	}
	public function cekmk($id){
		$this->db->select('id_mk');
		$this->db->where('id_mk',$id);
		$query = $this->db->get('mata_kuliah');
		return $query->row();
	}
	public function cekdosen($id){
		$this->db->select('id_sdm');
		$this->db->where('id_sdm',$id);
		$query = $this->db->get('dosen');
		return $query->row();
	}
	public function cekdosenpt($id){
		$this->db->select('id_reg_ptk');
		$this->db->where('id_reg_ptk',$id);
		$query = $this->db->get('dosen_pt');
		return $query->row();
	}
	public function cekklskul($id){
		$this->db->select('id_kls');
		$this->db->where('id_kls',$id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function cekkelasdosen($id){
		$this->db->select('id_ajar');
		$this->db->where('id_ajar',$id);
		$query = $this->db->get('ajar_dosen');
		return $query->row();
	}
	public function getnm_mk($id){
		$this->db->select('nm_mk');
		$this->db->where('kode_mk',$id);
		$query = $this->db->get('mata_kuliah');
		return $query->row();
	}
	public function cekkelaskul($kls,$id){
		$this->db->where('id_smt',$kls);
		$this->db->where('id_reg_pd',$id);
		$query = $this->db->get('kuliah_mahasiswa');
		return $query->row();
	}
	public function cekwil($id){
		$this->db->where('id_wil',$id);
		$query = $this->db->get('wilayah');
		return $query->row();
	}
	public function get_data_tabel($tabel){
		$query = $this->db->get($tabel);
		return $query->result();
	}
	public function detail_get($tabel,$nmfiled,$id){
		$this->db->where($nmfiled,$id);
		$query = $this->db->get($tabel);
		return $query->row();
	}
	function Insert($db,$data){
		$this->db->Insert($db,$data);
	}
	function update($db,$id,$data){
		$this->db->where('id',$id);
		$this->db->Update($db,$data);
	}
	function jumlah_mahasiswa(){
		return $this->db->get('mahasiswa')->num_rows();
	}
	function jumlah_mahasiswa_pt(){
		return $this->db->get('mahasiswa_pt')->num_rows();
	}
	function jumlah_mata_kuliah(){
		return $this->db->get('mata_kuliah')->num_rows();
	}
	function jumlah_mata_kuliah_kurikulum(){
		return $this->db->get('mata_kuliah_kurikulum')->num_rows();
	}
	function jumlah_mata_kuliah_prodi($sms){
		$this->db->where('id_sms',$sms);
		return $this->db->get('mata_kuliah')->num_rows();
	}
	function jumlah_dosen(){
		return $this->db->get('dosen')->num_rows();
	}
	function jumlah_dosen_pt(){
		return $this->db->get('dosen_pt')->num_rows();
	}
	function jumlah_ajar_dosen(){
		return $this->db->get('ajar_dosen')->num_rows();
	}
	function jumlah_kuliah_mahasiswa(){
		return $this->db->get('kuliah_mahasiswa')->num_rows();
	}
	function jumlah_nilai_transfer(){
		return $this->db->get('nilai_transfer')->num_rows();
	}
	function jumlah_wilayah(){
		return $this->db->get('wilayah')->num_rows();
	}
}
