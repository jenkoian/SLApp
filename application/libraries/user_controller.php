<?php if (! defined('BASEPATH')) {exit('No direct script access allow');}

class User_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->activeUser();
    }
    
    public function activeUser() {
        $activeUser = $this->session->userdata('activeUser');
        
        if(!isset($activeUser) || $activeUser != true)  {
            $this->session->flashdata('error', 'You must login before going to this page');
            redirect('login');
        }
    }
}