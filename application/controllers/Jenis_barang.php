<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_barang extends CI_Controller {

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
		$data['title'] = "Jenis Barang";
		$data['menu_title'] = "Jenis Barang - List Data";

		$this->load->view('jenis_barang/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_barang'] = $this->Jenis_barang_model->data_barang($limit, $offset, $search);
			$all_pages = $this->Jenis_barang_model->count_all_barang($search);
		} else{
			$data['all_barang'] = $this->Jenis_barang_model->data_barang($limit, $offset);
			$all_pages = $this->Jenis_barang_model->count_all_barang();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('jenis_barang/data-search', $data);
	}

	public function add()
	{
		$data['title'] = "Jenis Barang";
		$data['menu_title'] = "Nama Jenis Barang - Add Jenis Barang";

		$data['getKodeBarang'] = getKodeBarang();

		$post = $this->input->post();
		if($post){
			$data_barang = array(
					'kode_jenis'	=> $post['kode_jenis'],
					'nama_jenis'	=> $post['nama_jenis'],
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$add_barang = $this->Jenis_barang_model->add_barang($data_barang);
			if($add_barang != 0){
				$_SESSION['jenis_barang']['message_color'] = "green";
				$_SESSION['jenis_barang']['message'] = "Berhasil menambahkan jenis barang";
				redirect('jenis_barang');
			} else{
				$_SESSION['jenis_barang']['message_color'] = "red";
				$_SESSION['jenis_barang']['message'] = "Gagal menambahkan jenis barang. Silahkan coba kembali nanti.";
				redirect('jenis_barang');
			}
		}

		$this->load->view('jenis_barang/add', $data);
	}

	public function edit($id)
	{
		$data['title'] = "Jenis Barang";
		$data['menu_title'] = "Nama Jenis Barang - Edit Jenis Barang";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_barang = array(
					'nama_jenis'	=> $post['nama_jenis'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_barang = $this->Jenis_barang_model->update_barang($id, $data_barang);
			if($update_barang == TRUE){
				$_SESSION['jenis_barang']['message_color'] = "green";
				$_SESSION['jenis_barang']['message'] = "Berhasil edit data jenis barang";
				redirect('jenis_barang');
			} else{
				$_SESSION['jenis_barang']['message_color'] = "red";
				$_SESSION['jenis_barang']['message'] = "Gagal edit data jenis barang. Silahkan coba kembali nanti.";
				redirect('jenis_barang');
			}
		} else{
			$data['detail_barang'] = $this->Jenis_barang_model->detail_barang($id);
		}

		$this->load->view('jenis_barang/edit', $data);
	}

	public function delete($id)
	{
		$delete_barang = $this->Jenis_barang_model->delete_barang($id);

		if($delete_barang == TRUE){
			$_SESSION['jenis_barang']['message_color'] = "green";
			$_SESSION['jenis_barang']['message'] = "Berhasil hapus data jenis barang";
			redirect('jenis_barang');
		} else{
			$_SESSION['jenis_barang']['message_color'] = "red";
			$_SESSION['jenis_barang']['message'] = "Gagal hapus data jenis barang. Silahkan coba kembali nanti.";
			redirect('jenis_barang');
		}
	}
}
