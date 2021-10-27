<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Home extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
    }
	
	
	
	
	public function GetProducts($filter='', $order_by = '', $limit='' )
	{
	 	$query = "
		                select 
						tp.product_id,
						tp.product_name,
						tp.product_description,
						tp.product_image_path,
						tp.category_id,
						tp.product_price,
						tp.product_is_active,
						tp.product_created_date,
						tp.product_creator_id,
						tp.product_modified_date,
						tp.product_modifier_id,
						tp.product_is_deleted,
						(
						    SELECT tu.useR_name
						    FROM tbl_users tu
						    where tu.user_id = tp.product_creator_id 
						)as creator_name,
                        (
                            SELECT t.category_name
                            FROM tbl_categories t
                            where t.category_id = tp.category_id
                        )AS category_name
						from tbl_product tp
						where 1=1
						AND tp.product_is_deleted = 0
						$filter
						$order_by
						$limit

		         ";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}

	public function CreateNewAccount($name, $email, $password)
	{
		$data = array(
						"customer_name" => $name,
					 	"customer_email" => $email,
					 	"customer_pass" => md5($password)
					 );
		$this->db->insert('tbl_customer', $data);
	}

	public function CheckEmialAlreadyExist($email) 
	{

		$query = $this->db->select('*')->where('customer_email', $email)->get('tbl_customer')->result_array();
		return $query;
	}

	public function LoginCustomer($email, $password)
	{
		//$data = array();
		$password = md5($password);
		$password = mysqli_real_escape_string($this->db->conn_id, $password);
		$email = mysqli_real_escape_string($this->db->conn_id, $email);

		$query = "
					select *
					from tbl_customer 
					where customer_email = '$email' AND customer_pass = '$password'
					AND customer_is_active = 1

				";
		$query = $this->db->query($query)->result_array();
		//echo $this->db->last_query();
		return $query;
		

	}


}
