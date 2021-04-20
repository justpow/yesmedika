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

        $result = $this->products->get_products($page, $per_page, $query, $sort_by, $order_by, $brand, $minPrice, $maxPrice);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            redirect('');
        }
        header('Content-Type: application/json');
        echo json_encode( $result->data->result() );
	}
}
