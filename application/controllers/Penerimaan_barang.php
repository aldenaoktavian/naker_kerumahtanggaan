<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(left_menu());
		$this->load->model('Jenis_barang_model');
		$this->load->helper(array('form', 'url','file'));
    }

	public function index()
	{	
		$data['title'] = "Penerimaan Barang";
		$data['menu_title'] = "Penerimaan Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('penerimaan_barang/data', $data);
	}

	public function data_search_penerimaan($page=0, $search='')
	{
		$search = urldecode($search);

		$offset = 2;

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

		$this->load->view('penerimaan_barang/data-search', $data);
	}

	public function edit($id)
	{
		$this->load->helper(array('form', 'url'));
		$data['title'] = "Peneriman Barang";
		$data['menu_title'] = "Peneriman Barang - Edit Peneriman Barang";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			// $config['upload_path']          = './uploads/';
   //          $config['allowed_types']        = 'gif|jpg|png';
   //          $config['max_size']             = 100;
   //          $config['max_width']            = 1024;
   //          $config['max_height']           = 768;

   //          $this->load->library('upload', $config);
   //          if ( ! $this->penerimaan_barang->do_upload('userfile'))
   //          {
   //                  $error = array('error' => $this->upload->display_errors());

   //                  $this->load->view('upload_form', $error);
   //          }
   //          else
   //          {
   //                  $data = array('upload_data' => $this->upload->data());

   //                  $this->load->view('upload_success', $data);
   //          }

			$data_request = array(
					'tgl_terima'		=> date('Y-m-d H:i:s'),
					'keterangan'	 	=> $post['jenis_barang_id'],
					'nama_barang'		=> $post['nama_barang'],
					'merk'				=> $post['merk'],
					'qty'				=> $post['qty'],
					'direktorat'		=> $post['direktorat'],
					'nama_pemesan'		=> $post['nama_pemesan'],
					'alasan_pengadaan'	=> $post['alasan_pengadaan'],
					'spesifikasi'		=> $post['spesifikasi'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$update_req_barang = $this->Jenis_barang_model->update_pengadaan_barang($id, $data_request);
			if($update_req_barang == TRUE){
				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil edit data request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal edit data request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
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
