<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('ratings');
        $this->load->model('transactions');
        $this->load->model('user');
    }

    public function list_review()
    {
        // Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }

        $page     = isset($_GET['page'])     ? $_GET['page'] : 1;
        $per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $status  = isset($_GET['status'])  ? $_GET['status'] : 1;
        $product_id  = isset($_GET['product_id'])  ? $_GET['product_id'] : 1;


        header('Content-Type: application/json');

        // Max page that can be loaded.
        if ($page > MISC['MAX_PAGE']) {
            $this->send_api_response(404);
            return;
        }

        // Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }

        // Get total reviews.
        $resultReview = $this->ratings->get_reviews(1, 5000, array('product_id' => $product_id, 'status' => $status));
        if ($resultReview->error['code'] !==  0 && $resultReview->error['message']) {
            $this->send_api_response(500, (object)$resultReview->error);
            return;
        }

        $total_data = $resultReview->data->num_rows();
        $total_page = ceil($total_data/$per_page);

        // Handle limitation of the page.
        if ($page > $total_page) {
            $this->send_api_response(404);
            return;
        }

        // Get data review by product id.
        $result = $this->ratings->get_reviews($page, $per_page, array('product_id' => $product_id, 'status' => $status));
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->send_api_response(500, (object)$result->error);
            return;
        }

        $result = $result->data->result_array();
        foreach ($result as $key => $value) {
            $user_result = $this->user->get(array('user.id' => $user->id));
            if ($user_result->error['code'] !==  0 && $user_result->error['message']) {
                $this->send_api_response(500, (object)$user_result->error);
                return;
            }

            $user_result = $user_result->data->result_array()[0];
            @$result[$key]['reviewer'] = $user_result['firstname'].' '.$user_result['lastname'];
        }

        $this->send_api_response(200, $result);
    }

    public function submit_review()
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

        $comment = array();
        $rate = array();
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'msg') !== false) { 
                $comment[explode("_", $key)[1]] = $value;
            } else {
                $rate[$key] = $value;
            }
        }
        
        
        // TODO: SUPPORT MULTIPLE UPLOAD IMAGES.
        //===============================================
        // $images   = isset($_FILE['images']) ? $_FILE['images'] : null;
        // $file_path = './upload/'.$product_id.'/';
        // $upload_success = $this->upload_files($file_path, $user->username, $images);
        // if (!$upload_success) {
        //     $this->send_api_response(400);
        //     return;
        // }


        $this->db->trans_start();
        foreach ($rate as $key => $value) {

            // Get data transaction product by transaction product id.
            $resultTransProd = $this->transactions->get_transaction_product(array('id' => $key));
            if ($resultTransProd->error['code'] !==  0 && $resultTransProd->error['message']) {
                $this->send_api_response(500, (object)$resultTransProd->error);
                return;
            }

            $transRes =  $resultTransProd->data->result_array();
            if (count($transRes) == 0) {
                $this->send_api_response(500);
                return;
            }

            $result = $this->ratings->insert(array(
                'rate' => $rate[$key],
                'comment' => $comment[$key],
                'transaction_product_id' => $key,
                'product_id' => $transRes[0]['product_id'],
                'status' => 1, //active
                'create_by' => $user->id,
                'create_time' => date("Y-m-d H:i:s"),
            ));
            if ($result->error['code'] !==  0 && $result->error['message']) {
                $this->send_api_response(500, (object)$result->error);
                return;
            }
        }
     
        $this->db->trans_complete();
        redirect('transaction/detail/'.$transRes[0]['transaction_id']);
    }

    private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }
}
