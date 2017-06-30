<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Jenis_kendaraan_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function all_jenis_kendaraan()
	{
		$query = $this->db->get('jenis_kendaraans');
		return $query->result_array();
	}
	
	function data_jenis_kendaraan($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM jenis_kendaraans WHERE ( kode_jenis LIKE '%".$search."%' OR nama_jenis LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM jenis_kendaraans LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_jenis_kendaraan($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM jenis_kendaraans WHERE ( kode_jenis LIKE '%".$search."%' OR nama_jenis LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("jenis_kendaraans")->row_array();
		}
		return $query['jml'];
	}

	function detail_jenis_kendaraan($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('jenis_kendaraans')->row_array();
	}

	function add_jenis_kendaraan($data)
	{
		$this->db->insert('jenis_kendaraans', $data);
		return $this->db->insert_id();
	}

	function update_jenis_kendaraan($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('jenis_kendaraans', $data);
		return $update;
	}

	function delete_jenis_kendaraan($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('jenis_kendaraans');
		return $result;
	}
}
?>