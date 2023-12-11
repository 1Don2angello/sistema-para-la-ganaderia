<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Livestock extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('livestock_model');
        $this->load->library('upload');
        $this->load->model('ion_auth_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('settings/settings_model');
        $this->load->model('home/home_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['livestocks'] = $this->livestock_model->getLivestock();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('livestock', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $livestock_id = $this->input->post('l_id');
        $livestock_name = $this->input->post('livestock_name');
        $note = $this->input->post('note');
        $date = $this->input->post('date');
        //$date = strtotime($date);
        //$age = $this->input->post('age');
        $quantity = $this->input->post('quantity');


        if (empty($livestock_id)) {
            $livestock_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('livestock', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('livestock_name', 'Livestock Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('note', 'Note', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|min_length[1]|max_length[100]|xss_clean');

       


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("livestock/editLivestock?id=$id");
            } else {
                redirect("livestock/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'livestock_id' => $livestock_id,
                'note' => $note,
                'livestock_name' => $livestock_name,
                'date' => $date,
                'quantity' => $quantity,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->livestock_model->insertLivestock($data);
                redirect('livestock');
            } else {
                $this->livestock_model->updateLivestock($id, $data);
                redirect('livestock');
            }
        }
    }

    function getLivestock() {
        $data['livestock'] = $this->livestock_model->getLivestock();
        $this->load->view('livestock', $data);
    }

    function editLivestock() {
        $data = array();
        $id = $this->input->get('id');
        $data['livestock'] = $this->livestock_model->getLivestockById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editLivestockByJason() {
        $id = $this->input->get('id');
        $data['livestock'] = $this->livestock_model->getLivestockById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->livestock_model->deleteLivestock($id);
        redirect('livestock');
    }

}

/* End of file livestock.php */
/* Location: ./application/modules/livestock/controllers/livestock.php */  
