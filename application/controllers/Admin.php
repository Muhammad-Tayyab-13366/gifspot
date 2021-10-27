<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('url');
        $this->load->model('Model_Admin');
        $this->load->library('session');
        $this->load->library('pagination');
    }
	public function Login()
	{

		$data[]='';
		$data['error'] = "";
		if(isset($_POST['login']))
		{
			$email      = $this->input->post('email');
			$password   = $this->input->post('password'); 

			if(trim($email) == "")
			{
				$data['error'] = "Email is required.";
			}
			else if(trim($password) == "")
			{
				$data['error'] = "Password is required.";

			}
			else
			{
				$result = $this->Model_Admin->LoginVerification($email, $password);
				
				if(count($result) == 0)
				{
					$data['error'] = "Email or password is not valid.";
				}
				else
				{
					$data['error']  = "";
					$user_id 	= $result[0]['user_id'];
					$user_name 	= $result[0]['user_name'];
					$user_email = $result[0]['user_email'];
					$user_phone = $result[0]['user_phone'];
					$user_type = $result[0]['user_type'];
					$user_level = 'admin';
					$session_data = array(
									        'user_name'  	=> $user_name,
									        'user_email'    => $user_email,
									        'user_phone' 	=> $user_phone,
									        'user_type' 	=> $user_type,
									        'user_id'       => $user_id,
									        'user_level'     => $user_level
										);

					$this->session->set_userdata($session_data);
					header("location:".$this->config->base_url().'Admin/Home');
				}
			}

			

		}
		$this->load->view('Admin/Login', $data);
		
	}

	public function Home()
	{
		$data[]= ""; 
		
		$user_type = $this->session->userdata('user_type');
		if($user_type != 1)
		{
			header("location:".$this->config->base_url().'Admin/Login');
		}
		$this->load->view('Admin/Admin_Home', $data);
	}

	public function AddCategory()
	{
		$data[] = "";
		$data["error"] = "";
		$data['success'] = "";
		$category_id = $this->uri->segment(3);
		if($category_id !="")
		{
			$data['GetCategoryByID'] = $this->Model_Admin->GetCategoryByID($category_id);
		}

		if(isset($_POST['login']))
		{
			$category_name     = $this->input->post('category_name');
			$category_status   = $this->input->post('category_status'); 


			if(trim($category_name) == "")
			{
				$data['error'] = "Category name is required.";
			}
			else if(trim($category_status) == "-1")
			{
				$data['error'] = "Category status is required.";

			}
			else
			{ 
				if($category_id =="")
				{
					$result = $this->Model_Admin->CheckAlreadyExistCategory($category_name);
					$count_row = $result[0]['count_row'];
					if($count_row > 0)
					{
						$data['error'] = "Category name already exist.";
					}
					else
					{
						$data['success']  = "Category added successfully.";
						$this->Model_Admin->AddCategory($category_name, $category_status);
					//	header("location:".$this->config->base_url().'Admin/Home');
					}
				}
				else
				{
					$this->Model_Admin->UpdateCategory($category_name, $category_status, $category_id);
					$data['success'] = "Category updated successfully!";//header("location:".$this->config->base_url().'Admin/AddCategory/$category_id');
				}

			}

			

		}
		$this->load->view('Admin/AddCategory', $data);
		
	}

	public function ViewCategory()
	{
		$data[] = "";
		$count = $this->Model_Admin->GetAllCategory($is_get_count = 1);
		$count_row = $count[0]['row_count'];
		$config = array();
        $config["base_url"] = $this->config->base_url() . "Admin/ViewCategory";
        $config["total_rows"] = $count_row;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config["per_page"] = 50;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["links"] = $this->pagination->create_links();

        $data['category'] =$this->Model_Admin->GetAllCategory($is_get_count = 0, $offset =$config["per_page"], $limit = $page);
		$this->load->view('Admin/ViewCategory', $data);
		
	}

	public function DeleteCategoryByID()
	{
		$category_id = $this->input->post('category_id');
		$result = $this->Model_Admin->DeleteCategoryByID($category_id);
		if($result)
		echo "success";
	}

	public function DeleteProductByID()
	{
		$product_id = $this->input->post('product_id');
		$result = $this->Model_Admin->DeleteProductByID($product_id);
		if($result)
		echo "success";
	}

	public function AddProduct()
	{
		$curent_date_time = date("Y m d h i s"); 
		$curent_date_time = str_replace(" ", "_", $curent_date_time);	//die();
		$data[]      		= "";
		$data["error"] 		= "";
		$data['success'] 	= "";
		$product_id         = "";
		$url_product_id     = $this->uri->segment(3);
		if($this->uri->segment(4) =="success" && (!isset($_POST['login'])))
		{
			$data['success'] 	= "Product Added successfully.";
		}

		if(isset($_POST['login']))
		{
			//echo $_FILES["p_image"]["name"];
			$product_name     = $this->input->post('product_name');
			$product_status   = $this->input->post('product_status'); 
			$category_id      = $this->input->post('category_id'); 
			$product_desc     = $this->input->post('product_description');
			$product_price    = $this->input->post('product_price');
			$target_file = $this->input->post("hdn_prd_img_path");
			//echo is_int($product_price);
			//print_r($_FILES);

			if(trim($product_name) == "")
			{
				$data['error'] = "Product name is required.";
			}
			else if(trim($product_desc) == "")
			{
				$data['error'] = "Product description is required.";

			}
			elseif($product_price == 0 || $product_price == "")
			{
				$data['error'] = "Product price is required.";	
			}
			elseif(filter_var($product_price, FILTER_VALIDATE_INT) === false)
			{
				$data['error'] = "Product price is Invalid.";		
			}
			else if(trim($category_id) == "0")
			{
				$data['error'] = "Category is required.";

			}
			else if(trim($product_status) == "-1")
			{
				$data['error'] = "Product status is required.";

			}
			elseif($_FILES["p_image"]["name"] =="" && 	$url_product_id == "" && 1==2)
			{
				$data['error'] = "Product image is required.";
				
				
			}
			else
			{ 
				
				


				if($url_product_id =="" || 1==1)
				{
					$filter = "";
					if($url_product_id =="")
					{
						$filter  = " AND tp.product_name =  ".$this->db->escape($product_name);
					}
					else
					{
						$filter  = " AND tp.product_name =  ".$this->db->escape($product_name)."
						             AND tp.product_id != $url_product_id";
					}
					$result = $this->Model_Admin->CheckAlreadyExistProduct($filter);
					$count_row = $result[0]['row_count'];
					if($count_row > 0)
					{
						$data['error'] = "Product name already exist.";
					}
					else
					{
						if($_FILES["p_image"]["name"] !="")
						{
							$is_upload = 1;
							$target_dir = "assets\img\products\\";
							$current_time = date("Y_m_d_h_i_s");
							$target_file = $target_dir . basename($curent_date_time.'_'.$_FILES["p_image"]["name"]);
							$uploadOk = 1;
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

							$check = getimagesize($_FILES["p_image"]["tmp_name"]);
							if($check !== false)
							{
							   /* $data['error'] = "File is an image - " . $check["mime"] . ".";
							    $uploadOk = 1;*/
							} else
							{
								$data['error'] =  "File is not an image.";
							    $is_upload = 0;
							}

							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" )
							{
								$data['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
								$$is_upload = 0;
							}

							if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) 
							{
							   /* echo "The file ". htmlspecialchars( basename( $_FILES["p_image"]["name"])). " has been uploaded.";*/
							}
						}
						$data['success']  = "Product added successfully.";

						if($url_product_id == "")
						{
							$insert_id = $this->Model_Admin->AddProduct($product_name,$product_status, $category_id, $product_desc, $target_file, $product_price);
							header("location:".$this->config->base_url().'Admin/AddProduct/'.$insert_id.'/success');
						}
						else
						{
							$_POST['hdn_prd_img_path'] = $target_file;
							$this->Model_Admin->UpdateProduct($product_name,$product_status, $category_id, $product_desc, $target_file, $url_product_id, $product_price );
							$data['success']  = "Product updated successfully.";
						}
						//	$this->Model_Admin->AddCategory($category_name, $category_status);
					//	header("location:".$this->config->base_url().'Admin/Home');
					}
				}
				else
				{  
					//$this->Model_Admin->UpdateCategory($category_name, $category_status, $category_id);
					//$data['success'] = "Category updated successfully!";//header("location:".$this->config->base_url().'Admin/AddCategory/$category_id');
				}

			}
		}
		else
		{
			if($url_product_id !="")
			$data['products'] = $this->Model_Admin->GetProductByID($url_product_id);
		}
		
		$data['category'] 	= $this->Model_Admin->GetCategories();
		$this->load->view('Admin/AddProduct', $data);
	}
	public function Logout()
	{
		session_destroy();
		$this->session->sess_destroy();
		header("location:". $this->config->base_url().'Admin/Login');
	}

	public function ViewProduct()
	{
		$data[] = "";
		$count = $this->Model_Admin->GetAllProducts($is_get_count = 1);
		$count_row = $count[0]['row_count'];
		$config = array();
        $config["base_url"] = $this->config->base_url() . "Admin/ViewProduct";
        $config["total_rows"] = $count_row;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config["per_page"] = 50;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
        $data["links"] = $this->pagination->create_links();

        $data['products'] =$this->Model_Admin->GetAllProducts($is_get_count = 0, $offset =$config["per_page"], $limit = $page);
		//print_r($data['products']); die();
		$this->load->view('Admin/ViewProduct', $data);
	}

	public function customerlist()
	{
		$user_level = $this->session->userdata('user_level');
		$data['customer'] = "";
        if($user_level == "admin")
        {
        	$data['customer'] = $this->Model_Admin->GetAllCustomer();
        }
        else
        {
        	header("Location:".$this->config->base_url());
        }

        $this->load->view('Admin/customerlist', $data);
	}

	public function InactiveCustomer()
	{
		$status      = $this->input->post('status');
		$customer_id = $this->input->post('customer_id');
		$user_level = $this->session->userdata('user_level');
		$data['customer'] = "";
        if($user_level == "admin")
        {
        	$updated = $this->Model_Admin->UpdateCustomer($status, $customer_id );

        	if($updated)
        	{
        		if($status == '1')
        		$this->session->set_userdata("sucess", "<strong>Success!</strong> Customer activate successfully");
        		else
        		$this->session->set_userdata("sucess", "<strong>Success!</strong> Customer deactivate successfully!");
        			
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
