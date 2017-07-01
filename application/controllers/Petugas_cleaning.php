<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_cleaning extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('petugas_model');
		$this->load->model('notif_model');
    }

	public function index()
	{
		if(check_privilege('petugas_cleaning', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Petugas Cleaning";
		$data['menu_title'] = "Petugas Cleaning - List Data";

		$this->load->view('petugas-cleaning/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('petugas_cleaning', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$tipe_petugas = 1;
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

		$this->load->view('petugas-cleaning/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('petugas_cleaning', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Petugas Cleaning";
		$data['menu_title'] = "Petugas Cleaning - Add Petugas Cleaning";

		$data['getKodePetugas'] = getKodePetugas();

		$post = $this->input->post();
		if($post){
			$data_petugas = array(
					'petugas_tipe_id'	=> 1,
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
				$_SESSION['petugas']['message'] = "Berhasil menambahkan petugas cleaning";
				redirect('petugas_cleaning');
			} else{
				$_SESSION['petugas']['message_color'] = "red";
				$_SESSION['petugas']['message'] = "Gagal menambahkan petugas cleaning. Silahkan coba kembali nanti.";
				redirect('petugas_cleaning');
			}
		}

		$this->load->view('petugas-cleaning/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('petugas_cleaning', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Petugas Cleaning";
		$data['menu_title'] = "Petugas Cleaning - Edit Petugas Cleaning";

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
				$_SESSION['petugas']['message'] = "Berhasil edit data petugas cleaning";
				redirect('petugas_cleaning');
			} else{
				$_SESSION['petugas']['message_color'] = "red";
				$_SESSION['petugas']['message'] = "Gagal edit data petugas cleaning. Silahkan coba kembali nanti.";
				redirect('petugas_cleaning');
			}
		} else{
			$data['detail_petugas'] = $this->petugas_model->detail_petugas($id);
		}

		$this->load->view('petugas-cleaning/edit', $data);
	}

	public function delete($id)
	{
		if(check_privilege('petugas_cleaning', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}
		$delete_petugas = $this->petugas_model->delete_petugas($id);

		if($delete_petugas == TRUE){
			$_SESSION['petugas']['message_color'] = "green";
			$_SESSION['petugas']['message'] = "Berhasil hapus data petugas cleaning";
			redirect('petugas_cleaning');
		} else{
			$_SESSION['petugas']['message_color'] = "red";
			$_SESSION['petugas']['message'] = "Gagal hapus data petugas cleaning. Silahkan coba kembali nanti.";
			redirect('petugas_cleaning');
		}
	}
}
