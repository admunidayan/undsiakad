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
						<h4 class="media-heading">Import Kelas Kuliah</h4>
						<div class="txtabu">Import Kelas Kuliah dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" style="width: 100%" data-toggle="modal" data-target="#modalkelas"><i class="fa fa-plus"></i> Import Kelas</button>
						<button class="btn btn-primary tengah bts-ats" style="width: 100%" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Nilai</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $contoh; ?></label> Jumlah Kelas Kuliah pada database</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE MK</th>
							<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
							<th rowspan="2" class="tengah fkpading">KLS</th>
							<th rowspan="2" class="tengah fkpading">SMT</th>
							<th colspan="4" class="tengah fkpading">SKS</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
						</tr>
						<tr>
							<th class="tengah fkpading">MK</th>
							<th class="tengah fkpading">TM</th>
							<th class="tengah fkpading">PRAK</th>
							<th class="tengah fkpading">LAP</th>
						</tr>
					</thead>
					<tbody>
						<?php $no =$nomor+1; ?>
						<?php foreach ($allmk['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data['kode_mk'];?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/admin/import/detail_kelas_kuliah/'.$data['id_kls']) ?>"><?php echo strtoupper($data['fk__id_mk']);?></a></td>
								<td class="tengah fkpading"><?php echo $data['nm_kls'];?></td>
								<td class="tengah fkpading"><?php echo $data['id_smt'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_mk'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_tm'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_prak'];?></td>
								<td class="tengah fkpading"><?php echo $data['sks_prak_lap'];?></td>
								<td class="tengah fkpading">
									<?php if ($this->Import_m->cekkelaskuliah($data['id_kls']) == TRUE): ?>
										<label class="label label-success">exported</label>
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
<!-- Modal import kelas -->
<div class="modal fade" id="modalkelas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
<!-- Modal import nilai -->
<div class="modal fade" id="modalnilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah">Import nilai berdasarkan kelas kuliah</h4>
      </div>
      <div class="modal-body">
      	<div style="margin-right: auto; margin-left: auto; padding: 28px 0px; width: 100px;" class="img-circle bghijau tengah txtputih">
      		<span style="font-size: 30px"><i class="fa fa-download"></i></span>
      	</div>
	      <div id="ktkimportdata2">
	      	<div class="tengah bts-ats2">Yakin Melakukan Import data?</div>
	      	<div class="tengah bts-ats"><button id="importdatanilai" class="btn bghijau txtputih tengah" data-id="<?php echo $contoh; ?>" ><i class="fa fa-download"></i> Import data</button></div>
	      </div>
       	<div id="demo2"></div>
       	<div id="gagal2"></div>
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
			var loop = Math.ceil(jml/500);
			$('#ktkimportdata').remove();
			document.getElementById("demo").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/kelas_kuliah_prodi/'.$idprodi.'/'); ?>"+i*500,
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
		$("#importdatanilai").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			var loop = Math.ceil(jml/50);
			$('#ktkimportdata2').remove();
			document.getElementById("demo2").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo2").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/nilai_by_kelas_kuliah/'.$idprodi.'/'); ?>"+i*50,
					type:'get',
					success:function(data){
						$('#hitung').html(dtfinish++);
					},
		    		error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    			document.getElementById("gagal2").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
		    		}
		    	})
			}
		});
	});
</script>