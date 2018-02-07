<?php $no =1; ?>
<?php foreach ($mhsprod as $data): ?>
	<tr>
		<td class="tengah fkpading"><?php echo $no; ?></td>
		<td class="tengah fkpading"><?php echo $data->npm ?></td>
		<td class="fkpading"><?php echo ucwords(strtolower($data->nama_mhs)); ?></td>
		<td class="tengah fkpading"><?php echo $data->username; ?></td>
		<td class="tengah fkpading"><?php echo $data->angkatan; ?></td>
		<td class="tengah fkpading"><?php echo $data->gender_mhs; ?></td>
		<td class="tengah fkpading"><?php echo $data->tgl_lhr_mhs; ?></td>
		<td class="fkpading"><?php echo $data->tmpt_lahir; ?></td>
		<td class="tengah fkpading"><?php echo $data->status_mhs; ?></td>
		<td class="tengah fkpading">
			<a href="<?php echo base_url('index.php/admin/import/mhsprodi/'.$data->id_mhs); ?>" class="btn label label-success tengah">lihat</a>
		</td>
	</tr>
	<?php $no++; ?>
<?php endforeach ?>