<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelulusan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('prodi/Prodi_m');
        $this->load->model('prodi/Kelulusan_m');
    }
    public function mahasiswa($id){
         // setting data feeder
        $hostname = $this->ion_auth->user()->row()->hostname;
        $port = $this->ion_auth->user()->row()->port;
        $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
        $client = new nusoap_client($url, true);
        $proxy = $client->getProxy();
        $username =$this->ion_auth->user()->row()->userfeeder;
        $pass = $this->ion_auth->user()->row()->passfeeder;
        $token = $proxy->getToken($username, $pass);
    // setting nama table
        $table ='nilai';
        $limit =200;
        $offest =$id;
        $order = '';
        $filter = '';
        $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
        $error_count = 0;
        $error = array();
        $sukses = 0;
    // perulangan
        if (!empty($result['result'])) {
            foreach ($result['result'] as $data) { 
                $check = $this->Import_m->ceknilaimhs($data['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['kode_mk']." Sudah Ada";
                }else{
                    $sukses++;
                    if ( substr($data['id_smt'],-1)==1) {
                        $tulang='ganjil';
                    }else{
                        $tulang='genap';
                    }
                    if ($this->Import_m->getidklskul($data['id_kls']) == true) {
                        $idkls = $this->Import_m->getidklskul($data['id_kls'])->id_kelas_kuliah;
                    }else{
                        $idkls = 0;
                    }
                    if ($this->Import_m->getidmhs($data['nipd'])->id_mhs == FALSE) {
                        $idmahasiswa = 0;
                    }else{
                        $idmahasiswa = $this->Import_m->getidmhs($data['nipd'])->id_mhs;
                    }if ($this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah == TRUE) {
                        $idmatakuliah = $this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah;
                    }else{
                        $idmatakuliah = 0;
                    }
                    $datamhs = array(
                        'id_tahun_ajaran'      => $data['id_smt'],
                        'id_semester'      => $data['id_smt'],
                        'id_mhs'      => $idmahasiswa,
                        'id_matakuliah' => $idmatakuliah,
                        'id_kls_fdr' => $data['id_kls'],
                        'id_kls'      => $idkls,
                        'nipd'      => $data['nipd'],
                        'kode_mk'      => $data['kode_mk'],
                        'nilai_mhs' => $data['nilai_indeks'],
                        'nilai_angka' => $data['nilai_angka'],
                        'nilai_huruf' => $data['nilai_huruf'],
                        't_ulang' => $tulang,
                        );
                    // echo "<pre>";print_r($datamhs);echo "</pre>";exit();
                    $this->Import_m->insert_khs($datamhs);
                }
            }
        }
    }
}
?>