<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu"><?php echo $title; ?> dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label id="jumlah" class="label label-success"><?php echo $contoh; ?></label> Jumlah data Feeder</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NIPD</th>
							<th rowspan="2" class="tengah fkpading">MAHASISWA</th>
							<th rowspan="2" class="tengah fkpading">PRODI</th>
							<th rowspan="2" class="tengah fkpading">SMT</th>
							<th rowspan="2" class="tengah fkpading">STAT</th>
							<th colspan="2" class="tengah fkpading">NILAI</th>
							<th colspan="2" class="tengah fkpading">SKS</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">IPS</th>
							<th class="tengah fkpading">IPK</th>
							<th class="tengah fkpading">TOTAL</th>
							<th class="tengah fkpading">SMTR</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=$nomor+1 ?>
						<?php foreach ($allaktifitas['result'] as $data): ?>
							<?php $check = $this->Import_m->cekaktifmhs($data['id_smt'],$data['nipd']) ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="tengah fkpading"><?php echo $data['nipd']; ?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_pd'])); ?></td>
								<td class="fkpading"><?php echo $data['nm_lemb']; ?></td>
								<td class="tengah fkpading"><?php echo $data['id_smt']; ?></td>
								<td class="tengah fkpading"><?php echo $data['nm_stat_mhs']; ?></td>
								<td class="tengah fkpading"><?php echo $data['ips']; ?></td>
								<td class="tengah fkpading"><?php echo $data['ipk']; ?></td>
								<td class="tengah fkpading"><?php echo $data['sks_total']; ?></td>
								<td class="tengah fkpading"><?php echo $data['sks_smt']; ?></td>
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
				<?php echo $pagging; ?>
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#importdata").click(function(){

			var jml = $('#jumlah').html();
			var dtfinish =0;
			var dtvail =0;
			// default loop
			
			var loop = Math.ceil(jml/100);
			$('#ktkimportdata').remove();
			// asd
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/admin/import/proses_import_aktivitas_mhs/'); ?>"+i*100,
					type:'get',
					success:function(data){
						$('#hitung').html(dtfinish++);
					},
		    		error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    			document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
		    		}
		    	})
			}
		});
	});
</script>