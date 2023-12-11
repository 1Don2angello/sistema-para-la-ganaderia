<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Livestock_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertLivestock($data) {
        $this->db->insert('livestock', $data);
    }

    function getLivestock() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('livestock');
        return $query->result();
    }

    function getLivestockById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('livestock');
        return $query->row();
    }

    function updateLivestock($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('livestock', $data);
    }

    function deleteLivestock($id) {
        $this->db->where('id', $id);
        $this->db->delete('livestock');
    }

}
