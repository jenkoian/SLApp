<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {
    
    public $data = array();

    public function __construct() {
        parent::__construct();    
        $this->loadData();
    }    
    
    /**
     * @return void
     */
    public function index() {
        $this->layout->view('about', $this->data);
    }    
    
    /**
     * @return void
     */
    protected function loadData() {        
        $this->data['title'] = 'SLAPP!';
    }    

}

?>
