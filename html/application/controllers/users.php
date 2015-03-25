<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users extends CI_Controller {
    /*
     * Public Functions
     */

    public function index() {
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
                    'email' => $user['email']
                );
            }
        }

        $this->load->view('templates/header');
        $this->load->view('users', $data);
        $this->load->view('templates/footer');
    }

    public function company($companyId) {
        $data = array();
        $this->load->model('Company_dao');
        $this->load->model('User_dao');
        $company = $this->Company_dao->getCompany($companyId);
        if(!empty($company)) {
            $data['company'] = array(
                'id' => $company['id'],
                'name' => $company['name'],
                'users' => array()
            );
            $users = $this->User_dao->getUsersByCompany($companyId);
            foreach($users as $user) {
                $data['company']['users'][$user['id']] = array(
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'firstName' => $user['firstName'],
                    'lastName' => $user['lastName'],
                    'email' => $user['email']
                );
            }

            $this->load->view('templates/header');
            $this->load->view('user_single', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/404');
            $this->load->view('templates/footer');
        }
    }

}
