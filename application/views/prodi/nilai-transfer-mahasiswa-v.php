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
						<h4 class="media-heading">Nilai Transafer</h4>
						<div class="txtabu">Transfer Nilai Mahasiswa</div>
					</div>
					<div class="media-right">
						<button class="btn btn-success" data-toggle="modal" data-target="#add" ><i class="fa fa-plus"></i> Tambah Konversi</button>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-success bts-ats2 alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="tengah"><strong>Sukses!</strong> <?php echo $this->session->flashdata('message');?></div>
					</div>
				<?php endif ?>
				<div class="hasil"></div>
				<table border="1" class="bts-ats2" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th colspan="5" class="tengah fkpading">ASAL</th>
							<th colspan="3" class="tengah fkpading">BARU</th>
							<th rowspan="2" class="tengah fkpading">SYC</th>
							<th rowspan="2" colspan="2" class="tengah fkpading">ACTION</th>
						</tr>
						<tr>
							<th class="tengah fkpading">KODE</th>
							<th class="tengah fkpading">MATAKULIAH</th>
							<th class="tengah fkpading">SKS</th>
							<th class="tengah fkpading">ANK</th>
							<th class="tengah fkpading">AKUI</th>
							<th class="tengah fkpading">MATAKULIAH</th>
							<th class="tengah fkpading">HRF</th>
							<th class="tengah fkpading">IDX</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1 ?>
						<?php foreach ($nilai as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no;?></td>
								<td class="tengah fkpading"><?php echo $data->kode_mk_asal;?></td>
								<td class="fkpading"><?php echo ucwords(strtolower($data->nm_mk_asal));?></td>
								<td class="tengah fkpading"><?php echo $data->sks_asal;?></td>
								<td class="tengah fkpading"><?php echo $data->nilai_huruf_asal;?></td>
								<td class="tengah fkpading"><?php echo $data->sks_diakui;?></td>
								<td class="fkpading">
									<?php echo @$this->Mahasiswa_m->get_mkb($data->id_mk_siakad)->nm_mk; ?>
								</td>
								<td class="tengah fkpading"><?php echo $data->nilai_huruf_diakui;?></td>
								<td class="tengah fkpading"><?php echo $data->nilai_angka_diakui;?></td>
								<td class="tengah fkpading">
									<?php if (!empty($data->id_ekuivalensi)): ?>
										<label class="label label-success">exported</label>
									<?php else: ?>
										<label class="label label-warning">not exported</label>
									<?php endif ?>
								</td>
								<td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/mahasiswa/edit_koversi_nilai/'.$getmhs->nipd.'/'.$data->id); ?>" class="btn label label-primary"><i class="fa fa-pencil"></i></a></td>
								<td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/mahasiswa/delete_nilai_transfer/'.$getmhs->nipd.'/'.$data->id); ?>" onclick="javascript: return confirm('Yakin menghapus nilai ini ?')" class="btn label label-danger"><i class="fa fa-trash"></i></a></td>
							</tr>
							<?php $no++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div> 
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="tengah"><h4 class="modal-title" id="myModalLabel">Tambah Nilai Transfer</h4></div>
      </div>
      <form action="<?php echo base_url('index.php/prodi/mahasiswa/proses_add_mktrans'); ?>" method="post">
      	<div class="modal-body">
      		<div class="prfbox">
      			<div class="form-group">
      				<label>Kode MK Asal</label>
      				<input type="hidden" name="nipd" value="<?php echo $getmhs->npm; ?>">
      				<input type="text" class="form-control" name="kode_mk_asal" placeholder="Kode Matakuliah Asal">
      			</div>
      			<div class="form-group">
      				<label>Mata Kuliah Asal</label>
      				<input type="text" class="form-control" name="nm_mk_asal" placeholder="Matakuliah Asal">
      			</div>
      			<div class="form-group">
      				<label>SKS Asal</label>
      				<input type="text" class="form-control" name="sks_asal" placeholder="Jumlah SKS Asal">
      			</div>
      			<div class="form-group">
      				<label>Nilai Huruf Asal</label>
      				<input type="text" class="form-control" name="nilai_huruf_asal" placeholder="Nilai Huruf Asal">
      			</div>
      			<div id="loading" style="display:none">Loading...</div>
      			<div class="form-group">
      				<label>Matakuliah Diakui</label>
      				<input type="text" name="id_mk" id="namaMk" class="form-control" onkeyup="cariDosen(this.value);" onblur="pilih();" placeholder="MK" onfocus="if(this.value=='') this.value='';">
      				<div id="hasilPencarian" style="display: none;">
      					<div class="list-group" id="dataPencarian"></div>
      				</div>
      			</div>
      			<div class="form-group">
      				<label>Nilai Huruf Diakui</label>
      				<input type="text" class="form-control" name="nilai_huruf_diakui" placeholder="Nilai Huruf">
      			</div>
      			<div class="form-group">
      				<label>Nilai Angka Dakui</label>
      				<input type="text" class="form-control" name="nilai_angka_diakui" value="0.00" placeholder="Nilai Angka">
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
