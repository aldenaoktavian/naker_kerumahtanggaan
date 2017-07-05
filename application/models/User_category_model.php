<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class User_category_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function all_user_category()
	{
		$query = $this->db->get('user_categories');
		return $query->result_array();
	}
	
	function data_user_category($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM user_categories WHERE ( category_name LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM user_categories LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_user_category($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM user_categories WHERE ( category_name LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("user_categories")->row_array();
		}
		return $query['jml'];
	}

	function detail_user_category($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('user_categories')->row_array();
	}

	function add_user_category($data)
	{
		$this->db->insert('user_categories', $data);
		return $this->db->insert_id();
	}

	function update_user_category($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('user_categories', $data);
		return $update;
	}

	function delete_user_category($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('user_categories');
		return $result;
	}

	/* start for privileges */
	function all_priv_modules($user_category_id)
	{
		$query = $this->db->query("SELECT 
				*, 
				( SELECT is_view FROM user_privileges WHERE module_id = a.id AND user_category_id = ".$user_category_id." ) AS is_view,
				( SELECT is_insert FROM user_privileges WHERE module_id = a.id AND user_category_id = ".$user_category_id." ) AS is_insert,
				( SELECT is_update FROM user_privileges WHERE module_id = a.id AND user_category_id = ".$user_category_id." ) AS is_update,
				( SELECT is_delete FROM user_privileges WHERE module_id = a.id AND user_category_id = ".$user_category_id." ) AS is_delete, 
				( SELECT is_approve FROM user_privileges WHERE module_id = a.id AND user_category_id = ".$user_category_id." ) AS is_approve
				FROM modules a 
				WHERE id_parent IS NOT NULL 
				ORDER BY id_parent, no_urut ASC
			");
		return $query->result_array();
	}

	function add_privileges($data)
	{
		$this->db->insert('user_privileges', $data);
		return $this->db->insert_id();
	}

	function check_available_priv($module_id, $user_category_id)
	{
		$this->db->select('id');
		$this->db->where('module_id', $module_id);
		$this->db->where('user_category_id', $user_category_id);
		$result = $this->db->get('user_privileges')->row_array();
		return $result['id'];
	}

	function update_privileges($id, $data)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('user_privileges', $data);
		return $update;
	}
	/* end for privileges */
}
?>