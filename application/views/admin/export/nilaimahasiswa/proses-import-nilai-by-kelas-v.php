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
    $table ='kelas_kuliah';
    $tb_nilai ='nilai';
    $order ='';
    $limit ='1';
    $limit_nilai='';
    $offest =$perulangan;
    $offest_nilai ='';
    $filter = '';
    $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // default perhitungan jumlah
    $error_count = 0;
    $error = array();
    $sukses = 0;
    // perulangan
    
    foreach ($result['result'] as $kode) {
        $filter_nilai = "p.id_kls ='{$kode['id_kls']}'";
        $result_nilai = $proxy->getRecordset($token,$tb_nilai,$filter_nilai,$order,$limit_nilai,$offest_nilai);
        
        if (!empty($result_nilai['result'])) {
            foreach ($result_nilai['result'] as $data) { 
                $check = $this->Import_m->ceknilaimhs($kode['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk'],$data['nilai_huruf']);
                if ($check==true) {
                    $error_count++;
                    $error[] = $data['kode_mk']." - ".$data['nm_pd']." Sudah Ada";
                }else{
                    $sukses++;
                    if (!empty($this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah)) {
                        $kodematkul = $this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah;
                    }else{
                        $kodematkul =0;
                    }
                    if ( substr($data['id_smt'],-1)==1) {
                        $tulang='ganjil';
                    }else{
                        $tulang='genap';
                    }
                    
                    $datamhs = array(
                        'id_tahun_ajaran'      => $data['id_smt'],
                        'id_semester'      => $data['id_smt'],
                        'id_mhs'      => $this->Import_m->getidmhs($data['nipd'])->id_mhs,
                        'id_matakuliah' => $kodematkul,
                        'id_kls_fdr' => $kode['id_kls'],
                        'id_kls'      => $this->Import_m->getidklskul($kode['id_kls'])->id_kelas_kuliah,
                        'nipd'      => $data['nipd'],
                        'kode_mk'      => $data['kode_mk'],
                        'nilai_mhs' => $data['nilai_indeks'],
                        'nilai_angka' => $data['nilai_angka'],
                        'nilai_huruf' => $data['nilai_huruf'],
                        't_ulang' => $tulang,
                        );
                    
                    $this->Import_m->insert_khs($datamhs);
                }
            }
        }
    }
 ?>