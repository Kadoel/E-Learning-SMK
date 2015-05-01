<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_pelajaran extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_pelajaran(){
		$this->db->select('*');
		$this->db->from('tb_pelajaran');
		$this->db->order_by('pelajaran_nama', 'ASC');
		return $this->db->get();
	}
	
	function ambil_pelajaran_id($id){
		$this->db->select('*');
		$this->db->from('tb_pelajaran');
		$this->db->where('pelajaran_id', $id);
		return $this->db->get();
	}
	
	function tambah_pelajaran($data){
		return $this->db->insert('tb_pelajaran', $data);
	}
	
	function update_pelajaran($id, $data){
		$this->db->where('pelajaran_id', $id);
		return $this->db->update('tb_pelajaran', $data);
	}
	
	function hapus_pelajaran($id){
		$this->db->where('pelajaran_id', $id);
		$this->db->delete('tb_pelajaran');
	}
	
	function cek_nama_pelajaran($pelajaran){
		$this->db->select('pelajaran_nama');
		$this->db->from('tb_pelajaran');
		$this->db->where('pelajaran_nama', $pelajaran);
		return $this->db->get();
	}
}

/* End of file M_pelajaran.php */
/* Location: ./application/models/M_pelajaran.php */
