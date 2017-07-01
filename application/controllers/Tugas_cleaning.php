<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_cleaning extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('Petugas_model');
    }

	public function index()
	{	
		if(check_privilege('tugas_cleaning', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Petugas Cleaning";
		$data['menu_title'] = "Petugas Cleaning - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('tugas_cleaning/data', $data);
	}

	public function data_search($page=0, $search='')
	{
		if(check_privilege('tugas_cleaning', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$search = urldecode($search);

		$offset = 2;

		if($page != 0){
			$limit = 0 + (($page - 1) * $offset);
		} else{
			$limit = 0;
		}

		if($search != ''){
			$data['all_tugas_cleaning'] = $this->Petugas_model->data_cleaning($limit, $offset, $search);
			$all_pages = $this->Petugas_model->count_all_cleaning($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_tugas_cleaning'] = $this->Petugas_model->data_cleaning($limit, $offset);
			$all_pages = $this->Petugas_model->count_all_cleaning($_SESSION['login']['id_user']);
		}

		$data['bulan'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
		$data['tahun'] = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018');
		
		// print_r($data['all_tugas_cleaning']);exit;
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('tugas_cleaning/data-search', $data);
	}

	public function add()
	{
		if(check_privilege('tugas_cleaning', 'is_insert') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Tugas Cleaning";
		$data['menu_title'] = "Tugas Cleaning - Add";

		$data['getKodeJadwalCleaning'] = getKodeJadwalCleaning();

		$post = $this->input->post();
		if($post){
			$data_cleaning = array(
					'tipe'			=> 'C',
					'kode_jadwal'	=> $post['kode_jadwal'],
					'bulan_tugas'	=> $post['bulan_tugas'],
					'tahun_tugas'	=> $post['tahun_tugas'],
					'create_by'		=> $_SESSION['login']['id_user'],
					'created'		=> date('Y-m-d H:i:s'),
					'modi_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s')
				);
			$add_jadwal = $this->Petugas_model->add_jadwal($data_cleaning);
			foreach ($post['data']['detail'] as $a => $b) {
				$detail_cleaning = array(
					'jadwal_tugas_id'	=> $add_jadwal,
					'petugas_id'		=> $b['petugas_id'],
					'lokasi'			=> $b['lokasi'],
					'create_by'			=> $_SESSION['login']['id_user'],
					'created'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user'],
					'modified'			=> date('Y-m-d H:i:s')
				);
				$add_detail_jadwal = $this->Petugas_model->add_detail_jadwal($detail_cleaning);
			}
			if($add_jadwal != 0){
				$_SESSION['tugas_cleaning']['message_color'] = "green";
				$_SESSION['tugas_cleaning']['message'] = "Berhasil menambahkan jadwal tugas cleaning";
				redirect('tugas_cleaning');
			} else{
				$_SESSION['tugas_cleaning']['message_color'] = "red";
				$_SESSION['tugas_cleaning']['message'] = "Gagal menambahkan jadwal tugas cleaning. Silahkan coba kembali nanti.";
				redirect('tugas_cleaning');
			}
		} 
		else{
			$data['bulan'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
			$data['tahun'] = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018');
			$data['data_petugas_cleaning'] = $this->Petugas_model->all_petugas_cleaning();
			// echo "<pre>";print_r($data['data_petugas_cleaning']);echo "</pre>";exit;

		}

		$this->load->view('tugas_cleaning/add', $data);
	}

	function notelp_petugas($id_petugas){
		$data['notelp'] = $this->Petugas_model->data_notelp_petugas($id_petugas);
		die(json_encode($data['notelp'][0]['no_telp']));
	}

	public function edit($id)
	{
		if(check_privilege('tugas_cleaning', 'is_update') != TRUE){
			redirect('gate/unauthorized');
		}

		$data['title'] = "Tugas Cleaning";
		$data['menu_title'] = "Tugas Cleaning - Edit";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$get_id_asli = $this->Petugas_model->detail_jadwal($id);
			$data_cleaning = array(
					'tipe'			=> 'C',
					'kode_jadwal'	=> $post['kode_jadwal'],
					'bulan_tugas'	=> $post['bulan_tugas'],
					'tahun_tugas'	=> $post['tahun_tugas'],
					'modi_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s')
				);
			$update_jadwal = $this->Petugas_model->update_jadwal($id, $data_cleaning);

			$hapus_temp_detail =$this->Petugas_model->delete_temp_detail_jadwal($id);

			foreach ($post['data']['detail'] as $a => $b) {
				$detail_cleaning = array(
					'jadwal_tugas_id'	=> $get_id_asli[0]['id'],
					'petugas_id'		=> $b['petugas_id'],
					'lokasi'			=> $b['lokasi'],
					'create_by'			=> $_SESSION['login']['id_user'],
					'created'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user'],
					'modified'			=> date('Y-m-d H:i:s')
				);
				$add_detail_jadwal = $this->Petugas_model->add_detail_jadwal($detail_cleaning);
			}
			if(($update_jadwal == TRUE) && ($add_detail_jadwal == TRUE)){
				$_SESSION['tugas_cleaning']['message_color'] = "green";
				$_SESSION['tugas_cleaning']['message'] = "Berhasil edit data jawal tugas cleaning";
				redirect('tugas_cleaning');
			} else{
				$_SESSION['tugas_cleaning']['message_color'] = "red";
				$_SESSION['tugas_cleaning']['message'] = "Gagal edit data jadwal tugas cleaning. Silahkan coba kembali nanti.";
				redirect('tugas_cleaning');
			}
		} else{
			$data['bulan'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
			$data['tahun'] = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018');
			$data['data_petugas_cleaning'] = $this->Petugas_model->all_petugas_cleaning();
			$data['cleaning'] = $this->Petugas_model->detail_jadwal($id);
			$data['detail_cleaning'] = $this->Petugas_model->detail_jadwal_detail($id);
			// echo "<pre>";print_r($data['cleaning']);echo "</pre>";exit;

		}

		$this->load->view('tugas_cleaning/edit', $data);
	}

	public function view($id)
	{
		if(check_privilege('tugas_cleaning', 'is_view') != TRUE){
			redirect('gate/unauthorized');
		}
		$data['title'] = "Tugas Cleaning";
		$data['menu_title'] = "Tugas Cleaning - View";

		$data['id'] = $id;

		$data['detail_cleaning'] = $this->Petugas_model->detail_jadwal($id);
		$data['detail_cleaning_detail'] = $this->Petugas_model->detail_jadwal_detail($id);
		foreach ($data['detail_cleaning_detail'] as $key => $value) {
			$data['detail_petugas'] = $this->Petugas_model->detail_petugas2($value['petugas_id']);
			$data['detail_cleaning_detail'][$key]['nama_petugas'] = $data['detail_petugas']['nama_petugas'];
			$data['detail_cleaning_detail'][$key]['no_telp'] = $data['detail_petugas']['no_telp'];
		}

		$data['bulan'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
		$data['tahun'] = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018');
		// $data['jns_brg'] = $this->Jenis_barang_model->detail_barang2($data['detail_request'][0]['jenis_barang_id']);
		// echo "<pre>";print_r($data['detail_cleaning_detail']);echo "</pre>";exit;

		$this->load->view('tugas_cleaning/view', $data);
	}
}
