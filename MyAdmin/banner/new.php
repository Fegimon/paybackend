<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

if(isset($btn_sub))
{
	$banner_image=$conn->singlefileupload('bannerimage',$uploadFoldername);
	if($banner_image)
	{
		$new = array('banner_image'=>$banner_image,'banner_status'=>'Y','banner_dt'=>NOW);
		$ins = $conn->insert(BANNER,"",$new);
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
                  <h3 class="box-title text-navy">Add <?php echo $Pagetitle['title']; ?></h3>
                  <div class="pull-right">
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Title</label>
                      <input  name="banner_title" id="banner_title" type="text" class="form-control" placeholder="Enter Title" maxlength="200" />
                    </div>
                    <?php /*?><div class="form-group">
                      <label>Banner Text</label>
                      <input  name="banner_slogan" id="banner_slogan" type="text" class="form-control" placeholder="Enter Text" maxlength="200" />
                    </div><?php */?>
                    <div class="form-group">
                      <label>Image  <?php echo BANNERIMGSIZE; ?> <span class="text-red">*</span></label>
                      <div class="clearfix"></div>
                      <input name="bannerimage" id="bannerimage" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*"><div class="clearfix"></div>
                      <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    </div>
                    <div class="form-group">
                      <label>Position <span class="text-red">*</span></label>
                      <input name="banner_pos" id="banner_pos" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Position"  maxlength="2"  style="width:110px;" />
                      
                    </div>
                    <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                    <button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></center>
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
	var uploadvar=$("#bannerimage").fileinput({
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
	   var retrunval=$("#bannerimage").fileinput("upload");
	});

	//After complete functions
	$('#bannerimage').on('filebatchuploadcomplete', function(event, files, extra) {
		  //  console.log('File batch upload complete');
		$('#bannerimage').fileinput('disable');
		$('#successkey').val('1');
		//$('.fileinput-remove').hide();
		jQuery("#frm_new").validationEngine('hide');
	});
	//After Delete functions
	$('#bannerimage').on('filepredelete', function(event, key) {
		  $('#bannerimage').fileinput('enable');
		  $('#successkey').val('0');
		  //$('.fileinput-remove').hide();
	});
	//Error functions
	$('#bannerimage').on('filebatchuploaderror', function(event, data) {
		console.log(data.response.error);
	});
	//$('.fileinput-remove').hide();
}
$(function(){
	callfileinput();
	//Clear all	
	$('.fileinput-remove').click( function(){
	$('.kv-file-remove').trigger('click');
	$('#bannerimage').fileinput('reset');
	});		
});
</script>
</body>
</html>