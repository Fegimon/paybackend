<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Fetch value
if($ct == "mc"){
  $page_title_cat=$Pagetitle['title'];
} elseif($ct == "sc"){
  $page_title_cat="Sub-".$Pagetitle['title'];
}else{
  $conn->divert(ADMIN_URL.'common/home.php');
}

$id = $conn->variable($q);
$sel = $conn->select_query(CATEGORY,"*","cat_id='".$id."'","1");
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
  $cat_image=$conn->singlefileupload('cat_image',$uploadFoldername);
  $cat_logo=$conn->singlefileupload('cat_logo',$uploadFoldername);
  #image not upload //brand_imageanimation
  $cat_image=($cat_image)?$cat_image:$sel['cat_img'];
  $cat_logo=($cat_logo)?$cat_logo:$sel['cat_logo'];

  $new=array('cat_img'=>$cat_image,'cat_logo'=>$cat_logo);

  $selcheck = $conn->select_query(CATEGORY,"*","cat_title='".$cat_title."' AND cat_id !='".$id."'","1");
 /* if(!$selcheck['nr']){ */ 
    $ins = $conn->update(CATEGORY,"cat_id='".$id."'",$new);
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php?ct='.$ct;
      $conn->divert($rpage);
    }
  /*}else{
      echo "<script>alert('Name Already Exist');</script>";
  }*/
}

if(isset($add))
{

  $cat_image=$conn->singlefileupload('cat_image',$uploadFoldername);
  $cat_logo=$conn->singlefileupload('cat_logo',$uploadFoldername);
  #image not upload //brand_imageanimation
  $cat_image=($cat_image)?$cat_image:$sel['cat_img'];
  $cat_logo=($cat_logo)?$cat_logo:$sel['cat_logo'];

  $selcheck = $conn->select_query(CATEGORY,"*","cat_title='".$cat_title."'","1");
 /* if(!$selcheck['nr']){  */   
    $new = array('sub_status'=>'Y', 'cat_img'=>$cat_image, 'cat_logo'=>$cat_logo, 'cat_date_dt'=>NOW);
    $ins = $conn->insert(CATEGORY,"",$new);
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php?ct='.$ct;
      $conn->divert($rpage);
    }
  /*}else{
      echo "<script>alert('Name Already Exist');</script>";
  }*/
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
      <h1><?php echo $page_title_cat; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title_cat; ?></li>
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
                  <label>Title <span class="text-red">*</span></label>
                  <input  name="cat_title" id="cat_title" type="text" class="form-control validate[required]" placeholder="Enter Title" maxlength="200" onKeyUp="slug(this.value,'cat_slug');" onChange="slug(this.value,'cat_slug');" onBlur="slug(this.value,'cat_slug');" value="<?php echo $conn->stripval($sel['cat_title']);?>" />
                </div>
        <div class="form-group">
                  <label>Slug <span class="text-red">*</span></label>
                  <input  name="cat_slug" id="cat_slug" type="text" class="form-control validate[required,funcCall[checkslug]]" placeholder="Enter Slug" maxlength="200" onKeyUp="slug(this.value,'cat_slug');" onChange="slug(this.value,'cat_slug');" onBlur="slug(this.value,'cat_slug');" value="<?php echo $conn->stripval($sel['cat_slug']);?>" />
                  <div class="clearfix"></div>
                  <span class="text-light-blue">Eg :Title-slug</span> </div>

              <?php if($ct == "sc"){  $p_categorys = $conn->select_query(CATEGORY, "*", " cat_p_id='0' AND cat_status='Y' ");

               ?>    
                <div class="form-group">
                  <label>Main Category <span class="text-red">*</span></label>
                  <select name="cat_p_id" id="cat_p_id" class="form-control">';
                      <?php foreach($p_categorys['result'] as $p_category) { 
                       if($p_category['cat_id']==$sel['cat_p_id']) {
                          ?>
                         <option selected value="<?php echo $p_category['cat_id']; ?>" ><?php echo $p_category['cat_title']; ?></option>
                         <?php } else { ?>
                       <option value="<?php echo $p_category['cat_id']; ?>" ><?php echo $p_category['cat_title']; ?></option>
                      <?php } } ?>  
                  </select>
                </div>
              <?php } ?>
              <?php if($id !="6"){ ?>
                <div class="form-group">
                  <label>Category Description <span class="text-red">*</span></label>
                  <input  name="cat_desc" id="cat_desc" type="text" class="form-control validate[required]" placeholder="Enter Description" maxlength="200" value="<?php echo $conn->stripval($sel['cat_desc']);?>" />
                </div>
              <?php } ?>  

              <?php if($ct == "mc" && $id=="6"){ ?>  

                <div class="form-group">
                  <label><input type="radio" name="cat_change" class="cat_change" <?php echo ($sel['cat_change']==1)? 'checked="checked"':''; ?> value="1"> Description</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <label><input type="radio" name="cat_change" class="cat_change" <?php echo ($sel['cat_change']==2)? 'checked="checked"':''; ?> value="2"> Link</label>               
                </div>
                
                  <div class="form-group desc_enable">
                    <label>Category Description <span class="text-red">*</span></label>
                    <input  name="cat_desc" id="cat_desc" type="text" class="form-control validate[required]" placeholder="Enter Description" maxlength="200" value="<?php echo $conn->stripval($sel['cat_desc']);?>" />
                  </div>
                
                  <div class="form-group url_enable">
                    <label>Category Url <span class="text-red">*</span></label>
                    <input  name="cat_url" id="cat_url" type="text" class="form-control validate[required]" placeholder="Enter Page link"  value="<?php echo $conn->stripval($sel['cat_url']);?>" />
                  </div>
                
              <?php } ?>  
                   <div class="form-group">
                  <label>Logo Size ( 30 * 30 )<span class="text-red">*</span></label>
                  <div id="imageblock">
                    <?php if($sel['cat_logo']!=""){?>
                    <img sty src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/category/'.$sel['cat_logo'];?>&w=420&h=120&zc=0"  border="0" style="width:40px;height: 40px" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger"  href="javascript:void(0);" onClick="DelFile('cat_logo','imageblock','<?php echo $id?>','R','cat_logo');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                    
                    <div class="clearfix"></div>
                      <input name="cat_logo" id="cat_logo" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*"><div class="clearfix"></div>
                      <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>

                 <div class="form-group">
                  <label>Image ( 445 * 406 )<span class="text-red">*</span></label>
                  <div id="imageblock1">
                    <?php if($sel['cat_img']!=""){ ?> 
                    <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/category/'.$sel['cat_img'];?>&w=420&h=120&zc=0" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="DelFilecat('cat_image','imageblock1','<?php echo $id?>','R','cat_image');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                    
                    <div class="clearfix"></div>
                      <input name="cat_image" id="cat_image" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*"><div class="clearfix"></div>
                      <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>


                <div class="form-group">
                  <label>Position <span class="text-red">*</span></label>
                  <input name="cat_pos" id="cat_pos" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Position" maxlength="2" style="width:110px;" value="<?php echo $conn->stripval($sel['cat_pos']);?>" />
                </div>
                
                  <div class="box-header bg-gray">
                  <h3 class="box-title"> Category SEO Settings</h3>
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input name="seo_title" id="seo_title" type="text" class="form-control" placeholder="Title" maxlength="200" value="<?php echo $conn->stripval($sel['seo_title']); ?>" />
                  <span class="text-light-blue" style="font-size:12px;">Most search engines use a maximum of 60 chars for the title.</span> </div>
                <div class="form-group">
                  <label>Description <span style="font-size:10px"></span></label>
                  <textarea name="seo_description" id="seo_description" placeholder="Description" rows="4" class="form-control"><?php echo $conn->stripval($sel['seo_description']); ?></textarea>
                  <span class="text-light-blue" style="font-size:12px;">Most search engines use a maximum of 160 chars for the description.</span> </div>
                <div class="form-group">
                  <label>Keywords </label>
                  <textarea name="seo_keyword" id="seo_keyword" placeholder="Keywords" rows="5" class="form-control"><?php echo $conn->stripval($sel['seo_keyword']); ?></textarea>
                  <span class="text-light-blue" style="font-size:12px;"> Most search engines use a maximum of 200 chars for the Keywords.</span> </div>
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
 function checkslug(field, rules, i, options)
{
  var rvalue=false;
  if(field.val()!="")
  {
    $.ajax({url: '<?php echo ADMIN_URL.$path_folder."ajax.php" ?>',type: 'post',async:false,data:{ "func": "subslug", "id": $('#sub_slug').val(),'edit':'<?php echo $sel['sub_id']; ?>','cat':'<?php echo $sel['cat_id']; ?>' },
    success:function(result)
    {
      if(result=="wrong")
      {
        rvalue=true;
      }
    }});
  }
  if(rvalue)
  {
    return "Slug already exist.";
  }
}

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

function callfileinputcat()
{
  var uploadvar=$("#cat_image").fileinput({
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
     var retrunval=$("#cat_image").fileinput("upload");
  });

  //After complete functions
  $('#cat_image').on('filebatchuploadcomplete', function(event, files, extra) {
      //  console.log('File batch upload complete');
    $('#cat_image').fileinput('disable');
    $('#successkey').val('1');
    //$('.fileinput-remove').hide();
    jQuery("#frm_new").validationEngine('hide');
  });
  //After Delete functions
  $('#cat_image').on('filepredelete', function(event, key) {
      $('#cat_image').fileinput('enable');
      $('#successkey').val('0');
      //$('.fileinput-remove').hide();
  });
  //Error functions
  $('#cat_image').on('filebatchuploaderror', function(event, data) {
    console.log(data.response.error);
  });
  //$('.fileinput-remove').hide();
}
$(function(){
  callfileinputcat();
  //Clear all 
  $('.fileinput-remove').click( function(){
  $('.kv-file-remove').trigger('click');
  $('#cat_image').fileinput('reset');
  });   
});

function DelFilecat(field,div,id,fr,func)
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
//hai
function callfileinput()
{
  var uploadvar=$("#cat_logo").fileinput({
    uploadUrl: "<?php echo ADMIN_URL.$path_folder ?>ajax.php?func=fileuploadlogo", // server upload action
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
     var retrunval=$("#cat_logo").fileinput("upload");
  });

  //After complete functions
  $('#cat_logo').on('filebatchuploadcomplete', function(event, files, extra) {
      //  console.log('File batch upload complete');
    $('#cat_logo').fileinput('disable');
    $('#successkey').val('1');
    //$('.fileinput-remove').hide();
    jQuery("#frm_new").validationEngine('hide');
  });
  //After Delete functions
  $('#cat_logo').on('filepredelete', function(event, key) {
      $('#cat_logo').fileinput('enable');
      $('#successkey').val('0');
      //$('.fileinput-remove').hide();
  });
  //Error functions
  $('#cat_logo').on('filebatchuploaderror', function(event, data) {
    console.log(data.response.error);
  });
  //$('.fileinput-remove').hide();
}
$(function(){
  callfileinput();
  //Clear all 
  $('.fileinput-remove').click( function(){
  $('.kv-file-remove').trigger('click');
  $('#cat_logo').fileinput('reset');
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

  $(document).ready(function(){ 
    typechange("<?php echo $sel['cat_change']; ?>");
    $('input:radio').change(function () {
        var cat_change=$(this).val();
        typechange(cat_change);
                        
    });
  });  
   function typechange(obj){
    
    if(obj==1){
      $(".desc_enable").css("display", "block");
      $(".url_enable").css("display", "none");
    }
    if(obj==2){
      $(".url_enable").css("display", "block");
      $(".desc_enable").css("display", "none");
    }
   }
</script>
</body>
</html>
