<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Create connection
$conn = mysqli_connect("localhost", 'root', '', 'db_gift_spot_project');

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Gift Spot</title>
    <link rel="icon" href="<?=$this->config->base_url()?>assets/img/Logo/main_logo.png" type="image/png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?=$this->config->base_url()?>assets/css/custom.css">
    <!-- Favicon-->
  <!-- s -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      <style type="text/css">
        .navbar .menu-large ul .nav-item a{
          color: black !important;
          font-weight: bold;
        }
      </style>
  </head>
  <body>
    <!-- navbar-->
    <header class="header mb-5">
      <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
      <div id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"></div>
            <div class="col-lg-6 text-center text-lg-right">
              <ul class="menu list-inline mb-0">
                <?php
                /*$user_id    = $result[0]['user_id'];
      $user_name  = $result[0]['customer_name'];
      $user_email = $result[0]['customer_email'];*/
                if($this->session->userdata('user_id') =="")
                { ?>
                  <!-- <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal" id="login_popup">Login</a></li>
                   -->
                  <li class="list-inline-item"><a a href="#" data-toggle="modal" data-target="#login-modal" id="login_popup">Login</a></li>
                  <li class="list-inline-item"><a href="<?=$this->config->base_url()?>customer/register">Register</a></li>
                  <!-- <li class="list-inline-item"><a href="#" onclick="Test()">Test</a></li> -->
                <?php
                }
                else
                { ?>

                <ul class="navbar-nav">
                 
                  <li class="nav-item dropdown">
                    <a class="" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?=$this->session->userdata('user_name')?>
                       <img src="<?=$this->config->base_url()?>assets/img/avater.png" style="width: 25px; border-radius: 30px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a style="color: black;" class="dropdown-item" href="<?=$this->config->base_url()?>Customer/Logout"><i class="fa fa-sign-out"></i>Logout</a>
                     
                      
                    </div>
                  </li>
              
                </ul>
              

                <?php
                }
                ?>
                <!--  <li class="list-inline-item"><a href="contact.html">Contact</a></li>
                <li class="list-inline-item"><a href="#">Recently viewed</a></li> -->
              </ul>
            </div>
          </div>
        </div>
        <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Customer login</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                  <div class="alert alert-danger" role="alert" id="login_error" style="display: none;">
                      <span>Emial or Password is incorrect</span>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <div class="form-group">
                    <input id="email_modal" type="text" placeholder="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <input id="password_modal" type="password" placeholder="password" class="form-control">
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary" type="" id="btn_customer_login" onclick="Login_Customer()"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
               
                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="<?=$this->config->base_url()?>customer/register"><strong>Register now</strong></a> <!-- It is easy and done in 1 minute and gives you access to special discounts and much more! --></p>
              </div>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        <!-- $('#languages li a').on('click', function(){
  //window.location = document.referrer
  alert($(this).attr('href'));
  alert(document.referrer);
  var link =   document.referrer + '' + $(this).attr('href');
  alert(link);
  return false;
}); -->
        
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="<?=$this->config->base_url()?>" class="navbar-brand home"><img style="width: 80px;" src="<?=$this->config->base_url()?>assets/img/Logo/main_logo.png" alt="Obaju logo" class="d-none d-md-inline-block"><img src="<?=$this->config->base_url()?>assets/img/logo-small.png" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="<?=$this->config->base_url()?>" class="nav-link <?php if(($this->uri->segment(1) == 'Home' || $this->uri->segment(1) == '') && $this->uri->segment(3) == ''){ echo 'active'; }?>">Home</a></li>
              <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link <?php if($this->uri->segment(3) != ''&& $this->uri->segment(1) == 'Home'){ echo 'active'; }?>">All Categories<b class="caret"></b></a>
                <ul class="dropdown-menu megamenu">
                  <li>
                    <div class="row">
                      <?php 
                        $col = "  category_id ,
                                  category_name,
                                  category_is_active,
                                  category_creator_id,
                                  category_created_date,
                                  category_modifier_id,
                                  category_modified_date,
                                  category_is_deleted 
                                ,
                                (
                                    SELECT tu.useR_name
                                    FROM tbl_users tu
                                    where tu.user_id = tc.category_creator_id 
                                )as creator_name";
                        $query = "
                                  select 
                                  $col
                                  from tbl_categories tc 
                                  where tc.category_is_deleted = 0
                                ";
                        $result = mysqli_query($conn, $query);
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($result))
                        { 
                          //print_r($row);
                          if( $counter == 1)
                          {

                             echo '<div class="col-md-6 col-lg-3">
                                  <ul class="list-unstyled mb-3">';
                          }
                          ?>
                          
                            <li class="nav-item"><a href="<?=$this->config->base_url()?>Home/index/<?=$row['category_id']?>" class="nav-link"><?=$row['category_name']?></a></li>
                          <?php 
                          if($counter % 5 == 0 )
                          {
                            
                             echo '</ul></div>
                                  <div class="col-md-6 col-lg-3">
                                  <ul class="list-unstyled mb-3">';
                          }
                          ?>
                          

                        <?php 
                        /* if($counter % 4 == 0 )
                          {
                             echo '</ul></div>';
                          }*/
                          $counter++;
                        }
                       if(($counter--) % 4 != 0)
                         echo '</ul></div>';
                      ?>
                       
                    </div>
                  </li>
                </ul>
              </li>
              <?php 
              if($this->session->userdata('user_id') !="")
              { ?>
                <li class="nav-item"><a href="<?=$this->config->base_url()?>order/orderlist" class="nav-link <?php if($this->uri->segment(2) == 'orderlist'){ echo 'active'; }?>">Orders</a></li>
              <?php
              } ?> 
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
              <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="<?=$this->config->base_url().'Cart/'?>" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span><?=count($this->cart->contents())?> items in cart</span></a></div>
              
            </div>
          </div>
        </div>
      </nav>
      <div id="search" class="collapse">
        <div class="container">
          <form role="search" class="ml-auto">
            <div class="input-group">
              <input type="text" placeholder="Search" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <script type="text/javascript">
      function Login_Customer()
      {
        $("#login_error").hide();
        email     = $("#email_modal").val();
        password  = $("#password_modal").val();

        if(email !="")
        {
          email =email.trim();
        }
        if(password !="")
        {
          password =password.trim();
        }
        if(email == "")
        {
         alert("Email is required");
         return false;
        }

        if(password == "")
        {
          alert("Password is required");
          return false;
        }

        $.ajax({
                type:"POST",
                url:"<?=$this->config->base_url()?>"+"Customer/LoginCustomer",
                data:{ 
                        password : password,
                        email : email
                },
                success: function(data){

                  if(data !="")
                    data.trim();
                  
                  if(data !="")
                  {
                    if(data =="error")
                    {
                      $("#login_error").show();
                    }
                    else{
                        location.reload();
                    }
                  }
          }

        });

       
      }
      </script>
    </header>