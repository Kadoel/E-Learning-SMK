<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Jurusan extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_jurusan'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		$this->dataglobal = array(
				'listJurusan'=> $this->m_jurusan->ambil_jurusan()->result(),
				'datatable' => $this->my_handle->datatable("tabel-jurusan", "5"),
				'validasi' => $this->my_handle->validasi("form-jurusan"),
				'kirim' => $this->my_handle->kirimdata('btn-jurusan', 'form-jurusan', 'warning'),
				'hapusdata' => $this->my_handle->hapusdata("hapus-jurusan")
		);
		
		if($this->session->userdata('group_user') != '1'){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['idJurusan'] = "";
		$data['namaJurusan'] = "";
			
		$this->load->view('jurusan', $data);
		
	}
	
	public function edit($id){
		$cekDataJurusan = $this->m_jurusan->ambil_jurusan_id($id);
		if($cekDataJurusan->num_rows() >=1){
			$datajurusan = $cekDataJurusan->row();
			$data = $this->dataglobal;
			$data['idJurusan'] = $datajurusan->jurusan_id;
			$data['namaJurusan'] = $datajurusan->jurusan_nama;
			
			$this->load->view('jurusan', $data);
		}
		else{
			redirect(site_url('admin/jurusan'));
		}
	}
	
	public function act_jurusan(){
		$this->form_validation->set_rules('jurusan_nama', 'Nama Jurusan', 'trim|required|xss_clean|callback_cek_jurusan');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			$id = $this->input->post('jurusan_id', 'TRUE');
			$data['jurusan_nama'] = $this->input->post('jurusan_nama', 'TRUE');
			if($id==''){
				$simpan = $this->m_jurusan->tambah_jurusan($data);
				if($simpan){
					$this->my_notifikasi->suksesreload("Jurusan", "Jurusan Berhasil Disimpan");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Jurusan");
				}
			}
			else{
				$ubah = $this->m_jurusan->update_jurusan($id, $data);
				if($ubah){
					$this->my_notifikasi->sukses("Jurusan", "Jurusan Berhasil Diubah", "admin/jurusan");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Jurusan");
				}
			}
		}
	}
	
	public function cek_jurusan($jurusan){ //Cek Nama Jurusan Di Database
		$hasil = $this->m_jurusan->cek_nama_jurusan($jurusan);
		if($hasil->num_rows()>=1){
			$this->err = $this->my_notifikasi->kesalahan("Jurusan ".$jurusan." Sudah Terdapat Di Database");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public function hapus($id){ //Hapus Tag
			$this->m_jurusan->hapus_jurusan($id);
			redirect(site_url('admin/jurusan'));
	}
}

/* End of file Jurusan.php */
/* Location: ./application/modules/admin/controllers/Jurusan.php */
