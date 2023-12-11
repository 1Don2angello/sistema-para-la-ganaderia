<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertProduct($data) {
        $this->db->insert('product', $data);
    }

    function getProduct() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('product');
        return $query->result();
    }

    function getProductById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('product');
        return $query->row();
    }

    function updateProduct($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }

    function deleteProduct($id) {
        $this->db->where('id', $id);
        $this->db->delete('product');
    }

    // Product Category.........
    function insertProductCategory($data) {
        $this->db->insert('category', $data);
    }

    function getProductCategory() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('category');
        return $query->result();
    }

    function getProductCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->row();
    }

    function updateProductCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }

    function deleteProductCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }

}
