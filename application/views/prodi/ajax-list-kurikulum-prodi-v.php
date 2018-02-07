<?php if (!empty($dafkur)): ?>
	<?php foreach ($dafkur as $key): ?>
		<option value="<?php echo $key->id_kurikulum; ?>"><?php echo ucwords(strtolower($key->nama_kur)); ?></option>
	<?php endforeach ?>
<?php else: ?>
	<option>Kosong</option>
<?php endif ?>