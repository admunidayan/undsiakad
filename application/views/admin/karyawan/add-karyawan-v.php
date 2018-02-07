<?php if ($this->session->flashdata('message')): ?>
	<div class="alert alert-success alert-dismissible tengah" role="alert" style="margin-top:7px;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-warning"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
	</div>
<?php endif ;?>
<div class="unirow">
	<div class="col-md-12 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="tengah">
					<h1>Tambah Karyawan</h1>
				</div>
				<form action="<?php echo base_url('index.php/admin/karyawan/proses_add_karyawan'); ?>" method="post">
					<table width="100%">
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Nama Depan : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput" name="namadep" placeholder="Nama Depan">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Nama Belakang : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput" name="namabel" placeholder="Nama Belakang">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Username : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput" name="username" placeholder="Username">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Password : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="Password" class="fkinput" name="password" placeholder="Minimal 8 karakter, Maksimal 25 karakter">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Email : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="email" class="fkinput" name="email" placeholder="example@und.ac.id">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Nomor HP : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput" name="phone" placeholder="0823-1234-5678">
							</td>
						</tr>
						<tr>
							<td class="fkpading" width="15%">
								<div class="kanan">
									<h4>Hak Akses : </h4>
								</div>
							</td>
							<td class="fkpading" width="85%">
								<input type="text" class="fkinput" name="group" value="1">
							</td>
						</tr>
					</table>
					<button type="submit" class="btn btn-default btn-lg" name="submit" value="submit">Buat Karyawan</button>
				</form>
			</div>
		</div>
	</div>
</div>