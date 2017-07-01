<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perpanjangan_stnk extends CI_Controller {

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
		if(check_privilege('perpanjangan_stnk', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Perpanjangan STNK";
		$data['menu_title'] = "Perpanjangan STNK - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('perpanjangan_stnk/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('perpanjangan_stnk', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
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

		$this->load->view('perpanjangan_stnk/data-search', $data);
	}

	public function update_konf($id){
		if(check_privilege('perpanjangan_stnk', 'is_approve') != TRUE){
			redirect('gate/unauthorized');
		}
		$konfirmasi_stnk = $this->Kendaraan_model->konfirmasi_stnk($id);
		if(($konfirmasi_stnk['insert_perpanjang'] == TRUE) && ($konfirmasi_stnk['update_kendaraan'] == TRUE)){
			$_SESSION['perpanjangan_stnk']['message_color'] = "green";
			$_SESSION['perpanjangan_stnk']['message'] = "Berhasil dilakukan Perpanjangan STNK";
			redirect('perpanjangan_stnk');
		} else{
			$_SESSION['perpanjangan_stnk']['message_color'] = "red";
			$_SESSION['perpanjangan_stnk']['message'] = "Gagal dilakukan perpanjangan STNK. Silahkan coba kembali nanti.";
			redirect('perpanjangan_stnk');
		}
	}
}
