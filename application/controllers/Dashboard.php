<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
        if ( !isset($_SESSION['login']) ) {
			redirect('login'); 
		}
		$this->load->vars(left_menu());
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->load->view('dashboard', $data);
	}
}
