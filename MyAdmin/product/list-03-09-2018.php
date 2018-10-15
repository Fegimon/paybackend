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
   if(!empty($conn->variable($subcat_search))){
    $search_details .="&subcat_search=".base64_encode($conn->variable($subcat_search));
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

	$upd_inactive = $conn->Execute("UPDATE ".PRODUCT." SET p_status='N' WHERE p_id IN(".$selData.")");
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

	$upd_inactive = $conn->Execute("UPDATE ".PRODUCT." SET p_status='Y' WHERE p_id IN(".$selData.")");
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
	$upd_inactive = $conn->Execute("UPDATE ".PRODUCT." SET p_status='D' WHERE p_id IN(".$selData.")");
	if($upd_inactive)
	{
		#DELETE IMAGE
		$delDat = $conn->select_query(PRODUCT,"p_image","p_id IN(".$selData.")","");
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
   $cond = "p_status='N'"; 
   $website_cond = "inactive";
 }
elseif($token=="wait")
 {
  $cond = "p_status='W'"; 
$website_cond = "wait";
} 
else 
{
$cond = "p_status='Y'";
$website_cond = "active";
}

if($txtsearch)
{
  $cond .= " AND (p_name LIKE '%".base64_decode($txtsearch)."%' OR p_slug LIKE '%".base64_decode($txtsearch)."%')";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&txtsearch='.$txtsearch;
}

if($category_search)
{
  $cond .= " AND find_in_set('".base64_decode($category_search)."',p_category) <> 0";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&category_search='.$category_search;
}

if($subcat_search)
{
  $cond .= " AND find_in_set('".base64_decode($subcat_search)."',p_sub_category) <> 0";
  //$cond .= " OR (post_tag LIKE '%".base64_decode($txtsearch)."%')";
  $urlcond='&subcat_search='.$subcat_search;
}
#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;
//echo "hi"; echo $cond; exit;
#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(PRODUCT,"*",$cond,"",$website,$paging,$_GET['page']);

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
                <?php if($token==""){?><p class="<?php echo ($token=="")?"text-green":""?>"><?php echo ($token=="")?"Active":""; ?> <?php echo $Pagetitle['title']; ?></p><?php }?>
				<?php if($token=="inactive"){ ?><p class="<?php echo ($token=="inactive")?"text-red":""?>"><?php echo ($token=="inactive")?"Inactive":""; ?> <?php echo $Pagetitle['title']; ?></p><?php }?>
				<?php if($token=="wait"){ ?><p class="<?php echo ($token=="wait")?"text-yellow":""?>"><?php echo ($token=="wait")?"Waiting":""; ?> <?php echo $Pagetitle['title']; ?></p><?php }?>
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
             <form name="frm_search" id="frm_search" method="post" action="">
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label class="control-label" for="txtsearch">Search KeyWord</label>
                        <input type="text" name="txtsearch" value="<?php echo $conn->stripval(base64_decode($txtsearch)); ?>" placeholder="KeyWord Or Post Title" id="txtsearch" class="form-control" maxlength="150"  />
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                      <?php $category_list = $conn->select_query(CATEGORY,"*","cat_status='Y' AND cat_p_id='0'",""); ?>
                        <label class="control-label" for="category_search">Category</label>
                         <select name="category_search" id="category_search" class="form-control">
                            <option ></option>                            
                           <?php foreach ($category_list['result'] as $categorys) { ?>
                            <?php if ($categorys['cat_id'] == base64_decode($category_search)) { ?>
<option value="<?php echo $categorys['cat_id']; ?>" selected="selected"><?php echo $categorys['cat_title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $categorys['cat_id']; ?>"><?php echo $categorys['cat_title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>
                  </div>
                  
                  <div class="col-sm-3">
                      <div class="form-group">
                      <?php $category_list = $conn->select_query(CATEGORY,"*","cat_status='Y' AND cat_p_id!='0'",""); ?>
                        <label class="control-label" for="subcat_search">Sub Category</label>
                         <select name="subcat_search" id="subcat_search" class="form-control">
                            <option ></option>                            
                           <?php foreach ($category_list['result'] as $categorys) { ?>
                            <?php if ($categorys['cat_id'] == base64_decode($subcat_search)) { ?>
<option value="<?php echo $categorys['cat_id']; ?>" selected="selected"><?php echo $categorys['cat_title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $categorys['cat_id']; ?>"><?php echo $categorys['cat_title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <div class="input-group-btn" style="padding-top: 11%;">
                          <button class="btn btn-sm btn-default" type="submit" value="search" name="btn_search" id="btn_search"><i class="fa fa-search"></i></button>
                          <?php if($txtsearch || $category_search){?>
                          <button title="Clear" class="btn btn-sm btn-default text-red" type="button" value="search" name="clearsearch" id="clearsearch"><i class="fa fa-close"></i></button>
                          <?php }?>
                        </div>
                      </div>
                  </div>

                </form>
            </div>
            <!-- /.box-header -->
            <form method="post" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="5%">#</th>
					          <th class="head_text" width="15%">Product Name</th>
                    <th class="head_text" width="15%">Slug</th>
                    <th class="head_text" width="15%">Description</th>
                    <th class="head_text" width="10%">Date Added</th>
                    <!--th class="head_text" width="8%">Comments</th>
                    <th class="head_text" width="15%">Image</th-->
                    <th class="head_text" width="10%">Edit</th>
                    <th class="head_text" width="10%">View</th>
                    <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{
                //$commandcounts=$conn->getRow("Select * from (select count(p_id) as actcount from ".COMMENT." WHERE pc_post_id='".$res['post_id']."' AND pc_status='Y' limit 1)as a, (select count(pc_id) as disactcount from ".COMMENT." WHERE pc_post_id='".$res['post_id']."' AND pc_status='W' limit 1)as b");
                
								$sino++;
								//$TMexist = $conn->image_exist($res['post_image'],"../../".$uploadFolder);
								//$img = ($TMexist) ? $uploadFolder.$res['post_image'] : "images/noimg.jpg";
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
				<?php //$menucat = $conn->select_query(MENU_CATE,"*","cat_id='".$res['cat_id']."' AND cat_status='Y'","1");?>
          <?php //$user_name = $conn->select_query(USER,"*","user_id='".$res['user_id']."' AND user_status='Y'","1");?>
          <td class="td_text"><?php echo $conn->stripval(ucfirst($res['p_name']));?></td>
          <td class="td_text"><?php echo $conn->stripval($res['p_slug']);?></td>          
          <!--<?php //$menucat = $conn->select_query(MENU_SUBCATE,"*","cat_id='".$res['cat_id']."' AND cat_status='Y'","1");
            $sub_categoty_details= explode(',', $res['sub_id']);
          ?>
          <td class="td_text"><?php foreach($sub_categoty_details as $sub_categoty_details){
            $sub_categoty_name = $conn->select_query(MENU_SUBCATE,"*","sub_id='".$sub_categoty_details."' AND sub_status='Y'","1");
            
            if($sub_categoty_name['nr']){
              echo $conn->stripval(ucfirst($sub_categoty_name['sub_title']))."<br>"; 
            }
            } ?></td>
             <?php $usernames=($user_name['user_yourname'])?$user_name['user_yourname']:'Meini Team'; ?>
          <td class="td_text"><?php echo $conn->stripval(ucfirst($usernames));?></td-->
<!--td align="center" class="td_text"><a href="<?php echo $path_folder;?>view_post_approved_comments.php?id=<?php echo base64_encode($res['post_id']);?>&prod_name=<?php echo base64_encode($res['post_title']);?>" style="color:#006600; text-decoration:none;"><?php echo "(".$commandcounts['actcount'].")"; ?></a> | <a href="<?php echo $path_folder;?>view_post_unapproved_comments.php?id=<?php echo base64_encode($res['post_id']);?>&prod_name=<?php echo base64_encode($res['post_title']);?>" style="color:#FF0000; text-decoration:none;"><?php echo "(".$commandcounts['disactcount'].")"; ?></a></td-->
          <td class="td_text"><?php echo $conn->stripval($res['p_desc']);?></td>
          <td class="td_text"><?php echo date("d-m-Y",strtotime($res['p_date_dt']));?></td>
          
                    <!--td class="td_text"><?php if($TMexist){?>
                      <img class="media-object" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.$img;?>&w=200&h=86&zc=0" border="0" />
                      <?php }else{ echo 'NO IMAGE FOUND'; }?></td-->
          <td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."product_form.php"?>?q=<?php echo $res['p_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."view.php"?>?q=<?php echo $res['p_id'];?>"  title="View"><i class="fa fa-file-text"></i></a></td>
				<td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['p_id']; ?>" /></td>
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