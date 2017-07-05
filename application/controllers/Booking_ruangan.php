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

		$this->load->view('booking_ruangan/data', $data);
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
		$data['limit'] = $limit;

		$data['is_update'] = (check_privilege('booking_ruangan', 'is_update') != TRUE ? 'hidden' : '');
		$data['is_delete'] = (check_privilege('booking_ruangan', 'is_delete') != TRUE ? 'hidden' : '');
		$data['is_approve'] = (check_privilege('booking_ruangan', 'is_approve') != TRUE ? 'hidden' : '');

		$this->load->view('booking_ruangan/data-search', $data);
	}

	public function approve($id, $notif_id='')
	{
		if(check_privilege('booking_ruangan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		if($notif_id != ''){
			$this->notif_model->read_notif($notif_id);
			$_SESSION['new_unread_notif_count'] = json_encode($this->notif_model->unread_notif_count($_SESSION['login']['id_user']));
		}

		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Detail - Booking Ruangan";

		$post = $this->input->post();
		if($post){
			$data_update = array(
					'status'		=> $post['status'],
					'keterangan'	=> $post['keterangan']
				);
			$update_booking_ruangan = $this->ruangan_model->update_booking_ruangan($id, $data_update);
			if($update_booking_ruangan == TRUE){
				$_SESSION['booking_ruangan']['message_color'] = "green";
				$_SESSION['booking_ruangan']['message'] = "Berhasil update status booking ruangan";
				redirect('booking_ruangan');
			} else{
				$_SESSION['booking_ruangan']['message_color'] = "red";
				$_SESSION['booking_ruangan']['message'] = "Gagal update status booking ruangan. Silahkan coba kembali nanti.";
				redirect('booking_ruangan');
			}
		} else{
			$detail_booking_ruangan = $this->ruangan_model->detail_booking_ruangan($id);
			$start_hour = new DateTime($detail_booking_ruangan['start_time']);
			$end_hour = new DateTime($detail_booking_ruangan['end_time']);
			$durasi = date_diff($start_hour, $end_hour);
			$detail_booking_ruangan['durasi'] = $durasi->h;
			$data['detail_booking_ruangan'] = $detail_booking_ruangan;

			$data['is_approve'] = (check_privilege('booking_ruangan', 'is_approve') != TRUE || $detail_booking_ruangan['status'] != 'B' ? 'hidden' : '');
		}

		$this->load->view('booking_ruangan/approve', $data);
	}

	public function add()
	{
		if(check_privilege('booking_ruangan', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Add - Booking Ruangan";

		$data['getKodeBookingRuangan'] = getKodeBookingRuangan();

		$post = $this->input->post();
		if($post){
			$start_hour = date('H:i:s', strtotime($post['start_hour'].":".$post['start_menit']));
			//$end_hour = date_format(date_add(date_create($start_hour), date_interval_create_from_date_string('+'.$post['durasi'].' hours')), 'H:i:s');
			$end_hour = date('H:i:s', strtotime($post['end_hour'].":".$post['end_menit']));
			$data_booking = array(
					'start_time'	=> $start_hour,
					'end_time'		=> $end_hour,
					'id_user'		=> $_SESSION['login']['id_user'],
					'created'		=> date('Y-m-d H:i:s')
				);
			unset($post['start_hour']);
			unset($post['start_menit']);
			unset($post['end_hour']);
			unset($post['end_menit']);
			$add_booking_ruangan = $this->ruangan_model->add_booking_ruangan(array_merge($post, $data_booking));
			if($add_booking_ruangan != 0){
				$notif_receiver = $this->notif_model->get_email_by_module('booking_ruangan');
				$notif_data = array(
						'notif_type_id'	=> 9,
						'notif_url'		=> base_url().'booking_ruangan/approve/'.md5($add_booking_ruangan)
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

		$this->load->view('booking_ruangan/add', $data);
	}

	public function edit($id)
	{
		if(check_privilege('booking_ruangan', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Booking Ruangan";
		$data['menu_title'] = "Booking Ruangan - Edit Ruangan";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$start_hour = date('H:i:s', strtotime($post['start_hour'].":".$post['start_menit']));
			//$end_hour = date_format(date_add(date_create($start_hour), date_interval_create_from_date_string('+'.$post['durasi'].' hours')), 'H:i:s');
			$end_hour = date('H:i:s', strtotime($post['end_hour'].":".$post['end_menit']));
			$data_booking = array(
					'start_time'	=> $start_hour,
					'end_time'		=> $end_hour,
					'modi_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s')
				);
			unset($post['start_hour']);
			unset($post['start_menit']);
			unset($post['end_hour']);
			unset($post['end_menit']);
			$update_booking_ruangan = $this->ruangan_model->update_booking_ruangan($id, array_merge($post, $data_booking));
			if($update_booking_ruangan == TRUE){
				$_SESSION['booking_ruangan']['message_color'] = "green";
				$_SESSION['booking_ruangan']['message'] = "Berhasil edit data booking ruangan";
				redirect('booking_ruangan');
			} else{
				$_SESSION['booking_ruangan']['message_color'] = "red";
				$_SESSION['booking_ruangan']['message'] = "Gagal edit data booking ruangan. Silahkan coba kembali nanti.";
				redirect('booking_ruangan');
			}
		} else{
			$data['data_ruangan'] = $this->ruangan_model->all_ruangan();
			$detail_booking_ruangan = $this->ruangan_model->detail_booking_ruangan($id);
			$data['detail_booking_ruangan'] = $detail_booking_ruangan;
		}

		$this->load->view('booking_ruangan/edit', $data);
	}

	public function delete($id)
	{
		if(check_privilege('booking_ruangan', 'is_delete') != TRUE){
			redirect('gate/unauthorized');
		}

		$delete_booking_ruangan = $this->ruangan_model->delete_booking_ruangan($id);

		if($delete_booking_ruangan == TRUE){
			$_SESSION['booking_ruangan']['message_color'] = "green";
			$_SESSION['booking_ruangan']['message'] = "Berhasil hapus data booking ruangan";
			redirect('booking_ruangan');
		} else{
			$_SESSION['booking_ruangan']['message_color'] = "red";
			$_SESSION['booking_ruangan']['message'] = "Gagal hapus data booking ruangan. Silahkan coba kembali nanti.";
			redirect('booking_ruangan');
		}
	}

	function check_availability()
	{
		if(check_privilege('booking_ruangan', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$post = $this->input->post();

		$tgl_book = date('Y-m-d', strtotime($post['tgl_book']));
		$start_hour = date('H:i:s', strtotime($post['start_book']));
		//$end_hour = date_format(date_add(date_create($start_hour), date_interval_create_from_date_string('+'.$post['durasi'].' hours')), 'H:i:s');
		$end_hour = date('H:i:s', strtotime($post['end_book']));

		$room_available = $this->ruangan_model->check_room_availability($tgl_book, $start_hour, $end_hour);

		$list_room = '';
		foreach($room_available as $room){
			$list_room .= '<option value="'.$room['id'].'">'.$room['nama_ruangan'].'</option>';
		}

		echo $list_room;
	}

	public function print_data()
	{
		$data['tes'] = "aio";
		$this->load->view('booking_ruangan/print-data', $data);
	}
}
