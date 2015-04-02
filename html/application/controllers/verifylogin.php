<?php
//This controller is for the actual form validation of the fields and checks the credentials against the database

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class VerifyLogin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_dao');
	}

	public function index() {
		$this->form_validation->set_rules('username', 'User ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if ($this->form_validation->run() == false) {
			//field validation failed. 
			$this->load->view('templates/header');
			$this->load->view('login');
			$this->load->view('templates/footer');
		}
		else {
			/* THIS IS WHERE OTHERS COULD ADD THEIR CUSTOM CONTROLLERS TO LOAD THEIR CUSTOM VIEWS */

			//go to private areas -> show view based on who logged in

			//This calls a home controller -> this could redirect to specific pages that have been built. They would also need to have created controllers as well
			redirect('test', 'refresh');
		}
	}

	function check_database($password) {
		$this->load->model('User_dao');
		$username = $this->input->post('username');

		//query the database
		$result = $this->User_dao->login($username, $password);

		//var_dump($result);

		if ($result) {
			$session_array = array();
			foreach ($result as $row) {
				$session_array = array(
					'id' => $row->id,
					'username' => $row->username,
					'password' => $row->password,
					'title' => $row->title,
					'firstName' => $row->first_name,
					'lastName' => $row->last_name,
					'email' => $row->email,
					'phone' => $row->phone,
					'companyId' => $row->company_id
				);

				//store array values in session storage 
				$this->session->set_userdata('logged_in', $session_array);
			}
			return true;
		}
		else {
			return false;
		}
	}
}
/* End of File */