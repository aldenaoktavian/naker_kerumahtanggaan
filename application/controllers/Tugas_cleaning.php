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
		$data['title'] = "Petugas Cleaning";
		$data['menu_title'] = "Petugas Cleaning - List Data";

		// $data['all_pengadaan_barang'] = $this->Jenis_barang_model->data_pengadaan_barang($_SESSION['login']['id_user'], 20, 5);
		// print_r($data);exit;

		$this->load->view('tugas_cleaning/data', $data);
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
			$data['all_tugas_cleaning'] = $this->Petugas_model->data_cleaning($limit, $offset, $search);
			$all_pages = $this->Petugas_model->count_all_cleaning($_SESSION['login']['id_user'], $search);
		} else{
			$data['all_tugas_cleaning'] = $this->Petugas_model->data_cleaning($limit, $offset);
			$all_pages = $this->Petugas_model->count_all_cleaning($_SESSION['login']['id_user']);
		}
		
		// print_r($data['all_tugas_cleaning']);exit;
		$pages = ($all_pages % $offset == 0 ? $all_pages / $offset : ($all_pages / $offset)+1 );
		$data['pages'] = (int)$pages;
		$data['currentPage'] = $page;

		$this->load->view('tugas_cleaning/data-search', $data);
	}

	public function add()
	{
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
			$add_cleaning = $this->Petugas_model->add_cleaning($data_cleaning);
			foreach ($post['data']['detail'] as $a => $b) {
				$detail_cleaning = array(
					'jadwal_tugas_id'	=> $add_cleaning,
					'petugas_id'		=> $b['petugas_id'],
					'lokasi'			=> $b['lokasi'],
					'create_by'			=> $_SESSION['login']['id_user'],
					'created'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user'],
					'modified'			=> date('Y-m-d H:i:s')
				);
				$add_detail_cleaning = $this->Petugas_model->add_detail_cleaning($detail_cleaning);
			}
			if($add_cleaning != 0){
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
		$data['title'] = "Tugas Cleaning";
		$data['menu_title'] = "Tugas Cleaning - Edit";

		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_cleaning = array(
					'tipe'			=> 'C',
					'kode_jadwal'	=> $post['kode_jadwal'],
					'bulan_tugas'	=> $post['bulan_tugas'],
					'tahun_tugas'	=> $post['tahun_tugas'],
					'modi_by'		=> $_SESSION['login']['id_user'],
					'modified'		=> date('Y-m-d H:i:s')
				);
			$update_cleaning = $this->Petugas_model->update_cleaning($id, $data_cleaning);
			foreach ($post['data']['detail'] as $a => $b) {
				$detail_cleaning = array(
					'jadwal_tugas_id'	=> $add_cleaning,
					'petugas_id'		=> $b['petugas_id'],
					'lokasi'			=> $b['lokasi'],
					'create_by'			=> $_SESSION['login']['id_user'],
					'created'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user'],
					'modified'			=> date('Y-m-d H:i:s')
				);
				$add_detail_cleaning = $this->Petugas_model->add_detail_cleaning($detail_cleaning);
			}
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
			$data['bulan'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
			$data['tahun'] = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018');
			$data['data_petugas_cleaning'] = $this->Petugas_model->all_petugas_cleaning();
			$data['cleaning'] = $this->Petugas_model->detail_cleaning($id);
			$data['detail_cleaning'] = $this->Petugas_model->detail_cleaning_detail($id);
		}

		$this->load->view('pengadaan_barang/edit', $data);
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

	public function edit_admin($id)
	{
		$data['id'] = $id;

		$post = $this->input->post();
		if($post){
			$data_request = array(
					'status'			=> 'R',
					'remark'			=> $post['alasan_reject'],
					'modified'			=> date('Y-m-d H:i:s'),
					'modi_by'			=> $_SESSION['login']['id_user']
				);
			$approve_penerimaan = $this->Jenis_barang_model->approve_penerimaan($id, 'R', $data_request);
			if($approve_penerimaan == TRUE){
				$_SESSION['pengadaan_barang']['message_color'] = "green";
				$_SESSION['pengadaan_barang']['message'] = "Berhasil reject request barang";
				redirect('pengadaan_barang');
			} else{
				$_SESSION['pengadaan_barang']['message_color'] = "red";
				$_SESSION['pengadaan_barang']['message'] = "Gagal reject request barang. Silahkan coba kembali nanti.";
				redirect('pengadaan_barang');
			}
		} 
	}

	public function update_terima($id){
		$approve_penerimaan = $this->Jenis_barang_model->approve_penerimaan($id, 'A');
		if($approve_penerimaan == TRUE){
			$_SESSION['pengadaan_barang']['message_color'] = "green";
			$_SESSION['pengadaan_barang']['message'] = "Berhasil dilakukan Penerimaan Barang";
			redirect('pengadaan_barang');
		} else{
			$_SESSION['pengadaan_barang']['message_color'] = "red";
			$_SESSION['pengadaan_barang']['message'] = "Gagal Penerimaan Barang. Silahkan coba kembali nanti.";
			redirect('pengadaan_barang');
		}
	}
}
