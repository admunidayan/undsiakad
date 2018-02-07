<div class="unirow" id="mainpage">
  <?php $this->load->view('nav/nav-dosen-detail') ?>
  <div class="col-md-10 unipd">
    <div class="whitebox2 bts-ats fk-min">
      <div class="prfbox">
        <div class="bgbox">
          <form action="<?php echo base_url('index.php/admin/profil/edit'); ?>" method="post" enctype="multipart/form-data">
            <div class="bguser">
              <img src="<?php echo base_url('asset/img/bg/bg3.png'); ?>" width="100%">
              <div class="editbox-left"><?php echo ucfirst($detail->nama_dosen); ?></div>
            </div>
            <div class="dpbox">
              <div class="dpname">
                <div class="dpkot">
                  <?php if (!empty($detail->foto_profil_dosen)): ?>
                    <img class="dpimg" id="preview" src="<?php echo base_url('asset/img/users/'); ?><?php echo $detail->foto_profil_dosen; ?>" width="100%">
                  <?php else: ?>
                    <img class="dpimg" id="preview" src="<?php echo base_url('asset/img/users/avatar.png'); ?>" width="100%">
                  <?php endif ?>
                  <label for="inputimg" class="editbox" style="border-radius:50%;padding: 14px 17px;">
                    <input type="file" id="inputimg" class="inputfile" name="profile">
                    <i class="fa fa-camera"></i>
                  </label>
                </div>
                <h3 class="tengah"><?php echo ucwords(strtolower($detail->nama_dosen)); ?></h3>
                <h6 class="tengah"><i class="fa fa-envelope-o"></i> <?php echo ucfirst($detail->email_dosen); ?></h6>
                <h6 class="tengah"><i class="fa fa-mobile"></i> <?php echo ucfirst($detail->npp); ?></h6>
              </div>
            </div>
          </form>
          <div class="bts-ats">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#pribadi" class="txtabu" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user-circle-o"></i> Data Pribadi</a></li>
              <li role="presentation"><a href="#ortu" class="txtabu" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user-md"></i> Data 1</a></li>
              <li role="presentation"><a href="#wali" class="txtabu" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Data 2</a></li>
              <li role="presentation"><a href="#pendidikan" class="txtabu" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Data 3</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="pribadi">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <!-- mulai -->
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_dosen" placeholder="Nama Mahasiswa" value="<?php echo $detail->nama_dosen ?>">
                      </div>
                      <fieldset disabled>
                        <div class="form-group form-group-lg bts-ats">
                          <label>Nomor Pokok</label>
                          <input type="text" class="form-control" placeholder="Nama Mahasiswa" value="<?php echo $detail->npp ?>">
                        </div>
                      </fieldset>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $detail->username ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_dosen" placeholder="Email" value="<?php echo $detail->email_dosen ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="no_hp_dosen" placeholder="Nomor Handphone Dosen" value="<?php echo $detail->no_hp_dosen ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>No Telepon Rumah</label>
                        <input type="text" class="form-control" name="no_hp_dosen" placeholder="Nomor Nomor Rumah Dosen" value="<?php echo $detail->no_tel_rmh ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Gender</label>
                        <input type="text" class="form-control" name="gender_dosen" placeholder="Jenis Kelamin" value="<?php echo $detail->gender_dosen ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tgl_lhr_dosen" placeholder="Tanggal Lahir Mahasiswa" value="<?php echo $detail->tgl_lhr_dosen ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tmpt_lahir" placeholder="Tempat Lahir" value="<?php echo $detail->tempat_lahir ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="id_kk" placeholder="id_kk" value="<?php echo $detail->nip ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="rt" placeholder="RT" value="<?php echo $detail->nik ?>">
                      </div>
                      <!-- end -->
                    </div>
                    <div class="col-md-6">
                      <!-- start -->
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control" name="kode_pos" placeholder="Kode Ppost" value="<?php echo $detail->kode_pos ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>NIY NIGK</label>
                        <input type="text" class="form-control" name="niy_nigk" placeholder="NIY NIGK" value="<?php echo $detail->niy_nigk ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NUPTK</label>
                        <input type="text" class="form-control" name="nuptk" placeholder="NUPTK" value="<?php echo $detail->nuptk ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Status Pegawai</label>
                        <input type="text" class="form-control" name="fk__stat_pegawai" placeholder="Status Pegawai" value="<?php echo $detail->fk__stat_pegawai ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Jenis PTK</label>
                        <input type="text" class="form-control" name="fk__jns_ptk" placeholder="Jenis PTK" value="<?php echo $detail->fk__jns_ptk ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>RT</label>
                        <input type="text" class="form-control" name="rt" placeholder="RT" value="<?php echo $detail->rt ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>RW</label>
                        <input type="text" class="form-control" name="rw" placeholder="RW" value="<?php echo $detail->rw ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>DUSUN</label>
                        <input type="text" class="form-control" name="nm_dsn" placeholder="terima KPS" value="<?php echo $detail->nm_dsn ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Desa Kel</label>
                        <input type="text" class="form-control" name="ds_kel" placeholder="Desa kel" value="<?php echo $detail->ds_kel ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Wilayah</label>
                        <input type="text" class="form-control" name="id_wil" placeholder="Wilayah" value="<?php echo $detail->id_wil ?>">
                      </div>
                      <!-- end -->
                    </div>
                  </div>
                </form>
              </div>
              <div role="tabpanel" class="tab-pane" id="ortu">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group form-group-lg bts-ats2">
                      <label>SP</label>
                      <input type="text" class="form-control" name="fk__sp" placeholder="SP" value="<?php echo $detail->fk__sp ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>Stat Aktif</label>
                      <input type="text" class="form-control" name="fk__stat_aktif" placeholder="Stat Aktif" value="<?php echo $detail->fk__stat_aktif ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>SK CPNS</label>
                      <input type="text" class="form-control" name="sk_cpns" placeholder="SK CPNS" value="<?php echo $detail->sk_cpns ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>TGL SK CPNS</label>
                      <input type="text" class="form-control" name="tgl_sk_cpns" placeholder="TGL SK CPNS" value="<?php echo $detail->tgl_sk_cpns ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>SK ANGKAT</label>
                      <input type="text" class="form-control" name="sk_angkat" placeholder="sk_angkat" value="<?php echo $detail->sk_angkat ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>TMT K ANGKAT</label>
                      <input type="text" class="form-control" name="tmt_sk_angkat" placeholder="TMT SK ANGKAT" value="<?php echo $detail->tmt_sk_angkat ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>Lembaga</label>
                      <input type="text" class="form-control" name="fk__lemb_angkat" placeholder="fk__lemb_angkat" value="<?php echo $detail->fk__lemb_angkat ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>Golongan</label>
                      <input type="text" class="form-control" name="fk__pangkat_gol" placeholder="fk__pangkat_gol" value="<?php echo $detail->sk_angkat ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>Keahlian Lab</label>
                      <input type="text" class="form-control" name="fk__keahlian_lab" placeholder="fk__keahlian_lab" value="<?php echo $detail->fk__keahlian_lab ?>">
                    </div>
                    <!-- end -->
                  </div>
                  <div class="col-md-6">
                    <div class="form-group form-group-lg bts-ats">
                      <label>fk__sumber_gaji</label>
                      <input type="text" class="form-control" name="fk__sumber_gaji" placeholder="fk__sumber_gaji" value="<?php echo $detail->fk__sumber_gaji ?>">
                    </div>
                    <div class="form-group form-group-lg bts-ats">
                      <label>id_sumber_gaji</label>
                      <input type="text" class="form-control" name="id_sumber_gaji" placeholder="id_sumber_gaji" value="<?php echo $detail->id_sumber_gaji ?>">
                    </div>
                    <!-- end -->
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="wali">
                <div class="row">
                  <div class="col-md-6">
                   <div class="form-group form-group-lg bts-ats">
                    <label>nm_ibu_kandung</label>
                    <input type="text" class="form-control" name="nm_ibu_kandung" placeholder="nm_ibu_kandung" value="<?php echo $detail->nm_ibu_kandung ?>">
                  </div>
                   <div class="form-group form-group-lg bts-ats">
                    <label>stat_kawin</label>
                    <input type="text" class="form-control" name="stat_kawin" placeholder="stat_kawin" value="<?php echo $detail->stat_kawin ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>nm_suami_istri</label>
                    <input type="text" class="form-control" name="nm_suami_istri" placeholder="nm_suami_istri" value="<?php echo $detail->nm_suami_istri ?>">
                  </div>
                   <div class="form-group form-group-lg bts-ats">
                    <label>nip_suami_istri</label>
                    <input type="text" class="form-control" name="nip_suami_istri" placeholder="nip_suami_istri" value="<?php echo $detail->nip_suami_istri ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>id_pekerjaan_suami_istri</label>
                    <input type="text" class="form-control" name="id_pekerjaan_suami_istri" placeholder="id_pekerjaan_suami_istri" value="<?php echo $detail->id_pekerjaan_suami_istri ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>fk__perkerjaan_suami_istri</label>
                    <input type="text" class="form-control" name="fk__perkerjaan_suami_istri" placeholder="fk__perkerjaan_suami_istri" value="<?php echo $detail->fk__perkerjaan_suami_istri ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>tmt_pns</label>
                    <input type="text" class="form-control" name="tmt_pns" placeholder="tmt_pns" value="<?php echo $detail->tmt_pns ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>a_lisensi_kepsek</label>
                    <input type="text" class="form-control" name="a_lisensi_kepsek" placeholder="a_lisensi_kepsek" value="<?php echo $detail->a_lisensi_kepsek ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>jml_sekolah_binaan</label>
                    <input type="text" class="form-control" name="jml_sekolah_binaan" placeholder="jml_sekolah_binaan" value="<?php echo $detail->jml_sekolah_binaan ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>a_diklat_awas</label>
                    <input type="text" class="form-control" name="a_diklat_awas" placeholder="a_diklat_awas" value="<?php echo $detail->a_diklat_awas ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>akta_ijin_ajar</label>
                    <input type="text" class="form-control" name="akta_ijin_ajar" placeholder="akta_ijin_ajar" value="<?php echo $detail->akta_ijin_ajar ?>">
                  </div>
                   <div class="form-group form-group-lg bts-ats">
                    <label>nira</label>
                    <input type="text" class="form-control" name="nira" placeholder="nira" value="<?php echo $detail->nira ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>stat_data</label>
                    <input type="text" class="form-control" name="stat_data" placeholder="stat_data" value="<?php echo $detail->stat_data ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>mampu_handle_kk</label>
                    <input type="text" class="form-control" name="mampu_handle_kk" placeholder="mampu_handle_kk" value="<?php echo $detail->mampu_handle_kk ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>a_braille</label>
                    <input type="text" class="form-control" name="a_braille" placeholder="a_braille" value="<?php echo $detail->a_braille ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>a_bhs_isyarat</label>
                    <input type="text" class="form-control" name="a_bhs_isyarat" placeholder="a_bhs_isyarat" value="<?php echo $detail->a_bhs_isyarat ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>npwp</label>
                    <input type="text" class="form-control" name="npwp" placeholder="npwp" value="<?php echo $detail->npwp ?>">
                  </div>
                  <div class="form-group form-group-lg bts-ats">
                    <label>kewarganegaraan</label>
                    <input type="text" class="form-control" name="kewarganegaraan" placeholder="kewarganegaraan" value="<?php echo $detail->kewarganegaraan ?>">
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="pendidikan">
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <!-- end -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sambungfloat"></div>
</div>