<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$this->load->view('admin');
	}
	
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */
