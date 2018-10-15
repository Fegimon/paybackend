<?php
require_once ('config.php');

// Personal Detail

@$c_type = $_POST['c_type'];
@$c_name = $_POST['c_name'];
@$c_dob = $_POST['c_dob'];
@$c_age = date_diff(date_create($c_dob) , date_create('today'))->y;
@$c_nativity = $_POST['c_nativity'];
@$c_gender = $_POST['c_gender'];
@$c_mart_status = $_POST['c_mart_status'];
@$c_res_status = $_POST['c_res_status'];
@$c_mobile_type = $_POST['c_mobile_type'];
@$c_mobile_no = $_POST['c_mobile_no'];
@$c_pincode = $_POST['c_pincode'];
@$c_floor = $_POST['c_floor'];

// Professional Detail

@$c_company_name = $_POST['c_company_name'];
@$c_company_designation = $_POST['c_company_designation'];
@$c_depart = $_POST['c_depart'];
@$c_email = $_POST['c_email'];
@$c_alter_email = $_POST['c_alter_email'];
@$c_state = $_POST['c_state'];
@$c_city = $_POST['c_city'];
@$c_zone = $_POST['c_zone'];
@$c_area = $_POST['c_area'];
@$c_address_type = $_POST['c_address_type'];
@$c_address = $_POST['c_address'];

// Reference Detail

@$c_ref_name = $_POST['c_ref_name'];
@$c_ref_email = $_POST['c_ref_email'];
@$c_ref_mobile = $_POST['c_ref_mobile'];
@$c_ref_add = $_POST['c_ref_add'];

// KYC Detail

@$c_proof = $_POST['c_proof'];
@$proof_status0 = $_POST['proof_status0'];
@$proof_status1 = $_POST['proof_status1'];
@$proof_status2 = $_POST['proof_status2'];
@$proof_status3 = $_POST['proof_status3'];
@$kycstatus = $_POST['kycstatus'];
@$c_remarks = $_POST['c_remarks'];

// Customer Status

@$customer_status = $_POST['customer_status'];

// Temprory customer

if (!$customer_status)
	{
	$generatedEnqiryId = $functs->generateEnqiryIdFn();
	$newCustomerId = $generatedEnqiryId;
	$id_type = 'enquiry_id';

	// $tempro = $functs->generateInvoiceThisMonthNewEnq();

	$e_type = 1;
	}

// Direct customer

  else
	{
	$generatedEnqiryId = $functs->generateEnqiryIdFn();
	$generateCustomerid = $functs->generateCustomerIdFn();
	$lastCustomerId = $generateCustomerid[0]["id"];
	preg_match("/(\D+)(\d+)/", $lastCustomerId, $Matches); // Matches the PU and number
	$ProductCode = $Matches[1];
	$NewID = intval($Matches[2]);
	$NewID++;
	$BarcodeLength = 4;
	$CurrentLength = strlen($NewID);
	$MissingZeros = $BarcodeLength - $CurrentLength;
	for ($i = 0; $i < $MissingZeros; $i++) $NewID = "0" . $NewID;
	$newCustomerId = $ProductCode . $NewID;
	$id_type = 'customer_id';
	$e_type = 0;
	}

$t = date('d-m-Y');
$c_m = date("m", strtotime($t));
$c_y = date("Y", strtotime($t));
$t_d = cal_days_in_month(CAL_GREGORIAN, $c_m, $c_y);

// Insert General Detail

$Insert_data = array(
	$id_type => $newCustomerId,
	'customer_type_id' => $c_type,
	'customer_name' => $c_name,
	'dob' => $c_dob,
	'age' => $c_age,
	'nativity' => $c_nativity,
	'marital_status' => $c_mart_status,
	'residential_status' => $c_res_status,
	'gender' => $c_gender,
	'customer_status' => $customer_status,
	'email' => $c_email,
	'state_id' => $c_state,
	'city_id' => $c_city,
	'zone_id' => $c_zone,
	'area_id' => $c_area,
	'month' => $c_m,
	'year' => $c_y,
	'pincode' => $c_pincode,
	'floor' => $c_floor
);
$table_name = 'customer_general_detail';
$insertData = $functs->insertFn($table_name, $Insert_data);

// Insert Mobile Detail

$mobile_count = count(@$c_mobile_no);

for ($x = 0; $x < $mobile_count; $x++)
	{
	$Insert_data = array(
		$id_type => $newCustomerId,
		'mobile' => $c_mobile_no[$x],
		'type' => $c_mobile_type[$x]
	);
	$table_name = 'customer_contact';
	$insertData = $functs->insertFn($table_name, $Insert_data);
	}

// Insert Address Detail

$address_count = count($c_address);

for ($x = 0; $x < $address_count; $x++)
	{
	$Insert_data = array(
		$id_type => $newCustomerId,
		'address' => $c_address[$x],
		'type' => $c_address_type[$x],
		'state' => $c_state,
		'city' => $c_city,
		'zone' => $c_zone,
		'area' => $c_area
	);
	$table_name = 'customer_address';
	$insertData = $functs->insertFn($table_name, $Insert_data);
	}

// Insert Professional Detail

$Insert_data = array(
	$id_type => $newCustomerId,
	'company_name' => $c_company_name,
	'designation' => $c_company_designation,
	'department' => $c_depart,
	'email' => $c_email,
	'alternative_email' => $c_alter_email,
	'state' => $c_state,
	'city' => $c_city,
	'zone' => $c_zone,
	'area' => $c_area
);
$table_name = 'customer_professional';
$insertData = $functs->insertFn($table_name, $Insert_data);

// Insert Reference Detail

$ref_count = count($c_ref_name);

for ($x = 0; $x < $ref_count; $x++)
	{
	$Insert_data = array(
		$id_type => $newCustomerId,
		'name' => $c_ref_name[$x],
		'email' => $c_ref_email[$x],
		'mobile' => $c_ref_mobile[$x],
		'address' => $c_ref_add[$x]
	);
	$table_name = 'customer_reference_detail';
	$insertData = $functs->insertFn($table_name, $Insert_data);
	}

$firstFolderName = $newCustomerId;
session_start();
$city = $_SESSION['city'];
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName, 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/image', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Company Id', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Canceled Cheque', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Id Proof', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Address Proof', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Receipts', 0777, true);
mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName . '/Id Proof/Invoice', 0777, true);
@$c_type = $_POST['c_type'];
$folder = "";

for ($x = 0; $x <= 4; $x++)
	{
	if ($x === 0)
		{
		$target_dir = "../Documents/customer/$firstFolderName/image/";
		$f_name = $_FILES["userfile"]["name"][$x];
		$proof_type = "image";
		}

	if ($x === 1)
		{
		$target_dir = "../Documents/customer/$firstFolderName/Id Proof/Company Id/";
		$f_name = $_FILES["userfile"]["name"][$x];
		$proof_type = "Company Id";
		}

	if ($x === 2)
		{
		$target_dir = "../Documents/customer/$firstFolderName/Id Proof/Canceled Cheque/";
		$f_name = $_FILES["userfile"]["name"][$x];
		$proof_type = "Canceled Cheque";
		}

	if ($x === 3)
		{
		$target_dir = "../Documents/customer/$firstFolderName/Id Proof/Id Proof/";
		$f_name = $_FILES["userfile"]["name"][$x];
		$proof_type = "Id Proof";
		}

	if ($x === 4)
		{
		$target_dir = "../Documents/customer/$firstFolderName/Id Proof/Address Proof/";
		$f_name = $_FILES["userfile"]["name"][$x];
		$proof_type = "Address Proof";
		}

	$Insert_data = array(
		$id_type => $newCustomerId,
		'path' => $f_name,
		'proof_type' => $proof_type
	);
	$table_name = 'kyc';
	$insertData = $functs->insertFn($table_name, $Insert_data);
	$target_file = $target_dir . basename($_FILES["userfile"]["name"][$x]);
	$target_file;
	if (move_uploaded_file($_FILES["userfile"]["tmp_name"][$x], $target_file))
		{
		}
	  else
		{
		echo "Sorry, there was an error uploading your file.";
		}
	}

// Get static Data

@$e_cus_id = $newCustomerId;
@$e_f_date = date("m/d/y");
@$e_attend = 1;
@$e_assign = 1;
@$e_f_date = date("m/d/y");
@$e_remark = 1;
@$e_mode = 0;

// save enquiry data
// $generatedEnqiryId = $functs->generateEnqiryIdFn();
// Dynamic Data

@$e_var = $_POST['e_var'];
@$e_quan = $_POST['e_quan'];
@$e_delivery = $_POST['e_delivery'];
@$e_rent = $_POST['e_rent'];
@$e_tenure = $_POST['e_tenure'];
@$e_rent_cost = $_POST['e_rent_cost'];
@$e_security = $_POST['e_security'];
@$e_pro_fee = $_POST['e_pro_fee'];
@$e_ins_fee = $_POST['e_ins_fee'];
$var_count = count($e_var);
$t_s_amount = 0;
$t_p_amount = 0;
$t_i_amount = 0;

for ($x = 0; $x < $var_count; $x++)
	{

	// Get variant amount

	$getVariantAmount = $functs->getVariantAmountFn($e_var[$x]);
	$t_s_amount+= $e_security[$x] * $e_quan[$x];
	$t_p_amount+= $e_pro_fee[$x] * $e_quan[$x];
	$t_i_amount+= $e_ins_fee[$x] * $e_quan[$x];

	// save enquiry product

	$values = array(
		'enquiry_id' => $generatedEnqiryId,
		'customer_id' => $e_cus_id,
		'ptdvar_id' => $e_var[$x],
		'quantity' => $e_quan[$x],
		'expecting_delivery_date' => $e_delivery[$x],
		'rent_per_month' => $e_rent_cost[$x],
		'security_deposit_amount' => $e_security[$x],
		'rent_months_count' => $e_rent[$x],
		'tenure' => $e_tenure[$x],
		'processing_fee' => $e_pro_fee[$x],
		'ins_fee' => $e_ins_fee[$x],
		'other_fee' => $getVariantAmount["other_fee"]
	);
	$storeBase = 'enquiry_products';
	$functs->insertFn($storeBase, $values);
	}

$total_amount = $t_s_amount + $t_p_amount + $t_i_amount;
$values = array(
	'enquiry_id' => $generatedEnqiryId,
	'customer_status' => $e_type,
	'customer_id' => $e_cus_id,
	'enquiry_date' => date("Y-m-d"),
	'attended_by' => $e_attend,
	'assigned_to' => $e_assign,
	'followup_date' => $e_f_date,
	'followup_remarks' => $e_remark,
	'mode' => $e_mode,
	'total_security_amount' => $t_s_amount,
	'total_processing_fee' => $t_p_amount,
	't_installation_fee' => $t_i_amount,
	'total_amount' => $total_amount
);
$storeBase = 'enquiries';
$functs->insertFn($storeBase, $values);

// Temprory customer

if (!$customer_status)
	{
	$update_data = array(
		'customer_id' => '0',
		'e_id' => '1'
	);
	$where_con = array(
		'enquiry_id' => $generatedEnqiryId
	);
	$table_name = 'enquiries';
	$functs->updateTableFn($update_data, $where_con, $table_name);
	$update_data = array(
		'customer_id' => '0'
	);
	$where_con = array(
		'enquiry_id' => $generatedEnqiryId
	);
	$table_name = 'enquiry_products';
	$functs->updateTableFn($update_data, $where_con, $table_name);
	header('Location: ../Noncustomer-view.php');
	}

// Direct customer

  else
	{
	header('Location: ../customer-view.php');
	}

?>
