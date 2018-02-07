<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportmhskls extends CI_Controller {

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
          if ($val[0]!='') {
            $check = $this->Export_m->cekmhskls(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),$post['id_kls']);
            if ($check==true) {
              $error_count++;
              $error[] = $val[0]." ".$val[1]." Sudah Ada";
            } else  {
              $sukses++;
              $mhs = $this->Export_m->getmhs(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH));
              $mk = $this->Export_m->getmk($post['kode_mk']);
              $data = array(
                'id_tahun_ajaran' => $post['id_smt'],
                'id_semester' => $post['id_smt'],
                'id_mhs' => $mhs->id_mhs,
                'id_matakuliah' => $mk->id_matakuliah,
                'id_kls_fdr' => $post['id_kls_fdr'],
                'id_kls' => $post['id_kls'],
                'nipd' => filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                'kode_mk' => $post['kode_mk'],
                't_ulang' => $post['t_ulang']
              );
              $this->Export_m->insert_mhs_kls($data);
            }
          }
        }
      }
      unlink("asset/upload/mahasiswa/".$_FILES['semester']['name']);
      $msg = '';
      if (($sukses>0) || ($error_count>0)) {
        $msg =  "<div class=\"alert alert-warning bts-ats2 alert-dismissible\" role=\"alert\" >
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
      redirect(base_url('index.php/prodi/kelas/kelasprodi/'.$post['id_prodi']));
  }
  function proses_input_kelas_mhs(){
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
          if ($val[0]!='') {
            if (!empty($this->Export_m->getmhs(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)))) {
              $check = $this->Export_m->cekmhskls(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),$post['id_smt'],$post['id_kls']);
              if ($check==true) {
                $error_count++;
                $error[] = $val[0]." ".$val[1]." Sudah Ada";
              } else  {
                $sukses++;
                if ( substr($post['id_smt'],-1)==1) {
                  $tulang='ganjil';
                }else{
                  $tulang='genap';
                }
                $mhs = $this->Export_m->getmhs(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH));
                $data = array(
                  'id_tahun_ajaran'      => $post['id_smt'],
                  'id_semester'      => $post['id_smt'],
                  'id_mhs'      => $mhs->id_mhs,
                  'id_matakuliah' => $post['id_mk'],
                  'id_kls_fdr' => $post['id_kls_fdr'],
                  'id_kls' => $post['id_kls'],
                  'nipd' => filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                  'kode_mk' => $post['kode_mk'],
                  't_ulang' => $tulang
                  );
                // echo "<pre>";print_r($data);echo "</pre>";exit();
              $this->Export_m->insert_mhs_kls($data);
              }
            }else{
              $error_count++;
              $error[] = $val[0]." ".$val[1]." Mahasiswa ini tidak terdaftar.";
            }
          }
        }
      }
      unlink("asset/upload/mahasiswa/".$_FILES['semester']['name']);
      $msg = '';
      if (($sukses>0) || ($error_count>0)) {
        $msg =  "<div class=\"alert alert-warning bts-ats2 alert-dismissible\" role=\"alert\" >
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
      redirect(base_url('index.php/prodi/kelas/mhskelas/'.$post['id_kls']));
  }
}
?>