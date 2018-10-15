<?php 

require_once(dirname(__FILE__).'../../appcore/app-register.php');

header('Content-Type: application/json');

if(isset($_POST['email']) && isset($_POST['password'])) {

	$checkuser = $conn->select_query(USER,"*","user_email='".$_POST['email']."' AND user_status='Y'","1");

	$pass = $conn->tep_validate_password($_POST['password'], $checkuser['user_pwd']);
		
		if($checkuser['nr'] && $pass)
		{				
			$_SESSION['prentz_user_id'] = $checkuser['user_id'];
            $_SESSION['prentz_user_name'] = $checkuser['user_name'];  
            $_SESSION['prentz_user_email'] = $checkuser['user_email'];
            $_SESSION['prentz_user_mobile'] = $checkuser['user_mobile'];

            $json['success'] = 'Login Successfull ';

           

            if (isset($_SESSION['prentz_redirect'])) {
            	$json['redirect'] = $_SESSION['prentz_redirect'];
            } else {
            	$json['redirect'] = $_SERVER['HTTP_REFERER'];
            }
            
		} else {

			$json['fail'] = 'Email ID Or Password Incorrect';
		  }
		  echo json_encode($json);
}