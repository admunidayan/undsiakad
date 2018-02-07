<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-mahasiswa') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-user-circle-o"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<?php echo $title; ?>
					</div>
				</div>
				<div class="bts-ats2">
					<h4><b>Detail Mahasiswa</b></h4>
					<table>
						<tr>
							<td>ID</td>
							<td style="padding: 0px 7px">:</td>
							<td><?php echo $getmhs->id_pd; ?></td>
						</tr>
						<tr>
							<td>NAMA LENGKAP</td>
							<td style="padding: 0px 7px">:</td>
							<td><?php echo strtoupper($getmhs->nm_pd); ?></td>
						</tr>
						<tr>
							<td>NIPD</td>
							<td style="padding: 0px 7px">:</td>
							<td><?php echo strtoupper($getmhs->nipd); ?></td>
						</tr>
						<tr>
							<td>PROGRAM STUDI</td>
							<td style="padding: 0px 7px">:</td>
							<td><?php echo strtoupper($getmhs->nm_lemb); ?></td>
						</tr>
					</table><hr/>
					<h4><b>Daftar Kuliah Mahasiswa</b></h4>
					<button id="addmk" class="btn btn-success" data-toggle="modal" data-target="#addaktifitas"><i class="fa fa-plus-circle"></i> <b>Tambah Kuliah Mahasiswa</b></button>
					<table border="1" class="bts-ats" width="100%">
						<thead>
							<tr>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">NIPD</th>
								<th rowspan="2" class="tengah fkpading">MAHASISWA</th>
								<th rowspan="2" class="tengah fkpading">PROGRAM STUDI</th>
								<th rowspan="2" class="tengah fkpading">SMT</th>
								<th rowspan="2" class="tengah fkpading">STAT</th>
								<th colspan="2" class="tengah fkpading">NILAI</th>
								<th colspan="2" class="tengah fkpading">SKS</th>
								<th colspan="2" rowspan="2" class="tengah fkpading"></th>
							</tr>
							<tr>
								<th class="tengah fkpading">IPS</th>
								<th class="tengah fkpading">IPK</th>
								<th class="tengah fkpading">TTL</th>
								<th class="tengah fkpading">SMT</th>
							</tr>
						</thead>
						<tbody id="nilaimk">
							<?php $no=1 ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="tengah fkpading"><?php echo $no; ?></td>
									<td class="tengah fkpading"><?php echo strtoupper($getmhs->nipd); ?></td>
									<td class="fkpading"><?php echo strtoupper($getmhs->nm_pd); ?></td>
									<td class="fkpading"><?php echo strtoupper($getmhs->nm_lemb); ?></td>
									<td class="tengah fkpading"><?php echo $data->id_smt; ?></td>
									<td class="tengah fkpading"><?php echo $data->nm_stat_mhs; ?></td>
									<td class="tengah fkpading"><?php echo $data->ips; ?></td>
									<td class="tengah fkpading"><?php echo $data->ipk; ?></td>
									<td class="tengah fkpading"><?php echo $data->sks_total; ?></td>
									<td class="tengah fkpading"><?php echo $data->sks_smt; ?></td>
									<td class="tengah fkpading">
										<a href="<?php echo base_url('index.php/prodi/mahasiswa/edit_aktifitas'.$data->id); ?>" class="label label-primary"><i class="fa fa-pencil"></i> Edit</a>
									</td>
									<td class="tengah fkpading">
										<a href="<?php echo base_url('index.php/prodi/mahasiswa/hapus_aktifitas'.$data->id); ?>" class="label label-danger"><i class="fa fa-trash"></i> Hapus</a>
									</td>
								</tr>
								<?php $no++; ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal Add Fakultas -->
<div class="modal fade" id="addaktifitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah" id="myModalLabel">Tambahkan Aktifitas Kuliah Mahasiswa</h4>
      </div>
      <form action="<?php echo base_url('index.php/prodi/mahasiswa/proses_add_akt'); ?>" method="post">
      	<div class="modal-body">
      		<div class="prfbox">
      			<div class="form-group bts-ats">
      				<label>Semester</label>
      				<input type="hidden" name="id_mhs_pt" value="<?php echo $getmhs->id_mhs_pt; ?>">
      				<input type="hidden" name="id_reg_pd" value="<?php echo $getmhs->id_reg_pd; ?>">
      				<select name="id_smt" class="form-control">
      					<?php foreach ($smtmhs as $data): ?>
      						<option value="<?php echo $data->id_smt; ?>"><?php echo $data->id_smt; ?></option>
      					<?php endforeach ?>
      				</select>
      			</div>
      			<div class="form-group bts-ats">
      				<label>Status</label>
      				<input type="hidden" name="nm_lemb" value="<?php echo $getmhs->nm_lemb; ?>">
      				<select name="id_stat_mhs" class="form-control">
      					<?php foreach ($stat as $data): ?>
      						<option value="<?php echo $data->id_stat_mhs; ?>"><?php echo $data->nm_stat_mhs; ?></option>
      					<?php endforeach ?>
      				</select>
      			</div>
      			<div class="form-group bts-ats">
      				<input type="hidden" name="mulai_smt" value="<?php echo $getmhs->mulai_smt; ?>">
      				<label>SKS Semester</label>
      				<input type="text" class="form-control" name="sks_smt" placeholder="Jumlah SKS" >
      			</div>
      			<div class="form-group bts-ats">
      				<label>IPS</label>
      				<input type="text" class="form-control" name="ips" placeholder="IPS" value="0.00" >
      			</div>
      			<div class="form-group bts-ats">
      				<label>IPK</label>
      				<input type="text" class="form-control" name="ipk" placeholder="IPK" value="0.00" >
      			</div>
      			<div class="form-group bts-ats">
      				<label>SKS Total</label>
      				<input type="text" class="form-control" name="sks_total" placeholder="SKS Total" >
      			</div>
      		</div>
      	</div>
      	<div class="modal-footer">
      		<input type="hidden" name="nipd" value="<?php echo $getmhs->nipd; ?>">
      		<input type="hidden" name="nm_pd" value="<?php echo strtoupper($getmhs->nm_pd); ?>">
      		<input type="hidden" name="jk" value="<?php echo strtoupper($getmhs->jk); ?>">
      		<input type="hidden" name="id_agama" value="<?php echo $getmhs->id_agama; ?>">
      		<input type="hidden" name="tmpt_lahir" value="<?php echo $getmhs->tmpt_lahir; ?>">
      		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      		<button type="submit" name="submit" value="submit" class="btn btn-success">Tambah</button>
      	</div>
      </form>
    </div>
  </div>
</div>