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
						<h4 class="media-heading">Kelas Kuliah Program Studi <?php  echo $detkel->nm_lemb; ?></h4>
						<div class="txtabu">Daftar Kelas Kuliah yang terdaftar pada Prodi <?php echo $detkel->nm_lemb ?>.</div>
					</div>
					<div class="media-right media-middle">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addexcel">
							<i class="fa fa-plus"></i> <b>Tambah Kelas Banyak</b>
						</button>
					</div>
					<div class="media-right media-middle">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#profile">
							<i class="fa fa-plus"></i> <b>Tambah Kelas</b>
						</button>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-info alert-dismissible bts-ats bts-bwh" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('export')): ?>
					<?php echo $this->session->flashdata('export');?>
				<?php endif ?>
				<h1></h1><hr/>
				<?php echo $contoh.' Kelas Ditemukan'; ?>
				<form class="bts-ats" action="<?php echo base_url('index.php/prodi/kelas/kelasprodi/'.$getprod->kode_prodi); ?>" method="get">
					<div class="unirow">
						<div class="col-md-7 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Matakuliah :</span>
								<input type="text" class="form-control" name="matakuliah" placeholder="Masukan Nama Matakuliah">
							</div>
						</div>
						<div class="col-md-4 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Semester :</span>
								<input type="text" class="form-control" name="semester" placeholder="Semester Kelas">
							</div>
						</div>
						<div class="col-md-1 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<table border="1" width="100%" class="bts-ats">
					<thead>
						<tr> 
							<th class="tengah fktblpad" rowspan="2">No</th>
							<th class="tengah fktblpad" rowspan="2">Kode</th>
							<th class="tengah fktblpad" rowspan="2">Matakuliah</th>
							<th class="tengah fktblpad" rowspan="2">Semester</th>
							<th class="tengah fktblpad" rowspan="2">Kelas</th>
							<th class="tengah fktblpad" colspan="2">SKS</th>
							<th class="tengah fktblpad" rowspan="2">SYC</th>
							<th class="tengah fktblpad" rowspan="2"></th>
						</tr>
						<tr>
							<th class="tengah fktblpad">MK</th>
							<th class="tengah fktblpad">TM</th>
						</tr>
					</thead>
					<tbody> 
						<?php $no=$nomor+1; ?>
						<?php foreach ($allhasil as $data): ?>
							<tr> 
								<td class="tengah fktblpad"><?php echo $no; ?></td>
								<td class="tengah fktblpad"><?php echo $data->kode_mk; ?></td>
								<td class="fktblpad"><a href="<?php echo base_url('index.php/prodi/kelas/mhskelas/'); ?><?php echo $data->id_kelas; ?>"><?php echo strtoupper($data->nm_mk);?></a></td>
								<td class="tengah fktblpad"><?php echo $data->id_smt ?></td>
								<td class="tengah fktblpad"><?php echo $data->nm_kls ?></td>
								<td class="tengah fktblpad"><?php echo $data->sks_mk ?></td>
								<td class="tengah fktblpad"><?php echo $data->sks_tm ?></td>
								<td class="tengah fktblpad">
									<?php if (!empty($data->id_kls)): ?>
										<label class="label label-success">exported</label>
									<?php else: ?>
										<label class="label label-warning">not exported</label>
									<?php endif ?>
								</td>
								<td class="tengah fktblpad"><a href="<?php echo base_url('index.php/prodi/kelas/delete_kelas/'.$detkel->kode_prodi.'/'.$data->id_kelas); ?>" onclick="javascript: return confirm('Yakin menghapus Kelas ini ?')"><label class="btn label label-danger"><i class="fa fa-trash"></i> Hapus</label></a></td>
							</tr>
							<?php  $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<?php echo $pagging; ?>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-title">
        	<div class="media">
        		<div class="media-left media-middle">
        			<div class="dashsubttl"><i class="fa fa-institution"></i></div>
        		</div>
        		<div class="media-body">
        			<h4 class="media-heading">Form Tambah Kelas Kuliah</h4>
        			<div class="txtabu">Input data kelas kuliah baru</div>
        		</div>
        	</div>
        </div>
      </div>
      <form action="<?php echo base_url('index.php/prodi/kelas/proses_input_kelas'); ?>" method="post">
      	<input type="hidden" name="id_sms" value="<?php echo $detkel->id_sms ?>">
      	<div class="modal-body">
      		<div class="prfbox">
      			<div class="form-group form-group-lg">
      				<div class="form-group form-group-lg">
      					<label for="exampleInputEmail1">Program Studi</label>
      					<div class="form-control"><?php echo $detkel->nm_lemb; ?></div>
      				</div>
      				<label for="exampleInputEmail1">Mata Kuliah</label>
      				<input type="hidden" name="kode_prodi" value="<?php echo $detkel->kode_prodi ?>">
      				<select name="id_mk_siakad" class="form-control">
      					<?php foreach ($idkur as $kuri): ?>
      						<?php foreach ($this->Kelas_m->mk_prod($kuri->id) as $key): ?>
      							<option class="fkpading" value="<?php echo $key->id; ?>"><?php echo ucwords(strtolower($key->nm_mk)).' ('.$kuri->nm_kurikulum_sp.')'; ?></option>
      						<?php endforeach ?>
      					<?php endforeach ?>
      				</select>
      			</div>
      			<div class="form-group form-group-lg">
      				<input type="hidden" name="id_prodi" value="<?php echo $detkel->kode_prodi ?>">
      				<label for="exampleInputEmail1">Semester</label>
      				<select name="id_smt" class="form-control">
      					<?php foreach ($smt as $key): ?>
      						<option class="fkpading" value="<?php echo $key->id_smt; ?>"><?php echo $key->id_smt; ?></option>
      					<?php endforeach ?>
      				</select>
      			</div>
      			<div class="form-group form-group-lg">
      				<label for="exampleInputEmail1">Kelas</label>
      				<input type="text" class="form-control" name="nm_kls" placeholder="Nama Kelas">
      			</div>
      			<div class="form-group form-group-lg">
      				<label for="exampleInputEmail1">bahasan</label>
      				<textarea name="bahasan" class="form-control" placeholder="Bahasan"></textarea>
      			</div>
      			<div class="row">
      				<div class="col-md-6">
      					<div class="form-group form-group-lg">
      						<label for="exampleInputEmail1">Tanggal Mulai</label>
      						<input type="text" class="form-control" name="tgl_mulai" placeholder="Tanggal Mulai">
      					</div>
      				</div>
      				<div class="col-md-6">
      					<div class="form-group form-group-lg">
      						<label for="exampleInputEmail1">Tanggal Selesai</label>
      						<input type="text" class="form-control" name="tgl_selesai" placeholder="Tanggal Mulai">
      					</div>
      				</div>
      			</div>
      			<div class="sambungfloat"></div>
      		</div>
      		<div class="sambungfloat"></div>
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
      		<button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg"><b>Tambah Kelas Baru</b></button>
      	</div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- modal add excel -->
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
				<form action="<?php echo base_url('index.php/admin/exportkls'); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_prodi" value="<?php echo $detkel->id_prodi; ?>">
					<input type="hidden" name="kode_prodi" value="<?php echo $detkel->kode_prodi; ?>">
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