<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

$path_folder = "adminmenu/";
$Menutoken="";
$id = $conn->decode($q);

#func submenu
$sel = $conn->select_query(ADMINMENU,"*","menu_id='".$id."'","1");
function adminsubmenu($pid,$dash="")
{
	global $conn;
	global $sel;
	$dash="&ndash;&nbsp;".$dash;
	$submenus = $conn->select_query(ADMINMENU,"*","pid='".$pid."' AND menu_id!='".$sel['menu_id']."' AND menu_status='Y' order by menu_pos","");
	if($submenus['nr'])
	{
		foreach($submenus['result']as $ressub)
		{?>
        <option <?php echo $conn->isselected($ressub['menu_id'],$sel['pid']); ?> value="<?php echo $ressub['menu_id']; ?>"><?php echo $dash.$ressub['menu_title']; ?></option>
        <?php
		adminsubmenu($ressub['menu_id'],$dash);			
		}
	}
}

if(isset($btn_sub))
{
	if($pid!='0')
	{
		$arr=array('menu_home'=>'N');
	}
	$ins=$conn->update(ADMINMENU,"menu_id='".$id."'",$arr);
	if($ins)
	{
		$succAlert = "Updated Successfully Saved.";
		$_SESSION['alert']['adminmenu']['success']=$succAlert;
		$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
		$conn->divert($rpage);
	}
	
}
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
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">Edit Admin menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Root<span class="text-red">*</span></label>
                   <select  class="form-control validate[required]" name="pid" id="pid" >
                   <option <?php echo $conn->isselected('0',$sel['pid']); ?> value="0">--Main Root--</option>
                   <?php $Mainmenus = $conn->select_query(ADMINMENU,"*","pid='0' AND menu_status='Y' order by menu_pos","");
				   if($Mainmenus['nr'])
				   {
					   $dash="&raquo;&nbsp;";
				   foreach($Mainmenus['result'] as $resmenu){?>
                    <option <?php echo $conn->isselected($resmenu['menu_id'],$sel['pid']); ?> value="<?php echo $resmenu['menu_id']; ?>"><?php echo $dash.$conn->stripval($resmenu['menu_title']); ?></option>
                    <?php adminsubmenu($resmenu['menu_id'],$dash);
					}}?></select>
                </div>
                <div class="form-group">
                  <label>Title <span class="text-red">*</span></label>
                  <input  name="menu_title" id="menu_title" type="text" class="form-control validate[required]" placeholder="Enter Title" maxlength="200" value="<?php echo $conn->stripval($sel['menu_title']);?>"  />
                </div>
                <div class="form-group">
                  <label>Menu link <span style="font-size:12px;" class="text-light-blue">Leave blank for javascript:void(0);</span></label>
                  <input name="menu_link" id="menu_link" type="text" class="form-control" placeholder="Enter Link" maxlength="200" value="<?php echo $conn->stripval($sel['menu_link']);?>"  /><span class="text-light-blue" style="font-size:12px;">Eg: common/home.php</span>
                </div>
                <div class="form-group">
                  <label>Menu Icon <span class="text-red">*</span> </label>
                  <select  class="form-control validate[required]" name="menu_icon" id="menu_icon" >
                    <option value="">--Select--</option>
                    <?php foreach($fontawesomearray as $resfont){?>
                    <option <?php echo $conn->isselected($sel['menu_icon'],$resfont) ?> value="<?php echo $resfont; ?>"><?php echo $resfont; ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Position <span class="text-red">*</span></label>
                  <input name="menu_pos" id="menu_pos" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Position" maxlength="2" style="width:110px;" value="<?php echo $conn->stripval($sel['menu_pos']);?>" />
                </div>
                <div class="box-footer"><center>
                  <button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></center>
                </div>
              </form>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
<link href="<?php echo ADMIN_URL; ?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_URL; ?>plugins/select2/select2.full.min.js" type="text/javascript" charset="utf-8"></script> 

<script type="text/javascript">  
jQuery(document).ready(function() {
jQuery("#frm_new").validationEngine({ prettySelect: true, usePrefix: 's2id_' });
setTimeout("document.getElementById('menu_title').focus(); ", 500 ); 
});

function formatIcon (iconclass) {
  if (!iconclass.id) { return iconclass.text; }
  var $iconclass = $(
    '<span><i class="fa ' + iconclass.element.value.toLowerCase() + '" /></i> ' + iconclass.text + ' </span>'
  );
  return $iconclass;
};

$("#menu_icon").select2({
  templateResult: formatIcon,
   templateSelection: formatIcon
});

</script>
</body>
</html>