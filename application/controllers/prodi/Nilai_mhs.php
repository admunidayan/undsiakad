<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_mhs extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('prodi/Nilai_m');
    }
    function index(){
        if ($this->ion_auth->logged_in()) {
            $post = $this->input->post();  
            $pilih = $this->input->post('pilih');
            foreach ($pilih as $data) {
                $mk = $this->Nilai_m->get_mk($data);
                $remed = $this->Nilai_m->get_remed($data)->tahun;
                $mhs = $this->Nilai_m->get_mhs($post['id_mhs']);
                if ( substr($remed,-1)==1) {
                  $tulang='ganjil';
              }else{
                  $tulang='genap';
              }
                $input = array(
                    'id_matakuliah' => $data,
                    'id_mhs' => $post['id_mhs'],
                    'nipd' => $mhs->npm,
                    'kode_mk' => $mk->kode_matakuliah,
                    't_ulang' => $tulang,
                );
                // echo "<pre>"; print_r($input); echo "</pre>";exit();
                $this->Nilai_m->insert_khs($input);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function edit_nilai(){
        $post = $this->input->post();  
        $data = array(
            'nilai_mhs' => $post['nilai_mhs'],
            'nilai_angka' => $post['nilai_angka'],
            'nilai_huruf' => $post['nilai_huruf']
            );
        $this->Nilai_m->edit_khs($post['id_khs'],$data);
        redirect(base_url('index.php/prodi/mahasiswa/nilaimhs/'.$post['id_mhs']));
    }
    public function delete_nilai($idmhs,$idkhs){
        if ($this->ion_auth->logged_in()) {
            $this->Nilai_m->delete_khs($idkhs);
            redirect(base_url('index.php/prodi/mahasiswa/nilaimhs/'.$idmhs));
        }
    }
}
?>