<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagenotfound extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
 
    public function index() {
        $this->load->view('include/halamantidakditemukan');//loading view
    }
}
?> 
