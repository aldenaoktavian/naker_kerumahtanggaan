<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gate extends CI_Controller {

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
		$this->load->view('dashboard', $data);
	}

	public function unauthorized()
	{
		$data['title'] = "This Page is Unauthorized";
		$this->load->view('no-auth-page', $data);
	}
}