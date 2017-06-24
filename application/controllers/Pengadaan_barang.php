<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(left_menu());
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
					'id_user'		=> $_SESSION['login']['id_user'],
					'created'		=> date('Y-m-d H:i:s')
				);
			$add_pengadaan_barang = $this->Jenis_barang_model->add_pengadaan_barang(array_merge($post, $data_pengadaan_barang));
			if($add_booking_ruangan != 0){
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
		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Nama Ruangan - Edit Ruangan";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_ruangan = array(
					'nama_ruangan'	=> $post['nama_ruangan'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_ruangan = $this->ruangan_model->update_ruangan($id, $data_ruangan);
			if($update_ruangan == TRUE){
				$_SESSION['ruangan']['message_color'] = "green";
				$_SESSION['ruangan']['message'] = "Berhasil edit data ruangan";
				redirect('ruangan');
			} else{
				$_SESSION['ruangan']['message_color'] = "red";
				$_SESSION['ruangan']['message'] = "Gagal edit data ruangan. Silahkan coba kembali nanti.";
				redirect('ruangan');
			}
		} else{
			$data['detail_ruangan'] = $this->ruangan_model->detail_ruangan($id);
		}

		$this->load->view('ruangan/edit', $data);
	}

	public function delete($id)
	{
		$delete_ruangan = $this->ruangan_model->delete_ruangan($id);

		if($delete_ruangan == TRUE){
			$_SESSION['ruangan']['message_color'] = "green";
			$_SESSION['ruangan']['message'] = "Berhasil hapus data ruangan";
			redirect('ruangan');
		} else{
			$_SESSION['ruangan']['message_color'] = "red";
			$_SESSION['ruangan']['message'] = "Gagal hapus data ruangan. Silahkan coba kembali nanti.";
			redirect('ruangan');
		}
	}
}
