<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Actions Inactive
if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".BANNER." SET banner_status='N' WHERE banner_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully inactivated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}

#Actions Active
if($btn_action=="Action"&&$action=="Active")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".BANNER." SET banner_status='Y' WHERE banner_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully activated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}

#Actions Delete
if($btn_action=="Action"&&$action=="Delete")
{
	$selData = @implode(",",$chkall);
	$upd_inactive = $conn->Execute("UPDATE ".BANNER." SET banner_status='D',banner_image='' WHERE banner_id IN(".$selData.")",1);
	if($upd_inactive)
	{
		#DELETE IMAGE
		$delDat = $conn->select_query(BANNER,"banner_image","banner_id IN(".$selData.")","");
		if($delDat['nr'])
		{
			foreach($delDat['result']as $resdat)
			{
				$folder="../../".$uploadFolder;
				if($resdat['banner_image']!="")
				{
					$name=$resdat['banner_image'];
					@unlink($folder.$name);
				}
			}
		}
		$succAlert = "Data successfully Deleted.";
		$conn->adminAlert($pageKey,$succAlert);
	}
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}

#Actions Position
if($btn_action=="Action"&&$action=="Position")
{
	if(count($chkall)>0)
	{
		foreach($chkall as $id)
		{
			$updatepos = $conn->Execute("UPDATE ".BANNER." SET banner_pos='".$position[$id]."' WHERE banner_id='".$id."'");		}
	}
	$succAlert = "Position successfully updated.";
	$conn->adminAlert($pageKey,$succAlert);
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}

#Change paging  
if($showpage)
{
	$_SESSION['page'][$pageKey]=$showpage;
}

#Select Records
$cond = ($token=="inactive") ? "banner_status='N'" : "banner_status='Y'";

#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);
$website_cond = ($token=="inactive") ? "inactive" : "active";
$urlcond="";
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(BANNER,"*",$cond,"banner_pos asc",$website,$paging,$_GET['page']);
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
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="6%">#</th>
                    <th class="head_text" width="20%">Title</th>
                    <th class="head_text" width="37%">Image</th>
                    <th class="head_text" width="17%">Position</th>
                    <th class="head_text" width="10%">Edit</th>
                    <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{
								//print_r($res);
								$sino++;
								//$cls = ($sino%2==0) ? "even" : "odd";
								$TMexist = $conn->image_exist($res['banner_image'],"../../".$uploadFolder);
								$img = ($TMexist) ? $uploadFolder.$res['banner_image'] : "images/noimg.jpg";
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
                    <td class="td_text"><?php echo $conn->stripval(ucfirst($res['banner_title']));?></td>
                    <td class="td_text"><?php if($TMexist){?>
                      <img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" />
                      <?php }else{ echo 'NO IMAGE FOUND'; }?></td>
                    <td class="td_text"><input type="text" name="position[<?php echo $res['banner_id']; ?>]" style="width:60px; text-align:center;" id="position<?php echo $res['banner_id']; ?>" value="<?php echo $res['banner_pos']; ?>" maxlength="2" class="validate[required,custom[integer]] form-control"  /></td>
                    <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $res['banner_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
                    <td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['banner_id']; ?>" /></td>
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
                <div  class="col-sm-5 clearfix" >&nbsp;
                  <?php if($selTable['nr']>$paging){echo $selTable['page'];}?>
                </div>
                <div class="col-sm-7" style="text-align:right;padding-top:18px;" >Action :
                  <Select style="width:100px; margin-right:5px;" name="action" id="action">
                    <option value="<?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>">
                    <?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>
                    </option>
                    <option value="Position">Position</option>
                   
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
</script>

</body>
</html>