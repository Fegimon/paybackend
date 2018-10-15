<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$sel_address['result'] = $conn->select_query(USERADDRESS,"*","address_status = 'Y'","");

#search_records
if(isset($btn_search))
{
	
	$ts=base64_encode($conn->variable($txtsearch));
	$tokencond=($token)?"?token=".$token:"?token=active"; 
	$conn->divert("list.php".$tokencond."&txtsearch=".$ts);
}
#Actions Inactive
if($btn_action=="Action"&&$action=="Inactive")
{
	$selData = @implode(",",$chkall);

	$upd_inactive = $conn->Execute("UPDATE ".USER." SET user_status='N' WHERE user_id IN(".$selData.")");
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

	$upd_inactive = $conn->Execute("UPDATE ".USER." SET user_status='Y' WHERE user_id IN(".$selData.")");
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
	$upd_inactive = $conn->Execute("UPDATE ".USER." SET user_status='D' WHERE user_id IN(".$selData.")",1);
	if($upd_inactive)
	{
		$succAlert = "Data successfully Deleted.";
		$conn->adminAlert($pageKey,$succAlert);
		$conn->divert(ADMIN_URL.$path_folder.'list.php?token='.$token);
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
   $cond = "user_status='N'"; 
   $website_cond = "inactive";
 }
elseif($token=="wait")
 {
  $cond = "user_status='W'"; 
$website_cond = "wait";
} 
else 
{
$cond = "user_status='Y'";
$website_cond = "active";
}


if($txtsearch)
{
	$cond .= " AND (user_name LIKE '%".base64_decode($txtsearch)."%' OR user_email LIKE '%".base64_decode($txtsearch)."%' OR user_first_name LIKE '%".base64_decode($txtsearch)."%' OR user_last_name LIKE '%".base64_decode($txtsearch)."%' OR user_mobile LIKE '%".base64_decode($txtsearch)."%')";
	$urlcond='&txtsearch='.$txtsearch;
}

#Alert session
$bannerAlert=$conn->getadminAlert($pageKey);
$website = $_SERVER['PHP_SELF']."?token=".$website_cond.$urlcond;

#New Admin paging
$paging =$conn->adminpagesession($EXTRA_ARG['set_bpsize'],$pageKey);
$selTable = $conn->pagination(USER,"*",$cond,"user_id desc",$website,$paging,$_GET['page']);
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
            <form method="USER" name="frm_list" id="frm_list" >
              <div class="box-body table-responsive no-padding">
                <?php if($selTable['nr']){?>
                <table class="table table-hover">
                  <tr class="bg-gray color-palette">
                    <th class="head_text" width="10%">#</th>
					          <!--<th class="head_text" width="10%">User Name</th>--> 
                     <th class="head_text" width="10%">Name</th>
                    <th class="head_text" width="10%">User Email</th>
                    <th class="head_text" width="10%">Mobile</th>
                    <!--<th class="head_text" width="10%">school</th>-->
                    <?php /* ?>
                    <th class="head_text" width="10%">City</th>
                    <th class="head_text" width="10%">Country</th>
                    <?php */ ?>
                    <th class="head_text" width="10%">Date</th>
					          <th class="head_text" width="10%">Edit</th>
                    <th class="head_text" width="10%">View</th>
                    <th class="head_text" width="10%">Select</th>
                  </tr>
                  <?php 
							$sino = ($page) ? (($page-1)*$paging) : 0;
							foreach($selTable['result'] as $res)
							{
                $user_country_name_details = $conn->select_query(COUNTRY,"*"," country_id='".$res['user_country']."' AND status='1'","1"); 
  if($user_country_name_details['nr']){
    $user_country_name=$user_country_name_details['name'];
  } else {
    $user_country_name='';    
  }
								$sino++;
						   ?>
                  <tr class="tbldatarow">
                    <td class="td_text"><?php echo $sino; ?></td>
					<?php /* ?><td class="td_text"><?php echo $conn->stripval(ucfirst($res['user_name']));?></td> <?php */ ?>
					<td class="td_text"><?php echo $conn->stripval(ucfirst($res['user_name']));?></td>
					<td class="td_text"><?php echo $conn->stripval($res['user_email']);?></td>
                    <td class="td_text"><?php echo $conn->stripval($res['user_mobile']);?></td>
					<?php /* ?><td class="td_text"><?php echo $conn->stripval(ucfirst($res['user_school']));?></td><?php */ ?>
					<?php /* ?>
          <td class="td_text"><?php echo $conn->stripval(ucfirst($res['user_city']));?></td>
					<td class="td_text"><?php echo $conn->stripval(ucfirst($user_country_name));?></td>
					<?php */ ?>							
					<td class="td_text"><?php echo date("d-m-Y",strtotime($res['user_dt']));?></td>
					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."edit.php"?>?q=<?php echo $res['user_id'].'&rpage='.base64_encode($conn->getOwnURL());?>"  title="Edit"><i class="fa fa-edit"></i></a></td>
					<td class="td_text"><a class="btn btn-default" href="<?php echo $path_folder."view.php"?>?q=<?php echo $res['user_id'];?>"  title="View" target="_blank"><i class="fa fa-file-text"></i></a></td>
				<td class="td_text"><input name="chkall[]" id="chkall" class="chkall" type="checkbox" value="<?php echo $res['user_id']; ?>" /></td>
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
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on("click", ".following", function () {
			 var user_id = $(this).attr('user_id');
			 var access_type = $(this).attr('access_type');
			
			 if(access_type=="following"){
				 //following_title
				 $('.following_title').html("Following User Details");			
			 }
			 //follower
			 if(access_type=="follower"){
				 //following_title
				 $('.following_title').html("Followers User Details");			
			 }
			 
			 $.ajax({
					url: '<?php echo ADMIN_URL.$path_folder; ?>following_follower.php',
					type: "POST",
					dataType: "JSON",
					data: {user_id:user_id,access_type:access_type},
					success: function(data){
						if (data['result']) {
							
							$('.followerpopup_append').html(data['result']);							
							
						}
						if (data['error']) {
							
							$('.followerpopup_append').html(data['error']);							
							
						}
						
						$('#followerpopup').modal('show');
					},					
					error: function(xhr, status, error) {
					  var err = eval("(" + xhr.responseText + ")");
					  alert(err.Message);
					}
			});
	  });
    });
 </script>
  <div class="followerpopup"></div>
<!-- Modal -->
<div id="followerpopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title following_title">Modal Header</h4>
      </div>
      <div class="modal-body">		
        <div class="followerpopup_append"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>
