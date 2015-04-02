<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once(APPPATH.'libraries/REST_Controller.php');

// *********************************************************************************
// ***** Ratings API Class
// *****
// ***** Class that contains the REST Endpoints for the Teeth Ratings
// *********************************************************************************
class Ratings extends REST_Controller {
    // *********************************************************************************
    // ***** Get ALL of the ratings
    // ***** Endpoint: /api/ratings
    // ***** Request Method: GET
    // *****
    // ***** Parameters: None
    // ***** Return: Array of Rating data {}
    // *********************************************************************************
    public function index_get() {
        $data = array();
        $this->load->model('Company_dao');
        $this->load->model('User_dao');
        $this->load->model('Ratings_dao');
        $alltechs = $this->User_dao->getAllTechs();
        $data['alltechs'] = array();
        foreach($alltechs as $tech) {
            $data['alltechs'][$tech['id']] = array (
                'id' => $tech['id'],
                'first_name' => $tech['first_name'],
                'last_name' => $tech['last_name'],
                'ratings' => array()
                );
            $ratings = $this->Ratings_dao->get_rating_by_user($tech['id']);
            foreach($ratings as $rating) {
                $data['alltechs'][$tech['id']]['ratings'][$rating['id']] = array(
                    'id' => $rating['id'],
                    'rating' => $rating['rating'],
                    'timestamp' => $rating['timestamp'],
                    'tooth_number' => $rating['tooth_number'],
                    'rating_meta' => $rating['rating_meta'],
                    'technician' => $rating['technician'],
                    'qcadmin' => $rating['qcadmin']
                    );
            }
        }
        $this->response($data,200);
    }


    // *********************************************************************************
    // ***** Insert a rating
    // ***** Endpoint: /api/ratings
    // ***** Request Method: POST
    // *****
    // ***** Parameters: Rating ID, Rating, Comments, Tooth ID, Rating Meta ID, Technician ID, Quality Control ID
    // ***** Return: ID of the updated/inserted rating. 0 if no changes were made
    // *********************************************************************************
    public function index_post() {
        // POST Parameters
        $rating_id = $this->input->post('rating_id');
        $rating = $this->input->post('rating');
        $timestamp = date('Y-M-d H:i:s');
        $comments = $this->input->post('comments');
        $tooth_id = $this->input->post('tooth_id');
        $rating_meta_id = $this->input->post('rating_meta_id');
        $technician_id = $this->input->post('technician_id');
        $quality_control_id = $this->input->post('quality_control_id');
        
        // Load the Model and call the insert rating function
        $this->load->model('Ratings_dao');
        $updated_rating_id = $this->Ratings_dao->insert_rating($rating_id, $rating, $timestamp, $comments, $tooth_id, $rating_meta_id, $technician_id, $quality_control_id);
        
        // Return the 
        $this->response($updated_rating_id);
    }
    
    // *********************************************************************************
    // ***** Get the ratings for a specific user
    // ***** Endpoint: /api/ratings/user
    // ***** Request Method: GET
    // *****
    // ***** Parameters: User Id
    // ***** Return: Array of Rating data {}
    // *********************************************************************************
    public function user_get() {
        // GET Parameters
        $user_id = $this->input->get('id');
        
        // Load the Model and call the get_rating_by_user function
        $this->load->model('Ratings_dao');
        $ratings = $this->Ratings_dao->get_rating_by_user($user_id);
                
        $this->response($ratings);
    }
}
