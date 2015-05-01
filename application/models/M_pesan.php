<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_pesan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_pesan_masuk($id){
		$this->db->select('T1.pesan_id, T1.pesan_judul, T1.pesan_tanggal, T1.pesan_isi, T2.pengajar_nama, T1.pesan_status');
		$this->db->from('tb_pesan AS T1');
		$this->db->join('tb_pengajar AS T2', 'T2.pengajar_id = T1.pesan_dari', 'inner');
		$array = array('pesan_untuk'=>$id, 'hapus_masuk' => '0');
		$this->db->where($array);
		$this->db->order_by('pesan_id', 'DESC');
		return $this->db->get();
	}
	
	function ambil_pesan_terkirim($id){
		$this->db->select('T1.pesan_id, T1.pesan_judul, T1.pesan_tanggal, T1.pesan_isi, T2.pengajar_nama');
		$this->db->from('tb_pesan AS T1');
		$this->db->join('tb_pengajar AS T2', 'T2.pengajar_id = T1.pesan_untuk', 'inner');
		$array = array('pesan_dari'=>$id, 'hapus_kirim' => '0');
		$this->db->where($array);
		$this->db->order_by('pesan_id', 'DESC');
		return $this->db->get();
	}
	
	function cek_pesan_baru($id){
		$this->db->select('COUNT(pesan_id) as jumlah');
		$this->db->from('tb_pesan');
		$array = array('pesan_untuk'=>$id, 'pesan_status'=>'0');
		$this->db->where($array);
		return $this->db->get();
	}
	
	function baca_pesan($id, $iduser){
		$this->db->select('T1.pesan_dari, T1.pesan_untuk, T1.pesan_judul, T1.pesan_isi, T1.pesan_tanggal, T1.pesan_status, T2.pengajar_nama AS dari, T3.pengajar_nama as untuk');
		$this->db->from('tb_pesan AS T1');
		$this->db->join('tb_pengajar AS T2', 'T2.pengajar_id = T1.pesan_dari', 'inner');
		$this->db->join('tb_pengajar AS T3', 'T3.pengajar_id = T1.pesan_untuk', 'inner');
		$where = "pesan_id='".$id."' AND (pesan_dari='".$iduser."' OR pesan_untuk='".$iduser."')";
		$this->db->where($where);
		return $this->db->get();
	}
	
	function ubah_status_baca($id){
		$data['pesan_status'] = "1";
		$this->db->where('pesan_id', $id);
		$this->db->update('tb_pesan', $data);
	}
	
	function kirim_pesan($data){
		return $this->db->insert('tb_pesan', $data);
	}
	
	function hapus_pesan_masuk($id, $iduser){
		$data['hapus_masuk'] = "1";
		$this->db->where("pesan_id='".$id."' AND pesan_untuk='".$iduser."'");
		return $this->db->update('tb_pesan', $data);
	}
	
	function hapus_pesan_kirim($id, $iduser){
		$data['hapus_kirim'] = "1";
		$this->db->where("pesan_id='".$id."' AND pesan_dari='".$iduser."'");
		return $this->db->update('tb_pesan', $data);
	}
}

/* End of file M_pesan.php */
/* Location: ./application/models/M_pesan.php */
