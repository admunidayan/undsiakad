<?php
$hostname = $this->ion_auth->user()->row()->hostname;
$port = $this->ion_auth->user()->row()->port;
$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
$client = new nusoap_client($url, true);
$proxy = $client->getProxy();
$username =$this->ion_auth->user()->row()->userfeeder;
$pass = $this->ion_auth->user()->row()->passfeeder;
$token = $proxy->getToken($username, $pass);
$table = 'nilai';
$order ='';

$error_count = 0;
$error = array();
$sukses = 0;

if (!empty($dtpilih)) {
  foreach ($dtpilih as $kode) {

    $filter = "nipd ilike '%{$npm}%' and p.id_kls = '{$kode}'";
    $result = $proxy->getRecord($token,$table,$filter); 

    if (!empty($this->Import_m->getidklskul($kode)->id_kelas_kuliah)) {
      $idkelkul = $this->Import_m->getidklskul($kode)->id_kelas_kuliah;
    }else{
      $idkelkul =0;
    }
    if (!empty($this->Import_m->getidmkby($result['result']['kode_mk'])->id_matakuliah)) {
      $kodematkul = $this->Import_m->getidmkby($result['result']['kode_mk'])->id_matakuliah;
    }else{
      $kodematkul =0;
    }
    if ( substr($result['result']['id_smt'],-1)==1) {
      $tulang='ganjil';
    }else{
      $tulang='genap';
    }
    $check =$this->Import_m->cek_nilai_mhs($kode,$npm,$result['result']['id_smt'],$result['result']['kode_mk']);
    if ($check==true) {
      $error_count++;
      $error[] = $kode." - Sudah Ada";
    }else{
      $sukses++;
      $data = array(
        'id_tahun_ajaran'      => $result['result']['id_smt'],
        'id_semester'      => $result['result']['id_smt'],
        'id_mhs'      => $this->Import_m->getidmhs($npm)->id_mhs,
        'id_matakuliah' => $kodematkul,
        'id_kls_fdr' => $kode,
        'id_kls'      => $idkelkul,
        'nipd'      => $npm,
        'kode_mk'      => $result['result']['kode_mk'],
        'nilai_mhs' => $result['result']['nilai_indeks'],
        'nilai_angka' => $result['result']['nilai_angka'],
        'nilai_huruf' => $result['result']['nilai_huruf'],
        't_ulang' => $tulang,
        );
      // echo "<pre>";print_r($data);echo "</pre>";exit();
      $this->Import_m->insert_khs($data);
    }
  }
}
;?>