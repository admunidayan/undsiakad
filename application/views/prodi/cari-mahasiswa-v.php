<div class="unirow">
	<div class="col-md-12 unipd">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="bts-ats">
				<?php echo $this->session->flashdata('message');?>
			</div>
		<?php endif ?>
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="tengah"><h4><b>Program Studi <?php echo $getprod->nama_prodi; ?></b></h4></div>
				<div class="row">
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-info tengah">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ?>
				<div class="col-md-6">
				<form action="<?php echo base_url('index.php/prodi/mahasiswa/cari'); ?>/<?php echo $getprod->id_prodi; ?>" method="get">
						<div class="input-group">
							<span class="input-group-addon" id="sizing-addon1">NPM/Nama</span>
							<input type="text" name="cari" class="form-control" placeholder="Cari berdasarkan NPM atau Nama" aria-describedby="sizing-addon1">
							<span class="input-group-btn">
								<button style="width:100%" type="submit" name="submit" value="submit" class="btn btn-default tengah">Cari</button>
							</span>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<form action="<?php echo base_url('admin/mahasiswa_c/carimahasiswabyprodi'); ?>/<?php echo $getprod->id_prodi; ?>" method="post">
						<div class="input-group">
							<span class="input-group-addon" id="sizing-addon1">Angkatan</span>
							<input type="text" name="angkatan" class="form-control" placeholder="Angkatan..." aria-describedby="sizing-addon1">
							<span class="input-group-btn">
								<button style="width:100%" type="submit" name="submit" value="submit" class="btn btn-default tengah">Cari</button>
							</span>
						</div>
					</form>
				</div>
				<div class="sambungfloat"></div>
			</div>
			<hr/>
			<table class="table table-hover" width="100%" class="bts-ats">
				<thead>
					<tr>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">NO</div></th>
						<th rowspan="2" style="padding:2px 4px" class="tengah"><div class="dashsubttl3">IMG</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">NIP</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">NAMA</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">USERNAME</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">STATUS</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">ANGKATAN</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">TMPT LHR</div></th>
						<th rowspan="2" style="padding:10px 4px" class="tengah"><div class="dashsubttl3">TGL LHR</div></th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1 ?>
					<?php foreach ($dtmhs as $data): ?>
						<tr>
							<td style="padding:2px 4px" class="tengah"><?php echo $no; ?></td>
							<?php if ($data->foto_profil_mhs == 'avatar.png'): ?>
								<td style="padding:2px 4px" class="tengah">
									<div class="img-circle tengah" style="margin:auto;background-color: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>;width:33px;color: white;padding: 6px 4px;"><?php echo strtoupper(substr($data->nama_mhs, 0,2)); ?></div>
								</td>
							<?php else: ?>
								<td style="padding:2px 4px" class="tengah">
									<img class="img-circle" src="<?php echo base_url('asset/img/userimage'); ?>/<?php echo $data->foto_profil_mhs; ?>" width="20px">
								</td>
							<?php endif ?>
							<td style="padding:2px 4px"><div class="dashsubttl3 nobold"><?php echo $data->npm; ?></div></td>
							<td style="padding:2px 4px"><div class="dashsubttl3 nobold" style="text-align:left"><a href="<?php echo base_url('index.php/prodi/mahasiswa/detailmhs'); ?>/<?php echo $data->id_mhs; ?>"><?php echo $data->nama_mhs; ?></a></div></td>
							<td style="padding:2px 4px"><div class="dashsubttl3 nobold"><?php echo $data->username; ?></div></td>
							<td style="padding:2px 4px"><div class="dashsubttl3 nobold"><?php echo $data->status_mhs; ?></div></td>
							<td style="padding:2px 4px"><div class="dashsubttl3 nobold"><?php echo $data->angkatan; ?></div></td>
							<td style="padding:2px 4px" class="tengah">
								<div class="dashsubttl3 nobold" style="text-align: left"><?php echo $data->tmpt_lahir; ?></div>
							</td>
							<td style="padding:2px 4px" class="tengah">
								<div class="dashsubttl3 nobold"><?php echo $data->tgl_lhr_mhs; ?></div>
							</td>
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