<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

if($ct == "mc"){
  $cond = " cat_p_id='0'";
  $page_title_cat=$Pagetitle['title'];
  $urlcond='&ct='.$ct;
} elseif($ct == "sc"){
  $cond = " cat_p_id != '0'";
  $page_title_cat="Sub-".$Pagetitle['title'];
  $urlcond='&ct='.$ct;
}else{
  $conn->divert(ADMIN_URL.'common/home.php');
}

#search_records
if(isset($btn_search))
{
	
	$ts=base64_encode($conn->variable($txtsearch));
	$tokencond=($token)?"?token=".$token:"?token=active"; 
	$conn->divert("list.php".$tokencond."&txtsearch=".$ts."&ct=".$ct);
}
#Actions Inactive
if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".CATEGORY." SET cat_status='N' WHERE cat_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully inactivated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token.'&ct='.$ct);
	}
}

#Actions Active
if($btn_action=="Action"&&$action=="Active")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".CATEGORY." SET cat_status='Y' WHERE cat_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully activated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token.'&ct='.$ct);
	}
}

#Actions Delete
if($btn_action=="Action"&&$action=="Delete")
{
	$selData = @implode(",",$chkall);
	$upd_inactive = $conn->Execute("UPDATE ".CATEGORY." SET cat_status='D' WHERE cat_id IN(".$selData.")",1);
	if($upd_inactive)
	{
		$succAlert = "Data successfully Deleted.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token.'&ct='.$ct);
	}
}

#Change paging  
if($showpage)
{
	$_SESSION['page'][$pageKey]=$showpage;
}

#Select Records

if($token=="inactive")
  {
   $cond .= " AND cat_status='N'"; 
   $website_cond = "inactive";
 }
elseif($token=="wait")
 {
  $cond .= " AND cat_status='W'"; 
  $website_cond = "wait";
} 
else 
{
$cond .= " AND cat_status='Y'";
$website_cond = "active";
}

if($txtsearch)
{
	$cond .= " AND (cat_title LIKE '%".base64_decode($txtsearch)."%')";
	$urlcond .='&txtsearch='.$txtsearch;
}

#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);

$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(CATEGORY,"*",$cond,"",$website,$paging,$_GET['page']);
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
      <h1><?php echo $page_title_cat; ?> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title_cat; ?> </li>
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

                <?php if($token==""){?><p class="<?php echo ($token=="")?"text-green":""?>"><?php echo ($token=="")?"Active":""; ?> <?php echo $page_title_cat; ?> </p><?php }?>
				<?php if($token=="inactive"){ ?><p class="<?php echo ($token=="inactive")?"text-red":""?>"><?php echo ($token=="inactive")?"Inactive":""; ?> <?php echo $page_title_cat; ?> </p><?php }?>
				<?php if($token=="wait"){ ?><p class="<?php echo ($token=="wait")?"text-yellow":""?>"><?php echo ($token=="wait")?"Waiting":""; ?> <?php echo $page_title_cat; ?> </p><?php }?>
			  </h3>
            <?php if($ct == "sc"){ ?>
              <div class="pull-right" >
                <form name="adminpage" id="adminpage" method="post">
                  <span class="text-blue">Show :</span>
                  <select id="showpage" name="showpage" style="width:50px; margin-right:5px;" onchange="adminpagechange();">
                    <?php echo $conn->adminpageoption($EXTRA_ARG['set_bpsize'],$paging); ?>
                  </select>
                  <span class="text-blue">per page</span>
                </form>
              </div>
            <?php } ?>  
            </div>
            <?php if($ct == "sc"){ ?>
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
            <?php } ?>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="10%">#</th>
                    <th class="head_text" width="10%">Category Name</th>
                    <?php if($ct == "sc"){ ?>
                    <th class="head_text" width="10%">Parent Category Name</th>
                    <?php } ?>
                    <th class="head_text" width="10%">Position</th>
                    <th class="head_text" width="10%">Date</th>
					          <th class="head_text" width="10%">Edit</th>                    
                    <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{                
								$sino++;
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>					
          					<td class="td_text"><?php echo $conn->stripval(ucfirst($res['cat_title']));?></td>
                    <?php if($ct == "sc"){ 
                        $parent_title= $conn->select_query(CATEGORY,"*","cat_id='".$res['cat_p_id']."'","1");
                      ?>
                          <td class="td_text"><?php echo $conn->stripval(ucfirst($parent_title['cat_title']));?></td>
                    <?php } ?>
                    <td class="td_text"><?php echo $conn->stripval($res['cat_pos']);?></td>													
          					<td class="td_text"><?php echo date("d-m-Y",strtotime($res['cat_date_dt']));?></td>
          					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder.'form.php?ct='.$ct.'&q='.$res['cat_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>					
          				  <td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['cat_id']; ?>" /></td>
                  </tr>
                  <?php }?>
                </table>
                <?php }else{?>
                <div class="alert alert-dismissable col-md-4 col-md-offset-4">
                  <h3 class="text-red"><i class="icon fa fa-ban"></i>No record found!</h3>
                </div>
                <?php }?>
              </div>
              <?php if($selTable['nr'] && $ct == "sc" ){?>
              <div class="box-footer clearfix">
                <div  class="col-sm-5 clearfix" >&nbsp;
                  <?php if($selTable['nr']>$paging){echo $selTable['page'];}?>
                </div>
                <div class="col-sm-7" style="text-align:right;padding-top:18px;" >Action :
                  <Select style="width:100px; margin-right:5px;" name="action" id="action">
                    <option value="<?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>">
                    <?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>
                    </option>  
					<?php if($token=="wait"){?><option value="<?php if($token=="wait"){echo "Active";}?>">
					<?php if($token=="wait"){echo "Active";}?><?php }?>
                    </option>  
                    <option value="Delete">Delete</option>
                    
                  </Select>
                  <button name="btn_action" class="btn btn-primary btn-sm " type="submit" value="Action" id="btn_action" onClick="return check_confirm('Are you sure want to do the action?');"><i class="fa fa-bolt"></i> Action</button>
                  <button name="selectall" id="selectall" class="btn btn-primary btn-sm" type="button" onClick="if(markAll()) return false;" >Select all</button>
                  <button name="deselectall" id="deselectall" class="btn btn-primary btn-sm" type="button"onclick="if(unmarkAll()) return false;" >Deselect All</button>
                </div>
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
