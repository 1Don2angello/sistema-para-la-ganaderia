<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('medicine_model');
        $this->load->library('upload');
        $this->load->model('ion_auth_model');
        $this->load->model('shed/shed_model');
        $this->load->model('settings/settings_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['sheds'] = $this->shed_model->getShed();
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['sheds'] = $this->shed_model->getShed();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $medicine_id = $this->input->post('m_id');
        $duration = $this->input->post('duration');
        $no = $this->input->post('no');
        $p_date = $this->input->post('p_date');
        $n_date = $this->input->post('n_date');
        $l_date = $this->input->post('l_date');



        if (empty($medicine_id)) {
            $medicine_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('no', 'Shed No', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('duration', 'Medicine Duration', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Medicines Field
        $this->form_validation->set_rules('p_date', 'Previous Medicine Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Amount Field   
        $this->form_validation->set_rules('n_date', 'Next Medicine Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        $this->form_validation->set_rules('l_date', 'Last Medicine Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("medicine/editMedicine?id=$id");
            } else {
                redirect("medicine/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'medicine_id' => $medicine_id,
                'no' => $no,
                'duration' => $duration,
                'p_date' => $p_date,
                'n_date' => $n_date,
                'l_date' => $l_date,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->medicine_model->insertMedicine($data);
                redirect('medicine');
            } else {
                $this->medicine_model->updateMedicine($id, $data);
                redirect('medicine');
            }
        }
    }

    function getMedicine() {
        $data['medicine'] = $this->medicine_model->getMedicine();
        $this->load->view('medicine', $data);
    }

    function editMedicine() {
        $data = array();
        $id = $this->input->get('id');
        $data['sheds'] = $this->shed_model->getShed();
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicineByJason() {
        $id = $this->input->get('id');
        $data['sheds'] = $this->shed_model->getShed();
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->medicine_model->deleteMedicine($id);
        redirect('medicine');
    }

}

/* End of file medicine.php */
/* Location: ./application/modules/medicine/controllers/medicine.php */  
