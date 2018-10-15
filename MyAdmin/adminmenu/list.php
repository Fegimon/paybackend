<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

$path_folder = "adminmenu/";
$Menutoken="adminmenu";
$pageKey="adminmenu";

function submenu($pid)
{
	global $conn;
	global $sel;
	global $path_folder;
	
	$submenus = $conn->select_query(ADMINMENU,"*","pid='".$pid."' AND menu_status='Y' order by menu_pos","");
	if($submenus['nr'])
	{
		$sino[$pid]=1;
		foreach($submenus['result']as $ressub)
		{?>
<tr class="tbldatarow treegrid-<?php echo $ressub['menu_id']; ?> treegrid-parent-<?php echo $pid; ?>">
  <td class="td_text"><?php echo $sino[$pid]; ?></td>
  <td class="td_text"><?php echo $conn->stripval(ucfirst($ressub['menu_title']));?></td>
  <td class="td_text"><?php echo $conn->stripval($ressub['menu_link']);?></td>
  <td class="td_text"><?php echo ($ressub['menu_icon']!="")?"<span style='font-size:24px'><i class='fa ".$ressub['menu_icon']."'></i></span>  ".$ressub['menu_icon']:"";?></td>
  <td class="td_text">--
    <input name="home[<?php echo $ressub['menu_id']; ?>]" id="home<?php echo $ressub['menu_id']; ?>" value="N" type="hidden"></td>
  <td class="td_text"><input type="text" name="position[<?php echo $ressub['menu_id']; ?>]" style="width:60px; text-align:center;" id="position<?php echo $ressub['menu_id']; ?>" value="<?php echo $ressub['menu_pos']; ?>" maxlength="2" class="validate[required,custom[integer]] form-control"  /></td>
  <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $conn->encode($ressub['menu_id']).'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
  <td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $ressub['menu_id']; ?>" /></td>
</tr>
<?php $sino[$pid]++;submenu($ressub['menu_id']); }
		
		
		}
}
#search_records
if(isset($btn_search))
{
	$ts=base64_encode($conn->variable($txtsearch));
	$tokencond=($token=="inactive")?"?token=inactive":"?token=active";
	$conn->divert("list.php".$tokencond."&txtsearch=".$ts);
}

#update status
if($btn_status=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".ADMINMENU." SET menu_status='N' WHERE menu_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully inactivated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
		
	}
}
if($btn_status=="Active")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".ADMINMENU." SET menu_status='Y' WHERE menu_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully activated.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
	}
}
if($btn_status=="Position")
{
	if(count($chkall)>0)
	{
		foreach($chkall as $id)
		{
			$updatepos = $conn->Execute("UPDATE ".ADMINMENU." SET menu_pos='".$position[$id]."' WHERE menu_id='".$id."'");
		}
	}
	$succAlert = "Position successfully updated.";
	$conn->adminAlert($pageKey,$succAlert);
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}

if($btn_status=="Home")
{
	if(count($chkall)>0)
	{
		foreach($chkall as $id)
		{
			$updatepos = $conn->Execute("UPDATE ".ADMINMENU." SET menu_home='".$home[$id]."' WHERE menu_id='".$id."'");
		}
	}
	$succAlert = "Home successfully updated.";
	$conn->adminAlert($pageKey,$succAlert);
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}

#delete status
if($btn_status=="Delete")
{
	$selData = @implode(",",$chkall);
	$upd_inactive = $conn->Execute("UPDATE ".ADMINMENU." SET menu_status='D' WHERE menu_id IN(".$selData.")");
	if($upd_inactive)
	{
		$succAlert = "Data successfully Deleted.";
		$conn->adminAlert($pageKey,$succAlert);
	}
	$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
}


#select Records
$cond = ($token=="inactive") ? "menu_status='N' AND pid='0'" : "menu_status='Y' AND pid='0'";

#Alert session
$menuAlert=$conn->getadminAlert($pageKey);

$website_cond = ($token=="inactive") ? "inactive" : "active";
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;
//$paging =$EXTRA_ARG['set_bpsize'];
$paging=100;
$selTable = $conn->pagination(ADMINMENU,"*",$cond,"menu_pos asc",$website,$paging,$_GET['page']);
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
      <h1> Admin menu
        <?php /*?><small>it all starts here</small><?php */?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin menu</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-xs-12">
          <?php if($menuAlert){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $menuAlert; ?> </div>
          <?php }?>
          <div class="box <?php echo ($token=="inactive")?"box-danger":"box-success"; ?>">
            <div class="box-header">
              <h3 class="box-title">
                <p class="<?php echo ($token=="inactive")?"text-red":"text-green"?>"><?php echo ($token=="inactive")?"Inactive":"Active";  ?> Admin menu</p>
              </h3>
            </div>
            <?php /*?><div class="box-header">
             <form name="frm_search" id="frm_search" method="post" action="">
                <div class="input-group">
                  <input type="text" name="txtsearch" id="txtsearch" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="<?php echo $conn->stripval(base64_decode($txtsearch))?>" maxlength="150"  />
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="submit" value="search" name="btn_search" id="btn_search"><i class="fa fa-search"></i></button>
                     <?php if($txtsearch){?><button class="btn btn-sm btn-default" type="button" value="search" name="clearsearch" id="clearsearch"><i class="fa fa-close"></i></button>
                     <?php }?>
                  </div>
                </div>
                </form>
              </div><?php */?>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover tree">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="7%">#</th>
                    <th class="head_text" width="19%" >Title</th>
                    <th class="head_text" width="20%" >Link</th>
                    <th class="head_text" width="20%" >Icon</th>
                    <th class="head_text" width="10%" >Admin home</th>
                    <th class="head_text" width="8%" >Position</th>
                    <th class="head_text" width="8%">Edit</th>
                    <th class="head_text" width="8%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$EXTRA_ARG['set_bpsize']) : 0;
							foreach($selTable['result'] as $res)
							{
								//print_r($res);
								$sino++;
								
						   ?>
                  <tr class="tbldatarow treegrid-<?php echo $res['menu_id']; ?>">
                    <td class="td_text"><?php echo $sino; ?></td>
                    <td class="td_text"><?php echo $conn->stripval(ucfirst($res['menu_title']));?></td>
                    <td class="td_text"><?php echo $conn->stripval($res['menu_link']);?></td>
                    <td class="td_text"><?php echo ($res['menu_icon']!="")?"<span style='font-size:24px'><i class='fa ".$res['menu_icon']."'></i></span>  ".$res['menu_icon']:"";?></td>
                    <td class="td_text"><?php if($token=="inactive"){ echo($res['menu_home']=='Y')?"YES":"NO"; }else{?>
                      <select name="home[<?php echo $res['menu_id']; ?>]" class="form-control" id="home<?php echo $res['menu_id']; ?>">
                        <option <?php echo $conn->isselected('Y',$res['menu_home']); ?> value="Y">YES</option>
                        <option value="N" <?php echo $conn->isselected('N',$res['menu_home']); ?>>NO</option>
                      </select>
                      <?php }?></td>
                    <td class="td_text"><input type="text" name="position[<?php echo $res['menu_id']; ?>]" style="width:60px; text-align:center;" id="position<?php echo $res['menu_id']; ?>" value="<?php echo $res['menu_pos']; ?>" maxlength="2" class="validate[required,custom[integer]] form-control"  /></td>
                    <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $conn->encode($res['menu_id']).'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
                    <td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['menu_id']; ?>" /></td>
                  </tr>
                  <?php  submenu($res['menu_id']);
				  
				  }?>
                  
                </table>
                
                <?php }else{?>
                <div class="alert alert-danger alert-dismissable col-md-4 col-md-offset-4">
                  <h4><i class="icon fa fa-ban"></i>No record found!</h4>
                </div>
                <?php }?>
              </div>
               <?php if($selTable['nr']){?>
              <div class="box-footer clearfix">
                  <div  class="col-sm-5 clearfix" >&nbsp;<?php if($selTable['nr']>$paging){echo $selTable['page'];}?></div>
                  <div class="col-sm-7" style="text-align:right;padding-top:18px;" ><button class="btn btn-primary btn-sm" type="button" onClick="if(markAll()) return false;" >Select all</button>
                      <button class="btn btn-primary btn-sm" type="button"onclick="if(unmarkAll()) return false;" >Deselect All</button>
                      <?php if($token=="inactive"){?>
                      <button name="btn_status" id="delete" type="submit" class="btn btn-danger btn-sm" value="Delete" onClick="return check_confirm('Are you sure want to delete?');">Delete</button>
                      <?php }?>
                      <?php if($token!="inactive"){?>
                      <button name="btn_status" class="btn btn-primary btn-sm" type="submit" value="Home" id="home" onClick="return check_confirm('Are you sure want to do the position update?');">Home</button>
                      <?php }?>
                      <button name="btn_status" class="btn btn-primary btn-sm" type="submit" value="Position" id="position" onClick="return check_confirm('Are you sure want to do the position update?');">Position</button>
                      <button name="btn_status" id="delete" type="submit" class="btn <?php echo ($token=="inactive")?"btn-success":"btn-danger"; ?> btn-sm" value="<?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>" onClick="return check_confirm('Are you sure want to <?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>?');" >
                      <?php if($token=="inactive"){echo "Active";}else{echo "Inactive";}?>
                      </button></div>
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
<!--Table tree-->
<link href="<?php echo ADMIN_URL; ?>plugins/tabletree/jquery.treegrid.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_URL; ?>plugins/tabletree/jquery.treegrid.min.js" type="text/javascript" charset="utf-8"></script> 
<script src="<?php echo ADMIN_URL; ?>plugins/tabletree/jquery.treegrid.bootstrap3.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">  
jQuery(document).ready(function(){
	 jQuery("#frm_list").validationEngine();
	  jQuery('.tree').treegrid();
});

</script>
</body>
</html>