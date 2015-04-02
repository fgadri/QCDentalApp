<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class License_dao extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

    public function getDateDiff($companyId) {
    	$this->connect();
    	$sql = 'SELECT TIMESTAMPDIFF(DAY, CURDATE(), (SELECT end_date FROM licenses WHERE company_id=?)) AS diff';
    	$query = $this->db->query($sql, array($companyId));
        $this->disconnect();

        if($query->num_rows == 1) {
        	$retVal = $query->result()[0]->diff;
        }
        else {
        	$retVal = false;
        }
        return $retVal;
    }





    private function connect() {
        $this->load->database();
    }

    private function disconnect() {
        $this->db->close();
    }
}