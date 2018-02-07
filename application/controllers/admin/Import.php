<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
        $this->load->library('Excel');
        $this->load->library('Resize');
        $this->load->model('admin/Import_m');
        $this->load->model('Isi_m');
    }
    
    function index($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Program Studi';
                $data['page'] = 'admin/import/prodi/import-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // echo "<pre/>";print_r($data['title']);echo "<pre/>";exit();
                //setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $username = $this->ion_auth->user()->row()->userfeeder; 
                $password = $this->ion_auth->user()->row()->passfeeder; 
                // $data = array(
                //     'act'=>'GetToken', 
                //     'username'=>$username, 
                //     'password'=>$password
                // ); 
                // $result_string = runWS($data, 'xml');
                // echo "<pre>";print_r($result_string);echo "<pre/>";exit();
                // $data1 = array(
                //     'act'=>'GetProfilPT', 
                //     'token'=>$result_string, 
                //     'filter'=>$filter, 
                //     'order'=>$order, 
                //     'limit'=>$limit, 
                //     'offset'=>$offset, 
                // ); 
                // $result_string1 = runWS($data1, $ctype);
                // get jumlah data
                $table ='sms';
                $order = "";
                $filter ="id_sp = '921b9381-abed-4e3e-9ada-4a7554666b34'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/';
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
                $data['allprod'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function index2($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post('');
                $data['title'] = 'Import Program Studi';
                $data['page'] = 'admin/import/prodi/import-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                //setting web server
                $username = $this->ion_auth->user()->row()->userfeeder; 
                $password = $this->ion_auth->user()->row()->passfeeder; 
                $data = array(
                    'act'=>'GetToken', 
                    'username'=>$username, 
                    'password'=>$password
                ); 
                $result_string = runWS($data, 'xml');

                echo "<pre>";print_r(json_encode($result_string));echo "<pre/>";exit();
                $data1 = array(
                    'act'=>'GetProfilPT', 
                    'token'=>$result_string, 
                    'filter'=>$filter, 
                    'order'=>$order, 
                    'limit'=>$limit, 
                    'offset'=>$offset, 
                ); 
                $result_string1 = runWS($data1, $ctype);
                // get jumlah data
                $table ='sms';
                $order = "";
                $filter ="id_sp = '921b9381-abed-4e3e-9ada-4a7554666b34'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/';
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
                $data['allprod'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function detail_prodi($id){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import detail Prodi ';
                $data['page'] = 'admin/import/prodi/dashboard-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $table = 'sms';
                $filter = "id_sms = '{$id}'";
                $hasil = $proxy->GetRecord($token,$table,$filter);
                $data['dtprod'] = $hasil['result'];
                // echo "<pre>";print_r($data['dtprod']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function mhsbyprodi($id,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import detail Prodi ';
                $data['page'] = 'admin/import/mahasiswa/import-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
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
                $filter ="p.id_sms = '{$id}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/mhsbyprodi/'.$id;
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
                $data['smsprod'] = $id;
                $data['kodesms'] = $this->Import_m->get_sms($id)->kode_prodi;
                $this->pagination->initialize($config);
                $data['nomor'] = $offset;
                $data['allmhs'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                // echo "<pre>";print_r($data['dtprod']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function table_feeder(){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Rincian Table Database Feeder';
                $data['page'] = 'admin/import/list-table-feeder-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);

                $data['table'] = $proxy->ListTable($token);
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function diktio($nm){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Rincian Table Database Feeder';
                $data['page'] = 'admin/import/diktio-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);

                $data['hasil'] = $proxy->getDictionary($token,$nm);
                // echo "<pre>";print_r($proxy->getDictionary($token,$nm));echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    // tampilkan isi prodi
    public function reloadprodi(){
        $data['allprod'] = $this->Import_m->all_prodi();
        $this->load->view('admin/import/prodi/ajax-reload-prodi-v', $data);
    }
    function mahasiswa($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $post = $this->input->post('');
                $data['title'] = 'Import Program Studi';
                $data['page'] = 'admin/import/mahasiswa/import-mahasiswa-main-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                //setting web server
                 $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass); 
                // get jumlah data
                $table ='mahasiswa';
                $order = "";
                $filter ="";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/';
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
                $data['jmlfeeder'] = $this->Isi_m->jumlah_mahasiswa();
                $data['nomor'] = $offset;
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['hasil']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function mahasiswa_pt($offset=0){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $post = $this->input->post('');
                $data['title'] = 'Import Program Studi';
                $data['page'] = 'admin/import/mahasiswa/import-mahasiswa-pt-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                //setting web server
                 $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass); 
                // get jumlah data
                $table ='mahasiswa_pt';
                $order = "";
                $filter ="";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/';
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
                $data['jmlfeeder'] = $this->Isi_m->jumlah_mahasiswa_pt();
                $data['nomor'] = $offset;
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['hasil']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function mahasiswa2(){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Mahasiswa';
                $data['page'] = 'admin/import/mahasiswa/import-mahasiswa-main-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    // tampilkan isi prodi
    public function reloadprodi_mhs(){
        $data['allprod'] = $this->Import_m->all_prodi();
        $this->load->view('admin/import/mahasiswa/ajax-reload-prodi-v', $data);
    }
    // tampil mahaiswa Prodi
    public function mhsprodi($id,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();

                $data['title'] = 'Mahasiswa - '.$this->Import_m->detail_sms($id)->nama_prodi;
                $data['page'] = 'admin/import/mahasiswa/import-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['detprod'] = $this->Import_m->detail_sms($id);
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='mahasiswa_pt';
                $order = '';
                // echo "<pre>"; print_r($post); echo "<pre>";exit();
                if (!empty($post['string']) && $post['angkatan']) {
                    if (!is_numeric($post['string'])) {
                        $filter ="p.id_sms = '{$id}' and nm_pd ilike '%{$post['string']}%' and mulai_smt = '{$post['angkatan']}'";
                        $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/';
                    }else{
                        $filter ="p.id_sms = '{$id}' and nipd ='{$post['string']}' and mulai_smt = '{$post['angkatan']}'";
                        $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/';
                    }
                }else if(!empty($post['string'])){
                    if (!is_numeric($post['string'])) {
                        $filter ="p.id_sms = '{$id}' and nm_pd ilike '%{$post['string']}%'";
                        $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/';
                    }else{
                        $filter ="p.id_sms = '{$id}' and nipd ilike '%{$post['string']}%'";
                        $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/';
                    }
                }else if (!empty($post['angkatan'])) {
                    $filter ="p.id_sms = '{$id}' and mulai_smt = '{$post['angkatan']}'";
                    $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/'.$post['angkatan'].'/';
                }else{
                    $filter ="p.id_sms = '{$id}'";
                    $config['base_url'] = base_url().'index.php/admin/import/mhsprodi/'.$id.'/';
                }
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
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
                $data['allmhs'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);            
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    // isert mahasiswa prodi ke database dari feeder
    public function insert_mhs_banyak($filid,$mulaidari){
        $data['filid'] = $filid;
        $data['mulaidari'] = $mulaidari;
        $this->load->view('admin/import/proses-input-mhs-prod-banyak-v', $data);
    }
    // tampilkan isi mahasiswa prodi
    public function reload_mhs_prodi($id){
        $data['mhsprod'] = $this->Import_m->mahasiswa_prodi($id);
        $this->load->view('admin/import/mahasiswa/ajax-reload-mhs-prodi-v', $data);
    }
    public function kurikulum(){
        if ($this->ion_auth->logged_in()) {
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
                // get jumlah data
                $table ='kurikulum';
                $filter = '';
                $order = '';
                $offset = 0;
                $limit = '';
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // data setting
                $data['title'] = 'Import kurikulum';
                $data['page'] = 'admin/import/kurikulum/import-kurikulum-v';
                $data['contoh'] = $getjumlah;
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jumlah'] = $proxy->GetCountRecordset($token,$table,$filter);
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$limit,$offset));echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function kurikulum_prodi($idsms){
        if ($this->ion_auth->logged_in()) {
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
                // get jumlah data
                $table ='kurikulum';
                $filter = "id_sms = '{$idsms}'";
                $order = '';
                $offset = 0;
                $limit = '';
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // data setting
                $data['title'] = 'Import kurikulum';
                $data['page'] = 'admin/import/kurikulum/import-kurikulum-v';
                $data['contoh'] = $getjumlah;
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jumlah'] = $proxy->GetCountRecordset($token,$table,$filter);
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$limit,$offset));echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function matakuliah_kurikulum_prodi($idkur){
        if ($this->ion_auth->logged_in()) {
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
                // get jumlah data
                $table ='mata_kuliah_kurikulum';
                $filter = "p.id_kurikulum_sp = '{$idkur}'";
                $order = '';
                $offset = 0;
                $limit = '';
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // data setting
                $data['title'] = 'Import kurikulum';
                $data['page'] = 'admin/import/kurikulum/import-matakuliah-kurikulum-prodi-v';
                $data['contoh'] = $getjumlah;
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['idmksp'] = $idkur;
                $data['jumlah'] = $proxy->GetCountRecordset($token,$table,$filter);
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$limit,$offset));echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     // tampilkan isi kurikulum
    public function reloadkurikulum(){
        $data['allkur'] = $this->Import_m->all_kurikulum();
        $this->load->view('admin/import/kurikulum/ajax-kurikulum-v', $data);
    }
    public function mk_kurikulum($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                // server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // jumlah
                $table ='mata_kuliah_kurikulum';
                $order = "";
                $filter ="";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // title
                $data['title'] = 'Import Matakuliah kurikulum';
                $data['page'] = 'admin/import/kurikulum/import-matakuliah-kurikulum-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jmldb'] = $this->Isi_m->jumlah_mata_kuliah_kurikulum();
                // pagging setting
                $data['contoh'] = $getjumlah;
                $jumlah = $this->Isi_m->jumlah_mata_kuliah_kurikulum();
                $config['base_url'] = base_url().'index.php/admin/import/mk_kurikulum/';
                $config['total_rows'] = $getjumlah;
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
                $data['allmk'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset));echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function matakuliah($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                // server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // jumlah
                $table ='mata_kuliah';
                $order = "";
                $filter ="";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // title
                $data['title'] = 'Import Matakuliah kurikulum';
                $data['page'] = 'admin/import/kurikulum/import-matakuliah-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jmldb'] = $this->Isi_m->jumlah_mata_kuliah();
                // pagging setting
                $data['contoh'] = $getjumlah;
                $jumlah = $this->Isi_m->jumlah_mata_kuliah();
                $config['base_url'] = base_url().'index.php/admin/import/matakuliah/';
                $config['total_rows'] = $getjumlah;
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
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset));echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function mata_kuliah($idsms,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                // server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // jumlah
                $table ='mata_kuliah';
                $order = "";
                $filter ="p.id_sms = '{$idsms}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // title
                $data['title'] = 'Import Matakuliah';
                $data['page'] = 'admin/import/kurikulum/import-mata-kuliah-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jmldb'] = $this->Isi_m->jumlah_mata_kuliah_prodi($idsms);
                // pagging setting
                $data['contoh'] = $getjumlah;
                $jumlah = $this->Isi_m->jumlah_mata_kuliah_kurikulum();
                $config['base_url'] = base_url().'index.php/admin/import/mata_kuliah/'.$idsms.'/';
                $config['total_rows'] = $getjumlah;
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
                $data['id_sms'] = $idsms;
                $data['allmk'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset));echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     // tampilkan isi matakuliah kurikulum
    public function reloadmkkur(){
        $data['allmk'] = $this->Import_m->all_mk_kur();
        $this->load->view('admin/import/kurikulum/ajax-mk-kurikulum-v', $data);
    }
    public function kelas_kuliah($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Matakuliah kurikulum';
                $data['page'] = 'admin/import/kelaskuliah/import-kelas-kuliah-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
               // get jumlah data
                $table ='kelas_kuliah';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $data['jmldatabase'] = $this->Import_m->jumlah_kelas_kuliah();
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/kelas_kuliah/';
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
                $data['allmk'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                echo "<pre>";print_r($data['allmk']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function kelas_kuliah_prodi($idsms,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Kelas Kuliah';
                $data['page'] = 'admin/import/kelaskuliah/import-kelas-kuliah-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
               // get jumlah data
                $table ='kelas_kuliah';
                $order = "id_smt desc";
                $filter ="p.id_sms = '{$idsms}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/kelas_kuliah_prodi/'.$idsms.'/';
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
                $data['idprodi'] = $idsms;
                $data['allmk'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['allmk']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function detail_kelas_kuliah($idkls){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Matakuliah kurikulum';
                $data['page'] = 'admin/import/kelaskuliah/import-detail-kelas-kuliah-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
               // get jumlah data
                $table ='nilai';
                $order = "nipd asc";
                $filter ="p.id_kls = '{$idkls}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                //inisialisasi config
                $data['detail'] = $proxy->GetRecord($token,'kelas_kuliah',$filter);
                $data['allmk'] = $proxy->getRecordset($token,$table,$filter,$order);
                // echo "<pre>";print_r($data['allmk']);echo "<pre/>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     public function nilai_mahasiswa($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Nilai Mahasiswa';
                $data['page'] = 'admin/import/nilaimahasiswa/import-nilai-mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='nilai';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['jmldb'] =$this->Import_m->jumlah_nilai_mhs();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/nilai_mahasiswa/';
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
                $data['allnilai'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['allnilai']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }

    public function nilai_mhs_by_smt($smt=0,$offset=0){
        if ($this->ion_auth->logged_in()) {
            if ($this->input->post() == TRUE) {
                $post = $this->input->post();
                $smt = $post['tasmt'];
                $data['tasmt'] = @$smt;
            }
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Nilai Mahasiswa';
                $data['page'] = 'admin/import/nilaimahasiswa/import-nilai-mhs-by-smt-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='nilai';
                $order = '';
                $filter ="id_smt='{$smt}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['jmldb'] =$this->Import_m->jumlah_nilai_mhs();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/nilai_mhs_by_smt/'.$smt.'/';
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
                $data['allnilai'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     public function nilai_mhs_by_prodi($sms,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Import Nilai Mahasiswa';
                $data['page'] = 'admin/import/nilaimahasiswa/import-nilai-mhs-by-smt-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='nilai';
                $order = '';
                $filter ="id_sms='{$sms}'";
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['jmldb'] =$this->Import_m->jumlah_nilai_mhs();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/nilai_mhs_by_smt/'.$smt.'/';
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
                $data['allnilai'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function nilai_mhs($id){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Nilai Matakuliah';
                $data['page'] = 'admin/import/nilaimahasiswa/nilai_mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $table = 'nilai';
                $filter = "p.id_reg_pd = '{$id}'";
                $order ='id_smt asc';
                $limit ='';
                $offest =0;
                $data['npm'] = $id;
                $data['jumlahdata'] = $proxy->GetCountRecordset($token,$table,$filter);
                $data['hasil'] = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
                // echo "<pre>";print_r($data['hasil']);echo "</pre>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    // proses import kelas kuliah mahasiswa
    public function proses_import_kelas_kuliah($id){
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
                // echo "<pre>";print_r($result);echo "</pre>";exit();
                $check = $this->Import_m->cekkelaskuliah($data['id_kls']);
                // echo ($check == true);
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['kode_mk']." - ".$data['fk__id_mk']." Sudah Ada";
                }else{
                    $sukses++;
                    $datamhs = array(
                        'id_kls'      => $data['id_kls'],
                        'semester'      => $data['id_smt'],
                        'kode_mk'      => $data['kode_mk'],
                        'nama_mk' => $data['fk__id_mk'],
                        'nama_kelas' => $data['nm_kls'],
                        'kode_jurusan'      => $this->Import_m->cekprodi($data['id_sms'])->kode_prodi,
                        'sks_mk'      => $data['sks_mk'],
                        'sks_tm'      => $data['sks_tm'],
                        'sks_prak' => $data['sks_prak'],
                        'sks_prak_lap' => $data['sks_prak_lap'],
                        'sks_sim' => $data['sks_sim'],
                        );
                    $this->Import_m->insert_kelas_kuliah($datamhs);
                }
            }
        }
    }
    public function proses_input_nilai_mhs ($npm){
        $data['npm'] = $npm;
        $data['dtpilih'] = $this->input->post('pilih');
        // echo "<pre>";print_r($this->input->post());echo "<pre>";exit();
        $this->load->view('admin/import/nilaimahasiswa/proses-input-nilai-by-mhs-v', $data);
    }
    // proses import nilai mahasiswa
    public function proses_import_nilai($id){
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
                $check = $this->Import_m->ceknilaimhs($data['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['kode_mk']." Sudah Ada";
                }else{
                    $sukses++;
                    if ( substr($data['id_smt'],-1)==1) {
                        $tulang='ganjil';
                    }else{
                        $tulang='genap';
                    }
                    if ($this->Import_m->getidklskul($data['id_kls']) == true) {
                        $idkls = $this->Import_m->getidklskul($data['id_kls'])->id_kelas_kuliah;
                    }else{
                        $idkls = 0;
                    }
                    if ($this->Import_m->getidmhs($data['nipd'])->id_mhs == FALSE) {
                        $idmahasiswa = 0;
                    }else{
                        $idmahasiswa = $this->Import_m->getidmhs($data['nipd'])->id_mhs;
                    }if ($this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah == TRUE) {
                        $idmatakuliah = $this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah;
                    }else{
                        $idmatakuliah = 0;
                    }
                    $datamhs = array(
                        'id_tahun_ajaran'      => $data['id_smt'],
                        'id_semester'      => $data['id_smt'],
                        'id_mhs'      => $idmahasiswa,
                        'id_matakuliah' => $idmatakuliah,
                        'id_kls_fdr' => $data['id_kls'],
                        'id_kls'      => $idkls,
                        'nipd'      => $data['nipd'],
                        'kode_mk'      => $data['kode_mk'],
                        'nilai_mhs' => $data['nilai_indeks'],
                        'nilai_angka' => $data['nilai_angka'],
                        'nilai_huruf' => $data['nilai_huruf'],
                        't_ulang' => $tulang,
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Import_m->insert_khs($datamhs);
                }
            }
        }
    }
    // proses import nilai mahasiswa by tahun ajaran
    public function proses_import_nilai_by_smt($smt,$id){
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
                $check = $this->Import_m->ceknilaimhs($data['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['kode_mk']." Sudah Ada";
                }else{
                    $sukses++;
                    if ( substr($data['id_smt'],-1)==1) {
                        $tulang='ganjil';
                    }else{
                        $tulang='genap';
                    }
                    if ($this->Import_m->getidklskul($data['id_kls']) == true) {
                        $idkls = $this->Import_m->getidklskul($data['id_kls'])->id_kelas_kuliah;
                    }else{
                        $idkls = 0;
                    }
                    $datamhs = array(
                        'id_tahun_ajaran'      => $data['id_smt'],
                        'id_semester'      => $data['id_smt'],
                        'id_mhs'      => $this->Import_m->getidmhs($data['nipd'])->id_mhs,
                        'id_matakuliah' => $this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah,
                        'id_kls_fdr' => $data['id_kls'],
                        'id_kls'      => $idkls,
                        'nipd'      => $data['nipd'],
                        'kode_mk'      => $data['kode_mk'],
                        'nilai_mhs' => $data['nilai_indeks'],
                        'nilai_angka' => $data['nilai_angka'],
                        'nilai_huruf' => $data['nilai_huruf'],
                        't_ulang' => $tulang,
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Import_m->insert_khs($datamhs);
                }
            }
        }
    }
    // porses import nilai mahasiswa by kelas
    public function proses_import_nilai_by_kelas($id){
        $data['perulangan'] = $id;
        $this->load->view('admin/import/nilaimahasiswa/proses-import-nilai-by-kelas-v', $data);
    }
    public function nilai_transfer($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Nilai transfer';
                $data['page'] = 'admin/import/nilaitransfer/import-nilai-transfer-mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='nilai_transfer';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['datadb'] = $this->Isi_m->jumlah_nilai_transfer();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/nilai_transfer/';
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
                $data['allnilai'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['allnilai']);echo "<pre/>";exit();
                // $data['allnilai'] = $this->Import_m->all_nilai_transfer_pagging($config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function dosen($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Dosen';
                $data['page'] = 'admin/import/dosen/import-dosen-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='dosen';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['datadb'] =$this->Isi_m->jumlah_dosen();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/dosen/';
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
                $data['alldosen'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r( $data['alldosen']);echo "<pre/>";exit();
                // $data['allnilai'] = $this->Import_m->all_nilai_transfer_pagging($config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function dosen_pt($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Dosen PT';
                $data['page'] = 'admin/import/dosenpt/import-dosen-pt-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='dosen_pt';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['jmldb'] = $this->Isi_m->jumlah_dosen_pt();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/dosen_pt/';
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
                $data['alldosen'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['alldosen']);echo "<pre/>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function kelas_dosen($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Kelas Dosen';
                $data['page'] = 'admin/import/kelasdosen/import-kelas-dosen-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='ajar_dosen';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['jmldb'] = $this->Isi_m->jumlah_ajar_dosen();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/kelas_dosen/';
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
                $data['allkelas'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['allkelas']);echo "</pre>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function kuliah_mahasiswa($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Aktifitas Kuliah Mahasiswa';
                $data['page'] = 'admin/import/kuliahmahasiswa/import-kuliah-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='kuliah_mahasiswa';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                $data['datadb'] = $this->Isi_m->jumlah_kuliah_mahasiswa();
                // pagging setting
                $data['contoh'] =$getjumlah;
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/kuliah_mahasiswa/';
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
                $data['allaktifitas'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                // echo "<pre>";print_r($data['allaktifitas']);echo "</pre>";exit();
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_import_aktivitas_mhs($id){
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
        $order ='';
        $limit =100;
        $offest =$id;
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
        // perulangan
        foreach ($result['result'] as $data) {
            $check = $this->Import_m->cekaktifmhs($data['id_smt'],$data['nipd']);
            if ($check==true) {
                $error_count++;
                $error[] = $data['nipd']." - ".$data['nm_pd']." - Sudah Ada";
            }else{
                $aktivitas = array(
                    'id_smt' => str_replace(' ', '', $data['id_smt']),
                    'id_reg_pd' => str_replace(' ', '', $data['id_reg_pd']),
                    'id_stat_mhs' => str_replace(' ', '', $data['id_stat_mhs']),
                    'ips' => $data['ips'],
                    'sks_smt' => $data['sks_smt'],
                    'ipk' => $data['ipk'],
                    'sks_total' => $data['sks_total'],
                    'nm_lemb' => $data['nm_lemb'],
                    'mulai_smt' => $data['mulai_smt'],
                    'nipd' => str_replace(' ', '', $data['nipd']),
                    'nm_stat_mhs' => $data['nm_stat_mhs'],
                    'nm_smt' => $data['nm_smt'],
                    'nm_pd' => $data['nm_pd'],
                    'nisn' => $data['nisn'],
                    'jk' => $data['jk'],
                    'id_agama' => $data['id_agama'],
                    'tmpt_lahir' => $data['tmpt_lahir'],
                    'tgl_lahir' => $data['tgl_lahir'],
                    );
                $this->Import_m->insert_aktivitas_mhs($aktivitas);
            }
        }
        foreach ($error as $key) {
            echo $key;
        }
    }
    public function proses_import_nilai_transfer($id){
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
        $order ='';
        $limit =100;
        $offest =$id;
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
        // perulangan
        foreach ($result['result'] as $data) {
            $check = $this->Import_m->ceknilaitrans($data['id_ekuivalensi']);
            if ($check==true) {
                $error_count++;
                $error[] = $data['kode_mk_asal']." - ".$data['nm_mk_asal']." - ".$data['nm_pd']." - Sudah Ada";
            }else{
                $drpd ="p.id_reg_pd='".$data['id_reg_pd']."'";
                $id_pd = $proxy->GetRecord($token,'mahasiswa_pt',$drpd);
                // echo "<pre>";print_r($id_pd);echo "</pre>";exit();
                $trans = array(
                    'id_ekuivalensi' => str_replace(' ', '', $data['id_ekuivalensi']),
                    'id_mk' => str_replace(' ', '', $data['id_mk']),
                    'id_reg_pd' => str_replace(' ', '', $data['id_reg_pd']),
                    'id_pd' =>str_replace(' ', '', $id_pd['result']['id_pd']),
                    'kode_mk_asal' => str_replace(' ', '', $data['kode_mk_asal']),
                    'nm_mk_asal' => $data['nm_mk_asal'],
                    'sks_asal' => $data['sks_asal'],
                    'sks_diakui' => $data['sks_diakui'],
                    'nilai_huruf_asal' =>$data['nilai_huruf_asal'],
                    'nilai_huruf_diakui' => $data['nilai_huruf_diakui'],
                    'nilai_angka_diakui' => $data['nilai_angka_diakui'],
                    'nipd' =>str_replace(' ', '', $data['nipd'])
                );
                $this->Import_m->insert_nilai_transfer($trans);
            }
        }
    }
    public function proses_import_kelas_dosen($baris){
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
        $limit =100;
        $offest = $baris;
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        // setting default count
        $error_count = 0;
        $error = array();
        $sukses = 0;
        // perulngan
        foreach ($result['result'] as $kode) {
             $check = $this->Import_m->cekkelasdosen($kode['id_ajar']);
            if ($check==true) {
                $error_count++;
                $error[]= $kode['fk__id_reg_ptk']." - Sudah ada";
            }else{
                if (!empty($this->Import_m->dosen_id($kode['id_reg_ptk']))) {
                    $dosen_id = $this->Import_m->dosen_id($kode['id_reg_ptk']);
                }else{
                    $getdosen ='dosen_pt';
                    $fil ="p.id_reg_ptk = '{$kode['id_reg_ptk']}'";
                    $hasil = $proxy->GetRecord($token,$getdosen,$fil);
                    $get = $hasil['result'];
                    
                    if (!empty($this->Import_m->get_jurusan($get['id_sms'])->kode_prodi)) {
                        $kodejur2 = $this->Import_m->get_jurusan($get['id_sms'])->kode_prodi;
                    }else{
                        $kodejur2 = 0;
                    }
                    $dosen_id2 = $this->Import_m->get_id_dosen($get['id_sdm'])->id_dosen;
                    $dosen=array(
                        'id_reg_ptk' => str_replace(' ', '', $get['id_reg_ptk']),
                        'id_dosen' => $dosen_id2,
                        'id_sdm' => str_replace(' ', '', $get['id_sdm']),
                        'nm_sdm' => $get['nm_sdm'],
                        'tgl_lahir' => $get['tgl_lahir'],
                        'nik' => str_replace(' ', '', $get['nik']),
                        'id_sp' => str_replace(' ', '', $get['id_sp']),
                        'fk__sp' => $get['fk__sp'],
                        'id_thn_ajaran' => str_replace(' ', '', $get['id_thn_ajaran']),
                        'fk__thn_ajaran' => $get['fk__thn_ajaran'],
                        'id_sms' => str_replace(' ', '', $get['id_sms']),
                        'fk__sms' => $get['fk__sms'],
                        'kode_jurusan' => $kodejur2,
                        'no_srt_tgs' => $get['no_srt_tgs'],
                        'tgl_srt_tgs' => $get['tgl_srt_tgs'],
                        'tmt_srt_tgs' => $get['tmt_srt_tgs'],
                        'id_jns_keluar' => $get['id_jns_keluar'],
                        'fk__jns_keluar' => $get['fk__jns_keluar'],
                        'tgl_ptk_keluar' => $get['tgl_ptk_keluar'],
                    );

                    $this->Import_m->insert_dosen_pt($dosen);
                    $dosen_id = $this->Import_m->dosen_id($kode['id_reg_ptk']);
                }
                if (!empty($this->Import_m->get_jur_id($kode['id_kls'])->kode_jurusan)) {
                    $jur_id = $this->Import_m->get_jur_id($kode['id_kls'])->kode_jurusan;
                    $kodejur = $this->Import_m->get_jurusan_by_sms($jur_id);
                }else{
                    $kodejur = $this->Import_m->prodidefault(1);
                }
                if (!empty($this->Import_m->get_kode_mk($kode['id_kls']))) {
                    $mk_id = $this->Import_m->get_kode_mk($kode['id_kls'])->kode_mk;
                }else{
                    $mk_id = 0;
                }
                $data  = array(
                    'id_dosen' => $dosen_id->id_dosen,
                    'id_jenjang_pend' => $kodejur->id_jenjang_pend,
                    'id_fakultas' => $kodejur->id_fakultas,
                    'id_prodi' => $kodejur->id_prodi,
                    'id_tahun_ajaran' => str_replace(' ', '', $dosen_id->id_thn_ajaran),
                    'id_semester' => str_replace(' ', '', $dosen_id->id_thn_ajaran),
                    'kode_mk' => $mk_id,
                    'nama_dosen' => $kode['fk__id_reg_ptk'],
                    'id_ajar' => str_replace(' ', '', $kode['id_ajar']),
                    'id_reg_ptk' => str_replace(' ', '', $kode['id_reg_ptk']),
                    'fk__id_reg_ptk' => $kode['fk__id_reg_ptk'],
                    'id_subst' => str_replace(' ', '', $kode['id_subst']),
                    'id_kls' => str_replace(' ', '', $kode['id_kls']),
                    'sks_subst_tot' => str_replace(' ', '', $kode['sks_subst_tot']),
                    'sks_tm_subst' => str_replace(' ', '', $kode['sks_tm_subst']),
                    'sks_prak_subst' => str_replace(' ', '', $kode['sks_prak_subst']),
                    'sks_prak_lap_subst' => str_replace(' ', '', $kode['sks_prak_lap_subst']),
                    'sks_sim_subst' => str_replace(' ', '', $kode['sks_sim_subst']),
                    'jml_tm_renc' => str_replace(' ', '', $kode['jml_tm_renc']),
                    'jml_tm_real' => str_replace(' ', '', $kode['jml_tm_real']),
                    'id_jns_eval' => str_replace(' ', '', $kode['id_jns_eval']),
                    'nm_mk' => $kode['nm_mk'],
                    'sks_mk' => $kode['sks_mk'],
                    'nm_kls' => $kode['nm_kls'],
                    );
                // echo "<pre>";print_r($data);echo "</pre>";exit();
                $this->Import_m->insert_ajar_dosen($data);
            }
        }
    }
    public function wilayah($offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $this->load->model('Isi_m');
                $data['title'] = 'Import Wilayah';
                $data['page'] = 'admin/import/wilayah/import-wilayah-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                 // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);
                // get jumlah data
                $table ='wilayah';
                $order = '';
                $filter ='';
                $filter2 = "";
                $jml = $proxy->GetCountRecordset($token,$table,$filter2);
                $getjumlah =$jml['result'];
                // pagging setting
                $data['contoh'] =$getjumlah;
                $data['datadb'] =$this->Isi_m->jumlah_wilayah();
                $jumlah = $getjumlah;
                $config['base_url'] = base_url().'index.php/admin/import/nilai_mahasiswa/';
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
                $data['allnilai'] = $proxy->getRecordset($token,$table,$filter,$order,$config['per_page'],$offset);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>