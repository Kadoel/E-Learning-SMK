<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Profil extends CI_Controller{
	public $err;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_pengajar'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$id = $this->session->userdata('user_id');
		$dataPengajar = $this->m_pengajar->ambil_pengajar_id($id)->row();
		$data['validasi'] = $this->my_handle->validasi("form-profil");
		$data['kirim'] = $this->my_handle->kirimdata('btn-profil', 'form-profil', 'warning');
		$data['id_profil'] = $dataPengajar->pengajar_id;
		$data['nama_profil'] = $dataPengajar->pengajar_nama;
		$data['nip_profil'] = $dataPengajar->pengajar_nip;
		$data['username_profil'] = $dataPengajar->pengajar_username;
		$data['password_profil'] = $dataPengajar->pengajar_password;
		$data['alamat_profil'] = $dataPengajar->pengajar_alamat;
		
		$this->load->view('profil', $data);
	}
	
	public function act_profil(){
		if($this->input->post('profil_nama') == $this->session->userdata('user_nama')){
			$this->form_validation->set_rules('profil_nama', 'Nama Profil', 'trim|required|xss_clean');
		}
		else{
			$this->form_validation->set_rules('profil_nama', 'Nama Profil', 'trim|required|xss_clean|callback_cek_nama');
		}
		if($this->input->post('profil_username') == $this->session->userdata('user_login')){
			$this->form_validation->set_rules('profil_username', 'Username', 'trim|required|xss_clean');
		}
		else{
			$this->form_validation->set_rules('profil_username', 'Username', 'trim|required|xss_clean|callback_cek_username');
		}
		$this->form_validation->set_rules('profil_nip', 'No. Induk Pegawai', 'trim|xss_clean');
		$this->form_validation->set_rules('profil_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('profil_alamat', 'Alamat', 'trim|required|xss_clean');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			if($this->input->post('profil_password') == $this->input->post('profil_password_asli')){
				$data['pengajar_password'] = $this->input->post('profil_password', 'TRUE');
			}
			else{
				$data['pengajar_password'] = md5($this->input->post('profil_password', 'TRUE'));
			}
			$id = $this->session->userdata('user_id');
			$data['pengajar_nama'] = $this->input->post('profil_nama', 'TRUE');
			$data['pengajar_nip'] = $this->input->post('profil_nip', 'TRUE');
			$data['pengajar_username'] = $this->input->post('profil_username', 'TRUE');
			$data['pengajar_alamat'] = $this->input->post('profil_alamat', 'TRUE');
			
			$ubah = $this->m_pengajar->update_pengajar($id, $data);
			if($ubah){
				$this->my_notifikasi->sukses("Profil", "Profil Berhasil Diubah, Silahkan Login Ulang!", "logout");
			}
			else{
				$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pengajar");
			}
		}
	}
	
	public function cek_nama($nama){ //Cek Nama Jurusan Di Database
		$hasil = $this->m_pengajar->cek_nama_pengajar($nama);
		if($hasil->num_rows()>=1){
			$this->err = $this->my_notifikasi->kesalahan("Nama ".$nama." Sudah Terdapat Di Database");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public function cek_username($username){ //Cek Nama Jurusan Di Database
		$hasil = $this->m_pengajar->cek_username_pengajar($username);
		if($hasil->num_rows()>=1){
			$this->err = $this->my_notifikasi->kesalahan("Username ".$username." Sudah Terdapat Di Database");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}

/* End of file Profil.php */
/* Location: ./application/modules/admin/controllers/Profil.php */
