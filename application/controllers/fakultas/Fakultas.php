<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('fakultas/Fakultas_m');
    }
    function index()
    {
        $level= array('admin','fakultas');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Data Fakultas Unidayan';
                $data['page'] = 'fakultas/data-fakultas-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
                $data['dtafk'] = $this->Fakultas_m->getdtfak() ;
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
    public function detailfk($id_fakultas){
        if ($this->ion_auth->logged_in()) {
            $level= array('admin','fakultas');
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Detail Fakultas'.' - '.$this->Fakultas_m->detail_fak($id_fakultas)->row('nama_fakultas');
                $data['page'] = 'fakultas/detail-fakultas-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
                $data['getfak'] = $this->Fakultas_m->detail_fak($id_fakultas)->row();
                $data['getdtprodfak'] = $this->Fakultas_m->getprodfak($id_fakultas);
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