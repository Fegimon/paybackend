<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Fetch value
$id = $conn->variable($q);
$sel = $conn->select_query(BANNER,"*","banner_id='".$id."'","1");
if(!$sel['nr'])
{
	$conn->divert(ADMIN_URL.$path_folder.'list.php');
}

if(isset($btn_sub))
{
	$banner_image=$conn->singlefileupload('bannerimage','banner');
	#image not upload
	$banner_image=($banner_image)?$banner_image:$sel['banner_image'];
	if($banner_image)
	{
		$new=array('banner_image'=>$banner_image);
		$ins = $conn->update(BANNER,"banner_id='".$id."'",$new);
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
              <h3 class="box-title  text-navy">Edit Banner</h3>
              <div class="pull-right">
              <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Title</label>
                  <input  name="banner_title" id="banner_title" type="text" class="form-control" placeholder="Enter Title" maxlength="200" value="<?php echo $conn->stripval($sel['banner_title']);?>" />
                </div>
                <?php /*?><div class="form-group">
                  <label>Banner Text</label>
                  <input  name="banner_slogan" id="banner_slogan" type="text" class="form-control" placeholder="Enter Text" maxlength="200" value="<?php echo $conn->stripval($sel['banner_slogan']);?>" />
                </div><?php */?>
                <div class="form-group">
                  <label>Image <?php echo BANNERIMGSIZE; ?> <span class="text-red">*</span></label>
                  <div id="imageblock">
                    <?php if($sel['banner_image']!=""){?>
                    <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/banner/'.$sel['banner_image'];?>&w=420&h=120&zc=0" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="DelFile('banner_image','imageblock','<?php echo $id?>','R','bannerimage');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                    
                    <input name="bannerimage" id="bannerimage" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*">
                    <div class="clearfix"></div><span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Position <span class="text-red">*</span></label>
                  <input name="banner_pos" id="banner_pos" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Position" maxlength="2" style="width:110px;" value="<?php echo $conn->stripval($sel['banner_pos']);?>" />
                </div>
                <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
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
function callfileinput()
{
/*$("#banner_image").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-primary",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
		allowedFileExtensions : ['jpg', 'png','gif','jpeg']
});*/
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
	jQuery("#frm_new").validationEngine('hide');
});
//After Delete functions
$('#bannerimage').on('filepredelete', function(event, key) {
      $('#bannerimage').fileinput('enable');
	  $('#successkey').val('0');
});
//Error functions
$('#bannerimage').on('filebatchuploaderror', function(event, data) {
    console.log(data.response.error);
});

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