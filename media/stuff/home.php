<?php
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('main_model');
	}

	public function index()
	{
		
		$data=$this->main_model->load_media();
		$data['title'] = 'Welcome To Facebook';

	$this->load->view('header', $data);
	$this->load->view('home/index', $data);
	$this->load->view('footer',$data);
	}


	
	
	public function gotoPage($page='home')
	{
	$data=$this->main_model->load_media();

		$data['title'] = 'Welcome To Facebook';
		$this->load->view('header', $data);
		if($page=='signup1' || $page=='signup2' || $page=='signup3')
		{
		$data['stepCount']=$page;
		$this->load->view('home/signupSteps', $data);
		}
		
	$this->load->view('home/'.$page, $data);
	$this->load->view('footer',$data);
	}
	}
?>