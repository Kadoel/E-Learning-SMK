<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_pengajar'));
		
		if($this->session->userdata('logged_in')){
			redirect(site_url('admin'));
		}
	}
	
	public function index(){
			$data['validasi'] = $this->my_handle->validasi('form-login');
			$this->load->view('login', $data);
	}
	
	public function act_login(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		$this->form_validation->set_message('required', 'Kolom Tidak Boleh Kosong');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('notification', 'Periksa Inputan Anda');
			redirect(site_url('login'));
		}
		else{
			$username = $this->input->post('username', 'TRUE');
			$password = md5($this->input->post('password', 'TRUE'));
			$cek_user = $this->m_pengajar->cek_login($username, $password)->row();
			$numb_count = count($cek_user);
			if($numb_count > 0){
				//Setting Session
				$array_session = array(
					'user_id' => $cek_user->pengajar_id,
					'user_nama' => $cek_user->pengajar_nama,
					'user_login' => $cek_user->pengajar_username,
					'group_user' => $cek_user->pengajar_group, 
					'logged_in' => TRUE
					);
				$this->session->set_userdata($array_session);
				redirect(site_url('login'));
			}
			else{
				$this->session->set_flashdata('notification', 'Username Atau Password Salah');
				redirect(site_url('login'));
			}
		}
		
	}
}

/* End of file Login.php */
/* Location: ./application/modules/login/controllers/Login.php */
