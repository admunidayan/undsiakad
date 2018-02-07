<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-prodi') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-th-list"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><b>Program Studi <?php echo $getprod->nm_lemb; ?></b></h4>
						<div class="txtabu">Daftar mahasiswa terdaftar</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target="#addexcel"><i class="fa fa-plus-circle"></i> <b>Tambah Mahasiswa Banyak</b></button>
					</div>
					<div class="media-right media-middle">
						<button class="btn buttonlist bgbirut txtputih"><i class="fa fa-plus-circle"></i> <b>Tambah Mahasiswa</b></button>
					</div>
				</div>
				<div class="row bts-ats2">
					<?php if ($this->session->flashdata('message')): ?>
						<div class="alert alert-info tengah">
							<?php echo $this->session->flashdata('message');?>
						</div>
					<?php endif ?>
					<?php if ($this->session->flashdata('export')): ?>
						<?php echo $this->session->flashdata('export');?>
					<?php endif ?>
				</div>
				<?php echo $jmlmhs; ?>
				<form class="bts-ats" action="<?php echo base_url('index.php/prodi/mahasiswa/mhsprodi/'.$getprod->kode_prodi); ?>" method="get">
					<div class="unirow">
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">NPM / Nama :</span>
								<input type="text" class="form-control" name="string" placeholder="Masukan NPM atau Nama">
							</div>
						</div>
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Angkatan :</span>
								<input type="text" class="form-control" name="angkatan" placeholder="Angkatan Mahasiswa">
							</div>
						</div>
						<div class="col-md-2 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<table border="1" width="100%" class="bts-ats" style="font-size: 12px">
					<thead>
						<tr>
							<th rowspan="2" class="fkpading tengah">NO</th>
							<th rowspan="2" class="fkpading tengah">NIP</th>
							<th rowspan="2" class="fkpading tengah">NAMA</th>
							<th rowspan="2" class="fkpading tengah">ANGKATAN</th>
							<th colspan="2" class="fkpading tengah">TEMPAT TGL LHR</th>
							<th rowspan="2" class="fkpading tengah">STATUS</th>
							<th rowspan="2" class="fkpading tengah">EXPORT</th>
						</tr>
						<tr>
							<th class="tengah fkpading">TEMPAT</th>
							<th class="tengah fkpading">TANGGAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=$nmr+1 ?>
						<?php foreach ($dtmhsprd as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data->nipd; ?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/prodi/mahasiswa/detailmhs'); ?>/<?php echo $data->nipd; ?>"><?php echo $data->nm_pd; ?></a></td>
								<td class="tengah fkpading"><?php echo $data->mulai_smt; ?></td>
								<td class="fkpading"><?php echo $data->tmpt_lahir; ?></td>
								<td class="tengah fkpading"><?php echo $data->tgl_lahir; ?></td>
								<td class="tengah fkpading">
									<?php if ($this->Mahasiswa_m->get_stat($data->id)->id_jns_keluar == TRUE): ?>
										LULUS
									<?php else: ?>
										AKTIF
									<?php endif ?>
								</td>
								<td class="tengah fkpading">
									<?php if (!empty($data->id_pd)): ?>
										<label class="label label-success">exported</label>
									<?php else: ?>
										<label class="label label-warning">not exported</label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<?php echo $pagging; ?>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>	
</div>
<div class="sambungfloat"></div>
</div>
<!-- modal add excel -->
<!-- modal add excel -->
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
				<form action="<?php echo base_url('index.php/admin/exportmhs'); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_prodi" value="<?php echo $getprod->id_prodi; ?>">
					<input type="hidden" name="id_jenjang_pend" value="<?php echo $getprod->id_jenjang_pend; ?>">
					<input type="hidden" name="id_fakultas" value="<?php echo $getprod->id_fakultas; ?>">
					<input type="hidden" name="kode_prodi" value="<?php echo $getprod->kode_prodi; ?>">
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