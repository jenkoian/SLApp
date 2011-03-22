<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * List item model
 */
class Item_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param int $id
     * @return array 
     */
    public function get($id) {
        return $this->db->get_where('list_item', array('list_id'=>$id))->result();
    }
    
    /**
     *
     * @return string $title 
     */
    public function getListTitle() {
        $list = $this->db->get_where('list', array('id'=>1))->result();
        
        if (empty($list)) {
            return;
        }
        return $list[0]->title;
    }

    /**
     * @return array
     */
    public function getItems() {
        return $this->get(1);
    }

    /**
     * @return int
     */
    public function getTotalDoneItems() {
        return count($this->db->get_where('list_item', array('list_id'=>1, 'is_done'=>1))->result());
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
}
