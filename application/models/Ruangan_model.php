<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Ruangan_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function data_ruangan($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM ruangans WHERE ( kode_ruangan LIKE '%".$search."%' OR nama_ruangan LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM ruangans LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_ruangan($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM ruangans WHERE ( kode_ruangan LIKE '%".$search."%' OR nama_ruangan LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("ruangans")->row_array();
		}
		return $query['jml'];
	}

	function detail_ruangan($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('ruangans')->row_array();
	}

	function add_ruangan($data)
	{
		$this->db->insert('ruangans', $data);
		return $this->db->insert_id();
	}

	function update_ruangan($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('ruangans', $data);
		return $update;
	}

	function delete_ruangan($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('ruangans');
		return $result;
	}
}
?>