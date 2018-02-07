<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('Nusoap_lib');
		$this->load->library('Init_lib');
		$this->load->library('Excel');
		$this->load->library('Resize');
		$this->load->model('admin/Rekap_m');
	}
	// slider
	public function index($offset=0){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$data['title'] = 'Rekap Data';
				$data['dtadm'] = $this->ion_auth->user()->row();
				if ($this->ion_auth->in_group('admin')) {
					$data['nav'] = 'nav/nav-admin';
				}else{
					$data['nav'] = 'nav/nav-members';
				}
				$post = $this->input->get();
				if ($post == TRUE) {
					$data['semes'] = $post['string'];
				}else{
					$data['semes'] = $this->Rekap_m->order_semester()->id_smt;
				}
				$data['hasil'] = $this->Rekap_m->get_semester();
				$data['prodi'] = $this->Rekap_m->get_prodi();
				// echo "<pre>";print_r($this->Rekap_m->jumlah_aktif('ffd96664-f02a-4c27-97cd-9adacf9e04fd','20161','B'));echo "<pre/>";exit();
				$data['page'] = 'admin/rekaptulasi/rekapdata-v';
				// pagging setting
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin//login'));
		}
	}
	function dataexcel($prodi,$smt){
		if ($this->ion_auth->logged_in()){
			$level = 'admin';  
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard_c'));
			}else{
				$post = $this->input->post('');
				$data['title'] = 'List Pembayaran Calon Peserta';
				$detsms = $this->Rekap_m->detail_prodi($prodi);
      // $data['page'] = 'admin/export-v';
      // $data['nav'] = 'nav/nav-admin';
      // $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
				$file = new PHPExcel ();
				$file->getProperties ()->setCreator ( "Goblooge" );
				$file->getProperties ()->setLastModifiedBy ( "www.wisuda.unidayan.ac.id" );
				$file->getProperties ()->setTitle ( "Daftar Wisudawan Periode Juli 2017" );
				$file->getProperties ()->setSubject ( "Daftar Wisudawan" );
				$file->getProperties ()->setDescription ( "Daftar Wisudawan" );
				$file->getProperties ()->setKeywords ( "Daftar Wisudawan" );
				$file->getProperties ()->setCategory ( "Wisudawan" );
				/*end - BLOCK PROPERTIES FILE EXCEL*/

				/*start - BLOCK SETUP SHEET*/
				$file->createSheet ( NULL,0);
				$file->setActiveSheetIndex ( 0 );
				$sheet = $file->getActiveSheet ( 0 );
  //memberikan title pada sheet
				$sheet->setTitle ('Rekap Data');
				/*end - BLOCK SETUP SHEET*/

				/*start - BLOCK HEADER*/
				$sheet->setCellValue ( "A1", "No" );
				$sheet->setCellValue ( "B1", "Stambuk" );
				$sheet->setCellValue ( "C1", "Nama" );
				$sheet->setCellValue ( "D1", "Status" );
				/*end - BLOCK HEADER*/

				/* start - BLOCK MEMASUKAN DATABASE*/
				$nomor = 1;
				$nocel = 2;
				$hasil = $this->Rekap_m->get_mhs($prodi,$smt);
                // echo "<pre>";print_r($hasil);echo "</pre>";exit();
				foreach ($hasil as $data) {
					$sheet->setCellValue ( "A".$nocel, $nomor );
					$sheet->setCellValue ( "B".$nocel, $data->nipd );
					$sheet->setCellValue ( "C".$nocel, strtoupper($data->nm_pd));
					$sheet->setCellValue ( "D".$nocel, trim($data->nm_stat_mhs));
					$nomor++;
					$nocel++;
				}
				/* end - BLOCK MEMASUKAN DATABASE*/

				/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
				header ( 'Content-Type: application/vnd.ms-excel' );
  //namanya adalah keluarga.xls
				header ( 'Content-Disposition: attachment;filename="rekap_data.xls"' ); 
				header ( 'Cache-Control: max-age=0' );
				$writer = PHPExcel_IOFactory::createWriter ( $file, 'Excel5' );
				$writer->save ( 'php://output' );
				/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
                // pagging setting
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function create(){
		$post = $this->input->post();
		$data = array(
			'nama_bukutamu' => $post['nama_bukutamu'],
			'email_bukutamu' => $post['email_bukutamu'],
			'isi_bukutamu' => $post['isi_bukutamu']
		);
		$this->Wisuda_m->Insert_bukutamu($data);
		$pesan = 'bukutamu '.$post['nama_bukutamu'].' Berhasil dibuat';
		$this->session->set_flashdata('message', $pesan );
		redirect(base_url());
	}
	public function delete($id){
		if(!$this->ion_auth->logged_in()){
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}else{
			$this->Wisuda_m->delete_bukutamu($id);
			$this->session->set_flashdata('message', 'bukutamu berhasil di hapus');
			redirect(base_url('index.php/admin/bukutamu'));
		}
	}
	// update data
	function up_data_mhs_pt(){
		if ($this->ion_auth->logged_in()){
			$level = 'admin';  
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard_c'));
			}else{
				$mhs_pt = $this->Rekap_m->all_mhs_pt();
				foreach ($mhs_pt as $data) {
					$update =array(
						'kode_sms' => trim($this->Rekap_m->detail_prodi($data->id_sms)->kode_prodi),
					);
					$this->Rekap_m->update_mhs_pt($data->id,$update);
				}
				echo "data berhasil di ubah";
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	function up_data_mhs(){
		if ($this->ion_auth->logged_in()){
			$level = 'admin';  
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard_c'));
			}else{
				$mhs_pt = $this->Rekap_m->all_data('mahasiswa');
				foreach ($mhs_pt as $data) {
					$update =array(
						'nipd' => trim($this->Rekap_m->det_mhs_pt($data->id_pd)->nipd)
					);
					$this->Rekap_m->update_data($data->id,$update,'mahasiswa');
				}
				echo "data berhasil di ubah";
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	function up_data_kuliah_mhs(){
		if ($this->ion_auth->logged_in()){
			$level = 'admin';  
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard_c'));
			}else{
				$mhs_pt = $this->Rekap_m->all_data('mahasiswa');
				foreach ($mhs_pt as $data) {
					$update =array(
						'nipd' => trim($this->Rekap_m->det_mhs_pt($data->id_pd)->nipd)
					);
					$this->Rekap_m->update_data($data->id,$update,'mahasiswa');
				}
				echo "data berhasil di ubah";
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
}
