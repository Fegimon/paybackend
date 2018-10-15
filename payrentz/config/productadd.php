<?php

 require_once('config.php');

 @$type = $_POST['type'];

 switch ($type) {

	case "checkserialnum":
			@$serialnum = $_POST['serialnum'];
			$checkserialnum = $functs->checkserialnum($serialnum);
			echo json_encode($checkserialnum);
			break;

	case "prdvariantlistdetails":
			@$productvar = $_POST['productvar'];
			$prdvariantlistdetails = $functs->prdvariantlistdetails($productvar);
			echo json_encode($prdvariantlistdetails);
			break;

	case "provariantlist":
			@$subcategoryproduct = $_POST['subcategoryproduct'];
			$addproductvariantgot = $functs->addproductvariantgot($subcategoryproduct);
			echo json_encode($addproductvariantgot);
			break;

	case "productview":
			@$id = $_POST['id'];
			$gotparticularproductview = $functs->gotparticularproductview($id);
			echo json_encode($gotparticularproductview);
			break;

	case "editproductview":
			@$id = $_POST['id'];
			$gotparticularproductedit = $functs->gotparticularproductedit($id);
			echo json_encode($gotparticularproductedit);
			break;

//transport Expenses

	case "trcustidgot":
			@$productid = $_POST['productid'];
			$trgetcustomerid = $functs->trgetcustomerid($productid);
			echo json_encode($trgetcustomerid);
			break;

//Service Request

	case "gotproductforser1":
			@$mobilenum = $_POST['mobilenum'];
			$gotprodtforcusts1 = $functs->gotprodtforcusts1($mobilenum);
			echo json_encode($gotprodtforcusts1);
			break;

	case "gotproductforser2":
			@$customerid = $_POST['customerid'];
			$gotprodtforcusts2 = $functs->gotprodtforcusts2($customerid);
			echo json_encode($gotprodtforcusts2);
			break;

	case "gotproductforser3":
			@$productid = $_POST['productid'];
			$gotprodtforcusts3 = $functs->gotprodtforcusts3($productid);
			echo json_encode($gotprodtforcusts3);
			break;

	case "serviceadd":
			@$serviceinitiativdate = $_POST['serviceinitiativdate'];
			@$serviceproductid = $_POST['serviceproductid'];
			@$serviceissue = $_POST['serviceissue'];
			@$serviceremarks = $_POST['serviceremarks'];
			@$servicecustid = $_POST['servicecustid'];

			$serviceadddetails = $functs->serviceadd($serviceinitiativdate,$serviceproductid,$serviceissue,$serviceremarks,$servicecustid);
			echo json_encode($serviceadddetails);
			break;

	case "employeelist":
			$employeelist = $functs->employeelist();
			echo json_encode($employeelist);
			break;


	case "serviceclose":
			@$serviced_by = $_POST['serviced_by'];
			@$serviceproductidclose = $_POST['serviceproductidclose'];
			@$service_amount = $_POST['service_amount'];
			@$servicefrom_date = $_POST['servicefrom_date'];
			@$serviceto_date = $_POST['serviceto_date'];

			@$iswaiver = $_POST['iswaiver'];
			@$servicewaiver_from_date = $_POST['servicewaiver_from_date'];
			@$waiver_to_date = $_POST['waiver_to_date'];
			@$customerfeetback = $_POST['customerfeetback'];
			@$ispaid = $_POST['ispaid'];

      if($iswaiver == 1)
      {
        $earlier = new DateTime($servicewaiver_from_date);
        $later = new DateTime($waiver_to_date);
        $mappedProduct = $functs->mappedProductRent($serviceproductidclose);
        $diff = $later->diff($earlier)->format("%a");
       $amt = $mappedProduct[0]["total"]/30;
       $extamt = ($diff+1) * $amt;
       $getcostomerDetail = $functs->fngetcostomerDetail($mappedProduct[0]["customer_id"]);
       $e_a    = $getcostomerDetail["extra_amount"];
       $amt = $e_a + $extamt;
       $update_data = array('extra_amount'=>$amt);
           $where_con = array( 'customer_id' => $mappedProduct[0]["customer_id"]);
           $table_name='customer_general_detail';
           $functs->updateTableFn($update_data,$where_con,$table_name);
       //print_r($e_a);
       //exit;
      }

			@$received_ammout = $_POST['received_ammout'];
			@$paymentmode = $_POST['paymentmode'];
			@$colected_on = $_POST['colected_on'];
			@$collectedby = $_POST['collectedby'];
			@$deposit_on = $_POST['deposit_on'];
			@$deposit_by = $_POST['deposit_by'];

			$serviceadddetails = $functs->serviceclose($serviced_by,$serviceproductidclose,$service_amount,$servicefrom_date,$serviceto_date,$iswaiver,$servicewaiver_from_date,$waiver_to_date,$customerfeetback,$ispaid,$received_ammout,$paymentmode,$colected_on,$collectedby,$deposit_on,$deposit_by);
			echo json_encode($serviceadddetails);
			break;

	// Advance Receipt
	case "advancerendreceipt":
			@$value = $_POST['value'];
			$getcustomername = $functs->getcustomername($value);
			echo json_encode($getcustomername);
			break;

	case "advancetotalamout":
			@$customerid = $_POST['customerid'];
			$totalamt = $functs->gettotalamountforad($customerid);
			echo json_encode($totalamt);
			break;

	// General Expense
	case "generalexpense":
			@$expensedate = $_POST['expensedate'];
			@$expenseid = $_POST['expenseid'];
			@$expenseproduct = $_POST['expenseproduct'];
			@$expensereason = $_POST['expensereason'];
			@$expenseamount = $_POST['expenseamount'];
			@$expenseperson = $_POST['expenseperson'];
			@$expensepay = $_POST['expensepay'];
			@$expense_remark = $_POST['expense_remark'];
			$genralex = $functs->generalexpense($expensedate,$expenseid,$expenseproduct,$expensereason,$expenseamount,$expenseperson,$expensepay,$expense_remark);
			echo json_encode($genralex);
			break;

	// Service Expense
	case "serviceexpance":
			@$service_product = $_POST['service_product'];
			@$warranty_service = $_POST['warranty_service'];
			@$issuetype = $_POST['issuetype'];
			@$service_amount = $_POST['service_amount'];
			@$service_remark = $_POST['service_remark'];
			@$servicestartfrom = $_POST['servicestartfrom'];
			@$serviceendto = $_POST['serviceendto'];
			@$serivceexpwaiver = $_POST['serivceexpwaiver'];
			$servceexp = $functs->serviceexpense($service_product,$warranty_service,$issuetype,$service_amount,$service_remark,$servicestartfrom,$serviceendto,$serivceexpwaiver);
			echo json_encode($servceexp);
			break;

	//Transport product by date
	case "trapdateprodct":
		@$odate = $_POST['odate'];
		$trapdateprodct = $functs->trapdateprodct($odate);
		echo json_encode($trapdateprodct);
		break;

    default:
			echo "Your favorite color is neither red, blue, nor green!";
}




?>
