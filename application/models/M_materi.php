<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_materi extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_semua_materi($semester, $thnajaran){
		$this->db->select('T1.materi_nama, T1.materi_deskripsi, T1.materi_file, T1.materi_tanggal, T2.kelas_nama, T2.kelas_no, T3.pengajar_nama, T4.jurusan_nama, T5.pelajaran_nama');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_kelas AS T2', 'T1.materi_kelas = T2.kelas_id', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T1.materi_pengajar = T3.pengajar_id', 'inner');
		$this->db->join('tb_jurusan AS T4', 'T2.kelas_jurusan = T4.jurusan_id', 'inner');
		$this->db->join('tb_pelajaran AS T5', 'T1.materi_pelajaran = T5.pelajaran_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran);
		$this->db->where($array);
		$this->db->order_by('materi_id', 'DESC');
		return $this->db->get();
	}
	
	function ambil_materi_pengajar($semester, $thnajaran, $pengajar){
		$this->db->select('T1.materi_id, T1.materi_nama, T1.materi_deskripsi, T1.materi_file, T1.materi_tanggal, T2.kelas_nama, T2.kelas_no, T3.jurusan_nama, T4.pelajaran_nama');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_kelas AS T2', 'T1.materi_kelas = T2.kelas_id', 'inner');
		$this->db->join('tb_jurusan AS T3', 'T2.kelas_jurusan = T3.jurusan_id', 'inner');
		$this->db->join('tb_pelajaran AS T4', 'T1.materi_pelajaran = T4.pelajaran_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran, 'materi_pengajar' => $pengajar);
		$this->db->where($array);
		$this->db->order_by('materi_id', 'DESC');
		return $this->db->get();
	}
	
	function ambil_materi_kelas($semester, $thnajaran, $kelas){
		$this->db->select('T1.materi_nama, T1.materi_deskripsi, T1.materi_file, T1.materi_tanggal, T2.kelas_nama, T2.kelas_no, T3.pengajar_nama, T4.jurusan_nama, T5.pelajaran_nama');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_kelas AS T2', 'T1.materi_kelas = T2.kelas_id', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T1.materi_pengajar = T3.pengajar_id', 'inner');
		$this->db->join('tb_jurusan AS T4', 'T2.kelas_jurusan = T4.jurusan_id', 'inner');
		$this->db->join('tb_pelajaran AS T5', 'T1.materi_pelajaran = T5.pelajaran_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran, 'materi_kelas'=>$kelas);
		$this->db->where($array);
		$this->db->order_by('materi_id', 'DESC');
		return $this->db->get();
	}
	
	function cari_materi($semester, $thnajaran, $kelas, $pelajaran, $pengajar){
		$this->db->select('T1.materi_nama, T1.materi_deskripsi, T1.materi_file, T1.materi_tanggal, T2.kelas_nama, T2.kelas_no, T3.pengajar_nama, T4.jurusan_nama, T5.pelajaran_nama');
		$this->db->from('tb_materi AS T1 ');
		$this->db->join('tb_kelas AS T2', 'T1.materi_kelas = T2.kelas_id', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T1.materi_pengajar = T3.pengajar_id', 'inner');
		$this->db->join('tb_jurusan AS T4', 'T2.kelas_jurusan = T4.jurusan_id', 'inner');
		$this->db->join('tb_pelajaran AS T5', 'T1.materi_pelajaran = T5.pelajaran_id', 'inner');
		$array = array('materi_semester' => $semester, 'materi_thnajaran' => $thnajaran, 'materi_kelas'=>$kelas, 'materi_pelajaran'=>$pelajaran, 'materi_pengajar'=>$pengajar);
		$this->db->where($array);
		$this->db->order_by('materi_id', 'DESC');
		return $this->db->get();
	}
	
	function ambil_materi_id($id){
		$this->db->select('materi_id, materi_nama, materi_deskripsi, materi_kelas, materi_file, materi_pengajar, materi_pelajaran');
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

/* End of file M_materi.php */
/* Location: ./application/models/M_materi.php */
