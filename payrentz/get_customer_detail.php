<?php
require_once('dbconn.php'); 

$firstFolderName  ='a';
$secondFolderName ='b';
    if (!is_dir(dirname(__FILE__) . '/../' . $firstFolderName)) {
                mkdir(dirname(__FILE__) . '/../' . $firstFolderName, 0777, true);
            } else {
                mkdir(dirname(__FILE__) . '/../' . $firstFolderName . '/' . $secondFolderName, 0777, true);
            }
    exit;

 @$package_id = $_POST['package_id'];
 
  
	 $target_dir = "../scripts/app/content/image/pack_detail/";
	 $folder="scripts/app/content/image/pack_detail/";
	 
	// $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
	 $target_file;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
	{ 
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		
		$doc_path = $_FILES["file"]["name"];
		$insertsql ="insert into package_photos(photo_path,photo,package_id) values('$folder$doc_path','$doc_path','$package_id')";
        $res = mysql_query($insertsql);
        $id=mysql_insert_id();
		$insertsql1 ="update tour_packages set image='$folder$doc_path' where package_id ='$package_id'";
        $res1 = mysql_query($insertsql1);
		
        echo $id;

		
    } 
	else 
	{
        echo "Sorry, there was an error uploading your file.";
    }


?>
