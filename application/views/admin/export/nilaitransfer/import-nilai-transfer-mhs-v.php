<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Import Nilai Mahasiswa</h4>
						<div class="txtabu">Import Nilai Mahasiswa dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah data nilai Mahasiswa Feeder</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NPP</th>
							<th rowspan="2" class="tengah fkpading">MAHASISWA</th>
							<th colspan="5" class="tengah fkpading">ASAL</th>
							<th colspan="3" class="tengah fkpading">BARU</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">KODE</th>
							<th class="tengah fkpading">MATAKULIAH</th>
							<th class="tengah fkpading">SKS</th>
							<th class="tengah fkpading">ANK</th>
							<th class="tengah fkpading">AKUI</th>
							<th class="tengah fkpading">MATAKULIAH</th>
							<th class="tengah fkpading">HRF</th>
							<th class="tengah fkpading">IDX</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=$nomor+1 ?>
						<?php foreach ($allnilai['result'] as $data): ?>
							<?php $check = $this->Import_m->ceknilaitransfer($data['id_ekuivalensi']); ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data['nipd'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_pd']));?></td>
								<td class="tengah fkpading"><?php echo $data['kode_mk_asal'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_mk_asal']));?></td>
								<td class="tengah fkpading"><?php echo $data['sks_asal'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_huruf_asal'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_diakui'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['fk__nm_mk']));?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_huruf_diakui'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_angka_diakui'];?></td>
								<td class="tengah fkpading">
									<?php if ($check==true): ?>
										<label class="label label-success">imported</label>
									<?php else: ?>
										<label class="label label-warning">waiting</label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
				<?php echo $pagging; ?>
			</div> 
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- Modal import nilai -->
<div class="modal fade" id="modalnilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah"><?php echo $title; ?></h4>
      </div>
      <div class="modal-body">
      	<div style="margin-right: auto; margin-left: auto; padding: 28px 0px; width: 100px;" class="img-circle bghijau tengah txtputih">
      		<span style="font-size: 30px"><i class="fa fa-download"></i></span>
      	</div>
	      <div id="ktkimportdata">
	      	<div class="tengah bts-ats2">Yakin Melakukan Import data?</div>
	      	<div class="tengah bts-ats"><button id="importdata" class="btn bghijau txtputih tengah" data-id="<?php echo $jmlkls; ?>" ><i class="fa fa-download"></i> Import data</button></div>
	      </div>
       	<div id="demo"></div>
       	<div id="gagal"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"></script>