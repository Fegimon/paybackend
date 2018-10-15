<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$catslug= $conn->variable($_REQUEST['cat_slug']);

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$che_category = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");
//echo $catslug; exit;
if(!$che_category['nr'] && !empty($catslug)){
  $conn->divert(SITE_URL);
}

if($catslug){
  $website = SITE_URL.'listing/'.$catslug.'.html?type=cat';
} else {
  $website = SITE_URL.'listing?type=cat';
}

if(isset($_COOKIE["current_location"])) { 
  $paging = $EXTRA_ARG['set_fpsize'];
  $cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
  if($che_category['nr']){
    $cond .= " AND find_in_set('".$che_category['cat_id']."',p.p_category) <> 0";
  }
 
  $product_details = $conn->pagination(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) ","*",$cond,"p.p_id asc",$website,$paging,$_GET['page']);
}
//print_r($product_details); exit;

$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
  
}

if(isset($btn_update))
{
      $arr=array();
      $ins=$conn->update(USER,"user_id='".$uid."'",$arr);
}


$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
  
}
if(isset($btn_update))
{
      $arr=array();
      $ins=$conn->update(USER,"user_id='".$uid."'",$arr);
	   if($ins)
		{
			$userlog = $conn->select_query(USER,"*","user_id='".$uid."'","1");
			//insert login histroy
			$larr=array('user_id'=>$userlog['user_id'],'upd_type'=>'Professional Details','user_first_name'=>$userlog['user_first_name'],'user_last_name'=>$userlog['user_last_name'],'dob'=>$userlog['dob'],'user_gender'=>$userlog['user_gender'],'marital_Status'=>$userlog['marital_Status'],'user_mobile'=>$userlog['user_mobile'],'secondary_contact'=>$userlog['secondary_contact'],'user_email'=>$userlog['user_email'],'secondary_email'=>$userlog['secondary_email'],'permanent_flat_no'=>$userlog['permanent_flat_no'],'permanent_floor_no'=>$userlog['permanent_floor_no'],'permanent_street_road_name'=>$userlog['permanent_street_road_name'],'permanent_area'=>$userlog['permanent_area'],'permanent_pin_code'=>$userlog['permanent_pin_code'],'permanent_city'=>$userlog['permanent_city'],'permanent_state'=>$userlog['permanent_state'],'checksame'=>$userlog['checksame'],'user_primary_address'=>$userlog['user_primary_address'],'floor_no'=>$userlog['floor_no'],'street_road_name'=>$userlog['street_road_name'],'area'=>$userlog['area'],'pin_code'=>$userlog['pin_code'],'city'=>$userlog['city'],'state'=>$userlog['state'],'residence_status'=>$userlog['residence_status'],'company_name'=>$userlog['company_name'],'designation'=>$userlog['designation'],'department'=>$userlog['department'],'Official_email'=>$userlog['Official_email'],'company_address'=>$userlog['company_address']	,'reference_name1'=>$userlog['reference_name1'],'reference_name2'=>$userlog['reference_name2'],'Reference1_email1'=>$userlog['Reference1_email1'],'Reference2_email2'=>$userlog['Reference2_email2'],'Reference1_adress'=>$userlog['Reference1_adress'],'Reference2_adress'=>$userlog['Reference2_adress'],'Reference1_contact'=>$userlog['Reference1_contact'],'Reference2_contact'=>$userlog['Reference2_contact'],'id_proof_type'=>$userlog['id_proof_type'],'id_proof'=>$userlog['id_proof'],'address_proof_type'=>$userlog['address_proof_type'],'current_address_proof'=>$userlog['current_address_proof'],'company_id_card'=>$userlog['company_id_card'],'visiting_card'=>$userlog['visiting_card'],'bank_cancel'=>$userlog['bank_cancel'],'holder_name'=>$userlog['holder_name'],'acco_no'=>$userlog['acco_no'],'name_of_the_bank'=>$userlog['name_of_the_bank'],'ifsc_code'=>$userlog['ifsc_code'],'cancel_leaf_file'=>$userlog['cancel_leaf_file'],'dob'=>$userlog['dob'],'user_dt'=>NOW);
			
			$logins = $conn->insert(PROFILEHISTROY,"",$larr);
			
			$change='Professional Details - '.$userlog['payrentz_unique'] ;
			
			  require 'mailer/PHPMailerAutoload.php';
              include "mailcontent/profilechange.php";
		}
	   header("location:".SITE_URL."reference-details.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-general.php";?>
<?php include "header.php"; ?>
<base href="<?php echo SITE_URL; ?>">
<?php include "tracker.php"; ?>
</head>
<body>
<div class="main">
<section id="">
   <?php include 'menu.php';?>
</section>

<section id="inner-header" >
<div class="sub-page-category-inner">
  <div class="container-fluid">
    <div class="pull-left">
      <ol class="breadcrumb">
        <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
        <li class="active">Professional Details</li>
      </ol>
    </div>
    
  </div>
  </div>
</section>
<div class="clear-fix"></div>


  
  <!-- ================================================================ -->
  

      
<section id="product-llisting">
  <div class="container-fluid">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="text-center">
     <div class="btn-group btn-breadcrumb breadcrumb-color">
         
            <a href="<?php echo SITE_URL; ?>personal-details.html" class="btn btn-default "> 1. Personal Details</a>
   <a href="<?php echo SITE_URL; ?>professional-details.html" class="btn btn-success active"> 2. Professional Details</a>
             <a href="<?php echo SITE_URL; ?>reference-details.html" class="btn btn-default"> 3. Reference Details</a>
             <a href="<?php echo SITE_URL; ?>documents-required.html" class="btn btn-default"> 4. Documents Required </a>
            <?php /*?><a href="#" class="btn btn-default"> 3. Rental Requirements</a><?php */?>
           
        </div>
<div>&nbsp;</div>
</div>
     </div>
      <div class="personal-detail-form text-heading-profile">
      <h3>Professional Details - <?php echo $conn->stripval($userdetails['payrentz_unique']);?></h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      

         <form  name="reg_update" id="reg_update" method="post">
  <div class="form-group">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="company-name">Company Name<span></span></label>
    <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo  $userdetails['company_name']; ?>">
  </div>
  </div>
  
  <div class="form-group">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="company-name">Designation <span></span></label>
    <input type="text" class="form-control" name="designation"  id="designation" value="<?php echo  $userdetails['designation']; ?>">
  </div>
  </div>
    <div class="form-group">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="company-name">Department <span></span></label>
    <input type="text" class="form-control" name="department" id="department" value="<?php echo  $userdetails['department']; ?>">
  </div>
  </div>
  
  <div class="form-group">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="official-email"> Official Email <span>*</span></label>
    <input type="official-email" name="Official_email" required class="form-control" id="Official_email" value="<?php echo  $userdetails['Official_email']; ?>">
  </div>
  </div>
<div class="form-group">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="exampleTextarea">Company Address <span>*</span></label>
    <textarea class="form-control" required id="company_address" name="company_address"><?php echo  $userdetails['company_address']; ?></textarea>
  </div>
  </div>
  
    <div> &nbsp;</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="pull-left">
   <a  href="personal-details.php" class="btn btn-success btn-md">Previous</a>
     </div>
     <div class="pull-right">
   <button type="submit"  name="btn_update"id="btn_professional"  class="btn btn-primary btn-red">Update</button>
     </div>
     
     </div>
  
</form>
      </div>
      </div>
        
    </div>
  </div>
  
  
  
  
  
  
  </div>
  </div>
</section>
<?php include "footer.php"; ?>
 </body>
</html>

