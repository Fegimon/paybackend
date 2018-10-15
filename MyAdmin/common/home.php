<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');

$conn->check_admin();

?>
<?php #Admin Html head
$extrahead="<style>
.home-menu:hover{
transform: scale(1.02);
box-shadow: 1px 1px 5px #792da6;
webkit-animation-name: shakeit;
-webkit-animation-duration: 1s;
-webkit-animation-timing-function: linear;
-webkit-animation-iteration-count: infinite;
animation-name: shakeit;
animation-duration: 1s;
animation-timing-function: linear;
animation-iteration-count: infinite;
}
</style>";
$conn->adminHtmlhead($extrahead);
$conn->admninBody(); 

?>
<div class="wrapper">
  <?php include "../layout/header.php";  ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Home </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="<?php echo ADMIN_URL."common/home.php" ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        
      </ol>
    </section>
    <?php 	
	
	if($_SESSION['type']=='O')
	{
		if($sel_op['feat_id'])
		{
			$hmemcond=" AND menu_id IN (".$sel_op['feat_id'].")";
		}else
		{
			$hmemcond=" AND menu_id IN ('')";
		}
	}
	$Homemenu = $conn->select_query(ADMINMENU,"*","menu_status='Y' AND menu_home='Y' ".$hmemcond." order by menu_pos","");
	 ?>

    <!-- Main content -->
    <section class="content"> 
      <!-- Info boxes -->
      <div class="row">
      <?php if($Homemenu['nr']){
		  $size=$Homemenu['nr'];
		  $r=0;
		  //$randcolorarr=$conn->randcolor($size); #F07722 #055996
		  $randcolorarr=array('#F07722','#055996','#F07722','#055996','#F07722','#055996','#F07722','#055996','#F07722','#055996','#F07722','#055996','#F07722','#055996');
		  foreach($Homemenu['result']as $reshmenu){?>
          <div class="col-md-3 col-sm-6 col-xs-12"> <a href="<?php echo ADMIN_URL.$reshmenu['menu_link']; ?>" title="<?php echo $conn->stripval(ucfirst($reshmenu['menu_title']));  ?>">
          <div class="info-box home-menu"> <span class="info-box-icon" style=" background:<?php echo $randcolorarr[$r++] ?>; color:#FFF"><i class="fa <?php echo $conn->stripval($reshmenu['menu_icon']); ?>"></i></span>
            <div class="info-box-content"> <span class="info-box-text"><?php echo $conn->stripval(ucfirst($reshmenu['menu_title']));  ?></span>  </div>
            <!-- /.info-box-content --> 
          </div>
          </a> 
          <!-- /.info-box --> 
        </div>
      <?php } } ?>
      
      </div>
      
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