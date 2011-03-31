<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->loadData();
    }
    
    public function index() {
        
        if ($this->form_validation->run('login') === FALSE) {            
            $this->layout->view('registration', $this->data);
        } else {
            // if user is valid
            $this->load->model('login_model');
            $validUserId = $this->login_model->validateUser();
            
            if ($validUserId) {
                $data = array(
                        'id' => $validUserId,
                        'username' => $this->input->post('username'),
                        'activeUser' => true
                );
                
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success', 'You have successfully logged into your account');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Information submitted is incorrect.');
                redirect(uri_string());
            }
        }
    }
    
    protected function loadData() {
        $this->data['title'] = 'Login';
    }
}