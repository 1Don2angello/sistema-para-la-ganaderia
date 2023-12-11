<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayment($data) {
        $this->db->insert('payment', $data);
    }
function getPaymentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }
    function getPayment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByPurchaseId($purchase_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('purchase_id', $purchase_id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentBySaleId($sale_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('sale_id', $sale_id);
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    function getPaymentBySupplierId($supplier_id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('supplier', $supplier_id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentByClientId($client_id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }

    function totalInternatianalPayment() {
        $this->db->where('type !=', 'local');
        $query = $this->db->get('sale')->result();
        foreach ($query as $sale) {
            $this->db->where('sale_id', $sale->id);
            $query1 = $this->db->get('payment')->result();
            foreach ($query1 as $payment) {
                $total_payment[] = $payment->amount;
            }
        }

        if (!empty($total_payment)) {
            return array_sum($total_payment);
        } else {
            return 0;
        }
    }

    function totalLocalPayment() {

        $this->db->where('type', 'local');
        $query = $this->db->get('sale')->result();
        foreach ($query as $sale) {
            $this->db->where('sale_id', $sale->id);
            $query1 = $this->db->get('payment')->result();
            foreach ($query1 as $payment) {
                $total_payment[] = $payment->amount;
            }
        }

        if (!empty($total_payment)) {
            return array_sum($total_payment);
        } else {
            return 0;
        }
    }

    function totalPurchasePayment() {
        $this->db->where('purchase_id !=', 'NULL');
        $query = $this->db->get('payment')->result();
        foreach ($query as $payment) {
            $total_payment[] = $payment->amount;
        }
        if (!empty($total_payment)) {
            return array_sum($total_payment);
        } else {
            return 0;
        }
    }

    function totalPurchasePaymentBySupplierId($supplier_id) {

        $this->db->where('supplier', $supplier_id);
        $query = $this->db->get('purchase')->result();

        foreach ($query as $purchase) {
            $this->db->where('purchase_id', $purchase->id);
            $query1 = $this->db->get('payment')->result();
            foreach ($query1 as $payment) {
                $total_payment[] = $payment->amount;
            }
            if (!empty($total_payment)) {
                $tp[] = array_sum($total_payment);
            }
            $total_payment = NULL;
        }

        if (!empty($tp)) {
            return $tp = array_sum($tp);
        } else {
            return $tp = 0;
        }
    }

    function totalSalePaymentByClientId($client_id, $type) {

        if (!empty($type)) {
            $this->db->where('type', 'local');
        } else {
            $this->db->where('type !=', 'local');
        }

        $this->db->where('client_id', $client_id);
        $query = $this->db->get('sale')->result();

        foreach ($query as $sale) {
            $this->db->where('sale_id', $sale->id);
            $query1 = $this->db->get('payment')->result();
            foreach ($query1 as $payment) {
                $total_receivable[] = $payment->amount;
            }
            if (!empty($total_receivable)) {
                $ts[] = array_sum($total_receivable);
            }
            $total_receivable = NULL;
        }

        if (!empty($ts)) {
            return $ts = array_sum($ts);
        } else {
            return $ts = 0;
        }
    }

    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    function deletePayment($id) {
        $this->db->where('id', $id);
        $this->db->delete('payment');
    }

    function deletePaymentByPurchaseId($id) {
        $this->db->where('purchase_id', $id);
        $this->db->delete('payment');
    }

    function deletePaymentBySaleId($id) {
        $this->db->where('sale_id', $id);
        $this->db->delete('payment');
    }

}
