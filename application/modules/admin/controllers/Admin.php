<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Admin extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('dateindo'));
		$this->load->model(array('m_materi'));
		
		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$semester = $this->session->userdata('semester');
		$thnajaran = $this->session->userdata('tahunajaran');
		$pengajar = $this->session->userdata('user_id');
		$data['semuaMateri'] = $this->m_materi->ambil_semua_materi($semester, $thnajaran)->num_rows();
		$data['materiAnda'] = $this->m_materi->ambil_materi_pengajar($semester, $thnajaran, $pengajar)->num_rows();
		$this->load->view('admin', $data);
	}
	
}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */
