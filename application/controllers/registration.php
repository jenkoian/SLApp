<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->loadData();
    }
    
    public function index() {               
        
        // Checks to see if form validation rules were met an executed properly.  If not, will return with registration form.
        if ($this->form_validation->run('registration') === FALSE)  {
            $this->layout->view('registration', $this->data);
        } else {
            // If validation passes, information will be passed along to the MODEL to be processed and the account will be created.
            $this->load->model('registration_model');
            $this->registration_model->addUser();
            
            $data = array(
                    'username' => $this->input->post('username'),
                    'activeUser' => true
            );            
            $this->session->set_userdata($data);
            
            $this->session->set_flashdata('success', 'Your account has been successfully created');
            redirect('dashboard');
        }
    }
    
    /**
     *
     * @param type $username
     * @return type 
     */
    protected function _verifyUniqueUsername($username) {
    	// Call to MODEL to check db for any existing records that match the $username passed variable.
        $this->load->model('registration_model');
        $uniqueUser = $this->registration_model->verifyUniqueUsername($username);
        
        // If username entered is unique, then registration process will continue.
        if ($uniqueUser)  {
            return true;
        } else {
            // If username entered is not unique and has already been used, will return FALSE and an error message will appear prompting the user to choose a new username.
            $this->form_validation->set_message('verifyUniqueUsername', 'The %s you entered is already in use.  Please select another username.');
            return false;
        }
    }
    
    /**
     *
     * @param type $email
     * @return type 
     */
    protected function _verifyUniqueEmail($email) {
    	// Call to MODEL to check db for any existing records that match the $email passed variable.
        $this->load->model('registration_model');
        $uniqueEmail = $this->registration_model->verifyUniqueEmail($email);
        
        // If email entered is unique, then registration process will continue.
        if ($uniqueEmail) {
            return true;
        } else  {
            // If email entered is not unique and has already been used, will return FALSE and an error message will appear prompting the user to choose a new email.
            $this->form_validation->set_message('verifyUniqueEmail', 'The email address you entered is already in use.  Please select another email.');
            return false;
        }
    }
    
    /**
     * @return void
     */
    protected function loadData() {        
        $this->data['title'] = 'Registration';
    }    
}