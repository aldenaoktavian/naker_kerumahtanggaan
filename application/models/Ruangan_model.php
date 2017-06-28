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
		if($id_user != 0){
			$sort_user = "id_user = ".$id_user;
		} else{
			$sort_user = "1=1";
		}

		if($search != ''){
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, start_time, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status = 'B' AND (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.start_time LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, start_time, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status = 'B' LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_booking_ruangan($id_user, $search='')
	{
		if($id_user != 0){
			$sort_user = "id_user = ".$id_user;
		} else{
			$sort_user = "1=1";
		}
		
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status = 'B' AND (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.start_time LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status = 'B'")->row_array();
		}
		return $query['jml'];
	}

	function check_room_availability($tgl_book, $start_time, $end_time)
	{
		if($tgl_book != ''){
			$search_tgl_book = 'tgl_book = '.$tgl_book;
		} else{
			$search_tgl_book = '1=1';
		}

		if($start_time != ''){
			$search_time = '( start_time NOT BETWEEN '.$start_time.' AND '.$end_time.' )';
		} else{
			$search_time = '1=1';
		}

		$query = $this->db->query("SELECT * FROM ruangans WHERE id NOT IN ( SELECT ruangan_id FROM booking_ruangans WHERE tgl_book = '".$tgl_book."' AND (( start_time BETWEEN '".$start_time."' AND '".$end_time."' ) OR ( end_time BETWEEN '".$start_time."' AND '".$end_time."' )) AND status = 'B' )");
		print_r($this->db->last_query());

		return $query->result_array();
	}

	function add_booking_ruangan($data)
	{
		$this->db->insert('booking_ruangans', $data);
		return $this->db->insert_id();
	}

	function detail_booking_ruangan($id)
	{
		$query = $this->db->query("SELECT a.*, nama_ruangan FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE md5(a.id) = '".$id."'");
		return $query->row_array();
	}

	function update_booking_ruangan($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('booking_ruangans', $data);
		return $update;
	}

	function delete_booking_ruangan($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('booking_ruangans');
		return $result;
	}

	/* end about booking ruangan */

	/* start about histori booking ruangan */

	function data_booking_ruangan_history($id_user, $limit, $offset, $search='')
	{
		if($id_user != 0){
			$sort_user = "id_user = ".$id_user;
		} else{
			$sort_user = "1=1";
		}

		if($search != ''){
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, start_time, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status != 'B' AND (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.start_time LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.id AS id, nama_ruangan, tgl_book, start_time, direktorat, status FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status != 'B' LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_booking_ruangan_history($id_user, $search='')
	{
		if($id_user != 0){
			$sort_user = "id_user = ".$id_user;
		} else{
			$sort_user = "1=1";
		}
		
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status != 'B' AND (
					b.nama_ruangan LIKE '%".$search."%' OR 
					a.tgl_book LIKE '%".$search."%' OR 
					a.start_time LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' 
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM booking_ruangans a INNER JOIN ruangans b ON a.ruangan_id = b.id WHERE ".$sort_user." AND status != 'B'")->row_array();
		}
		return $query['jml'];
	}

	/* end about histori booking ruangan */
}
?>