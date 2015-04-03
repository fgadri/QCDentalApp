<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ratings extends CI_Controller {
    /*
     * Public Functions
     */

    public function index() {
        $data = array();
        $this->load->model('Ratings_dao');
        $ratings = $this->Ratings_dao->get_all_ratings();
        $data['ratings'] = array();
        foreach($ratings as $rating) {
            $data['ratings'][$rating['id']] = array(
                'rating_id' => $rating['id'],
                'rating' => $rating['rating'],
                'timestamp' => $rating['timestamp'],
                'tooth_number' => $rating['tooth_number'],
                'rating_meta' => $rating['rating_name'],
                'technician' => $rating['technician'],
                'qcadmin' => $rating['qcadmin']
            );
        };

        $this->load->view('templates/header');
        $this->load->view('ratings', $data);
        $this->load->view('templates/footer');
    }

}
