<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_security extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(left_menu());
		$this->load->model('petugas_model');
    }

	public function index()
	{
		$data['title'] = "Petugas Security";
		$data['menu_title'] = "Petugas Security - List Data";

		$this->load->view('petugas-security/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		$tipe_petugas = 2;
		$search = urldecode($search);

		$offset = 2;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_petugas'] = $this->petugas_model->data_petugas($tipe_petugas, $limit, $offset, $search);
			$all_pages = $this->petugas_model->count_all_petugas($tipe_petugas, $search);
		} else{
			$data['all_petugas'] = $this->petugas_model->data_petugas($tipe_petugas, $limit, $offset);
			$all_pages = $this->petugas_model->count_all_petugas($tipe_petugas);
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('petugas-security/data-search', $data);
	}

	public function add()
	{
		$data['title'] = "Petugas Security";
		$data['menu_title'] = "Petugas Security - Add Petugas Security";

		$data['getKodePetugas'] = getKodePetugas();

		$post = $this->input->post();
		if($post){
			$data_petugas = array(
					'petugas_tipe_id'	=> 2,
					'kode_petugas'	=> $post['kode_petugas'],
					'nama_petugas'	=> $post['nama_petugas'],
					'jns_kelamin'	=> $post['jns_kelamin'],
					'no_telp'		=> $post['no_telp'],
					'alamat'		=> $post['alamat'],
					'created'		=> date('Y-m-d H:i:s'),
					'create_by'		=> $_SESSION['login']['id_user']
				);
			$add_petugas = $this->petugas_model->add_petugas($data_petugas);
			if($add_petugas != 0){
				$_SESSION['petugas']['message_color'] = "green";
				$_SESSION['petugas']['message'] = "Berhasil menambahkan petugas security";
				redirect('petugas_security');
			} else{
				$_SESSION['petugas']['message_color'] = "red";
				$_SESSION['petugas']['message'] = "Gagal menambahkan petugas security. Silahkan coba kembali nanti.";
				redirect('petugas_security');
			}
		}

		$this->load->view('petugas-security/add', $data);
	}

	public function edit($id)
	{
		$data['title'] = "Petugas Security";
		$data['menu_title'] = "Petugas Security - Edit Petugas Security";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_petugas = array(
					'nama_petugas'	=> $post['nama_petugas'],
					'jns_kelamin'	=> $post['jns_kelamin'],
					'no_telp'		=> $post['no_telp'],
					'alamat'		=> $post['alamat'],
					'modified'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user']
				);
			$update_petugas = $this->petugas_model->update_petugas($id, $data_petugas);
			if($update_petugas == TRUE){
				$_SESSION['petugas']['message_color'] = "green";
				$_SESSION['petugas']['message'] = "Berhasil edit data petugas security";
				redirect('petugas_security');
			} else{
				$_SESSION['petugas']['message_color'] = "red";
				$_SESSION['petugas']['message'] = "Gagal edit data petugas security. Silahkan coba kembali nanti.";
				redirect('petugas_security');
			}
		} else{
			$data['detail_petugas'] = $this->petugas_model->detail_petugas($id);
		}

		$this->load->view('petugas-security/edit', $data);
	}

	public function delete($id)
	{
		$delete_petugas = $this->petugas_model->delete_petugas($id);

		if($delete_petugas == TRUE){
			$_SESSION['petugas']['message_color'] = "green";
			$_SESSION['petugas']['message'] = "Berhasil hapus data petugas security";
			redirect('petugas_security');
		} else{
			$_SESSION['petugas']['message_color'] = "red";
			$_SESSION['petugas']['message'] = "Gagal hapus data petugas security. Silahkan coba kembali nanti.";
			redirect('petugas_security');
		}
	}
}
