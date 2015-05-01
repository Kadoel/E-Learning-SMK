<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_kelas extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_kelas(){
		$this->db->select('T1.kelas_id, T1.kelas_nama, T1.kelas_no, T2.jurusan_nama, T2.jurusan_slug');
		$this->db->from('tb_kelas AS T1');
		$this->db->join('tb_jurusan AS T2', 'T2.jurusan_id = T1.kelas_jurusan', 'inner');
		$this->db->order_by('kelas_nama', 'ASC');
		$this->db->order_by('jurusan_nama', 'ASC');
		$this->db->order_by('kelas_no', 'ASC');
		return $this->db->get();
	}
	
	function ambil_kelas_id($id){
		$this->db->select('*');
		$this->db->from('tb_kelas');
		$this->db->where('kelas_id', $id);
		return $this->db->get();
	}
	
	function ambil_id_kelas($kls, $jrs, $no){
		$this->db->select('kelas_id');
		$this->db->from('tb_kelas');
		$array = array('kelas_nama'=>$kls, 'kelas_jurusan'=>$jrs, 'kelas_no'=>$no);
		$this->db->where($array);
		return $this->db->get();
	}
	
	function ambil_kelas_judul($id){
		$this->db->select('T1.kelas_nama, T1.kelas_no, T2.jurusan_nama');
		$this->db->from('tb_kelas AS T1');
		$this->db->join('tb_jurusan AS T2', 'T2.jurusan_id = T1.kelas_jurusan', 'inner');
		$this->db->where('kelas_id', $id);
		return $this->db->get();
	}
	
	function tambah_kelas($data){
		return $this->db->insert('tb_kelas', $data);
	}
	
	function update_kelas($id, $data){
		$this->db->where('kelas_id', $id);
		return $this->db->update('tb_kelas', $data);
	}
	
	function hapus_kelas($id){
		$this->db->where('kelas_id', $id);
		$this->db->delete('tb_kelas');
	}
	
	function cek_kelas($nama, $jurusan, $nomor=''){
		$this->db->select('kelas_id');
		$this->db->from('tb_kelas');
		$array=array('kelas_nama'=>$nama, 'kelas_jurusan'=>$jurusan, 'kelas_no'=>$nomor);
		$this->db->where($array);
		return $this->db->get();
	}
}

/* End of file M_kelas.php */
/* Location: ./application/models/M_kelas.php */
