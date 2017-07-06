<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_pengadaan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Jenis_barang_model');
    }

	public function index()
	{	
		if(check_privilege('history_pengadaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "History Pengadaan Barang";
		$data['menu_title'] = "History Pengadaan Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('history_pengadaan_barang/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('history_pengadaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if(check_privilege('history_pengadaan_barang', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}

		// print_r($search);exit;
		if($search != ''){
			$data['all_history_barang'] = $this->Jenis_barang_model->data_history_barang($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->Jenis_barang_model->count_all_history_barang($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_history_barang'] = $this->Jenis_barang_model->data_history_barang($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->Jenis_barang_model->count_all_history_barang($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$this->load->view('history_pengadaan_barang/data-search', $data);
	}

	
	public function view($id)
	{
		if(check_privilege('history_pengadaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "History Pengadaan Barang";
		$data['menu_title'] = "History Pengadaan Barang - View";

		$data['id'] = $id;

		$data['detail_request'] = $this->Jenis_barang_model->detail_pengadaan_barang($id,$_SESSION['login']['id_user']);
		$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
		// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;

		$this->load->view('history_pengadaan_barang/view', $data);
	}
}
