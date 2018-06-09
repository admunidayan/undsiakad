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
						<h4 class="media-heading">Import Mahasiswa <?php echo $detprod->nama_prodi; ?></h4>
						<div class="txtabu">Import Mahasiswa dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-primary tengah" data-toggle="modal" data-target="#modalimpmhs"><i class="fa fa-plus"></i> Import Mahasiswa</button>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Nilai</button>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-info tengah" data-toggle="modal" data-target="#modalkuliah"><i class="fa fa-plus"></i> Import Aktifitas Kuliah</button>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="bts-ats">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ?>
				<div id="hasil"></div>
				<div class="bts-ats2"><label class="label label-success" id="jumlah"><?php echo $contoh; ?></label> Jumlah Mahasiswa Feeder</div>
				<form class="bts-ats" action="<?php echo base_url('index.php/admin/import/mhsprodi/'.$detprod->id_sms); ?>" method="get">
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
				<form action="<?php echo base_url('index.php/admin/import_p/input_bnyk/mahasiswa/'.$detprod->id_sms.'/'.$this->uri->segment('5')); ?>" method="post">
					<table border="1" class="bts-ats" width="100%">
						<thead>
							<tr>
								<th class="tengah fkpading" rowspan="2"><input type="checkbox" id="select_all"></th>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">NPM</th>
								<th rowspan="2" class="tengah fkpading">NAMA</th>
								<th rowspan="2" class="tengah fkpading">TAHUN</th>
								<th colspan="2" class="tengah fkpading">TTL</th>
								<th rowspan="2" class="tengah fkpading">JENIS</th>
								<th rowspan="2" class="tengah fkpading">AGAMA</th>
								<th rowspan="2" class="tengah fkpading">SYC</th>

							</tr>
							<tr>
								<th class="tengah fkpading">TANGGAL</th>
								<th class="tengah fkpading">TEMPAT</th>
							</tr>
						</thead>
						<tbody id="reloadmhsprodi">
							<?php $no=$nomor+1; ?>
							<?php foreach ($allmhs['result'] as $data): ?>
								<?php //echo "<pre>";print_r($data);echo "</pre>"; ?>
								<?php $check = $this->Import_m->cekmhs($data['id_pd']); ?>
								<tr>
									<td class="tengah"><input type="checkbox" class="pilih" name="pilih[]" value="<?php echo $data['nipd']; ?>"></td>
									<td class="tengah fkpading"><?php echo $no; ?></td>
									<td class="tengah fkpading"><?php echo $data['nipd']; ?></td>
									<td class="fkpading">
										<a href="<?php echo base_url('index.php/admin/import/nilai_mhs/'.$data['id_reg_pd']); ?>">
											<?php echo ucwords(strtolower( $data['nm_pd'])); ?>
										</a>
									</td>
									<td class="tengah fkpading"><?php echo $data['mulai_smt']; ?></td>
									<td class="tengah fkpading"><?php echo $data['tgl_lahir']; ?></td>
									<td class="fkpading"><?php echo ucwords(strtolower($data['tmpt_lahir'])); ?></td>
									<td class="tengah fkpading"><?php echo $data['fk__jns_daftar']; ?></td>
									<td class="tengah fkpading"><?php echo $this->Import_m->get_agama($data['id_agama'])->row('nm_agama'); ?></td>
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
					<div class="bts-ats">
						<?php echo $pagging; ?>
						<div class="sambungfloat"></div>
					</div>
					<button class="btn btn-default bts-ats" type="submit" name="submit" value="submit">Import Data di pilih</button>
				</form>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- Modal import nilai-->
<div class="modal fade" id="modalnilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah">Import Nilai Mahasiswa</h4>
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
<!-- Modal import mhs -->
<div class="modal fade" id="modalmhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah">Import Mahasiswa</h4>
      </div>
      <div class="modal-body">
      	<div style="margin-right: auto; margin-left: auto; padding: 28px 0px; width: 100px;" class="img-circle bghijau tengah txtputih">
      		<span style="font-size: 30px"><i class="fa fa-download"></i></span>
      	</div>
	      <div id="ktkimportdatamhs">
	      	<div class="tengah bts-ats2">Yakin Melakukan Import data?</div>
	      	<div class="tengah bts-ats"><button id="importdatamhs" class="btn bghijau txtputih tengah" data-id="<?php echo $contoh; ?>" ><i class="fa fa-download"></i> Import data</button></div>
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
<!-- Modal import aktivitas -->
<div class="modal fade" id="modalkuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah">Import Aktifitas Kuliah Mahasiswa</h4>
      </div>
      <div class="modal-body">
      	<div style="margin-right: auto; margin-left: auto; padding: 28px 0px; width: 100px;" class="img-circle bghijau tengah txtputih">
      		<span style="font-size: 30px"><i class="fa fa-download"></i></span>
      	</div>
	      <div id="ktkimportaktivitas">
	      	<div class="tengah bts-ats2">Yakin Melakukan Import data?</div>
	      	<div class="tengah bts-ats"><button id="importaktivitas" class="btn bghijau txtputih tengah" data-id="<?php echo $contoh; ?>" ><i class="fa fa-download"></i> Import data</button></div>
	      </div>
       	<div id="demo3"></div>
       	<div id="gagal3"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal import aktivitas -->
<div class="modal fade" id="modalimpmhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title tengah">Import Data Mahasiswa</h4>
      </div>
      <div class="modal-body">
      	<div style="margin-right: auto; margin-left: auto; padding: 28px 0px; width: 100px;" class="img-circle bghijau tengah txtputih">
      		<span style="font-size: 30px"><i class="fa fa-download"></i></span>
      	</div>
	      <div id="ktkimpmahasiswa">
	      	<div class="tengah bts-ats2">Yakin Melakukan Import data?</div>
	      	<div class="tengah bts-ats"><button id="impmahasiswa" class="btn bghijau txtputih tengah" data-id="<?php echo $contoh; ?>" ><i class="fa fa-download"></i> Import data</button></div>
	      </div>
       	<div id="demo4"></div>
       	<div id="gagal4"></div>
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
			var loop = Math.ceil(jml/50);
			$('#ktkimportdata').remove();
			document.getElementById("demo").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/get_nilai_mhs_by_prodi/'.$kodesms.'/'); ?>"+i*50,
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
	$(document).ready(function(){
		$("#importaktivitas").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			var loop = Math.ceil(jml/200);
			$('#ktkimportaktivitas').remove();
			document.getElementById("demo3").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung3'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo3").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung3'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/get_kuliah_mhs_by_mhs_pt/'.$kodesms.'/'); ?>"+i*200,
					type:'get',
					success:function(data){
						$('#hitung3').html(dtfinish++);
					},
		    		error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    			document.getElementById("gagal3").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
		    		}
		    	})
			}
		});
	});
	$(document).ready(function(){
		$("#impmahasiswa").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			var loop = Math.ceil(jml/500);
			$('#ktkimpmahasiswa').remove();
			document.getElementById("demo4").innerHTML = "<div class='tengah'><i class='fa fa-refresh fa-spin'></i> <span id='hitung4'>0</span> dari "+jml+" berhasil di import ...</div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo4").innerHTML = "<div class='tengah bts-ats2'><i class='fa fa-refresh fa-spin'></i> <span id='hitung4'>0</span> dari "+loop+" berhasil di import ...</div>";
				$.ajax({
					url : "<?php echo base_url('index.php/isi_db/impmahasiswa/'.$smsprod.'/'); ?>"+i*500,
					type:'get',
					success:function(data){
						$('#hitung4').html(dtfinish++);
					},
		    		error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    			document.getElementById("gagal4").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
		    		}
		    	})
			}
		});
	});
</script>