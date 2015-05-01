<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
class Materi extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi', 'upload'));
		$this->load->helper(array('form', 'dateindo'));
		$this->load->model(array('m_materi', 'm_kelas', 'm_pelajaran'));
		
		$this->err = $this->my_notifikasi->kesalahan("Hayooo... Mau Ngapain :p");
		$this->dataglobal = array(
			'list_materi' => $this->m_materi->ambil_materi_pengajar($this->session->userdata('semester'), $this->session->userdata('tahunajaran'), $this->session->userdata('user_id'))->result(),
			'list_kelas' => $this->m_kelas->ambil_kelas()->result(),
			'list_pelajaran' => $this->m_pelajaran->ambil_pelajaran()->result(),
			'validasi' => $this->my_handle->validasi("form-materi"),
			'datatable' => $this->my_handle->datatable("tabel-materi", '5'),
			'hapusdata' => $this->my_handle->hapusdata("hapus-materi")
		);
		
		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['id_materi'] = "";
		$data['nama_materi'] = "";
		$data['deskripsi_materi'] = "";
		$data['file_materi'] = " ";
		$data['kelas_materi'] = "";
		$data['pelajaran_materi'] = "";
		$this->load->view('materi', $data);
	}
	
	public function edit($id){
		if($this->m_materi->ambil_materi_id($id)->num_rows() >=1){
			$dataMateri = $this->m_materi->ambil_materi_id($id)->row();
			if($dataMateri->materi_pengajar == $this->session->userdata('user_id')){
				$data = $this->dataglobal;
				$data['id_materi'] = $dataMateri->materi_id;
				$data['nama_materi'] = $dataMateri->materi_nama;
				$data['deskripsi_materi'] = $dataMateri->materi_deskripsi;
				$data['file_materi'] = " disabled ";
				$data['kelas_materi'] = $dataMateri->materi_kelas;
				$data['pelajaran_materi'] = $dataMateri->materi_pelajaran;
				$this->load->view('materi', $data);
			}
			else{
				$this->load->view('include/halamantidakditemukan');
			}
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
	
	public function act_materi(){
		$this->form_validation->set_rules('materi_nama', 'Nama Materi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('materi_deskripsi', 'Deskripsi Materi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('materi_kelas', 'Kelas', 'trim|required|xss_clean');
		$this->form_validation->set_rules('materi_pelajaran', 'Mat. Pelajaran', 'trim|required|xss_clean');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			$id = $this->input->post('materi_id', 'TRUE');
			$data['materi_nama'] = $this->input->post('materi_nama', 'TRUE');
			$data['materi_deskripsi'] = $this->input->post('materi_deskripsi', 'TRUE');
			$data['materi_kelas'] = $this->input->post('materi_kelas', 'TRUE');
			$data['materi_pelajaran'] = $this->input->post('materi_pelajaran', 'TRUE');
			if($id==''){
				$nmfile = "Materi_".date('dmYHis'); //nama file saya beri nama langsung dan diikuti fungsi time
				$config['upload_path'] = './assets/uploads/'; //path folder
				$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf'; //type yang dapat diakses bisa anda sesuaikan
				$config['max_size'] = '5090'; //maksimum besar file 5M
				$config['file_ext_tolower'] = TRUE;
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = $nmfile; //nama yang terupload nantinya
				
				$this->upload->initialize($config);
				if($this->upload->do_upload('materi_file')){
					$materi = $this->upload->data();
					$data['materi_file'] = $materi['file_name'];
					$data['materi_semester'] = $this->session->userdata('semester');
					$data['materi_thnajaran'] = $this->session->userdata('tahunajaran');
					$data['materi_pengajar'] =  $this->session->userdata('user_id');
					$data['materi_tanggal'] = dateindo(date('Y-m-d'));
					
					$tambah = $this->m_materi->tambah_materi($data);
					if($tambah){
						redirect(site_url('admin/materi'));
					}
					else{
						$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pengajar");
					}
				}
				else{
					$error = array('error' => $this->my_notifikasi->kesalahan($this->upload->display_errors()));

                    $this->load->view('upload_error', $error);
				}

			}
			else{
				$edit = $this->m_materi->update_materi($id, $data);
				if($edit){
					redirect(site_url('admin/materi'));
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pengajar");
				}
			}
		}
		
	}
	
	public function hapus($id){
		if($this->m_materi->ambil_materi_id($id)->num_rows() >=1){
			$dataHapus = $this->m_materi->ambil_materi_id($id)->row();
			if($dataHapus->materi_pengajar == $this->session->userdata('user_id')){
				unlink("./assets/uploads/".$dataHapus->materi_file);
				$this->m_materi->hapus_materi($id);
				redirect(site_url('admin/materi'));
			}
			else{
				$this->load->view('include/halamantidakditemukan');
			}
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
}

/* End of file Materi.php */
/* Location: ./application/modules/admin/controllers/Materi.php */
