<?php
/*if(isset($btn_forget))
{
	echo "sdfs";exit;
	$userforget = $conn->select_query(USER,"*","user_status='Y' AND user_email='".$forget_mail."'","1");
	
	require(dirname(__FILE__).'mailer/PHPMailerAutoload.php');
					 
					$from=$EXTRA_ARG['set_email'];
					$fromname=SITE_NAME;
					$to=$userforget['user_email'];
					$user_name=$conn->stripval($userforget['user_name']);
					$usermail=$userforget['user_email'];
					$userpass=$userforget['user_email'];
					
					require(dirname(__FILE__).'mailcontent/resetpassword.php');
	
	
}*/
if(isset($sub_otp))
{
	//echo "dfsD";exit;
	
	$userotp = $conn->select_query(USER,"*","user_status='Y' AND user_id='".$_SESSION['otp_user']."'","1");
	if($userotp['mobile_otp']==$mob_otp)
	{
		$insert=$conn->Execute("UPDATE ".USER." SET mobile_verify='Y' WHERE user_id='".$_SESSION['otp_user']."'");
		
		   $_SESSION['prentz_user_id'] = $userotp['user_id'];
            $_SESSION['prentz_user_name'] = $userotp['user_name'];  
            $_SESSION['prentz_user_email'] = $userotp['user_email'];
            $_SESSION['prentz_user_mobile'] = $userotp['user_mobile'];
			echo '<script>';
		echo 'alert("Otp verfied Successfully")';
		echo 'location.reload()';
		echo '</script>';
		$conn->divert(SITE_URL.'my-profile.html');
			
	}else
	{
		
		//$errorotp="Invalid Otp";
		//echo'<style type="text/css">.showotp{display:block;}</style>';
			
		echo '<script>';
		echo 'alert("Invalid Otp")';
		echo '</script>';
	}
					
	
	
}
if(isset($verify_otp))
{
	//echo "dfsD";exit;
	
	$userotpn = $conn->select_query(USER,"*","user_status='Y' AND user_id='".$_SESSION['otp_user']."'","1");
	if($userotpn['mobile_otp']==$re_otp)
	{
		$insert=$conn->Execute("UPDATE ".USER." SET mobile_verify='Y' WHERE user_id='".$_SESSION['otp_user']."'");
		
		   $_SESSION['prentz_user_id'] = $userotpn['user_id'];
            $_SESSION['prentz_user_name'] = $userotpn['user_name'];  
            $_SESSION['prentz_user_email'] = $userotpn['user_email'];
            $_SESSION['prentz_user_mobile'] = $userotpn['user_mobile'];
			echo '<script>';
		echo 'alert("Otp verified Successfully")';
		echo '</script>';
			$conn->divert(SITE_URL.'my-profile.html');
			
	}else
	{
		$errorotp="Invalid Otp";
		echo '<script>';
		echo 'alert("Invalid Otp")';
		echo '</script>';
		
	}
}
?>

<section id="footer">
  <div class="container-fluid">
    <ul class="foot-ul">
      <li><a href="<?php echo SITE_URL; ?>">Home <span>|</span></a></li>
      <li><a href="<?php echo SITE_URL; ?>about_us.html">About Us<span>|</span></a></li>
      <li><a href="<?php echo SITE_URL; ?>privacy-policy.html">Privacy Policy<span>|</span> </a></li>
      <li><a href="<?php echo SITE_URL; ?>terms.html">Terms of Use<span>|</span> </a></li>
      <li><a href="<?php echo SITE_URL; ?>disclaimer.html">Disclaimer<span>|</span></a></li>
      <li><a href="<?php echo SITE_URL; ?>blog/" target="_blank">Blog <span>|</span></a></li>
      <li><a href="<?php echo SITE_URL; ?>pages/faq-payrentz.html" target="_blank">FAQ <span>|</span></a></li>
      <li><a href="<?php echo SITE_URL; ?>contact.html">Contact Us</a></li>
    </ul>
    <ul class="social-icon">
      <?php if($EXTRA_ARG['facebook']!=''&&$EXTRA_ARG['facebook_settings']=="Y"){?>
      <li><a href="<?php echo $conn->stripval($EXTRA_ARG['facebook']); ?>" class="fb" target="_blank"><i class="fa fa-facebook " aria-hidden="true"></i></a></li>
      <?php }?>
      <?php if($EXTRA_ARG['twitter']!=''&&$EXTRA_ARG['twitter_settings']=="Y"){?>
      <li><a href="<?php echo $conn->stripval($EXTRA_ARG['twitter']); ?>" class="tw" target="_blank"><i class="fa fa-twitter " aria-hidden="true"></i></a></li>
      <?php }?>
      <?php if($EXTRA_ARG['googleplus']!=''&&$EXTRA_ARG['googleplus_settings']=="Y"){?>
      <li><a href="<?php echo $conn->stripval($EXTRA_ARG['googleplus']); ?>" class="gp" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
      <?php }?>
       <?php if($EXTRA_ARG['googleplus']!=''&&$EXTRA_ARG['googleplus_settings']=="Y"){?>
      <li><a href="<?php echo $conn->stripval($EXTRA_ARG['googleplus']); ?>" class="tw" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
      <?php }?>
    </ul>
  </div>
  <!--fluid--> 
  
</section>
<section class="bottom-strip">
  <ul class="bottom-link">
    <li><a href="#"><span> &copy; CopyRights 2017</span> PayRentz.com </a></li>
   <!-- <li><a href="#"><span> Designed and Maintained By</span> Mirrorminds.in</a></li>-->
  </ul>
</section>

<?php
  $cookie_name = "current_location";
  if(!isset($_COOKIE[$cookie_name])) {
?>

<!-- Pop up Window --> 
<!-- Modal -->
<div id="location-modal" style="padding: 0px 5px 0px 5px !important;" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content country-popup">
      <div class="modal-header ">
        <h4 class="modal-title" style="text-align: center;" >Choose your city</h4>
        <p class="text-center country-text">This would help us in serving you the right list of products. You can change this anytime.</p>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="con-sec">
              <?php foreach($sellocation['result'] as $res) { 
			   $exist = $conn->image_exist($res['lo_image'],"uploads/location/");
		      $locimg = ($exist) ? "location/image/".$res['lo_image'] : "images/chennai.png";
				 	  
			  ?>
              <li><i class="fa fa-map-marker"></i> &nbsp; 
                <!--<a href="javascript(0);"  data-dismiss="modal"><?php echo $conn->stripval(ucfirst($res['lo_name'])); ?></a>-->
                <?php /* ?> <button class="btn set_location" location_id="<?php echo $res['lo_id']; ?>"><?php echo $conn->stripval(ucfirst($res['lo_name'])); ?></button><?php */ ?>
                <a href="javascript:void(0)" class="set_location" location_id="<?php echo $res['lo_id']; ?>"><?php echo $conn->stripval(ucfirst($res['lo_name'])); ?></a> </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>--> 
      
    </div>
  </div>
</div>
<?php  } ?>
<form method="post">
<input type="hidden" name="curcookie" id="curcookie" value="<?php echo $_COOKIE[$cookie_name]; ?>" />
<input type="hidden" name="cartlocval" id="cartlocval" value="<?php echo $cartlocval; ?>" />
</form>
<?php
  if(isset($_SESSION['prentz_user_id']) && (empty($_SESSION['prentz_user_email']) || empty($_SESSION['prentz_user_mobile']))) {
?>
<!-- Pop up Window --> 
<!-- Modal -->
<div id="email-modal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content country-popup">
      <div class="modal-header ">
        <h4 class="modal-title" style="text-align: center;" >Enter Details</h4>
        <p class="text-center country-text"></p>
      </div>
      <div class="modal-body">
        <div class="email_err"></div>
        <?php if (empty($_SESSION['prentz_user_email'])) { ?>
        <div class="form-group">
          <input type="email" class="form-control" id="email_email" placeholder="Email">
          <div class="email_error"></div>
        </div>
        <?php } if (empty($_SESSION['prentz_user_mobile'])) { ?>
        <div class="form-group">
          <input type="text" class="form-control" id="email_mobile" placeholder="Mobile">
          <div class="mobile_err"></div>
        </div>
        <?php } ?>
        <center>
          <button id = "email_entry" class="btn btn-login btn-register">Submit</button>
          <div class="logout"></div>
        </center>
        
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>  --> 
      </div>
    </div>
  </div>
</div>
<?php  } ?>
<nav id="menu">
  <ul class="nav navbar-nav">
   
    <li class="dropdown"> <a href="#mm-2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rent </a>
      <ul >
         <li ><a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-home'  ?>.html"><i class="fa fa-stop"></i> Rent For Home</a></li>
        <li ><a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html"> <i class="fa fa-stop"></i> Rent For Office</a></li>
        <li ><a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-events'  ?>.html"><i class="fa fa-stop"></i> Rent For Events</a></li>
      </ul>
    </li>
    <li class="dropdown"><a  href="#mm-3" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Buy</a>
      <ul >
       <li><a href="<?php echo $RES_SURL['buy_url'];  ?>"><i class="fa fa-stop"></i> Clearance Website</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#mm-4" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Service</a>
      <ul >
        <li><a href="<?php echo SITE_URL; ?>service-request.html"><i class="fa fa-stop"></i> PayRentz Product</a></li>
        <li><a href="<?php echo SITE_URL; ?>common_services.html"><i class="fa fa-stop"></i> Non PayRentz Product</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#mm-5" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Business Solutions</a>
      <ul >
         <li><a href="<?php echo SITE_URL; ?>business.html"><i class="fa fa-stop"></i> Business Solutions one </a></li>
      </ul>
      <?php if($topmenus['nr']){ ?>
    <?php foreach ($topmenus['result'] as  $topmenu) { ?>
      <li class="badge mm-menu-badge"> <a href="<?php echo SITE_URL; ?>page/<?php echo $topmenu['tl_slug']; ?>.html" > <i class="fa fa-credit-card"></i> <?php echo $topmenu['tl_name'] ?> </a></li>
       <?php }?>
    <?php }?>
    </li>
 
<!--location--> 
  <?php if($sellocation['nr']){ ?>  
    <?php /*?><div class="location-menu-mob"> <a href="javascript:void(0)" class="city-first" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false" location_id="<?php echo $_COOKIE["current_location"]; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $current_location_name["lo_name"]; ?> <span class="caret"></span></a>
      <div class="mob-cities">
        <ul>
         <?php foreach ($sellocation['result'] as  $resloc) {
				 $exist = $conn->image_exist($resloc['lo_image'],"uploads/location/");
		 $locimg = ($exist) ? "location/image/".$resloc['lo_image'] : "images/chennai.png";
				 
				  ?>
          <li>
            <div class="col-xs-4"> <img src="<?php echo $locimg; ?>"  alt="<?php echo $resloc['lo_name']; ?>" /> </div>
            <div class="col-xs-8"> <a href="javascript:void(0)" class="set_location"location_id="<?php echo $resloc['lo_id']; ?>"><?php echo $resloc['lo_name']; ?></a> </div>
          </li>
           <?php }?>
        </ul>
      </div>
    </div><?php */?>
      <?php }?>
  </ul>
</nav>

<!-- Pop up Window Ends--> 
<script src="<?php echo SITE_URL;?>js/angular.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/jquery.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/moment.js"></script> 
<script src="<?php echo SITE_URL;?>js/bootstrap.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/slick.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/theme.js"></script> 
<script src="<?php echo SITE_URL;?>js/wow.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/modernizr.js"></script> 
<script src="<?php echo SITE_URL;?>js/rzslider.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/jquery.mmenu.all.js"></script> 
<script src="<?php echo SITE_URL;?>js/productzoom.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/bootstrap-datetimepicker.min.js"></script> 
<script src="<?php echo JS_URL; ?>bootbox.min.js"></script> 

<!-- ===================== JS Files 20-3-2018 ========================== --> 

<script src="<?php echo SITE_URL;?>js/jquery.easing.1.3.js"></script> 
<script src="<?php echo SITE_URL;?>js/blueimp-gallery.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL;?>js/owl.carousel.js"></script> 
<script src="<?php echo SITE_URL;?>js/slick.min.js"></script> 
<script src="<?php echo SITE_URL;?>js/wow.min.js"></script> 


<!-- Carousel slider--> 
<!-- =================================================================== --> 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>


<script>
$(".rotate").click(function(){
 $('.faaa').toggleClass("down")  ; 
})
</script>
 
<script>

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    $('#location-modal').modal('hide');
    location.reload(); 
}


$(document).ready(function(){
  $(document).on("click", ".set_location", function(){
    var location=$(this).attr("location_id");
	var curcok=$('#curcookie').val();
	var curcart=$('#cartlocval').val();
	if(curcok!=location && curcart>0)
	{
if (!confirm('Your cart items will get discarded if you change your location. Are you sure you want to go ahead?')) return false;

//cartclear();
$.ajax({
          url: '<?php echo SITE_URL ?>ajax_submit.php?func=cart_clear',
          type: 'post',
          dataType: 'json',
          data: {cval:curcart},
          success: function (json) {
			 // exit;
	setCookie("current_location", location, 30);
	window.location.href = "<?php echo SITE_URL;?>";
	//$('#curcookie').val(current_location);
			  }
        });
		
	}else{
	//alert(curcok);
    setCookie("current_location", location, 30);
	window.location.href = "<?php echo SITE_URL;?>";
	//$('#curcookie').val(current_location);
	}
	
  });
  //checkCookie();
});
</script> 
<script>
function cartclear()
{
	alert("test");
}

</script>

<!-- Popup Window --> 
<script>
    
// A $( document ).ready() block.
$( document ).ready(function() {

 
//$('body').css('overflow', 'hidden');
    // load the overlay
    //$('#myModal').modal({show:true});
    
$("#location-modal").modal({
        show:true,
        backdrop: 'static',
        keyboard: false,
       });

   /* $('body').on('wheel.modal mousewheel.modal', function () {return false;}); */
    
   /* $('#myModal').on('shown', function () {
    $('body').on('wheel.modal mousewheel.modal', function () {return false;});
}).on('hidden', function () {
    $('body').off('wheel.modal mousewheel.modal');
}); */

$(function(){
    $('#myModalLogin').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 3000));
    });
});

$(function(){
    $('#myModalReg').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 3000));
    });
});

$(function(){
    $('#myModalup').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 3000));
    });
});

$("#expiry-modal").modal({
        show:true,
        backdrop: 'static',
        keyboard: false,
       });

$("#email-modal").modal({
        show:true,
        backdrop: 'static',
        keyboard: false,
       });
}); 
    


</script> 

<!--mobile menu--> 
<script type="text/javascript">


<?php 
//Error Alerts
if($Alerterror)
{?>
bootbox.dialog({
  message: "<p style='color:#C9302C;font-size:13px'><?php echo $Alerterror ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    danger: {
      label: "Ok",
      className: "btn-danger"
    <?php if($Alerterrorurl){?>
      ,callback: function() {
        window.location.href="<?php echo $Alerterrorurl; ?>";
      }
    <?php }?>
    }
  }
});
<?php } 

//SUCCESS  Alerts
if(isset($Alertsuccess))
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $Alertsuccess; ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    success: {
      label: "OK",
      className: "btn-success"
    <?php if($Alertsuccessurl){?>
    ,callback: function() {
        window.location.href="<?php echo $Alertsuccessurl; ?>";
      }
     <?php }?>
    }
  }
});
<?php
}?>

  jQuery(document).ready(function( $ ) {
            $("#mob-menu").mmenu({
               
                navbar: {
        title: ""
    },
                "slidingSubmenus": false,
                
               "extensions": [
                  "pagedim-black"
               ]
                
            });
         });
      </script> 
<script>
$(document).ready(function(){
    $("#user-menu").click(function(){

        $("#user-panel").fadeToggle();
    });
});
</script> 
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script> 

<!--price slider for detail page--> 
<script>
var myApp = angular.module('myapp', ['rzModule']);

myApp.controller('TestController', TestController);

function TestController($scope, $timeout) {
  var vm = this;

  vm.visible = true;
  vm.priceSlider = {
	   value: 4,
  options: {
    showTicksValues: true,
	  showSelectionBar: true,
    stepsArray: [
      { value: 100, legend: '1-3'},
     
      {value: 240, legend: '4-6'},
  
      {value: 350, legend: '7-9'},
      
      { value: 450, legend: '10-12'},
    
      
    ]
  }
	  
  };

  vm.toggle = function () {
    vm.visible = !vm.visible;
    if (vm.visible)
      vm.refreshSlider();
  };

  vm.refreshSlider = function () {
    $timeout(function () {
      $scope.$broadcast('rzSliderForceRender');
    });
  };
}
</script> 

<!--Quantity for cart page--> 
<script>
$(document).ready(function(){

//var quantitiy=0;
  /* $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });*/
    
});
    
$(document).ready(function(){

var quantitiy=0;
   $('.quantity1-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity1').val());
        
        // If is not undefined
            
            $('#quantity1').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity1-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity1').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity1').val(quantity - 1);
            }
    });
    
});
    
$(document).ready(function(){

var quantitiy=0;
   $('.quantity2-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity2').val());
        
        // If is not undefined
            
            $('#quantity2').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity2-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity2').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity2').val(quantity - 1);
            }
    });
    
});
</script> 

<!-- Calling the GlassCase plugin --> 
<script type="text/javascript">  
   
	$(function(){
    var $window = $(window);
    if($window.width() <= 767){
        $('#product-gallery').glassCase({ 'isShowAlwaysIcons': true, 'isDownloadEnabled':false,       'heightDisplay': 550, 'widthDisplay': 334,});
    }else if($window.width() <= 1024 && $window.width() >= 768){
        $('#product-gallery').glassCase({ 'thumbsPosition': 'bottom', 'nrThumbsPerRow':4, 'isDownloadEnabled':false, 'isZoomEnabled':false,});

    }else{
        $('#product-gallery').glassCase({ 'thumbsPosition': 'bottom', 'nrThumbsPerRow':4, 'isDownloadEnabled':false});
    }
});  
</script> 
<script>
  new WOW().init();
</script> 
<script> 
$(document).ready(function(){
    $("#city-link").mouseover(function(){
        $("#city-panel").slideToggle("3000");
    });
});
    
</script> 
<Script>
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).slideDown(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).slideUp(500);
});
</Script> 
<script type="text/javascript">
(function($) {          
    $(document).ready(function(){                    
        $(window).scroll(function(){                          
            if ($(this).scrollTop() > 50) {
                $('#fixed-nav').fadeIn(100);
            } else {
                $('#fixed-nav').fadeOut(100);
            }
        });
    });
})(jQuery);
</script> 
<script>
  $('#hover1').hover(function() {
        $(this).find('#first-show1').hide();
        $(this).find('#second-show1').fadeIn("slow");
    }, function() {
        $(this).find('#second-show1').hide();
        $(this).find('#first-show1').fadeIn("slow");
});
 $('#hover2').hover(function() {
        $(this).find('#first-show2').hide();
        $(this).find('#second-show2').fadeIn("slow");
    }, function() {
        $(this).find('#second-show2').hide();
        $(this).find('#first-show2').fadeIn("slow");
});
 $('#hover3').hover(function() {
        $(this).find('#first-show3').hide();
        $(this).find('#second-show3').fadeIn("slow");
    }, function() {
        $(this).find('#second-show3').hide();
        $(this).find('#first-show3').fadeIn("slow");
});
 $('#hover4').hover(function() {
        $(this).find('#first-show4').hide();
        $(this).find('#second-show4').fadeIn("slow");
    }, function() {
        $(this).find('#second-show4').hide();
        $(this).find('#first-show4').fadeIn("slow");
});
</script> 
<script>
$('.testimonial-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  arrows: false,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
$('.client-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 6,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4,
		 dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
		 dots: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
			
$('.people-rented').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 2500,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		 dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		 dots: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});				
				</script> 
<!-- side mnavigation bar--> 
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 

<!--   product gallery --> 
<script>
  jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 5000
        });
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});
 </script> 
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script> 

<!-- Login/ Register Success popup Model -->

<div id="myModalLogin" class="modal fade" role="dialog">
  <div class="modal-dialog"><!-- Modal content-->
    <div class="modal-content country-popup">
      <div class="modal-body"> Login Successful...! </div>
    </div>
  </div>
</div>
<div id="myModalReg" class="modal fade" role="dialog">
  <div class="modal-dialog"><!-- Modal content-->
    <div class="modal-content country-popup">
      <div class="modal-body"> Registered Successful...! </div>
    </div>
  </div>
</div>

<!-- register modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-register" role="document">
    <div class="col-md-8 col-md-offset-2">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Register</h4>
        </div>
        <div class="modal-body">
          <form class="form-top">
            <div class="reg_err"></div>
            <div class="form-group">
              <input type="text" class="form-control" id="check_reg_name" placeholder="Name">
              <div class="reg_err_username"></div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="check_reg_email" placeholder="Email">
              <div class="reg_err_email"></div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="check_reg_mobile" placeholder="Mobile Number">
              <div class="reg_err_mobile"></div>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="check_reg_pwd" placeholder="Password">
              <div class="reg_err_password"></div>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="check_reg_cpwd"  placeholder="Confirm Password">
              <div class="reg_err_cpassword"></div>
            </div>
            <center>
              <button type="submit" class="btn btn-login btn_register" id="check_reg">Sign up</button>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if(isset($_SESSION['prentz_expired'])) {
          echo "<script type='text/javascript'>
$(document).ready(function(){
$('#myModal').modal('show');
});
</script>";

unset($_SESSION['prentz_expired']);
} ?>

<!-- Top-Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-md-8 col-md-offset-2">
      <div class="form-body">
        <ul class="nav nav-tabs final-login lable-left tops-ul">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> ×</button>
          <div class="clearfix"></div>
          <li class="active tabs"><a data-toggle="tab" href="#sectionA">Login</a></li>
          <li><a data-toggle="tab" href="#sectionB">Sign Up</a></li>
        </ul>
        <div class="tab-content">
          <div id="sectionA" class="tab-pane fade in active">
            <div class="innter-form">
              <div id="login" >
                <form class="sa-innate-form" id="frm_login" method="post" >
                  <div class="log_err"></div>
                  <label>Mobile No</label>
                  <input type="text" id="login_email" name="log_email">
                  <div class="log_err_email"></div>
                  <label>Password</label>
                  <input type="password" id="login_pwd" name="log_pwd">
                  <div class="log_err_pwd"></div>
                  <button type="button" id="btn_login">Login</button>
                  <a  class="forget" id="open_forget" href="javascript:void(0);" > Forgot Password? </a>
                </form>
              </div>
              <div id="forget" style="display:none;" class="">
                <div class="forget-hide" id="collapseExample"> <br>
                  Enter Your Registered Mobile No
                  <form class="sa-innate-form"  method="post" id="frm_forget" >
                    <label></label>
                    <input type="text" name="forget_mob" id="forget_mob" placeholder="Enter Your Mobile No">
                    <div class="fgt_err_mobile"></div>
                    <button type="button" class="forget_11 send-btntriger btn_forget" id="open_forget_1" href="javascript:void(0);" >Send</button>
                  </form>
                  <a  class="forget" id="open_login"  href="javascript:void(0);" > Login? </a> </div>
              </div>
              <div id="forget_1" style="display: none;" class="sms-ver">
                <div class="" id="collapseExample"> <br>
                  sms verification
                  <form class="sa-innate-form reotp"  method="post" >
                    <label></label>
                    <input type="text" name="re_otp" id="re_otp" placeholder="Enter Your OTP">
                    <div class="fgt_err_sdsdemail"></div>
                    <button type="submit" name="verify_otp" id="verify_otp" class="verify_otp">Submit</button>
                    <a class="btn_resend" href="javascript:void(0);">Resend OTP</a>
                  </form>
                </div>
              </div>
            </div>
            <div class="social-login">
              <p> - - - - - - - - - - - Login in with - - - - - - - - - - - </p>
              <ul>
                <li><a href="<?php echo SITE_URL ?>login/fblogin.php"><i class="fa fa-facebook"></i> Facebook</a></li>
                <li><a href="<?php echo SITE_URL ?>login/gplus/index.php"><i class="fa fa-google-plus"></i> Google+</a></li>
                <!--<li><a href="login/twitter/index.php"><i class="fa fa-twitter"></i> Twitter</a></li>-->
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
          <div id="sectionB" class="tab-pane fade webreg">
            <div class="innter-form" id="signuphide">
              <form class="sa-innate-form" method="post" id="frm_register">
                <div class="reg_err"></div>
                <label>Name</label>
                <input type="text" name="register_username" id="reg_username">
                <div class="reg_err_username"></div>
                <label>Email Address</label>
                <input type="text" name="register_email" id="reg_email">
                <div class="reg_err_email"></div>
                <label>Mobile Number</label>
                <input type="text" name="register_mobile" id="reg_mobile">
                <div class="reg_err_phone"></div>
                <label>Password</label>
                <input type="password" name="register_password" id="reg_password">
                <div class="reg_err_password"></div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="c_password"> 
                 <div class="reg_err_cpassword"></div>
                   <div class="reg_err_terms"></div>
   <input type="checkbox" name="terms" id="terms" value="1" /> I accept all the <a href="<?php SITE_URL ?>termscondition.php" target="_blank" style="color:#00F"> Terms & Conditions</a>
                <button type="button" id="btn_register" class="btn_register">Sign Up</button>
              </form>
            </div>
        
            <div class="showotp " id="collapseExample" style="display: none;"> <br>
              sms verification
              <form class="sa-innate-form new"  method="post" >
              <div class="reg_errs"><?php echo $errorotp; ?></div>
                <label></label>
                <input type="text" name="mob_otp" id="mob_otp" placeholder="Enter Your OTP">
    <button type="submit" name="sub_otp" id="sub_otp" class="sub_otp">Submit</button>
                <a class="btn_resend" href="javascript:void(0);">Resend OTP</a>
              </form>
            </div>
             <div class="social-login">
              <p>- - - - - - - - - - - - - Sign in With - - - - - - - - - - - - - </p>
              <ul>
                <li><a href="<?php echo SITE_URL ?>login/fblogin.php"><i class="fa fa-facebook"></i> Facebook</a></li>
                <li><a href="<?php echo SITE_URL ?>login/gplus/index.php"><i class="fa fa-google-plus"></i> Google+</a></li>
             <!--     <li><a href="login/twitter/index.php"><i class="fa fa-twitter"></i> Twitter</a></li> --> 
              </ul>
            </div>
            </div>
            
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="logout">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        
        <!--  <h4 class="modal-title"></h4><?php echo SITE_NAME ?></h4> --> 
      </div>
      <div class="modal-body">
        <center>
          <p>Are you sure want to Sign out?</p>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-default logoutfunction">Yes</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 
<script type="text/javascript">

function validateMobile(email) {
      var rm = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;     
      return rm.test(email);
    }
	function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }


$('#login_pwd').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
	 document.getElementById("btn_login").click();
  }
});

$('#login_email').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
	 document.getElementById("btn_login").click();
  }
});
	
    // login button action here
    $(document).on("click", "#btn_login", function(){	
	
       var mobile = $("#login_email").val();
       var password = $("#login_pwd").val();
	  
        if (!validateMobile(mobile)) {
            $('.log_err_email').html('<div class="text-danger"> Invalid Mobile No </div>');
            return false;
        } else {
            $('.log_err_email').html('');
        }

        if(password.length == 0){
           $('.log_err_pwd').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.log_err_pwd').html('');
        }

        $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/login.php',
            data: {"phone": mobile,"password": password},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalLogin').modal('show');
                });*/

                    alert("Login submitted successfully.");
                    window.location = window.location.href;


               /* $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 1000);
                });*/
              }

              if (json['fail']) {
                $('.log_err').html('<div class="text-danger"> '+json['fail']+' </div>'); 
              }
                
            }
        });
        return true;
    });

//forget pw
	
 $(document).on("click", ".btn_forget", function(){   
       var forget_mob = $("#forget_mob").val(); 
	    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
		//alert(forget_mob.length);
		if(forget_mob.length == 0){
           $('.fgt_err_mobile').html('<div class="text-danger"> Mobile No Cant be Empty! </div>');
            return false;
        } else {
            $('.fgt_err_mobile').html('');
        }


		  if(!forget_mob.match(phoneno)){
           $('.fgt_err_mobile').html('<div class="text-danger"> Enter Valid Mobile Number </div>');
            return false;
        } else {
            $('.fgt_err_mobile').html('');
			 $(".forget-hide").css({'display': 'none'});
      $(".sms-ver").css({'display': 'block'});
        }
         $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/forgot.php',
            data: {"mobile": forget_mob},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalReg').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/

                  //  alert("Password Send successfully.");
                   // window.location = json['redirect']


              }

              if (json['fail']) {
                $('.fgt_err_mobile').html('<div class="text-danger">  '+json['fail']+' </div>'); 
				 $(".forget-hide").css({'display': 'block'});
                 $(".sms-ver").css({'display': 'none'});
              }
                
            }
        });

        return true;

       
    });	


//resend pw
	
 $(document).on("click", ".btn_resend", function(){   
       var resend_mob = $("#forget_mob").val(); 
	    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
		//alert(forget_mob.length);
	
         $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/resend.php',
            data: {"mobile": resend_mob},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalReg').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/

                  //  alert("Password Send successfully.");
                   // window.location = json['redirect']


              }

              if (json['fail']) {
                $('.fgt_err_mobile').html('<div class="text-danger">  '+json['fail']+' </div>'); 
				 $(".forget-hide").css({'display': 'block'});
                 $(".sms-ver").css({'display': 'none'});
              }
                
            }
        });

        return true;

       
    });
</script>
<script type="text/javascript">
    
    // show forget password window here
    $(document).on("click", "#open_forget", function(){
      $("#login").css({'display': 'none'});
      $("#forget").removeAttr("style");
    });

    // show login window here
    $(document).on("click", "#open_login", function(){
      $("#forget").css({'display': 'none'});
      $("#login").removeAttr("style");
    });
	
//trigger

$('#c_password').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
	 document.getElementById("btn_register").click();
  }
}); 	
   $(document).on("click", ".btn_register", function(){   

    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;     

       var reg_email = $("#reg_email").val();
       var reg_username = $("#reg_username").val();
       var reg_mobile = $("#reg_mobile").val();
       var reg_pass = $("#reg_password").val();
       var confirmPassword = $("#c_password").val();

        if(reg_username.length == 0){
           $('.reg_err_username').html('<div class="text-danger"> Username Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_username').html('');
        }

        if (!validateEmail(reg_email)) {
            $('.reg_err_email').html('<div class="text-danger"> Email id is not valid </div>');
            return false;
        } else {
            $('.reg_err_email').html('');
        }

        if(!reg_mobile.match(phoneno)){
           $('.reg_err_phone').html('<div class="text-danger"> Enter Valid Mobile Number </div>');
            return false;
        } else {
            $('.reg_err_phone').html('');
        }

        if(reg_pass.length == 0){
           $('.reg_err_password').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_password').html('');
        }

        if (reg_pass != confirmPassword) {
            $('.reg_err_cpassword').html('<div class="text-danger"> Passwords not match </div>'); 
            return false;
        } else {
             $('.reg_err_cpassword').html('');
        }

if ($('#terms').prop('checked')==true){ 
        //do something
		$('.reg_err_terms').html('');
        }else
		{
			 $('.reg_err_terms').html('<div class="text-danger"> Accept Terms & Conditions </div>'); 
           return false;
			
		}
         $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/signup.php',
            data: {"email": reg_email, "username": reg_username, "mobile": reg_mobile, "password": reg_pass},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {

         
              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalReg').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/

                  //  alert("Register submitted successfully.");
                    //window.location = json['redirect'];
					
					 $("#signuphide").hide();
				    showoup();
				   


              }

              if (json['fail']) {
                $('.reg_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
              }
                
            }
        });

        return true;

       
    });
		
		$(document).on("click", ".btn_personal", function(){  

    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;     

       var reg_email = $("#reg_email").val();
       var reg_username = $("#reg_username").val();
       var reg_mobile = $("#reg_mobile").val();
       var reg_pass = $("#reg_password").val();
       var confirmPassword = $("#c_password").val();
       
		
        if(reg_username.length == 0){
           $('.reg_err_username').html('<div class="text-danger"> Username Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_username').html('');
        }

        if (!validateEmail(reg_email)) {
            $('.reg_err_email').html('<div class="text-danger"> Email id is not valid </div>');
            return false;
        } else {
            $('.reg_err_email').html('');
        }

        if(!reg_mobile.match(phoneno)){
           $('.reg_err_phone').html('<div class="text-danger"> Enter Valid Mobile Number </div>');
            return false;
        } else {
            $('.reg_err_phone').html('');
        }

        if(reg_pass.length == 0){
           $('.reg_err_password').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_password').html('');
        }

        if (reg_pass != confirmPassword) {
            $('.reg_err_cpassword').html('<div class="text-danger"> Passwords not match </div>'); 
            return false;
        } else {
             $('.reg_err_cpassword').html('');
        }
		
		if ($('#terms').prop('checked')==true){ 
        //do something
		$('.reg_err_terms').html('');
        }else
		{
			 $('.reg_err_terms').html('<div class="text-danger"> Accept Terms & Conditions </div>'); 
           return false;
			
		}
	
		/*if(!this.form.checkbox.checked)
     {
		  $('.reg_err_terms').html('<div class="text-danger"> Accept Terms & Conditions </div>'); 
           return false;
        }*/

         $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/signup.php',
            data: {"email": reg_email, "username": reg_username, "mobile": reg_mobile, "password": reg_pass},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {

         
              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalReg').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/

                  //  alert("Register submitted successfully.");
                    //window.location = json['redirect'];
					
					 $("#signuphide").hide();
				 showoup();
				   


              }

              if (json['fail']) {
                $('.reg_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
              }
                
            }
        });

        return true;

       
    });
	
	function showoup()
{
	$(".showotp").show();
	// $(".sms-ver").css({'display': 'block'});
}



//verify otp
 /*$(document).on("click", ".btn_subotp", function(){   
	 alert("asd");
	  $.ajax
        ({ 
		
		 var use_otp = $("#mob_otp").val();
            url: 'login/otpverify.php',
            data: {"otp": use_otp},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) 
			  {
				 alert("Otp Verified successfully."); 
              }

              if (json['fail']) {
                $('.otp_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
              }
                
            }
        });		
    });
	*/
$(document).on("click", "#email_entry", function(){ 

       var emailemail = $("#email_email").val();
       var emailmobile = $("#email_mobile").val();

        $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/email_mobile.php',
            data: {"email": emailemail,"mobile": emailmobile},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
				  window.location.href = json['redirect'];
                /*$(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/
              }

              if (json['success_mobile']) {
				   window.location.href = json['redirect'];
              /*  $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/
              }

              if (json['error']) {
                $('.email_err').html('<div class="text-danger"> '+json['error']+' </div>');
                $('.btn-register').html('<a href="logout.php"><button class="btn btn-login">Logout</button></a>');
                 
              }

              if (json['mobile_error']) {
                $('.mobile_err').html('<div class="text-danger"> '+json['mobile_error']+' </div>');
                 
              }
              if (json['email_error']) {
                $('.email_error').html('<div class="text-danger"> '+json['email_error']+' </div>');
                 
              }
                
            }
        });
        return true;
    });




</script> 

<!----ggggggggggggggggggggggggggggggg----------------> 

<script type="text/javascript">
function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
  $(document).ready(function(){    

    // show forget password window here
  /*  $(document).on("click", "#open_forget_1", function(){
      $("#login").css({'display': 'none'});
      $("#forget_1").removeAttr("style");
    });*/
	
	    // show forget password window here
  /*  $(document).on("click", ".send-btntriger", function(){
      $(".forget-hide").css({'display': 'none'});
      $(".sms-ver").css({'display': 'block'});
    });
*/
    // show login window here
    $(document).on("click", "#open_login", function(){
      $("#forget_1").css({'display': 'none'});
      $("#login").removeAttr("style");
    });

    // login button action here
   // $(document).on("click", "#btn_login", function(){  
//
//
//
//
//       var email = $("#login_email").val();
//
//
//       var password = $("#login_pwd").val();
//
//        if (!validateEmail(email)) {
//            $('.log_err_email').html('<div class="text-danger"> Email id is not valid </div>');
//            return false;
//        } else {
//            $('.log_err_email').html('');
//        }
//
//        if(password.length == 0){
//           $('.log_err_pwd').html('<div class="text-danger"> Password Cant be Empty! </div>');
//            return false;
//        } else {
//            $('.log_err_pwd').html('');
//        }
//
//        $.ajax
//        ({ 
//            url: 'login/login.php',
//            data: {"email": email,"password": password},
//            type: 'post',
//            dataType: 'json',
//            success: function(json)
//            {
//				
//
//              if (json['success']) {
//                /*$(document).ready(function(){
//                  $('#myModal').modal('hide');
//                  $('#myModalLogin').modal('show');
//                });*/
//
//                    alert("Login submitted successfully.");
//                    window.location = window.location.href
//
//
//               /* $(document).ready(function(){
//                  setTimeout(function() {
//                   window.location.href = json['redirect']
//                  }, 1000);
//                });*/
//              }
//
//              if (json['fail']) {
//                $('.log_err').html('<div class="text-danger"> '+json['fail']+' </div>'); 
//              }
//                
//            }
//        });
//        return true;
//    });


// login button action here
    $(document).on("click", "#btn_logins", function(){  




       var email = $("#login_emails").val();




       var password = $("#login_pwds").val();
   

        if (!validateEmail(email)) {
            $('.log_err_emails').html('<div class="text-danger"> Email id is not valid </div>');
            return false;
        } else {
            $('.log_err_emails').html('');
        }

        if(password.length == 0){
           $('.log_err_pwds').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.log_err_pwds').html('');
        }

        $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/login.php',
            data: {"email": email,"password": password},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
        

              if (json['success']) {
                /*$(document).ready(function(){
                  $('#myModal').modal('hide');
                  $('#myModalLogin').modal('show');
                });*/

                    alert("Login submitted successfully.");
                    window.location = 'checkout.php'


               /* $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 1000);
                });*/
              }

              if (json['fail']) {
                $('.log_err').html('<div class="text-danger"> '+json['fail']+' </div>'); 
              }
                
            }
        });
        return true;
    });



//
//
//    $(document).on("click", ".btn_register", function(){   
//
//    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;     
//
//       var reg_email = $("#reg_email").val();
//       var reg_username = $("#reg_username").val();
//       var reg_mobile = $("#reg_mobile").val();
//       var reg_pass = $("#reg_password").val();
//       var confirmPassword = $("#c_password").val();
//
//        if(reg_username.length == 0){
//           $('.reg_err_username').html('<div class="text-danger"> Username Cant be Empty! </div>');
//            return false;
//        } else {
//            $('.reg_err_username').html('');
//        }
//
//        if (!validateEmail(reg_email)) {
//            $('.reg_err_email').html('<div class="text-danger"> Email id is not valid </div>');
//            return false;
//        } else {
//            $('.reg_err_email').html('');
//        }
//
//        if(!reg_mobile.match(phoneno)){
//           $('.reg_err_phone').html('<div class="text-danger"> Enter Valid Mobile Number </div>');
//            return false;
//        } else {
//            $('.reg_err_phone').html('');
//        }
//
//        if(reg_pass.length == 0){
//           $('.reg_err_password').html('<div class="text-danger"> Password Cant be Empty! </div>');
//            return false;
//        } else {
//            $('.reg_err_password').html('');
//        }
//
//        if (reg_pass != confirmPassword) {
//            $('.reg_err_cpassword').html('<div class="text-danger"> Passwords not match </div>'); 
//            return false;
//        } else {
//             $('.reg_err_cpassword').html('');
//        }
//
//         $.ajax
//        ({ 
//            url: 'login/signup.php',
//            data: {"email": reg_email, "username": reg_username, "mobile": reg_mobile, "password": reg_pass},
//            type: 'post',
//            dataType: 'json',
//            success: function(json)
//            {
//
//         
//              if (json['success']) {
//                /*$(document).ready(function(){
//                  $('#myModal').modal('hide');
//                  $('#myModalReg').modal('show');
//                });
//                $(document).ready(function(){
//                  setTimeout(function() {
//                   window.location.href = json['redirect']
//                  }, 500);
//                });*/
//
//                    alert("Register submitted successfully.");
//                    window.location = json['redirect']
//
//
//              }
//
//              if (json['fail']) {
//                $('.reg_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
//              }
//                
//            }
//        });
//
//        return true;
//
//       
//    });
	
	

// $(document).on("click", ".btn_forget", function(){   
//  
//
//       var forget_email = $("#forget_mob").val();
//      
//
//      /*  if (!validateEmail(forget_email)) {
//            $('.fgt_err_email').html('<div class="text-danger"> Email id is not valid </div>');
//            return false;  
//        } else {
//            $('.forget_email').html('');
//        }
//      */
//
//         $.ajax
//        ({ 
//            url: 'login/forgot.php',
//            data: {"email": forget_email},
//            type: 'post',
//            dataType: 'json',
//            success: function(json)
//            {
//
//         
//              if (json['success']) {
//                /*$(document).ready(function(){
//                  $('#myModal').modal('hide');
//                  $('#myModalReg').modal('show');
//                });
//                $(document).ready(function(){
//                  setTimeout(function() {
//                   window.location.href = json['redirect']
//                  }, 500);
//                });*/
//
//                    alert("Password Send successfully.");
//                    window.location = json['redirect']
//
//
//              }
//
//              if (json['fail']) {
//                $('.forget_email').html('<div class="text-danger">  '+json['fail']+' </div>'); 
//              }
//                
//            }
//        });
//
//        return true;
//
//       
//
//    });	

 
	
$(document).on("click", "#email_entry", function(){ 

       var emailemail = $("#email_email").val();
       var emailmobile = $("#email_mobile").val();

        $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/email_mobile.php',
            data: {"email": emailemail,"mobile": emailmobile},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
				   window.location.href = json['redirect'];	
               /* $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/
              }

              if (json['success_mobile']) {
				   window.location.href = json['redirect'];
               /* $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });*/
              }

              if (json['error']) {
                $('.email_err').html('<div class="text-danger"> '+json['error']+' </div>');
                $('.btn-register').html('<a href="logout.php"><button class="btn btn-login">Logout</button></a>');
                 
              }

              if (json['mobile_error']) {
                $('.mobile_err').html('<div class="text-danger"> '+json['mobile_error']+' </div>');
                 
              }
              if (json['email_error']) {
                $('.email_error').html('<div class="text-danger"> '+json['email_error']+' </div>');
                 
              }
                
            }
        });
        return true;
    });

  });


</script> 

<!-----------------fffffffffffffff--> 

<script type="text/javascript">

  $(document).ready(function () {

 $(".logoutfunction").click(function(e){

window.location.href="<?php echo SITE_URL; ?>logout/";

 e.preventDefault();
});
   
   });
  


</script> 
<script type="text/javascript">
  $(document).ready(function(){

    $('.mini-cart').load('cart_response.php .cart-info');
  });
</script> 

<!-- new address modal -->

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-register" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Add New Address</h4>
      </div>
      <div class="modal-body">
        <form name="form-add" id="form-add-address" method="post" autocomplete="off">
          <div class="form-group">
            <label for="name">Name <span style="color:#a70f13">*</span></label>
            <input  class="form-control" placeholder="Name" name="firstname" id="firstname" maxlength="100" type="text">
          </div>
          <div class="form-group">
            <label for="address">Address <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="Address" name="address_1" id="address_1" maxlength="150" type="text">
          </div>
          <div class="form-group">
            <label for="city">City <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="City" name="city" id="address-city" maxlength="100" type="text">
          </div>
          <div class="form-group">
            <label for="state">State <span style="color:#a70f13">*</span></label>
            <?php $state_detail = $conn->select_query(STATE,"*", "country_id = '99' AND status = '1' order by name", ""); ?>
            <select class="form-control" name="state_id" id="state_id">
              <?php foreach ($state_detail['result'] as $key => $state_value) { ?>
              <option value="<?php echo $state_value['zone_id'];?>"><?php echo $state_value['name'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="pincode">Pincode <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="postcode" name="postcode" id="address-pincode" maxlength="6" type="text">
          </div>
          <div class="form-group">
            <label for="email">E-mail Address <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="E-mail Address" name="email_id" id="email_id" maxlength="150" type="text">
          </div>
          <div class="form-group">
            <label for="mobile">Mobile Number <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="Mobile Number" name="mobile_no" id="mobile_no" maxlength="15" type="text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit" id="my_address" name="my_address" value="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
//verify otp
function chkotp()
{
 /*$.ajax
        ({ 
		 var use_otp = $("#mob_otp").val();
            url: 'login/otpverify.php',
            data: {"otp": use_otp},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) 
			  {
				 alert("Otp Verified successfully."); 
              }
              if (json['fail']) {
                $('.otp_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
              }
            }
        });	*/	

}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click", "#btn_add_address", function(){
       $.ajax({
        url: '<?php echo SITE_URL ?>ajax_submit.php?func=address_add',
        type: 'post',
        data: $('#form-add-address input[type=\'text\'], #form-add-address input[type=\'date\'], #form-add-address input[type=\'datetime-local\'], #form-add-address input[type=\'time\'], #form-add-address input[type=\'password\'], #form-add-address input[type=\'checkbox\']:checked, #form-add-address input[type=\'radio\']:checked, #form-add-address input[type=\'hidden\'], #form-add-address textarea, #form-add-address select'),
        dataType: 'json',       
        success: function(json) {  
          $('.alert, .text-danger').remove();
          $('.form-group').removeClass('has-error');  

          if (json['redirect']) {
                location = json['redirect'];
          } 
          if (json['error']) {
            
              for (i in json['error']) {
                var element = $('#address-' + i.replace('_', '-'));
               // console.log(element); return false;
                if (element.parent().hasClass('input-group')) {
                  element.parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                } else {
                  element.after('<div class="text-danger">' + json['error'][i] + '</div>');
                }
              }
      
            // Highlight any found errors
            $('.text-danger').parent().addClass('has-error');
          }
          if (json['success']) {
              //modal popup window close here
              $('#exampleModal1').modal('hide');

              //form data reset here
              $('#form-add-address').trigger("reset");
              
              // checkout page address div reload here
              $('#collapseTwo .panel-body').load('checkout_response.php #checkout-ajax-address');

              // checkout page other div close when new address added
              $('#collapseThree').parent().find('.panel-heading .panel-title').html(' 3. Order Summary ');
              $('#collapseThree').parent().find('.panel-heading').removeClass('active'); 
              $('#collapseFour').parent().find('.panel-heading .panel-title').html(' 4. Payment Method ');
              $('#collapseFour').parent().find('.panel-heading').removeClass('active'); 
          } 
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    });
  });
</script> 
<script type="text/javascript">
   function cartRemove(key) {
      $.ajax({
        url: '<?php echo SITE_URL ?>ajax_submit.php?func=cart_remove',
        type: 'post',
        data: 'key=' + key,
        dataType: 'json',       
        success: function(json) { 
		location.reload();        
          if (json['cart_display']) {              
            $('.cart-display').html(json['cart_display']);
          }
                    
          $('.cart-number').html(json['cart_number']);
                     
          $('#dynamic_cart').load('cart_response.php #new_dynamic_cart');
          $('.mini-cart').load('cart_response.php .cart-info');
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }

    
  function cartAdd(product_id, quantity, action) {
    //alert(action); return false;
    $.ajax({
      url: '<?php echo SITE_URL ?>ajax_submit.php?func=cart_add',
      type: 'post',
      data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
      dataType: 'json',     
      success: function(json) {
        $('.alert, .text-danger').remove();
        //return false;
        if (json['redirect']) {
          location = json['redirect'];
        }
      
        if (json['error']) {        
                 // Highlight any found errors
          $('.container').before(json['error']);
        }

        if (json['success']) {
          $('.breadcrumb').after('<div class="alert alert-success container-fluid">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          
          $('html, body').animate({ scrollTop: 0 }, 'slow');

          $('.mini-cart').load('cart_response.php .cart-info');
          if (json['cart_number']) {              
              $('.cart-number').html(json['cart_number']);
          }
          if(action){
            location = "<?php echo SITE_URL.'cart.php'; ?>";
          }
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
</script> 
<script>
 jQuery(document).ready(function( $ ) {
	 $(".location-menu-mob").hover(
    function() {
        $(".mob-cities").slideDown(500);
    }, function() {
        $(".mob-cities").slideUp(500);
    });
});
</script> 
<script>

document.getElementById('links').onclick = function (event){
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script> 
<script>
$('.brand-img').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
     autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
       
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
   
  ]
});    
    
    </script> 
<!-- Fire the plugin onDocumentReady --> 
<script type="text/javascript">
         jQuery(document).ready(function( $ ) {
            $("#menu").mmenu({
               "offCanvas":{
                   "position":"left"
               } 
            });
             
         });
</script> 
<script>
$(document).ready(function(){

$( "div.wrapper" )
  .mouseover(function() {

	    $( this ).find( ".description").addClass("wrapper-hover");
		$( this ).find( ".description").removeClass("wrapper-default");
  })
  .mouseout(function() {
	    $( this ).find( ".description").removeClass("wrapper-hover");
		$( this ).find( ".description" ).addClass("wrapper-default");

  });
	
});
</script> 
<script>
$(document).ready(function(){

$( "div.wrapper" )
  .mouseover(function() {

	    $( this ).find( ".a-link").addClass("a-link-hover");
		$( this ).find( ".a-link").removeClass("a-link-default");
  })
  .mouseout(function() {
	    $( this ).find( ".a-link").removeClass("a-link-hover");
		$( this ).find( ".a-link" ).addClass("a-link-default");

  });
	
});
</script> 
<script>

if (screen.width >= 768 || windowWidth >= 768) {
  var speed = 500;
  var header = 0;
  
  $(window).scroll(function(){
	  if($(document).scrollTop() > 0) {
		  if(header == 0) {
			 header = 1;
			  $('#header-inner').stop().animate({ marginTop:'0' }, speed);
			  $("#header-main").css({backgroundColor:'rgba(64,64,64,0.9)'}, speed);
			  $(".navbar-brand img").css({"max-width":'60%'}, speed);
			  $(".navbar-brand img").css({"height":'auto'}, speed);
			   $(".navbar-default").css({"height":'50px'}, speed);
			   $(".menuon-top").hide().slideUp(370);
			  
		  }
		  
	  } else {
		  if(header == 1) {
			 header = 0;
			  $('#header-inner').stop().animate({ marginTop:'0px' },speed);
			  $("#header-main").css({backgroundColor:'transparent'}, speed);
			  $(".navbar-brand img").css({"max-width":'100%'}, speed);
		 $(".navbar-default").css({"height":'98px'}, speed);
		 $(".menuon-top").show().slideDown(370);
		 
			  
		  }  
	  }
  });
}

</script>
<?php /*?><script>
$('.navbar-default .navbar-nav > li.dropdown').hover(function() {
		$('ul.dropdown-menu', this).stop(true, true).slideDown(370);
		$(this).addClass('open');
	}, function() {
		$('ul.dropdown-menu', this).stop(true, true).slideUp(370);
		$(this).removeClass('open');
   });

</script><?php */?>
<script>
    $(document).ready(function() {

      $("#owl-demo2").owlCarousel({
        items : 4,
        lazyLoad : true,
        navigation : true
      });

    });
    </script> 
<script>
    $(document).ready(function() {
		  var owl = $("#owl-demo2");
		  owl.owlCarousel({
		  autoPlay: 1500,
		  items : 4, //10 items above 1000px browser width
		  itemsDesktop : [1000,4], //5 items between 1000px and 901px
		  itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
		  itemsTablet: [600,2], //2 items between 600 and 0;
		  itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
		  pagination:false
      });
      $(".nextone").click(function(){
          owl.trigger('owl.next');
      })
      $(".prevone").click(function(){
          owl.trigger('owl.prev');
      })
    });
</script> 
<script>
    $(document).ready(function() {

      $("#owl-demo").owlCarousel({
        items : 4,
        lazyLoad : true,
        navigation : true
      });

    });
    </script> 
<script>
    $(document).ready(function() {
		  var owl = $("#owl-demo");
		  owl.owlCarousel({
		  autoPlay: 1500,
		  items : 4, //10 items above 1000px browser width
		  itemsDesktop : [1000,4], //5 items between 1000px and 901px
		  itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
		  itemsTablet: [600,2], //2 items between 600 and 0;
		  itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
		  pagination:false
      });
      $(".next").click(function(){
          owl.trigger('owl.next');
      })
      $(".prev").click(function(){
          owl.trigger('owl.prev');
      })
    });
</script> 
<script>
$('.testimonial-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  arrows: false,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
$('.client-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 6,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4,
		 dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
		 dots: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
			
$('.people-rented').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 2500,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		 dots: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		 dots: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});				
				</script> 
<!-- side mnavigation bar--> 
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 

<!--   product gallery --> 
<script>
  jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 5000
        });
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});
 </script> 
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script> 
<script>
   $('ul.nav li.dropdown').hover(function() {
     $(this).find('.dropdown-menu').stop(true, true).delay(200).slideDown(500);
   }, function() {
     $(this).find('.dropdown-menu').stop(true, true).delay(200).slideUp(500);
   });
</script> 
<script>
    var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: true,    // optional scroll container selector, otherwise use window,
    resetAnimation: true,     // reset animation on end (default is true)
  }
);
wow.init();
</script> 
<script>
$(document).ready(function(){

var myNavBar = {

    flagAdd: true,

    elements: [],

    init: function (elements) {
        this.elements = elements;
    },

    add : function() {
        if(this.flagAdd) {
            for(var i=0; i < this.elements.length; i++) {
                document.getElementById(this.elements[i]).className += " fixed-theme";
            }
            this.flagAdd = false;
        }
    },

    remove: function() {
        for(var i=0; i < this.elements.length; i++) {
            document.getElementById(this.elements[i]).className =
                    document.getElementById(this.elements[i]).className.replace( /(?:^|\s)fixed-theme(?!\S)/g , '' );
        }
        this.flagAdd = true;
    }

};

/**
 * Init the object. Pass the object the array of elements
 * that we want to change when the scroll goes down
 */
myNavBar.init(  [
    "header",
    "header-container",
    "brand"
]);

/**
 * Function that manage the direction
 * of the scroll
 */
function offSetManager(){

    var yOffset = 0;
    var currYOffSet = window.pageYOffset;

    if(yOffset < currYOffSet) {
        myNavBar.add();
    }
    else if(currYOffSet == yOffset){
        myNavBar.remove();
    }

}

/**
 * bind to the document scroll detection
 */
window.onscroll = function(e) {
    offSetManager();
}

/**
 * We have to do a first detectation of offset because the page
 * could be load with scroll down set.
 */
offSetManager();
});
</script> 
<script>
$(document).ready(function(){
  $("a[data-toggle='tab']").click(function(e){
    $(".tab-content").css("border-color",$(this).css('backgroundColor'));
  });
});
</script> 
<script>
     $("#r11").on("click", function() {
  $(this)
    .parent()
    .find("a")
    .trigger("click");
});

$("#r12").on("click", function() {
  $(this)
    .parent()
    .find("a")
    .trigger("click");
});

</script> 
<script>
   var FormStuff = {    init: function() {    this.applyConditionalRequired();    this.bindUIActions();  },    bindUIActions: function() {    $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);  },    applyConditionalRequired: function() {        $(".require-if-active").each(function() {      var el = $(this);      if ($(el.data("require-pair")).is(":checked")) {        el.prop("required", true);      } else {        el.prop("required", false);      }    });      }  };FormStuff.init();
</script> 

<?php echo ($EXTRA_ARG ['footer_script'])?$conn->stripval($EXTRA_ARG ['footer_script']):""; ?> 