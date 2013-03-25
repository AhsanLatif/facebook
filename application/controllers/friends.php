<?php

class Friends extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function addFriend() {
        $fid = $_GET['fid'];
        $username = $this->session->userdata('currMail');
        $id = $this->main_model->get_id($username);
        $this->main_model->addFriend($id, $fid);
    }

    public function acceptRequest() {
        $fid = $_GET['fid'];
        $username = $this->session->userdata('currMail');
        $id = $this->main_model->get_id($username);
        $this->main_model->acceptRequest($id, $fid);
    }

    public function ignoreRequest() {
        $fid = $_GET['fid'];
        $username = $this->session->userdata('currMail');
        $id = $this->main_model->get_id($username);
        $this->main_model->ignoreRequest($id, $fid);
    }

    public function deleteFriend(){
        $fid = $_GET['fid'];
        $username = $this->session->userdata('currMail');
        $id = $this->main_model->get_id($username);
        $this->main_model->deleteFriend($id, $fid);
    }
}

?>