<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$id = $conn->variable($q);
$sel = $conn->select_query(PRODUCT,"*","p_id='".$id."'","1");
$subimp=explode(',',$sel['p_sub_category']);
//print_r($subimp);
if(!$sel['nr'] && !empty($id))
{
  $conn->divert(ADMIN_URL.$path_folder.'list.php');
}
  
if($id){
  $btn_name="edit";
} else {
  $btn_name="add";
}



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
           case 'application/msword': return '.doc';
           default: return false;
       }
    } 

if(isset($edit))
{
//echo $cat_p_id;exit;
    $p_sub_cat=implode(',', $_POST['p_sub_cat']); 

    $post_image=$conn->singlefileupload('pimage','product');    
    $post_image=($post_image)?$post_image:$sel['p_image'];
    
    $new = array('p_name'=>$product_name, 'p_slug' =>$product_slug, 'p_image'=>$post_image, 'p_desc' =>$product_desc,'p_sub_category' =>$p_sub_cat,'p_status'=>'Y');

    //print_r($new); exit;
    $ins = $conn->update(PRODUCT,"p_id='".$id."'",$new);

    if($ins)
    {
        if(isset($_POST['product_specification'])){
           $conn->delete_query(PRODUCTSPECIFICATION, "product_id='".$id."'");
          foreach ($_POST['product_specification'] as $key => $value) {
            $specification_add=array('ps_id'=>$value['ps_id'], 'product_id'=>$id, 'ps_name'=>$value['name'], 'ps_detail'=>$value['detail'], 'ps_dt'=>NOW);
            $specification_ins = $conn->insert(PRODUCTSPECIFICATION,"",$specification_add);
			
          }
		   $succAlert = "Successfully Updated.";
			$conn->adminAlert($pageKey,$succAlert);
			$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'product_rent.php?q='.$id.'';
			$conn->divert($rpage); 
        } 

         if(isset($_POST['images_table_details'])){
          $conn->delete_query(PRODUCTIMAGE, "product_id='".$id."'");
          foreach ($_POST['images_table_details'] as $key => $value) {
            $image_add=array('product_image_id'=>$value['post_image_id'], 'product_id'=>$id, 'product_image'=>$value['image'], 'product_dt'=>NOW);
            $image_ins = $conn->insert(PRODUCTIMAGE,"",$image_add);
          }
           
        }

        //POST_DOCUMENT
        if(isset($_FILES['product_image_detail'])){
          $i=0;
           foreach ($_FILES['product_image_detail']['name'] as $key => $value) {
           // print_r($value);echo "<br>";
           // print_r($_FILES['product_image_detail']['tmp_name'][$key]);
            //print_r($_FILES['product_image_detail']['size'][$key]);    
            //echo "<br>";
            $su_image_file_name=$value["file"];
            $su_image_temp_name=$_FILES["product_image_detail"]["tmp_name"][$key]["file"]; 
            $su_image_imgtype=$_FILES["product_image_detail"]["type"][$key]["file"]; 
            $su_image_ext= GetImageExtension($su_image_imgtype); 
            $su_image_imagename="suimage-".$i."-".date("d-m-Y")."-".time().$su_image_ext;
            $su_image_target_path = "../../uploads/product/".$su_image_imagename;

            move_uploaded_file($su_image_temp_name, $su_image_target_path);

            $image_add=array('product_id'=>$id, 'product_image'=>$su_image_imagename, 'product_dt'=>NOW);
            $image_ins = $conn->insert(PRODUCTIMAGE,"",$image_add);
            $i++;
          }
		  

        }

        //product_price_detail
//print_r($_POST['product_price_detail']);
        if(isset($_POST['product_price_detail'])){
         // print_r($_POST['product_price_detail']); exit;
          $conn->delete_query(PRODUCTPRICE, "pp_product_id='".$id."' AND pp_price_option='hp'");
          foreach ($_POST['product_price_detail'] as $key => $value) {
            $houe_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'hp', 'pp_product_id'=>$id, 'pp_location_id'=>$value['location_id'], 'ps_price_month'=>$value['per_month'], 'pp_price_3_month'=>$value['pp_price_3_month'],'pp_feature'=>$value['features'], 'pp_price_6_month'=>$value['pp_price_6_month'], 'pp_price_9_month'=>$value['pp_price_9_month'], 'pp_price_12_month'=>$value['pp_price_12_month'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $houe_price_ins = $conn->insert(PRODUCTPRICE,"",$houe_price_add);
          }
        }

        if(isset($_POST['office_price_details'])){
         // print_r($_POST['office_price_details']); exit;
          $conn->delete_query(PRODUCTPRICE, "pp_product_id='".$id."' AND pp_price_option='op'");
          foreach ($_POST['office_price_details'] as $key => $value) {
            $office_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'op', 'pp_product_id'=>$id, 'pp_location_id'=>$value['location_id'], 'pp_price_3_month'=>$value['pp_price_3_month'],'pp_feature'=>$value['features'], 'pp_price_6_month'=>$value['pp_price_6_month'], 'pp_price_9_month'=>$value['pp_price_9_month'], 'pp_price_12_month'=>$value['pp_price_12_month'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $office_price_ins = $conn->insert(PRODUCTPRICE,"",$office_price_add);
          }
        }

        if(isset($_POST['event_price_details'])){
         // print_r($_POST['event_price_details']); exit;
          $conn->delete_query(PRODUCTPRICE, "pp_product_id='".$id."' AND pp_price_option='ep'");
          foreach ($_POST['event_price_details'] as $key => $value) {
            $event_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'ep', 'pp_product_id'=>$id, 'pp_location_id'=>$value['location_id'], 'ps_price_month'=>$value['per_month'],'pp_feature'=>$value['features'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $event_price_ins = $conn->insert(PRODUCTPRICE,"",$event_price_add);
          }
        }
       
      $succAlert = "Successfully Updated.";
			$conn->adminAlert($pageKey,$succAlert);
			$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'product_rent.php?q='.$id.'';
			$conn->divert($rpage); 
    }

    $succAlert = "Successfully Updated.";
			$conn->adminAlert($pageKey,$succAlert);
			$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'product_rent.php?q='.$id.'';
			$conn->divert($rpage); 
}

if(isset($add))
{
	//($product_category);
	 $p_sub_cat=implode(',', $_POST['p_sub_cat']);  
	//print_r ($product_categorys);exit;
  $post_image=$conn->singlefileupload('pimage',$uploadFoldername);
           
  $new = array('p_name'=>$product_name, 'p_slug' =>$product_slug, 'p_image'=>$post_image, 'p_desc' =>$product_desc, 'p_sub_category' =>$p_sub_cat,  'p_status'=>'Y', 'p_date_dt'=>NOW);
                 
      $ins = $conn->insert(PRODUCT,"",$new);
      if($ins){

        //POST_DOCUMENT
        if(isset($_FILES['product_image_detail'])){
          $i=0;
           foreach ($_FILES['product_image_detail']['name'] as $key => $value) {
            /*print_r($value);echo "<br>";
            print_r($_FILES['product_image_detail']['tmp_name'][$key]);
            print_r($_FILES['product_image_detail']['size'][$key]);    
            echo "<br>";*/
            $su_image_file_name=$value["file"];
            $su_image_temp_name=$_FILES["product_image_detail"]["tmp_name"][$key]["file"]; 
            $su_image_imgtype=$_FILES["product_image_detail"]["type"][$key]["file"]; 
            $su_image_ext= GetImageExtension($su_image_imgtype); 
            $su_image_imagename="suimage-".$i."-".date("d-m-Y")."-".time().$su_image_ext;
            $su_image_target_path = "../../uploads/product/".$su_image_imagename;

            move_uploaded_file($su_image_temp_name, $su_image_target_path);

            $image_add=array('product_id'=>$ins['id'], 'product_image'=>$su_image_imagename, 'product_dt'=>NOW);
            $image_ins = $conn->insert(PRODUCTIMAGE,"",$image_add);
            $i++;
          }
        }

        if(isset($_POST['product_specification'])){
          foreach ($_POST['product_specification'] as $key => $value) {
            $specification_add=array('ps_id'=>$value['ps_id'], 'product_id'=>$ins['id'], 'ps_name'=>$value['name'], 'ps_detail'=>$value['detail'], 'ps_dt'=>NOW);
            $specification_ins = $conn->insert(PRODUCTSPECIFICATION,"",$specification_add);
          }
        }

        //product_price_detail

        if(isset($_POST['product_price_detail'])){
          foreach ($_POST['product_price_detail'] as $key => $value) {
            $houe_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'hp', 'pp_product_id'=>$ins['id'], 'pp_location_id'=>$value['location_id'], 'pp_price_3_month'=>$value['pp_price_3_month'],'pp_feature'=>$value['features'], 'pp_price_6_month'=>$value['pp_price_6_month'], 'pp_price_9_month'=>$value['pp_price_9_month'], 'pp_price_12_month'=>$value['pp_price_12_month'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $houe_price_ins = $conn->insert(PRODUCTPRICE,"",$houe_price_add);
          }
        }

        if(isset($_POST['office_price_details'])){
          foreach ($_POST['office_price_details'] as $key => $value) {
            $office_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'op', 'pp_product_id'=>$ins['id'], 'pp_location_id'=>$value['location_id'], 'pp_price_3_month'=>$value['pp_price_3_month'],'pp_feature'=>$value['features'], 'pp_price_6_month'=>$value['pp_price_6_month'], 'pp_price_9_month'=>$value['pp_price_9_month'], 'pp_price_12_month'=>$value['pp_price_12_month'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $office_price_ins = $conn->insert(PRODUCTPRICE,"",$office_price_add);
          }
        }

        if(isset($_POST['event_price_details'])){
          foreach ($_POST['event_price_details'] as $key => $value) {
            $event_price_add=array('pp_id'=>$value['pp_id'], 'pp_price_option'=>'ep', 'pp_product_id'=>$ins['id'], 'pp_location_id'=>$value['location_id'], 'ps_price_month'=>$value['per_month'],'pp_feature'=>$value['features'], 'pp_taxes'=>$value['taxes'], 'pp_security_deposit'=>$value['security_deposit'], 'pp_handling_charge'=>$value['handling_charge'], 'pp_dt'=>NOW);
            $event_price_ins = $conn->insert(PRODUCTPRICE,"",$event_price_add);
          }
        }

 //POST_DOCUMENT
       /* if(isset($_FILES['post_document_detail'])){
           foreach ($_FILES['post_document_detail']['name'] as $key => $value) {
         
            $doc_image_file_name=$value["file"];
            $doc_image_temp_name=$_FILES["post_document_detail"]["tmp_name"][$key]["file"]; 
            $doc_image_imgtype=$_FILES["post_document_detail"]["type"][$key]["file"]; 
            $doc_image_ext= GetImageExtension($doc_image_imgtype); 
            $doc_image_imagename="docimage-".date("d-m-Y")."-".time().$doc_image_ext;
            $doc_image_target_path = "../../uploads/post/".$doc_image_imagename;

            move_uploaded_file($doc_image_temp_name, $doc_image_target_path);

            $document_name=$_POST['post_document_detail'][$key]['document_name'];
            
            $document_add=array('post_id'=>$ins['id'], 'document_name'=>$document_name, 'file_name'=>$doc_image_imagename);
            $document_ins = $conn->insert(POSTDOCUMENT,"",$document_add);
          }
        }*/

     	$succAlert = "Successfully Updated.";
			$conn->adminAlert($pageKey,$succAlert);
			$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
			$conn->divert($rpage);       
        
      }
  }

  $categorys = $conn->select_query(CATEGORY,"*"," cat_status='Y' AND cat_id NOT IN (4,5,6) order by cat_pos",""); 
  
  $attributes = $conn->select_query(ATTRIBUTE,"*"," at_status='Y' order by at_pos",""); 

  $locations = $conn->select_query(LOCATION,"*","lo_status='Y'","");

  $taxs = $conn->select_query(TAX,"*","tax_status='Y'","");

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
              <h3 class="box-title text-navy"><?php echo ucfirst($btn_name).' '.$Pagetitle['title']; ?></h3>
              <!--<div class="pull-right">
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a>
                  </div> --> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                <div class="pull-right">
                  <button class="btn btn-primary"  onclick="ddlValidate();" name="<?php echo $btn_name; ?>" id="<?php echo $btn_name; ?>" type="submit">Submit</button>
                  <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a> </div>
                  
               <ul class="nav nav-tabs" role="tablist">

                  <li role="presentation"  ><a href="<?php echo ADMIN_URL.$path_folder; ?>product_form.php?q=<?php echo $id?>" aria-controls="home" >General</a></li>
                  
                  <li role="presentation" ><a href="<?php echo ADMIN_URL.$path_folder; ?>product_img.php?q=<?php echo $id?>" aria-controls="home" >Product Image</a></li>
                  
                  <li role="presentation" class="active"><a href="<?php echo ADMIN_URL.$path_folder; ?>product_spec.php?q=<?php echo $id?>" aria-controls="home" >Specifications</a></li>
                  
                  <li role="presentation" id="month_div"><a href="<?php echo ADMIN_URL.$path_folder; ?>product_rent.php?q=<?php echo $id?>" aria-controls="home" >Rent For Month</a>
                 <!--  <li role="presentation"><a href="#office_price" aria-controls="office_price" role="tab" data-toggle="tab">Rent for Office Price List</a> -->
<li role="presentation" id="hidden_div" style="display: none;"><a href="<?php echo ADMIN_URL.$path_folder; ?>product_rent.php?q=<?php echo $id?>" aria-controls="event_price" >Rent for Event</a></li>

<!-- <div id="hidden_div" style="display: none;"><a href="#event_price" aria-controls="event_price" role="tab" data-toggle="tab">Rent for Event</a></div> -->

                  
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane " id="home">
                    <div class=" mg-top">
                      <div class="">
                        <div class="form-group">
                          <label for=""> Product Name <span class="text-red"> *</span></label>
                          <input  name="product_name" id="product_name" type="text" class="form-control validate[required]" placeholder="Enter Product Name" maxlength="200" onKeyUp="slug(this.value,'product_slug');" value="<?php echo $sel['p_name']; ?>" onChange="slug(this.value,'product_slug');" onBlur="slug(this.value,'product_slug');"/>
                          <div class="error_p_name"></div>
                        </div>
                        <div class="form-group">
                          <label for=""> Product Slug <span class="text-red"> *</span></label>
                          <input  name="product_slug" id="product_slug" type="text" class="form-control validate[required]" placeholder="Enter Slug" maxlength="200" onKeyUp="slug(this.value,'product_slug');" value="<?php echo $sel['p_slug']; ?>" onChange="slug(this.value,'product_slug');" onBlur="slug(this.value,'product_slug');"  />
                        </div>

                        <div class="form-group">
                          <label for="">Meta Key<span class="text-red"> *</span></label>
                          <input  name="meta_key" id="meta_key" type="text" class="form-control validate[required]" placeholder="Enter Slug" maxlength="200" onKeyUp="slug(this.value,'meta_key');" value="<?php echo $sel['meta_key']; ?>" onChange="slug(this.value,'meta_key');" onBlur="slug(this.value,'meta_key');"  />
                        </div>

                        <div class="form-group">
                          <label for=""> Product Description <span class="text-red"> *</span></label>
                          <textarea class="form-control validate[required]" name="product_desc" rows="3"><?php echo $sel['p_desc']; ?></textarea>
                        </div>
                        <?php   $p_categorys = $conn->select_query(CATEGORY, "*", " cat_p_id='0' AND cat_status='Y' ");

               ?>
                        <div class="form-group">
                          <label>Main Category <span class="text-red">*</span></label>
                          <select name="p_category" id="p_category" class="form-control"  onchange="getdata(this.value,'locdiv','getlocation')" >     
                               <option value="">-- Select --</option>
                            <?php foreach($p_categorys['result'] as $p_category) { ?>
                       
                            <option value="<?php echo $p_category['cat_id']; ?>" <?php echo $conn->isselected($p_category['cat_id'],$sel['p_category']); ?>><?php echo $p_category['cat_title']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <?php ?>
                        <?php if($sel['p_category']!=0){
	$subcat = $conn->select_query(CATEGORY,"*","cat_status='Y' AND cat_p_id='".$sel['p_category']."' order by cat_title","");
							
							?>
                        <div class="form-group">
                          <label>Sub Category<span class="text-red">*</span></label>
                           <span id="locdiv">
                          <select  class="form-control validate[required]" name="p_sub_cat[]" id="p_sub_cat"  multiple="multiple">
                            <option value="">-- Select --</option>
                           <?php  foreach($subcat['result'] as $ressub){?>
  <option <?php if(in_array($ressub['cat_id'],$subimp)){?> selected="selected" <?php }?>  value="<?php echo $ressub['cat_id']; ?>"><?php echo ucfirst($conn->stripval($ressub['cat_title'])); ?></option>
                              <?php }?>
                          </select>
                          </span>
                          </div>
                          <?php }else{?>
                          <div class="form-group">
                          <label>Sub Category<span class="text-red">*</span></label>
                          <span id="locdiv">
                          <select  class="form-control validate[required]" name="p_sub_cat[]" id="p_sub_cat"  multiple="multiple">
                            <option value="">-- Select --</option>
                          </select>
                          </span> </div>
                          <?php }?>
                          
                        <div class="form-group">
                          <label for="">Cover Image <span class="text-red"> *</span></label>
                          <div id="imageblock">
                            <?php if($sel['p_image']!=""){?>
                            <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/product/'.$sel['p_image'];?>&w=420&h=120&zc=0" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="DelFile('p_image','imageblock','<?php echo $id?>','R','pimage');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                            <?php }else{?>
                            <input name="pimage" id="pimage" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*">
                            <div class="clearfix"></div>
                            <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                            <?php }?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row mg-top">
                      <div class="table-responsive">
                        <table id="fileimage" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <td class="text-left">Product Image Upload ( 400 * 534 )</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                    if($id){
                      $images_details = $conn->select_query(PRODUCTIMAGE,"*","product_id='".$id."'",""); 
                    }
                     $image_row = 0; ?>
                            <?php if(isset($images_details)){ foreach ($images_details['result'] as $images_detail) { ?>
                            <tr id="image-row<?php echo $image_row; ?>">
                              <td class="text-right"><input type="hidden" name="images_table_details[<?php echo $image_row; ?>][post_image_id]" value="<?php echo $images_detail['post_image_id']; ?>"  />
                                <input type="hidden" name="images_table_details[<?php echo $image_row; ?>][image]" value="<?php echo $images_detail['product_image']; ?>" />
                                <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/product/'.$images_detail['product_image'];?>&w=144&h=144&zc=0" alt="<?php echo $sel['p_name']; ?>" class="img-resposnive"></td>
                              <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                            </tr>
                            <?php $image_row++; ?>
                            <?php } } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="1"></td>
                              <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add More" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More</button></td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div role="tabpanel" class="tab-pane active" id="messages">
                    <div class="row mg-top">
                      <div class="table-responsive">
                        <table id="tool" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <td class="text-left">Name</td>
                              <td class="text-left">Details</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                    $tool_details = $conn->select_query(PRODUCTSPECIFICATION,"*","product_id='".$id."'",""); 
                    $tool_row = 0; ?>
                            <?php if(isset($tool_details['nr'])){ foreach ($tool_details['result'] as $tool_detail) { ?>
                            <tr id="tool-row<?php echo $tool_row; ?>">
                              <td class="text-right"><input type="hidden" name="product_specification[<?php echo $tool_row; ?>][ps_id]" value="<?php echo $tool_detail['ps_id']; ?>"  class="form-control" />
                                <input type="text" name="product_specification[<?php echo $tool_row; ?>][name]" value="<?php echo $tool_detail['ps_name']; ?>"  class="form-control" /></td>
                              <td class="text-right"><input type="text" name="product_specification[<?php echo $tool_row; ?>][detail]" value="<?php echo $tool_detail['ps_detail']; ?>"  class="form-control" /></td>
                              <td class="text-left"><button type="button" onclick="$('#tool-row<?php echo $tool_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                            </tr>
                            <?php $tool_row++; ?>
                            <?php } } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="2"></td>
                              <td class="text-left"><button type="button" onclick="addTools();" data-toggle="tooltip" title="Add More" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More</button></td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="house_price">
                    <div class="row mg-top">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <input type="hidden" id="getselectedservices" value="">
                          <table id="hp_price" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <td class="text-left">Location Name </td>
                                 <td class="text-left">Featured  Product </td>
                                <!-- <td class="text-left">Rent Per Month </td>  -->
                                <td class="text-left">Rent Per 1 Month </td>
                            <!--     <td class="text-left">Rent Per 2 Month </td>
                                <td class="text-left">Rent Per 3 Month </td>
                                <td class="text-left">Rent Per 4 Month </td> -->
                                <td class="text-left">Taxes </td>
                                <td class="text-left">Security Deposit </td>
                                <td class="text-left">Handling Charge </td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                    if($id){
                      $document_details = $conn->select_query( PRODUCTPRICE, "*", "pp_price_option='hp' AND pp_product_id='".$id."'", "" ); 
                    }

                     $document_row = 0; ?>
                              <?php if(isset($document_details)){ foreach ($document_details['result'] as $document_detail) {
								   ?>
                              <tr id="price-row<?php echo $document_row; ?>">
                                <td class="text-right"><input type="hidden" name="product_price_detail[<?php echo $document_row; ?>][pp_id]" value="<?php echo $document_detail['pp_id']; ?>"  class="form-control" />
                                  <select name="product_price_detail[<?php echo $document_row; ?>][location_id]" class="form-control location_get">
                                    <?php foreach($locations['result'] as $location) { 
                          if($location['lo_id']==$document_detail['pp_location_id']) {
                          ?>
                                    <option selected value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } }  ?>
                                  </select></td>
                                <?php /* ?><td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][per_month]" value="<?php echo $document_detail['ps_price_month']; ?>" class="form-control" /></td><?php */ ?>
                                
                                 <td class="text-right"><select name="product_price_detail[<?php echo $document_row; ?>][features]" id="feat_get" class="form-control">
                                <option value="N" <?php  if($document_detail['pp_feature']=='N') { ?> selected="selected"<?php }?>>No</option>  
                                 <option value="Y" <?php  if($document_detail['pp_feature']=='Y') { ?> selected="selected"<?php }?>>Yes</option>
                                 </select>
                                 </td>
                                 
                                <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][pp_price_3_month]" value="<?php echo round($document_detail['pp_price_3_month']); ?>" class="form-control" /></td>
                               <!--  <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][pp_price_6_month]" value="<?php echo $document_detail['pp_price_6_month']; ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][pp_price_9_month]" value="<?php echo $document_detail['pp_price_9_month']; ?>" class="form-control" /></td> -->
                        <!--         <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][pp_price_12_month]" value="<?php echo $document_detail['pp_price_12_month']; ?>" class="form-control" /></td> -->
                                <td class="text-right"><select name="product_price_detail[<?php echo $document_row; ?>][taxes]" id="tax_get" class="form-control">
                                    
                                    ';
                      
                                    
                                    <?php foreach($taxs['result'] as $tax_value) { 
                       if($tax_value['tax_id']==$document_detail['pp_taxes']) {
                          ?>
                                    <option selected value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } } ?>
                                  </select></td>
                                <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][security_deposit]" value="<?php echo round($document_detail['pp_security_deposit']); ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="product_price_detail[<?php echo $document_row; ?>][handling_charge]" value="<?php echo round($document_detail['pp_handling_charge']); ?>" class="form-control" /></td>
                                <td class="text-left"><button type="button" onclick="$('#price-row<?php echo $document_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price"><i class="fa fa-minus-circle"></i></button></td>
                              </tr>
                              <?php $document_row++; ?>
                              <?php } } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="9"></td>
                                <!--onclick="addPrice();"-->
                                <td class="text-left"><button type="button" data-toggle="tooltip" title="Add More" class="btn btn-primary addprice"><i class="fa fa-plus-circle"></i>Add More</button></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="office_price">
                    <div class="row mg-top">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <input type="hidden" id="getselectedservices" value="">
                          <table id="op_price" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <td class="text-left">Location Name </td>
                                <!-- <td class="text-left">Rent Per Month </td> -->
                                <td class="text-left">Rent Per 1 Month </td>
                                <td class="text-left">Rent Per 2 Month </td>
                                <td class="text-left">Rent Per 3 Month </td>
                                <td class="text-left">Rent Per 4 Month </td>
                                <td class="text-left">Taxes </td>
                                <td class="text-left">Security Deposit </td>
                                <td class="text-left">Handling Charge </td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                    if($id){
                      $op_price_details = $conn->select_query( PRODUCTPRICE, "*", "pp_price_option='op' AND pp_product_id='".$id."'", "" ); 
                    }

                     $op_price_row = 0; ?>
                              <?php if(isset($op_price_details)){ foreach ($op_price_details['result'] as $document_detail) { ?>
                              <tr id="op-price-row<?php echo $op_price_row; ?>">
                                <td class="text-right"><input type="hidden" name="office_price_details[<?php echo $op_price_row; ?>][pp_id]" value="<?php echo $document_detail['pp_id']; ?>"  class="form-control" />
                                  <select name="office_price_details[<?php echo $op_price_row; ?>][location_id]" class="form-control location_get_op">
                                    <?php foreach($locations['result'] as $location) { 
                          if($location['lo_id']==$document_detail['pp_location_id']) {
                          ?>
                                    <option selected value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } }  ?>
                                  </select></td>
                                <?php /* ?><td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][per_month]" value="<?php echo $document_detail['ps_price_month']; ?>" class="form-control" /></td><?php */ ?>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][pp_price_3_month]" value="<?php echo $document_detail['pp_price_3_month']; ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][pp_price_6_month]" value="<?php echo $document_detail['pp_price_6_month']; ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][pp_price_9_month]" value="<?php echo $document_detail['pp_price_9_month']; ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][pp_price_12_month]" value="<?php echo $document_detail['pp_price_12_month']; ?>" class="form-control" /></td>
                                <td class="text-right"><select name="office_price_details[<?php echo $op_price_row; ?>][taxes]" id="tax_get" class="form-control">
                                    
                                    ';
                      
                                    
                                    <?php foreach($taxs['result'] as $tax_value) { 
                       if($tax_value['tax_id']==$document_detail['pp_taxes']) {
                          ?>
                                    <option selected value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } } ?>
                                  </select></td>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][security_deposit]" value="<?php echo $document_detail['pp_security_deposit']; ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="office_price_details[<?php echo $op_price_row; ?>][handling_charge]" value="<?php echo $document_detail['pp_handling_charge']; ?>" class="form-control" /></td>
                                <td class="text-left"><button type="button" onclick="$('#op-price-row<?php echo $op_price_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price-ep"><i class="fa fa-minus-circle"></i></button></td>
                              </tr>
                              <?php $op_price_row++; ?>
                              <?php } } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="9"></td>
                                <!--onclick="addPrice();"-->
                                <td class="text-left"><button type="button" data-toggle="tooltip" title="Add More" class="btn btn-primary addopprice"><i class="fa fa-plus-circle"></i>Add More</button></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="event_price">
                    <div class="row mg-top">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <input type="hidden" id="getselectedservices" value="">
                          <table id="ep_price" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <td class="text-left">Location Name </td>
                                 <td class="text-left">Featured  Product </td>
                                <!-- <td class="text-left">Rent Per Month </td> -->
                                <td class="text-left">Rent Per Day </td>
                                <td class="text-left">Taxes </td>
                                <td class="text-left">Security Deposit </td>
                                <td class="text-left">Handling Charge </td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                    if($id){
                      $ep_price_details = $conn->select_query( PRODUCTPRICE, "*", "pp_price_option='ep' AND pp_product_id='".$id."'", "" ); 
                    }

                     $ep_price_row = 0; ?>
                              <?php if(isset($ep_price_details)){ foreach ($ep_price_details['result'] as $document_detail) { ?>
                              <tr id="ep-price-row<?php echo $ep_price_row; ?>">
                                <td class="text-right"><input type="hidden" name="event_price_details[<?php echo $ep_price_row; ?>][pp_id]" value="<?php echo $document_detail['pp_id']; ?>"  class="form-control" />
                                  <select name="event_price_details[<?php echo $ep_price_row; ?>][location_id]" class="form-control location_get_ep">
                                    <?php foreach($locations['result'] as $location) { 
                          if($location['lo_id']==$document_detail['pp_location_id']) {
                          ?>
                                    <option selected value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
                                    <?php } }  ?>
                                  </select></td>
                                  
                                   <td class="text-right"><select name="event_price_details[<?php echo $ep_price_row; ?>][features]" id="feat_get" class="form-control">
    <option value="N" <?php  if($document_detail['pp_feature']=='N') { ?> selected="selected"<?php }?>>No</option>  
          <option value="Y" <?php  if($document_detail['pp_feature']=='Y') { ?> selected="selected"<?php }?>>Yes</option>
                                 </select>
                                 </td>
                                 
                                <td class="text-right"><input type="text" name="event_price_details[<?php echo $ep_price_row; ?>][per_month]" value="<?php echo round($document_detail['ps_price_month']); ?>" class="form-control" /></td>
                                <td class="text-right"><select name="event_price_details[<?php echo $ep_price_row; ?>][taxes]" id="tax_get" class="form-control">
                                    
                                    ';
                                    
                      
                                    
                                    <?php foreach($taxs['result'] as $tax_value) { 
                       if($tax_value['tax_id']==$document_detail['pp_taxes']) {
                          ?>
                                    <option selected value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>
                                    <?php } } ?>
                                  </select></td>
                                <td class="text-right"><input type="text" name="event_price_details[<?php echo $ep_price_row; ?>][security_deposit]" value="<?php echo round($document_detail['pp_security_deposit']); ?>" class="form-control" /></td>
                                <td class="text-right"><input type="text" name="event_price_details[<?php echo $ep_price_row; ?>][handling_charge]" value="<?php echo round($document_detail['pp_handling_charge']); ?>" class="form-control" /></td>
                                <td class="text-left"><button type="button" onclick="$('#ep-price-row<?php echo $ep_price_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price-ep"><i class="fa fa-minus-circle"></i></button></td>
                              </tr>
                              <?php $ep_price_row++; ?>
                              <?php } } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="9"></td>
                                <!--onclick="addPrice();"-->
                                <td class="text-left"><button type="button" data-toggle="tooltip" title="Add More" class="btn btn-primary addepprice"><i class="fa fa-plus-circle"></i>Add More</button></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <div class="box-footer">
                  <center>
                    <input type="hidden" name="successkey" id="successkey"  value="" />
                  </center>
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
    <select name="testselect" id="page-service-option-list-data" style="display: none;" class="form-control">
      <?php foreach($locations['result'] as $location) { ?>
      <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
      <?php } ?>
    </select>
    <select name="testselect_op" id="page-service-option-list-data-op" style="display: none;" class="form-control">
      <?php foreach($locations['result'] as $location) { ?>
      <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
      <?php } ?>
    </select>
    <select name="testselect_ep" id="page-service-option-list-data-ep" style="display: none;" class="form-control">
      <?php foreach($locations['result'] as $location) { ?>
      <option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>
      <?php } ?>
    </select>
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
	
	var cat=document.getElementById('p_category').value;
	var style1 = cat == 3 ? 'none' : 'block';
	document.getElementById('month_div').style.display = style1;
	
	var style = cat == 3 ? 'block' : 'none';
	document.getElementById('hidden_div').style.display = style;
	

jQuery("#frm_new").validationEngine();
//setTimeout("document.getElementById('banner_title').focus(); ", 500 ); 
});
function checkImage(field, rules, i, options)
{
	if($('#successkey').val()!="1"&&$('#successkey').val()!="")
	{
		return "Please select an image";
	}
	if(field.val()!="")
	{
		var img=field.val();
		var pos=img.lastIndexOf('.');
		if(pos<0)
		{
			return options.allrules.validateimages.alertText;
		}
		if(pos>=0)
		{
			var mainext=img.substr(pos+1);
			mainext= mainext.toLowerCase();
			if((mainext!='jpg')&&(mainext!='jpeg')&&(mainext!='gif')&&(mainext!='png'))
			{
				return options.allrules.validateimages.alertText;
			}
		}
	}
}

function DelFile(field,div,id,fr,func)
{
  if(confirm('Are you sure want to delete'))
  {
    $("#"+div).html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.ajax({url:"<?php echo ADMIN_URL.$path_folder; ?>ajaxDelete.php?field="+field+"&id="+id+"&fr="+fr+"&func="+func,success:function(result){
    $("#"+div).html(result);
    callfileinput();
    $("#"+div).fadeIn();
    }});
  }
} 

function callfileinput()
{
	var uploadvar=$("#pimage").fileinput({
		uploadUrl: "<?php echo ADMIN_URL.$path_folder ?>ajax.php?func=fileupload", // server upload action
		uploadAsync: false,
		showUpload: false, // hide upload button
		showRemove: false, // hide remove button
		minFileCount: 1,
		maxFileCount: 1,
		browseClass: "btn btn-primary uploadbtn",
		previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
		allowedFileExtensions : ['jpg', 'png','gif','jpeg']
	}).on("filebatchselected", function(event, files) {
		// trigger upload method immediately after files are selected
	   var retrunval=$("#pimage").fileinput("upload");
	});

	//After complete functions
	$('#pimage').on('filebatchuploadcomplete', function(event, files, extra) {
		  //  console.log('File batch upload complete');
		$('#pimage').fileinput('disable');
		$('#successkey').val('1');
		//$('.fileinput-remove').hide();
		jQuery("#frm_new").validationEngine('hide');
	});
	//After Delete functions
	$('#pimage').on('filepredelete', function(event, key) {
		  $('#pimage').fileinput('enable');
		  $('#successkey').val('0');
		  //$('.fileinput-remove').hide();
	});
	//Error functions
	$('#pimage').on('filebatchuploaderror', function(event, data) {
		console.log(data.response.error);
	});
	//$('.fileinput-remove').hide();
}
$(function(){
	callfileinput();
	//Clear all	
	$('.fileinput-remove').click( function(){
	$('.kv-file-remove').trigger('click');
	$('#pimage').fileinput('reset');
	});		
});
</script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() { 
    html  = '<tr id="image-row' + image_row + '">'; 
    html += '  <td class="text-right"><div class="pull-left"><input type="file" image_id="image-dy-'+image_row+'" name="product_image_detail[' + image_row + '][file]" class="form-control add_image" /></div><div class="pull-right"><img id="image-dy-'+image_row+'" src="" class="img-responsive usedby-photo" style="width: 144px;height:144px;" alt="Product image" /></div></td>';      
    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';  
  
  $('#fileimage tbody').append(html);
  //alert("test"); return false;
  image_row++;
}
//--></script> 
<script type="text/javascript">
  function readURL(input, image_id) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#'+image_id).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).on("change", ".add_image", function() {
  var image_id=$(this).attr('image_id');
  readURL(this, image_id);
});

</script> 
<script type="text/javascript"><!--
var tool_row = <?php echo $tool_row; ?>;

function addTools() {
    html  = '<tr id="tool-row' + tool_row + '">';    
    html += '  <td class="text-right"><input type="hidden" name="product_specification[' + tool_row + '][ps_id]" value=""  class="form-control" /><input type="text" name="product_specification[' + tool_row + '][name]" value="" placeholder="Name" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_specification[' + tool_row + '][detail]" value="" placeholder="URL" class="form-control" /></td>';      
    html += '  <td class="text-left"><button type="button" onclick="$(\'#tool-row' + tool_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';  
  
  $('#tool tbody').append(html);
  
  tool_row++;
}
//--></script> 
<script type="text/javascript"><!--
var document_row = <?php echo $document_row; ?>;  
 
testarray='';
$(document).on("click", ".addprice", function(){

  i = $('#hp_price >tbody >tr').length;

  var data=[];
  var $el=$(".location_get");

  if(i !=0){
    $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
       if($(this).val() !=0){
        data.push($(this).val());
        }
    });
  }

var testarray='';

  if(data.length!=''){
    //console.log(data);
    testarray=data;
   /* $.each( data, function( key, value ) {
      alert( value.value );
      $(".location_get option[value='"+value.value+"']").remove();
    });*/
    //$("#selectBox option[value='option1']").remove();
  } else {
    testarray='';
  }

  //console.log(testarray);

  i = $('#hp_price >tbody >tr').length;
var totallocation="<?php echo $locations['nr']; ?>";
  
  if(i < totallocation){
    addPrice(testarray);
  }
  
});


function filedadd(document_row){
   var addpricehtml  = '<tr id="price-row' + document_row + '">'; 

     addpricehtml += '  <td class="text-right"><input type="hidden" name="product_price_detail[' + document_row + '][pp_id]" class="form-control" /><select id="ddlView" name="product_price_detail[' + document_row + '][location_id]" class="form-control location_get"><option value = 0>Select Location</option>';
    <?php foreach($locations['result'] as $location) { ?>
      addpricehtml += '<option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';

    //addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][per_month]" class="form-control" /></td>';
	
	addpricehtml += ' <td class="text-right"><select name="product_price_detail[' + document_row + '][features]"  class="form-control"><option value="N">No</option> <option value="Y">Yes</option></select></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][pp_price_3_month]" class="form-control" /></td>';

/*    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][pp_price_6_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][pp_price_9_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][pp_price_12_month]" class="form-control" /></td>';*/

    addpricehtml += '  <td class="text-right"><select name="product_price_detail[' + document_row + '][taxes]" id="tax_get" class="form-control">';
    <?php foreach($taxs['result'] as $tax_value) { ?>
      addpricehtml += '<option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';
   

    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][security_deposit]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="product_price_detail[' + document_row + '][handling_charge]" class="form-control" /></td>';      
    addpricehtml += '  <td class="text-left"><button type="button" onclick="$(\'#price-row' + document_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price"><i class="fa fa-minus-circle"></i></button></td>';
    addpricehtml += '</tr>';  

    return addpricehtml;
}

function addPrice(testarray) {
  // console.log(testarray); 
  var addpricehtml=filedadd(document_row);
  $('#hp_price tbody').append(addpricehtml);
  
  $('#hp_price tbody tr:last').find('select').each( function (n, nval) {
            
          // Add Dynamic Service Options   
                if($(this).hasClass('location_get')){
         //  var getserviceitemsfromtext = $(this).html();          
          // var selectedservicestext = $('#getselectedservices').val();   
         //  var selectedservicestextarray = [];                      
          // if(testarray == '')
          // var testarray = []; 
            
          // $('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select' ).find('option').each(function (t,coption) {   
           $(this).find('option').each(function (t,coption) {   
             if($.inArray($(this).val(),testarray) != -1)
                $(this).remove();       
                //$('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select option[value='+ $(this).val() +']').remove();       
           });           
        }
        // Reload Sevice fields
       // reloadallserviceoptions();
        //-----------------------------------------
        
            });       
  document_row++;
}

// Reload all service fields
  function reloadallserviceoptions(){
  //console.log('test');  
       var selectedservicestextarray = [];   
       var $el=$(".location_get");
       $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
         if($(this).val() !=0){
          selectedservicestextarray.push($(this).val());
          }
      });
  
    $('#hp_price tbody' ).find('.location_get').each(function () { 
      
      var current_selected_field = '';
      var current_selected_option_value = $(this).val();
      var current_selected_field = '<option value = 0>Select Location</option>' ;
      
      $('#page-service-option-list-data').find('option').each(function () { 
        if(current_selected_option_value == $(this).val()){       
          current_selected_field += '<option value = \''+$(this).val()+'\' selected>'+$(this).html()+'</option>' ;          
        }             
        else if($.inArray($(this).val(),selectedservicestextarray) != -1){
          //$(this).remove(); 
        }       
        else
        {
          current_selected_field += '<option value = \''+$(this).val()+'\' >'+$(this).html()+'</option>' ;
        }
              
      }); 
      $(this).html(current_selected_field);
     });
  }

$(document).on("change", ".location_get", function(){
  $(this).find("option:selected").attr("selected", "selected");
     // Reload Sevice fields
        reloadallserviceoptions();
});

$(document).on('click','.delete-location-price',function(){ 
    // Reload Sevice fields
    reloadallserviceoptions();
   // $(this).closest('tr').remove(); 
  });
$(document).ready(function(){
  reloadallserviceoptions();
});
//--></script> 
<script type="text/javascript"><!--
var op_price_row = <?php echo $op_price_row; ?>;  
 
testarray='';
$(document).on("click", ".addopprice", function(){

  i = $('#op_price >tbody >tr').length;

  var data=[];
  var $el=$(".location_get_op");

  if(i !=0){
    $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
       if($(this).val() !=0){
        data.push($(this).val());
        }
    });
  }

var testarray='';

  if(data.length!=''){
    //console.log(data);
    testarray=data;
   /* $.each( data, function( key, value ) {
      alert( value.value );
      $(".location_get_op option[value='"+value.value+"']").remove();
    });*/
    //$("#selectBox option[value='option1']").remove();
  } else {
    testarray='';
  }

  //console.log(testarray);

  i = $('#op_price >tbody >tr').length;
var totallocation="<?php echo $locations['nr']; ?>";
  
  if(i < totallocation){
    opaddPrice(testarray);
  }
  
});


function opfiledadd(op_price_row){
   var addpricehtml  = '<tr id="op-price-row' + op_price_row + '">'; 

     addpricehtml += '  <td class="text-right"><input type="hidden" name="office_price_details[' + op_price_row + '][pp_id]" class="form-control" /><select name="office_price_details[' + op_price_row + '][location_id]" class="form-control location_get_op"><option value = 0>Select Location</option>';
    <?php foreach($locations['result'] as $location) { ?>
      addpricehtml += '<option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';

    //addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][per_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][pp_price_3_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][pp_price_6_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][pp_price_9_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][pp_price_12_month]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><select name="office_price_details[' + op_price_row + '][taxes]" id="tax_get" class="form-control">';
    <?php foreach($taxs['result'] as $tax_value) { ?>
      addpricehtml += '<option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';
   

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][security_deposit]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="office_price_details[' + op_price_row + '][handling_charge]" class="form-control" /></td>';      
    addpricehtml += '  <td class="text-left"><button type="button" onclick="$(\'#op-price-row' + op_price_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price-op"><i class="fa fa-minus-circle"></i></button></td>';
    addpricehtml += '</tr>';  

    return addpricehtml;
}

function opaddPrice(testarray) {
  // console.log(testarray); 
  var addpricehtml=opfiledadd(op_price_row);
  $('#op_price tbody').append(addpricehtml);
  
  $('#op_price tbody tr:last').find('select').each( function (n, nval) {
            
          // Add Dynamic Service Options   
                if($(this).hasClass('location_get_op')){
         //  var getserviceitemsfromtext = $(this).html();          
          // var selectedservicestext = $('#getselectedservices').val();   
         //  var selectedservicestextarray = [];                      
          // if(testarray == '')
          // var testarray = []; 
            
          // $('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select' ).find('option').each(function (t,coption) {   
           $(this).find('option').each(function (t,coption) {   
             if($.inArray($(this).val(),testarray) != -1)
                $(this).remove();       
                //$('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select option[value='+ $(this).val() +']').remove();       
           });           
        }
        // Reload Sevice fields
       // reloadallserviceoptions();
        //-----------------------------------------
        
            });       
  op_price_row++;
}

// Reload all service fields
  function reloadallserviceoptionsop(){
  //console.log('test');  
       var selectedservicestextarray = [];   
       var $el=$(".location_get_op");
       $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
         if($(this).val() !=0){
          selectedservicestextarray.push($(this).val());
          }
      });
  
    $('#op_price tbody' ).find('.location_get_op').each(function () { 
      
      var current_selected_field = '';
      var current_selected_option_value = $(this).val();
      var current_selected_field = '<option value = 0>Select Location</option>' ;
      
      $('#page-service-option-list-data-op').find('option').each(function () { 
        if(current_selected_option_value == $(this).val()){       
          current_selected_field += '<option value = \''+$(this).val()+'\' selected>'+$(this).html()+'</option>' ;          
        }             
        else if($.inArray($(this).val(),selectedservicestextarray) != -1){
          //$(this).remove(); 
        }       
        else
        {
          current_selected_field += '<option value = \''+$(this).val()+'\' >'+$(this).html()+'</option>' ;
        }
              
      }); 
      $(this).html(current_selected_field);
     });
  }

$(document).on("change", ".location_get_op", function(){
  $(this).find("option:selected").attr("selected", "selected");
     // Reload Sevice fields
        reloadallserviceoptionsop();
});

$(document).on('click','.delete-location-price-op',function(){ 
    // Reload Sevice fields
    reloadallserviceoptionsop();
   // $(this).closest('tr').remove(); 
  });
$(document).ready(function(){
  reloadallserviceoptionsop();
});
//--></script> 
<script type="text/javascript"><!--
var ep_price_row = <?php echo $ep_price_row; ?>;  
 
testarray='';
$(document).on("click", ".addepprice", function(){

  i = $('#ep_price >tbody >tr').length;

  var data=[];
  var $el=$(".location_get_ep");

  if(i !=0){
    $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
       if($(this).val() !=0){
        data.push($(this).val());
        }
    });
  }

var testarray='';

  if(data.length!=''){
    //console.log(data);
    testarray=data;
   /* $.each( data, function( key, value ) {
      alert( value.value );
      $(".location_get_op option[value='"+value.value+"']").remove();
    });*/
    //$("#selectBox option[value='option1']").remove();
  } else {
    testarray='';
  }

  //console.log(testarray);

  i = $('#ep_price >tbody >tr').length;
var totallocation="<?php echo $locations['nr']; ?>";
  
  if(i < totallocation){
    epaddPrice(testarray);
  }
  
});


function epfiledadd(ep_price_row){
   var addpricehtml  = '<tr id="ep-price-row' + ep_price_row + '">'; 

     addpricehtml += '  <td class="text-right"><input type="hidden" name="event_price_details[' + ep_price_row + '][pp_id]" class="form-control" /><select name="event_price_details[' + ep_price_row + '][location_id]" class="form-control location_get_ep"><option value = 0>Select Location</option>';
    <?php foreach($locations['result'] as $location) { ?>
      addpricehtml += '<option value="<?php echo $location['lo_id']; ?>" ><?php echo $location['lo_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';

	addpricehtml += ' <td class="text-right"><select name="product_price_detail[' + ep_price_row + '][features]"  class="form-control"><option value="N">No</option> <option value="Y">Yes</option></select></td>';
	
    addpricehtml += '  <td class="text-right"><input type="text" name="event_price_details[' + ep_price_row + '][per_month]" class="form-control" /></td>';
   
    addpricehtml += '  <td class="text-right"><select name="event_price_details[' + ep_price_row + '][taxes]" id="tax_get" class="form-control">';
    <?php foreach($taxs['result'] as $tax_value) { ?>
      addpricehtml += '<option value="<?php echo $tax_value['tax_id']; ?>" ><?php echo $tax_value['tax_name']; ?></option>';
    <?php } ?>  
     addpricehtml += '</select></td>';
   

    addpricehtml += '  <td class="text-right"><input type="text" name="event_price_details[' + ep_price_row + '][security_deposit]" class="form-control" /></td>';

    addpricehtml += '  <td class="text-right"><input type="text" name="event_price_details[' + ep_price_row + '][handling_charge]" class="form-control" /></td>';      
    addpricehtml += '  <td class="text-left"><button type="button" onclick="$(\'#ep-price-row' + ep_price_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger delete-location-price-op"><i class="fa fa-minus-circle"></i></button></td>';
    addpricehtml += '</tr>';  

    return addpricehtml;
}

function epaddPrice(testarray) {
  // console.log(testarray); 
  var addpricehtml=epfiledadd(ep_price_row);
  $('#ep_price tbody').append(addpricehtml);
  
  $('#ep_price tbody tr:last').find('select').each( function (n, nval) {
            
          // Add Dynamic Service Options   
                if($(this).hasClass('location_get_ep')){
         //  var getserviceitemsfromtext = $(this).html();          
          // var selectedservicestext = $('#getselectedservices').val();   
         //  var selectedservicestextarray = [];                      
          // if(testarray == '')
          // var testarray = []; 
            
          // $('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select' ).find('option').each(function (t,coption) {   
           $(this).find('option').each(function (t,coption) {   
             if($.inArray($(this).val(),testarray) != -1)
                $(this).remove();       
                //$('#merchant-service-pricing-table tbody tr:last .merchant-profile-service-service-select option[value='+ $(this).val() +']').remove();       
           });           
        }
        // Reload Sevice fields
       // reloadallserviceoptions();
        //-----------------------------------------
        
            });       
  ep_price_row++;
}

// Reload all service fields
  function reloadallserviceoptionsep(){
  //console.log('test');  
       var selectedservicestextarray = [];   
       var $el=$(".location_get_ep");
       $el.find('option:selected').each(function(){
       // data.push({value:$(this).val(),text:$(this).text()});
         if($(this).val() !=0){
          selectedservicestextarray.push($(this).val());
          }
      });
  
    $('#ep_price tbody' ).find('.location_get_ep').each(function () { 
      
      var current_selected_field = '';
      var current_selected_option_value = $(this).val();
      var current_selected_field = '<option value = 0>Select Location</option>' ;
      
      $('#page-service-option-list-data-ep').find('option').each(function () { 
        if(current_selected_option_value == $(this).val()){       
          current_selected_field += '<option value = \''+$(this).val()+'\' selected>'+$(this).html()+'</option>' ;          
        }             
        else if($.inArray($(this).val(),selectedservicestextarray) != -1){
          //$(this).remove(); 
        }       
        else
        {
          current_selected_field += '<option value = \''+$(this).val()+'\' >'+$(this).html()+'</option>' ;
        }
              
      }); 
      $(this).html(current_selected_field);
     });
  }

$(document).on("change", ".location_get_ep", function(){
  $(this).find("option:selected").attr("selected", "selected");
     // Reload Sevice fields
        reloadallserviceoptionsep();
});

$(document).on('click','.delete-location-price-ep',function(){ 
    // Reload Sevice fields
    reloadallserviceoptionsep();
   // $(this).closest('tr').remove(); 
  });
$(document).ready(function(){
  reloadallserviceoptionsep();
});








function getdata(sval,div,func)
{
  $('#'+div).html('Loading...');
  $.ajax({url: '<?php echo ADMIN_URL.$path_folder."ajax.php" ?>',type: 'post',async:false,data:{ "func": func, "id": sval },
  success:function(result)
  {
    if(result)
    {
      $('#'+div).html(result);
    }else
    {
      $('#'+div).html('');
    }
  }});
}








//--></script>



<script type="text/javascript">
 document.getElementById('p_category').addEventListener('change', function () {
    var style = this.value == 3 ? 'block' : 'none';
    document.getElementById('hidden_div').style.display = style;
	 var style1 = this.value == 3 ? 'none' : 'block';
	document.getElementById('month_div').style.display = style1;
});

</script>






<script type="text/javascript">
        function ddlValidate() {
            var e = document.getElementById("ddlView");
            var optionSelIndex = e.options[e.selectedIndex].value;
   
            if (optionSelIndex == 0) {
                alert("Location Name");
            }
            else {
                alert("Success !! You have selected Course : " + optionSelectedText); ;
            }
        }
    </script>










</body></html>