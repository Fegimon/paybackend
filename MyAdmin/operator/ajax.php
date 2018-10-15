<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

$func=$conn->variable($_REQUEST["func"]);
$id=$conn->variable($_REQUEST["id"]);
$edit=$conn->variable($_REQUEST["edit"]);

if($func=="checkoperator")
{
	if(!headers_sent())
	header('Content-Type: text/html; charset=utf-8');
	if($edit)
	{
		$extracond=" AND op_id!='".$edit."'";
	}
	$package = $conn->select_query(OPERATOR,"op_id","op_status!='D' AND op_uname='".$id."'".$extracond,"1");
	if($package['nr'])
	{
		echo "wrong";		
	}
}
?>