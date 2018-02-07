<?php 
	$hostname = $this->ion_auth->user()->row()->hostname;
    $port = $this->ion_auth->user()->row()->port;
    $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
    $client = new nusoap_client($url, true);
    $proxy = $client->getProxy();
    $username =$this->ion_auth->user()->row()->userfeeder;
    $pass = $this->ion_auth->user()->row()->passfeeder;
    $token = $proxy->getToken($username, $pass);
    // setting nama table
    $table ='mata_kuliah';
?>
<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Import Nilai Mahasiswa</h4>
						<div class="txtabu">Import Nilai Mahasiswa dari Web Service Feeder <?php echo $contoh; ?></div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah data nilai Mahasiswa Feeder</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NPP</th>
							<th rowspan="2" class="tengah fkpading">MAHASISWA</th>
							<th rowspan="2" class="tengah fkpading">KLS</th>
							<th rowspan="2" class="tengah fkpading">SMT</th>
							<th rowspan="2" class="tengah fkpading">KODE MK</th>
							<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
							<th colspan="3" class="tengah fkpading">NILAI</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">ANGKA</th>
							<th class="tengah fkpading">HURUF</th>
							<th class="tengah fkpading">INDEXK</th>
						</tr>
					</thead>
					<tbody>
						<?php $no =$nomor+1; ?>
						<?php foreach ($allnilai['result'] as $data): ?>
							<?php $filter = "kode_mk = '{$data['kode_mk']}'";$result = $proxy->GetRecord($token,$table,$filter); ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data['nipd'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_pd']));?></td>
								<td class="tengah fkpading"><?php echo $data['fk__id_kls'];?></td>
								<td class="tengah fkpading"><?php echo $data['id_smt'];?></td>
								<td class="tengah fkpading"><?php echo $data['kode_mk'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($result['result']['nm_mk']));?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_angka'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_huruf'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_indeks'];?></td>
								<td class="tengah fkpading">
									<?php $check = $this->Import_m->ceknilai($data['id_kls']); ?>
									<?php if ($check==true): ?>
										<label class="label label-success">imported</label>
									<?php else: ?>
										<label class="label label-warning">waiting</label>
									<?php endif ?>
								</td>
							</tr>
							<?php $no++; ?>
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
	      	<div class="tengah bts-ats"><button id="importdata" class="btn bghijau txtputih tengah" data-id="<?php echo $jmlkls; ?>" ><i class="fa fa-download"></i> Import data</button></div>
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
		$("#importdata").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			$('#ktkimportdata').remove();
			document.getElementById("demo").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i < jml; i++) {
				$.ajax({
					url : "<?php echo base_url('index.php/admin/import/proses_import_nilai_by_kelas/'); ?>"+i,
					type:'post',
					dataType: 'json'
				})
				.done(function(khs) {
					$('#hitung').html(dtfinish++);
				})
				.fail(function() {
				document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
			})
			}
		});
	});
</script>