<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jenis_pembayaran extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Keuangan_m');
    }
    public function index(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Daftar Jenis Pembayaran';
                $data['page'] = 'admin/keuangan/list-jenis-pembayaran-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['hasil'] = $this->Keuangan_m->get_jenis_pembayaran();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function create(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                
                $data = array(
                    'nama_jenis_pembayaran' => $post['nama_jenis_pembayaran'],
                    'kode_jenis_pembayaran' => $post['kode_jenis_pembayaran']
                );
                $this->Keuangan_m->insert_jenis_pembayaran($data);
                $pesan = $post['nama_jenis_pembayaran'].' berhasil di berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/keuangan/jenis_pembayaran'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Edit Jenis Pembayaran';
                $data['page'] = 'admin/keuangan/edit-jenis-pembayaran-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['hasil'] = $this->Keuangan_m->detail_jenis_pembayaran($id);
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function proses_edit(){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','keuangan');  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                
                $data = array(
                    'nama_jenis_pembayaran' => $post['nama_jenis_pembayaran'],
                    'kode_jenis_pembayaran' => $post['kode_jenis_pembayaran']
                );
                $id= $post['id_jenis_pembayaran'];
                $this->Keuangan_m->update_jenis_pembayaran($id,$data);
                $pesan = $post['nama_jenis_pembayaran'].' berhasil di berhasil diubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/keuangan/jenis_pembayaran'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>