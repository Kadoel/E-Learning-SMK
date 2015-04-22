<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
class Semua_materi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('MY_Handle'));
		$this->load->model(array('m_materi'));

		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$semester = $this->session->userdata('semester');
		$thnajaran = $this->session->userdata('tahunajaran');
		$pengajar = $this->session->userdata('user_id');
		$data['semuaMateri'] = $this->m_materi->ambil_semua_materi($semester, $thnajaran)->result();
		$data['dataTable'] = $this->my_handle->datatable("tabel-semua-materi", '10');
		$this->load->view('semua_materi', $data);
	}
}

/* End of file Semua_materi.php */
/* Location: ./application/modules/admin/controllers/Semua_materi.php */
