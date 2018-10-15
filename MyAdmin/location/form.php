<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Fetch value
$id = $conn->variable($q);
$sel = $conn->select_query(LOCATION,"*","lo_id='".$id."'","1");
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
  $lo_image=$conn->singlefileupload('loimage','location');
  //echo $lo_image; exit;
  $lo_image=($lo_image)?$lo_image:$sel['lo_image'];
  $selcheck = $conn->select_query(LOCATION,"*","lo_name='".$lo_name."' AND lo_id !='".$id."'","1");
  if(!$selcheck['nr']){  
    $new = array('lo_image'=>$lo_image, 'lo_status'=>'Y', 'lo_slug' => $location_slug);

    $ins = $conn->update(LOCATION,"lo_id='".$id."'",$new);
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
      $conn->divert($rpage);
    }
  }else{
      echo "<script>alert('Name Already Exist');</script>";
  }
}

if(isset($add))
{
  $lo_image=$conn->singlefileupload('loimage','location');
  $lo_image=($lo_image)?$lo_image:$sel['lo_image'];

  $selcheck = $conn->select_query(LOCATION,"*","lo_name='".$lo_name."'","1");
  if(!$selcheck['nr']){ 
    $new = array('lo_image'=>$lo_image, 'lo_status'=>'Y', 'lo_slug' => $location_slug, 'lo_date_dt'=>NOW);
    $ins = $conn->insert(LOCATION,"",$new);
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
      $conn->divert($rpage);
    }
  }else{
      echo "<script>alert('Name Already Exist');</script>";
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
              <h3 class="box-title  text-navy"><?php echo ucfirst($btn_name).' '.$Pagetitle['title']; ?></h3>
              <div class="pull-right">
              <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                    <label for=""> Location Name <span class="text-red"> *</span></label>
                    <input  name="lo_name" id="lo_name" type="text" class="form-control validate[required]" placeholder="Enter Location Name" maxlength="200" onKeyUp="slug(this.value,'location_slug');" value="<?php echo $sel['lo_name']; ?>" onChange="slug(this.value,'location_slug');" onBlur="slug(this.value,'location_slug');"/>

                    <div class="error_p_name"></div>
                </div>  
                <div class="form-group">
                  <label for=""> Location Slug <span class="text-red"> *</span></label>
                  <input  name="location_slug" id="location_slug" type="text" class="form-control validate[required]" placeholder="Enter Slug" maxlength="200" onKeyUp="slug(this.value,'location_slug');" value="<?php echo $sel['lo_slug']; ?>" onChange="slug(this.value,'location_slug');" onBlur="slug(this.value,'location_slug');"  />
                </div>   

                <div class="form-group">
                  <label>Image <?php echo TEAMIMGSIZE; ?> <span class="text-red">*</span></label>
                  <div id="imageblock">
                    <?php if($sel['lo_image']!=""){?>
                    <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/location/'.$sel['lo_image'];?>&w=100&h=100&zc=0" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="DelFile('lo_image','imageblock','<?php echo $id?>','R','loimage');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                    
                    <input name="loimage" id="loimage" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*">
                    <div class="clearfix"></div><span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>

                <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                  <button class="btn btn-primary" name="<?php echo $btn_name; ?>" id="<?php echo $btn_name; ?>" type="submit">Submit</button></center>
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
jQuery("#frm_edit").validationEngine();
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
var uploadvar=$("#loimage").fileinput({
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
   var retrunval=$("#loimage").fileinput("upload");
});

//After complete functions
$('#loimage').on('filebatchuploadcomplete', function(event, files, extra) {
      //  console.log('File batch upload complete');
  $('#loimage').fileinput('disable');
  $('#successkey').val('1');
  jQuery("#frm_new").validationEngine('hide');
});
//After Delete functions
$('#loimage').on('filepredelete', function(event, key) {
      $('#loimage').fileinput('enable');
    $('#successkey').val('0');
});
//Error functions
$('#loimage').on('filebatchuploaderror', function(event, data) {
    console.log(data.response.error);
});

}
$(function(){
callfileinput();

//Clear all 
$('.fileinput-remove').click( function(){
$('.kv-file-remove').trigger('click');
$('#loimage').fileinput('reset');
});   
  
});

</script>
</body>
</html>
