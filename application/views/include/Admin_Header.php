<?php
$this->load->helper("url");
if($this->session->userdata('user_id') == "")
{
   header("location:". $this->config->base_url()."Admin/Login");
}

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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
    <link rel="shortcut icon" href="favicon.png">
    <link href="<?=$this->config->base_url()?>assets/css/select2.min.css" rel="stylesheet" />

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
               <br>
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
                <form action="customer-orders.html" method="post">
                  <div class="form-group">
                    <input id="email-modal" type="text" placeholder="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <input id="password-modal" type="password" placeholder="password" class="form-control">
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        
        
      </div>
      <?php
      $this->load->helper('url');
       $function = $this->uri->segment(2)  ;
    
      ?>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="<?=$this->config->base_url()?>Admin/Home" class="navbar-brand home"><img src="<?=$this->config->base_url()?>assets/img/Logo/main_logo.png"style="width: 80px; border-radius: 7px;" alt="Obaju logo" class="d-none d-md-inline-block">
          <img src="<?=$this->config->base_url()?>assets/img/Logo/main_logo.png" style="width: 150px; border-radius: 7px;"  alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
             
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($function =='AddCategory' || $function =='ViewCategory'){ echo ' active'; }?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item <?php if($function =='AddCategory' ){ echo ' active'; }?>"  href="<?=$this->config->base_url()?>Admin/AddCategory">Add Category</a>
                      <a class="dropdown-item <?php if($function =='ViewCategory' ){ echo ' active'; }?>" href="<?=$this->config->base_url()?>Admin/ViewCategory">View Category</a>
                      
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($function =='AddProduct' || $function =='ViewProduct'){ echo ' active'; }?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                       Product
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item <?php if($function =='AddProduct'){ echo ' active'; }?>"  href="<?=$this->config->base_url()?>Admin/AddProduct">Add Product</a>
                      <a class="dropdown-item <?php if($function =='ViewProduct'){ echo ' active'; }?>"  href="<?=$this->config->base_url()?>Admin/ViewProduct">View Product</a>
                      
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="<?=$this->config->base_url()?>Order/orderlist">Orders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if($function =='customerlist'){ echo ' active'; }?>" href="<?=$this->config->base_url()?>Admin/customerlist">Customer</a>
                  </li>
                 <!--  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li> -->
                </ul>
              </div>
            </nav>
            
          

          </div>
          <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
               <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                 
                  <li class="nav-item dropdown">
                    <a class="" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?=$this->session->userdata('user_name')?>
                       <img src="<?=$this->config->base_url()?>assets/img/avater.png" style="width: 50px; border-radius: 30px;"">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     <a class="dropdown-item" href="<?=$this->config->base_url()?>Admin/Logout"><i class="fa fa-sign-out"></i>Logout</a>
                     
                      
                    </div>
                  </li>
              
                </ul>
              </div>
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
    </header>