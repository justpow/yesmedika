<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}
		
	public function index()
	{
		if (!$this->has_access(READ_REGISTER)) {
			redirect('');
			return;
		}

		$this->render_page('non_navbar', 'user/register');	
	}

	public function form_submit()
	{
		if (!$this->has_access(WRITE_REGISTER)) {
			$this->load->view('forbidden');
			return;
		}

		if ($_POST['password'] !== $_POST['cPassword']) {
			$this->session->set_flashdata('register_error', 'Password didn\'t match');
			$this->render_page('non_navbar', 'user/register');
			return;
		}


		// TO DO: NEED EMAIL HANDLER.

		// Check for Password
		if ( !empty($this->valid_password($_POST['password'])) ) {
			$this->session->set_flashdata('register_error', $this->valid_password($_POST['password']));
			$this->render_page('non_navbar', 'user/register');
			return;
		}

		// Check Number Phone
		if ( !empty($this->valid_phone($_POST['phone'])) ) {
			$this->session->set_flashdata('register_error', $this->valid_phone($_POST['phone']));
			$this->render_page('non_navbar', 'user/register');
			return;
		}

		$user = array(
			'firstname' 	=> $_POST['fname'],
			'lastname' 		=> $_POST['lname'],
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
		$result = $this->user->insert($user);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('register_error', $this->compile_error($result->error['message']));
			$this->render_page('non_navbar', 'user/register');
			return;
		}

		$this->session->set_flashdata('register_success', 'Registrasi sukses. Silahkan login.');
		redirect('login');	
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

	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		$message = '';

		if (empty($password))
		{
			$message = 'Kata sandi tidak boleh kosong';
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$message = 'Kata sandi minimal memiliki 1 huruf besar';
		}

		if (strlen($password) < 8)
		{
			$message = 'Kata sandi minimal memiliki 8 karakter';
		}

		return $message;
	}

	public function valid_phone($phone = '')
	{
		$phone = trim($phone);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		$message = '';

		if (empty($phone))
		{
			$message = 'Nomor Handphone tidak boleh kosong';
		}

		if (strlen($phone) < 10)
		{
			$message = 'Nomor Handphone minimal memiliki 10 karakter';
		}

		return $message;
	}
}
