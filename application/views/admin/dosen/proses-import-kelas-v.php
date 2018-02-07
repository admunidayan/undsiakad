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
    $table ='ajar_dosen';
    $order ='';
    $limit ='1';
    $offest = $baris;
    $filter = '';
    $result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
    // setting default count
    $error_count = 0;
    $error = array();
    $sukses = 0;
    // perulngan
    foreach ($result['result'] as $kode) {
         $check = $this->Dosen_m->cekkelasdosen($kode['id_ajar']);
        if ($check==true) {
            $error_count++;
            $error[]= $kode['fk__id_reg_ptk']." - Sudah ada";
        }else{
            $jur_id = $this->Dosen_m->get_jur_id($kode['id_kls'])->kode_jurusan;
            $kodejur = $this->Dosen_m->get_jurusan_by_sms($jur_id);
            if (!empty($this->Dosen_m->dosen_id($kode['id_reg_ptk']))) {
                $dosen_id = $this->Dosen_m->dosen_id($kode['id_reg_ptk']);
            }else{
                $getdosen ='dosen_pt';
                $fil ="p.id_reg_ptk = '{$kode['id_reg_ptk']}'";
                $hasil = $proxy->GetRecord($token,$getdosen,$fil);
                $get = $hasil['result'];
                $kodejur2 = $this->Dosen_m->get_jurusan($get['id_sms'])->kode_prodi;
                $dosen_id2 = $this->Dosen_m->get_id_dosen($get['id_sdm'])->id_dosen;
                $dosen=array(
                    'id_reg_ptk' => str_replace(' ', '', $get['id_reg_ptk']),
                    'id_dosen' => $dosen_id2,
                    'id_sdm' => str_replace(' ', '', $get['id_sdm']),
                    'nm_sdm' => $get['nm_sdm'],
                    'tgl_lahir' => $get['tgl_lahir'],
                    'nik' => str_replace(' ', '', $get['nik']),
                    'id_sp' => str_replace(' ', '', $get['id_sp']),
                    'fk__sp' => $get['fk__sp'],
                    'id_thn_ajaran' => str_replace(' ', '', $get['id_thn_ajaran']),
                    'fk__thn_ajaran' => $get['fk__thn_ajaran'],
                    'id_sms' => str_replace(' ', '', $get['id_sms']),
                    'fk__sms' => $get['fk__sms'],
                    'kode_jurusan' => $kodejur2,
                    'no_srt_tgs' => $get['no_srt_tgs'],
                    'tgl_srt_tgs' => $get['tgl_srt_tgs'],
                    'tmt_srt_tgs' => $get['tmt_srt_tgs'],
                    'id_jns_keluar' => $get['id_jns_keluar'],
                    'fk__jns_keluar' => $get['fk__jns_keluar'],
                    'tgl_ptk_keluar' => $get['tgl_ptk_keluar'],
                );
                $this->Dosen_m->insert_dosen_pt($dosen);
                $dosen_id = $this->Dosen_m->dosen_id($kode['id_reg_ptk']);
            }
            $mk_id = $this->Dosen_m->get_kode_mk($kode['id_kls'])->kode_mk;
            $data  = array(
                'id_dosen' => $dosen_id->id_dosen,
                'id_jenjang_pend' => $kodejur->id_jenjang_pend,
                'id_fakultas' => $kodejur->id_fakultas,
                'id_prodi' => $kodejur->id_prodi,
                'id_tahun_ajaran' => str_replace(' ', '', $dosen_id->id_thn_ajaran),
                'id_semester' => str_replace(' ', '', $dosen_id->id_thn_ajaran),
                'kode_mk' => $mk_id,
                'nama_dosen' => $kode['fk__id_reg_ptk'],
                'id_ajar' => str_replace(' ', '', $kode['id_ajar']),
                'id_reg_ptk' => str_replace(' ', '', $kode['id_reg_ptk']),
                'fk__id_reg_ptk' => $kode['fk__id_reg_ptk'],
                'id_subst' => str_replace(' ', '', $kode['id_subst']),
                'id_kls' => str_replace(' ', '', $kode['id_kls']),
                'sks_subst_tot' => str_replace(' ', '', $kode['sks_subst_tot']),
                'sks_tm_subst' => str_replace(' ', '', $kode['sks_tm_subst']),
                'sks_prak_subst' => str_replace(' ', '', $kode['sks_prak_subst']),
                'sks_prak_lap_subst' => str_replace(' ', '', $kode['sks_prak_lap_subst']),
                'sks_sim_subst' => str_replace(' ', '', $kode['sks_sim_subst']),
                'jml_tm_renc' => str_replace(' ', '', $kode['jml_tm_renc']),
                'jml_tm_real' => str_replace(' ', '', $kode['jml_tm_real']),
                'id_jns_eval' => str_replace(' ', '', $kode['id_jns_eval']),
                'nm_mk' => $kode['nm_mk'],
                'sks_mk' => $kode['sks_mk'],
                'nm_kls' => $kode['nm_kls'],
                );
            $this->Dosen_m->insert_ajar_dosen($data);
        }
    }
    // tes
    // foreach ($result['result'] as $kode) {
    //     $check = $this->Dosen_m->cekkelasdosen($kode['id_ajar']);
    //     if ($check==true) {
    //         $error_count++;
    //         $error[]= $kode['fk__id_reg_ptk']." - Sudah ada";
    //     }else{
    //         $jur_id = $this->Dosen_m->get_jur_id($kode['id_kls'])->kode_jurusan;
    //         $kodejur = $this->Dosen_m->get_jurusan_by_sms($jur_id);
    //         if (!empty($this->Dosen_m->get_id_dosen($kode['id_reg_ptk'])->id_dosen)) {
    //             $dosen_id = $this->Dosen_m->get_id_dosen($kode['id_reg_ptk'])->id_dosen;
    //         }else{
                // $getdosen ='dosen_pt';
                // $fil ="p.id_reg_ptk = '{$kode['id_reg_ptk']}'";
                // $hasil = $proxy->GetRecord($token,$getdosen,$fil);
                // $get = $hasil['result'];
                // $kodejur2 = $this->Dosen_m->get_jurusan($get['id_sms'])->kode_prodi;
                // $dosen_id2 = $this->Dosen_m->get_id_dosen($get['id_sdm'])->id_dosen;
                // $dosen=array(
                //     'id_reg_ptk' => str_replace(' ', '', $get['id_reg_ptk']),
                //     'id_dosen' => $dosen_id2,
                //     'id_sdm' => str_replace(' ', '', $get['id_sdm']),
                //     'nm_sdm' => $get['nm_sdm'],
                //     'tgl_lahir' => $get['tgl_lahir'],
                //     'nik' => str_replace(' ', '', $get['nik']),
                //     'id_sp' => str_replace(' ', '', $get['id_sp']),
                //     'fk__sp' => $get['fk__sp'],
                //     'id_thn_ajaran' => str_replace(' ', '', $get['id_thn_ajaran']),
                //     'fk__thn_ajaran' => $get['fk__thn_ajaran'],
                //     'id_sms' => str_replace(' ', '', $get['id_sms']),
                //     'fk__sms' => $get['fk__sms'],
                //     'kode_jurusan' => $kodejur2,
                //     'no_srt_tgs' => $get['no_srt_tgs'],
                //     'tgl_srt_tgs' => $get['tgl_srt_tgs'],
                //     'tmt_srt_tgs' => $get['tmt_srt_tgs'],
                //     'id_jns_keluar' => $get['id_jns_keluar'],
                //     'fk__jns_keluar' => $get['fk__jns_keluar'],
                //     'tgl_ptk_keluar' => $get['tgl_ptk_keluar'],
                // );
                // $this->Dosen_m->insert_dosen_pt($dosen);
                // $dosen_id = $this->Dosen_m->get_id_dosen($kode['id_reg_ptk'])->id_dosen;
    //         }
    //         $mk_id = $this->Dosen_m->get_kode_mk($kode['id_kls'])->kode_mk;
    //         $data  = array(
    //                 'id_dosen' => $dosen_id,
    //                 'id_jenjang_pend' => $kodejur->id_jenjang_pend,
    //                 'id_fakultas' => $kodejur->id_fakultas,
    //                 'id_prodi' => $kodejur->id_prodi,
    //                 'id_tahun_ajaran' => str_replace(' ', '', $kode['id_tahun_ajaran']),
    //                 'id_semester' => str_replace(' ', '', $kode['id_tahun_ajaran']),
    //                 'kode_mk' => $mk_id,
    //                 'nama_dosen' => $kode['nama_dosen'],
    //                 'id_ajar' => str_replace(' ', '', $kode['id_ajar']),
    //                 'id_reg_ptk' => str_replace(' ', '', $kode['id_reg_ptk']),
    //                 'fk__id_reg_ptk' => $kode['fk__id_reg_ptk'],
    //                 'id_subst' => str_replace(' ', '', $kode['id_subst']),
    //                 'id_kls' => str_replace(' ', '', $kode['id_kls']),
    //                 'sks_subst_tot' => str_replace(' ', '', $kode['sks_subst_tot']),
    //                 'sks_tm_subst' => str_replace(' ', '', $kode['sks_tm_subst']),
    //                 'sks_prak_subst' => str_replace(' ', '', $kode['sks_prak_subst']),
    //                 'sks_prak_lap_subst' => str_replace(' ', '', $kode['sks_prak_lap_subst']),
    //                 'sks_sim_subst' => str_replace(' ', '', $kode['sks_sim_subst']),
    //                 'jml_tm_renc' => str_replace(' ', '', $kode['jml_tm_renc']),
    //                 'jml_tm_real' => str_replace(' ', '', $kode['jml_tm_real']),
    //                 'id_jns_eval' => str_replace(' ', '', $kode['id_jns_eval']),
    //                 'nm_mk' => $kode['nm_mk'],
    //                 'sks_mk' => $kode['sks_mk'],
    //                 'nm_kls' => $kode['nm_kls'],
    //             );
    //         $this->Dosen_m->insert_ajar_dosen($data);
    //     }
    // }
 ?>