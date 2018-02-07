<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-prodi') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Daftar Dosen <?php echo $getprod->nama_prodi; ?></h4>
						<div class="txtabu">Daftar dosen prodi Universitas Dayanu Ikhsanuddin Baubau</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target="#addmhs"><i class="fa fa-plus-circle"></i> <b>Tambah Dosen</b></button>
					</div>
					<div class="media-right media-middle">
						<a href="<?php echo base_url('index.php/prodi/dosen/exportexldosen/'.$getprod->kode_prodi); ?>" class="btn buttonlist bghijau txtputih"><i class="fa fa-file-o"></i> <b>Import Excel</b></a>
					</div>
				</div>
				<div class="bts-ats2">
					<label class="label label-success"><?php echo $contoh; ?></label> Data ditemukan.
				</div>
				<form class="bts-ats" action="<?php echo base_url('index.php/prodi/dosen/dosenprodi/'.$getprod->kode_prodi); ?>" method="get">
					<div class="unirow">
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon">Dosen :</span>
								<input type="text" class="form-control" name="dosen" placeholder="Masukan Nama Dosen">
							</div>
						</div>
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon">Tahun :</span>
								<input type="text" class="form-control" name="tahun" placeholder="Tahun Ajaran">
							</div>
						</div>
						<div class="col-md-2 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<table class="bts-ats" width="100%" border="1">
					<thead>
						<tr>
							<th class="tengah fkpading" rowspan="2">NO</th>
							<th class="tengah fkpading" rowspan="2">NIK</th>
							<th class="tengah fkpading" rowspan="2">DOSEN</th>
							<th class="tengah fkpading" rowspan="2">MATAKULIAH</th>
							<th class="tengah fkpading" rowspan="2">TGL LAHIR</th>
							<th class="tengah fkpading" rowspan="2">T.A</th>
							<th class="tengah fkpading" colspan="2">TUGAS</th>
						</tr>
						<tr>
							<th class="tengah fkpading">NO SURAT</th>
							<th class="tengah fkpading">TANGGAL</th>
						</tr>
					</thead>
					<tbody id="dosenpt">
						<?php if (!empty($dtdosen)): ?>
							<?php $no=$nomor+1; ?>
							<?php foreach ($dtdosen as $data): ?>
								<tr>
									<td class="tengah fkpading"><?php echo $no; ?></td>
									<td class="fkpading"><?php echo $data->nik; ?></td>
									<td class="fkpading"><?php echo $data->nm_sdm; ?></td>
									<td class="fkpading"><?php echo $data->nm_mk; ?></td>
									<td class="tengah fkpading"><?php echo $data->tgl_lahir; ?></td>
									<td class="tengah fkpading"><?php echo $data->id_thn_ajaran; ?></td>
									<td class="tengah fkpading">
										<?php if ($data->no_srt_tgs !== ' ' || $data->no_srt_tgs !== NULL ): ?>
											<?php echo $data->no_srt_tgs; ?>
										<?php else: ?>
											-
										<?php endif ?>
									</td>
									<td class="tengah fkpading"><?php echo $data->tgl_srt_tgs; ?></td>
								</tr>
								<?php $no++; ?>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
							<td colspan="8" class="tengah" style="padding: 10px">Data kosong</td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
				<?php echo $pagging; ?>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>