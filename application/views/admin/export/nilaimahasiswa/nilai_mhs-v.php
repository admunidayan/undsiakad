<?php 
	$hostname = $this->ion_auth->user()->row()->hostname;
	$port = $this->ion_auth->user()->row()->port;
	$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
	$client = new nusoap_client($url, true);
	$proxy = $client->getProxy();
	$username =$this->ion_auth->user()->row()->userfeeder;
	$pass = $this->ion_auth->user()->row()->passfeeder;
	$token = $proxy->getToken($username, $pass);
 ?>
<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import'); ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min">
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
						<button id="importnilaimhs" class="btn btn-success tengah" data-id="<?php echo $npm;?>"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div id="hasil"></div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="bts-ats">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ?>
				<div class="bts-ats2"><label class="label label-success"><?php echo $jumlahdata['result']; ?></label> daftar nilai Feeder</div>
				<form id="impnilai" action="<?php //echo base_url('index.php/admin/import/proses_input_nilai_mhs/'.$npm); ?>" method="post">
					<table border="1" class="bts-ats" width="100%">
						<thead>
								<tr>
									<th class="tengah fkpading" rowspan="2"><input type="checkbox" id="select_all"></th>
									<th class="tengah fkpading" rowspan="2">NO</th>
									<th class="tengah fkpading" rowspan="2">KODE MK</th>
									<th class="tengah fkpading" rowspan="2">MATAKULIAH</th>
									<th class="tengah fkpading" rowspan="2">KLS</th>
									<th class="tengah fkpading" rowspan="2">TAHUN</th>
									<th class="tengah fkpading" rowspan="2">SKS</th>
									<th class="tengah fkpading" colspan="3">NILAI</th>
									<th class="tengah fkpading" rowspan="2">SYC</th>
								</tr>
								<tr>
									<th class="tengah fkpading">ANGKA</th>
									<th class="tengah fkpading">HURUF</th>
									<th class="tengah fkpading">INDEKS</th>
								</tr>
							</thead>
						<tbody id="reloadmhsprodi">
							<?php $no=1; ?>
							<?php foreach ($hasil['result'] as $data): ?>
								<?php //echo "<pre>";print_r($data);echo "</pre>"; ?>
								<?php $check = $this->Import_m->cek_nilai_mhs($data['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk']); ?>
								<tr>
										<td class="tengah">
										<input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data['id_kls']; ?>">
										</td>
										<td class="tengah fkpading"><?php echo $no; ?></td>
										<td class="tengah fkpading"><?php echo $data['kode_mk']; ?></td>
										<td class="fkpading">
											<?php $filter2 = "kode_mk = '{$data['kode_mk']}'";
												$result2 = $proxy->getRecord($token,'mata_kuliah',$filter2);
												 echo $result2['result']['nm_mk'];?>
										</td>
										<td class="tengah fkpading"><?php echo $data['fk__id_kls']; ?></td>
										<td class="tengah fkpading"><?php echo $data['id_smt']; ?></td>
										<td class="tengah fkpading"><?php echo $data['sks_mk']; ?></td>
										<td class="tengah fkpading"><?php echo $data['nilai_angka']; ?></td>
										<td class="tengah fkpading"><?php echo $data['nilai_huruf']; ?></td>
										<td class="tengah fkpading"><?php echo $data['nilai_indeks']; ?></td>
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
				</form>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#importnilaimhs").click(function(event){
		document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert bts-ats2 tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Mengimport data...</div>';
		$.ajax({
			url : "<?php echo base_url('index.php/admin/import/proses_input_nilai_mhs/'.$npm); ?>",
			type: "post",
			data: $("#impnilai").serialize(),
		})
		.done(function(msg) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-success bts-ats2 tengah"><i class="fa fa-check-circle-o"></i> Beberapa Nilai Berhasil di import</div>');
			reloadprodi();
		})
		.fail(function(datae) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-danger bts-ats2 tengah"><i class="fa fa-warning"></i> <b>Terjadi kesalahan!</b> Import nilai gagal</div>');
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