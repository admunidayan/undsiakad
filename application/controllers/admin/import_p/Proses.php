<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proses extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Nusoap_lib');
        $this->load->library('Excel');
        $this->load->library('Resize');
        $this->load->model('admin/Import_m');
    }
    public function mahasiswa_prodi($filid,$mulaidari){
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table = 'mahasiswa_pt';
        $filter = "p.id_sms = '{$filid}'";
        $order ='mulai_smt asc';
        $limit =100;
        $offest = $mulaidari;
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        $pordi_id = $this->Import_m->idprod($filid)->id_prodi;

        $error_count = 0;
        $error = array();
        $sukses = 0;
        foreach ($result['result'] as $kode) {
            if (!empty($kode['fk__jns_keluar'])) {
                $status = $kode['fk__jns_keluar'];
            }else{
                $status = 'Aktif';
            }
            if ($kode['nipd']!='') {
                $check =$this->Import_m->cekdatamhs($kode['nipd'],$pordi_id);
                if ($check==true) {
                  $error_count++;
                  $error[] = $kode['nipd']." - ".$kode['nm_pd']." Sudah Ada";
              } else {
                  $sukses++;
                  $table2 = 'mahasiswa';
                  $filter2 = "p.id_pd = '{$kode['id_pd']}'";
                  $result2 = $proxy->getRecord($token,$table2,$filter2);

                  $datamhs = array(
                    'id_pd'      =>$kode['id_pd'],
                    'npm'      => $kode['nipd'],
                    'nama_mhs'      =>$kode['nm_pd'] ,
                    'tmpt_lahir' => $kode['tmpt_lahir'],
                    'tgl_lhr_mhs'  => $kode['tgl_lahir'],
                    'gender_mhs'         =>$kode['jk'],
                    'id_agama'   => $kode['id_agama'],
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
                    "angkatan" => substr($kode['mulai_smt'],0, -1),
                    "semester_mhs" => ((2017 - substr($kode['mulai_smt'],0, -1))*2)-1,
                    "id_fakultas" => $this->Import_m->getdtprod($filid)->id_fakultas,
                    "id_prodi" => $this->Import_m->getdtprod($filid)->id_prodi,
                    "id_kelas_mhs" => 0,
                    "username" => $kode['nipd'],
                    "pass" =>md5(str_replace(' ', '', $kode['nipd'])),
                    "foto_profil_mhs" =>"avatar.png",
                    );
                  $this->Import_m->insert_mhs_prod($datamhs);

                  $last_id = $this->Import_m->get_last_id()->id_mhs;
                  $data_mhs_pt = array(
                    'nipd' => $kode['nipd'],
                    'kode_jurusan' => $this->Import_m->getdtprod($filid)->kode_prodi,
                    'id_mhs' => $last_id,
                    'id_jns_daftar' => $kode['id_jns_daftar'],
                    'id_jns_keluar' => $kode['id_jns_keluar'],
                    'tgl_masuk_sp' => $kode['tgl_masuk_sp'],
                    'mulai_smt' => $kode['mulai_smt']
                    );
                  $this->Import_m->insert_mhs_pt($data_mhs_pt);
              }
            // asd
          }
      }
  }
}
?>