<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_db extends CI_Migration {
	function __construct()
	{
		parent::__construct();
		$this->load->library('Nusoap_lib');
        $this->load->library('Init_lib');
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
	            if ($datadb['error_code']=='0') {
	            	foreach ($datadb['result'] as $dtdb) {
	                	// Drop table 'groups' if it exists
	                	$dbname = $dtdb['table'];
		                $this->dbforge->drop_table($dbname, TRUE);
		                // buat id primer colom
		     			$iddbname = 'id';
		                $this->dbforge->add_field(array(
		                	$iddbname => array(
		                		'type' => 'INT',
		                		'constraint' => '11',
		                		'unsigned' => TRUE,
		                		'auto_increment' => TRUE
		                	)
		                ));
						// Table structure for table 'groups'
						$diktio = $proxy->getDictionary($token,$dtdb['table']);
						foreach ($diktio['result'] as $data) {
							if ($data == TRUE) {
								$this->dbforge->add_field(array(
									$data['column_name'] => array(
										'type' => 'VARCHAR',
										'constraint' => '114',
										'null' => TRUE,
										'description' => $data['desc']
									)
								));
							}
						}
		                $this->dbforge->add_key($iddbname, TRUE);
		                $this->dbforge->create_table($dbname);
	                }
	            }
                // load
                echo "database berhasil di buat - lanjut ke pengisian data";
                // pengisian data
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}