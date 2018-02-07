<?php $no =1; ?>
<?php foreach ($allprod as $data): ?>
	<tr>
		<td class="tengah fkpading"><?php echo $no; ?></td>
		<td class="tengah fkpading"><?php echo $data->kode_prodi ?></td>
		<td class="fkpading"><?php echo $data->nm_lemb; ?></td>
		<td class="tengah fkpading"><?php echo $data->sks_lulus; ?></td>
		<td class="tengah fkpading"><?php echo $data->sk_selenggara; ?></td>
		<td class="fkpading">
			<?php if (!empty($data->nama_kur)): ?>
				<?php echo ucwords(strtolower($data->nama_kur)) ?>
			<?php else: ?>
				<i class="fa fa-exclamation-circle txtbirut"></i> Tidak diisi
			<?php endif ?>	
		</td>
		<td class="tengah fkpading">
			<button class="btn label label-success editkur" data-id="<?php echo $data->id ?>" data-toggle="modal" data-target="#modaledit">edit</button>
		</td>
	</tr>
	<?php $no++; ?>
<?php endforeach ?>
<script type="text/javascript">
	$('.editkur').click(function(event) {
		var id = $(this).data('id');
		$.ajax({
			url : "<?php echo base_url('index.php/admin/setting/editkur'); ?>",
			type: 'post',
			dataType: 'json',
			data: {id_prodi:id}
		})
		.done(function(khs) {
			$('#kursaatini').remove();
			$('#prodi_id').val(id);
			$('#headerkur').append('<h4 id="kursaatini">'+khs.nama_kur+'</h4>');
			getlistkur(id);
		})
		.fail(function() {
			alert("gagal");
		})
	});
	function getlistkur(id){
		$.ajax({
			url : "<?php echo base_url('index.php/admin/setting/listkurprod/'); ?>"+id,
			type: "get",
			success:function(data){
				$('#selkuri').html(data);
			},
		    error: function (){ // jqXHR, textStatus, errorThrow <- awalnya ada di dalam kurung
		    	alert('error adding / Updating data');
		    }
		});
	}
</script>