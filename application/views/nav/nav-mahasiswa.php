<div class="col-md-2 unipd" >
	<div class="blackbox2 bts-ats" >
		<div class="ttlblack"><h4>Mahasiswa</h4></div>
		<a href="<?php echo base_url('index.php/prodi/mahasiswa/detailmhs/') ?><?php echo $getmhs->nipd ?>"><div class="black-menu"><i class="fa fa-user-circle-o"></i> Profil</div></a>
		<a href="<?php echo base_url('index.php/prodi/mahasiswa/nilaimhs/') ?><?php echo $getmhs->nipd ?>"><div class="black-menu"><i class="fa fa-book"></i> Nilai</div></a>
		<?php if ($getmhs->id_jns_daftar == '2'): ?>
		<a href="<?php echo base_url('index.php/prodi/mahasiswa/nilai_transfer_mhs/'.$getmhs->nipd); ?>"><div class="black-menu"><i class="fa fa-sinc"></i> Nilai Transfer</div></a>
		<?php endif ?>
		<a href="<?php echo base_url('index.php/prodi/mahasiswa/aktivitas/'.$getmhs->nipd); ?>"><div class="black-menu"><i class="fa fa-comments-o"></i> Aktifitas Kuliah</div></a>
		<a href="#"><div class="black-menu"><i class="fa fa-users"></i> Organisasi</div></a>
	</div>
</div>
<div class="col-md-2 unipd"></div>