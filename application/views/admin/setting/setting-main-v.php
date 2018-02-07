<div class="unirow" id="mainpage">
	 <?php $this->load->view('nav/nav-setting'); ?>
	<div class="col-md-10 unipd" >
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media bts-bwh">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-th-list"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Setting Kurikulum Program Studi</h4>
						<div class="txtabu">pengaturan penggunaan kurikulum per pogram studi</div>
					</div>
				</div>
				<div class="bts-ats2">
					<div id="hasil"></div>
					<table border="1" width="100%">
						<thead>
							<tr>
								<th class="tengah fkpading">NO</th>
								<th class="tengah fkpading">KODE</th>
								<th class="tengah fkpading">PRODI</th>
								<th class="tengah fkpading">SKS</th>
								<th class="tengah fkpading">SK</th>
								<th class="tengah fkpading">KURIKULUM</th>
								<th class="tengah fkpading">ACTION</th>
							</tr>
						</thead>
						<tbody id="reloadprodi">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal edit nilai -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title tengah"><i class="fa fa-pencil"></i> Ubah Kurikulum Prodi</h4>
			</div>
			<form id="formeditkur" action="#" method="post">
				<div class="modal-body">
					<input id="prodi_id" type="hidden" name="id_prodi">
					<div class="tengah"><h4>Kurikulum Saat ini :</h4></div>
					<div id="headerkur" class="tengah"><h4 id="kursaatini"></h4></div>
					<label>Pilih Kurikulum</label>
					<select id="selkuri" name="id_kurikulum" class="form-control"></select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="modalproses" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Sedang mengambil data dari server...</div>';
		$.ajax({
			url : "<?php echo base_url('index.php/admin/setting/reloadprodi'); ?>",
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
	$('#modalproses').click(function(event) {
		var kur_id = $('#selkuri').val();
		var datae = $("#formeditkur").serialize();
		$.ajax({
			url : "<?php echo base_url('index.php/admin/setting/proses_editkur'); ?>",
			type: 'post',
			data: datae,
		})
		.done(function(msg) {
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-success tengah"><i class="fa fa-check-circle-o"></i> Kurikurum berhasil di ubah</div>');
			reloadprodi();
		})
		.fail(function(datae) {
			
			$('#infohasil').remove();
			$('#hasil').append('<div id="infohasil" class="alert alert-danger tengah"><i class="fa fa-warning"></i> <b>Terjadi kesalahan!</b> kurikulum gagal di ubah</div>');
		})
	});
	function reloadprodi(){
	  $.ajax({
	    url : "<?php echo base_url('index.php/admin/setting/reloadprodi'); ?>",
	    type: "get",
	    success:function(data){
	      $('#reloadprodi').html(data);
	    },
	    error: function (){
	      alert('error adding / Updating data');
	    }
	  });
	}
</script>