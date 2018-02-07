<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('fakultas/Fakultas_m');
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
    function update_jml_mhs()
    {
        $level= array('admin','fakultas','prodi');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $allprodi = $this->Prodi_m->allprodi();
                foreach ($allprodi as $data) {
                    $jml = $this->Prodi_m->jumlah_data_mhs($data->kode_prodi);
                    $update = array('jml_mhs_seluruh' => $jml);
                    // echo "<pre>";print_r($update);echo "<pre/>";exit();
                    $this->Prodi_m->update_sms($data->id,$update);
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
    public function dataprodi($id_prodi){
        if ($this->ion_auth->logged_in()) {
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Data Prodi'.' - '.$this->Prodi_m->detail_prodi($id_prodi)->row('nm_lemb');
                $data['page'] = 'prodi/dashboard-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
                $data['dtafk'] = $this->Fakultas_m->getdtfak() ;
                // $data['dtsmstr'] = $this->Fakultas_m->getdtsemester() ;
                $data['dtprod'] = $this->Prodi_m->detail_prodi($id_prodi)->row();
                $data['dtadm'] = $this->ion_auth->user()->row();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function detailprodi($id_prodi){
        if ($this->ion_auth->logged_in()){
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
               $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
               $this->session->set_flashdata('message', $pesan );
               redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Detail Prodi'.' - '.$this->Prodi_m->detail_prodi($id_prodi)->row('nama_prodi');
                $data['page'] = 'prodi/detail-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['dtajp'] = $this->Fakultas_m->getdtjp() ;
                $data['dtafk'] = $this->Fakultas_m->getdtfak() ;
                $data['dtsmstr'] = $this->Fakultas_m->getdtsemester() ;
                $data['mkygblumada'] = $this->Prodi_m->get_matkul_not_in_prod($id_prodi) ;
                $data['getprod'] = $this->Prodi_m->detail_prodi($id_prodi)->row();
                $data['getdtprodmk'] = $this->Prodi_m->getmkprodi($id_prodi);
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