<?php if (!empty($klsmeng)): ?>
	<?php $no=1; ?>
	<?php foreach ($klsmeng as $data): ?>
		<tr>
			<td class="tengah fkpading"><?php echo $no; ?></td>
			<td class="fkpading"><?php echo $data->nama_dosen; ?></td>
			<td class="tengah fkpading"><?php echo $data->kode_mk; ?></td>
			<td class="fkpading"><?php echo $data->nm_mk; ?></td>
			<td class="tengah fkpading"><?php echo $data->nm_kls; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_mk; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_subst_tot; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_tm_subst; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_prak_subst; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_prak_lap_subst; ?></td>
			<td class="tengah fkpading"><?php echo $data->sks_sim_subst; ?></td>
			<td class="tengah fkpading"><?php echo $data->jml_tm_renc; ?></td>
			<td class="tengah fkpading"><?php echo $data->jml_tm_real; ?></td>
		</tr>
		<?php $no++; ?>
	<?php endforeach ?>
<?php else: ?>
	<tr>
		<td colspan="12" class="tengah" style="padding: 10px">Data kosong</td>
	</tr>
<?php endif ?>