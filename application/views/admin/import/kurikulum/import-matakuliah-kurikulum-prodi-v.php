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
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu">Import Matakuliah kurikulum dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<a href="<?php echo base_url('index.php/isi_db/mata_kuliah_kurikulum_prodi/'.$idmksp) ?>" class="btn btn-success tengah"><i class="fa fa-plus"></i> Import Data Feeder</a>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success" id="jumlah"><?php echo $contoh; ?></label> Jumlah Matakuliah Kurikulum pada database <?php echo $jmldb; ?></div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="bts-ats">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif ?>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE MK</th>
							<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
							<th rowspan="2" class="tengah fkpading">SMT</th>
							<th rowspan="2" class="tengah fkpading">KURIKULUM</th>
							<th rowspan="2" class="tengah fkpading">W/P</th>
							<th rowspan="2" class="tengah fkpading">STS</th>
						</tr>
					</thead>
					<tbody>
						<?php $no =1; ?>
						<?php foreach ($hasil['result'] as $data): ?>

							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data['fk__id_mk'];?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data['nm_mk']));?></td>
								<td class="tengah fkpading"><?php echo $data['smt'];?></td>
								<td class="fkpading"><?php echo ucfirst(strtolower($data['fk__id_kurikulum_sp']));?></td>
								<td class="tengah fkpading"><?php echo $data['a_wajib'];?></td>
								<td class="tengah fkpading">
									<?php if ($this->Isi_m->cekmkkurprod($data['id_kurikulum_sp'],$data['id_mk'])==true): ?>
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
					url : "<?php echo base_url('index.php/isi_db/mata_kuliah_kurikulum/'); ?>"+i*200,
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
}) ;
</script>
