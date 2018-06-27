<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mahasiswa_m extends CI_Model {
	public function getmhsprodbyangkatan($sampai,$dari,$id,$angkatan){
		$this->db->where('id_prodi', $id);
		$this->db->where('angkatan', $angkatan);
		$query = $this->db->get('mahasiswa',$sampai,$dari);
		return $query->result();
	}
	public function get_prodi($id){
		$this->db->where('id_sms',$id);
		$sdf = $this->db->get('sms');
		return $sdf->row();
	}
	function jumlah_data_mhs($id,$string,$angkatan){
		$this->db->select('mahasiswa.nm_pd,mahasiswa.tgl_lahir,mahasiswa.tmpt_lahir,mahasiswa_pt.*');
		$this->db->join('mahasiswa', 'mahasiswa.id_pd = mahasiswa_pt.id_pd');
		if (!empty($string)) {
			$this->db->like('nipd',$string);
			$this->db->or_like('nm_pd',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mulai_smt',$angkatan);
		}
		$this->db->where('kode_sms', $id);
		return $this->db->get('mahasiswa_pt')->num_rows();
	}
	function jumlah_data_mhs_by_ang($id,$ang){
		$this->db->where('id_sms', $id);
		if (!empty($ang)) {
			$this->db->where('mulai_smt',$angkatan);
		}
		return $this->db->get('mahasiswa_pt')->num_rows();
	}
	public function jenjangpendby($id){
		$this->db->select('nm_jenj_didik');
		$this->db->where('id_jenj_didik', $id);
		$query = $this->db->get('jenjang_pendidikan');
		return $query->row();
	}
	public function detail_mahasiswa($id_mhs){
		$this->db->select('mahasiswa.*,mahasiswa_pt.*,sms.nm_lemb,sms.kode_prodi,sms.id_jenj_didik,sms.id_sms,mahasiswa_pt.id AS idmhs');
		$this->db->join('mahasiswa', 'mahasiswa.id = mahasiswa_pt.id_pd_siakad');
		$this->db->join('sms', 'sms.kode_prodi = mahasiswa_pt.kode_sms');
		$this->db->where('mahasiswa_pt.nipd', $id_mhs);
		$query = $this->db->get('mahasiswa_pt');
		return $query;
	}
	public function get_stat($id){
		$this->db->select('mahasiswa_pt.id,mahasiswa_pt.id_jns_keluar');
		$this->db->where('id', $id);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function detail_mahasiswa2($id_mhs){
		$this->db->where('id_pd', $id_mhs);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function jnstgl($id){
		if ($id == NULL) {
			$this->db->where('id_jns_tinggal', 1);
		}else{
			$this->db->where('id_jns_tinggal', $id);
		}
		$query = $this->db->get('jenis_tinggal');
		return $query->row();
	}
	public function jnsdftr($id){
		if ($id == NULL || $id == 0 ) {
			$this->db->where('id_jns_daftar', 1);
		}else{
			$this->db->where('id_jns_daftar', $id);
		}
		$query = $this->db->get('jenis_pendaftaran');
		return $query->row();
	}
	public function nmagama($id){
		if ($id == NULL || $id == 0 ) {
			$this->db->where('id_agama', 99);
		}else{
			$this->db->where('id_agama', $id);
		}
		$query = $this->db->get('agama');
		return $query->row();
	}
	public function listjnstgl(){
		$query = $this->db->get('jenis_tinggal');
		return $query->result();
	}
	public function agama(){
		$query = $this->db->get('agama');
		return $query->result();
	}
	public function get_khs_mhs($id_mhs){

		$this->db->select('kelas_kuliah.*,nilai.*');
		$this->db->join('kelas_kuliah', 'kelas_kuliah.id_kls = nilai.id_kls');
		$this->db->where('nilai.id_reg_pd',$id_mhs);
		$this->db->order_by('nilai.id', 'desc');
		$sdf = $this->db->get('nilai');
		return $sdf->result();
	}
	public function get_khs_mhs2($id_mhs){

		// $this->db->join('kelas_kuliah', 'kelas_kuliah.id_kls = nilai.id_kls');
		// $this->db->join('mata_kuliah', 'mata_kuliah.kode_mk = nilai.kode_mk');
		$this->db->where('nilai.id_mhs_pt',$id_mhs);
		$this->db->group_by(array("nipd", "id_smt","kode_mk")); 
		$this->db->order_by('nilai.id_smt', 'asc');
		$sdf = $this->db->get('nilai');
		return $sdf->result();
	}
	public function get_khs_mhs3(){
		$this->db->select('kode_mk, COUNT(user_id) as total');
		$this->db->group_by('user_id'); 
		$this->db->order_by('total', 'desc'); 
		$this->db->get('tablename', 10);
	}
	public function get_mk($id_mk){
		$this->db->where('kode_mk', $id_mk);
		$query = $this->db->get('mata_kuliah');
		return $query->row();
	}
	public function get_kls($id){
		$this->db->where('id_kls', $id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	public function get_detail_khs($id){
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = khs.id_matakuliah');
		$this->db->where('id_khs', $id);
		$rs = $this->db->get('khs');
		return $rs->row();
	}
	public function get_matkul_all_khs($id_mhs){
		$this->db->where('nipd', $id_mhs);
		$query = $this->db->get('nilai');
		return $query->result();
	}
	public function get_matkul_not_in_khs($id_mhs, $id_prodi){

		$this->db->select('kode_mk');
		$this->db->from('nilai');
		$this->db->where_in('id_mhs_pt', $id_mhs);
		$query = $this->db->get();
		$matkul = $query->result();

		$this->db->select('*');
		$this->db->from('mata_kuliah_kurikulum');
		$this->db->join('kurikulum', 'kurikulum.id = mata_kuliah_kurikulum.id_kurikulum_siakad');
		// $this->db->where('atur_matkul.id_fakultas', $id_fakultas);
		$this->db->where('mata_kuliah_kurikulum.id_sms', $id_prodi);
		foreach ($matkul as $data) {
			$this->db->where_not_in('mata_kuliah_kurikulum.id_mk_siakad', $data->kode_mk);
		}
		$this->db->order_by('mata_kuliah_kurikulum.smt', 'asc');
		$query = $this->db->get();

		return $query->result();
	}
	public function count_khs_wajib($id_mhs){
		if ($id_mhs>0) {
			$this->db->where('id_mhs', $id_mhs);
		}
		$this->db->select('SUM(jumlah_sks) as total');
		$this->db->from('khs');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = khs.id_matakuliah');
		$this->db->where('tipe_matakuliah', 'Wajib');
		return $this->db->get()->row()->total;
	}
	public function count_khs_pilihan($id_mhs){
		if ($id_mhs>0) {
			$this->db->where('id_mhs', $id_mhs);
		}
		$this->db->select('SUM(jumlah_sks) as total');
		$this->db->from('khs');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = khs.id_matakuliah');
		$this->db->where('tipe_matakuliah', 'Pilihan');
		return $this->db->get()->row()->total;
	}
	// pencarian
	public function carimhs($id,$cari){
		$this->db->where('id_prodi', $id);
		$this->db->where('nama_mhs', $cari);
		$this->db->or_where('npm', $cari);
		$query = $this->db->get('mahasiswa');
		return $query->result();
	}
	public function lookup($id,$keyword){

		$this->db->select('*')->from('mahasiswa');
		$this->db->where('id_prodi', $id);
		$this->db->like('nama_mhs',$keyword,'after');
		$query = $this->db->get();
		 return $query->result();
	}
	public function getmahasiswaprodi($sampai,$dari,$id){
		$this->db->where('id_prodi', $id);
		$query = $this->db->get('mahasiswa',$sampai,$dari);
		return $query->result();
	}
	public function searcing_data($sampai,$dari,$id,$string,$angkatan){
		$this->db->select('mahasiswa.nm_pd,mahasiswa.tgl_lahir,mahasiswa.tmpt_lahir,mahasiswa_pt.*');
		$this->db->join('mahasiswa', 'mahasiswa.id_pd = mahasiswa_pt.id_pd');
		if (!empty($string)) {
			$this->db->like('nipd',$string);
			$this->db->or_like('nm_pd',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mulai_smt',$angkatan);
		}
		$this->db->where('kode_sms',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get('mahasiswa_pt',$sampai,$dari);
		return $query->result();
	}
	public function searcing_data2($sampai,$dari,$id,$string,$angkatan){
		$this->db->select('mahasiswa.id_pd,mahasiswa.nm_pd,mahasiswa.id,mahasiswa.tgl_lahir,mahasiswa.tmpt_lahir,mahasiswa_pt.*,mahasiswa.id_pd AS idpd');
		$this->db->join('mahasiswa', 'mahasiswa.id = mahasiswa_pt.id_pd_siakad');
		if (!empty($string)) {
			$this->db->like('nipd',$string);
			$this->db->or_like('nm_pd',$string);
		}
		if (!empty($angkatan)) {
			$this->db->where('mahasiswa_pt.mulai_smt',$angkatan);
		}
		$this->db->where('kode_sms',$id);
		$this->db->order_by('mulai_smt','desc');
		$query = $this->db->get('mahasiswa_pt',$sampai,$dari);
		return $query->result();
	}
	public function get_mhs_by_prodi($sms){
		$this->db->select('id_pd,kode_sms,id_mhs');
		$this->db->where('kode_sms',$sms);
		$query = $this->db->get('mahasiswa_pt');
		return $query->result();
	}
	public function id_mhs_get($id){
		$this->db->where('id_pd',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	// aktivitas mahasiswa
	public function get_aktivitas_mhs($nipd){
		$this->db->select('kuliah_mahasiswa.*,status_mahasiswa.id_stat_mhs,status_mahasiswa.nm_stat_mhs');
		$this->db->where('kuliah_mahasiswa.id_mhs_pt',$nipd);
		$this->db->join('status_mahasiswa', 'status_mahasiswa.id_stat_mhs = kuliah_mahasiswa.id_stat_mhs');
		$this->db->order_by('kuliah_mahasiswa.id_smt','asc');
		$query = $this->db->get('kuliah_mahasiswa');
		return $query->result();
	}
	// get kelas
	public function get_kelas($id){
		$this->db->select('nama_kelas');
		$this->db->where('id_kelas_kuliah',$id);
		$query = $this->db->get('kelas_kuliah');
		return $query->row();
	}
	// get mhs pt
	public function get_mhs_pt($id){
		$this->db->where('id_pd',$id);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	public function detail_mahasiswa_npm($npm){
		$this->db->where('nipd',$npm);
		$this->db->join('mahasiswa', 'mahasiswa.id = mahasiswa_pt.id_pd_siakad');
		$query = $this->db->get('mahasiswa_pt');
		return $query;
	}
	public function get_nilai_trans_mhs($npm){
		$this->db->where('nipd',$npm);
		// $this->db->order_by('id_nilai_transfer','desc');
		$query = $this->db->get('nilai_transfer');
		return $query->result();
	}
	public function get_mkb($id){
		// $this->db->select('nm_mk,id_mk_siakad');
		$this->db->where('mata_kuliah.id',$id);
		$query = $this->db->get('mata_kuliah');
		return $query->row();
	}
	// search
	function tampil_dosen_limit($nama){
		$this->db->like('nama_matakuliah',$nama);
		$this->db->limit('8');
		$query = $this->db->get('matakuliah');
		return $query;
	}
	function sksakui($id){
		$this->db->select('jumlah_sks');
		$this->db->where('id_mk',$id);
		$query = $this->db->get('matakuliah');
		return $query->row();
	}
	function insert_nilai_transfer($data){
		$this->db->insert('nilai_transfer',$data);
	}
	//edit nilai trannsfer
	function data_nilai_transfer($id){
		$this->db->where('id_nilai_transfer',$id);
		$this->db->join('matakuliah', 'matakuliah.id_mk = nilai_transfer.id_mk');
		$query = $this->db->get('nilai_transfer');
		return $query->row();
	}
	function update_nilai_transfer($id,$data){
		$this->db->where('id_nilai_transfer',$id);
		$this->db->update('nilai_transfer',$data);
	}
	function Update_mahasiswa($id,$data){
		$this->db->where('id',$id);
		$this->db->update('mahasiswa',$data);
	}
	function Update_mahasiswa_pt($id,$data){
		$this->db->where('id_pd',$id);
		$this->db->update('mahasiswa_pt',$data);
	}
	function delete_nilai_transfer($id){
		$this->db->where('id_nilai_transfer',$id);
		$this->db->delete('nilai_transfer');
	}
	function semester(){
		$this->db->order_by('id_smt','desc');
		$query = $this->db->get('semester');
		return $query->result();
	}
	function stat_mhs(){
		$query = $this->db->get('status_mahasiswa');
		return $query->result();
	}
	function get_stat_mhs($id){
		$this->db->where('id_stat_mhs',$id);
		$query = $this->db->get('status_mahasiswa');
		return $query->row();
	}
	function pt_mhs($id){
		$this->db->where('id_',$id);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	function insert_aktifitas($data){
		$this->db->insert('aktifitas_mhs',$data);
	}
}
