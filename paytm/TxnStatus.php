<?php
require_once(dirname(__FILE__).'/app-register.php');
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	// following files need to be included
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");
	
	if($_SESSION['ses_oid'])
{
	$getOrder = $conn->select_query(ORDER,"*","ord_id='".$_SESSION['ses_oid']."'","1");
	
}

	$ORDER_ID = $getOrder["ord_id"];
	$requestParamList = array();
	$responseParamList = array();

//	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		//$ORDER_ID = $_SESSION['order_id'];

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $ORDER_ID);  

		// Call the PG's getTxnStatus() function for verifying the transaction status.
		$responseParamList = getTxnStatus($requestParamList);
		
	//}
	
	
	//print_r($responseParamList);
 	$ordstatus=$responseParamList['STATUS'];
	//echo $ordstatus;exit;
if ($ordstatus == "TXN_SUCCESS") {
	
		//$conn->divert(SITE_URL.'order-success.html');
		$conn->divert(SITE_URL.'myform/');
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		$conn->divert(SITE_URL.'order-failed/');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Transaction status query</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
	<h2>Transaction status query</h2>
	<form method="post" action="">
		<table border="1">
			<tbody>
				<tr>
					<td><label>ORDER_ID::*</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $ORDER_ID ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input value="Status Query" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		<br/></br/>
		<?php
		if (isset($responseParamList) && count($responseParamList)>0 )
		{ 
		?>
		<h2>Response of status query:</h2>
		<table style="border: 1px solid nopadding" border="0">
			<tbody>
				<?php
					foreach($responseParamList as $paramName => $paramValue) {
						
					
				?>
				<tr >
					<td style="border: 1px solid"><label><?php //echo $paramName?></label></td>
					<td style="border: 1px solid"><?php //echo $paramValue?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
		}
		?>
	</form>
</body>
</html>