<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Cart extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
      	date_default_timezone_set("Asia/Karachi");
        $this->load->library('session');
        $this->load->model('Model_Home');
        $this->load->library('cart');
    }
	

	public function AddOrder($pyment_type, $card_number, $name, $phone, $address )
	{  
		$this->db->trans_start();
		$customer_id = $this->session->userdata('user_id');
		$data =  array(
						'payment_type_id' => $pyment_type,
						'customer_id' => $customer_id,
						'customer_name' => $name,
						'customer_phone' => $phone,
						'customer_addess' => $address
					   );
		if($pyment_type == 1)
		{
			$data1 = array('customer_card_number' => $card_number);
			$data=array_merge($data, $data1);

		}

		$this->db->insert('tbl_orders', $data);
	    $order_id = $this->db->insert_id();
	    $cartItems = $this->cart->contents();
	    foreach($cartItems as $item)
        {
        	// $item["id"]; $item["name"] $item["price"] $item["qty"] $item["subtotal"]

			$data  = array(	
							"order_id" => $order_id,
							"product_id"=>$item["id"],
							"product_quantity"=>$item["qty"],
							"sub_total" => $item["subtotal"]
						);
			$this->db->insert('tbl_order_items', $data);

        } 
        $this->cart->destroy();
	    // $final_array=array_merge($existing_array, $new_array);
			/*
			SELECT `order_item_id`, `order_id`, `product_id`, `product_quantity`, `sub_total`, `order_item_is_deleted` FROM `tbl_order_items` WHERE 1

			SELECT `order_id`, `payment_type_id`, `customer_id`, `customer_name`, `customer_card_number`, `customer_phone`, `customer_addess`, `order_is_completed`, `order_is_deleted` FROM `tbl_orders` WHERE 1*/

		$this->db->trans_complete();
        
        return $order_id;

	}
}
