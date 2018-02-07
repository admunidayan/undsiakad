<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-Export'); ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu"><?php echo $title; ?> Ke Web Service Feeder</div>
					</div>
				</div>
				<div id="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah Mahasiswa Belum Terexport</div>
				<form class="bts-ats" action="<?php echo base_url('index.php/admin/export/proses_export_mhs'); ?>" method="post">
					<div class="unirow">
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">NPM / Nama :</span>
								<input type="text" class="form-control" name="string" placeholder="Masukan NPM atau Nama">
							</div>
						</div>
						<div class="col-md-5 unipd">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" id="basic-addon1">Angkatan :</span>
								<input type="text" class="form-control" name="angkatan" placeholder="Angkatan Mahasiswa">
							</div>
						</div>
						<div class="col-md-2 unipd">
							<button type="submit" class="btn btn-sm btn-success" style="width:100%"><i class="fa fa-search"></i> Cari ...</button>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</form>
				<!--  -->
				<form id="formexportmhs" action="<?php echo base_url('index.php/admin/export/proses_export_mhs'); ?>" method="post">
					<table border="1" class="bts-ats" width="100%">
						<thead>
							<tr>
								<th rowspan="2" class="tengah fkpading"><input type="checkbox" id="select_all"></th>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">NPM</th>
								<th rowspan="2" class="tengah fkpading">NAMA</th>
								<th rowspan="2" class="tengah fkpading">SMT MULAI</th>
								<th colspan="2" class="tengah fkpading">TTL</th>
								<th rowspan="2" class="tengah fkpading">JENIS</th>
								<th rowspan="2" class="tengah fkpading">AGAMA</th>
							</tr>
							<tr>
								<th class="tengah fkpading">TANGGAL</th>
								<th class="tengah fkpading">TEMPAT</th>
							</tr>
						</thead>
						<tbody id="reloadmhsprodi">
							<?php if (!empty($hasil)): ?>
								<?php $no=$nomor+1; ?>
								<?php foreach ($hasil as $data): ?>
									<tr>
										<td class="tengah fkpading"><input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data->idmhs; ?>"></td>
										<td class="tengah fkpading"><?php echo $no; ?></td>
										<td class="tengah fkpading"><?php echo $data->nipd; ?></td>
										<td class="fkpading"><?php echo strtoupper($data->nm_pd); ?></td>
										<td class="tengah fkpading"><?php echo $data->mulai_smt; ?></td>
										<td class="tengah fkpading"><?php echo $data->tgl_lahir; ?></td>
										<td class="fkpading"><?php echo strtoupper($data->tmpt_lahir); ?></td>
										<td class="tengah fkpading"><?php echo strtoupper($data->nm_jns_daftar); ?></td>
										<td class="tengah fkpading"><?php echo strtoupper($data->nm_agama); ?></td>
									</tr>
									<?php $no++ ?>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td class="tengah fkpading" colspan="10"><i>Tidak ada data ditemukan</i></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
					<div><?php echo $pagging; ?></div>
					<button id="aexportmhs" type="submit" name="submit" value="submit" class="btn btn-success tengah bts-ats2"><i class="fa fa-plus"></i> Export Data Dipilih Ke Feeder</button>
				</form>

				<button id="deletetmhs" class="btn btn-warning tengah bts-ats2"><i class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#exportmhs").click(function(event){
		document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert bts-ats2 tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Mengimport data...</div>';
		$.ajax({
			url : "<?php echo base_url('index.php/admin/export/proses_export_mhs'); ?>",
			type: "post",
			data: $("#formexportmhs").serialize(),
		})
		.done(function(msg) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-success bts-ats2 tengah"><i class="fa fa-check-circle-o"></i> Export Selesai</div>');
			reloadprodi();
		})
		.fail(function(datae) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-danger bts-ats2 tengah"><i class="fa fa-warning"></i> <b>Terjadi kesalahan!</b> Gagal Melakukan Export</div>');
		})
	});
	$("#deletetmhs").click(function(event){
		document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert bts-ats2 tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Menghapus data...</div>';
		$.ajax({
			url : "<?php echo base_url('index.php/admin/export/delete_mhs'); ?>",
			type: "post",
			data: $("#formexportmhs").serialize(),
		})
		.done(function(msg) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-success bts-ats2 tengah"><i class="fa fa-check-circle-o"></i> Export Selesai</div>');
			reloadprodi();
		})
		.fail(function(datae) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-danger bts-ats2 tengah"><i class="fa fa-warning"></i> <b>Terjadi kesalahan!</b> Gagal Melakukan Penghapusan Data</div>');
		})
	});
});
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