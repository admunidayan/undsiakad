<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelulusan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('prodi/Prodi_m');
        $this->load->model('prodi/Kelulusan_m');
    }
    function daftar($id,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level= array('admin','fakultas','prodi');
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                // echo "<pre>"; print_r($post);echo "</pre>";exit();
                $data['title'] = 'Mahasiswa Keluar';
                $data['page'] = 'prodi/kelulusan-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // pagging setting
                $data['contoh'] =$this->Kelulusan_m->jumlah($id,@$post['string']);
                $jumlah = $this->Kelulusan_m->jumlah($id,@$post['string']);
                $config['base_url'] = base_url().'index.php/prodi/kelulusan/daftar/'.$id.'/';
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
                $data['nomor'] = $offset;
                $idprod = $this->Kelulusan_m->get_id_prodi($id)->id_prodi;
                $data['getprod'] = $this->Prodi_m->detail_prodi($idprod)->row();
                $data['hasil'] = $this->Kelulusan_m->searcing_data($config['per_page'],$offset,$id,@$post['string']);
                $data['pagging'] = $this->pagination->create_links();
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