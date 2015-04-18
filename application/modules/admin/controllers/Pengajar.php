<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
class pengajar extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_pengajar'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		
		$this->dataglobal = array(
				'list_pengajar' => $this->m_pengajar->ambil_pengajar()->result(),
				'datatable' => $this->my_handle->datatable("tabel-pengajar", '5'),
				'validasi' => $this->my_handle->validasi("form-pengajar"),
				'kirim' => $this->my_handle->kirimdata('btn-pengajar', 'form-pengajar', 'warning'),
				'hapusdata' => $this->my_handle->hapusdata("hapus-pengajar")
		);
		
		if($this->session->userdata('group_user') != '1'){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['id_pengajar'] = "";
		$data['nama_pengajar'] = "";
		$data['nip_pengajar'] = "";
		$data['username_pengajar'] = "";
		$data['password_pengajar'] = "";
		$data['alamat_pengajar'] = "";
		$data['group_pengajar'] = "";
		$this->load->view('pengajar', $data);
	}
	
	public function edit($id){
		if($this->m_pengajar->ambil_pengajar_id($id)->num_rows() >= 1){
			$dataPengajar = $this->m_pengajar->ambil_pengajar_id($id)->row();
			$data = $this->dataglobal;
			$data['id_pengajar'] = $dataPengajar->pengajar_id;
			$data['nama_pengajar'] = $dataPengajar->pengajar_nama;
			$data['nip_pengajar'] = $dataPengajar->pengajar_nip;
			$data['username_pengajar'] = $dataPengajar->pengajar_username;
			$data['password_pengajar'] = $dataPengajar->pengajar_password;
			$data['alamat_pengajar'] = $dataPengajar->pengajar_alamat;
			$data['group_pengajar'] = $dataPengajar->pengajar_group;;
			$this->load->view('pengajar', $data);
		}
		else{
			redirect(site_url('admin/pengajar'));
		}
	}
	
	public function act_pengajar(){
		if($this->input->post('pengajar_nama') == $this->input->post('pengajar_nama_asli')){
			$this->form_validation->set_rules('pengajar_nama', 'Nama Pengajar', 'trim|required|xss_clean');
		}
		else{
			$this->form_validation->set_rules('pengajar_nama', 'Nama Pengajar', 'trim|required|xss_clean|callback_cek_nama');
		}
		if($this->input->post('pengajar_username') == $this->input->post('pengajar_username_asli')){
			$this->form_validation->set_rules('pengajar_username', 'Username', 'trim|required|xss_clean');
		}
		else{
			$this->form_validation->set_rules('pengajar_username', 'Username', 'trim|required|xss_clean|callback_cek_username');
		}
		$this->form_validation->set_rules('pengajar_nip', 'No. Induk Pegawai', 'trim|xss_clean');
		$this->form_validation->set_rules('pengajar_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pengajar_alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pengajar_group', 'Group', 'trim|required|xss_clean');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			$id = $this->input->post('pengajar_id', 'TRUE');
			$data['pengajar_nama'] = $this->input->post('pengajar_nama', 'TRUE');
			$data['pengajar_nip'] = $this->input->post('pengajar_nip', 'TRUE');
			$data['pengajar_username'] = $this->input->post('pengajar_username', 'TRUE');
			$data['pengajar_alamat'] = $this->input->post('pengajar_alamat', 'TRUE');
			$data['pengajar_group'] = $this->input->post('pengajar_group', 'TRUE');
			if($this->input->post('pengajar_password') == $this->input->post('pengajar_password_asli')){
				$data['pengajar_password'] = $this->input->post('pengajar_password', 'TRUE');
			}
			else{
				$data['pengajar_password'] = md5($this->input->post('pengajar_password', 'TRUE'));
			}
			if($id==''){
				$tambah = $this->m_pengajar->tambah_pengajar($data);
				if($tambah){
					$this->my_notifikasi->suksesreload("Pengajar", "Pengajar Berhasil Disimpan");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pengajar");
				}
			}
			else{
				$ubah = $this->m_pengajar->update_pengajar($id, $data);
				if($ubah){
					$this->my_notifikasi->sukses("Pengajar", "Pengajar Berhasil Diubah", "admin/pengajar");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pengajar");
				}
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
	
	public function hapus($id){
		$this->m_pengajar->hapus_pengajar($id);
		redirect(site_url('admin/pengajar'));
	}
}

/* End of file Pengajar.php */
/* Location: ./application/modules/admin/controllers/Pengajar.php */
