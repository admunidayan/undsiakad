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
    $table ='dosen_pt';
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
    foreach ($result['result'] as $kode) {
        // cek data apakah data sudah ada di dalam database atau belum.
        $check =$this->Dosen_m->cekdosenpt($kode['id_reg_ptk']);
        if ($check==true) {
          $error_count++;
          $error[] = $kode['nm_sdm']." - Sudah Ada";
        }else{
            $kodejur = $this->Dosen_m->get_jurusan($kode['id_sms'])->kode_prodi;
            $dosen_id = $this->Dosen_m->get_id_dosen($kode['id_sdm'])->id_dosen;

            $data = array(
                'id_reg_ptk' => str_replace(' ', '', $kode['id_reg_ptk']),
                'id_dosen' => $dosen_id,
                'id_sdm' => str_replace(' ', '', $kode['id_sdm']),
                'nm_sdm' => $kode['nm_sdm'],
                'tgl_lahir' => $kode['tgl_lahir'],
                'nik' => str_replace(' ', '', $kode['nik']),
                'id_sp' => str_replace(' ', '', $kode['id_sp']),
                'fk__sp' => $kode['fk__sp'],
                'id_thn_ajaran' => str_replace(' ', '', $kode['id_thn_ajaran']),
                'fk__thn_ajaran' => $kode['fk__thn_ajaran'],
                'id_sms' => str_replace(' ', '', $kode['id_sms']),
                'fk__sms' => $kode['fk__sms'],
                'kode_jurusan' => $kodejur,
                'no_srt_tgs' => $kode['no_srt_tgs'],
                'tgl_srt_tgs' => $kode['tgl_srt_tgs'],
                'tmt_srt_tgs' => $kode['tmt_srt_tgs'],
                'id_jns_keluar' => $kode['id_jns_keluar'],
                'fk__jns_keluar' => $kode['fk__jns_keluar'],
                'tgl_ptk_keluar' => $kode['tgl_ptk_keluar']
            );
            $this->Dosen_m->insert_dosen_pt($data);
        }
    }
 ?>