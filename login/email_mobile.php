<?php
require_once(dirname(__FILE__).'../../appcore/app-register.php');
header('Content-Type: application/json');

if(isset($_POST['email'])) {

	$email = $_POST["email"];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 	 $json['email_error'] = "Invalid email format"; 
	} else {

		$usercheck = $conn->select_query(USER,"*","user_status!='D' AND user_email='".$_POST['email']."'","1");

		if (!$usercheck['nr']) {

			$new = array('user_email' => $_POST['email']);

			$ins = $conn->update(USER,"user_status!='D' AND user_id='".$_SESSION['prentz_user_id']."'",$new);

			if($ins)
		    {                                            
		        $Select_usr = $conn->select_query(USER, "*", "user_id='".$_SESSION['prentz_user_id']."'", "1");

		        $_SESSION['prentz_user_email'] = $Select_usr['user_email'];

		        $json['success'] = 'Email Successfully Updated ';
		        $json['redirect'] = SITE_URL;

		    }

		} else {

			$json['error'] = 'Email ID already Exists';
		}
	}
}

if(isset($_POST['mobile'])) {
	
	$mobile = $_POST['mobile'];
	if(!preg_match('/^[0-9]{10}+$/', $mobile)){

		$json['mobile_error'] = "Invalid Mobile Number"; 
	} else {

		$new = array('user_mobile' => $_POST['mobile']);

			$ins = $conn->update(USER,"user_status!='D' AND user_id='".$_SESSION['prentz_user_id']."'",$new);

			if($ins)
		    {                                            
		        $Select_usr = $conn->select_query(USER, "*", "user_id='".$_SESSION['prentz_user_id']."'", "1");

		        $_SESSION['prentz_user_mobile'] = $Select_usr['user_mobile'];

		        $json['success_mobile'] = 'Mobile Successfully Updated ';
		        $json['redirect'] = SITE_URL;

		    }

	}
}

echo json_encode($json);

?>