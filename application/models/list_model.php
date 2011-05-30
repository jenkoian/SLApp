<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * List model
 */
class List_model extends CI_Model {
    
    public $listId;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setListId($listId) {
        $this->listId = $listId;
    }
    
    /**
     *
     * @param int $id
     * @return array 
     */
    public function get() {
        return $this->db->get_where('list_item', array('list_id'=>$this->listId))->result();
    }    
    
    /**
     *
     * @param int $userId
     * @param bool $isOwner
     * @return int $listId
     */
    public function addList($userId, $isOwner=0) {
        
        $data = array(
                'title'=>'[Click to add title]',
                'date_created' => date("Y-m-d H:i:s"),                
        );
        
        $this->db->insert('list', $data);
        
        $listId = $this->db->insert_id();
        
        $user_data = array (
            'user_id' => $userId,
            'list_id' => $listId,
            'is_owner' => $isOwner
        );
        
        $this->db->insert('user_lists', $user_data);
        
        return $listId;        
    }
    
    /**
     *
     * @param int $listId
     * @param int $userId
     * @return bool
     */
    public function deleteList($listId, $userId) {
     
        // Check user is owner
        if ($this->isListOwner($userId)) {
            $this->db->delete('list',array('id'=>$listId));
            $this->db->delete('user_lists',array('list_id'=>$listId));
            
            return true;
        }
        
        return false;
    }
    
    /**
     *
     * @return string $title 
     */
    public function getListTitle() {
        $list = $this->db->get_where('list', array('id'=>$this->listId))->result();
        
        if (empty($list)) {
            return;
        }
        return $list[0]->title;
    }

    /**
     * @return array
     */
    public function getItems() {
        return $this->get($this->listId);
    }

    /**
     * @return int
     */
    public function getTotalDoneItems() {
        return count($this->db->get_where('list_item', array('list_id'=>$this->listId, 'is_done'=>1))->result());
    }

    /**
     * @return int
     */
    public function getTotalItems() {
        return count($this->getItems());
    }

    /**
     *
     * @return float 
     */
    public function calculatePercentage() {
        if ($this->getTotalItems() < 1) {
            return 0;
        }
        return number_format(($this->getTotalDoneItems() / $this->getTotalItems()) * 100,0);
    }    
    
    /**
     *
     * @param int $userId
     * @return int 
     */
    public function isListOwner($listId, $userId) {        
        return count($this->db->get_where('user_lists', array('list_id'=>$listId, 'user_id'=>$userId, 'is_owner'=>1))->result());      
    }
    
    /**
     *
     * @param type $listId
     * @return string
     */
    public function listIdToListTitle($listId) {
        $this->db->select('title');
        $this->db->where('id', $listId);
        
        $result =  $this->db->get('list')->row();               
        
        return $result->title;
    }
}
