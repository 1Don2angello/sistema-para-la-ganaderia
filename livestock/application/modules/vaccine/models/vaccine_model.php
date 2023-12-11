<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vaccine_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertVaccine($data) {
        $this->db->insert('vaccine', $data);
    }
     function getVaccineByShedId($shed_id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('shed', $shed_id);
        $query = $this->db->get('vaccine');
        return $query->result();
    }

    function getVaccine() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('vaccine'); 
        return $query->result();
    }

    function getVaccineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('vaccine');
        return $query->row();
    }

    function updateVaccine($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('vaccine', $data);
    }

    function deleteVaccine($id) {
        $this->db->where('id', $id);
        $this->db->delete('vaccine');
    }

}
