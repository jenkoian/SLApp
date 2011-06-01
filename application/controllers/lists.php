<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @todo: Loads of this needs to be moved to the model
 */
class Lists extends CI_Controller {

    public $data = array();
    
    public $listId;

    public function __construct() {
        parent::__construct();
        
        $this->listId = $this->uri->segment(3);
        $this->loadData();        
    }

    /**
     * @return void
     */
    public function index() {
        $this->layout->view('lists', $this->data);
    }
    
    public function view() {
        $this->index();
    }

    /**
     * @return void
     */
    public function uncomplete() {
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);

        $this->list->db->update('list_item', array('is_done'=>0), 'id = '.$this->uri->segment(5));

        if ($this->input->get('ajax') == 1) {
            echo $this->list->calculatePercentage();
            exit;
        }

        redirect('lists/view/'.$this->listId);
    }

    /**
     * @return void
     */
    public function complete() {
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);
        
        $this->list->db->update('list_item', array('is_done'=>1), 'id = '.$this->uri->segment(5));

        if ($this->input->get('ajax') == 1) {
            echo $this->list->calculatePercentage();
            exit;
        }

        redirect('lists/view/'.$this->listId);
    }

    /**
     * @todo This should reutrn the percentage like the other methods and the
     *       html should be built in the js
     * @return string
     */
    public function add() {
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);
        
        $data = array('title'=>'[Click to edit title]',
                      'comments'=>'[Click to edit description]',
                      'is_done'=>0,
                      'list_id'=>$this->listId);

        $this->list->db->insert('list_item', $data);        

        if ($this->input->get('ajax') == 1) {
            echo $this->list->calculatePercentage();
            exit;
        }

        redirect('lists/view/'.$this->listId);
    }

    /**
     * @return int|string
     */
    public function delete() {
        
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);        

        // Mark an item as complete        
        if (is_numeric($this->uri->segment(5))) {
            
            $this->list->db->delete('list_item', array('id' => $this->uri->segment(5)));
        }

        if ($this->input->get('ajax') == 1) {
            echo $this->list->calculatePercentage();
            exit;
        }

        redirect('lists/view/'.$this->listId);
    }

    /**
     * Edit content of list, can be either list title, title (of an item) or comment (of an item)
     *
     * @return void
     */
    public function edit() {        
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);  

        $result = '';

        switch ($this->uri->segment(4)) {
            case 'list_title':
                $result = str_replace('[total]',$this->list->getTotalItems(),$this->input->post('list_title'));
                $this->list->db->update('list', array('title'=>$result), 'id = '.$this->listId);
            break;
            // List title/comments
            default:
                list($field, $id) = explode('_',$this->input->post('id'));
                $result = $this->input->post($field);

                $this->list->db->update('list_item', array($field=>$result), 'id = '.$id);
            break;
        }

        if ($this->input->post('ajax') == 1) {
            echo $result;
            exit;
        }

        redirect('lists/view/'.$this->listId);
    }

    /**
     * 
     * @todo Refactor this, this should be built in the JS
     * @return string
     */
    public function getLatestItemHTML() {
        $this->load->model('list_model', 'list');        
        
        // Get the latest addition
        $this->list->db->select('*');
        $this->list->db->from('list_item');        
        $this->list->db->order_by('id', 'desc');
        $this->list->db->limit(1);

        $new_item = $this->list->db->get()->result();

        $new_row = $new_item[0];
        
        $return = '<li>
                    <span class="item">
                        <span class="title" id="title_'.$new_row->id.'">'.$new_row->title.'</span>
                        <br />
                        <span class="comments" id="comments_'.$new_row->id.'">'.$new_row->comments.'</span>
                    </span>
                    <span class="status">'.anchor('lists/complete/'.$this->listId.'/item/'.$new_row->id, '<img src="'.site_url().'images/complete.png" alt="Complete" class="complete-icon" />', 'class="complete_'.$new_row->id.'"').'</span>
                    <span class="delete">'.anchor('lists/delete/'.$this->listId.'/item/'.$new_row->id, '<img src="'.site_url().'images/delete.png" alt="Delete" class="delete-icon" />', 'class="delete_'.$new_row->id.'"').'</span>
                </li>';   
        
        if ($this->input->get('ajax') == 1) {
            echo $return;
            exit;
        }
        
        return $return;
    }

    /**
     * @return void
     */
    protected function loadData() {
        $this->load->model('list_model', 'list');
        $this->list->setListId($this->listId);  
        
        $this->data['title'] = $this->list->getListTitle();
        $this->data['percentage'] = $this->list->calculatePercentage();
        $this->data['items'] = $this->list->getItems();
        $this->data['listId'] = $this->listId;
        $this->data['ownerId'] = $this->list->getOwner();
        $this->data['userId'] = $this->session->userdata('id');
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */