<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('Nusoap_lib');
		$this->load->library('Excel');
		$this->load->library('Resize');
		$this->load->model('admin/Import_m');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// setting web server
		$hostname = $this->ion_auth->user()->row()->hostname;
		$port = $this->ion_auth->user()->row()->port;
		$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
		$client = new nusoap_client($url, true);
		$proxy = $client->getProxy();
		$username =$this->ion_auth->user()->row()->userfeeder;
		$pass = $this->ion_auth->user()->row()->passfeeder;
		$token = $proxy->getToken($username, $pass);

		$data['hasil'] = $proxy->ListTable($token);
		$this->load->view('import_db',$data);
	}
	public function proses_import_nilai($id,$sts){
		if ($sts == 1) {
         	// setting data feeder
			$hostname = $this->ion_auth->user()->row()->hostname;
			$port = $this->ion_auth->user()->row()->port;
			$url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
			$client = new nusoap_client($url, true);
			$proxy = $client->getProxy();
			$username =$this->ion_auth->user()->row()->userfeeder;
			$pass = $this->ion_auth->user()->row()->passfeeder;
			$token = $proxy->getToken($username, $pass);
    // setting nama table
			$table ='nilai';
			$limit =50;
			$offest =$id;
			$order = '';
			$filter = '';
			$result = $proxy->getRecordset($token,$table,$filter,$order,$limit,$offest);
			$jml = $proxy->GetCountRecordset($token,$table,$filter);
			$getjumlah =$jml['result'];
    // default perhitungan jumlah
			$error_count = 0;
			$error = array();
			$sukses = 0;
    // perulangan
			if (!empty($result['result'])) {
				foreach ($result['result'] as $data) { 
					$check = $this->Import_m->ceknilaimhs($data['id_kls'],$data['nipd'],$data['id_smt'],$data['kode_mk']);
                // echo "<pre>";print_r($check);echo "</pre>";
					if ($check==true) {
						$error_count++;
						$error[] = $data['kode_mk']." Sudah Ada";
					}else{
						$sukses++;
						if ( substr($data['id_smt'],-1)==1) {
							$tulang='ganjil';
						}else{
							$tulang='genap';
						}
						if ($this->Import_m->getidklskul($data['id_kls']) == true) {
							$idkls = $this->Import_m->getidklskul($data['id_kls'])->id_kelas_kuliah;
						}else{
							$idkls = 0;
						}
						$datamhs = array(
							'id_tahun_ajaran'      => $data['id_smt'],
							'id_semester'      => $data['id_smt'],
							'id_mhs'      => $this->Import_m->getidmhs($data['nipd'])->id_mhs,
							'id_matakuliah' => $this->Import_m->getidmkby($data['kode_mk'])->id_matakuliah,
							'id_kls_fdr' => $data['id_kls'],
							'id_kls'      => $idkls,
							'nipd'      => $data['nipd'],
							'kode_mk'      => $data['kode_mk'],
							'nilai_mhs' => $data['nilai_indeks'],
							'nilai_angka' => $data['nilai_angka'],
							'nilai_huruf' => $data['nilai_huruf'],
							't_ulang' => $tulang,
						);
                    echo "<pre>";print_r($datamhs);echo "</pre>";exit();
						// $this->Import_m->insert_khs($datamhs);
					}
				}
				$bagian =  $id*50;
				if ( $bagian <= $getjumlah ) {
					$pesan = $bagian.' part dari '.$getjumlah.'  Sedang di proses';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/welcome/proses_import_nilai/'.$bagian.'/1'));
				}else{
					$pesan = 'data sudah dimuat';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/welcome/proses_import_nilai/0/0'));
				}
			}
		}
		else{
			$pesan = 'data sudah dimuat';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/welcome/proses_import_nilai/0/0'));
		}
		$this->load->view('admin/tes/import_nilai-v');
    }
    public function newver()
	{
		$this->load->view('admin/tes/init-v');
	}
}
