<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// *********************************************************************************
// ***** Ratings_dao Class
// *****
// ***** Class that contains the Database queries related to the Teeth Ratings
// *********************************************************************************
class Ratings_dao extends CI_Model {
    // *********************************************************************************
    // ***** Public Functions
    // *********************************************************************************
    // *********************************************************************************
    // ***** Insert a rating into the database
    // *****
    // ***** Parameters: Rating ID, Rating, Comments, Tooth ID, Rating Meta ID, Technician ID, Quality Control ID
    // ***** Return: Boolean if insert was successful
    // *********************************************************************************
    public function insert_rating($rating_id, $rating, $timestamp, $comments, $tooth_id, $rating_meta_id, $technician_id, $quality_control_id) {
        $this->connect();
        if($rating_id === "") {
            $sql = "INSERT INTO ratings (rating, timestamp, comments, tooth_id, rating_meta_id, technician_id, quality_control_id) "
                ."VALUES (?, ?, ?, ?, ?, ?, ?) "
                ."ON DUPLICATE KEY UPDATE "
                ."rating = ?, "
                ."timestamp = ?, "
                ."comments = ?;";
            $query = $this->db->query($sql, array(
                $rating,
                $timestamp,
                $comments,
                $tooth_id,
                $rating_meta_id,
                $technician_id,
                $quality_control_id,
                $rating,
                $timestamp,
                $comments
            ));
        } else {
            $sql = "INSERT INTO ratings (rating_id, rating, timestamp, comments, tooth_id, rating_meta_id, technician_id, quality_control_id) "
                ."VALUES (?, ?, ?, ?, ?, ?, ?, ?) "
                ."ON DUPLICATE KEY UPDATE "
                ."rating = ?, "
                ."timestamp = ?, "
                ."comments = ?;";
            $query = $this->db->query($sql, array(
                $rating_id,
                $rating,
                $timestamp,
                $comments,
                $tooth_id,
                $rating_meta_id,
                $technician_id,
                $quality_control_id,
                $rating,
                $timestamp,
                $comments
            ));
        }
        $this->disconnect();
        if($query) {
            return true;
        } else {
            return false;
        }
    }

    // *********************************************************************************
    // ***** Get ratings for a specific user
    // *****
    // ***** Parameters: User ID
    // ***** Return: Array of Rating Data - Rating ID, Rating, Timestamp, Comments, Tooth Number, Rating Meta, Technician, QC Admin 
    // *********************************************************************************
    public function get_rating_by_user($user_id) {
        $retVal = array();

        $this->connect();
        $sql = "SELECT r.id AS rating_id, r.rating, r.timestamp, t.tooth_number, rm.name AS rating_name, tech.username AS technician, qcadmin.username AS qcadmin "
            ."FROM ratings r, teeth t, rating_meta rm, users tech, users qcadmin "
            ."WHERE r.tooth_id = t.id "
            ."AND r.rating_meta_id = rm.id "
            ."AND r.technician_id = tech.id "
            ."AND r.quality_control_id = qcadmin.id "
            ."AND tech.id = ?;";
        $query = $this->db->query($sql, array($user_id));

        if($query->num_rows > 0) {
            foreach($query->result() as $row) {
                array_push($retVal, array(
                    'id' => $row->rating_id,
                    'rating' => $row->rating,
                    'timestamp' => $row->timestamp,
                    'tooth_number' => $row->tooth_number,
                    'rating_meta' => $row->rating_name,
                    'technician' => $row->technician,
                    'qcadmin' => $row->qcadmin
                ));
            }
        }
        
        return $retVal;
    }

    // *********************************************************************************
    // ***** Private Functions
    // *********************************************************************************
    private function connect() {
        $this->load->database();
    }

    private function disconnect() {
        $this->db->close();
    }

}
