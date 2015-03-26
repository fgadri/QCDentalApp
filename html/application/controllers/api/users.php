<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once(APPPATH . 'libraries/REST_Controller.php');

class Users extends REST_Controller {

    public function index_get() {
        $data = array();
        $this->load->model('Company_dao');
        $this->load->model('User_dao');
        $companies = $this->Company_dao->getCompanies();
        $data['companies'] = array();
        foreach($companies as $company) {
            $data['companies'][$company['id']] = array(
                'id' => $company['id'],
                'name' => $company['name'],
                'users' => array()
            );
            $users = $this->User_dao->getUsersByCompany($company['id']);
            foreach($users as $user) {
                $data['companies'][$company['id']]['users'][$user['id']] = array(
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'firstName' => $user['firstName'],
                    'lastName' => $user['lastName'],
                    'email' => $user['email'],
                    'image' => $user['image']
                );
            }
        }

        $this->response($data, 200);
    }

    public function index_post() {
        $inputData = array(
            'username' => filter_input(INPUT_POST, 'username'),
            'password' => filter_input(INPUT_POST, 'password'),
            'title' => filter_input(INPUT_POST, 'title') === "" ? NULL : filter_input(INPUT_POST, 'title'),
            'firstName' => filter_input(INPUT_POST, 'first_name'),
            'lastName' => filter_input(INPUT_POST, 'last_name'),
            'email' => filter_input(INPUT_POST, 'email'),
            'phone' => filter_input(INPUT_POST, 'phone'),
            'image' => filter_input(INPUT_POST, 'image'),
            'companyId' => filter_input(INPUT_POST, 'company_id')
        );

        $this->load->model('User_dao');

        $result = $this->User_dao->insertUser($inputData);

        if($result) {
            $this->response('The user was added/updated successfully.', 200);
        } else {
            $this->response('An unexpected error occured while adding the user.', 417);
        }
    }

}
