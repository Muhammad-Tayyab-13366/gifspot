<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->library('cart');
        $this->load->helper('url');
    }
	
	public function index()
	{

		$category_id = $this->uri->segment(3);
		$data = [];
		$start_date = date("Y-m-d H:i:s");
		$end_date   = date("Y-m-d H:i:s", strtotime($start_date." -7 days"));
		$filter = "";// AND tp.product_created_date between '$start_date' and '$end_date'";
		$data['current_week_product'] = "";
		$data['birthday_gift'] = "";
		$data['birthday_gift']  = "";
		$data['category_product'] = "";
		if($category_id !="")
		{
			$filter .= " AND tp.category_id = $category_id";
			$data['category_product'] = $this->Model_Home->GetProducts($filter, $order_by = "order by tp.product_id desc ", $limit= ' ');
		}
		else
		{
            $data['current_week_product'] = $this->Model_Home->GetProducts($filter, $order_by = "order by tp.product_id desc ", $limit= ' limit 5');
			$filter = "AND tp.category_id = 7 ";
			$data['birthday_gift'] = $this->Model_Home->GetProducts($filter, $order_by = "order by tp.product_id desc ", $limit= ' limit 5');
			
			$filter = "AND tp.category_id = 13 ";
			$data['Wedding_gifts'] = $this->Model_Home->GetProducts($filter, $order_by = "order by tp.product_id desc ", $limit= ' limit 5');
		}
		$this->load->view('Home/Home', $data);
	}
}
