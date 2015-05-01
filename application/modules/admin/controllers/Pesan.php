<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
class Pesan extends CI_Controller{
	public $err, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation', 'MY_Handle', 'MY_Notifikasi'));
		$this->load->helper(array('form', 'dateindo'));
		$this->load->model(array('m_pesan', 'm_pengajar'));
		
		$this->err = $this->my_notifikasi->kesalahan("Periksa Kolom Dengan Benar");
		$this->dataglobal = array(
				'pesanMasuk'=> $this->m_pesan->ambil_pesan_masuk($this->session->userdata('user_id'))->result(),
				'pesanTerkirim'=> $this->m_pesan->ambil_pesan_terkirim($this->session->userdata('user_id'))->result(),
				'listPengajar' => $this->m_pengajar->ambil_pengajar()->result(),
				'kirimdata' => $this->my_handle->kirimdata('btn-pesan', 'form-tulis-pesan', 'warning'),
				'validasi' => $this->my_handle->validasi("form-tulis-pesan"),
				'datatableMasuk' => $this->my_handle->datatable("tabel-pesan-masuk", "10"),
				'datatableKirim' => $this->my_handle->datatable("tabel-pesan-kirim", "10"),
				'hapusdataMasuk' => $this->my_handle->hapusdata("hapus-pesan-masuk"),
				'hapusdataKirim' => $this->my_handle->hapusdata("hapus-pesan-kirim")
		);
		
		if(!$this->session->userdata('logged_in')){
			redirect(site_url('login'));
		}
	}
	
	public function index(){
		$data = $this->dataglobal;
		$this->load->view('admin/pesan', $data);
	}
	
	public function baca($id){
		$cekPesan = $this->m_pesan->baca_pesan($id, $this->session->userdata('user_id'));
		if($cekPesan->num_rows() >= 1){
			if($cekPesan->row()->pesan_status == "0" && $cekPesan->row()->pesan_untuk == $this->session->userdata('user_id')){
				$this->m_pesan->ubah_status_baca($id);
			}
			
			$data['datapesan'] = $cekPesan->row();
			$data['validasi'] = $this->my_handle->validasi("form-balas-cepat");
			$data['kirim']= $this->my_handle->kirimdata('btn-pesan', 'form-balas-cepat', 'warning');
			$this->load->view('admin/baca_pesan', $data);
		}
		else{
			$this->load->view('include/halamantidakditemukan');
		}
	}
	
	public function act_pesan(){
		$this->form_validation->set_rules('pesan_untuk', 'Untuk', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pesan_judul', 'Subjek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pesan_isi', 'Pesan', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			echo $this->err;
		}
		else{
			date_default_timezone_set("Asia/Hong_Kong");
			$data['pesan_dari'] = $this->session->userdata('user_id');
			$data['pesan_untuk'] = $this->input->post('pesan_untuk', 'TRUE');
			$data['pesan_judul'] = $this->input->post('pesan_judul', 'TRUE');
			$data['pesan_isi'] = $this->input->post('pesan_isi', 'TRUE');
			$data['pesan_tanggal'] = dateindo(date('Y-m-d')).", ".date('H:i');
			$kirimpesan =$this->m_pesan->kirim_pesan($data);
			if($kirimpesan){
				$this->my_notifikasi->sukses("Pesan", "Pesan Berhasil Dikirim", "admin/pesan");
			}
			else{
				$this->err = $this->my_notifikasi->kesalahan("Gagal Mengirim Pesan");
			}
			
		}
	}
	
	public function hapus_masuk($id){
		$hapusmasuk = $this->m_pesan->hapus_pesan_masuk($id, $this->session->userdata('user_id'));
		if($hapusmasuk){
			redirect(site_url('admin/pesan'));
		}
		else{
			echo "Gagal Hapus Pesan";
		}
	}
	
	public function hapus_kirim($id){
		$hapuskirim = $this->m_pesan->hapus_pesan_kirim($id, $this->session->userdata('user_id'));
		if($hapuskirim){
			redirect(site_url('admin/pesan'));
		}
		else{
			echo "Gagal Hapus Pesan";
		}
	}
}

/* End of file Pesan.php */
/* Location: ./application/modules/admin/controllers/Pesan.php */
