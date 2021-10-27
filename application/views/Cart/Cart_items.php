<?php $this->load->view("include/header"); 
  
?>
<input type="hidden" id="hdn_page_title" value="Cart Items">
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    if($success !="")
                    { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success!</strong> Order place successfully!
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    <?php 
                    } ?>
                    <h1>CART Items</h1>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="25%">Product</th>
                            <th width="15%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="20%" class="text-right">Subtotal</th>
                            <th width="12%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($this->cart->total_items() > 0)
                        { 
                            
                            foreach($cartItems as $item)
                            {    ?>
                                <tr>
                                    <td>
                                        <?php $imageURL = $this->config->base_url().$item["image"]; ?>
                                        <img src="<?php echo $imageURL; ?>" width="50"/>
                                    </td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["price"].' PKR'; ?></td>
                                    <td><input type="number" min="1" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                                    <td class="text-right"><?php echo '$'.$item["subtotal"].' PKR'; ?></td>
                                    <td class="text-right">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo $this->config->base_url().'Cart/removeItem/'.$item["rowid"]; ?>':false;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                     </td>
                                </tr>
                        <?php 
                            } 
                        }
                        else
                        { ?>
                            <tr><td colspan="6"><p>Your cart is empty.....</p></td>
                        <?php
                        } 
                        ?>
                        <?php if($this->cart->total_items() > 0)
                        { ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Cart Total</strong></td>
                                <td class="text-right"><strong><?php echo '$'.$this->cart->total().' PKR'; ?></strong></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td colspan="11" class="text-right"> 
                                    <strong><button class="btn btn-primary btn-md mr-2" onclick="continueShopping()">Continue Shopping</button></strong>
                                    <strong><button class="btn btn-primary btn-md" onclick="continueCheckout()">Checkout</button></strong>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    <?php
                    if($this->cart->total_items() > 0)
                    {  ?>
                        <div class="row" id="div_order_detail" style="display: none;">
                            <div class="col-lg-12">
                              <!-- breadcrumb-->
                              <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li aria-current="page" class="breadcrumb-item active"><h3>Order Details</h3></li>
                                </ol>
                              </nav>
                              <div class="col-lg-12 pl-0 pr-0" id="">
                                  <div class="box ">
                                    <form action="" method="post" id="frm_place_order">
                                    <h4 style="display: inline-block;">Select Payment Type:</h4>
                                    <h5 style="display: inline-block;">
                                        &nbsp;&nbsp;<input type="radio" name="pyment_type" id="rad_card" value="1" onchange="ShowPaymentMethodDetail(this.id, this.val)"> <label for="rad_card"> Debit/Credit card</label>
                                        &nbsp;&nbsp;<input type="radio" name="pyment_type" id="rad_cash" value="2" onchange="ShowPaymentMethodDetail(this.id, this.val)"> <label for="rad_cash"> Cash on Delivery</label>
                                    </h5>
                                    <div id="div_inner_order_detail" style="display: none;">
                                        <p class="lead" id="p_order_detail_heading">Please provide following Debit/Credit Detail.</p>
                                        <hr>
                                        
                                          
                                          <div class="form-group"  id="div_rad_card" style="display: none;">
                                            <label for="card_number">Card Number</label>
                                            <input id="card_number" name="card_number" type="text" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label for="name">Name</label>
                                            <input id="name" name="name" type="text" class="form-control" required="required">
                                          </div>
                                          <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input id="phone" name="phone" type="text" class="form-control" required="required">
                                          </div>
                                           <div class="form-group">
                                            <label for="address">Address</label>
                                            <input id="address" name="address" type="text" class="form-control" required="required">
                                          </div>
                                          <input type="hidden" name="is_place_order" value="1">
                                          <div class="text-center">
                                            <button type="button" class="btn btn-primary" onclick="ConfirmOrderDetail()"><!-- <i class="fa fa-sign-in"></i> -->Place Order</button>
                                          </div>
                                       
                                    </div>
                                   </form>
                                    
                                  </div>
                               </div>
                            </div>
                        </div>
                    <?php 
                    }
                    ?>      
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Update item quantity
function updateCartItem(obj, rowid){
    $.get("<?php echo $this->config->base_url().'Cart/updateItemQty'; ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });


}

function continueShopping()
{

   window.location = document.referrer;
  
}

function continueCheckout()
{
    session_user_id = "<?=$this->session->userdata('user_id')?>";
    if(session_user_id == "")
    {

        $("#login_popup").trigger('click');
    }
    else
    {
        $("#div_order_detail").show();
        $('html,body').animate({ scrollTop: 130 }, 'slow');
    }
}

function ShowPaymentMethodDetail(id,val)
{  

   // $('html,body').animate({ scrollTop: 350 }, 'slow');
    $("#div_inner_order_detail").show();
    if(id == "rad_card")
    {
        $("#p_order_detail_heading").text("Please provide following Debit/Credit Detail.");
        $("#div_rad_card").show();

    }
    else
    {
        $("#p_order_detail_heading").text("Please provide following Cash on Delivery Detail.");
        $("#div_rad_card").hide();

       
    }
}

function ConfirmOrderDetail()
{
    message = "Are you sure you provide correct detail and want to place order?";
    pyment_type = $('input[name="pyment_type"]:checked').val();
    card_number = $("#card_number").val();
    name        = $("#name").val();
    phone       = $("#phone").val();
    address     = $("#address").val();
    
    if(name !="")
        name.trim();

    if(phone !="")
        phone.trim();

    if(address !="")
        address.trim();

    if(pyment_type == 1)
    {
        if(card_number != "")
            card_number.trim();
        if(card_number =="")
        {
            alert("Card numer is required.");
            $("#card_number").focus();
            return false;
        }
        if(($.isNumeric(card_number)) == false)
        {
            alert("Card numer is invalid.");
            $("#card_number").focus();
            return false;
        }
    }


    if(name == "")
    {
        alert("Name is required.");
        $("#name").focus();
        return false;  
    }

    if(phone == "")
    {
        alert("Phone is required.");
        $("#phone").focus();
        return false;  
    } 

    if(address == "")
    {
        alert("Address is required.");
        $("#address").focus();
        return false;  
    }

    if(confirm(message))
    {
       $("#frm_place_order").submit();            
    }
    else
    {

    }
}

</script>

<?php $this->load->view("include/footer"); ?>