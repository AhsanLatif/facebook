<?php

class profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function Search() {
        $query = $_POST['SearchBox'];
        $resource = $this->main_model->search($query, 'firstname');
    }

    public function updateInfo() {
        $school = $_POST['school'];
        $university = $_POST['university'];
        $employer = $_POST['employer'];
        $bdate = date('Y-m-d H:i:s', strtotime($_POST['bdate']));
        $id = $_POST['id'];
        $data = array('user_id' => $id, 'school' => $school, 'university' => $university, 'employer' => $employer);
        $this->main_model->insert_sign_up2($data);
        $blekh = $this->main_model->updateInfo($data);
        $this->main_model->updateBirthday(array('id' => $id, 'birthday' => $bdate));
        $this->index();
    }

    public function cropPicture() {
        $img = $this->session->userdata('img');
        echo $img;

        //	$config['library_path'] = '/usr/bin';


        $config['image_library'] = 'imagemagick';
        $config['library_path'] = '/usr/X11R6/bin/';
        $config['source_image'] = base_url() . "uploads/images.jpg";
        echo $config['source_image'];
        $config['new_image'] = base_url() . "uploads/new.gif";
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 50;
        $config['height'] = 50;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
// resize image
        //$this->image_lib->resize();
        // handle if there is any problem
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
    }

    public function removePic() {
        $username = $this->session->userdata('currMail');
        $id = $this->main_model->get_id($username);

        echo $id;
        $this->main_model->removePic($id);
        $this->index();
    }

    public function profilePhotoUpload() {

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '10240';
        $config['max_height'] = '7680';

        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $imgdata = $this->upload->data();
        $filename = $imgdata['file_name'];
        $user_id = $_POST['id'];
        $data = array(
            'user_id' => $user_id,
            'image_name' => $imgdata['file_name'],
            'is_active' => 1
        );
        $this->main_model->insert_image_info($data);
        $this->index();
    }

    public function index() {

        $data = $this->main_model->load_media();
        $data['title'] = 'Profile Page';
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
        $imgage_path = $this->main_model->image_model($id);

        $data['id'] = $id;
        $data['image_path'] = $imgage_path;
        $img = array('img' => $imgage_path);
        $this->session->set_userdata($img);

        $friends = $this->main_model->viewFriends($id);
        $data['friends'] = $friends;

        $requests = $this->main_model->viewRequests($id);
        $data['requests'] = $requests;

        $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('footer', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/home/index');
    }

    public function viewProfile() {
        $id = $_GET['id'];

        $data = $this->main_model->load_media();
        $data['title'] = 'Profile Page';

        $details = $this->main_model->getUserDetailsById($id);
        $data['name'] = $details['first_name'] . " " . $details['last_name'];
        $data['bday'] = $details['birthday'];
        $data['school'] = $details['school'];
        $data['university'] = $details['university'];
        $data['employer'] = $details['employer'];

        //  $id = $this->main_model->get_id($username);
        $imgage_path = $this->main_model->image_model($id);

        $data['fid'] = $id;
        $data['image_path'] = $imgage_path;
        $img = array('img' => $imgage_path);

        $friends = $this->main_model->viewFriends($id);
        $data['friends'] = $friends;

        $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('profile/viewProfile', $data);
        $this->load->view('footer', $data);
    }

    public function displayPeople() {
        $details = $this->main_model->displayPeople_model();
        $data = $this->main_model->load_media();
        $data['details'] = $details;
//        foreach ($details as $detail){
//            echo $detail['first_name'];
//        } 
//        exit();        
        $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('profile/view_people', $data);
//        $this->load->view('profile/index', $data);
        $this->load->view('footer', $data);
    }

    public function friends($username) {
        $data = $this->main_model->load_media();
        redirect('/profile/index', 'refresh');
    }

}

?>