<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URLm/index.php/welcome
	 *	- or -
	 * 		http://example.co
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
        $this->load->library('cart');
        $this->load->helper('url');
    }
	
	public function index()
	{

	}

	public function register()
	{
		$data[] = "";
		$data['error'] = "";
		$data['success'] = "";
		if(isset($_POST['btn_register']))
		{
			$name     = $this->input->post('name');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			if($name == "")
			{
				$data['error'] = "Name is required";
			}
			elseif($email == "")
			{
				$data['error'] = "Email is required";
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$data['error'] = "Invalid email address";
			}
			elseif($password == "")
			{
				$data['error'] = "Password is required";
			}
			else
			{
				
				$is_email_exist = $this->Model_Home->CheckEmialAlreadyExist($email);
                if(count($is_email_exist) > 0)
                {
                	$data['error'] = "Email already exist";
                }
                else
                {
                	$this->Model_Home->CreateNewAccount($name, $email, $password);
					$data['success'] = "Register successfully. Please login to place order/checkout";
				}
			}

		}
		$this->load->view('Customer/register', $data);
	}


	public function LoginCustomer()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$result = $this->Model_Home->LoginCustomer($email, $password);
		if(count($result) > 0)
		{
			$user_id    = $result[0]['customer_id'];
			$user_name  = $result[0]['customer_name'];
			$user_email = $result[0]['customer_email'];
			$user_level = 'customer';

			$data = array("user_id"=>$user_id, "user_name"=>$user_name, "user_email"=>$user_email, "user_level"=> $user_level);
		    $this->session->set_userdata($data);
            echo "success";
		    if(count($this->cart->contents()) > 0)
		    {

		    	// echo $this->config->base_url()."Cart/";
		    }
		}
		else
		{
			echo "error";
		}
		
		//print_r($result);

	}

	public function Logout()
	{
		session_destroy();
		header("location:".$this->config->base_url());

	}


}
