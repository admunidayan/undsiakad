<?php if (!empty($dosenpt)): ?>
	<?php $no=1; ?>
	<?php foreach ($dosenpt as $data): ?>
		<tr>
			<td class="tengah fkpading"><?php echo $no; ?></td>
			<td class="fkpading"><?php echo $data->nm_sdm; ?></td>
			<td class="tengah fkpading"><?php echo $data->nik; ?></td>
			<td class="tengah fkpading"><?php echo $data->fk__thn_ajaran; ?></td>
			<td class="tengah fkpading"><?php echo $data->fk__sms; ?></td>
			<td class="tengah fkpading"><?php echo $data->no_srt_tgs; ?></td>
			<td class="tengah fkpading"><?php echo $data->tgl_srt_tgs; ?></td>
		</tr>
		<?php $no++; ?>
	<?php endforeach ?>
<?php else: ?>
	<tr>
		<td colspan="7" class="tengah" style="padding: 10px">Data kosong</td>
	</tr>
<?php endif ?>