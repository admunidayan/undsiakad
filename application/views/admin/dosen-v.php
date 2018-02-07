<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-dosen') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Daftar Dosen</h4>
						<div class="txtabu">Daftar lengkap Dosen Universitas</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> <b>Buat Dosen baru</b></button>
					</div>
					<div class="media-right media-middle">
						<a href="<?php echo base_url('index.php/admin/dosen/exportexldosen'); ?>" class="btn buttonlist bghijau txtputih"><i class="fa fa-file-o"></i> <b>Export to Excel</b></a>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-success alert-dismissible tengah" role="alert" style="margin-bottom:7px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-warning"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
					</div>
				<?php endif ;?>
				<form class="bts-ats" action="<?php echo base_url('index.php/admin/dosen'); ?>" method="get">
					<div class="unirow">
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">NIDN / Nama :</span>
								<input type="text" class="form-control" name="dosen" placeholder="Masukan NIDN atau Nama">
							</div>
						</div>
						<div class="col-md-2 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<div class="bts-ats">
					<table border="1"  width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NPP</th>
							<th rowspan="2" class="tengah fkpading">DOSEN</th>
							<th rowspan="2" class="tengah fkpading">USERNAME</th>
							<th rowspan="2" class="tengah fkpading">L/P</th>
							<th colspan="2" class="tengah fkpading">TTL</th>
							<th rowspan="2" class="tengah fkpading">AGAMA</th>
							<th rowspan="2" class="tengah fkpading">STATUS</th>
						</tr>
						<tr>
							<th class="tengah fkpading">TGL</th>
							<th class="tengah fkpading">TEMPAT</th>
						</tr>
					</thead>
						<?php $no=$nomor+1; ?>
						<?php foreach ($alldosen as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data->npp; ?></td>
								<td class="fkpading">
									<a href="<?php echo base_url('index.php/admin/dosen/detail/'.$data->id_dosen); ?>"><?php echo ucwords(strtolower($data->nama_dosen)); ?></a>
								</td>
								<td class="tengah fkpading"><?php echo $data->username; ?></td>
								<td class="tengah fkpading"><?php echo $data->gender_dosen; ?></td>
								<td class="fkpading"><?php echo $data->tgl_lhr_dosen; ?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data->tempat_lahir)); ?></td>
								<td class="fkpading"><?php echo $data->agama_dosen; ?></td>
								<td class="tengah fkpading">
									<?php if ($data->status_dosen == 'Aktif'): ?>
										<label class="label label-success"><?php echo $data->status_dosen; ?></label>
									<?php else: ?>
										<label class="label label-warning"><?php echo $data->status_dosen; ?></label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</table>
					<?php echo $pagging; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal -->
<div class="modal fade" id="add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Buat Karyawan baru</h4>
						<div class="txtabu">membuat karyawan baru Universitas</div>
					</div>
				</div>	
			</div>
			<form action="<?php echo base_url('index.php/admin/karyawan/proses_add_karyawan'); ?>" method="post">
				<div class="modal-body">
					<table width="100%">
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nama Depan </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="namadep" placeholder="Nama Depan">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nama Belakang </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="namabel" placeholder="Nama Belakang">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Username </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="username" placeholder="Username">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Password </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="Password" class="fkinput2" name="password" placeholder="Minimal 8 karakter, Maksimal 25 karakter">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Email </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="email" class="fkinput2" name="email" placeholder="example@und.ac.id">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nomor HP </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="phone" placeholder="0823-1234-5678">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Hak Akses </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<?php foreach ($allgroup as $grb): ?>
									<?php if ($grb->name !== 'admin'): ?>
										<div class="col-md-6">
											<input type="checkbox" name="group[]" value="<?php echo $grb->id; ?>"><label class="label label-success"><?php echo $grb->name; ?></label> <?php echo $grb->description; ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
								<div class="sambungfloat"></div>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" value="submit" class="btn btn-info">Simpan akun</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		$( "#progressbar" ).progressbar({
			value: 37
		});
	// progressbar 2
	var progressbar = $( "#progressbar2" ),
	progressLabel = $( ".progress-label" );

	progressbar.progressbar({
		value: false,
		change: function() {
			progressLabel.text( progressbar.progressbar( "value" ) + "%" );
		},
		complete: function() {
			progressLabel.text( "Complete!" );
		}
	});

});
</script>