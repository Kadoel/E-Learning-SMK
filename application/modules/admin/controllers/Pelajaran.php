<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

class Pelajaran extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form'));
		$this->load->model(array('m_pelajaran'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		$this->dataglobal = array(
				'listPelajaran'=> $this->m_pelajaran->ambil_pelajaran()->result(),
				'datatable' => $this->my_handle->datatable("tabel-pelajaran", "5"),
				'validasi' => $this->my_handle->validasi("form-pelajaran"),
				'kirim' => $this->my_handle->kirimdata('btn-pelajaran', 'form-pelajaran', 'warning'),
				'hapusdata' => $this->my_handle->hapusdata("hapus-pelajaran")
		);
		
		if($this->session->userdata('group_user') != '1'){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['id_pelajaran'] = "";
		$data['nama_pelajaran'] = "";
		$this->load->view('admin/pelajaran', $data);
	}
	
	public function edit($id){
		$cekPelajaran = $this->m_pelajaran->ambil_pelajaran_id($id);
		if($cekPelajaran->num_rows() >= 1){
			$data = $this->dataglobal;
			$data['id_pelajaran'] = $cekPelajaran->row()->pelajaran_id;
			$data['nama_pelajaran'] = $cekPelajaran->row()->pelajaran_nama;
			$this->load->view('admin/pelajaran', $data);
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
	
	public function act_pelajaran(){
		$this->form_validation->set_rules('pelajaran_nama', 'Nama Mat. Pelajaran', 'htmlspecialchars|trim|required|xss_clean|callback_cek_pelajaran');
		if($this->form_validation->run()==FALSE){
			echo $this->err;
		}
		else{
			$id = $this->input->post('pelajaran_id', 'TRUE');
			$data['pelajaran_nama'] = $this->input->post('pelajaran_nama', 'TRUE');
			if($id==''){
				$simpan = $this->m_pelajaran->tambah_pelajaran($data);
				if($simpan){
					$this->my_notifikasi->suksesreload("Pelajaran", "Pelajaran Berhasil Disimpan");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pelajaran");
				}
			}
			else{
				$ubah = $this->m_pelajaran->update_pelajaran($id, $data);
				if($ubah){
					$this->my_notifikasi->sukses("Pelajaran", "Pelajaran Berhasil Diubah", "admin/pelajaran");
				}
				else{
					$this->err = $this->my_notifikasi->kesalahan("Gagal Menyimpan Pelajaran");
				}
			}
		}
	}
	
	public function cek_pelajaran($pelajaran){
		$hasil = $this->m_pelajaran->cek_nama_pelajaran($pelajaran);
		if($hasil->num_rows()>=1){
			$this->err = $this->my_notifikasi->kesalahan("Pelajaran ".$pelajaran." Sudah Terdapat Di Database");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public function hapus($id){
		if($this->m_pelajaran->ambil_pelajaran_id($id)->num_rows() >=1){
			$this->m_pelajaran->hapus_pelajaran($id);
			redirect(site_url('admin/pelajaran'));
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
}

/* End of file Pelajaran.php */
/* Location: ./application/modules/admin/controllers/Pelajaran.php */
