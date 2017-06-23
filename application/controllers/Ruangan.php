<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(left_menu());
		$this->load->model('ruangan_model');
    }

	public function index()
	{
		$data['title'] = "Ruangan";
		$data['menu_title'] = "Nama Ruangan - List Data";

		$this->load->view('ruangan/data', $data);
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
			$data['all_ruangan'] = $this->ruangan_model->data_ruangan($limit, $offset, $search);
			$all_pages = $this->ruangan_model->count_all_ruangan($search);
		} else{
			$data['all_ruangan'] = $this->ruangan_model->data_ruangan($limit, $offset);
			$all_pages = $this->ruangan_model->count_all_ruangan();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('ruangan/data-search', $data);
	}

	public function add()
	{
		$data['title'] = "Ruangan";
		$data['menu_title'] = "Nama Ruangan - Add Ruangan";

		$data['getKodeRuangan'] = getKodeRuangan();

		$post = $this->input->post();
		if($post){
			$data_ruangan = array(
					'kode_ruangan'	=> $post['kode_ruangan'],
					'nama_ruangan'	=> $post['nama_ruangan'],
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user']
				);
			$add_ruangan = $this->ruangan_model->add_ruangan($data_ruangan);
			if($add_ruangan != 0){
				$_SESSION['ruangan']['message_color'] = "green";
				$_SESSION['ruangan']['message'] = "Berhasil menambahkan ruangan";
				redirect('ruangan');
			} else{
				$_SESSION['ruangan']['message_color'] = "red";
				$_SESSION['ruangan']['message'] = "Gagal menambahkan ruangan. Silahkan coba kembali nanti.";
				redirect('ruangan');
			}
		}

		$this->load->view('ruangan/add', $data);
	}

	public function edit($id)
	{
		$data['title'] = "Ruangan";
		$data['menu_title'] = "Nama Ruangan - Edit Ruangan";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_ruangan = array(
					'kode_ruangan'	=> $post['kode_ruangan'],
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
