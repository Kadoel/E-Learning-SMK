<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	public $semester, $thnajaran, $dataglobal;
	public function __construct(){
		parent::__construct();
		$this->load->library(array('MY_Handle'));
		$this->load->model(array('m_materi', 'm_kelas', 'm_jurusan', 'm_setting', 'm_pelajaran', 'm_pengajar'));
		$this->load->helper(array('dateindo','form'));
		
		$pengaturan = $this->m_setting->ambil_setting('1')->row();
		$this->semester = $pengaturan->setting_semester;
		$this->thnajaran = $pengaturan->setting_thnajaran;
		$this->dataglobal = array(
					'listKelas' => $this->m_kelas->ambil_kelas()->result(),
					'list_pelajaran' => $this->m_pelajaran->ambil_pelajaran()->result(),
					'list_pengajar' => $this->m_pengajar->ambil_pengajar()->result(),
					'dataTable' => $this->my_handle->datatable("tabel-semua-materi", '10'),
					'validasi' => $this->my_handle->validasi("form-cari"),
					'semester' => $this->semester,
					'thnajaran' => $this->thnajaran
				);
	}
	
	public function index(){
		$data = $this->dataglobal;
		$data['semuaMateri'] = $this->m_materi->ambil_semua_materi($this->semester, $this->thnajaran)->result();
		$this->load->view('home', $data);
	}
	
	public function kelas($slug){
		$param = explode("_", $slug);
		$paramjrs = $this->m_jurusan->ambil_id_jurusan($param[1])->row()->jurusan_id;
		if(count($param)=='3'){
			$no = $param[2];
		}
		else{
			$no="";
		}
		$cekId = $this->m_kelas->ambil_id_kelas($param[0], $paramjrs, $no);
		if($cekId->num_rows() < 1){
			$this->load->view('include/halamantidakditemukan');
		}
		else{
			$id = $cekId->row()->kelas_id;
			$jPage = $this->m_kelas->ambil_kelas_judul($id)->row();
			$data = $this->dataglobal;
			$data['semuaMateri'] = $this->m_materi->ambil_materi_kelas($this->semester, $this->thnajaran, $id)->result();
			$data['judulPage']= $jPage->kelas_nama." ".$jPage->jurusan_nama." ".$jPage->kelas_no;
			$this->load->view('kelas', $data);
		}
	}
	
	public function cari(){
		$kelas = $this->input->post('materi_kelas');
		$pelajaran = $this->input->post('materi_pelajaran');
		$pengajar = $this->input->post('materi_pengajar');
		if($kelas =="" AND $pelajaran =="" AND $pengajar==""){
			//redirect(site_url());
			$data = $this->dataglobal;
			$this->load->view('cari_kosong', $data);
		}
		else{
			$kls = $this->m_kelas->ambil_kelas_judul($kelas)->row();
			$data = $this->dataglobal;
			$data['semuaMateri'] = $this->m_materi->cari_materi($this->semester, $this->thnajaran, $kelas, $pelajaran, $pengajar)->result();
			$data['infokelas'] = $kls->kelas_nama." ".$kls->jurusan_nama." ".$kls->kelas_no;
			$data['infopelajaran'] = $this->m_pelajaran->ambil_pelajaran_id($pelajaran)->row()->pelajaran_nama;
			$data['infopengajar'] = $this->m_pengajar->ambil_pengajar_id($pengajar)->row()->pengajar_nama;
			$this->load->view('cari', $data);
		}
	}
}
