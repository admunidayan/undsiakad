<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Export_adm extends CI_Model {
	public function all_prodi(){
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$query = $this->db->get('prodi');
		return $query->result();
	}
	public function detail_prodi($id_prodi){
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas');
		$this->db->where('id_prodi', $id_prodi);
		$query = $this->db->get();
		return $query->row();
	}
	public function detail_sms($id_prodi){
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$this->db->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas');
		$this->db->where('id_sms', $id_prodi);
		$query = $this->db->get();
		return $query->row();
	}
	public function mahasiswa_prodi($id_prodi){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->where('id_prodi', $id_prodi);
		$query = $this->db->get();
		return $query->result();
	}
	// kurikulum
	public function all_kurikulum(){
		$this->db->select('kurikulum.*,jenjang_pend.nama_jenjang_pend,prodi.nama_prodi');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = kurikulum.id_jenjang_pend');
		$this->db->join('prodi', 'prodi.kode_prodi = kurikulum.kode_jurusan');
		$query = $this->db->get('kurikulum');
		return $query->result();
	}
	// matakuliah kurikulum
	public function all_mk_kur(){
		$this->db->select('atur_matkul.*,kurikulum.nama_kur,matakuliah.nama_matakuliah,matakuliah.kode_matakuliah,matakuliah.jumlah_sks,prodi.kode_prodi,prodi.nama_prodi');
		$this->db->join('kurikulum', 'kurikulum.id_kurikulum = atur_matkul.id_kurikulum');
		$this->db->join('prodi', 'prodi.id_prodi = atur_matkul.id_prodi');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = atur_matkul.id_matakuliah');
		$query = $this->db->get('atur_matkul');
		return $query->result();
	}
	public function all_mk_kur_pagging($sampai,$dari){
		$this->db->select('atur_matkul.*,kurikulum.nama_kur,matakuliah.nama_matakuliah,matakuliah.kode_matakuliah,matakuliah.jumlah_sks,prodi.kode_prodi,prodi.nama_prodi');
		$this->db->join('kurikulum', 'kurikulum.id_kurikulum = atur_matkul.id_kurikulum');
		$this->db->join('prodi', 'prodi.id_prodi = atur_matkul.id_prodi');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = atur_matkul.id_matakuliah');
		$query = $this->db->get('atur_matkul',$sampai,$dari);
		return $query->result();
	}
	function jumlah_data_mk_kur(){
		return $this->db->get('mahasiswa')->num_rows();
	}
	function jumlah_kelas_kuliah(){
		return $this->db->get('kelas_kuliah')->num_rows();
	}
	public function all_kelas_kuliah_pagging($sampai,$dari){
		$this->db->order_by('semester', 'asc');
		$query = $this->db->get('kelas_kuliah',$sampai,$dari);
		return $query->result();
	}
	public function all_nilai_mhs_pagging($sampai,$dari){
		$this->db->select('khs.*,matakuliah.nama_matakuliah,matakuliah.kode_matakuliah,kelas_kuliah.nama_kelas,mahasiswa.npm,mahasiswa.nama_mhs');
		$this->db->join('mahasiswa', 'mahasiswa.id_mhs = khs.id_mhs');
		$this->db->join('kelas_kuliah', 'kelas_kuliah.id_kelas_kuliah = khs.id_kls');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = khs.id_matakuliah');
		$this->db->order_by('id_tahun_ajaran', 'asc');
		$query = $this->db->get('khs',$sampai,$dari);
		return $query->result();
	}
	public function all_nilai_transfer_pagging($sampai,$dari){
		$this->db->select('nilai_transfer.*,matakuliah.nama_matakuliah,matakuliah.kode_matakuliah,kelas_kuliah.nama_kelas,mahasiswa.nama_mhs');
		$this->db->join('mahasiswa', 'mahasiswa.npm = nilai_transfer.nipd');
		$this->db->join('kelas_kuliah', 'kelas_kuliah.id_kelas_kuliah = nilai_transfer.id_kelas_kuliah');
		$this->db->join('matakuliah', 'matakuliah.kode_matakuliah = nilai_transfer.kode_mk');
		$this->db->order_by('id_tahun_ajaran', 'asc');
		$query = $this->db->get('nilai_transfer',$sampai,$dari);
		return $query->result();
	}
	function jumlah_nilai_mhs(){
		return $this->db->get('khs')->num_rows();
	}
	//cek
	public function ceknilaimhs($idkls,$nipd,$smt,$mk,$nilai) {
		$this->db->select('id_khs');
		$this->db->from('khs');
		$this->db->where('id_kls_fdr', $idkls);
		$this->db->where('nipd', $nipd);
		$this->db->where('id_tahun_ajaran', $smt);
		$this->db->where('kode_mk', $mk);
		$this->db->where('nilai_huruf', $nilai);
		$query = $this->db->get();
		return $query->row();
	}
	public function getidmhs($value) {
		$this->db->select('id_mhs');
		$this->db->from('mahasiswa');
		$this->db->where('npm', $value);
		$query = $this->db->get();
		return $query->row();
	}
	function insert_khs($data){
		$this->db->insert('khs', $data);
	}
	// jumlah
	function jumlah_nilai_transfer(){
		return $this->db->get('nilai_transfer')->num_rows();
	}
	// cek nilai transfer
	public function ceknilaitransfer($id) {
		$this->db->select('id_ekuivalensi');
		$this->db->where('id_ekuivalensi', $id);
		$query = $this->db->get('nilai_transfer');
		return $query->row();
	}
	// cek dosen
	public function cekdosen($id) {
		$this->db->select('npp');
		$this->db->where('npp', $id);
		$query = $this->db->get('dosen');
		return $query->row();
	}
	// cek nilai
	public function ceknilai($id) {
		$this->db->select('id_kls_fdr');
		$this->db->where('id_kls_fdr', $id);
		$query = $this->db->get('khs');
		return $query->row();
	}
	// cek dosen PT
	public function cekdosenpt($id,$prodi) {
		$this->db->select('id_sdm');
		$this->db->where('id_reg_ptk', $id);
		$this->db->where('id_sms', $prodi);
		$query = $this->db->get('dosen_pt');
		return $query->row();
	}
	// cek dosen
	public function cekkelasdosen($id) {
		$this->db->select('id_ajar');
		$this->db->where('id_ajar', $id);
		$query = $this->db->get('atur_dosen');
		return $query->row();
	}
	// cek dosen
	public function cekprodi($id) {
		$this->db->select('id_sms');
		$this->db->where('id_sms', $id);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	// cek mahasiswa
	public function cekmhs($id) {
		$this->db->select('id_pd');
		$this->db->where('id_pd', $id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	// cek mahasiswa
	public function cekaktifmhs($id,$nipd) {
		$this->db->select('id_smt');
		$this->db->where('id_smt', $id);
		$this->db->where('nipd', $nipd);
		$query = $this->db->get('aktifitas_mhs');
		return $query->row();
	}
	function insert_aktivitas_mhs($data){
		$this->db->insert('aktifitas_mhs', $data);
	}
	// cek nilai mahasiswa berdasarkan mahasiswanya
	public function cek_nilai_mhs($idkls,$nipd,$smt,$mk) {
		$this->db->select('id_khs');
		$this->db->where('id_kls_fdr', $idkls);
		$this->db->where('nipd', $nipd);
		$this->db->where('id_tahun_ajaran', $smt);
		$this->db->where('kode_mk', $mk);
		$query = $this->db->get('khs');
		return $query->row();
	}
	public function cek_nilai_mhs2($nipd,$smt,$mk) {
		$this->db->select('id_khs');
		$this->db->where('nipd', $nipd);
		$this->db->where('id_tahun_ajaran', $smt);
		$this->db->where('kode_mk', $mk);
		$query = $this->db->get('khs');
		return $query;
	}
	public function getidklskul($id) {
		$this->db->select('id_kelas_kuliah');
		$this->db->from('kelas_kuliah');
		$this->db->where('id_kls', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getidmkby($id) {
		$this->db->select('id_matakuliah');
		$this->db->from('matakuliah');
		$this->db->where('kode_matakuliah', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function detail_mhs($id) {
		$this->db->where('npm', $id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	// agama
	public function get_agama($id) {
		$this->db->where('id_agama', $id);
		$query = $this->db->get('agama');
		return $query;
	}
	// mahasiswa not export to feeder
	// jumlah
	function jumlah_mhs_not_exported($string,$angkatan){
		if (!empty($string)) {
			$this->db->like('nipd',$string);
			$this->db->or_like('nm_pd',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('angkatan',$angkatan);
		}
		$this->db->where('id_pd', NULL);
		return $this->db->get('mahasiswa')->num_rows();
	}
	public function mahasiswa_not_exported($sampai,$dari,$string,$angkatan) {
		$this->db->select('mahasiswa.*,mahasiswa_pt.*,agama.*,jenis_pendaftaran.*, mahasiswa.id AS idmhs');
		if (!empty($string)) {
			$this->db->like('nipd',$string);
			$this->db->or_like('nm_pd',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('angkatan',$angkatan);
		}
		$this->db->where('mahasiswa.id_pd', NULL);
		$this->db->join('mahasiswa_pt', 'mahasiswa_pt.id = mahasiswa.id_mhs_pt');
		$this->db->join('agama', 'agama.id_agama = mahasiswa.id_agama');
		$this->db->join('jenis_pendaftaran', 'jenis_pendaftaran.id_jns_daftar = mahasiswa_pt.id_jns_daftar');
		$query = $this->db->get('mahasiswa',$sampai,$dari);
		return $query->result();
	}
	public function kur_not_exported($sampai,$dari,$string) {
		$this->db->select('kurikulum.*,prodi.nama_prodi,jenjang_pend.nama_jenjang_pend');
		if (!empty($string)) {
			$this->db->like('nama_kur',$string);
		}
		$this->db->where('id_kurikulum_sp', NULL);
		$this->db->join('prodi', 'prodi.id_prodi = kurikulum.id_prodi');
		$this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = kurikulum.id_jenjang_pend');
		$query = $this->db->get('kurikulum',$sampai,$dari);
		return $query->result();
	}
	// get jumlah kurikulum
	function jumlah_kur_not_exported($string){
		if (!empty($string)) {
			$this->db->like('nama_kur',$string);
		}
		$this->db->where('id_kurikulum_sp', NULL);
		return $this->db->get('kurikulum')->num_rows();
	}
	public function get_mhs($kode){
		$this->db->where('id', $kode);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function get_mhs_pt($kode){
		$this->db->where('id', $kode);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	function update_mhs($kode,$data){
		$this->db->where('id', $kode);
		$this->db->update('mahasiswa', $data);
	}
	public function get_id_sms($kode){
		$this->db->select('id_sms');
		$this->db->where('kode_prodi', $kode);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	// kelas not export to feeder
	function jumlah_kelas_not_exported(){
		$this->db->where('id_kls', NULL);
		return $this->db->get('kelas_kuliah')->num_rows();
	}
	public function kelas_not_exported($sampai,$dari) {
		$this->db->where('id_kls', NULL);
		$query = $this->db->get('kelas_kuliah',$sampai,$dari);
		return $query->result();
	}
	public function get_kls($kode){
		$this->db->where('id_kelas_kuliah', $kode);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function get_prodi($kode){
		$this->db->where('kode_prodi', $kode);
		$query = $this->db->get('prodi');
		return $query->row();
	}
	public function get_mk($kode){
		$this->db->where('kode_matakuliah', $kode);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	function update_kls($kode,$data){
		$this->db->where('id_kelas_kuliah', $kode);
		$this->db->update('kelas_kuliah', $data);
	}
	function update_mhs_pt($kode,$data){
		$this->db->where('id', $kode);
		$this->db->update('mahasiswa_pt', $data);
	}
	function delete_mhs($kode){
		$this->db->where('id_mhs', $kode);
		$this->db->delete('mahasiswa');
	}
	function delete_mhs_pt($kode){
		$this->db->where('id_mhs', $kode);
		$this->db->delete('mahasiswa_pt');
	}
}
