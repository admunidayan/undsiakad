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
				<?php if ($hasil['error_code'] !== '0'): ?>
					<div class="alert alert-info bts-ats2">
						<p>ERROR - <?php echo $hasil['error_code']; ?></p>
						<p><?php echo $hasil['error_desc']; ?></p>
					</div>
				<?php endif ?>
				<table border="1" class="bts-ats2" width="100%">
					<thead>
						<tr>
						<th class="tengah fkpading">No</th>
						<th class="tengah fkpading">Nama Kolom</th>
						<th class="tengah fkpading">Primary<br/>Key</th>
						<th class="tengah fkpading">Type</th>
						<th class="tengah fkpading">Not Null</th>
						<th class="tengah fkpading">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1 ?>
						<?php foreach ($hasil['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data['column_name']; ?></td>
								<?php if (!empty($data['pk'])): ?>
									<td class="tengah fkpading">
										<?php if ($data['pk'] == 1): ?>
											<?php echo "Ya"; ?>
										<?php endif ?>
									</td>
								<?php else: ?>
									<td class="tengah fkpading">-</td>	
								<?php endif ?>
								<?php if (!empty($data['type'])): ?>
									<td class="fkpading"><?php echo $data['type']; ?></td>
								<?php else: ?>
									<td class="tengah fkpading">-</td>	
								<?php endif ?>
								<?php if (!empty($data['not_null'])): ?>
									<td class="tengah fkpading">
										<?php if ($data['not_null'] == 1): ?>
											<?php echo "Ya"; ?>
										<?php endif ?>
									</td>
								<?php else: ?>
									<td class="tengah fkpading">-</td>	
								<?php endif ?>
								<?php if (!empty($data['desc'])): ?>
									<td class="fkpading"><?php echo $data['desc']; ?></td>
								<?php else: ?>
									<td class="tengah fkpading">-</td>	
								<?php endif ?>
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