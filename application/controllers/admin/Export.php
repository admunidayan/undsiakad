<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Nusoap_lib');
        $this->load->model('admin/Export_adm');
    }
    function index($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Export Mahasiswa';
                $data['page'] = 'admin/export/mahasiswa/export-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $getjumlah =$this->Export_adm->jumlah_mhs_not_exported(@$post['string'],@$post['angkatan']);
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/export/';
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '100';
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
                $data['nomor'] = $offset;
                $data['hasil'] = $this->Export_adm->mahasiswa_not_exported($config['per_page'],$offset,@$post['string'],@$post['angkatan']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function proses_export_mhs(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $post = $this->input->post('pilih');
                // echo "<pre>";print_r($post);echo "</pre>";exit();
                // get id_sp mahasiswa setelah export
                $table = 'mahasiswa';
                // ID Perguruan Tinggi
                $id_sp = '921b9381-abed-4e3e-9ada-4a7554666b34';
                // perulangan
                foreach ($post as $kode) {
                    $dtmhs = $this->Export_adm->get_mhs($kode);
                    $dtmhspt = $this->Export_adm->get_mhs_pt($dtmhs->id_mhs_pt);
                    $mahasiswa = array(
                        'nm_pd' => strtoupper($dtmhs->nm_pd),
                        'jk' => $dtmhs->jk,
                        'jln' => $dtmhs->jln,
                        'rt' => $dtmhs->rt,
                        'rw' => $dtmhs->rw,
                        'nm_dsn' => $dtmhs->nm_dsn,
                        'ds_kel' => $dtmhs->ds_kel,
                        'kode_pos' => '93717',
                        'nisn' => $dtmhs->nisn,
                        'nik' => $dtmhs->nik,
                        'tmpt_lahir' => $dtmhs->tmpt_lahir,
                        'tgl_lahir' => date('Y-m-d', strtotime($dtmhs->tgl_lahir)),
                        'nm_ayah' => $dtmhs->nm_ayah,
                        'tgl_lahir_ayah' => $dtmhs->tgl_lahir_ayah,
                        'nik_ayah' => $dtmhs->nik_ayah,
                        'id_jenjang_pendidikan_ayah' => $dtmhs->id_jenjang_pendidikan_ayah,
                        'id_pekerjaan_ayah' => $dtmhs->id_pekerjaan_ayah,
                        'id_penghasilan_ayah' => $dtmhs->id_penghasilan_ayah,
                        'id_kebutuhan_khusus_ayah' => $dtmhs->id_kebutuhan_khusus_ayah,
                        'nm_ibu_kandung' => $dtmhs->nm_ibu_kandung,
                        'tgl_lahir_ibu' => $dtmhs->tgl_lahir_ibu,
                        'nik_ibu' => $dtmhs->nik_ibu,
                        'id_jenjang_pendidikan_ibu' => $dtmhs->id_jenjang_pendidikan_ibu,
                        'id_pekerjaan_ibu' => $dtmhs->id_pekerjaan_ibu,
                        'id_penghasilan_ibu' => $dtmhs->id_penghasilan_ibu,
                        'id_kebutuhan_khusus_ibu' => $dtmhs->id_kebutuhan_khusus_ibu,
                        'nm_wali' => $dtmhs->nm_wali,
                        'tgl_lahir_wali' => $dtmhs->tgl_lahir_wali,
                        'id_jenjang_pendidikan_wali' => $dtmhs->id_jenjang_pendidikan_wali,
                        'id_pekerjaan_wali' => $dtmhs->id_pekerjaan_wali,
                        'id_penghasilan_wali' => $dtmhs->id_penghasilan_wali,
                        'id_kk' => $dtmhs->id_kk,
                        'no_tel_rmh' => $dtmhs->no_tel_rmh,
                        'no_hp' => $dtmhs->no_hp,
                        'email' => $dtmhs->email,
                        'no_kps' => $dtmhs->no_kps,
                        'npwp' => $dtmhs->npwp,
                        'id_wil' => '200000',
                        'id_jns_tinggal' => $dtmhs->id_jns_tinggal,
                        'id_agama' => $dtmhs->id_agama,
                        'id_alat_transport' => $dtmhs->id_alat_transport,
                        'kewarganegaraan' => 'ID',
                        'a_terima_kps'=>$dtmhs->a_terima_kps
                    );
                    $inputmhs = $proxy->InsertRecord($token, 'mahasiswa', json_encode($mahasiswa));
                    // echo "<pre>";print_r($inputmhs);echo "</pre>";exit();
                    if ($inputmhs['result']['error_desc']==NULL) {
                        $id_pds = "p.nm_pd='".strtoupper($dtmhs->nm_pd)."' and p.tgl_lahir='".date('Y-m-d', strtotime($dtmhs->tgl_lahir))."'";
                        $dtexp = $proxy->GetRecord($token,'mahasiswa',$id_pds);
                        // echo "<pre>";print_r($dtexp);echo "</pre>";exit();
                        $id_pdmhs = array('id_pd' => $dtexp['result']['id_pd']);
                        $this->Export_adm->update_mhs($kode,$id_pdmhs);
                    }
                    // input mahasiswa_pt
                    $id_pds = "p.nm_pd='".strtoupper($dtmhs->nm_pd)."' and p.tgl_lahir='".date('Y-m-d', strtotime($dtmhs->tgl_lahir))."' and p.nm_ibu_kandung='".$dtmhs->nm_ibu_kandung."'";

                    $get_idpd = $proxy->GetRecord($token,'mahasiswa',$id_pds);
                    // echo "<pre>";print_r($get_idpd);echo "</pre>";exit();
                    $id_pd=$get_idpd['result']['id_pd'];
                    $mhspt=array(
                        'id_pd' => $id_pd,
                        'id_sp' => $id_sp,
                        'id_sms' => $dtmhspt->id_sms,
                        'id_jns_daftar' => $dtmhspt->id_jns_daftar,
                        'nipd' => $dtmhspt->nipd,
                        'tgl_masuk_sp' => date('Y-m-d', strtotime($dtmhspt->tgl_masuk_sp)),
                        'a_pernah_paud' => '1',
                        'a_pernah_tk' => '1',
                        'mulai_smt' => $dtmhspt->mulai_smt,
                        'tgl_create' => '2017-09-07',
                    );
                    $inputmhspt =  $proxy->InsertRecord($token, 'mahasiswa_pt', json_encode($mhspt));
                    // echo "<pre>";print_r($inputmhspt);echo "</pre>";exit();
                    if ($inputmhspt['result']['error_desc']==NULL) {
                        $id_mhspt = "p.nipd='".$dtmhspt->nipd."'";
                        $restmhs = $proxy->GetRecord($token,'mahasiswa_pt',$id_mhspt);
                        $id_reg_pd = array('id_reg_pd' => $restmhs['result']['id_reg_pd']);
                        // echo "<pre>";print_r($id_reg_pd);echo "</pre>";exit();
                        $this->Export_adm->update_mhs_pt($dtmhs->id_mhs_pt,$id_reg_pd);
                    }
                }
                $pesan = 'Export data berhasil';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/export'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function kelas_kuliah($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Export Kelas Kuliah';
                $data['page'] = 'admin/export/kelaskuliah/export-kelas-kuliah-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $getjumlah =$this->Export_adm->jumlah_kelas_not_exported(@$post['string']);
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/export/kelas_kuliah/';
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
                $data['nomor'] = $offset;
                $data['hasil'] = $this->Export_adm->kelas_not_exported($config['per_page'],$offset,@$post['string']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function proses_export_kls(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $post = $this->input->post('pilih');
                // get id_sp mahasiswa setelah export
                $table = 'kelas_kuliah';
                // ID Perguruan Tinggi
                // perulangan
                foreach ($post as $kode) {
                    $dtmhs = $this->Export_adm->get_kls($kode);
                    $sms_id = $this->Export_adm->get_prodi($dtmhs->kode_jurusan)->id_sms;
                    $mk = $this->Export_adm->get_mk($dtmhs->kode_mk)->id_mk;
                    $kelas = array(
                        'id_sms' => $sms_id,
                        'id_smt' => $dtmhs->semester,
                        'nm_kls' => $dtmhs->nama_kelas,
                        'sks_mk' => $dtmhs->sks_mk,
                        'sks_tm' => $dtmhs->sks_tm,
                        'sks_prak' => $dtmhs->sks_prak,
                        'sks_prak_lap' => $dtmhs->sks_prak_lap,
                        'sks_sim' => $dtmhs->sks_sim,
                        'a_selenggara_pditt' => 0,
                        'a_pengguna_pditt' => 0,
                        'kuota_pditt' => 0,
                        'tgl_mulai_koas' =>'',
                        'tgl_selesai_koas' => '',
                        'id_mou' => '',
                        'id_mk' => $mk,
                    );
                    $inputmhs = $proxy->InsertRecord($token, 'kelas_kuliah', json_encode($kelas));
                    
                    if ($inputmhs['result']['error_desc']==NULL) {
                        $id_pds = "p.id_sms='".$sms_id."' and p.id_mk='".$mk."' and p.id_smt='".$dtmhs->semester."'";
                        $dtexp = $proxy->GetRecord($token,'kelas_kuliah',$id_pds);
                        $id_pdmhs = array('id_kls' => $dtexp['result']['id_kls']);
                        $this->Export_adm->update_kls($kode,$id_pdmhs);
                    } 
                }
                $pesan = 'Login terlebih dahulu';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/login'));
            }
        }else{
            $pesan = 'Data berhasil di Export ke feeder';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/export/kelas_kuliah'));
        }
    }
    public function delete_mhs(){
        $post= $this->input->post('pilih');
        // echo "<pre>";print_r($post);echo "</pre>";exit();
        foreach ($post as $data) {
            $this->Export_adm->delete_mhs($data);
            $this->Export_adm->delete_mhs_pt($data);
        }
    }
    public function kurikulum($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Export Kurikulum';
                $data['page'] = 'admin/export/kurikulum/export-kurikulum-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $getjumlah =$this->Export_adm->jumlah_kur_not_exported(@$post['string']);
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/export/kurikulum/';
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
                $data['nomor'] = $offset;
                $data['hasil'] = $this->Export_adm->kur_not_exported($config['per_page'],$offset,@$post['string']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function proses_export_kur(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin'; 
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $post = $this->input->post('pilih');
                // get id_sp mahasiswa setelah export
                $table = 'kurikulum';
                // perulangan
                foreach ($post as $kode) {
                    $kur = $this->Export_adm->get_kur($kode);
                    $sms_id = $this->Export_adm->get_prodi($kur->kode_jurusan)->id_sms;
                    $kurikulum = array(
                        'id_sms' => $sms_id,
                        'id_jenj_didik' => $kur->id_jenjang_pend,
                        'id_smt' => $kur->mulai->berlaku,
                        'nm_kurikulum_sp' => $kur->nama_kur,
                        'jml_sem_normal' => $kur->jml_sem_normal,
                        'jml_sks_lulus' => $kur->total_sks,
                        'jml_sks_wajib' => $kur->jml_sks_wajib,
                        'jml_sks_pilihan' => $kur->jml_sks_pilihan
                    );
                    $inputmhs = $proxy->InsertRecord($token, 'kkurikulum', json_encode($kurikulum));
                    
                    if ($inputmhs['result']['error_desc']==NULL) {
                        $id_pds = "p.id_sms='".$sms_id."' and nm_kurikulum_sp like'%".$kur->nama_kur."%'";
                        $dtexp = $proxy->GetRecord($token,'kurikulum',$id_pds);
                        $id_pdmhs = array('id_kurikulum_sp' => $dtexp['result']['id_kurikulum_sp']);
                        $this->Export_adm->update_kur($kode,$id_pdmhs);
                    } 
                }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>