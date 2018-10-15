<?php
  require_once('config.php');
  @$e_type = $_POST['e_type'];
  //Existing User
  if($e_type == 0)
  {
    //Get static Data
    @$e_cus_id = $_POST['e_cus_id'];
    @$e_date   = $_POST['e_date'];
    @$e_attend = $_POST['e_attend'];
    @$e_assign = $_POST['e_assign'];
    @$e_f_date = $_POST['e_f_date'];
    @$e_remark = $_POST['e_remark'];
    @$e_mode   = 0;
    //save enquiry data
    $generatedEnqiryId = $functs->generateEnqiryIdFn();
    //Dynamic Data
     @$e_var = $_POST['e_var'];
     @$e_quan = $_POST['e_quan'];
     @$e_delivery = $_POST['e_delivery'];
     @$e_rent = $_POST['e_rent'];
     @$e_tenure = $_POST['e_tenure'];
     @$e_rent_cost = $_POST['e_rent_cost'];
     @$e_security = $_POST['e_security'];
     @$e_pro_fee = $_POST['e_pro_fee'];
     @$e_ins_fee = $_POST['e_ins_fee'];
     $var_count =count($e_var);


     $t_s_amount =0 ;
     $t_p_amount =0 ;
     $t_i_amount =0 ;

     for ($x = 0; $x < $var_count; $x++)
     {
        //Get variant amount
        $getVariantAmount = $functs->getVariantAmountFn($e_var[$x]);
        $t_s_amount +=$e_security[$x]*$e_quan[$x];
        $t_p_amount += $e_pro_fee[$x]*$e_quan[$x];
        $t_i_amount += $e_ins_fee[$x]*$e_quan[$x];

        //save enquiry product
        $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => $e_cus_id,'ptdvar_id' => $e_var[$x],'quantity' => $e_quan[$x],'expecting_delivery_date' => $e_delivery[$x],'rent_per_month' => $e_rent_cost[$x],'security_deposit_amount' =>$e_security[$x] ,'rent_months_count' =>$e_rent[$x],'tenure' =>$e_tenure[$x],'processing_fee' => $e_pro_fee[$x],'ins_fee' =>$e_ins_fee[$x],
        'other_fee' => $getVariantAmount["other_fee"]);
        $storeBase = 'enquiry_products';
        $functs->insertFn($storeBase,$values);
      }

      $total_amount=$t_s_amount+$t_p_amount+$t_i_amount;
      $values = array('enquiry_id' => $generatedEnqiryId,'customer_status' => $e_type,'customer_id' => $e_cus_id,'enquiry_date' => $e_date,'attended_by' => $e_attend,'assigned_to' => $e_assign,'followup_date' => $e_f_date,'followup_remarks' => $e_remark,'mode' => $e_mode,
 'total_security_amount' =>$t_s_amount,'total_processing_fee' =>$t_p_amount,'t_installation_fee' =>$t_i_amount,'total_amount'=>$total_amount);
      $storeBase = 'enquiries';
      $functs->insertFn($storeBase,$values);
 }
 //New User
 else
 {
    @$e_date   = $_POST['e_date'];
    @$e_attend = $_POST['e_attend'];
    @$e_assign = $_POST['e_assign'];
    @$e_f_date = $_POST['e_f_date'];
    @$e_remark = $_POST['e_remark'];
    @$e_mode   =  $_POST['e_mode'];

    $generatedEnqiryId = $functs->generateEnqiryIdFn();

     $t_s_amount =0 ;
     $t_p_amount =0 ;
     $t_i_amount =0 ;
      //Dynamic Data
     @$e_var = $_POST['e_var'];
     @$e_quan = $_POST['e_quan'];
     @$e_delivery = $_POST['e_delivery'];
     @$e_rent = $_POST['e_rent'];
     @$e_tenure = $_POST['e_tenure'];
     @$e_rent_cost = $_POST['e_rent_cost'];
     @$e_security = $_POST['e_security'];
     @$e_pro_fee = $_POST['e_pro_fee'];
     @$e_ins_fee = $_POST['e_ins_fee'];
     $var_count =count($e_var);

     for ($x = 0; $x < $var_count; $x++)
     {
      //Get variant amount
      $getVariantAmount = $functs->getVariantAmountFn($e_var[$x]);
      $t_s_amount +=$e_security[$x]*$e_quan[$x];
      $t_p_amount += $e_pro_fee[$x]*$e_quan[$x];
      $t_i_amount += $e_ins_fee[$x]*$e_quan[$x];

      //save enquiry product
      $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => '0','ptdvar_id' => $e_var[$x],'quantity' => $e_quan[$x],'expecting_delivery_date' => $e_delivery[$x],'rent_per_month' => $e_rent_cost[$x],'security_deposit_amount' =>$e_security[$x] ,'rent_months_count' =>$e_rent[$x],'tenure' =>$e_tenure[$x],'processing_fee' => $e_pro_fee[$x],'ins_fee' =>$e_ins_fee[$x],'other_fee' => $getVariantAmount["other_fee"]);
      $storeBase = 'enquiry_products';
      $functs->insertFn($storeBase,$values);
     }
     $total_amount=$t_s_amount+$t_p_amount+$t_i_amount;
     $values = array('enquiry_id' => $generatedEnqiryId,'customer_status' => $e_type,'customer_id' =>'0','enquiry_date' => $e_date,'attended_by' => $e_attend,'assigned_to' => $e_assign,'followup_date' => $e_f_date,'followup_remarks' => $e_remark,'mode' => $e_mode,'total_security_amount' =>$t_s_amount,'total_processing_fee' =>$t_p_amount,'t_installation_fee' =>$t_i_amount,'total_amount'=>$total_amount);
     $storeBase = 'enquiries';
     $functs->insertFn($storeBase,$values);
     //new customer general detail
      @$e_cus_name = $_POST['e_cus_name'];
      @$c_state = $_POST['c_state'];
      @$c_city = $_POST['c_city'];
      @$c_zone = $_POST['c_zone'];
      @$c_area = $_POST['c_area'];
      @$e_cus_email = $_POST['e_cus_email'];
      @$e_customer_type = $_POST['e_customer_type'];
      @$c_gender = $_POST['c_gender'];



      $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => '0','customer_name' => $e_cus_name,'state_id' => $c_state,'city_id' => $c_city,'zone_id' => $c_zone,'area_id' => $c_area,'email' =>$e_cus_email ,'customer_type_id' =>$e_customer_type,'gender'=>$c_gender);
      $storeBase = 'customer_general_detail';
      $functs->insertFn($storeBase,$values);

      //Professional Detail
      @$e_com_name      = $_POST['e_com_name'];
      $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => '0','company_name' => $e_com_name);
      $storeBase = 'customer_professional';
      $functs->insertFn($storeBase,$values);

      //Mobile Number
      @$e_cus_phone = $_POST['e_cus_phone'];
      $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => '0','mobile' => $e_cus_phone,'type' => 'primary');
      $storeBase = 'customer_contact';
      $functs->insertFn($storeBase,$values);
      @$e_Address   =  $_POST['e_Address'];
      $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => '0','address' => $e_Address);
      $storeBase = 'customer_address';
      $functs->insertFn($storeBase,$values);

      $firstFolderName  =$generatedEnqiryId;



	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName, 0777, true);
    mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/image', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Others', 0777, true);
    mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Company Id', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Canceled Cheque', 0777,true);
    mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Id Proof', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Id Proof/Address Proof', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Others/Receipts', 0777, true);
	mkdir(dirname(__FILE__) . '/../Documents/customer/' . $firstFolderName.'/Others/Invoice', 0777, true);
   
 }

 header('Location: ../enquiry-view.php');
?>
