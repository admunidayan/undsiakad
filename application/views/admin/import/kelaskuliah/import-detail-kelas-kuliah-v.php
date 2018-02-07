
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
						<h4 class="media-heading">Detail Kelas Kuliah</h4>
						<div class="txtabu">Import Nilai Mahasiswa dari Web Service Feeder <?php echo $contoh; ?></div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah" data-toggle="modal" data-target="#modalnilai"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-info tengah" role="alert">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ;?>
				<table class="bts-ats">
					<tr>
						<td style="padding: 0px 7px;">KELAS</td>
						<td style="padding: 0px 7px;">:</td>
						<td style="padding: 0px 7px;"><?php echo $detail['result']['nm_kls'] ?></td>
					</tr>
					<tr>
						<td style="padding: 0px 7px;">PRODI</td>
						<td style="padding: 0px 7px;">:</td>
						<td style="padding: 0px 7px;"><?php echo strtoupper($detail['result']['fk__id_sms']) ?></td>
					</tr>
					<tr>
						<td style="padding: 0px 7px;">SEMESTER</td>
						<td style="padding: 0px 7px;">:</td>
						<td style="padding: 0px 7px;"><?php echo strtoupper($detail['result']['fk__id_smt'].'/'.$detail['result']['id_smt']) ?></td>
					</tr>
					<tr>
						<td style="padding: 0px 7px;">MATAKULIAH</td>
						<td style="padding: 0px 7px;">:</td>
						<td style="padding: 0px 7px;"><?php echo strtoupper($detail['result']['fk__id_mk'].' - '.$detail['result']['kode_mk']);?></td>
					</tr>
					<tr>
						<td style="padding: 0px 7px;">JUMLAH MHS</td>
						<td style="padding: 0px 7px;">:</td>
						<td style="padding: 0px 7px;"><?php echo $contoh.' Mahasiswa'; ?></td>
					</tr>
				</table>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NIM</th>
							<th rowspan="2" class="tengah fkpading">NAMA MAHASISWA</th>
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
						<?php foreach ($allmk['result'] as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data['nipd'];?></td>
								<td class="fkpading"><?php echo strtoupper($data['nm_pd']);?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_angka'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_huruf'];?></td>
								<td class="tengah fkpading"><?php echo $data['nilai_indeks'];?></td>
								<td class="tengah fkpading">
									<?php $check = $this->Isi_m->ceknilai($data['nipd'],$data['id_smt'],$data['kode_mk']); ?>
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
					url : "<?php echo base_url('index.php/isi_db/nilai/'); ?>"+i*200,
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