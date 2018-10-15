<?php 

require_once(dirname(__FILE__).'../../appcore/app-register.php');

header('Content-Type: application/json');

if(isset($_POST['email'])) {

	$userforget = $conn->select_query(USER,"*","user_email='".$_POST['email']."' AND user_status='Y'","1");
		
		if($userforget['nr'])
		{	
		
		$from=$EXTRA_ARG['set_email'];
					$fromname=SITE_NAME;
					$to=$userforget['user_email'];
					$user_name=$conn->stripval($userforget['user_name']);
					$usermail=$userforget['user_email'];
					$userpass=$userforget['password'];
							
		  require '../mailer/PHPMailerAutoload.php';
         include "../mailcontent/resetpassword.php";
		 
		 	
      $json['success'] = 'Send Successfull ';

            if (isset($_SESSION['prentz_redirect'])) {
            	$json['redirect'] = $_SESSION['prentz_redirect'];
            } else {
            	$json['redirect'] = $_SERVER['HTTP_REFERER'];
            }
            
		} else {

			$json['fail'] = ' Incorrect Email ID ';
		  }
		  echo json_encode($json);
}

//mobile
if(isset($_POST['mobile'])) {

	$userforget = $conn->select_query(USER,"*","user_mobile='".$_POST['mobile']."' AND user_status='Y'","1");
		
		if($userforget['nr'])
		{	
		//  $otp=$conn->get_rand_id(4);
		  $otp=rand(1000,9999);
		$insert=$conn->Execute("UPDATE ".USER." SET mobile_otp='".$otp."' WHERE user_id='".$userforget['user_id']."'");
		
		$Select_usr = $conn->select_query(USER,"*","user_mobile='".$_POST['mobile']."' AND user_status='Y'","1");
		
		
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
      $json['success'] = 'Send Successfull ';

            if (isset($_SESSION['prentz_redirect'])) {
            	$json['redirect'] = $_SESSION['prentz_redirect'];
            } else {
            	$json['redirect'] = $_SERVER['HTTP_REFERER'];
            }
            
		} else {

			$json['fail'] = ' Incorrect Mobile No ';
		  }
		  echo json_encode($json);
}