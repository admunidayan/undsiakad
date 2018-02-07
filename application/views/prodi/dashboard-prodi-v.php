<div class="unirow">
	<div class="col-md-8 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
					<h4 class="media-heading">Program Studi <?php echo $dtprod->nm_lemb ?></h4>
						Informasi Program Studi <?php echo $dtprod->nm_lemb ?>.
					</div>
				</div>
			</div>
		</div>
		<div class="unirow">
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/2.png'); ?>">
					<h4><b>Mahasiswa</b></h4>
					<a href="<?php echo base_url('index.php/prodi/mahasiswa/mhsprodi/'); ?><?php echo $dtprod->kode_prodi; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/4.png'); ?>">
					<h4><b>Kurikulum</b></h4>
					<a href="<?php echo base_url('index.php/prodi/Kurikulum/kurprodi/'); ?><?php echo $dtprod->kode_prodi; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/24.png'); ?>">
					<h4><b>Kelas</b></h4>
					<a href="<?php echo base_url('index.php/prodi/kelas/kelasprodi/'); ?><?php echo $dtprod->kode_prodi; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/14.png'); ?>">
					<h4><b>Pegawai</b></h4>
					<a href="#" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/21.png'); ?>">
					<h4><b>Dosen</b></h4>
					<a href="<?php echo base_url('index.php/prodi/dosen/dosenprodi/'); ?><?php echo $dtprod->kode_prodi; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/22.png'); ?>">
					<h4><b>Kelulusan</b></h4>
					<a href="<?php echo base_url('index.php/prodi/kelulusan/daftar/'.$dtprod->kode_prodi); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="sambungfloat"></div>
		</div>
	</div>
	<div class="col-md-4 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="bts-ats">
					<div class="media">
						<div class="media-left media-middle">
							<div class="dashsubttl"><i class="fa fa-institution"></i></div>
						</div>
						<div class="media-body">
							<h4 class="media-heading">Detail Program Studi <?php echo $dtprod->nm_lemb ?></h4>
							Informasi Program Studi <?php echo $dtprod->nm_lemb ?>.
						</div>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
					</div>
				<?php endif ?>
				<form class="bts-ats2" action="<?php echo base_url('admin/Administrator_c/proses_update_prodi'); ?>" method="post">
					<div class="input-group">
						<span class="input-group-addon"><div class="bts-sm">KDP</div></span>
						<input type="hidden" name="id_prodi" value="<?php echo $dtprod->id ?>">
						<input type="text" name="kode_prodi" class="form-control" placeholder="Kode prodi" value="<?php echo $dtprod->kode_prodi ?>">
					</div>
					<div class="input-group bts-ats">
						<span class="input-group-addon"><div class="bts-sm">NMP</div></span>
						<input type="text" name="nm_lemb" class="form-control" placeholder="Nama prodi" value="<?php echo $dtprod->nm_lemb ?>">
					</div>
					<div class="input-group bts-ats">
						<span class="input-group-addon"><div class="bts-sm">JEN</div></span>
						<select class="form-control" name="id_jenjang_pend">
							<option value="<?php echo $dtprod->id_jenj_didik ?>">-- <?php echo $dtprod->nm_jenj_didik ?> --</option>
							<?php foreach ($dtajp as $jen): ?>
								<option value="<?php echo $jen->id_jenj_didik ?>"><?php echo $jen->nm_jenj_didik ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group bts-ats">
						<span class="input-group-addon"><div class="bts-sm">FKS</div></span>
						<select class="form-control" name="id_fakultas">
							<option>-- Pilih Fakultas --</option>
							<?php foreach ($dtafk as $fk): ?>
								<option value="<?php echo $fk->id_fakultas ?>"><?php echo $fk->nama_fakultas ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group bts-ats">
						<span class="input-group-addon"><div class="bts-sm">AKR</div></span>
						<input type="text" name="akreditasi_prodi" class="form-control" placeholder="Akreditasi prodi" value="<?php echo $dtprod->polesei_nilai ?>">
					</div>
					<div class="input-group bts-ats">
						<span class="input-group-addon"><div class="bts-sm">STS</div></span>
						<select class="form-control" name="status_prodi">
							<option value="<?php echo $dtprod->stat_prodi ?>">-- <?php echo $dtprod->stat_prodi ?> --</option>
							<option value="A">Aktif</option>
							<option value="Nonaktif">Nonaktif</option>
						</select>
					</div>
					<textarea class="form-control bts-ats bts-bwh" placeholder="Keterangan prodi" name="ket_prodi" rows="5"><?php echo $dtprod->jln ?></textarea>
					<button type="submit" name="submit" value="submit" class="btn btn-default btn-lg bts-bwh kanan"><b>Simpan</b></button>
				</form>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>