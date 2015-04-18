<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class M_users extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}

	//Function Untuk Login
	function cek_login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_users');
		$this->db->where('users_login', $username);
		$this->db->where('users_pass', $password);
		return $this->db->get();
	}
}

/* End of file User.php */
/* Location: ./application/models/Users.php */
