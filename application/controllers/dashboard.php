<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TODO: Find out the best way to do this
require_once $_SERVER['DOCUMENT_ROOT'].'/www/todo/application/libraries/User_Controller.php';

class Dashboard extends User_Controller {
    
    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->loadData();
    }
    
    public function index() {
        $this->lists();
    }
    
    public function lists() {
        // Are they trying to add a list?
        if ($this->uri->segment(3) == 'add') {
            return $this->addList();
        }
        
        // Get all lists for the user
        $this->load->model('user_model');
        $this->data['lists'] = $this->user_model->getLists($this->session->userdata('id'));
                
        $this->layout->view('dashboard', $this->data);                
    }
    
    protected function addList() {
        $this->load->model('list_model');        
        
        $this->list_model->addList($this->session->userdata('id'));
        
        $this->session->set_flashdata('success', 'You have successfully added a new list');
        redirect('dashboard/lists');
    }
    
    private function loadData() {
        $this->data['title'] = 'Dashboard';
    }
}