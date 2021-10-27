<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper("url");
if($this->session->userdata('user_id') != "")
{
   header("location:". $this->config->base_url()."Admin/Home");
}
$email      = $this->input->post('email');
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
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
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="all">
          <div id="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <!-- breadcrumb-->
                  <nav aria-label="breadcrumb">
                   <img style="width: 100%;" src="<?=$this->config->base_url()?>assets/img/Logo/brand_banner.png">
                  </nav>
                </div>
                
                <div class="col-lg-12">
                  <div class="box">
                    <h1>Admin Login</h1>
                    
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
                      } ?>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text" class="form-control" value="<?=$email?>">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="login"><i class="fa fa-sign-in"></i> Log in</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    
    <!-- *** COPYRIGHT END ***-->
    <!-- JavaScript files-->
    <script src="<?=$this->config->base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$this->config->base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$this->config->base_url()?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?=$this->config->base_url()?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?=$this->config->base_url()?>assets/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="<?=$this->config->base_url()?>assets/js/front.js"></script>
  </body>
</html>