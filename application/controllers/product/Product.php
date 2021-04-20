<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products');
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
        if ($page > MAX_PAGE) {
            http_response_code(404);
            return;
        }

        // Get total products.
        $result = $this->products->get_products(1, 1000);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            http_response_code(500);
            echo json_encode((object)$result->error);
            return;
        }

        $total_data = $result->data->num_rows();
        $total_page = ceil($total_data/$per_page);

        // Handle limitation of the page.
        if ($page > $total_page) {
            http_response_code(404);
            return;
        }

        $result = $this->products->get_products($page, $per_page, $query, $sort_by, $order_by, $brand, $minPrice, $maxPrice);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            http_response_code(500);
            echo json_encode((object)$result->error);
            return;
        }

        echo json_encode($result->data->result());
	}
}
