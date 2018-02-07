<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import_m extends CI_Model {
	public function all_prodi(){
		// $this->db->join('jenjang_pend', 'jenjang_pend.id_jenjang_pend = prodi.id_jenjang_pend');
		$query = $this->db->get('sms');
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
	public function get_sms($id_prodi){
		$this->db->where('id_sms', $id_prodi);
		$query = $this->db->get('sms');
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
	public function getmkbykodemk($id){
		$this->db->where('kode_matakuliah', $id);
		$query = $this->db->get('matakuliah');
		return $query->row();
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
		return $this->db->get('nilai')->num_rows();
	}
	function jumlah_mata_kuliah(){
		return $this->db->get('matakuliah')->num_rows();
	}
	//cek
	public function cekkelaskuliah($idkls) {
		$this->db->select('id_kls');
		$this->db->where('id_kls', $idkls);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function ceknilaimhs($idkls,$nipd,$smt,$mk) {
		$this->db->select('id_khs');
		$this->db->from('khs');
		$this->db->where('id_kls_fdr', $idkls);
		$this->db->where('nipd', $nipd);
		$this->db->where('id_tahun_ajaran', $smt);
		$this->db->where('kode_mk', $mk);
		// $this->db->where('nilai_huruf', $nilai);
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
	function insert_kelas_kuliah($data){
		$this->db->insert('kelas_kuliah', $data);
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
	public function ceknilai2($nipd,$smt,$mk){
		$this->db->where('nipd',$nipd);
		$this->db->where('id_smt',$smt);
		$this->db->where('kode_mk',$mk);
		$query = $this->db->get('nilai');
		return $query->row();
	}
	public function getidklskul($id) {
		$this->db->select('id_kelas_kuliah,id_kls');
		$this->db->from('kelas_kuliah');
		$this->db->where('id_kls', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getnm_mk($id){
		$this->db->select('nm_mk');
		$this->db->where('kode_mk',$id);
		$query = $this->db->get('mata_kuliah');
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
	public function get_mk($id) {
		$this->db->where('kode_mk', $id);
		$query = $this->db->get('mata_kuliah');
		return $query->row();
	}
	// Nilai Trnasfer
	public function ceknilaitrans($id) {
		$this->db->where('id_ekuivalensi', $id);
		$query = $this->db->get('nilai_transfer');
		return $query->row();
	}
	function insert_nilai_transfer($data){
		$this->db->insert('nilai_transfer', $data);
	}
	// ambil kode jurusan dari id_kls ajar_dosen feeder
	public function get_jur_id($id) {
		$this->db->select('kode_jurusan');
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
	// ambil id_dosen dari id_sdm dosen_pt
	public function dosen_id($id) {
		$this->db->select('id_dosen,id_thn_ajaran');
		$this->db->from('dosen_pt');
		$this->db->where('id_reg_ptk', $id);
		$query = $this->db->get();
		return $query->row();
	}
	// ambil kode jurusan dari id_sms dosen_pt
	public function get_jurusan($id) {
		$this->db->select('kode_prodi');
		$this->db->from('prodi');
		$this->db->where('id_sms', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_id_dosen($id) {
		$this->db->select('id_dosen');
		$this->db->from('dosen');
		$this->db->where('id_sdm', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function insert_dosen_pt($data){
		$this->db->insert('dosen_pt', $data);
	}
	// ambil kode_mk dari kelas_kuliah
	public function get_kode_mk($id) {
		$this->db->select('kode_mk');
		$this->db->from('kelas_kuliah');
		$this->db->where('id_kls', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function insert_ajar_dosen($data){
		$this->db->insert('atur_dosen', $data);
	}
	public function prodidefault($id){
		$this->db->where('id_prodi', $id);
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
	// kurikulum
	public function cekkur($value) {
		$this->db->select('id_kurikulum_sp');
		$this->db->from('kurikulum');
		$this->db->where('id_kurikulum_sp', $value);
		$query = $this->db->get();
		return $query->row();
	}
	public function getidkur($value) {
		$this->db->select('id_kurikulum');
		$this->db->from('kurikulum');
		$this->db->where('id_kurikulum_sp', $value);
		$query = $this->db->get();
		return $query->row();
	}
	function insert_kurikulum($data){
		$this->db->insert('kurikulum', $data);
	}
	public function get_jp($value) {
		$this->db->select('nama_jenjang_pend');
		$this->db->from('jenjang_pend');
		$this->db->where('id_jenjang_pend', $value);
		$query = $this->db->get();
		return $query->row();
	}
	// matakuliah kurikulum
	function insert_mk($data){
		$this->db->insert('matakuliah', $data);
	}
	public function getidmk() {
		$this->db->select('id_matakuliah');
		$this->db->from('matakuliah');
		$this->db->order_by('id_matakuliah', 'desc');
		$query = $this->db->get();
		return $query->row();
	}
	function insert_atur_mk($data){
		$this->db->insert('atur_matkul', $data);
	}
	public function cekmk($idmk) {
		$this->db->select('id_matakuliah');
		$this->db->where('id_mk', $idmk);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	public function cekmkkur($idmk,$kur) {
		$this->db->select('id_matakuliah,id_kurikulum_sp');
		$this->db->where('id_matakuliah', $idmk);
		$this->db->where('id_kurikulum_sp', $kur);
		$query = $this->db->get('atur_matkul');
		return $query->row();
	}
}
