<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(PRODUCT,"*","p_id='".$id."'","1");

$images_list = $conn->select_query(PRODUCTIMAGE,"*"," product_id =".$id." order by product_image_id",""); 
$specification_list = $conn->select_query(PRODUCTSPECIFICATION,"*"," product_id =".$id." order by ps_id",""); 
$house_price_list = $conn->select_query(PRODUCTPRICE,"*"," pp_price_option='hp' AND pp_product_id =".$id." order by pp_id",""); 
$office_price_list = $conn->select_query(PRODUCTPRICE,"*"," pp_price_option='op' AND pp_product_id =".$id." order by pp_id",""); 
$event_price_list = $conn->select_query(PRODUCTPRICE,"*"," pp_price_option='ep' AND pp_product_id =".$id." order by pp_id",""); 

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
      <h1> <?php echo $Pagetitle['title']; ?>
      </h1>
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
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">View <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" class="form-horizontal" >
                <!-- text input -->
        <dl class="dl-horizontal">
                  <dt>Product Name :</dt> 
                  <dd><?php echo $conn->stripval(ucfirst($sel['p_name'])); ?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>slug :</dt>
                  <dd><?php echo $conn->stripval($sel['p_slug']); ?></dd>
                </dl>
                
                 <dl class="dl-horizontal">
                  <dt>Search Key :</dt>
                  <dd><?php echo $conn->stripval($sel['meta_key']); ?></dd>
                </dl>
                        
        <dl class="dl-horizontal">
                  <dt>Product Description :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['p_desc'])); ?></dd>
                </dl>
                 <dl class="dl-horizontal">
                  <dt>Cover Image :</dt>
                  <?php $TMexist = $conn->image_exist($sel['p_image'],"../../".$uploadFolder);
            $img = ($TMexist) ? $uploadFolder.$sel['p_image'] : "images/noimg.jpg";?>
                  <dd><img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" /></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Date Added :</dt>
                  <dd><?php echo date("d-m-Y",strtotime($sel['p_date_dt']));?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Cateogry :</dt>
                  <?php $categorys = $conn->select_query(CATEGORY, "cat_title", "cat_id IN(".$sel['p_category'].") AND cat_status='Y' order by cat_pos",""); ?>
                  <dd><?php $i=0; foreach ($categorys['result'] as $category) { if($i!=0){ echo ', '; } echo $category['cat_title'];  $i++; } ?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Sub Cateogry :</dt>
                  <?php $categorys = $conn->select_query(CATEGORY, "cat_title", "cat_id IN(".$sel['p_sub_category'].") AND cat_status='Y' order by cat_pos",""); ?>
                  <dd><?php $i=0; foreach ($categorys['result'] as $category) { if($i!=0){ echo ', '; } echo $category['cat_title'];  $i++; } ?></dd>
                </dl>
       <?php /* ?> <?php if($sel['post_preparation']){ ?>
        <dl class="dl-horizontal">
                  <dt>Preparation / Environment :</dt>
                  <dd><?php echo $conn->stripval($sel['post_preparation']);?></dd>
                </dl>
        <?php } ?>
        <dl class="dl-horizontal">
                  <dt>Activity:</dt>
                  <dd><?php echo $conn->stripval($sel['post_activity']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Youtube url:</dt>
                  <dd><?php echo $conn->stripval($sel['post_youtubeurl']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Teacher Role's :</dt>
                  <dd><?php echo $conn->stripval($sel['post_teacher_role']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Competencies :</dt>
                <?php foreach ($competence_list['result'] as $key => $value) {
                  echo '<dd> '.$value['competence_name'].'</dt>';
                } ?> 
                </dl>
        <dl class="dl-horizontal">
                  <dt>Materials:</dt>
                  <dd><?php echo $conn->stripval($sel['post_materials']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Required Hardware :</dt>
                  <dd><?php echo $conn->stripval($sel['post_hardware']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Nature of Tool:</dt>
                  <dd><?php echo $conn->stripval($sel['post_n_tool']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Time Duration:</dt>
                  <dd><?php echo $conn->stripval($sel['post_time_duration']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Tag:</dt>
                  <dd><?php echo $conn->stripval($sel['post_tag']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Can see the feild:</dt>
                  <dd><?php echo $conn->stripval($sel['post_see']);?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Image  :</dt>
          <?php $TMexist = $conn->image_exist($sel['post_image'],"../../".$uploadFolder);
            $img = ($TMexist) ? $uploadFolder.$sel['post_image'] : "images/noimg.jpg";?>
                  <dd><img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" /></dd>
                </dl>   
                <?php */ ?>
                <?php if($images_list['nr']) { ?>
        <dl class="dl-horizontal">
                  <dt>Supporting Image  :</dt>
          <?php foreach ($images_list['result'] as $key => $value) {  
            $TMexist = $conn->image_exist($value['product_image'],"../../".$uploadFolder);
            $img = ($TMexist) ? $uploadFolder.$value['product_image'] : "images/noimg.jpg";?>
                  <dd><img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" /></dd><br>
          <?php } ?>        
                </dl> 
                <?php } ?>    

                 <?php if(!empty($specification_list['nr'])){ ?>
                    <dl class="dl-horizontal">
                    <dt>Specifications :</dt>
                      <dd> <table class="table table-striped table-bordered table-hover"> <th>Name</th><th>Detail</th>               
                        <?php foreach ($specification_list['result'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['ps_name']; ?></td>
                            <td><?php echo $value['ps_detail']; ?></td>
                        </tr>
                        <?php } ?>
                        </table>  
                      </dd>
                  <?php } ?> 

                 <?php if(!empty($house_price_list['nr'])){ ?>
                    <dl class="dl-horizontal">
                    <dt>House Price List :</dt>
                      <dd> <table class="table table-striped table-bordered table-hover"> <th>Location Name</th><th>Rent Per 1 Month</th><th>Rent Per 2 Month</th><th>Rent Per 3 Month</th><th>Rent Per 4 Month</th> <th>Taxes</th><th>Security Deposit</th><th>Handling Charge</th>              
                        <?php foreach ($house_price_list['result'] as $key => $value) { 

                          $location = $conn->select_query(LOCATION,"*","lo_id='".$value['pp_location_id']."' AND lo_status='Y'","1");

                          $tax = $conn->select_query(TAX,"*","tax_id='".$value['pp_taxes']."' AND tax_status='Y'","1");

                          ?>
                        <tr>
                            <td><?php echo $location['lo_name']; ?></td> 
                            <td><?php echo $value['pp_price_3_month']; ?></td>  
                            <td><?php echo $value['pp_price_6_month']; ?></td>  
                            <td><?php echo $value['pp_price_9_month']; ?></td>  
                            <td><?php echo $value['pp_price_12_month']; ?></td>  
                            <td><?php echo $tax['tax_name']; ?></td>                            
                            <td><?php echo $value['pp_security_deposit']; ?></td>  
                            <td><?php echo $value['pp_handling_charge']; ?></td>  
                        </tr>
                        <?php } ?>
                        </table>  
                      </dd>
                  <?php } ?> 

                 <?php if(!empty($office_price_list['nr'])){ ?>
                    <dl class="dl-horizontal">
                    <dt>Office Price List :</dt>
                      <dd> <table class="table table-striped table-bordered table-hover"> <th>Location Name</th><th>Rent Per 1 Month</th><th>Rent Per 2 Month</th><th>Rent Per 3 Month</th><th>Rent Per 4 Month</th> <th>Taxes</th><th>Security Deposit</th><th>Handling Charge</th>              
                        <?php foreach ($office_price_list['result'] as $key => $value) { 

                          $location = $conn->select_query(LOCATION,"*","lo_id='".$value['pp_location_id']."' AND lo_status='Y'","1");

                          $tax = $conn->select_query(TAX,"*","tax_id='".$value['pp_taxes']."' AND tax_status='Y'","1");

                          ?>
                        <tr>
                            <td><?php echo $location['lo_name']; ?></td>    
                            <td><?php echo $value['pp_price_3_month']; ?></td>  
                            <td><?php echo $value['pp_price_6_month']; ?></td>  
                            <td><?php echo $value['pp_price_9_month']; ?></td>  
                            <td><?php echo $value['pp_price_12_month']; ?></td>  
                            <td><?php echo $tax['tax_name']; ?></td>                            
                            <td><?php echo $value['pp_security_deposit']; ?></td>  
                            <td><?php echo $value['pp_handling_charge']; ?></td>  
                        </tr>
                        <?php } ?>
                        </table>  
                      </dd>
                  <?php } ?> 

                 <?php if(!empty($event_price_list['nr'])){ ?>
                    <dl class="dl-horizontal">
                    <dt>Event Price List :</dt>
                      <dd> <table class="table table-striped table-bordered table-hover"> <th>Location Name</th><th>Rent Per Day</th><th>Taxes</th><th>Security Deposit</th><th>Handling Charge</th>              
                        <?php foreach ($event_price_list['result'] as $key => $value) { 

                          $location = $conn->select_query(LOCATION,"*","lo_id='".$value['pp_location_id']."' AND lo_status='Y'","1");

                          $tax = $conn->select_query(TAX,"*","tax_id='".$value['pp_taxes']."' AND tax_status='Y'","1");

                          ?>
                        <tr>
                            <td><?php echo $location['lo_name']; ?></td>  
                            <td><?php echo $value['ps_price_month']; ?></td>  
                            <td><?php echo $tax['tax_name']; ?></td>                            
                            <td><?php echo $value['pp_security_deposit']; ?></td>  
                            <td><?php echo $value['pp_handling_charge']; ?></td>  
                        </tr>
                        <?php } ?>
                        </table>  
                      </dd>
                  <?php } ?> 

        
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
</body></html>