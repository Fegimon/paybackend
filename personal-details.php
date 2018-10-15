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
	$chkadd = $conn->select_query(USER,"*","user_id='".$uid."'","1");
	if($chkadd['user_primary_address']=='' && $chkadd['pin_code']=='0' && $chkadd['state']=='' && $chkadd['city']=='')
	{
		$state = $conn->select_query(STATE,"*","name LIKE '%".$state."%'","1");
		
	$arradd=array('firstname'=>$_SESSION['prentz_user_name'],'address_1'=>$user_primary_address.','.$floor_no.','.$street_road_name.','.$area,'email_id'=>$user_email,'mobile_no'=>$user_mobile,'city'=>$city,'postcode'=>$pin_code,'state_id'=>$state['zone_id'],'address_status'=>'Y','customer_id'=>$uid);
  $insadd=$conn->insert(USERADDRESS,"",$arradd);
	}
      $arr=array('checksame'=>$check);
      $ins=$conn->update(USER,"user_id='".$uid."'",$arr);
	  
	  if($ins)
		{
			$userlog = $conn->select_query(USER,"*","user_id='".$uid."'","1");
			//insert login histroy
			$larr=array('user_id'=>$userlog['user_id'],'upd_type'=>'Personal Details','user_first_name'=>$userlog['user_first_name'],'user_last_name'=>$userlog['user_last_name'],'dob'=>$userlog['dob'],'user_gender'=>$userlog['user_gender'],'marital_Status'=>$userlog['marital_Status'],'user_mobile'=>$userlog['user_mobile'],'secondary_contact'=>$userlog['secondary_contact'],'user_email'=>$userlog['user_email'],'secondary_email'=>$userlog['secondary_email'],'permanent_flat_no'=>$userlog['permanent_flat_no'],'permanent_floor_no'=>$userlog['permanent_floor_no'],'permanent_street_road_name'=>$userlog['permanent_street_road_name'],'permanent_area'=>$userlog['permanent_area'],'permanent_pin_code'=>$userlog['permanent_pin_code'],'permanent_city'=>$userlog['permanent_city'],'permanent_state'=>$userlog['permanent_state'],'checksame'=>$userlog['checksame'],'user_primary_address'=>$userlog['user_primary_address'],'floor_no'=>$userlog['floor_no'],'street_road_name'=>$userlog['street_road_name'],'area'=>$userlog['area'],'pin_code'=>$userlog['pin_code'],'city'=>$userlog['city'],'state'=>$userlog['state'],'residence_status'=>$userlog['residence_status'],'company_name'=>$userlog['company_name'],'designation'=>$userlog['designation'],'department'=>$userlog['department'],'Official_email'=>$userlog['Official_email'],'company_address'=>$userlog['company_address']	,'reference_name1'=>$userlog['reference_name1'],'reference_name2'=>$userlog['reference_name2'],'Reference1_email1'=>$userlog['Reference1_email1'],'Reference2_email2'=>$userlog['Reference2_email2'],'Reference1_adress'=>$userlog['Reference1_adress'],'Reference2_adress'=>$userlog['Reference2_adress'],'Reference1_contact'=>$userlog['Reference1_contact'],'Reference2_contact'=>$userlog['Reference2_contact'],'id_proof_type'=>$userlog['id_proof_type'],'id_proof'=>$userlog['id_proof'],'address_proof_type'=>$userlog['address_proof_type'],'current_address_proof'=>$userlog['current_address_proof'],'company_id_card'=>$userlog['company_id_card'],'visiting_card'=>$userlog['visiting_card'],'bank_cancel'=>$userlog['bank_cancel'],'holder_name'=>$userlog['holder_name'],'acco_no'=>$userlog['acco_no'],'name_of_the_bank'=>$userlog['name_of_the_bank'],'ifsc_code'=>$userlog['ifsc_code'],'cancel_leaf_file'=>$userlog['cancel_leaf_file'],'dob'=>$userlog['dob'],'user_dt'=>NOW);
			
			$logins = $conn->insert(PROFILEHISTROY,"",$larr);
			
			$change='Personal Details - '.$userlog['payrentz_unique'] ;
			
			  require 'mailer/PHPMailerAutoload.php';
              include "mailcontent/profilechange.php";
		}
		header("location:".SITE_URL."professional-details.html");
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
        <li class="active">Personal Details</li>
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
           
           <a href="<?php echo SITE_URL; ?>personal-details.html" class="btn btn-success active"> 1. Personal Details</a>
         <a href="<?php echo SITE_URL; ?>professional-details.html" class="btn btn-default"> 2. Professional Details</a>
             <a href="<?php echo SITE_URL; ?>reference-details.html" class="btn btn-default"> 3. Reference Details</a>
             <a href="<?php echo SITE_URL; ?>documents-required.html" class="btn btn-default"> 4. Documents Required </a>
            <?php /*?><a href="#" class="btn btn-default"> 3. Rental Requirements</a><?php */?>
           
        </div>

<div>&nbsp;</div>
</div>

        


     </div>
      <div class="personal-detail-form text-heading-profile">
      <h3>Personal Details - <?php echo $conn->stripval($userdetails['payrentz_unique']);?></h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



     <form class="form-horizontal" name="reg_update" id="reg_update" method="post">
  <div class="form-group">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<label for="name">First Name </label>
    <input type="text" name="user_first_name" required class="form-control" id="user_first_name" placeholder="First Name" value="<?php echo  $userdetails['user_first_name']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <label for="name">Last Name </label>
    <input type="text" class="form-control" id="user_last_name"  name="user_last_name" placeholder="Last Name" value="<?php echo  $userdetails['user_last_name']; ?>">
  </div>
  </div>

  <div class="form-group">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <label for="dob">Date of Birth <span>*</span></label>
 <input id="input-date" type="date"  name="dob" id="dob" class="form-control" value="<?php echo  $userdetails['dob']; ?>">
    </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <label for="dob">Gender <span>*</span></label>
    <br>

    <label class="radio-inline">
      <input type="radio" required name="user_gender" value="MALE"  <?php echo $conn->ischecked('MALE',$userdetails['user_gender']);?>/>M
    </label>
    <label class="radio-inline">
      <input type="radio" name="user_gender" value="FEMALE"  <?php echo $conn->ischecked('FEMALE',$userdetails['user_gender']);?>>F
    </label>



    </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <label for="dob">Marital Status <span>*</span></label>
    <br>

    <label class="radio-inline">
      <input type="radio" name="marital_Status" value="S" <?php echo $conn->ischecked('S',$userdetails['marital_Status']);?>/>Single
    </label>

    <label class="radio-inline">
      <input type="radio" name="marital_Status" value="M" <?php echo $conn->ischecked('M',$userdetails['marital_Status']);?>>Married
    </label>



    </div>
    </div>
    
        
<div class="clear-fix"></div>
    
      <div class="form-group">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-1">Primary Contact</label>
    <input type="mobile-1" name="user_mobile" readonly  required="" id="user_mobile" class="form-control" id="mobile-1" value="<?php echo  $userdetails['user_mobile']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">Secondary contact</label>
    <input type="mobile-2" class="form-control" id="mobile-2" name="secondary_contact" id="secondary_contact" value="<?php echo  $userdetails['secondary_contact']; ?>">
  </div>
  </div>

  <div class="form-group">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-1">Primary Email <span>*</span></label>
    <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo  $userdetails['user_email']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2"> Secondary Email </label>
    <input type="text" class="form-control" name="secondary_email" id="secondary_email" value="<?php echo  $userdetails['secondary_email']; ?>">
  </div>
  </div>
  
    
<div class="clear-fix"></div>
<div class="form-group">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <label for=""><strong> Permanent Address</strong> <span>*</span>  </label>&nbsp;<?php /*?><label><input type="checkbox" value=""></label><?php */?>
   
   </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="mobile-1"> Door No/Flat No/Apartment Name</label>
    <input type="text" class="form-control" id="mobile-1" name="permanent_flat_no" id="permanent_flat_no" value="<?php echo  $userdetails['permanent_flat_no']; ?>">
  </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <label for="mobile-2">Floor No</label>
    <input type="text" class="form-control" id="permanent_floor_no" name="permanent_floor_no" value="<?php echo  $userdetails['permanent_floor_no']; ?>">
  </div>
  
   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <label for="mobile-2">Street Name / Road Name</label>
    <input type="street-name" class="form-control" name="permanent_street_road_name" id="permanent_street_road_name" value="<?php echo  $userdetails['permanent_street_road_name']; ?>">
  </div>
  
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">Area</label>
    <input type="text" class="form-control"  name="permanent_area" id="permanent_area" value="<?php echo  $userdetails['permanent_area']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">Pin code</label>
    <input type="text" class="form-control"  name="permanent_pin_code" id="permanent_pin_code" value="<?php echo  $userdetails['permanent_pin_code']; ?>">
  </div>
  <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">City</label>
    <select class="selectpicker">
  <option>Chennai</option>
  <option>Vellore</option>
  <option>Trichy</option>
</select>

  </div>-->
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">City</label>
    <input type="text" class="form-control"  name="permanent_city" id="permanent_city" value="<?php echo  $userdetails['permanent_city']; ?>">
  </div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">State</label>
    <input type="text" class="form-control"  name="permanent_state" id="permanent_state" value="<?php echo  $userdetails['permanent_state']; ?>">
  </div>
  
  </div>


  
  <div class="clear-fix"></div>
  <div class="form-group">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <label for=""><strong> Communication Address</strong> <span>*</span></label>
     <span class="material-switch "> <!--someSwitchOption001-->
                            <input id="someSwitchOptionSuccess" name="check" type="checkbox" id="check" value="Y" onClick="fnvalid();" <?php if($userdetails['checksame']=="Y"){ ?>checked="checked"<?php } ?> />
                            <label for="someSwitchOptionSuccess" class="label-success"></label>
                        </span>   
   </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="mobile-1"> Door No/Flat No/Apartment Name</label>
    <input type="text" class="form-control" name="user_primary_address" id="user_primary_address" value="<?php echo  $userdetails['user_primary_address']; ?>">
  </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <label for="mobile-2">Floor No</label>
    <input type="text" class="form-control" name="floor_no" id="floor_no"  value="<?php echo  $userdetails['floor_no']; ?>">
  </div>
  
   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <label for="mobile-2">Street Name / Road Name</label>
    <input type="text" class="form-control" name="street_road_name" id="street_road_name" value="<?php echo  $userdetails['street_road_name']; ?>">
  </div>
  
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">Area</label>
    <input type="text" class="form-control" name="area" id="area" value="<?php echo  $userdetails['area']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">Pin code</label>
    <input type="text" class="form-control" name="pin_code" id="pin_code" value="<?php echo  $userdetails['pin_code']; ?>">
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">City</label>
    <input type="text" class="form-control" name="city" id="city" value="<?php echo  $userdetails['city']; ?>">
  </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="mobile-2">State</label>
    <input type="text" name="state" id="state" class="form-control" id="state" value="<?php echo  $userdetails['state']; ?>">
  </div>
  
  </div>
 
<div class="clear-fix"></div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="dob">Residence Status</label>
    <br>

<div class="btn-group btn-group-toggle " data-toggle="buttons">
  <label class="btn btn-secondary <?php if($userdetails['residence_status']=='Owned'){?>active <?php }?>">
    <input type="radio" name="residence_status" id="residence_status1" autocomplete="off" value="Owned" 
	> Owned
  </label>
  <label class="btn btn-secondary <?php if($userdetails['residence_status']=='Rented'){?>active <?php }?>">
    <input type="radio" name="residence_status" id="residence_status2" value="Rented" autocomplete="off"> Rented
  </label>
  <label class="btn btn-secondary <?php if($userdetails['residence_status']=='Co-lease'){?>active <?php }?>">
    <input type="radio" name="residence_status" id="residence_status3" value="Co-lease" autocomplete="off"> Co-lease
  </label>
  <label class="btn btn-secondary <?php if($userdetails['residence_status']=='Others'){?>active <?php }?>">
    <input type="radio" name="residence_status" id="residence_status4" value="Others" autocomplete="off" >Others
  </label>
</div>
    </div>
    <div> &nbsp;</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="pull-right">
   <button type="submit"  name="btn_update" id="btn_personal"  class="btn btn-primary btn-red">Update</button>
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

<script language="javascript" type="text/javascript">
function fnvalid()
{
	
	if(document.reg_update.check.checked==true)
	{
	   document.reg_update.user_primary_address.value=document.reg_update.permanent_flat_no.value;
	   document.reg_update.floor_no.value=document.reg_update.permanent_floor_no.value;
	   document.reg_update.street_road_name.value=document.reg_update.permanent_street_road_name.value;
	   document.reg_update.area.value=document.reg_update.permanent_area.value;
	   document.reg_update.pin_code.value=document.reg_update.permanent_pin_code.value;
	   document.reg_update.city.value=document.reg_update.permanent_city.value;
	   document.reg_update.state.value=document.reg_update.	permanent_state.value;
	  
	}
	else
	{
	   document.reg_update.user_primary_address.value="";
	   document.reg_update.floor_no.value="";
	   document.reg_update.street_road_name.value="";
	   document.reg_update.area.value="";
	   document.reg_update.pin_code.value="";
	   document.reg_update.city.value="";
	   document.reg_update.state.value="";
	  
	}
	
}
</script>
 </body>
</html>

