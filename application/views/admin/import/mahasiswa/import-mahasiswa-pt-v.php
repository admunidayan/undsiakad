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
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div id="hasil"></div>
				<div class="bts-ats2"><p>Jumlah Temuan Feeder : <?php echo $contoh; ?> | Jumlah Temuan Siakad : <?php echo $jmlfeeder; ?></p></div>
				<table class="bts-ats2" border="1" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NIPD</th>
							<th rowspan="2" class="tengah fkpading">NAMA</th>
							<th rowspan="2" class="tengah fkpading">PRODI</th>
							<th rowspan="2" class="tengah fkpading">JNS DAFTAR</th>
							<th rowspan="2" class="tengah fkpading">MASUK</th>
							<th rowspan="2" class="tengah fkpading">STATUS</th>
							<th rowspan="2" class="tengah fkpading">IMPORT</th>
						</tr>
					</thead>
					<tbody id="reloadprodi">
						<?php if ($hasil['error_code'] !=='0'): ?>
							<div class="alert alert-warning">
								<p>
									<b>Perhatian <?php echo $hasil['error_code']; ?></b><br/>
									<?php echo $hasil['error_desc']; ?>
								</p>
							</div>
						<?php endif ?>
						<?php $no=1 ?>
						<?php foreach ($hasil['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="fkpading"><?php echo $data['nipd'] ?></td>
								<td class="fkpading"><?php echo $data['nm_pd']; ?></td>
								<td class="fkpading"><?php echo $data['fk__sms']; ?></td>
								<td class="fkpading"><?php echo $data['tgl_lahir']; ?></td>
								<td class="fkpading"><?php echo $data['fk__jns_daftar']; ?></td>
								<td class="tengah fkpading"><?php echo $data['fk__jns_keluar']; ?></td>
								<td class="tengah fkpading">
									<?php if ($this->Isi_m->cekmhspt($data['id_reg_pd'] == TRUE)): ?>
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
		$("#importdata").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			var loop = Math.ceil(jml/200);
			$('#ktkimportdata').remove();
			document.getElementById("demo").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/mahasiswa_pt/'); ?>"+i*200,
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