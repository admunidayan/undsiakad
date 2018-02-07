<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekap_m extends CI_Model {
	public function get_semester(){
		$this->db->order_by('id_smt', 'desc');
		$query = $this->db->get('semester');
		return $query->result();
	}
	public function order_semester(){
		$this->db->order_by('id_smt', 'desc');
		$query = $this->db->get('semester');
		return $query->row();
	}
	public function get_prodi(){
		$this->db->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenj_didik = sms.id_jenj_didik');
		$this->db->order_by('tgl_berdiri', 'asc');
		$query = $this->db->get('sms');
		return $query->result();
	}
	public function detail_prodi($sms){
		$this->db->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenj_didik = sms.id_jenj_didik');
		$this->db->order_by('tgl_berdiri', 'asc');
		$this->db->where('id_sms',$sms);
		$query = $this->db->get('sms');
		return $query->row();
	}
	function jumlah_mhs($sms,$smt){
		$this->db->select('kuliah_mahasiswa.*,mahasiswa_pt.id_reg_pd,mahasiswa_pt.id_sms');
		$this->db->join('mahasiswa_pt', 'mahasiswa_pt.id_reg_pd = kuliah_mahasiswa.id_reg_pd');
		$this->db->where('id_sms',$sms);
		$this->db->where('id_smt',$smt);
		return $this->db->get('kuliah_mahasiswa')->num_rows();
	}
	function jumlah($sms,$smt,$sts){
		$this->db->select('kuliah_mahasiswa.*,mahasiswa_pt.id_reg_pd,mahasiswa_pt.id_sms');
		$this->db->join('mahasiswa_pt', 'mahasiswa_pt.id_reg_pd = kuliah_mahasiswa.id_reg_pd');
		$this->db->where('id_sms',$sms);
		$this->db->where('id_smt',$smt);
		$this->db->where('id_stat_mhs',$sts);
		return $this->db->get('kuliah_mahasiswa')->num_rows();
	}
	function get_mhs($sms,$smt){
		$this->db->select('kuliah_mahasiswa.*,mahasiswa_pt.id_reg_pd,mahasiswa_pt.id_sms,mahasiswa_pt.nipd,status_mahasiswa.id_stat_mhs,status_mahasiswa.nm_stat_mhs,mahasiswa.id_pd,mahasiswa.nm_pd');
		$this->db->join('mahasiswa_pt', 'mahasiswa_pt.id_reg_pd = kuliah_mahasiswa.id_reg_pd');
		$this->db->join('mahasiswa', 'mahasiswa.id_pd = mahasiswa_pt.id_pd');
		$this->db->join('status_mahasiswa', 'status_mahasiswa.id_stat_mhs = kuliah_mahasiswa.id_stat_mhs');
		$this->db->where('id_sms',$sms);
		$this->db->where('id_smt',$smt);
		$query = $this->db->get('kuliah_mahasiswa');
		return $query->result();
	}
	public function get_nm_mhs($id){
		$this->db->select('mahasiswa.id_pd,mahasiswa.nm_pd');
		$this->db->where('id_pd',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}
	public function all_mhs_pt(){
		$query = $this->db->get('mahasiswa_pt');
		return $query->result();
	}
	function update_mhs_pt($id,$data){
		$this->db->where('id',$id);
		$this->db->update('mahasiswa_pt', $data);
	}
	public function all_data($tb){
		$query = $this->db->get($tb);
		return $query->result();
	}
	public function det_mhs_pt($id){
		$this->db->where('id_pd',$sms);
		$query = $this->db->get('mahasiswa_pt');
		return $query->row();
	}
	function update_data($id,$data,$tb){
		$this->db->where('id',$id);
		$this->db->update($tb, $data);
	}
}
