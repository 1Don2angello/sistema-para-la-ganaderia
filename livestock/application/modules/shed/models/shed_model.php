<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shed_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertShed($data) {
        $this->db->insert('shed', $data);
    }

    function getShed() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('shed');
        return $query->result();
    }

    function getShedById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('shed');
        return $query->row();
    }

    function updateShed($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('shed', $data);
    }

    function deleteShed($id) {
        $this->db->where('id', $id);
        $this->db->delete('shed');
    }

}
