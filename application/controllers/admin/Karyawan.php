<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('fakultas/Karyawan_m');
        $this->load->library('resize');
    }
    function index()
    {
        $level = 'admin';
        if ($this->ion_auth->logged_in() )
        {  
            if (!$this->ion_auth->is_admin()) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Karyawan Fakultas';
                $data['page'] = 'admin/karyawan/karyawan-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                $data['alluser'] = $this->ion_auth->users()->result();
                $data['allgroup'] = $this->ion_auth->groups()->result();
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
    public function edit($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $data['title'] = 'Edit - '.$this->ion_auth->user($id)->row()->username;
                $data['dtadm'] = $this->ion_auth->user()->row();
                if ($this->ion_auth->in_group('admin')) {
                    $data['nav'] = 'nav/nav-admin';
                }else{
                    $data['nav'] = 'nav/nav-members';
                }
                $data['groups'] = $this->ion_auth->groups()->result();
                $data['usergroups'] = array();
                if($usergroups = $this->ion_auth->get_users_groups($id)->result()){
                    foreach($usergroups as $group)
                    {
                        $data['usergroups'][] = $group->id;
                    }
                }
                $data['detail'] = $this->ion_auth->user($id)->row();
                $data['page'] = 'admin/karyawan/edit-karyawan-v';
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin//login'));
        }
    }
    public function proses_edit(){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $id = $this->input->post('id');
                $additional_data = array(
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                    );
                if (!empty($_FILES["profile"]["tmp_name"])) {
                    $config['file_name'] = strtolower(url_title('users'.'-'.$this->input->post('first_name').'-'.date('Ymd').'-'.time('His')));
                    $config['upload_path'] = './asset/img/users/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 2048;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 768;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('profile')){
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('message', $error );
                        redirect(base_url('index.php/admin/users/create'));
                    }
                    else{
                        $file = $this->Karyawan_m->cek_users($id)->profile;
                        if ($file != "avatar.jpg") {
                            unlink("asset/img/users/$file");
                        }
                        $img = $this->upload->data('file_name');
                        $additional_data['profile'] = $img;
                        //file yang akan di resize
                        $file = "asset/img/users/$img";
                        //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
                        $resizedFile = "asset/img/users/$img";
                        $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,100 );
                    }
                }
                $groups = $this->input->post('groups');
                $this->ion_auth->remove_from_group('', $id);
                $this->ion_auth->add_to_group($groups, $id);
                $this->ion_auth->update($id, $additional_data);

                $pesan = 'user '.$this->input->post('username').' Berhasil di edit';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/karyawan'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
}
?>