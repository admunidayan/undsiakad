<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keuangan_m extends CI_Model {

	public function getdtta(){
		$this->db->order_by('k_index_ta', 'desc');
		$query = $this->db->get('tahun_ajaran');
		return $query->result();
	}
	public function getprodi(){
		$this->db->order_by('smt_mulai', 'asc');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas');
		$query = $this->db->get('prodi');
		return $query->result();
	}
	public function listkeuangan(){
		$query = $this->db->get('jenis_pembayaran');
		return $query->result();
	}
	public function liststatusbayar(){
		$query = $this->db->get('status_bayar');
		return $query->result();
	}
	public function detailjnsbayar($id){
		$this->db->where('id_jenis_pembayaran',$id);
		$query = $this->db->get('jenis_pembayaran');
		return $query->row();
	}
	public function detailprodi($id){
		$this->db->where('kode_prodi',$id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	public function detailta($id){
		$this->db->where('id_tahun_ajaran',$id);
		$query = $this->db->get('tahun_ajaran');
		return $query->row();
	}
	public function listmahasiswa($index_ta,$id_prodi,$idbayar){
		$this->db->select('pembayaran_mhs.*,mahasiswa.nama_mhs,mahasiswa.id_prodi,mahasiswa.npm');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = pembayaran_mhs.id_mhs');
		$this->db->where('pembayaran_mhs.k_index_ta',$index_ta);
		$this->db->where('mahasiswa.id_prodi',$id_prodi);
		$this->db->where('pembayaran_mhs.id_jenis_pembayaran',$idbayar);
		$query = $this->db->get('pembayaran_mhs');
		return $query->result();
	}
	function jumlah_data_mhs($index_ta,$id_prodi,$idbayar,$string,$angkatan){
		$this->db->select('pembayaran_mhs.*,mahasiswa.nama_mhs,mahasiswa.angkatan,mahasiswa.id_prodi,mahasiswa.npm');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = pembayaran_mhs.id_mhs');
		if (!empty($string)) {
			$this->db->like('mahasiswa.npm',$string);
			$this->db->or_like('mahasiswa.nama_mhs',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa.angkatan',$angkatan);
		}
		$this->db->where('pembayaran_mhs.k_index_ta',$index_ta);
		$this->db->where('mahasiswa.id_prodi',$id_prodi);
		$this->db->where('pembayaran_mhs.id_jenis_pembayaran',$idbayar);
		return $this->db->get('pembayaran_mhs')->num_rows();
	}
	public function searcing_data($sampai,$dari,$index_ta,$id_prodi,$idbayar,$string,$angkatan){
		$this->db->select('pembayaran_mhs.*,mahasiswa.nama_mhs,mahasiswa.angkatan,mahasiswa.id_prodi,mahasiswa.npm');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = pembayaran_mhs.id_mhs');
		if (!empty($string)) {
			$this->db->like('mahasiswa.npm',$string);
			$this->db->or_like('mahasiswa.nama_mhs',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa.angkatan',$angkatan);
		}
		$this->db->order_by('id_mhs','asc');
		$this->db->where('pembayaran_mhs.k_index_ta',$index_ta);
		$this->db->where('mahasiswa.id_prodi',$id_prodi);
		$this->db->where('pembayaran_mhs.id_jenis_pembayaran',$idbayar);
		$query = $this->db->get('pembayaran_mhs',$sampai,$dari);
		return $query->result();
	}
	public function getangkatan(){
		$this->db->order_by('kode_angkatan', 'desc');
		$query = $this->db->get('angkatan');
		return $query->result();
	}
	function jumlah_data_mhs_sts($index_ta,$id_prodi,$idbayar,$sts,$string,$angkatan){
		$this->db->select('pembayaran_mhs.*,mahasiswa.nama_mhs,mahasiswa.angkatan,mahasiswa.id_prodi,mahasiswa.npm');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = pembayaran_mhs.id_mhs');
		if (!empty($string)) {
			$this->db->like('mahasiswa.npm',$string);
			$this->db->or_like('mahasiswa.nama_mhs',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa.angkatan',$angkatan);
		}
		$this->db->where('pembayaran_mhs.k_index_ta',$index_ta);
		$this->db->where('mahasiswa.id_prodi',$id_prodi);
		$this->db->where('pembayaran_mhs.id_jenis_pembayaran',$idbayar);
		$this->db->where('pembayaran_mhs.status_bayar',$sts);
		return $this->db->get('pembayaran_mhs')->num_rows();
	}
	public function searcing_data_sts($sampai,$dari,$index_ta,$id_prodi,$idbayar,$sts,$string,$angkatan){
		$this->db->select('pembayaran_mhs.*,mahasiswa.nama_mhs,mahasiswa.angkatan,mahasiswa.id_prodi,mahasiswa.npm');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = pembayaran_mhs.id_mhs');
		if (!empty($string)) {
			$this->db->like('mahasiswa.npm',$string);
			$this->db->or_like('mahasiswa.nama_mhs',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa.angkatan',$angkatan);
		}
		$this->db->order_by('id_mhs','asc');
		$this->db->where('pembayaran_mhs.k_index_ta',$index_ta);
		$this->db->where('mahasiswa.id_prodi',$id_prodi);
		$this->db->where('pembayaran_mhs.id_jenis_pembayaran',$idbayar);
		$this->db->where('pembayaran_mhs.status_bayar',$sts);
		$query = $this->db->get('pembayaran_mhs',$sampai,$dari);
		return $query->result();
	}
	public function get_atur_bayar($id){
		$this->db->where('id_atur_pembayaran',$id);
		$query = $this->db->get('atur_pembayaran');
		return $query->row();
	}
	public function get_atur_bayar_by_angkatan($id,$byr){
		$this->db->where('kode_angkatan',$id);
		$this->db->where('id_jenis_pembayaran',$byr);
		$query = $this->db->get('atur_pembayaran');
		return $query->row();
	}
	public function get_status($id){
		$this->db->where('id_status_bayar',$id);
		$query = $this->db->get('status_bayar');
		return $query->row();
	}
	public function detail_mhs($id){
		$this->db->where('id_mhs',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function list_pembayaran_mhs($id){
		$this->db->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = pembayaran_mhs.id_jenis_pembayaran');
		$this->db->where('id_mhs',$id);
		$query = $this->db->get('pembayaran_mhs');
		return $query->result();
	}
	public function edit_pembayaran_mhs($id){
		$this->db->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = pembayaran_mhs.id_jenis_pembayaran');
		$this->db->where('id_pembayaran_mhs',$id);
		$query = $this->db->get('pembayaran_mhs');
		return $query->row();
	}
	function proses_edit_pembayaran($id,$data){
		$this->db->where('id_pembayaran_mhs',$id);
		$this->db->update('pembayaran_mhs',$data);
	}
	public function get_mhs_aktif_by_prodi($id){
		$this->db->select('mahasiswa.id_mhs,mahasiswa.angkatan');
		$this->db->where('id_prodi',$id);
		$this->db->where('status_mhs',"Aktif");
		$query = $this->db->get('mahasiswa');
		return $query->result();
	}
	function insert_pbyr_by_prod($data){
		$this->db->insert('pembayaran_mhs',$data);
	}
	public function get_jenis_pembayaran(){
		$query = $this->db->get('jenis_pembayaran');
		return $query->result();
	}
	public function get_atur_pembayaran(){
		$this->db->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = atur_pembayaran.id_jenis_pembayaran');
		$query = $this->db->get('atur_pembayaran');
		return $query->result();
	}
	function insert_jenis_pembayaran($data){
		$this->db->insert('jenis_pembayaran',$data);
	}
	function insert_atur_pembayaran($data){
		$this->db->insert('atur_pembayaran',$data);
	}
	function update_jenis_pembayaran($id,$data){
		$this->db->where('id_jenis_pembayaran',$id);
		$this->db->update('jenis_pembayaran',$data);
	}
	function update_atur_pembayaran($id,$data){
		$this->db->where('id_atur_pembayaran',$id);
		$this->db->update('atur_pembayaran',$data);
	}
	function delete_jenis_pembayaran($id){
		$this->db->where('id_jenis_pembayaran',$id);
		$this->db->delete('jenis_pembayaran');
	}
	function delete_atur_pembayaran($id){
		$this->db->where('id_atur_pembayaran',$id);
		$this->db->delete('atur_pembayaran');
	}
	public function detail_jenis_pembayaran($id){
	$this->db->where('id_jenis_pembayaran',$id);
		$query = $this->db->get('jenis_pembayaran');
		return $query->row();
	}
}
