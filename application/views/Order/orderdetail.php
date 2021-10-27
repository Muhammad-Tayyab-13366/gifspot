
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
    <input type="hidden" id="hdn_page_title" value="Order Detail">
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
                <h1>Order Detail</h1>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Product</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Sub Total</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $grand_total = 0;
                      foreach ($order_detail as $key => $order)
                      {
                        $product_name = $order['product_name'];
                        $img_path = $order['img_path'];
                        $product_quantity = $order['product_quantity'];
                        $sub_total = $order['sub_total'];
                        
                        $grand_total = $sub_total + $grand_total;



                        ?>
                        <tr>
                          <th scope="row" width="15%"><img style="width: 100%;" src="<?=$this->config->base_url()?><?=$img_path?>"></th>
                          <td><?=$product_name?></td>
                          <td><?=$product_quantity?></td>
                          <td><?=$sub_total?></td>
                          
                        </tr>
                    <?php 
                      }
                    ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><b>Total: <?=$grand_total?> PKR</b></td>
                    </tr>
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
    </script>
   