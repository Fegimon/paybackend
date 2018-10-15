<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$id = $conn->variable($q);
$sel = $conn->select_query(OPERATOR,"*","op_id='".$id."'","1");
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
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">View <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" class="form-horizontal" >
                <dl class="dl-horizontal">
                  <dt>Name :</dt>
                  <dd><?php echo $conn->stripval($sel['op_name']);?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Username :</dt>
                  <dd><?php echo $conn->stripval($sel['op_uname']);?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Password :</dt>
                  <dd><?php echo $conn->decpyt($sel['op_password']);?></dd>
                </dl>
                <?php if($sel['feat_id']!=""){
				 $Menus = $conn->select_query(ADMINMENU,"menu_title","pid='0' AND menu_status='Y' AND menu_id IN(".$sel['feat_id'].") order by menu_pos","");
				}
				if($Menus['nr'])
				{
					foreach($Menus['result']as $mtitle)
					{
						$titlearr[]=$mtitle['menu_title'];
					}
					$opfet= @implode(', ',$titlearr);
				}
				?>
                <dl class="dl-horizontal">
                  <dt>Features :</dt>
                  <dd><?php echo $conn->stripval($opfet);?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Status :</dt>
                  <dd><?php echo ($sel['op_status']=="Y")?"Active":"Inactive"; ?></dd>
                </dl>
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
</body></html>