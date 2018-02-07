<?php 
// setting data feeder
$hostname = $this->ion_auth->user()->row()->hostname;
$port = $this->ion_auth->user()->row()->port;
$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
$client = new nusoap_client($url, true);
$proxy = $client->getProxy();
$username =$this->ion_auth->user()->row()->userfeeder;
$pass = $this->ion_auth->user()->row()->passfeeder;
$token = $proxy->getToken($username, $pass);
// get jumlah data
$table ='mata_kuliah_kurikulum';
$filter2 = "";
$jml = $proxy->GetCountRecordset($token,$table,$filter2);
$getjumlah =$jml['result'];
?>
<div class="unirow" id="mainpage">
	<?php $this->load->view('nav/nav-import') ?>
	<div class="col-md-10 unipd">
		<div class="whitebox2 fk-min bts-ats fk-min">
			<div class="prfbox">
				<div class="media">
					<div class="media-left media-middle">
						<div class="dashsubttl"><i class="fa fa-book"></i></div>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Import Matakuliah Kurikulum</h4>
						<div class="txtabu">Import Matakuliah kurikulum dari Web Service Feeder</div>
					</div>
					<div class="media-right media-middle">
						<button class="btn btn-success tengah"><i class="fa fa-plus"></i> Import Data Feeder</button>
					</div>
				</div>
				<div class="hasil"></div>
				<div class="bts-ats2"><label class="label label-success"><?php echo $getjumlah; ?></label> Jumlah Matakuliah Kurikulum Feeder</div>
				<table border="1" class="bts-ats" width="100%">
					<thead>
						<tr>
							<th rowspan="2" class="tengah fkpading">NO</th>
							<th rowspan="2" class="tengah fkpading">KODE MK</th>
							<th rowspan="2" class="tengah fkpading">MATAKULIAH</th>
							<th rowspan="2" class="tengah fkpading">SMT</th>
							<th colspan="2" class="tengah fkpading">KURIKULUM</th>
							<th rowspan="2" class="tengah fkpading">W/P</th>
						</tr>
						<tr>
							<th class="tengah fkpading">KURIKULUM</th>
							<th class="tengah fkpading">PRODI</th>
						</tr>
					</thead>
					<tbody>
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
					</tbody>
				</table>
				<?php echo $pagging; ?>
			</div> 
		</div>
	</div>
	<div class="sambungfloat"></div>
</div>
