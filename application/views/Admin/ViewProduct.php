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
   .zoom {
    transition: transform .2s;
 
}

.zoom:hover {
  -ms-transform: scale(3.5); /* IE 9 */
  -webkit-transform: scale(3.5); /* Safari 3-8 */
  transform: scale(3.5); 
}
</style>
  </head>
   <body>
    <input type="hidden" id="hdn_page_title" value="Product List">
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
                  <div class="box" style="    overflow-x: auto;">
                    <h1>View Products</h1>
                    
                    <hr>
                    <form action="" method="post">
                     <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Category</th>
                           <th scope="col" width="25%">Description</th>
                           <th scop="col" >Price</th>
                          <th scope="col">Status</th>
                          <th scope="col">Created By</th>
                          <th scope="col">Image</th> 
                          <th scope="col">Action</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $counter = 1;
                        foreach ($products as $key => $pro)
                        {
                          $category_is_active = $pro['product_is_active'];
                          if($category_is_active == 1)
                            $category_is_active_txt = " Active";
                          else
                            $category_is_active_txt = "Inactive";
                          $creator_name = $pro['creator_name'];
                          $product_id  = $pro['product_id'];
                          ?>
                          <tr>
                             <th scope="row"><?=$counter?></th>
                            <td><?=$pro['product_name']?></td>
                            <td><?=$pro['category_name']?></td>
                            <td><?=$pro['product_description']?></td>
                            <td><?=$pro['product_price']." PKR"?></td>
                            <td><?=$category_is_active_txt?></td>
                            <td><?=$creator_name.' on '.date("D, d M Y", strtotime($pro['product_created_date'])).' at '.date("h:i A", strtotime($pro['product_created_date']))?></td>
                            <td><img class="zoom" onclick="openImageInNewTab(this.id)" style="width:50px; cursor: pointer;" id="<?=$this->config->base_url()?><?=$pro['product_image_path']?>" src="<?=$this->config->base_url()?><?=$pro['product_image_path']?>"></td>
                            <td><a target="_blank" href="<?=$this->config->base_url()?>Admin/AddProduct/<?=$product_id?>">Edit</a> | 
                              <a href="javascript:void(0)" onclick="DeleteProductByID(product_id = '<?=$product_id?>')">Delete</a></td>
                          </tr>
                          <?php
                          $counter++;
                        }
                        ?>
                        
                      </tbody>
                    </table>
                   <div class="row">
                  <div class="col-md-12 text-center">
                          <?php echo $links; ?>
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
  function DeleteProductByID(product_id)
  { 
     message = "Are you sure you want to delete product?";
     if(confirm(message))
     {
        $.ajax({
           type:"POST",
           url : BaseURL+'Admin/DeleteProductByID',
           data:{
                  product_id: product_id
           } ,
           success: function(result)
           {
               location.reload();
           }
        });
     }
  }

  function openImageInNewTab(ID)
  {

  	 window.open(ID);
  }
</script>