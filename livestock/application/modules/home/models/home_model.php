<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function getSum(){
        $query = $this->db->get('shed')->result();
         foreach($query as $chicken){
             $quantity[] = $chicken->quantity;
         } 
         if(!empty($quantity)){
             $total_quantity = array_sum($quantity);
         }
         else{
             $total_quantity = 0;
         }
         
         return $total_quantity;
         
          
         
        
    }
    
}
