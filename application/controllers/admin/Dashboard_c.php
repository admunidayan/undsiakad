<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_c extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }
    function index()
    {
        if ($this->ion_auth->logged_in() )
        {  
            $data['title'] = 'Dashboard Fakultas';
            $data['page'] = 'admin/dashboard-main-v';
            $data['nav'] = 'nav/nav-admin';
            $data['dtadm'] = $this->ion_auth->user()->row();
            $this->load->view('admin/dashboard-v', $data);
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