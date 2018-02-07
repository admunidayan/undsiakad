<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-keuangan') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 prfbox bts-ats">
			<div class="media">
				<div class="media-left media-middle">
					<div class="dashsubttl"><i class="fa fa-graduation-cap"></i></div>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Daftar Program Studi</h4>
					<div class="txtabu">Daftar lengkap Program Studi Universitas Dayanu Ikhsanuddin Baubau</div>
				</div>
			</div>
			<div class="prfbox">
				<table border="1" class="bts-ats2" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE</th>
							<th rowspan="2" class="tengah fkpading">NAMA PRODI</th>
							<th rowspan="2" class="tengah fkpading">FAKULTAS</th>
							<th rowspan="2" class="tengah fkpading">SMT MULAI</th>
							<th rowspan="2" class="tengah fkpading">SKS</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;?>
						<?php foreach ($allprod as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data->kode_prodi; ?></td>
								<td class="fkpading">
									<a href="<?php echo base_url('index.php/admin/keuangan/sistem/listdata/'.$thn.'/'.$data->kode_prodi); ?>"><?php echo $data->nama_jenjang_pend; ?> <?php echo $data->nama_prodi; ?></a>
								</td>
								<td class="fkpading"><?php echo $data->nama_fakultas; ?></td>
								<td class="tengah fkpading"><?php echo $data->smt_mulai; ?></td>
								<td class="tengah fkpading"><?php echo $data->sks_lulus; ?></td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>