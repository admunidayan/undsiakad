<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('prodi/Kelas_m');
        $this->load->model('prodi/Prodi_m');
    }
    function index()
    {
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Daftar Program Studi';
                $data['page'] = 'prodi/prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['allprod'] = $this->Prodi_m->allprodi()->result();
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
    public function kelasprodi($id_prodi,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $kodeprod = $this->Prodi_m->detail_prodi($id_prodi)->row('id_sms');
                $data['title'] = 'Kelas Kuliah Prodi'.' - '.$this->Prodi_m->detail_prodi($id_prodi)->row('nm_lemb');
                $data['page'] = 'prodi/kelas-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // $data['klskul'] = $this->Kelas_m->kelas_kuliah_prodi($kodeprod)->result();
                $data['detkel'] = $this->Prodi_m->detail_prodi($id_prodi)->row();
                // pagging setting
                $data['contoh'] =$this->Kelas_m->jumlah_kelas_prodi($kodeprod,@$post['matakuliah'],@$post['semester']);
                $jumlah = $data['contoh'];
                if ($post == TRUE) {
                    $config['base_url'] = base_url('index.php/prodi/kelas/kelasprodi/'.$id_prodi.'/'.@$post['matakuliah'].'/'.@$post['semester']);
                }else{
                    $config['base_url'] = base_url('index.php/prodi/kelas/kelasprodi/'.$id_prodi);
                }
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '20';
                $config["uri_segment"] = 5;
                // $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = 2;
                // bootstap style
                $config['first_link']       = 'Awal';
                $config['last_link']        = 'Akhir';
                $config['next_link']        = 'Selanjutnya';
                $config['prev_link']        = 'Sebelumnya';
                $config['full_tag_open']    = '<div class="pagging"><nav><ul class="pagination">';
                $config['full_tag_close']   = '</ul></nav></div>';
                $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                $config['num_tag_close']    = '</span></li>';
                $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['prev_tagl_close']  = '</span>Next</li>';
                $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                $config['first_tagl_close'] = '</span></li>';
                $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['last_tagl_close']  = '</span></li>';
                //inisialisasi config
                $this->pagination->initialize($config);
                $data['nomor'] = $offset;
                $data['idkur'] = $this->Kelas_m->get_id_kur_prod($this->Prodi_m->detail_prodi($id_prodi)->row('id_sms'));
                // echo "<pre>";print_r( $data['idkur']);echo "<pre/>";exit();
                // $data['mkprod'] = $this->Kelas_m->mk_prod($id_prodi,$kur);
                $data['smt'] = $this->Kelas_m->smt();
                $data['getprod'] = $this->Prodi_m->detail_prodi($id_prodi)->row();
                $data['allhasil'] = $this->Kelas_m->all_kelas_prodi($config['per_page'],$offset,$kodeprod,@$post['matakuliah'],@$post['semester']);
                // echo "<pre>";print_r($data['allhasil']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function mhskelas($id){
        if ($this->ion_auth->logged_in()){
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
               $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
               $this->session->set_flashdata('message', $pesan );
               redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = $this->Kelas_m->detail_kelas($id)->nm_mk;
                $data['page'] = 'prodi/mahasiswa-kelas-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['nmkls'] = $this->Kelas_m->detail_kelas($id);
                $kode_prodi = $this->Kelas_m->get_prodi_by_kel($id)->kode_prodi;
                $data['getprod'] = $this->Kelas_m->detail_prodi($kode_prodi)->row();
                // echo "<pre>";print_r($data['getprod']);echo "<pre/>";exit();
                $data['detdosen'] = $this->Kelas_m->dosenkls($id);
                $data['bobotnilai'] = $this->Kelas_m->bobotnilai($this->Kelas_m->get_prodi_by_kel($id)->id_sms);
                $data['mhskls'] = $this->Kelas_m->mahasiwakelas($id)->result();
                 // echo "<pre>";print_r($data['mhskls']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit_nilai($kls,$id){
        if ($this->ion_auth->logged_in()){
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
               $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
               $this->session->set_flashdata('message', $pesan );
               redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                $nindeks = $this->Kelas_m->detail_data('bobot_nilai','nilai_huruf',$post['nilai_huruf'])->nilai_indeks;
                // echo "<pre>";print_r($nindeks);echo "<pre/>";exit();
                $edit = array(
                    'nilai_huruf' => $post['nilai_huruf'],
                    'nilai_indeks' => $nindeks,
                );
                $this->Kelas_m->edit('nilai','id',$id,$edit);
                $pesan = 'Ubah nilai berhasi';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/mhskelas/'.$kls));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function tmbhmhsbanyak($sms,$kls,$offset=0){
        if ($this->ion_auth->logged_in()){
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
               $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
               $this->session->set_flashdata('message', $pesan );
               redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $data['title'] = $this->Kelas_m->detail_kelas($kls)->nm_mk;
                $data['page'] = 'prodi/add-mahasiswa-kelas-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['nmkls'] = $this->Kelas_m->detail_kelas($kls);
                $data['getprod'] = $this->Kelas_m->detail_prodi($sms)->row();
                // echo "<pre>";print_r($data['getprod']);echo "<pre/>";exit();
                 $data['contoh'] =$this->Kelas_m->jumlah_mhs_prodi($sms,@$post['nama'],@$post['angkatan']);
                $jumlah = $data['contoh'];
                if ($post == TRUE) {
                    $config['base_url'] = base_url('index.php/prodi/kelas/tmbhmhsbanyak/'.$sms.'/'.$kls.'/'.@$post['nama'].'/'.@$post['angkatan']);
                }else{
                    $config['base_url'] = base_url('index.php/prodi/kelas/tmbhmhsbanyak/'.$sms.'/'.$kls.'/');
                }
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '20';
                $config["uri_segment"] = 4;
                // $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = 2;
                // bootstap style
                $config['first_link']       = 'Awal';
                $config['last_link']        = 'Akhir';
                $config['next_link']        = 'Selanjutnya';
                $config['prev_link']        = 'Sebelumnya';
                $config['full_tag_open']    = '<div class="pagging"><nav><ul class="pagination">';
                $config['full_tag_close']   = '</ul></nav></div>';
                $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                $config['num_tag_close']    = '</span></li>';
                $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['prev_tagl_close']  = '</span>Next</li>';
                $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                $config['first_tagl_close'] = '</span></li>';
                $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['last_tagl_close']  = '</span></li>';
                //inisialisasi config
                $this->pagination->initialize($config);
                $data['nomor'] = $offset;
                $data['mhskls'] = $this->Kelas_m->get_mahasiswa($config['per_page'],$offset,$sms,@$post['nama'],@$post['angkatan']);
                $data['pagging'] = $this->pagination->create_links();
                 // echo "<pre>";print_r($data['mhskls']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     public function prosesaddmhs($sms,$kls){
        if ($this->ion_auth->logged_in()){
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
               $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
               $this->session->set_flashdata('message', $pesan );
               redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $dtpilih = $this->input->post('pilih');
                // echo "<pre>";print_r($dtpilih);echo "<pre/>";exit();
                $kelas = $this->Kelas_m->detail_data('kelas_kuliah','id',$kls);
                $matakuliah = $this->Kelas_m->detail_data('mata_kuliah','id',$kelas->id_mk_siakad);
                foreach ($dtpilih as $data) {
                    $cekmhs = $this->Kelas_m->cek_mahasiswa_di_kelas($kls,$data,$kelas->id_smt);
                    // echo "<pre>";print_r($cekmhs);echo "<pre/>";exit();
                    if ($cekmhs == FALSE) {
                        $mahasiswa = $this->Kelas_m->detail_data('mahasiswa_pt','id',$data);
                        $datamhs = array(
                            'id_kls' => @$kelas->id_kls,
                            'id_reg_pd' => @$mahasiswa->id_reg_pd,
                            'id_kls_siakad'=>$kls,
                            'id_mhs_pt' =>$data,
                            'nipd' => $mahasiswa->nipd,
                            'id_smt' => $kelas->id_smt,
                            'kode_mk' => $matakuliah->kode_mk,
                        );
                        $this->Kelas_m->insert('nilai',$datamhs);
                    }
                }
                $pesan = 'Mahasiswa berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/mhskelas/'.$kls));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function editnilaimkmhs() {
        $idkhs = $this->input->post('id_khs');
        $khs = $this->Kelas_m->get_detail_khs($idkhs);
        echo json_encode($khs);
    }
    public function tampildosen(){
        $nama = $this->input->post('kirimNama');
        $data['hasil_limit']=$this->Kelas_m->tampil_dosen_limit($nama);
        if($nama!=""){
            foreach($data['hasil_limit']->result() as $result)
            {
                echo '<a class="list-group-item" onClick="pilih(\''.$result->id_dosen.'\');">
                <b>'.$result->nidn.'</b> - '.$result->nm_sdm.' ('.$result->id_thn_ajaran.')</a>';
            }
        }else{
           echo "error";        
       }
    }
    public function proses_input_kelas(){
        if ($this->ion_auth->logged_in()){
            $post=$this->input->post();
            $kodemk = $this->Kelas_m->getkodemk($post['id_mk_siakad']);
             // echo "<pre>";print_r($post['id_mk_siakad']);echo "</pre>";exit();
            $data=array(
                'id_sms' => $post['id_sms'],
                'id_smt' => $post['id_smt'],
                'nm_kls' => $post['nm_kls'],
                'sks_mk' => $kodemk->sks_mk,
                'sks_tm' => $kodemk->sks_mk,
                'sks_prak' => $kodemk->sks_prak,
                'sks_prak_lap' => $kodemk->sks_prak_lap,
                'sks_sim' => $kodemk->sks_sim,
                'bahasan_case' => $post['bahasan'],
                'a_selenggara_pditt' => 0,
                'a_pengguna_pditt' => 0,
                'kuota_pditt' => 0,
                'tgl_mulai_koas' => $post['tgl_mulai'],
                'tgl_selesai_koas' => $post['tgl_selesai'],
                'id_mk_siakad' => $post['id_mk_siakad'],
                'id_mk' => $kodemk->id_mk,
            );
            // echo "<pre>";print_r($data);echo "</pre>";exit();
            $this->Kelas_m->insert_kls($data);
            $pesan = 'Kelas '.$post['kelas'].' '.$post['id_smt'].' '.$kodemk->nm_mk.' Berhasil dibuat';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/prodi/kelas/kelasprodi/'.$post['kode_prodi']));
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_tambah_dosen_kelas(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                $dosen = $this->Kelas_m->detail_data('dosen_pt','id',$post['id_dosen']);
                $kelas = $this->Kelas_m->detail_data('kelas_kuliah','id',$post['id_kls_siakad']);
                $datamhs = array(
                    'id_jns_eval'      => 1,
                    'id_dosen_pt_siakad' => $post['id_dosen'],
                    'id_reg_ptk' => $dosen->id_reg_ptk,
                    'id_kls'      => @$kelas->id_kls,
                    'id_kls_siakad'      => $post['id_kls_siakad'],
                    'sks_tm_subst' => $kelas->sks_tm,
                    'sks_prak_subst' => $kelas->sks_prak,
                    'sks_prak_lap_subst' => $kelas->sks_prak_lap,
                    'sks_sim_subst' => $kelas->sks_sim,
                    'sks_subst_tot'      => number_format($post['sks_subst_tot'],2),
                    'jml_tm_renc' => $post['jml_tm_renc'],
                    'jml_tm_real' => $post['jml_tm_real'],
                );
                // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                $this->Kelas_m->insert('ajar_dosen',$datamhs);
                $pesan = 'Dosen Berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/mhskelas/'.$post['id_kls_siakad']));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_edit_dosen_kelas(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                $datamhs = array(
                    'sks_subst_tot'      => number_format($post['sks_subst_tot'],2),
                    'jml_tm_renc' => $post['jml_tm_renc'],
                    'jml_tm_real' => $post['jml_tm_real'],
                );
                // echo "<pre>";print_r($post);echo "</pre>";exit();
                $this->Kelas_m->edit('ajar_dosen','id',$post['id_ajr_dosen'],$datamhs);
                $pesan = 'Perubahan data dosen berhasil';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/mhskelas/'.$post['id_kls_siakad']));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete_kelas($prodi,$id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->Kelas_m->delete_kelas($id);
                $pesan = 'Data Berhasil di Hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/kelasprodi/'.$prodi));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function delete_dosen_kelas($kelas,$id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->Kelas_m->delete('ajar_dosen','id',$id);
                $pesan = 'Data Berhasil di Hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/kelas/mhskelas/'.$kelas));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function getdosenkelasfromfeeder($idklsf,$idklssiakad){
        $this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
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
        $result = $proxy->getRecordset($token,$table,"p.id_kls = '{$idklsf}'");
        // echo "<pre>";print_r($result['result']);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) {
                $check = $this->Kelas_m->cek_ajar_dosen(trim($data['id_ajar']));
                 // echo "<pre>";print_r($check->id);echo "</pre>";exit();
                if ($check == FALSE) {
                   $datamhs = array(
                    'id_ajar'      =>trim($data['id_ajar']),
                    'id_subst'      =>$data['id_subst'],
                    'id_jns_eval'      =>$data['id_jns_eval'],
                    'id_dosen_pt_siakad'      =>$this->Isi_m->detail_data('dosen_pt','id_reg_ptk',$data['id_reg_ptk'])->id,
                    'id_reg_ptk' =>$data['id_reg_ptk'],
                    'id_kls'      =>$data['id_kls'],
                    'id_kls_siakad'      =>$idklssiakad,
                    'sks_subst_tot'      =>$data['sks_subst_tot'],
                    'sks_tm_subst' =>$data['sks_tm_subst'],
                    'sks_prak_subst' =>$data['sks_prak_subst'],
                    'sks_prak_lap_subst' =>$data['sks_prak_lap_subst'],
                    'sks_sim_subst' =>$data['sks_sim_subst'],
                    'jml_tm_renc' =>$data['jml_tm_renc'],
                    'jml_tm_real' =>$data['jml_tm_real'],
                );
                 // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                   $this->Kelas_m->insert('ajar_dosen',$datamhs);
               }
           }
           $pesan = 'Dosen Kelas Berhasil Di Update';
           $this->session->set_flashdata('message', $pesan );
           redirect(base_url('index.php/prodi/kelas/mhskelas/'.$idklssiakad));
       }else{
        $pesan = 'Belum ada dosen di kelas ini pada data feeder';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/prodi/kelas/mhskelas/'.$idklssiakad));
       }
    }
    public function getmhskelasfromfeeder($idklsf,$idklssiakad){
        $this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
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
        $limit =500;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,"p.id_kls = '{$idklsf}'");
        // echo "<pre>";print_r($result['result']);echo "</pre>";exit();
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) {
                $check = $this->Kelas_m->cek_mhs_kelas(trim($data['id_kls']),trim($data['nipd']),trim($data['id_smt']),trim($data['kode_mk']));
                 // echo "<pre>";print_r($check);echo "</pre>";exit();
                if ($check == FALSE) {
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
                        echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    // $this->Kelas_m->insert('nilai',$datamhs);
               }
           }
           $pesan = 'Mahasiswa Kelas Berhasil Di Tambahkan';
           $this->session->set_flashdata('message2', $pesan );
           redirect(base_url('index.php/prodi/kelas/mhskelas/'.$idklssiakad));
       }else{
        $pesan = 'Belum ada Mahasiswa di kelas ini pada data feeder';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/prodi/kelas/mhskelas/'.$idklssiakad));
       }
    }
    public function edit_mhs_kelas_nilai(){
        $post = $this->input->post();  
        $data = array(
            'nilai_mhs' => $post['nilai_mhs'],
            'nilai_angka' => $post['nilai_angka'],
            'nilai_huruf' => $post['nilai_huruf']
            );
        $this->Kelas_m->edit_khs($post['id_khs'],$data);
        redirect(base_url('index.php/prodi/kelas/mhskelas/'.$post['id_kls']));
    }
    public function delete_mhs_kelas($idkls,$idkhs){
        if ($this->ion_auth->logged_in()) {
            $this->Kelas_m->delete_khs($idkhs);
            redirect(base_url('index.php/prodi/kelas/mhskelas/'.$idkls));
        }
    }
}
?>