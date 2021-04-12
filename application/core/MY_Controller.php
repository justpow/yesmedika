<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Check if user is a guest.
		if (!$this->session->has_userdata('user')) {
			
			// [HARDCODE] Temporary only, will get from DB soon as posible.
			$newdata = array(
				'username'   => 'guest',
				'logged_in'  => TRUE,
				'role'		 => 'guest',
				'permission' => array(101, 201)
			);
		
			// Set user as a guest. Refresh every 30 minutes.
			$this->session->set_tempdata('user', $newdata, 1800);
		}
		
	}

	public function is_granted($user_access, $permission)
	{
		if (in_array(READ_ALL, $user_access)) {
			return true;
		}

		return in_array($permission, $user_access);
	}

	public function render_page($template, $page, $data = array())
	{
		$this->load->view($template, array('page' => $page, 'data' => $data));
	}
}
