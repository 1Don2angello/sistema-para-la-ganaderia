<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('product_model');
        $this->load->library('upload');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        $this->load->model('settings/settings_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['categorys'] = $this->product_model->getProductCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['products'] = $this->product_model->getProduct();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('product', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['categorys'] = $this->product_model->getProductCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $product_id = $this->input->post('p_id');
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $note = $this->input->post('note');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $cost = $this->input->post('cost');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');



        if (empty($product_id)) {
            $product_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('product', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('code', 'Product Code', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('category', 'Product Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('unit', 'Unit', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|min_length[1]|max_length[100]|xss_clean');

        $this->form_validation->set_rules('cost', 'Cost', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Products Field
        $this->form_validation->set_rules('price', 'Product Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Amount Field   
        $this->form_validation->set_rules('note', 'Note', 'trim|required|min_length[1]|max_length[100]|xss_clean');




        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("product/editProduct?id=$id");
            } else {
                redirect("product/addNewView");
            }
        } else {
            $data = array();
            $data = array(
                'product_id' => $product_id,
                'code' => $code,
                'name' => $name,
                'type' => $type,
                'cost' => $cost,
                'unit' => $unit,
                'price' => $price,
                'note' => $note,
                'quantity' => $quantity,  
                'category' => $category,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->product_model->insertProduct($data);
                redirect('product');
            } else {
                $this->product_model->updateProduct($id, $data);
                redirect('product');
            }
        }
    }

    function getProduct() {
        $data['product'] = $this->product_model->getProduct();
        $this->load->view('product', $data);
    }

    function editProduct() {
        $data = array();
        $id = $this->input->get('id');
        $data['categorys'] = $this->product_model->getProductCategory();
        $data['product'] = $this->product_model->getProductById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editProductByJason() {
        $id = $this->input->get('id');
        $data['categorys'] = $this->product_model->getProductCategory();
        $data['product'] = $this->product_model->getProductById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get("id");
        $this->product_model->deleteProduct($id);
        redirect('product');
    }

// Product Category..............

    public function categoryList() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['categorys'] = $this->product_model->getProductCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewViewCategory() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCategory() {
        $id = $this->input->post('id');
        $category_id = $this->input->post('c_id');
        $category = $this->input->post('category');




        if (empty($category_id)) {
            $category_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('category', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("product/editProductCategory?id=$id");
            } else {
                redirect("product/addNewViewCategory");
            }
        } else {
            $data = array();
            $data = array(
                'category_id' => $category_id,
                'category' => $category,
                'add_date' => $add_date
            );

            if (empty($id)) {
                $this->product_model->insertProductCategory($data);
                redirect('product/categoryList');
            } else {
                $this->product_model->updateProductCategory($id, $data);
                redirect('product/categoryList');
            }
        }
    }

    function getProductCategory() {
        $data['category'] = $this->product_model->getProductCategory();
        $this->load->view('category', $data);
    }

    function editProductCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->product_model->getProductCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editProductCategoryByJason() {
        $id = $this->input->get('id');
        $data['category'] = $this->product_model->getProductCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        echo json_encode($data);
    }

    function deleteCategory() {
        $data = array();
        $id = $this->input->get("id");
        $this->product_model->deleteProductCategory($id);
        redirect('product/categoryList');
    }

}

/* End of file product.php */
/* Location: ./application/modules/product/controllers/product.php */  
