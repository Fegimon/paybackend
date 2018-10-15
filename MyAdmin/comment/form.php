<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$id = $conn->variable($q);
$sel = $conn->select_query(COMMENT,"*","lt_id='".$id."'","1");
if(!$sel['nr'] && !empty($id))
{
  $conn->divert(ADMIN_URL.$path_folder.'list.php');
}

if($id){
  $btn_name="edit";
} else {
  $btn_name="add";
}

if(isset($edit))
{
  $profileimage=$conn->singlefileupload('profileimage',$uploadFoldername);
  //$team_image_animation=$conn->singlefileupload('brand_imageanimation','brand');
  #image not upload //brand_imageanimation
  $profileimage=($profileimage)?$profileimage:$sel['lt_profile'];
  //$team_image_animation=($team_image_animation)?$team_image_animation:$sel['team_image_animation'];
  if($profileimage)
  {
    $new=array('lt_profile'=>$profileimage);
    $ins = $conn->update(COMMENT,"lt_id='".$id."'",$new);
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
      $conn->divert($rpage);
    }
  }
  else
  {
    $errAlert = "Image Not found";
  }
}

if(isset($add))
{
	$profileimage=$conn->singlefileupload('profileimage',$uploadFoldername);
	//$team_image_animation=$conn->singlefileupload('brand_imageanimation','team');
	if($profileimage)
	{ 
		$new = array('lt_profile'=>$profileimage, 'lt_status'=>'Y','lt_date_dt'=>NOW);
		$ins = $conn->insert(COMMENT,"",$new);
		if($ins)
		{
			$succAlert = "Successfully Saved.";
			$conn->adminAlert($pageKey,$succAlert);
			$conn->divert(ADMIN_URL.$path_folder.'list.php');
		
		}
	}else
	{
		$errAlert = "Image Not uploaded";
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
            <div class="col-md-10 col-md-offset-1">
          <?php if($errAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $errAlert; ?> </div>
          <?php }?>
            <div class="box box-primary">
              <div class="box-header">
                  <h3 class="box-title text-navy"><?php echo ucfirst($btn_name).' '.$Pagetitle['title']; ?></h3>
                  <div class="pull-right">
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                    <!-- text input -->
					         <div class="form-group">
                      <label>Name <span class="text-red">*</span></label>
                      <input  name="lt_name" id="lt_name" type="text" value="<?php echo $conn->stripval(ucfirst($sel['lt_name']));?>" class="form-control validate[required]" placeholder="Enter Name" />
                    </div>
                   <div class="form-group">
                      <label>Designation <span class="text-red">*</span></label>
                      <input  name="lt_designation" id="lt_designation" type="text" value="<?php echo $conn->stripval(ucfirst($sel['lt_designation']));?>" class="form-control validate[required]" placeholder="Enter Name" />
                    </div>
                   <div class="form-group">
                      <label>Description <span class="text-red">*</span></label>                      
                      <textarea class="form-control validate[required]" name="lt_desc" rows="3"><?php echo $sel['lt_desc']; ?></textarea>
                    </div>
                    <div class="form-group">
                  <label>Profile Image<span class="text-red">*</span></label>
                  <div id="imageblock">
                    <?php if($sel['lt_profile']!=""){?>
                    <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/comment/'.$sel['lt_profile'];?>&w=420&h=120&zc=0" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="DelFile('lt_profile','imageblock','<?php echo $id?>','R','profileimage');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                    
                    <div class="clearfix"></div>
                      <input name="profileimage" id="profileimage" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*"><div class="clearfix"></div>
                      <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>
                    <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                    <button class="btn btn-primary" name="<?php echo $btn_name; ?>" id="<?php echo $btn_name; ?>" type="submit">Submit</button></center>
                  </div>

                  </form>
                </div><!-- /.box-body -->
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
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_new").validationEngine();
setTimeout("document.getElementById('banner_title').focus(); ", 500 ); 
});
function checkImage(field, rules, i, options)
{
	if($('#successkey').val()!="1"&&$('#successkey').val()!="")
	{
		return "Please select an image";
	}
	if(field.val()!="")
	{
		var img=field.val();
		var pos=img.lastIndexOf('.');
		if(pos<0)
		{
			return options.allrules.validateimages.alertText;
		}
		if(pos>=0)
		{
			var mainext=img.substr(pos+1);
			mainext= mainext.toLowerCase();
			if((mainext!='jpg')&&(mainext!='jpeg')&&(mainext!='gif')&&(mainext!='png'))
			{
				return options.allrules.validateimages.alertText;
			}
		}
	}
}

function callfileinput()
{
	var uploadvar=$("#profileimage").fileinput({
		uploadUrl: "<?php echo ADMIN_URL.$path_folder ?>ajax.php?func=fileupload", // server upload action
		uploadAsync: false,
		showUpload: false, // hide upload button
		showRemove: false, // hide remove button
		minFileCount: 1,
		maxFileCount: 1,
		browseClass: "btn btn-primary uploadbtn",
		previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
		allowedFileExtensions : ['jpg', 'png','gif','jpeg']
	}).on("filebatchselected", function(event, files) {
		// trigger upload method immediately after files are selected
	   var retrunval=$("#profileimage").fileinput("upload");
	});

	//After complete functions
	$('#profileimage').on('filebatchuploadcomplete', function(event, files, extra) {
		  //  console.log('File batch upload complete');
		$('#profileimage').fileinput('disable');
		$('#successkey').val('1');
		//$('.fileinput-remove').hide();
		jQuery("#frm_new").validationEngine('hide');
	});
	//After Delete functions
	$('#profileimage').on('filepredelete', function(event, key) {
		  $('#profileimage').fileinput('enable');
		  $('#successkey').val('0');
		  //$('.fileinput-remove').hide();
	});
	//Error functions
	$('#profileimage').on('filebatchuploaderror', function(event, data) {
		console.log(data.response.error);
	});
	//$('.fileinput-remove').hide();
}
$(function(){
	callfileinput();
	//Clear all	
	$('.fileinput-remove').click( function(){
	$('.kv-file-remove').trigger('click');
	$('#profileimage').fileinput('reset');
	});		
});

function DelFile(field,div,id,fr,func)
{
  if(confirm('Are you sure want to delete'))
  {
    $("#"+div).html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.ajax({url:"<?php echo ADMIN_URL.$path_folder; ?>ajaxDelete.php?field="+field+"&id="+id+"&fr="+fr+"&func="+func,success:function(result){
    $("#"+div).html(result);
    callfileinput();
    $("#"+div).fadeIn();
    }});
  }
}

// second images
</script>
</body>
</html>