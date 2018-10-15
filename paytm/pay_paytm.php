<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
//echo $_SESSION['ses_oid'].'1';
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
//echo $_SESSION['ses_oid'].'2';
$checkSum = "";
$paramList = array();

if($_SESSION['ses_oid'])
{
	$getOrder = $conn->select_query(ORDER,"*","user_id='".$_SESSION['ses_userid']."' AND id='".$_SESSION['ses_oid']."' AND status='Y'","1");
}
$ORDER_ID = $getOrder["ord_id"];
$CUST_ID = $getOrder["user_id"];
$INDUSTRY_TYPE_ID = 'Retail';
$CHANNEL_ID = 'WEB';//APP
$TXN_AMOUNT = round($getOrder["order_total"]);

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

/*
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/
print_r($paramList);exit;
//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

//echo "kalidas"; 
//echo PAYTM_TXN_URL; exit;
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
				echo '<input type="text" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
		//	document.f1.submit();
		</script>
	</form>
</body>
</html>