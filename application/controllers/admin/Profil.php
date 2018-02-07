<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Groups_m');
        $this->load->library('resize');
    }
    function index()
    {
        redirect(base_url('index.php/admin/profil/admin'));
    }
    public function admin() {
        if ($this->ion_auth->logged_in()) {
            $data['title'] = 'Profil - '.$this->ion_auth->user()->row()->first_name;
            $data['page'] = 'admin/profil-v';
            $data['nav'] = 'nav/nav-admin';
            $data['dtadm'] = $this->ion_auth->user()->row();
            $data['gruser'] = $this->Groups_m->grupuser($this->ion_auth->user()->row()->id);
            $this->load->view('admin/dashboard-v', $data);
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

            date_default_timezone_set("Asia/Jakarta");
            $post = $this->input->post();

            $data = array(
              'first_name' => $post['first'],
              'last_name' => $post['last'],
              'username'=> $post['username'],
              'phone' => $post['phone'],
              'email' => $post['email'],
              'hostname' =>strtolower($post['host']),
              'port' => $post['port'],
              'userfeeder' => $post['userfeeder'],
              'passfeeder' => $post['passfeeder'],
              );

            $id = $post['idadm'];
            $file = $this->Groups_m->cek_userimg($id)->row('profile');

            if (!empty($_FILES["profile"]["tmp_name"])) {
                $config['file_name'] = strtolower(url_title("unidayan".'-'.$post['first'].'-'.$post['last'].'-'.date('Ymd').'-'.time('His')));
                $config['upload_path'] = './asset/img/users';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 3072;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile')){
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error );
                    redirect(base_url('index.php/admin/profil/admin'));
                }else{
                    if ($file != "avatar.jpg") {
                        unlink("asset/img/users/$file");
                    }
                    $data['profile'] = $this->upload->data('file_name');
                    $a = $this->upload->data('file_name');
                    $file = "asset/img/users/$a";
                    $resizedFile = "asset/img/users/$a";
                    $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,35 );
                }
            }
            $updateuser = $this->ion_auth->update($id,$data);
            if(!$updateuser){
                $pesan = $this->ion_auth->messages();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/profil/admin'));
            }else{
                $pesan ='Profil anda berhasil di perbarui';
                $this->session->set_flashdata('message', $pesan);
                redirect(base_url('index.php/admin/profil/admin'));
            }
            
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>