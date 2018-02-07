<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import'); ?>
	<div class="col-md-10 unipd" style="overflow:auto;">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu">Import Program Studi dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<a href="<?php echo base_url('index.php/isi_db/kurikulum') ?>" class="btn btn-success tengah"><i class="fa fa-plus"></i> Import Data Feeder</a>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="bts-ats">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ?>
				<div id="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah <?php echo $title; ?> Feeder</div>
				<table class="bts-ats2" border="1" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KURIKULUM</th>
							<th rowspan="2" class="tengah fkpading">BERLAKU</th>
							<th colspan="3" class="tengah fkpading">SKS</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">WJB</th>
							<th class="tengah fkpading">PLN</th>
							<th class="tengah fkpading">LLS</th>
						</tr>
					</thead>
					<tbody id="reloadkurikulum">
						<?php $no =1; ?>
						<?php foreach ($hasil['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/admin/import/matakuliah_kurikulum_prodi/'.$data['id_kurikulum_sp']) ?>"><?php echo ucwords(strtolower($data['nm_kurikulum_sp'])) ; ?></a></td>
								<td class="tengah fkpading"><?php echo $data['id_smt'];?></td>
								<td class="tengah fkpading"><?php echo $data['jml_sks_wajib'];?></td>
								<td class="tengah fkpading"><?php echo $data['jml_sks_pilihan'];?></td>
								<td class="tengah fkpading"><?php echo $data['jml_sks_lulus'];?></td>
								<td class="tengah fkpading">
									<?php if ($this->Import_m->cekkur($data['id_kurikulum_sp'])== True): ?>
										<label class="label label-success">Imported</label>
									<?php else: ?>
										<label class="label label-warning">Waiting</label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- Modal import -->
<div class="modal fade" id="modalkur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
	      	<div class="tengah bts-ats"><a href="<?php echo base_url('index.php/admin/import_p/input_bnyk/kurikulum'); ?>" class="btn bghijau txtputih tengah"><i class="fa fa-download"></i> Import data</a></div>
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