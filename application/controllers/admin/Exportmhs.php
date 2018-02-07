<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportmhs extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('admin/Export_m');
    $this->load->library('Excel');
  }
  function index(){
    $post = $this->input->post();
    if (!is_dir('asset/upload/mahasiswa')) {
      mkdir('asset/upload/mahasiswa');
    }
    if (!preg_match("/.(xls|xlsx)$/i", $_FILES["semester"]["name"]) ) {

      echo "pastikan file yang anda pilih xls|xlsx";
      exit();

    } else {
      move_uploaded_file($_FILES["semester"]["tmp_name"],'asset/upload/mahasiswa/'.$_FILES['semester']['name']);
      $semester = array("semester"=>$_FILES["semester"]["name"]);

    }
    $objPHPExcel = PHPExcel_IOFactory::load('asset/upload/mahasiswa/'.$_FILES['semester']['name']);
    $data = $objPHPExcel->getActiveSheet()->toArray();
    $error_count = 0;
    $error = array();
    $sukses = 0;
    foreach ($data as $key => $val) {
      if ($key>0) {
        if ($val[1]!='') {
          $check = $this->Export_m->cekdata(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH));
          if ($check==true) {
            $error_count++;
            $error[] = $val[1]." ".$val[2]." Sudah Ada";
          } else {
            $sukses++;
            $idsms = $this->Export_m->get_id_sms(filter_var($val[13], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))->id_sms;
            $data_mhs_pt = array(
              'nipd' => str_replace(' ', '', filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
              'id_sms' => $idsms,
              'kode_sms' => filter_var($val[13], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'tgl_masuk_sp' => filter_var($val[14], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'mulai_smt' => filter_var($val[15], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'id_jns_daftar' => filter_var($val[16], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'id_jalur_masuk' => filter_var($val[17], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'id_pembiayaan' => filter_var($val[18], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
            );
            $this->Export_m->insert_mhs_pt($data_mhs_pt);
            $idmhs = $this->Export_m->get_last_id()->id;
            $data = array(
              'id_mhs_pt' => $idmhs,
              'nim' => str_replace(' ', '', filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
              'nm_pd'      => strtoupper(filter_var($val[2], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
              'jk' => strtoupper(filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
              'tmpt_lahir'  => filter_var($val[4], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'tgl_lahir'  => filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'id_agama'   => filter_var($val[6], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              'nm_ibu_kandung'      => filter_var($val[7], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              "nik"        => filter_var($val[8], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              "kewarganegaraan"         => filter_var($val[9], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
              "jln"         => "tidak diisi",
              "foto_profil_mhs" =>"avatar.png",
              "kode_pos" =>"0.000",
              "nisn" =>"0",
              "ds_kel" =>"-",
              "id_kebutuhan_khusus_ayah" =>"0",
              "id_kebutuhan_khusus_ibu" =>"0",
              "id_kk" =>"0",
              "a_terima_kps" =>"0",
              "id_wil" =>"200312",
            );
            $this->Export_m->insert_mhs($data);
          }
        }
      }
    }
    unlink("asset/upload/mahasiswa/".$_FILES['semester']['name']);
    $msg = '';
    if (($sukses>0) || ($error_count>0)) {
      $msg =  "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\" >
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <font color=\"#3c763d\">".$sukses." data Mahasiswa baru berhasil di import</font><br />
      <font color=\"#ce4844\" >".$error_count." data tidak bisa ditambahkan </font>";
      if (!$error_count==0) {
        $msg .= "<a data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">Detail error</a>";
      }
                  //echo "<br />Total: ".$i." baris data";
      $msg .= "<div class=\"collapse\" id=\"collapseExample\">";
      $i=1;
      foreach ($error as $pesan) {
        $msg .= "<div class=\"bs-callout bs-callout-danger\">".$i.". ".$pesan."</div><br />";
        $i++;
      }
      $msg .= "</div>
      </div>";
    }
    $this->session->set_flashdata('export', $msg);
    redirect(base_url('index.php/prodi/prodi'));
  }
}
?>