<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_ruangan extends CI_Controller {

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
		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Booking Ruangan - List Data";

		$this->load->view('booking-ruangan/data', $data);
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
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan($_SESSION['login']['id_user'], $limit, $offset, $search);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan($_SESSION['login']['id_user'], $limit, $offset);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan($_SESSION['login']['id_user']);
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('booking-ruangan/data-search', $data);
	}

	public function add()
	{
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
