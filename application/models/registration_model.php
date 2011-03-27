<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }    

    public function addUser() {
        $data = array(
                'username' => $this->input->post('username'),
                    'display_name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')
        );
        
        $this->db->insert('user', $data);
        return null;
    }
    
    public function verifyUniqueUsername($username) {
        $this->db->where('username', $username);
        $q = $this->db->get('user');
        
        if ($q->num_rows() > 0)  {
            return false;
        } else {
            return true;
        }
    }
    
    public function verifyUniqueEmail($email) {
        $this->db->where('email', $email);
        $q = $this->db->get('user');
        
        if ($q->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
}