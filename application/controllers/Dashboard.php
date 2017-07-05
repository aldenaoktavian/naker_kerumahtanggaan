<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
    }

	public function index()
	{
		$data['title'] = "Dashboard";

		$this->load->model('jenis_barang_model');

		if(check_privilege('pengadaan_barang', 'is_insert') == TRUE || check_privilege('pengadaan_barang', 'is_view') == TRUE || check_privilege('pengadaan_barang', 'is_update') == TRUE){
			$data['ongoing_pengadaan_barang'] = $this->jenis_barang_model->ongoing_pengadaan_barang(check_privilege('pengadaan_barang', 'is_approve'));
		}

		if(check_privilege('penerimaan_barang', 'is_insert') == TRUE || check_privilege('penerimaan_barang', 'is_view') == TRUE || check_privilege('penerimaan_barang', 'is_update') == TRUE){
			$data['ongoing_penerimaan_barang'] = $this->jenis_barang_model->ongoing_penerimaan_barang(check_privilege('penerimaan_barang', 'is_approve'));
		}

		if(check_privilege('perawatan_barang', 'is_insert') == TRUE || check_privilege('perawatan_barang', 'is_view') == TRUE || check_privilege('perawatan_barang', 'is_update') == TRUE){
			$data['ongoing_perawatan_barang'] = $this->jenis_barang_model->ongoing_perawatan_barang(check_privilege('perawatan_barang', 'is_approve'));
		}
		
		if(check_privilege('perawatan_barang_selesai', 'is_insert') == TRUE || check_privilege('perawatan_barang_selesai', 'is_view') == TRUE || check_privilege('perawatan_barang_selesai', 'is_update') == TRUE){
			$data['ongoing_perawatan_selesai'] = $this->jenis_barang_model->ongoing_perawatan_selesai(check_privilege('perawatan_barang_selesai', 'is_approve'));
		}
		

		$this->load->model('kendaraan_model');

		if(check_privilege('perpanjangan_stnk', 'is_insert') == TRUE || check_privilege('perpanjangan_stnk', 'is_view') == TRUE || check_privilege('perpanjangan_stnk', 'is_update') == TRUE){
			$data['ongoing_perpanjangan_stnk'] = $this->kendaraan_model->ongoing_perpanjangan_stnk();
		}

		$this->load->model('ruangan_model');

		if(check_privilege('booking_ruangan', 'is_insert') == TRUE || check_privilege('booking_ruangan', 'is_view') == TRUE || check_privilege('booking_ruangan', 'is_update') == TRUE){
			$data['ongoing_booking_ruangan'] = $this->ruangan_model->ongoing_booking_ruangan(check_privilege('booking_ruangan', 'is_approve'));
		}

		$this->load->view('dashboard', $data);
	}
}
