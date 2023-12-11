<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shed extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('shed_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        $this->load->model('settings/settings_model');
        $this->load->model('home/home_model');
        $this->load->model('livestock/livestock_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data = array();
        $data['livestocks'] = $this->livestock_model->getLivestock();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sheds'] = $this->shed_model->getShed();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('shed', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['livestocks'] = $this->livestock_model->getLivestock();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $shed_id = $this->input->post('s_id');
        $chicken_type = $this->input->post('chicken_type');
        $no = $this->input->post('no');
        $date = $this->input->post('date');
        //$date = strtotime($date);
        $age = $this->input->post('age');
        $quantity = $this->input->post('quantity');


        if (empty($shed_id)) {
            $shed_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('shed', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('no', 'Shed No', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('chicken_type', 'Livestock Type', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Amount Field   
        $this->form_validation->set_rules('age', 'Age (Days)', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("shed/editShed?id=$id");
            } else {
                redirect("shed/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'shed_id' => $shed_id,
                'no' => $no,
                'chicken_type' => $chicken_type,
                'date' => $date,
                'age' => $age,
                'quantity' => $quantity,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->shed_model->insertShed($data);
                redirect('shed');
            } else {
                $this->shed_model->updateShed($id, $data);
                redirect('shed');
            }
        }
    }

    function getShed() {
        $data['shed'] = $this->shed_model->getShed();
        $this->load->view('shed', $data);
    }

    function editShed() {
        $data = array();
        $id = $this->input->get('id');
        $data['shed'] = $this->shed_model->getShedById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editShedByJason() {
        $id = $this->input->get('id');
        $data['shed'] = $this->shed_model->getShedById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->shed_model->deleteShed($id);
        redirect('shed');
    }

}

/* End of file shed.php */
/* Location: ./application/modules/shed/controllers/shed.php */  
