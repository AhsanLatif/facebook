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
       
	
	$data = $this->main_model->load_media();
        $data['title'] = 'Newsfeed';
        $username = $this->session->userdata('currMail');
        if (!$username) {
            redirect('/home/index', 'refresh');
        }
        $details = $this->main_model->getUserDetails($username);
        $data['name'] = $details['first_name'] . " " . $details['last_name'];
        $data['bday'] = $details['birthday'];
        $data['school'] = $details['school'];
        $data['university'] = $details['university'];
        $data['employer'] = $details['employer'];


        $id = $this->main_model->get_id($username);
        $data['notification'] = $this->main_model->getNotification($id);
        
        $id = $this->main_model->get_id($username);
        $imgage_path = $this->main_model->image_model($id);

        $data['id'] = $id;
        $data['image_path'] = $imgage_path;
        $img = array('img' => $imgage_path);
        $this->session->set_userdata($img);
        $this->session->set_userdata(array('id' => $id));
        $friends = $this->main_model->viewFriends($id);
        $data['friends'] = $friends;

        $requests = $this->main_model->viewRequests($id);
        $data['requests'] = $requests;
 $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('newsFeed/index', $data);
        $this->load->view('footer', $data);
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
            $configVideo['max_size'] = '10240';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $date . $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;

            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            if (!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            } else {
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded";
            }
            $text = $_POST['VidText'];
            $this->addPost($text, $video_name, '4');
        }

    }
}
        