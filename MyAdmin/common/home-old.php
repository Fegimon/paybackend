<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin</title>
<?php include "../layout/title.php"; ?>
<style>

.home-menu:hover{
transform: scale(1.02);
box-shadow: 1px 1px 5px #792da6;
}
</style>
</head>
<body class="skin-custom sidebar-mini">
<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Home </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="<?php echo ADMIN_URL."common/home.php" ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <?php /*?><li >Dashboard</li><?php */?>
      </ol>
    </section>
    <?php if($_SESSION['type']=='O')
	{
		$extrcond=" AND user_type='O' AND user_id='".$_SESSION['admin_id']."'";
	}
	
	$Homecounts=$conn->getRow("Select * from (select count(banner_id) as actbanner from ".BANNER." WHERE banner_status='Y' limit 1)as a,(select count(banner_id)inactbanner  from ".BANNER." WHERE banner_status='N'  limit 1)as b,(select count(event_id) as actevent from ".EVENTS." WHERE event_status='Y' ".$extrcond." limit 1)as c,(select count(event_id)inactevent   from ".EVENTS." WHERE event_status='N' ".$extrcond." limit 1)as d");
	?>

    <!-- Main content -->
    <section class="content"> 
      <!-- Info boxes -->
      <div class="row">
       <?php if( $_SESSION['type']=='admin'||($_SESSION['type']!='admin'&&@in_array("Settings", $arr_feat_id)))
		  { ?>
        <div class="col-md-3 col-sm-6 col-xs-12"> <a href="<?php echo ADMIN_URL; ?>common/admin_settings.php" title="Settings">
          <div class="info-box home-menu"> <span class="info-box-icon bg-purple"><i class="fa fa-gear"></i></span>
            <div class="info-box-content"> <span class="info-box-text">Settings</span>  </div>
            <!-- /.info-box-content --> 
          </div>
          </a> 
          <!-- /.info-box --> 
        </div>
        <?php }
		 if( $_SESSION['type']=='admin'||($_SESSION['type']!='admin'&&@in_array("Banner", $arr_feat_id)))
		  { ?>
        <div class="col-md-3 col-sm-6 col-xs-12"> <a href="<?php echo ADMIN_URL; ?>banner/list.php">
          <div class="info-box home-menu"> <span class="info-box-icon bg-aqua"><i class="fa fa-image"></i></span>
            <div class="info-box-content"> <span class="info-box-text">Banner</span> <span class="info-box-number"><span class="badge bg-green"><?php echo$Homecounts['actbanner'];  ?></span> | <span class="badge bg-red"><?php echo$Homecounts['inactbanner'];  ?></span><small></small></span> </div>
            <!-- /.info-box-content --> 
          </div>
          </a> 
          <!-- /.info-box --> 
        </div>
        <?php }
		if( $_SESSION['type']=='admin'||($_SESSION['type']!='admin'&&@in_array("Calender", $arr_feat_id))){?>
        <div class="col-md-3 col-sm-6 col-xs-12"> <a href="<?php echo ADMIN_URL; ?>common/calender.php" title="Calender">
          <div class="info-box home-menu"> <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content"> <span class="info-box-text">Calender</span> <span class="info-box-number"><span class="badge bg-green"><?php echo$Homecounts['actevent'];  ?></span> | <span class="badge bg-red"><?php echo$Homecounts['inactevent'];  ?></span><small></small></span> </div>
            <!-- /.info-box-content --> 
          </div>
          </a> 
          <!-- /.info-box --> 
        </div>
        <?php }?>
        
        <?php /*?><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
            <div class="info-box-content"> <span class="info-box-text">Likes</span> <span class="info-box-number">41,410</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col --> 
        
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box"> <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content"> <span class="info-box-text">Sales</span> <span class="info-box-number">760</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content"> <span class="info-box-text">New Members</span> <span class="info-box-number">2,000</span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div><?php */?>
        <!-- /.col --> 
      </div>
      <!-- /.row -->
      
      <?php /*?><div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <div class="btn-group">
                  <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center"> <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> </p>
                  <div class="chart"> 
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180"></canvas>
                  </div>
                  <!-- /.chart-responsive --> 
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center"> <strong>Goal Completion</strong> </p>
                  <div class="progress-group"> <span class="progress-text">Add Products to Cart</span> <span class="progress-number"><b>160</b>/200</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group"> <span class="progress-text">Complete Purchase</span> <span class="progress-number"><b>310</b>/400</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group"> <span class="progress-text">Visit Premium Page</span> <span class="progress-number"><b>480</b>/800</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group"> <span class="progress-text">Send Inquiries</span> <span class="progress-number"><b>250</b>/500</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group --> 
                </div>
                <!-- /.col --> 
              </div>
              <!-- /.row --> 
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right"> <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block"> <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span> </div>
                  <!-- /.description-block --> 
                </div>
              </div>
              <!-- /.row --> 
            </div>
            <!-- /.box-footer --> 
          </div>
          <!-- /.box --> 
        </div>
        <!-- /.col --> 
      </div><?php */?>
      <!-- /.row --> 
      
      <!-- Main row --> 
      
      <!-- /.row --> 
    </section>
    <!-- /.content --> 
  </div>

<!-- ./wrapper -->
<?php include "footer.php"; ?>
  <!-- /.content-wrapper -->
</div>
<?php include "footer-scripts.php"; ?>

</body>
</html>