<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Pengaturan extends CI_Controller{
	public $err;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_setting'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		
		if($this->session->userdata('group_user') != '1'){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$ambilpengaturan = $this->m_setting->ambil_setting('1')->row();
		$data['smester'] = $ambilpengaturan->setting_semester;
		$data['thnajaran'] = $ambilpengaturan->setting_thnajaran;
		$data['kirim'] = $this->my_handle->kirimdata('btn-pengaturan', 'form-pengaturan', 'warning');
		$this->load->view('pengaturan', $data);
	}
	
	public function act_pengaturan(){
		$this->form_validation->set_rules('semester', 'Semester', 'trim|required|xss_clean');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			$data['setting_semester'] = $this->input->post('semester', 'TRUE');
			$data['setting_thnajaran'] = $this->input->post('thnajaran', 'TRUE');
			$ubah = $this->m_setting->update_setting('1', $data);
			if($ubah){
				$this->my_notifikasi->suksesreload("Pengaturan", "Pengaturan Berhasil Disimpan");
			}
			else{
				$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Setting");
			}
		}
	}
	
}

/* End of file Pengaturan.php */
/* Location: ./application/modules/admin/controllers/Pengaturan.php */
