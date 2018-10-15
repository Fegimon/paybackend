<?php
require_once(dirname(__FILE__).'../../appcore/app-register.php');
header('Content-Type: application/json');

if(isset($_POST['otp'])) {

$receotp=$_POST['otp'];
	$userotp = $conn->select_query(USER,"*","user_status='Y' AND user_id='".$_SESSION['otp_user']."'","1",1);
	if($userotp['mobile_otp']==$receotp)
	{
		$insert=$conn->Execute("UPDATE ".USER." SET mobile_verify='Y' WHERE user_id='".$_SESSION['otp_user']."'");
		
		   $_SESSION['prentz_user_id'] = $userotp['user_id'];
            $_SESSION['prentz_user_name'] = $userotp['user_name'];  
            $_SESSION['prentz_user_email'] = $userotp['user_email'];
            $_SESSION['prentz_user_mobile'] = $userotp['user_mobile'];
			
			 $json['success'] = 'Successfully Registered ';
            $json['redirect'] = $_SERVER['HTTP_REFERER'];
			
	}else
	{
		$json['fail'] = 'Invalid otp';
	}
	echo json_encode($json);
}

?>