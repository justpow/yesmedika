<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	var $USER;

	public function __construct()
	{
		parent::__construct();
		$this->USER = $this->session->userdata('user');
		$this->load->model('user');
	}
		
	public function index()
	{
		if (!$this->is_granted($this->USER['permission'], READ_REGISTER)) {
			$this->load->view('forbidden');
			return;
		}

		$this->render_page('main', 'user/register');	
	}

	public function form_submit()
	{
		if (!$this->is_granted($this->USER['permission'], WRITE_REGISTER)) {
			$this->load->view('forbidden');
			return;
		}

		if ($_POST['password'] !== $_POST['cPassword']) {
			$this->session->set_flashdata('register_error', 'Password didn\'t match');
			$this->render_page('main', 'user/register');
			return;
		}

		// TO DO: NEED EMAIL HANDLER.

		// TO DO: NEED PASSWORD LENGTH VALIDATOR.

		$user = array(
			'firstname' 	=> $_POST['fname'],
			'lastname' 		=> $_POST['lname'],
			'birth_date' 	=> $_POST['birth'],
			'username' 		=> $_POST['username'],
			'email' 		=> $_POST['email'],
			'password' 		=> password_hash($_POST['password'], PASSWORD_BCRYPT),
			'phone_number' 	=> $_POST['phone'],
			'is_active' 	=> true,
			'create_by' 	=> 0,
			'update_by' 	=> 0,
			'role_id' 		=> 3 // temporary hard coded.
		);

		// Insert data.
		$result = $this->user->insert_user($user);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('register_error', $this->compile_error($result->error['message']));
			$this->render_page('main', 'user/register');
			return;
		}
		

		$this->render_page('main', 'auth/login');	
	}

	private function compile_error($error)
	{
		switch (true) {
			case strpos($error, 'email'):
				return 'Email tidak tersedia';
				break;
			case strpos($error, 'username'):
				return 'Username tidak tersedia';
				break;
			case strpos($error, 'phone_number'):
				return 'Nomor Telepon sudah terpakai pada akun lain';
				break;
			default:
				return 'Gagal, silahkan cek form kembali';
				break;
		}
	}
}
