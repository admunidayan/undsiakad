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
$table ='ajar_dosen';
$filter = '';
$jml = $proxy->GetCountRecordset($token,$table,$filter);
$getjumlah =$jml['result'];

?>
<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-dosen') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Daftar kelas mengajar dosen</h4>
						<div class="txtabu">Daftar lengkap kelas mengajar dosen Universitas</div>
					</div>
					<div class="media-right media-middle">
						<button id="addklsdsn" class="btn buttonlist bgbirut txtputih"><i class="fa fa-cloud-download"></i> <b>Import data feeder</b></button>
					</div>
				</div>
				<div id="demo" class="bts-ats2 tengah"></div>
				<div class="bts-ats2">
					<span id="jumlah" class="label label-success"><?php echo $getjumlah; ?></span> Jumlah Kelas Megajar data feeder
				</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th class="tengah fkpading" rowspan="2">NO</th>
							<th class="tengah fkpading" rowspan="2">DOSEN</th>
							<th class="tengah fkpading" rowspan="2">KODE MK</th>
							<th class="tengah fkpading" rowspan="2">MATAKULIAH</th>
							<th class="tengah fkpading" rowspan="2">KELAS</th>
							<th class="tengah fkpading" colspan="6">SKS</th>
							<th class="tengah fkpading" colspan="2">JUMLAH</th>
						</tr>
						<tr>
							<th class="tengah fkpading">MK</th>
							<th class="tengah fkpading">SUBST</th>
							<th class="tengah fkpading">TM</th>
							<th class="tengah fkpading">PRAK</th>
							<th class="tengah fkpading">LAP</th>
							<th class="tengah fkpading">PLS</th>
							<th class="tengah fkpading">RENC</th>
							<th class="tengah fkpading">REAL</th>
						</tr>
					</thead>
					<tbody id="daftarkls"></tbody>
				</table>
				<div id="coba"></div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("daftarkls").innerHTML = "<tr><td class='tengah fkpading' colspan='13'><i class='fa fa-refresh fa-spin txthijau'></i> Sedang mengambil data dari server...</td></tr>";
		$.ajax({
	    url : "<?php echo base_url('index.php/admin/dosen/tampildatakelas'); ?>",
	    type: "get",
	    success:function(data){
	    	document.getElementById("daftarkls").innerHTML = "";
	      $('#daftarkls').html(data);
	    },
	    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
	      alert('error adding / Updating data');
	    }
	  });
	});
	$("#addklsdsn").click(function(){
		var jml = $('#jumlah').html();
		var dtfinish =0;
		var dtvail =0;
		document.getElementById("demo").innerHTML = "<i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...";
		for (var i = 0; i < jml; i++) {
			$.ajax({
				url : "<?php echo base_url('index.php/admin/dosen/importkelas/'); ?>"+i,
				success:function(data){
					$('#hitung').html(dtfinish++);
				},
				error: function() {
				document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
				}
			});
		}
	});
	function reloadkelas(){
	  $.ajax({
	    url : "<?php echo base_url('index.php/admin/dosen/tampildatakelas'); ?>", 
	    type: "get",
	    success:function(data){
	      $('#daftarkls').html(data);
	    },
	    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
	      alert('error adding / Updating data');
	    }
	  });
	}
</script>