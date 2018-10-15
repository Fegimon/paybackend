<?php

 require_once('config.php');

 //Personal Detail
 @$cus_id = $_POST['cus_id'];
 @$c_type = $_POST['c_type'];
 @$c_name = $_POST['c_name'];
 @$c_dob = $_POST['c_dob'];
 @$c_age = date_diff(date_create($c_dob), date_create('today'))->y;
 @$c_nativity = $_POST['c_nativity'];
 @$c_gender = $_POST['c_gender'];
 @$c_mart_status = $_POST['c_mart_status'];
 @$c_res_status = $_POST['c_res_status'];
 @$c_mobile_type = $_POST['c_mobile_type'];
 @$c_mobile_no = $_POST['c_mobile_no'];
 @$c_pincode = $_POST['c_pincode'];
 @$c_floor = $_POST['c_floor'];


 //Professional Detail
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


 //Reference Detail
 @$c_ref_name = $_POST['c_ref_name'];
 @$c_ref_email = $_POST['c_ref_email'];
 @$c_ref_mobile = $_POST['c_ref_mobile'];
 @$c_ref_add = $_POST['c_ref_add'];


 //KYC Detail
 @$c_proof = $_POST['c_proof'];
 @$proof_status0 = $_POST['proof_status0'];
 @$proof_status1 = $_POST['proof_status1'];
 @$proof_status2 = $_POST['proof_status2'];
 @$proof_status3 = $_POST['proof_status3'];
 @$kycstatus = $_POST['kycstatus'];
 @$c_remarks = $_POST['c_remarks'];




 //Customer Status
 @$customer_status = $_POST['customer_status'];


 $ce_id = mb_substr($cus_id, 0, 2);
 //Temprory customer
 if($ce_id=='PR' || $ce_id=='EV')
 {
	$newCustomerId = $cus_id;
	$id_type = 'customer_id';


	//$tempro = $functs->generateInvoiceThisMonthNewEnq();
 }

 //Direct customer
 else
 {
	$newCustomerId = $cus_id;
	$id_type = 'enquiry_id';


 }


// Upload part edit
  $firstFolderName  =$newCustomerId;
    $dir ='../Documents/customer/' . $firstFolderName;
       if (!is_dir($dir)) {
      mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName, 0777, true);
      mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/image', 0777, true);
      mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof', 0777, true);
      mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Company Id', 0777, true);
        mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Canceled Cheque', 0777,true);
    mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Id Proof', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Address Proof', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Receipts', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Invoice', 0777, true);
        }
   session_start();
   $city = $_SESSION['city'] ;


    @$c_type = $_POST['c_type'];

	 $folder="";

	  @$kyclen = $_POST['kyclen'];


	for ($x = 0; $x <=4 ; $x++) {





		if($x===0)
		{
		 $target_dir = "../Documents/customer/$firstFolderName/image/";
		 $f_name = $_FILES["userfile"]["name"][$x];
         $proof_type = "image";

		}
		if($x===1)
		{
		 $target_dir = "../Documents/customer/$firstFolderName/Id Proof/Company Id/";
		  $f_name = $_FILES["userfile"]["name"][$x];
         $proof_type = "Company Id";
		}
		if($x===2)
		{
		 $target_dir = "../Documents/customer/$firstFolderName/Id Proof/Canceled Cheque/";
		  $f_name = $_FILES["userfile"]["name"][$x];
         $proof_type = "Canceled Cheque";
		}
		if($x===3)
		{
		 $target_dir = "../Documents/customer/$firstFolderName/Id Proof/Id Proof/";
		  $f_name = $_FILES["userfile"]["name"][$x];
         $proof_type = "Id Proof";
		}
		if($x===4)
		{
		 $target_dir = "../Documents/customer/$firstFolderName/Id Proof/Address Proof/";
		 $f_name = $_FILES["userfile"]["name"][$x];
         $proof_type = "Address Proof";
		}


        if($kyclen == 5)
      {
		  if($f_name=="")
		  {

		  }
		  else
		  {
		 $update_data = array('path' => $f_name);
		 $where_con = array('proof_type' =>$proof_type,$id_type =>$firstFolderName);
         $table_name='kyc';
         $functs->updateTableFn($update_data,$where_con,$table_name);
		  }

      }
	  else
	  {
		 $Insert_data = array($id_type => $newCustomerId,'path' => $f_name,'proof_type' =>$proof_type);
         $table_name='kyc';
         $insertData = $functs->insertFn($table_name,$Insert_data);
	  }


     $target_file = $target_dir . basename($_FILES["userfile"]["name"][$x]);
	 $target_file;

    if (move_uploaded_file($_FILES["userfile"]["tmp_name"][$x], $target_file))
	{






    }
	else
	{

    }
} // upload edit close


//general detail edit


  $update_data = array('customer_type_id' => $c_type,'customer_name'=>$c_name,'dob'  =>$c_dob,'age' => $c_age,'nativity'=>$c_nativity,'marital_status'  =>$c_mart_status,'residential_status'  =>$c_res_status,'gender'  =>$c_gender,'email' =>$c_email,'state_id' =>$c_state,'city_id' =>$c_city,'zone_id' =>$c_zone,'area_id' =>$c_area,'remark'=>$c_remarks,'pincode'=>$c_pincode,'floor'=>$c_floor);
  $where_con = array( $id_type => $newCustomerId);
  $table_name='customer_general_detail';
  $functs->updateTableFn($update_data,$where_con,$table_name);
  //print_r($id_type);
  //exit;

   //professional detail edit

   $delete_where = array($id_type => $newCustomerId);
   $table_name='customer_professional';
   $functs->deletefn($delete_where,$table_name);


   $Insert_data = array($id_type => $newCustomerId,'company_name' => $c_company_name,'designation' =>$c_company_designation,'department' =>$c_depart,'email' =>$c_email,'alternative_email' =>$c_alter_email,'state' =>$c_state,'city' =>$c_city,'zone'=>$c_zone,'area' =>$c_area);
   $insertData = $functs->insertFn($table_name,$Insert_data);


   $delete_where = array($id_type => $newCustomerId);
   $table_name='customer_contact';
   $functs->deletefn($delete_where,$table_name);
    //Insert Mobile Detail
  $mobile_count  = count(@$c_mobile_no);

   for($x = 0; $x <$mobile_count ; $x++)
  {


     $Insert_data = array($id_type => $newCustomerId,'mobile' => $c_mobile_no[$x],'type' =>$c_mobile_type[$x]);
     $table_name='customer_contact';

     $insertData = $functs->insertFn($table_name,$Insert_data);
  }


 //Insert Address Detail

   $delete_where = array($id_type => $newCustomerId);
   $table_name='customer_address';
   $functs->deletefn($delete_where,$table_name);

  $address_count  = count($c_address);

   for($x = 0; $x <$address_count; $x++)
  {


     $Insert_data = array($id_type =>$newCustomerId,'address' => $c_address[$x],'type' =>$c_address_type[$x],'state' =>$c_state,'city'
     =>$c_city,'zone' =>$c_zone,'area' =>$c_area);
     $table_name = 'customer_address';
     $insertData = $functs->insertFn($table_name,$Insert_data);
  }

   $delete_where = array($id_type => $newCustomerId);
   $table_name='customer_reference_detail';
   $functs->deletefn($delete_where,$table_name);
 //Insert Reference Detail
   $ref_count  = count($c_ref_name);
   for($x = 0; $x <$ref_count; $x++)
  {
   $Insert_data = array($id_type => $newCustomerId,'name' => $c_ref_name[$x] ,'email' => $c_ref_email[$x],'mobile' =>$c_ref_mobile[$x],'address' =>$c_ref_add[$x]);
   $table_name='customer_reference_detail';
   $insertData = $functs->insertFn($table_name,$Insert_data);

  }

if($customer_status==1)
{

 if($ce_id=='PR')
 {
 }
 else
 {

	        $t=date('d-m-Y');
			$c_m=date("m",strtotime($t));
			$c_y=date("y",strtotime($t));
			$t_d = cal_days_in_month(CAL_GREGORIAN, $c_m, $c_y);
	$generateCustomerid = $functs->generateCustomerIdFn();
	$lastCustomerId = $generateCustomerid[0]["id"];
	preg_match("/(\D+)(\d+)/", $lastCustomerId,$Matches ); // Matches the PU and number
    $ProductCode = $Matches[1];
    $NewID = intval($Matches[2]);
	$NewID++;
    $BarcodeLength = 4;
    $CurrentLength = strlen($NewID);
    $MissingZeros = $BarcodeLength - $CurrentLength;
    for ($i=0; $i<$MissingZeros; $i++) $NewID = "0" . $NewID;
    $newCustomerId = $ProductCode . $NewID;


	rename ("../Documents/customer/$cus_id", "../Documents/customer/$newCustomerId");

	     $update_data = array('customer_id' => $newCustomerId,'customer_status' =>1,'enquiry_id' =>'0','month'=>$c_m,'year'=>$c_y );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='customer_general_detail';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'enquiry_id' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='kyc';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'enquiry_id' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='customer_address';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'enquiry_id' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='customer_contact';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'enquiry_id' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='customer_professional';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'enquiry_id' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='customer_reference_detail';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId,'customer_status' =>'0' );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='enquiries';
         $functs->updateTableFn($update_data,$where_con,$table_name);

		 $update_data = array('customer_id' => $newCustomerId );
		 $where_con = array('enquiry_id' =>$cus_id);
         $table_name='enquiry_products';
         $functs->updateTableFn($update_data,$where_con,$table_name);


 }
  header('Location: ../customer-view.php');
}
 else
 {
 header('Location: ../Noncustomer-view.php');
 }


?>
