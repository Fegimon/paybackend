<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#New Admin paging
$selTable = $conn->select_query(FEATUREDPRODUCT, "*", "");
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
      <?php //include "submenu.php"; ?>
     
      <!-- Default box -->
      <div class="row">    
        <div class="col-xs-12">
          <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo ADMIN_URL.$path_folder; ?>form.php" title="Add"> <i class="fa fa-file-o"></i> Add </a>
          </div>
        </div>   
        <div class="col-xs-12">
          <?php if($bannerAlert){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $bannerAlert; ?> </div>
          <?php }?>
          <div class="box <?php echo ($token=="inactive")?"box-danger":"box-success"; ?>">
            <div class="box-header">
              <h3 class="box-title">
                <p class="text-green"><?php echo $Pagetitle['title']; ?></p>				
			        </h3>
            </div>

			            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="10%">#</th>
                    <th class="head_text" width="10%">Product Name</th>
                    <th class="head_text" width="10%">Category</th>
					          <th class="head_text" width="10%">Date</th> 
                  </tr>
                  <?php 
							$sino = 0;
							foreach($selTable['result'] as $res)
							{
                $p_details = $conn->select_query(PRODUCT,"*","p_status='Y' AND p_id='".$res['fp_prodict_id']."'","1");
                if($p_details['nr']){
								  $sino++;
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>					
          					<td class="td_text"><?php echo $conn->stripval(ucfirst($p_details['p_name']));?></td>		
                    <td class="td_text">
                      <?php if($res['fp_price_id']=="hp"){ 
                        echo $conn->stripval(ucfirst("House Price")); 
                      }elseif($res['fp_price_id']=="op"){
                        echo $conn->stripval(ucfirst("Office Price")); 
                      }elseif($res['fp_price_id']=="ep"){
                        echo $conn->stripval(ucfirst("Event Price"));                         
                      } ?>
                    </td>    											
          					<td class="td_text"><?php echo date("d-m-Y",strtotime($res['fp_added_on']));?></td>
				          </tr>
                  <?php } } ?>
                </table>
                <?php }else{?>
                <div class="alert alert-dismissable col-md-4 col-md-offset-4">
                  <h3 class="text-red"><i class="icon fa fa-ban"></i>No record found!</h3>
                </div>
                <?php }?>
              </div>
             
            </form>
            <!-- /.box-body --> 
            
          </div>
          <!-- /.box --> 
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper --> 
  <!-- ./wrapper -->
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>js/checkbox.js"></script> 
<!----> 

</body>
</html>
