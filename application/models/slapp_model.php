<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slapp_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     *
     * @param int $userId
     * @param bool $isOwner
     * @return int $listId
     */
    public function slappUser(User_Model $userModel, $username, $listId, $ownerId) {                   
        
        $userInfo = $userModel->getUserInfo($username);       
        
        // Ensure this user hasn't already been slapped with this list
        if ($this->userBeenSlapped($userInfo['id'], $listId)) {
            return false;
        }

        $user_data = array (
            'user_id' => $userInfo['id'],
            'list_id' => $listId,
            'owner_id' => $ownerId
        );
        
        $this->db->insert('user_lists', $user_data);
        
        return $listId;        
    }    
    
    /**
     * Has the user already been slapped with this list?
     *
     * @param int $userId
     * @param int $listId
     * @return int
     */
    protected function userBeenSlapped($userId, $listId) {
        $this->db->where('user_id', $userId);    
        $this->db->where('list_id', $listId);    
  
        return $this->db->count_all_results('user_lists');                
    }
    
}