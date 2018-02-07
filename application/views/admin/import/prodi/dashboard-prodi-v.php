<div class="unirow">
	<div class="col-md-8 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
					<h4 class="media-heading">Program Studi <?php echo $dtprod['nm_lemb'] ?></h4>
						Informasi Program Studi <?php echo $dtprod['nm_lemb'] ?>.
					</div>
				</div>
			</div>
		</div>
		<div class="unirow">
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/2.png'); ?>">
					<h4><b>Mahasiswa</b></h4>
					<a href="<?php echo base_url('index.php/admin/import/mhsbyprodi/'); ?><?php echo $dtprod['id_sms']; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/4.png'); ?>">
					<h4><b>Matakuliah</b></h4>
					<a href="<?php echo base_url('index.php/admin/import/mata_kuliah/'); ?><?php echo $dtprod['id_sms']; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/6.png'); ?>">
					<h4><b>Kurikulum</b></h4>
					<a href="<?php echo base_url('index.php/admin/import/kurikulum_prodi/'); ?><?php echo $dtprod['id_sms']; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/24.png'); ?>">
					<h4><b>Kelas</b></h4>
					<a href="<?php echo base_url('index.php/admin/import/kelas_kuliah_prodi/'); ?><?php echo $dtprod['id_sms']; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/21.png'); ?>">
					<h4><b>Dosen</b></h4>
					<a href="<?php echo base_url('index.php/admin/import/dosen/'); ?><?php echo $dtprod['id_sms']; ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="col-md-4 unipd">
				<div class="prfbox fkpanelbox">
					<img src="<?php echo base_url('asset/img/icon/22.png'); ?>">
					<h4><b>Kelulusan</b></h4>
					<a href="<?php echo base_url('index.php/prodi/kelulusan/daftar/'.$dtprod['id_sms']); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="sambungfloat"></div>
		</div>
	</div>
	
	</div>
	<div class="sambungfloat"></div>
</div>