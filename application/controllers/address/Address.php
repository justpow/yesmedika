<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
		$this->load->model('UserAddress');
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

        // Get data address with wilayah
        $resultAddress = $this->UserAddress->get_address_wilayah(array('id_user' => $user->id));
        if ($resultAddress->error['code'] !==  0 && $resultAddress->error['message']) {
            redirect(''); // temporary error handler. Need flashdata.
            return;
        }

		$result['address'] = $resultAddress->data->result_array();
		
		if ( count($result['address']) > 0 && $result['address'][0]['id_user'] != $user->id ) {
			$this->session->set_flashdata('error', 'Maaf, Data tidak sesuai');
			$this->render_page('main', 'address/listAddress');
			return;	
		}
 
		$this->render_page('main', 'address/listAddress', $result);	
		
	}

	public function get_address()
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

		$id = $this->input->get('id');
		$resultAddress = $this->UserAddress->get_address_wilayah(array('id' => $id));
		$result = $resultAddress->data->result_array();

		// Check Empty or Not Result 
		if ( empty($result) ) {
			http_response_code(400);
			$response = array('code' => 99, 'msg' => 'Maaf, Data tidak ditemukan');
			echo json_encode($response);
			return;
		}

		if ($resultAddress->error['code'] !==  0 && $resultAddress->error['message']) {
            http_response_code(400);
			$response = array('code' => 99, 'msg' => 'Maaf, Data tidak ditemukan');
			echo json_encode($response);
			return;
        }

		// Check user id = session user id
		if ( $user->id != $result[0]['id_user'] )
		{
			http_response_code(400);
			$response = array('code' => 99, 'msg' => 'Maaf, Data tidak ditemukan');
			echo json_encode($response);
			return;
		}

		echo json_encode($result);
		return;

	}

    public function get_wilayah($act="", $kode="")
    {

        // Get data wilayah provinsi
        if ( $act == 'provinsi' )
        {
            $param = 'CHAR_LENGTH(kode)=2';
        }
		else if ( $act == 'kota' )
        {
            $param = "LEFT(kode, 2) = '". $kode ."' AND CHAR_LENGTH(kode) = 5";
        }
		else if ( $act == 'kecamatan' )
        {
            $param = "LEFT(kode, 5) = '". $kode ."' AND CHAR_LENGTH(kode) = 8";
        }
		else if ( $act == 'kelurahan' )
        {
            $param = "LEFT(kode, 8) = '". $kode ."' AND CHAR_LENGTH(kode) = 13";
        }

        $resultWilayah = $this->UserAddress->get_wilayah($param);
        echo json_encode($resultWilayah->data->result_array());

    }

    public function check_kode_wilayah()
    {

        $data = $this->input->post();

		foreach ( $data as $key => $value ) {
			if ( $key == 'provinsi' ) {
				$param = 'CHAR_LENGTH(kode) = 2 and UPPER(nama) = UPPER("'.$value.'")';
				$check = $this->UserAddress->get_wilayah($param)->data->result_array();
				if ( empty($check) ) 
				{
					$result = array(
						'kode' 			=> 0,
						'message' 		=> 'Data Provinsi Tidak Ditemukan',
						'id' 			=> '',
						'nama' 			=> ''
					);
					echo json_encode($result); return;
				}
				else 
				{
					$result['provinsi'] = array(
						'kode' 			=> 1,
						'message' 		=> '',
						'id' 			=> $check[0]['kode'],
						'nama' 			=> $check[0]['nama']
					);
				}
			}
			else if ( $key == 'kota' ) 
			{ 
				$param = "CHAR_LENGTH(kode) = 5 and UPPER(nama) = UPPER('". $value ."')";
				$check = $this->UserAddress->get_wilayah($param)->data->result_array();
				if ( empty($check) ) 
				{
					$result = array(
						'kode' 			=> 0,
						'message' 		=> 'Data Kota/Kabupaten Tidak Ditemukan',
						'id' 			=> '',
						'nama' 			=> ''
					);
					echo json_encode($result); return;
				}
				else 
				{
					$result['kota'] = array(
						'kode' 			=> 1,
						'message' 		=> '',
						'id' 			=> $check[0]['kode'],
						'nama' 			=> $check[0]['nama']
					);
				}
			}
			else if ( $key == 'kecamatan' ) 
			{ 
				$param = "CHAR_LENGTH(kode) = 8 and UPPER(nama) = UPPER('". $value ."')";
				$check = $this->UserAddress->get_wilayah($param)->data->result_array();
				if ( empty($check) ) 
				{
					$result = array(
						'kode' 			=> 0,
						'message' 		=> 'Data Kecamatan Tidak Ditemukan',
						'id' 			=> '',
						'nama' 			=> ''
					);

					echo json_encode($result); return;
				}
				else 
				{
					$result['kecamatan'] = array(
						'kode' 			=> 1,
						'message' 		=> '',
						'id' 			=> $check[0]['kode'],
						'nama' 			=> $check[0]['nama']
					);
				}
			}
			else if ( $key == 'kelurahan' ) 
			{ 
				$param = "CHAR_LENGTH(kode) = 13 and UPPER(nama) = UPPER('". $value ."')";
				$check = $this->UserAddress->get_wilayah($param)->data->result_array();
				if ( empty($check) ) 
				{
					$result = array(
						'kode' 			=> 0,
						'message' 		=> 'Data Kelurahan Tidak Ditemukan',
						'id' 			=> '',
						'nama' 			=> ''
					);

					echo json_encode($result); return;
				}
				else 
				{
					$result['kelurahan'] = array(
						'kode' 			=> 1,
						'message' 		=> '',
						'id' 			=> $check[0]['kode'],
						'nama' 			=> $check[0]['nama']
					);
				}
			}
		}

        echo json_encode($result);

    }

	public function add_address_submit()
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

		$address = array(
			'id_user' 			=> $user->id,
			'address_name' 		=> $this->input->post('namaAlamat'),
			'recipient_name'	=> $this->input->post('namaPenerima'),
			'phone_number' 		=> $this->input->post('noTelp'),
			'address' 			=> $this->input->post('detailAlamat'),
			'note_address' 		=> $this->input->post('noteAlamat'),
			'province' 			=> $this->input->post('provinsiId'),
            'city' 				=> $this->input->post('kotaId'),
			'kecamatan' 		=> $this->input->post('kecamatanId'),
			'kelurahan' 		=> $this->input->post('kelurahanId'),
			'kode_pos' 			=> $this->input->post('inputZip'),
			'is_utama' 			=> empty($this->input->post('isUtama')) ? '0' : '1',
			'create_by' 		=> $user->id,
			'update_by' 		=> $user->id
		);

		// Insert data.
		$result = $this->UserAddress->insert($address);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('error', 'Anda gagal membuat alamat');
			redirect('address/list-address');
			return;
		}

		$this->session->set_flashdata('success', 'Anda berhasil membuat alamat');
		redirect('address/list-address');	
	}

	public function update_address_submit($id="")
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

		// Check Data Kosong
		foreach ( $this->input->post() as $key => $value ) {
			if ( $value == "" ) {
				$this->session->set_flashdata('error', 'Data tidak boleh kosong');
				redirect('address/list-address');
				return;
			}
		}

		// Check User Address
		$this->check_address($id);

		$data = array(
			'address_name' 		=> $this->input->post('namaAlamat'),
			'recipient_name'	=> $this->input->post('namaPenerima'),
			'phone_number' 		=> $this->input->post('noTelp'),
			'address' 			=> $this->input->post('detailAlamat'),
			'note_address' 		=> $this->input->post('noteAlamat'),
			'province' 			=> $this->input->post('provinsiId'),
            'city' 				=> $this->input->post('kotaId'),
			'kecamatan' 		=> $this->input->post('kecamatanId'),
			'kelurahan' 		=> $this->input->post('kelurahanId'),
			'kode_pos' 			=> $this->input->post('inputZip'),
			'update_by' 		=> $user->id
		);

		$param = array(
			'id'				=> $id
		);

		// Update data.
		$result = $this->UserAddress->update($data, $param);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('error', 'Anda gagal memperbarui alamat');
			redirect('address/list-address');
			return;
		}

		$this->session->set_flashdata('success', 'Anda berhasil memperbarui alamat');
		redirect('address/list-address');
			
	}

	public function delete_address()
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

		// Check User Address
		$this->check_address($this->input->get('id'));

		$data = array(
			'id'	=> $this->input->get('id')
		);

		// Delete data.
		$result = $this->UserAddress->delete($data);

		// Error Handler. If got error in page, please set db_debug = FALSE at application/database.php
		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('error', 'Anda gagal menghapus alamat');
			redirect('address/list-address');
			return;
		}

		$this->session->set_flashdata('success', 'Anda berhasil menghapus alamat');
		redirect('address/list-address');

	}

	public function set_utama()
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

		// Check User Address
		$this->check_address($this->input->get('id'));

		// Set Update All Data to is_utama 0
		$data = array(
			'is_utama' 	=> '0',
			'update_by'	=> $user->id
		);
		
		$result = $this->UserAddress->update($data);

		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('error', 'Anda gagal mengubah alamat utama');
			redirect('address/list-address');
			return;
		}

		// Set Update Data to Alamat Utama
		$data = array(
			'is_utama'	 => '1',
			'update_by'	=> $user->id
		);

		$param = array(
			'id' 		=> $this->input->get('id')
		);
		
		$result = $this->UserAddress->update($data, $param);

		if ($result->error['code'] !==  0 && $result->error['message']) {
			$this->session->set_flashdata('error', 'Anda gagal mengubah alamat utama');
			redirect('address/list-address');
			return;
		}

		$this->session->set_flashdata('success', 'Anda berhasil mengubah alamat utama');
		redirect('address/list-address');	

	}

	public function check_address($id="") 
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

		$resultAddress = $this->UserAddress->get_address_wilayah(array('id' => $id));
		$result = $resultAddress->data->result_array();

		if ($resultAddress->error['code'] !==  0 && $resultAddress->error['message']) {
            $this->session->set_flashdata('error', 'Maaf, Data tidak sesuai');
			redirect('address/list-address');
			return;
        }

		// Check user id = session user id
		if ( $user->id != $result[0]['id_user'] )
		{
			$this->session->set_flashdata('error', 'Maaf, Data tidak sesuai');
			redirect('address/list-address');
			return;
		}

		return;

	}

}