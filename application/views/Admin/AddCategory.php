<?php
$this->load->view('include/Admin_Header');
$category_name     = $this->input->post('category_name');
$category_status   = $this->input->post('category_status'); 

if(!isset($_POST['login']) && $this->uri->segment(3)!="")
{
  $category_name    = $GetCategoryByID[0]['category_name'];
  $category_status  = $GetCategoryByID[0]['category_is_active'];
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
                        echo "Add New Category";
                        echo '<input type="hidden" id="hdn_page_title" value="Add Category">';
                      }
                      else
                      {
                        echo "Edit Category";
                        echo '<input type="hidden" id="hdn_page_title" value="Edit Category">';
                      }
                      ?>
                      </h1>
                    
                    <hr>
                    <form action="" method="post">
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
                        <input id="email" name="category_name" type="text" class="form-control" value="<?=$category_name?>">
                      </div>
                      <div class="form-group">
                        <label for="password">Status</label>
                        <select class="form-control" name="category_status">
                            <option value="-1">Select Status</option>
                            <option value="1" <?php if($category_status == '1'){ echo "selected"; }?> >Active</option>
                            <option value="0"  <?php if($category_status == '0'){ echo "selected"; }?>>Inactive</option>
                        </select>
                      </div>
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
        

<?php
$this->load->view('include/Admin_Footer');
?>
<script type="text/javascript">
  function RedirectTOViewCategory()
  {
    window.location ='<?php echo $this->config->base_url(); ?>'+'Admin/ViewCategory';
  }
</script>