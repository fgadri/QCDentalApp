<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Licenses extends CI_Controller {
	/*
	Public Functions
	*/

	public function index() {
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

			//get inputted info
			$fName = $this->input->post('firstName');
			$lName = $this->input->post('lastName');
			$cName = $this->input->post('companyName');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$zip = $this->input->post('zip');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$fullAddress = $address.' '.$city.' '.$state.' '.$zip;
			$fullName = $fName.' '.$lName;

			//add email library			
			$this->load->library('email');

			//define email characteristics
			$this->email->from($email, $fullName);
			$this->email->to('CaptureDental@gmail.com'); //<------ MODIFY THIS TO AN ACTUAL RECIPIENT. I have tested it with my gmail account as recipient


			$this->email->subject($cName.' needs their license modified');
			$this->email->message($fullName." from ".$cName." has requested that their license be modified. Here is a full list of the provided info:\n\nFull Name: ".$fullName."\nCompany Name: ".$cName."\nAddress: ".$fullAddress."\nPhone Number: ".$phone."\nEmail: ".$email);

			//send the email
			$this->email->send();

			//debugger. Shows the status of the email -> helpful
			//echo $this->email->print_debugger();
		}
	}

}


?>
