<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('dashboard', $data);
	}

	public function load_unread_notif($id_user)
	{
		$data['title'] = "Unread Notif";
		$notif_list = notif_list($id_user);
		$data['new_notif_updates'] = $notif_list['notif_updates'];
		$this->load->view('notif-unread', $data);
	}
}
