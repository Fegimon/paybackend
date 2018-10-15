<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

$field=$conn->variable($_REQUEST["field"]);
$id=$conn->variable($_REQUEST["id"]);
$func=$conn->variable($_REQUEST["func"]);
$fr=$conn->variable($_REQUEST["fr"]);
$name=$conn->variable($_REQUEST["name"]);
$fieldname="brandimage";


if($func=="brandimage")
{
	if(!headers_sent())
	header('Content-Type: text/html; charset=utf-8');
	
	$ResQ=$conn->select_query(BRAND,"brand_img","brand_id='".$id."'","1");
	$option_image=$ResQ[$field];
	if($option_image!="")
	{
		$upload="../../uploads/team/";
		@unlink($upload.$option_image);
	}
	$Upd=$conn->Execute("UPDATE ".BRAND." set brand_img='' WHERE brand_id='".$id."'");
	//$Must=($fr=="R")?"required":"optional";
	if($fr=="R")
	{
		echo '<input name="'.$fieldname.'" id="'.$fieldname.'" type="file" class="form-control validate[required,funcCall[checkImage]]"  accept="image/*" /> <div class="clearfix"></div><span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>';
	}
	else
	{
		echo '<input name="'.$fieldname.'" id="'.$fieldname.'" type="file" class="form-control validate[funcCall[checkImage]]" accept="image/*" /> <div class="clearfix"></div><span class="text-yellow">Upload only JPEG,JPG,GIF,PNG files below 2MB</span>';
	}
	exit;
}else if($func=="deletetemp")
{
	if(!headers_sent())
	header('Content-Type: application/json; charset=utf-8', true,200);

	$folder="../../".UPLOADTEMPFOLDER."/";
	if($name!="")
	{
		@unlink($folder.$name);
	}
	echo json_encode("success");
	
}

?>