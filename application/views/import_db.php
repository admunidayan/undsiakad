<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'undtes';
error_reporting(E_ALL ^ E_DEPRECATED);
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);
if(! $koneksi )
{
	die('Gagal Koneksi: ' . mysql_error());
}
echo 'Koneksi Berhasil';
foreach ($hasil['result'] as $data) {
	// setting web server
	$hostname = $this->ion_auth->user()->row()->hostname;
	$port = $this->ion_auth->user()->row()->port;
	$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
	$client = new nusoap_client($url, true);
	$proxy = $client->getProxy();
	$username =$this->ion_auth->user()->row()->userfeeder;
	$pass = $this->ion_auth->user()->row()->passfeeder;
	$token = $proxy->getToken($username, $pass);
	$hasil2 = $proxy->getDictionary($token,$data['table']);
	// hasil
	$sql = 'CREATE TABLE '.$data['table'].'('.'id_'.$data['table'].' AUTO_INCREMENT PRIMARY KEY NOT NULL'.')';
	mysql_select_db('undtes');
	$buattabel = mysql_query( $sql, $koneksi );
	foreach ($hasil2['result'] as $isi) {
		// echo "<pre>";print_r($isi);echo "<pre/>";exit();
		if ($isi['pk'] == 0) {
			'ALTER TABLE '.$data['table'].' ADD '.$isi['column_name'].' '.$isi['type'].' NULL';
			mysql_select_db('undtes');
			$buattabel = mysql_query( $sql, $koneksi );
		}
	}
}
?>