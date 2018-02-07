<div class="unirow">
	<div class="col-md-8 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Daftar group</h4>
						<div class="txtabu">Daftar lengkap group user untuk hak akses data</div>
					</div>
				</div>	
			</div>
		</div>
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-info alert-dismissible tengah" role="alert" style="margin-bottom: 7px;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-check-circle"></i> <strong><?php echo $this->session->flashdata('message');?></strong>
			</div>
		<?php endif ;?>
		<table width="100%">
			<tbody>
				<?php foreach ($allgrup as $data): ?>
					<?php if ($data->name !== 'admin'): ?>
						<tr class="whitebox2">
							<td class="fktblpad3">
								<div class="img-circle tengah" style="margin:auto;background-color: <?php printf( "#%06X\n", mt_rand( 0, 0xFFFFFF )); ?>;width:33px;color: white;padding: 6px 4px;"><?php echo strtoupper(substr($data->name, 0,2)); ?></div>
							</td>
							<td class="fktblpad3"><?php echo $data->name; ?></td>
							<td class="fktblpad3"><?php echo $data->description; ?></td>

							<td class="fktblpad3">
								<a href="<?php echo base_url('index.php/admin/groups/delete/'); ?><?php echo $data->id; ?>" class="img-circle bgpink tengah fkbtn" >
									<i class="fa fa-trash"></i>
								</a>
								<div class="img-circle bgbirut tengah fkbtn"  data-toggle="modal" data-target="#<?php echo $data->id; ?>" >
									<i class="fa fa-pencil"></i>
								</div>
							</td>

						</tr>
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-4 unipd">
		<div class="whitebox2 bts-ats">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-laptop"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Buat Group baru</h4>
						<div class="txtabu">Buat group baru untuk hak akses</div>
					</div>
				</div>
				<form action="<?php echo base_url('index.php/admin/groups/create'); ?>" method="post">
					<div class="form-group bts-ats2">
					<label for="exampleInputEmail1">Nama Group</label>
						<input type="text" name="name" class="form-control" placeholder="Nama Group">
					</div>
					<div class="form-group">
					<label for="exampleInputEmail1">Deskripsi</label>
						<input type="text" name="description" class="form-control" placeholder="Deskripsi Group">
					</div>
					<button type="submit" name="submit" value="submit" class="btn btn-info" style="width:100%">Buat group baru</button>
				</form>
			</div>
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
<!-- modal -->
<?php foreach ($allgrup as $modal): ?>
	<div class="modal fade" id="<?php echo $modal->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Group</h4>
				</div>
				<form action="<?php echo base_url('index.php/admin/groups/edit'); ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Group</label>
							<input type="hidden" name="id" value="<?php echo $modal->id; ?>">
							<input type="text" name="name" value="<?php echo $modal->name; ?>" class="form-control" placeholder="Nama Group">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Deskripsi</label>
							<input type="text" name="description" value="<?php echo $modal->description; ?>" class="form-control" placeholder="Deskripsi Group">
						</div>
						

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="submit" value="submit" class="btn btn-info">Simpan perubahan</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endforeach ?>