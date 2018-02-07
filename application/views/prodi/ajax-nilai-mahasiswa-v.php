<?php if (!empty($khsmhs)): ?>
	<?php $no=1; ?>
	<?php foreach ($khsmhs as $data): ?>
		<tr>
			<td class="tengah fkpading"><?php echo $no; ?></td>
			<td class="tengah fkpading"><?php echo $data->kode_mk; ?></td>
			<td class="fkpading"><?php echo $data->nama_matakuliah; ?></td>
			<td class="tengah fkpading">
				<?php if (!empty($this->Mahasiswa_m->get_kelas($data->id_kls))): ?>
					<?php echo $this->Mahasiswa_m->get_kelas($data->id_kls)->nama_kelas; ?>
				<?php else: ?>
					-
				<?php endif ?>
			</td>
			<td class="tengah fkpading"><?php echo $data->id_tahun_ajaran; ?></td>
			<td class="tengah fkpading"><?php echo $data->jumlah_sks; ?></td>
			<td class="tengah fkpading"><?php echo $data->nilai_angka; ?></td>
			<td class="tengah fkpading"><?php echo $data->nilai_huruf; ?></td>
			<td class="tengah fkpading"><?php echo $data->nilai_mhs; ?></td>
			<td class="tengah fkpading">
				<button class="btn label label-success editnilai" data-id="<?php echo $data->id_khs ?>" data-toggle="modal" data-target="#modaledit">edit</button>
				<a href="<?php echo base_url('index.php/prodi/nilai_mhs/delete_nilai/'.$data->id_mhs.'/'.$data->id_khs); ?>" onclick="javascript: return confirm('Yakin menghapus nilai ini ?')" class="btn label label-danger">hapus</a>
			</td>
		</tr>
		<?php $no++; ?>
	<?php endforeach ?>
<?php else: ?>
	<tr>
		<td colspan="10" class="tengah" style="padding: 10px">Data kosong</td>
	</tr>
<?php endif ?>
<script type="text/javascript">
	$('.editnilai').click(function(event) {
			var id = $(this).data('id');
			$.ajax({
				url : "<?php echo base_url('index.php/prodi/mahasiswa/editnilaimkmhs'); ?>",
				type: 'post',
				dataType: 'json',
				data: {id_khs:id}
			})
			.done(function(khs) {
				$( "#nmk" ).remove();
				$('#nm_mk').append('<h4 id="nmk">'+khs.kode_mk+ " - "+khs.nama_matakuliah+'</h4>');
				$('#id_khs').val(khs.id_khs);
				$('#id_mhs').val(khs.id_mhs);
				$('#nilai_huruf').val(khs.nilai_huruf);
				$('#nilai_angka').val(khs.nilai_angka);
				$('#nilai_mhs').val(khs.nilai_mhs);
			})
			.fail(function() {
				alert("gagal");
			})
		});
</script>