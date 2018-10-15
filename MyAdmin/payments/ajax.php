<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$func=$conn->variable($_REQUEST["func"]);

$id=$conn->variable($_REQUEST["id"]);

$fieldname="pimage";
$folder="../../".UPLOADTEMPFOLDER;
$acceptable = array( 'image/jpeg','image/jpg','image/gif','image/png');

if($func=="fileupload")
{
	if(!headers_sent())
	header('Content-Type: application/json; charset=utf-8', true,200);
	
	if (empty($_FILES['pimage']['name']))
	{
		$res['error'] ='Error while uploading file.';
		echo json_encode($res);
		exit;
	}
	
	if((!in_array($_FILES[$fieldname]['type'], $acceptable)) && (!empty($_FILES[$fieldname]["type"])))
	{
		$res['error'] ='Invalid file type. Only JPG, JPEG, GIF and PNG types are accepted.';
		echo json_encode($res);
		exit;
	
	}
	
	$filename=$conn->variable($_FILES[$fieldname]['name']);
	$uploadFilename=$conn->uploadfilename($filename);
	
	$fileinfo=pathinfo($uploadFilename);
	$file_extn =  $fileinfo['extension'];
	
	$p1 =$p2= "";
	
	##Exist loop check
	for($i=0;$i<100;$i++)
	{
		
		$Orgexist = $conn->image_exist($uploadFilename,"../../".$uploadFolder);
		$tempexist = $conn->image_exist($uploadFilename,"../../".UPLOADTEMPFOLDER);
		if(!$Orgexist&&!$tempexist)
		{
			$movefileName=$uploadFilename;
			break;
		}else{
			$movefileName=$conn->uploadfilename($uploadFilename,$fileinfo['filename']."-".$i);
		}
	}
	
	#move file 
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'],$folder.$movefileName);
	
	/*for ($i = 0; $i < count($_FILES['banner_image']['name']); $i++)
	{
		
		$fieldname = '1';
		$url = ADMIN_URL.'banner/ajaxDelete.php?name=rtwataw.jpg&func=deletetemp';
		$p1[$i] = "<img src='http://path.to.uploaded.file/1.jpg' class='file-preview-image'>";
		$p2[$i] = array('caption' => "testset.jpg", 'width' => '120px','url' => $url,'key' => $fieldname);
	}*/
	
	#Session settings
	$_SESSION['uploadtemp'][$fieldname]=$movefileName;
	
	#upload function here
	
	$key = $movefileName;
	$url = ADMIN_URL.$path_folder.'ajaxDelete.php?name='.$movefileName.'&func=deletetemp';
	$p1[$i] = "<img src='".SITE_URL."timthumb.php?src=".SITE_URL.UPLOADTEMPFOLDER.$movefileName."&h=160&zc=0&q=85' class='file-preview-image'>";
	$p2[$i] = array('caption' =>$movefileName,'url' => $url,'key' => $key);
	
	$res['initialPreview'] =$p1; 
	$res['initialPreviewConfig']=$p2;
	$res['append']=true; 
	$res['success']=1; 
	echo json_encode($res);
}

if($func=="fileuploadadditionalimage")
{
	$fieldname="postadditionalimage";
	if(!headers_sent())
	header('Content-Type: application/json; charset=utf-8', true,200);
	
	if (empty($_FILES['postadditionalimage']['name']))
	{
		$res['error'] ='Error while uploading file.';
		echo json_encode($res);
		exit;
	}
	
	if((!in_array($_FILES[$fieldname]['type'], $acceptable)) && (!empty($_FILES[$fieldname]["type"])))
	{
		$res['error'] ='Invalid file type. Only JPG, JPEG, GIF and PNG types are accepted.';
		echo json_encode($res);
		exit;
	
	}
	
	$filename=$conn->variable($_FILES[$fieldname]['name']);
	$uploadFilename=$conn->uploadfilename($filename);
	
	$fileinfo=pathinfo($uploadFilename);
	$file_extn =  $fileinfo['extension'];
	
	$p1 =$p2= "";
	
	##Exist loop check
	for($i=0;$i<100;$i++)
	{
		
		$Orgexist = $conn->image_exist($uploadFilename,"../../".$uploadFolder);
		$tempexist = $conn->image_exist($uploadFilename,"../../".UPLOADTEMPFOLDER);
		if(!$Orgexist&&!$tempexist)
		{
			$movefileName=$uploadFilename;
			break;
		}else{
			$movefileName=$conn->uploadfilename($uploadFilename,$fileinfo['filename']."-".$i);
		}
	}
	
	#move file 
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'],$folder.$movefileName);
	
	/*for ($i = 0; $i < count($_FILES['banner_image']['name']); $i++)
	{
		
		$fieldname = '1';
		$url = ADMIN_URL.'banner/ajaxDelete.php?name=rtwataw.jpg&func=deletetemp';
		$p1[$i] = "<img src='http://path.to.uploaded.file/1.jpg' class='file-preview-image'>";
		$p2[$i] = array('caption' => "testset.jpg", 'width' => '120px','url' => $url,'key' => $fieldname);
	}*/
	
	#Session settings
	$_SESSION['uploadtemp'][$fieldname]=$movefileName;
	
	#upload function here
	
	$key = $movefileName;
	$url = ADMIN_URL.$path_folder.'ajaxDelete.php?name='.$movefileName.'&func=deletetemp';
	$p1[$i] = "<img src='".SITE_URL."timthumb.php?src=".SITE_URL.UPLOADTEMPFOLDER.$movefileName."&h=160&zc=0&q=85' class='file-preview-image'>";
	$p2[$i] = array('caption' =>$movefileName,'url' => $url,'key' => $key);
	
	$res['initialPreview'] =$p1; 
	$res['initialPreviewConfig']=$p2;
	$res['append']=true; 
	$res['success']=1; 
	echo json_encode($res);
}


if($func=="getlocation")
{
	if(!headers_sent())
	header('Content-Type: text/html; charset=utf-8');
	$Subsubcat = $conn->select_query(CATEGORY,"*","cat_status='Y' AND cat_p_id='".$id."' order by cat_pos",""); ?>
    <select  class="form-control validate[required]" name="p_sub_cat[]" id="p_sub_cat[]" multiple="multiple" >
    <option value="">-- Select --</option>
    <?php $Location = $conn->select_query(CATEGORY,"*","cat_status='Y' AND cat_p_id='".$id."' order by cat_title","");
	  if($Location['nr'])
	  {
		  foreach($Location['result'] as $resloc){?><option value="<?php echo $resloc['cat_id']; ?>"><?php echo ucfirst($conn->stripval($resloc['cat_title'])); ?></option><?php
		}
	}?>
    </select><?php 
}








?>