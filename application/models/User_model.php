<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function data_user($id_user)
	{
		$this->db->where('id', $id_user);
		return $this->db->get('users')->row_array();
	}
}
?>