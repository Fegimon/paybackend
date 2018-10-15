<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include_once 'src/twitteroauth.php';

/*
 * Configuration and setup Twitter API
 */
$consumerKey = 'xPodBLUQFpyy5EbHxTeecbOmL';
$consumerSecret = 'd274Fjn6osfZ5ZL3kbl6fn1eDNcvvORirzmwnJhyc3hBBBdiCc';
$redirectURL = 'http://192.168.1.30/payrentz-dev/login/twitter/index.php?hi';

?>