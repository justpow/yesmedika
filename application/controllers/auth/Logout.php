<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->has_access(LOGOUT)) {
			redirect('');
			return;
		}
        
        session_destroy();
        redirect('login');
	}
}
