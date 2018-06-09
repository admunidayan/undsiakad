<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('Nusoap_lib');
        $this->load->model('fakultas/Fakultas_m');
        $this->load->model('prodi/Prodi_m');
        $this->load->model('prodi/Mahasiswa_m');
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
    public function mhsprodi($idpd,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                // $id = $this->Mahasiswa_m->get_prodi($idpd)->kode_prodi;
                $post = $this->input->get();
                // echo "<pre>"; print_r($post);echo "</pre>";exit();
                $data['title'] = 'Data Mahasiswa Program Studi';
                $data['page'] = 'prodi/data-mhs-by-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $jumlah = $this->Prodi_m->count_mhs_prod($idpd,@$post['string'],@$post['angkatan']);
                $config['base_url'] = base_url().'index.php/prodi/mahasiswa/mhsprodi/'.$idpd.'/';
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '20';
                $config["uri_segment"] = 5;
                // $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = 2;
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
                // pengaturan searching
                $data['jmlmhs'] = $jumlah;
                $data['nmr'] = $offset;
                $data['getprod'] = $this->Prodi_m->detail_prodi($idpd)->row();
                $data['dtmhsprd'] = $this->Mahasiswa_m->searcing_data2($config['per_page'],$offset,$idpd,@$post['string'],@$post['angkatan']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function prodi($idpd,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
               
                // $id = $this->Mahasiswa_m->get_prodi($idpd)->kode_prodi;
                $post = $this->input->get();
                // echo "<pre>"; print_r($post);echo "</pre>";exit();
                $data['title'] = 'Data Mahasiswa Program Studi';
                $data['page'] = 'prodi/data-mhs-by-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $config['base_url'] = base_url().'index.php/prodi/mahasiswa/prodi/'.$idpd;
                $config['total_rows'] = 956;
                $config['per_page'] = '20';
                
                //inisialisasi config
                $this->pagination->initialize($config);
                $data['pagging'] = $this->pagination->create_links();
                $data['getprod'] = $this->Prodi_m->detail_prodi($idpd)->row();
                $data['dtmhsprd'] = $this->Mahasiswa_m->searcing_data2($config['per_page'],$from,$idpd);
                // echo "<pre>"; print_r($data['dtmhsprd']);echo "</pre>";exit();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
     function detailmhs($id_mhs){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = ucwords(strtolower($this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('nm_pd')));
                $data['page'] = 'prodi/detail-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['dtta'] = $this->Fakultas_m->getdtta() ;
                $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
                $data['dtafk'] = $this->Fakultas_m->getdtfak() ;
                $data['dtaprod'] = $this->Prodi_m->allprodi() ;
                // $data['dtsmstr'] = $this->Fakultas_m->getdtsemester() ;
                $data['dttgl'] = $this->Mahasiswa_m->listjnstgl();
                $data['listagama'] = $this->Mahasiswa_m->agama() ;
                $data['getmhs'] = $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row();
                // echo "<pre>";print_r($data['getmhs']);echo "<pre/>";exit();
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
    function nilaimhs($id_mhs){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $detail = $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row();
                $data['title'] = ucwords(strtolower($detail->nm_pd));
                $data['page'] = 'prodi/nilai-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // $data['dtkhs'] = $this->Mahasiswa_m->get_matkul_all_khs($id_mhs);
                $data['getmhs'] = $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row();
                $id_reg = $detail->nipd;
                // echo "<pre>";print_r($id_reg);echo "<pre/>";exit();
                $data['khsmhs'] = $this->Mahasiswa_m->get_khs_mhs2($detail->idmhs);
                // echo "<pre>";print_r($data['khsmhs']);echo "<pre/>";exit();
                // $data['mkblumada'] = $this->Mahasiswa_m->get_matkul_not_in_khs(
                //   $id_mhs,
                //   $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('id_fakultas'),
                //   $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('id_prodi')
                //   ) ;
                
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
    function nilai_transfer_mhs($npm){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = ucwords(strtolower($this->Mahasiswa_m->detail_mahasiswa_npm($npm)->row('nama_mhs')));
                $data['page'] = 'prodi/nilai-transfer-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['getmhs'] = $this->Mahasiswa_m->detail_mahasiswa_npm($npm)->row();
                $data['nilai'] = $this->Mahasiswa_m->get_nilai_trans_mhs($npm);
                //
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
    public function tampilmk(){
        $nama = $this->input->post('kirimNama');
        $data['hasil_limit']=$this->Mahasiswa_m->tampil_dosen_limit($nama);
        if($nama!=""){

            foreach($data['hasil_limit']->result() as $result)
            {
                echo '<a class="list-group-item" onClick="pilih(\''.$result->id_mk.'\');">
                <b>'.$result->kode_matakuliah.'</b> - '.$result->nama_matakuliah.'</a>';
            }
        }else{
           echo "error";        
       }
    }
    public function proses_add_mktrans(){
        $post = $this->input->post();
        $sksakui = $this->Mahasiswa_m->sksakui($post['id_mk'])->jumlah_sks;
        $data = array(
            'id_mk' => $post['id_mk'],
            'kode_mk_asal' => $post['kode_mk_asal'],
            'nm_mk_asal' => $post['nm_mk_asal'],
            'sks_asal' => $post['sks_asal'],
            'sks_diakui' => $sksakui,
            'nilai_huruf_asal' => $post['nilai_huruf_asal'],
            'nilai_huruf_diakui' => $post['nilai_huruf_diakui'],
            'nilai_angka_diakui' => $post['nilai_angka_diakui'],
            'nipd' => $post['nipd'],
        );
        // echo "<pre>";print_r($data);echo "<pre>";exit();
        $this->Mahasiswa_m->insert_nilai_transfer($data);
        $pesan = 'Nilai Konversi Baru Berhasil di tambahkan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/prodi/mahasiswa/nilai_transfer_mhs/'.$post['nipd']));
    }
     public function edit_koversi_nilai($npm,$id){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = ucwords(strtolower($this->Mahasiswa_m->detail_mahasiswa_npm($npm)->row('nama_mhs')));
                $data['page'] = 'prodi/edit-nilai-transfer-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['getmhs'] = $this->Mahasiswa_m->detail_mahasiswa_npm($npm)->row();
                $data['hasil'] = $this->Mahasiswa_m->data_nilai_transfer($id);
                //
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
    public function proses_edit_mktrans(){
        $post = $this->input->post();
        $sksakui = $this->Mahasiswa_m->sksakui($post['id_mk'])->jumlah_sks;
        $id = $post['id_nilai_transfer'];
        $data = array(
            'id_mk' => $post['id_mk'],
            'kode_mk_asal' => $post['kode_mk_asal'],
            'nm_mk_asal' => $post['nm_mk_asal'],
            'sks_asal' => $post['sks_asal'],
            'sks_diakui' => $sksakui,
            'nilai_huruf_asal' => $post['nilai_huruf_asal'],
            'nilai_huruf_diakui' => $post['nilai_huruf_diakui'],
            'nilai_angka_diakui' => $post['nilai_angka_diakui'],
            'nipd' => $post['nipd'],
        );
        // echo "<pre>";print_r($data);echo "<pre>";exit();
        $this->Mahasiswa_m->update_nilai_transfer($id,$data);
        $pesan = 'Nilai Konversi berhasil di edit';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/prodi/mahasiswa/nilai_transfer_mhs/'.$post['nipd']));
    }
    public function delete_nilai_transfer($npm,$id){
        if ($this->ion_auth->logged_in()) {
            $this->Mahasiswa_m->delete_nilai_transfer($id);
            $pesan = 'Nilai Konversi di Hapus';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/prodi/mahasiswa/nilai_transfer_mhs/'.$npm));
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function tampilnilaimk($id){
        $data['khsmhs'] = $this->Mahasiswa_m->get_khs_mhs2($id);
        $this->load->view('prodi/ajax-nilai-mahasiswa-v', $data);
    }
    public function tampilmknotkhsmhs($id_mhs){
        $data['mkblumada'] = $this->Mahasiswa_m->get_matkul_not_in_khs(
          $id_mhs,
          $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('id_fakultas'),
          $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('id_prodi')
          ) ;
        $this->load->view('prodi/ajax-mk-not-khs-mhs-v', $data);
    }
    public function editnilaimkmhs() {
        $idkhs = $this->input->post('id_khs');
        $khs = $this->Mahasiswa_m->get_detail_khs($idkhs);
        echo json_encode($khs);
    }
    public function cari($id){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                if (!empty($this->input->post('term'))) {
                    $data['title'] = 'Cari- Mahasiswa';
                    $data['page'] = 'prodi/cari-mahasiswa-v';
                    $data['nav'] = 'nav/nav-admin';
                    $data['dtadm'] = $this->ion_auth->user()->row();
                    $cari = $this->input->post('term');
                    $data['dtmhs'] = $this->Mahasiswa_m->carimhs($id,$cari);
                    $data['getprod'] = $this->Prodi_m->detail_prodi($id)->row();
                }else{
                    $pesan = 'masukan npm atau nama terlebih dahulu';
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/prodi/mahasiswa/mhsprodi/'.$id));
                }
                //
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
    public function autocompletecari($id) {
       $q=$this->input->post('term');
       $data['response'] = 'false';

       $query = $this->Mahasiswa_m->lookup($id,$q);
       if (!empty($query)) {
           $data['response'] = 'true';
           $data['message'] = array();
           foreach ($query as $row) {
               $data['message'][] = array('label'=>$row->npm,'value'=>$row->nama_mhs);
           }
           echo json_encode($data);
       }
    }
    function aktivitas($id_mhs){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $nipd=$this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('idmhs');
                $data['title'] ='Aktivitas Kuliah '.ucwords(strtolower($this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row('nama_mhs')));
                $data['page'] = 'prodi/aktivitas-mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['smtmhs'] = $this->Mahasiswa_m->semester();
                $data['stat'] = $this->Mahasiswa_m->stat_mhs();
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['hasil'] = $this->Mahasiswa_m->get_aktivitas_mhs($nipd);
                $data['getmhs'] = $this->Mahasiswa_m->detail_mahasiswa($id_mhs)->row();
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
    function proses_add_akt(){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                $stat = $this->Mahasiswa_m->get_stat_mhs($post['id_stat_mhs'])->nm_stat_mhs;
                $data = array(
                    'id_smt' => $post['id_smt'],
                    'id_reg_pd' => $post['id_reg_pd'],
                    'id_stat_mhs' => $post['id_stat_mhs'],
                    'ips' => $post['ips'],
                    'sks_smt' => $post['sks_smt'],
                    'ipk' => $post['ipk'],
                    'sks_total' => $post['sks_total'],
                    'nm_lemb' => $post['nm_lemb'],
                    'mulai_smt' => $post['mulai_smt'],
                    'nipd' => $post['nipd'],
                    'nm_stat_mhs' => $stat,
                    'nm_pd' => $post['nm_pd'],
                    'nisn' => 0,
                    'jk' => $post['jk'],
                    'id_agama' => $post['id_agama'],
                    'tmpt_lahir' => $post['tmpt_lahir']
                );
                // echo "<pre>";print_r($data);echo "</pre>";
                $this->Mahasiswa_m->insert_aktifitas($data);
                $pesan = 'Aktifitas Baru berhasil ditembahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/mahasiswa/aktivitas/'.$post['id_mhs']));
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function get_id_mhs($sms){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $mahasiswa = $this->Mahasiswa_m->get_mhs_by_prodi($sms);
                foreach ($mahasiswa as $data){
                    $idmhs = $this->Mahasiswa_m->id_mhs_get($data->id_pd)->id;
                    $dtid = array('id_mhs' => $idmhs);
                    $this->Mahasiswa_m->Update_mahasiswa_pt($data->id_pd,$dtid);
                }
                
                $pesan = 'Aktifitas Baru berhasil ditembahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/mahasiswa/aktivitas/'.$post['id_mhs']));
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function proses_edit_mahasiswa(){
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                // echo "<pre>";print_r($post);echo "</pre>";exit();
                $data = array(
                    'nm_pd'      => $post['nm_pd'],
                    'jk'      => $post['jk'],
                    'jln' => $post['jln'],
                    'rt' => $post['rt'],
                    'rw'      => $post['rw'],
                    'nm_dsn'      => $post['nm_dsn'],
                    'ds_kel'      => $post['ds_kel'],
                    'kode_pos' => $post['kode_pos'],
                    'nisn' => $post['nisn'],
                    'nik' => $post['nik'],
                    'tmpt_lahir' => $post['tmpt_lahir'],
                    'tgl_lahir' => $post['tgl_lahir'],
                    'nm_ayah' => $post['nm_ayah'],
                    'tgl_lahir_ayah' => $post['tgl_lahir_ayah'],
                    'nik_ayah' => $post['nik_ayah'],
                    'id_jenjang_pendidikan_ayah' => $post['id_jenjang_pendidikan_ayah'],
                    'id_pekerjaan_ayah' => $post['id_pekerjaan_ayah'],
                    'id_penghasilan_ayah' => $post['id_penghasilan_ayah'],
                    'nm_ibu_kandung' => $post['nm_ibu_kandung'],
                    'tgl_lahir_ibu' => $post['tgl_lahir_ibu'],
                    'nik_ibu' => $post['nik_ibu'],
                    'id_jenjang_pendidikan_ibu' => $post['id_jenjang_pendidikan_ibu'],
                    'id_pekerjaan_ibu' => $post['id_pekerjaan_ibu'],
                    'id_penghasilan_ibu' => $post['id_penghasilan_ibu'],
                    'nm_wali' => $post['nm_wali'],
                    'tgl_lahir_wali' => $post['tgl_lahir_wali'],
                    'id_jenjang_pendidikan_wali' => $post['id_jenjang_pendidikan_wali'],
                    'id_pekerjaan_wali' => $post['id_pekerjaan_wali'],
                    'id_penghasilan_wali' => $post['id_penghasilan_wali'],
                    'id_kk' => $post['id_kk'],
                    'no_tel_rmh' => $post['no_tel_rmh'],
                    'no_hp' => $post['no_hp'],
                    'email' => $post['email'],
                    'a_terima_kps' => $post['a_terima_kps'],
                    'no_kps' => $post['no_kps'],
                    'npwp' => $post['npwp'],
                    'id_wil' => $post['id_wil'],
                    'id_jns_tinggal' => $post['id_jns_tinggal'],
                    'id_agama' => $post['id_agama'],
                );
                // echo "<pre>";print_r($data);echo "</pre>";exit();
                $this->Mahasiswa_m->update_mahasiswa($post['id'],$data);
                $pesan = 'Data '.$post['nm_pd'].' berhasil disimpan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/prodi/mahasiswa/detailmhs/'.$post['nipd']));
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