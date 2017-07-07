<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawatan_barang_history extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('jenis_barang_model');
    }

	public function index()
	{	
		if(check_privilege('perawatan_barang_history', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "History Perawatan Barang";
		$data['menu_title'] = "History Perawatan Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('perawatan_barang_history/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('perawatan_barang_history', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if(check_privilege('perawatan_barang_history', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}

		// print_r($search);exit;
		if($search != ''){
			$data['all_history_perawatan'] = $this->jenis_barang_model->data_history_perawatan($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->jenis_barang_model->count_all_history_perawatan($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_history_perawatan'] = $this->jenis_barang_model->data_history_perawatan($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->jenis_barang_model->count_all_history_perawatan($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$this->load->view('perawatan_barang_history/data-search', $data);
	}

	public function view($id)
	{
		if(check_privilege('perawatan_barang_history', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "History Perawatan Barang";
		$data['menu_title'] = "History Perawatan Barang - View";

		$data['id'] = $id;

		$data['detail_request'] = $this->jenis_barang_model->detail_history_perawatan($id,$_SESSION['login']['id_user']);
		$data['jns_brg'] = $this->jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
		// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;

		$this->load->view('perawatan_barang_history/view', $data);
	}

	public function print_data()
	{
		$data['title'] = "Print Booking Ruangan";

		if(check_privilege('perawatan_barang', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}
		$data['all_history_perawatan'] = $this->jenis_barang_model->data_history_perawatan($id_user);
		
		$this->load->view('perawatan_barang_history/print-data', $data);
	}
}
