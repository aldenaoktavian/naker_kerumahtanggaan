<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('jenis_barang_model');
		$this->load->model('notif_model');
    }

	public function index()
	{	
		if(check_privilege('pengadaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Request Barang";
		$data['menu_title'] = "Request Barang - List Data";
		
		$this->load->view('pengadaan_barang/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('pengadaan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if(check_privilege('pengadaan_barang', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}

		if($search != ''){
			$data['all_pengadaan_barang'] = $this->jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->jenis_barang_model->count_all_pengadaan_barang($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_pengadaan_barang'] = $this->jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->jenis_barang_model->count_all_pengadaan_barang($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$data['is_update'] = (check_privilege('pengadaan_barang', 'is_update') != TRUE ? 'hidden' : '');
		$data['is_delete'] = (check_privilege('pengadaan_barang', 'is_delete') != TRUE ? 'hidden' : '');
		$data['is_approve'] = (check_privilege('pengadaan_barang', 'is_approve') != TRUE ? 'hidden' : '');

		$this->load->view('pengadaan_barang/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('pengadaan_barang', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}

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
			$add_pengadaan_barang = $this->jenis_barang_model->add_pengadaan_barang(array_merge($post, $data_pengadaan_barang));
			if($add_pengadaan_barang != 0){

				if(check_privilege('pengadaan_barang', 'is_approve') == TRUE){
					$notif_receiver = $this->notif_model->get_email_by_module('pengadaan_barang');
					$notif_data = array(
							'notif_type_id'	=> 1,
							'notif_url'		=> base_url().'pengadaan_barang/approve/'.md5($add_pengadaan_barang)
						);
					saveNotif($notif_data, $notif_receiver);
				} else{
					$notif_receiver = $this->notif_model->get_email_by_module('pengadaan_barang');
					$notif_data = array(
							'notif_type_id'	=> 1,
							'notif_url'		=> base_url().'pengadaan_barang/index/'.md5($add_pengadaan_barang)
						);
					saveNotif($notif_data, $notif_receiver);
				}
				

				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil menambahkan request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal menambahkan request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->jenis_barang_model->all_barang();
		}

		$this->load->view('pengadaan_barang/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('pengadaan_barang', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

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
			$update_req_barang = $this->jenis_barang_model->update_pengadaan_barang($id, $data_request);
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
			$data['data_pengadaan_barang'] = $this->jenis_barang_model->all_barang();
			$data['detail_request'] = $this->jenis_barang_model->detail_pengadaan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;
		}

		$this->load->view('pengadaan_barang/edit', $data);
	}

	public function delete($id)
	{
		$delete_pengadaan_baran = $this->jenis_barang_model->delete_pengadaan_baran($id);

		if($delete_pengadaan_baran == TRUE){
			$_SESSION['pengadaan_barang']['message_color'] = "green";
			$_SESSION['pengadaan_barang']['message'] = "Berhasil hapus data request barang";
			redirect('pengadaan_barang');
		} else{
			$_SESSION['pengadaan_barang']['message_color'] = "red";
			$_SESSION['pengadaan_barang']['message'] = "Gagal hapus data request barang. Silahkan coba kembali nanti.";
			redirect('pengadaan_barang');
		}
	}

	public function approve($id, $notif_id='')
	{
		if(check_privilege('pengadaan_barang', 'is_approve') != TRUE){
			redirect('gate/unauthorized');
		}

		if($notif_id != ''){
			$this->notif_model->read_notif($notif_id);
			$_SESSION['new_unread_notif_count'] = json_encode($this->notif_model->unread_notif_count($_SESSION['login']['id_user']));
		}

		$data['title'] = "Request Barang";
		$data['menu_title'] = "Request Barang - Approve";
		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_request = array(
					'status'			=> $post['status'],
					'keterangan'		=> $post['alasan_reject'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$update_pengadaan_barang = $this->jenis_barang_model->update_pengadaan_barang($id, $data_request);
			if($update_pengadaan_barang == TRUE){
				$notif_receiver = $this->notif_model->get_email_by_module('pengadaan_barang');
				$notif_data = array(
						'notif_type_id'	=> 2,
						'notif_url'		=> base_url().'pengadaan_barang/index/'.md5($update_pengadaan_barang)
					);
				saveNotif($notif_data, $notif_receiver);
				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil update status request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal update status request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
			}
		} else{
			$data['data_pengadaan_barang'] = $this->jenis_barang_model->all_barang();
			$data['detail_request'] = $this->jenis_barang_model->detail_pengadaan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;
		}

		$this->load->view('pengadaan_barang/approve', $data);
	}
}
