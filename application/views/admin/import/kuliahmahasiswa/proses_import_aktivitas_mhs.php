<?php 
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
    $table ='kuliah_mahasiswa';
    $order ='';
    $limit ='1';
    $offest =$baris;
    $filter = '';
    $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
    $error_count = 0;
    $error = array();
    $sukses = 0;
    // perulangan
   
    foreach ($result['result'] as $data) {

        $check = $this->Import_m->cekaktifmhs($data['id_smt'],$data['nipd']);
        if ($check==true) {
            $error_count++;
            $error[] = $data['nipd']." - ".$data['nm_pd']." - Sudah Ada";
        }else{
            $aktivitas = array(
                'id_smt' => str_replace(' ', '', $data['id_smt']),
                'id_reg_pd' => str_replace(' ', '', $data['id_reg_pd']),
                'id_stat_mhs' => str_replace(' ', '', $data['id_stat_mhs']),
                'ips' => $data['ips'],
                'sks_smt' => $data['sks_smt'],
                'ipk' => $data['ipk'],
                'sks_total' => $data['sks_total'],
                'nm_lemb' => $data['nm_lemb'],
                'mulai_smt' => $data['mulai_smt'],
                'nipd' => str_replace(' ', '', $data['nipd']),
                'nm_stat_mhs' => $data['nm_stat_mhs'],
                'nm_smt' => $data['nm_smt'],
                'nm_pd' => $data['nm_pd'],
                'nisn' => $data['nisn'],
                'jk' => $data['jk'],
                'id_agama' => $data['id_agama'],
                'tmpt_lahir' => $data['tmpt_lahir'],
                'tgl_lahir' => $data['tgl_lahir'],
            );
            $this->Import_m->insert_aktivitas_mhs($aktivitas);
        }
    }
 ?>