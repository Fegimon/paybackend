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
	
	
	 function GetImageExtension($imagetype)
   	 {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
		   case 'application/pdf': return '.pdf';
		  case 'application/msword': return $imagetype;
           default: return false;
       }
     }
	 
//id proof	 
	if (!empty($_FILES["id_proof_file"]["name"])) 

{
$up_dir="proof/";
	$file_name=$_FILES["id_proof_file"]["name"];
	$temp_name=$_FILES["id_proof_file"]["tmp_name"]; 
	$imgtype=$_FILES["id_proof_file"]["type"];
 $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path = "proof/".$imagename;
	$idproof=SITE_URL.$target_path;
}
else
{
	$idproof=$userdetails['id_proof']; 
}

//address proof
if (!empty($_FILES["current_address"]["name"])) 

{
$up_dir="proof/";
	$file_name=$_FILES["current_address"]["name"];
	$temp_name_add=$_FILES["current_address"]["tmp_name"]; 
	$imgtype=$_FILES["current_address"]["type"];
 $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path_add = "proof/".$imagename;
   $addidproof=SITE_URL.$target_path_add;
}
else
{
	$addidproof=$userdetails['current_address_proof']; 
}

//company proof
if (!empty($_FILES["company_id_card_file"]["name"])) 

{
$up_dir="proof/";
	$file_name=$_FILES["company_id_card_file"]["name"];
	$temp_name_comp=$_FILES["company_id_card_file"]["tmp_name"]; 
	$imgtype=$_FILES["company_id_card_file"]["type"];
 $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path_comp = "proof/".$imagename;
   $compidproof=SITE_URL.$target_path_comp;
}
else
{
	$compidproof=$userdetails['company_id_card']; 
}


//Visiting proof
if (!empty($_FILES["visiting_card_file"]["name"])) 

{
$up_dir="proof/";
	$file_name=$_FILES["visiting_card_file"]["name"];
	$temp_name_visit=$_FILES["visiting_card_file"]["tmp_name"]; 
	$imgtype=$_FILES["visiting_card_file"]["type"];
 $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path_visit = "proof/".$imagename;
   $visitidproof=SITE_URL.$target_path_visit;
}
else
{
	$visitidproof=$userdetails['visiting_card']; 
}

//Cancell leaf
if (!empty($_FILES["cancel_leaf"]["name"])) 

{
$up_dir="proof/";
	$file_name=$_FILES["cancel_leaf"]["name"];
	$temp_name_canc=$_FILES["cancel_leaf"]["tmp_name"]; 
	$imgtype=$_FILES["cancel_leaf"]["type"];
    $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path_canc = "proof/".$imagename;
    $cancelleaf=SITE_URL.$target_path_canc;
}
else
{
	$cancelleaf=$userdetails['cancel_leaf_file']; 
}

move_uploaded_file($temp_name, $target_path);	
move_uploaded_file($temp_name_comp, $target_path_comp);
move_uploaded_file($temp_name_add, $target_path_add);	
move_uploaded_file($temp_name_visit, $target_path_visit);
move_uploaded_file($temp_name_canc, $target_path_canc);

      $arr=array('id_proof'=>$idproof,'company_id_card'=>$compidproof,'current_address_proof'=>$addidproof,'visiting_card'=>$visitidproof,'cancel_leaf_file'=>$cancelleaf);
	  
      $ins=$conn->update(USER,"user_id='".$uid."'",$arr);
	  
	   if($ins)
		{
			$userlog = $conn->select_query(USER,"*","user_id='".$uid."'","1");
			//insert login histroy
			$larr=array('user_id'=>$userlog['user_id'],'upd_type'=>'Document Required','user_first_name'=>$userlog['user_first_name'],'user_last_name'=>$userlog['user_last_name'],'dob'=>$userlog['dob'],'user_gender'=>$userlog['user_gender'],'marital_Status'=>$userlog['marital_Status'],'user_mobile'=>$userlog['user_mobile'],'secondary_contact'=>$userlog['secondary_contact'],'user_email'=>$userlog['user_email'],'secondary_email'=>$userlog['secondary_email'],'permanent_flat_no'=>$userlog['permanent_flat_no'],'permanent_floor_no'=>$userlog['permanent_floor_no'],'permanent_street_road_name'=>$userlog['permanent_street_road_name'],'permanent_area'=>$userlog['permanent_area'],'permanent_pin_code'=>$userlog['permanent_pin_code'],'permanent_city'=>$userlog['permanent_city'],'permanent_state'=>$userlog['permanent_state'],'checksame'=>$userlog['checksame'],'user_primary_address'=>$userlog['user_primary_address'],'floor_no'=>$userlog['floor_no'],'street_road_name'=>$userlog['street_road_name'],'area'=>$userlog['area'],'pin_code'=>$userlog['pin_code'],'city'=>$userlog['city'],'state'=>$userlog['state'],'residence_status'=>$userlog['residence_status'],'company_name'=>$userlog['company_name'],'designation'=>$userlog['designation'],'department'=>$userlog['department'],'Official_email'=>$userlog['Official_email'],'company_address'=>$userlog['company_address']	,'reference_name1'=>$userlog['reference_name1'],'reference_name2'=>$userlog['reference_name2'],'Reference1_email1'=>$userlog['Reference1_email1'],'Reference2_email2'=>$userlog['Reference2_email2'],'Reference1_adress'=>$userlog['Reference1_adress'],'Reference2_adress'=>$userlog['Reference2_adress'],'Reference1_contact'=>$userlog['Reference1_contact'],'Reference2_contact'=>$userlog['Reference2_contact'],'id_proof_type'=>$userlog['id_proof_type'],'id_proof'=>$userlog['id_proof'],'address_proof_type'=>$userlog['address_proof_type'],'current_address_proof'=>$userlog['current_address_proof'],'company_id_card'=>$userlog['company_id_card'],'visiting_card'=>$userlog['visiting_card'],'bank_cancel'=>$userlog['bank_cancel'],'holder_name'=>$userlog['holder_name'],'acco_no'=>$userlog['acco_no'],'name_of_the_bank'=>$userlog['name_of_the_bank'],'ifsc_code'=>$userlog['ifsc_code'],'cancel_leaf_file'=>$userlog['cancel_leaf_file'],'dob'=>$userlog['dob'],'user_dt'=>NOW);
			
			$logins = $conn->insert(PROFILEHISTROY,"",$larr);
			
			$change='Document Required Details - '.$userlog['payrentz_unique'] ;
			
			  require 'mailer/PHPMailerAutoload.php';
              include "mailcontent/profilechange.php";
			  
		}
		 header("location:".SITE_URL."my-profile.html");
	
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
          <a href="<?php echo SITE_URL; ?>personal-details.html" class="btn btn-default"> 1. Personal Details</a> 
          <a href="<?php echo SITE_URL; ?>professional-details.html" class="btn btn-default"> 2. Professional Details</a>
           <a href="<?php echo SITE_URL; ?>reference-details.html" class="btn btn-default"> 3. Reference Details</a> 
       <a href="<?php echo SITE_URL; ?>documents-required.html" class="btn btn-success active">4. Documents Required </a>
           
            <?php /*?><a href="#" class="btn btn-default"> 3. Rental Requirements</a><?php */?>
          </div>
          <div>&nbsp;</div>
        </div>
      </div>
      <div class="personal-detail-form text-heading-profile">
        <h3>Documents Required - <?php echo $conn->stripval($userdetails['payrentz_unique']);?></h3>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-paddnig">
        <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="id-proof"><strong>ID Proof </strong></label>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="aadhar-card">Select Id Proof</label>
                <select name="id_proof_type" class="selectpicker">
                  <option value="Passport"  <?php echo $conn->isselected('Passport',$userdetails['id_proof_type']);?>>Passport</option>
                  <option value="Aadhar"  <?php echo $conn->isselected('Aadhar',$userdetails['id_proof_type']);?>>Aadhar Card </option>
                  <option value="Pan"  <?php echo $conn->isselected('Pan',$userdetails['id_proof_type']);?>>Pan Card </option>
                  <option value="Driving"  <?php echo $conn->isselected('Driving',$userdetails['id_proof_type']);?>>Driving Licence</option>
                </select>
              </div>
 
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label class="lable-style-3" for="passport"> <?php if($userdetails['id_proof']!=''){?>
             <a download="<?php echo  $userdetails['id_proof']; ?>" href="<?php echo  $userdetails['id_proof']; ?>" title="Download">Download ID Proof <i class="fa fa-download"></i></a>
              <?php }?></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="id_proof_file" id="id_proof_file" <?php if($userdetails['id_proof']==''){?> required <?php }?>>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="id-proof"><strong>Current Address Proof </strong></label>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="aadhar-card">Select Id Proof</label>
                <select name="address_proof_type" class="selectpicker">
<option value="Rental"  <?php echo $conn->isselected('Rental',$userdetails['address_proof_type']);?>>Rental Agreement</option>
<option value="Aadhar"  <?php echo $conn->isselected('Aadhar',$userdetails['address_proof_type']);?>>Aadhar Card </option>
<option value="Utility"  <?php echo $conn->isselected('Utility',$userdetails['address_proof_type']);?>>Utility Bill</option>
<option value="Driving"  <?php echo $conn->isselected('Driving',$userdetails['address_proof_type']);?>>Driving Licence</option>
                </select>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label class="lable-style-3" for="pan-card"> <?php if($userdetails['current_address_proof']!=''){?>
             <a download="<?php echo  $userdetails['current_address_proof']; ?>" href="<?php echo  $userdetails['current_address_proof']; ?>" title="Download">Download Address Proof <i class="fa fa-download"></i></a>
              <?php }?></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="current_address" id="inputGroupFile01" <?php if($userdetails['current_address_proof']==''){?> required <?php } ?>>
                </div>
               
              </div>
            </div>
          </div>
          <div class="clear-fix"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
             <div>&nbsp;</div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="inputGroupFile01">Company ID Card</label> <label class="label-style" for="inputGroupFile01"> <?php if($userdetails['company_id_card']!=''){?><a download="<?php echo  $userdetails['company_id_card']; ?>" href="<?php echo  $userdetails['company_id_card']; ?>" title="Download">Download Company Proof <i class="fa fa-download"></i></a><?php }?></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"  name="company_id_card_file" id="company_id_card_file" value="<?php echo  $userdetails['company_id_card']; ?>">
                </div>
              </div>
              <div>&nbsp;</div>
              
              
              
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="visiting-card ">Visiting Card (Optional) </label> <label class="label-style-1" for="visiting-card ">  <?php if($userdetails['visiting_card']!=''){?>
             
             <a download="<?php echo  $userdetails['visiting_card']; ?>" href="<?php echo  $userdetails['visiting_card']; ?>" title="Download">Download Visiting Proof <i class="fa fa-download"></i></a>
          
              <?php }?></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"  name="visiting_card_file" id="visiting_card_file" value="<?php echo  $userdetails['visiting_card']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <style type="text/css">
  body {
  font-family: arial;
}
.hide {
  display: none;
}
p {
  font-weight: bold;
}
</style>
                <br>
                <input type="radio" name="bank_detail" value="bank" onclick="show1();" <?php echo $conn->ischecked('bank',$userdetails['bank_detail']);?> />
                Bank Details
                <input type="radio" name="bank_detail" value="cancelled" onclick="show2();" <?php echo $conn->ischecked('cancelled',$userdetails['bank_detail']);?> />
                Cancelled Cheque leaf
                <!--<div id="div1 cancell" class="hide">
                  <input type="checkbox" value="Yes" name="one">
                  <input type="checkbox" value="Yes" name="two">
                  Cancelled </div>-->
              </div>
               <div id="cancell">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="visiting-card ">Cancelled Cheque leaf </label> <label class="label-style-1" for="visiting-card ">  <?php if($userdetails['cancel_leaf_file']!=''){?>
             
             <a download="<?php echo  $userdetails['cancel_leaf_file']; ?>" href="<?php echo  $userdetails['cancel_leaf_file']; ?>" title="Download">Download Visiting Proof <i class="fa fa-download"></i></a>
          
              <?php }?></label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"  name="cancel_leaf" id="cancel_leaf" >
                </div>
              </div>
              </div>
              <div id="bank">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="passport">Account Holder Name </label>
                <div class="custom-file">
                  <input type="name-1" class="form-control" id="holder_name" name="holder_name"  value="<?php echo  $userdetails['holder_name']; ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="pan-card">Account Number</label>
                <div class="custom-file">
                  <input type="name-1" name="acco_no" class="form-control"  id="acco_no" value="<?php echo  $userdetails['acco_no']; ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="driving-licence">Name of Bank </label>
                <div class="custom-file">
                  <input type="text" class="form-control"   name="name_of_the_bank" id="  name_of_the_bank" value="<?php echo  $userdetails['name_of_the_bank']; ?>"/>
                </div>
              </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label for="pan-card">IFSC code</label>
              <div class="custom-file">
                <input type="text" class="form-control"  id="ifsc_code" name="ifsc_code" value="<?php echo  $userdetails['ifsc_code']; ?>">
              </div>
            </div>
            </div>
          </div>
          </div>
          <div> &nbsp;</div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left"> 
               <input type="checkbox" name="vehicle1" value="Bike" required><a href="<?php echo SITE_URL; ?>termscondition.html" target="_blank" >&nbsp;  I Accept Terms and Conditions.</a>
            </div>
          </div>
          <div>&nbsp;</div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left"> <a  href="reference-details.php" class="btn btn-success btn-md">Previous</a> </div>
            <div class="pull-right">
              <input class="input-btn-style" type="submit" name="btn_update" id="btn_update" value="Submit">
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
<script type="text/javascript">
  function validateForm() {
    var x = document.forms["myForm"]["id_proof"].value;
    if (x == "") {
        alert("Select Id Proof must be filled out");
        return false;
    }


var x = document.forms["myForm"]["current_address"].value;
    if (x == "") {
        alert("Select Current Address must be filled out");
        return false;
    }


}
function show1(){
  //document.getElementById('div1').style.display ='none';
  $("#bank").show();
 $("#cancell").hide();
}
function show2(){
 // document.getElementById('div1').style.display = 'block';
 $("#bank").hide();
 $("#cancell").show();
}
<?php if($userdetails['bank_detail']=='bank'){?>
 $("#bank").show();
 $("#cancell").hide();
<?php }else{?>
 $("#bank").hide();
 $("#cancell").show();
 <?php }?>
</script>