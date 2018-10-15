<?php 
function openurl($url) {

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch,CURLOPT_TIMEOUT, '3');  $content = trim(curl_exec($ch));  curl_close($ch); 
echo $url;
  }
$username="payrentz"; //use your sms api username
$pass    =     "HG1WJgkG";  //enter your password 

$dest_mobileno   =     "9600224484";//reciever 10 digit number (use comma (,) for multiple users. eg: 9999999999,8888888888,7777777777)
$sms         =     "Test Message from HTTP API";//sms content
$message         =     "Test Message from HTTP API";//sms content
$senderid    =     "PRentz";//use your sms api sender id
$sms_url = sprintf("http://107.20.199.106/api/v3/sendsms/plain?user=payrentz&password=HG1WJgkG&sender=PRentz&SMSText=TEST&GSM=919600224484", $username, $pass , $senderid, $dest_mobileno, $message, urlencode($sms) );
openurl($sms_url);


/*function sendsms()
	{
		
		$username="payrentz"; //use your sms api username
$pass    =     "HG1WJgkG";  //enter your password

$dest_mobileno   =     "9600224484";//reciever 10 digit number (use comma (,) for multiple users. eg: 9999999999,8888888888,7777777777)
$sms         =     "Test Message from HTTP API";//sms content
$message         =     "Test Message from HTTP API";//sms content
$senderid    =     "payrentz";//use your sms api sender id

			$ch = curl_init();

sprintf($ch,CURLOPT_URL,"http://193.105.74.159/api/v3/sendsms/plain?user=XXXXX&password=XXXXX&sender=XXXXX&SMSText=TEST&GSM=9197380XXXXX", $username, $pass , $senderid, $dest_mobileno, $message, urlencode($sms));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 0);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, "&sender=".SMSSENDERID."&number=".$mobile."&message=".$smsmsg."");
			$buffer = curl_exec($ch);
			curl_close($ch);
		
		
	}
	$username="payrentz"; //use your sms api username
$pass    =     "HG1WJgkG";  //enter your password

$dest_mobileno   =     "9600224484";//reciever 10 digit number (use comma (,) for multiple users. eg: 9999999999,8888888888,7777777777)
$sms         =     "Test Message from HTTP API";//sms content
$message         =     "Test Message from HTTP API";//sms content
$senderid    =     "payrentz";//use your sms api sender id
$sms_url = sprintf("http://193.105.74.159/api/v3/sendsms/plain?user=XXXXX&password=XXXXX&sender=XXXXX&SMSText=TEST&GSM=9197380XXXXX", $username, $pass , $senderid, $dest_mobileno, $message, urlencode($sms) );
	sendsms();*/
?>