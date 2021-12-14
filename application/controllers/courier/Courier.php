<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('couriers');
        $this->load->model('products');
        $this->load->model('user');
    }

    public function get_cost()
    {
        // Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }

        $origin     = isset($_POST['origin'])     ? $_POST['origin'] : 0;
        $destination = isset($_POST['destination']) ? $_POST['destination'] : 0;
        $courierType  = isset($_POST['courierType'])  ? $_POST['courierType'] : 0;
        $weight  = isset($_POST['weight'])  ? $_POST['weight'] : 0;


        header('Content-Type: application/json');

        $result = $this->couriers->get_cost($origin, $destination, $weight, strtolower(PICKUP[$courierType]));
        $this->send_api_response(200, $result);
    }
}
