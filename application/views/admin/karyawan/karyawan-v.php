<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-karyawan') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $title; ?></h4>
						<div class="txtabu"><?php echo $title; ?></div>
					</div>
					<div class="media-right media-middle">
						<button class="btn buttonlist bgbirut txtputih" data-toggle="modal" data-target="#add"><i class="fa fa-plus-circle"></i> <b>Buat Karyawan baru</b></button>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')): ?>
					<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
					</div>
				<?php endif ?>
				<div class="hasil"></div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">NAMA</th>
							<th rowspan="2" class="tengah fkpading">USERNAME</th>
							<th rowspan="2" class="tengah fkpading">EMAIL</th>
							<th rowspan="2" class="tengah fkpading">CREATE</th>
							<th rowspan="2" class="tengah fkpading">LAST LOG</th>
							<th rowspan="2" class="tengah fkpading">LEVEL</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1 ?>
						<?php foreach ($alluser as $data): ?>
							<tr>
								<td class="tengah fkpading"><?php echo $no; ?></td>
								<td class="fkpading"><a href="<?php echo base_url('index.php/admin/karyawan/edit/'.$data->id); ?>"><?php echo $data->first_name; ?> <?php echo $data->last_name; ?></a></td>
								<td class="tengah fkpading"><?php echo $data->username; ?></td>
								<td class="tengah fkpading"><?php echo $data->email; ?></td>
								<td class="tengah fkpading"><?php echo unix_to_human($data->created_on); ?></td>
								<td class="tengah fkpading"><?php echo unix_to_human($data->last_login); ?></td>
								<td class="tengah fkpading">
									<?php foreach ($this->Karyawan_m->grupuser($data->id) as $dtg): ?>
										<?php if ($dtg->name == 'admin'): ?>
											<i class="fa fa-circle txt-xs txtbirut"></i> <span class="txtabu txt-small"><?php echo $dtg->name; ?></span>	
										<?php else: ?>
											<i class="fa fa-circle txt-xs" style="color:yellow"></i> <span class="txtabu txt-small"><?php echo $dtg->name; ?></span>
										<?php endif ?>
									<?php endforeach ?>
								</td>
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
<!-- modal -->
<div class="modal fade" id="add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Buat Karyawan baru</h4>
						<div class="txtabu">membuat karyawan baru Universitas</div>
					</div>
				</div>	
			</div>
			<form action="<?php echo base_url('index.php/admin/karyawan/proses_add_karyawan'); ?>" method="post">
				<div class="modal-body">
					<table width="100%">
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nama Depan </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="namadep" placeholder="Nama Depan">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nama Belakang </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="namabel" placeholder="Nama Belakang">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Username </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="username" placeholder="Username">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Password </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="Password" class="fkinput2" name="password" placeholder="Minimal 8 karakter, Maksimal 25 karakter">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Email </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="email" class="fkinput2" name="email" placeholder="example@und.ac.id">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Nomor HP </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput2" name="phone" placeholder="0823-1234-5678">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h5>Hak Akses </h5>
								</div>
							</td>
							<td class="fkpading">:</td>
							<td class="fkpading" width="85%">
								<?php foreach ($allgroup as $grb): ?>
									<?php if ($grb->name !== 'admin'): ?>
										<input type="checkbox" name="group[]" class="pilih" value="<?php echo $grb->id; ?>"><?php echo $grb->name; ?>
									<?php endif ?>
								<?php endforeach ?>
								<a id="select_all">pilih semua</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" value="submit" class="btn btn-info">Simpan akun</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script type="text/javascript">
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
</script>