<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#search_records
if(isset($btn_search))
{
	$ts=base64_encode($conn->variable($txtsearch));
	$tokencond=($token=="inactive")?"?token=inactive":"?token=active";
	$conn->divert("list.php".$tokencond."&txtsearch=".$ts);
}

#Actions Inactive
/*if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".TAX." SET tax_status='N' WHERE tax_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully inactivated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}*/

#Actions processing
if($btn_action=="Action"&&$action=="processing")
{
	$selData = @implode(",",$chkall);
  //print_r($selData);

	$upd_processing = $conn->Execute("UPDATE ".PRODUCTRETURN." SET status='Y' WHERE id IN(".$selData.")");
	if($upd_processing)
	{
		$succAlert = "Data successfully processing.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}


#Actions completed

if($btn_action=="Action"&&$action=="completed")
{
  $selData = @implode(",",$chkall);
  //print_r($selData);

  $upd_completed = $conn->Execute("UPDATE ".PRODUCTRETURN." SET status='C' WHERE id IN(".$selData.")");
  if($upd_completed)
  {
    $succAlert = "Data successfully completed.";
    $conn->adminAlert($pageKey,$succAlert);
    $conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
  }
}



/*#Actions shipped


if($btn_action=="Action"&&$action=="shipped")
{
  $selData = @implode(",",$chkall);
  //print_r($selData);

  $upd_shipped = $conn->Execute("UPDATE ".ORDER." SET status='3' WHERE order_id IN(".$selData.")");
  if($upd_shipped)
  {
    $succAlert = "Data successfully shipped.";
    $conn->adminAlert($pageKey,$succAlert);
    $conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
  }
}
*/


if($btn_action=="Action"&&$action=="cancelled")
{
  $selData = @implode(",",$chkall);
  //print_r($selData);

  $upd_cancelled = $conn->Execute("UPDATE ".PRODUCTRETURN." SET status='N' WHERE id IN(".$selData.")");
  if($upd_cancelled)
  {
    $succAlert = "Data successfully cancelled.";
    $conn->adminAlert($pageKey,$succAlert);
    $conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
  }
}




#Actions Delete
if($btn_action=="Action"&&$action=="Delete")
{
	$selData = @implode(",",$chkall);
	$upd_inactive = $conn->Execute("UPDATE ".PRODUCTRETURN." SET status='D' WHERE id IN(".$selData.")",1);

	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}

#Change paging  
if($showpage)
{
	$_SESSION['page'][$pageKey]=$showpage;
}





#Select Records


$cond = ($token=="inactive") ? "order_status_id='1'" : "order_status_id='1'";




switch($token)
{
 
  
  case 'pending':$cond= "status='W'";
  $ttxt="Pending";
  $website_cond="pending";
  $orderby="id asc";
  break;

  case 'processing':$cond= "status='Y'";
  $ttxt="processing";
  $website_cond="processing";
  $orderby="id asc";
  break;
  
  case 'completed':$cond= "status='C'";
  $ttxt="completed";
  $website_cond="completed";
  $orderby="id asc";
  break;



case 'cancelled':$cond= "status='N'";
  $ttxt="cancelled";
  $website_cond="cancelled";
  $orderby="id asc";
  break;


  default :$cond= "status='W'";
  $ttxt="Pending";
  $website_cond=$token="pending";
  $orderby="id asc";
  break;  
}

#Select Records
//$cond = ($token=="inactive") ? "order_status_id='1'" : "order_status_id='1'";
if($txtsearch)
{
	$cond .= " AND (tax_name LIKE '%".base64_decode($txtsearch)."%' OR tax_percentage LIKE '%".base64_decode($txtsearch)."%')";
	$urlcond='&txtsearch='.$txtsearch;
}

#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);
$website_cond = ($token=="inactive") ? "inactive" : "active";
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(PRODUCTRETURN,"*",$cond,"id desc",$website,$paging,$_GET['page']);


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
                <p class="<?php echo ($token=="inactive")?"text-red":"text-green"?>"><?php echo ($token=="inactive")?"Inactive":"Active"; ?> <?php echo $Pagetitle['title']; ?></p>
              </h3>
              <div class="pull-right" >
                <form name="adminpage" id="adminpage" method="post">
                  <span class="text-blue">Show :</span>
                  <select id="showpage" name="showpage" style="width:50px; margin-right:5px;" onchange="adminpagechange();">
                    <?php echo $conn->adminpageoption($EXTRA_ARG['set_bpsize'],$paging); ?>
                  </select>
                  <span class="text-blue">per page</span>
                </form>
              </div>
            </div>
			<div class="box-header">
              <div class="col-md-4 pull-right">
                <form name="frm_search" id="frm_search" method="post" action="">
                  <div class="input-group">
                    <input type="text" name="txtsearch" id="txtsearch" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="<?php echo $conn->stripval(base64_decode($txtsearch))?>" maxlength="150"  />
                    <div class="input-group-btn">
                      <button class="btn btn-sm btn-default" type="submit" value="search" name="btn_search" id="btn_search"><i class="fa fa-search"></i></button>
                      <?php if($txtsearch){?>
                      <button title="Clear" class="btn btn-sm btn-default text-red" type="button" value="search" name="clearsearch" id="clearsearch"><i class="fa fa-close"></i></button>
                      <?php }?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="5%">#</th>
                    <th class="head_text" width="25%">Order ID</th>
                     <th class="head_text" width="25%">User Name</th>
                    <th class="head_text" width="25%">Comments</th>
                    <th class="head_text" width="15%">Date</th>
                 <!--    <th class="head_text" width="15%">Total</th> -->
					          <!--<th class="head_text" width="10%">Edit</th>-->
                    <th class="head_text" width="10%">View</th>
                   <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{
                
				
               $orders = $conn->select_query(ORDER,"*","ord_id ='".$res['main_ord_id']."'","1");
			    $users = $conn->select_query(USER,"*","user_id ='".$res['user_id']."'","1");
               // $order_status = $conn->select_query(PRODUCTRETURN,"*","status='".$res['status']."' AND status='W'","1");
								$sino++;
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
                    <td class="td_text"><?php echo $conn->stripval($orders['order_id']);?></td>
                     <td class="td_text"><?php echo $conn->stripval(ucfirst($users['user_name']));?></td>
                    <td class="td_text"><?php echo $res['comments']; ?></td>
                    <td class="td_text"><?php echo $res['date_time']; ?></td>
                   <!--  <td class="td_text"><?php echo $order_status['comments']; ?></td> -->
                    <!-- <td class="td_text">&#x20B9;<?php echo round($res['total']); ?></td> -->

                   <?php /* ?> <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."form.php"?>?q=<?php echo $res['tax_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td><?php */ ?>

					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."view.php"?>?q=<?php echo $res['id'];?>"  title="View"><i class="fa fa-file-text"></i></a></td>
				<?php  ?><td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['id']; ?>" /></td><?php  ?>
                  </tr>
                  <?php }?>
                </table>
                <?php }else{?>
                <div class="alert alert-dismissable col-md-4 col-md-offset-4">
                  <h3 class="text-red"><i class="icon fa fa-ban"></i>No record found!</h3>
                </div>
                <?php }?>
              </div>
              <?php if($selTable['nr'] && $token!='completed' && $token!='cancelled'){?>
              <div class="box-footer clearfix">
                <div  class="col-sm-5 clearfix" >&nbsp;
                  <?php if($selTable['nr']>$paging){echo $selTable['page'];}?>
                </div>
                <div class="col-sm-7" style="text-align:right;padding-top:18px;" >Action :
                  <Select style="width:100px; margin-right:5px;" name="action" id="action">

                        
                        <?php if($token=="pending"){ ?>
                         <option value="">--Select--</option>
                        <option value="processing">PROCESSING</option>
                        <option value="cancelled">CANCELLED</option>
                        <?php }?>
                        <?php if($token=="processing"){ ?>
                         <option value="">--Select--</option>
                       <option value="completed">COMPLETED</option>
                        <option value="cancelled">CANCELLED</option> 
                        <?php }?>
                        

                           <?php if($token=="completed"){ ?>
                  
                        <?php }?>

                         <?php if($token=="cancelled"){ ?>
                  
                        <?php }?>
                      


                  </Select>















                  <button name="btn_action" class="btn btn-primary btn-sm " type="submit" value="Action" id="btn_action" onClick="return check_confirm('Are you sure want to do the action?');"><i class="fa fa-bolt"></i> Action</button>
                  <button name="selectall" id="selectall" class="btn btn-primary btn-sm" type="button" onClick="if(markAll()) return false;" >Select all</button>
                  <button name="deselectall" id="deselectall" class="btn btn-primary btn-sm" type="button"onclick="if(unmarkAll()) return false;" >Deselect All</button>
                </div>
              </div>







              <?php } ?>
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
<script type="text/javascript">  
jQuery(document).ready(function() {
jQuery("#frm_list").validationEngine();
});
jQuery('#clearsearch').click( function (){ window.location.href="<?php echo ADMIN_URL.$path_folder."list.php?token=".$_REQUEST['token'];?>";  });
</script>

</body>
</html>