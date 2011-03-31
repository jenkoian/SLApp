<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// TODO: Find out the best way to do this
require_once $_SERVER['DOCUMENT_ROOT'].'/www/todo/application/libraries/User_Controller.php';

class Profile extends User_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        $this->load->model('user_model', 'profile');
        
        if ($this->form_validation->run('editUser') === FALSE) {
            $userinfo = $this->profile->getUserInfo($this->session->userdata('username'));
            $data['userInfo'] = $userinfo;
            
            $data ['title'] = 'Profile';
            $data['main_content'] = 'profile';
            $this->load->view('include/template', $data);        
        } else {
            $this->profile->updateUserInfo();
            $this->session->set_flashdata('success', 'You have successfully updated your profile info.');
            redirect(uri_string());
        }
    }    
}