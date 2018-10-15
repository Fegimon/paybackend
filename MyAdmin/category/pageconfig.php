<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#Module Common Config
$path_folder = "category/";
$Menutoken="13";
if($ct == "mc"){
 	$SubMenutoken=$pageKey="13";  
} elseif($ct == "sc"){
	$SubMenutoken=$pageKey="13";
}
$conn->valoperator($pageKey);
$uploadFolder = "uploads/category/";
$uploadFoldername = "category";
$Pagetitle=array("title"=>"Category");

?>
