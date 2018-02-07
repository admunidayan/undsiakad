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
						<h4 class="media-heading"><?php echo $title ?></h4>
						<div class="txtabu">pengaturan <?php echo $title;?> per mahasiswa</div>
					</div>
				</div>
				<div class="bts-ats2">
					<div id="demo"></div>
					<button id="validasi" class="btn btn-primary btn-lg" data-id="<?php echo $jumlah ?>">Validasi Data Nilai Mahaiswa</button>
					<div class="alert alert-info bts-ats">Validasi Nilai Mahasiswa adalah fitur SIAKAD untuk mendeteksi nilai, kelas dan matakuliah yang terdapat kesamaan data, yang kemudian di perbaiki menjadi data yang benar.</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#validasi").click(function(event){
			var jml = $(this).data('id');
			var dtfinish =0;
			var dtvail =0;
			var loop = Math.ceil(jml/200);
			$('#validasi').remove();
			document.getElementById("demo").innerHTML = "<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>0%</div></div>";
			for (var i = 0; i <= loop; i++) {
				// $('#demo').append(i+' dan '+i*100+loop+"<br/>");
				document.getElementById("demo").innerHTML = "<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>0%</div></div>";
				$.ajax({
					url : "<?php echo base_url('index.php/admin/setting/proses_validasi_nilai/'); ?>"+i*200,
					type:'get',
					success:function(data){
						var persentase = Math.ceil(i/jml*200);
						document.getElementById("demo").innerHTML = "<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='"+persentase+"' aria-valuemin='0' aria-valuemax='100' style='width: "+persentase+"%;'>"+persentase+"%</div></div>";
					},
		    		error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    			document.getElementById("gagal").innerHTML = "<i class='fa fa-warninng txtpink'></i> "+dtvail+++" data gagal";
		    		}
		    	})
			}
		});
	});
</script>