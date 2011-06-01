<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TODO: Find out the best way to do this
require_once $_SERVER['DOCUMENT_ROOT'].'/www/todo/application/libraries/User_Controller.php';

class Slapp extends User_Controller {
    
    /**
     * @var array
     */
    public $data = array();
    
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->loadData();
    }
    
    /**
     * Confusingly perhaps, we're not listing anything, rather this will be used
     * to 'slapp' a list on to another user
     */
    public function lists() {
        // Ensure we have a list id
        if (!$this->uri->segment(3)) {
            return false;
        }
        
        $this->data['listId'] = $this->uri->segment(3);
        $this->layout->view('slapp', $this->data);         
    }
    
    /**
     * Slapp a user with a list, username will be the form vallue username
     */
    public function user() {
        
        $this->load->model('user_model');
        $this->load->model('slapp_model');
        $this->load->model('list_model');
        
        $username = $this->input->post('username');        
        $listId = $this->input->post('listId');
        
        if (!$listId) {
            throw new Exception('Need a list ID to slapp a user');
        }
        
        if (!$this->list_model->isListOwner($listId, $this->session->userdata('id'))) {
            $this->session->set_flashdata('error', 'You are not the owner of this list');      
            redirect('dashboard/lists');   
        }                
        
        if ($this->slapp_model->slappUser($this->user_model, $username, $listId, $this->session->userdata('id'))) {
            $this->session->set_flashdata('success', 'You have successfully slapped '.$this->list_model->listIdToListTitle($listId).' on to user '.$username);
            redirect('dashboard/lists');  
        } else {
            $this->session->set_flashdata('error', 'Could not slapp '.$this->list_model->listIdToListTitle($listId).' on to user '.$username);      
            redirect('dashboard/lists');    
        }
        
    }
    
    /**
     * Load data
     */
    private function loadData() {
        $this->data['title'] = 'Slapp';
    }    
}