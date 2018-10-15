<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(BRAND,"*","brand_id='".$id."'","1");
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
                  <dt>Name :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['brand_name']));?></dd>
                </dl>
                 <dl class="dl-horizontal">
                  <dt>Image  :</dt>
				  <?php $TMexist = $conn->image_exist($sel['brand_img'],"../../".$uploadFolder);
						$img = ($TMexist) ? $uploadFolder.$sel['brand_img'] : "images/noimg.jpg";?>
                  <dd><img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" /></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>DATE :</dt>
				  <dd><?php echo ($sel['brand_dt']=="0000-00-00")?"-":date('d-m-Y',strtotime($sel['brand_dt']));?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Position :</dt>
                  <dd><?php echo $conn->stripval($sel['brand_pos']);?></dd>
                </dl>
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