<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_ruangan extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('ruangan_model');
		$this->load->model('notif_model');
    }

	public function index()
	{
		if(check_privilege('booking_ruangan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Booking Ruangan - List Data";

		$this->load->view('booking-ruangan/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('booking_ruangan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$search = urldecode($search);

		$offset = 10;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if(check_privilege('booking_ruangan', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}

		if($search != ''){
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan($id_user, $limit, $offset, $search);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan($id_user, $search);
		} else{
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan($id_user, $limit, $offset);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan($id_user);
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('booking-ruangan/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('booking_ruangan', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Booking Ruangan - Add Booking Ruangan";

		$data['getKodeBookingRuangan'] = getKodeBookingRuangan();

		$post = $this->input->post();
		if($post){
			$data_booking = array(
					'id_user'		=> $_SESSION['login']['id_user'],
					'created'		=> date('Y-m-d H:i:s')
				);
			$add_booking_ruangan = $this->ruangan_model->add_booking_ruangan(array_merge($post, $data_booking));
			if($add_booking_ruangan != 0){
				$notif_receiver = $this->notif_model->get_email_by_module('booking_ruangan');
				$notif_data = array(
						'notif_type_id'	=> 9,
						'notif_url'		=> base_url().'booking_ruangan/view/'.md5($add_booking_ruangan)
					);
				saveNotif($notif_data, $notif_receiver);

				$_SESSION['booking_ruangan']['message_color'] = "green";
				$_SESSION['booking_ruangan']['message'] = "Berhasil menambahkan booking ruangan";
				redirect('booking_ruangan');
			} else{
				$_SESSION['booking_ruangan']['message_color'] = "red";
				$_SESSION['booking_ruangan']['message'] = "Gagal menambahkan booking ruangan. Silahkan coba kembali nanti.";
				redirect('booking_ruangan');
			}
		} else{
			$data['data_ruangan'] = $this->ruangan_model->all_ruangan();
		}

		$this->load->view('booking-ruangan/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('booking_ruangan', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

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
		if(check_privilege('booking_ruangan', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}

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
