<?php

class profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
	
    public function filteredSearch() {
        $i = 0;
        if (isset($_POST['fname']) && $_POST['fname'] != "") {

            $query[$i] = array('first_name' => $_POST['fname']);
            $i++;
        }
        if (isset($_POST['lname']) && $_POST['lname'] != "") {

            $query[$i] = array('last_name' => $_POST['lname']);
            $i++;
        }
        if (isset($_POST['school']) && $_POST['school'] != "") {

            $query[$i] = array('school' => $_POST['school']);
            $i++;
        }
        if (isset($_POST['uni']) && $_POST['uni'] != "") {
            $query[$i] = array('university' => $_POST['uni']);
            $i++;
        }
        if (isset($_POST['emp']) && $_POST['emp'] != "") {

            $query[$i] = array('employer' => $_POST['emp']);
            $i++;
        }
        if (isset($_POST['city']) && $_POST['city'] != "") {
            $query[$i] = array('city' => $_POST['city']);
        }

        if ($i == 0)
            $this->displayPeople();
        else {
            $resource = $this->main_model->filteredSearch($query);
            $data = $this->main_model->load_media();
            $data['details'] = $resource;
            $data['userid'] = $this->session->userdata('id');
            $data['id'] = $this->session->userdata('id');
            $this->load->view('header', $data);
            $this->load->view('profile/loggedInNav', $data);
            $this->load->view('profile/view_people', $data);
            $this->load->view('footer', $data);
        }
    }
		public function SearchFriends(){
		
		
			$query = $_POST['query'];
					if ($query == "") {
						echo "nada";
					}
					$id=$this->session->userdata('id');
			
				
		$from="user_friends";
			   
		$resource = $this->main_model->searchF($query,$from,$id);
			    
      echo json_encode($resource);
	}
		public function SearchMutualFriends(){
		
			$query = $_POST['query'];
			$otherOf=$_POST['frndID'];
					if ($query == "") {
						echo "nada";
					}
			$id=$this->session->userdata('id');	
		$from="user_friends";
			   
		$resource = $this->main_model->searchMF($query,$from,$id,$otherOf);
			    
      echo json_encode($resource);

	}
    public function Search() {
        $query = $_POST['SearchBox'];
        if ($query == "") {
            $this->displayPeople();
            return;
        }
		
		
        $data = array('0' => 'firstname', '1' => 'lastname', '2' => 'school', '3' => 'university', '4' => 'employer', '5' => 'city');
        $i = 0;
        do {
            $resource = $this->main_model->search($query, $data[$i]);
            if ($resource != "0") {
                $resource2 = $this->main_model->search($query, $data[$i + 1]);
                if ($resource2 != "0") {
                    $resource = array_merge($resource, $resource2);
                }
                $i++;
            }
            $i++;
        } while ($resource == "0" && $i <= 5);
    $data = $this->main_model->load_media();
        $data['details'] = $resource;
        $data['userid'] = $this->session->userdata('id');
        $data['id'] = $this->session->userdata('id');
				 $friends = $this->main_model->viewFriends($data['userid']);
				  $data['friends'] = $friends;
        $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('profile/view_people', $data);
        $this->load->view('footer', $data);
    }
public function updateInfo()
	{
		$school=$_POST['school'];
		$university=$_POST['university'];
		$employer=$_POST['employer'];
		$bdate=date('Y-m-d H:i:s', strtotime($_POST['bdate']));
		$id=$_POST['id'];
		$school=strip_tags($school);
		$university=strip_tags($university);
		$employer=strip_tags($employer);
		$data=array('user_id'=>$id,'school'=>$school, 'university'=>$university, 'employer'=>$employer);
		$this->main_model->insert_sign_up2($data);
		$blekh=$this->main_model->updateInfo($data);
		$this->main_model->updateBirthday(array('id'=>$id,'birthday'=>$bdate));
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
	    public function coverPhotoUpload() {

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
            'is_active' => 2
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
        $data['name'] = strip_tags($details['first_name'] . " " . $details['last_name']);
        $data['bday'] = strip_tags($details['birthday']);
        $data['school'] = strip_tags($details['school']);
        $data['university'] = strip_tags($details['university']);
        $data['employer'] = strip_tags($details['employer']);


        $id = $this->main_model->get_id($username);
        $data['notification'] = $this->main_model->getNotification($id);
        $wallPost = $this->getWallPost($id);
        $data['wallPost'] = $wallPost;
        $data['posted'] = 8;
        $id = $this->main_model->get_id($username);
        $imgage_path = $this->main_model->image_model($id);
	$cover=$this->main_model->cover_get($id);
	$data['cover']=$cover;
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
        $this->load->view('profile/index', $data);
        $this->load->view('footer', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/home/index');
    }

    public function viewProfile() {
        $id = $_GET['id'];
$data['myID'] = $id;
        $data = $this->main_model->load_media();
        $data['title'] = 'Profile Page';

        $details = $this->main_model->getUserDetailsById($id);
        $data['name'] = $details['first_name'] . " " . $details['last_name'];
        $data['bday'] = $details['birthday'];
        $data['school'] = $details['school'];
        $data['university'] = $details['university'];
        $data['employer'] = $details['employer'];
    
        $userid = $this->session->userdata('id');
		 $friends = $this->main_model->viewFriends($userid);
        $data['friends'] = $friends;
        $requests = $this->main_model->viewRequests($userid); 
        $data['requests'] = $requests;
        
        $check = $this->main_model->ifFriend($userid, $id);
        $data['myID'] = $id;

        if ($check == 1) {
            $data['reqaccept'] = 1;
        } else if ($check == 2) {
            $data['friend'] = 1;
        } else if ($check == 3) {
            $data['reqsent'] = 1;
        } else {
            $data['abc'] = 1;
        }
        $data['fid'] = $id;

//  $id = $this->main_model->get_id($username);
        $imgage_path = $this->main_model->image_model($id);


        $data['image_path'] = $imgage_path;
        $img = array('img' => $imgage_path);
//
//        $friends = $this->main_model->viewFriends($id);
//        $data['friends'] = $friends;

        $mutualfriends = $this->main_model->viewMutualFriends($userid, $id);
        $data['mutualfriends'] = $mutualfriends;

        //THE CHANGES!
        $data['id'] = $this->session->userdata('id');
        $data['wallPost'] = $this->getWallPost($id);
        //End of CHANGES!!

        $this->load->view('header', $data);
        $this->load->view('profile/loggedInNav', $data);
        $this->load->view('profile/viewProfile', $data);
        $this->load->view('footer', $data);
    }

    public function displayPeople() {
        $details = $this->main_model->displayPeople_model();
        $data = $this->main_model->load_media();
        $data['details'] = $details;
        $data['userid'] = $this->session->userdata('id');
        $data['id'] = $this->session->userdata('id');
		 $friends = $this->main_model->viewFriends($data['userid']);
		 $data['friends'] = $friends;
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
		
	public function Notify($id, $notice, $link)
	{
		$this->main_model->Notify($id,$notice,$link);
	}
	public function getNotification()
	{
	$id=$_POST['id'];
	$notice=$this->main_model->getNotification($id);
	if($notice!="")
		{
		echo json_encode($notice);
		
		}
	else
		{
			echo json_encode("nada");
		}
	}

    public function addWallPost() {
        $to = $_POST['myID'];
        $from = $_POST['id'];
        $post = $_POST['post'];
        $this->main_model->addWallPost($to, $from, $post);
		        $details=$this->main_model->getUserDetailsById($from);
		$notice=$details['first_name']." wrote on your wall";
		$link="#wall";
		$id=$to;
		$this->Notify($id,$notice,$link);
        echo json_encode($this->main_model->getUserDetailsById($from));
    }

    public function getWallPost($id) {
        return $this->main_model->getWallPost($id);
    }
	public function removeNotification($id)
	{
		 $this->main_model->removeNotification($id);
		 $this->index();
	}
		public function goToPage($page)
	{
		if($page=="newsfeed")
		{
			redirect('newsfeed/index');
		}
	}
	

}

?>