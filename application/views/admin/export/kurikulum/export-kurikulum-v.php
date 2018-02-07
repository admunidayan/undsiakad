<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-export'); ?>
	<div class="col-md-10 unipd" style="overflow:auto;">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">export Kurikulum</h4>
						<div class="txtabu">export Program Studi dari Web Service Feeder</div>
					</div>
				</div>
				<div id="hasil"></div>
				<div class="bts-ats2">
					<label class="label label-success"><?php echo $contoh; ?></label> Data ditemukan
				</div>
				<form action="<?php echo base_url('index.php/admin/exportkur'); ?>" method="post">
					<table class="bts-ats" border="1" width="100%">
						<thead>
							<tr>
								<th rowspan="2" class="tengah fkpading"><input type="checkbox" id="select_all"></th>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">KURIKULUM</th>
								<th rowspan="2" class="tengah fkpading">BERLAKU</th>
								<th rowspan="2" class="tengah fkpading">JURUSAN</th>
								<th colspan="3" class="tengah fkpading">SKS</th>
								<th rowspan="2" class="tengah fkpading">SYC</th>
							</tr>
							<tr>
								<th class="tengah fkpading">WAJIB</th>
								<th class="tengah fkpading">PILIHAN</th>
								<th class="tengah fkpading">TOTAL</th>
							</tr>
						</thead>
						<tbody id="reloadkurikulum">
							<?php $no =$nomor+1; ?>
							<?php foreach ($hasil as $data): ?>
								<tr>
									<td class="tengah fkpading"><input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data->id_kurikulum; ?>"></td>
									<td class="tengah fkpading"><?php echo $no;?></td>
									<td class="fkpading"><?php echo $data->nama_kur;?></td>
									<td class="tengah fkpading"><?php echo $data->mulai_berlaku;?></td>
									<td class="fkpading"><?php echo $data->nama_jenjang_pend;?> <?php echo $data->nama_prodi;?></td>
									<td class="tengah fkpading"><?php echo $data->jml_sks_wajib;?></td>
									<td class="tengah fkpading"><?php echo $data->jml_sks_pilihan;?></td>
									<td class="tengah fkpading"><?php echo $data->total_sks;?></td>
									<td class="tengah fkpading">
										<?php if (!empty($data->id_kurikulum_sp)): ?>
											<label class="label label-success">exported</label>
										<?php else: ?>
											<label class="label label-warning">not exported</label>
										<?php endif ?>
									</td>
								</tr>
								<?php $no++; ?>
							<?php endforeach ?>
						</tbody>
					</table>
					<button class="btn btn-success tengah"><i class="fa fa-plus"></i> export Data Feeder</button>
				</form>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>