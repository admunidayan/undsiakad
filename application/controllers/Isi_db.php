<?php

class Isi_db extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
        $this->load->library('Excel');
        $this->load->library('Resize');
        $this->load->model('Isi_m');
    }

    public function index ()
    {
      $hostname = $this->ion_auth->user()->row()->hostname;
      $port = $this->ion_auth->user()->row()->port;
      $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
      $client = new nusoap_client($url, true);
      $proxy = $client->getProxy();
      $username =$this->ion_auth->user()->row()->userfeeder;
      $pass = $this->ion_auth->user()->row()->passfeeder;
      $token = $proxy->getToken($username, $pass);
      $table = 'agama';
      // load
      $hasil = $proxy->getRecordset($token,$table,$filter,$order);
      echo "<pre>";print_r($hasil);echo "<pre/>";exit();
  }
  public function tes ()
    {
      $hostname = $this->ion_auth->user()->row()->hostname;
      $port = $this->ion_auth->user()->row()->port;
      $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
      $client = new nusoap_client($url, true);
      $proxy = $client->getProxy();
      $username =$this->ion_auth->user()->row()->userfeeder;
      $pass = $this->ion_auth->user()->row()->passfeeder;
      $token = $proxy->getToken($username, $pass);
      $table = 'agama';
      // load
      $hasil = $proxy->getRecordset($token,$table,$filter,$order);
      echo "<pre>";print_r($hasil);echo "<pre/>";exit();
  }
  public function proses_import_nilai($offset=0){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =20;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offset);
        // $selanjutnya = $offset+$limit;
        // echo "<pre>";print_r($selanjutnya);echo "<pre/>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Isi_m->ceknilai($data['id_kls'],$data['id_reg_pd']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['id_reg_pd']." Sudah Ada";
                }else{
                    $sukses++;
                    $datamhs = array(
                        'id_kls'      => $data['id_kls'],
                        'id_reg_pd'      => $data['id_reg_pd'],
                        'nilai_angka'      => $data['nilai_angka'],
                        'nilai_huruf' => $data['nilai_huruf'],
                        'nilai_indeks' => $data['nilai_indeks'],
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('nilai',$datamhs);
                    $selanjutnya = $offset+$limit;
                    redirect(base_url('index.php/Isi_db/proses_import_nilai/'.$selanjutnya));
                }
            }
        }
    }
    public function isi_prodi(){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='sms';
        $limit =50;
        $order = '';
        $filter ="id_sp = '921b9381-abed-4e3e-9ada-4a7554666b34'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offset);
        // $selanjutnya = $offset+$limit;
        // echo "<pre>";print_r($result);echo "<pre/>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Isi_m->ceknilai($data['id_kls'],$data['id_reg_pd']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['id_reg_pd']." Sudah Ada";
                }else{
                    $sukses++;
                    $datamhs = array(
                        'id_sms'      => $data['id_sms'],
                        'nm_lemb'      => $data['nm_lemb'],
                        'smt_mulai'      => $data['smt_mulai'],
                        'kode_prodi' => $data['kode_prodi'],
                        'nm_prodi_english' => $data['nm_prodi_english'],
                        'jln' => $data['jln'],
                        'rt' => $data['rt'],
                        'rw' => $data['rw'],
                        'nm_dsn' => $data['nm_dsn'],
                        'ds_kel' => $data['ds_kel'],
                        'kode_pos' => $data['kode_pos'],
                        'lintang' => $data['lintang'],
                        'bujur' => $data['bujur'],
                        'no_tel' => $data['no_tel'],
                        'no_fax' => $data['no_fax'],
                        'email' => $data['email'],
                        'website' => $data['website'],
                        'singkatan' => $data['singkatan'],
                        'tgl_berdiri' => $data['tgl_berdiri'],
                        'sk_selenggara' => $data['sk_selenggara'],
                        'tgl_sk_selenggara' => $data['tgl_sk_selenggara'],
                        'tmt_sk_selenggara' => $data['tmt_sk_selenggara'],
                        'tst_sk_selenggara' => $data['tst_sk_selenggara'],
                        'kpst_pd' => $data['kpst_pd'],
                        'sks_lulus' => $data['sks_lulus'],
                        'gelar_lulusan' => $data['gelar_lulusan'],
                        'stat_prodi' => $data['stat_prodi'],
                        'polesei_nilai' => $data['polesei_nilai'],
                        'a_kependidikan' => $data['a_kependidikan'],
                        'sistem_ajar' => $data['sistem_ajar'],
                        'luas_lab' => $data['luas_lab'],
                        'kapasitas_prak_satu_shift' => $data['kapasitas_prak_satu_shift'],
                        'jml_mhs_pengguna' => $data['jml_mhs_pengguna'],
                        'jml_jam_penggunaan' => $data['jml_jam_penggunaan'],
                        'jml_prodi_pengguna' => $data['jml_prodi_pengguna'],
                        'jml_modul_prak_sendiri' => $data['jml_modul_prak_sendiri'],
                        'jml_modul_prak_lain' => $data['jml_modul_prak_lain'],
                        'fungsi_selain_prak' => $data['fungsi_selain_prak'],
                        'penggunaan_lab' => $data['penggunaan_lab'],
                        'id_sp' => $data['id_sp'],
                        'id_jenj_didik' => $data['id_jenj_didik'],
                        'id_jns_sms' => $data['id_jns_sms'],
                        'id_fungsi_lab' => $data['id_fungsi_lab'],
                        'id_kel_usaha' => $data['id_kel_usaha'],
                        'id_blob' => $data['id_blob'],
                        'id_wil' => $data['id_wil'],
                        'id_jur' => $data['id_jur'],
                        'id_induk_sms' => $data['id_induk_sms'],
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('sms',$datamhs);
                }
            }
        }
    }
    public function mahasiswa($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mahasiswa';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Isi_m->cekmhs($data['id_pd']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['nm_pd']." Sudah Ada";
                }else{
                    $sukses++;
                    $datamhs = array(
                        'id_pd'      => $data['id_pd'],
                        'nm_pd'      => $data['nm_pd'],
                        'jk'      => $data['jk'],
                        'jln' => $data['jln'],
                        'rt' => $data['rt'],
                        'rw'      => $data['rw'],
                        'nm_dsn'      => $data['nm_dsn'],
                        'ds_kel'      => $data['ds_kel'],
                        'kode_pos' => $data['kode_pos'],
                        'nisn' => $data['nisn'],
                        'nik' => $data['nik'],
                        'tmpt_lahir' => $data['tmpt_lahir'],
                        'tgl_lahir' => $data['tgl_lahir'],
                        'nm_ayah' => $data['nm_ayah'],
                        'tgl_lahir_ayah' => $data['tgl_lahir_ayah'],
                        'nik_ayah' => $data['nik_ayah'],
                        'id_jenjang_pendidikan_ayah' => $data['id_jenjang_pendidikan_ayah'],
                        'id_pekerjaan_ayah' => $data['id_pekerjaan_ayah'],
                        'id_penghasilan_ayah' => $data['id_penghasilan_ayah'],
                        'id_kebutuhan_khusus_ayah' => $data['id_kebutuhan_khusus_ayah'],
                        'nm_ibu_kandung' => $data['nm_ibu_kandung'],
                        'tgl_lahir_ibu' => $data['tgl_lahir_ibu'],
                        'nik_ibu' => $data['nik_ibu'],
                        'id_jenjang_pendidikan_ibu' => $data['id_jenjang_pendidikan_ibu'],
                        'id_pekerjaan_ibu' => $data['id_pekerjaan_ibu'],
                        'id_penghasilan_ibu' => $data['id_penghasilan_ibu'],
                        'id_kebutuhan_khusus_ibu' => $data['id_kebutuhan_khusus_ibu'],
                        'nm_wali' => $data['nm_wali'],
                        'tgl_lahir_wali' => $data['tgl_lahir_wali'],
                        'id_jenjang_pendidikan_wali' => $data['id_jenjang_pendidikan_wali'],
                        'id_pekerjaan_wali' => $data['id_pekerjaan_wali'],
                        'id_penghasilan_wali' => $data['id_penghasilan_wali'],
                        'id_kk' => $data['id_kk'],
                        'no_tel_rmh' => $data['no_tel_rmh'],
                        'no_hp' => $data['no_hp'],
                        'email' => $data['email'],
                        'a_terima_kps' => $data['a_terima_kps'],
                        'no_kps' => $data['no_kps'],
                        'npwp' => $data['npwp'],
                        'id_wil' => $data['id_wil'],
                        'id_jns_tinggal' => $data['id_jns_tinggal'],
                        'id_agama' => $data['id_agama'],
                        'id_alat_transport' => $data['id_alat_transport'],
                        'kewarganegaraan' => $data['kewarganegaraan'],
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa',$datamhs);
                }
            }
        }
    }
    public function impmahasiswa($sms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $limit =500;
        // 
        $table ='mahasiswa_pt';
        $order = "";
        $filter ="p.id_sms = '{$sms}'";
        // 
        $offest =$id;
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $hasil) {
                $tes = $this->Isi_m->detail_data_order('mahasiswa','id_pd',$hasil['id_pd']);
                $kodesms = $this->Isi_m->cekprodi($sms)->kode_prodi;
                // echo "<pre>";print_r($kodesms);echo "</pre>";exit();
                if ($tes == FALSE) {
                    $check = $proxy->getRecord($token,"mahasiswa","id_pd='{$hasil['id_pd']}'");
                    $datam = $check['result'];
                    // echo "<pre>";print_r($check);echo "</pre>";exit();
                    $datamhss = array(
                        'id_pd'      => $hasil['id_pd'],
                        'nm_pd'      => $datam['nm_pd'],
                        'nim'      => $hasil['nipd'],
                        'jk'      => $datam['jk'],
                        'jln' => $datam['jln'],
                        'rt' => $datam['rt'],
                        'rw'      => $datam['rw'],
                        'nm_dsn'      => $datam['nm_dsn'],
                        'ds_kel'      => $datam['ds_kel'],
                        'kode_pos' => $datam['kode_pos'],
                        'nisn' => $datam['nisn'],
                        'nik' => $datam['nik'],
                        'tmpt_lahir' => $datam['tmpt_lahir'],
                        'tgl_lahir' => $datam['tgl_lahir'],
                        'nm_ayah' => $datam['nm_ayah'],
                        'tgl_lahir_ayah' => $datam['tgl_lahir_ayah'],
                        'nik_ayah' => $datam['nik_ayah'],
                        'id_jenjang_pendidikan_ayah' => $datam['id_jenjang_pendidikan_ayah'],
                        'id_pekerjaan_ayah' => $datam['id_pekerjaan_ayah'],
                        'id_penghasilan_ayah' => $datam['id_penghasilan_ayah'],
                        'id_kebutuhan_khusus_ayah' => $datam['id_kebutuhan_khusus_ayah'],
                        'nm_ibu_kandung' => $datam['nm_ibu_kandung'],
                        'tgl_lahir_ibu' => $datam['tgl_lahir_ibu'],
                        'nik_ibu' => $datam['nik_ibu'],
                        'id_jenjang_pendidikan_ibu' => $datam['id_jenjang_pendidikan_ibu'],
                        'id_pekerjaan_ibu' => $datam['id_pekerjaan_ibu'],
                        'id_penghasilan_ibu' => $datam['id_penghasilan_ibu'],
                        'id_kebutuhan_khusus_ibu' => $datam['id_kebutuhan_khusus_ibu'],
                        'nm_wali' => $datam['nm_wali'],
                        'tgl_lahir_wali' => $datam['tgl_lahir_wali'],
                        'id_jenjang_pendidikan_wali' => $datam['id_jenjang_pendidikan_wali'],
                        'id_pekerjaan_wali' => $datam['id_pekerjaan_wali'],
                        'id_penghasilan_wali' => $datam['id_penghasilan_wali'],
                        'id_kk' => $datam['id_kk'],
                        'no_tel_rmh' => $datam['no_tel_rmh'],
                        'no_hp' => $datam['no_hp'],
                        'email' => $datam['email'],
                        'a_terima_kps' => $datam['a_terima_kps'],
                        'no_kps' => $datam['no_kps'],
                        'npwp' => $datam['npwp'],
                        'id_wil' => $datam['id_wil'],
                        'id_jns_tinggal' => $datam['id_jns_tinggal'],
                        'id_agama' => $datam['id_agama'],
                        'id_alat_transport' => $datam['id_alat_transport'],
                        'kewarganegaraan' => $datam['kewarganegaraan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa',$datamhss);
                    // 
                    $datamhs = array(
                        'id_pd'      => $hasil['id_pd'],
                        'id_pd_siakad'      => $this->Isi_m->detail_data_order('mahasiswa','id_pd',$hasil['id_pd'])->id,
                        'id_reg_pd'      => $hasil['id_reg_pd'],
                        'kode_sms' =>$kodesms,
                        'id_sp'      => $hasil['id_sp'],
                        'id_sms' => $hasil['id_sms'],
                        'nipd' => trim($hasil['nipd']),
                        'tgl_masuk_sp'      => $hasil['tgl_masuk_sp'],
                        'tgl_keluar'      => $hasil['tgl_keluar'],
                        'ket'      => $hasil['ket'],
                        'skhun' => $hasil['skhun'],
                        'no_peserta_ujian' => $hasil['no_peserta_ujian'],
                        'no_seri_ijazah' => $hasil['no_seri_ijazah'],
                        'a_pernah_paud' => $hasil['a_pernah_paud'],
                        'a_pernah_tk' => $hasil['a_pernah_tk'],
                        'tgl_create' => $hasil['tgl_create'],
                        'mulai_smt' => $hasil['mulai_smt'],
                        'sks_diakui' => $hasil['sks_diakui'],
                        'jalur_skripsi' => $hasil['jalur_skripsi'],
                        'judul_skripsi' => $hasil['judul_skripsi'],
                        'bln_awal_bimbingan' => $hasil['bln_awal_bimbingan'],
                        'bln_akhir_bimbingan' => $hasil['bln_akhir_bimbingan'],
                        'sk_yudisium' => $hasil['sk_yudisium'],
                        'tgl_sk_yudisium' => $hasil['tgl_sk_yudisium'],
                        'ipk' => $hasil['ipk'],
                        'sert_prof' => $hasil['sert_prof'],
                        'a_pindah_mhs_asing' => $hasil['a_pindah_mhs_asing'],
                        'id_pt_asal' => $hasil['id_pt_asal'],
                        'id_prodi_asal' => $hasil['id_prodi_asal'],
                        'id_jns_daftar' => $hasil['id_jns_daftar'],
                        'id_jns_keluar' => $hasil['id_jns_keluar'],
                        'id_jalur_masuk' => $hasil['id_jalur_masuk'],
                        'id_pembiayaan' => $hasil['id_pembiayaan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa_pt',$datamhs);
                }
                else{
                    $datamhs = array(
                        'id_pd'      => $hasil['id_pd'],
                        'id_pd_siakad'      => $tes->id,
                        'id_reg_pd'      => $hasil['id_reg_pd'],
                        'kode_sms' =>$kodesms,
                        'id_sp'      => $hasil['id_sp'],
                        'id_sms' => $hasil['id_sms'],
                        'nipd' => trim($hasil['nipd']),
                        'tgl_masuk_sp'      => $hasil['tgl_masuk_sp'],
                        'tgl_keluar'      => $hasil['tgl_keluar'],
                        'ket'      => $hasil['ket'],
                        'skhun' => $hasil['skhun'],
                        'no_peserta_ujian' => $hasil['no_peserta_ujian'],
                        'no_seri_ijazah' => $hasil['no_seri_ijazah'],
                        'a_pernah_paud' => $hasil['a_pernah_paud'],
                        'a_pernah_tk' => $hasil['a_pernah_tk'],
                        'tgl_create' => $hasil['tgl_create'],
                        'mulai_smt' => $hasil['mulai_smt'],
                        'sks_diakui' => $hasil['sks_diakui'],
                        'jalur_skripsi' => $hasil['jalur_skripsi'],
                        'judul_skripsi' => $hasil['judul_skripsi'],
                        'bln_awal_bimbingan' => $hasil['bln_awal_bimbingan'],
                        'bln_akhir_bimbingan' => $hasil['bln_akhir_bimbingan'],
                        'sk_yudisium' => $hasil['sk_yudisium'],
                        'tgl_sk_yudisium' => $hasil['tgl_sk_yudisium'],
                        'ipk' => $hasil['ipk'],
                        'sert_prof' => $hasil['sert_prof'],
                        'a_pindah_mhs_asing' => $hasil['a_pindah_mhs_asing'],
                        'id_pt_asal' => $hasil['id_pt_asal'],
                        'id_prodi_asal' => $hasil['id_prodi_asal'],
                        'id_jns_daftar' => $hasil['id_jns_daftar'],
                        'id_jns_keluar' => $hasil['id_jns_keluar'],
                        'id_jalur_masuk' => $hasil['id_jalur_masuk'],
                        'id_pembiayaan' => $hasil['id_pembiayaan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa_pt',$datamhs);
                }
            }
        }
    }
    public function mahasiswa_pt($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mahasiswa_pt';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $hasil) {
                $tes = $this->Isi_m->detail_data_order('mahasiswa','id_pd',$hasil['id_pd']);
                $kodesms = $this->Isi_m->cekprodi($hasil['id_sms'])->kode_prodi;
                // echo "<pre>";print_r($kodesms);echo "</pre>";exit();
                if ($tes == FALSE) {
                    $check = $proxy->getRecord($token,"mahasiswa","id_pd='{$hasil['id_pd']}'");
                    $datam = $check['result'];
                    // echo "<pre>";print_r($check);echo "</pre>";exit();
                    $datamhss = array(
                        'id_pd'      => $hasil['id_pd'],
                        'nm_pd'      => $datam['nm_pd'],
                        'nim'      => $hasil['nipd'],
                        'jk'      => $datam['jk'],
                        'jln' => $datam['jln'],
                        'rt' => $datam['rt'],
                        'rw'      => $datam['rw'],
                        'nm_dsn'      => $datam['nm_dsn'],
                        'ds_kel'      => $datam['ds_kel'],
                        'kode_pos' => $datam['kode_pos'],
                        'nisn' => $datam['nisn'],
                        'nik' => $datam['nik'],
                        'tmpt_lahir' => $datam['tmpt_lahir'],
                        'tgl_lahir' => $datam['tgl_lahir'],
                        'nm_ayah' => $datam['nm_ayah'],
                        'tgl_lahir_ayah' => $datam['tgl_lahir_ayah'],
                        'nik_ayah' => $datam['nik_ayah'],
                        'id_jenjang_pendidikan_ayah' => $datam['id_jenjang_pendidikan_ayah'],
                        'id_pekerjaan_ayah' => $datam['id_pekerjaan_ayah'],
                        'id_penghasilan_ayah' => $datam['id_penghasilan_ayah'],
                        'id_kebutuhan_khusus_ayah' => $datam['id_kebutuhan_khusus_ayah'],
                        'nm_ibu_kandung' => $datam['nm_ibu_kandung'],
                        'tgl_lahir_ibu' => $datam['tgl_lahir_ibu'],
                        'nik_ibu' => $datam['nik_ibu'],
                        'id_jenjang_pendidikan_ibu' => $datam['id_jenjang_pendidikan_ibu'],
                        'id_pekerjaan_ibu' => $datam['id_pekerjaan_ibu'],
                        'id_penghasilan_ibu' => $datam['id_penghasilan_ibu'],
                        'id_kebutuhan_khusus_ibu' => $datam['id_kebutuhan_khusus_ibu'],
                        'nm_wali' => $datam['nm_wali'],
                        'tgl_lahir_wali' => $datam['tgl_lahir_wali'],
                        'id_jenjang_pendidikan_wali' => $datam['id_jenjang_pendidikan_wali'],
                        'id_pekerjaan_wali' => $datam['id_pekerjaan_wali'],
                        'id_penghasilan_wali' => $datam['id_penghasilan_wali'],
                        'id_kk' => $datam['id_kk'],
                        'no_tel_rmh' => $datam['no_tel_rmh'],
                        'no_hp' => $datam['no_hp'],
                        'email' => $datam['email'],
                        'a_terima_kps' => $datam['a_terima_kps'],
                        'no_kps' => $datam['no_kps'],
                        'npwp' => $datam['npwp'],
                        'id_wil' => $datam['id_wil'],
                        'id_jns_tinggal' => $datam['id_jns_tinggal'],
                        'id_agama' => $datam['id_agama'],
                        'id_alat_transport' => $datam['id_alat_transport'],
                        'kewarganegaraan' => $datam['kewarganegaraan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa',$datamhss);
                    // 
                    $datamhs = array(
                        'id_pd'      => $hasil['id_pd'],
                        'id_pd_siakad'      => $this->Isi_m->detail_data_order('mahasiswa','id_pd',$hasil['id_pd'])->id,
                        'id_reg_pd'      => $hasil['id_reg_pd'],
                        'kode_sms' =>$kodesms,
                        'id_sp'      => $hasil['id_sp'],
                        'id_sms' => $hasil['id_sms'],
                        'nipd' => trim($hasil['nipd']),
                        'tgl_masuk_sp'      => $hasil['tgl_masuk_sp'],
                        'tgl_keluar'      => $hasil['tgl_keluar'],
                        'ket'      => $hasil['ket'],
                        'skhun' => $hasil['skhun'],
                        'no_peserta_ujian' => $hasil['no_peserta_ujian'],
                        'no_seri_ijazah' => $hasil['no_seri_ijazah'],
                        'a_pernah_paud' => $hasil['a_pernah_paud'],
                        'a_pernah_tk' => $hasil['a_pernah_tk'],
                        'tgl_create' => $hasil['tgl_create'],
                        'mulai_smt' => $hasil['mulai_smt'],
                        'sks_diakui' => $hasil['sks_diakui'],
                        'jalur_skripsi' => $hasil['jalur_skripsi'],
                        'judul_skripsi' => $hasil['judul_skripsi'],
                        'bln_awal_bimbingan' => $hasil['bln_awal_bimbingan'],
                        'bln_akhir_bimbingan' => $hasil['bln_akhir_bimbingan'],
                        'sk_yudisium' => $hasil['sk_yudisium'],
                        'tgl_sk_yudisium' => $hasil['tgl_sk_yudisium'],
                        'ipk' => $hasil['ipk'],
                        'sert_prof' => $hasil['sert_prof'],
                        'a_pindah_mhs_asing' => $hasil['a_pindah_mhs_asing'],
                        'id_pt_asal' => $hasil['id_pt_asal'],
                        'id_prodi_asal' => $hasil['id_prodi_asal'],
                        'id_jns_daftar' => $hasil['id_jns_daftar'],
                        'id_jns_keluar' => $hasil['id_jns_keluar'],
                        'id_jalur_masuk' => $hasil['id_jalur_masuk'],
                        'id_pembiayaan' => $hasil['id_pembiayaan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa_pt',$datamhs);
                }
                else{
                    $datamhs = array(
                        'id_pd'      => $hasil['id_pd'],
                        'id_pd_siakad'      => $tes->id,
                        'id_reg_pd'      => $hasil['id_reg_pd'],
                        'kode_sms' =>$kodesms,
                        'id_sp'      => $hasil['id_sp'],
                        'id_sms' => $hasil['id_sms'],
                        'nipd' => trim($hasil['nipd']),
                        'tgl_masuk_sp'      => $hasil['tgl_masuk_sp'],
                        'tgl_keluar'      => $hasil['tgl_keluar'],
                        'ket'      => $hasil['ket'],
                        'skhun' => $hasil['skhun'],
                        'no_peserta_ujian' => $hasil['no_peserta_ujian'],
                        'no_seri_ijazah' => $hasil['no_seri_ijazah'],
                        'a_pernah_paud' => $hasil['a_pernah_paud'],
                        'a_pernah_tk' => $hasil['a_pernah_tk'],
                        'tgl_create' => $hasil['tgl_create'],
                        'mulai_smt' => $hasil['mulai_smt'],
                        'sks_diakui' => $hasil['sks_diakui'],
                        'jalur_skripsi' => $hasil['jalur_skripsi'],
                        'judul_skripsi' => $hasil['judul_skripsi'],
                        'bln_awal_bimbingan' => $hasil['bln_awal_bimbingan'],
                        'bln_akhir_bimbingan' => $hasil['bln_akhir_bimbingan'],
                        'sk_yudisium' => $hasil['sk_yudisium'],
                        'tgl_sk_yudisium' => $hasil['tgl_sk_yudisium'],
                        'ipk' => $hasil['ipk'],
                        'sert_prof' => $hasil['sert_prof'],
                        'a_pindah_mhs_asing' => $hasil['a_pindah_mhs_asing'],
                        'id_pt_asal' => $hasil['id_pt_asal'],
                        'id_prodi_asal' => $hasil['id_prodi_asal'],
                        'id_jns_daftar' => $hasil['id_jns_daftar'],
                        'id_jns_keluar' => $hasil['id_jns_keluar'],
                        'id_jalur_masuk' => $hasil['id_jalur_masuk'],
                        'id_pembiayaan' => $hasil['id_pembiayaan'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa_pt',$datamhs);
                }
            }
        }
    }
    public function mahasiswa_by_mahasiswa_pt($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mahasiswa';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $this->Isi_m->mhs_by_mhs_pt($limit,$id);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result)) {
            foreach ($result as $hasil) { 
                $check = $proxy->getRecord($token,$table,"id_pd = '{$hasil->id_pd}'");
                $data = $check['result'];
                // echo "<pre>";print_r($data);echo "</pre>";exit();
                $datamhs = array(
                    'id_mhs_pt' => $hasil->id,
                    'id_pd'      => $data['id_pd'],
                    'nim'      => $hasil->nipd,
                    'nm_pd'      => $data['nm_pd'],
                    'jk'      => $data['jk'],
                    'jln' => $data['jln'],
                    'rt' => $data['rt'],
                    'rw'      => $data['rw'],
                    'nm_dsn'      => $data['nm_dsn'],
                    'ds_kel'      => $data['ds_kel'],
                    'kode_pos' => $data['kode_pos'],
                    'nisn' => $data['nisn'],
                    'nik' => $data['nik'],
                    'tmpt_lahir' => $data['tmpt_lahir'],
                    'tgl_lahir' => $data['tgl_lahir'],
                    'nm_ayah' => $data['nm_ayah'],
                    'tgl_lahir_ayah' => $data['tgl_lahir_ayah'],
                    'nik_ayah' => $data['nik_ayah'],
                    'id_jenjang_pendidikan_ayah' => $data['id_jenjang_pendidikan_ayah'],
                    'id_pekerjaan_ayah' => $data['id_pekerjaan_ayah'],
                    'id_penghasilan_ayah' => $data['id_penghasilan_ayah'],
                    'id_kebutuhan_khusus_ayah' => $data['id_kebutuhan_khusus_ayah'],
                    'nm_ibu_kandung' => $data['nm_ibu_kandung'],
                    'tgl_lahir_ibu' => $data['tgl_lahir_ibu'],
                    'nik_ibu' => $data['nik_ibu'],
                    'id_jenjang_pendidikan_ibu' => $data['id_jenjang_pendidikan_ibu'],
                    'id_pekerjaan_ibu' => $data['id_pekerjaan_ibu'],
                    'id_penghasilan_ibu' => $data['id_penghasilan_ibu'],
                    'id_kebutuhan_khusus_ibu' => $data['id_kebutuhan_khusus_ibu'],
                    'nm_wali' => $data['nm_wali'],
                    'tgl_lahir_wali' => $data['tgl_lahir_wali'],
                    'id_jenjang_pendidikan_wali' => $data['id_jenjang_pendidikan_wali'],
                    'id_pekerjaan_wali' => $data['id_pekerjaan_wali'],
                    'id_penghasilan_wali' => $data['id_penghasilan_wali'],
                    'id_kk' => $data['id_kk'],
                    'no_tel_rmh' => $data['no_tel_rmh'],
                    'no_hp' => $data['no_hp'],
                    'email' => $data['email'],
                    'a_terima_kps' => $data['a_terima_kps'],
                    'no_kps' => $data['no_kps'],
                    'npwp' => $data['npwp'],
                    'id_wil' => $data['id_wil'],
                    'id_jns_tinggal' => $data['id_jns_tinggal'],
                    'id_agama' => $data['id_agama'],
                    'id_alat_transport' => $data['id_alat_transport'],
                    'kewarganegaraan' => $data['kewarganegaraan'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('mahasiswa',$datamhs);
            }
        }
    }
    public function get_nilai_mhs($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $this->Isi_m->mhs_by_mhs_pt($limit,$id);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        foreach ($result as $hasil) {
            $check = $proxy->getRecordset($token,$table,"p.id_reg_pd = '{$hasil->id_reg_pd}'");
            // echo "<pre>";print_r($check);echo "</pre>";exit();
            foreach ($check['result'] as $data) {
                $datamhs = array(
                    'id_mhs_pt' =>trim($hasil->id),
                    'id_kls'      => trim($data['id_kls']),
                    'id_reg_pd'      => trim($hasil->id_reg_pd),
                    'nipd'      => trim($data['nipd']),
                    'id_smt'      => trim($data['id_smt']),
                    'kode_mk'      => trim($data['kode_mk']),
                    'nilai_angka'      => trim($data['nilai_angka']),
                    'nilai_huruf' => trim($data['nilai_huruf']),
                    'nilai_indeks'      => trim($data['nilai_indeks']),
                );
            // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('nilai',$datamhs);
            }   
        }
    }
    public function get_nilai_mhs_by_prodi($sms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =50;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $this->Isi_m->mhs_by_mhs_pt_by_prodi($sms,$limit,$id);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        foreach ($result as $hasil) {
            $check = $proxy->getRecordset($token,$table,"p.id_reg_pd = '{$hasil->id_reg_pd}'");
            // echo "<pre>";print_r($check);echo "</pre>";exit();
            if ($check['result']==TRUE) {
                foreach ($check['result'] as $data) {
                    $datamhs = array(
                        'id_mhs_pt' =>trim($hasil->id),
                        'id_kls'      => trim($data['id_kls']),
                        'id_kls_siakad' =>$this->Isi_m->get_id_kls_siakad($data['id_kls'])->id,
                        'id_reg_pd'      => trim($hasil->id_reg_pd),
                        'nipd'      => trim($data['nipd']),
                        'id_smt'      => trim($data['id_smt']),
                        'kode_mk'      => trim($data['kode_mk']),
                        'nilai_angka'      => trim($data['nilai_angka']),
                        'nilai_huruf' => trim($data['nilai_huruf']),
                        'nilai_indeks'      => trim($data['nilai_indeks']),
                    );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('nilai',$datamhs);
                }   
            }
        }
    }
    public function get_kuliah_mhs_by_mhs_pt($sms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='kuliah_mahasiswa';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $this->Isi_m->mhs_by_mhs_pt_by_prodi($sms,$limit,$id);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        foreach ($result as $hasil) {
            $check = $proxy->getRecordset($token,$table,"p.id_reg_pd = '{$hasil->id_reg_pd}'");
            // echo "<pre>";print_r($check);echo "</pre>";exit();
            if ($check['result']==TRUE) {
                foreach ($check['result'] as $data) {
                    $datamhs = array(
                    'id_smt'      => trim($data['id_smt']),
                    'id_reg_pd'      => trim($data['id_reg_pd']),
                    'id_mhs_pt'      => trim($hasil->id),
                    'id_stat_mhs'      => trim($data['id_stat_mhs']),
                    'ips' => trim($data['ips']),
                    'sks_smt'      => trim($data['sks_smt']),
                    'ipk'      => trim($data['ipk']),
                    'sks_total'      => trim($data['sks_total']),
                );
                   $this->Isi_m->insert('kuliah_mahasiswa',$datamhs);
                }   
            }
        }
    }
    public function mahasiswa_pt_by_prodi($sms,$id){
        // echo "asd";exit();
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mahasiswa_pt';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = "p.id_sms = '{$sms}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) {
                $check = $this->Isi_m->cekmhs($data['id_pd']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['nm_pd']." Sudah Ada";
                }else{
                    $sukses++;
                    $datamhs = array(
                        'id_pd'      => $data['id_pd'],
                        'id_reg_pd'      => $data['id_reg_pd'],
                        'id_sp'      => $data['id_sp'],
                        'id_sms' => $data['id_sms'],
                        'nipd' => trim($data['nipd']),
                        'tgl_masuk_sp'      => $data['tgl_masuk_sp'],
                        'tgl_keluar'      => $data['tgl_keluar'],
                        'ket'      => $data['ket'],
                        'skhun' => $data['skhun'],
                        'no_peserta_ujian' => $data['no_peserta_ujian'],
                        'no_seri_ijazah' => $data['no_seri_ijazah'],
                        'a_pernah_paud' => $data['a_pernah_paud'],
                        'a_pernah_tk' => $data['a_pernah_tk'],
                        'tgl_create' => $data['tgl_create'],
                        'mulai_smt' => $data['mulai_smt'],
                        'sks_diakui' => $data['sks_diakui'],
                        'jalur_skripsi' => $data['jalur_skripsi'],
                        'judul_skripsi' => $data['judul_skripsi'],
                        'bln_awal_bimbingan' => $data['bln_awal_bimbingan'],
                        'bln_akhir_bimbingan' => $data['bln_akhir_bimbingan'],
                        'sk_yudisium' => $data['sk_yudisium'],
                        'tgl_sk_yudisium' => $data['tgl_sk_yudisium'],
                        'ipk' => $data['ipk'],
                        'sert_prof' => $data['sert_prof'],
                        'a_pindah_mhs_asing' => $data['a_pindah_mhs_asing'],
                        'id_pt_asal' => $data['id_pt_asal'],
                        'id_prodi_asal' => $data['id_prodi_asal'],
                        'id_jns_daftar' => $data['id_jns_daftar'],
                        'id_jns_keluar' => $data['id_jns_keluar'],
                        'id_jalur_masuk' => $data['id_jalur_masuk'],
                        'id_pembiayaan' => $data['id_pembiayaan'],
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa_pt',$datamhs);
                    $biomhs = $proxy->GetRecord($token,'mahasiswa',"p.id_pd='".$data['id_pd']."'");
                    $lastid = $this->Isi_m->get_last_id()->id;
                    $datamhs2 = array(
                        'id_mhs_pt'      => $lastid,
                        'id_pd'      => $data['id_pd'],
                        'nm_pd'      => $biomhs['result']['nm_pd'],
                        'jk'      => $biomhs['result']['jk'],
                        'jln' => $biomhs['result']['jln'],
                        'rt' => $biomhs['result']['rt'],
                        'rw'      => $biomhs['result']['rw'],
                        'nm_dsn'      => $biomhs['result']['nm_dsn'],
                        'ds_kel'      => $biomhs['result']['ds_kel'],
                        'kode_pos' => $biomhs['result']['kode_pos'],
                        'nisn' => $biomhs['result']['nisn'],
                        'nik' => $biomhs['result']['nik'],
                        'tmpt_lahir' => $biomhs['result']['tmpt_lahir'],
                        'tgl_lahir' => $biomhs['result']['tgl_lahir'],
                        'nm_ayah' => $biomhs['result']['nm_ayah'],
                        'tgl_lahir_ayah' => $biomhs['result']['tgl_lahir_ayah'],
                        'nik_ayah' => $biomhs['result']['nik_ayah'],
                        'id_jenjang_pendidikan_ayah' => $biomhs['result']['id_jenjang_pendidikan_ayah'],
                        'id_pekerjaan_ayah' => $biomhs['result']['id_pekerjaan_ayah'],
                        'id_penghasilan_ayah' => $biomhs['result']['id_penghasilan_ayah'],
                        'id_kebutuhan_khusus_ayah' => $biomhs['result']['id_kebutuhan_khusus_ayah'],
                        'nm_ibu_kandung' => $biomhs['result']['nm_ibu_kandung'],
                        'tgl_lahir_ibu' => $biomhs['result']['tgl_lahir_ibu'],
                        'nik_ibu' => $biomhs['result']['nik_ibu'],
                        'id_jenjang_pendidikan_ibu' => $biomhs['result']['id_jenjang_pendidikan_ibu'],
                        'id_pekerjaan_ibu' => $biomhs['result']['id_pekerjaan_ibu'],
                        'id_penghasilan_ibu' => $biomhs['result']['id_penghasilan_ibu'],
                        'id_kebutuhan_khusus_ibu' => $biomhs['result']['id_kebutuhan_khusus_ibu'],
                        'nm_wali' => $biomhs['result']['nm_wali'],
                        'tgl_lahir_wali' => $biomhs['result']['tgl_lahir_wali'],
                        'id_jenjang_pendidikan_wali' => $biomhs['result']['id_jenjang_pendidikan_wali'],
                        'id_pekerjaan_wali' => $biomhs['result']['id_pekerjaan_wali'],
                        'id_penghasilan_wali' => $biomhs['result']['id_penghasilan_wali'],
                        'id_kk' => $biomhs['result']['id_kk'],
                        'no_tel_rmh' => $biomhs['result']['no_tel_rmh'],
                        'no_hp' => $biomhs['result']['no_hp'],
                        'email' => $biomhs['result']['email'],
                        'a_terima_kps' => $biomhs['result']['a_terima_kps'],
                        'no_kps' => $biomhs['result']['no_kps'],
                        'npwp' => $biomhs['result']['npwp'],
                        'id_wil' => $biomhs['result']['id_wil'],
                        'id_jns_tinggal' => $biomhs['result']['id_jns_tinggal'],
                        'id_agama' => $biomhs['result']['id_agama'],
                        'id_alat_transport' => $biomhs['result']['id_alat_transport'],
                        'kewarganegaraan' => $biomhs['result']['kewarganegaraan'],
                        );
                    // echo "<pre>";print_r($datamhs2);echo "</pre>";exit();
                    $this->Isi_m->insert('mahasiswa',$datamhs2);
                }
                $pesan =$sukses.' Data Berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/import/mhsbyprodi/'.$sms));
            }
        }
    }
    public function kurikulum(){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table ='kurikulum';
        $order = "";
        $filter ="";
        $filter2 = "";
        $offest ='';
        $limit = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        foreach ($result['result'] as $data) {
            $datamhs = array(
                'id_kurikulum_sp'      => $data['id_kurikulum_sp'],
                'id_sms'      => $data['id_sms'],
                'id_jenj_didik' => $data['id_jenj_didik'],
                'id_smt' => $data['id_smt'],
                'nm_kurikulum_sp'      => $data['nm_kurikulum_sp'],
                'jml_sem_normal'      => $data['jml_sem_normal'],
                'jml_sks_lulus'      => $data['jml_sks_lulus'],
                'jml_sks_wajib' => $data['jml_sks_wajib'],
                'jml_sks_pilihan' => $data['jml_sks_pilihan'],
            );
                // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
            $this->Isi_m->insert('kurikulum',$datamhs);  
       }
       $pesan =$sukses.' Data Berhasil ditambahkan';
       $this->session->set_flashdata('message', $pesan );
       redirect(base_url('index.php/admin/import/kurikulum'));
    }
    public function mata_kuliah_kurikulum(){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mata_kuliah_kurikulum';
        $limit =500;
        $offest ='';
        $order = '';
        $filter = '';
        $result = $this->Isi_m->get_data_tabel('kurikulum');
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result)) {
            foreach ($result as $hasil) { 
                $check = $proxy->getRecordset($token,$table,"p.id_kurikulum_sp = '{$hasil->id_kurikulum_sp}'");
                // echo "<pre>";print_r($check);echo "</pre>";
                foreach ($check['result'] as $data) {
                    $sukses++;
                    $datamhs = array(
                        'id_kurikulum_siakad'      => $this->Isi_m->detail_get('kurikulum','id_kurikulum_sp',$data['id_kurikulum_sp'])->id,
                        'id_kurikulum_sp'      => $data['id_kurikulum_sp'],
                        'id_mk_siakad'      => $this->Isi_m->detail_get('mata_kuliah','id_mk',$data['id_mk'])->id,
                        'id_mk'      => $data['id_mk'],
                        'smt'      => $data['smt'],
                        'sks_mk' => $data['sks_mk'],
                        'sks_tm' => $data['sks_tm'],
                        'sks_prak'      => $data['sks_prak'],
                        'sks_prak_lap'      => $data['sks_prak_lap'],
                        'sks_sim'      => $data['sks_sim'],
                        'a_wajib' => $data['a_wajib'],
                    );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Isi_m->insert('mata_kuliah_kurikulum',$datamhs);
                }
            }
        }
    }
    public function mata_kuliah_kurikulum_prodi($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mata_kuliah_kurikulum';
        $limit ='';
        $offest ='';
        $order = '';
        $filter = "p.id_kurikulum_sp = '{$id}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $sukses++;
                $datamhs = array(
                    'id_kurikulum_sp'      => $data['id_kurikulum_sp'],
                    'id_mk'      => $data['id_mk'],
                    'smt'      => $data['smt'],
                    'sks_mk' => $data['sks_mk'],
                    'sks_tm' => $data['sks_tm'],
                    'sks_prak'      => $data['sks_prak'],
                    'sks_prak_lap'      => $data['sks_prak_lap'],
                    'sks_sim'      => $data['sks_sim'],
                    'a_wajib' => $data['a_wajib'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('mata_kuliah_kurikulum',$datamhs);
            }
            $pesan =$sukses.' Data Berhasil ditambahkan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/import/matakuliah_kurikulum_prodi/'.$id));
        }
    }
    public function mata_kuliah($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mata_kuliah';
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                // $check = $this->Isi_m->cekmk($data['id_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                $sukses++;
                $datamhs = array(
                    'id_mk'      => trim($data['id_mk']),
                    'id_sms'      => $data['id_sms'],
                    'id_jenj_didik'      => $data['id_jenj_didik'],
                    'kode_mk' => $data['kode_mk'],
                    'nm_mk' => $data['nm_mk'],
                    'jns_mk'      => $data['jns_mk'],
                    'kel_mk'      => $data['kel_mk'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm' => $data['sks_tm'],
                    'sks_prak' => $data['sks_prak'],
                    'sks_prak_lap' => $data['sks_prak_lap'],
                    'sks_sim' => $data['sks_sim'],
                    'metode_pelaksanaan_kuliah' => $data['metode_pelaksanaan_kuliah'],
                    'a_sap' => $data['a_sap'],
                    'a_silabus' => $data['a_silabus'],
                    'a_bahan_ajar' => $data['a_bahan_ajar'],
                    'acara_prak' => $data['acara_prak'],
                    'a_diktat' => $data['a_diktat'],
                    'tgl_mulai_efektif' => $data['tgl_mulai_efektif'],
                );
                // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('mata_kuliah',$datamhs);
            }
        }
    }
    public function mata_kuliah_sms($idsms){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='mata_kuliah';
        $limit ='';
        $offest ='';
        $order = '';
        $filter = "p.id_sms = '{$idsms}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                // $check = $this->Isi_m->cekmk($data['id_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                $sukses++;
                $datamhs = array(
                    'id_mk'      => $data['id_mk'],
                    'id_sms'      => $data['id_sms'],
                    'id_jenj_didik'      => $data['id_jenj_didik'],
                    'kode_mk' => $data['kode_mk'],
                    'nm_mk' => $data['nm_mk'],
                    'jns_mk'      => $data['jns_mk'],
                    'kel_mk'      => $data['kel_mk'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm' => $data['sks_tm'],
                    'sks_prak' => $data['sks_prak'],
                    'sks_prak_lap' => $data['sks_prak_lap'],
                    'sks_sim' => $data['sks_sim'],
                    'metode_pelaksanaan_kuliah' => $data['metode_pelaksanaan_kuliah'],
                    'a_sap' => $data['a_sap'],
                    'a_silabus' => $data['a_silabus'],
                    'a_bahan_ajar' => $data['a_bahan_ajar'],
                    'acara_prak' => $data['acara_prak'],
                    'a_diktat' => $data['a_diktat'],
                    'tgl_mulai_efektif' => $data['tgl_mulai_efektif'],
                );
                // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('mata_kuliah',$datamhs);
            }
            $pesan =$sukses.' Data Berhasil ditambahkan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/import/mata_kuliah/'.$idsms));
        }
    }
    public function kelas_kuliah($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='kelas_kuliah';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Isi_m->cekklskul($data['id_kls']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check == FALSE) {
                    $datamhs = array(
                    'id_kls'      => $data['id_kls'],
                    'id_sms'      => $data['id_sms'],
                    'id_smt'      => $data['id_smt'],
                    'nm_kls' => $data['nm_kls'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm'      => $data['sks_tm'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm' => $data['sks_tm'],
                    'sks_prak' => $data['sks_prak'],
                    'sks_prak_lap' => $data['sks_prak_lap'],
                    'sks_sim' => $data['sks_sim'],
                    'bahasan_case' => $data['bahasan_case'],
                    'a_selenggara_pditt' => $data['a_selenggara_pditt'],
                    'a_pengguna_pditt' => $data['a_pengguna_pditt'],
                    'kuota_pditt' => $data['kuota_pditt'],
                    'tgl_mulai_koas' => $data['tgl_mulai_koas'],
                    'tgl_selesai_koas' => $data['tgl_selesai_koas'],
                    'id_mou' => $data['id_mou'],
                    'id_mk' => $data['id_mk'],
                    'id_kls_pditt' => $data['id_kls_pditt'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('kelas_kuliah',$datamhs);
                }
            }
        }
    }
    public function kelas_kuliah_prodi($idsms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='kelas_kuliah';
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = "p.id_sms = '{$idsms}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $datamhs = array(
                    'id_kls'      => $data['id_kls'],
                    'id_sms'      => $data['id_sms'],
                    'id_smt'      => $data['id_smt'],
                    'nm_kls' => $data['nm_kls'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm'      => $data['sks_tm'],
                    'sks_mk'      => $data['sks_mk'],
                    'sks_tm' => $data['sks_tm'],
                    'sks_prak' => $data['sks_prak'],
                    'sks_prak_lap' => $data['sks_prak_lap'],
                    'sks_sim' => $data['sks_sim'],
                    'bahasan_case' => $data['bahasan_case'],
                    'a_selenggara_pditt' => $data['a_selenggara_pditt'],
                    'a_pengguna_pditt' => $data['a_pengguna_pditt'],
                    'kuota_pditt' => $data['kuota_pditt'],
                    'tgl_mulai_koas' => $data['tgl_mulai_koas'],
                    'tgl_selesai_koas' => $data['tgl_selesai_koas'],
                    'id_mou' => $data['id_mou'],
                    'id_mk_siakad' => $this->Isi_m->detail_get('mata_kuliah','id_mk',$data['id_mk'])->id,
                    'id_mk' => $data['id_mk'],
                    'id_kls_pditt' => $data['id_kls_pditt'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('kelas_kuliah',$datamhs);
            }
        }
    }
    public function nilai_by_kelas_kuliah($idsms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='kelas_kuliah';
        $limit ='50';
        $offest =$id;
        $order = '';
        $filter = "p.id_sms = '{$idsms}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $mhs) {
                $filt = "p.id_kls = '{$mhs['id_kls']}'";
                $nilai = $proxy->getRecordset($token,'nilai',$filt);
            // echo "<pre>";print_r($nilai);echo "</pre>";exit();
                foreach ($nilai['result'] as $data) {
                   $datamhs = array(
                    'id_kls'      => trim($data['id_kls']),
                    'id_reg_pd'      => trim($data['id_reg_pd']),
                    'nipd'      => trim($data['nipd']),
                    'id_smt'      => trim($data['id_smt']),
                    'kode_mk'      => trim($data['kode_mk']),
                    'nilai_angka'      => trim($data['nilai_angka']),
                    'nilai_huruf' => trim($data['nilai_huruf']),
                    'nilai_indeks'      => trim($data['nilai_indeks']),
                );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                   $this->Isi_m->insert('nilai',$datamhs);   
               }
           }
       }
    }
    public function nilai_by_kelas($idkls){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit ='';
        $offest ='';
        $order = '';
        $filter = "p.id_kls = '{$idkls}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($nilai['result'] as $data) {
             $datamhs = array(
                'id_kls'      => trim($data['id_kls']),
                'id_reg_pd'      => trim($data['id_reg_pd']),
                'nipd'      => trim($data['nipd']),
                'id_smt'      => trim($data['id_smt']),
                'kode_mk'      => trim($data['kode_mk']),
                'nilai_angka'      => trim($data['nilai_angka']),
                'nilai_huruf' => trim($data['nilai_huruf']),
                'nilai_indeks'      => trim($data['nilai_indeks']),
            );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
            $this->Isi_m->insert('nilai',$datamhs);   
         }
         $pesan =$sukses.' Data Berhasil ditambahkan';
         $this->session->set_flashdata('message', $pesan );
         redirect(base_url('index.php/admin/import/kurikulum'));
       }
    }
    public function dosen($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='dosen';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Isi_m->cekdosen($data['id_sdm']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check == FALSE) {
                    $datamhs = array(
                    'id_sdm'      => $data['id_sdm'],
                    'nm_sdm'      => $data['nm_sdm'],
                    'jk'      => $data['jk'],
                    'tmpt_lahir' => $data['tmpt_lahir'],
                    'tgl_lahir'      => $data['tgl_lahir'],
                    'nm_ibu_kandung'      => $data['nm_ibu_kandung'],
                    'stat_kawin'      => $data['stat_kawin'],
                    'nik' => $data['nik'],
                    'nip' => $data['nip'],
                    'niy_nigk' => $data['niy_nigk'],
                    'nuptk' => $data['nuptk'],
                    'nidn' => $data['nidn'],
                    'nsdmi' => $data['nsdmi'],
                    'jln' => $data['jln'],
                    'rt' => $data['rt'],
                    'rw' => $data['rw'],
                    'nm_dsn' => $data['nm_dsn'],
                    'ds_kel' => $data['ds_kel'],
                    'kode_pos' => $data['kode_pos'],
                    'no_tel_rmh' => $data['no_tel_rmh'],
                    'no_hp' => $data['no_hp'],
                    'email' => $data['email'],
                    'tmt_pns' => $data['tmt_pns'],
                    'nm_suami_istri' => $data['nm_suami_istri'],
                    'nip_suami_istri' => $data['nip_suami_istri'],
                    'sk_cpns' => $data['sk_cpns'],
                    'tgl_sk_cpns' => $data['tgl_sk_cpns'],
                    'sk_angkat' => $data['sk_angkat'],
                    'tmt_sk_angkat' => $data['tmt_sk_angkat'],
                    'npwp' => $data['npwp'],
                    'nm_wp' => $data['nm_wp'],
                    'stat_data' => $data['stat_data'],
                    'a_lisensi_kepsek' => $data['a_lisensi_kepsek'],
                    'a_braille' => $data['a_braille'],
                    'a_bhs_isyarat' => $data['a_bhs_isyarat'],
                    'jml_sekolah_binaan' => $data['jml_sekolah_binaan'],
                    'a_diklat_awas' => $data['a_diklat_awas'],
                    'akta_ijin_ajar' => $data['akta_ijin_ajar'],
                    'nira' => $data['nira'],
                    'kewarganegaraan' => $data['kewarganegaraan'],
                    'id_jns_sdm' => $data['id_jns_sdm'],
                    'id_wil' => $data['id_wil'],
                    'id_stat_aktif' => $data['id_stat_aktif'],
                    'id_blob' => $data['id_blob'],
                    'id_agama' => $data['id_agama'],
                    'id_keahlian_lab' => $data['id_keahlian_lab'],
                    'id_pekerjaan_suami_istri' => $data['id_pekerjaan_suami_istri'],
                    'id_sumber_gaji' => $data['id_sumber_gaji'],
                    'id_lemb_angkat' => $data['id_lemb_angkat'],
                    'id_pangkat_gol' => $data['id_pangkat_gol'],
                    'mampu_handle_kk' => $data['mampu_handle_kk'],
                    'id_bid_pengawas' => $data['id_bid_pengawas'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('dosen',$datamhs);
                }
            }
        }
    }
    public function dosen_pt($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='dosen_pt';
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                // $check = $this->Isi_m->cekdosenpt($data['id_reg_ptk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                    $datamhs = array(
                    'id_reg_ptk'      => $data['id_reg_ptk'],
                    'no_srt_tgs '      => $data['no_srt_tgs '],
                    'tgl_srt_tgs'      => $data['tgl_srt_tgs'],
                    'tmt_srt_tgs' => $data['tmt_srt_tgs'],
                    'tgl_ptk_keluar'      => $data['tgl_ptk_keluar'],
                    'id_dosen_siakad' => $this->Isi_m->detail_get('dosen','id_sdm',$data['id_sdm'])->id,
                    'tgl_create'      => $data['tgl_create'],
                    'id_stat_pegawai' => $data['id_stat_pegawai'],
                    'id_sdm' => $data['id_sdm'],
                    'id_thn_ajaran' => $data['id_thn_ajaran'],
                    'id_sp' => $data['id_sp'],
                    'id_jns_keluar' => $data['id_jns_keluar'],
                    'id_ikatan_kerja' => $data['id_ikatan_kerja'],
                    'id_sms' => $data['id_sms'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('dosen_pt',$datamhs);
                
            }
        }
    }
    public function ajar_dosen($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='ajar_dosen';
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                // $check = $this->Isi_m->cekdosenpt($data['id_reg_ptk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                    $datamhs = array(
                    'id_ajar'      => $data['id_ajar'],
                    'id_subst'      => $data['id_subst'],
                    'id_jns_eval'      => $data['id_jns_eval'],
                    'id_dosen_pt_siakad'      => $this->Isi_m->detail_get('dosen_pt','id_reg_ptk',$data['id_reg_ptk'])->id,
                    'id_reg_ptk' => $data['id_reg_ptk'],
                    'id_kls'      => $data['id_kls'],
                    'id_kls_siakad'      => $this->Isi_m->detail_get('kelas_kuliah','id_kls',$data['id_kls'])->id,
                    'sks_subst_tot'      => $data['sks_subst_tot'],
                    'sks_tm_subst' => $data['sks_tm_subst'],
                    'sks_prak_subst' => $data['sks_prak_subst'],
                    'sks_prak_lap_subst' => $data['sks_prak_lap_subst'],
                    'sks_sim_subst' => $data['sks_sim_subst'],
                    'jml_tm_renc' => $data['jml_tm_renc'],
                    'jml_tm_real' => $data['jml_tm_real'],
                );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('ajar_dosen',$datamhs);   
            }
        }
    }
    public function nilai($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $cek = $this->Isi_m->ceknilai(trim($data['nipd']),trim($data['id_smt']),trim($data['kode_mk']));
                if ($cek !== TRUE) {
                   $datamhs = array(
                    'id_kls'      => trim($data['id_kls']),
                    'id_reg_pd'      => trim($data['id_reg_pd']),
                    'nipd'      => trim($data['nipd']),
                    'id_smt'      => trim($data['id_smt']),
                    'kode_mk'      => trim($data['kode_mk']),
                    'nilai_angka'      => trim($data['nilai_angka']),
                    'nilai_huruf' => trim($data['nilai_huruf']),
                    'nilai_indeks'      => trim($data['nilai_indeks']),
                );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                   $this->Isi_m->insert('nilai',$datamhs);   
                }
            }
        }
    }
    public function nilai_mahasiswa($sms,$id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table ='mahasiswa_pt';
        $order = "";
        $filter ="p.id_sms = '{$sms}'";
        $filter2 = "";
        $offest =$id;
        $limit = 50;
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        
        foreach ($result['result'] as $mhs) {
            $filt = "p.id_reg_pd = '{$mhs['id_reg_pd']}'";
            $nilai = $proxy->getRecordset($token,'nilai',$filt);
            // echo "<pre>";print_r($nilai);echo "</pre>";exit();
            foreach ($nilai['result'] as $data) {
             $datamhs = array(
                'id_kls'      => trim($data['id_kls']),
                'id_reg_pd'      => trim($data['id_reg_pd']),
                'nipd'      => trim($data['nipd']),
                'id_smt'      => trim($data['id_smt']),
                'kode_mk'      => trim($data['kode_mk']),
                'nilai_angka'      => trim($data['nilai_angka']),
                'nilai_huruf' => trim($data['nilai_huruf']),
                'nilai_indeks'      => trim($data['nilai_indeks']),
            );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
             $this->Isi_m->insert('nilai',$datamhs);   
         }
        }
    }
     public function nilai_by_smt($smt,$id){
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter ="id_smt='{$smt}'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $datamhs = array(
                    'id_kls'      => $data['id_kls'],
                    'id_reg_pd'      => $data['id_reg_pd'],
                    'nilai_angka'      => $data['nilai_angka'],
                    'nilai_huruf' => $data['nilai_huruf'],
                    'nilai_indeks'      => $data['nilai_indeks'],
                );
                        // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Isi_m->insert('nilai',$datamhs);
            }
        }
    }
    public function kuliah_mahasiswa($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='kuliah_mahasiswa';
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $this->Isi_m->mhs_by_mhs_pt($limit,$id);
        // echo "<pre>";print_r($result);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        foreach ($result as $hasil) {
            $check = $proxy->getRecordset($token,$table,"p.id_reg_pd = '{$hasil->id_reg_pd}'");
            // echo "<pre>";print_r($check);echo "</pre>";exit();
            foreach ($check['result'] as $data) {
                 $datamhs = array(
                    'id_smt'      => trim($data['id_smt']),
                    'id_reg_pd'      => trim($data['id_reg_pd']),
                    'id_mhs_pt'      => trim($hasil->id),
                    'id_stat_mhs'      => trim($data['id_stat_mhs']),
                    'ips' => trim($data['ips']),
                    'sks_smt'      => trim($data['sks_smt']),
                    'ipk'      => trim($data['ipk']),
                    'sks_total'      => trim($data['sks_total']),
                );
                   $this->Isi_m->insert('kuliah_mahasiswa',$datamhs);
            }   
        }
    }
    public function nilai_transfer($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai_transfer';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) {
                $check = $this->Isi_m->ceknilait($data['id_ekuivalensi']);
                if ($check !== TRUE) {
                    $datamhs = array(
                        'id_ekuivalensi'      => trim($data['id_ekuivalensi']),
                        'id_reg_pd'      => trim($data['id_reg_pd']),
                        'nipd'      => trim($data['nipd']),
                        'id_mk'      => trim($data['id_mk']),
                        'kode_mk_asal' => trim($data['kode_mk_asal']),
                        'nm_mk_asal'      => trim($data['nm_mk_asal']),
                        'sks_asal'      => trim($data['sks_asal']),
                        'sks_diakui'      => trim($data['sks_diakui']),
                        'nilai_huruf_asal'      => trim($data['nilai_huruf_asal']),
                        'nilai_huruf_diakui'      => trim($data['nilai_huruf_diakui']),
                        'nilai_angka_diakui'      => trim($data['nilai_angka_diakui']),
                    );
                    $this->Isi_m->insert('nilai_transfer',$datamhs);
                } 
            }
        }
    }
    public function wilayah($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='wilayah';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
             $datamhs = array(
                'id_wil'      => $data['id_wil'],
                'id_negara'      => $data['id_negara'],
                'nm_wil'      => $data['nm_wil'],
                'asal_wil' => $data['asal_wil'],
                'kode_bps'      => $data['kode_bps'],
                'kode_dagri'      => $data['kode_dagri'],
                'kode_keu'      => $data['kode_keu'],
                'id_induk_wilayah'      => $data['id_induk_wilayah'],
                'id_level_wil'      => $data['id_level_wil'],
            );
             $this->Isi_m->insert('wilayah',$datamhs); 
            }
        }
    }
    public function isi_tbl_kosong(){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='wilayah';
        $limit ='20';
        $offest ='';
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        echo "<pre>";print_r($result);echo "<pre/>";
    // perulangan
        
    }
    public function isi_nilai_tbl_kosong(){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='wilayah';
        $limit ='';
        $offest ='';
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
             $datamhs = array(
                'id_tkt_prestasi'      => $data['id_tkt_prestasi'],
                'nm_tkt_prestasi'      => $data['nm_tkt_prestasi'],
            );
             $this->Isi_m->insert($table,$datamhs); 
            }
        }
        echo "data berhasil di upload";
    }
}
?>