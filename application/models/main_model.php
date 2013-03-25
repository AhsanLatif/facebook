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

        $result = $this->db->get_where('user_images', array('user_id' => $data['user_id']));
        if ($result->num_rows > 0) {
            $this->db->where('user_id', $data['user_id']);
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

    public function viewFriends($id) {
        $this->db->select('*');
        $this->db->from('user_friends');
        $this->db->where('user_id', $id);
        $query = $this->db->get();

        $row = $query->result_array();
        return $row;
    }

    public function viewRequests($id) {
        $this->db->select('*');
        $this->db->from('user_friends_request');
        $this->db->where('user_id', $id);
        $query = $this->db->get();

        $row = $query->result_array();
        return $row;
    }

    public function ignoreRequest($id, $fid) {
        $query = $this->db->select('id')->get_where('user_friends_request', array('user_id' => $id, 'friend_id' => $fid));
        $this->db->delete('user_friends_request', array('id' => $row->id));
    }

    public function deleteFriend($id, $fid) {
        $query = $this->db->select('id')->get_where('user_friends', array('user_id' => $id, 'friend_id' => $fid));
        $this->db->delete('user_friends_request', array('id' => $row->id));
    }

    public function acceptRequest($id, $fid) {
        $query = $this->db->select('id, friend_first_name, friend_last_name')->get_where('user_friends_request', array('user_id' => $id, 'friend_id' => $fid));

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
        $this->db->delete('user_friends_request', array('id' => $row->id));
    }

}

?>