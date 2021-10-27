<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
    }
	
	
	public function LoginVerification($email, $password)
	{
		$password = md5($password);
		$query = "
					SELECT * 
					FROM tbl_users 
					WHERE user_email = ".$this->db->escape($email)."
					and user_password = ".$this->db->escape($password)."
					and user_is_deleted = 0
					and user_type = 1 
		";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}

	public function CheckAlreadyExistCategory($category_name)
	{
		$query = "
					SELECT count(*) as count_row
					FROM tbl_categories 
					WHERE category_name = ".$this->db->escape($category_name)."
					AND 	category_is_deleted = 0 
		";
		$result = $this->db->query($query)->result_array();
		
		return $result; 	
	}

	public function AddCategory($category_name, $category_status)
	{
		$user_id = $this->session->userdata('user_id');
		$data_array = array(
								"category_name" => $category_name,
								"category_creator_id" => $user_id,
								"category_is_active" => $category_status
							);
		$this->db->insert('tbl_categories', $data_array);
	}

	public function GetAllCategory($is_get_count,  $offset='', $limit='')
	{
		$pagination = "";
		
		$col = "";

		if($is_get_count == 1)
		{
			$col = " count(*) as row_count";

		}
		else
		{
			$col = "  category_id ,
					  category_name,
					  category_is_active,
					  category_creator_id,
					  category_created_date,
					  category_modifier_id,
					  category_modified_date,
					  category_is_deleted 
					,
					(
					    SELECT tu.useR_name
					    FROM tbl_users tu
					    where tu.user_id = tc.category_creator_id 
					)as creator_name";

			$pagination = " limit ".$limit.' ,'.$offset; 

		}

		$query = "
		            select 
		            $col
		            from tbl_categories tc 
		            where tc.category_is_deleted = 0
		            $pagination

				";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}

	public function GetCategoryByID($category_id)
	{
		$query = "	select 
					category_id ,
					category_name,
					category_is_active,
					category_creator_id,
					category_created_date,
					category_modifier_id,
					category_modified_date,
					category_is_deleted 
					from tbl_categories tc 
		            where tc.category_is_deleted = 0
		            AND category_id = $category_id
				";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}

	public function UpdateCategory($category_name, $category_status, $category_id)
	{
		$user_id = $this->session->userdata('user_id');
		$query  = "
					 Update tbl_categories
					 set category_name = ".$this->db->escape($category_name).",
					 category_is_active = $category_status,
					 category_modifier_id= $user_id,
					 category_modified_date = Now()
					 where category_id = $category_id
				  ";
		$result = $this->db->query($query);
		
		return $result; 
	}

	public function DeleteCategoryByID($category_id)
	{
		$user_id = $this->session->userdata('user_id');
		$query = "
					UPDATE tbl_categories
					SET category_is_deleted = 1,
					category_modified_date = Now(),
					category_modifier_id= $user_id
					WHERE category_id = $category_id
		         ";
		$result = $this->db->query($query);
		
		return $result;
	}


	public function DeleteProductByID($product_id)
	{
		$user_id = $this->session->userdata('user_id');
		$query = "
					UPDATE tbl_product
					SET product_is_deleted = 1,
					product_modified_date = Now(),
					product_modifier_id= $user_id
					WHERE product_id = $product_id
		         ";
		$result = $this->db->query($query);
		
		return $result;
	}


	public function GetCategories()
	{
		$query = "
					SELECT tc.category_name,
					tc.category_id
					FROM tbl_categories tc
					WHERE tc.category_is_active = 1
					AND tc.category_is_deleted = 0
				";
		$result = $this->db->query($query)->result_array();
		
		return $result;
	}

	public function CheckAlreadyExistProduct($filter)
	{
		$query = "
					SELECT COUNT(*) as row_count
					FROM tbl_product tp
					WHERE 1=1 
					$filter
					AND tp.product_is_deleted = 0
				";
		$result = $this->db->query($query)->result_array();
		
		return $result; 	
	}

	public function AddProduct($product_name,$product_status, $category_id, $product_desc, $target_file, $product_price)
	{
		$user_id = $this->session->userdata('user_id');
		$query = "
		INSERT INTO tbl_product
		(	 product_name,
		     product_description,
		     product_image_path,
		     category_id,
		     product_is_active,
		     product_created_date,
		     product_creator_id,
		     product_price
		 ) 
		 VALUES
		 (
		     ".$this->db->escape($product_name).",
		     ".$this->db->escape($product_desc).",
		     ".$this->db->escape($target_file).",
		     $category_id,
		     $product_status,
		     NOW(),
		     $user_id,
		     $product_price
		 )";
		$result = $this->db->query($query);
		
		return $this->db->insert_id(); 
	}

	public function GetAllProducts($is_get_count = '', $offset='', $limit='')
	{
		$pagination ="";
		$col ="";
		if($is_get_count == 1)
		{
			$col = " count(*) as row_count";
		}
		else
		{
			$col = " 
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
						    select c.category_name
						    from tbl_categories c
						    WHERE c.category_id = tp.category_id
						)AS category_name,
						(
						    SELECT tu.useR_name
						    FROM tbl_users tu
						    where tu.user_id = tp.product_creator_id 
						)as creator_name
						
						";

			$pagination = " limit ".$limit.' ,'.$offset; 
		}

		$query = "
					SELECT $col
					FROM  tbl_product tp
					WHERE tp.product_is_deleted = 0
					$pagination
				 ";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}

	public function GetProductByID($url_product_id)
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
						)as creator_name
						from tbl_product tp
						where tp.product_id = $url_product_id
		         ";
		$result = $this->db->query($query)->result_array();
		
		return $result; 
	}


	public function UpdateProduct($product_name,$product_status, $category_id, $product_desc, $target_file, $url_product_id, $product_price )
	{
		$user_id = $this->session->userdata('user_id');
		
		$data = array(
						'product_name' => $product_name,
						'product_description' => $product_desc,
						'product_image_path' => $target_file,
						'category_id' => $category_id,
						'product_is_active' => $product_status,
						'product_modified_date' => date("Y-m-d h:i:s"),
						'product_modifier_id' => $user_id,
						'product_name' => $product_name,
						'product_price' =>$product_price
					 );
		$this->db->where('product_id', $url_product_id );
		$this->db->update('tbl_product', $data);
		
	}


	public function GetAllCustomer()
	{
		$query = "
		            select *
		            from tbl_customer
		            order by customer_name
		";

		$result = $this->db->query($query)->result_array();
		return $result;
	}


	public function UpdateCustomer($status, $customer_id )
	{
		$result = false;
		if($customer_id !="")
		{
			$query = "
			UPDATE tbl_customer 
			set customer_is_active = $status
			WHERE customer_id = $customer_id";

			$result= $this->db->query($query);
		}
		
		return $result;
	}

}
