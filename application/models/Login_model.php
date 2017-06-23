<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Login_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function cek_user_login($username, $password)
	{
		$query = $this
			->db
			->where('username', $username)
			->where('password', $password)
			->limit(1)
			->get('users');
			
		if ($query->num_rows() == 1) {
			$data = $query->row_array();
			return $data['id'];
		}
		else
		{
			return FALSE;
		}
	}

}
?>