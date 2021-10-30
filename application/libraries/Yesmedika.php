<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Yesmedika
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
		$this->CI->load->model('cart');
    }
	
	function countCart() 
    {

		$result = $this->CI->cart->get_carts(array('username' => $this->CI->session->userdata('user')['username']));
		$data = $result->data->num_rows();
		return $data;

	}
}