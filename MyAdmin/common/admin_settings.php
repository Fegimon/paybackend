<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Module Common Config
$Menutoken=$pageKey="1";
$path_folder = "common/";
$conn->valoperator("1");

$admin_id = $_SESSION['admin_id'];
$sel = $conn->select_query(ADMIN,"*","admin_id='1'","1");
if($sel['setting_fields']!='')
{
	$res = @unserialize($sel['setting_fields']);
	array_walk($res,'decode_ArrayWalk');
}

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y' order by cat_pos asc");

if(isset($btn_sub))
{
	if($sitename && $set_url && $fields['set_bpsize'])
	{
		$_SESSION['page'][$sessiontype]=$fields['set_bpsize'];
		if(count($res))
		{
			foreach( $res as $key=>$rval)
			{
				if(!$fields[$key] && !@array_key_exists ($key,$fields))
				{
					$fields[$key]=$rval;
				}
			}
		}
		
		if($_SESSION['uploadtemp']['settinglogo'])
		{
			array_walk($fields,'encode_ArrayWalk');
			$extra=@serialize($fields);
			#image upload
			$setting_logo=$_SESSION['uploadtemp']['settinglogo'];
			$move=$conn->temptoorgfolder(dirname(__FILE__).'/../../'.UPLOADTEMPFOLDER,dirname(__FILE__)."/../../uploads/common/",$setting_logo);
			if($move)
			{
				$arr=array("setting_logo"=>$setting_logo,'setting_fields'=>$extra);
				$upd = $conn->update(ADMIN,"admin_id='1'",$arr,"../../uploads/common/","",$sitename);
				if($upd)
				{
					$succAlert = "Settings Successfully Saved.";
					$conn->adminAlert($pageKey,$succAlert);
					$conn->divert(ADMIN_URL.'common/admin_settings.php');
				}
			}else
			{
				$errAlert = "Error in File upload";
			}
		}else if($_FILES['settinglogo']['name'])
		{
			#Older browser support
			array_walk($fields,'encode_ArrayWalk');
			$extra=@serialize($fields);
			
			#image upload
			$setting_logo=$conn->adminupload('settinglogo',"../../uploads/common/");
			if($setting_logo)
			{
				$arr=array("setting_logo"=>$setting_logo,'setting_fields'=>$extra);
				$upd = $conn->update(ADMIN,"admin_id='1'",$arr,"../../uploads/common/","",$sitename);
				if($upd)
				{
					$succAlert = "Settings Successfully Saved.";
					$conn->adminAlert($pageKey,$succAlert);
					$conn->divert(ADMIN_URL.'common/admin_settings.php');
				}
				
			}else
			{
				$errAlert = "Error in File upload";
			}
		}
		else
		{
			if($sel['setting_logo']!='')
			{
        $fields['home_category']=implode(',', $fields['home_cat']);
				array_walk($fields,'encode_ArrayWalk');
        
				$extra=@serialize($fields);
				
				$arr=array('setting_fields'=>$extra);
				$upd = $conn->update(ADMIN,"admin_id='1'",$arr,"../../uploads/common/","",$sitename);
				if($upd)
				{
					$succAlert = "Settings Successfully Saved.";
					$conn->adminAlert($pageKey,$succAlert);
					$conn->divert(ADMIN_URL.'common/admin_settings.php');
				}
			}else
			{
				$errAlert = "Logo Not uploaded";
			}
		}
	}
	else
	{
		$errAlert = "Please Enter All * Marked Values";
		
	}
}
$succAlert=$conn->getadminAlert($pageKey);

$conn->adminHtmlhead($extrahead);
$conn->admninBody();
?>
<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Admin Settings
        <?php /*?><small>it all starts here</small><?php */?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Settings</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php //include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <?php if($succAlert){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $succAlert; ?> </div>
          <?php }?>
          <?php if($ErrAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $ErrAlert; ?> </div>
          <?php }?>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-olive"> Admin Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Site name <span class="text-red">*</span></label>
                  <input name="sitename" id="sitename" type="text" class="form-control validate[required]" placeholder="Site name" maxlength="200" value="<?php echo $conn->stripval($sel['sitename']); ?>" />
                </div>


                <div class="form-group">
                  <label>Buy Url<span class="text-red">*</span></label>
        <input name="buy_url" id="buy_url" type="text" class="form-control validate[required]" placeholder="Buy Url" maxlength="200" value="<?php echo $conn->stripval($sel['buy_url']); ?>" />
                </div>

                     <div class="form-group">
                  <label>Phone No 1<span class="text-red">*</span></label>
                  <input name="set_phone" id="set_phone" type="text" class="form-control validate[required]" placeholder="Phone No" maxlength="200" value="<?php echo $conn->stripval($sel['set_phone']); ?>" />
                </div>
                
                <div class="form-group">
                  <label>Phone No 2<span class="text-red">*</span></label>
                  <input name="set_phone1" id="set_phone1" type="text" class="form-control validate[required]" placeholder="Phone No" maxlength="200" value="<?php echo $conn->stripval($sel['set_phone1']); ?>" />
                </div>



                <div class="form-group">
                  <label>Site url ( http:// must ) <span class="text-red">*</span></label>
                  <input  name="set_url" id="set_url" type="text" class="form-control validate[required,custom[url]]" placeholder="Site url" maxlength="200" value="<?php echo $conn->stripval($sel['set_url']); ?>" />
                </div>
                <div class="form-group">
                  <label>Registeration Email <span class="text-red">*</span></label>
                  <input name="fields[reg_email]" id="reg_email" type="text" class="form-control validate[required,custom[email]]" placeholder="Registeration Email" maxlength="200" value="<?php echo $conn->stripval($res['reg_email']); ?>" />
                </div>
                
                 <div class="form-group">
                  <label>Support Email <span class="text-red">*</span></label>
                  <input name="fields[set_email]" id="set_email" type="text" class="form-control validate[required,custom[email]]" placeholder="Support Email" maxlength="200" value="<?php echo $conn->stripval($res['set_email']); ?>" />
                </div>
                
                <div class="form-group">
                  <label>Service Email <span class="text-red">*</span></label>
                  <input name="fields[service_email]" id="service_email" type="text" class="form-control validate[required,custom[email]]" placeholder="Support Email" maxlength="200" value="<?php echo $conn->stripval($res['service_email']); ?>" />
                </div>
                
                <!-- <div class="form-group">
                  <label>Support Phone <span class="text-red">*</span></label>
                  <input name="fields[set_phone]" id="set_phone" type="text" class="form-control validate[required]" placeholder="Support Phone" maxlength="200" value="<?php echo $conn->stripval($res['set_phone']); ?>" />
                </div> -->
               <?php /*?> <div class="form-group">
                  <label>Phone timing <span class="text-red">*</span></label>
                  <input name="fields[set_phonetime]" id="set_phonetime" type="text" class="form-control validate[required]" placeholder="Phone timing" maxlength="200" value="<?php echo $conn->stripval($res['set_phonetime']); ?>" />
                </div><?php */?>
                <div class="form-group">
                  <label>Backoffice Paging size <span class="text-red">*</span></label>
                  <input name="fields[set_bpsize]" id="set_bpsize" type="text" class="form-control validate[required,custom[integer],min[1]]" placeholder="Backoffice Paging size" maxlength="2" value="<?php echo $conn->stripval($res['set_bpsize']); ?>" style="width:110px;" />
                </div>
                <div class="form-group">
                  <label>Frontend Paging size <span class="text-red">*</span></label>
                  <input name="fields[set_fpsize]" id="set_fpsize"  type="text" class="form-control validate[required,custom[integer],min[1]]" placeholder="Frontend Paging size" maxlength="2" value="<?php echo $conn->stripval($res['set_fpsize']); ?>" style="width:110px;" />
                </div>
                 
                <?php if($_SESSION['type']=='admin'){?>
                <div class="form-group">
                  <label>Operator Login  <span class="text-red">*</span></label>
                  <div class="radio">
                 <label><input name="setting_operator" id="setting_operator" type="radio" value="Y" <?php echo $conn->ischecked('Y',$sel['setting_operator']); ?>> Enable</label>&nbsp;&nbsp;<label><input name="setting_operator" id="setting_operator" type="radio" value="N" <?php echo $conn->ischecked('N',$sel['setting_operator']); ?>> Disable</label>
                 </div>
                </div>
                <?php }?>
                
                <div class="box-header bg-gray">
                  <h3 class="box-title">Logo</h3>
                </div>
                <div class="form-group">
                  <label>Image <?php echo LOGOIMGSIZE; ?> <span class="text-red">*</span></label>
                  <div id="imageblock" style="background:#ECF0F5; padding-top:3px;">
                    <?php if($sel['setting_logo']!=""){?>
                    <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo SITE_URL.'uploads/common/'.$sel['setting_logo'];?>&w=200&zc=0&q=80" border="0" /> &nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="DelFile('setting_logo','imageblock','<?php echo $sel['admin_id']; ?>','R','logo');"><i class="fa fa-trash-o"></i>&nbsp; Delete</a>
                    <?php }else{?>
                  
                    <input name="settinglogo" id="settinglogo" type="file" class="form-control validate[required,funcCall[checkImage]]" accept="image/*">
                   <div class="clearfix"></div>
                    <span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>
                    <?php }?>
                  </div>
                </div>
                <?php /*?>
				<div class="box-header bg-gray">
                  <h3 class="box-title">SMS Gateway</h3>
                </div>
                <div class="form-group">
                  <label>SMS </label>
                  <div class="radio">
                   <label><input name="fields[smsenable]" id="smsenable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['smsenable']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[smsenable]" id="smsdisable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['smsenable']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  
                  <input name="fields[smsuser]" id="fb" type="text" class="form-control" placeholder="Username" maxlength="200" value="<?php echo $conn->stripval($res['smsuser']); ?>" />
                </div>
                <div class="form-group">
                  <label>Password</label>
                  
                  <input name="fields[smspass]" id="fb" type="text" class="form-control" placeholder="Password" maxlength="200" value="<?php echo $conn->stripval($res['smspass']); ?>" />
                </div>
                <div class="form-group">
                  <label>Sender ID</label>
                  
                  <input name="fields[smssenderid]" id="fb" type="text" class="form-control" placeholder="Sender ID" maxlength="200" value="<?php echo $conn->stripval($res['smssenderid']); ?>" />
                </div>
				<?php */?>
                 <?php /*?><div class="box-header bg-gray">
                  <h3 class="box-title">Paypal Payment Gateway</h3>
                </div>
                <div class="form-group">
                  <label>Paypal Email</label>
                  
                  <input name="fields[paypal_email]" id="fb" type="text" class="form-control validate[required]" placeholder="Paypal Email" value="<?php echo $conn->stripval($res['paypal_email']); ?>" />
                </div><?php */?>
                 <?php /*?><div class="box-header bg-gray">
                  <h3 class="box-title">PayUMoney  Payment Gateway</h3>
                </div>
                <div class="form-group">
                  <label>Merchant Key</label>
                  
                  <input name="fields[payumoneymerchant]" id="payumoneymerchant" type="text" class="form-control" placeholder="Merchant Key" maxlength="200" value="<?php echo $conn->stripval($res['payumoneymerchant']); ?>" />
                </div>
                <div class="form-group">
                  <label>Salt</label>
                  
                  <input name="fields[payumoneysalt]" id="payumoneysalt" type="text" class="form-control" placeholder="Salt" maxlength="200" value="<?php echo $conn->stripval($res['payumoneysalt']); ?>" />
                </div>
                <div class="form-group">
                  <label>Base Url</label>
                  
                  <input name="fields[payumoneybaseurl]" id="payumoneybaseurl" type="text" class="form-control" placeholder="Base Url" maxlength="200" value="<?php echo $conn->stripval($res['payumoneybaseurl']); ?>" />
                </div><?php */?>
                <div class="box-header bg-gray">
                  <h3 class="box-title">Social Media</h3>
                </div>
                
                <div class="form-group">
                  <label>Facebook</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[facebook]" id="fb" type="text" class="form-control validate[custom[url]]" placeholder="Facebook" maxlength="200" value="<?php echo $conn->stripval($res['facebook']); ?>" />
                </div>
                <div class="form-group">
                  <label>Facebook frontend display</label>
                  <div class="radio">
                   <label><input name="fields[facebook_settings]" id="facebook_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['facebook_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[facebook_settings]" id="facebook_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['facebook_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                <div class="form-group">
                  <label>Twitter</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[twitter]" id="twitter" type="text" class="form-control validate[custom[url]]" placeholder="Twitter" maxlength="200" value="<?php echo $conn->stripval($res['twitter']); ?>" />
                </div>
                <div class="form-group">
                  <label>Twitter frontend display</label>
                  <div class="radio">
                   <label><input name="fields[twitter_settings]" id="twitter_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['twitter_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[twitter_settings]" id="twitter_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['twitter_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                <div class="form-group">
                  <label>Google+ </label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[googleplus]" id="gplus" type="text" class="form-control validate[custom[url]]" placeholder="Google+" maxlength="200" value="<?php echo $conn->stripval($res['googleplus']); ?>" />
                </div>
                <div class="form-group">
                  <label>Google+ frontend display</label>
                  <div class="radio">
                   <label><input name="fields[googleplus_settings]" id="googleplus_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['googleplus_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[googleplus_settings]" id="googleplus_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['googleplus_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                  <div class="form-group">
                  <label>Linkedin: </label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[instagram]" id="instagram" type="text" class="form-control validate[custom[url]]" placeholder="Linkedin" maxlength="200" value="<?php echo $conn->stripval($res['instagram']); ?>" />
                </div>
                <div class="form-group">
                  <label>Linkedin frontend display</label>
                  <div class="radio">
                   <label><input name="fields[instagram_settings]" id="instagram_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['instagram_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[instagram_settings]" id="instagram_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['instagram_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                <?php /*?><div class="form-group">
                  <label>Youtube</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[youtube]" id="ln" type="text" class="form-control validate[custom[url]]" placeholder="Youtube" maxlength="200" value="<?php echo $conn->stripval($res['youtube']); ?>" />
                </div>
                <div class="form-group">
                  <label>Youtube frontend display</label>
                  <div class="radio">
                   <label><input name="fields[youtube_settings]" id="youtube_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['youtube_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[youtube_settings]" id="youtube_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['youtube_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div>
                <div class="form-group">
                  <label>Linkedin</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[linkedin]" id="ln" type="text" class="form-control validate[custom[url]]" placeholder="Linkedin" maxlength="200" value="<?php echo $conn->stripval($res['linkedin']); ?>" />
                </div>
                <div class="form-group">
                  <label>Linkedin frontend display</label>
                  <div class="radio">
                   <label><input name="fields[linkedin_settings]" id="linkedin_enable" type="radio" value="Y" <?php echo $conn->ischecked('Y',$res['linkedin_settings']); ?> class="validate[required]"> Enable</label>&nbsp;&nbsp;<label><input name="fields[linkedin_settings]" id="linkedin_disable" type="radio" value="N" <?php echo $conn->ischecked('N',$res['linkedin_settings']); ?> class="validate[required]"> Disable</label>
                   </div>
                </div><?php */?>
                <div class="box-header bg-gray">
                  <h3 class="box-title">Resource Url Settings</h3>
                 </div>
                 <div class="form-group">
                <label>CSS URL</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[cssurl]" id="cssurl" type="text" class="form-control validate[custom[url]]" placeholder="CSS URL" maxlength="200" value="<?php echo $conn->stripval($res['cssurl']); ?>" /></div>
                  <div class="form-group">
                <label>JS URL</label>
                  <span class="text-light-blue" style="font-size:12px;">( http:// must )</span>
                  <input name="fields[jsurl]" id="jsurl" type="text" class="form-control validate[custom[url]]" placeholder="JS URL" maxlength="200" value="<?php echo $conn->stripval($res['jsurl']); ?>" /></div>
                <?php /*?> <div class="box-header bg-gray">
                  <h3 class="box-title">HOME CONTENTS</h3>
                 </div>
                 <div class="form-group">
                  <label>Title <span class="text-red">*</span></label>
                  <input name="fields[title]" id="fields[title]" type="text" class="form-control validate[required]" placeholder="Title" maxlength="200" value="<?php echo $conn->stripval($res['title']); ?>" />
                </div>
                <div class="form-group">
                  <label>Description <span class="text-red">*</span></label>
                  <textarea name="fields[description]" id="description" placeholder="Description" rows="4" class="form-control validate[required]"><?php echo $conn->stripval($res['description']); ?></textarea>
                  <span class="text-light-blue" style="font-size:12px;">Most search engines use a maximum of 160 chars for the description.</span> </div>
                 <div class="form-group">
                  <label>HOME VIDEO URL  ( http:// must )</label>
                  <input name="fields[home_video]" id="home_video" type="text" class="form-control validate[custom[url]]" placeholder="Video url" maxlength="200" value="<?php echo $conn->stripval($res['home_video']); ?>" />
                  <span class="text-light-blue" style="font-size:12px;">(Youtube / Vimeo) Ex: https://www.youtube.com/watch?v=olFEpeMwgHk</span>
                 </div>
                <div class="box-header bg-gray">
                  <h3 class="box-title">FOOTER COLUMN HEAD</h3>
                </div>
                <div class="form-group">
                  <label>Column 1 title</label>
                  <input name="fields[footer_head1]" id="footer_head1" type="text" class="form-control" placeholder="Footer Column 1 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head1']); ?>" />
                </div>
                <div class="form-group">
                  <label>Column 2 title</label>
                  <input name="fields[footer_head2]" id="footer_head2" type="text" class="form-control" placeholder="Footer Column 2 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head2']); ?>" />
                </div> 
                <div class="form-group">
                  <label>Column 3 title</label>
                  <input name="fields[footer_head3]" id="footer_head3" type="text" class="form-control" placeholder="Footer Column 3 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head3']); ?>" />
                </div>  
                <div class="form-group">
                  <label>Column 4 title</label>
                  <input name="fields[footer_head4]" id="footer_head4" type="text" class="form-control" placeholder="Footer Column 4 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head4']); ?>" />
                </div>
                <div class="form-group">
                  <label>Column 5 title</label>
                  <input name="fields[footer_head5]" id="footer_head5" type="text" class="form-control" placeholder="Footer Column 5 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head5']); ?>" />
                </div>
                <div class="form-group">
                  <label>Column 6 title</label>
                  <input name="fields[footer_head6]" id="footer_head6" type="text" class="form-control" placeholder="Footer Column 6 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head6']); ?>" />
                </div>
                 <div class="form-group">
                  <label>Column 7 title</label>
                  <input name="fields[footer_head7]" id="footer_head7" type="text" class="form-control" placeholder="Footer Column 7 title" maxlength="200" value="<?php echo $conn->stripval($res['footer_head7']); ?>" />
                </div><?php */?>
                <div class="box-header bg-gray">
                  <h3 class="box-title"> General SEO Settings</h3>
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input name="fields[seo_title]" id="seo_title" type="text" class="form-control" placeholder="Title" maxlength="200" value="<?php echo $conn->stripval($res['seo_title']); ?>" />
                  <span class="text-light-blue" style="font-size:12px;">Most search engines use a maximum of 60 chars for the title.</span> </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="fields[seo_description]" id="seo_description" placeholder="Description" rows="4" class="form-control"><?php echo $conn->stripval($res['seo_description']); ?></textarea>
                  <span class="text-light-blue" style="font-size:12px;">Most search engines use a maximum of 160 chars for the description.</span> </div>
                <div class="form-group">
                  <label>Keywords </label>
                  <textarea name="fields[seo_keywords]" id="seo_keywords" placeholder="Keywords" rows="5" class="form-control"><?php echo $conn->stripval($res['seo_keywords']); ?></textarea>
                  <span class="text-light-blue" style="font-size:12px;"> Most search engines use a maximum of 200 chars for the Keywords.</span> </div>

                  <!--<div class="box-header bg-gray">
                  <h3 class="box-title">Home Page Category</h3>
                </div>-->
                <div class="form-group">

                <?php /*?>  <?php $home_category=explode(',', $res['home_category']);
                  foreach($selcategory['result'] as $res_cat) { 
                    if(in_array($res_cat['cat_id'], $home_category)){
                   ?>
                    <label><input id="checkBox" name="fields[home_cat][]" type="checkbox" checked="checked" value="<?php echo $res_cat['cat_id']; ?>" ><?php echo $conn->stripval($res_cat['cat_title']); ?> </label>
                  <?php } else { ?>
                  <label><input id="checkBox" name="fields[home_cat][]" type="checkbox" value="<?php echo $res_cat['cat_id']; ?>" ><?php echo $conn->stripval($res_cat['cat_title']); ?> </label>

                  <?php } } ?><?php */?>

                   <div class="box-header bg-gray">
                  <h3 class="box-title">Extra Scripts</h3>
                </div>
                <div class="form-group">
                  <label>Header scripts </label>
                  <textarea name="fields[header_script]" id="header_script" placeholder="Header scripts" rows="5" class="form-control"><?php echo $conn->stripval($res['header_script']); ?></textarea>
                   </div>
                <div class="form-group">
                  <label>Footer scripts </label>
                  <textarea name="fields[footer_script]" id="footer_script" placeholder="Footer scripts" rows="5" class="form-control"><?php echo $conn->stripval($res['footer_script']); ?></textarea>
                   </div>  

                   <div class="form-group">
                      <label>Why Rent ? <span class="text-red">*</span></label>
                      <input  name="fields[wrent]" id="wrent" type="text" class="form-control" placeholder="Enter Quote" maxlength="140" value="<?php echo $conn->stripval($res['wrent']); ?>" />
                    </div>

                    <div class="form-group">
                      <label>How it works ? <span class="text-red">*</span></label>
                      <input  name="fields[works]" id="works" type="text" class="form-control" placeholder="Enter Quote" maxlength="140" value="<?php echo $conn->stripval($res['works']);?>" />
                    </div>

                    <div class="form-group">
                      <label>FAQ <span class="text-red">*</span></label>
                      <input  name="fields[faq]" id="faq" type="text" class="form-control" placeholder="Enter Quote" maxlength="140" value="<?php echo $conn->stripval($res['faq']);?>" />
                    </div>

                    <div class="form-group">
                      <label>Rent To Own <span class="text-red">*</span></label>
                      <input  name="fields[own]" id="own" type="text" class="form-control" placeholder="Enter Quote" maxlength="140" value="<?php echo $conn->stripval($res['own']);?>" />
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
  
  <?php include "footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "footer-scripts.php"; ?>
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_new").validationEngine();
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
/*$("#setting_logo").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-primary",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
		allowedFileExtensions : ['jpg', 'png','gif','jpeg']
});
*/
var uploadvar=$("#settinglogo").fileinput({
	uploadUrl: "<?php echo ADMIN_URL.$path_folder; ?>/ajax.php?func=fileupload", // server upload action
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
   var retrunval=$("#settinglogo").fileinput("upload");
});

//After complete functions
$('#settinglogo').on('filebatchuploadcomplete', function(event, files, extra) {
      //  console.log('File batch upload complete');
	$('#settinglogo').fileinput('disable');
	$('#successkey').val('1');
	//$('.fileinput-remove').hide();
	jQuery("#frm_new").validationEngine('hide');
});
//After Delete functions
$('#settinglogo').on('filepredelete', function(event, key) {
      $('#settinglogo').fileinput('enable');
	  $('#successkey').val('0');
	  //$('.fileinput-remove').hide();

});
//Error functions
$('#settinglogo').on('filebatchuploaderror', function(event, data) {
  console.log(data.response.error);
});
 //$('.fileinput-remove').hide();
}
$(function() {
callfileinput();
//Clear all	
$('.fileinput-remove').click( function(){
$('.kv-file-remove').trigger('click');
$('#settinglogo').fileinput('reset');
});	
});

var theCheckboxes = $("input[type='checkbox']"); 

theCheckboxes.click(function()
{
    if (theCheckboxes.filter(":checked").length > 4)
        $(this).removeAttr("checked");
});
</script>
</body>
</html>