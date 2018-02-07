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
						<h4 class="media-heading"><b>Kelulusan Mahasiswa <?php echo $getprod->nama_prodi; ?></b></h4>
						<div class="txtabu">Daftar mahasiswa Lulus/Dropout dll</div>
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
				<label class="label label-success"><?php echo $contoh;?></label> Jumlah mahasiswa keseluruhan.
				<form class="bts-ats" action="<?php echo base_url('index.php/prodi/mahasiswa/mhsprodi/'.$getprod->id_prodi); ?>" method="get">
					<div class="unirow">
						<div class="col-md-5 unipd"></div>
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">NPM / Nama :</span>
								<input type="text" class="form-control" name="string" placeholder="Masukan NPM atau Nama">
							</div>
						</div>
						<div class="col-md-2 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<table border="1" width="100%" class="bts-ats">
					<thead>
						<tr>
							<th rowspan="2" class="fkpading tengah">NO</th>
							<th rowspan="2" class="fkpading tengah">NPM</th>
							<th rowspan="2" class="fkpading tengah">NAMA</th>
							<th rowspan="2" class="fkpading tengah">ANGKATAN</th>
							<th rowspan="2" class="fkpading tengah">JENIS KELUAR</th>
							<th rowspan="2" class="fkpading tengah">TGL KELUAR</th>
							<th rowspan="2" class="fkpading tengah">KETERANGAN</th>
							<th rowspan="2" class="fkpading tengah">EXP</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($hasil)): ?>
							<?php $no=$nomor+1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="tengah fkpading"><?php echo $no; ?></td>
									<td class="fkpading"><?php echo $data->npm; ?></td>
									<td class="fkpading"><?php echo $data->nama; ?></td>
									<td class="fkpading"><a href="#"><?php echo $this->Kelulusan_m->angkatan($data->npm)->angkatan; ?></a></td>
									<td class="tengah fkpading"><?php echo $this->Kelulusan_m->jnskel($data->id_jenis_keluar)->ket_keluar; ?></td>
									<td class="tengah fkpading"><?php echo $data->tanggal_keluar; ?></td>
									<td class="tengah fkpading"><?php echo $data->keterangan; ?></td>
									<td class="tengah fkpading">
									<?php if ($data->stat_feeder == 1): ?>
										<label class="label label-success">exported</label>
									<?php else: ?>
										<label class="label label-warning">not exported</label>
									<?php endif ?>
									</td>
								</tr>
								<?php $no++ ?>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td class="tengah fkpading" colspan="8"><i>Tidak ada data ditemukan</i></td>
							</tr>
						<?php endif ?>
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