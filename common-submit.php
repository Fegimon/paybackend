<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
if(isset($_POST['submitLogin'])&&$_POST['submitLogin']=='submit')
{
	//LOGIN
	$usrname=$conn->variable($_POST['username']);
	$usrpass=$_POST['userpass'];
	if($usrpass!=""&&$usrname!="")
	{
		$Select_usr=$conn->select_query(USER, "*", "user_email='".$usrname."' AND user_status='Y'",1);
		$user_pass = $Select_usr['user_pass'];
		if($Select_usr['nr'])
		{
			if($conn->encpyt($usrpass)==$user_pass)
			{
				$_SESSION['ses_userid'] = $Select_usr['user_id'];
				$_SESSION['ses_username'] = (strlen($Select_usr['user_name'])>100)?@substr($conn->stripval($Select_usr['user_name']),0,100):$Select_usr['user_name'];
				$Alertsuccess="Welcome ".$conn->stripval($Select_usr['user_name']);
				$Alertsuccessurl=($_REQUEST['rpage']!='')?$conn->decode($_REQUEST['rpage']):$conn->getOwnURL();
				
			}else
			{
				$Alerterror="Invalid Login";
				$Alerterrorurl=$conn->getOwnURL();
			}
		}else
		{
			$Alerterror="Invalid Login";
			$Alerterrorurl=$conn->getOwnURL();
		}
	}else
	{
		$Alerterror="Please Fill Email and password";
		$Alerterrorurl=SITE_URL;
	}
}
if(isset($_POST['submitReg'])&&$_POST['submitReg']=='submit')
{
	
	//REGISTER USER
	$user_name=$conn->variable($_POST['regname']);
	$user_email=$conn->variable($_POST['regemail']);
	$user_mobile=$conn->variable($_POST['regmobile']);
	$user_pass=$conn->variable($_POST['regpass']);
	$userpass=$conn->encpyt($user_pass);
	
	if($user_name!=""&&$user_email!=""&&$userpass!='')
	{
			if (!filter_var($user_email, FILTER_VALIDATE_EMAIL) === false)
			{
				$usercheck = $conn->select_query(USER,"*","user_status!='D' AND user_email='".$user_email."'","1");
				if(!$usercheck['nr'])
				{
					$password=$userpass;
					$user_ip=$conn->getIp();
					$user_status='Y';
					$new = array('user_name'=>$user_name,'user_email'=>$user_email,'user_mobile'=>$user_mobile,'user_pass'=>$password,'user_status'=>$user_status,'user_ip'=>$user_ip,'user_dt'=>NOW);
					$ins = $conn->insert(USER,"",$new);
					if($ins)
					{
						$to=$user_email;
						$from=$EXTRA_ARG['set_email'];
						$uname=$user_name;
						$userpass=$_REQUEST['password'];
						
						$to=$user_email;
						$from=$EXTRA_ARG['set_email'];
						$uname=$user_name;
						$userpass=$_REQUEST['regpass'];
						include "mailcontent/registration.php";
						
						
						$Select_usr = $conn->select_query(USER,"*","user_id='".$ins['id']."'","1");
						$_SESSION['ses_userid'] = $Select_usr['user_id'];
						$_SESSION['ses_username'] = (strlen($Select_usr['user_name'])>100)?@substr($conn->stripval($Select_usr['user_name']),0,100):$Select_usr['user_name'];
						
							
						$Alertsuccess="Welcome ".$_SESSION['ses_username'];
						$Alertsuccessurl=($Alertsuccessurl)?$Alertsuccessurl:SITE_URL."my-profile.html";
					}
				}else
				{
					$Alerterror="Sorry user already exist !!!";
					$Alerterrorurl=$conn->getOwnURL();
				}
			}else
			{
				$Alerterror="Please enter valid Email.";
				$Alerterrorurl=$conn->getOwnURL();
			}
	}else
	{
		$Alerterror="Please fill all required fields.";
		$Alerterrorurl=$conn->getOwnURL();
	}
}
?>