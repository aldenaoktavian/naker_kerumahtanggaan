<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->session->unset_userdata('login');
    }

	public function index()
	{
		$data["msg"] = "";
		if ( isset($_SESSION['login']) ) { 
			redirect('dashboard'); 
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('user', 'Uername', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if ( $this->form_validation->run() == TRUE ) {
			$result = $this->login_model->cek_user_login(
				$this->input->post('user'),
				md5($this->input->post('pass'))
			);
			
			if ( $result != FALSE) {
				$detail_user = $this->user_model->detail_user_nomd5($result);

				$_SESSION['login']['id_user'] = $detail_user['id'];
				$_SESSION['login']['user_category'] = $detail_user['user_category_id'];
				$_SESSION['login']['nama_user'] = $detail_user['fullname'];

				redirect('dashboard');
			} else{
				$data["msg"] = "Username atau Password salah";
			}
		}

		$this->load->view('login', $data);
	}

	public function logout()
	{
		session_destroy();
		redirect('dashboard');
	}
}

?>