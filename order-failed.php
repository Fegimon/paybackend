<?php require(dirname(__FILE__).'/appcore/app-register.php');
require_once(dirname(__FILE__).'/appcore/app-register.php');
if(!$_SESSION['ses_oid'])
{
	$conn->divert(SITE_URL);
}

$ord_id=$_SESSION['ses_oid'];
//print_r("update ".ORDER." set payment_status='confirmed' where id='".$ord_id."' AND user_id='".$_SESSION['ses_userid']."' and ord_status='pending'");

$Sel = $conn->select_query(ORDER,"*","ord_id='".$oid."'","1");
/*if($Sel['customer_id']!=$_SESSION['prentz_user_id'])
{
	$conn->divert(SITE_URL);
}
if($Sel['customer_id']==$_SESSION['prentz_user_id'])
{
//$update=$conn->Execute("update ".ORDERPRODUCT." set payment_status='cancelled' where order_product_id='".$ord_id."' AND customer_id='".$_SESSION['prentz_user_id']."'");
}*/
unset($_SESSION['ses_oid']);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <?php  include "inner-header.php"; ?>
     <base href="<?php echo SITE_URL; ?>">
     <style>
.payment-success{
	text-align:center;
}
</style>
  </head>
  <body>
<?php include 'menu.php';?>
<div class="container order-failed">
  <div class="row">
 <!--   <div class="abt">
      <h1>ORDER FAILED</h1>
    </div>-->
    <div class = "container abt-txt">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!--<div class="payment-success"><center> <img alt="Failed" class="img-responsive" src="<?php echo SITE_URL; ?>images/failed.png"></center>-->
          <div class="text-center">
            <h3>PAYMENT FAILED</h3>
             <h4>YOUR ORDER HAS BEEN FAILED</h4>
              <p><i class="fa fa-times-circle-o" aria-hidden="true"></i></p>
             <h5>Attention, There was some problem in your payment!</h5>
           <!-- <h5>We are sorry that your payment is failed. Please Try again later.</h5>-->
            <a style="color:#f08517;" href="<?php echo SITE_URL; ?>">CLICK HERE FOR HOME</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end container --> 
  </div>
</div>




<?php include "footer.php"; ?>

<script>

  function changeQty(position, increase) {
    //alert(position);
   // alert(increase);
    var qty = parseInt($('#quantity' + position).val());

    if ( !isNaN(qty) ) {
      qty = increase ? qty + 1 : (qty - 1 >= 1 ? qty - 1 : 0);
      
      if(qty > 0){
        $.ajax({
          url: 'ajax_submit.php?func=cart_update',
          type: 'post',
          dataType: 'json',
          data: {qty:qty,cart_key:position},
          success: function (json) {
            if (json['cart_display']) {              
              $('.cart-display').html(json['cart_display']);
            }

            if (json['cart_number']) {              
              $('.cart-number').html(json['cart_number']);
            }
            
            $('#dynamic_cart').load('cart_response.php #new_dynamic_cart');
             $('.mini-cart').load('cart_response.php .cart-info');
           // $('#cart-total').html(json['total']);
           //cart_display cart_number


           /* if (json['error']) {
              $('.dynamic_cart').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }

            if (json['success']) {
              $('.dynamic_cart').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
            }*/
          }
        });
        $('#quantity' + position).val(qty);  
      } 
    } else {
      $('#quantity' + position).val(1);
    }   
      return false;      
    }

    function changeOption(cart_key, obj){
       $.ajax({
          url: 'ajax_submit.php?func=cart_update',
          type: 'post',
          dataType: 'json',
          data: {option:obj.value,cart_key:cart_key},
          success: function (json) {
            if (json['cart_display']) {              
              $('.cart-display').html(json['cart_display']);
            }

            if (json['cart_number']) {              
              $('.cart-number').html(json['cart_number']);
            }
            
            $('#dynamic_cart').load('cart_response.php #new_dynamic_cart');
             $('.mini-cart').load('cart_response.php .cart-info');
           // $('#cart-total').html(json['total']);
           //cart_display cart_number


           /* if (json['error']) {
              $('.dynamic_cart').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }

            if (json['success']) {
              $('.dynamic_cart').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
            }*/
          }
        });
    }
      
</script>

</body>
</html>