<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();
#Page Config
include "pageconfig.php"; //print_r($_POST);exit;

#Fetch value
$id = $conn->variable($q);
$sel = $conn->select_query(USER,"*","user_id='".$id."'","1");

$sel_address = $conn->select_query(USERADDRESS,"*","customer_id='". $id ."' AND address_status = 'Y'",""); //print_r($sel_address);


if(!$sel['nr'])
{
	$conn->divert(ADMIN_URL.$path_folder.'list.php');
}

if(isset($btn_sub))
{
		$new=array('user_name'=>$user_name, 'user_email'=>$user_email, 'user_pwd'=>$user_pwd);
		$ins = $conn->update(USER,"user_id='".$id."'",$new);

    if (isset($_POST['address'])) { //print_r($_POST['address']);exit;

      $delete = $conn->Execute("UPDATE ".USERADDRESS." set address_status = 'D' WHERE customer_id = '".$id."'");

      $new_add = array();

      foreach ($_POST['address'] as $address) { 

        $new_add = array('customer_id' => $id, 'firstname' => $address['firstname'], 'lastname' => $address['lastname'], 'address_1' => $address['address1'], 'address_2' => $address['address2'], 'city' => $address['city'], 'postcode' => $address['postcode'], 'country_id' => $address['country'], 'address_status' => 'Y', 'created_dt' => NOW);

       $ins_address = $conn->insert(USERADDRESS,"",$new_add);

       $lastid = mysql_insert_id();

        if (isset($address['default'])) {
          $new=array('user_primary_address'=>$lastid);
          $ins = $conn->update(USER,"user_id='".$id."'",$new);
        }
      }

    }

    if($ins || $ins_address)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
      $conn->divert($rpage);
    }


}

$country_details = $conn->select_query(COUNTRY,"*","status='1'","");
?>
<?php #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>
<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $Pagetitle['title']; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $Pagetitle['title']; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <?php if($errAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $errAlert; ?> </div>
          <?php }?>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title  text-navy">Edit <?php echo $Pagetitle['title']; ?></h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data">
                <div class="pull-right">
                <button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button>
              <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>

                <ul class="nav nav-tabs">
            <li class="active"><a href = "#tab-general" data-toggle = "tab">General</a></li>
            
            <li><a href="#tab-address" data-toggle="tab">Address</a></li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              
                <!-- text input -->
                <div class="form-group">
                  <label>User Name <span class="text-red">*</span></label>
                  <input  name="user_name" id="user_name" type="text" class="form-control validate[required]" placeholder="Enter Name" maxlength="200" value="<?php echo $conn->stripval($sel['user_name']);?>" />
                </div>
				<div class="form-group">
                  <label>User Email <span class="text-red">*</span></label>
                  <input  name="user_email" id="user_email" type="text" class="form-control validate[required]" placeholder="Enter Email" maxlength="200" value="<?php echo $conn->stripval($sel['user_email']);?>" />
				  </div>
                  
                  <div class="form-group">
                  <label>Payrentz Unique Id<span class="text-red">*</span></label>
                  <input  name="payrentz_unique" id="payrentz_unique" type="text" class="form-control" placeholder="Enter Payrentz Unique Id" maxlength="200" value="<?php echo $conn->stripval($sel['payrentz_unique']);?>" />
				  </div>
                  
                <div class="form-group">
                  <label>Password <span class="text-red">*</span></label>
                  <input name="user_pwd" id="user_pwd" type="text" class="form-control validate[required]" placeholder="Enter Password" maxlength="200" value="<?php echo $conn->stripval($sel['user_pwd']);?>" />
                </div>

                <?php /* ?>
				<div class="form-group">
                  <label>Age <span class="text-red">*</span></label>
                  <input name="user_age" id="user_age" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Age" maxlength="2"  value="<?php echo $conn->stripval($sel['user_age']);?>" />
                </div>
				<div class="form-group">
                  <label>Country <span class="text-red">*</span></label>
                    <select name="user_country" id="user_country" class="form-control validate[required]">
                      <?php foreach ($country_details['result'] as $key => $value) { 
                         if($value['country_id']== $sel['user_country']){ 
                        ?>
                        <option value="<?php echo $value['country_id']; ?>" selected><?php echo $value['name']; ?></option>
                        <?php } else { ?>                        
                        <option value="<?php echo $value['country_id']; ?>" ><?php echo $value['name']; ?></option>
                      <?php } } ?>
                    </select>
                </div>
				<div class="form-group">
                  <label>City <span class="text-red">*</span></label>
                  <input name="user_city" id="user_city" type="text" class="form-control validate[required] " placeholder="Enter City" maxlength="200"  value="<?php echo $conn->stripval($sel['user_city']);?>" />
                </div>

                <?php */ ?>
			               <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                  </center>
                </div>

            </div>


            <div class="tab-pane" id="tab-address">

              <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="address">
                    
                    <?php $address_row = 1;?>
                    <?php foreach ($sel_address['result'] as $res_address) { ?>
                    <li class="<?php if($address_row == 1){echo 'active';} ?>"><a href="#address<?php echo $address_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle " onclick="$('#address a:first').tab('show'); $('#address a[href=\'#address<?php echo $address_row; ?>\']').parent().remove(); $('#address<?php echo $address_row; ?>').remove();"></i> <?php echo 'Address' . ' ' . $address_row; ?></a></li>
                    <?php $address_row++; ?>
                    <?php } ?>
                    <li id="address-add"><a style="color: #1e91cf;" id="addAddress" onclick="addAddress()"><i class="fa fa-plus-circle"></i> Add Address </a></li>
                  </ul>
                  </div>

                <div class="col-sm-10">
                  <div class="tab-content add">
                    <?php $address_row = 1; ?>
                    <?php foreach ($sel_address['result'] as $res_address) { ?>
                    <div class="tab-pane <?php if($address_row == 1){echo 'active';} ?>" id="address<?php echo $address_row; ?>">


                      <div class="form-group">
                          <label for=""> First Name <span class="text-red"> *</span></label>
                          <input  name="address[<?php echo $address_row; ?>][firstname]" id="f_name" type="text" class="form-control validate[required]" placeholder="Enter First Name" maxlength="200" value="<?php echo $res_address['firstname']; ?>" />
                      </div>  

                      <div class="form-group">
                          <label for=""> Last Name <span class="text-red"> *</span></label>
                          <input  name="address[<?php echo $address_row; ?>][lastname]" id="l_name" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="<?php echo $res_address['lastname']; ?>" />
                      </div> 

                      <div class="form-group">
                          <label for=""> Address 1 <span class="text-red"> *</span></label>
                          <input  name="address[<?php echo $address_row; ?>][address1]" id="address1" type="text" class="form-control validate[required]" placeholder="Enter Address1" maxlength="200" value="<?php echo $res_address['address_1']; ?>" />
                      </div> 

                      <div class="form-group">
                          <label for=""> Address 2 </label>
                          <input  name="address[<?php echo $address_row; ?>][address2]" id="addres" type="text" class="form-control" placeholder="Enter Address2" maxlength="200" value="<?php echo $res_address['address_2']; ?>" />

                          
                      </div> 

                      <div class="form-group">
                          <label for=""> City <span class="text-red"> *</span></label>
                          <input  name="address[<?php echo $address_row; ?>][city]" id="city" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="<?php echo $res_address['city']; ?>" />
                      </div> 

                      <div class="form-group">
                          <label for=""> Postcode <span class="text-red"> *</span></label>
                          <input  name="address[<?php echo $address_row; ?>][postcode]" id="postcode" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="<?php echo $res_address['postcode']; ?>" />
                      </div>

                      <div class="form-group">
                        <label for=""> Country <span class="text-red"> *</span></label>
                        <select class="form-control validate[required]" name="address[<?php echo $address_row; ?>][country]">
                          <option value="">Select Country</option>
                          <?php foreach ($country_details['result'] as $country_res) { ?>
                            <option value="<?php echo $country_res['country_id']; ?>" <?php if($country_res['country_id'] == $res_address['country_id']){echo 'selected="selected"';} ?>><?php echo $country_res['name']; ?></option>
                           <?php } ?> 
                        </select>
                      </div>

                      <div class="form-group">
                        <label class="">Default Address</label>
                          <label class="col-sm-1">
                            <?php  if (($sel['user_primary_address'] == $res_address['address_id'])) { ?>
                            <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" />
                            <?php } ?>
                          </label>
                        
                      </div>



                    </div>
                    <?php $address_row++; ?>
                    <?php } ?>
                  </div>
                </div>



                </div>

          

          

              </form>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_edit").validationEngine();
});
</script>

<script type="text/javascript"><!--
var address_row = <?php echo $address_row; ?>; console.log(address_row);

function addAddress() {  
  html  = '<div class="tab-pane" id="address' + address_row + '">';

  html += '<div class="form-group">';
  html += '<label for=""> First Name <span class="text-red"> *</span></label>';
  html += '<input  name="address[' + address_row + '][firstname]" id="f_name" type="text" class="form-control validate[required]" placeholder="Enter First Name" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> Last Name <span class="text-red"> *</span></label>';
  html += '<input  name="address[' + address_row + '][lastname]" id="l_name" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> Address 1 <span class="text-red"> *</span></label>';
  html += '<input  name="address[' + address_row + '][address1]" id="address1" type="text" class="form-control validate[required]" placeholder="Enter Address1" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> Address 2 </label>';
  html += '<input  name="address[' + address_row + '][address2]" id="addres" type="text" class="form-control" placeholder="Enter Address2" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> City <span class="text-red"> *</span></label>';
  html += '<input  name="address[' + address_row + '][city]" id="city" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> Postcode <span class="text-red"> *</span></label>';
  html += '<input  name="address[' + address_row + '][postcode]" id="postcode" type="text" class="form-control validate[required]" placeholder="Enter Last Name" maxlength="200" value="" />';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label for=""> Country <span class="text-red"> *</span></label>';
  html += '<select class="form-control validate[required]" name="address[' + address_row + '][country]">';
  html += '<option value="">Select Country</option>';
  html += '<?php foreach ($country_details['result'] as $country_res) { ?>';
  html += '<option value="<?php echo $country_res['country_id']; ?>" ><?php echo $country_res['name']; ?></option>';
  html += '<?php } ?>';
  html += '</select>';
  html += '</div>';

  html += '<div class="form-group">';
  html += '<label>Default Address</label>';
  html += '<label class="col-sm-1">';
  html += '<?php if (($country_res['address_default'])) { ?>';
  html += '<input type="radio" name="address[' + address_row + '][default]" value="<?php echo $address_row; ?>" checked="checked" />';
  html += '<?php } else { ?>';
  html += '<input type="radio" name="address[' + address_row + '][default]" value="<?php echo $address_row; ?>" /><?php } ?>';
  html += '</label>';
  html += ' </div>';

  $('#tab-address .add').append(html);

  $('select[name=\'customer_group_id\']').trigger('change');

  $('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');

  $('#address-add').before('<li><a href="#address' + address_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#address a:first\').tab(\'show\'); $(\'a[href=\\\'#address' + address_row + '\\\']\').parent().remove(); $(\'#address' + address_row + '\').remove();"></i> Address ' + address_row + '</a></li>');

  $('#address a[href=\'#address' + address_row + '\']').tab('show');

  address_row++;
}

//--></script>
</body>
</html>
