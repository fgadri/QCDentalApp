<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	public function logout() {
		//delete the session data for logged in user
		$this->session->unset_userdata('logged_in');

		redirect('login', 'refresh');
	}
}

/* End of file */