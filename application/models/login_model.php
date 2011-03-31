<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }    

    public function validateUser() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('password'));
        $q = $this->db->get('user');
                                
        
        if ($q->num_rows == 1)  {
            
            $user = $q->result();
            
            return $user[0]->id;
        } else {
            return false;
        }
    }
}