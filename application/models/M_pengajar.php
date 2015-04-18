<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_pengajar extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_pengajar(){
		$this->db->select('*');
		$this->db->from('tb_pengajar');
		return $this->db->get();
	}
	
	function ambil_pengajar_id($id){
		$this->db->select('*');
		$this->db->from('tb_pengajar');
		$this->db->where('pengajar_id', $id);
		return $this->db->get();
	}
	
	function tambah_pengajar($data){
		return $this->db->insert('tb_pengajar', $data);
	}
	
	function update_pengajar($id, $data){
		$this->db->where('pengajar_id', $id);
		return $this->db->update('tb_pengajar', $data);
	}
	
	function hapus_pengajar($id){
		$this->db->where('pengajar_id', $id);
		$this->db->delete('tb_pengajar');
	}
	
	function cek_nama_pengajar($nama){
		$this->db->select('pengajar_nama');
		$this->db->from('tb_pengajar');
		$this->db->where('pengajar_nama', $nama);
		return $this->db->get();
	}
	
	function cek_username_pengajar($username){
		$this->db->select('pengajar_username');
		$this->db->from('tb_pengajar');
		$this->db->where('pengajar_username', $username);
		return $this->db->get();
	}
	
	function cek_login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_pengajar');
		$this->db->where('pengajar_username', $username);
		$this->db->where('pengajar_password', $password);
		return $this->db->get();
	}
}
