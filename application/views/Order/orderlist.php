
    <?php
    $user_level = $this->session->userdata('user_level');
    if($user_level == "admin")
    {
      $this->load->view('include/Admin_Header');
    }
    else
    {
      $this->load->view("include/header");
    }
    ?>
    <input type="hidden" id="hdn_page_title" value="Order List">
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign Up</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-12">
              <div class="box">
                <h1>Order List</h1>
                <?php 
                 if( $this->session->userdata("sucess") !="")
                 {
                   
                  ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <?=$this->session->userdata("sucess")?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    <?php
                      $this->session->set_userdata("sucess", ""); 
                    } ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Payment Type</th>
                      <th scope="col">Order Items</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Order Satus</th>
                      <th scope="col">Order Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $user_level = $this->session->userdata('user_level');
                      foreach ($order_list as $key => $order)
                      {
                        $order_id             = $order['order_id'];
                        $payment_method       = $order['payment_method'];
                        $customer_id          = $order['customer_id'];
                        $customer_name        = $order['customer_name'];
                        $customer_card_number = $order['customer_card_number'];
                        $customer_phone       = $order['customer_phone'];
                        $customer_addess      = $order['customer_addess'];
                        $order_is_completed   = $order['order_is_completed'];
                        $order_created_date   = $order['order_created_date'];
                        $order_amount         = $order['order_amount'];
                        $total_order_items    = $order['total_order_items'];
                        $orser_status_txt = "Pending";
                        if($order_is_completed == 1)
                          $orser_status_txt = "Completed";

                        ?>
                        <tr>
                          <th scope="row"><?=$order_id?></th>
                          <td><?=$customer_name?></td>
                          <td><?=$payment_method?></td>
                          <td><?=$total_order_items?></td>
                          <td><?=$order_amount?> PKR</td>
                          <td><?=$customer_phone?></td>
                          <td><?=$orser_status_txt?></td>
                          <td><?=date('D d M, Y h:i A', strtotime($order_created_date))?></td>
                          <td <?php if($user_level == "admin"){ echo "style='font-size:12px; '";}?>><a target="_blank" href="<?=$this->config->base_url()?>order/orderdetail/<?=$order_id?>">View</a>
                           <?php 
                           if($user_level == "admin")
                           { ?>
                           | <a id="<?$this->base_url()?>order/orderdetail/<?=$order_id?> "href="javascript:void(0);" onclick="DeleteOrder(order_id = '<?=$order_id?>')"> Delete</a>
                           | <a id="<?$this->base_url()?>order/orderdetail/<?=$order_id?> "href="javascript:void(0);" onclick="CompleteOrder(order_id = '<?=$order_id?>')"> Complete Order</a>
                           <?php
                           } 
                           ?>
                          </td>
                        </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <?php
    $this->load->view("include/footer");
    ?>

    <script type="text/javascript">
      function DeleteOrder()
      {

      }

      function DeleteOrder(order_id)
      {
         message = "Are you sure you want to delete this order?";
         if(confirm(message))
         {
            $.ajax({
                type:"POST",
                url:"<?=$this->config->base_url()?>"+"Order/DeleteOrder",
                data:{ 
                        order_id : order_id
                },
                success: function(data){

                  if(data !="")
                    data.trim();
                  
                  if(data !="")
                  {
                    if(data =="error")
                    {
                      alert('Something went wrong. Please try agin.');
                    }
                    else{
                       location.reload();
                    }
                  }
                }

            });
        }
      }

      function CompleteOrder()
      {
        message = "Are you sure you want to compplete this order?";
        if(confirm(message))
        {
            $.ajax({
                type:"POST",
                url:"<?=$this->config->base_url()?>"+"Order/CompleteOrder",
                data:{ 
                        order_id : order_id
                },
                success: function(data){

                  if(data !="")
                    data.trim();
                  
                  if(data !="")
                  {
                    if(data =="error")
                    {
                      alert('Something went wrong. Please try agin.');
                    }
                    else{
                        location.reload();
                    }
                  }
                }

            });
        }
      }
    </script>
   