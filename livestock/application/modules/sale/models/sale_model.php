<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSale($data) {
        $this->db->insert('sale', $data);
    }

    function getSale($type) {
        if (!empty($type)) {
            $this->db->where('type', $type);
        } else {
            $this->db->where('type !=', 'local');
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('sale');
        return $query->result();
    }

    function getSaleById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sale');
        return $query->row();
    }

    function getSaleByProductId($product) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('sale')->result();
        $sale_details = array();
        foreach ($query as $query1) {
            $category_name = $query1->category_name;
            $category_name1 = explode('*', $category_name);
            if ($category_name1[0] == $product) {
                $sale_details[] = $category_name . '*' . $query1->date;
            }
        }
        return $sale_details;
    }

    function getSaleQuantityByProductId($product) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('sale')->result();
        $sale_quantity = array();
        foreach ($query as $query1) {
            $category_name = $query1->category_name;
            $category_name1 = explode('*', $category_name);
            if ($category_name1[0] == $product) {
                $sale_quantity[] = $category_name1[2];
            }
        }
        return array_sum($sale_quantity);
    }

    function getSalesByClientId($client_id, $type) {
        if (!empty($type)) {
            $this->db->where('type', $type);
        } else {
            $this->db->where('type !=', 'local');
        }
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('sale');
        return $query->result();
    }

    function updateSale($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sale', $data);
    }

    function deleteSale($id) {
        $this->db->where('id', $id);
        $this->db->delete('sale');
    }

    function getSaleByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('sale');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getPurchaseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('purchase');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }

    function getExpenseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function amountReceived($id, $data) {
        $this->db->where('id', $id);
        $query = $this->db->update('sale', $data);
    }

    function totalInternatianalSaleReceivable() {
        $this->db->where('type !=', 'local');
        $query = $this->db->get('sale')->result();
        foreach ($query as $sale) {
            $total_sale[] = $sale->gross_total;
        }
        if (!empty($total_sale)) {
            return array_sum($total_sale);
        } else {
            return 0;
        }
    }

    function totalLocalSaleReceivable() {
        $this->db->where('type', 'local');
        $query = $this->db->get('sale')->result();
        foreach ($query as $sale) {
            $total_sale[] = $sale->gross_total;
        }
        if (!empty($total_sale)) {
            return array_sum($total_sale);
        } else {
            return 0;
        }
    }

    function totalSaleReceivableByClientId($client_id, $type) {
        if (!empty($type)) {
            $this->db->where('type', 'local');
        } else {
            $this->db->where('type !=', 'local');
        }
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('sale')->result();
        foreach ($query as $sale) {
            $total_receivable[] = $sale->gross_total;
        }
        if (!empty($total_receivable)) {
            return array_sum($total_receivable);
        } else {
            return 0;
        }
    }

    function todayPurchaseAmount() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['purchases'] = $this->getPurchaseByDate($today, $today_last);

        foreach ($data['purchases'] as $purchase) {
            $purchase_amount[] = $purchase->amount_payable;
        }
        if (!empty($purchase_amount)) {
            return array_sum($purchase_amount);
        } else {
            return 0;
        }
    }

    function todaySaleAmount() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['sales'] = $this->getSaleByDate($today, $today_last);

        foreach ($data['sales'] as $sale) {
            $sale_amount[] = $sale->gross_total;
        }
        if (!empty($sale_amount)) {
            return array_sum($sale_amount);
        } else {
            return 0;
        }
    }

    function todayExpensesAmount() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['sales'] = $this->getExpenseByDate($today, $today_last);

        foreach ($data['sales'] as $expenses) {
            $expenses_amount[] = $expenses->amount;
        }
        if (!empty($expenses_amount)) {
            return array_sum($expenses_amount);
        } else {
            return 0;
        }
    }

}
