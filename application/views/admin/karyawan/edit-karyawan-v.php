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
				</div>
				<div class="bts-ats">
					<?php if ($this->session->flashdata('message')): ?>
						<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:65px;">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
						</div>
					<?php endif ?>
					<form action="<?php echo base_url('index.php/admin/karyawan/proses_edit'); ?>" method="post" enctype="multipart/form-data">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Depan</label>
								<input type="hidden" name="id" value="<?php echo $detail->id; ?>">
								<input type="text" class="form-control" name="first_name" value="<?php echo $detail->first_name; ?>" placeholder="Nama Depan">
							</div>
							<div class="form-group">
								<label class="control-label">Nama Belakang</label>
								<input type="text" class="form-control" name="last_name" value="<?php echo $detail->last_name; ?>" placeholder="Nama Belakang">
							</div>
							<div class="form-group">
								<label class="control-label">Username</label>
								<input type="text" class="form-control" name="username" value="<?php echo $detail->username; ?>" placeholder="Username">
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" class="form-control" name="email" value="<?php echo $detail->email; ?>" placeholder="Email">
							</div>
							<div class="form-group">
								<label class="control-label">Company</label>
								<input type="text" class="form-control" name="company" value="<?php echo $detail->company; ?>" placeholder="Company">
							</div>
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" class="form-control" name="phone" value="<?php echo $detail->phone; ?>" placeholder="Phone">
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label">profil Image</label>
							<div class="box-profil">
								<img id="preview" src="<?php echo base_url('asset/img/users/'.$detail->profile); ?>" width="100%">
								<input id="uploadBtn" type="file" class="bts-ats" name="profile">
							</div>
							<div class="form-group" style="margin-top: 30px;">
								<label class="control-label">Groups</label><br/>
								<?php foreach ($groups as $gg): ?>
									<input type="checkbox" name="groups[]" value="<?php echo $gg->id; ?>" 
									<?php foreach ($usergroups as $us): ?>
										<?php if ($gg->id==$us){echo('checked');} ?>
									<?php endforeach ?>
									> <?php echo $gg->name; ?>
								<?php endforeach ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-12">
							<button class="btn btn-success btn-lg" style="width:100%">Edit User</button>
						</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<script type="text/javascript">
	document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
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

	$("#uploadBtn").change(function(){
		readURL(this);
	});
</script>