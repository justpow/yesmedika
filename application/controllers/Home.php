<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index()
	{
		$this->render_page('main', 'product/listProduct');
	}

	public function cari_produk()
	{
		$merek = $this->input->get('merek[]');
		$harga = $this->input->get('harga[]');
		var_dump($merek); var_dump($harga); die();
		$this->render_page('main', 'product/listProduct');
	}
}
