<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TODO: Find out the best way to do this
require_once $_SERVER['DOCUMENT_ROOT'].'/www/todo/application/libraries/User_Controller.php';

class Dashboard extends User_Controller {
    
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
     * index action
     */
    public function index() {
        $this->lists();
    }
    
    /**
     * lists action
     * 
     * @return void
     */
    public function lists() {
        
        switch ($this->uri->segment(3)) {
            case 'add':
                return $this->addList(1);
            break;
        
            case 'delete':
                // Segment 4 should be our id
                return $this->deleteList($this->uri->segment(4));                
            break;
        }
        
        // Get all lists for the user
        $this->load->model('user_model');
        $this->data['lists'] = $this->user_model->getLists($this->session->userdata('id'))->result();
                
        $this->layout->view('dashboard', $this->data);                
    }
    
    /**
     * slapps action
     */
    public function slapps() {
        
        // Get all lists for the user
        $this->load->model('user_model');
        $slapps = $this->user_model->getSlapps($this->session->userdata('id'));     
        
        $this->data['slapps'] = $slapps->result();    
        
        foreach ($this->data['slapps'] as $k=>$slapp) {
            $this->data['slapps'][$k]->username = $this->user_model->userIdToUsername($slapp->user_id);
        }
                                        
        $this->layout->view('dashboard', $this->data);
    }
    
    /**
     * slapped action
     */
    public function slapped() {
        
        // Get all lists for the user
        $this->load->model('user_model');
        $slapped = $this->user_model->getSlapped($this->session->userdata('id'));   
        
        $this->data['slapped'] = $slapped->result();    
        
        foreach ($this->data['slapped'] as $k=>$slapp) {
            $this->data['slapped'][$k]->username = $this->user_model->userIdToUsername($slapp->user_id);
        }
                                
        $this->layout->view('dashboard', $this->data);
    }    
    
    /**
     * Add a new list
     */
    protected function addList($isOwner=0) {
        $this->load->model('list_model');        
        
        $this->list_model->addList($this->session->userdata('id'), $isOwner);
        
        $this->session->set_flashdata('success', 'You have successfully added a new list');
        redirect('dashboard/lists');
    }
    
    /**
     *
     * @param int $listId 
     */          
    protected function deleteList($listId) {
        $this->load->model('list_model');   
        
        // First check the user does have the right to delete this list
        $deleted = $this->list_model->deleteList($listId, $this->session->userdata('id'));
        
        if ($deleted) {                
            $this->session->set_flashdata('success', 'You have successfully deleted a list');
        } else {
            $this->session->set_flashdata('failure', 'List could not be deleted');
        }
        redirect('dashboard/lists');
    }    
    
    /**
     * Load data
     */
    private function loadData() {
        $this->data['title'] = 'Dashboard';
    }
}