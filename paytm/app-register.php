<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 */
ob_start();
session_start();
$session_id = session_id();
$config=dirname(__FILE__).'/../appconfig/config.php';
if(is_string($config))
{
	$config=require($config);
}
$App =json_decode(json_encode($config));
define('BASEPATH', $App->basePath);

$connection=dirname(__FILE__).'/../appconfig/mainFunctions.php';
if(is_string($connection))
{
	$connection=require($connection);
}

function __autoload($name) {
   $filename = $name.'.php';
   $file = dirname(__FILE__).'/../applib/'.$filename;
    if ( ! file_exists($file))
    {
        return FALSE;
    }
    include $file;	
}
register_shutdown_function(array('AM_Exceptions','fatalErrorShutdownHandler'));
$conn=new createConnection($App);
require(dirname(__FILE__).'/../appconfig/constants.php');
$bn=new AM_Benchmark;
//$bn->mark('total_execution_time_start');
//$setting = $conn->select_query(tbl__admin,"*","admin_id='1'",1);
//$res_set = @unserialize(stripslashes($setting['setting_fields']));

?>