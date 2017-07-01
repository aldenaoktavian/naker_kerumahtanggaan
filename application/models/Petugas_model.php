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

	function detail_petugas2($id)
	{
		$this->db->where('id', $id);
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
	/* Tugas Cleaning */
	function data_cleaning($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM jadwal_tugas WHERE( kode_jadwal LIKE '%".$search."%' OR bulan_tugas LIKE '%".$search."%' OR tahun_tugas LIKE '%".$search."%' ) AND tipe = 'C' LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM jadwal_tugas WHERE tipe = 'C' LIMIT ".$limit.",".$offset);
		}
		return $query->result_array();
	}

	function count_all_cleaning($tipe_petugas, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM jadwal_tugas WHERE( kode_jadwal LIKE '%".$search."%' OR bulan_tugas LIKE '%".$search."%' OR tahun_tugas LIKE '%".$search."%' ) AND tipe = 'C'")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get_where("jadwal_tugas",array('tipe'=>'C'))->row_array();
		}
		return $query['jml'];
	}

	function all_petugas_cleaning(){
		$data = $this->db->select('*')->get_where('petugas',array('petugas_tipe_id'=>'1'));
		return $data->result_array();
	}

	function data_notelp_petugas($id){
		$data = $this->db->select('no_telp')->get_where('petugas',array('id'=>$id));
		return $data->result_array();
	}

	function add_jadwal($data){
		$this->db->insert('jadwal_tugas', $data);
		return $this->db->insert_id();
	}

	function add_detail_jadwal($data){
		$this->db->insert('jadwal_tugas_details', $data);
		return $this->db->insert_id();
	}

	function update_jadwal($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('jadwal_tugas', $data);
		return $update;
	}

	function detail_jadwal($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('jadwal_tugas')->result_array();
	}

	function detail_jadwal_detail($id)
	{
		$data = $this->db->select('*')->get_where('jadwal_tugas_details',array('md5(jadwal_tugas_id)'=>$id));
		return $data->result_array();
	}

	function update_detail_jadwal($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('jadwal_tugas_details', $data);
		return $update;
	}

	function delete_temp_detail_jadwal($id)
	{
		$this->db->where('md5(jadwal_tugas_id)', $id);
		$result = $this->db->delete('jadwal_tugas_details');
		return $result;
	}
	/* end */
	/* Tugas Security */
	function data_security($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM jadwal_tugas WHERE( kode_jadwal LIKE '%".$search."%' OR bulan_tugas LIKE '%".$search."%' OR tahun_tugas LIKE '%".$search."%' ) AND tipe = 'S' LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM jadwal_tugas WHERE tipe = 'S' LIMIT ".$limit.",".$offset);
		}
		return $query->result_array();
	}

	function count_all_security($tipe_petugas, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM jadwal_tugas WHERE( kode_jadwal LIKE '%".$search."%' OR bulan_tugas LIKE '%".$search."%' OR tahun_tugas LIKE '%".$search."%' ) AND tipe = 'S'")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get_where("jadwal_tugas",array('tipe'=>'S'))->row_array();
		}
		return $query['jml'];
	}

	function all_petugas_security(){
		$data = $this->db->select('*')->get_where('petugas',array('petugas_tipe_id'=>'2'));
		return $data->result_array();
	}
	/* end */
}
?>