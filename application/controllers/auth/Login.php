<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function index()
	{
		$this->render_page('non_navbar', 'auth/login');
	}
}
