<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-prodi') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">MATAKULIAH <?php  echo ucwords($nmkls->nm_mk); ?></h4>
						<div class="txtabu">Daftar Mahasiswa kelas kuliah <?php  echo $nmkls->nm_mk; ?>.</div>
					</div>
				</div>
				<?php if (empty($nmkls->id_kls)): ?>
					<div class="alert alert-danger bts-ats2">
						<p>
							<span style="font-size: 20px"><b>Peringatan</b>. . . !</span><br/>
							Kelas ini belum masuk kedalam data feeder, lakuan import kelas untuk memasukan data kelas kedalam sistem feeder PDDIKTI.
						</p>
					</div>
				<?php endif ?>
				<div class="bts-ats2">
					<h4><b>Detail Kelas</b></h4>
					<table>
						<tr>
							<td class="fktblpad2" >ID</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" >
								<?php if ($nmkls->id_kls !== NULL): ?>
									<span style="color: green"><?php echo $nmkls->id_kls; ?></span>
								<?php else: ?>
									<span style="color: red">Belum di eksport</span>
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td class="fktblpad2" >NAMA KELAS</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" ><?php echo $nmkls->nm_kls; ?></td>
						</tr>
						<tr>
							<td class="fktblpad2" >MATAKULIAH</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" ><?php echo $nmkls->nm_mk; ?></td>
						</tr>
						<tr>
							<td class="fktblpad2" >SEMESTER</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" ><?php echo $nmkls->id_smt; ?></td>
						</tr>
						<tr>
							<td class="fktblpad2" >KODE MATAKULIAH</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" ><?php echo $nmkls->kode_mk; ?></td>
						</tr>
						<tr>
							<td class="fktblpad2" >STATUS KELAS FEEDER</td>
							<td class="fktblpad2">:</td>
							<td class="fktblpad2" >
								<?php if ($nmkls->id_kls !== NULL): ?>
									<span class="label label-success">Sudah di eksport</span>
								<?php else: ?>
									<span class="label label-warning">Belum di eksport</span>
								<?php endif ?>
							</td>
						</tr>
					</table>
				</div><hr/>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="bts-ats">
						<div class="alert alert-success"><b><?php echo ucwords($this->session->flashdata('message'));?></b></div>
					</div>
				<?php endif ?>
				<div>
					<h4><b>Daftar Dosen Kelas</b></h4>
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="addmhs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-plus"></i> Tambah Dosen
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="addmhs" id="addmhs">
							<li><a href="#" data-toggle="modal" data-target="#aturkls">Dari Database</a></li>
							<?php if (!empty($nmkls->id_kls)): ?>
								<li><a href="<?php echo base_url('index.php/prodi/kelas/getdosenkelasfromfeeder/'.$nmkls->id_kls.'/'.$nmkls->id_kelas) ?>">Dari Data Feeder</a></li>
							<?php endif ?>
						</ul>
					</div>
					<table border="1" width="100%" class="bts-ats">
						<thead>
							<tr>
								<th class="fktblpad tengah" rowspan="2">NO</th>
								<th class="fktblpad tengah" rowspan="2">NIDN</th>
								<th class="fktblpad tengah" rowspan="2">NAMA</th>
								<th class="fktblpad tengah" rowspan="2">JUMLAH SKS</th>
								<th class="fktblpad tengah" colspan="2">JUMLAH PERTEMUAN</th>
								<th class="fktblpad tengah" rowspan="2">STATUS</th>
								<th class="fktblpad tengah" rowspan="2">ACTION</th>
							</tr>
							<tr>
								<th class="fktblpad tengah">RECANA</th>
								<th class="fktblpad tengah">REALISASI</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1 ?>
							<?php if ($detdosen == TRUE): ?>
								<?php foreach ($detdosen as $data): ?>
									<tr>
										<td class="fktblpad tengah"><?php echo $no; ?></td>
										<td class="fktblpad tengah"><?php echo $data->nidn; ?></td>
										<td class="fktblpad"><?php echo $data->nm_sdm; ?></td>
										<td class="fktblpad tengah"><?php echo $data->sks_subst_tot; ?></td>
										<td class="fktblpad tengah"><?php echo $data->jml_tm_renc; ?></td>
										<td class="fktblpad tengah"><?php echo $data->jml_tm_real; ?></td>
										<td class="fktblpad tengah">
											<?php if ($data->id_ajar !== NULL): ?>
												<span class="label label-success">Sudah di eksport</span>
											<?php else: ?>
												<span class="label label-warning">Belum di eksport</span>
											<?php endif ?>
										</td>
										<td class="fktblpad tengah">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle btn-sm" type="button" id="addmhs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<i class="fa fa-plus"></i> Action
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" aria-labelledby="addmhs" id="addmhs">
													<li><a href="#" data-toggle="modal" data-target="#<?php echo 'editdosen'.$data->id_ajr_dosen ?>"><i class="fa fa-pencil"></i> Edit</a></li>
													<li><a href="<?php echo base_url('index.php/prodi/kelas/delete_dosen_kelas/'.$nmkls->id_kelas.'/'.$data->id_ajr_dosen) ?>" onclick="javascript: return confirm('Yakin menghapus Dosen ini ?')"><i class="fa fa-trash"></i> Hapus</a></li>
												</ul>
											</div>
										</td>
									</tr>
									<?php $no++ ?>
									<?php $jmlsks =  $data->sks_subst_tot + (int)@$jmlsks ;?>
									<?php $totalrenc = $data->jml_tm_renc + (int)@$totalrenc; ?>
									<?php $totalreal = $data->jml_tm_real + (int)@$totalreal; ?>
								<?php endforeach ?>
								<tr>
									<td class="fktblpad tengah" colspan="3"><b>Jumlah</b></td>
									<td class="fktblpad tengah"><?php echo $jmlsks; ?></td>
									<td class="fktblpad tengah"><?php echo $totalrenc; ?></td>
									<td class="fktblpad tengah"><?php echo $totalreal; ?></td>
									<td class="fktblpad tengah" colspan="2"></td>
								</tr>
							<?php else: ?>
								<tr>
									<td class="fktblpad tengah" colspan="8">Dosen Kosong/belum di atur</td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div><hr/>
				<?php if ($this->session->flashdata('message2')): ?>
					<div class="bts-ats">
						<div class="alert alert-success"><b><?php echo ucwords($this->session->flashdata('message2'));?></b></div>
					</div>
				<?php endif ?>
				<h4><b>Daftar Mahasiswa Kelas</b></h4>
				<div class="">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="addmhs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-plus"></i> Tambah Mahasiswa
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="addmhs" id="addmhs">
							<li><a href="#" data-toggle="modal" data-target="#addexcel">Format Excel</a></li>
							<li><a href="<?php echo base_url('index.php/prodi/kelas/tmbhmhsbanyak/'.$getprod->kode_prodi.'/'.$nmkls->id_kelas);?>">Dari Database</a></li>
							<li><a href="#">Dari Penawaran Mahasiswa</a></li>
							<?php if (!empty($nmkls->id_kls)): ?>
								<li><a href="<?php echo base_url('index.php/prodi/kelas/getmhskelasfromfeeder/'.$nmkls->id_kls.'/'.$nmkls->id_kelas) ?>">Dari Data Feeder</a></li>
							<?php endif ?>
						</ul>
					</div>
					<div class="sambungfloat"></div>
				</div>
				<table border="1" width="100%" class="bts-ats">
					<thead>
						<tr>
							<th class="fktblpad tengah" rowspan="2">NO</th>
							<th class="fktblpad tengah" rowspan="2">NIPD</th>
							<th class="fktblpad tengah" rowspan="2">NAMA</th>
							<th class="fktblpad tengah" colspan="3">NILAI</th>
							<th class="fktblpad tengah" rowspan="2" colspan="2"></th>
						</tr>
						<tr>
							<th class="fktblpad tengah">ANGKA</th>
							<th class="fktblpad tengah">HURUF</th>
							<th class="fktblpad tengah">INDEKS</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($mhskls)): ?>
							<?php $no=1; ?>
							<?php foreach ($mhskls as $data): ?>
								<tr>
									<td class="fktblpad tengah"><?php echo $no; ?></td>
									<td class="tengah fktblpad"><?php echo $data->nipd; ?></td>
									<td class="fktblpad"><?php echo $data->nm_pd; ?></td>
									<td class="fktblpad tengah">
										<input type="text" style="width: 60px" class="form-control" name="nilai_angka" value="<?php echo $data->nilai_angka; ?>">
									</td>
									<td class="fktblpad tengah">
										<form action="<?php echo base_url('index.php/prodi/kelas/edit_nilai/'.$nmkls->id_kelas.'/'.$data->idnilai) ?>" method="post">
											<select class="form-control" name="nilai_huruf" onChange='this.form.submit()'>
												<option value="<?php echo $data->nilai_huruf ?>"><?php echo $data->nilai_huruf; ?></option>
												<?php foreach ($bobotnilai as $nilai): ?>
													<option value="<?php echo $nilai->nilai_huruf ?>"><?php echo $nilai->nilai_huruf; ?></option>
												<?php endforeach ?>
											</select>
										</form>
									</td>
									<td class="fktblpad tengah">
										<?php echo $data->nilai_indeks; ?>
									</td>
									<td class="tengah fkpading"><a href="<?php echo base_url('index.php/prodi/kelas/delete_mhs_kelas/'.$nmkls->id_kls.'/'.$data->id_mhs_pt); ?>"  onclick="javascript: return confirm('Yakin menghapus Mahasiswa ini ?')" class="btn label label-danger"><i class="fa fa-trash"></i> Hapus</a></td>
								</tr>
								<?php $no++ ?>
							<?php endforeach ?>
						<?php else: ?>
							<tr><td class="tengah fkpading" colspan="10"><i>Tidak ada data ditemukan.</i></td></tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal add excel -->
<div class="modal fade addpangkat" id="addexcel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Upload Data Excel</h4>
				<form action="<?php echo base_url('index.php/admin/exportmhskls/proses_input_kelas_mhs'); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_smt" value="<?php echo $nmkls->id_smt; ?>">
					<input type="hidden" name="kode_mk" value="<?php echo $nmkls->kode_mk; ?>">
					<input type="hidden" name="id_mk" value="$nmkls->id_mk; ?>">
					<input type="hidden" name="id_kls_fdr" value="<?php echo $nmkls->id_kls; ?>">
					<input type="hidden" name="id_kls" value="<?php echo $nmkls->id_kls; ?>">
					<div class="form-group">
						<label>Masukan File Exel</label>
						<input type="file" name="semester" class="form-control" placeholder="File.exl">
					</div>
					<button class="btn btn-default kanan" value="submit" name="submit">Upload</button>
				</form>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
</div>
<!-- modal atur kelas -->
<div class="modal fade addpangkat" id="aturkls" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="prfbox">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Atur Kelas</h4>
				<div class="prfbox">
					<form action="<?php echo base_url('index.php/prodi/kelas/proses_tambah_dosen_kelas'); ?>" method="post">
						<div class="form-group">
							<label>Tambah dosen</label>
							<input type="text" id="namaDosen" name="id_dosen" class="form-control" placeholder="Masukan nama Dosen" onkeyup="cariDosen(this.value);" onblur="pilih();">
							<div id="hasilPencarian" style="display: none;">
								<div class="list-group" id="dataPencarian"></div>
							</div>
						</div>
						<div class="form-group">
							<label>Jumlah SKS Mengajar</label>
							<input type="text" name="sks_subst_tot" class="form-control" placeholder="Jumlah SKS Mengajar" value="0.00">
						</div>
						<div class="form-group">
							<label>Jumlah Pertemuan Rencana</label>
							<input type="text" name="jml_tm_renc" class="form-control" placeholder="Jumlah Pertemuan Rencana" value="0">
						</div>
						<div class="form-group">
							<label>Jumlah Jumlah Pertemuan Realisasi</label>
							<input type="text" name="jml_tm_real" class="form-control" placeholder="Jumlah Pertemuan Realisasi" value="0">
						</div>
						<input type="hidden" name="id_kls_siakad" value="<?php echo $nmkls->id_kelas; ?>">
						<button class="btn btn-success kanan" value="submit" name="submit">Tambah</button>
					</form>
				</div>
				<div class="sambungfloat"></div>
			</div>
		</div>
	</div>
</div>
<?php if ($detdosen == TRUE): ?>
	<?php foreach ($detdosen as $data): ?>
		<!-- modal atur kelas -->
		<div class="modal fade addpangkat" id="<?php echo 'editdosen'.$data->id_ajr_dosen ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="prfbox">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="tengah nobold"><i class="fa fa-plus u20 txtbiru"></i> Atur Kelas</h4>
						<div class="prfbox">
							<form action="<?php echo base_url('index.php/prodi/kelas/proses_edit_dosen_kelas/'); ?>" method="post">
								<div class="form-group">
									<label>Nama Dosen</label>
									<input type="hidden" name="id_ajr_dosen" value="<?php echo $data->id_ajr_dosen ?>">
									<div class="form-control"><?php echo $data->nm_sdm; ?></div>
								</div>
								<div class="form-group">
									<label>Jumlah SKS Mengajar</label>
									<input type="text" name="sks_subst_tot" class="form-control" placeholder="Jumlah SKS Mengajar" value="<?php echo $data->sks_subst_tot ?>">
								</div>
								<div class="form-group">
									<label>Jumlah Pertemuan Rencana</label>
									<input type="text" name="jml_tm_renc" class="form-control" placeholder="Jumlah Pertemuan Rencana" value="<?php echo $data->jml_tm_renc ?>">
								</div>
								<div class="form-group">
									<label>Jumlah Jumlah Pertemuan Realisasi</label>
									<input type="text" name="jml_tm_real" class="form-control" placeholder="Jumlah Pertemuan Realisasi" value="<?php echo $data->jml_tm_real ?>">
								</div>
								<input type="hidden" name="id_kls_siakad" value="<?php echo $nmkls->id_kelas; ?>">
								<button class="btn btn-success kanan" value="submit" name="submit">Simpan perubahan</button>
							</form>
						</div>
						<div class="sambungfloat"></div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
<script type="text/javascript">
	$(function() {
		$('#loading').ajaxStart(function(){
			$(this).fadeIn();
		}).ajaxStop(function(){
			$(this).fadeOut();
		});
	});
	function cariDosen(namaDosen) {
		if(namaDosen.length == 0) {
			$('#hasilPencarian').hide();
		} else {
			$.post("<?php echo base_url('index.php/prodi/kelas/tampildosen/'); ?>",{kirimNama: ""+namaDosen+""}, function(data){
				if(data.length >0) {
					$('#hasilPencarian').fadeIn();
					$('#dataPencarian').html(data);
				}
			});
		}
	}
	function pilih(thisValue) {
		$('#namaDosen').val(thisValue);
		setTimeout("$('#hasilPencariane').fadeOut();", 100);
	}
</script>