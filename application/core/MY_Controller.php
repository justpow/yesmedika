<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');

		// Check if user is a guest.
		if (!$this->session->has_userdata('user')) {	
			$result = $this->user->get(array('user.username' => 'guest'));
			$data = $result->data->row();
			if (!isset($data)) {
				redirect('');
			}

			$result = $this->user->get_role_permission(array('role_id' => $data->role_id));
			if ($result->error['code'] !==  0 && $result->error['message']) {
				redirect('');
				return;
			}

			$role_permission = array();
			foreach ($result->data->result() as $row) {
				array_push($role_permission, $row->permission_id);
			}

			$data->permission = $role_permission;
			$this->create_user_session($data);
		}

		// Temporary only, only for user debug. Uncomment this if needed.
		$user = $this->session->userdata('user');
		print_r($user);
	}

	private function is_granted($user_access, $permission)
	{
		if (in_array(READ_ALL, $user_access) || in_array(WRITE_ALL, $user_access)) {
			return true;
		}

		return in_array($permission, $user_access);
	}

	public function render_page($template, $page, $data = array())
	{
		$this->load->view($template, array('page' => $page, 'data' => $data));
	}

	public function has_access($permission)
	{
		$user = $this->session->userdata('user');
		return $this->is_granted($user['permission'], $permission);
	}

	public function create_user_session($data)
	{	
		$new_data = array(
			'id' => $data->id,
			'fullname' => $data->firstname.' '.$data->lastname,
			'username' => $data->username,
			'email' => $data->email,
			'role' => $data->title,
			'permission' => $data->permission
		);
		$this->session->set_tempdata('user', $new_data, 1800);
		
	}
}
