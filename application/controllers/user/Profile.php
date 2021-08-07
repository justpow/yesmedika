<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}
		
	public function index()
	{
        // Check user permission.
         if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }

		// Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }

        // Get data user
        $resultUser = $this->user->get(array('user.id' => $user->id));
        if ($resultUser->error['code'] !==  0 && $resultUser->error['message']) {
            redirect(''); // temporary error handler. Need flashdata.
            return;
        }

        $resultUser = $resultUser->data->result_array();
        // var_dump($resultUser);die();
 
		$this->render_page('main', 'user/profile', $resultUser);	
	}

	public function edit_prof_submit()
	{
		// Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }

		// TO DO: NEED EMAIL HANDLER.

		// TO DO: NEED PASSWORD LENGTH VALIDATOR.

		$user = array(
			'firstname' 	=> $this->input->post('fname'),
			'lastname' 		=> $this->input->post('lname'),
			'birth_date' 	=> $this->input->post('birth'),
			'username' 		=> $this->input->post('uname'),
			'email' 		=> $this->input->post('email'),
			'phone_number' 	=> $this->input->post('phone_number'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin')
		);

		$param = array(
            'id' 	        => $this->session->userdata('user')['id']
		);

		// Update data.
		$result = $this->user->update($param, $user);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('update_error', 'Anda gagal memperbarui profile');
			redirect('user/profile');
			return;
		}

		$this->session->set_flashdata('update_success', 'Anda berhasil memperbarui profile');
		redirect('user/profile');	
	}

	public function ubah_password()
	{
		// Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }
		
		// Check old password in database
		$param = array(
            'user.id' 	        => $this->session->userdata('user')['id']
		);
		$old_password_db = $this->user->get($param)->data->result_array();
		$old_password_form = $this->input->post('inputPassword');
		$verify = password_verify($old_password_form, $old_password_db[0]['password']);
		// var_dump($verify);die();
		if( !$verify ){
			$this->session->set_flashdata('password_error', 'Maaf, Kata Sandi Lama tidak sesuai');
			redirect('user/profile');
			return;
		}

		$user = array(
			'password'	 	=> password_hash($this->input->post('inputPassword2'), PASSWORD_BCRYPT)
		);

		$param = array(
            'id' 	        => $this->session->userdata('user')['id']
		);

		// Update data.
		$result = $this->user->update($param, $user);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('password_error', 'Anda gagal memperbarui kata sandi');
			redirect('user/profile');
			return;
		}

		$this->session->set_flashdata('password_success', 'Anda berhasil memperbarui kata sandi');
		redirect('user/profile');	
	}
}
