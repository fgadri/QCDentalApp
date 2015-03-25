<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Company_dao extends CI_Model {
    /*
     * Public Functions
     */

    public function __construct() {
        parent::__construct();
    }

    public function getCompanies() {
        $retVal = array();

        $this->connect();
        $sql = "SELECT c.id, c.name "
            . "FROM companies c ";
        $query = $this->db->query($sql, array());
        $this->disconnect();

        if($query->num_rows > 0) {
            foreach($query->result() as $row) {
                array_push($retVal, array(
                    'id' => $row->id,
                    'name' => $row->name
                ));
            }
        }
        return $retVal;
    }

    public function getCompany($companyId) {
        $retVal = array();

        $this->connect();
        $sql = "SELECT c.id, c.name "
            . "FROM companies c "
            . "WHERE c.id = ?";
        $query = $this->db->query($sql, array($companyId));
        $this->disconnect();

        if($query->num_rows > 0) {
            foreach($query->result() as $row) {
                $retVal['id'] = $row->id;
                $retVal['name'] = $row->name;
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
