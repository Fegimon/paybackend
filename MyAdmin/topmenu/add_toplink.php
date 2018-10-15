<?php
require_once "../includes/settings.php";
require_once "../includes/myfunctions.php";
require_once "sitesecurity.php";


$sestype=$_SESSION['ses_atype'];	 
if($sestype=='O'){valoperator("CMS");}

$sestype=$_SESSION['ses_atype'];	 
if($sestype=='O'){valoperator("CMS");}	  
if(isset($_REQUEST['type']))
{
	$tl_name=$_REQUEST['tl_name'];
	$tl_split=$_REQUEST['tl_split'];
	$tl_slug=generate_seo_link($_REQUEST['tl_name'],$replace = '-');
	$select=mysql_query("select * from tbl_topmenu where tl_slug='".$tl_slug."'") or die(mysql_error());
	if(mysql_num_rows($select)>0){$tl_slug=$tl_slug.'-'.$tl_id;}		
	$tl_date=date("Y-m-d",strtotime($RES_SURL['set_days']." day ".$RES_SURL['set_hrs']." hours ".$RES_SURL['set_mins']." minutes"));
	$tl_status="Y";
	$tl_content=$_REQUEST['tl_content'];
	$tl_seo_title=$_REQUEST['tl_seo_title'];
	$tl_seo_description=$_REQUEST['tl_seo_description'];
	$tl_seo_keywords=$_REQUEST['tl_seo_keywords'];
	
	$insert=mysql_query("insert into tbl_topmenu(tl_name,tl_split,tl_slug,tl_content,tl_seo_title,tl_seo_description,tl_seo_keywords,tl_dt,tl_status) values('$tl_name','$tl_split','$tl_slug','$tl_content','$tl_seo_title','$tl_seo_description','$tl_seo_keywords','$tl_date','$tl_status')") or die(mysql_error());
	
	echo'<script language=javascript>alert("Record Inserted successfully");</script>';
	echo'<script language=javascript>window.location.href="view_topmenu.php"</script>';
}

$displaywebsites_details = array('title' => 'CMS', 'cssclass' => 'fa fa-slack');
?>
<!doctype html>
<html class="no-js">
  <head>
  <?php include "head.php"; ?>  
  
      <link rel="stylesheet" href="css/adminstyles.css">
      
      <script language=JavaScript src='../scripts/innovaeditor.js'></script>
<script language=JavaScript src="../editorjs/editor.js"></script>
<script language="javascript" type="text/javascript">
function val()
{
	if(document.tl_edit.tl_name.value=="")
	{
		alert("Enter the page name");
		document.tl_edit.tl_name.focus();
		return false;
	}
	var ed=oEdit1.getTextBody();
	if(ed==""||ed='</br>')
	{
		alert("Enter the content");
		return false;
	}
}
</script>
      
      </head>
      <body class="">
    <div class="bg-dark dk" id="wrap">
    
	<?php include "top.php"; ?>
    
    <?php include "left.php"; ?>  
    
    <div id="content">
        <div class="outer">
          <div class="inner bg-light lter">
         	
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="innertop_bg">
		<form method="post" name="tl_edit" enctype="multipart/form-data" action="" onsubmit="return val();">
		<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="55"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="88%" height="30" class="heading2">Add Page </td>
                  <td width="12%"><table width="70%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="37%"><img src="images/icon/back_icon.gif" width="20" height="14" /></td>
                        <td width="63%"><a href="javascript:history.go(-1)" class="backlink">Back</a></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="head_bg">
                  <td width="100%" height="28" colspan="3" class="form_head">Add page </td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" class="form_text">Enter Page name</td>
                        <td width="3%" align="center" class="form_text">:</td>
                        <td width="70%" class="form_text"><input name="tl_name" id="tl_name" type="text" size="45" /></td>
                      </tr>
                      <tr>
                        <td width="27%" class="form_text">Display Column Type</td>
                        <td width="3%" align="center" class="form_text">:</td>
                        <td width="70%" class="form_text">
                        <select name="tl_split" id="tl_split">
                        <?php if($column_array){
						foreach($column_array as $id=>$name){
						?>
                        <option value="<?php echo $id; ?>" <?php echo isselected($id,$res['tl_split']); ?>><?php echo $name; ?></option>
                        <?php }}else{?>
                        <option value="0">No Column</option>
                        <?php }?>
                        </select>
                        </td>
                      </tr>
                        <tr class="row_color">
                          <td width="27%" valign="top" class="form_text">Enter the Content </td>
                          <td width="3%" align="center" valign="top" class="form_text">:</td>
                          <td width="70%" class="form_text innertop_tablepad"><textarea name="tl_content" id="tl_content" cols="75" rows="10"></textarea><script>oEdit1.REPLACE("tl_content");</script></td>
                        </tr>
                          <tr class="head_bg">
                    <td width="100%" height="28" colspan="3" class="form_head">SEO Settings </td>
                    </tr>
                      <tr>
                        <td width="27%" class="form_text">Title</td>
                        <td width="3%" align="center"  class="form_text">:</td>
                        <td width="70%" class="form_text" height="70"><input type="text" name="tl_seo_title" id="tl_seo_title" value="" size="75" /><br /><b>Most search engines use a maximum of 60 chars for the title.</b></td>
                      </tr>
                      <tr class="row_color">
                        <td class="form_text">Description</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text"><textarea name="tl_seo_description" id="tl_seo_description" cols="50" rows="6"></textarea><br /><b>Most search engines use a maximum of 160 chars for the description.</b></td>
                      </tr>
                      <tr>
                        <td class="form_text">Keywords (comma separated)</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text"><textarea name="tl_seo_keywords" id="tl_seo_keywords" cols="50" rows="6"></textarea></td>
                      </tr>
                      </table>				  
				  </td>
                </tr>
                
            </table></td>
          </tr>
          <tr>
            <td class="innertop_tablepad1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="69%" align="center"><input name="type" type="submit" class="btn btn-metis-5 btn-sm btn-grad" value="Update" /></td>
                </tr>
            </table></td>
          </tr>
        </table>
		</form>
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
             
          </div><!-- /.inner -->
        </div><!-- /.outer -->
      </div><!-- /#content -->
      
	<?php include "right.php"; ?>
    
    <?php include "footer.php"; ?>
    
    <?php include "bottomscript.php"; ?>
	
    </body>
  </html>