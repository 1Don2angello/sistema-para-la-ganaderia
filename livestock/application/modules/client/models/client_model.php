<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertClient($data) {
        $this->db->insert('client', $data);
    }

    function getClient() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('client');
        return $query->result();
    }

    function getClientById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('client');
        return $query->row();
    }

    function getClientByPhone($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('client');
        return $query->row();
    }

    function updateClient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('client', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('client');
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
