<?php $no =1; ?>
<?php foreach ($allmk as $data): ?>
	<tr>
		<td class="tengah fkpading"><?php echo $no;?></td>
		<td class="tengah fkpading"><?php echo $data->kode_matakuliah;?></td>
		<td class="fkpading"><?php echo ucwords(strtolower($data->nama_matakuliah));?></td>
		<td class="tengah fkpading"><?php echo $data->id_semester;?></td>
		<td class="tengah fkpading"><?php echo ucwords(strtolower($data->nama_kur));?></td>
		<td class="tengah fkpading"><?php echo $data->nama_prodi;?></td>
		<td class="tengah fkpading"><?php echo $data->jns_mk;?></td>
	</tr>
	<?php $no++; ?>
<?php endforeach ?>