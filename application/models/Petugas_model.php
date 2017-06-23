<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Petugas_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function data_petugas($tipe_petugas, $limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM petugas WHERE petugas_tipe_id = ".$tipe_petugas." AND ( kode_petugas LIKE '%".$search."%' OR nama_petugas LIKE '%".$search."%' OR jns_kelamin LIKE '%".$search."%' OR no_telp LIKE '%".$search."%' OR alamat LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM petugas WHERE petugas_tipe_id = ".$tipe_petugas." LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_petugas($tipe_petugas, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM petugas WHERE petugas_tipe_id = ".$tipe_petugas." AND ( kode_petugas LIKE '%".$search."%' OR nama_petugas LIKE '%".$search."%' OR jns_kelamin LIKE '%".$search."%' OR no_telp LIKE '%".$search."%' OR alamat LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get_where("petugas", array("petugas_tipe_id"=>$tipe_petugas))->row_array();
		}
		return $query['jml'];
	}

	function detail_petugas($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('petugas')->row_array();
	}

	function add_petugas($data)
	{
		$this->db->insert('petugas', $data);
		return $this->db->insert_id();
	}

	function update_petugas($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('petugas', $data);
		return $update;
	}

	function delete_petugas($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('petugas');
		return $result;
	}
}
?>