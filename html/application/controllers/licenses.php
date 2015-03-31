<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Licenses extends CI_Controller {
	/*
	Public Functions
	*/

	public function index() {
		//load the form helper class 
		$this->load->helper("form");
		//load the form validation classes
		$this->load->library("form_validation");

		//setup the validation rules for the form
		$this->form_validation->set_rules("firstName", "First Name", "required");
		$this->form_validation->set_rules("lastName", "Last Name", "required");
		$this->form_validation->set_rules("companyName", "Company Name", "required");
		$this->form_validation->set_rules("address", "Address", "required");
		$this->form_validation->set_rules("city", "City", "required");
		$this->form_validation->set_rules("state", "State", "required");
		$this->form_validation->set_rules("zip", "Zip Code", "required");
		$this->form_validation->set_rules("phone", "Phone Number", "required");
		$this->form_validation->set_rules("email", "Email Address", "required");

		//if the form does not validate, show the form again
		if ($this->form_validation->run() == false) {
			$this->load->view("templates/header");
			$this->load->view("licenses_view");
			$this->load->view("templates/footer");
		}
		//if the form validates, show the formSuccess view
		else {
			$this->load->view("templates/header");
			$this->load->view("formSuccess");
			$this->load->view("templates/footer");
		}
	}

}


?>