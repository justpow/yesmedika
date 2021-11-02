<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Yesmedika
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
        $this->CI->load->model('cart');
        $this->CI->load->helper(array('form', 'url'));
        
    }
	
	function countCart() 
    {

		$result = $this->CI->cart->get_carts(array('username' => $this->CI->session->userdata('user')['username']));
		$data = $result->data->num_rows();
		return $data;

    }
    
    public function do_upload($path, $post_form_name, $identifier)
    {
            $config['upload_path']          = $path;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 20480; // 20MB
            $config['file_name'] = $identifier;

            $this->CI->load->library('upload', $config);

            $error = '';
            $data = '';
            if ( ! $this->CI->upload->do_upload($post_form_name))
            {
                $error = $this->CI->upload->display_errors();
            }
            else
            {
                $data = $this->CI->upload->data();
            }

            return array('error' => $error, 'data' => $data);
    }
}