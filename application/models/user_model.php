<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }   
    
    /**
     *
     * @param string $username
     * @return array
     */
    public function getUserInfo($username) {
        $data = array();
        $this->db->where('username', $username);
        $this->db->limit(1);
        $q = $this->db->get('user');
        
        if (!$q)  {
            throw new CI_Exception('Error no users found');
        }
        
        if ($q->num_rows() >0) {
            $data = $q->row_array();
        }
        
        $q->free_result();
        return $data;
    }
    
    /**
     *
     * @param int $userId
     * @return array 
     */
    public function getLists($userId) {        
        $this->db->where('user_id', $userId);    
        $this->db->where('owner_id', $userId); 
        $this->db->join('list', 'list.id = user_lists.list_id');
        
        return $this->db->get('user_lists');                 
    }
    
    /**
     *
     * @param int $userId
     * @return array 
     */
    public function getSlapps($userId) {        
        $this->db->where('user_id', $userId);    
        $this->db->where('owner_id != ', $userId); 
        $this->db->join('list', 'list.id = user_lists.list_id');
        
        return $this->db->get('user_lists');                 
    }    
    
    /**
     *
     * @param int $userId
     * @return array 
     */
    public function getSlapped($userId) {        
        
        $this->db->select();
        $this->db->from('user_lists');
        $this->db->where('user_id != ', $userId);
        $this->db->where('owner_id', $userId);            
        $this->db->join('list', 'list.id = user_lists.list_id');  
                
        return $this->db->get();                 
    }    
    
    /**
     * Update the user information
     */
    public function updateUserInfo()  {
        $data = array(
            'email' => $this->input->post('email')
        );
        
        if ($this->input->post('password')){
            $data['password'] = $this->input->post('password');
        }        

        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('user', $data); 
    }
    
    /**
     *
     * @param int $userId
     * @return string
     */
    public function userIdToUsername($userId) {
        
        $this->db->where('id', $userId);
        $result = $this->db->get('user')->row();
        
        return $result->username;
    }
}