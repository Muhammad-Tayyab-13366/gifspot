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
    <input type="hidden" id="hdn_page_title" value="Category List">
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
                    <h1>View Category</h1>
                    
                    <hr>
                    <form action="" method="post">
                     <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Status</th>
                          <th scope="col">Created By</th>
                          <th scope="col">Action</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $counter = 1;
                        foreach ($category as $key => $cat)
                        {
                          $category_is_active = $cat['category_is_active'];
                          if($category_is_active == 1)
                            $category_is_active_txt = " Active";
                          else
                            $category_is_active_txt = "Inactive";
                          $creator_name = $cat['creator_name'];
                          $category_id  = $cat['category_id'];
                          ?>
                          <tr>
                             <th scope="row"><?=$counter?></th>
                            <td><?=$cat['category_name']?></td>
                            <td><?=$category_is_active_txt?></td>
                            <td><?=$creator_name.' on '.date("D, d M Y", strtotime($cat['category_created_date'])).' at '.date("h:i A", strtotime($cat['category_created_date']))?></td>
                            <td><a target="_blank" href="<?=$this->config->base_url()?>Admin/AddCategory/<?=$category_id?>">Edit</a> | 
                              <a href="javascript:void(0)" onclick="DeleteCategoryByID(category_id = '<?=$category_id?>')">Delete</a></td>
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
  function DeleteCategoryByID(category_id)
  { 
     message = "Are you sure you want to delete category?";
     if(confirm(message))
     {
        $.ajax({
           type:"POST",
           url : BaseURL+'Admin/DeleteCategoryByID',
           data:{
                  category_id: category_id
           } ,
           success: function(result)
           {
               location.reload();
           }
        });
     }
  }
</script>