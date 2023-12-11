<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertStaff($data) {
        $this->db->insert('staff', $data);
    }

    function getStaff() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('staff');
        return $query->result();
    }

    function getStaffById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('staff');
        return $query->row();
    }

    function getStaffByPhone($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('staff');
        return $query->row();
    }

    function updateStaff($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('staff', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('staff');
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
