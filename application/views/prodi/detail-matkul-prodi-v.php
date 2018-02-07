<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-prodi') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo ucwords(strtolower($detail->nm_kurikulum_sp)); ?></h4>
						<div class="txtabu">Detail Kurikulum</div>
					</div>
				</div>
				<?php if ($this->session->flashdata('edit')): ?>
					<div class="alert alert-success alert-dismissible bts-ats2" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="tengah"><strong>SUKSES!</strong> <?php echo $this->session->flashdata('edit');?>.</div>
					</div>
				<?php endif ?>
				<h4><b>Detail kurikulum</b> </h4>
				<form method="post" action="<?php echo base_url('index.php/prodi/kurikulum/proses_edit_kurikulum') ?>">
					<table width="50%">
						<tr>
							<td class="">ID</td>
							<td class="tengah ">:</td>
							<td class="text-success"><?php echo $detail->id_kurikulum_sp ?></td>
						</tr>
						<tr>
							<td class="">NAMA KURIKULUM</td>
							<td class="tengah ">:</td>
							<td class=""><?php echo $detail->nm_kurikulum_sp ?></td>
						</tr>
						<tr>
							<td class="">MULAI BERLAKU</td>
							<td class="tengah ">:</td>
							<td class=""><?php echo $detail->id_smt ?></td>
						</tr>
						<tr>
							<td class="">SKS WAJIB</td>
							<td class="tengah ">:</td>
							<td class=""><?php echo $detail->jml_sks_wajib ?></td>
						</tr>
						<tr>
							<td class="">SKS PILIHAN</td>
							<td class="tengah ">:</td>
							<td class=""><?php echo $detail->jml_sks_pilihan ?></td>
						</tr>
					</table>
				</form>
				<div class="bts-ats2">
					<div class="media">
						<div class="media-left media-middle">
							<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
						</div>
						<div class="media-body">
							<h4 class="media-heading">Daftar Matakuliah</h4>
							<div class="txtabu">Daftar lengkap Matakuliah Universitas Dayanu Ikhsanuddin Baubau</div>
						</div>
					</div>
				</div>
				<?php if ($this->session->flashdata('import')): ?>
					<?php echo $this->session->flashdata('import');?>
				<?php endif ?>
				<div class="dropdown bts-ats">
					<button class="btn btn-default dropdown-toggle" type="button" id="addmhs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<i class="fa fa-plus"></i> Tambah Matakuliah
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="addmhs" id="addmhs">
						<li><a href="#" data-toggle="modal" data-target="#addexcel">Dari Database</a></li>
						<li><a href="#" data-toggle="modal" data-target="#addexcel">Menggunakan Excel</a></li>
						<?php if (!empty($detail->id_kurikulum_sp)): ?>
							<li><a href="<?php echo base_url('index.php/prodi/kurikulum/getmkurfromfeeder/'.$detail->id_kurikulum_sp) ?>">Dari Data Feeder</a></li>
						<?php endif ?>
					</ul>
				</div>
				<table border="1" width="100%" id="kats" class="bts-ats">
					<thead>
						<tr>
							<th class="tengah fkpading" rowspan="2">NO</th>
							<th class="tengah fkpading" rowspan="2">KODE</th>
							<th class="tengah fkpading" rowspan="2">MATAKULIAH</th>
							<th class="tengah fkpading" rowspan="2">SMT</th>
							<th class="tengah fkpading" colspan="2">SKS</th>
							<th class="tengah fkpading" rowspan="2" colspan="2"></th>
						</tr>
						<tr>
							<th class="tengah fkpading">MK</th>
							<th class="tengah fkpading">TM</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1 ?>
						<?php foreach ($dtkur as $mhs): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $mhs->kode_mk ?></td>
								<td class="fkpading"><?php echo $mhs->nm_mk ?></td>
								<td class="tengah fkpading"><?php echo $mhs->smt ?></td>
								<td class="tengah fkpading"><?php echo (int)$mhs->sks_mk ?></td>
								<td class="tengah fkpading"><?php echo (int)$mhs->sks_tm ?></td>
								<td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/kurikulum/delete_mk_kurikulum/'.$getprod->kode_prodi.'/'.$detail->id.''.$mhs->idkur) ?>" onclick="javascript: return confirm('Yakin menghapus Matakuliah ini ?')"><label class="btn label label-danger"><i class="fa fa-trash"></i></label></a></td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal Add mk-->
<div class="modal fade" id="addmhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambahkan Matakuliah Lain</h4>
			</div>
			<form class="" action="<?php echo base_url('admin/Administrator_c/proses_add_mahasiswa'); ?>" method="post">

			</form>
		</div>
	</div>
</div>
<!-- modal add excel -->
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
				<form action="<?php echo base_url('index.php/prodi/kurikulum/proses_import_mk_kur'); ?>" method="post">
					<div class="form-group">
						<label for="exampleInputEmail1">Masukan File Exel</label>
						<input type="file" name="semester" class="form-control" placeholder="File.exl">
					</div>
					<button class="btn btn-default kanan" value="submit" name="submit">Upload</button>
				</form>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
</div>

