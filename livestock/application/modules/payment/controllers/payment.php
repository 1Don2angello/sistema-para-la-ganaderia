<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        //$this->lang->load('system_syntax');
        $this->load->model('payment_model');
        $this->load->model('purchase/purchase_model');
        $this->load->model('sale/sale_model');
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
        $data['payments'] = $this->payment_model->getPayment();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function payment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->payment_model->getPayment();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['products'] = $this->product_model->getProduct();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_payment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPayment() {
        $id = $this->input->post('id');
        $reference = $this->input->post('reference');
        $supplier_id = $this->input->post('supplier_id');
        $client_id = $this->input->post('client_id');
        $date = $this->input->post('date');
        $date = strtotime($date);
        $amount = $this->input->post('amount');

        $view = $this->input->post('view');
        $paid_by = $this->input->post('paid_by');
        $purchase_id = $this->input->post('purchase_id');
        $sale_id = $this->input->post('sale_id');
        $local_sale_id = $this->input->post('local_sale_id');
        $cheque_no = $this->input->post('cheque_no');
        $note = $this->input->post('note');
        $created_by = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Price Field
        $this->form_validation->set_rules('date', 'Date', 'trim|min_length[2]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {

            $data = array();
            if (empty($id)) {
                $data = array(
                    'reference_no' => $reference,
                    'date' => $date,
                    'amount' => $amount,
                    'purchase_id' => $purchase_id,
                    'sale_id' => $sale_id,
                    'supplier' => $supplier_id,
                    'client_id' => $client_id,
                    'local_sale_id' => $local_sale_id,
                    'note' => $note,
                    'paid_by' => $paid_by,
                    'cheque_no' => $cheque_no,
                    'created_by' => $created_by
                );
                $this->payment_model->insertPayment($data);
                $this->session->set_flashdata('feedback', 'Added');
                if (!empty($supplier_id)) {
                    if (!empty($view)) {
                        redirect('purchase');
                    } else {
                        redirect('purchase/purchaseDetailsBySupplier?supplier_id=' . $supplier_id);
                    }
                } elseif (!empty($client_id)) {
                    if (!empty($view)) {
                        redirect('sale');
                    } else {
                        redirect('sale/saleDetailsByClient?client_id=' . $client_id);
                    }
                } elseif (!empty($purchase_id)) {
                    redirect('purchase');
                } elseif (!empty($sale_id)) {
                    redirect('sale');
                }
            } else {
                $data = array(
                    'reference_no' => $reference,
                    'date' => $date,
                    'amount' => $amount,
                    'purchase_id' => $purchase_id,
                    'sale_id' => $sale_id,
                    'local_sale_id' => $local_sale_id,
                    'note' => $note,
                    'paid_by' => $paid_by,
                    'cheque_no' => $cheque_no,
                    'created_by' => $created_by
                );
                $this->payment_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');



                if (!empty($supplier_id)) {
                    redirect('purchase/purchaseDetailsBySupplier?supplier_id=' . $supplier_id);
                } elseif (!empty($client_id)) {
                    redirect('sale/saleDetailsByClient?client_id=' . $client_id);
                } elseif (!empty($purchase_id)) {
                    redirect('purchase');
                } elseif (!empty($sale_id)) {
                    redirect('sale');
                }
            }
        }
    }

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['products'] = $this->product_model->getProduct();
            $id = $this->input->get('id');
            $data['payment'] = $this->payment_model->getPaymentById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_payment_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function getPaymentByPurchaseIdByJason() {
        $purchase_id = $this->input->get('id');
        $data['paymentsByPurchaseId'] = $this->payment_model->getPaymentByPurchaseId($purchase_id);
        echo json_encode($data);
    }

    function getPaymentBySaleIdByJason() {
        $sale_id = $this->input->get('id');
        $data['paymentsBySaleId'] = $this->payment_model->getPaymentBySaleId($sale_id);
        echo json_encode($data);
    }

    function deletePayment() {
        if ($this->ion_auth->in_group('admin')) {
            $id = $this->input->get('id');
            $purchase_id = $this->payment_model->getPaymentById($id)->purchase_id;
            $sale_id = $this->payment_model->getPaymentById($id)->sale_id;


            $this->payment_model->deletePayment($id);
            $this->session->set_flashdata('feedback', 'Deleted');
            if (!empty($purchase_id)) {
                $supplier_id = $this->purchase_model->getPurchaseById($purchase_id)->supplier;
                redirect('purchase/purchaseDetailsBySupplier?supplier_id=' . $supplier_id);
            }
            if (!empty($sale_id)) {
                $client_id = $this->sale_model->getSaleById($sale_id)->client_id;
                $type = $this->sale_model->getSaleById($sale_id)->type;
                redirect('sale/saleDetailsByClient?client_id=' . $client_id . '&type=' . $type);
            }
        }
    }

}

/* End of file payment.php */
/* Location: ./application/modules/payment/controllers/payment.php */