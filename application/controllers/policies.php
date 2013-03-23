<?php
class Policies extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('main_model');
		$this->load->helper('url');
	}

	public function index($msg='terms')
	{
		
		$data=$this->main_model->load_media();
		$data['title'] = 'Data Use Policy';
	
	$this->gotoPage($msg,$data);
	}


	
	
	public function gotoPage($page='index',$data)
	{
		$this->load->view('header',$data);
		$this->load->view('home/loginForm',$data);
		$this->load->view('policies/'.$page,$data);
		$this->load->view('footer',$data);
	}
	}
	 

?>