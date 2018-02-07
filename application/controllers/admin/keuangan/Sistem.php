<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sistem extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Keuangan_m');
    }
    function index()
    {
        if ($this->ion_auth->logged_in() )
        {  
            $data['title'] = 'Data Keuangan Mahasiswa';
            $data['page'] = 'admin/keuangan/dashboard-v';
            $data['nav'] = 'nav/nav-admin';
            $data['dtadm'] = $this->ion_auth->user()->row();
            $data['allta'] = $this->Keuangan_m->getdtta();
            $this->load->view('admin/dashboard-v', $data);
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function prodi_by_ta($ta){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Pilih Program Studi';
                $data['page'] = 'admin/keuangan/list-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['allprod'] = $this->Keuangan_m->getprodi();
                $data['thn'] = $ta;
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function listdata($ta,$idprodi){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Jenis Pembayaran';
                $data['page'] = 'admin/keuangan/list-data-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['list'] = $this->Keuangan_m->listkeuangan();
                $data['thn'] = $ta;
                $data['idprod'] = $idprodi;
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function jenisbayar($ta,$idprodi,$idbayar,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                // echo "<pre>"; print_r($post);echo "</pre>";exit();
                $index_ta = $this->Keuangan_m->detailta($ta)->k_index_ta;
                $id_prodi = $this->Keuangan_m->detailprodi($idprodi)->id_prodi;
                $data['title'] = $this->Keuangan_m->detailjnsbayar($idbayar)->nama_jenis_pembayaran.' Mahasiswa Prodi '.$this->Keuangan_m->detailprodi($idprodi)->nama_prodi.' Tahun Ajaran '.$index_ta;
                $data['page'] = 'admin/keuangan/list-mahasiswa-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // pagging setting
                $data['contoh'] =$this->Keuangan_m->jumlah_data_mhs($index_ta,$id_prodi,$idbayar,@$post['string'],@$post['angkatan']);
                $jumlah = $this->Keuangan_m->jumlah_data_mhs($index_ta,$id_prodi,$idbayar,@$post['string'],@$post['angkatan']);
                $config['base_url'] = base_url().'index.php/admin/keuangan/sistem/jenisbayar/'.$ta.'/'.$idprodi.'/'.$idbayar;
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
                // pengaturan searching
                $data['thn'] = $ta;
                $data['kodeprod'] = $idprodi;
                $data['idbyr'] = $idbayar;
                $data['liststatusbyr'] = $this->Keuangan_m->liststatusbayar();
                $data['angkatan'] = $this->Keuangan_m->getangkatan();
                $data['list'] = $this->Keuangan_m->searcing_data($config['per_page'],$offset,$index_ta,$id_prodi,$idbayar,@$post['string'],@$post['angkatan']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
                // old
                // $index_ta = $this->Keuangan_m->detailta($ta)->k_index_ta;
                // $id_prodi = $this->Keuangan_m->detailprodi($idprodi)->id_prodi;
                // $data['title'] = $this->Keuangan_m->detailjnsbayar($idbayar)->nama_jenis_pembayaran.' Prodi '.$this->Keuangan_m->detailprodi($idprodi)->nama_prodi.' Mahasiswa Tahun Ajaran '.$index_ta;
                // $data['page'] = 'admin/keuangan/list-mahasiswa-v';
                // $data['nav'] = 'nav/nav-admin';
                // $data['dtadm'] = $this->ion_auth->user()->row();
                // $data['list'] = $this->Keuangan_m->listmahasiswa($index_ta,$id_prodi,$idbayar);
                // $data['thn'] = $ta;
                // $data['kodeprod'] = $idprodi;
                // $data['idbyr'] = $idbayar;
                // $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function jenisbayarbysts($ta,$idprodi,$idbayar,$sts,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                // echo "<pre>"; print_r($post);echo "</pre>";exit();
                $index_ta = $this->Keuangan_m->detailta($ta)->k_index_ta;
                $id_prodi = $this->Keuangan_m->detailprodi($idprodi)->id_prodi;
                $data['title'] = $this->Keuangan_m->detailjnsbayar($idbayar)->nama_jenis_pembayaran.' Mahasiswa Prodi '.$this->Keuangan_m->detailprodi($idprodi)->nama_prodi.' Tahun Ajaran '.$index_ta;
                $data['page'] = 'admin/keuangan/list-mahasiswa-sts-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // pagging setting
                $data['contoh'] =$this->Keuangan_m->jumlah_data_mhs_sts($index_ta,$id_prodi,$idbayar,$sts,@$post['string'],@$post['angkatan']);
                $jumlah = $this->Keuangan_m->jumlah_data_mhs_sts($index_ta,$id_prodi,$idbayar,$sts,@$post['string'],@$post['angkatan']);
                $config['base_url'] = base_url().'index.php/admin/keuangan/sistem/jenisbayar/'.$ta.'/'.$idprodi.'/'.$idbayar.'/'.$sts;
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
                // pengaturan searching
                $data['thn'] = $ta;
                $data['kodeprod'] = $idprodi;
                $data['idbyr'] = $idbayar;
                $data['liststatusbyr'] = $this->Keuangan_m->liststatusbayar();
                $data['angkatan'] = $this->Keuangan_m->getangkatan();
                $data['list'] = $this->Keuangan_m->searcing_data_sts($config['per_page'],$offset,$index_ta,$id_prodi,$idbayar,$sts,@$post['string'],@$post['angkatan']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
                // old
                // $index_ta = $this->Keuangan_m->detailta($ta)->k_index_ta;
                // $id_prodi = $this->Keuangan_m->detailprodi($idprodi)->id_prodi;
                // $data['title'] = $this->Keuangan_m->detailjnsbayar($idbayar)->nama_jenis_pembayaran.' Prodi '.$this->Keuangan_m->detailprodi($idprodi)->nama_prodi.' Mahasiswa Tahun Ajaran '.$index_ta;
                // $data['page'] = 'admin/keuangan/list-mahasiswa-v';
                // $data['nav'] = 'nav/nav-admin';
                // $data['dtadm'] = $this->ion_auth->user()->row();
                // $data['list'] = $this->Keuangan_m->listmahasiswa($index_ta,$id_prodi,$idbayar);
                // $data['thn'] = $ta;
                // $data['kodeprod'] = $idprodi;
                // $data['idbyr'] = $idbayar;
                // $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function detail_pembayaran($id_mhs){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Detail Pembayaran Mahasiswa '.$this->Keuangan_m->detail_mhs($id_mhs)->nama_mhs;
                $data['page'] = 'admin/keuangan/list-pembayaran-mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['list'] = $this->Keuangan_m->list_pembayaran_mhs($id_mhs);
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit_pembayaran($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Edit Pembayaran';
                $data['page'] = 'admin/keuangan/edit-pembayaran-mhs-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['hasil'] = $this->Keuangan_m->edit_pembayaran_mhs($id);
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_edit_pembayaran(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                $harusbyr = $this->Keuangan_m->get_atur_bayar($post['id_atur_pembayaran'])->biaya;
                if ($post['jumlah_bayar'] == 0) {
                    $bayar = 1;
                }else if ($post['jumlah_bayar'] !== 0 && $harusbyr - $post['jumlah_bayar'] >= 0 && $post['jumlah_bayar'] < $harusbyr ) {
                    $bayar = 2;
                }else if($post['jumlah_bayar'] == $harusbyr){
                    $bayar = 3;
                }else{
                    $bayar = 1;
                }
                $data = array(
                    'jumlah_bayar' => $post['jumlah_bayar'],
                    'status_bayar' => $bayar,
                );
                $id=$post['id_pembayaran_mhs'];
                $this->Keuangan_m->proses_edit_pembayaran($id,$data);
                $pesan = 'data berhasil di ubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/keuangan/sistem/detail_pembayaran/'.$post['id_mhs']));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function tambahmhs($ta,$idprodi,$idbayar){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $index_ta = $this->Keuangan_m->detailta($ta)->k_index_ta;
                $id_prodi = $this->Keuangan_m->detailprodi($idprodi)->id_prodi;
                $list = $this->Keuangan_m->get_mhs_aktif_by_prodi($id_prodi);
                // echo "<pre>";print_r($list);echo "<pre/>";exit();
                foreach ($list as $data) {
                    if (!empty($this->Keuangan_m->get_atur_bayar_by_angkatan($data->angkatan,$idbayar)->id_atur_pembayaran)) {
                        $idatur = $this->Keuangan_m->get_atur_bayar_by_angkatan($data->angkatan,$idbayar)->id_atur_pembayaran;
                    }else{
                        $idatur = 99 ;
                    }
                    $mhs = array(
                        'id_mhs' => $data->id_mhs,
                        'id_jenis_pembayaran' => $idbayar,
                        'id_atur_pembayaran' => $idatur,
                        'k_index_ta' => $index_ta,
                        'status_bayar' => 1,
                        'jumlah_bayar' => 0
                    );
                    $this->Keuangan_m->insert_pbyr_by_prod($mhs);
                }
                $pesan = 'suskses';
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/keuangan/sistem/jenisbayar/'.$ta.'/'.$idprodi.'/'.$idbayar));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>