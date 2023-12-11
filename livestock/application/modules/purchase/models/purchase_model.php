<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPurchase($data) {
        $this->db->insert('purchase', $data);
    }
 function getPurchaseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('purchase');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }
    function getPurchase() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('purchase');
        return $query->result();
    }

    function getPurchaseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('purchase');
        return $query->row();
    }

    function totalPurchasePayable() {
        $query = $this->db->get('purchase')->result();
        foreach ($query as $purchase) {
            $total_payable[] = $purchase->amount_payable;
        }
        if (!empty($total_payable)) {
            return array_sum($total_payable);
        } else {
            return 0;
        }
    }

    function totalPurchasePayableBySupplierId($supplier_id) {
        $this->db->where('supplier', $supplier_id);
        $query = $this->db->get('purchase')->result();
        foreach ($query as $purchase) {
            $total_payable[] = $purchase->amount_payable;
        }
        if (!empty($total_payable)) {
            return array_sum($total_payable);
        } else {
            return 0;
        }
    }

    function getValueStockByProduct($product) {
        $this->db->where('product', $product);
        $query = $this->db->get('purchase')->result();
        foreach ($query as $purchase) {
            $amount_payable[] = $purchase->amount_payable;
            $quantity[] = $purchase->quantity;
        }

        if (!empty($amount_payable)) {
            $total_amount_payable = array_sum($amount_payable);
        } else {
            $total_amount_payable = 0;
        }

        if (!empty($quantity)) {
            $total_quantity = array_sum($quantity);
        } else {
            $total_quantity = 0;
        }

        if ($total_quantity != 0) {
            return $total_amount_payable / $total_quantity;
        } else {
            return 0;
        }
    }

    function getPurchaseByProductId($product) {
        $this->db->order_by('id', 'asc');
        $this->db->where('product', $product);
        $query = $this->db->get('purchase');
        return $query->result();
    }

    function getPurchaseQuantityByProductId($product) {
        $this->db->where('product', $product);
        $query = $this->db->get('purchase')->result();
        $purchase_quantity = array();
        foreach ($query as $query1) {
            $purchase_quantity[] = $query1->quantity;
        }
        return array_sum($purchase_quantity);
    }

    function getPurchasesBySupplierId($supplier_id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('supplier', $supplier_id);
        $query = $this->db->get('purchase');
        return $query->result();
    }

    function updatePurchase($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('purchase', $data);
    }

    function deletePurchase($id) {
        $this->db->where('id', $id);
        $this->db->delete('purchase');
    }

}
