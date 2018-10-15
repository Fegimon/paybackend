<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$contact = $conn->select_query(TLINK,"*","tl_id='2'","1");
 if(isset($btn_sub))
{
	
	$name=$_REQUEST['name'];
	$mobile=$_REQUEST['mobile'];
	$email=$_REQUEST['mail'];
	$msg=$_REQUEST['message'];

		require 'mailer/PHPMailerAutoload.php';
		//SELLER HERE
		$to=$EXTRA_ARG['set_email'];
		$from=$_REQUEST['mail'];
		$uname=$_REQUEST['name'];
		
		$to1=$conn->variable($_REQUEST['mail']);
		$from1=$EXTRA_ARG['from_email'];
		$fromname1=SITE_NAME;
		include "mailcontent/enquirymail.php";
		
		$Alertsuccess="Enquiry Submited successfully. We will contact you soon ";
		$Alertsuccessurl=SITE_URL.'contact.html';
	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php include "seo-general.php";?>
     <?php  include "inner-header.php"; ?>
  </head>
  <body>
    <?php include 'menu.php';?>
<section id="inner-banner">
<img src="images/new-banner.png" class="img-responsive" alt=""/>
    <div class="container">
    <h1 class="banner-title"> Contact Us </h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Contact Us </li>
        </ol>
        
    </div>
    </div>
</section>


<section id="faq">
<div class="container">
        <div class="faq">
            <div class="terms">
      <div class="col-md-6 col-xs-12 col-sm-6 col-lg-6">
         <!--<div class="address">
            <h3>Address</h3>
             <p><b>PR Rental Solutions Pvt Ltd,</b> </p>
             <p>#24/53, Eldams Road, Teynampet, Chennai - 600018.</p>
             <p>+91 89395 81818 / 044 4863 8090</p>
			 <p>rent@payrentz.com</p>
             <p>www.payrentz.com</p>
             <h4>Branch Office: Chennai</h4>
             <p><b>PR Rental Solutions Pvt Ltd,(PayRentz)</b></p>
             <p>PayRentz, #232, Ground Floor, Mahatma Gandhi Road,</p>
             <p> Srinivasa Nagar, Velachery, Chennai - 600042.</p>
             <h4>Branch Office: Coimbatore</h4>
             <p><b>PR Rental Solutions Pvt Ltd,(PayRentz)</b></p>
             <p>PayRentz, No:13/18, New Scheme Colony,</p>
             <p> Kavundampalayam, Coimbatore – 641 030.</p>
             
               
            <p><i class="fa fa-phone" aria-hidden="true"></i><span> 044 3100 3040 / 044 3100 4050</span></p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i><span> rent@payrentz.com</span></p>
            <p><i class="fa fa-globe" aria-hidden="true"></i> www.payrentz.com</p>
            <!--<p><i class="fa fa-clock-o" aria-hidden="true"></i><span> Mon-Fri 9.30 AM - 7.00PM</span></p>-->
       <!--  </div>-->
          <?php echo  $contact['tl_content']; ?>
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
         <div class="address">
            <h3>Send us a message</h3>
            <form class="col-md-10" name="frm_contact" method="post">
               <div class="form-group">
                  <input type="text" class="form-control" name="name" required id="name" placeholder="Your Name" maxlength="100">
               </div>
               <div class="form-group">
                  <input type="email" class="form-control" required id="mail" name="mail" placeholder="Your Email" maxlength="100">
               </div>
               <div class="form-group">
                  <input type="text" class="form-control" required id="mobile" maxlength="15" name="mobile" placeholder="Phone Number">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="3" name="message" id="message" placeholder="Your Message"></textarea>
               </div>
               <button type="submit" name="btn_sub" id="btn_sub" class="btn btn-primary btn-red">Submit</button>
            </form>
         </div>
      </div>
      <div class="map">
         <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.9505209275003!2d80.24828691482271!3d13.038821490811785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52664ba0e35c8f%3A0x55ab3e8826f72ea6!2s24%2C+53%2C+Eldams+Rd%2C+Teynampet%2C+Chennai%2C+Tamil+Nadu+600018!5e0!3m2!1sen!2sin!4v1513945081475" width="100%" height="250" frameborder="0" style="border:0; margin-top:30px;" allowfullscreen=""></iframe>-->
          <?php echo  $contact['tl_map']; ?>
      </div>
   </div>
        </div>
  </div>
</section>

<?php include "footer.php"; ?>
  </body>
</html>