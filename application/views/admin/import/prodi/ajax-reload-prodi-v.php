<?php $no =1; ?>
<?php foreach ($allprod as $data): ?>
	<tr>
		<td class="tengah fkpading"><?php echo $no; ?></td>
		<td class="tengah fkpading"><?php echo $data->kode_prodi ?></td>
		<td class="fkpading"><?php echo $data->nama_jenjang_pend; ?> <?php echo $data->nama_prodi; ?></td>
		<td class="tengah fkpading"><?php echo $data->sks_lulus; ?></td>
		<td class="tengah fkpading"><?php echo $data->sk_selenggara; ?></td>
		<td class="tengah fkpading"><?php echo $data->smt_mulai; ?></td>
		<td class="tengah fkpading"><?php echo $data->tgl_sk_selenggara; ?></td>
		<td class="tengah fkpading"><?php echo $data->tgl_berdiri; ?></td>
		<td class="tengah fkpading"><?php echo $data->stat_prodi; ?></td>
	</tr>
	<?php $no++; ?>
<?php endforeach ?>