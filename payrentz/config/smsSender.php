<?PHP
require_once('config.php'); 
@$cids = $_POST['c_id'];

$s_id = explode(",",$cids);
$c = count($s_id);
$con ='';
for ($x = 0; $x < $c; $x++) { 
 $getContact = $functs->fngetContact($s_id[$x]);
 $c_contact    = $getContact["mobile"];
$conc1 = explode(",",$c_contact);
$d = count($conc1);
for ($y = 0; $y < $d; $y++) { 
$con .='91'.$conc1[$y].',';
}

 }
$sms= $functs->getsms();
$sms = str_replace(' ', '%20', $sms[0]["description"]);



function openurl($url) {

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch,CURLOPT_TIMEOUT, '3');  $content = trim(curl_exec($ch));  curl_close($ch); 
echo $url;
  }
$username="payrentz"; //use your sms api username
$pass    ="HG1WJgkG";  //enter your password
$dest_mobileno   = $con;

$dest_mobileno   =  "918531075313";
$sms         =     "Test Message from HTTP API";//sms content
$senderid    =     "PRentz";//use your sms api sender id
//$sms_url = sprintf("http://193.105.74.159/api/v3/sendsms/plain?user=XXXXX&password=XXXXX&sender=XXXXX&SMSText=TEST&GSM=9197380XXXXX", $username, $pass , $senderid, $dest_mobileno, $message, urlencode($sms) );
$sms_url ="http://193.105.74.159/api/v3/sendsms/plain?user=payrentz&password=HG1WJgkG&sender=PRentz&SMSText=".$sms."&GSM=".$dest_mobileno."";
openurl($sms_url);
  //$functs->smsStatus($s_id[$x]);

?>
