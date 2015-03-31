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
    // ***** Private Functions
    // *********************************************************************************
    private function connect() {
        $this->load->database();
    }

    private function disconnect() {
        $this->db->close();
    }

}
