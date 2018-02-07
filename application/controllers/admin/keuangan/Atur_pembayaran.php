<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atur_pembayaran extends CI_Controller {

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
                $data['title'] = 'Atur Pembayaran';
                $data['page'] = 'admin/keuangan/list-atur-pembayaran-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['listjenis'] = $this->Keuangan_m->get_jenis_pembayaran();
                $data['angkatan'] = $this->Keuangan_m->getangkatan();
                $data['hasil'] = $this->Keuangan_m->get_atur_pembayaran();
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
                    'id_jenis_pembayaran' => $post['id_jenis_pembayaran'],
                    'kode_angkatan' => $post['kode_angkatan'],
                    'biaya' => $post['biaya']
                );
                $this->Keuangan_m->insert_atur_pembayaran($data);
                $pesan ='Data berhasil di berhasil ditambahkan';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/keuangan/atur_pembayaran'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>