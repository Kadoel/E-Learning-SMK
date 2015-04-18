<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_jurusan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_jurusan(){
		$this->db->select('*');
		$this->db->from('tb_jurusan');
		return $this->db->get();
	}
	
	function ambil_jurusan_id($id){
		$this->db->select('*');
		$this->db->from('tb_jurusan');
		$this->db->where('jurusan_id', $id);
		return $this->db->get();
	}
	
	function tambah_jurusan($data){
		return $this->db->insert('tb_jurusan', $data);
	}
	
	function update_jurusan($id, $data){
		$this->db->where('jurusan_id', $id);
		return $this->db->update('tb_jurusan', $data);
	}
	
	function hapus_jurusan($id){
		$this->db->where('jurusan_id', $id);
		$this->db->delete('tb_jurusan');
	}
	
	function cek_nama_jurusan($nama){
		$this->db->select('jurusan_nama');
		$this->db->from('tb_jurusan');
		$this->db->where('jurusan_nama', $nama);
		return $this->db->get();
	}
}

/* End of file Setting.php */
/* Location: ./application/models/Setting.php */
