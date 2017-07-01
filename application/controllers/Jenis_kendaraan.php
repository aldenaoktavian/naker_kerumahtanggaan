<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kendaraan extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Jenis_kendaraan_model');
    }

	public function index()
	{
		if(check_privilege('jenis_kendaraan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Jenis Kendaraan";
		$data['menu_title'] = "Jenis Kendaraan - List Data";

		$this->load->view('jenis_kendaraan/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('jenis_kendaraan', 'is_view') != TRUE){
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
			$data['all_jenis_kendaraan'] = $this->Jenis_kendaraan_model->data_jenis_kendaraan($limit, $offset, $search);
			$all_pages = $this->Jenis_kendaraan_model->count_all_jenis_kendaraan($search);
		} else{
			$data['all_jenis_kendaraan'] = $this->Jenis_kendaraan_model->data_jenis_kendaraan($limit, $offset);
			$all_pages = $this->Jenis_kendaraan_model->count_all_jenis_kendaraan();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('jenis_kendaraan/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('jenis_kendaraan', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Jenis Kendaraan";
		$data['menu_title'] = "Nama Jenis Kendaraan - Add Jenis Kendaraan";

		$data['getKodeJenisKendaraan'] = getKodeJenisKendaraan();

		$post = $this->input->post();
		if($post){
			$data_jenis_kendaraan = array(
					'kode_jenis'	=> $post['kode_jenis'],
					'nama_jenis'	=> $post['nama_jenis'],
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$add_jenis_kendaraan = $this->Jenis_kendaraan_model->add_jenis_kendaraan($data_jenis_kendaraan);
			if($add_jenis_kendaraan != 0){
				$_SESSION['jenis_kendaraan']['message_color'] = "green";
				$_SESSION['jenis_kendaraan']['message'] = "Berhasil menambahkan jenis kendaraan";
				redirect('jenis_kendaraan');
			} else{
				$_SESSION['jenis_kendaraan']['message_color'] = "red";
				$_SESSION['jenis_kendaraan']['message'] = "Gagal menambahkan jenis kendaraan. Silahkan coba kembali nanti.";
				redirect('jenis_kendaraan');
			}
		}

		$this->load->view('jenis_kendaraan/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('jenis_kendaraan', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Jenis Kendaraan";
		$data['menu_title'] = "Nama Jenis Kendaraan - Edit Jenis Kendaraan";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_jenis_kendaraan = array(
					'nama_jenis'	=> $post['nama_jenis'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_jenis_kendaraan = $this->Jenis_kendaraan_model->update_jenis_kendaraan($id, $data_jenis_kendaraan);
			if($update_jenis_kendaraan == TRUE){
				$_SESSION['jenis_kendaraan']['message_color'] = "green";
				$_SESSION['jenis_kendaraan']['message'] = "Berhasil edit data jenis barang";
				redirect('jenis_kendaraan');
			} else{
				$_SESSION['jenis_kendaraan']['message_color'] = "red";
				$_SESSION['jenis_kendaraan']['message'] = "Gagal edit data jenis barang. Silahkan coba kembali nanti.";
				redirect('jenis_kendaraan');
			}
		} else{
			$data['detail_jenis_kendaraan'] = $this->Jenis_kendaraan_model->detail_jenis_kendaraan($id);
		}

		$this->load->view('jenis_kendaraan/edit', $data);
	}

	public function delete($id)
	{
		if(check_privilege('jenis_kendaraan', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}
		$delete_jenis_kendaraan = $this->Jenis_kendaraan_model->delete_jenis_kendaraan($id);

		if($delete_jenis_kendaraan == TRUE){
			$_SESSION['jenis_kendaraan']['message_color'] = "green";
			$_SESSION['jenis_kendaraan']['message'] = "Berhasil hapus data jenis kendaraan";
			redirect('jenis_kendaraan');
		} else{
			$_SESSION['jenis_kendaraan']['message_color'] = "red";
			$_SESSION['jenis_kendaraan']['message'] = "Gagal hapus data jenis kendaraan. Silahkan coba kembali nanti.";
			redirect('jenis_kendaraan');
		}
	}
}
