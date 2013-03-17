<?php

class Terms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
    }

    public function index() {

        $data = $this->main_model->load_media();
        $data['title'] = 'Terms';

        $this->load->view('header', $data);
        $this->load->view('home/loginForm', $data);
        $this->load->view('home/terms', $data);
        $this->load->view('footer', $data);
    }

}

?>