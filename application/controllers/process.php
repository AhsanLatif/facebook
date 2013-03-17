<?php

class Process extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
		$this->load->library('session');
    }

    public function index() {
        $this->load->library('session');

        $data = $this->main_model->load_media();
        $data['title'] = 'Welcome To Facebook';
    }

    public function goToPage($page = 'google.com',$msg="") {
        $data = $this->main_model->load_media();
		
		if($msg!="")
		{
			$data['error']=$msg;
		}
        $this->load->view('header', $data);
        $this->load->view('home/loginForm', $data);
		if($page=="newPassword")
		$data['msg']=$this->session->userdata('EmailReset');
        $this->load->view('process/' . $page, $data);
        $this->load->view('footer', $data);
    }
	public function changePassword()
	{
	$email=$_POST['Email'];
	$pass=$_POST['newPassword'];
	
	$this->main_model->changePass($email,$pass);
echo '<script> alert("success") </script>';
	redirect("/home/index/Success", 'refresh');
	
	}
	public function sendResetCode()
	{
	 $ans=$_POST['accountIdentify'];
	 $email= $this->session->userdata('EmailToReset');
	 echo $email;
	 $num=rand(10,10000);
	 if($ans=='Yes')
	 {
	 $this->main_model->setResetCode($email,md5($email.$num));
	        $message = "Please Click The Link Below To Reset Your Pass\n" . "<a href='http://localhost/webProject/index.php/process/resetPasswordCodeCheck/" . md5($email.$num) . "'>Click Here</a>";

	 $this->sendEmailNow($email,$message);
	 }
	 else
	 {
	 echo 'cant help you';
	 }
	}
	public function resetPasswordCodeCheck($code)
	{
	$this->session->unset_userdata('EmailToReset');
	$email=$this->main_model->getResetCode($code);
	if($email==-1)
	{
	echo "blimey!";
	}
	echo $email;
	 $currMail = array('EmailReset' => $email); //set it
	 
      $this->session->set_userdata($currMail);
	  $this->goToPage('newPassword');
	
	}
	public	function findAccount()
	{
		$email = $_POST['resetEmail'];
		$result=$this->main_model->getUserDetails($email);
		$pic=$this->main_model->image_model($result['id']);
		echo $pic;
		if($result==0)
		{
		$this->goToPage('resetPassword','Email not found');
		}
		else
		{
		$data=$this->main_model->load_media();
         $currUser = array('EmailToReset' => $email); //set it
            $this->session->set_userdata($currUser);
			echo $currUser['EmailToReset'];
		$data['name']=$result['first_name']." ".$result['last_name'];
		$data['pic']=$pic;
		$this->load->view('header', $data);
        $this->load->view('home/loginForm', $data);
        $this->load->view('process/identifyAccount', $data);
        $this->load->view('footer', $data);
			
		}
	}
    public function sendEmail($email = '') {
       
       
		$this->load->library('session');
        $emailTo = $this->session->userdata('currMail');
       
        $message = "Please Click The Link Below To Confirm Your Account\n" . "<a href='http://localhost/webProject/index.php/process/emailConfirmation/" . md5($email) . "'>Click Here</a>";
        $this->sendEmailNow($emailTo,$message);


    }
	public function sendEmailNow($email,$msg)
	{
	/*$config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'webproject.random@gmail.com.',
            'smtp_pass' => 'randompass',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'mailtype' => 'html'// or html
        );
	 $this->load->library('email', $config);
		 $this->email->from('webproject.random@gmail.com', 'Your Name');
        $this->email->to($email);
        $this->email->cc('');
        $this->email->bcc('');
		$this->email->subject('Facebook!');
        $this->email->message($msg);
		 $this->email->send();*/
		 
        $data['message'] = $msg;
        $this->load->view('helperPages/psuedoMail', $data);
	}
    public function emailConfirmation($code) {
        $result = $this->main_model->getActivationCode($code);
        redirect('/profile/index', 'refresh');
    }

}

?>