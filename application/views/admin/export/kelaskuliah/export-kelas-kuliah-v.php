<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-export') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Import Kelas Kuliah</h4>
						<div class="txtabu">Import Kelas Kuliah dari Web Service Feeder</div>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah Kelas Kuliah Feeder <?php echo $contoh; ?></div>
				<form action="<?php echo base_url('index.php/admin/export/proses_export_kls'); ?>" method="post">
					<table border="1" class="bts-ats" width="100%">
						<thead>
							<tr>
								<th rowspan="2" class="tengah fkpading"><input type="checkbox" id="select_all"></th>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">KODE MK</th>
								<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
								<th rowspan="2" class="tengah fkpading">KLS</th>
								<th rowspan="2" class="tengah fkpading">SMT</th>
								<th colspan="4" class="tengah fkpading">SKS</th>
								<th rowspan="2" class="tengah fkpading">ACTION</th>
							</tr>
							<tr>
								<th class="tengah fkpading">MK</th>
								<th class="tengah fkpading">TM</th>
								<th class="tengah fkpading">PRAK</th>
								<th class="tengah fkpading">LAP</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($hasil)): ?>
								<?php $no = $nomor+1; ?>
								<?php foreach ($hasil as $data): ?>
									<tr>
										<td class="tengah fkpading"><input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data->idkelas; ?>"></td>
										<td class="tengah fkpading"><?php echo $no;?></td>
										<td class="tengah fkpading"><?php echo $data->id_mk_siakad;?></td>
										<td class="fkpading"><?php echo ucwords(strtolower($data->nm_mk));?></td>
										<td class="tengah fkpading"><?php echo $data->nm_kls;?></td>
										<td class="tengah fkpading"><?php echo $data->id_smt;?></td>
										<td class="tengah fkpading"><?php echo $data->sks_mk;?></td>
										<td class="tengah fkpading"><?php echo $data->sks_tm;?></td>
										<td class="tengah fkpading"><?php echo $data->sks_prak;?></td>
										<td class="tengah fkpading"><?php echo $data->sks_prak_lap;?></td>
										<td class="tengah fkpading"><label class="label label-warning">Not Exxported</label></td>
									</tr>
									<?php $no++; ?>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td class="tengah fkpading" colspan="10"><i>Tidak ada data ditemukan.</i></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
					<?php echo $pagging; ?>
					<button id="exportmhs" class="btn btn-success tengah bts-ats2"><i class="fa fa-plus"></i> Export Data Dipilih Ke Feeder</button>
				</form>
			</div> 
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$("#select_all").change(function(){  //"select all" change 
    var status = this.checked; // "select all" checked status
    $('.pilih').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

$('.pilih').change(function(){ //".checkbox" change 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#select_all")[0].checked = false; //change "select all" checked status to false
    }
    
    //check "select all" if all checkbox items are checked
    if ($('.pilih:checked').length == $('.pilih').length ){ 
        $("#select_all")[0].checked = true; //change "select all" checked status to true
    }
});
</script>