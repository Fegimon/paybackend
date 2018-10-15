<?php
//Include GP config file && User class
require_once(dirname(__FILE__).'/../../appcore/app-register.php');
include_once 'gpConfig.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();  

	$usercheck = $conn->select_query(USER,"*","user_status!='D' AND user_oauth_uid='".$gpUserProfile['id']."' AND user_oauth_provider = 'Google'","1");

    $user_ip = $conn->getIp();
                if(!$usercheck['nr'])
                {
                    $new = array('user_oauth_provider' => 'Google', 'user_oauth_uid' => $gpUserProfile['id'], 'user_name' => $gpUserProfile['name'], 'user_first_name' => $gpUserProfile['given_name'], 'user_last_name' => $gpUserProfile['family_name'], 'user_locale' => $gpUserProfile['locale'], 'user_profile' => $gpUserProfile['picture'], 'user_ip'=>$user_ip, 'user_email' => $gpUserProfile['email'], 'user_facebook' => $gpUserProfile['link'], 'user_status'=>'Y', 'user_dt'=>NOW);
                    $ins = $conn->insert(USER,"",$new);

                    $lastid = mysql_insert_id();

                    $_SESSION['prentz_user_name'] = $_SESSION['request_vars']['screen_name'];
                    $_SESSION['prentz_user_email'] = $_SESSION['request_vars']['email'];
                    $_SESSION['prentz_user_id'] = $lastid;
                    $_SESSION['prentz_user_mobile'] = '';

                   if (isset($_SESSION['prentz_redirect'])) {
                        header("Location:".$_SESSION['prentz_redirect']);
                    } else {
                        header("Location: ../../index.php");
                    }
                } else {

                    $update = array('user_oauth_provider' => 'Google', 'user_oauth_uid' => $gpUserProfile['id'], 'user_name' => $gpUserProfile['name'], 'user_first_name' => $gpUserProfile['given_name'], 'user_last_name' => $gpUserProfile['family_name'], 'user_ip'=>$user_ip, 'user_locale' => $gpUserProfile['locale'], 'user_profile' => $gpUserProfile['picture'], 'user_email' => $gpUserProfile['email'], 'user_facebook' => $gpUserProfile['link'], 'user_status'=>'Y');

                    $up = $conn->update(USER,"user_status!='D' AND user_oauth_uid='".$gpUserProfile['id']."' AND user_oauth_provider = 'Google'",$update);

                     $_SESSION['prentz_user_name'] = $usercheck['user_name'];
                    $_SESSION['prentz_user_email'] = $usercheck['user_email'];
                    $_SESSION['prentz_user_id'] = $usercheck['user_id'];
                    $_SESSION['prentz_user_mobile'] = $usercheck['user_mobile'];
                    if (isset($_SESSION['prentz_redirect'])) {
                        header("Location:".$_SESSION['prentz_redirect']);
                    } else {
                        header("Location: ../../index.php");
                    }
                }
     

} else {
	$authUrl = $gClient->createAuthUrl();
	header('Location:'. filter_var($authUrl, FILTER_SANITIZE_URL));
}
?>
