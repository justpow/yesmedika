<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->has_access(READ_LOGIN)) {
			redirect('');
			return;
		}
		
		$this->render_page('non_navbar', 'auth/login');
	}
	
	public function form_submit()
	{
		if (!$this->has_access(WRITE_LOGIN)) {
			$this->load->view('forbidden');
			return;
		}

		$result = $this->user->get(array(
			'user.email' => $_POST['email'],
			'user.is_active' => true
		));
		
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('login_error', $result->error['message']);
			redirect('login');
			return;
		}

		$row = $result->data->row();
		$num = $result->data->num_rows();
		if ($num == 0 || !isset($row)) {
			$this->session->set_flashdata('login_error', 'Email tidak terdaftar');
			redirect('login');
			return;
		}

		if (!password_verify($_POST['password'], $row->password)) {
			$this->session->set_flashdata('login_error', 'Email/Password salah, silakan coba lagi');
			redirect('login');
			return;
		}

		$result = $this->user->get_role_permission(array('role_id' => $row->role_id));
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('login_error', $result->error['message']);
			redirect('login');
			return;
		}

		$role_permission = array();
		foreach ($result->data->result() as $data) {
			array_push($role_permission, $data->permission_id);
		}
		
		$row->permission = $role_permission;
		$this->create_user_session($row);
		redirect('');
	}
}
