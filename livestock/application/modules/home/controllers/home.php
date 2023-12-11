<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ion_auth_model');
        $this->load->library('upload');
        $this->load->model('client/client_model');
        $this->load->model('supplier/supplier_model');
        $this->load->model('purchase/purchase_model');
        $this->load->model('payment/payment_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('shed/shed_model');
        $this->load->model('sale/sale_model');
        $this->load->model('expense/expense_model');
        $this->load->model('settings/settings_model');
        $this->load->model('home_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index() {
        $data = array();
        $data['today_sale'] = $this->sale_model->todaySaleAmount();
        $data['expenses_paid'] = $this->expense_model->totalExpensePaidAmount();
        $data['expensed_amount'] = $this->expense_model->totalExpensedAmount();
        $data['total_international_sale'] = $this->sale_model->totalInternatianalSaleReceivable();
        $data['total_international_payment'] = $this->payment_model->totalInternatianalPayment();
        $data['total_purchase_payable'] = $this->purchase_model->totalPurchasePayable();
        $data['total_purchase_paid'] = $this->payment_model->totalPurchasePayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['clients'] = $this->client_model->getClient();
        $data['sheds'] = $this->shed_model->getShed();
        $data['suppliers'] = $this->supplier_model->getSupplier();

        $date_from = strtotime(date('m/d/y'));
        $date_to = strtotime(date('m/d/y'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $this->load->view('dashboard', $data); // just the header file
        $this->load->view('home', $data);
        $this->load->view('footer');
    }

    public function permission() {
        $this->load->view('permission');
    }

    function todayHistory() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['today_sale'] = $this->sale_model->todaySaleAmount();
        $data['today_purchase'] = $this->sale_model->todayPurchaseAmount();
        $data['today_expense'] = $this->sale_model->todayExpensesAmount();
        $this->load->view('dashboard', $data); // just the header file
        $this->load->view('today_history', $data);
        $this->load->view('footer');
    }

}

/* End of file home.php */
/* Location: ./application/modules/home/controllers/home.php */
