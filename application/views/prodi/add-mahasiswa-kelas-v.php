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
						<h4 class="media-heading">MATAKULIAH <?php  echo ucwords($nmkls->nm_mk); ?></h4>
						<div class="txtabu">Daftar Mahasiswa kelas kuliah <?php  echo $nmkls->nm_mk; ?>.</div>
					</div>
				</div>
				<form class="bts-ats" action="<?php echo base_url('index.php/prodi/kelas/tmbhmhsbanyak/'.$getprod->kode_prodi.'/'.$nmkls->id_kelas); ?>" method="get">
					<div class="unirow">
						<div class="col-md-7 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Nama | NIPD :</span>
								<input type="text" class="form-control" name="nama" placeholder="Masukan Nama atau Nomor Stambuk Mahasiswa">
							</div>
						</div>
						<div class="col-md-4 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Angkatan :</span>
								<input type="text" class="form-control" name="angkatan" placeholder="Angkatan Mahasiswa">
							</div>
						</div>
						<div class="col-md-1 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<form action="<?php echo base_url('index.php/prodi/kelas/prosesaddmhs/'.$getprod->kode_prodi.'/'.$nmkls->id_kelas) ?>" method="post">
					<table border="1" width="100%" class="bts-ats">
						<thead>
							<tr>
								<th rowspan="2" class="fkpading tengah"></th>
								<th rowspan="2" class="fkpading tengah">NO</th>
								<th rowspan="2" class="fkpading tengah">NIPD</th>
								<th rowspan="2" class="fkpading tengah">NAMA</th>
								<th rowspan="2" class="fkpading tengah">ANGKATAN</th>
								<th colspan="2" class="fkpading tengah">TEMPAT TGL LHR</th>
							<tr>
								<th class="tengah fkpading">TEMPAT</th>
								<th class="tengah fkpading">TANGGAL</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = $nomor+1; ?>
							<?php foreach ($mhskls as $data): ?>
								<tr>
									<td class="tengah fkpading"><input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data->id_mhs_pt ?>"></td>
									<td class="tengah fkpading"><?php echo $no; ?></td>
									<td class="tengah fkpading"><?php echo $data->nipd; ?></td>
									<td class="fkpading"><?php echo $data->nm_pd; ?></td>
									<td class="tengah fkpading"><?php echo $data->mulai_smt; ?></td>
									<td class="fkpading"><?php echo $data->tmpt_lahir; ?></td>
									<td class="tengah fkpading"><?php echo $data->tgl_lahir; ?></td>
								</tr>
								<?php $no++ ?>
							<?php endforeach ?>
						</tbody>
					</table>
					<div>
						<button type="submit" name="submit" value="submit" class="btn btn-success bts-ats">Tambah Mahasiswa</button>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<?php echo $pagging; ?>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>