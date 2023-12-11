<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        //$this->lang->load('system_syntax');
        $this->load->model('sale_model');
        $this->load->model('payment/payment_model');
        $this->load->model('purchase/purchase_model');
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
        $type = $this->input->get('type');
        $data['clients'] = $this->client_model->getClient();
        $data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sales'] = $this->sale_model->getSale($type);
        $data['type'] = $type;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('sale', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function sale() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['sales'] = $this->sale_model->getSale();

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('sale', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function clientHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $type = $this->input->get('type');
        $data['clients'] = $this->client_model->getClient();
        $data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sales'] = $this->sale_model->getSale($type);
        $data['type'] = $type;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('client_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getProductForPos() {
        $key = $this->input->get('keyword');
        $products = $this->product_model->getProductByKeyForPos($key);

        $data[] = array();
        $items = array();
        foreach ($products as $product) {
            if ($product->quantity > 0) {
                $items[] = '<div class="span_item" id=' . $product->id . '>' . $product->name . '</div>';
            }
        }

        $data['items'] = $items;

        $items = NULL;

        echo json_encode($data);
    }

    public function addSaleView() {

        $data = array();
        $type = $this->input->get('type');
        $data['type'] = $type;
        $data['clients'] = $this->client_model->getClient();
        $data['discount_type'] = $this->sale_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        if (!empty($type)) {
            $data['products'] = $this->product_model->getProductByType($type);
        } else {
            $data['products'] = $this->product_model->getProduct();
        }
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_sale_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addSale() {
        $id = $this->input->post('id');
        $item_selected = array();
        $quantity = array();
        $price = array();

        $item_selected = $this->input->post('product_id');
        $price_selected = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $type = $this->input->post('type');
        $reference = $this->input->post('reference');

        $date = $this->input->post('date');
        $date = strtotime($date);


        //   foreach ($item_price_array as $key1 => $value1) {
        //      $new_price = array('price' => $value1);
        //      $this->db->where('id', $key1);
        //      $this->db->update('product', $new_price);
        //  }

        if (empty($item_selected)) {
            $this->session->set_flashdata('quantity_check', 'Select An Item ');
            redirect('sale/addSaleView');
        } else {
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
            $item_price_array = array();
            $item_price_array = array_combine($item_selected, $price_selected);
        }
        foreach ($item_quantity_array as $key => $value) {
            $current_product = $this->db->get_where('product', array('id' => $key))->row();
            $unit_price = $item_price_array[$key];
            $current_stock = $current_product->quantity;
            $qty = $value;

            if (!empty($id)) {
                $sale_quantity = $this->sale_model->getSaleById($id)->category_name;
                $sale_quantity = explode('*', $sale_quantity);
                if ($sale_quantity[0] == $current_product->id) {
                    $current_stock = $sale_quantity[2] + $current_stock;
                }
            }

            if ($current_stock < $qty) {
                $this->session->set_flashdata('quantity_check', 'Insufficient Quantity selected for product ' . $current_product->name);
                if (!empty($type)) {
                    redirect('sale/addSaleView?type=local');
                } else {
                    redirect('sale/editSale?id=' . $id);
                }
                die();
            }
            $item_price[] = $unit_price * $value;
            $category_name[] = $key . '*' . $unit_price . '*' . $qty;
        }

        $category_name = implode(',', $category_name);

        $client = $this->input->post('client');
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');
        $sale_status = $this->input->post('sale_status');

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
            $amount = array_sum($item_price);
            $sub_total = $amount;

            if (!empty($discount)) {
                $gross_total = $sub_total - $discount;
            } else {

                $gross_total = $sub_total;
            }

            $data = array();
            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'reference' => $reference,
                    'client_id' => $client,
                    'date' => $date,
                    'amount' => $sub_total,
                    'type' => $type,
                    'discount' => $discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'sale_status' => $sale_status,
                );
                $this->sale_model->insertSale($data);
                $inserted_id = $this->db->insert_id();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('product', array('id' => $key))->row()->quantity;
                    $new_qty = $previous_qty - $value;
                    $this->db->where('id', $key);
                    $this->db->update('product', array('quantity' => $new_qty));
                }
                $this->session->set_flashdata('feedback', 'Added');
                redirect("sale/invoice?id=" . "$inserted_id");
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'reference' => $reference,
                    'client_id' => $client,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'type' => $type,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'sale_status' => $sale_status,
                );

                $original_sale = $this->sale_model->getSaleById($id);
                $original_sale_quantity = array();
                $original_sale_quantity = explode(',', $original_sale->category_name);
                $o_s_value[] = array();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('product', array('id' => $key))->row()->quantity;
                    foreach ($original_sale_quantity as $osq_key => $osq_value) {
                        $o_s_value = explode('*', $osq_value);
                        if ($o_s_value[0] == $key) {
                            $previous_qty1 = $previous_qty + $o_s_value[2];
                            $new_qty = $previous_qty1 - $value;
                            $this->db->where('id', $key);
                            $this->db->update('product', array('quantity' => $new_qty));
                        }
                    }
                }
                $this->sale_model->updateSale($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect("sale/invoice?id=" . "$id");
            }
        }
    }

    function getSaleByIdByJason() {
        $id = $this->input->get('id');
        $data['sale'] = $this->sale_model->getSaleById($id);
        $data['product_name'] = $this->product_model->getproductById($data['sale']->product)->name;
        echo json_encode($data);
    }

    function saleDetailsByClient() {
        $type = $this->input->get('type');
        $client_id = $this->input->get('client_id');
        $data['type'] = $type;
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->payment_model->getPayment();
        $data['sales'] = $this->sale_model->getSalesByClientId($client_id, $type);
        $data['client_id'] = $client_id;
        $data['total_receivable'] = $this->sale_model->totalsaleReceivableByClientId($client_id, $type);
        $data['total_paid'] = $this->payment_model->totalSalePaymentByClientId($client_id, $type);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('sale_details_by_client', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSale() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $data = array();
            $data['discount_type'] = $this->sale_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['clients'] = $this->client_model->getClient();
            $data['products'] = $this->product_model->getProduct();
            $id = $this->input->get('id');
            $data['sale'] = $this->sale_model->getSaleById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_sale_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $client_id = $this->input->get('client_id');
            $id = $this->input->get('id');
            $category_name = $this->sale_model->getSaleById($id)->category_name;
            $all_product_details = array();
            $all_product_details = explode(',', $category_name);

            foreach ($all_product_details as $key => $value) {
                $product_details = array();
                $product_details = explode('*', $value);
                $product_id = $product_details[0];
                $qty = $product_details[2];
                $purchase_quantity = $this->purchase_model->getPurchaseQuantityByProductId($product_id);
                $sale_quantity = $this->sale_model->getSaleQuantityByProductId($product_id);
                $previous_qty = $purchase_quantity - $sale_quantity;
                $new_qty = $previous_qty + $qty;
                $data = array();
                $data = array('quantity' => $new_qty);
                $this->product_model->updateProduct($product_id, $data);
            }

            $this->payment_model->deletePaymentBySaleId($id);
            $this->sale_model->deleteSale($id);

            $this->session->set_flashdata('feedback', 'Deleted');
            if (!empty($client_id)) {
                redirect('sale/saleDetailsByClient?client_id=' . $client_id);
            } else {
                redirect('sale');
            }
        }
    }

    function invoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->sale_model->getDiscountType();
        $data['sale'] = $this->sale_model->getSaleById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('sale', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->sale_model->amountReceived($id, $data);
        redirect('sale/invoice?id=' . $id);
    }

    function amountReceivedFromPT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $sales = $this->sale_model->getSaleByClientId($id);
        foreach ($sales as $sale) {
            if ($sale->gross_total != $sale->amount_received) {
                $due_balance = $sale->gross_total - $sale->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $sale->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->sale_model->amountReceived($sale->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $sale->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->sale_model->amountReceived($sale->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('sale/invoiceClientTotal?id=' . $id);
    }

    function todaySale() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['clients'] = $this->client_model->getClient();
        $data['payments'] = $this->payment_model->getPayment();
        $data['settings'] = $this->settings_model->getSettings();
        $data['sales'] = $this->sale_model->getSaleByDate($today, $today_last);



        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('today_sale', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function salePerMonth() {

        $sales = $this->sale_model->getSale();
        foreach ($sales as $sale) {
            $date = $sale->date;
            $month = date('m', $date);
            $year = date('y', $date);
            if ($month = '01') {
                
            }
        }
    }

}

/* End of file sale.php */
/* Location: ./application/modules/sale/controllers/sale.php */