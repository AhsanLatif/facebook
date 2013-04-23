<?php

class Newsfeed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
//        $this->load->helper('dom');
        $this->load->library('session');
    }

    public function index() {
        // Grab HTML From the URL
        /*
          $html = file_get_html('http://codeigniter.com/');


          // find all link on Codeigniter Site

          foreach($html->find('img') as $e)
          echo $e . '<br>'; */

        $data = $this->main_model->load_media();
        $this->load->view('header', $data);
        $this->load->view('newsFeed/index', $data);
    }

    public function uploadPhoto() {
        $text = $_POST['PicText'];
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '10240';
        $config['max_height'] = '7680';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $imgdata = $this->upload->data();
            $filename = $imgdata['file_name'];
            $this->addPost($text, $filename, '1');
        }
    }

    public function addPost($content, $link, $type) {
        $id = $this->session->userdata('id');
        $this->main_model->addPost($id, $content, $link, $type);
    }

    public function getPosts($iter) {

        $id = $this->session->userdata('id');

        echo json_encode($this->main_model->getPosts($id, $iter));
    }

    public function add_video() {
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
            unset($config);
            $date = date("ymd");
            $configVideo['upload_path'] = './video';
            $configVideo['max_size'] = '30240';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp3';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $date . $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;

            $text = $_POST['VidText'];
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            if (!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            } else {
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded";
            }
            $this->addPost($text, $video_name, 4);
        }

    }
}
        