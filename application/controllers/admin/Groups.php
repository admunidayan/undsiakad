<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('admin/Groups_m');
    }
    function index()
    {
        $level= array('admin');
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Daftar Groups Universitas';
                $data['page'] = 'admin/groups-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['allgrup'] = $this->ion_auth->groups()->result();
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
    public function create() {
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                if (!empty($post)) {
                    $name = $post['name'];
                    $description = $post['description'];
                    $group = $this->ion_auth->create_group($name,$description);
                    if(!$group)
                    {
                        $pesan = $this->ion_auth->messages();
                        $this->session->set_flashdata('message', $pesan );
                        redirect(base_url('index.php/admin/groups'));
                    }
                    else
                    {
                        $pesan = 'Groups '.$name.' berhasil dibuat';
                        $this->session->set_flashdata('message', $pesan );
                        redirect(base_url('index.php/admin/groups'));
                    }
                }
                $pesan = 'Nama dan Deskripsi group kosong';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/groups'));
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit() {
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post();
                if (!empty($post)) {
                    $id = $post['id'];
                    $name = $post['name'];
                    $description = $post['description'];
                    $group = $this->ion_auth->update_group($id,$name,$description);
                    if(!$group)
                    {
                        $pesan = $this->ion_auth->messages();
                        $this->session->set_flashdata('message', $pesan );
                        redirect(base_url('index.php/admin/groups'));
                    }
                    else
                    {
                        $pesan = 'Groups '.$name.' berhasil diubah';
                        $this->session->set_flashdata('message', $pesan );
                        redirect(base_url('index.php/admin/groups'));
                    }
                }
                $pesan = 'Nama dan Deskripsi group kosong';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/groups'));
            }
        }
        else
        {
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }

    public function delete($id) {
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $group = $this->ion_auth->delete_group($id);
                if(!$group){
                    $pesan = $this->ion_auth->messages();
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/groups'));
                }else{
                    $pesan = 'Groups dihapus';
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/groups'));
                }
                $pesan = 'Nama dan Deskripsi group kosong';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/groups'));
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