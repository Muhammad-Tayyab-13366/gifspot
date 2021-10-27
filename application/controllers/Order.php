<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
        $this->load->model('Model_Order');
        $this->load->library('cart');
        $this->load->helper('url');
    }
	
	public function index()
	{
		
	}
	public function OrderList()
	{
		$user_level = $this->session->userdata('user_level');
		$user_id = $this->session->userdata('user_id');
		if($this->session->userdata('user_id') == "")
		{
			header("Location:".$this->config->base_url());
			die();
		}
		$data[] = "";
		$filter = "";
		$url_order_id = $this->uri->segment(3); 
		if($url_order_id != "")
		$filter = " AND o.order_id = $url_order_id";

	    if($user_level == "customer")
	    $filter .= " AND o.customer_id = $user_id";
		$data['order_list'] = $this->Model_Order->GetOrderList($filter);
		$this->load->view('Order/orderlist', $data);
	}

	public function orderdetail()
	{
		if($this->session->userdata('user_id') == "")
		{
			header("Location:".$this->config->base_url());
			die();
		}
		$order_id = $this->uri->segment(3);
		$data['order_detail'] = $this->Model_Order->GetOrderDeatil($order_id);

		$this->load->view('Order/orderdetail', $data);
	}

	public function DeleteOrder()
	{
		$order_id = $this->input->post('order_id');
		$user_level = $this->session->userdata('user_level');
        if($user_level == "admin")
        {
        	$is_deleted = $this->Model_Order->DeleteOrder($order_id);
        	if($is_deleted)
        	{
        		$this->session->set_userdata("sucess", "<strong>Success!</strong> Order deleted successfully!");
        		echo "success";
        	}
        	else
        	{
        		echo "error";
        	}
        }
        else
        {
        	echo "error";
        }
	}


	public function CompleteOrder()
	{
		$order_id = $this->input->post('order_id');
		$user_level = $this->session->userdata('user_level');
        if($user_level == "admin")
        {
        	$is_deleted = $this->Model_Order->CompleteOrder($order_id);
        	if($is_deleted)
        	{
        		$this->session->set_userdata("sucess", "<strong>Success!</strong> Order completed successfully!");
        		echo "success";
        	}
        	else
        	{
        		echo "error";
        	}
        }
        else
        {
        	echo "error";
        }
	}

	


}
