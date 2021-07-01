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
            'grand_total' => $grand_total
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

        // Mapping note to checked item.
        foreach ($_POST as $key => $value) {
            $item_checked[$key]->note = $value;
        }

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

            'create_by' => $user->id,
            'update_by' => $user->id,
            'create_time' => date("Y-m-d H:i:s"),

            // Payment expiration time.
            'expire' => $date_expire
        ));
        if ($result->error['code'] !==  0 && $result->error['message']) {
            $this->db->trans_complete();
            redirect('cart'); // temporary error handler. Need flashdata.
            return;
        }

        // Trans ID.
        $trans_id = $result->data;

        //Grand Total.
        $grand_total = 0;

        // Inserting item to transaction-product.
        foreach ($item_checked as $value) {
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
                $this->db->trans_complete();
                redirect('cart'); // temporary error handler. Need flashdata.
                return;
            }

            // Deleting data from cart.
            $resultDelete = $this->cart->delete(array('product_id' => $value->product['id'], 'variant_id' => isset($value->variant) ? $value->variant['id'] : null, 'username' => $user->username));
            if ($resultDelete->error['code'] !==  0 && $resultDelete->error['message']) {
                $this->db->trans_complete();
                redirect('cart'); // temporary error handler. Need flashdata.
                return;
            }
        }

        $data = array(
            'invoice' => 'INV/YES/'.$trans_id, // Temporary, need discuss the invoice format.
            'total' => $grand_total,
            'expire' => $date_expire
        );

        $this->db->trans_complete();
        $this->session->unset_userdata('item_checked');
        $this->render_page('main', 'transaction/payment', $data);
    }

    // TO DO: NEED IMPLEMENT LAZY LOAD.
    public function history()
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

        // Get data transaction by user id.
        $resultTrans = $this->transactions->get_transaction(array('create_by' => $user->id));
        if ($resultTrans->error['code'] !==  0 && $resultTrans->error['message']) {
            redirect(''); // temporary error handler. Need flashdata.
            return;
        }

        $resultTrans = $resultTrans->data->result_array();

        foreach ($resultTrans as $key => $value) {
            // Get data transaction product by transaction id.
            $resultTransProd = $this->transactions->get_transaction_product(array('transaction_id' => $value['id']));
            if ($resultTransProd->error['code'] !==  0 && $resultTransProd->error['message']) {
                redirect(''); // temporary error handler. Need flashdata.
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

        $this->render_page('main', 'transaction/orderHistory', $resultTrans);
    }
}
