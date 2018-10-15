<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#search_records
if(isset($btn_search))
{  
  $search_details='';
  if(!empty($conn->variable($txtsearch))){
    $search_details .="&txtsearch=".base64_encode($conn->variable($txtsearch));
  }
  if(!empty($conn->variable($category_search))){
    $search_details .="&category_search=".base64_encode($conn->variable($category_search));
  }
  if(!empty($conn->variable($username))){
    $search_details .="&username=".base64_encode($conn->variable($username));
  }
	//$ts=base64_encode($conn->variable($txtsearch));
	$tokencond=($token)?"?token=".$token:"?token=active";
	//$conn->divert("list.php".$tokencond."&txtsearch=".$ts);
  $conn->divert("list.php".$tokencond.$search_details);
}
#Actions Inactive
if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".POST." SET post_status='N' WHERE post_id IN(".$selData.")");
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

	$upd_inactive = $conn->Execute("UPDATE ".POST." SET post_status='Y' WHERE post_id IN(".$selData.")");
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
	$upd_inactive = $conn->Execute("UPDATE ".POST." SET post_status='D',post_image='' WHERE post_id IN(".$selData.")",1);
	if($upd_inactive)
	{
		#DELETE IMAGE
		$delDat = $conn->select_query(POST,"post_image","post_id IN(".$selData.")","");
		if($delDat['nr'])
		{
			foreach($delDat['result']as $resdat)
			{
				$folder="../../".$uploadFolder;
				if($resdat['post_image']!="")
				{
					$name=$resdat['post_image'];
					@unlink($folder.$name);
				}
			}
		}
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

#Select Records

if($token=="inactive")
  {
   $cond = "post_status='N'"; 
   $website_cond = "inactive";
 }
elseif($token=="wait")
 {
  $cond = "post_status='W'"; 
$website_cond = "wait";
} 
else 
{
$cond = "post_status='Y'";
$website_cond = "active";
}
if($txtsearch)
{
  $cond .= " AND (post_title LIKE '%".base64_decode($txtsearch)."%' OR post_tag LIKE '%".base64_decode($txtsearch)."%')";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&txtsearch='.$txtsearch;
}
if($category_search)
{
  $cond .= " AND find_in_set('".base64_decode($category_search)."',sub_id) <> 0";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&category_search='.$category_search;
}
if($username)
{
  
  $userdetails=$conn->select_query(USER,"user_id","user_yourname LIKE '%".base64_decode($username)."%' AND user_status='Y' ","");
  
  $userdetails_id='';
  $i=0;
  if($userdetails['nr']){
    foreach ($userdetails['result'] as $key => $value) {
      if($i==0){
        $userdetails_id.=$value['user_id'];
      } else {
        $userdetails_id.=','.$value['user_id'];
      }
      $i++;
    }
  } else{
    $userdetails_id.=0;
  }
  
  $cond .= " AND user_id IN(".$userdetails_id.")";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&username='.$username;
}

#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);
$urlcond="";
//$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;
$website = $_SERVER['PHP_SELF']."?type=cms".$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(TLINK,"*","tl_status='Y'","",$website,$paging,$_GET['page']);
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
                <?php /* if($token==""){?><p class="<?php echo ($token=="")?"text-green":""?>"><?php echo ($token=="")?"Active":""; ?> <?php echo $Pagetitle['title']; ?></p><?php }?>
				<?php if($token=="inactive"){ ?><p class="<?php echo ($token=="inactive")?"text-red":""?>"><?php echo ($token=="inactive")?"Inactive":""; ?> <?php echo $Pagetitle['title']; ?></p><?php }?>
				<?php if($token=="wait"){ ?><p class="<?php echo ($token=="wait")?"text-yellow":""?>"><?php echo ($token=="wait")?"Waiting":""; ?> <?php echo $Pagetitle['title']; ?></p><?php } */ ?>
          <p class="text-green"><?php echo $Pagetitle['title']; ?></p>
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
			<?php /* ?><div class="box-header">
             <form name="frm_search" id="frm_search" method="post" action="">
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="txtsearch">Search KeyWord</label>
                        <input type="text" name="txtsearch" value="<?php echo $conn->stripval(base64_decode($txtsearch)); ?>" placeholder="KeyWord Or Post Title" id="txtsearch" class="form-control" maxlength="150"  />
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                      <?php $category_list = $conn->select_query(MENU_SUBCATE,"*","cat_id='3' AND sub_status='Y'",""); ?>
                        <label class="control-label" for="category_search">Category</label>
                         <select name="category_search" id="category_search" class="form-control">
                            <option ></option>                            
                           <?php foreach ($category_list['result'] as $categorys) { ?>
                            <?php if ($categorys['sub_id'] == base64_decode($category_search)) { ?>
                            <option value="<?php echo $categorys['sub_id']; ?>" selected="selected"><?php echo $categorys['sub_title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $categorys['sub_id']; ?>"><?php echo $categorys['sub_title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="username">User Name</label>
                        <input type="text" name="username" value="<?php echo $conn->stripval(base64_decode($username)); ?>" placeholder="user name" id="username" class="form-control" maxlength="150"  />
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <div class="input-group-btn" style="padding-top: 9%;">
                          <button class="btn btn-sm btn-default" type="submit" value="search" name="btn_search" id="btn_search"><i class="fa fa-search"></i></button>
                          <?php if($txtsearch || $username || $category_search){?>
                          <button title="Clear" class="btn btn-sm btn-default text-red" type="button" value="search" name="clearsearch" id="clearsearch"><i class="fa fa-close"></i></button>
                          <?php }?>
                        </div>
                      </div>
                  </div>

                </form>
            </div><?php */ ?>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="5%">#</th>
					          <th class="head_text" width="15%">Page Name</th>
                    <th class="head_text" width="15%">Display Status</th>
                    <th class="head_text" width="10%">Edit</th>
                    <th class="head_text" width="10%">View</th>
                    <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{
								$sino++;
							//	$TMexist = $conn->image_exist($res['post_image'],"../../".$uploadFolder);
							//	$img = ($TMexist) ? $uploadFolder.$res['post_image'] : "images/noimg.jpg";
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
				
          <td class="td_text"><?php echo $conn->stripval(ucfirst($res['tl_name']));?></td>          
                  
          <td class="td_text"><?php echo ($res['tl_status']=="Y")?'<font style="color:#060">Active</font>':'<font style="color:#900">Inactive</font>';?>&nbsp;</td>
                   
          <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $res['tl_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."view.php"?>?q=<?php echo $res['tl_id'];?>"  title="View"><i class="fa fa-file-text"></i></a></td>
				<td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['tl_id']; ?>" /></td>
                  </tr>
                  <?php }?>
                </table>
                <?php }else{?>
                <div class="alert alert-dismissable col-md-4 col-md-offset-4">
                  <h3 class="text-red"><i class="icon fa fa-ban"></i>No record found!</h3>
                </div>
                <?php }?>
              </div>
              <?php  if($selTable['nr']){?>
              <div class="box-footer clearfix">
                <div  class="col-sm-5 clearfix" >&nbsp;
                  <?php if($selTable['nr']>$paging){echo $selTable['page'];}?>
                </div>
                 <?php }?>
                <?php /* <div class="col-sm-7" style="text-align:right;padding-top:18px;" >Action :
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
              <?php } */?>
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