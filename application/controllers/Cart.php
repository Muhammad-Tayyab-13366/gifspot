<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
      	date_default_timezone_set("Asia/Karachi");
        $this->load->library('session');
        $this->load->model('Model_Home');
        $this->load->model('Model_Cart');
        $this->load->library('cart');
    }
	
	public function index()
	{
        $data = array();
        $data['success'] = "";
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        if(@$_POST['is_place_order'] == 1 && count($this->cart->contents()) > 0)
        {
            $pyment_type = $_POST['pyment_type'];
            $card_number = $_POST['card_number'];
            $name        = $_POST['name'];
            $phone       = $_POST['phone'];
            $address     = $_POST['address'];

            $order_id = $this->Model_Cart->AddOrder($pyment_type, $card_number, $name, $phone, $address );
            $this->session->set_userdata("sucess", "<strong>Success!</strong> Order place successfully!");
            header("Location:". $this->config->base_url()."Order/orderlist/".$order_id);
            $data['success'] = "success";
        }
        // Load the cart view
        $this->load->view('Cart/Cart_items', $data);
    }

	public function AddCart($proID)
	{
        
         $this->load->model('Model_Home');
        // Fetch specific product by ID
        $filter = " And tp.product_id = $proID";
        $product = $this->Model_Home->GetProducts($filter);
        



        // Add product to the cart
        $data = array(
            'id'    => $product[0]['product_id'],
            'qty'    => 1,
            'price'    => $product[0]['product_price'],
            'name'    => $product[0]['product_name'],
            'image' => $product[0]['product_image_path']
        );
        $this->cart->insert($data);
        
        // Redirect to the cart page
        header("Location:". $this->config->base_url()."Cart/");
    }

    
    function updateItemQty()
    {
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    
    function removeItem($rowid){
        // Remove item from cart
        $remove = $this->cart->remove($rowid);
        
        // Redirect to the cart page
       header("Location:". $this->config->base_url()."Cart/");
    }
    
}