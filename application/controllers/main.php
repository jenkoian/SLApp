<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->loadData();
    }

    /**
     * @return void
     */
    public function index() {
        $this->layout->view('main', $this->data);
    }

    /**
     * @return void
     */
    public function uncomplete() {
        $this->load->model('Item_model');

        $this->Item_model->db->update('listItem', array('is_done'=>0), 'id = '.$this->uri->segment(4));

        if ($this->input->get('ajax') == 1) {
            echo $this->Item_model->calculatePercentage();
            exit;
        }

        redirect('main/index');
    }

    /**
     * @return void
     */
    public function complete() {
        $this->load->model('Item_model');
        $this->Item_model->db->update('listItem', array('is_done'=>1), 'id = '.$this->uri->segment(4));

        if ($this->input->get('ajax') == 1) {
            echo $this->Item_model->calculatePercentage();
            exit;
        }

        redirect('main/index');
    }

    /**
     * @todo This should reutrn the percentage like the other methods and the
     *       html should be built in the js
     * @return string
     */
    public function add() {
        $this->load->model('Item_model');
        $data = array('title'=>'[Click to edit title]',
                      'comments'=>'[Click to edit description]',
                      'is_done'=>0,
                      'listId'=>1);

        $this->Item_model->db->insert('listItem', $data);        

        if ($this->input->get('ajax') == 1) {
            echo $this->Item_model->calculatePercentage();
            exit;
        }

        redirect('main/index');
    }

    /**
     * @return int|string
     */
    public function delete() {
        // Mark an item as complete
        if (is_numeric($this->uri->segment(4))) {
            $this->load->model('Item_model');
            $this->Item_model->db->delete('listItem', array('id' => $this->uri->segment(4)));
        }

        if ($this->input->get('ajax') == 1) {
            echo $this->Item_model->calculatePercentage();
            exit;
        }

        redirect('main/index');
    }

    /**
     * Edit content of list, can be either list title, title (of an item) or comment (of an item)
     *
     * @return void
     */
    public function edit() {
        $this->load->model('Item_model');

        $result = '';

        switch ($this->uri->segment(3)) {
            case 'list_title':
                $result = str_replace('[total]',$this->Item_model->getTotalItems(),$this->input->post('list_title'));
                $this->Item_model->db->update('list', array('title'=>$result), 'id = 1');
            break;
            // List title/comments
            default:
                list($field, $id) = explode('_',$this->input->post('id'));
                $result = $this->input->post($field);

                $this->Item_model->db->update('listItem', array($field=>$result), 'id = '.$id);
            break;
        }

        if ($this->input->post('ajax') == 1) {
            echo $result;
            exit;
        }

        redirect('main/index');
    }

    /**
     * 
     * @todo Refactor this, this should be built in the JS
     * @return string
     */
    public function getLatestItemHTML() {
        $this->load->model('Item_model');
        
        // Get the latest addition
        $this->Item_model->db->select('*');
        $this->Item_model->db->from('listItem');
        $this->Item_model->db->order_by('id', 'desc');
        $this->Item_model->db->limit(1);

        $new_item = $this->Item_model->db->get()->result();

        $new_row = $new_item[0];
        
        $return = '<tr>
                    <td class="id" valign="top">'.($this->Item_model->getTotalItems()).'.</td>
                    <td>
                        <span class="title" id="title_'.$new_row->id.'">'.$new_row->title.'</span>
                        <br />
                        <span class="comments" id="comments_'.$new_row->id.'">'.$new_row->comments.'</span>
                    </td>
                    <td valign="top" class="status">'.anchor('main/complete/item/'.$new_row->id, '<img src="'.site_url().'images/complete.png" alt="Complete" class="complete-icon" />', 'class="complete_'.$new_row->id.'"').'</td>
                    <td valign="top" class="delete">'.anchor('main/delete/item/'.$new_row->id, '<img src="'.site_url().'images/delete.png" alt="Delete" class="delete-icon" />', 'class="delete_'.$new_row->id.'"').'</td>
                </tr>';   
        
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
        $this->load->model('Item_model');
        
        $this->data['title'] = $this->Item_model->getListTitle();
        $this->data['percentage'] = $this->Item_model->calculatePercentage();
        $this->data['items'] = $this->Item_model->getItems();
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */