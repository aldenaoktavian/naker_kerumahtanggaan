<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function detail_user_nomd5($id_user)
	{
		$this->db->where('id', $id_user);
		return $this->db->get('users')->row_array();
	}

	function all_user()
	{
		$query = $this->db->get('users');
		return $query->result_array();
	}
	
	function data_user($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM users WHERE ( category_name LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM users LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_user($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM users WHERE ( category_name LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("users")->row_array();
		}
		return $query['jml'];
	}

	function detail_user($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('users')->row_array();
	}

	function add_user($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	function update_user($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('users', $data);
		return $update;
	}

	function delete_user($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('users');
		return $result;
	}
	
	function check_user_password($user_id, $pass)
	{
	    $this->db->where('id', $user_id);
	    $this->db->where('password', $pass);
	    $data = $this->db->get('users')->row_array();
	    if($data != NULL){
	        return TRUE;
	    } else{
	        return FALSE;
	    }
	}
}
?>