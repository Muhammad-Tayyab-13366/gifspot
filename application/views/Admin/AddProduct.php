<?php
$this->load->view('include/Admin_Header');
$product_name     = $this->input->post('product_name');
$product_status   = $this->input->post('product_status'); 
$categoryid       = $this->input->post('category_id'); 
$product_desc     = $this->input->post('product_description');
$product_price    = $this->input->post('product_price');
$is_show_img      = 0; 
$product_image_path = $this->input->post("hdn_prd_img_path");
if($product_image_path !="")
{
  
  $is_show_img= 1;
}
if(!isset($_POST['login']) && $this->uri->segment(3)!="")
{
  $is_show_img        = 1; 
  $product_name       = $products[0]['product_name'];
  $product_status     = $products[0]['product_is_active'];
  $categoryid         = $products[0]['category_id'];
  $product_desc       = $products[0]['product_description'];
  $product_image_path = $products[0]['product_image_path'];
  $product_name       = $products[0]['product_name'];
  $product_price      = $products[0]['product_price'];;
 /* $category_name    = $GetCategoryByID[0]['category_name'];
  $category_status  = $GetCategoryByID[0]['category_is_active'];*/
}
$is_add = 1;
if( $this->uri->segment(3) !="")
{
  $is_add = 0;
}

?>
  </head>
   <body>
    <?php 
    if($success !="" && 1==2)
    { ?>
    <div class="container">
        <!-- breadcrumb-->
        <nav aria-label="breadcrumb">
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> <?=$success?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              
           
        </nav>
    </div>
    <?php
    } ?>

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
                    <h1>
                      <?php 
                      if($is_add == 1)
                      {
                        echo "Add New Product";
                        echo '<input type="hidden" id="hdn_page_title" value="Add Product">';
                      
                      }
                      else
                      {
                        echo "Edit Product";
                        echo '<input type="hidden" id="hdn_page_title" value="Edit Product">';
                      
                      }
                      ?>
                      </h1>
                    
                    <hr>
                    <form action="" method="post" enctype="multipart/form-data">
                      <?php
                      if($error !="")
                      { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Alert!</strong> <?=$error?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      <?php
                      }
                      if($success !="")
                      { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success!</strong> <?=$success?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      <?php
                      }  ?>
                      <div class="form-group">
                        <label for="email">Name</label>
                        <input id="email" name="product_name" type="text" class="form-control" value="<?=$product_name?>">
                      </div>

 
                      <div class="form-group">
                        <label for="email">Description</label>
                        <textarea class="form-control" name="product_description"><?=$product_desc?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="email">Price</label>
                        <input class="form-control" type="number" name="product_price" value="<?=$product_price?>" min="1"> 
                      </div>
                      <div class="form-group">
                        <label for="password">Category/Brand</label>
                        <select class="form-control category_id " name="category_id" >
                            <option value="0">Select Category</option>
                            <?php
                            foreach ($category as $key => $cat)
                            {
                              $category_name = $cat['category_name'];
                              $category_id   = $cat['category_id'];
                            ?>
                             <option value="<?=$category_id?>" <?php if($categoryid == $category_id ){ echo "selected"; } ?> ><?=$category_name?></option>
                           <?php
                             }
                             ?>
                        </select>
                      </div>
                       <div class="form-group">
                        <label for="password">Status</label>
                        <select class="form-control" name="product_status">
                            <option value="-1">Select Status</option>
                            <option value="1" <?php if($product_status == '1'){ echo "selected"; }?> >Active</option>
                            <option value="0"  <?php if($product_status == '0'){ echo "selected"; }?>>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="email">Product Image</label>
                        <input type="file" name="p_image" accept="image/*">
                      </div>
                      <input type="hidden" name="hdn_prd_img_path" value="<?=$product_image_path?>">
                      <?php
                      if($is_show_img == 1)
                      { ?>
                        <div class="form-group">
                          <img onclick="OpenImgInNewTab(this.id)" id="<?=$this->config->base_url().$product_image_path?>" src="<?=$this->config->base_url().$product_image_path?>"  style="width: 150px; border-radius: 7px;">
                        </div>

                      <?php
                      } ?>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="login">
                          <?php 
                          if($is_add == 1)
                          {
                            echo "Add";
                          }
                          else
                          {
                            echo "Update";
                          }
                          ?></button>
                        <button type="button" class="btn btn-primary" name="login" onclick="RedirectTOViewCategory()"><!-- <i class="fa fa-sign-in"> --></i> Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
        
<script type="text/javascript">
  // In your Javascript (external .js resource or <script> tag)

</script>
<?php
$this->load->view('include/Admin_Footer');
?>
<script type="text/javascript">
  function OpenImgInNewTab(id)
  {
    window.open(id);
  }

  $(document).ready(function() {
  
  $('.category_id').select2();
});

  
</script>