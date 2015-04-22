<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_materi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_semua_materi($semester, $thnajaran){
		$this->db->select('T1.materi_nama, T1.materi_deskripsi, T1.materi_kelas, T2.jurusan_nama, T1.materi_file, T3.pengajar_nama, T1.materi_tanggal');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_jurusan AS T2', 'T1.materi_jurusan = T2.jurusan_id', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T1.materi_pengajar = T3.pengajar_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran);
		$this->db->where($array);
		return $this->db->get();
	}
	
	function ambil_materi_pengajar($semester, $thnajaran, $pengajar){
		$this->db->select('T1.materi_id, T1.materi_nama, T1.materi_deskripsi, T1.materi_kelas, T2.jurusan_nama, T1.materi_file, T1.materi_tanggal');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_jurusan AS T2', 'T1.materi_jurusan = T2.jurusan_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran, 'materi_pengajar' => $pengajar);
		$this->db->where($array);
		return $this->db->get();
	}
	
	function pencarian_materi($semester, $thnajaran, $kelas, $jurusan, $pengajar){
		$this->db->select('T1.materi_id, T1.materi_nama, T1.materi_deskripsi, T1.materi_kelas, T2.jurusan_nama, T1.materi_file, T3.pengajar_nama, T1.materi_tanggal');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_jurusan AS T2', 'T1.materi_jurusan = T2.jurusan_id', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T1.materi_pengajar = T3.pengajar_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran, 'materi_kelas' => $kelas, 'materi_jurusan' => $jurusan, 'materi_pengajar' => $pengajar);
		$this->db->where($array);
		return $this->db->get();
	}
	
	function ambil_materi_id($id){
		$this->db->select('materi_id, materi_nama, materi_deskripsi, materi_kelas, materi_jurusan, materi_file, materi_pengajar');
		$this->db->from('tb_materi');
		$this->db->where('materi_id', $id);
		return $this->db->get();
	}
	
	function tambah_materi($data){
		return $this->db->insert('tb_materi', $data);
	}
	
	function update_materi($id, $data){
		$this->db->where('materi_id', $id);
		return $this->db->update('tb_materi', $data);
	}
	
	function hapus_materi($id){
		$this->db->where('materi_id', $id);
		$this->db->delete('tb_materi');
	}
}
