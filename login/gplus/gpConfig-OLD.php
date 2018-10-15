<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '453451844458-3jpqv198da684g7758egiu02cp6llo81.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'l0vlYg_r8G89TtDZGJ4xkX4g'; //Google client secret
$redirectURL = 'http://192.168.1.30/payrentz-dev/login/gplus'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('test');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>