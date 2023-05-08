<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pesanan extends CI_Controller
{
    public function add_to_cart()
    {
        $data = array(
            array(
                'id'      => 'sku_123ABC',
                'qty'     => 12,
                'price'   => 1000,
                'name'    => 'T-Shirt',
                'options' => array('Size' => 'L', 'Color' => 'Red')
            ),

        );



        // $this->cart->insert($data);

        foreach ($this->cart->contents() as $r) {
            print_r($r['subtotal']);
            // print_r($r['price'] * $r['qty']);
            // print_r($this->cart->product_options($r['rowid']));
        }
    }
}
