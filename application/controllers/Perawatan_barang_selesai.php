<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawatan_barang_selesai extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('jenis_barang_model');
		$this->load->helper(array('form', 'url','file'));
    }

	public function index()
	{	
		if(check_privilege('perawatan_barang_selesai', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Perawatan Selesai";
		$data['menu_title'] = "Perawatan Selesai - List Data";

		// $data['all_pengadaan_barang'] = $this->jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('perawatan_barang_selesai/data', $data);
	}

	public function data_search_perawatan($page=0, $search='')
	{
		if(check_privilege('perawatan_barang_selesai', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_perawatan_selesai'] = $this->jenis_barang_model->data_perawatan_selesai($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->jenis_barang_model->count_all_perawatan_selesai($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_perawatan_selesai'] = $this->jenis_barang_model->data_perawatan_selesai($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->jenis_barang_model->count_all_perawatan_selesai($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$data['is_update'] = (check_privilege('perawatan_barang_selesai', 'is_update') != TRUE ? 'hidden' : '');

		$this->load->view('perawatan_barang_selesai/data-search', $data);
	}

	public function edit($id)
	{
		if(check_privilege('perawatan_barang_selesai', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$this->load->helper(array('form', 'url'));
		$data['title'] = "Perawatan Barang Selesai";
		$data['menu_title'] = "Perawatan Barang Selesai - Edit";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			 $config['upload_path']          = './uploads/perawatan_barang/perawatan_selesai/';
             $config['allowed_types']        = 'gif|jpg|png';
             $config['max_size']             = 2000;

             $this->load->library('upload', $config);
             if ( ! $this->upload->do_upload('bukti_foto_sesudah'))
             {
                $message = $this->upload->display_errors();
             }
             else
             {
                $data_image = $this->upload->data();
                // echo "<pre>";print_r($data_image);echo "</pre>";exit;
             }

			$data_request = array(
					'status'				=> 'S',
					'tgl_selesai'			=> date('Y-m-d H:i:s'),
					'keterangan_selesai'	=> $post['keterangan_selesai'],
					'bukti_foto_sesudah'	=> $data_image['file_name'],
				);
			$update_perawatan = $this->jenis_barang_model->update_perawatan_barang($id, $data_request);
			if($update_perawatan == TRUE){
				$_SESSION['update_perawatan']['message_color'] = "green";
				$_SESSION['update_perawatan']['message'] = "Berhasil melakukan perawatan barang";
				redirect('perawatan_barang_selesai');
			} else{
				$_SESSION['update_perawatan']['message_color'] = "red";
				$_SESSION['update_perawatan']['message'] = "Gagal melakukan perawatan barang. Silahkan coba kembali nanti.";
				redirect('perawatan_barang_selesai');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->jenis_barang_model->all_barang();
			$data['detail_request'] = $this->jenis_barang_model->detail_perawatan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['detail_request']);echo "</pre>";exit;
		}

		$this->load->view('perawatan_barang_selesai/edit', $data);
	}

	public function print_data()
	{
		$data['title'] = "Print Data Perawatan Barang";

		if(check_privilege('perawatan_barang', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}
		$data['all_perawatan_selesai'] = $this->jenis_barang_model->data_perawatan_selesai($id_user);
		
		$this->load->view('perawatan_barang_selesai/print-data', $data);
	}
}
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	