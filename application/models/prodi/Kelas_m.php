<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_m extends CI_Model
{
	public function kelas_kuliah_prodi($kode){
			$this->db->order_by('id_smt', 'desc');
			$this->db->where('id_sms', $kode);
			$query = $this->db->get('kelas_kuliah');
		return $query;
	}
	public function getmkprodi($id_prodi){

		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = atur_matkul.id_matakuliah');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = atur_matkul.id_jenjang_pend');
		$this->db->join('semester', 'semester.id_semester = atur_matkul.id_semester');
		$this->db->where('atur_matkul.id_prodi', $id_prodi);
		$this->db->order_by('atur_matkul.id_semester', 'asc');
		$sdf = $this->db->get('atur_matkul');
		return $sdf->result();
	}
	public function get_matkul_not_in_prod($id_prodi){

		$this->db->select('id_matakuliah');
		$this->db->from('atur_matkul');
		$this->db->where_in('id_prodi', $id_prodi);
		$query = $this->db->get();
		$matkul = $query->result();

		$this->db->select('*');
		$this->db->from('matakuliah');
		foreach ($matkul as $data) {
			$this->db->where_not_in('id_matakuliah', $data->id_matakuliah);
		}
		$query = $this->db->get();

		return $query->result();
	}
	public function count_matkul_prod($id_prodi){
		if ($id_prodi>0) {
			$this->db->where('id_prodi', $id_prodi);
		}
		$this->db->from('atur_matkul');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	public function count_mhs_prod($id_prodi){
		if ($id_prodi>0) {
			$this->db->where('id_prodi', $id_prodi);
		}
		$this->db->from('mahasiswa');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	public function detail_kelas($id){
		$this->db->select('mata_kuliah.*,kelas_kuliah.*,kelas_kuliah.id AS id_kelas');
		$this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_kuliah.id_mk_siakad');
		$this->db->where('kelas_kuliah.id', $id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function detail_kelas2($id){
		// $this->db->select('kelas_kuliah.*,atur_dosen.id_kls,atur_dosen.nama_dosen');
		// $this->db->join('atur_dosen', 'atur_dosen.id_kls = kelas_kuliah.id_kls');
		$this->db->where('id_kls', $id);
		$query = $this->db->get('atur_dosen');
		return $query->row();
	}
	public function mahasiwakelas($id){
		$this->db->select('nilai.*,mahasiswa.nm_pd,mahasiswa.id_mhs_pt,nilai.id as idnilai');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs_pt = nilai.id_mhs_pt');
		$this->db->order_by('nipd','asc');
		$this->db->where('id_kls_siakad', $id);
		$query = $this->db->get('nilai');
		return $query;
	}
	function jumlah_kelas_prodi($id,$string,$string2){
		if (!empty($string)) {
			$this->db->like('mata_kuliah.nm_mk',$string);
		}
		if (!empty($string2)) {
			$this->db->where('kelas_kuliah.id_smt',$string2);
		}
		$this->db->where('kelas_kuliah.id_sms',$id);
		$this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_kuliah.id_mk_siakad');
		return $this->db->get('kelas_kuliah')->num_rows();
	}
	function jumlah_kelas_prodi2($id){
		$this->db->where('id_prodi',$id);
		return $this->db->get('atur_dosen')->num_rows();
	}
	public function all_kelas_prodi($limit,$start,$id,$string,$string2){
		$this->db->select('kelas_kuliah.*,mata_kuliah.*,kelas_kuliah.id AS id_kelas');
		if (!empty($string)) {
			$this->db->like('mata_kuliah.nm_mk',$string);
		}
		if (!empty($string2)) {
			$this->db->where('kelas_kuliah.id_smt',$string2);
		}
		$this->db->where('kelas_kuliah.id_sms',$id);
		$this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_kuliah.id_mk_siakad');
		$this->db->order_by('kelas_kuliah.id_smt,kelas_kuliah.id','desc');
		$query = $this->db->get('kelas_kuliah',$limit,$start);
		return $query->result();
	}
	public function all_kelas_prodi2($sampai,$dari,$id){
		$this->db->select('atur_dosen.*,kelas_kuliah.semester,kelas_kuliah.id_kelas_kuliah');
		$this->db->join('kelas_kuliah', 'kelas_kuliah.id_kls = atur_dosen.id_kls');
		$this->db->where('id_prodi',$id);
		$this->db->order_by('kelas_kuliah.semester','desc');
		$query = $this->db->get('atur_dosen',$sampai,$dari);
		return $query->result();
	}
	public function dosenkls($id){
		$this->db->select('ajar_dosen.*,dosen_pt.id,dosen_pt.id_dosen_siakad,dosen.id,dosen.nm_sdm,dosen.nidn,ajar_dosen.id AS id_ajr_dosen');
		$this->db->where('id_kls_siakad',$id);
		$this->db->join('dosen_pt', 'dosen_pt.id = ajar_dosen.id_dosen_pt_siakad');
		$this->db->join('dosen', 'dosen_pt.id_dosen_siakad = dosen.id');
		$query = $this->db->get('ajar_dosen');
		return $query->result();
	}
	public function mk_prod($kur){
		$this->db->where('id_kurikulum_siakad',$kur);
		$this->db->join('mata_kuliah', 'mata_kuliah.id = mata_kuliah_kurikulum.id_mk_siakad');
		$this->db->order_by('mata_kuliah.nm_mk','asc');
		$query = $this->db->get('mata_kuliah_kurikulum');
		return $query->result();
	}
	public function cek_mahasiswa_di_kelas($kls,$idmhs,$smt){
		$this->db->where('id_kls_siakad',$kls);
		$this->db->where('id_mhs_pt',$idmhs);
		$this->db->where('id_smt',$smt);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	function Insert($db,$data){
		$this->db->Insert($db,$data);
	}
	public function cek_ajar_dosen($id){
		$this->db->where('id_ajar',$id);
		$query = $this->db->get('ajar_dosen');
		return $query->row();
	}
	public function cek_mhs_kelas($id,$nipd,$smt,$mk){
		$this->db->select('id,id_kls,nipd,id_smt,kode_mk');
		$this->db->where('id_kls',$id);
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	public function get_id_kur_prod($id){
		$this->db->select('id,nm_kurikulum_sp');
		$this->db->where('id_sms',$id);
		$this->db->order_by('nm_kurikulum_sp','desc');
		$query = $this->db->get('kurikulum');
		return $query->result();
	}
	public function smt(){
		$this->db->select('id_smt');
		$this->db->order_by('id_smt','desc');
		$query = $this->db->get('semester');
		return $query->result();
	}
	public function getkodemk($id){
		$this->db->where('id',$id);
		$query = $this->db->get('mata_kuliah');
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
	function delete_kelas($id){
		$this->db->where('id',$id);
		$this->db->delete('kelas_kuliah');
	}
	// tampildosen
	function tampil_dosen_limit($nama){
		$this->db->select('dosen.nm_sdm,dosen.id,dosen.nidn,dosen_pt.id_dosen_siakad,dosen_pt.id_thn_ajaran,dosen_pt.id_sms,dosen_pt.id AS id_dosen,sms.id_sms,sms.nm_lemb');
		$this->db->join('dosen', 'dosen.id = dosen_pt.id_dosen_siakad');
		$this->db->join('sms', 'sms.id_sms = dosen_pt.id_sms');
		$this->db->like('dosen.nm_sdm',$nama);
		$this->db->limit('8');
		$query = $this->db->get('dosen_pt');
		return $query;
	}
	public function dosen_id($id) {
		$this->db->select('id_dosen,id_thn_ajaran,id_reg_ptk');
		$this->db->from('dosen_pt');
		$this->db->where('id_dosen', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_prodi_by_kel($id) {
		$this->db->select('kelas_kuliah.id,kelas_kuliah.id_kls,kelas_kuliah.id_sms,sms.id_sms,sms.kode_prodi');
		$this->db->join('sms', 'sms.id_sms = kelas_kuliah.id_sms');
		$this->db->where('.kelas_kuliah.id', $id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
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
	public function jumlah_mhs_prodi($id_prodi,$nama,$angkatan){
		$this->db->select('mahasiswa_pt.*,mahasiswa.nm_pd,mahasiswa.id_mhs_pt');
		if (!empty($nama)) {
			$this->db->like('mahasiswa.nm_pd', $nama);
			$this->db->or_like('nipd',$nama);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa_pt.mulai_smt', $angkatan);
		}
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs_pt = mahasiswa_pt.id');
		$this->db->where('kode_sms', $id_prodi);
		$this->db->from('mahasiswa_pt');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	public function get_mahasiswa($limit,$start,$sms,$nama,$angkatan) {
		$this->db->select('mahasiswa_pt.*,mahasiswa.nm_pd,mahasiswa.tmpt_lahir,mahasiswa.tgl_lahir,mahasiswa.id_mhs_pt');
		if (!empty($nama)) {
			$this->db->like('mahasiswa.nm_pd', $nama);
			$this->db->or_like('nipd',$nama);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa_pt.mulai_smt', $angkatan);
		}
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs_pt = mahasiswa_pt.id');
		$this->db->where('kode_sms', $sms);
		$this->db->order_by('mahasiswa_pt.nipd','asc');
		$query = $this->db->get('mahasiswa_pt',$limit,$start);
		return $query->result();
	}
	public function get_detail_khs($id){
		$this->db->select('nilai.*,mahasiswa.nm_pd,mahasiswa.nim');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs_pt = nilai.id_mhs_pt');
		$this->db->where('nilai.id', $id);
		$rs = $this->db->get('nilai');
		return $rs->row();
	}
	public function bobotnilai($id){
		$this->db->where('id_sms', $id);
		$this->db->order_by('nilai_huruf','asc');
		$this->db->group_by('nilai_huruf');
		$rs = $this->db->get('bobot_nilai');
		return $rs->result();
	}
	function get_univ($id){
		$this->db->where('kode_prodi',$id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	function get_dosen($id){
		$this->db->where('id_dosen',$id);
		$query = $this->db->get('dosen');
		return $query->row();
	}
	function id_mk($id){
		$this->db->select('id_matakuliah');
		$this->db->where('kode_matakuliah',$id);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	function get_kelas($id){
		$this->db->where('id_kelas_kuliah',$id);
		$query = $this->db->get('kelas_kuliah');
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
	function insert_ajar_dosen($data){
		$this->db->insert('atur_dosen', $data);
	}
	function delete_dosen_kelas($id){
		$this->db->where('id_atur_dosen',$id);
		$this->db->delete('atur_dosen');
	}
	function edit($tabel,$field,$id,$data){
		$this->db->where($field,$id);
		$this->db->update($tabel,$data);
	}
	function delete($tabel,$field,$id){
		$this->db->where($field,$id);
		$this->db->delete($tabel);
	}
	public function edit_dosen_kelas($id,$data) {
		$this->db->where('id_atur_dosen', $id);
		$this->db->update('atur_dosen',$data);
	}
}
