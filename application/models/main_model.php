<?php

class Main_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function load_media() {
        $data['base'] = $this->config->item('base_url');
        $data['css'] = $this->config->item('css');
        $data['images'] = $this->config->item('images');
        $data['js'] = $this->config->item('js');
        $data['uploads'] = $this->config->item('uploads');
        return $data;
    }

    public function changePass($email, $pass) {
        $data = array(
            'password' => $pass
        );

        $this->db->where('email_id', $email);
        $this->db->update('user_sign_up', $data);
    }

    public function validate_email($email) {
        $query = $this->db->select('id')->get_where('user_sign_up', array('email_id' => $email));
        $no = $query->num_rows();
        return $no;
    }

    public function removePic($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('user_images');
    }

    public function image_model($user_id) {
        $this->db->select('image_name');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get('user_images');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->image_name;
        } else {
            return 'defaultPic.gif';
        }
    }
	public function cover_get($user_id) {
        $this->db->select('image_name');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 2);
        $query = $this->db->get('user_images');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->image_name;
        } else {
            return 'defaultCover.jpg';
        }
    }

    public function insert_sign_up($data) {
        $this->db->insert('user_sign_up', $data);
    }

    public function get_id($email) {
        $query = $this->db->select('id')->get_where('user_sign_up', array('email_id' => $email));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        }
    }

    public function setResetCode($email, $code) {
        $query = $this->db->select('id')->get_where('user_sign_up', array('email_id' => $email));
        $id = $query->row()->id;
        $data = array(
            'id' => $id,
            'code' => $code
        );

        $this->db->insert('password_recovery', $data);
    }

    public function getResetCode($code) {
        $query = $this->db->select('id')->get_where('password_recovery', array('code' => $code));
        $this->db->get('password_recovery');
        $id = $query->row()->id;

        if ($query->num_rows() > 0) {
            $email = $this->db->select('email_id')->get_where('user_sign_up', array('id' => $id));
            $row = $email->row();
            $this->db->where('code', $code);
            $this->db->delete('password_recovery');
            return $row->email_id;
        } else {
            return -1;
        }
    }

    public function getUserDetails($username) {
        /* $this->db->select('*');
          $this->db->from('user_sign_up');
          $this->db->where('email_id',$username); */

        $this->db->select('*');
        $this->db->from('user_sign_up');
        $this->db->where('email_id', $username);
        $this->db->join('user_info', 'user_info.user_id = user_sign_up.id', 'left');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->row_array();
            return $row;
        }
        else
            return 0;
    }

    public function getUserDetailsById($id) {

        $this->db->select('*');
        $this->db->from('user_sign_up');
        $this->db->where('user_sign_up.id', $id);
        $this->db->join('user_info', 'user_info.user_id = user_sign_up.id', 'left');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row = $query->row_array();
            return $row;
        }
        else
            return 0;
    }

    public function getActivationCode($email) {
        echo $email;
        $result = $this->db->get_where('user_sign_up', array('activation' => $email));
        echo $result->num_rows;
        if ($result->num_rows > 0) {
            $data = array(
                'activation' => '1');

            $this->db->where('activation', $email);
            $this->db->update('user_sign_up', $data);
        }
    }

    /*
      public function updateImage($newName)
      {
      $result = $this->db->get_where('user_sign_up', array('activation' => $email));
      }
     */

    public function insert_sign_up2($data) {
        $this->db->insert('user_info', $data);
    }

  
	 public function insert_image_info($data) {

        $result = $this->db->get_where('user_images', array('user_id' => $data['user_id'], 'is_active'=>$data['is_active']));
        if ($result->num_rows > 0) {
            $this->db->where('user_id', $data['user_id']);
			$this->db->where('is_active',$data['is_active']);
            $img = array('image_name' => $data['image_name']);
            $this->db->update('user_images', $img);
        } else {
            $this->db->insert('user_images', $data);
        }
    }

    public function login_model($username, $password) {
        $this->db->select('id');
        $this->db->where('email_id', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('user_sign_up');
        $rows = $query->num_rows();
        return $rows;
    }

    public function displayPeople_model() {


        $this->db->select('*');
        $this->db->from('user_sign_up');
        $this->db->join('user_images', 'user_images.user_id = user_sign_up.id');
        $query = $this->db->get();

//        if ($query->num_rows > 0) {
        $row = $query->result_array();
        return $row;
//        }
//        else
//            return 0;
    }

    public function addFriend($id, $fid) {
        $query = $this->db->select('first_name, last_name')->get_where('user_sign_up', array('id' => $id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $friend_first_name = $row->first_name;
            $friend_last_name = $row->last_name;
        }
        $data = Array(
            'user_id' => $id,
            'friend_id' => $fid,
            'friend_first_name' => $friend_first_name,
            'friend_last_name' => $friend_last_name
        );
        $this->db->insert('user_friends_request', $data);
    }

    public function ifFriend($userid, $id) {

        $query = $this->db->select('id')->get_where('user_friends', array('user_id' => $id, 'friend_id' => $userid));

        if ($query->num_rows() > 0) {
            return 2;
        }

        $query = $this->db->select('id')->get_where('user_friends', array('user_id' => $userid, 'friend_id' => $id));

        if ($query->num_rows() > 0) {
            return 2;
        }
        $query = $this->db->select('id')->get_where('user_friends_request', array('user_id' => $id, 'friend_id' => $userid));

        if ($query->num_rows() > 0) {
            return 1;
        }

        $query = $this->db->select('id')->get_where('user_friends_request', array('user_id' => $userid, 'friend_id' => $id));

        if ($query->num_rows() > 0) {
            return 3;
        }
    }

    public function viewFriends($id) {
        $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where('user_friends.user_id', $id);
        $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id', 'left');
        $query = $this->db->get();

        $row = $query->result_array();

        return $row;
    }

    public function viewMutualFriends($id, $fid) {
        $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where('user_friends.user_id', $id);
        $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id', 'left');
        $query = $this->db->get();
        $row = $query->result_array();

        $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where('user_friends.user_id', $fid);
        $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id', 'left');
        $query = $this->db->get();
        $row1 = $query->result_array();

        $result = Array();
        foreach ($row as $friend) {
            foreach ($row1 as $friend1) {
                if ($friend['friend_id'] == $friend1['friend_id']) {
                    array_push($result, $friend);
                }
            }
        }
        return $result;
    }

    public function viewRequests($id) {
        $this->db->select('*');
        $this->db->from('user_friends_request');
        $this->db->where('friend_id', $id);
        $query = $this->db->get();

        $row = $query->result_array();
        return $row;
    }

    public function ignoreRequest($id, $fid) {
        $query = $this->db->select('id')->get_where('user_friends_request', array('user_id' => $id, 'friend_id' => $fid));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->db->delete('user_friends_request', array('id' => $row->id));
        }
        $query = $this->db->select('id')->get_where('user_friends_request', array('user_id' => $fid, 'friend_id' => $id));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->db->delete('user_friends_request', array('id' => $row->id));
        }
    }

    public function deleteFriend($id, $fid) {
        $query = $this->db->select('id')->get_where('user_friends', array('user_id' => $id, 'friend_id' => $fid));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->db->delete('user_friends', array('id' => $row->id));
        }

        $query = $this->db->select('id')->get_where('user_friends', array('user_id' => $fid, 'friend_id' => $id));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->db->delete('user_friends', array('id' => $row->id));
        }
    }

    public function acceptRequest($id, $fid) {
        $query = $this->db->select('id, friend_first_name, friend_last_name')->get_where('user_friends_request', array('user_id' => $fid, 'friend_id' => $id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $friend_first_name = $row->friend_first_name;
            $friend_last_name = $row->friend_last_name;
        }
        $data = Array(
            'user_id' => $id,
            'friend_id' => $fid,
            'friend_first_name' => $friend_first_name,
            'friend_last_name' => $friend_last_name
        );
        $this->db->insert('user_friends', $data);

//        $row = getUserDetailsById($fid);
        $this->db->select('*');
        $this->db->from('user_sign_up');
        $this->db->where('user_sign_up.id', $id);
        $this->db->join('user_info', 'user_info.user_id = user_sign_up.id', 'left');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $row1 = $query->row_array();
        }

        $data = Array(
            'user_id' => $fid,
            'friend_id' => $id,
            'friend_first_name' => $row1['first_name'],
            'friend_last_name' => $row1['last_name']
        );
        $this->db->insert('user_friends', $data);
        $this->db->delete('user_friends_request', array('id' => $row->id));
    }

    public function updateInfo($data) {
        $this->db->where('user_id', $data['user_id']);
        if ($this->db->update('user_info', $data))
            return 1;
        return -1;
    }

    public function updateBirthday($data) {
        $this->db->where('id', $data['id']);
        if ($this->db->update('user_sign_up', array('birthday' => $data['birthday'])))
            return 1;
        return -1;
    }

    public function addWallPost($to, $from, $post) {
        $data = array('to_id' => $to, 'from_id' => $from, 'post' => $post, 'date_posted' => date('Y-m-d H:i:s'));
        $this->db->insert('wall_post', $data);
        return;
    }

    public function getWallPost($id) {
        $this->db->select('*');
        $this->db->from('wall_post');
        $this->db->where(array('to_id' => $id));
        $this->db->order_by("wall_post.id", "desc");
        $this->db->join('user_sign_up', 'user_sign_up.id = wall_post.from_id');
        $record = $this->db->get();
        $i = 0;

        foreach ($record->result() as $post): {
                $temp[$i]['first_name'] = $post->first_name;
                $temp[$i]['last_name'] = $post->last_name;
                $temp[$i]['post'] = $post->post;
                $temp[$i]['id'] = $post->id;
                $i++;
            }endforeach;
        if ($i == 0)
            $temp = 0;
        return $temp;
    }

    public function getNotification($id) {
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->order_by("id", "desc");
        $this->db->where(array('user_id' => $id));
        return $this->db->get()->result();
    }

    public function Notify($id, $notification, $link) {
        $addition = array('user_id' => $id, 'notice' => $notification, 'link' => $link);
        $this->db->insert('notification', $addition);
    }
	
		public function removeNotification($id){
	
		$this->db->delete('notification',array('id'=>$id));
	}

    public function search($name, $type) {
        if ($type == "firstname") {
            $this->db->select('*');
            $this->db->from('user_sign_up');
            $this->db->order_by("first_name", "asc");
            $this->db->where(array('first_name' => $name));
            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS

        if ($type == "lastname") {
            $this->db->select('*');
            $this->db->from('user_sign_up');
            $this->db->order_by("last_name", "asc");
            $this->db->where(array('last_name' => $name));
            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS

        if ($type == "school") {
            $this->db->select('*');
            $this->db->from('user_info');
            $this->db->order_by("school", "asc");
            $this->db->where(array('school' => $name));
            $this->db->join('user_sign_up', 'user_info.user_id=user_sign_up.id', 'left');
            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS

        if ($type == "university") {
            $this->db->select('*');
            $this->db->from('user_info');
            $this->db->order_by("university", "asc");
            $this->db->where(array('university' => $name));
            $this->db->join('user_sign_up', 'user_info.user_id=user_sign_up.id', 'left');

            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS

        if ($type = "employer") {
            $this->db->select('*');
            $this->db->from('user_info');
            $this->db->order_by("employer", "asc");
            $this->db->where(array('employer' => $name));
            $this->db->join('user_sign_up', 'user_info.user_id=user_sign_up.id', 'left');

            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS

        if ($type == "city") {
            $this->db->select('*');
            $this->db->from('user_info');
            $this->db->order_by("city", "asc");
            $this->db->where(array('city' => $name));
            $this->db->join('user_sign_up', 'user_info.user_id=user_sign_up.id', 'left');
			
			
            $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
            $query = $this->db->get();
            if ($query->num_rows > 0)
                return $query->result_array();
            return "0";
        } // IF ENDS
		
		
    }
	
	public function searchF($name,$from,$id)
	{		
		
			
			$this->db->select('*');
			$this->db->from("user_friends");
			$this->db->where(array('user_id'=>$id, 'friend_first_name'=>$name));
			$this->db->or_where(array('friend_last_name'=>$name, 'user_id'=>$id));
            $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id');
			$query=$this->db->get();
		
			if($query->num_rows>0)
				{return $query->result_array();}
				else{
			return "nada";}
			
			
	}
	
	public function searchMF($name,$from,$of,$otherOf)
	{		
		  $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where(array('user_friends.user_id' =>$of, 'friend_first_name'=>$name));
		$this->db->or_where(array('user_friends.user_id' =>$of, 'friend_last_name'=>$name));
        $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id', 'left');
        $query = $this->db->get();
        $row = $query->result_array();

        $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where(array('user_friends.user_id' =>$otherOf, 'friend_first_name'=>$name));
		$this->db->or_where(array('user_friends.user_id' =>$otherOf, 'friend_last_name'=>$name));
        $this->db->join('user_images', 'user_images.user_id = user_friends.friend_id', 'left');
        $query = $this->db->get();
        $row1 = $query->result_array();

        $result = Array();
        foreach ($row as $friend) {
            foreach ($row1 as $friend1) {
                if ($friend['friend_id'] == $friend1['friend_id']) {
                    array_push($result, $friend);
                }
            }
        }
        return $result;
	}
	
    public function filteredSearch($where) {
        $this->db->select('*');
        $this->db->from('user_sign_up');
        $this->db->join('user_info', 'user_info.user_id=user_sign_up.id', 'left');
        $this->db->join('user_images', 'user_images.user_id = user_sign_up.id', 'left');
        foreach ($where as $c): {
                $this->db->where($c);
            }endforeach;
        $query = $this->db->get();
        if ($query->num_rows > 0)
            return $query->result_array();
        return "0";
    }
	//add newsfeed post
	public function addPost($id, $content, $link, $type)
	{
		  $data = array('user_id' => $id, 'content' => $content, 'link' => $link, 'type' => $type);
        $this->db->insert('post', $data);
	}
	public function addPost_img($id, $content, $link, $type,$img)
	{
		  $data = array('user_id' => $id, 'content' => $content, 'link' => $link, 'type' => $type,'linkimage'=>$img);
        $this->db->insert('post', $data);
	}
	public function getPosts($id,$iter)
	{
		$this->db->select('friend_id');
		$this->db->from('user_friends');
		$this->db->where('user_id',$id);
		$ids=$this->db->get()->result_array();
		$i=0;
		foreach($ids as $f):
		{
		$arr[$i]= $f['friend_id'];
		$i++;
		}endforeach;
		$name='user_id';
		$this->db->select('*');
		$this->db->from('post');
		
		$this->db->where_in($name,$arr);
	$this->db->having('post_id >',$iter);
		$this->db->or_where('user_id', $id); 
		 
		$this->db->join('user_sign_up','user_sign_up.id=user_id');

		$query=$this->db->get();
	return $query->result_array();
		

		
	}
	public function delete_post_row($post_id, $id)	
{	 	
    $this->db->delete('post', array('user_id' => $id, 'post_id'=> $post_id)); 
}
}

?>