<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import'); ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu"><?php echo $title; ?> dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div id="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?> Prodi</label> Jumlah program Studi Feeder</div>
				<table class="bts-ats" border="1" width="100%" style="font-size: 11px">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE</th>
							<th rowspan="2" class="tengah fkpading">PRODI</th>
							<th rowspan="2" class="tengah fkpading">SKS</th>
							<th rowspan="2" class="tengah fkpading">SK</th>
							<th rowspan="2" class="tengah fkpading">SMT MULAI</th>
							<th colspan="2" class="tengah fkpading">TANGGAL</th>
							<th rowspan="2" class="tengah fkpading">STATUS</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">SK SELENGGARA</th>
							<th class="tengah fkpading">BERDIRI</th>
						</tr>
					</thead>
					<?php $no=$nomor+1; ?>
					<tbody id="reloadprodi">
						<?php foreach ($allprod['result'] as $data): ?>
							<?php $check = $this->Isi_m->cekprodi($data['id_sms']); ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data['kode_prodi']; ?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/admin/import/detail_prodi/'.$data['id_sms']) ?>"><?php echo $data['nm_lemb']; ?></a></td>
								<td class="tengah fkpading"><?php echo $data['sks_lulus']; ?></td>
								<td class="tengah fkpading"><?php echo $data['sk_selenggara']; ?></td>
								<td class="tengah fkpading"><?php echo $data['smt_mulai']; ?></td>
								<td class="tengah fkpading"><?php echo $data['tgl_sk_selenggara']; ?></td>
								<td class="tengah fkpading"><?php echo $data['tgl_berdiri']; ?></td>
								<td class="tengah fkpading"><?php echo $data['stat_prodi']; ?></td>
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
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>