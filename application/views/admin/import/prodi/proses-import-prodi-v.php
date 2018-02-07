<?php 
public function update_prod_banyak(){
	$hostname = $this->ion_auth->user()->row()->hostname;
	$port = $this->ion_auth->user()->row()->port;
	$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
	$client = new nusoap_client($url, true);
	$proxy = $client->getProxy();
	$username =$this->ion_auth->user()->row()->userfeeder;
	$pass = $this->ion_auth->user()->row()->passfeeder;
	$token = $proxy->getToken($username, $pass);
	$table = 'sms';
	$filter = "id_sp = '921b9381-abed-4e3e-9ada-4a7554666b34'";
	$order ='';
	$limit =500;
	$offest =0;
	$result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);

	foreach ($result['result'] as $kode) {
		$data = array(
			"id_sms"                  =>$kode['id_sms'],
			'nama_prodi'              =>$kode['nm_lemb'],
			'smt_mulai'               =>$kode['smt_mulai'],
			'sks_lulus'               =>$kode['sks_lulus'],
			'sk_selenggara'           =>$kode['sk_selenggara'],
			'tgl_sk_selenggara'       =>$kode['tgl_sk_selenggara'],
			'tgl_berdiri'             =>$kode['tgl_berdiri'],
			'stat_prodi'              =>$kode['stat_prodi']
			);
		$id = $kode['kode_prodi'];
		$this->Sincdikti_m->update_prod($id,$data);
	}
	echo "berhasil";
}
?>