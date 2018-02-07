<div style="width: 80%;margin: auto;">
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-danger alert-dismissible tengah" role="alert" style="margin-top:7px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="fa fa-warning"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
		</div>
	<?php endif ;?>
	<div class="tengah">
		<h1><b>Welcome <?php echo $dtadm->first_name; ?></b></h1>
		<span>This your navigation Menu</span>
	</div>
	<div class="unirow bts-ats2">
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img style="width: 154px;border: 6px solid #cccccc;border-radius: 50%;" src="<?php echo base_url('asset/img/users/'); ?><?php echo $dtadm->profile; ?>">
				<h4><b>Profil</b></h4>
				<a href="<?php echo base_url('index.php/admin/profil/admin'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/14.png'); ?>">
				<h4><b>Fakultas</b></h4>
				<a href="<?php echo base_url('index.php/fakultas/fakultas'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/24.png'); ?>">
				<h4><b>Prodi</b></h4>
				<a href="<?php echo base_url('index.php/prodi/prodi'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/11.png'); ?>">
				<h4><b>Matakuliah</b></h4>
				<a href="<?php echo base_url('index.php/fakultas/fakultas'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/15.png'); ?>">
				<h4><b>Kurikulum</b></h4>
				<a href="<?php echo base_url('index.php/fakultas/fakultas'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/10.png'); ?>">
				<h4><b>Group</b></h4>
				<a href="<?php echo base_url('index.php/admin/groups'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/21.png'); ?>">
				<h4><b>Dosen</b></h4>
				<a href="<?php echo base_url('index.php/admin/dosen'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
		<div class="col-md-3 unipd">
			<div class="prfbox fkpanelbox">
				<img src="<?php echo base_url('asset/img/icon/13.png'); ?>">
				<h4><b>Karyawan</b></h4>
				<a href="<?php echo base_url('index.php/admin/karyawan'); ?>" class="btn btn-success">lihat detail&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
			</div>
		</div>
	</div>
</div>