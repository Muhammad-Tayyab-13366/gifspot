
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Order extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
    }
	
	public function GetOrderList($filter='')
	{
		$query = "
					SELECT o.order_id,
					o.payment_type_id,
					(
					    SELECT pm.payment_method
					    FROM tbl_payment_method pm
					    where pm.payment_method_id = o.payment_type_id
					)AS payment_method,
					o.customer_id,
					o.customer_name,
					o.customer_card_number,
					o.customer_phone,
					o.customer_addess,
					o.order_is_completed,
					o.order_is_deleted,
					o.order_completed_date,
					o.order_created_date,
					(
                        SELECT SUM(oi.sub_total)
                        FROM tbl_order_items oi
                        WHERE oi.order_id = o.order_id
                    )AS order_amount,
                    (
                        SELECT COUNT(*) 
                        FROM tbl_order_items oi
                        WHERE oi.order_id = o.order_id
                        AND oi.order_item_is_deleted = 0
                    ) AS total_order_items
					FROM tbl_orders o
					where o.order_is_deleted = 0
					$filter
				";
	    $result=$this->db->query($query)->result_array();
	    return $result ;
	}

	public function GetOrderDeatil($order_id)
	{
		$query = "
		            SELECT oi.order_item_id,
					oi.product_id,
					(
					    SELECT p.product_name
					    FROM tbl_product p
					    where p.product_id = oi.product_id
					)AS product_name,
					(
					    SELECT p.product_image_path
					    FROM tbl_product p
					    where p.product_id = oi.product_id
					)AS img_path,
					oi.product_quantity,
					oi.sub_total
					FROM tbl_order_items oi
					WHERE oi.order_item_is_deleted = 0 
                    AND oi.order_id  = $order_id;    
		         ";
		$result=$this->db->query($query)->result_array();
	    return $result ;

	}

	public function DeleteOrder($order_id)
	{
		$result = false;
		if($order_id !="")
		{
			echo $query = "
			UPDATE tbl_orders 
			set order_is_deleted = 1
			WHERE order_id = $order_id";

			$result= $this->db->query($query);
		}
		
		return $result;
	}

	public function CompleteOrder($order_id)
	{
		$result = false;
		if($order_id !="")
		{
			$query = "
			UPDATE tbl_orders 
			set order_is_completed = 1,
			order_completed_date = now()
			WHERE order_id = $order_id";

			$result= $this->db->query($query);
		}
		
		return $result;
	}


}
