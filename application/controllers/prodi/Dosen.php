<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('fakultas/Fakultas_m');
        $this->load->library('Excel');
        $this->load->model('prodi/Prodi_m');
        $this->load->model('prodi/Dosen_m');
    }
    function index()
    {
        redirect(base_url('index.php/prodi/dosen/dosenprodi'));
    }
    public function dosenprodi($id,$offset=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','prodi',$id);
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->get();
                $data['title'] = 'Daftar Dosen Berdasarkan Prodi';
                $data['page'] = 'prodi/data-dosen-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // pagging setting
                $data['contoh'] =$this->Dosen_m->jumlah_dosen($id,@$post['dosen'],@$post['tahun']);
                $jumlah = $this->Dosen_m->jumlah_dosen($id,@$post['dosen'],@$post['tahun']);
                $config['base_url'] = base_url().'index.php/prodi/dosen/dosenprodi/'.$id;
                $config['total_rows'] = $jumlah;
                $config['per_page'] = '20';
                $config['first_page'] = 'Awal';
                $config['last_page'] = 'Akhir';
                $config['next_page'] = '&laquo;';
                $config['prev_page'] = '&raquo;';
                // bootstap style
                $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative;'>";
                $config['full_tag_close'] ="</ul>";
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
                $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
                $config['next_tag_open'] = "<li>";
                $config['next_tagl_close'] = "</li>";
                $config['prev_tag_open'] = "<li>";
                $config['prev_tagl_close'] = "</li>";
                $config['first_tag_open'] = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open'] = "<li>";
                $config['last_tagl_close'] = "</li>";
                //inisialisasi config
                $this->pagination->initialize($config);
                // pengaturan searching
                $prodi_id = $this->Dosen_m->id_prodi($id)->id_prodi;
                $data['nomor'] = $offset;
                $data['getprod'] = $this->Prodi_m->detail_prodi($prodi_id)->row();
                $data['dtdosen'] = $this->Dosen_m->searcing_dosen($config['per_page'],$offset,$id,@$post['dosen'],@$post['tahun']);
                $data['pagging'] = $this->pagination->create_links();
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    function tampildosenpt($id){
        $data['dtdosen'] = $this->Dosen_m->dosen_by_pord($id);
        $this->load->view('prodi/ajax-dosen-prodi-v', $data);
    }
    function exportexldosen(){
        if ($this->ion_auth->logged_in()){
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $post = $this->input->post('');
                $data['title'] = 'Eksport Excel dosen';
                $data['page'] = 'admin/import/prodi/import-prodi-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $file = new PHPExcel ();
                $file->getProperties ()->setCreator ( "Goblooge" );
                $file->getProperties ()->setLastModifiedBy ( "www.unidayan.ac.id" );
                $file->getProperties ()->setTitle ( "Dosen" );
                $file->getProperties ()->setSubject ( "Daftar Dosen" );
                $file->getProperties ()->setDescription ( "Daftar Dosen Unidayan" );
                $file->getProperties ()->setKeywords ( "Daftar Dosen" );
                $file->getProperties ()->setCategory ( "Dosen" );
                /*end - BLOCK PROPERTIES FILE EXCEL*/

                /*start - BLOCK SETUP SHEET*/
                $file->createSheet ( NULL,0);
                $file->setActiveSheetIndex ( 0 );
                $sheet = $file->getActiveSheet ( 0 );
  //memberikan title pada sheet
                $sheet->setTitle ( "Daftar Dosen" );
                /*end - BLOCK SETUP SHEET*/

                /*start - BLOCK HEADER*/
                $sheet->setCellValue ( "A1", "No" );
                $sheet->setCellValue ( "B1", "NIDN" );
                $sheet->setCellValue ( "C1", "NAMA" );
                $sheet->setCellValue ( "D1", "EMAIL" );
                $sheet->setCellValue ( "E1", "USERNAME" );
                $sheet->setCellValue ( "F1", "PASSWORD" );
                /*end - BLOCK HEADER*/

                /* start - BLOCK MEMASUKAN DATABASE*/
                $nomor = 1;
                $hasil = $this->Dosen_m->dosen_export_xecel();
                // echo "<pre>";print_r($hasil);echo "</pre>";exit();
                foreach ($hasil as $data) {
                  $sheet->setCellValue ( "A".$nomor, $nomor );
                  $sheet->setCellValue ( "B".$nomor, $data->nidn );
                  $sheet->setCellValue ( "C".$nomor, $data->nm_sdm );
                  $sheet->setCellValue ( "D".$nomor, str_replace(' ', '',strtolower($data->nm_sdm.'@unidayan.ac.id')) );
                  $sheet->setCellValue ( "E".$nomor, $data->nidn );
                  $sheet->setCellValue ( "F".$nomor, $data->nidn );
                  $nomor++;
                }
                /* end - BLOCK MEMASUKAN DATABASE*/

                /* start - BLOCK MEMBUAT LINK DOWNLOAD*/
                header ( 'Content-Type: application/vnd.ms-excel' );
  //namanya adalah keluarga.xls
                header ( 'Content-Disposition: attachment;filename="daftar_dosen.xls"' ); 
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
}
?>