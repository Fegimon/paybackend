<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Fetch value
$id = $conn->variable($q);
$res = $conn->select_query(BUSINESSSOLUTION,"*","tl_id='".$id."'","1");
if(!$res['nr'])
{
	$conn->divert(ADMIN_URL.$path_folder.'list.php');
}

if(isset($btn_sub))
{	
		
		$ins = $conn->update(BUSINESSSOLUTION,"tl_id='".$id."'",$new);
		if($ins)
		{
			$succAlert = "Successfully Updated.";
			$conn->adminAlert($pageKey,$succAlert);
			$rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
			$conn->divert($rpage);
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
<!-- Editor --> 
<script src='<?php echo SITE_URL;?>js/editor/scripts/innovaeditor.js' type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>js/editor/editorjs/editor.js" type="text/javascript"></script>
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
              <h3 class="box-title  text-navy">Edit <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right">
              <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data">
                <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <!--<tr>
            <td height="55"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="88%" height="30" class="heading2">Edit Page </td>
                  <td width="12%"><table width="70%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="37%"><img src="images/icon/back_icon.gif" width="20" height="14" /></td>
                        <td width="63%"><a href="javascript:history.go(-1)" class="backlink">Back</a></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr> -->
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="head_bg">
                  <td width="100%" height="28" colspan="3" class="form_head">Edit page </td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" class="form_text">Enter page name</td>
                        <td width="3%" align="center" class="form_text">:</td>
                        <td width="70%" class="form_text"><input name="tl_name" id="tl_name" value="<?php echo $res['tl_name']; ?>" type="text" size="45" /></td>
                      </tr>
                        <tr class="row_color">
                          <td width="27%" valign="top" class="form_text">Enter the Content </td>
                          <td width="3%" align="center" valign="top" class="form_text">:</td>
                          <td width="70%" class="form_text innertop_tablepad" style="padding:10px"><textarea name="tl_content" id="tl_content" cols="75"  class="form-control"  rows="10"><?php echo $res['tl_content']; ?></textarea><script>oEdit1.REPLACE("tl_content");</script></td>
                        </tr>
                  <tr class="head_bg">
                    <td width="100%" height="28" colspan="3" class="form_head">SEO Settings </td>
                    </tr>
                      <tr class="row_color">
                        <td width="27%" class="form_text">Title</td>
                        <td width="3%" align="center"  class="form_text">:</td>
                        <td width="70%" class="form_text" height="70"><input type="text" name="tl_seo_title" id="tl_seo_title" value="<?php echo $res['tl_seo_title']; ?>" size="75" /><br /><b>Most search engines use a maximum of 60 chars for the title.</b></td>
                      </tr>
                      <tr>
                        <td class="form_text">Description</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text" style="padding:10px"><textarea name="tl_seo_description" id="tl_seo_description" cols="50" rows="6"  class="form-control" ><?php echo $res['tl_seo_description']; ?></textarea><br /><b>Most search engines use a maximum of 160 chars for the description.</b></td>
                      </tr>
                      <tr class="row_color">
                        <td class="form_text">Keywords (comma separated)</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text" style="padding:10px"><textarea name="tl_seo_keywords" id="tl_seo_keywords" cols="50" rows="6"  class="form-control" ><?php echo $res['tl_seo_keywords']; ?></textarea></td>
                      </tr>
                  </table>          
          </td>
                </tr>
                
            </table></td>
          </tr>
          <tr>
            <td class="innertop_tablepad1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="69%" align="center"><button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></td>
                </tr>
            </table></td>
          </tr>
        </table>
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
  
<script language=JavaScript src='../scripts/innovaeditor.js'></script>
<script language=JavaScript src="../editorjs/editor.js"></script>

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_edit").validationEngine();
setTimeout("document.getElementById('service_title').focus(); ", 500 ); 
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
var uploadvar=$("#teamimage").fileinput({
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
   var retrunval=$("#teamimage").fileinput("upload");
});

//After complete functions
$('#teamimage').on('filebatchuploadcomplete', function(event, files, extra) {
      //  console.log('File batch upload complete');
	$('#teamimage').fileinput('disable');
	$('#successkey').val('1');
	jQuery("#frm_new").validationEngine('hide');
});
//After Delete functions
$('#teamimage').on('filepredelete', function(event, key) {
      $('#teamimage').fileinput('enable');
	  $('#successkey').val('0');
});
//Error functions
$('#teamimage').on('filebatchuploaderror', function(event, data) {
    console.log(data.response.error);
});

}
$(function(){
callfileinput();

//Clear all	
$('.fileinput-remove').click( function(){
$('.kv-file-remove').trigger('click');
$('#teamimage').fileinput('reset');
});		
	
});
</script>
</body>
</html>