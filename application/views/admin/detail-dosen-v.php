<script>
  $(function () {
    $('#riwayatmengajar').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
  $(function () {
    $('#kelasmengajar').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false
    });
  });
</script>
<div class="unirow">
  <div class="col-md-6 unipd">
    <div class="whitebox2 bts-ats">
      <div class="bts-atas">
        <div class="prfbox">
          <div class="media">
            <div class="media-left media-middle">
              <div class="editfpbox mdling" data-toggle="modal" data-target="#editprofil">
                <img class="media-object" src="<?php echo base_url('asset/img/dosen'); ?>/<?php echo $detdos->foto_profil_dosen ?>" alt="gambar">
                <div class="editfp"><i class="fa fa-camera"></i></div>
              </div>
            </div>
            <div class="media-body media-middle">
              <h4 class="media-heading">
                <?php echo $detdos->nama_dosen; ?>
                <?php if ($detdos->status_dosen == 'Aktif'): ?>
                  <i class="fa fa-check-circle u11 txtbiru" data-toggle="tooltip" data-placement="bottom" title="Mahasiswa <?php echo $detdos->status_dosen ?> "></i>
                <?php else: ?>
                  <i class="fa fa-warning u11 txtmerah" data-toggle="tooltip" data-placement="bottom" title="Mahasiswa <?php echo $detdos->status_dosen ?>"></i>
                <?php endif; ?>
              </h4>
              <div class="txtabu">Dosen Universitas Dayanu Ikshanuddin Baubau  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if ($this->session->flashdata('editfoto')): ?>
      <div class="alert tengah alert-info alert-dismissible bts-ats bts-bwh" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo $this->session->flashdata('editfoto');?></strong>
      </div>
    <?php endif ?>
    <div class="whitebox2">
      <div class="prfbox">
        <div class="media">
          <div class="media-left media-middle">
            <i class="fa fa-unlock txtbiru u20"></i>
          </div>
          <div class="media-body media-middle">
            <h6 class="media-heading nobold">Klik 'ubah password untuk mengganti password anda'</h6>
          </div>
          <div class="media-right media-middle">
            <button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".editpass">Ubah Password</button>
          </div>
        </div>
      </div>
    </div>
    <?php if ($this->session->flashdata('message')): ?>
      <div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
      </div>
    <?php endif ?>
    <form action="<?php echo base_url('index.php/admin/dosen/editinfopribadidos'); ?>" method="post">
      <div class="whitebox2">
        <div class="prfbox">
          <div class="media">
            <div class="media-left media-middle">
              <div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Informasi Pribadi</h4>
              <div class="txtabu">
                Informasi Pribadi <?php echo $detdos->nama_dosen ?>.
              </div>
            </div>
          </div>
          <div class="form-group bts-ats2">
          	<label for="namalengkap">Nama Lengkap</label>
          	<input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen ?>">
          	<input type="text" name="nama_dosen" class="form-control" id="namalengkap" placeholder="Nama Lengkap" value="<?php echo $detdos->nama_dosen ?>">
          </div>
          <div class="form-group">
          	<label for="username">Username</label>
          	<input type="text" name="username" class="form-control" id="username" placeholder="Nama Lengkap" value="<?php echo $detdos->username ?>">
          </div>
           <div class="form-group">
          	<label for="username">Status Dosen <span class="txtmerah">penting</span></label>
          	<select class="form-control" name="status_dosen">
          		<option value="<?php echo $detdos->status_dosen; ?>">-- <?php echo $detdos->status_dosen; ?> --</option>
          		<option value="Aktif">Aktif</option>
          		<option value="Aktif">Nonaktif</option>
          	</select>
          </div>
          <div class="form-group">
          	<label for="tgllhr">Tanggal Lahir</label>
          	<input type="text" name="tgl_lhr_dosen" class="form-control" id="tgllhr" placeholder="Tanggal Lahir" value="<?php echo $detdos->tgl_lhr_dosen ?>">
          </div>
          <div class="form-group">
          	<label for="email">Email</label>
          	<input type="text" name="email_dosen" class="form-control" id="email" placeholder="Email Dosen" value="<?php echo $detdos->email_dosen ?>">
          </div>
          <div class="form-group">
          	<label for="nohp">Nomor Handphone (HP)</label>
          	<input type="text" name="no_hp_dosen" class="form-control" id="nohp" placeholder="Nomor Handphone" value="<?php echo $detdos->no_hp_dosen ?>">
          </div>
          <div class="form-group">
          	<label for="gender">Jenis Kelamin (l/p)</label>
          	<input type="text" name="gender_dosen" class="form-control" id="gender" placeholder="Jenis Kelamin" value="<?php echo $detdos->gender_dosen ?>">
          </div>
          <div class="form-group">
          	<label for="gender">Alamat Rumah</label>
          	<textarea class="form-control" name="alamat_dosen" rows="3" placeholder="Alamat Rumah"><?php echo $detdos->alamat_dosen ?></textarea>
          </div>
          <div class="form-group">
          	<label for="gender">Alamat Kantor</label>
          	<textarea class="form-control" name="alamat_kantor_dosen" rows="3" placeholder="Alamat Kantor"><?php echo $detdos->alamat_kantor_dosen ?></textarea>
          </div>
          <button class="btn btn-lg btn-info bts-ats kanan" type="submit" name="submit" value="submit">Simpan</button>
          <div class="sambungfloat"></div>
        </div>
      </div>
    </form>
    <div class="whitebox2 bts-ats">
      <div class="prfbox">
        <div class="media">
          <div class="media-left media-middle">
            <div class="dashsubttl"><i class="fa fa-bell-o"></i></div>
          </div>
          <div class="media-body">
            <h4 class="media-heading">Golongan</h4>
            <div class="txtabu">
              Data Golongan  - <?php echo $detdos->nama_dosen ?>.
            </div>
          </div>
          <div class="media-right media-middle">
            <button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".addgolongann">Tambah kelas</button>
          </div>
        </div>
        <div class="bts-ats2">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="tengah">No</th>
                <th class="tengah">Golongan</th>
                <th class="tengah">TMT</th>
                <th class="tengah">Masa Golongan</th>
                <th class="tengah">Masa Kerja</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1 ?>
              <?php foreach ($dtagol as $data): ?>
                <td><?php echo $no; ?></td>
                <td><?php echo $data->golongan; ?></td>
                <td><?php echo $data->tmt; ?></td>
                <td><?php echo $data->masa_golongan; ?></td>
                <td><?php echo $data->masa_kerja; ?></td>
                <?php $no++ ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="whitebox2 bts-ats">
      <div class="prfbox">
        <div class="media">
          <div class="media-left media-middle">
            <div class="dashsubttl"><i class="fa fa-bell-o"></i></div>
          </div>
          <div class="media-body">
            <h4 class="media-heading">Pemangkatan</h4>
            <div class="txtabu">
              Data Pemangkatan  - <?php echo $detdos->nama_dosen ?>.
            </div>
          </div>
          <div class="media-right media-middle">
            <button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".addpangkat">Tambah Pemangkatan</button>
          </div>
        </div>
        <div class="bts-ats2">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="tengah">No</th>
                <th class="tengah">Jbtn Fng TMT</th>
                <th class="tengah">PAK</th>
                <th class="tengah">Inspasing TMT</th>
                <th class="tengah">Masa Berlaku</th>
                <th class="tengah">Ket</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1 ?>
              <?php foreach ($dtapak as $data): ?>
                <td><?php echo $no; ?></td>
                <td><?php echo $data->kbtn_fung_tmt; ?></td>
                <td><?php echo $data->pak; ?></td>
                <td><?php echo $data->inspasing_tmt; ?></td>
                <td><?php echo $data->masa_berlaku; ?></td>
                <td><?php echo $data->ket; ?></td>
                <?php $no++ ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 unipd">
  	<div class="whitebox2 bts-ats">
  		<div class="prfbox">
  			<div class="media">
  				<div class="media-left media-middle">
  					<div class="dashsubttl"><i class="fa fa-bell-o"></i></div>
  				</div>
  				<div class="media-body">
  				<h4 class="media-heading">Kelas Mengajar </h4>
  					<div class="txtabu">
  						Daftar Kelas yang diajar oleh <?php echo $detdos->nama_dosen ?>.
  					</div>
  				</div>
  				<div class="media-right media-middle">
  				<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".addkelas">Tambah kelas</button>
  				</div>
  			</div>
  		</div>
	  	<div style="padding: 0px 14px">
	  		<?php if (!empty($kelasmeng)): ?>
	  			<table class="table" id="kelasmengajar">
	  				<thead>
	  					<tr>
	  						<td></td><td></td><td></td><td></td>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					<?php foreach ($kelasmeng as $data): ?>
		  					<tr>
		  						<td>
		  							<span class="u30 tengah">
		  								<?php echo $data->kode_jenjang_pend ?>
		  							</span>
		  						</td>
		  						<td>
		  						<h4 class="media-heading"><?php echo $data->nama_matakuliah ?></h4>
		  							<div class="txtabu"> 
		  								<?php echo $data->nama_fakultas ?> 
		  								<?php echo $data->nama_prodi ?> 
		  								<?php echo $data->nama_semester ?> 
		  								<?php echo $data->nama_tahun_ajaran ?>.
		  							</div>
		  						</td>
		  						<td>
		  							<span class="u20"><?php echo $data->nama_kelas_mhs; ?></span>
		  						</td>
		  						<td>
		  							<a href="<?php echo base_url('index.php/admin/dosen/delete_kelas_mengajar'); ?>/<?php echo $data->id_atur_dosen; ?>/<?php echo $detdos->id_dosen; ?>">
		  							<div class="buttonlist bgpink txtputih">Hapus</div>
		  						</a>
		  						</td>
		  					</tr>
		  				<?php endforeach ?>
	  				</tbody>
	  			</table>
	  		<?php else: ?>
	  			<div class="alert tengah">
	  				<i class="fa fa-warning"></i> Belum memiliki kelas mengajar
	  			</div>
	  		<?php endif ?>
	  	</div>
  	</div>
  	<div class="whitebox2 bts-ats">
  		<div class="prfbox">
  			<div class="media">
  				<div class="media-left media-middle">
  					<div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
  				</div>
  				<div class="media-body">
  				<h4 class="media-heading">Riwayat Pendidikan</h4>
  					<div class="txtabu">
  						Informasi Pribadi <?php echo $detdos->nama_dosen ?>.
  					</div>
  				</div>
  				<div class="media-right media-middle">
  				<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".addrwpend">Tambah riwayat</button>
  				</div>
  			</div>
  		</div>
  		<?php if (!empty($rwpend)): ?>
  			<?php foreach ($rwpend as $data): ?>
  				<div class="colriw">
	  				<div class="media">
	  					<div class="media-left media-middle tengah" style="min-width:80px;">
	  						<span class="u20"><b><?php echo $data->jenjang_sekolah; ?></b></span>
	  					</div>
	  					<div class="media-body media-middle">
	  						<h4 class="media-heading"><?php echo $data->nama_sekolah; ?></h4>
	  						<div class="txtabu"><?php echo $data->alamat_sekolah; ?></div>
	  					</div>
	  					<div class="media-left media-middle">
	  						<b class="u20"><?php echo $data->tahun_masuk; ?></b>
	  					</div>
	  					<div class="media-right media-middle">
	  						<a href="<?php echo base_url('index.php/admin/dosen/delete_riwayat_pendidikan'); ?>/<?php echo $data->id_riwayat_pend; ?>/<?php echo $detdos->id_dosen; ?>">
	  							<div class="buttonlist bgpink txtputih">Hapus</div>
	  						</a>
	  					</div>
	  				</div>
	  			</div>
  			<?php endforeach ?>
  		<?php else: ?>
  			<div class="alert tengah">Tidak ada riwayat pendidikan</div>
  		<?php endif ?>
  	</div>
  	<div class="whitebox2">
  		<div class="prfbox">
  			<div class="media">
  				<div class="media-left media-middle">
  					<div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
  				</div>
  				<div class="media-body">
  				<h4 class="media-heading">Riwayat Mengajar</h4>
  					<div class="txtabu">
  						Daftar riwayat mengajar dari <?php echo $detdos->nama_dosen ?>.
  					</div>
  				</div>
  				<div class="media-right media-middle">
  				<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target=".addrwmeng">Tambah riwayat</button>
  				</div>
  			</div>
  		</div>
  		<?php if (!empty($rwmeng)): ?>
  			<table id="riwayatmengajar" class="table table-striphed">
  				<thead>
  					<tr>
  						<th>Matakuliah</th>
  						<th>Instansi</th>
  						<th align="tengah">tahun</th>
  						<th align="tengah">action</th>
  					</tr>
  				</thead>
  				<tbody>

  					<?php foreach ($rwmeng as $data): ?>
  						<tr>
  							<td><?php echo $data->nama_matakuliah_r; ?></td>
  							<td><?php echo $data->nama_instansi_r; ?></td>
  							<td align="center"><?php echo $data->tahun_mengajar; ?></td>
  							<td>
  								<a href="<?php echo base_url('index.php/admin/dosen/delete_riwayat_mengajar'); ?>/<?php echo $data->id_riwayat_mengajar; ?>/<?php echo $detdos->id_dosen; ?>">
  									<div class="buttonlist bgpink txtputih">Hapus</div>
  								</a>
  							</td>
  						</tr>
  					<?php endforeach ?>
  				</tbody>
  			</table>
  		<?php else: ?>
  			<div class="alert tengah">tidak ada riwayat mengajar</div>
  		<?php endif ?>
  	</div>
  	<div class="sambungfloat"></div>
  </div>
  <!-- modal edit profil -->
  <div class="modal fade" id="editprofil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form action="<?php echo base_url('index.php/admin/dosen/proses_update_foto_profil_dosen'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="nama_dosen" value="<?php echo $detdos->nama_dosen ?>">
            <input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen ?>">
            <div class="prfbox bts-bwh2">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="editprofilttl">Edit Profil</h3>
              <img class="editprofilbox" id="preview" src="<?php echo base_url('asset/img/dosen'); ?>/<?php echo $detdos->foto_profil_dosen ?>" alt="gambar">
              <div class="namafile bts-ats">
                <div class="unirow">
                  <div class="col-md-8 col-sm-8 col-xs-8 unipd">
                    <input type="hidden" name="profilsaatini" value="<?php echo $detdos->foto_profil_dosen ?>">
                    <input id="uploadFile" class="form-control" placeholder="Nama File" disabled="disabled" />
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4 unipd">
                    <div class="fileUpload btn btn-info" style="width:100%;">
                      <span class="u15"><b>Pilih</b></span>
                      <input id="uploadBtn" type="file" name="editprofil" class="upload" />
                    </div>
                  </div>
                  <div class="sambungfloat"></div>
                </div>
              </div>
              <div class="btneditprofil">
                <button type="submit" class="btn btn-info submbtn bts-bwh" name="submit"><b>Ubah Foto Profil</b></button>
                <div class="btneditprofil txtabu tengah">
                  Gunakan file dengan ukuran persegi ( 100x100 ) untuk mendapatkan hasi yang maksimal,
                  file gambar akan di lakukan <i>Croping</i> secara otomatis oleh sistem.
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal ubah password -->
  <div class="modal fade editpass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="whitebox2">
          <div class="prfbox">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="tengah nobold"><i class="fa fa-unlock u20 txtbiru"></i> Ubah Password</h4>
            <form action="<?php echo base_url('index.php/admin/dosen/updatepassdsn'); ?>" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Password Baru</label>
                <input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen ?>">
                <input type="password" class="form-control" name="pass"  placeholder="Password baru">
              </div>
              <div class="unirow">
                <div class="col-md-4 unipd">
                  <button type="submit" style="width:100%" name="submit" value="submit" class="btn btn-info">Ubah password</button>
                </div>
                <div class="col-md-8 unipd">
                  Pastikan anda mengingat password baru tersebut.
                </div>
              </div>
              <div class="sambungfloat"></div>
            </form>
            <div class="alert alert-info u11 bts-ats">
              <i class="fa fa-info-circle"></i> Gunakan password yang mudah anda ingat,
              atau menggunakan password yang sama dengan akun media sosial anda.
              <b>Password anda disimpan dalam bentuk MD5 Sehingga hanya anda yang mengetahui password anda.</b>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal add riwayad pendidikan -->
  <div class="modal fade addrwpend" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="whitebox2">
          <div class="prfbox">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Tambah Riwayat Pendidikan</h4>
            <form action="<?php echo base_url('index.php/admin/dosen/addriwayatpend'); ?>" method="post">
            	<div class="form-group">
            		<label>Jenjang Sekolah</label>
            		<input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen; ?>">
            		<select class="form-control input-lg" name="jenjang_sekolah">
            			<option value="SD">SD</option>
            			<option value="SMP">SMP</option>
            			<option value="SMA">SMA</option>
            			<option value="SMK">SMK</option>
            			<option value="D1">D1</option>
            			<option value="D2">D2</option>
            			<option value="D3">D3</option>
            			<option value="D4">D4</option>
            			<option value="S1">S1</option>
            			<option value="S2">S2</option>
            			<option value="S3">S3</option>
            		</select>
            	</div>
            	<div class="form-group">
            	<label>Nama Instansi</label>
            		<input type="text" name="nama_sekolah" class="form-control input-lg" placeholder="Nama Instansi">
            	</div>
              <div class="form-group">
              <label>Fakultas/Program Studi</label>
                <input type="text" name="progstudi" class="form-control input-lg" placeholder="Fakultas/Program Studi">
              </div>
            	<div class="form-group">
            	<label>Tahun Masuk</label>
            		<input type="text" name="tahun_masuk" class="form-control input-lg" placeholder="Tahun Masuk">
            	</div>
            	<div class="form-group">
            	<label>Alamat Sekolah</label>
            		<textarea name="alamat_sekolah" rows="3" class="form-control input-lg" placeholder="alamat instansi"></textarea>
            	</div>
            	<button type="submit" style="width:100%" name="submit" value="submit" class="btn btn-info btn-lg">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- modal add riwayat mengajar -->
  <div class="modal fade addrwmeng" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="whitebox2">
          <div class="prfbox">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="tengah nobold"><i class="fa fa-unlock u20 txtbiru"></i> Tambah Riwayat Mengajar</h4>
            <form action="<?php echo base_url('index.php/admin/dosen/add_rw_mengajar'); ?>" method="post">
            	<input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen; ?>">
            	<div class="form-group">
            	<label>Nama Matakuliah</label>
            		<input type="text" name="nama_matakuliah_r" class="form-control input-lg" placeholder="Nama Matakuliah">
            	</div>
            	<div class="form-group">
            	<label>Tahun Memngajar</label>
            		<input type="text" name="tahun_mengajar" class="form-control input-lg" placeholder="Tahun Mengajar">
            	</div>
            	<div class="form-group">
            	<label>Nama Instansi </label>
            		<input type="text" name="nama_instansi_r" class="form-control input-lg" placeholder="Nama Instansi">
            	</div>
            	<button type="submit" style="width:100%" name="submit" value="submit" class="btn btn-info btn-lg">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- modal add golongan -->
  <div class="modal fade addgolongann" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="whitebox2">
          <div class="prfbox">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="tengah nobold"><i class="fa fa-unlock u20 txtbiru"></i> Tambah Golongan</h4>
            <form action="#" method="post">
              <input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen; ?>">
              <div class="form-group">
              <label>Golongan</label>
                <input type="text" name="golongan" class="form-control input-lg" placeholder="Nama Golongan" required>
              </div>
              <div class="form-group">
              <label>TMT</label>
                <input type="tmt" name="tmt" class="form-control input-lg" placeholder="Terhitung Mulai Tanggal (TMT)" required>
              </div>
              <div class="form-group">
              <label>Masa Golongan </label>
                <input type="text" name="masa_golongan" class="form-control input-lg" placeholder="Masa Golongan" required>
              </div>
              <div class="form-group">
              <label>Masa Kerja </label>
                <input type="text" name="masa_kerja" class="form-control input-lg" placeholder="Masa Kerja" required>
              </div>
              <button type="submit" style="width:100%" name="submit" value="submit" class="btn btn-info btn-lg">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal add pemangkatan -->
  <div class="modal fade addpangkat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="whitebox2">
          <div class="prfbox">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Tambah Pemangkatan</h4>
            <form action="#" method="post">
              <input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen; ?>">
              <div class="form-group">
              <label>Jabatan Fungsional TMT</label>
                <input type="text" name="jbtn_fung_tmt" class="form-control input-lg" placeholder="Jabatan Fungsional TMT" required>
              </div>
              <div class="form-group">
              <label>PAK</label>
                <input type="tmt" name="pak" class="form-control input-lg" placeholder="PAK" required>
              </div>
              <div class="form-group">
              <label>Inspasing TMT </label>
                <input type="text" name="inspasing_tmt" class="form-control input-lg" placeholder="Inspasing TMT">
              </div>
              <div class="form-group">
              <label>Masa Berlaku </label>
                <input type="text" name="masa_berlaku" class="form-control input-lg" placeholder="Masa Berlaku">
              </div>
              <div class="form-group">
              <label>Keterangan </label>
                <input type="text" name="ket" class="form-control input-lg" placeholder="Keterangan">
              </div>
              <button type="submit" style="width:100%" name="submit" value="submit" class="btn btn-info btn-lg">Tambah</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal Add kelas mengajar -->
<div class="modal fade addkelas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambahkan Mahasiswa Baru</h4>
      </div>
      <form class="" action="<?php echo base_url('index.php/admin/dosen/proses_add_kelas_mengajar'); ?>" method="post">
      <input type="hidden" name="id_dosen" value="<?php echo $detdos->id_dosen; ?>">
        <div class="modal-body">
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">JPD</div></span>
                <select class="form-control" name="id_jenjang_pend">
                  <option value="1">-- Jenjang Pendidikan --</option>
                  <?php foreach ($dtajp as $djp): ?>
                    <option value="<?php echo $djp->id_jenjang_pend ?>"><?php echo $djp->nama_jenjang_pend ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">FKS</div></span>
                <select id="fakultas" class="form-control" name="id_fakultas">
                  <option>-- Fakultas --</option>
                  <?php foreach ($dtafk as $djp): ?>
                    <option value="<?php echo $djp->id_fakultas ?>"><?php echo $djp->nama_fakultas ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">PRD</div></span>
                <select id="prodi" class="form-control" name="id_prodi">
                  <option>-- Prodi --</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">STR</div></span>
                <select class="form-control" name="id_semester">
                  <option value="1">-- Semester --</option>
                  <?php foreach ($dtsmstr as $djp): ?>
                    <option value="<?php echo $djp->id_semester ?>"><?php echo $djp->nama_semester ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="unirow">
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">THA</div></span>
                <select class="form-control" name="id_tahun_ajaran">
                  <option value="Aktif">-- Tahun Ajaran --</option>
                  <?php foreach ($dtta as $ta): ?>
                    <option value="<?php echo $ta->id_tahun_ajaran ?>"><?php echo $ta->nama_tahun_ajaran ?> - <?php echo $ta->kode_tahun_ajaran ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 unipd">
              <div class="input-group input-group-lg bts-ats">
                <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">KLS</div></span>
                <select class="form-control" name="id_kelas_mhs">
                  <option value="1">-- KELAS --</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Nonaktif">Nonaktif</option>
                </select>
              </div>
            </div>
            <div class="sambungfloat"></div>
          </div>
          <div class="input-group input-group-lg bts-ats">
            <span class="input-group-addon" id="basic-addon1"><div class="bts-lg">MTK</div></span>
            <select class="form-control" name="id_matakuliah">
                  <option value="1">-- Matakuliah --</option>
                  <?php foreach ($dtamatkul as $data): ?>
                    <option value="<?php echo $data->id_matakuliah ?>"><?php echo $data->nama_matakuliah ?></option>
                  <?php endforeach; ?>
                </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" value="submit" class="btn btn-lg btn-info">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <script type="text/javascript">
  $( document ).ready(function() {
    // console.log( "ready!" );
    $("#fakultas").change(function(event) {
      $("#prodi").find('option').not(":eq(0)").remove();

      $.getJSON('<?php echo base_url('admin/Administrator_c/get_list_prod'); ?>', {fakultas: $("#fakultas").val()},
      function(json, textStatus) {
        $.each(json, function (key, data) {
          $("#prodi").append("<option value="+data.id_prodi+">"+data.nama_prodi+"</option>");
        });
      });
    });
});
  $(function () {
    $('#tgllhr').datetimepicker({
      viewMode: 'years',
      format: 'YYYY/MM/DD'
    });
  });

  // $('#default_datetimepicker').datetimepicker({
  //   formatDate:'d.m.Y',
  //   timepickerScrollbar:true
  // });

  document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
  };

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#uploadBtn").change(function(){
    readURL(this);
  });
  </script>
