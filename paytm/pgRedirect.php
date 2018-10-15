<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("lib/config_paytm.php");
require_once("lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();
$uid = $_SESSION['prentz_user_id'];
$oid =  $_SESSION['ses_oid'];
if($_SESSION['ses_oid']) 
{    
    $order = $conn->select_query(ORDER,"*","ord_id='".$oid."'","1");
  
}
 $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");

$paytotal=round($order['total']);


$CUST_ID = $uid;
$INDUSTRY_TYPE_ID = 'Retail';
$CHANNEL_ID = 'WEB';//APP
$TXN_AMOUNT = $paytotal;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $_SESSION['ses_oid'];
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
//$paramList["CALLBACK_URL"] = SITE_URL;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
//print_r($paramList);exit;

$paramList["CALLBACK_URL"] = SITE_URL."paytm/TxnStatus.php";

/*$paramList["MSISDN"] = '7777777777'; //Mobile number of customer
$paramList["EMAIL"] = 'prithivi.mirrorminds@gmail.com'; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //*/



//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>