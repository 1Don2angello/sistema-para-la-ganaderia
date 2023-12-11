<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSupplier($data) {
        $this->db->insert('supplier', $data);
    }

    function getSupplier() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('supplier');
        return $query->result();
    }

    function getSupplierById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('supplier');
        return $query->row();
    }

    function getSupplierByPhone($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('supplier');
        return $query->row();
    }

    function updateSupplier($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('supplier', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
