<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}
	
	public function index()
	{
		$this->render_page('main', 'product/listProduct');
	}

	public function cari_produk()
	{
		$merek = $this->input->get('merek[]');
		$harga = $this->input->get('harga[]');
		if(empty($merek) and empty($harga[0]) and empty($harga[1])){
			redirect('');
		}
		$this->render_page('main', 'product/listProduct');
	}

	public function detail_produk(){
		$this->render_page('main', 'product/detailProduct');
	}

	public function keranjang(){
		$this->render_page('main', 'transaction/cart');
	}

	public function detail_pesanan(){
		$this->render_page('main', 'transaction/orderDetails');
	}
}
