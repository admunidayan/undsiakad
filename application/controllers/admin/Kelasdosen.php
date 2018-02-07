<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelasdosen extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->library('Nusoap_lib');
    $this->load->library('Excel');
    $this->load->library('Resize');
    $this->load->model('admin/Dosen_m');
  }
  
}
?>