<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->library('Nusoap_lib');
    $this->load->library('Excel');
    $this->load->library('Resize');
    $this->load->model('admin/Dosen_m');
    $this->load->model('fakultas/Fakultas_m');
  }
  function index($offset=0){
    if ($this->ion_auth->logged_in() ){
      $level= array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
                // pagging setting
        $post=$this->input->get();
        $data['allgroup'] = $this->ion_auth->groups()->result();
        $data['contoh'] =$this->Dosen_m->jumlah_data_dosen(@$post['dosen']);
        $jumlah = $this->Dosen_m->jumlah_data_dosen(@$post['dosen']);
        $config['base_url'] = base_url('index.php/admin/dosen/index/');
        $config['total_rows'] = $jumlah;
        $config['per_page'] = '20';
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
                // bootstap style
        $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                //inisialisasi config
        $this->pagination->initialize($config);
        $data['title'] = 'Daftar Dosen Universitas';
        $data['page'] = 'admin/dosen-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();
        $data['nomor'] = $offset;
        $data['alldosen'] = $this->Dosen_m->searcing_data($config['per_page'],$offset,@$post['dosen']);
        $data['pagging'] = $this->pagination->create_links();
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  function detaildosen($id){
    if ($this->ion_auth->logged_in() ){
      $level= array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
        $data['title'] = 'Daftar Dosen Universitas';
        $data['page'] = 'admin/detail-dosen-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();

        $data['dtta'] = $this->Fakultas_m->getdtta() ;
        $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
        $data['dtafk'] = $this->Fakultas_m->getdtfak() ;
        $data['dtaprod'] = $this->Fakultas_m->getdtprod() ;
        $data['dtsmstr'] = $this->Fakultas_m->getdtsemester() ;
        $data['dtamatkul'] = $this->Fakultas_m->getdtmatkul() ;

        $data['detdos'] = $this->Dosen_m->detaildosen($id);
        $data['kelasmeng'] = $this->Dosen_m->kelasmengajar($id) ;
        $data['rwpend'] = $this->Dosen_m->riwayat_pendidikan($id) ;
        $data['rwmeng'] = $this->Dosen_m->riwayat_mengajar($id) ;
        $data['dtagol'] = $this->Dosen_m->getdtgol($id) ;
        $data['dtapak'] = $this->Dosen_m->getdtpak($id) ;
                //
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  function kelasdosen($id,$offset=0){
    if ($this->ion_auth->logged_in() ){
      $level= array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
                // pagging setting
        $post=$this->input->get();
        $data['contoh'] =$this->Dosen_m->jml_kls_dsn($id,@$post['dosen']);
        $jumlah = $this->Dosen_m->jml_kls_dsn($id,@$post['dosen']);
        $config['base_url'] = base_url('index.php/admin/dosen/kelasdosen/'.$id.'/');
        $config['total_rows'] = $jumlah;
        $config['per_page'] = '20';
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
                // bootstap style
        $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                //inisialisasi config
        $this->pagination->initialize($config);
        $data['title'] = 'Daftar Kelas Dosen';
        $data['page'] = 'admin/dosen/kelas-by-dosen-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();
        $data['nomor'] = $offset;
        $data['detail'] = $this->Dosen_m->detaildosen($id);
        $data['hasil'] = $this->Dosen_m->searcing_kls_dsn($config['per_page'],$offset,$id,@$post['dosen']);
        $data['pagging'] = $this->pagination->create_links();
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  function detail($id){
    if ($this->ion_auth->logged_in() ){
      $level= array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
        $data['title'] = 'Daftar Dosen Universitas';
        $data['page'] = 'admin/dosen/detail-dosen-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();
                //
        $data['detail'] = $this->Dosen_m->detaildosen($id);
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function kelas(){
    if ($this->ion_auth->logged_in()) {

      $level = array('admin','prodi','fakultas');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
        $data['title'] = 'Kelas Mengajar Dosen';
        $data['page'] = 'admin/dosen/kelas-mengajar-dosen-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();
        $data['klsmeng'] = $this->Dosen_m->get_kelas_mengajar_dosen();
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function dosenpt(){
    if ($this->ion_auth->logged_in()) {

      $level = array('admin','prodi','fakultas');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
        $data['title'] = 'Daftar Dosen PT';
        $data['page'] = 'admin/dosen/dosen-pt-v';
        $data['nav'] = 'nav/nav-admin';
        $data['dtadm'] = $this->ion_auth->user()->row();
        $data['klsmeng'] = $this->Dosen_m->get_kelas_mengajar_dosen();
        $this->load->view('admin/dashboard-v', $data);
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function tampildosenpt(){
    $data['dosenpt'] = $this->Dosen_m->get_dosen_pt();
    $this->load->view('admin/dosen/ajax-dosen-pt-v', $data);
  }
  public function tampildatakelas(){
    $data['klsmeng'] = $this->Dosen_m->get_kelas_mengajar_dosen();
    $this->load->view('admin/dosen/ajax-kelas-meng-v', $data);
  }
  public function importdosenpt($id){
    $data['baris']=$id;
    $this->load->view('admin/dosen/proses-import-dosen-pt-v',$data);
  }
  public function importkelas($id){
    $data['baris']=$id;
    $this->load->view('admin/dosen/proses-import-kelas-v', $data);
  }
  public function proses_import_kelas(){

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
    $order ='';
    $limit ='10';
    $offest =0;
    $filter = '';
    $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // get jumlah data
    $jml = $proxy->GetCountRecordset($token,$table,$filter);
    $getjumlah =$jml['result'];
    $data_per_loop = 100;
    // perulangan
    foreach ($result['result'] as $data) {
      $iterasi = ceil($getjumlah / $data_per_loop);
      for($nomor=0; $nomor < $iterasi; $nomor++) 
      { 
        for($datake=0; $datake < $data_per_loop; $datake++) 
        { 

        }
      }
    }
  }
  public function proses_update_foto_profil_dosen(){

    $id = $this->input->post('id_dosen');
    $post = $this->input->post();
    $file = $this->Dosen_m->detail_dosen($id)->row('foto_profil_dosen');

    if (!empty($_FILES["editprofil"]["tmp_name"])) {
      if ($file != "avatar.jpg") {
        unlink("asset/img/dosen/$file");
      }
      $config['file_name']            = strtolower(url_title("dosen-unidayan".'-'.$post['nama_dosen'].'-'.date('Ymd').'-'.time('His')));
      $config['upload_path']          = './asset/img/dosen/';
      $config['allowed_types']        = 'jpg|png|gif';
      $config['max_size']             = 2048;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('editprofil')){
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('editfoto', $error );
        redirect(base_url('index.php/admin/dosen/detaildosen/'.$id));
      }else{
        $data['foto_profil_dosen'] = $this->upload->data('file_name');
      }
      $a = $this->upload->data('file_name');
    //file yang akan di resize
      $file = "asset/img/dosen/$a";
    //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
      $resizedFile = "asset/img/dosen/$a";
      $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,35 );

      $this->Dosen_m->edit_info_pribadi_dos ($id, $data);
      $this->session->set_flashdata('editfoto', 'Foto profil berhasil di perbarui');
      redirect(base_url('index.php/admin/dosen/detaildosen/'.$id));
    }else{
      $this->session->set_flashdata('editfoto', 'Tidak ada gambar di pilih');
      redirect(base_url('index.php/admin/dosen/detaildosen/'.$id));
    }
  }
  public function editinfopribadidos(){
    $post = $this->input->post();

    $data = array(
      'nama_dosen'       => $post['nama_dosen'],
      'email_dosen'       => $post['email_dosen'],
      'status_dosen'       => $post['status_dosen'],
      'username'  => $post['username'],
      'no_hp_dosen'  => $post['no_hp_dosen'],
      'alamat_dosen'      => $post['alamat_dosen'],
      'alamat_kantor_dosen'      => $post['alamat_kantor_dosen'],
      'tgl_lhr_dosen'      => $post['tgl_lhr_dosen'],
      'gender_dosen'      => $post['gender_dosen'],
      );
    $id = $this->input->post('id_dosen');
    $this->Dosen_m->edit_info_pribadi_dos($id, $data);
    $this->session->set_flashdata('editinfo', 'Berhasil memperbarui informasi pribadi');
    redirect(base_url('adm-detail-dosen/'.$post['id_dosen']));
  }
  public function updatepassdsn(){

    $post = $this->input->post();

    $data = array(
      'pass'  => md5($post['pass'])
      );

    $id = $this->input->post('id_dosen');
    $this->Dosen_m->edit_info_pribadi_dos ($id, $data);
    $this->session->set_flashdata('editpass', 'Password Berhasil Di Perbarui');

    redirect(base_url('adm-detail-dosen/'.$post['id_dosen']));
  }
  public function addriwayatpend(){
    $post = $this->input->post();

    $data = array(
      'id_dosen'       => $post['id_dosen'],
      'nama_sekolah'       => $post['nama_sekolah'],
      'jenjang_sekolah'  => $post['jenjang_sekolah'],
      'tahun_masuk'      => $post['tahun_masuk'],
      'progstudi'      => $post['progstudi'],
      'alamat_sekolah'      => $post['alamat_sekolah'],
      );

    $this->Dosen_m->insert_riwayat_pend_dosen($data);
    $this->session->set_flashdata('addriwayat', 'Riwayat pendidikan berhasil ditambahkan');
    redirect(base_url('adm-detail-dosen/'.$post['id_dosen']));
  }
  public function add_rw_mengajar(){
    $post = $this->input->post();

    $data = array(
      'id_dosen'       => $post['id_dosen'],
      'nama_matakuliah_r'       => $post['nama_matakuliah_r'],
      'tahun_mengajar'      => $post['tahun_mengajar'],
      'nama_instansi_r'      => $post['nama_instansi_r'],
      );

    $this->Dosen_m->insert_riwayat_meng_dosen($data);
    $this->session->set_flashdata('addriwayat', 'Riwayat mengajar berhasil ditambahkan');
    redirect(base_url('adm-detail-dosen/'.$post['id_dosen']));
  }
  public function delete_riwayat_pendidikan($id, $id_dosen){
    if(!$this->AccountAdmin->validate_cookie()){
      show_404();
    }else{
      $this->Dosen_m->delete_riwayat_pend($id);
      $this->session->set_flashdata('addriwayatmeng', 'Riwayat mengajar berhasil dihapus');
      redirect(base_url('adm-detail-dosen/'.$id_dosen));
    }
  }
  public function delete_riwayat_mengajar($id){
    if(!$this->AccountAdmin->validate_cookie()){
      show_404();
    }else{
      $this->Dosen_m->delete_riwayat_meng($id, $id_dosen);
      $this->session->set_flashdata('addriwayatmeng', 'Riwayat mengajar berhasil dihapus');
      redirect(base_url('adm-detail-dosen/'.$id_dosen));
    }
  }
  // import dosen from feeder
  function import(){
    if ($this->ion_auth->logged_in() ){
      $level= array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/dashboard_c'));
      }else{
        // do something here
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table ='dosen';
        $order ='';
        $limit =300;
        $offest =0;
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);

        $error_count = 0;
        $error = array();
        $sukses = 0;
        
        // proses
        foreach ($result['result'] as $kode) {
          $check = $this->Dosen_m->cekdosen($kode['id_sdm']);
          if ($check==true) {
            $error_count++;
            $error[] = $kode['nm_sdm']." - Sudah Ada";
          }else{
            $sukses++;
            $data = array(
              'id_sdm'      => str_replace(' ','',$kode['id_sdm']),
              'nama_dosen'      =>$kode['nm_sdm'],
              'npp'      => str_replace(' ','',$kode['nidn']),
              'username'      => str_replace(' ','',$kode['nidn']),
              'pass' => md5(str_replace(' ','',$kode['nidn'])),
              'nidn' =>str_replace(' ','',$kode['id_sdm']),
              'nip'      => $kode['nip'],
              'tempat_lahir'      => $kode['tmpt_lahir'],
              'nik'      => $kode['nik'],
              'niy_nigk' => $kode['niy_nigk'],
              'nuptk' => $kode['nuptk'],
              'id_stat_pegawai' => $kode['p.id_stat_pegawai'],
              'id_jns_ptk' => $kode['p.id_jns_ptk'],
              'fk__jns_ptk' => $kode['fk__jns_ptk'],
              'id_bid_pengawas' => $kode['id_bid_pengawas'],
              'jln' => $kode['jln'],
              'rt' => $kode['rt'],
              'rw' => $kode['rw'],
              'nm_dsn' => $kode['nm_dsn'],
              'ds_kel' => $kode['ds_kel'],
              'id_wil' => $kode['id_wil'],
              'email_dosen' => $kode['email'],
              'alamat_dosen' => 'tidak diisi',
              'status_dosen' => 'Aktif',
              'tgl_lhr_dosen' => $kode['tgl_lahir'],
              'no_hp_dosen' => '0000',
              'alamat_kantor_dosen' => 'tidak diisi',
              'gender_dosen' => $kode['jk'],
              'foto_profil_dosen' => 'avatar.jpg',
              'agama_dosen' => $kode['fk__agama'],
              'fk__wilayah' => $kode['fk__wilayah'],
              'kode_pos' => $kode['kode_pos'],
              'no_tel_rmh' => $kode['no_tel_rmh'],
              'id_sp' => $kode['p.id_sp'],
              'fk__sp' => $kode['fk__sp'],
              'id_stat_aktif' => $kode['id_stat_aktif'],
              'fk__stat_aktif' => $kode['fk__stat_aktif'],
              'sk_cpns' => $kode['sk_cpns'],
              'tgl_sk_cpns' => $kode['tgl_sk_cpns'],
              'sk_angkat' => $kode['sk_angkat'],
              'tmt_sk_angkat' => $kode['tmt_sk_angkat'],
              'id_lemb_angkat' => $kode['id_lemb_angkat'],
              'fk__lemb_angkat' => $kode['fk__lemb_angkat'],
              'id_pangkat_gol' => $kode['id_pangkat_gol'],
              'fk__pangkat_gol' => $kode['fk__pangkat_gol'],
              'id_keahlian_lab' => $kode['id_keahlian_lab'],
              'fk__keahlian_lab' => $kode['fk__keahlian_lab'],
              'id_sumber_gaji' => $kode['id_sumber_gaji'],
              'fk__sumber_gaji' => $kode['fk__sumber_gaji'],
              'nm_ibu_kandung' => $kode['nm_ibu_kandung'],
              'stat_kawin' => $kode['stat_kawin'],
              'nm_suami_istri' => $kode['nm_suami_istri'],
              'id_pekerjaan_suami_istri' => $kode['id_pekerjaan_suami_istri'],
              'fk__perkerjaan_suami_istri' => $kode['fk__perkerjaan_suami_istri'],
              'tmt_pns' => $kode['tmt_pns'],
              'a_lisensi_kepsek' => $kode['a_lisensi_kepsek'],
              'jml_sekolah_binaan' => $kode['jml_sekolah_binaan'],
              'a_diklat_awas' => $kode['a_diklat_awas'],
              'akta_ijin_ajar' => $kode['akta_ijin_ajar'],
              'nira' => $kode['nira'],
              'stat_data' => $kode['stat_data'],
              'mampu_handle_kk' => $kode['mampu_handle_kk'],
              'a_braille' => $kode['a_braille'],
              'a_bhs_isyarat' => $kode['a_bhs_isyarat'],
              'npwp' => $kode['npwp'],
              'kewarganegaraan' => $kode['kewarganegaraan']
              );
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit();
            $this->Dosen_m->insert_dosen($data);
          }
        }
        // do here
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
      redirect(base_url('index.php/admin/dosen'));
    }
  }else{
    $pesan = 'Login terlebih dahulu';
    $this->session->set_flashdata('message', $pesan );
    redirect(base_url('index.php/login'));
  }
}
function exportexldosen(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post('');
                $data['title'] = 'Eksport Excel dosen';
                $data['page'] = 'admin/import/prodi/import-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $file = new PHPExcel ();
                $file->getProperties ()->setCreator ( "Goblooge" );
                $file->getProperties ()->setLastModifiedBy ( "www.unidayan.ac.id" );
                $file->getProperties ()->setTitle ( "Dosen" );
                $file->getProperties ()->setSubject ( "Daftar Dosen" );
                $file->getProperties ()->setDescription ( "Daftar Dosen Unidayan" );
                $file->getProperties ()->setKeywords ( "Daftar Dosen" );
                $file->getProperties ()->setCategory ( "Dosen" );
                /*end - BLOCK PROPERTIES FILE EXCEL*/

                /*start - BLOCK SETUP SHEET*/
                $file->createSheet ( NULL,0);
                $file->setActiveSheetIndex ( 0 );
                $sheet = $file->getActiveSheet ( 0 );
  //memberikan title pada sheet
                $sheet->setTitle ( "Daftar Dosen" );
                /*end - BLOCK SETUP SHEET*/

                /*start - BLOCK HEADER*/
                $sheet->setCellValue ( "A1", "No" );
                $sheet->setCellValue ( "B1", "NIDN" );
                $sheet->setCellValue ( "C1", "NAMA" );
                $sheet->setCellValue ( "D1", "USERNAME" );
                $sheet->setCellValue ( "E1", "PASSWORD" );
                /*end - BLOCK HEADER*/

                /* start - BLOCK MEMASUKAN DATABASE*/
                $nomor = 1;
                $hasil = $this->Dosen_m->get_all_dosen();
                foreach ($hasil as $data) {
                  $sheet->setCellValue ( "A".$nomor, $nomor );
                  $sheet->setCellValue ( "B".$nomor, $data->npp );
                  $sheet->setCellValue ( "C".$nomor, $data->nama_dosen );
                  $sheet->setCellValue ( "D".$nomor, $data->username );
                  $sheet->setCellValue ( "E".$nomor, $data->username );
                  $nomor++;
                }
                /* end - BLOCK MEMASUKAN DATABASE*/

                /* start - BLOCK MEMBUAT LINK DOWNLOAD*/
                header ( 'Content-Type: application/vnd.ms-excel' );
  //namanya adalah keluarga.xls
                header ( 'Content-Disposition: attachment;filename="daftar_dosen.xls"' ); 
                header ( 'Cache-Control: max-age=0' );
                $writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
                $writer->save ( 'php://output' );
                /* start - BLOCK MEMBUAT LINK DOWNLOAD*/
                // pagging setting
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>