<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-mahasiswa') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Edit Nilai Transafer <?php echo $hasil->nm_mk_asal.' ke '.ucwords(strtolower($hasil->nama_matakuliah)); ?></h4>
						<div class="txtabu">Edit Hasil Konversi</div>
					</div>
				</div>
				<div class="hasil"></div>
				<form action="<?php echo base_url('index.php/prodi/mahasiswa/proses_edit_mktrans'); ?>" method="post">
					<div class="modal-body">
						<div class="prfbox">
							<div class="form-group">
								<label>Kode MK Asal</label>
								<input type="hidden" name="nipd" value="<?php echo $getmhs->npm; ?>">
								<input type="text" class="form-control" name="kode_mk_asal" value="<?php echo $hasil->kode_mk_asal; ?>" placeholder="Kode Matakuliah Asal">
								<input type="hidden" name="id_nilai_transfer" value="<?php echo $hasil->id_nilai_transfer; ?>">
							</div>
							<div class="form-group">
								<label>Mata Kuliah Asal</label>
								<input type="text" class="form-control" name="nm_mk_asal" value="<?php echo $hasil->nm_mk_asal; ?>"  placeholder="Matakuliah Asal">
							</div>
							<div class="form-group">
								<label>SKS Asal</label>
								<input type="text" class="form-control" name="sks_asal" value="<?php echo $hasil->sks_asal; ?>" placeholder="Jumlah SKS Asal">
							</div>
							<div class="form-group">
								<label>Nilai Huruf Asal</label>
								<input type="text" class="form-control" name="nilai_huruf_asal" value="<?php echo $hasil->nilai_huruf_asal; ?>" placeholder="Nilai Huruf Asal">
							</div>
							<div id="loading" style="display:none">Loading...</div>
							<div class="form-group">
								<label>Matakuliah Diakui</label>
								<input type="text" name="id_mk" id="namaMk" class="form-control" onkeyup="cariDosen(this.value);" onblur="pilih();" placeholder="MK" value="<?php echo $hasil->id_mk; ?>">
								<div id="hasilPencarian" style="display: none;">
									<div class="list-group" id="dataPencarian"></div>
								</div>
							</div>
							<div class="form-group">
								<label>Nilai Huruf Diakui</label>
								<input type="text" class="form-control" name="nilai_huruf_diakui" value="<?php echo $hasil->nilai_huruf_diakui; ?>" placeholder="Nilai Huruf">
							</div>
							<div class="form-group">
								<label>Nilai Angka Dakui</label>
								<input type="text" class="form-control" name="nilai_angka_diakui" value="<?php echo $hasil->nilai_angka_diakui; ?>" placeholder="Nilai Angka">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Reset</button>
						<button type="submit" name="submit" value="submit" class="btn btn-success">Tambah</button>
					</div>
				</form>
			</div> 
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	$(function() {
		$('#loading').ajaxStart(function(){
			$(this).fadeIn();
		}).ajaxStop(function(){
			$(this).fadeOut();
		});
	});
	function cariDosen(namaMk) {
		if(namaMk.length == 0) {
			$('#hasilPencarian').hide();
		} else {
			$.post("<?php echo base_url('index.php/prodi/mahasiswa/tampilmk/'); ?>",{kirimNama: ""+namaMk+""}, function(data){
				if(data.length >0) {
					$('#hasilPencarian').fadeIn();
					$('#dataPencarian').html(data);
				}
			});
		}
	}
	function pilih(thisValue) {
		$('#namaMk').val(thisValue);
		setTimeout("$('#hasilPencariane').fadeOut();", 100);
	}
</script>