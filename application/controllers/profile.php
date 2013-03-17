<?php

class profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
		 $this->load->library('session');

    }

	public function cropPicture()
	{
		$img = $this->session->userdata('img');
echo $img;
		
	//	$config['library_path'] = '/usr/bin';
		

		$config['image_library'] = 'imagemagick';
$config['library_path'] = '/usr/X11R6/bin/';
	$config['source_image'] =  base_url()."uploads/images.jpg";
	echo $config['source_image'];
	$config['new_image'] = base_url()."uploads/new.gif";
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width'] = 50;
	$config['height'] = 50;
$this->load->library('image_lib');
$this->image_lib->initialize($config);
// resize image
	//$this->image_lib->resize();
	// handle if there is any problem
	if ( ! $this->image_lib->resize()){
		echo $this->image_lib->display_errors();
	}

}

public function removePic()
{
$username=$this->session->userdata('currMail');
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
$filename= $imgdata['file_name'];
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
		if(!$username)
		{
		redirect('/home/index','refresh');
		}
		$details=$this->main_model->getUserDetails($username);
		$data['name']=$details['first_name']." ".$details['last_name'];
		$data['bday']=$details['birthday'];
		$data['school']=$details['school'];
		$data['university']=$details['university'];
		$data['employer']=$details['employer'];
		
		 $id = $this->main_model->get_id($username);
        $imgage_path = $this->main_model->image_model($id);
		
		$data['id']=$id;
		$data['image_path']=$imgage_path;
		$img=array('img'=>$imgage_path);
		$this->session->set_userdata($img);
	
        $this->load->view('header', $data);
		$this->load->view('profile/loggedInNav',$data);
        $this->load->view('profile/index', $data);
        $this->load->view('footer', $data);
    }
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/home/index');
	}

}

?>