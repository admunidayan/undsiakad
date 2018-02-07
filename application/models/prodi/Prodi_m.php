<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prodi_m extends CI_Model
{
	public function allprodi(){
		$this->db->order_by('tgl_berdiri','asc');
		$sdf = $this->db->get('sms');
		return $sdf->result();
	}
	public function detail_prodi($id_prodi){
			$this->db->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenj_didik = sms.id_jenj_didik');
			// $this->db->join('fakultas', 'fakultas.id_fakultas = sms.id_fakultas');
			$this->db->where('kode_prodi', $id_prodi);

			$query = $this->db->get('sms');

		return $query;
	}
	public function list_kurikulum_by_prodi($id){
		$this->db->where('id_prodi', $id);
		$this->db->order_by('id_kurikulum','desc');
		$sdf = $this->db->get('kurikulum');
		return $sdf->result();
	}
	public function get_nama_kur($id){
		$this->db->select('nama_kur');
		$this->db->where('id_kurikulum', $id);
		$sdf = $this->db->get('kurikulum');
		return $sdf->row();
	}
	// public function getmkprodi($id_prodi){

	// 	$this->db->join('matakuliah', 'matakuliah.id_matakuliah = atur_matkul.id_matakuliah');
	// 	$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = atur_matkul.id_jenjang_pend');
	// 	$this->db->join('semester', 'semester.id_semester = atur_matkul.id_semester');
	// 	$this->db->where('atur_matkul.id_prodi', $id_prodi);
	// 	$this->db->order_by('atur_matkul.id_semester', 'asc');
	// 	$sdf = $this->db->get('atur_matkul');
	// 	return $sdf->result();
	// }
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
			$this->db->where('kode_sms', $id_prodi);
		}
		$this->db->from('mahasiswa_pt');
		$rs = $this->db->count_all_results();
		return $rs;
	}
	function update_kur_prodi($id, $data){
		$this->db->where('id_prodi', $id);
		$this->db->update('prodi', $data);
	}
	function insert_mhs_lulus($data){
		$this->db->insert('kelulusan', $data);
	}
	function update_mhs_pt($id, $data){
		$this->db->where('nipd', $id);
		$this->db->update('mhs_pt', $data);
	}
	function get_kodejur($sms){
		$this->db->select('kode_prodi');
		$this->db->where('id_sms', $sms);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	// import
	function insert_mhs_prod($data){
		$this->db->insert('mahasiswa', $data);
	}
	function insert_mhs_pt($data){
		$this->db->insert('mhs_pt', $data);
	}
	public function get_last_id() {
		$this->db->select('id_mhs');
		$this->db->order_by('id_mhs', 'desc');
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function getdtprod($id){
		$this->db->where('id_sms',$id);
		$sdf = $this->db->get('prodi');
		return $sdf->row();
	}
	public function idprod($id){
		$this->db->select('id_prodi');
		$this->db->where('id_sms',$id);
		$sdf = $this->db->get('prodi');
		return $sdf->row();
	}
	public function cekdatamhs($value,$idprodie) {
		$this->db->select('npm');
		$this->db->from('mahasiswa');
		$this->db->where('npm', $value);
		$this->db->where('id_prodi', $idprodie);
		$query = $this->db->get();
		return $query->row();
	}
	public function all_nilai($mulai,$dari){
		$query = $this->db->get('nilai',$mulai,$dari);
		return $query->result();
	}
	function jumlah_nilai(){
		return $this->db->get('nilai')->num_rows();
	}
	public function ceknilai($nipd,$smt,$mk){
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	function jumlah_nilai_sama($nipd,$smt,$mk){
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		return $this->db->get('nilai')->num_rows();
	}
	function ambil_nilai_sama($nipd,$smt,$mk,$jml){
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		$query = $this->db->get('nilai',$jml,1);
		return $query->result();
	}
	function delete_nilai($id){
		$this->db->where('id',$id);
		$this->db->delete('nilai');
	}
	function jumlah_data_mhs($id){
		$this->db->where('kode_sms', $id);
		return $this->db->get('mahasiswa_pt')->num_rows();
	}
	function update_sms($id,$data){
		$this->db->where('id',$id);
		$this->db->update('sms',$data);
	}
}
