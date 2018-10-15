<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

$field=$conn->variable($_REQUEST["field"]);
$id=$conn->variable($_REQUEST["id"]);
$func=$conn->variable($_REQUEST["func"]);
$fr=$conn->variable($_REQUEST["fr"]);
$name=$conn->variable($_REQUEST["name"]);
$fieldname="loimage";


if($func=="loimage")
{
	if(!headers_sent())
	header('Content-Type: text/html; charset=utf-8');
	
	$ResQ=$conn->select_query(LOCATION,"lo_image","lo_id='".$id."'","1");
	$option_image=$ResQ[$field];
	if($option_image!="")
	{
		$upload="../../uploads/location/";
		@unlink($upload.$option_image);
	}
	$Upd=$conn->Execute("UPDATE ".LOCATION." set lo_image='' WHERE lo_id='".$id."'");
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