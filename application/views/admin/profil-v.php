<div class="unirow bts-ats">
	<div class="col-md-12 unipd">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-success alert-dismissible tengah" role="alert" style="margin-bottom:7px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?php echo $this->session->flashdata('message');?></strong>
			</div>
		<?php endif ;?>
		<div class="bgbox">
			<form action="<?php echo base_url('index.php/admin/profil/edit'); ?>" method="post" enctype="multipart/form-data">
				<div class="bguser">
					<img src="<?php echo base_url('asset/img/bg/bg3.png'); ?>" width="100%">
					<div class="editbox-left"><?php echo ucfirst($dtadm->first_name); ?> <?php echo ucfirst($dtadm->last_name); ?></div>
				</div>
				<div class="dpbox">
					<div class="dpkot">
						<img class="dpimg" id="preview" src="<?php echo base_url('asset/img/users/'); ?><?php echo $dtadm->profile; ?>" width="100%">
						<label for="inputimg" class="editbox" style="border-radius:50%;padding: 14px 17px;">
							<input type="file" id="inputimg" class="inputfile" name="profile">
							<i class="fa fa-camera"></i>
						</label>
						<h3 class="tengah"><?php echo ucfirst($dtadm->username); ?></h3>
						<h6 class="tengah"><i class="fa fa-envelope-o"></i> <?php echo ucfirst($dtadm->email); ?></h6>
						<h6 class="tengah"><i class="fa fa-mobile"></i> <?php echo ucfirst($dtadm->phone); ?></h6>
					</div>
				</div>
				<div class="prfbox bts-ats2">
					<div class="col-md-4 bts-bwh" style="min-height:407px;">
						<h4 class="txtabu"><i class="fa fa-user"></i> <b>Data diri anda : </b></h4><hr/>
						
						<div class="form-group form-group-lg">
							<label class="txtabu">Nama Depan</label>
							<input type="hidden" name="idadm" value="<?php echo $dtadm->id; ?>">
							<input type="text" class="form-control" name="first" placeholder="Nama Depan" value="<?php echo $dtadm->first_name; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Nama Belakang</label>
							<input type="text" class="form-control" name="last" placeholder="Nama Depan" value="<?php echo $dtadm->last_name; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $dtadm->username; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $dtadm->email; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Handphone</label>
							<input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" value="<?php echo $dtadm->phone; ?>">
						</div>
					</div>
					<div class="col-md-4 bts-bwh" style="min-height:407px;">
						<h4 class="txtabu"><i class="fa fa-cloud-download"></i> <b>Data Feeder : </b></h4><hr/>
						<div class="form-group form-group-lg">
							<label class="txtabu">Hostname</label>
							<input type="text" class="form-control" name="host" placeholder="Hostname" value="<?php echo $dtadm->hostname; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Port</label>
							<input type="text" class="form-control" name="port" placeholder="Port" value="<?php echo $dtadm->port; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Username Feeder</label>
							<input type="text" class="form-control" name="userfeeder" placeholder="Username Feeder" value="<?php echo $dtadm->userfeeder; ?>">
						</div>
						<div class="form-group form-group-lg">
							<label class="txtabu">Password Feeder</label>
							<input type="password" class="form-control" name="passfeeder" placeholder="Password Feeder" value="<?php echo $dtadm->passfeeder; ?>">
						</div>
					</div>
					<div class="col-md-4 bts-bwh">
						<h4 class="txtabu"><i class="fa fa-users"></i> <b>List Group : </b></h4><hr/>
						<ul class="list-group">
							<?php foreach ($gruser as $dtg): ?>
								<li class="list-group-item">
									<span class="label label-success"><?php echo $dtg->name; ?></span> <?php echo $dtg->description; ?>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<div class="col-md-12 bts-bwh">
						<hr/>
						<div class="btnkot"><button class="btn buttonlist-lg bgbirut btn-lg" style="width: 100%" name="submit" type="submit" value="submit"><b>Simpan</b></button></div>
					</div>
					<div class="sambungfloat"></div>
				</div>
			</form>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
  document.getElementById("inputimg").onchange = function () {
    document.getElementById("inputimg").value = this.value;
  };

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inputimg").change(function(){
    readURL(this);
  });
</script>