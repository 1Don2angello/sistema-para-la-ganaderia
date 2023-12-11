<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        //$this->lang->load('system_syntax');
        $this->load->model('purchase_model');
        $this->load->model('client/client_model');
        $this->load->model('supplier/supplier_model');
        $this->load->model('payment/payment_model');
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
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->payment_model->getPayment();
        $data['purchases'] = $this->purchase_model->getPurchase();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('purchase', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function purchase() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['purchases'] = $this->purchase_model->getPurchase();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('purchase', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function supplierHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['suppliers'] = $this->supplier_model->getSupplier();
        $data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['purchases'] = $this->purchase_model->getPurchase();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('supplier_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPurchaseView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['products'] = $this->product_model->getProduct();
        $data['suppliers'] = $this->supplier_model->getSupplier();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_purchase_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPurchase() {
        $id = $this->input->post('id');
        $supplier_id = $this->input->get('supplier_id');
        $reference = $this->input->post('reference');

        $date = $this->input->post('date');
        $date = strtotime($date);

        $product = $this->input->post('product');
        $supplier = $this->input->post('supplier');

        $unit_price = $this->input->post('unit_price');
        $quantity = $this->input->post('quantity');
        $subtotal = $unit_price * $quantity;
        $discount = $this->input->post('discount');
        if (!empty($discount)) {
            $amount_payable = $subtotal - $discount;
        } else {
            $amount_payable = $subtotal;
        }
        $amount_received = $this->input->post('amount_received');
        $status = $this->input->post('status');
        $note = $this->input->post('note');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Price Field
        $this->form_validation->set_rules('client', 'Client', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {

            $data = array();
            if (empty($id)) {
                $data = array(
                    'reference' => $reference,
                    'date' => $date,
                    'product' => $product,
                    'supplier' => $supplier,
                    'unit_price' => $unit_price,
                    'discount' => $discount,
                    'quantity' => $quantity,
                    'amount_payable' => $amount_payable,
                    'status' => $status,
                );
                $this->purchase_model->insertPurchase($data);
                $this->load($id, $product, $quantity);
                $this->session->set_flashdata('feedback', 'Added');
                redirect("purchase/purchaseDetailsBySupplier?supplier_id=" . $supplier);
            } else {
                $data = array(
                    'reference' => $reference,
                    'date' => $date,
                    'product' => $product,
                    'supplier' => $supplier,
                    'unit_price' => $unit_price,
                    'discount' => $discount,
                    'quantity' => $quantity,
                    'amount_payable' => $amount_payable,
                    'status' => $status,
                );
                $this->load($id, $product, $quantity);
                $this->purchase_model->updatePurchase($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                if (!empty($supplier_id)) {
                    redirect("purchase/purchaseDetailsBySupplier?supplier_id=" . $supplier_id);
                } else {
                    redirect("purchase");
                }
            }
        }
    }

    function purchaseDetailsBySupplier() {
        $supplier_id = $this->input->get('supplier_id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->payment_model->getPayment();
        $data['purchases'] = $this->purchase_model->getPurchasesBySupplierId($supplier_id);
        $data['total_payable'] = $this->purchase_model->totalPurchasePayableBySupplierId($supplier_id);
        $data['total_paid'] = $this->payment_model->totalPurchasePaymentBySupplierId($supplier_id);
        $data['supplier_id'] = $supplier_id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('purchase_details_by_supplier', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function load($purchase_id, $product_id, $qty) {
        if (empty($purchase_id)) {
            $previous_purchase_quantity = 0;
        } else {
            $previous_purchase_quantity = $this->db->get_where('purchase', array('id' => $purchase_id))->row()->quantity;
        }
        $previous_product_qty = $this->db->get_where('product', array('id' => $product_id))->row()->quantity;
        if ($previous_product_qty < 0) {
            $new_qty = $qty;
        } else {
            $new_qty = $previous_product_qty - $previous_purchase_quantity + $qty;
        }
        $data = array();
        $data = array('quantity' => $new_qty);
        $this->product_model->updateProduct($product_id, $data);
    }

    function getPurchaseByIdByJason() {
        $id = $this->input->get('id');
        $data['purchase'] = $this->purchase_model->getPurchaseById($id);
        $data['product_name'] = $this->product_model->getproductById($data['purchase']->product)->name;
        echo json_encode($data);
    }

    function editPurchase() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['products'] = $this->product_model->getProduct();
            $data['suppliers'] = $this->supplier_model->getSupplier();
            $id = $this->input->get('id');
            $data['purchase'] = $this->purchase_model->getPurchaseById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_purchase_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $supplier_id = $this->input->get('supplier_id');
            $id = $this->input->get('id');
            $product_id = $this->purchase_model->getPurchaseById($id)->product;
            $qty = $this->purchase_model->getPurchaseById($id)->quantity;
            $previous_qty = $this->product_model->getProductById($product_id)->quantity;
            $new_qty = $previous_qty - $qty;
            if ($new_qty < 0) {
                $new_qty = 0;
            }
            $this->payment_model->deletePaymentByPurchaseId($id);
            $this->purchase_model->deletePurchase($id);
            $data = array();
            $data = array('quantity' => $new_qty);
            $this->product_model->updateProduct($product_id, $data);
            $this->session->set_flashdata('feedback', 'Deleted');
            if (!empty($supplier_id)) {
                redirect('purchase/purchaseDetailsBySupplier?supplier_id=' . $supplier_id);
            } else {
                redirect('purchase');
            }
        }
    }

}

/* End of file purchase.php */
/* Location: ./application/modules/purchase/controllers/purchase.php */