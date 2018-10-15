<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(USER,"*","user_id='".$id."'","1");
 $user_country_name_details = $conn->select_query(COUNTRY,"*"," country_id='".$sel['user_country']."' AND status='1'","1"); 
  if($user_country_name_details['nr']){
    $user_country_name=$user_country_name_details['name'];
  } else {
    $user_country_name='';    
  }
    
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
                  <dt>User Name:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_name']));?></dd>
                </dl>
				<dl class="dl-horizontal">
                  <dt>User Email:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_email']));?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Password :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_pwd']));?></dd>
                </dl>
				<dl class="dl-horizontal">
                  <dt>YourName:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_yourname']));?></dd>
                </dl>
				<dl class="dl-horizontal">
                  <dt>Age :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_age']));?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>Address:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_address']));?></dd>
                </dl>
        <dl class="dl-horizontal">
                  <dt>City:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['user_city']));?></dd>
                </dl>
				<dl class="dl-horizontal">
                  <dt>Country:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($user_country_name));?></dd>
                </dl>
				<!--<dl class="dl-horizontal">
                  <dt>IP Address:</dt>
                  <dd><?php echo $conn->stripval($sel['user_ip']);?></dd>
                </dl> -->
                <dl class="dl-horizontal">
                  <dt>Date :</dt>
				  <dd><?php echo ($sel['user_dt']=="0000-00-00")?"-":date('d-m-Y',strtotime($sel['user_dt']));?></dd>
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
