<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportkls extends CI_Controller {

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
            $check = $this->Export_m->cekkls(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),$post['kode_prodi']);
            if ($check==true) {
              $error_count++;
              $error[] = $val[1]." ".$val[2]." ".$val[3]." ".$val[0]." Sudah Ada";
            } else  {
              $sukses++;
              $kodemk = $this->Export_m->getkodemk(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH));
              $aturmk = $this->Export_m->getaturmk($kodemk->id_matakuliah);
              $data = array(
                'semester' => filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                'kode_jurusan' => $post['kode_prodi'],
                'kode_mk' => filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                'nama_mk' => $kodemk->nama_matakuliah,
                'nama_kelas' => filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                'nama_mk' => $kodemk->nama_matakuliah,
                'sks_mk' => $kodemk->jumlah_sks,
                'sks_tm' => $aturmk->sks_tm,
                'sks_prak' => $aturmk->sks_prak,
                'sks_prak_lap' => $aturmk->sks_prak_lap,
                'sks_sim' => $aturmk->sks_sim,
              );
              $this->Export_m->insert_kls($data);
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
}
?>