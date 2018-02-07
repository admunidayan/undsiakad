<?php if ($this->session->flashdata('message')): ?>
	<div class="alert alert-danger alert-dismissible tengah" role="alert" style="margin-top:7px;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<i class="fa fa-warning"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
	</div>
<?php endif ;?>
ASD