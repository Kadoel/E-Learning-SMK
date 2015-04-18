<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_setting extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function ambil_setting($id){
		$this->db->select('*');
		$this->db->from('tb_setting');
		$this->db->where('setting_id', $id);
		return $this->db->get();
	}
	
	function update_setting($id, $data){
		$this->db->where('setting_id', $id);
		return $this->db->update('tb_setting', $data);
	}
}

/* End of file Setting.php */
/* Location: ./application/models/Setting.php */
