<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    function insertExpense($data) {
        $this->db->insert('expense', $data);
    }

    function getExpense() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('expense');
        return $query->result();
    }
    

    function getExpenseById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    function updateExpense($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
    }

    function insertExpenseCategory($data) {
        $this->db->insert('expense_category', $data);
    }

    function getExpenseCategory() {
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    function getExpenseCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_category');
        return $query->row();
    }
    
    function getExpenseCategoriesById($category_id) {
        $this->db->where('id', $category_id);
        $query = $this->db->get('expense_category');
        return $query->result();
    }
    
    function getExpensesByCategoryId($category_id){
        $this->db->order_by('id', 'asc');
        $this->db->where('category', $category_id);
        $query = $this->db->get('expense');
        return $query->result();
    }

    function updateExpenseCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_category', $data);
    }
    
    function insertExpenseSubCategory($data) {
        $this->db->insert('expense_sub_category', $data);
    }
    
    function getExpenseSubCategory() {
        $query = $this->db->get('expense_sub_category');
        return $query->result();
    }

    function getExpenseSubCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('expense_sub_category');
        return $query->row();
    }
    
    function getExpenseSubCategoriesById($sub_category_id) {
        $this->db->where('id', $sub_category_id);
        $query = $this->db->get('expense_sub_category');
        return $query->result();
    }
    
    function getExpensesBySubCategoryId($sub_category_id){
        $this->db->where('category', $sub_category_id);
        $query = $this->db->get('expense');
        return $query->result();
    }

    function updateExpenseSubCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('expense_sub_category', $data);
    }

    function deleteExpense($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense');
    }

    function deleteExpenseCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }
    
    function deleteExpenseSubCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_sub_category');
    }
    
    function totalExpensePaidAmount(){
        $query = $this->db->get('expense')->result();
        foreach ($query as $expense) {
            $total_paid[] = $expense->paid;
        }
        if (!empty($total_paid)) {
            return array_sum($total_paid);
        } else {
            return 0;
        }
    }
    
    function totalExpensedAmount(){
        $query = $this->db->get('expense')->result();
        foreach ($query as $expense) {
            $total_expense[] = $expense->amount;
        }
        if (!empty($total_expense)) {
            return array_sum($total_expense);
        } else {
            return 0;
        }
    }
    
    function totalExpensePaidAmountByCategory($category){
        $this->db->where('category', $category);
        $query = $this->db->get('expense')->result();
        foreach ($query as $expense) {
            $total_paid[] = $expense->paid;
        }
        if (!empty($total_paid)) {
            return array_sum($total_paid);
        } else {
            return 0;
        }
    }
    
    function totalExpensedAmountByCategory($category){
        $this->db->where('category', $category);
        $query = $this->db->get('expense')->result();
        foreach ($query as $expense) {
            $total_expense[] = $expense->amount;
        }
        if (!empty($total_expense)) {
            return array_sum($total_expense);
        } else {
            return 0;
        }
    }

    function getExpenseByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }
    
    function todayExpensesAmount(){
         if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } 
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['sales'] = $this->getExpenseByDate($today,$today_last);

        foreach($data['sales'] as $expenses){
            $expenses_amount[] = $expenses->amount;
        }
        if(!empty($expenses_amount)){
            return array_sum($expenses_amount);
        }
        else{
            return 0;
        }
    }

}
