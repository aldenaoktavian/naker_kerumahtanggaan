<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gate extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(load_default());
		$this->load->model('notif_model');
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('dashboard', $data);
	}

	public function unauthorized()
	{
		$data['title'] = "This Page is Unauthorized";
		$this->load->view('no-auth-page', $data);
	}

	public function all_notification()
	{
		$data['title'] = "Notifikasi";
		$data['menu_title'] = "Notifikasi";

		$notif_list = notif_list(0, 0, 10);
		$data['notif_list'] = $notif_list['notif_updates'];

		$this->load->view('all_notif', $data);
	}
}