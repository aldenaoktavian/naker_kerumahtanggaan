<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_barang extends CI_Controller {

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
		$data['title'] = "Request Barang";
		$data['menu_title'] = "Request Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('pengadaan_barang/data', $data);
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
			$data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->Jenis_barang_model->count_all_pengadaan_barang($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->Jenis_barang_model->count_all_pengadaan_barang($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('pengadaan_barang/data-search', $data);
	}

	public function add()
	{
		$data['title'] = "Request Barang";
		$data['menu_title'] = "Request Barang - Add Request Barang";

		$data['getKodePengadaanBarang'] = getKodePengadaanBarang();

		$post = $this->input->post();
		if($post){
			$data_pengadaan_barang = array(
					'status' 		=> 'E',
					'create_by'		=> $_SESSION['login']['id_user'],
					'created'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s')
				);
			$add_pengadaan_barang = $this->Jenis_barang_model->add_pengadaan_barang(array_merge($post, $data_pengadaan_barang));
			if($add_pengadaan_barang != 0){
				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil menambahkan request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal menambahkan request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->Jenis_barang_model->all_barang();
		}

		$this->load->view('pengadaan_barang/add', $data);
	}

	public function edit($id)
	{
		$data['title'] = "Request Barang";
		$data['menu_title'] = "Request Barang - Edit";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_request = array(
					'tgl_pengadaan'		=> $post['tgl_pengadaan'],
					'jenis_barang_id' 	=> $post['jenis_barang_id'],
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

		$this->load->view('pengadaan_barang/edit', $data);
	}

	// public function delete($id)
	// {
	// 	$delete_req = $this->Jenis_barang_model->delete_ruangan($id);

	// 	if($delete_ruangan == TRUE){
	// 		$_SESSION['ruangan']['message_color'] = "green";
	// 		$_SESSION['ruangan']['message'] = "Berhasil hapus data ruangan";
	// 		redirect('ruangan');
	// 	} else{
	// 		$_SESSION['ruangan']['message_color'] = "red";
	// 		$_SESSION['ruangan']['message'] = "Gagal hapus data ruangan. Silahkan coba kembali nanti.";
	// 		redirect('ruangan');
	// 	}
	// }

	public function approve($id)
	{
		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_request = array(
					'status'			=> 'R',
					'remark'			=> $post['alasan_reject'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$approve_penerimaan = $this->Jenis_barang_model->approve_penerimaan($id, 'R', $data_request);
			if($approve_penerimaan == TRUE){
				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil reject request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal reject request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->Jenis_barang_model->all_barang();
			$data['detail_request'] = $this->Jenis_barang_model->detail_pengadaan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;
		}

		$this->load->view('pengadaan_barang/approve', $data);
	}

	public function update_terima($id){
		$approve_penerimaan = $this->Jenis_barang_model->approve_penerimaan($id, 'A');
		if($approve_penerimaan == TRUE){
			$_SESSION['pengadaan_barang']['message_color'] = "green";
			$_SESSION['pengadaan_barang']['message'] = "Berhasil dilakukan Penerimaan Barang";
			redirect('pengadaan_barang');
		} else{
			$_SESSION['pengadaan_barang']['message_color'] = "red";
			$_SESSION['pengadaan_barang']['message'] = "Gagal Penerimaan Barang. Silahkan coba kembali nanti.";
			redirect('pengadaan_barang');
		}
	}
}
