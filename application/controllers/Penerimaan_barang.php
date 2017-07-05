<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Jenis_barang_model');
		$this->load->helper(array('form', 'url','file'));
    }

	public function index()
	{	
		if(check_privilege('penerimaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Penerimaan Barang";
		$data['menu_title'] = "Penerimaan Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('penerimaan_barang/data', $data);
	}

	public function data_search_penerimaan($page=0, $search='')
	{
		if(check_privilege('penerimaan_barang', 'is_view') != TRUE){
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
			$data['all_penerimaan_barang'] = $this->Jenis_barang_model->data_penerimaan_barang($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->Jenis_barang_model->count_all_penerimaan_barang($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_penerimaan_barang'] = $this->Jenis_barang_model->data_penerimaan_barang($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->Jenis_barang_model->count_all_penerimaan_barang($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$data['is_update'] = (check_privilege('penerimaan_barang', 'is_update') != TRUE ? 'hidden' : '');

		$this->load->view('penerimaan_barang/data-search', $data);
	}

	public function edit($id)
	{
		if(check_privilege('penerimaan_barang', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$this->load->helper(array('form', 'url'));
		$data['title'] = "Peneriman Barang";
		$data['menu_title'] = "Peneriman Barang - Edit Peneriman Barang";

		$data['id'] = $id;
		$error = 0;

		$post = $this->input->post();
		if($post){
			 $config['upload_path']          = './uploads/penerimaan_barang/';
             $config['allowed_types']        = 'gif|jpg|png';
             $config['max_size']             = 2000;

             $this->load->library('upload', $config);
             if ( ! $this->upload->do_upload('bukti_foto'))
             {
                $message = $this->upload->display_errors();
             }
             else
             {
                $data_image = $this->upload->data();
                // echo "<pre>";print_r($data_image);echo "</pre>";exit;
             }

             if(!isset($data_image['file_name'])){
             	$error = 1;
             	$_SESSION['penerimaan_barang']['message_color'] = "red";
				$_SESSION['penerimaan_barang']['message'] = "Silahkan isi data diri secara lengkap.";
				redirect('penerimaan_barang');
             }
			$data_request = array(
					'status'			=> 'S',
					'tgl_terima'		=> date('Y-m-d H:i:s'),
					'keterangan'	 	=> $post['keterangan'],
					'bukti_foto'		=> $data_image['file_name'],
				);
			$update_penerimaan = $this->Jenis_barang_model->update_penerimaan($id, $data_request);
			if($update_penerimaan == TRUE){
				$_SESSION['penerimaan_barang']['message_color'] = "green";
				$_SESSION['penerimaan_barang']['message'] = "Berhasil melakukan penerimaan barang";
				redirect('penerimaan_barang');
			} else{
				$_SESSION['penerimaan_barang']['message_color'] = "red";
				$_SESSION['penerimaan_barang']['message'] = "Gagal melakukan penerimaan barang. Silahkan coba kembali nanti.";
				redirect('penerimaan_barang');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->Jenis_barang_model->all_barang();
			$data['detail_request'] = $this->Jenis_barang_model->detail_pengadaan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;
		}

		$this->load->view('penerimaan_barang/edit', $data);
	}
}
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	