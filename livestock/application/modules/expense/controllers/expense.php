<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language; 
        $this->lang->load('system_syntax', $language);
        //$this->lang->load('system_syntax');
        $this->load->model('expense_model');
        $this->load->model('client/client_model');
        $this->load->model('product/product_model');
        $this->load->model('settings/settings_model');
        $data['settings'] = $this->settings_model->getSettings();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->expense_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->expense_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function expenseHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->expense_model->getExpense();
        $data['categories'] = $this->expense_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
        $data = array();
        $category_id = $this->input->get('category_id');
        $data['sub_categories'] = $this->expense_model->getExpenseSubCategory();
        $data['settings'] = $this->settings_model->getSettings();
        if (!empty($category_id)) {
            $data['categories'] = $this->expense_model->getExpenseCategoriesById($category_id);
        } else {
            $data['categories'] = $this->expense_model->getExpenseCategory();
        }
        $data['category_id'] = $category_id;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function addExpensePayment() {
        $data = array();
        $category_id = $this->input->get('category_id');
        $data['sub_categories'] = $this->expense_model->getExpenseSubCategory();
        $data['settings'] = $this->settings_model->getSettings();
        if (!empty($category_id)) {
            $data['categories'] = $this->expense_model->getExpenseCategoriesById($category_id);
        } else {
            $data['categories'] = $this->expense_model->getExpenseCategory();
        }
        $data['category_id'] = $category_id;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $sub_category = $this->input->post('sub_category');
        $category_id = $this->input->post('category_id');
        $voucher = $this->input->post('voucher_no');
        $date = $this->input->post('date');
        $date = strtotime($date);
        $amount = $this->input->post('amount');
        $note = $this->input->post('note');
        $paid = $this->input->post('paid');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Voucher No Name Field
        $this->form_validation->set_rules('voucher_no', 'Voucher No', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Amount Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Paid Field
        $this->form_validation->set_rules('paid', 'Paid', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Note Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->expense_model->getExpenseCategory();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'sub_category' => $sub_category,
                    'date' => $date,
                    'voucher_no' => $voucher,
                    'amount' => $amount,
                    'paid' => $paid,
                    'note' => $note
                );
            } else {
                $data = array(
                    'category' => $category,
                    'sub_category' => $sub_category,
                    'amount' => $amount,
                    'voucher_no' => $voucher,
                    'paid' => $paid,
                    'note' => $note
                );
            }
            if (empty($id)) {
                $this->expense_model->insertExpense($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->expense_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }

            if (!empty($category_id)) {
                redirect('expense/expenseDetails?id=' . $category_id);
            } else {
                redirect('expense');
            }
        }
    }

    function editExpense() {
        $data = array();
        $data['categories'] = $this->expense_model->getExpenseCategory();
        $data['sub_categories'] = $this->expense_model->getExpenseSubCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->expense_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editExpensePayment() {
        $data = array();
        $data['categories'] = $this->expense_model->getExpenseCategory();
        $data['sub_categories'] = $this->expense_model->getExpenseSubCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->expense_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_payment', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function expenseDetails() {
        $catrgory_id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->expense_model->getExpensesByCategoryId($catrgory_id);
        $data['category_id'] = $catrgory_id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_details_by_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpense() {
        $category_id = $this->input->get('category_id');
        $id = $this->input->get('id');
        $this->expense_model->deleteExpense($id);

        if (!empty($category_id)) {
            redirect('expense/expenseDetails?id=' . $category_id);
        } else {
            redirect('expense');
        }
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->expense_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->expense_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->expense_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('expense/expenseCategory');
        }
    }

    function editExpenseCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->expense_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        $this->expense_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('expense/expenseCategory');
    }

    public function expenseSubCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->expense_model->getExpenseSubCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('expense_sub_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseSubCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_sub_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseSubCategory() {
        $id = $this->input->post('id');
        $sub_category = $this->input->post('name');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('name', 'Sub Category Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('name' => $sub_category,
                'description' => $description
            );
            if (empty($id)) {
                $this->expense_model->insertExpenseSubCategory($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->expense_model->updateExpenseSubCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('expense/expenseSubCategory');
        }
    }

    function editExpenseSubCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->expense_model->getExpenseSubCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_expense_sub_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseSubCategory() {
        $id = $this->input->get('id');
        $this->expense_model->deleteExpenseSubCategory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('expense/expenseSubCategory');
    }

    function todayExpense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->expense_model->getExpenseByDate($today, $today_last);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('today_expenses', $data);
        $this->load->view('home/footer'); // just the header file
    }

}

/* End of file expense.php */
/* Location: ./application/modules/expense/controllers/expense.php */