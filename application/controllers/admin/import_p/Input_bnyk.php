<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_bnyk extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Nusoap_lib');
        $this->load->model('admin/Import_m');
    }
    function mahasiswa($filid,$halaman){
        $dtpilih = $this->input->post('pilih');
        // echo "<pre>";print_r($dtpilih);echo "<pre/>";exit();
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table = 'mahasiswa_pt';
        // $filter = "p.id_sms = '{$filid}'";
        // $order ='mulai_smt asc';
        // $limit =100;
        // $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        $pordi_id = $this->Import_m->idprod($filid)->id_prodi;

        $error_count = 0;
        $error = array();
        $sukses = 0;
        if (!empty($dtpilih)) {
          foreach ($dtpilih as $result['result']) {
            $filter = "p.nipd = '{$result['result']}' and p.id_sms = '{$filid}'";
            $result = $proxy->getRecord($token,$table,$filter);

            if (!empty($result['result']['fk__jns_keluar'])) {
              $status = $result['result']['fk__jns_keluar'];
          }else{
              $status = 'Aktif';
          }

          $check =$this->Import_m->cekdatamhs($result['result']['nipd'],$pordi_id);
          if ($check==true) {
              $error_count++;
              $error[] = $result['result']['nipd']." - ".$result['result']['nm_pd']." Sudah Ada";
          }else{
              $sukses++;
              $table2 = 'mahasiswa';
              $filter2 = "p.id_pd = '{$result['result']['id_pd']}'";
              $result2 = $proxy->getRecord($token,$table2,$filter2);

              $datamhs = array(
                'id_pd'      =>$result['result']['id_pd'],
                'npm'      => $result['result']['nipd'],
                'nama_mhs'      =>$result['result']['nm_pd'] ,
                'tmpt_lahir' => $result['result']['tmpt_lahir'],
                'tgl_lhr_mhs'  => $result['result']['tgl_lahir'],
                'gender_mhs'         =>$result['result']['jk'],
                'id_agama'   => $result['result']['id_agama'],
                'id_kk'      => $result2['result']['id_kk'],
                "alamat_mhs"        => $result2['result']['jln'],
                "rt"         => $result2['result']['rt'],
                "rw"         => $result2['result']['rw'],
                "nm_dsn"     => $result2['result']['nm_dsn'],
                "ds_kel"     => $result2['result']['ds_kel'],
                "id_wil"     => $result2['result']['id_wil'],
                "kodepost_mhs"   => $result2['result']['kode_pos'],
                "id_jns_tinggal"      => $result2['result']['id_jns_tinggal'],
                "telepon_rumah"       => $result2['result']['p.telepon_rumah'],
                "no_hp_mhs"     => $result2['result']['p.telepon_seluler'],
                "email_mhs"               => $result2['result']['email'],
                "a_terima_kps"        => $result2['result']['a_terima_kps'],
                "no_kps"              => $result2['result']['no_kps'],
                "status_mhs" => $status,
                "nama_ot_mhs"         => $result2['result']['nm_ayah'],
                "tgl_lahir_ayah"      => $result2['result']['tgl_lahir_ayah'],
                "id_jenjang_pendidikan_ayah" => $result2['result']['id_jenjang_pendidikan_ayah'],
                "id_pekerjaan_ayah"   => $result2['result']['id_jenjang_pendidikan_ayah'],
                "id_penghasilan_ayah" => $result2['result']['id_penghasilan_ayah'],
                "nm_ibu_kandung"      => $result2['result']['nm_ibu_kandung'],
                "tgl_lahir_ibu"       => $result2['result']['tgl_lahir_ibu'],
                "id_jenjang_pendidikan_ibu" => $result2['result']['id_jenjang_pendidikan_ibu'],
                "id_pekerjaan_ibu"    => $result2['result']['id_pekerjaan_ibu'],
                "id_penghasilan_ibu"  => $result2['result']['id_penghasilan_ibu'],
                "nm_wali"             => $result2['result']['nm_wali'],
                "tgl_lahir_wali"      => $result2['result']['tgl_lahir_wali'],
                "id_jenjang_pendidikan_wali" => $result2['result']['id_jenjang_pendidikan_wali'],
                "id_pekerjaan_wali"   => $result2['result']['id_pekerjaan_wali'],
                "id_penghasilan_wali" => $result2['result']['id_penghasilan_wali'],
                "id_jenjang_pend" =>  $this->Import_m->getdtprod($filid)->id_jenjang_pend,
                "id_tahun_ajaran" => 11,
                "angkatan" => substr($result['result']['mulai_smt'],0, -1),
                "semester_mhs" => ((2017 - substr($result['result']['mulai_smt'],0, -1))*2)-1,
                "id_fakultas" => $this->Import_m->getdtprod($filid)->id_fakultas,
                "id_prodi" => $this->Import_m->getdtprod($filid)->id_prodi,
                "id_kelas_mhs" => 0,
                "username" => $result['result']['nipd'],
                "pass" =>md5(str_replace(' ', '', $result['result']['nipd'])),
                "foto_profil_mhs" =>"avatar.png",
                );
              $this->Import_m->insert_mhs_prod($datamhs);

              $last_id = $this->Import_m->get_last_id()->id_mhs;
              $data_mhs_pt = array(
                'nipd' => $result['result']['nipd'],
                'kode_jurusan' => $this->Import_m->getdtprod($filid)->kode_prodi,
                'id_mhs' => $last_id,
                'id_jns_daftar' => $result['result']['id_jns_daftar'],
                'id_jns_keluar' => $result['result']['id_jns_keluar'],
                'tgl_masuk_sp' => $result['result']['tgl_masuk_sp'],
                'mulai_smt' => $result['result']['mulai_smt']
                );
              $this->Import_m->insert_mhs_pt($data_mhs_pt);
          }
      }
  }else{

      $suksesinfo =  "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\" >
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <font color=\"#3c763d\">".$sukses." - Tidak ada data dibilih . Pilih data terlebih dahulu! </font><br />";
      $suksesinfo .= "</div>
  </div>";

  $this->session->set_flashdata('message', $suksesinfo);
  redirect(base_url('admin/sincdikti_c/getmhsprod'.'/'.$filid));
  exit();
}
$suksesinfo = '';
if (($sukses>0) || ($error_count>0)) {
    $suksesinfo =  "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\" >
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <font color=\"#3c763d\">".$sukses." data Mahasiswa baru berhasil di import</font><br />
    <font color=\"#ce4844\" >".$error_count." data batal ditambahkan </font>";
    if (!$error_count==0) {
      $suksesinfo .= "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
  }
                  //echo "<br />Total: ".$i." baris data";
  $suksesinfo .= "<div class=\"collapse\" id=\"collapseExample\">";
  $i=1;
  foreach ($error as $pesan) {
      $suksesinfo .= "<div class=\"bs-callout bs-callout-danger\">".$i.". ".$pesan."</div>";
      $i++;
  }
  $suksesinfo .= "</div>
</div>";
}
$this->session->set_flashdata('message', $suksesinfo);
redirect(base_url('index.php/admin/import/mhsprodi/'.$filid.'/'.@$halaman));
}
public function kurikulum(){
  $hostname = $this->ion_auth->user()->row()->hostname;
  $port = $this->ion_auth->user()->row()->port;
  $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
  $client = new nusoap_client($url, true);
  $proxy = $client->getProxy();
  $username =$this->ion_auth->user()->row()->userfeeder;
  $pass = $this->ion_auth->user()->row()->passfeeder;
  $token = $proxy->getToken($username, $pass);
  $table = 'kurikulum';
  $filter = "";
  $order ='';
  $offest = 0;
  $limit =100;
  $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
  $error_count = 0;
  $error = array();
  $sukses = 0;

  foreach ($result['result'] as $data) {

    $check =$this->Import_m->cekkur($data['id_kurikulum_sp']);
     // echo "<pre>";print_r($check);echo "<pre/>";exit();
      if ($check ==true) {
        $error_count++;
        $error[] = $data['nm_kurikulum_sp']." - Sudah Ada";
      }else{
        $sukses++;
        $kur = array(
          'id_kurikulum_sp' => $data['id_kurikulum_sp'],
          'id_sms' => $data['id_sms'],
          'id_kurikulum_sp' => $data['id_kurikulum_sp'],
          'id_jenj_didik' => $data['id_jenj_didik'],
          'id_smt' => $data['id_smt'],
          'nm_kurikulum_sp' => $data['nm_kurikulum_sp'],
          'jml_sem_normal' => $data['jml_sem_normal'],
          'jml_sks_wajib' => $data['jml_sks_wajib'],
          'jml_sks_pilihan' => $data['jml_sks_pilihan'],
          'jml_sks_lulus' => $data['jml_sks_lulus']
          );
        
        $this->Import_m->insert_kurikulum($kur);
      }
  }
  $suksesinfo = '';
      if (($sukses>0) || ($error_count>0)) {
        $suksesinfo =  "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\" >
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        <font color=\"#3c763d\">".$sukses." data Mahasiswa baru berhasil di import</font><br />
        <font color=\"#ce4844\" >".$error_count." data batal ditambahkan </font>";
        if (!$error_count==0) {
          $suksesinfo .= "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
        }
                  //echo "<br />Total: ".$i." baris data";
        $suksesinfo .= "<div class=\"collapse\" id=\"collapseExample\">";
        $i=1;
        foreach ($error as $pesan) {
          $suksesinfo .= "<div class=\"bs-callout bs-callout-danger\">".$i.". ".$pesan."</div>";
          $i++;
        }
        $suksesinfo .= "</div>
      </div>";
    }
    $this->session->set_flashdata('message', $suksesinfo);
    redirect(base_url('index.php/admin/import/kurikulum'));
  }
  public function mkkur($mulaidari){
   $hostname = $this->ion_auth->user()->row()->hostname;
   $port = $this->ion_auth->user()->row()->port;
   $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
   $client = new nusoap_client($url, true);
   $proxy = $client->getProxy();
   $username =$this->ion_auth->user()->row()->userfeeder;
   $pass = $this->ion_auth->user()->row()->passfeeder;
   $token = $proxy->getToken($username, $pass);
    $table ='mata_kuliah_kurikulum';
    $table2 = 'mata_kuliah';
    $table3 = 'kurikulum';
    $filter = "";
    $order ='';
    $offest = $mulaidari;
    $limit =100;
    $error_count = 0;
    $error = array();
    $sukses = 0;

    $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // echo "<pre>";print_r($result);echo "<pre/>";exit();
    foreach ($result['result'] as $data) {

      $filter2 = "p.id_mk = '{$data['id_mk']}'";
      $result2 = $proxy->getRecord($token,$table2,$filter2);

      $filter3 = "id_kurikulum_sp = '{$data['id_kurikulum_sp']}'";
      $result3 = $proxy->getRecord($token,$table3,$filter3);

       if ($data['a_wajib']==1) {
          $tipemk = "Wajib";
        }else{
          $tipemk = "Pilihan";
        }

        $sukses++;
        $datamkkur = array(
          'id_mk'      => $data['id_mk'],
          'kode_matakuliah'      => $data['fk__id_mk'],
          'nama_matakuliah'      => $result2['result']['nm_mk'],
          'semester_matakuliah' => $data['smt'],
          'jumlah_sks' => $result2['result']['sks_mk'],
          'tipe_matakuliah'  => $tipemk,
          'ket_matakuliah'         => "MPK-Pengembangan Kepribadian",
          'id_jenjang_pend' => $this->Import_m->getdtprod($result3['result']['id_sms'])->id_jenjang_pend,
          'status_matakuliah' =>"Aktif",
          );
       // echo "<pre>";print_r($datamkkur);echo "<pre/>";exit();

        $this->Import_m->insert_mk($datamkkur);
        // 
        $idmk = $this->Import_m->getidmk()->id_matakuliah;
        if (!empty($this->Import_m->getidkur($data['id_kurikulum_sp'])->id_kurikulum)) {
          $kurid = $this->Import_m->getidkur($data['id_kurikulum_sp'])->id_kurikulum;
        }else{
          $kurid = 0;
        }
        $aturmkprod = array( 
          'id_matakuliah' => $idmk,
          'id_kurikulum_sp' => $data['id_kurikulum_sp'],
          'id_jenjang_pend' => $this->Import_m->getdtprod($result3['result']['id_sms'])->id_jenjang_pend,
          'id_fakultas' => $this->Import_m->getdtprod($result3['result']['id_sms'])->id_fakultas,
          'id_prodi' => $this->Import_m->getdtprod($result3['result']['id_sms'])->id_prodi,
          'id_semester' => $data['smt'],
          'jenis_mk' => 0,
          'mksyarat' => 0,
          'id_kurikulum' => $kurid,
          'tahun' => $result3['result']['id_smt'],
          'jns_mk' => $result2['result']['jns_mk'],
          'sks_tm' => $result2['result']['sks_tm'],
          'sks_prak' => $result2['result']['sks_prak'],
          'sks_prak_lap' => $result2['result']['sks_prak_lap'],
          'sks_sim' => $result2['result']['sks_sim'],
          'a_sap' => $result2['result']['a_sap'],
          's_silabus' => $result2['result']['a_silabus'],
          'a_bahan_ajar' => $result2['result']['a_bahan_ajar'],
          'acara_prakata_dikdat' => $result2['result']['a_diktat']
          );
        // echo "<pre>";print_r($aturmkprod);echo "<pre/>";exit();
        $this->Import_m->insert_atur_mk($aturmkprod);
    }
  }
}
?>