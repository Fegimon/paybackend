<?php
require_once(dirname(__FILE__).'/../../appcore/app-register.php');
//start session
session_start();

//Include Twitter config file && User class
include_once 'twConfig.php';

//If OAuth token not matched
if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']){
	//Remove token from session
	unset($_SESSION['token']);
	unset($_SESSION['token_secret']);
}

//If user already verified 
if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified' && !empty($_SESSION['request_vars'])){ //print_r($_SESSION['request_vars']);exit;
	//Retrive variables from session
	//$profilePicture	  = $_SESSION['userData']['picture'];
	$usercheck = $conn->select_query(USER,"*","user_status!='D' AND user_oauth_uid='".$_SESSION['request_vars']['user_id']."' AND user_oauth_provider = 'Twitter'","1");

	$user_ip = $conn->getIp();

                if(!$usercheck['nr'])
                {
                    $new = array('user_oauth_provider' => 'Twitter', 'user_oauth_uid' => $_SESSION['request_vars']['user_id'], 'user_name' => $_SESSION['request_vars']['screen_name'], 'user_email' => $_SESSION['request_vars']['email'], 'user_twitter' => 'Http://twitter.com/'.$_SESSION['request_vars']['screen_name'], 'user_ip'=>$user_ip, 'user_status'=>'Y', 'user_dt'=>NOW);
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

                    $update = array('user_oauth_provider' => 'Twitter', 'user_oauth_uid' => $_SESSION['request_vars']['user_id'], 'user_name' => $_SESSION['request_vars']['screen_name'], 'user_email' => $_SESSION['request_vars']['email'], 'user_ip'=>$user_ip, 'user_twitter' => 'Http://twitter.com/'.$_SESSION['request_vars']['screen_name'], 'user_status'=>'Y');

                    $up = $conn->update(USER,"user_status!='D' AND user_oauth_uid='".$_SESSION['request_vars']['user_id']."' AND user_oauth_provider = 'Twitter'",$update);

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
	/*
	 * Prepare output to show to the user
	 */
	$twClient = new TwitterOAuth($consumerKey, $consumerSecret, $oauthToken, $oauthTokenSecret);
	
	//If user submits a tweet to post to twitter
	
}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']){
	//Call Twitter API
	$twClient = new TwitterOAuth($consumerKey, $consumerSecret, $_SESSION['token'] , $_SESSION['token_secret']);
	
	//Get OAuth token
	$access_token = $twClient->getAccessToken($_REQUEST['oauth_verifier']);
	
	//If returns success
	if($twClient->http_code == '200'){
		//Storing access token data into session
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;
		
		//Get user profile data from twitter
		$userInfo = $twClient->get('account/verify_credentials');

		//Initialize User class
		//$user = new User();
		
		//Insert or update user data to the database
		$name = explode(" ",$userInfo->name);
		$fname = isset($name[0])?$name[0]:'';
		$lname = isset($name[1])?$name[1]:'';
		$profileLink = 'https://twitter.com/'.$userInfo->screen_name;
		$twUserData = array(
			'oauth_provider'=> 'twitter',
			'oauth_uid'     => $userInfo->id,
			'first_name'    => $fname,
			'last_name'     => $lname,
			'email'         => '',
			'gender'        => '',
			'locale'        => $userInfo->lang,
			'picture'       => $userInfo->profile_image_url,
			'link'          => $profileLink,
			'username'		=> $userInfo->screen_name
		); 

		//$userData = $user->checkUser($twUserData);
		
		//Storing user data into session
		$_SESSION['userData'] = $userData;
		
		//Remove oauth token and secret from session
		unset($_SESSION['token']);
		unset($_SESSION['token_secret']);
		
		//Redirect the user back to the same page
		header('Location: ./');
	}else{
		//error message
	}
}else{
	//Fresh authentication
	$twClient = new TwitterOAuth($consumerKey, $consumerSecret);
	$request_token = $twClient->getRequestToken($redirectURL);
	
	//Received token info from twitter
	$_SESSION['token']		 = $request_token['oauth_token'];
	$_SESSION['token_secret']= $request_token['oauth_token_secret'];
	
	//If authentication returns success
	if($twClient->http_code == '200'){
		//Get twitter oauth url
		$authUrl = $twClient->getAuthorizeURL($request_token['oauth_token']);
		
		$authUrl = $twClient->getAuthorizeURL($request_token['oauth_token']);

		header('Location:'. filter_var($authUrl, FILTER_SANITIZE_URL));
	}
}
?>