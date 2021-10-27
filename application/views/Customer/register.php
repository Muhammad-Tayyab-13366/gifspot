
    <?php
    $this->load->view("include/header");
    ?>
    <input type="hidden" id="hdn_page_title" value="Register New Account">
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign Up</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-12">
              <div class="box">
                <h1>New account</h1>
                <p class="lead">Not our registered customer yet?</p>
                <!-- <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p> -->
                <hr>
                <form action="" method="post">
                  <?php
                  $name  = $this->input->post('name');
                  $email  = $this->input->post('email'); 
                  if($error !="")
                  { ?>
                    <div class="alert alert-danger" role="alert">
                      <?=$error?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php 
                  } 
                  
                  if($success !="")
                  { 
                     $name  = "";
                     $email = "";
                    ?>
                    <div class="alert alert-success" role="alert">
                      <?=$success?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                  <?php 
                  } 
                  ?>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="<?=$name?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" name="email" value="<?=$email?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="btn_register" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                  </div>
                </form>
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
      
      $(document).ready(function(){
          success = "<?=$success?>";
          if(success !="")
          {
            setTimeout(function(){
                openLognBox();
            }, 2000);
          }
      });
      function openLognBox()
      {
        $("#login_popup").trigger('click');
      }
    </script>