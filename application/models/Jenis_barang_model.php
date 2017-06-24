<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Jenis_barang_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function all_barang()
	{
		$query = $this->db->get('jenis_barangs');
		return $query->result_array();
	}
	
	function data_barang($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT * FROM jenis_barangs WHERE ( kode_jenis LIKE '%".$search."%' OR nama_jenis LIKE '%".$search."%' ) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM jenis_barangs LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_barang($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM jenis_barangs WHERE ( kode_jenis LIKE '%".$search."%' OR nama_jenis LIKE '%".$search."%' )")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("jenis_barangs")->row_array();
		}
		return $query['jml'];
	}

	function detail_barang($id)
	{
		$this->db->where('md5(id)', $id);
		return $this->db->get('jenis_barangs')->row_array();
	}

	function add_barang($data)
	{
		$this->db->insert('jenis_barangs', $data);
		return $this->db->insert_id();
	}

	function update_barang($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('jenis_barangs', $data);
		return $update;
	}

	function delete_barang($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('jenis_barangs');
		return $result;
	}

	// /* start about booking ruangan */

	function data_pengadaan_barang($id_user, $limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM pengadaan_barangs a INNER JOIN jenis_barangs b ON a.jenis_barang_id = b.id WHERE a.create_by = ".$id_user." AND (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_pengadaan LIKE '%".$search."%' OR 
					a.tgl_pengadaan LIKE '%".$search."%' OR 
					a.nama_barang LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' OR
					a.nma_pemesan LIKE '%".$search."%' 
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM pengadaan_barangs a INNER JOIN jenis_barangs b ON a.jenis_barang_id = b.id WHERE a.create_by = ".$id_user." LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_pengadaan_barang($id_user, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM pengadaan_barangs a INNER JOIN jenis_barangs b ON a.jenis_barang_id = b.id WHERE (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_pengadaan LIKE '%".$search."%' OR 
					a.tgl_pengadaan LIKE '%".$search."%' OR 
					a.nama_barang LIKE '%".$search."%' OR 
					a.direktorat LIKE '%".$search."%' OR
					a.nma_pemesan LIKE '%".$search."%' 
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM pengadaan_barangs a INNER JOIN jenis_barangs b ON a.jenis_barang_id = b.id WHERE create_by = ".$id_user)->row_array();
		}
		return $query['jml'];
	}

	function add_pengadaan_barang($data)
	{
		$this->db->insert('pengadaan_barangs', $data);
		return $this->db->insert_id();
	}

	/* end about booking ruangan */
}
?>