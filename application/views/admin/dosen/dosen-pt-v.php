<?php 
// setting data feeder
$hostname = $this->ion_auth->user()->row()->hostname;
$port = $this->ion_auth->user()->row()->port;
$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
$client = new nusoap_client($url, true);
$proxy = $client->getProxy();
$username =$this->ion_auth->user()->row()->userfeeder;
$pass = $this->ion_auth->user()->row()->passfeeder;
$token = $proxy->getToken($username, $pass);
// get jumlah data
$table ='dosen_pt';
$filter2 = '';
$jml = $proxy->GetCountRecordset($token,$table,$filter2);
$getjumlah =$jml['result'];
?>
<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-dosen') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Daftar Dosen PT</h4>
						<div class="txtabu">Daftar lengkap Dosen PT Universitas</div>
					</div>
					<div class="media-right media-middle">
						<button name="submit" id="adddosenpt" class="btn buttonlist bgbirut txtputih"><i class="fa fa-cloud-download"></i> <b>Import data feeder</b></button>
					</div>
				</div>
				<div id="demo" class="bts-ats2 tengah"></div>
				<div id="gagal" class="bts-ats2 tengah"></div>
				<div class="bts-ats2">
					<span id="jumlah" class="label label-success"><?php echo $getjumlah; ?></span> Jumlah dosen PT pada data feeder
				</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th class="tengah fkpading" rowspan="2">NO</th>
							<th class="tengah fkpading" rowspan="2">DOSEN</th>
							<th class="tengah fkpading" rowspan="2">NIK</th>
							<th class="tengah fkpading" rowspan="2">T.A</th>
							<th class="tengah fkpading" rowspan="2">PRODI</th>
							<th class="tengah fkpading" colspan="2">SRT TUGAS</th>
						</tr>
						<tr>
							<th class="tengah fkpading">NOMOR</th>
							<th class="tengah fkpading">TANGGAL</th>
						</tr>
					</thead>
					<tbody id="dosenpt"></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
	    url : "<?php echo base_url('index.php/admin/dosen/tampildosenpt'); ?>",
	    type: "get",
	    success:function(data){
	      $('#dosenpt').html(data);
	    },
	    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
	      alert('error adding / Updating data');
	    }
	  });
	});
	$("#adddosenpt").click(function(){
		var jml = $('#jumlah').html();
		var dtfinish =0;
		var dtvail =0;
		document.getElementById("demo").innerHTML = "<i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari"+jml+" berhasil di import ...";
		for (var i = 0; i < jml; i++) {
			$.ajax({
				url : "<?php echo base_url('index.php/admin/dosen/importdosenpt/'); ?>"+i,
				success:function(data){
					$('#hitung').html(dtfinish++);
				},
				error: function() {
				document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
				}
			});
		}
	});
	function reloaddosenpt(){
	  $.ajax({
	    url : "<?php echo base_url('index.php/admin/dosen/tampildosenpt'); ?>", 
	    type: "get",
	    success:function(data){
	      $('#dosenpt').html(data);
	    },
	    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
	      alert('error adding / Updating data');
	    }
	  });
	}
</script>