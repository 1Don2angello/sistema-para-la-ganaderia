<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Food_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFood($data) {
        $this->db->insert('food', $data);
    }

    function getFood() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('food');
        return $query->result();
    }

    function getFoodById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('food');
        return $query->row();
    }

    function updateFood($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('food', $data);
    }

    function deleteFood($id) {
        $this->db->where('id', $id);
        $this->db->delete('food');
    }

}
