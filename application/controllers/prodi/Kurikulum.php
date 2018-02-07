<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('fakultas/Fakultas_m');
        $this->load->model('prodi/Prodi_m');
        $this->load->model('prodi/Kurikulum_m');
        $this->load->library('Excel');
    }
    function index()
    {
        $level= 'prodi';
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Daftar Program Studi';
                $data['page'] = 'admin/karyawan/karyawan-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtuser'] = $this->ion_auth->user()->row();
                $data['alluser'] = $this->ion_auth->users()->result();
                $this->load->view('admin/dashboard-v', $data);
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function kurprodi($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Daftar Kurikulum Berdasarkan Prodi';
                $data['page'] = 'prodi/list-kurikulum-prod-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['getprod'] = $this->Kurikulum_m->detail_prodi($id)->row();
                $data['hasil'] = $this->Kurikulum_m->kur_by_pord($data['getprod']->id_sms);
                // echo "<pre>";print_r($data['hasil']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete_kurikulum($prodi,$id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->Kurikulum_m->delete_kur($id);
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/Kurikulum/kurprodi/'.$prodi));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete_mk_kurikulum($prodi,$kur,$id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->Kurikulum_m->delete_mkkur($id);
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/Kurikulum/mkbyprod/'.$prodi.'/'.$kur));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_add_kurikulum(){
    $post = $this->input->post();

    $data = array(
      'id_prodi'       => $post['id_prodi'],
      'nama_kur'       => strtoupper($post['nama_kur']),
      'mulai_berlaku'       => $post['mulai_berlaku'],
      'id_jenjang_pend'       => $post['id_jenjang_pend'],
      'jml_sem_normal'  => 8,
      'kode_jurusan'  => $post['kode_jurusan'],
      'jml_sks_wajib'     => $post['jml_sks_wajib'],
      'jml_sks_pilihan' => $post['jml_sks_pilihan'],
      'total_sks' => $post['jml_sks_pilihan']+$post['jml_sks_wajib'],
    );

    $this->Kurikulum_m->insert_kur($data);
    $this->session->set_flashdata('message', 'Kurikurum '.$post['nama_kur'].' Berhasil ditambahkan');
    redirect(base_url('index.php/prodi/Kurikulum/kurprodi/'.$post['id_prodi']));
  }
    public function mkbyprod($prodi,$idkur){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Data Matakuliah Kurikulum';
                $data['page'] = 'prodi/detail-matkul-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // $data['dtamhs'] = $this->Kurikulum_m->mk_by_pord($idj,$idf,$idp,$idkur);
                // $data['dtamhsprod'] = $this->Kurikulum_m->mhsbyprod($idp);
                $data['getprod'] = $this->Prodi_m->detail_prodi($prodi)->row();
                $data['detail'] = $this->Kurikulum_m->detail_data('kurikulum','id',$idkur);
                $data['dtkur'] = $this->Kurikulum_m->mk_by_pord($idkur);
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_edit_kurikulum(){
    $post = $this->input->post();
    $id = $this->input->post('id_kurikulum');
    $data = array(
      'id_prodi'       => $post['id_prodi'],
      'nama_kur'       => strtoupper($post['nama_kur']),
      'mulai_berlaku'       => $post['mulai_berlaku'],
      'kode_jurusan'  => $post['kode_jurusan'],
      'jml_sks_wajib'     => $post['jml_sks_wajib'],
      'jml_sks_pilihan' => $post['jml_sks_pilihan'],
      'total_sks' => $post['jml_sks_pilihan']+$post['jml_sks_wajib'],
    );
    $this->Kurikulum_m->update_kur($id,$data);
    $this->session->set_flashdata('edit', 'KURIKULUM '.$post['nama_kur'].' BERHASIL DIUBAH');
    redirect(base_url('index.php/prodi/kurikulum/mkbyprod/'.$post['id_jenjang_pend'].'/'.$post['id_fakultas'].'/'.$post['id_prodi'].'/'.$post['id_kurikulum']));
  }
    public function proses_import_mk_kur(){
        $post = $this->input->post();

        if (!is_dir('asset/upload/matakuliah')) {
            mkdir('asset/upload/matakuliah');
        }
        if (!preg_match("/.(xls|xlsx)$/i", $_FILES["semester"]["name"]) ) {
            echo "pastikan file yang anda pilih xls|xlsx";
            exit();
        } else {
            move_uploaded_file($_FILES["semester"]["tmp_name"],'asset/upload/matakuliah/'.$_FILES['semester']['name']);
            $semester = array("semester"=>$_FILES["semester"]["name"]);
        }
        $objPHPExcel = PHPExcel_IOFactory::load('asset/upload/matakuliah/'.$_FILES['semester']['name']);
        $data = $objPHPExcel->getActiveSheet()->toArray();
        $error_count = 0;
        $error = array();
        $sukses = 0;
        foreach ($data as $key => $val) {
            if ($key>0) {
              if ($val[0]!='') {
                $check = $this->Kurikulum_m->cekdatamk(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH));
                if ($check==true) {
                  $error_count++;
                  $error[] = $val[0]." ".$val[1]." Sudah Ada";
                  $idmk = $this->Kurikulum_m->dtmk(filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))->id_matakuliah;
                  $aturmkprod = array(
                    'id_matakuliah' => $idmk,
                    'id_jenjang_pend' => $post['id_jenjang_pend'],
                    'id_fakultas' =>$post['id_fakultas'],
                    'id_prodi' => $post['id_prodi'],
                    'id_semester' => filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'jenis_mk' => 0,
                    'mksyarat' => 0,
                    'id_kurikulum' => $post['id_kurikulum'],
                    'tahun' => $post['tahun'],
                    'jns_mk' => filter_var($val[6], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_tm' => filter_var($val[7], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_prak' => filter_var($val[8], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_prak_lap' => filter_var($val[9], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_sim' => filter_var($val[10], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'a_sap' => filter_var($val[11], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    's_silabus' => filter_var($val[12], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'a_bahan_ajar' => filter_var($val[13], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'acara_prakata_dikdat' => filter_var($val[14], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)
                    );
                  // echo "<pre>";print_r($aturmkprod);echo "</pre>";exit();
                  $this->Kurikulum_m->insert_aturmk($aturmkprod);
              } else {
                  $sukses++;
                  $data = array(
                    'kode_matakuliah'      => filter_var($val[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'nama_matakuliah'      => ucwords(strtolower(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                    'semester_matakuliah' => filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'jumlah_sks' => filter_var($val[2], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'tipe_matakuliah'  => filter_var($val[4], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'ket_matakuliah'         => filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'id_jenjang_pend' =>$post['id_jenjang_pend'],
                    'status_matakuliah' =>"Aktif",
                    );
                  $this->Kurikulum_m->insert_mk_prod($data);
                    //atur matkul
                  $idmk = $this->Kurikulum_m->getidmk()->id_matakuliah;
                  $aturmkprod = array(
                    'id_matakuliah' => $idmk,
                    'id_jenjang_pend' => $post['id_jenjang_pend'],
                    'id_fakultas' =>$post['id_fakultas'],
                    'id_prodi' => $post['id_prodi'],
                    'id_semester' => filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'jenis_mk' => 0,
                    'mksyarat' => 0,
                    'id_kurikulum' => $post['id_kurikulum'],
                    'tahun' => $post['tahun'],
                    'jns_mk' => filter_var($val[6], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_tm' => filter_var($val[7], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_prak' => filter_var($val[8], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_prak_lap' => filter_var($val[9], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'sks_sim' => filter_var($val[10], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'a_sap' => filter_var($val[11], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    's_silabus' => filter_var($val[12], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'a_bahan_ajar' => filter_var($val[13], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH),
                    'acara_prakata_dikdat' => filter_var($val[14], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)
                    );
                  $this->Kurikulum_m->insert_aturmk($aturmkprod); 
                 }
              }
          }
      }
      unlink("asset/upload/matakuliah/".$_FILES['semester']['name']);
      $msg = '';
      if (($sukses>0) || ($error_count>0)) {
        $msg =  "<div class=\"alert bts-ats2 alert-warning alert-dismissible\" role=\"alert\" >
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        <font color=\"#3c763d\">".$sukses." data baru dibuat dan di tambahkan</font><br />
        <font color=\"#ce4844\" >".$error_count." data sudah ada berhasil ditambahkan </font>";
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
    $this->session->set_flashdata('import', $msg);
    redirect(base_url('index.php/prodi/kurikulum/mkbyprod/'.$post['id_jenjang_pend'].'/'.$post['id_fakultas'].'/'.$post['id_prodi'].'/'.$post['id_kurikulum']));
    }
    public function deletemkprodi($jp,$fk,$prodi,$kur,$id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->Kurikulum_m->delete_mkkur($id);
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/Kurikulum/mkbyprod/'.$jp.'/'.$fk.'/'.$prodi.'/'.$kur));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>