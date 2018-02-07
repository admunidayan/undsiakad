<div class="unirow">
	<div class="col-md-12 unipd">
		<div class="whitebox2 prfbox bts-ats">
			<div class="media">
				<div class="media-left media-middle">
					<div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Daftar Program Studi</h4>
					<div class="txtabu">Daftar lengkap Program Studi Universitas Dayanu Ikhsanuddin Baubau</div>
				</div>
				<div class="media-right media-middle">
					<button class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target="#addexcel"><i class="fa fa-plus-circle"></i> <b>Tambah Mahasiswa Banyak</b></button>
				</div>
			</div>
			<?php if ($this->session->flashdata('export')): ?>
				<?php echo $this->session->flashdata('export');?>
			<?php endif ?>
			<div class="prfbox">
				<table border="1" class="bts-ats2" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE</th>
							<th rowspan="2" class="tengah fkpading">NAMA PRODI</th>
							<th rowspan="2" class="tengah fkpading">SMT MULAI</th>
							<th rowspan="2" class="tengah fkpading">SKS</th>
							<th colspan="3" class="tengah fkpading">SK</th>
							<th rowspan="2" class="tengah fkpading">STAT</th>
						</tr>
						<tr>
							<th class="tengah fkpading">SURAT</th>
							<th class="tengah fkpading">TGL SURAT</th>
							<th class="tengah fkpading">TGL BERDIRI</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;?>
						<?php foreach ($allprod as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data->kode_prodi; ?></td>
								<td class="fkpading">
									<a href="<?php echo base_url('index.php/prodi/prodi/dataprodi/'.$data->kode_prodi); ?>"><?php echo $data->nm_lemb; ?></a>
								</td>
								<td class="tengah fkpading"><?php echo $data->smt_mulai; ?></td>
								<td class="tengah fkpading"><?php echo $data->sks_lulus; ?></td>
								<td class="tengah fkpading"><?php echo $data->sk_selenggara; ?></td>
								<td class="tengah fkpading"><?php echo $data->tgl_sk_selenggara; ?></td>
								<td class="tengah fkpading"><?php echo $data->tgl_berdiri; ?></td>
								<td class="tengah fkpading">
									<?php if ($data->stat_prodi=='A'): ?>
										<label class="label label-success">Aktif</label>
									<?php else: ?>
										<label class="label label-warning"><?php echo $data->stat_prodi; ?></label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
				<form action="<?php echo base_url('index.php/admin/exportmhs'); ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Masukan File Exel</label>
						<input type="file" name="semester" class="form-control" placeholder="File.exl">
					</div>
					<div class="alert alert-info bts-ats">
						<b>PENTING!</b><br/>Data Mahasiswa baru yang dimasukan harus sesuai dengan format "penambahan mahasiswa sekaligus untuk seluruh Program Studi. Pastikan data yang dimasukan sudah sesuai format.
					</div>
					<button class="btn btn-default kanan" value="submit" name="submit">Upload</button>
				</form>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
</div>