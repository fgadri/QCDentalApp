<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ratings_dao extends CI_Model {
    public function insert_rating($rating_id, $rating, $timestamp, $comments, $tooth_id, $rating_meta_id, $technician_id, $quality_control_id) {
        $retVal = array();
        
        $sql = "INSERT INTO ratings (rating, timestamp, comments, tooth_id, rating_meta_id, technician_id, quality_control_id) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?) "
            . "ON DUPLICATE KEY UPDATE "
            . "rating = ?, "
            . ""
    }
}

