<?php
class Install_db extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
		$this->load->library('Excel');
		$this->load->library('Resize');
		$this->load->model('admin/Import_m');
	}

	public function index ()
	{
		$this->load->library('migration');
		if (! $this->migration->current()) {
			show_error($this->migration->error_string());
		}
		else {
			echo 'Migration worked!';
		}
	}
	public function up(){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Rincian Table Database Feeder';
                $data['page'] = 'admin/import/list-table-feeder-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);

                $datadb = $proxy->ListTable($token);
                		// echo "<pre>";print_r($datadb);echo "<pre/>";exit();
                if ($datadb['error_code']=='0') {
                	foreach ($datadb['result'] as $dtdb) {
	            			// echo "<pre>";print_r($dtdb);echo "<pre/>";exit();
	                	// Drop table 'groups' if it exists
	            			// $this->dbforge->drop_table('tbl_'.$dtdb['table'], TRUE);
                		$this->dbforge->create_table('percobaan');
		                // buat id primer colom
                		$dbfiled = array(
                			'id_'.$datadb['table'] => array(
                				'type' => 'INT',
                				'constraint' => '11',
                				'unsigned' => TRUE,
                				'auto_increment' => TRUE
                			),
                		);
                		$this->dbforge->add_field($dbfiled);
	            			// $this->dbforge->add_field(array(
	            			// 	'id_'.$datadb['table'] => array(
	            			// 		'type' => 'INT',
	            			// 		'constraint' => '11',
	            			// 		'unsigned' => TRUE,
	            			// 		'auto_increment' => TRUE
	            			// 	)
	            			// ));
						// Table structure for table 'groups'
	            			// $diktio = $proxy->getDictionary($token,$dtdb['table']);
	            			// foreach ($diktio['result'] as $data) {
	            			// 	if ($data == TRUE) {
	            			// 		$this->dbforge->add_field(array(
	            			// 			$data['column_name'] => array(
	            			// 				'type' => 'VARCHAR',
	            			// 				'constraint' => '114',
	            			// 				'description' => $data['desc']
	            			// 			)
	            			// 		));
	            			// 	}
	            			// }
                		$this->dbforge->add_key('id_'.$datadb['table'], TRUE);
	            			// $this->dbforge->create_table('tbl_'.$dtdb['table']);
                	}
                }
                // load
                echo "db berhasil do buat";
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function testing(){
        if ($this->ion_auth->logged_in()) {
            $level = 'admin';  
            if (!$this->ion_auth->in_group($level)) {
             $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
             $this->session->set_flashdata('message', $pesan );
             redirect(base_url('index.php/admin/dashboard_c'));
            }else{
                $data['title'] = 'Rincian Table Database Feeder';
                $data['page'] = 'admin/import/list-table-feeder-v';
                $data['nav'] = 'nav/nav-admin';
                $data['dtadm'] = $this->ion_auth->user()->row();
                // setting web server
                $hostname = $this->ion_auth->user()->row()->hostname;
                $port = $this->ion_auth->user()->row()->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$this->ion_auth->user()->row()->userfeeder;
                $pass = $this->ion_auth->user()->row()->passfeeder;
                $token = $proxy->getToken($username, $pass);

                $datadb = $proxy->ListTable($token);
                // echo "<pre>";print_r($datadb);echo "<pre/>";exit();
                if ($datadb['error_code']== '0') {
                	$this->dbforge->create_table('testes');
                }
                // load
                echo "db berhasil do buat";
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>