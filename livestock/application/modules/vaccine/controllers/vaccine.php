<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vaccine extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('vaccine_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        $this->load->model('settings/settings_model');
        $this->load->model('shed/shed_model');
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
        $data['vaccines'] = $this->vaccine_model->getVaccine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('vaccine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sheds'] = $this->shed_model->getShed();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function shedHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['sheds'] = $this->shed_model->getShed();
        //$data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['vaccines'] = $this->vaccine_model->getVaccine();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('shed_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function vaccineDetailsByShed() {
        $shed_id = $this->input->get('shed_id');
        $data['settings'] = $this->settings_model->getSettings();
        //$data['payments'] = $this->payment_model->getPayment();
        $data['vaccines'] = $this->vaccine_model->getVaccineByShedId($shed_id);
        //$data['total_payable'] = $this->purchase_model->totalPurchasePayableBySupplierId($supplier_id);
        //$data['total_paid'] = $this->payment_model->totalPurchasePaymentBySupplierId($supplier_id);
        $data['shed_id'] = $shed_id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('vaccine_details_by_shed', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $vaccine_id = $this->input->post('v_id');
        $name = $this->input->post('name');
        $no = $this->input->post('no');
        $l_date = $this->input->post('l_date');
        $n_date = $this->input->post('n_date');
        $duration = $this->input->post('duration');



        if (empty($vaccine_id)) {
            $vaccine_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('vaccine', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('no', 'Shed No', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Vaccine Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Vaccines Field
        $this->form_validation->set_rules('l_date', 'Last Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Vaccines Field
        $this->form_validation->set_rules('n_date', 'Next Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Amount Field   
        $this->form_validation->set_rules('duration', 'Vaccine Duration (days)', 'trim|required|min_length[1]|max_length[100]|xss_clean');




        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("vaccine/editVaccine?id=$id");
            } else {
                redirect("vaccine/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'vaccine_id' => $vaccine_id,
                'no' => $no,
                'name' => $name,
                'l_date' => $l_date,
                'n_date' => $n_date,
                'duration' => $duration,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->vaccine_model->insertVaccine($data);
                redirect('vaccine');
            } else {
                $this->vaccine_model->updateVaccine($id, $data);
                redirect('vaccine');
            }
        }
    }

    function getVaccine() {
        $data['vaccine'] = $this->vaccine_model->getVaccine();
        $this->load->view('vaccine', $data);
    }

    function editVaccine() {
        $data = array();
        $id = $this->input->get('id');
        $data['vaccine'] = $this->vaccine_model->getVaccineById($id);
        $data['sheds'] = $this->shed_model->getShed();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editVaccineByJason() {
        $id = $this->input->get('id');
        $data['sheds'] = $this->shed_model->getShed();
        $data['vaccine'] = $this->vaccine_model->getVaccineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->vaccine_model->deleteVaccine($id);
        redirect('vaccine');
    }

}

/* End of file vaccine.php */
/* Location: ./application/modules/vaccine/controllers/vaccine.php */  
