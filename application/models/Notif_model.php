<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Notif_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function add_notif($data)
	{
		$this->db->insert('notifs', $data);
		return $this->db->insert_id();
	}

	function all_notif($user_id, $limit=0, $offset=0)
	{
		$this->db->where('user_id', $user_id);
		$this->db->order_by('notif_status', 'asc');
		$this->db->order_by('created', 'desc');

		if($offset != 0){
			$this->db->limit($offset, $limit);
		}

		$query = $this->db->get('notifs');
		return $query->result_array();
	}

	function unread_notif_count($user_id)
	{
		$this->db->select("count(*) AS jml");
		$this->db->where('user_id', $user_id);
		$this->db->where("notif_status", 0);
		$result = $this->db->get("notifs")->row_array();
		return $result["jml"];
	}

	function detail_notif($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('notifs')->row_array();
	}

	function read_notif($id)
	{
		$data = array(
				'notif_status'	=> 1,

			);
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('notifs', $data);
		return $update;
	}

	function get_email_by_module($module_name)
	{
		$query = $this->db->query("SELECT a.id AS user_id, email FROM users a INNER JOIN user_categories b ON a.user_category_id = b.id INNER JOIN user_privileges c ON b.id = c.user_category_id INNER JOIN modules d ON c.module_id = d.id WHERE d.module_name = '".$module_name."' AND c.is_approve = 1");
		return $query->result_array();
	}
}
?>