
<div class="unirow" id="mainpage">
	<div class="col-md-12 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Rekaptulasi data Siakad</h4>
						<div class="txtabu">Rekapan Data siakad, jumlah dan presentase pertahun</div>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="row">
					<div class="col-md-6">
						<div class="bts-ats2"><b>Jumlah Keaktifan Mahasiswa</b></div>
						<form class="bts-ats" action="<?php echo base_url('index.php/admin/rekaptulasi/data'); ?>" method="get">
							<div class="unirow">
								<div class="col-md-10 unipd">
									<div class="input-group input-group-sm">
										<span class="input-group-addon" id="basic-addon1">tahun ajaran :</span>
										<select class="form-control" name="string">
											<?php foreach ($hasil as $semt): ?>
												<option value="<?php echo $semt->id_smt ?>"><?php echo $semt->nm_smt; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-2 unipd">
									<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
								</div>
								<div class="sambungfloat"></div>
							</div>
						</form>
						<table border="1" class="bts-ats" width="100%" style="font-size: 11px">
							<thead>
								<tr>
									<th rowspan="2" class="tengah fkpading">NO</th>
									<th rowspan="2" class="tengah fkpading">PROGRAM STUDI</th>
									<th rowspan="4" class="tengah fkpading">JUMLAH</th>
									<th colspan="4" class="tengah fkpading">STATUS AKTIF MAHASISWA</th>
									<th rowspan="2" class="tengah fkpading">CETAK</th>
								</tr>
								<tr>
									<th class="tengah fkpading">AKTIF</th>
									<th class="tengah fkpading">CUTI</th>
									<th class="tengah fkpading">NON-AKTIF</th>
									<th class="tengah fkpading">DOUBLE DEGREE</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =$nomor+1; ?>
								<?php foreach ($prodi as $prod): ?>
									<tr>
										<td class="tengah fkpading"><?php echo $no;?></td>
										<td class="fkpading"><?php echo strtoupper($prod->nm_jenj_didik.' '.$prod->nm_lemb);?></td>
										<td class="tengah fkpading"><?php echo $this->Rekap_m->jumlah_mhs($prod->id_sms,$semes); ?></td>
										<td class="tengah fkpading"><?php echo $this->Rekap_m->jumlah($prod->id_sms,$semes,'A'); ?></td>
										<td class="tengah fkpading"><?php echo $this->Rekap_m->jumlah($prod->id_sms,$semes,'C'); ?></td>
										<td class="tengah fkpading"><?php echo $this->Rekap_m->jumlah($prod->id_sms,$semes,'N'); ?></td>
										<td class="tengah fkpading"><?php echo $this->Rekap_m->jumlah($prod->id_sms,$semes,'G'); ?></td>
										<td class="tengah fkpading">
											<a href="<?php echo base_url('index.php/admin/rekaptulasi/data/dataexcel/'.$prod->id_sms.'/'.$semes) ?>" target="_blank"><label class="label label-success">cetak</label></a>
										</td>
									</tr>
									<?php $no++; ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<div class="bts-ats2"><b>Cetak Data Mahasiswa</b></div>
						
					</div>
				</div>
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