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
				<table border="1" class="bts-ats2" width="100%">
					<thead>
						<tr>
							<th class="tengah fkpading">No</th>
							<th class="tengah fkpading">Nama Table</th>
							<th class="tengah fkpading">Jenis</th>
							<th class="tengah fkpading">Keterangan</th>
							<th class="tengah fkpading">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1 ?>
						<?php foreach ($table['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/admin/import/diktio/'.$data['table']); ?>"><?php echo $data['table']; ?></a></td>
								<td class="tengah fkpading"><?php echo $data['jenis']; ?></td>
								<td class="fkpading"><?php echo $data['keterangan']; ?></td>
								<td class="tengah fkpading"><label class="label label-info">ready</label></td>
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