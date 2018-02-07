<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tahunajaran extends CI_Controller {
  public function __construct()
  {
    parent:: __construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('admin/Ta_m');
  }

  function index(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Pengaturan Tambahan';
                $data['page'] = 'admin/setting/ta-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['allta'] = $this->Ta_m->getdtta();
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
}
