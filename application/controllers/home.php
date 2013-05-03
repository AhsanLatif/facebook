<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($msg = '', $invalididpassword = '') {
        // $this->load->library('session');
        $data = $this->main_model->load_media();
        $data['title'] = 'Welcome To Facebook';
        if ($msg != '')
            $data['msg'] = $msg;
        if ($invalididpassword != '')
            $data['invalididpassword'] = $invalididpassword;
        $this->load->view('header', $data);
        $this->load->view('home/loginForm', $data);
        $this->load->view('home/index', $data);
        $this->load->view('footer', $data);
    }

    public function gotoPage($page = 'home') {
        $data = $this->main_model->load_media();

        $data['title'] = 'Welcome To Facebook';
        $this->load->view('header', $data);
        if ($page == 'signup1' || $page == 'signup2' || $page == 'signup3') {
		$mail=$this->session->userdata('currMail');
		if($mail!=false)
          {  $data['id'] = $this->session->userdata('id');
            $data['stepCount'] = $page;
            $this->load->view('home/signupSteps', $data);}
			else
			{
			redirect('/home/index');
			}
        }

        $this->load->view('home/' . $page, $data);
        $this->load->view('footer', $data);
    }

    public function signUp() {
        $firstName = $_POST['Fname'];
        $lastName = $_POST['Lname'];
        $email = $_POST['Email'];
        $phno = $_POST['Phone'];
        $pass = $_POST['password'];
        $date = $_POST['Bdate'];
        $date = date('Y-m-d H:i:s', strtotime($date));
        $gender = $_POST['Gender'];

        //////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////

        $error = "";

        $email_repeat = $_POST['EmailCon'];

        if ($firstName == "" || $firstName == NULL) {
            $error = "error: Firstname field empty ";
        }

        if (strlen($firstName) > 30) {
            $error = "error: Firstname exceeds limit";
        }

        if (strlen($firstName) <= 2) {
            $error = "error: Firstname is extreemly small";
        }

        if ($lastName == "" || $lastName == NULL) {
            $error = "error: Lastname field empty ";
        }

        if (strlen($lastName) > 30) {
            $error = "error: Lastname exceeds limit";
        }


        if ($email == "" || $email == NULL) {
            $error = "error: Email field empty";
        }

        if ($email_repeat == "" || $email_repeat == NULL) {
            $error = "error: Second Email field empty ";
        }

        if ($pass == "" || $pass == NULL) {
            $error = "error: Password field empty ";
        }

        $valid_name = "/^[a-z]+$/i";

        if (!preg_match($valid_name, $firstName)) {
            $error = "error: First name should only have alphabets";
        }

        if (!preg_match($valid_name, $lastName)) {
            $error = "error: First name should only have alphabets";
        }

        $valid_email = "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/ ";

        if (!preg_match($valid_email, $email)) {
            $error = "error: Email address violates format";
        }

        if (!preg_match($valid_email, $email_repeat)) {
            $error = "error: Email address violates format";
        }

        if ($email != $email_repeat) {
            $error = "error: Email addresses not same";
        }

        $valid_phone = "/^\(?([0-9]{4})\)?[-. ]?([0-9]{7})$/";

        if (!preg_match($valid_phone, $phno)) {
            $error = "error: Phone number violates format";
        }

        if ($gender == "") {
            $error = "error: Gender not selected";
        }

        $valid_password = "/^[a-z0-9_-]{3,30}$/";

        if (!preg_match($valid_password, $pass)) {
            $error = "error: Password either wrong or exceeds limit";
        }

        if ($error != "") { // This means that there is some error in data entered
            $msg = $error;
            $this->index($msg);
        }

        //////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////

        $data = array(
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email_id' => $email,
            'password' => md5($pass),
            'phone' => $phno,
            'birthday' => $date,
            'gender' => $gender,
            'activation' => md5($email)
        );

        $value = $this->main_model->validate_email($email);
        if ($value > 0) {
            $msg = 'Email already exists';
            $this->index($msg);
        } else {
            $result = $this->main_model->insert_sign_up($data);
            $data = $this->main_model->load_media();

            // $this->load->library('session');

            $currMail = array('currMail' => $email); //set it
            $this->session->set_userdata($currMail);
            $this->gotoPage('signup1');
        }
    }

    public function signupStep1() {
        $email = $this->session->userdata('currMail');

        $id = $this->main_model->get_id($email);
        $this->session->set_userdata('id', $id);
        $this->goToPage('signup2');
    }

    public function signupStep2() {
        $id = $_POST['id'];
        $school = $_POST['school'];
        $college = $_POST['college'];
        $employer = $_POST['employer'];
        $data = array(
            'user_id' => $id,
            'school' => $school,
            'university' => $college,
            'employer' => $employer
        );
        $result = $this->main_model->insert_sign_up2($data);

        $data = $this->main_model->load_media();
        $data['id'] = $id;
        $data['title'] = 'Welcome To Facebook';
        $this->load->view('header', $data);
        $this->load->view('home/signup3', $data);
        $this->load->view('footer', $data);
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
        redirect('/process/sendEmail', 'refresh');
    }

    public function login() {
        $username = $_POST['loginEmail'];
        $password = md5($_POST['loginPassword']);
        $value = $this->main_model->login_model($username, $password);
        if ($value == 0) {
            $invalididpassword = 'invalid username or password';
            if ($this->session->userdata('loginAttempt')) {
                $loginAttempt = $this->session->userdata('loginAttempt');
                if ($loginAttempt < 2) {

                    $this->session->set_userdata('loginAttempt', $loginAttempt + 1);
                    $this->index('', $invalididpassword);
                } else {
                    $this->session->unset_userdata('loginAttempt');
                    redirect('/process/goToPage/resetPassword', 'refresh');
                }
            } else {
                $loginAttempt = array('loginAttempt' => 1); //set it
                $this->session->set_userdata($loginAttempt);
                $this->index('', $invalididpassword);
            }
        } else {
            $this->session->unset_userdata('loginAttempt');
            $currMail = array('currMail' => $username); //set it
            $this->session->set_userdata($currMail);
            $this->home($username);
        }
    }

    public function home($username) {
        $data = $this->main_model->load_media();
        redirect('/profile/index', 'refresh');
    }

}

?>