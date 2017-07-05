<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Kendaraan_model');
    }

	public function index()
	{
		if(check_privilege('kendaraan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Kendaraan";
		$data['menu_title'] = "Kendaraan - List Data";

		$this->load->view('kendaraan/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('kendaraan', 'is_view') != TRUE){
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
			$data['all_kendaraan'] = $this->Kendaraan_model->data_kendaraan($limit, $offset, $search);
			$all_pages = $this->Kendaraan_model->count_all_kendaraan($search);
		} else{
			$data['all_kendaraan'] = $this->Kendaraan_model->data_kendaraan($limit, $offset);
			$all_pages = $this->Kendaraan_model->count_all_kendaraan();
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$data['is_view'] = (check_privilege('kendaraan', 'is_view') != TRUE ? 'hidden' : '');
		$data['is_update'] = (check_privilege('kendaraan', 'is_update') != TRUE ? 'hidden' : '');
		$data['is_delete'] = (check_privilege('kendaraan', 'is_delete') != TRUE ? 'hidden' : '');

		$this->load->view('kendaraan/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('kendaraan', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Kendaraan";
		$data['menu_title'] = "Kendaraan - Add";

		$data['getKodeKendaraan'] = getKodeKendaraan();

		$post = $this->input->post();
		if($post){
			$data_kendaraan = array(
					'kode_kendaraan'	=> $post['kode_kendaraan'],
					'jns_kendaraan_id'	=> $post['jns_kendaraan_id'],
					'merk'				=> $post['merk'],
					'tahun'				=> $post['tahun'],
					'nup'				=> $post['nup'],
					'no_pol'			=> $post['no_pol'],
					'no_mesin'			=> $post['no_mesin'],
					'no_chasis'			=> $post['no_chasis'],
					'kondisi'			=> $post['kondisi'],
					'pemegang'			=> $post['pemegang'],
					'direktorat'		=> $post['direktorat'],
					'masa_stnk'			=> $post['masa_stnk'],
					'created'			=> date('Y-m-d H:i:s'),
					'create_by'			=> $_SESSION['login']['id_user'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$add_kendaraan = $this->Kendaraan_model->add_kendaraan($data_kendaraan);
			if($add_kendaraan != 0){
				$_SESSION['kendaraan']['message_color'] = "green";
				$_SESSION['kendaraan']['message'] = "Berhasil menambahkan jenis barang";
				redirect('kendaraan');
			} else{
				$_SESSION['kendaraan']['message_color'] = "red";
				$_SESSION['kendaraan']['message'] = "Gagal menambahkan jenis barang. Silahkan coba kembali nanti.";
				redirect('kendaraan');
			}
		}else{
			$this->load->model('Jenis_kendaraan_model');
			$data['data_jenis_kendaraan'] = $this->Jenis_kendaraan_model->all_jenis_kendaraan();
		}

		$this->load->view('kendaraan/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('kendaraan', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Kendaraan";
		$data['menu_title'] = "Kendaraan - Edit";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_kendaraan = array(
					'kode_kendaraan'	=> $post['kode_kendaraan'],
					'jns_kendaraan_id'	=> $post['jns_kendaraan_id'],
					'merk'				=> $post['merk'],
					'tahun'				=> $post['tahun'],
					'nup'				=> $post['nup'],
					'no_pol'			=> $post['no_pol'],
					'no_mesin'			=> $post['no_mesin'],
					'no_chasis'			=> $post['no_chasis'],
					'kondisi'			=> $post['kondisi'],
					'pemegang'			=> $post['pemegang'],
					'direktorat'		=> $post['direktorat'],
					'masa_stnk'			=> $post['masa_stnk'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$update_kendaraan = $this->Kendaraan_model->update_kendaraan($id, $data_kendaraan);
			if($update_kendaraan == TRUE){
				$_SESSION['kendaraan']['message_color'] = "green";
				$_SESSION['kendaraan']['message'] = "Berhasil edit data jenis barang";
				redirect('kendaraan');
			} else{
				$_SESSION['kendaraan']['message_color'] = "red";
				$_SESSION['kendaraan']['message'] = "Gagal edit data jenis barang. Silahkan coba kembali nanti.";
				redirect('kendaraan');
			}
		} else{
			$data['detail_kendaraan'] = $this->Kendaraan_model->detail_kendaraan($id);
			$this->load->model('Jenis_kendaraan_model');
			$data['data_jenis_kendaraan'] = $this->Jenis_kendaraan_model->all_jenis_kendaraan();
		}

		$this->load->view('kendaraan/edit', $data);
	}

	public function view($id)
	{
		if(check_privilege('kendaraan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Data Kendaraan";
		$data['menu_title'] = "Data Kendaraan";

		$data['id'] = $id;

		$data['detail_kendaraan'] = $this->Kendaraan_model->detail_kendaraan($id,$_SESSION['login']['id_user']);
		// echo "<pre>";print_r($data['detail_kendaraan']);echo "</pre>";exit;

		$this->load->view('kendaraan/view', $data);
	}

	public function delete($id)
	{
		if(check_privilege('kendaraan', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}
		$delete_kendaraan = $this->Kendaraan_model->delete_kendaraan($id);

		if($delete_kendaraan == TRUE){
			$_SESSION['kendaraan']['message_color'] = "green";
			$_SESSION['kendaraan']['message'] = "Berhasil hapus data kendaraan";
			redirect('kendaraan');
		} else{
			$_SESSION['kendaraan']['message_color'] = "red";
			$_SESSION['kendaraan']['message'] = "Gagal hapus data kendaraan. Silahkan coba kembali nanti.";
			redirect('kendaraan');
		}
	}
}
