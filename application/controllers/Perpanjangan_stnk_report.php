<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perpanjangan_stnk_report extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Kendaraan_model');
    }

	public function index()
	{	
		$data['title'] = "Laporan Perpanjangan STNK";
		$data['menu_title'] = "Laporan Perpanjangan STNK - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('perpanjangan_stnk_report/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		$search = urldecode($search);

		$offset = 2;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_stnk'] = $this->Kendaraan_model->data_stnk($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->Kendaraan_model->count_all_data_stnk($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_stnk'] = $this->Kendaraan_model->data_stnk($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->Kendaraan_model->count_all_data_stnk($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('perpanjangan_stnk_report/data-search', $data);
	}
}
