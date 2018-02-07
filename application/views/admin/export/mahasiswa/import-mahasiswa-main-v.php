<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import'); ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-institution"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Import Mahasiswa Berdasarkan Program Studi</h4>
						<div class="txtabu">Pilih Program studi untuk Import Mahasiswa</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div id="hasil"></div>
				<table class="bts-ats2" border="1" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE</th>
							<th rowspan="2" class="tengah fkpading">PRODI</th>
							<th rowspan="2" class="tengah fkpading">SKS</th>
							<th rowspan="2" class="tengah fkpading">SK</th>
							<th rowspan="2" class="tengah fkpading">SMT MULAI</th>
							<th colspan="2" class="tengah fkpading">TANGGAL</th>
							<th rowspan="2" class="tengah fkpading">ACTION</th>
						</tr>
						<tr>
							<th class="tengah fkpading">SK SELENGGARA</th>
							<th class="tengah fkpading">BERDIRI</th>
						</tr>
					</thead>
					<tbody id="reloadprodi">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Sedang mengambil data dari server...</div>';
		$.ajax({
			url : "<?php echo base_url('index.php/admin/import/reloadprodi_mhs'); ?>",
			type: "get",
			success:function(data){
				document.getElementById("hasil").innerHTML = "";
				$('#reloadprodi').html(data);
			},
		    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    	alert('error adding / Updating data');
		    }
		});
	});
</script>