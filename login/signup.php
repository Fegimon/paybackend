<?php
require_once(dirname(__FILE__).'../../appcore/app-register.php');
header('Content-Type: application/json');

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password'])) {

	$usercheck = $conn->select_query(USER,"*","user_status!='D' AND (user_email='".$_POST['email']."' OR user_mobile='".$_POST['mobile']."')","1");

	if (!$usercheck['nr']) {

		$user_ip = $conn->getIp();
		$pass = $conn->tep_encrypt_password($_POST['password']);

     // $otp=$conn->get_rand_id(4); 
	 $otp=rand(1000,9999);
		$new = array('user_name' => $_POST['username'], 'user_status'=>'Y', 'mobile_verify'=>'N','mobile_otp'=>$otp, 'user_email' => $_POST['email'], 'user_mobile' => $_POST['mobile'], 'user_pwd' => $pass,'password'=>$_POST['password'], 'user_ip'=>$user_ip, 'user_dt'=>NOW);

		$ins = $conn->insert(USER,"",$new);

		if($ins)
        {                                            
            $Select_usr = $conn->select_query(USER, "*", "user_id='".$ins['id']."'", "1");

             $from1=$conn->variable($Select_usr['user_email']);
		$to1=$EXTRA_ARG['reg_email'];
		$fromname1=$conn->variable($Select_usr['user_name']);
		$sub1="New Registration - ".SITE_NAME;

         require '../mailer/PHPMailerAutoload.php';
         include "../mailcontent/registration.php";
			
			
          /*  $_SESSION['prentz_user_id'] = $Select_usr['user_id'];
            $_SESSION['prentz_user_name'] = $Select_usr['user_name'];  
            $_SESSION['prentz_user_email'] = $Select_usr['user_email'];
            $_SESSION['prentz_user_mobile'] = $Select_usr['user_mobile'];*/
function openurl($url) {

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,CURLOPT_TIMEOUT, '3');  
$content = trim(curl_exec($ch));  curl_close($ch); 
//echo $url;
  }
$username="payrentz"; //use your sms api username
$pass    =     "HG1WJgkG";  //enter your password 

$dest_mobileno   =     $Select_usr['user_mobile'];//reciever 10 digit number (use comma (,) for multiple users. eg: 9999999999,8888888888,7777777777)
$sms         =     "Your One Time Password-".$Select_usr['mobile_otp'];//sms content
$message         =    "Your One Time Password-".$Select_usr['mobile_otp'];//sms content
$message  =urlencode($message);
$senderid    =     "PRentz";//use your sms api sender id
$sms_url = sprintf("http://107.20.199.106/api/v3/sendsms/plain?user=payrentz&password=HG1WJgkG&sender=PRentz&SMSText=".$message."&GSM=91".$Select_usr['user_mobile']."", $username, $pass , $senderid, $dest_mobileno, $message, urlencode($sms) );
openurl($sms_url);

           $_SESSION['otp_user'] = $Select_usr['user_id'];
            $json['success'] = 'Successfully Registered ';
            $json['redirect'] = $_SERVER['HTTP_REFERER'];

        }
	} else {

		$json['fail'] = 'Email ID or Mobile No Already Exists';
	}

	echo json_encode($json);
}

?>