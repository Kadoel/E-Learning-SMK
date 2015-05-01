<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Logout extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->session->sess_destroy();
		redirect(site_url('admin'));
	}

}
