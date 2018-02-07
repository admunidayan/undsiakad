<?php if (!empty($dtdosen)): ?>
	<?php $no=1; ?>
	<?php foreach ($dtdosen as $data): ?>
		<tr>
			<td class="tengah fkpading"><?php echo $no; ?></td>
			<td class="fkpading"><?php echo $data->nik; ?></td>
			<td class="fkpading"><?php echo $data->nm_sdm; ?></td>
			<td class="fkpading"><?php echo $data->nm_mk; ?></td>
			<td class="tengah fkpading"><?php echo $data->tgl_lahir; ?></td>
			<td class="tengah fkpading"><?php echo $data->id_thn_ajaran; ?></td>
			<td class="tengah fkpading">
				<?php if ($data->no_srt_tgs !== ' ' || $data->no_srt_tgs !== NULL ): ?>
					<?php echo $data->no_srt_tgs; ?>
				<?php else: ?>
					-
				<?php endif ?>
			</td>
			<td class="tengah fkpading"><?php echo $data->tgl_srt_tgs; ?></td>
		</tr>
		<?php $no++; ?>
	<?php endforeach ?>
<?php else: ?>
	<tr>
		<td colspan="7" class="tengah" style="padding: 10px">Data kosong</td>
	</tr>
<?php endif ?>