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

#update status
if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".OPERATOR." SET op_status='N' WHERE op_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully inactivated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
		
	}
}
if($btn_action=="Action"&&$action=="Active")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".OPERATOR." SET op_status='Y' WHERE op_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully activated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}

#delete status
if($btn_action=="Action"&&$action=="Delete")
{
	$selData = @implode(",",$chkall);
	$upd_inactive = $conn->Execute("UPDATE ".OPERATOR." SET op_status='D' WHERE op_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully Deleted.";
		$conn->adminAlert($pageKey,$succAlert);
	}
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}


#Change paging  
if($showpage)
{
	$_SESSION['page'][$pageKey]=$showpage;
}

#select Records
$cond = ($token=="inactive") ? "op_status='N'" : "op_status='Y'";

if($_SESSION['type']=='O')
{
	$cond.=" AND op_id!='".$_SESSION['admin_id']."'";
}

if($txtsearch)
{
	$cond .= " AND ((op_name LIKE '%".base64_decode($txtsearch)."%') OR (op_uname LIKE '%".base64_decode($txtsearch)."%'))";
	$urlcond ="&txtsearch=".$txtsearch;
}
#Alert session
$operatorAlert=$conn->getadminAlert($pageKey);
$website_cond = ($token=="inactive") ? "inactive" : "active";
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(OPERATOR,"*",$cond,"op_id asc",$website,$paging,$_GET['page']);
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
          <?php if($operatorAlert){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $operatorAlert; ?> </div>
          <?php }?>
          <div class="box <?php echo ($token=="inactive")?"box-danger":"box-success"; ?>">
            <div class="box-header">
              <h3 class="box-title">
                <p class="<?php echo ($token=="inactive")?"text-red":"text-green"?>"><?php echo ($token=="inactive")?"Inactive":"Active";  ?> <?php echo $Pagetitle['title']; ?></p>
              </h3>
              <div class="pull-right" ><form name="adminpage" id="adminpage" method="post">
                  <span class="text-blue">Show :</span>
                  <select id="showpage" name="showpage" style="width:50px; margin-right:5px;" onchange="adminpagechange();">
                    <?php echo $conn->adminpageoption($EXTRA_ARG['set_bpsize'],$paging); ?>
                  </select>
                  <span class="text-blue">per page</span></form>
              </div>
            </div>
            
            <div class="box-header"><div class="col-md-4 pull-right">
              <form name="frm_search" id="frm_search" method="post" action="">
                <div class="input-group">
                  <input type="text" name="txtsearch" id="txtsearch" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="<?php echo $conn->stripval(base64_decode($txtsearch))?>" maxlength="150"  />
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="submit" value="search" name="btn_search" id="btn_search"><i class="fa fa-search"></i></button>
                    <?php if($txtsearch){?>
                    <button class="btn btn-sm btn-default text-red" title="Clear" type="button" value="search" name="clearsearch" id="clearsearch"><i class="fa fa-close"></i></button>
                    <?php }?>
                  </div>
                </div>
              </form></div>
            </div>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="4%">#</th>
                    <th class="head_text" width="20%">Name</th>
                    <th class="head_text" width="18%">Username</th>
                    <th class="head_text" width="25%">Password</th>
                    <th class="head_text" width="11%">Edit</th>
                    <th class="head_text" width="11%">View</th>
                    <th class="head_text" width="11%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$EXTRA_ARG['set_bpsize']) : 0;
							foreach($selTable['result'] as $res)
							{
								//print_r($res);
								$sino++;
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
                    <td class="td_text"><?php echo $conn->stripval(ucfirst($res['op_name']));?></td>
                    <td class="td_text"><?php echo $conn->stripval($res['op_uname']);?></td>
                    <td class="td_text"><?php echo $conn->decode($res['op_password']);?></td>
                    <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $res['op_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
                    <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."view.php"?>?q=<?php echo $res['op_id'];?>"  title="View"><i class="fa fa-file-text"></i></a></td>
                    <td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['op_id']; ?>" /></td>
                  </tr>
                  <?php }?>
                </table>
                <?php }else{?>
                <div class="alert alert-dismissable col-md-4 col-md-offset-4">
                  <h3 class="text-red"><i class="icon fa fa-ban"></i>No record found!</h3>
                </div>
                <?php }?>
              </div>
               <?php if($selTable['nr']){?>
              <div class="box-footer clearfix">
                  <div  class="col-sm-5 clearfix" >&nbsp;<?php if($selTable['nr']>$paging){echo $selTable['page'];}?></div>
                  <div class="col-sm-7" style="text-align:right;padding-top:18px;" >Action :
                      <Select style="width:100px; margin-right:5px;" name="action" id="action">
                      
                        <option value="<?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>">
                        <?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>
                        </option>
                        <option value="Delete">Delete</option>
                      </Select>
                      <button name="btn_action" class="btn btn-primary btn-sm " type="submit" value="Action" id="btn_action" onClick="return check_confirm('Are you sure want to do the action?');"><i class="fa fa-bolt"></i> Action</button>
                      <button class="btn btn-primary btn-sm" type="button" onClick="if(markAll()) return false;" >Select all</button>
                      <button class="btn btn-primary btn-sm" type="button"onclick="if(unmarkAll()) return false;" >Deselect All</button></div>
                </div>
              <?php }?>
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