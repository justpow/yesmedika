<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products');
		$this->load->model('variants');
		$this->load->model('cart');
	}
		
	public function index()
	{
        $page     = isset($_GET['page'])     ? $_GET['page'] : 1;
        $per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $sort_by  = isset($_GET['sort_by'])  ? $_GET['sort_by'] : 'id';
        $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'desc';
        $query    = isset($_GET['query'])    ? $_GET['query'] : '';
        $brand    = isset($_GET['brand'])    ? explode(',', $_GET['brand']) : '';
        $minPrice = isset($_GET['min'])      ? $_GET['min'] : '';
        $maxPrice = isset($_GET['max'])      ? $_GET['max'] : '';

        header('Content-Type: application/json');

        // Max page that can be loaded.
        if ($page > MISC['MAX_PAGE']) {
            $this->send_api_response(404);
            return;
        }

        // Get total products.
        $result = $this->products->get_products(1, 1000, $query, $sort_by, $order_by, $brand, $minPrice, $maxPrice);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->send_api_response(500, (object)$result->error);
            return;
        }

        $total_data = $result->data->num_rows();
        $total_page = ceil($total_data/$per_page);

        // Handle limitation of the page.
        if ($page > $total_page) {
            $this->send_api_response(404);
            return;
        }

        $result = $this->products->get_products($page, $per_page, $query, $sort_by, $order_by, $brand, $minPrice, $maxPrice);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->send_api_response(500, (object)$result->error);
            return;
        }

        $this->send_api_response(200, $result->data->result());
	}

    public function detail($productId)
    {
        // Add filter id.
        $filter = array('id' => $productId);

        // Get product by id.
        $result = $this->products->get_products(1, 1000, '', 'id', 'desc', '', '', '', $filter);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->send_api_response(500, (object)$result->error);
            return;
        }

        $product = $result->data->result_array()[0];

        // Get variant product.
        $result = $this->variants->get_variants(array('product_id' => $productId));
        $result = $result->data->result_array();
        if (count($result) > 0) {
            $product['variants'] = $result;
        }

        $this->render_page('main', 'product/detailProduct', $product);

    }

    public function add_to_cart()
    {
        if (!$this->has_access(ADD_TO_CART)) {
			redirect('login');
			return;
        }

        $productId = $_POST['productId'];
        $variantId = $_POST['variantId'];
        $quantities = $_POST['qty'];
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            $this->cart_page();
            return;
        }

        $username = $user->username;
        $data = array(
            'product_id' => $productId,
            'qty' => $quantities,
            'username' => $username,
            'create_by' => $user->id,
            'update_by' => $user->id
        );

        if ($variantId != 0) {
            $data['variant_id'] = $variantId;
        }

        $result = $this->cart->insert($data);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->cart_page();
            return;
        }

        // $this->cart_page();
        redirect('cart');
    }

    public function cart_page()
    {
        if (!$this->has_access(ADD_TO_CART)) {
			redirect('login');
			return;
        }
        
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('home');
            return;
        }

        // Get cart by username.
        $result = $this->cart->get_carts(array('username' => $user->username));
        $result = $result->data->result_array();

        if (count($result) == 0) {
            $this->render_page('main', 'transaction/cart');
            return;
        }

        $listPrd = array();
        foreach ($result as $cart) {
            // Add filter id.
            $filter = array('id' => $cart['product_id']);
    
            // Get product by id.
            $resultProd = $this->products->get_products(1, 1000, '', 'id', 'desc', '', '', '', $filter);
            if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                $this->send_api_response(500, (object)$resultProd->error);
                return;
            }
    
            $product = $resultProd->data->result_array()[0];
           
            if ($cart['variant_id'] != null) {
                // Get variant product.
                $resultVar = $this->variants->get_variants(array('id' => $cart['variant_id']));
                $resultVar = $resultVar->data->result_array();
                
                foreach ($resultVar as $key => $value) {
                    array_push($listPrd, array(
                        'product' => $product,
                        'variant' => $value,
                        'qty' => $cart['qty']
                    ));
                }
            } else {
                array_push($listPrd, array(
                    'product' => $product,
                    'qty' => $cart['qty']
                ));
            }
        }
        
        $this->render_page('main', 'transaction/cart', $listPrd);
    }
}
