<div class="unirow" id="mainpage">
  <?php $this->load->view('nav/nav-mahasiswa') ?>
  <div class="col-md-10 unipd">
    <div class="whitebox2 bts-ats fk-min">
      <div class="prfbox">
        <div class="bgbox">
          <form action="<?php echo base_url('index.php/admin/profil/edit'); ?>" method="post" enctype="multipart/form-data">
            <div class="bguser">
              <img src="<?php echo base_url('asset/img/bg/bg3.png'); ?>" width="100%">
              <div class="editbox-left"><?php echo ucfirst($getmhs->nm_pd); ?></div>
            </div>
            <div class="dpbox">
              <div class="dpname">
                <div class="dpkot">
                  <?php if (!empty($getmhs->foto_profil_mhs)): ?>
                    <img class="dpimg" id="preview" src="<?php echo base_url('asset/img/users/'); ?><?php echo $getmhs->foto_profil_mhs; ?>" width="100%">
                  <?php else: ?>
                    <img class="dpimg" id="preview" src="<?php echo base_url('asset/img/users/avatar.png'); ?>" width="100%">
                  <?php endif ?>
                  <label for="inputimg" class="editbox" style="border-radius:50%;padding: 14px 17px;">
                    <input type="file" id="inputimg" class="inputfile" name="profile">
                    <i class="fa fa-camera"></i>
                  </label>
                </div>
                <h3 class="tengah"><?php echo ucwords(strtolower($getmhs->nm_pd)); ?></h3>
                <h6 class="tengah"><i class="fa fa-envelope-o"></i> <?php echo ucfirst($getmhs->email); ?></h6>
                <h6 class="tengah"><i class="fa fa-mobile"></i> <?php echo ucfirst($getmhs->nipd); ?></h6>
              </div>
            </div>
          </form>
          <div class="bts-ats">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#pribadi" class="txtabu" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user-circle-o"></i> Data Pribadi</a></li>
              <li role="presentation"><a href="#ortu" class="txtabu" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user-md"></i> Data Orang Tua</a></li>
              <li role="presentation"><a href="#wali" class="txtabu" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Data wali</a></li>
              <li role="presentation"><a href="#pendidikan" class="txtabu" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Pendidikan <label class="label label-danger">no edit</label></a></li>
            </ul>
            <!-- Tab panes -->
            <form action="<?php echo base_url('index.php/prodi/mahasiswa/proses_edit_mahasiswa') ?>" method="POST">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="pribadi">

                  <div class="row">
                    <div class="col-md-6">
                      <!-- mulai -->
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nm_pd" placeholder="Nama Mahasiswa" value="<?php echo ucwords(strtolower($getmhs->nm_pd));?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIPD</label>
                        <input type="text" class="form-control" name="nipd" placeholder="username/nomor stambuk" value="<?php echo $getmhs->nipd ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="username/nomor stambuk" value="<?php echo $getmhs->nik ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $getmhs->email ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor Handphone Mahasiswa" value="<?php echo $getmhs->no_hp ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Nomor Telepon Rumah</label>
                        <input type="text" class="form-control" name="no_tel_rmh" placeholder="Nomor Handphone Mahasiswa" value="<?php echo $getmhs->no_tel_rmh ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Gender</label>
                        <select class="form-control" name="jk">
                          <option value="<?php echo $getmhs->jk; ?>">-- <?php echo $getmhs->jk; ?> --</option>
                          <option value="L">L</option>
                          <option value="P">P</option>
                        </select>
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Agama</label>
                        <select name="id_agama" class="form-control">
                          <option value="<?php echo $getmhs->id_agama; ?>">-- <?php echo $this->Mahasiswa_m->nmagama($getmhs->id_agama)->nm_agama;?> --</option>
                          <?php foreach ($listagama as $data): ?>
                            <option value="<?php echo $data->id_agama; ?>"><?php echo $data->nm_agama; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir Mahasiswa" value="<?php echo $getmhs->tgl_lahir ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tmpt_lahir" placeholder="Tempat Lahir" value="<?php echo $getmhs->tmpt_lahir ?>">
                      </div>
                       <div class="form-group form-group-lg bts-ats">
                        <label>Alamat Saat Ini</label>
                        <input type="text" class="form-control" name="jln" placeholder="Tempat Lahir" value="<?php echo $getmhs->jln ?>">
                      </div>
                      <!-- end -->
                    </div>
                    <div class="col-md-6">
                      <!-- start -->
                      <div class="form-group form-group-lg bts-ats2">
                        <label>ID KK</label>
                        <input type="text" class="form-control" name="id_kk" placeholder="id_kk" value="<?php echo $getmhs->id_kk ?>">
                      </div>
                       <div class="form-group form-group-lg bts-ats">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="username/nomor stambuk" value="<?php echo $getmhs->nik ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NPWP</label>
                        <input type="text" class="form-control" name="npwp" placeholder="NPWP" value="<?php echo $getmhs->npwp ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>RT</label>
                        <input type="text" class="form-control" name="rt" placeholder="RT" value="<?php echo $getmhs->rt ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>RW</label>
                        <input type="text" class="form-control" name="rw" placeholder="RW" value="<?php echo $getmhs->rw ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>DS KEL</label>
                        <input type="text" class="form-control" name="ds_kel" placeholder="RW" value="<?php echo $getmhs->ds_kel ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Kode POS</label>
                        <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" value="<?php echo $getmhs->kode_pos ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Nama Dusun</label>
                        <input type="text" class="form-control" name="nm_dsn" placeholder="Nama Dusun" value="<?php echo $getmhs->nm_dsn ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Id Wilayah</label>
                        <input type="text" class="form-control" name="id_wil" placeholder="Wilayah" value="<?php echo $getmhs->id_wil ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Jenis Tinggal</label>
                        <select class="form-control" name="id_jns_tinggal">
                          <option value="<?php echo $this->Mahasiswa_m->jnstgl($getmhs->id_jns_tinggal)->id_jns_tinggal; ?>">-- <?php echo $this->Mahasiswa_m->jnstgl($getmhs->id_jns_tinggal)->nm_jns_tinggal; ?> --</option>
                          <?php foreach ($dttgl as $data): ?>
                            <option value="<?php echo $data->id_jns_tinggal; ?>"><?php echo $data->nm_jns_tinggal; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Terima KPS</label>
                        <input type="text" class="form-control" name="a_terima_kps" placeholder="terima KPS" value="<?php echo $getmhs->a_terima_kps ?>">
                      </div>
                      <!-- end -->
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="ortu">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nama Ayah</label>
                        <input type="text" class="form-control" name="nm_ayah" placeholder="Nama Ayah" value="<?php echo $getmhs->nm_ayah ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIK Ayah</label>
                        <input type="text" class="form-control" name="nik_ayah" placeholder="Pekerjaan Ayah" value="<?php echo $getmhs->nik_ayah ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pekerjaan Ayah</label>
                        <input type="text" class="form-control" name="id_pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="<?php echo $getmhs->id_pekerjaan_ayah ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Penghasilan Ayah</label>
                        <input type="text" class="form-control" name="id_penghasilan_ayah" placeholder="RW" value="<?php echo $getmhs->id_penghasilan_ayah ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pendidikan Terakhir Ayah</label>
                        <input type="text" class="form-control" name="id_jenjang_pendidikan_ayah" placeholder="Pendidiikan Ayah" value="<?php echo $getmhs->id_jenjang_pendidikan_ayah ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tanggal Lahir Ayah</label>
                        <input type="text" class="form-control" name="tgl_lahir_ayah" placeholder="Tanggal Lahir" value="<?php echo $getmhs->tgl_lahir_ayah ?>">
                      </div>
                      <!-- end -->
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="nm_ibu_kandung" placeholder="Nama Ibu" value="<?php echo $getmhs->nm_ibu_kandung ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NIK Ibu</label>
                        <input type="text" class="form-control" name="nik_ibu" placeholder="Pekerjaan Ibu" value="<?php echo $getmhs->nik_ibu ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pekerjaan Ibu</label>
                        <input type="text" class="form-control" name="id_pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="<?php echo $getmhs->id_pekerjaan_ibu ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Penghasilan Ibu</label>
                        <input type="text" class="form-control" name="id_penghasilan_ibu" placeholder="Penghasilan Ibu" value="<?php echo $getmhs->id_penghasilan_ibu ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pendidikan Terakhir Ibu</label>
                        <input type="text" class="form-control" name="id_jenjang_pendidikan_ibu" placeholder="Pendidiikan Ibu" value="<?php echo $getmhs->id_jenjang_pendidikan_ibu ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tanggal Lahir Ibu</label>
                        <input type="text" class="form-control" name="tgl_lahir_ibu" placeholder="Tanggal Lahir" value="<?php echo $getmhs->tgl_lahir_ibu ?>">
                      </div>
                      <!-- end -->
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="wali">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nama Wali</label>
                        <input type="text" class="form-control" name="nm_wali" placeholder="Nama Wali" value="<?php echo $getmhs->nm_wali ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pekerjaan Wali</label>
                        <input type="text" class="form-control" name="id_pekerjaan_wali" placeholder="Pekerjaan Wali" value="<?php echo $getmhs->id_pekerjaan_wali ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Penghasilan Wali</label>
                        <input type="text" class="form-control" name="id_penghasilan_wali" placeholder="Penghasilan Wali" value="<?php echo $getmhs->id_penghasilan_wali ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Pendidikan Terakhir Wali</label>
                        <input type="text" class="form-control" name="id_jenjang_pendidikan_wali" placeholder="Pendidiikan Wali" value="<?php echo $getmhs->id_jenjang_pendidikan_wali ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>Tanggal Lahir Wali</label>
                        <input type="text" class="form-control" name="tgl_lahir_wali" placeholder="Tanggal Lahir" value="<?php echo $getmhs->tgl_lahir_wali ?>">
                      </div>
                      <!-- end -->
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="pendidikan">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Nomor Pokok Mahasiswa (NPM)</label>
                        <div class="form-control"><?php echo $getmhs->nipd ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Jenjang Pendidikan</label>
                        <div class="form-control"><?php echo $this->Mahasiswa_m->jenjangpendby($getmhs->id_jenj_didik)->nm_jenj_didik ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Fakultas</label>
                        <div class="form-control"></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Program Studi</label>
                        <div class="form-control"><?php echo $getmhs->nm_lemb ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats">
                        <label>NISN</label>
                        <input type="text" class="form-control" name="nisn" placeholder="Wilayah" value="<?php echo $getmhs->nisn ?>">
                      </div>
                      <!-- end -->
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-group-lg bts-ats2">
                        <label>NO KPS</label>
                        <input type="hidden" name="id" value="<?php echo $getmhs->id ?>">
                         <input type="text" class="form-control" name="no_kps" placeholder="Nomor KPS" value="<?php echo $getmhs->no_kps ?>">
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>ID PD</label>
                        <div class="form-control"><?php echo $getmhs->id_pd ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Jenis Daftar</label>
                        <div class="form-control"><?php echo $this->Mahasiswa_m->jnsdftr($getmhs->id_jns_daftar)->nm_jns_daftar ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Tanggal Masuk</label>
                        <div class="form-control"><?php echo $getmhs->tgl_masuk_sp ?></div>
                      </div>
                      <div class="form-group form-group-lg bts-ats2">
                        <label>Semester Mulai</label>
                        <div class="form-control"><?php echo $getmhs->mulai_smt ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg" style="width:100%">Simpan Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sambungfloat"></div>
</div>