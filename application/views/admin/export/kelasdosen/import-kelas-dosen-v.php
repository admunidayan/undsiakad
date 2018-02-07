<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu"><?php echo $title; ?> dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah data Dosen Feeder</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">DOSEN</th>
							<th rowspan="2" class="tengah fkpading">MATA KULIAH</th>
							<th rowspan="2" class="tengah fkpading">KELAS</th>
							<th colspan="6" class="tengah fkpading">SKS</th>
							<th colspan="2" class="tengah fkpading">TEMU</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">MK</th>
							<th class="tengah fkpading">SUB</th>
							<th class="tengah fkpading">TM</th>
							<th class="tengah fkpading">PRK</th>
							<th class="tengah fkpading">LAP</th>
							<th class="tengah fkpading">PLS</th>
							<th class="tengah fkpading">RENC</th>
							<th class="tengah fkpading">REAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=$nomor+1 ?>
						<?php foreach ($allkelas['result'] as $data): ?>
							<?php //echo "<pre>"; print_r($data);echo "</pre>"; ?>
							<?php $check = $this->Import_m->cekkelasdosen($data['id_ajar']); ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo ucwords(strtolower($data['fk__id_reg_ptk']));?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_mk']));?></td>
								<td class="tengah fkpading"><?php echo $data['nm_kls'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_mk'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_subst_tot'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_tm_subst'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_prak_subst'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_prak_lap_subst'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_sim_subst'];?></td>
								<td class="tengah fkpading"><?php echo $data['jml_tm_renc'];?></td>
								<td class="tengah fkpading"><?php echo $data['jml_tm_real'];?></td>
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
	      	<div class="tengah bts-ats"><button id="importdata" class="btn bghijau txtputih tengah" data-id="<?php echo $contoh; ?>" ><i class="fa fa-download"></i> Import data</button></div>
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