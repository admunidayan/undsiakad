<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen_m extends CI_Model
{
	public function alldosen($sampai,$dari){
		$this->db->order_by('nama_dosen', 'asc');
		$query = $this->db->get('dosen',$sampai,$dari);
		return $query->result();
	}
	public function get_all_dosen(){
		$this->db->order_by('nama_dosen', 'asc');
		$query = $this->db->get('dosen');
		return $query->result();
	}
	// detail dosen
	public function detaildosen($id){
		$this->db->select('*');
		$this->db->from('dosen');
		$this->db->where('id_dosen', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// cek foto profil dosen
	public function detail_dosen($id_dosen){
		$this->db->select('*');
		$this->db->from('dosen');
		$this->db->where('id_dosen', $id_dosen);
		$query = $this->db->get();
		return $query;
	}
	// ambil kode jurusan dari id_sms dosen_pt
	public function get_jurusan($id) {
		$this->db->select('kode_prodi');
		$this->db->from('prodi');
		$this->db->where('id_sms', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// ambil kode jurusan dari id_kls ajar_dosen feeder
	public function get_jur_id($id) {
		$this->db->select('kode_jurusan');
		$this->db->from('kelas_kuliah');
		$this->db->where('id_kls', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// ambil id_dosen dari id_sdm dosen_pt
	public function dosen_id($id) {
		$this->db->select('id_dosen,id_thn_ajaran');
		$this->db->from('dosen_pt');
		$this->db->where('id_reg_ptk', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// 
	public function get_id_dosen($id) {
		$this->db->select('id_dosen');
		$this->db->from('dosen');
		$this->db->where('id_sdm', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// ambil kode_mk dari kelas_kuliah
	public function get_kode_mk($id) {
		$this->db->select('kode_mk');
		$this->db->from('kelas_kuliah');
		$this->db->where('id_kls', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_jurusan_by_sms($id) {
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('kode_prodi', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// tampilkan seluruh dosen PT
	public function get_dosen_pt(){
		$this->db->select('*');
		$this->db->from('dosen_pt');
		$query = $this->db->get();
		return $query->result();
	}
	// cek adanya dosen di database
	public function cekdosenpt($id) {
		$this->db->select('id_sdm');
		$this->db->from('dosen_pt');
		$this->db->where('id_sdm', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// cek adanya atur_dosen di database
	public function cekkelasdosen($id) {
		$this->db->select('id_ajar');
		$this->db->from('atur_dosen');
		$this->db->where('id_ajar', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// }AJAX SELECT KELAS MENGJAR
	public function get_kelas_mengajar_dosen(){
		$this->db->select('*');
		$this->db->from('atur_dosen');
		$query = $this->db->get();
		return $query->result();
	}
	// input kelas mengajar dosen
	public function kelasmengajar($id_dosen){
		$this->db->select('atur_dosen.*,tahun_ajaran.nama_tahun_ajaran,jenjang_pend.nama_jenjang_pend,fakultas.nama_fakultas,prodi.nama_prodi,semester.nama_semester,matakuliah.nama_matakuliah');
		$this->db->from('atur_dosen');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = atur_dosen.id_jenjang_pend');
		$this->db->join('fakultas', 'fakultas.id_fakultas = atur_dosen.id_fakultas');
		$this->db->join('prodi', 'prodi.id_prodi = atur_dosen.id_prodi');
		$this->db->join('semester', 'semester.id_semester = atur_dosen.id_semester');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = atur_dosen.id_matakuliah');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = atur_dosen.id_tahun_ajaran');
		$this->db->where('id_dosen', $id_dosen);
		$query = $this->db->get();
		return $query->result();
	}
	public function riwayat_pendidikan($id){
		$this->db->select('*');
		$this->db->from('riwayat_pend');
		$this->db->where('id_dosen', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function riwayat_mengajar($id){
		$this->db->select('*');
		$this->db->from('riwayat_mengajar');
		$this->db->where('id_dosen', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getLastID() {
		$this->db->select('id_dosen');
		$this->db->from('dosen');
		$this->db->order_by('id_dosen', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	public function getdtgol($id_dosen){
		$this->db->select('*');
		$this->db->from('golongan_dosen');
		$this->db->where('id_dosen', $id_dosen);
		$query = $this->db->get();
		return $query->result();
	}
	public function getdtpak($id_dosen){
		$this->db->select('*');
		$this->db->from('pemangkatan_dosen');
		$this->db->where('id_dosen', $id_dosen);
		$query = $this->db->get();
		return $query->result();
	}
	// Insert
	public function insert_kelas_mengajar_dosen($data){
		$this->db->insert('atur_dosen', $data);
	}
	public function insert_dosen($data){
		$this->db->insert('dosen', $data);
	}
	public function insert_dosen_pt($data){
		$this->db->insert('dosen_pt', $data);
	}
	public function insert_ajar_dosen($data){
		$this->db->insert('atur_dosen', $data);
	}
	public function insert_riwayat_pend_dosen($data){
		$this->db->insert('riwayat_pend', $data);
	}
	public function insert_riwayat_meng_dosen($data){
		$this->db->insert('riwayat_mengajar', $data);
	}
	public function edit_info_pribadi_dos($id, $data){
		$this->db->where('id_dosen', $id);
		$this->db->update('dosen', $data);
	}
	public function delete_riwayat_pend($id){
		$this->db->where('id_riwayat_pend', $id);
		$this->db->delete('riwayat_pend');
	}
	public function delete_riwayat_meng($id){
		$this->db->where('id_riwayat_mengajar', $id);
		$this->db->delete('riwayat_mengajar');
	}
	// baru
	function jumlah_data_dosen($string){
		if (!empty($string)) {
			$this->db->like('npp',$string);
			$this->db->or_like('nama_dosen',$string);
		}
		return $this->db->get('dosen')->num_rows();
	}
	public function searcing_data($sampai,$dari,$dosen){
		if (!empty($dosen)) {
			$this->db->like('npp',$dosen);
			$this->db->or_like('nama_dosen',$dosen);
		}
		$query = $this->db->get('dosen',$sampai,$dari);
		return $query->result();
	}
	// kelas
	function jml_kls_dsn($id,$string){
		if (!empty($string)) {
			$this->db->like('nm_mk',$string);
		}
		$this->db->where('id_dosen', $id);
		return $this->db->get('atur_dosen')->num_rows();
	}
	public function searcing_kls_dsn($sampai,$dari,$id,$dosen){
		if (!empty($dosen)) {
			$this->db->like('npp',$dosen);
			$this->db->or_like('atur',$dosen);
		}
		$this->db->where('id_dosen', $id);
		$this->db->order_by('id_atur_dosen','desc');
		$query = $this->db->get('atur_dosen',$sampai,$dari);
		return $query->result();
	}
	function get_prodi($id){
		$this->db->select('nama_prodi');
		$this->db->where('id_prodi', $id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	function get_smt_kls($id){
		$this->db->select('semester');
		$this->db->where('id_kls', $id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
}
