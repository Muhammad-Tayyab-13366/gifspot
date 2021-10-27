<?php
$this->load->view('include/Admin_Header');

?>
 <style type="text/css">
   ul.pagination li{
        padding: 12px;
    border: 1px solid #dee2e6;
        font-weight: bold;
   }
   .pagination{
    float: right;
   }
 </style>
  </head>
   <body>
    <input type="hidden" id="hdn_page_title" value="Customer Lost">
    <div id="all">
          <div id="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <!-- breadcrumb-->
                  <nav aria-label="breadcrumb">
                  <!--  <img style="width: 100%;" src="<?=$this->config->base_url()?>assets/img/Logo/brand_banner.png">
                  </nav> -->
                </div>
                
                <div class="col-lg-12">
                  <div class="box">
                    <h1>Customer List</h1>
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
                    <hr>
                    <form action="" method="post">
                     <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Status</th>
                          <th scope="col">Created</th>
                          <th scope="col">Action</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $counter = 1;
                        foreach ($customer as $key => $c)
                        {
                          /*SELECT `customer_id`, `customer_name`,
                           `customer_email`, `customer_pass`, `customer_phone`,
                           `customer_address`, `customer_is_active`, `customer_created_date*/
                          $customer_is_active = $c['customer_is_active'];
                          $customer_email     = $c['customer_email'];
                          $link_txt = "";
                          if($customer_is_active == 1)
                          {
                            $link_txt = "Deactivate";
                            $status = " Active";
                          }
                          else
                          {
                            $status = "Inactive";
                            $link_txt = "Activate";
                          }
                          $customer_name = $c['customer_name'];
                          $customer_id  = $c['customer_id'];
                          ?>
                          <tr>
                             <th scope="row"><?=$counter?></th>
                            <td><?=$customer_name?></td>
                            <td><?=$customer_email?></td>
                            <td><?=$status?></td>
                            <td><?=date("D, d M Y", strtotime($c['customer_created_date'])).' at '.date("h:i A", strtotime($c['customer_created_date']))?></td>
                            <td> 
                              <a href="javascript:void(0)" onclick="InactiveCustomer(customer_id = '<?=$customer_id?>', status = '<?=$customer_is_active?>')"><?=$link_txt?></a></td>
                          </tr>
                          <?php
                          $counter++;
                        }
                        ?>
                        
                      </tbody>
                    </table>
                   <div class="row">
                  <div class="col-md-12 text-center">
                  
                  </div>
                </div>
                    </form>
                  </div>

                </div>
                
              </div>
            </div>
          </div>
    </div>
        

<?php
$this->load->view('include/Admin_Footer');
?>
<script type="text/javascript">
  BaseURL = '<?php echo $this->config->base_url(); ?>';

  function InactiveCustomer(customer_id, status)
  { 
    if(status == 1)
    message = "Are you sure you want Inactive customer?";
    else
    message = "Are you sure you want activate customer?"; 

    if(status == 1)
      status = 0;
    else
      status = 1;
     if(confirm(message))
     {
        $.ajax({
           type:"POST",
           url : BaseURL+'Admin/InactiveCustomer',
           data:{
                  customer_id: customer_id,
                  status : status
           } ,
           success: function(result)
           {
               location.reload();
           }
        });
     }
  }
</script>