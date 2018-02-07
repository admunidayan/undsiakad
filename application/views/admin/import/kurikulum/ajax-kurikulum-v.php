<?php $no =1; ?>
<?php foreach ($allkur as $data): ?>
	<tr>
		<td class="tengah fkpading"><?php echo $no;?></td>
		<td class="fkpading"><?php echo $data->nama_kur;?></td>
		<td class="tengah fkpading"><?php echo $data->mulai_berlaku;?></td>
		<td class="fkpading"><?php echo $data->nama_jenjang_pend;?> <?php echo $data->nama_prodi;?></td>
		<td class="tengah fkpading"><?php echo $data->jml_sks_wajib;?></td>
		<td class="tengah fkpading"><?php echo $data->jml_sks_pilihan;?></td>
		<td class="tengah fkpading"><?php echo $data->total_sks;?></td>
	</tr>
	<?php $no++; ?>
<?php endforeach ?>