<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-mahasiswa') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-user-circle-o"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Nilai Matakuliah</h4>
						Detail Nilai Matakuliah mahasiswa
					</div>
					<div class="media-right media-middle">
						<button id="addmk" class="btn buttonlist bghijau txtputih" data-toggle="modal" data-target="#modaladdmk"><i class="fa fa-plus-circle"></i> <b>Tambah Matakuliah</b></button>
					</div>
				</div>
				<div class="bts-ats2">
					<div class="media">
						<div class="media-left media-middle">
							<img class="img-circle" style="border: 2px solid #eeeeee" src="<?php echo base_url('asset/img/users/'.$getmhs->foto_profil_mhs); ?>" width="50px">
						</div>
						<div class="media-body media-middle">
							<h4 class="media-heading">NAMA : <?php echo $getmhs->nm_pd; ?></h4>
							<p class="txtabu">NPM  : <?php echo $getmhs->nipd; ?></p>
						</div>
					</div>
					<table border="1" class="bts-ats" width="100%" style="font-size: 11px">
						<thead>
							<tr>
								<th rowspan="2" class="tengah fkpading">NO</th>
								<th rowspan="2" class="tengah fkpading">KODE MK</th>
								<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
								<th rowspan="2" class="tengah fkpading">KLS</th>
								<th rowspan="2" class="tengah fkpading">TAHUN</th>
								<th rowspan="2" class="tengah fkpading">SKS</th>
								<th colspan="2" class="tengah fkpading">NILAI</th>
								<th rowspan="2" class="tengah fkpading">ACTION</th>
							</tr>
							<tr>
								<th class="tengah fkpading">HRF</th>
								<th class="tengah fkpading">INDEX</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($khsmhs)): ?>
								<?php $no =1; ?>
								<?php foreach ($khsmhs as $data): ?>
									<tr>
										<td class="tengah fkpading"><?php echo $no; ?></td>
										<td class="tengah fkpading"><?php echo $data->kode_mk; ?></td>
										<td class="fkpading"><?php echo @$this->Mahasiswa_m->get_mk($data->kode_mk)->nm_mk; ?></td>
										<td class="tengah fkpading"><?php echo @$this->Mahasiswa_m->get_kls($data->id_kls)->nm_kls; ?></td>
										<td class="tengah fkpading"><?php echo $data->id_smt; ?></td>
										<td class="tengah fkpading"><?php echo @$this->Mahasiswa_m->get_mk($data->kode_mk)->sks_mk; ?></td>
										<td class="tengah fkpading"><?php echo $data->nilai_huruf; ?></td>
										<td class="tengah fkpading"><?php echo $data->nilai_indeks; ?></td>
										<td class="tengah fkpading">
											<button class="btn label label-success editnilai" data-id="<?php echo $data->id ?>" data-toggle="modal" data-target="#modaledit">edit</button>
											<a href="<?php echo base_url('index.php/prodi/nilai_mhs/delete_nilai/'.$data->id); ?>" onclick="javascript: return confirm('Yakin menghapus nilai ini ?')" class="btn label label-danger">hapus</a>
										</td>
									</tr>
									<?php $no++ ?>
									<?php $sks = @$this->Mahasiswa_m->get_mk($data->kode_mk)->sks_mk + (int)@$sks; ?>
									<?php
									$jmlahsks =  @$this->Mahasiswa_m->get_mk($data->kode_mk)->sks_mk + (int)@$jmlahsks ;
									?>
								<?php endforeach ?>
								<tr>
									<td colspan="5" class="tengah fkpading"><b>Total SKS</b></td>
									<td class="tengah fkpading"><b><?php echo $jmlahsks; ?></b></td>
									<td colspan="3"></td>
								</tr>
							<?php else: ?>
								<tr>
									<td colspan="9" class="tengah fkpading">Data Kosong</td>
								</tr>
							<?php endif ?>
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
				<h4 class="modal-title tengah"><i class="fa fa-pencil"></i> Edit Nilai Matakuliah</h4>
			</div>
			<form action="<?php echo base_url('index.php/prodi/nilai_mhs/edit_nilai'); ?>" method="post">
				<div class="modal-body">
					<div id="nm_mk" class="tengah"></div>
					<div class="row">
						<input type="hidden" id="id_khs" class="id_khs" name="id_khs">
						<input type="hidden" id="id_mhs" class="id_mhs" name="id_mhs">
						<div class="col-md-4">
							<div class="form-group form-group-lg bts-ats">
								<label>angka</label>
								<input type="text" id="nilai_angka" class="form-control nilai_angka" name="nilai_angka" placeholder="Angka">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-group-lg bts-ats">
								<label>Huruf</label>
								<input type="text" id="nilai_huruf" class="form-control nilai_huruf" name="nilai_huruf" placeholder="Huruf">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group form-group-lg bts-ats">
								<label>Index</label>
								<input type="text" id="nilai_mhs" class="form-control nilai_mhs" name="nilai_mhs" placeholder="Index">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- modal tambah matakuliah -->
<div class="modal fade" id="modaladdmk" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title tengah"><i class="fa fa-pencil"></i> Tambah Matakuliah</h4>
			</div>
			<div id="hasil"></div>
			<form id="tambahmk" action="#" method="post">
				<input type="hidden" name="id_mhs" value="<?php echo $getmhs->id; ?>">
				<div class="modal-body">
					<div id="listmk" style="max-height: 500px; overflow: scroll;">
						<div class="prfbox">
							<table border="1" width="100%">
								<thead>
									<tr>
										<th class="tengah fkpading"><input type="checkbox" id="select_all"></th>
										<th class="tengah fkpading">KODE</th>
										<th class="tengah fkpading">MATAKULIAH</th>
										<th class="tengah fkpading">SKS</th>
										<th class="tengah fkpading">SMT</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($mkblumada)): ?>
										<?php foreach ($mkblumada as $data): ?>
											<tr>
												<td class="tengah fkpading"><input class="pilih" type="checkbox" name="pilih[]" value="<?php echo $data->id_matakuliah; ?>"></td>
												<td class="tengah fkpading"><?php echo $data->kode_matakuliah; ?></td>
												<td class="fkpading"><?php echo $data->nama_matakuliah; ?></td>
												<td class="tengah fkpading"><?php echo $data->jumlah_sks; ?></td>
												<td class="tengah fkpading"><?php echo $data->semester_matakuliah; ?></td>
											</tr>
										<?php endforeach ?>
									<?php else: ?>
										<tr>
											<td colspan="10" class="tengah" style="padding: 10px">Data kosong</td>
										</tr>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="submitaddmk" type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#submitaddmk").click(function(event){
			document.getElementById("hasil").innerHTML = '<div id="infohasil" class="alert bts-ats tengah"><i class="fa fa-refresh fa-spin txthijau"></i> Menambah Matakuliah...</div>';
			$.ajax({
				url : "<?php echo base_url('index.php/prodi/nilai_mhs'); ?>",
				type: "post",
				data: $("#tambahmk").serialize(),
			})
			.done(function(msg) {
				$('#infohasil').remove();
				$('#hasil').append('<div id="infohasil" class="alert alert-success bts-ats tengah"><i class="fa fa-check-circle-o"></i> Penambahan mtakuliah selesai</div>');
			})
			.fail(function(datae) {
				$('#infohasil').remove();
				$('#hasil').append('<div id="infohasil" class="alert alert-danger bts-ats tengah"><i class="fa fa-warning"></i> <b>Terjadi kesalahan!</b> Gagal Melakukan Penambahan Matakuliah</div>');
			})
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
		});
	});
</script>