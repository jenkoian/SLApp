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
        $this->layout->view('dashboard', $this->data);
    }
    
    private function loadData() {
        $this->data['title'] = 'Dashboard';
    }
}