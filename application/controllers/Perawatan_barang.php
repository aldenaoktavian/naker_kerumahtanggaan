	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawatan_barang extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Jenis_barang_model');
		$this->load->model('notif_model');
    }

	public function index()
	{	
		if(check_privilege('perawatan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Perawatan Barang";
		$data['menu_title'] = "Perawatan Barang - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('perawatan_barang/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('perawatan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if(check_privilege('perawatan_barang', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}

		if($search != ''){
			$data['all_perawatan_barang'] = $this->Jenis_barang_model->data_perawatan_barang($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->Jenis_barang_model->count_all_perawatan_barang($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_perawatan_barang'] = $this->Jenis_barang_model->data_perawatan_barang($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->Jenis_barang_model->count_all_perawatan_barang($_SESSION['login']['id_user']);
		}
		
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$data['is_update'] = (check_privilege('perawatan_barang', 'is_update') != TRUE ? 'hidden' : '');
		$data['is_delete'] = (check_privilege('perawatan_barang', 'is_delete') != TRUE ? 'hidden' : '');
		$data['is_approve'] = (check_privilege('perawatan_barang', 'is_approve') != TRUE ? 'hidden' : '');

		$this->load->view('perawatan_barang/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('perawatan_barang', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Perawatan Barang";
		$data['menu_title'] = "Perawatan Barang - Add Perawatan Barang";

		$data['getKodePerawatanBarang'] = getKodePerawatanBarang();

		$post = $this->input->post();
		if($post){
			$config['upload_path']          = './uploads/perawatan_barang/';
             $config['allowed_types']        = 'gif|jpg|png';
             $config['max_size']             = 2000;

             $this->load->library('upload', $config);
             if ( ! $this->upload->do_upload('bukti_foto_sebelum'))
             {
                $message = $this->upload->display_errors();
             }
             else
             {
                $data_image = $this->upload->data();
             }

			$data_perawatan_barang = array(
					'status' 				=> 'E',
					'bukti_foto_sebelum'	=> $data_image['file_name'],
					'create_by'				=> $_SESSION['login']['id_user'],
					'created'				=> date('Y-m-d H:i:s'),
					'modi_by'				=> $_SESSION['login']['id_user'],
					'modified'				=> date('Y-m-d H:i:s')
				);
			$add_perawatan_barang = $this->Jenis_barang_model->add_perawatan_barang(array_merge($post, $data_perawatan_barang));
			if($add_perawatan_barang != 0){

				if(check_privilege('pengadaan_barang', 'is_approve') == TRUE){
					$notif_receiver = $this->notif_model->get_email_by_module('perawatan_barang');
					$notif_data = array(
							'notif_type_id'	=> 5,
							'notif_url'		=> base_url().'perawatan_barang/approve/'.md5($add_perawatan_barang)
						);
					saveNotif($notif_data, $notif_receiver);
				} else{
					$notif_receiver = $this->notif_model->get_email_by_module('perawatan_barang');
					$notif_data = array(
							'notif_type_id'	=> 5,
							'notif_url'		=> base_url().'perawatan_barang/index/'.md5($add_perawatan_barang)
						);
					saveNotif($notif_data, $notif_receiver);
				}
				
				

				$_SESSION['perawatan_barang']['message_color'] = "green";
				$_SESSION['perawatan_barang']['message'] = "Berhasil menambahkan permintaan perawatan barang";
				redirect('perawatan_barang');
			} else{
				$_SESSION['perawatan_barang']['message_color'] = "red";
				$_SESSION['perawatan_barang']['message'] = "Gagal menambahkan permintaan perawatan barang. Silahkan coba kembali nanti.";
				redirect('perawatan_barang');
			}
		} else{
			$data['data_jenis_barang'] = $this->Jenis_barang_model->all_barang();
		}

		$this->load->view('perawatan_barang/add', $data);
	}

	public function view($id)
	{
		if(check_privilege('perawatan_barang', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Data Perawatan Barang";
		$data['menu_title'] = "Data Perawatan Barang - View";

		$data['id'] = $id;

		$data['detail_request'] = $this->Jenis_barang_model->detail_perawatan_barang($id,$_SESSION['login']['id_user']);
		$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
		// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;

		$this->load->view('perawatan_barang/view', $data);
	}

	public function edit($id)
	{
		if(check_privilege('perawatan_barang', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Perawatan Barang";
		$data['menu_title'] = "Perawatan Barang - Edit Perawatan Barang";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			 $config['upload_path']          = './uploads/perawatan_barang/';
	         $config['allowed_types']        = 'gif|jpg|png';
	         $config['max_size']             = 2000;

	         $this->load->library('upload', $config);
	         if ( ! $this->upload->do_upload('bukti_foto_sebelum'))
	         {
	            $message = $this->upload->display_errors();
	         }
	         else
	         {
	            $data_image = $this->upload->data();
	         }

	         if(!isset($data_image['file_name'])){
	         	$data_request = array(
					'tgl_perawatan'			=> $post['tgl_perawatan'],
					'jenis_barang_id' 		=> $post['jenis_barang_id'],
					'nama_barang'			=> $post['nama_barang'],
					'direktorat'			=> $post['direktorat'],
					'nama_pemesan'			=> $post['nama_pemesan'],
					'alasan_perawatan'		=> $post['alasan_perawatan'],
					'lokasi'				=> $post['lokasi'],
					'usulan'				=> $post['usulan'],
					'modified'				=> date('Y-m-d H:i:s'),
					'modi_by'				=> $_SESSION['login']['id_user']
				);
	         }else{
	         	$data_request = array(
					'tgl_perawatan'			=> $post['tgl_perawatan'],
					'jenis_barang_id' 		=> $post['jenis_barang_id'],
					'nama_barang'			=> $post['nama_barang'],
					'direktorat'			=> $post['direktorat'],
					'nama_pemesan'			=> $post['nama_pemesan'],
					'alasan_perawatan'		=> $post['alasan_perawatan'],
					'lokasi'				=> $post['lokasi'],
					'usulan'				=> $post['usulan'],
					'bukti_foto_sebelum'	=> $data_image['file_name'],
					'modified'				=> date('Y-m-d H:i:s'),
					'modi_by'				=> $_SESSION['login']['id_user']
				);
	         }

			
			$update_perawatan_brg = $this->Jenis_barang_model->update_perawatan_barang($id, $data_request);
			if($update_perawatan_brg == TRUE){
				$_SESSION['perawatan_barang']['message_color'] = "green";
				$_SESSION['perawatan_barang']['message'] = "Berhasil edit data perawatan barang";
				redirect('perawatan_barang');
			} else{
				$_SESSION['perawatan_barang']['message_color'] = "red";
				$_SESSION['perawatan_barang']['message'] = "Gagal edit data perawatan barang. Silahkan coba kembali nanti.";
				redirect('perawatan_barang');
			}
		} else{
			$data['data_jenis_barang'] = $this->Jenis_barang_model->all_barang();
			$data['detail_request'] = $this->Jenis_barang_model->detail_perawatan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
			// echo "<pre>";print_r($data['jns_brg']['nama_jenis']);echo "</pre>";exit;
		}

		$this->load->view('perawatan_barang/edit', $data);
	}

	public function approve($id)
	{
		if(check_privilege('perawatan_barang', 'is_approve') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Perawatan Barang";
		$data['menu_title'] = "Perawatan Barang - Approve Perawatan Barang";
		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_status = array(
					'status'			=> $post['status'],
					'alasan_reject'		=> $post['alasan_reject'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$update_perawatan_barang = $this->Jenis_barang_model->update_perawatan_barang($id, $data_status);
			if($update_perawatan_barang == TRUE){
				$notif_receiver = $this->notif_model->get_email_by_module('perawatan_barang');
				$notif_data = array(
						'notif_type_id'	=> 6,
						'notif_url'		=> base_url().'perawatan_barang_history/indesx/'.md5($update_perawatan_barang)
					);
				saveNotif($notif_data, $notif_receiver);
				$_SESSION['perawatan_barang']['message_color'] = "green";
				$_SESSION['perawatan_barang']['message'] = "Berhasil update status perawatan barang";
				redirect('perawatan_barang');
			} else{
				$_SESSION['perawatan_barang']['message_color'] = "red";
				$_SESSION['perawatan_barang']['message'] = "Gagal update status perawatan barang. Silahkan coba kembali nanti.";
				redirect('perawatan_barang');
			}
		}else{
			$data['data_jenis_barang'] = $this->Jenis_barang_model->all_barang();
			$data['detail_request'] = $this->Jenis_barang_model->detail_perawatan_barang($id,$_SESSION['login']['id_user']);
			$data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
		}
		$this->load->view('perawatan_barang/approve', $data);
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

	public function update_terima_rawat($id){
		if(check_privilege('perawatan_barang', 'is_approve') != TRUE){
			redirect('gate/unauthorized');
		}

		$approve_perawatan = $this->Jenis_barang_model->approve_perawatan($id, 'A');
		if($approve_perawatan == TRUE){
			$_SESSION['approve_perawatan']['message_color'] = "green";
			$_SESSION['approve_perawatan']['message'] = "Berhasil dilakukan Perawatan Barang";
			redirect('perawatan_barang');
		} else{
			$_SESSION['approve_perawatan']['message_color'] = "red";
			$_SESSION['approve_perawatan']['message'] = "Gagal Perawatan Barang. Silahkan coba kembali nanti.";
			redirect('perawatan_barang');
		}
	}
}
