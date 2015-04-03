<?php
/* THIS IS JUST FOR DEMO PURPOSES. DELETE THIS FILE BEFORE FINAL */

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Test extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		//check for the existance of the logged in user session data
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');

			//$data['username'] = $session_data['username'];

			//var_dump($session_data);

			$this->load->view('templates/header');
			$this->load->view('test_view', $session_data);
			$this->load->view('templates/footer');
		}
		else {
			//redirect to the login page
			redirect('login', 'refresh');
		}
	}

	public function logout() {
		//delete the session data for logged in user
		$this->session->unset_userdata('logged_in');

		redirect('test', 'refresh');
	}
}

/* End of File */