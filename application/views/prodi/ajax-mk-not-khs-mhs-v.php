<div class="prfbox">
	<table border="1" width="100%">
		<thead>
			<tr>
				<th class="tengah fkpading"><input type="checkbox" id="select_all"></th>
				<th class="tengah fkpading">KODE</th>
				<th class="tengah fkpading">MATAKULIAH</th>
				<th class="tengah fkpading">SKS</th>
				<th class="tengah fkpading">SMT</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($mkblumada)): ?>
				<?php foreach ($mkblumada as $data): ?>
					<tr>
						<td class="tengah fkpading pilih"><input type="checkbox" name="pilih[]" value="<?php echo $data->id_matakuliah; ?>"></td>
						<td class="tengah fkpading"><?php echo $data->kode_matakuliah; ?></td>
						<td class="fkpading"><?php echo $data->nama_matakuliah; ?></td>
						<td class="tengah fkpading"><?php echo $data->jumlah_sks; ?></td>
						<td class="tengah fkpading"><?php echo $data->semester_matakuliah; ?></td>
					</tr>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="10" class="tengah" style="padding: 10px">Data kosong</td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$("#select_all").change(function(){  //"select all" change 
    var status = this.checked; // "select all" checked status
    $('.pilih').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

$('.pilih').change(function(){ //".checkbox" change 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#select_all")[0].checked = false; //change "select all" checked status to false
    }
    
    //check "select all" if all checkbox items are checked
    if ($('.pilih:checked').length == $('.pilih').length ){ 
        $("#select_all")[0].checked = true; //change "select all" checked status to true
    }
});
</script>