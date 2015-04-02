<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_dao extends CI_Model {
    /*
     * Public Functions
     */

    public function __construct() {
        parent::__construct();
    }

    public function getUsersByCompany($companyId) {
        $retVal = array();

        $this->connect();
        $sql = "SELECT u.id, u.username, u.first_name, u.last_name, u.email, u.image "
            . "FROM users u, companies c "
            . "WHERE u.company_id = c.id "
            . "AND c.id = ?";
        $query = $this->db->query($sql, array($companyId));
        $this->disconnect();

        if($query->num_rows > 0) {
            foreach($query->result() as $row) {
                array_push($retVal, array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'firstName' => $row->first_name,
                    'lastName' => $row->last_name,
                    'email' => $row->email,
                    'image' => $row->image
                ));
            }
        }
        return $retVal;
    }

    public function insertUser($inputData) {
        $this->connect();
        $sql = "INSERT INTO users (username, password, title, first_name, last_name, email, phone, image, company_id) "
            . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?) "
            . "ON DUPLICATE KEY UPDATE "
            . "password = ?, "
            . "title = ?, "
            . "first_name = ?, "
            . "last_name = ?, "
            . "email = ?, "
            . "phone = ?, "
            . "image = ?";
        $query = $this->db->query($sql, array(
            $inputData['username'],
            $inputData['password'],
            $inputData['title'],
            $inputData['firstName'],
            $inputData['lastName'],
            $inputData['email'],
            $inputData['phone'],
            $inputData['image'],
            $inputData['companyId'],
            $inputData['password'],
            $inputData['title'],
            $inputData['firstName'],
            $inputData['lastName'],
            $inputData['email'],
            $inputData['phone'],
            $inputData['image']
        ));
        $this->disconnect();

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    //TESTING
    public function login($username, $password)
    {
        $this->connect();
        $sql = "SELECT username, password FROM users WHERE username = ? AND password = ?";
        $query = $this->db->query($sql, array($username, $password));
        $this->disconnect();

        if ($query->num_rows == 1) {
            return $query->result();
        }
        else {
            return false;
        }
    }
    //TESTING

    /*
     * Private Functions
     */

    private function connect() {
        $this->load->database();
    }

    private function disconnect() {
        $this->db->close();
    }

}
