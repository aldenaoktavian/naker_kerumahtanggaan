<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Ruangan_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function all_ruangan()
	{
		$query = $this->db->get('ruangans');
		return $query->result_array();
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

	/* start about booking ruangan */

	function data_booking_ruangan($id_user, $limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, jam_book, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE id_user = ".$id_user." AND (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.jam_book LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, jam_book, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE id_user = ".$id_user." LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_booking_ruangan($id_user, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.jam_book LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE id_user = ".$id_user)->row_array();
		}
		return $query['jml'];
	}

	function add_booking_ruangan($data)
	{
		$this->db->insert('booking_ruangans', $data);
		return $this->db->insert_id();
	}

	/* end about booking ruangan */
}
?>