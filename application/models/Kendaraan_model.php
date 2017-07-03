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
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%'
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
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%'
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

	function detail_kendaraan($id)
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

	// /* start about perpanjangan stnk */

	function data_stnk($id_user, $limit, $offset, $search='')
	{	
		if($search != ''){
			$query = $this->db->query("SELECT a.id, a.pemegang, a.no_pol, a.merk, a.masa_stnk, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'),INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_ADD(masa_stnk,INTERVAL 1 MONTH) ) AND (
					a.merk LIKE '%".$search."%' OR
					b.nama_jenis LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.masa_stnk LIKE '%".$search."%' 
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT a.id, a.pemegang, a.no_pol, a.merk, a.masa_stnk, b.nama_jenis FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'),INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_ADD(masa_stnk,INTERVAL 1 MONTH) ) LIMIT ".$limit.",".$offset);
			// echo "<pre>";print_r($query->result_array());echo "</pre>";exit;
		}
		return $query->result_array();
	}

	function count_all_data_stnk($id_user, $search='')
	{

		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'),INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_ADD(masa_stnk,INTERVAL 1 MONTH) ) AND (
					a.merk LIKE '%".$search."%' OR
					b.nama_jenis LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					a.masa_stnk LIKE '%".$search."%' 
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id WHERE (DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_SUB(DATE_FORMAT(masa_stnk,'%Y-%m-%d'),INTERVAL 5 MONTH) OR DATE_FORMAT(NOW(),'%Y-%m-%d') = DATE_ADD(masa_stnk,INTERVAL 1 MONTH) )")->row_array();
		}
		return $query['jml'];
	}

	function konfirmasi_stnk($id){
		$data = $this->db->select('*')->get_where('kendaraans',array('md5(id)'=>$id))->row_array();
		$data['masa_akhir'] = $this->db->query("SELECT DATE_ADD(DATE_FORMAT(masa_stnk,'%Y-%m-%d'), INTERVAL 12 MONTH) masa_akhir FROM kendaraans WHERE md5(id) = '".$id."'");
		// echo "<pre>";print_r($data['masa_akhir']->result_array()[0]['masa_akhir']);echo "</pre>";exit;
		$data['insert'] = array(
				'kendaraan_id'				=> $data['id'],
				'masa_awal_perpanjangan'	=> $data['masa_stnk'],
				'masa_akhir_perpanjangan'	=> $data['masa_akhir']->result_array()[0]['masa_akhir'],
				'tgl_perpanjangan'			=> date('Y-m-d H:i:s'),
				'status'					=> 'C',
				'created'					=> date('Y-m-d H:i:s'),
				'create_by'					=> $_SESSION['login']['id_user'],
				'modified'					=> date('Y-m-d H:i:s'),
				'modi_by'					=> $_SESSION['login']['id_user']
			);
		$this->db->insert('perpanjangan_stnks', $data['insert']);
		$data['insert_perpanjang'] = $this->db->insert_id();
		$this->db->where('md5(id)', $id);
		$data['update_kendaraan'] = $this->db->update('kendaraans', array('masa_stnk'=>$data['masa_akhir']->result_array()[0]['masa_akhir'],'modified'=>date('Y-m-d H:i:s'),'modi_by'=>$_SESSION['login']['id_user']));
		return $data;
	}

	/* end */
	/* laporan perpanjangan stnk */

	function data_stnk_report($id_user, $limit, $offset, $search='')
	{	
		if($search != ''){
			$query = $this->db->query("SELECT c.id, a.pemegang, a.no_pol, b.nama_jenis, c.masa_awal_perpanjangan, c.masa_akhir_perpanjangan, c.tgl_perpanjangan FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id INNER JOIN perpanjangan_stnks c ON a.id = c.kendaraan_id WHERE (
					b.nama_jenis LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					c.masa_akhir_perpanjangan LIKE '%".$search."%' OR
					c.masa_awal_perpanjangan LIKE '%".$search."%' OR
					c.tgl_perpanjangan LIKE '%".$search."%'
				) LIMIT ".$limit.",".$offset);
		} else{
			$query = $this->db->query("SELECT c.id, a.pemegang, a.no_pol, b.nama_jenis, c.masa_awal_perpanjangan, c.masa_akhir_perpanjangan, c.tgl_perpanjangan FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id INNER JOIN perpanjangan_stnks c ON a.id = c.kendaraan_id LIMIT ".$limit.",".$offset);
			// echo "<pre>";print_r($query->result_array());echo "</pre>";exit;
		}
		return $query->result_array();
	}

	function count_all_data_stnk_report($id_user, $search='')
	{

		if($search != ''){
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id INNER JOIN perpanjangan_stnks c ON a.id = c.kendaraan_id WHERE (
					b.nama_jenis LIKE '%".$search."%' OR
					a.no_pol LIKE '%".$search."%' OR
					a.pemegang LIKE '%".$search."%' OR
					c.masa_akhir_perpanjangan LIKE '%".$search."%' OR
					c.masa_awal_perpanjangan LIKE '%".$search."%' OR
					c.tgl_perpanjangan LIKE '%".$search."%'
				)")->row_array();
		} else{
			$query = $this->db->query("SELECT count(*) AS jml FROM kendaraans a INNER JOIN jenis_kendaraans b ON a.jns_kendaraan_id = b.id INNER JOIN perpanjangan_stnks c ON a.id = c.kendaraan_id")->row_array();
		}
		return $query['jml'];
	}

	
}
?>