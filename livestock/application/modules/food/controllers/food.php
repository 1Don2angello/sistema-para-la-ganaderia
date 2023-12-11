<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Food extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('food_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        $this->load->model('settings/settings_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['foods'] = $this->food_model->getFood();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('food', $data);
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
        $food_id = $this->input->post('f_id');
        $date = $this->input->post('date');
        $consumption = $this->input->post('consumption');
        $quantity = $this->input->post('quantity');
        //  $ave_consumption = $consumption / $quantity;
        $ave_consumption = $this->input->post('ave_consumption');
        $note = $this->input->post('note');


        if (empty($food_id)) {
            $food_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('food', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('consumption', 'Food Consumption', 'trim|required|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("food/editFood?id=$id");
            } else {
                redirect("food/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'food_id' => $food_id,
                'date' => $date,
                'consumption' => $consumption,
                'quantity' => $quantity,
                'ave_consumption' => $ave_consumption,
                'note' => $note,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->food_model->insertFood($data);
                redirect('food');
            } else {
                $this->food_model->updateFood($id, $data);
                redirect('food');
            }
        }
    }

    function getFood() {
        $data['food'] = $this->food_model->getFood();
        $this->load->view('food', $data);
    }

    function editFood() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['food'] = $this->food_model->getFoodById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editFoodByJason() {
        $id = $this->input->get('id');
        $data['food'] = $this->food_model->getFoodById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->food_model->deleteFood($id);
        redirect('food');
    }

}

/* End of file food.php */
/* Location: ./application/modules/food/controllers/food.php */  
