<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('prodi/Prodi_m');
        $this->load->library('Nusoap_lib');
    }
    function index()
    {
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Pengaturan Tambahan';
                $data['page'] = 'admin/setting/setting-main-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['allprod'] = $this->Prodi_m->allprodi();
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
    public function editkur() {
        $iprod = $this->input->post('id');
        $prodi = $this->Prodi_m->detail_prodi($iprod)->row();
        echo json_encode($prodi);
    }
    public function listkurprod($id){
        $data['dafkur']= $this->Prodi_m->list_kurikulum_by_prodi($id);
        $this->load->view('prodi/ajax-list-kurikulum-prodi-v',$data);
    }
    public function proses_editkur(){
        $id = $this->input->post('id_prodi');
        $kur_id = $this->input->post('id_kurikulum');
        $namakur = $this->Prodi_m->get_nama_kur($kur_id)->nama_kur;
        $data = array('id_kurikulum'=>$kur_id,'nama_kur'=>$namakur);
        $this->Prodi_m->update_kur_prodi($id,$data);
    }
    public function reloadprodi(){
        $data['allprod'] = $this->Prodi_m->allprodi();
        $this->load->view('admin/setting/ajax-reload-prodi-v', $data);
    }
    public function addkaryawan(){
        if ($this->ion_auth->logged_in()){
            // do something here...
            $data['title'] = 'Tambah Karyawan';
            $data['page'] = 'admin/karyawan/add-karyawan-v';
            $data['nav'] = 'nav/nav-admin';
            $data['dtadm'] = $this->ion_auth->user()->row();
            $this->load->view('admin/dashboard-v', $data);
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_add_karyawan(){

        if ($this->ion_auth->logged_in()) {
            $level= array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                
                //validasi
                $this->form_validation->set_rules('namadep', 'Nama depan', 'required');
                $this->form_validation->set_rules('namabel', 'Nama belakang', 'required');
                $this->form_validation->set_rules('username', 'username', 'required');
                $this->form_validation->set_rules('password', 'password', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
                if($this->form_validation->run()===FALSE)
                {
                    $pesan = validation_errors();
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/karyawan'));
                }else{
                // data
                    $post = $this->input->post();
                    $username = $post['username'];
                    $pass = $post['password'];
                    $email = $post['email'];
                    $dtkar = array(
                        'first_name' => $post['namadep'],
                        'last_name' => $post['namabel'],
                        'phone' => $post['phone'],
                        );
                $group = array($this->input->post('group')); // Sets user to admin.
                $this->ion_auth->register($username, $pass, $email, $dtkar, $group);

                // echo "<pre>";
                // print_r($this->input->post('group'));
                // echo "<pre/>";
                // exit();

                $pesan = 'Akun baru '.$post['username'].' berhasil di buat';
                $this->session->set_flashdata('message', $pesan);
                redirect(base_url('index.php/admin/karyawan'));
            }
        }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    // darurat
    function update_mhs_pt()
    {
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'update Mahasiswa PT';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['page'] = 'admin/tes';
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
    function proses_update($id){
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table = 'mahasiswa_pt';
        $order ='';
        $limit =100;
        $offest =$id;
        $filter ='';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        foreach ($result['result'] as $data) {
            $update = array(
            'id_reg_pd' => $data['id_reg_pd']
            );
            $nipd = str_replace(' ', '', $data['nipd']);
            $this->Prodi_m->update_mhs_pt($nipd,$update);
        }
    }
    function proses_import_mhs_lulus($id){
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
        $table = 'mahasiswa_pt';
        $order ='';
        $limit =100;
        $offest =$id;
        $filter ="p.id_jns_keluar ='1'";
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
        foreach ($result['result'] as $data) {
            $kodejurusan = $this->Prodi_m->get_kodejur($data['id_sms'])->kode_prodi;
            $update = array(
            'npm' => str_replace(' ', '', $data['nipd']),
            'kode_jurusan' => $kodejurusan,
            'nama' => strtoupper($data['nm_pd']),
            'id_jenis_keluar' => $data['id_jns_keluar'],
            'tanggal_keluar' => $data['tgl_keluar'],
            'sk_yudisium' => $data['sk_yudisium'],
            'tgl_sk_yudisium' => $data['tgl_sk_yudisium'],
            'ipk' => $data['ipk'],
            'no_seri_ijasah' => $data['no_seri_ijazah'],
            'jalur_skripsi' => $data['jalur_skripsi'],
            'judul_skripsi' => $data['judul_skripsi'],
            'bulan_awal_bimbingan' => $data['bln_awal_bimbingan'],
            'bulan_akhir_bimbingan' => $data['bln_akhir_bimbingan'],
            // 'pembimbing_1' => $data['pembimbing_1'],
            // 'pembimbing_2' => $data['pembimbing_2'],
            'keterangan' => '',
            'stat_feeder' => 1
            );
            // echo "<pre>";print_r($update);echo "</pre>";exit();
            $this->Prodi_m->insert_mhs_lulus($update);
        }
    }
    function validasi_nilai(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Validasi Nilai';
                $data['page'] = 'admin/setting/setting-validasi-nilai-mhs';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['jumlah'] = $this->Prodi_m->jumlah_nilai();
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
    function proses_validasi_nilai($dari){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $hasil = $this->Prodi_m->all_nilai(200,$dari);
                foreach ($hasil as $data) {
                    $cek = $this->Prodi_m->jumlah_nilai_sama(trim($data->nipd),trim($data->id_smt),trim($data->kode_mk));
                    if ($cek !== "1") {
                        foreach ($this->Prodi_m->ambil_nilai_sama(trim($data->nipd),trim($data->id_smt),trim($data->kode_mk),$cek) as $sama) {
                            $this->Prodi_m->delete_nilai($sama->id);
                        }
                    }
                }
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>