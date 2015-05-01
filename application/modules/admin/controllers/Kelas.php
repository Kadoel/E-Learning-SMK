<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Kelas extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_kelas', 'm_jurusan'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		$this->dataglobal = array(
				'listJurusan'=> $this->m_jurusan->ambil_jurusan()->result(),
				'listKelas' => $this->m_kelas->ambil_kelas()->result(),
				'datatable' => $this->my_handle->datatable("tabel-kelas", "5"),
				'validasi' => $this->my_handle->validasi("form-kelas"),
				'kirim' => $this->my_handle->kirimdata('btn-kelas', 'form-kelas', 'warning'),
				'hapusdata' => $this->my_handle->hapusdata("hapus-kelas")
		);
		
		if($this->session->userdata('group_user') != '1'){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['id_kelas'] = "";
		$data['nama_kelas'] = "";
		$data['jurusan_kelas'] = "";
		$data['no_kelas'] = "";
		$this->load->view('kelas', $data);
	}
	
	public function edit($id){
		$cekKelas = $this->m_kelas->ambil_kelas_id($id);
		if($cekKelas->num_rows() >= 1){
			$data = $this->dataglobal;
			$data['id_kelas'] = $cekKelas->row()->kelas_id;
			$data['nama_kelas'] = $cekKelas->row()->kelas_nama;
			$data['jurusan_kelas'] = $cekKelas->row()->kelas_jurusan;
			$data['no_kelas'] = $cekKelas->row()->kelas_no;
			$this->load->view('admin/kelas', $data);
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
	
	public function act_kelas(){
		$this->form_validation->set_rules('kelas_nama', 'Tingkat Kelas', 'htmlspecialchars|trim|required|xss_clean');
		$this->form_validation->set_rules('kelas_jurusan', 'Jurusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kelas_no', 'No', 'trim|integer|xss_clean');
		if($this->form_validation->run() == FALSE){
			echo $this->err;
		}
		else{
			$kelas = $this->input->post('kelas_nama', 'TRUE');
			$jurusan = $this->input->post('kelas_jurusan');
			$nokelas = $this->input->post('kelas_no', 'TRUE');
			if($this->m_kelas->cek_kelas($kelas, $jurusan, $nokelas)->num_rows() >= 1){
				echo $this->my_notifikasi->kesalahan("Kelas Sudah Terdapat Di Database");
			}
			else{
				$id = $this->input->post('kelas_id');
				$data['kelas_nama'] = $kelas;
				$data['kelas_jurusan'] = $jurusan;
				$data['kelas_no'] = $nokelas;
				if($id==''){
					$simpan = $this->m_kelas->tambah_kelas($data);
					if($simpan){
						$this->my_notifikasi->suksesreload("Kelas", "Kelas Berhasil Disimpan");
					}
					else{
						$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Kelas");
					}
				}
				else{
					$update = $this->m_kelas->update_kelas($id, $data);
					if($update){
						$this->my_notifikasi->sukses("Kelas", "Kelas Berhasil Diubah", "admin/kelas");
					}
					else{
						$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Kelas");
					}
				}
			}
		}
	}
	
	public function hapus($id){
		if($this->m_kelas->ambil_kelas_id($id)->num_rows()>=1){
			$this->m_kelas->hapus_kelas($id);
			redirect(site_url('admin/kelas'));
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
}

/* End of file Kelas.php */
/* Location: ./application/modules/admin/controllers/Kelas.php */
