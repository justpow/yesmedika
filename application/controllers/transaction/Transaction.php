<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products');
		$this->load->model('variants');
		$this->load->model('cart');
		$this->load->model('transactions');
        $this->load->model('UserAddress');
        $this->load->model('ratings');
        $this->load->model('payment');
        $this->load->model('couriers');
    }
    
    private function compile_cart_items($cart)
    {
        $item_checked = [];
        foreach ($cart as $key => $value) {
            $vars = explode("_", $key);
            if ($vars[0] == 'checked') {
                $item_checked[$vars[1].'_'.$vars[2]] = new stdClass();
                $item_checked[$vars[1].'_'.$vars[2]]->qty = 0;
            }
        }

        foreach ($cart as $key => $value) {
            $vars = explode("_", $key);
            if ($vars[0] == 'qty' && isset($item_checked[$vars[1].'_'.$vars[2]])) {
                $item_checked[$vars[1].'_'.$vars[2]]->qty = $value;
            }
        }

        return $item_checked;
    }
		
	public function pre_checkout()
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

        // Get Address Utama
        $where_address = array('id_user' => $user->id, 'is_utama' => 1);
        $address_utama = $this->UserAddress->get_address_wilayah($where_address);
        $selected_address = null;
        if (count($address_utama->data->result_array()) > 0) {
            $selected_address = $address_utama->data->result_array()[0];
        } 
        

        // Get Adress All
        $where_address = array('id_user' => $user->id);
        $address_all = $this->UserAddress->get_address_wilayah($where_address);
        $all_address = $address_all->data->result_array();

        // Re-mapping cart item to array list.
        $item_checked = $this->compile_cart_items($_POST);
        
        $grand_total = 0;
        foreach ($item_checked as $key => $value) {
            $vars = explode("_", $key);
            $product_id = $vars[0];
            $variant_id = $vars[1] == 0 ? null : $vars[1];

            // Update checked item's quantity.
            $result = $this->cart->update(array('qty' => $value->qty), array('product_id' => $product_id, 'variant_id' => $variant_id, 'username' => $user->username));
            if ($result->error['code'] !==  0 && $result->error['message']) {
                redirect(''); // temporary error handler.
                return;
            }

            // Get product by id.
            $filter = array('id' => $product_id);
            $resultProd = $this->products->get_products(1, 1000, '', 'id', 'desc', '', '', '', $filter);
            if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                $this->send_api_response(500, (object)$resultProd->error);
                return;
            }
    
            $value->product = $resultProd->data->result_array()[0];

            // Get variant product.
            if ($variant_id != null) {
                $resultVar = $this->variants->get_variants(array('id' => $variant_id));
                $value->variant = $resultVar->data->result_array()[0];
                $value->product['price'] = $value->variant['price'];
            }

            $grand_total += $value->product['price'] * $value->qty;
        }

        $data = array(
            'item_checked' => $item_checked,
            'grand_total' => $grand_total,
            'address' => $selected_address,
            'address_all' => $all_address
        );

        // Set checked item session for making checkout process easy.
        $this->session->set_tempdata('item_checked', $item_checked, 1800); // 30 minutes.

		$this->render_page('main', 'transaction/orderDetails', $data);
	}

    public function checkout()
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

        $item_checked = $this->session->userdata('item_checked');
        if (count($item_checked) == 0) {
            redirect('cart');
            return;
        }

        // pickup type.
        $pickup_type = 0;

        // address id.
        $address_id = 0;
        
        // address string.
        $address_string = '';

        // payment type.
        $payment_type = 0;

        // shipping desc.
        $shipping_desc = "";

        // Mapping note to checked item.
        foreach ($_POST as $key => $value) {
            if ($key != 'note' && $key != 'pickup_type' && $key != 'address_id' && $key != 'address_string' && $key != 'payment_type' && $key != 'shipping_desc') {
                @$item_checked[$key]->note = $value;
            }
        }

        $pickup_type = $_POST['pickup_type'];
        $address_id = $_POST['address_id'];
        $address_string = $_POST['address_string'];
        $payment_type = $_POST['payment_type'];
        $shipping_cost = 0;
        $shipping_desc = $_POST['shipping_desc'];
        $destination_code = 0;
        $origin_code = 115; // DEPOK
        $total_weight = 0;
        

        // Payment expiration time.
        $date_expire = date("Y-m-d H:i:s", strtotime('+3 hours'));

        // Inserting to transaction.
        $this->db->trans_start();
        $result = $this->transactions->insert_transaction(array(
            // Temporary due to only self-delivery/COD system is available right now. 
            'shipping_cost' => 0,
            
            /**
             * Define status (may change in depends its condition).\
             * See it at: application/config/constants.php
             * 
             * TRANS = [
             *      'WAITING_PAYMENT' => 1,
             *      'ON_PROCESS' => 2,
             *      'ON_DELIVERY' => 3,
             *      'DELIVERED' => 4,
             *      'CANCELLED' => 5
             * ]
             */
            'status' => TRANS['WAITING_PAYMENT'],

            // Need table for Kurir/Pickup.
            'pickup_type'=> $pickup_type,

            'address_id' => $address_id,
            'payment_type' => $payment_type,
            'address_string' => $address_string,
            'create_by' => $user->id,
            'update_by' => $user->id,
            'create_time' => date("Y-m-d H:i:s"),

            // Payment expiration time. Payment expiration will be implemented by using cron.
            'expire' => $date_expire
        ));
        if ($result->error['code'] !==  0 && $result->error['message']) {
            redirect('cart'); // temporary error handler. Need flashdata.
            return;
        }

        // Trans ID.
        $trans_id = $result->data;

        //Grand Total.
        $grand_total = 0;

        // Inserting item to transaction-product.
        foreach ($item_checked as $value) {

            // Get detail product. e.g: stock, status, etc.
            $resultDetailProduct = $this->products->get_products(1, 10, '', 'id', 'desc', '', '', '', array(
                'id' => $value->product['id']
            ));
            if ($resultDetailProduct->error['code'] !==  0 && $resultDetailProduct->error['message']) {
                $this->session->set_flashdata('checkout_error', $resultDetailProduct->error['message']);
                redirect('cart');
                return;
            }
            
            $resultDetailProduct = $resultDetailProduct->data->result_array();
            $resultVariant = '';
            // Check product validity.
            if (count($resultDetailProduct) == 0) {
                $this->session->set_flashdata('checkout_error', 'produk tidak valid');
                redirect('cart');
                return;
            }
            
            // Check product status.
            if ($resultDetailProduct[0]['status'] != PRODUCT['ACTIVE']) {
                $this->session->set_flashdata('checkout_error', 'produk '.$resultDetailProduct[0]['name'].' tidak tersedia');
                redirect('cart');
                return;
            }

            if (!isset($value->variant)) {
                // Check stock product
                if ($resultDetailProduct[0]['stock'] < $value->qty) {
                    $this->session->set_flashdata('checkout_error', 'stok '.$resultDetailProduct[0]['name'].' tidak mecukupi');
                    redirect('cart');
                    return;
                }
            
                if ($resultDetailProduct[0]['stock'] == 0) {
                    $this->session->set_flashdata('checkout_error', 'stok '.$resultDetailProduct[0]['name']." habis");
                    redirect('cart');
                    return;
                }
            } else {
                // Get variant detail.
                $resultVariant = $this->variants->get_variants(array('id' => $value->variant['id']));
                if ($resultVariant->error['code'] !==  0 && $resultVariant->error['message']) {
                    $this->session->set_flashdata('checkout_error', $resultVariant->error['message']);
                    redirect('cart');
                    return;
                }
                
                // Check variant product.
                $resultVariant = $resultVariant->data->result_array();
                if ($resultVariant[0]['stock'] < $value->qty) {
                    $this->session->set_flashdata('checkout_error', 'stok '.$resultDetailProduct[0]['name'].' '.$resultVariant[0]['name'].' tidak mecukupi');
                    redirect('cart');
                    return;
                }
            
                if ($resultVariant[0]['stock'] == 0) {
                    $this->session->set_flashdata('checkout_error', 'stok '.$resultDetailProduct[0]['name'].' '.$resultVariant[0]['name']." habis");
                    redirect('cart');
                    return;
                }
            }

            $grand_total += $value->qty * $value->product['price'];

            $resultTransProd = $this->transactions->insert_transaction_product(array(
                'transaction_id' => $trans_id,
                'product_id' => $value->product['id'],
                'variant_id' => isset($value->variant) ? $value->variant['id'] : null,
                'qty' => $value->qty,
                'note' => $value->note,
                'total_price' => $value->qty * $value->product['price']
            ));
            if ($resultTransProd->error['code'] !==  0 && $resultTransProd->error['message']) {
                $this->session->set_flashdata('checkout_error', $resultTransProd->error['message']);
                redirect('cart');
                return;
            }

            // Calculate totalWeight.
            $total_weight += $resultDetailProduct[0]['weight']*$value->qty;           

            // Deleting data from cart.
            $resultDelete = $this->cart->delete(array('product_id' => $value->product['id'], 'variant_id' => isset($value->variant) ? $value->variant['id'] : null, 'username' => $user->username));
            if ($resultDelete->error['code'] !==  0 && $resultDelete->error['message']) {
                $this->session->set_flashdata('checkout_error', $resultDelete->error['message']);
                redirect('cart');
                return;
            }

            // Reduce stock based on transaction of product.
            if (!isset($value->variant)) {
                $resultProd = $this->products->update(array('stock' => $resultDetailProduct[0]['stock'] - $value->qty), array('id' => $value->product['id']));
                if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                    $this->session->set_flashdata('checkout_error', $resultProd->error['message']);
                    redirect('cart');
                    return;
                }
            } else {
                $resultProd = $this->variants->update(array('stock' => $resultVariant[0]['stock'] - $value->qty), array('id' => $value->variant['id']));
                if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                    $this->session->set_flashdata('checkout_error', $resultProd->error['message']);
                    redirect('cart');
                    return;
                }
            }
        }

   
        if ($pickup_type == PICKUP['JNE']) {
            $res = $this->UserAddress->get_address_wilayah(array('address.id' =>  $address_id));
            if ($res->error['code'] !==  0 && $res->error['message']) {
                $this->session->set_flashdata('checkout_error', $res->error['message']);
                redirect('cart');
                return;
            }

            $res = $res->data->result_array();
            if (count($res) == 0) {
                $this->session->set_flashdata('checkout_error', 'Alamat tidak ditemukan');
                redirect('cart');
                return;
            }
            
            $destination_code = $res[0]['kode_ongkir'];
            
            $result = $this->couriers->get_cost($origin_code, $destination_code, $total_weight, strtolower(PICKUP[$pickup_type]));
            if (!empty($result) && isset($result->rajaongkir) && count($result->rajaongkir->results) != 0) {
                $list = $result->rajaongkir->results[0]->costs;

                for ($i=0; $i < count($list); $i++) {                    
                    if ($list[$i]->service == $shipping_desc) {
                        $shipping_desc.= " (".$list[$i]->cost[0]->etd." hari)";
                        $shipping_cost = $list[$i]->cost[0]->value;
                    break;
                    }
                }
            }

            // Update transaction shipping cost and description.
            $result = $this->transactions->update_transaction(array(
                'shipping_cost' => $shipping_cost,
                'shipping_desc' => $shipping_desc), array('id' => $trans_id));
            if ($result->error['code'] !==  0 && $result->error['message']) {
                redirect('cart'); // temporary error handler. Need flashdata.
                return;
            }

        }

        $data = array(
            'transaction_id' => $trans_id,
            'invoice' => 'INV/YES/'.$trans_id, // Temporary, need discuss the invoice format.
            'total' => $grand_total+$shipping_cost,
            'expire' => $date_expire
        );

        $this->db->trans_complete();
        $this->session->unset_userdata('item_checked');

        // // COD, Need create COD result page. Temporary disable from FE.
        // if ($payment_type == 1) {
        //     $this->render_page('main', 'transaction/payment_cod', $data);
        //     return;
        // }

        $this->render_page('main', 'transaction/payment', $data);
    }

    public function history_page()
    {
        // Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }
        
        $this->render_page('main', 'transaction/orderHistory');   
    }

    public function history()
    {
        // Check user permission.
        if (!$this->has_access(CHECKOUT)) {
			redirect('login');
			return;
        }

        $page     = isset($_GET['page'])     ? $_GET['page'] : 1;
        $per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $status  = isset($_GET['status'])  ? $_GET['status'] : 1;


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

        // Get total transactions.
        $resultTrans = $this->transactions->get_transaction(1, 1000, array('create_by' => $user->id, 'status' => $status));
        if ($resultTrans->error['code'] !==  0 && $resultTrans->error['message']) {
            $this->send_api_response(500, (object)$resultTrans->error);
            return;
        }


        $total_data = $resultTrans->data->num_rows();
        $total_page = ceil($total_data/$per_page);

        // Handle limitation of the page.
        if ($page > $total_page) {
            $this->send_api_response(404);
            return;
        }

        // Get data transaction by user id.
        $resultTrans = $this->transactions->get_transaction($page, $per_page, array('create_by' => $user->id, 'status' => $status));
        if ($resultTrans->error['code'] !==  0 && $resultTrans->error['message']) {
            $this->send_api_response(500, (object)$resultTrans->error);
            return;
        }

        $resultTrans = $resultTrans->data->result_array();

        foreach ($resultTrans as $key => $value) {
            // Get data transaction product by transaction id.
            $resultTransProd = $this->transactions->get_transaction_product(array('transaction_id' => $value['id']));
            if ($resultTransProd->error['code'] !==  0 && $resultTransProd->error['message']) {
                $this->send_api_response(500, (object)$resultTransProd->error);
                return;
            }

            $value['trans_prod'] = $resultTransProd->data->result_array();
            foreach ($value['trans_prod'] as $key2 => $value2) {
                 // Get product by id.
                $filter = array('id' => $value2['product_id']);
                $resultProd = $this->products->get_products(1, 1000, '', 'id', 'desc', '', '', '', $filter);
                if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                    $this->send_api_response(500, (object)$resultProd->error);
                    return;
                }
        
                $value2['product'] = $resultProd->data->result_array()[0];

                // Get variant product.
                if ($value2['variant_id'] != null) {
                    $resultVar = $this->variants->get_variants(array('id' => $value2['variant_id']));
                    $value2['variant'] = $resultVar->data->result_array()[0];
                    $value2['product']['price'] = $value2['variant']['price'];
                }

                $value['trans_prod'][$key2] = $value2;
            }

            $resultTrans[$key] = $value;
        }

        $this->send_api_response(200, $resultTrans);

        // $this->render_page('main', 'transaction/orderHistory', $resultTrans);
    }


    public function detail($trans_id)
    {

        // Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }

        // Get data transaction by user id.
        $resultTrans = $this->transactions->get_transaction(1, 1, array('create_by' => $user->id, 'id' => $trans_id));
        if ($resultTrans->error['code'] !==  0 && $resultTrans->error['message']) {
            $this->send_api_response(500, (object)$resultTrans->error);
            return;
        }

        $resultTrans = $resultTrans->data->result_array();

        if (count($resultTrans) == 1) {
            $transDetail = $resultTrans[0];

            // Get buyer address.
            $where_address = array('id_user' => $user->id, 'id' => $transDetail['address_id']);
            $address = $this->UserAddress->get_address_wilayah($where_address);
            if ($address->error['code'] !==  0 && $address->error['message']) {
                $this->send_api_response(500, (object)$address->error);
                return;
            }

            $address = $address->data->result_array();
            if (count($address) > 0) {
                $transDetail['recipient_name'] = $address[0]['recipient_name'];
                $transDetail['phone_number'] = $address[0]['phone_number'];
            }

            // Get data transaction product by transaction id.
            $resultTransProd = $this->transactions->get_transaction_product(array('transaction_id' => $transDetail['id']));
            if ($resultTransProd->error['code'] !==  0 && $resultTransProd->error['message']) {
                $this->send_api_response(500, (object)$resultTransProd->error);
                return;
            }

            $transDetail['trans_prod'] = $resultTransProd->data->result_array();
            foreach ($transDetail['trans_prod'] as $key2 => $value2) {
                // Get product by id.
                $filter = array('id' => $value2['product_id']);
                $resultProd = $this->products->get_products(1, 1000, '', 'id', 'desc', '', '', '', $filter);
                if ($resultProd->error['code'] !==  0 && $resultProd->error['message']) {
                    $this->send_api_response(500, (object)$resultProd->error);
                    return;
                }
        
                $value2['product'] = $resultProd->data->result_array()[0];

                // Get variant product.
                if ($value2['variant_id'] != null) {
                    $resultVar = $this->variants->get_variants(array('id' => $value2['variant_id']));
                    $value2['variant'] = $resultVar->data->result_array()[0];
                    $value2['product']['price'] = $value2['variant']['price'];
                }

                // Get user review.
                $review = $this->ratings->get_reviews(1, 1000, array('transaction_product_id' => $value2['id'], 'create_by' => $user->id));
                if ($review->error['code'] !==  0 && $review->error['message']) {
                    $this->send_api_response(500, (object)$review->error);
                    return;
                }

                $review = $review->data->result_array();
                if (count($review) > 0) {
                    $value2['review'] = $review[0];
                }

                // Get latest payment doc.
                $payment_docs = $this->payment->get(array('transaction_id' => $transDetail['id']), 'create_time', 'desc');
                if ($payment_docs->error['code'] !==  0 && $payment_docs->error['message']) {
                    $this->send_api_response(500, (object)$payment_docs->error);
                    return;
                }

                $payment_docs = $payment_docs->data->result_array();
                $transDetail['trans_prod'][$key2] = $value2;

                if (count($payment_docs) != 0) {
                    $transDetail['payment_doc'] = $payment_docs[0];
                }
            }
        } else {
            redirect('');
        }

        $this->render_page('main', 'transaction/transactionDetails', $transDetail);
    }


    public function cancel_order()
    {
        
        // Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }

        // Update Status Transaction to Cancelled
        $resultCancel = $this->transactions->update_transaction(array('status' => TRANS['CANCELLED']), array('create_by' => $user->id, 'id' => $_GET['id']));
        if ($resultCancel->error['code'] !==  0 && $resultCancel->error['message']) {
            $this->send_api_response(500, (object)$resultCancel->error);
            return;
        }
        
        redirect('transaction/detail/'.$_GET['id']);

    }

    public function complete_order()
    {
        
        // Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }

        // Update Status Transaction to Done
        $resultCancel = $this->transactions->update_transaction(array('status' => TRANS['DONE']), array('create_by' => $user->id, 'id' => $_GET['id']));
        if ($resultCancel->error['code'] !==  0 && $resultCancel->error['message']) {
            $this->send_api_response(500, (object)$resultCancel->error);
            return;
        }
        
        redirect('transaction/detail/'.$_GET['id']);

    }


    public function upload_payment($trans_id)
    {

        // Get user session.
        $user = (object)$this->session->userdata('user');
        if (!isset($user)) {
            redirect('login');
            return;
        }
        
        $sender = $this->input->post('sender_name');
        $number = $this->input->post('account_number');
        $provider = $this->input->post('provider');
        $amount = $this->input->post('amount');

        // Base path of upload location.
        $base_path = 'assets/payment_docs/';

        // Upload process.
        $res = $this->yesmedika->do_upload($base_path, 'file', $trans_id);
        if ($res['error'] != '') {
            $this->session->set_flashdata('upload_error', 'upload bukti bayar gagal, silahkan coba lagi pada tombol di bawah');
            redirect('transaction/detail/'.$trans_id);
        }

        // File location.
        $file_location = $base_path.$res['data']['file_name'];

        // Insert payment doc.
        $data = array(
            'transaction_id' => $trans_id,
            'sender_name' => $sender,
            'account_number' => $number,
            'provider' => PAYMENT_PROVIDER[$provider],
            'amount' => $amount,
            'file_location' => $file_location,
            'status' => PAYMENT_DOC_STATUS['WAITING'],
            'create_by' => $user->id
        );

        $result = $this->payment->insert($data);
        if ($result->error['code'] !==  0 && $result->error['message']) {
            print_r($result);
            $this->session->set_flashdata('upload_error', 'upload bukti bayar gagal, silahkan coba lagi pada tombol di bawah');
            redirect('transaction/detail/'.$trans_id);
        }
        
        $this->session->set_flashdata('upload_success', 'upload bukti sukses, admin akan segera validasi bukti bayar');
        redirect('transaction/detail/'.$trans_id);
    }
}
