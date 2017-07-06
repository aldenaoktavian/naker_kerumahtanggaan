<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_ruangan_history extends CI_Controller {

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
		if(check_privilege('booking_ruangan_history', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Histori Booking Ruangan";
		$data['menu_title'] = "List Data - Histori Booking Ruangan";

		$this->load->view('booking_ruangan_history/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('booking_ruangan_history', 'is_view') != TRUE){
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
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan_history($id_user, $limit, $offset, $search);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan_history($id_user, $search);
		} else{
			$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan_history($id_user, $limit, $offset);
			$all_pages = $this->ruangan_model->count_all_booking_ruangan_history($id_user);
		}

		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;
		$data['limit'] = $limit;

		$this->load->view('booking_ruangan_history/data-search', $data);
	}

	public function view($id)
	{
		if(check_privilege('booking_ruangan_history', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Histori Booking Ruangan";
		$data['menu_title'] = "Detail - Histori Booking Ruangan";

		$detail_booking_ruangan = $this->ruangan_model->detail_booking_ruangan($id);
		$start_hour = new DateTime($detail_booking_ruangan['start_time']);
		$end_hour = new DateTime($detail_booking_ruangan['end_time']);
		$durasi = date_diff($start_hour, $end_hour);
		$detail_booking_ruangan['durasi'] = $durasi->h;
		switch ($detail_booking_ruangan['status']) {
            case 'F':
                $detail_booking_ruangan['status_keterangan'] = "Selesai";
                break;

            case 'C':
                $detail_booking_ruangan['status_keterangan'] = "Dibatalkan";
                break;
            
            default:
                $detail_booking_ruangan['status_keterangan'] = "Terbooking";
                break;
        };
        $detail_booking_ruangan['is_canceled'] = ($detail_booking_ruangan['status'] != 'C' ? 'hidden' : '');
		$data['detail_booking_ruangan'] = $detail_booking_ruangan;

		$this->load->view('booking_ruangan_history/view', $data);
	}

	public function print_data()
	{
		$data['title'] = "Print Booking Ruangan";

		if(check_privilege('booking_ruangan', 'is_approve') == TRUE){
			$id_user = 0;
		} else{
			$id_user = $_SESSION['login']['id_user'];
		}
		$data['all_booking_ruangan'] = $this->ruangan_model->data_booking_ruangan_history($id_user);
		
		$this->load->view('booking_ruangan_history/print-data', $data);
	}
}
