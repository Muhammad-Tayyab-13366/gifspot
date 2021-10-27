
    <?php
    $this->load->view("include/header");
    ?>

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div id="main-slider" class="owl-carousel owl-theme">
                <div class="item"><img src="<?=$this->config->base_url()?>assets/img/Slider/birthday-gift.jpg" alt="" class="img-fluid"></div>
                <div class="item"><img src="<?=$this->config->base_url()?>assets/img/Slider/exclusive-products.jpg" alt="" class="img-fluid"></div>
                <div class="item"><img src="<?=$this->config->base_url()?>assets/img/Slider/flowers1.jpg" alt="" class="img-fluid"></div>
               <!--  <div class="item"><img src="<?=$this->config->base_url()?>assets/img/Slider/download.jpg" alt="" class="img-fluid"></div> -->
              </div>
              <!-- /#main-slider-->
            </div>
          </div>
        </div>
       
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <?php
        $url_category_id = $this->uri->segment(3); 
        if($url_category_id =="")
        { ?>
          <input type="hidden" id="hdn_page_title" value="Home">
          <div id="hot">
            <div class="box py-4">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="mb-0">Hot this week</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
            
              <div class="product-slider owl-carousel owl-theme">
                <?php 
                /*  echo "<pre>";print_r($current_week_product);
                  echo "</pre>";*/

                foreach ($current_week_product as $key => $week_product)
                {
                  $product_name = $week_product['product_name'];
                  $product_image_path = $week_product['product_image_path'];
                  $product_price = $week_product['product_price'];
                  $product_id = $week_product['product_id'];
                  ?>
                  <div class="item">
                  <div class="product">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="#" class="invisible"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3 style="height: 35px;font-size: 15px;"><a href="#"><?=$product_name?></a></h3>
                      <p class="price"> 
                        <del></del><?=$product_price." PKR"?>
                      </p>
                      <p class="price"> 
                       
                        <button class="btn btn-primary btn-sm" >
                          <a style="color: white;" href="<?=$this->config->base_url()?>Cart/AddCart/<?=$product_id?>">Add to Cart
                            <svg style="    margin: -3px 0 0 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                          </a>
                        </button>
                      </p>
                    </div>
                    
                    <div class="ribbon new">
                      <div class="theribbon">NEW</div>
                      <div class="ribbon-background"></div>
                    </div>
                    
                  </div>
                 
                </div>
                <?php
                } ?>
                 
                </div>
                <!-- /.product-slider-->
              </div>
              <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
          </div>
        <?php 
        } 
        else
        {
          ?>

          <div id="hot">
            <div class="box py-4">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="mb-0">
                      <?php
                      if(count($category_product)>0)   
                      {
                        echo $category_product[0]['category_name'];
                        echo '<input type="hidden" id="hdn_page_title" value="'.$category_product[0]['category_name'].'">';
                      }
                      else { echo "No product Found."; }
                      ?>
                        
                       </h2>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
            
             <!--  <div class="product-slider owl-carousel owl-theme"> -->
                <?php 
                /*  echo "<pre>";print_r($current_week_product);
                  echo "</pre>";*/
                $counter = 1;
                foreach ($category_product as $key => $week_product)
                {
                  $product_name = $week_product['product_name'];
                  $product_image_path = $week_product['product_image_path'];
                  $product_price = $week_product['product_price'];
                  $product_id = $week_product['product_id'];
                  if($counter == 1)
                  {
                    echo ' <div class="product-slider owl-carousel owl-theme">';
                  }
                  if($counter % 5 == 0 )
                  {
                    echo ' </div><div class="product-slider owl-carousel owl-theme">';
                  }
                  ?>
                  <div class="item">
                  <div class="product">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="#" class="invisible"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3 style="height: 35px;font-size: 15px;"><a href="#"><?=$product_name?></a></h3>
                      <p class="price"> 
                        <del></del><?=$product_price." PKR"?>
                      </p>
                      <p class="price"> 
                       
                        <button class="btn btn-primary btn-sm" >
                          <a style="color: white;" href="<?=$this->config->base_url()?>Cart/AddCart/<?=$product_id?>">Add to Cart
                            <svg style="    margin: -3px 0 0 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                          </a>
                        </button>
                      </p>
                    </div>
                    
                    <div class="ribbon new">
                      <div class="theribbon">NEW</div>
                      <div class="ribbon-background"></div>
                    </div>
                    
                  </div>
                 
                </div>
                <?php
                 $counter++;
                }
                if(($counter--) % 5 != 0) 
                echo "</div>";
                ?>
                 
                
                <!-- /.product-slider-->
              </div>
              <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
          </div>
        <?php 
        } ?>
        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
       <!--  <div class="container">
          <div class="col-md-12">
            <div class="box slideshow">
              <h3>Get Inspired</h3>
              <p class="lead">Get the inspiration from our world class designers</p>
              <div id="get-inspired" class="owl-carousel owl-theme">
                <div class="item"><a href="#"><img src="<?=$this->config->base_url()?>assets/img/getinspired1.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="<?=$this->config->base_url()?>assets/img/getinspired2.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="<?=$this->config->base_url()?>assets/img/getinspired3.jpg" alt="Get inspired" class="img-fluid"></a></div>
              </div>
            </div>
          </div>
        </div> -->
        <!-- *** GET INSPIRED END ***-->
        <!--
        *** BLOG HOMEPAGE ***
        _________________________________________________________
        -->
         <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <?php 
        if($url_category_id =="")
        { ?>
          <div id="advantages">
            <div class="container">
              <div class="row mb-4">
                <div class="col-md-4">
                  <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                    <div class="icon"><i class="fa fa-heart"></i></div>
                    <h3><a href="#">We love our customers</a></h3>
                    <p class="mb-0">We are known to provide best possible service ever</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                    <div class="icon"><i class="fa fa-tags"></i></div>
                    <h3><a href="#">Best prices</a></h3>
                    <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                    <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                    <h3><a href="#">100% satisfaction guaranteed</a></h3>
                    <p class="mb-0">Free returns on everything for 3 months.</p>
                  </div>
                </div>
              </div>
              <!-- /.row-->
            </div>
            <!-- /.container-->
          </div>
        <?php 
        }
        ?>

        <?php 
        if($url_category_id =="")
        { ?>
          <div id="all">
            <div class="" id="content">
              <div id="hot">
                <div class="box py-4">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="mb-0">Birthday gifts</h2>
                  </div>
                </div>
              </div>
                </div>
                <div class="container">
            
              <div class="product-slider owl-carousel owl-theme">
                <?php 
                /*  echo "<pre>";print_r($current_week_product);
                  echo "</pre>";*/

                foreach ($birthday_gift as $key => $week_product)
                {
                  $product_name = $week_product['product_name'];
                  $product_image_path = $week_product['product_image_path'];
                  $product_price = $week_product['product_price'];
                  $product_id = $week_product['product_id'];
                  ?>
                  <div class="item">
                  <div class="product">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="#" class="invisible"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3 style="height: 35px;font-size: 15px;"><a href="#"><?=$product_name?></a></h3>
                      <p class="price"> 
                        <del></del><?=$product_price." PKR"?>
                      </p>
                      <p class="price"> 
                       
                        <button class="btn btn-primary btn-sm" >
                          <a style="color: white;" href="<?=$this->config->base_url()?>Cart/AddCart/<?=$product_id?>">Add to Cart
                            <svg style="    margin: -3px 0 0 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                          </a>
                        </button>
                      </p>
                    </div>
                    
                    <div class="ribbon new">
                      <div class="theribbon">NEW</div>
                      <div class="ribbon-background"></div>
                    </div>
                    
                  </div>
                 
                </div>
                <?php
                } ?>
                 
                </div>
                <!-- /.product-slider-->
              </div>
              <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
          </div>
          </div>
          </div>
        <?php 
        }
      
        
        if($url_category_id =="")
        { ?>
          <div id="all">
            <div class="" id="content">
              <div id="hot">
                <div class="box py-4">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="mb-0">Wedding gifts</h2>
                  </div>
                </div>
              </div>
                </div>
                <div class="container">
            
              <div class="product-slider owl-carousel owl-theme">
                <?php 
                /*  echo "<pre>";print_r($current_week_product);
                  echo "</pre>";*/

                foreach ($Wedding_gifts as $key => $week_product)
                {
                  $product_name = $week_product['product_name'];
                  $product_image_path = $week_product['product_image_path'];
                  $product_price = $week_product['product_price'];
                  $product_id = $week_product['product_id'];
                  ?>
                  <div class="item">
                  <div class="product">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="#"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="#" class="invisible"><img src="<?=$this->config->base_url()?><?=$product_image_path?>" alt="" class="img-fluid"></a>
                    <div class="text">
                      <h3 style="height: 35px;font-size: 15px;"><a href="#"><?=$product_name?></a></h3>
                      <p class="price"> 
                        <del></del><?=$product_price." PKR"?>
                      </p>
                      <p class="price"> 
                       
                        <button class="btn btn-primary btn-sm" >
                          <a  style="color: white;" href="<?=$this->config->base_url()?>Cart/AddCart/<?=$product_id?>">Add to Cart
                            <svg style="    margin: -3px 0 0 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                          </a>
                        </button>
                      </p>
                    </div>
                    
                    <div class="ribbon new">
                      <div class="theribbon">NEW</div>
                      <div class="ribbon-background"></div>
                    </div>
                    
                  </div>
                 
                </div>
                <?php
                } ?>
                 
                </div>
                <!-- /.product-slider-->
              </div>
              <!-- /.container-->
            </div>
            <!-- /#hot-->
            <!-- *** HOT END ***-->
          </div>
          </div>
          </div>
        <?php 
        } ?>
        <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
      </div>
    </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <?php
    $this->load->view("include/footer");
    ?>