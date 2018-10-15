<?php
$today = date('h-i-s');
$db_name = "paytrentz1";
	$conn = mysqli_connect("localhost", "payadmin159", "payadmin159", $db_name);
$table = 'customer_general_detail';

$querys = "SELECT  r.year,`customer_type_id` , `customer_status` , doj,  `closed_on` , a.customer_id,  `customer_name` ,  `age` , `dob` ,  `nativity` , gender, `marital_status`, `floor`, `area_id`, `zone_id`, `city_id`, `state_id`, pincode, done_by, r.product_id FROM  `customer_general_detail` AS a INNER JOIN rent_history as r on r.customer_id = a.customer_id  group by a.customer_id,r.year,r.product_id ";

$filename1 = "Customer Data Report $today.csv";
$fp = fopen($filename1, 'w');

$header = ['Year', 'Customer Type', 'Customer Status', 'Date of Join', 'Date of Close', 'Customer Id', 'Customer Name', 'Age', 'Date of Birth', 'Nativity', 'Gender', 'Maritial Status', 'Floor', 'Area', 'Zone', 'City', 'State', 'Pincode', 'KYC Done by', 'Product Id', 'Product Category', 'Product Variant', 'Rent Per month', 'Rental Deposit', 'Registration Fee', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=' . $filename1);
fputcsv($fp, $header);

$num_column = count($header);
$query = $querys;
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_row($result))
{
	$p_id = $row[19];
	$year = $row[0];
///////////////////////////////////////////////////////////////////////////////////////////
	$querys = "SELECT `ptdvar_id` FROM `product` WHERE `product_id`='$p_id'";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$var = $ro[0];
		$querys1 = "SELECT description,name,rent_cost,security_deposit_price,processing_fee FROM `product_variant` WHERE `ptdvar_id`='$var'";
		$resul1 = mysqli_query($conn, $querys1);
		while ($ro1 = mysqli_fetch_row($resul1))
		{
			$row[20] = $ro1[0];
			$row[21] = $ro1[1];
			$row[22] = $ro1[2];
			$row[23] = $ro1[3];
			$row[24] = $ro1[4];
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////
	$querys = "SELECT `rent_cost`,month FROM `rent_history` WHERE `product_id`='$p_id' and year ='$year'";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$mon = $ro[1];
		$row[24 + $mon] = $ro[0];
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($row[1] == 1)
	{
		$row[1] = "Individual";
	}
	else if ($row[1] == 2)
	{
		$row[1] = "Corporate";
	}
	else
	{
		$row[1] = "Event";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($row[2] == 1)
	{
		$row[2] = "Active";
	}
 	else if ($row[2] == 2)
	{
		$row[2] = "Closed";
	}
	else
	{
		$row[2] = "New";
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
	$nav = $row[9];
	if($nav!=null){
		$querys = "SELECT `name` FROM `nativity` WHERE `id`=$nav ";
		$resul = mysqli_query($conn, $querys);
		while ($ro = mysqli_fetch_row($resul))
		{
			$row[9] = $ro[0];
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($row[10] == 0)
	{
		$row[10] = "Mr.";
	}
	else if ($row[10] == 1)
	{
		$row[10] = "Ms.";
	}
	else if ($row[10] == 2)
	{
		$row[10] = "Dr.";
	}
	else if ($row[10] == 3)
	{
		$row[10] = "M/s.";
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($row[11] == 0)
	{
		$row[11] = "Single";
	}
	else if ($row[11] == 1)
	{
		$row[11] = "Married";
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$areaId = $row[13];
	$querys = "SELECT `name` FROM `area` where id = $areaId ";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$val = $ro[0];
		$row[13] = $ro[0];
	}
	$areaId = $row[14];
	$querys = "SELECT `name` FROM `zone` where id = $areaId ";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$val = $ro[0];
		$row[14] = $ro[0];
	}
	$areaId = $row[15];
	$querys = "SELECT `name` FROM `cities` where id = $areaId ";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$val = $ro[0];
		$row[15] = $ro[0];
	}
	$areaId = $row[16];
	$querys = "SELECT `name` FROM `states` where id = $areaId ";
	$resul = mysqli_query($conn, $querys);
	while ($ro = mysqli_fetch_row($resul))
	{
		$val = $ro[0];
		$row[16] = $ro[0];
	}
	fputcsv($fp, $row);
}
echo $filename1;
?>
