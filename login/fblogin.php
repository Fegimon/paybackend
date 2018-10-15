<?php
require_once(dirname(__FILE__).'/../appcore/app-register.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
 
 
// Include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';


 
// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*$appId = '143362989661301'; //Facebook App ID
$appSecret = '7760a8ea145ce040ed9490cfa62dffb1'; //Facebook App Secret*/

$appId = '188529472009495'; //Facebook App ID
$appSecret = '65dd36c357219d18eb2f8482409bc98f'; //Facebook App Secret
$redirectURL = SITE_URL.'login/fblogin.php'; //Callback URL
$fbPermissions = array('email');  //Optional permissions 
 
$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.9',
        ));
 
// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();
 
// Try to get access token
try {
    // Already login
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
 
    if (isset($accessToken)) {
        if (isset($_SESSION['facebook_access_token'])) {
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        } else {
            // Put short-lived access token in session
            $_SESSION['facebook_access_token'] = (string) $accessToken;
 
            // OAuth 2.0 client handler helps to manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();
 
            // Exchanges a short-lived access token for a long-lived one
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
            $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
 
            // Set default access token to be used in script
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }
 
        // Redirect the user back to the same page if url has "code" parameter in query string
        if (isset($_GET['code'])) {
 
            // Getting user facebook profile info
            try {
                $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
                $fbUserProfile = $profileRequest->getGraphNode()->asArray(); //print_r($fbUserProfile); exit;
                // Here you can redirect to your Home Page.
                $usercheck = $conn->select_query(USER,"*","user_status!='D' AND user_oauth_uid='".$fbUserProfile['id']."' AND user_oauth_provider = 'Facebook'","1");
                 
                 $user_ip = $conn->getIp();

                if(!$usercheck['nr'])
                {

                    $new = array('user_oauth_provider' => 'Facebook', 'user_oauth_uid' => $fbUserProfile['id'], 'user_name' => $fbUserProfile['name'], 'user_first_name' => $fbUserProfile['first_name'], 'user_last_name' => $fbUserProfile['last_name'], 'user_profile' => $fbUserProfile['picture'], 'user_email' => $fbUserProfile['email'], 'user_status'=>'Y', 'user_ip'=>$user_ip, 'user_dt'=>NOW);
                    $ins = $conn->insert(USER,"",$new);

                    $lastid = mysql_insert_id();

                    $_SESSION['prentz_user_name'] = $fbUserProfile['name'];
                    $_SESSION['prentz_user_email'] = $fbUserProfile['email'];
                    $_SESSION['prentz_user_mobile'] = '';
                    $_SESSION['prentz_user_id'] = $lastid;

                   if (isset($_SESSION['prentz_redirect'])) {
                        header("Location:".$_SESSION['prentz_redirect']);
                    } else {
                        header("Location: ../index.php");
                    }
                } else {

                    $update = array('user_oauth_provider' => 'Facebook', 'user_oauth_uid' => $fbUserProfile['id'], 'user_name' => $fbUserProfile['name'], 'user_first_name' => $fbUserProfile['first_name'], 'user_last_name' => $fbUserProfile['last_name'], 'user_profile' => $fbUserProfile['picture'], 'user_email' => $fbUserProfile['email'],  'user_ip'=>$user_ip, 'user_status'=>'Y');

                    $up = $conn->update(USER,"user_status!='D' AND user_oauth_uid='".$fbUserProfile['id']."' AND user_oauth_provider = 'Facebook'",$update);

                    $_SESSION['prentz_user_name'] = $usercheck['user_name'];
                    $_SESSION['prentz_user_email'] = $usercheck['user_email'];
                    $_SESSION['prentz_user_id'] = $usercheck['user_id'];
                    $_SESSION['prentz_user_mobile'] = $usercheck['user_mobile'];
                    if (isset($_SESSION['prentz_redirect'])) {
                        header("Location:".$_SESSION['prentz_redirect']);
                    } else {
                        header("Location: ../index.php");
                    }

                }
                //echo "<pre/>";
                //
                
            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                session_destroy();
                // Redirect user back to app login page
                header("Location: ./");
                exit;
            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
        }
    } else {
        // Get login url
 
        $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
        header("Location: " . $loginURL);
        
    }
} catch (FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
 
?>