<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Kendaraan_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function all_kendaraan()
	{
		$query = $this->db->get('kendaraans');
		return $query->result_array();
	}
	
	function data_kendaraan($limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_kendaraan LIKE '%".$search."%' OR 
					a.merk LIKE '%".$search."%' OR 
					a.tahun LIKE '%".$search."%' OR 
					a.nup LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.no_mesin LIKE '%".$search."%' OR
					a.no_chasis LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.direktorat LIKE '%".$search."%'
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT * FROM kendaraans LIMIT ".$limit.",".$offset);
		}

		return $query->result_array();
	}

	function count_all_kendaraan($search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_kendaraan LIKE '%".$search."%' OR 
					a.merk LIKE '%".$search."%' OR 
					a.tahun LIKE '%".$search."%' OR 
					a.nup LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.no_mesin LIKE '%".$search."%' OR
					a.no_chasis LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.direktorat LIKE '%".$search."%'
				) ")->row_array();
		} else{
			$query = $this->db->select("count(*) AS jml")->get("kendaraans")->row_array();
		}
		return $query['jml'];
	}

	// function detail_kendaraan($id)
	// {
	// 	$this->db->where('md5(id)', $id);
	// 	return $this->db->get('kendaraans')->row_array();
	// }

	function add_kendaraan($data)
	{
		$this->db->insert('kendaraans', $data);
		return $this->db->insert_id();
	}

	function update_kendaraan($id, $data)
	{
		$this->db->where('md5(id)', $id);
		$update = $this->db->update('kendaraans', $data);
		return $update;
	}

	function detail_kendaraan($id,$id_user)
	{
		$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE md5(a.id) = '".$id."' ");

		return $query->result_array();
	}

	function delete_kendaraan($id)
	{
		$this->db->where('md5(id)', $id);
		$result = $this->db->delete('kendaraans');
		return $result;
	}

	// /* start about pengadaan barang */

	function data_stnk($id_user, $limit, $offset, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 5 MONTH) AND (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_kendaraan LIKE '%".$search."%' OR 
					a.merk LIKE '%".$search."%' OR 
					a.tahun LIKE '%".$search."%' OR 
					a.nup LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.no_mesin LIKE '%".$search."%' OR
					a.no_chasis LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.direktorat LIKE '%".$search."%'
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.*, b.kode_jenis, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 5 MONTH) LIMIT ".$limit.",".$offset);
		}
		return $query->result_array();
	}

	function count_all_data_stnk($id_user, $search='')
	{
		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_ADD(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 1 MONTH)) AND (
					b.nama_jenis LIKE '%".$search."%' OR
					a.kode_kendaraan LIKE '%".$search."%' OR 
					a.merk LIKE '%".$search."%' OR 
					a.tahun LIKE '%".$search."%' OR 
					a.nup LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.no_mesin LIKE '%".$search."%' OR
					a.no_chasis LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.direktorat LIKE '%".$search."%'
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d')= DATE_ADD(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 1 MONTH)) ")->row_array();
		}
		return $query['jml'];
	}

	function konfirmasi_stnk($id){
		// $this->db->where('md5(id)', $id);
		$query = $this->db->query("UPDATE kendaraans SET masa_stnk = DATE_ADD(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 12 MONTH), modified = '".date('Y-m-d H:i:s')."', modi_by = '".$_SESSION['login']['id_user']."' WHERE md5(id) = '".$id."'");
		// $update = $this->db->update('kendaraans', array('masa_stnk'=>"DATE_ADD(masa_stnk, INTERVAL 12 MONTH)",'modified'=>date('Y-m-d H:i:s'),'modi_by'=>$_SESSION['login']['id_user']));
		return $query;
	}
}
?>