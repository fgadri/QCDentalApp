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
        $sql = "SELECT u.id, u.username, u.first_name, u.last_name, u.email "
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
                    'email' => $row->email
                ));
            }
        }
        return $retVal;
    }

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
