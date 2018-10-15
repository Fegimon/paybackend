<?php

class Functions extends DB{
public $query;


//To get the Customer Type

//getTaxPer
function getTaxPercenTax($id)
	{


		$query3="SELECT (ps.cgst+ps.sgst) as gst FROM `product` as p INNER JOIN product_variant as pv on pv.`ptdvar_id` = p.ptdvar_id INNER JOIN product_sub_category as ps on ps.pr_sub_id = pv.ptd_sub_catgry_id where p.product_id ='$id'";
	    $data3=$this->get_results( $query3 );
		return $data3;

	}
	
	
function getCustomerType()
{
$query1="SELECT id,name FROM `customer_type`";
$resultsArray = $this->get_results($query1);
return $resultsArray;
}

function truncat()
	{
		$delete = array();
		$deleted = $this->truncate1('tempbill_images');
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function randomPassword()
	{


		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789*$";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++)
			{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		    }
		return implode($pass); //turn the array into a string


	}

	function getAllUsers()
	{
		$query1="SELECT umailid,status FROM users WHERE role='1'";
		$resultsArray = $this->get_results( $query1 );
		return $resultsArray;
	}

	function fnCheckLogin($u,$p)
	{
		$query1="SELECT user_name,city FROM `admin_account` WHERE `user_name`='$u' and `password`='$p';";
		$resultsArray = $this->get_results( $query1 );
		return $resultsArray;
	}


	function sendUserDetailMail($mailid,$value)
	{
		$to = "somebody@example.com, somebodyelse@example.com";
		$subject = "HTML email";

		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<p> </p>
		<table>
		<tr>
		<th>UserName</th>
		<th>Password</th>
		</tr>
		<tr>
		<td>".$mailid."</td>
		<td>".$value."</td>
		</tr>
		</table>
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";

		mail($to,$subject,$message,$headers);
	}


	function getInvoiceListtotal()
	{


		  $query2="SELECT invoice.customer_id,invoice.received_total_rent_cost as recived,invoice.invoice_date,invoice.total_rent_cost,  customer_general_detail.pending_cost,customer_general_detail.extra_amount,lpc  FROM invoice INNER JOIN customer_general_detail ON invoice.customer_id=customer_general_detail.customer_id ";

		$invoicelist=$this->get_results_dt( $query2 );
		return $invoicelist;
	}

	function getInvoiceList()
	{


		  $query2="SELECT invoice.customer_id,invoice.received_total_rent_cost as recived,invoice.invoice_date,invoice.total_rent_cost, invoice.pending_rent_cost as total,invoice.invoice_mail_status,invoice.invoice_sms_status, invoice.pending_security_amount, customer_general_detail.customer_name,customer_general_detail.pending_cost,customer_general_detail.extra_amount, invoice.tax,invoice.Late_Payment_Charge,lpc  FROM invoice INNER JOIN customer_general_detail ON invoice.customer_id=customer_general_detail.customer_id ORDER BY invoice.id DESC";

		$invoicelist=$this->get_results_dt( $query2 );
		return $invoicelist;
	}

	function pendingListFn()
	{
		  $query2="SELECT invoice.customer_id,invoice.received_total_rent_cost as recived,invoice.total_rent_cost, invoice.invoice_date,ROUND(invoice.total_rent_cost,0), ROUND(invoice.pending_rent_cost,0) as total,invoice.invoice_mail_status,invoice.invoice_sms_status, invoice.pending_security_amount, customer_general_detail.customer_name,customer_general_detail.pending_cost,customer_general_detail.extra_amount, invoice.tax,invoice.Late_Payment_Charge,customer_general_detail.lpc as lpc  FROM invoice INNER JOIN customer_general_detail ON invoice.customer_id=customer_general_detail.customer_id ORDER BY invoice.id DESC";

		$invoicelist=$this->get_results_dp( $query2 );
		return $invoicelist;
	}


	//customer Table
	function getCustomerList($c)
	{
		$query2="SELECT b.customer_id,GROUP_CONCAT(mobile) mobile,customer_name,email,extra_amount,customer_status,pending_cost FROM `customer_general_detail` as a inner join customer_contact as b on a.customer_id = b.customer_id WHERE `city_id`='$c' and customer_status='1' and remove_type='0' GROUP BY b.customer_id";
		$status = 1;
		$invoicelist=$this->get_results_dt_customer( $query2,$status );
		return $invoicelist;
	}

	//customer Table
	function getcloCustomerList($c)
	{
		$query2="SELECT customer_id,customer_name,email,extra_amount,customer_status,pending_cost,closed_on FROM `customer_general_detail` WHERE `city_id`='$c' and customer_status='1' and remove_type='1' ";
		$status = 1;
		$invoicelist=$this->get_results_dt_clo_customer( $query2,$status );
		return $invoicelist;
	}

	//mapped Table

	function getMappedListFn($c)
	{
		$query2="SELECT m.id, m.enquiry_id, m.customer_id,mobile, `product_id`, `delivery_status`, `delivery_date`, `installation_date`, `rent_on_date`, `return_date`, `is_returned`, `return_remark`, `delivered_by`, `delivered_at`, `rent_per_month`, `rent_cost`, `tax`, `received_total_rent_cost`, `pending_rent_amount`, `actual_security_deposit_amount`, `actual_processing_fee`, `actual_installation_fee`, `actual_other_fee`, `reiceved_total_security_deposit_amount`, `reiceved_total_processing_fee`, `reiceved_total_installation_fee`, `reiceved_total_other_fee`, `enq_product_pending_amount`, `is_closure`, DATE_FORMAT(return_date, '%d/%m/%Y') as `closure_date`, `service_status`, `invoice_status`, `mapped_status`, `refund_status`, `refund_amount`, `pending_minus`, `refund_remark`, `removed_status`, `closure_remark`, m.month,        m.year, `c_month`, `c_year`, `r_month`, `r_year`, `re_month`, `re_year`,pending_cost  FROM `mapping_table` as m inner join customer_general_detail as c on c.customer_id =   m.customer_id inner join customer_contact cc on m.customer_id = cc.customer_id  where is_closure=1 and refund_status=0 group by product_id ORDER by return_date desc";
		$status = 1;
		$invoicelist=$this->get_mapped_list( $query2,$status );
		return $invoicelist;
	}

function getMappedListFnR($c)
	{
		$query2="SELECT m.id, m.enquiry_id, m.customer_id,mobile , `product_id`, `delivery_status`, `delivery_date`, `installation_date`, `rent_on_date`, `return_date`, `is_returned`, `return_remark`, `delivered_by`, `delivered_at`, `rent_per_month`, `rent_cost`, `tax`, `received_total_rent_cost`, `pending_rent_amount`, `actual_security_deposit_amount`, `actual_processing_fee`, `actual_installation_fee`, `actual_other_fee`, `reiceved_total_security_deposit_amount`, `reiceved_total_processing_fee`, `reiceved_total_installation_fee`, `reiceved_total_other_fee`, `enq_product_pending_amount`, `is_closure`, DATE_FORMAT(return_date, '%d/%m/%Y') as `closure_date`, `service_status`, `invoice_status`, `mapped_status`, `refund_status`, `refund_amount`, `pending_minus`, `refund_remark`, `removed_status`, `closure_remark`, m.month,        m.year, `c_month`, `c_year`, `r_month`, `r_year`, `re_month`, `re_year`,pending_cost  FROM `mapping_table` as m inner join customer_general_detail as c on c.customer_id =   m.customer_id  inner join customer_contact cc on m.customer_id = cc.customer_id  where is_closure=1 and refund_status=1 group by product_id  ORDER by return_date desc";
		$status = 1;
		$invoicelist=$this->get_mapped_list( $query2,$status );
		return $invoicelist;
	}
		function mapvalid($c)
	{
		$query2="SELECT customer_id FROM `enquiries` WHERE `customer_id`='$c' and is_closed=0";

		$invoicelist=$this->get_results($query2);
		return $invoicelist;
	}

		function amountRecivedCheck($c)
	{
		$query2="SELECT  `amount_received_from_customer` FROM `enquiries` WHERE enquiry_id='$c'";
		$invoicelist=$this->get_results($query2);
		return $invoicelist [0]['amount_received_from_customer'];
	}
	function mapd($c)
	{
		$query2="SELECT customer_id FROM `mapping_table` WHERE `customer_id`='$c' and is_closure=0";

		$invoicelist=$this->get_results($query2);
		return $invoicelist;
	}


	//customer Table
	function getNonCustomerList($c)
	{
		$query2="SELECT b.customer_id,b.enquiry_id,GROUP_CONCAT(mobile) mobile,customer_name,email,extra_amount,customer_status,pending_cost FROM `customer_general_detail` as a inner join customer_contact as b on a.enquiry_id = b.enquiry_id WHERE `city_id`='$c' and customer_status='0' and remove_type='0' GROUP BY b.enquiry_id";
		$status = 0;
		$invoicelist=$this->get_results_dt_customer( $query2,$status );
		return $invoicelist;
	}

	//customer general Data

	function particularCusGenDetailFn($c_id,$c_status)
	{

	if($c_status ==1)
      {
	    $query2="SELECT   `customer_type_id`, `customer_name`, `email`, `age`, `dob`, `nativity`, `gender`, `marital_status`, `residential_status`, `payment_status`, `kyc_status`, `prepared_by`, `prepared_at`, `kyc_verified_by`, `kyc_verified_at`, `done_by`, `done_at`, `referal_bonus`, `extra_amount`, `state_id`, `city_id`, `zone_id`, `area_id`,remark,pincode,floor,pending_cost FROM `customer_general_detail` WHERE   customer_status='1' and customer_id='$c_id'";
      }
	  else
	  {
		 $query2="SELECT   `customer_type_id`, `customer_name`, `email`, `age`, `dob`,`nativity`, `gender`, `marital_status`, `residential_status`, `payment_status`, `kyc_status`, `prepared_by`, `prepared_at`, `kyc_verified_by`, `kyc_verified_at`, `done_by`, `done_at`, `referal_bonus`, `extra_amount`, `state_id`, `city_id`, `zone_id`, `area_id`,remark,pincode,floor,pending_cost FROM `customer_general_detail` WHERE   customer_status='0' and enquiry_id= '$c_id'";
	  }
		$genData=$this->get_results($query2);
		return $genData;
	}

	function particularCusProDetailFn($c_id,$c_status)
	{

	if($c_status ==1)
      {
	    $query2="SELECT   `company_name`, `company_address`, `designation`, `department`, `email`, `alternative_email` FROM `customer_professional` WHERE customer_id='$c_id'";
      }
	  else
	  {
		  $query2="SELECT   `company_name`, `company_address`, `designation`, `department`, `email`, `alternative_email` FROM `customer_professional` WHERE enquiry_id='$c_id'";
	  }
		$proData=$this->get_results($query2);

		return $proData;
	}

	function particularCusConDetailFn($c_id,$c_status)
	{

	if($c_status ==1)
      {
	    $query2="SELECT  `mobile`, `type` FROM `customer_contact`  WHERE customer_id='$c_id'";
      }
	  else
	  {
		  $query2="SELECT `mobile`, `type` FROM `customer_contact` WHERE
		  enquiry_id='$c_id'";
	  }
		$conData=$this->get_results($query2);

		return $conData;
	}

	function particularCusRefDetailFn($c_id,$c_status)
	{

	if($c_status ==1)
      {
	    $query2="SELECT `name`, `email`, `mobile`, `address` FROM `customer_reference_detail` WHERE  customer_id='$c_id'";
      }
	  else
	  {
		  $query2="SELECT  `name`, `email`, `mobile`, `address` FROM `customer_reference_detail` WHERE
		  enquiry_id='$c_id'";
	  }
		$conData=$this->get_results($query2);

		return $conData;
	}

	function particularCusKycDetailFn($c_id,$c_status)
	{

	  if($c_status ==1)
      {
	    $query2="SELECT  `path`, `proof_type`, `remarks` FROM `kyc` WHERE
		  customer_id='$c_id'";
      }
	  else
	  {
		  $query2="SELECT  `path`, `proof_type`, `remarks` FROM `kyc` WHERE
		  enquiry_id='$c_id'";
	  }
		$conData=$this->get_results($query2);
		return $conData;
	}

		function particularCusAddDetailFn($c_id,$c_status)
	{

	  if($c_status ==1)
      {
	    $query2="SELECT  `type`, `state`, `city`, `address`, `zone`, `area` FROM `customer_address` WHERE  customer_id='$c_id'";
      }
	  else
	  {
		  $query2="SELECT  `type`, `state`, `city`, `address`, `zone`, `area` FROM `customer_address` WHERE enquiry_id='$c_id'";
	  }
		$conData=$this->get_results($query2);
		return $conData;
	}


		function updateTableFn($update_data,$where_con,$table_name)
	   {




				$updated = $this->update($table_name,$update_data,$where_con);
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}


	   }


	function generateInvoiceThisMonthExEnq()
	{

		$closure_status = 0;
		$invoice_status = 0;
		$service_status = 0;




				$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.12','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status,
					 'LEFT(product_id , 2 )' => 'CY'
				);


				$updated = $this->update_column('mapping_table', $update, $where_clause);




				$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.28','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status,
					'LEFT(product_id , 2 )' => 'AC'
				);


				$updated = $this->update_column('mapping_table', $update, $where_clause);

				$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.28','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status,
					 'LEFT(product_id , 2 )' => 'TV'
				);


				//$updated = $this->update_column('mapping_table', $update, $where_clause);

				//$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.28','invoice_status' //=>'1');
				//Add the WHERE clauses
				//$where_clause = array(
				//	'is_closure'     => $closure_status,
				//	'invoice_status' => $invoice_status,
				//	 'LEFT(product_id , 2 )' => 'PR'
				//);


				$updated = $this->update_column('mapping_table', $update, $where_clause);

				$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.05','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status,
					 'LEFT(product_id , 2 )' => 'BE'
				);


				$updated = $this->update_column('mapping_table', $update, $where_clause);

				$update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.05','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status,
					 'LEFT(product_id , 2 )' => 'WD'
				);


				$updated = $this->update_column('mapping_table', $update, $where_clause);
				//
				// $update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.18','invoice_status' =>'1');
				// //Add the WHERE clauses
				// $where_clause = array(
				// 	'is_closure'     => $closure_status,
				// 	'invoice_status' => $invoice_status,
				// 	 'LEFT(product_id , 2 )' => 'TU'
				// );
				//
				//
				// $updated = $this->update_column('mapping_table', $update, $where_clause);
				//
				// $update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.18','invoice_status' =>'1');
				// //Add the WHERE clauses
				// $where_clause = array(
				// 	'is_closure'     => $closure_status,
				// 	'invoice_status' => $invoice_status,
				// 	 'LEFT(product_id , 2 )' => 'MT'
				// );
				//
				//
				// $updated = $this->update_column('mapping_table', $update, $where_clause);
				//
				// $update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.18','invoice_status' =>'1');
				// //Add the WHERE clauses
				// $where_clause = array(
				// 	'is_closure'     => $closure_status,
				// 	'invoice_status' => $invoice_status,
				// 	 'LEFT(product_id , 2 )' => 'WC'
				// );
				//
        //                         $updated = $this->update_column('mapping_table', $update, $where_clause);
				//
				// $update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.18','invoice_status' =>'1');
				// //Add the WHERE clauses
				// $where_clause = array(
				// 	'is_closure'     => $closure_status,
				// 	'invoice_status' => $invoice_status,
				// 	 'LEFT(product_id , 2 )' => 'EB'
				// );


				$updated = $this->update_column('mapping_table', $update, $where_clause);

				 $update = array('rent_cost' => 'rent_per_month','tax'=>'rent_per_month * 0.18','invoice_status' =>'1');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status,
					'invoice_status' => $invoice_status
				);
				$updated = $this->update_column('mapping_table', $update, $where_clause);


				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}


	   }

	function  updateNewInvoice ($r,$id,$tax)
	{



		$update = array('rent_cost' => $r,'tax'=>$tax,'invoice_status' => '1');
				//Add the WHERE clauses
				$where_clause = array(
					'id'=> $id,
					'invoice_status' => '0'
				);
				$updated = $this->update('mapping_table', $update, $where_clause);
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}

	}

		function  fnconfrimMailStatus ($id,$tax,$n)
	{

	   print_r($n);

		$update = array('invoice_mail_status' => '1','tax'=>$tax,'pending_rent_cost'=>$n);


				//Add the WHERE clauses
				$where_clause = array(
					'customer_id'=> $id
				);
				$updated = $this->update('invoice', $update, $where_clause);
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}

	}
			function  smsStatus ($id)
	{



		$update = array('invoice_sms_status' => '1');

		print_r($n);
				//Add the WHERE clauses
				$where_clause = array(
					'customer_id'=> $id
				);
				$updated = $this->update('invoice', $update, $where_clause);
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}

	}



	function generateInvoiceThisMonthNewEnq()
	{

		$query2="SELECT * FROM mapping_table where invoice_status=0 and is_closure=0 and rent_on_date <> ''";
		$categorylist=$this->get_results_map( $query2 );
		return $categorylist;

	}

	function verifiedDataMapFn($id)
	{

		$query2="SELECT * FROM mapping_table where enquiry_id='$id'";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;

	}

	function getMappedDataFn($id)
	{

		$query2="SELECT
    o.product_id,
    o.customer_id,
    o.delivery_date,
    o.installation_date,
    o.rent_on_date,
    o.return_date,
    o.is_returned,
    o.delivered_by,
    o.delivered_at,
   ( CASE WHEN (YEAR(o.delivery_date) <> YEAR(CURRENT_DATE()) OR MONTH(o.delivery_date) <> MONTH(CURRENT_DATE())) THEN ROUND(
        (
            ((c.CGST + c.SGST) / 100) * o.rent_per_month
        ) + o.rent_per_month
    ,2)
    ELSE ROUND(
        (
            ((c.CGST + c.SGST) / 100) *  (o.rent_per_month / DAY(LAST_DAY(CURRENT_DATE()))) * (DAY (CURRENT_DATE())-DAY(o.delivery_date))
        ) + (o.rent_per_month / DAY(LAST_DAY(CURRENT_DATE()))) * (DAY (CURRENT_DATE())-DAY(o.delivery_date))
    ,2)
    END) AS rent_per_month,
		( CASE WHEN (YEAR(o.delivery_date) <> YEAR(CURRENT_DATE()) OR MONTH(o.delivery_date) <> MONTH(CURRENT_DATE())) THEN ROUND(
         (
             ((c.CGST + c.SGST) / 100) * o.rent_per_month
         ) + o.rent_per_month
     ,2)
     ELSE ROUND(
         (
             ((c.CGST + c.SGST) / 100) *  (o.rent_per_month / DAY(LAST_DAY(CURRENT_DATE()))) * (DAY (CURRENT_DATE())-DAY(o.delivery_date))
         ) + (o.rent_per_month / DAY(LAST_DAY(CURRENT_DATE()))) * (DAY (CURRENT_DATE())-DAY(o.delivery_date))
     ,2)
     END) AS rent_cost,
		(o.rent_per_month+o.tax) as rent_per_month ,
    o.received_total_rent_cost,
    o.actual_security_deposit_amount,
    o.actual_processing_fee,
    o.actual_installation_fee,
    o.actual_other_fee,
    o.service_status,
    o.mapped_status,
    o.is_closure,
    o.closure_date,
    o.refund_status,
    o.removed_status,
    o.refund_amount,
    o.pending_minus,
    r.name,
    c.pr_sub_name
FROM
    mapping_table o
LEFT OUTER JOIN product j ON
    o.product_id = j.product_id
LEFT OUTER JOIN product_variant r ON
    j.ptdvar_id = r.ptdvar_id
LEFT OUTER JOIN product_sub_category c ON
    r.ptd_sub_catgry_id = c.pr_sub_id
where o.customer_id='$id'";
$categorylist=$this->get_results( $query2 );
return $categorylist;

	}





	function fngetcostomerDetail ($id)
	{


		$query3="SELECT customer_name,email,extra_amount,pending_cost,gender,lpc FROM customer_general_detail where customer_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}

		function fngettempcostomerDetail ($id)
	{


		$query3="SELECT customer_name,email,extra_amount,pending_cost,gender,lpc FROM customer_general_detail where enquiry_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}
		function in_vo_list($id)
	{


		$query3="SELECT total_rent_cost,tax,received_total_rent_cost FROM invoice where customer_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}




	function fngetcostomerAddress ($id)
	{


		$query3="SELECT address FROM customer_address where customer_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}

	function fngettempcostomerAddress ($id)
	{


		$query3="SELECT address FROM customer_address where enquiry_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}

	function fnGetGeneralInvoiceDetail ($id)
	{


		$query3="SELECT * FROM invoice where customer_id= '$id'";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}

	function fngetContact($id)
	{


		$query3="SELECT mobile FROM customer_contact where customer_id= '$id' GROUP BY customer_id";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}

	function fngettempContact($id)
	{


		$query3="SELECT mobile FROM customer_contact where enquiry_id= '$id' GROUP BY customer_id";
	    $data3=$this->get_results( $query3 );

		return $data3[0];

	}



	function fngetGeneralMappingDetail($id)
	{


		$query3="SELECT name,product_variant.description as des,count(name) as c,mapping_table.rent_cost as r_c,sum(mapping_table.rent_cost) as t_c,psc.CGST as cgst,psc.SGST as sgst FROM mapping_table JOIN product ON mapping_table.product_id=product.product_id JOIN product_variant ON product.ptdvar_id=product_variant.ptdvar_id JOIN product_sub_category as psc ON product_variant.ptd_sub_catgry_id=psc.pr_sub_id where mapping_table.customer_id='$id' and mapping_table.`rent_per_month` =mapping_table.`rent_cost` GROUP BY product_variant.ptdvar_id";
	    $data3=$this->get_results_invoice_pdf( $query3 );

		return $data3;

	}
	function fngetGeneralMappingDetailc ($id)
	{


		$query3="SELECT name,product_variant.description as des,mapping_table.rent_cost as r_c,mapping_table.rent_on_date as rod,psc.CGST as cgst,psc.SGST as sgst FROM mapping_table JOIN product ON mapping_table.product_id=product.product_id JOIN product_variant ON product.ptdvar_id=product_variant.ptdvar_id JOIN product_sub_category as psc ON product_variant.ptd_sub_catgry_id=psc.pr_sub_id   where mapping_table.customer_id='$id' and mapping_table.`rent_per_month` <> mapping_table.`rent_cost`";
		$data3=$this->get_results_invoice_pdf( $query3 );

		return $data3;

	}



	function invoiceCheckList()
	{
		$query2="SELECT MAX(id) as id FROM month_invoice;";
		$data=$this->get_results( $query2 );
		$a= $data[0]["id"];
		$query3="SELECT month FROM month_invoice where id= $a";
	    $data3=$this->get_results( $query3 );
		return $data3[0]["month"];

	}



	function invoiceGenrateAll()
	{
		$query3="SELECT customer_id, SUM(rent_cost) as total_rent_cost,SUM(pending_rent_amount) as pending_rent_cost ,SUM(enq_product_pending_amount) as pending_security_amount,sum(tax) as tax FROM mapping_table where invoice_status=1 and is_closure=0 GROUP BY customer_id";
	    $data3=$this->get_results_inall($query3);
		return $data3;

	}




	function generateInvoiceList()
	{
		$query2="SELECT * FROM mapping_table where invoice_status=0";
		$categorylist=$this->get_results_map( $query2 );
		return $categorylist;

	}




     //customer_select_box_list



	function getsubcategorylists($id_category)
    {
        $query2="SELECT * FROM subcategories where status=1 and  cid=$id_category order by priority asc";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;
    }

	function getUserDetailsByMail($mailid)
	{
		$query3="SELECT * FROM users where umailid='$mailid' limit 1";
		$userdetail=$this->get_results( $query3 );
		return $userdetail;
	}

	function submitQuiz($vals,$userid)
    {
		foreach( $vals as $key => $value )
		{
			$vals[$key] = $this->filter( $value );
		}
		$totalquestions=$vals['totalquestion'];
		if(isset($totalquestions))
		{
		for($i=1;$i<=$totalquestions;$i++)
		{
			$questionvar="answerquestion".$i;
			if($vals["$questionvar"]!="")
			{
					$query="";
			}
		}
		return $vals;
		}
	}

	function getUserResultsCategory($userid,$catid)
	{
		$query5="SELECT * FROM user_results WHERE usid='$userid' and catid='$catid' limit 1";
		if( $this->num_rows( $query5 ) > 0 )
		{
			$row = $this->get_row( $query5 );
			return $row;
		}
		return false;
	}

	/*Newly added Function October 11*/
	function productAddFunction($catid,$subcatid,$prodname,$proddesc,$childcat)
	{

	    $insertproducts = array( 'catid' => $catid, 'subcatid' =>$subcatid, 'productname' =>$prodname, 'productdescription' =>$proddesc,
			'addedon' =>date("Y-m-d H:i:s"),'status'=>0,'childcategory'=>$childcat);
		$add_query = $this->insert( 'products', $insertproducts );
                $id= $this->lastid();
                $update = array('priority' => $id,
                );
                //Add the WHERE clausessubcatid
                $where_clause = array(
                        'id' => $id
                );
                $updated = $this->update( 'products', $update, $where_clause, 1 );

		if( $updated )
		{
			return $id;
		}
		else
		{
			return false;
		}

	}
	function uploadImageName($catid,$subcatid,$pid,$imagename)
	{

		$insertimagenames = array( 'catid' => $catid, 'subcatid' =>$subcatid, 'pid' =>$pid, 'imagename' =>$imagename);
		$add_query = $this->insert( 'productimages', $insertimagenames );
		if( $add_query )
		{
			return true;
		}

	}

	function getSubCategoryName($catid,$subcatid)
	{
		$query2="SELECT subcatname FROM subcategories where cid=$catid and subcatid= $subcatid limit 1 ";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;
	}

	function getCategorySubcategoryLists($catid)
	{
		$query2="SELECT subcatid,subcatname FROM subcategories where cid=$catid and status=1";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;
	}

	function getAllSubcategorylistByCatid($catid)
	{
		$query2="SELECT subcatid,subcatname FROM subcategories where cid=$catid";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;

	}

	function getSubCategoryDetails($catid,$subcatid)
	{
		$query2="SELECT * FROM subcategories where cid=$catid and subcatid= $subcatid";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;
	}

	function getCategoryName($catid)
	{
		$query2="SELECT catname FROM categories where cid=$catid limit 1";
		$categorylist=$this->get_results( $query2 );
		return $categorylist;
	}

	function getProductDeatils($catid,$subcatid)
	{
		$query3="select products.* from products where products.catid=$catid and products.subcatid=$subcatid and products.status=1 order by priority asc ";
		$productlist=$this->get_results( $query3 );
		return $productlist;

	}

	function getJobDetailsById($jobid)
	{
		$jobid=$this->filter( $jobid );
		$query4="SELECT * FROM careers where id=$jobid limit 1";
		$categorylist=$this->get_results( $query4 );
		return $categorylist;

	}

	function getNewsDetailsById($newsid)
	{
		$newsid=$this->filter( $newsid );
		$query5="SELECT * FROM newslist where id=$newsid limit 1";
		if( $this->num_rows( $query5 ) > 0 )
		{
			$categorylist=$this->get_results( $query5 );
			return $categorylist;
		}
		else
		return false;

	}

	function checkValidMailId($mailid)
	{
		if (filter_var($mailid, FILTER_VALIDATE_EMAIL) === false)
		{
			return false;
		}
		else
			return true;
	}

	function checkAlreadySubscribed($mailid)
	{
		$mailid=$this->filter( $mailid );
		$query6="SELECT * FROM subscribers where submailid='$mailid' limit 1";
		if( $this->num_rows( $query6 ) > 0 )
			return true;
		else
			return false;
	}

	function insertSubscriber($mailid)
	{
		$mailid=$this->filter( $mailid );
		$insertimagenames = array( 'submailid' => $mailid,'addedon' => date("Y-m-d H:i:s"), 'status' =>1);
		$add_query1 = $this->insert( 'subscribers', $insertimagenames );
		if( $add_query1 )
		{
			return true;
		}
		else
			return false;
	}

	function getProductDetailsById($productid)
	{
		$productid=$this->filter( $productid );
		$query7="SELECT * FROM products where id='$productid' limit 1";

		if( $this->num_rows( $query7 ) > 0 )
		{
			$productlist=$this->get_results( $query7 );
			return $productlist;
		}
		else
			return false;
	}

	function getpdf($product_name)
	{
		$productid=$this->filter( $productid );
		$query7="SELECT * FROM brouchers where product_name='$product_name' order by id desc limit 1";

		if( $this->num_rows( $query7 ) > 0 )
		{
			$productlist=$this->get_results( $query7 );
			return $productlist;
		}
		else
			return false;
	}

	function getProductImages($productid)
	{
		$productid=$this->filter( $productid );
		$query8="SELECT imagename FROM productimages where pid='$productid'";
		if( $this->num_rows( $query8 ) > 0 )
		{
			$productimagelist=$this->get_results( $query8 );
			return $productimagelist;
		}
		else
			return false;
	}

	function getNewsDetailsArray()
	{
		$query9="SELECT * FROM newslist where status=1";
		$newslist=$this->get_results( $query9 );
		return $newslist;
	}




	function getSubCategoryList($cid)
	{
		$cid=$this->filter( $cid );
		$query11="SELECT * FROM subcategories where cid='$cid'";

		if( $this->num_rows( $query11 ) > 0 )
		{

			$subcategorylist=$this->get_results( $query11 );
			return $subcategorylist;
		}
		else
			return false;
	}

	function getProductsByCid($catid)
	{
		$catid=$this->filter( $catid );
		$query12="select products.* from products where products.catid=$catid  and products.status=1 ";
		if( $this->num_rows( $query12 ) > 0 )
		{
			$productlist=$this->get_results( $query12 );
			return $productlist;
		}
		return false;
	}

	function deletefn($delete,$table)
	{

		$deleted = $this->delete( $table,$delete);
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function deleteSubCategory($id)
	{
		$delete = array('subcatid' => $id);
		$deleted = $this->delete( 'subcategories', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function deleteProducts($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'products', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function deleteProductsImages($id)
	{
		$delete = array('pid' => $id);
		$deleted = $this->delete( 'productimages', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function deleteNewsById($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'newslist', $delete, 1 );
		if($deleted)
		{
			return true;
		}
		return false;
	}

	function deleteJobsById($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'careers', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function deleteStaffById($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'staffs', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function deleteSubscriberById($id)
	{
		$delete = array('subscriberid' => $id);
		$deleted = $this->delete( 'subscribers', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function deleteSoftwareById($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'softwares', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function deleteBroucherById($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'brouchers', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function checkSoftwareExists($name)
	{
		$check_column = 'softwarename';
		$check_for = array( 'softwarename' => $name );
		$exists = $this->exists( 'softwares', $check_column,  $check_for );
		if( $exists )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function addSoftware($name)
	{
		$names = array('softwarename' => $name,'status'  =>0);
		$add_query = $this->insert( 'softwares', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}
	function searchProduct($productname)
	{
		$productname=$this->filter( $productname );
		$query = "SELECT id, productname FROM products WHERE productname LIKE '%$productname%' or productdescription LIKE '%$productname%' ";
		if( $this->num_rows( $query ) > 0 )
		{
			$productlist=$this->get_results( $query );
			return $productlist;
		}
		else
		{
			return false;
		}
	}
	function checkBroucherExists($name)
	{
		$check_column = 'brouchername';
		$check_for = array( 'brouchername' => $name );
		$exists = $this->exists( 'brouchers', $check_column,  $check_for );
		if( $exists )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function addBroucher($name,$product_id)
	{
		$names = array('brouchername' => $name,'status'  =>0,'product_name'=>$product_id);
		$add_query = $this->insert( 'brouchers', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}
	function getProductImageById($pid)
	{
		$pid=$this->filter( $pid );
		$query20="SELECT imagename FROM productimages where pid='$pid' limit 1";
		if( $this->num_rows( $query20 ) > 0 )
		{
			$productimage=$this->get_results( $query20 );
			return $productimage;
		}
		else
			return false;
	}

	function sendSubscriberNewsletter( $to, $title,$message)
	{

		$subject = $title;
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <admin@nanotec.com>' . "\r\n";

		if(mail($to,$subject,$message,$headers))
			return true;
		else
			return false;

	}
	function checkClientExists($name)
	{
		$check_column = 'clientname';
		$check_for = array( 'clientname' => $name );
		$exists = $this->exists( 'clients', $check_column,  $check_for );
		if( $exists )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function addClient($name,$imgname)
	{
		$names = array('clientname' => $name,'clientimage'=>$imgname,'status'  =>0);
		$add_query = $this->insert( 'clients', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}
	function deleteClientById($id)
	{
		$delete = array('clientid' => $id);
		$deleted = $this->delete( 'clients', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function getDetailsClientById($id)
	{
		$id=$this->filter( $id );
		$query22="SELECT * FROM clients where clientid='$id' limit 1";
		if( $this->num_rows( $query22 ) > 0 )
		{
			$clientdetails=$this->get_results( $query22 );
			return $clientdetails;
		}
		else
			return false;
	}
	function updateClient($clientid,$clientname,$imagename)
	{
		if($clientid!="" && $clientname!="" && $imagename!="")
		{
		$update = array('clientname' => $clientname,'clientimage'=>$imagename);
				//Add the WHERE clauses
				$where_clause = array(
					'clientid' => $clientid
				);
				$updated = $this->update( 'clients', $update, $where_clause, 1 );
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}
		}
		else
			return false;
	}
	function getAllClientList()
	{
		$query23="SELECT * FROM clients order by clientid asc";
		if( $this->num_rows( $query23 ) > 0 )
		{
			$clientdetailsArray=$this->get_results( $query23 );
			return $clientdetailsArray;
		}
		else
			return false;
	}
	function getAllClientWidgetList()
	{
		$query24="SELECT * FROM clients  where status =1 order by clientid asc";
		if( $this->num_rows( $query24 ) > 0 )
		{
			$clientdetailsArray=$this->get_results( $query24 );
			return $clientdetailsArray;
		}
		else
			return false;
	}

	//customer_select option

	function getNativity()
	{
		$query10="SELECT * FROM `nativity`";
		$nativity=$this->get_results( $query10 );
		return $nativity;
	}

	function getState()
	{
		$query10="SELECT * FROM `states`";
		$states=$this->get_results( $query10 );
		return $states;
	}

	function getCity($state_id)
	{

		$query10="SELECT * FROM `cities` where state_id='$state_id'";
		$city=$this->get_results( $query10 );
		return $city;
	}

	function getZone($city_id)
	{

		$query10="SELECT * FROM `zone` where city_id='$city_id'";
		$zone=$this->get_results( $query10 );
		return $zone;
	}
	function getArea($zone_id)
	{

		$query10="SELECT * FROM `area` where zone_id='$zone_id'";
		$area=$this->get_results( $query10 );
		return $area;
	}

	function getCheckList($value,$type)
	{
	    if($type==='mobile')
		{
	    $query10="SELECT * FROM `customer_contact` WHERE `mobile`='$value'";
		}
		if($type==='email')
		{
		$query10="SELECT * FROM `customer_general_detail` WHERE email LIKE '$value'";
		}
		$checked_data=$this->get_results( $query10 );
		return $checked_data;

	}

	function generateCustomerIdFn()
	{

		$query10="SELECT Max(Customer_id) as id FROM customer_general_detail ";
		$customerId=$this->get_results( $query10 );
		return $customerId;
	}

	function insertFn ($table_name,$Insert_data)
	{



		$add_query = $this->insert( $table_name, $Insert_data );
		$variantid= $this->lastid();
		if( $add_query )
		{
			return $variantid;
		}
		else
			return $variantid;
	}

	 function enquiryGetCustomerFn ($value,$i_type)
   {
	  if($i_type =='c_id')
	  {
	    $query10="SELECT customer_name,customer_id FROM `customer_general_detail` WHERE  customer_id='$value' ";
		$customer_name = $this->get_results($query10);
		if(count($customer_name)>0)
		{
	     $c_name =$customer_name;
		}
		else
		{
		 $c_name = "Invalid_c";
		}
		return $c_name;
	  }
	  if($i_type =='mobile')
	  {
	    $query10="SELECT customer_name,t1.customer_id FROM customer_general_detail as t1 INNER JOIN customer_contact as t2 ON t1.`customer_id` = t2.`customer_id` where  t2.mobile LIKE '%$value%' and customer_status = '1' and remove_type='0'";
		$customer_name = $this->get_results($query10);
		if(count($customer_name)>0)
		{
	     $c_name =$customer_name;
		}
		else
		{
		 $c_name = "Invalid_m";
		}
		return $c_name;

	  }

    }
    function  Enqexitfn ($cid)
	{

	    $query10="SELECT  `enquiry_id` FROM `enquiries` WHERE `customer_id`='$cid'";
		$customer_name = $this->get_results($query10);
		if(count($customer_name)>0)
		{
	     $c_name =$customer_name[0]["enquiry_id"];
		}
		else
		{
		 $c_name = "no";
		}
		return $c_name;



	}


   function enquiryProductCategory ()
   {
	   $query10="SELECT `pr_sub_id`, `pr_sub_name` FROM `product_sub_category`";
	   $category = $this->get_results($query10);
       return $category;

   }

   function enquiryVariantFn ($cat_id)
   {
	   $query10="SELECT `ptdvar_id`, `name`,rent_cost,security_deposit_price,processing_fee,ins_fee,other_fee FROM `product_variant` where ptd_sub_catgry_id='$cat_id' ";
	   $category = $this->get_results($query10);
       return $category;

   }

    function empListfn ()
	{
		$query10="SELECT  id,`name` FROM `payrentz_employees` ";
	   $employee = $this->get_results($query10);
       return $employee;

	}

	function generateEnqiryIdFn ()
   {

		$query10="SELECT Max(enquiry_id) as id FROM enquiries ";
		$enquireId=$this->get_results( $query10 );
		$id =$enquireId[0]["id"];
		if($id=="")
		{
			$e_id='ENQ000001';
		}
		 else
		 {
	     preg_match("/(\D+)(\d+)/", $id,$Matches ); // Matches the PU and number
         $ProductCode = $Matches[1];
         $NewID = intval($Matches[2]);
	     $NewID++;
         $BarcodeLength = 6;
         $CurrentLength = strlen($NewID);
         $MissingZeros = $BarcodeLength - $CurrentLength;
         for ($i=0; $i<$MissingZeros; $i++) $NewID = "0" . $NewID;
         $e_id = $ProductCode . $NewID;
		 }
		 return $e_id;

	}

	//save enquiry data
	function getVariantAmountFn($e_var)
	{

	 $query10="SELECT  rent_cost,`security_deposit_price`,processing_fee,ins_fee,other_fee,tenure FROM `product_variant_cost` where ptdvar_id=$e_var LIMIT 1";
	 $varAmount = $this->get_results($query10);
     return $varAmount[0];

	}
	function getTenureCostFn ($p_var_id,$ten)
	{

	 $query10="SELECT  rent_cost,`security_deposit_price`,processing_fee,ins_fee,other_fee,tenure FROM `product_variant_cost` where ptdvar_id=$p_var_id and tenure=$ten LIMIT 1";
	 $varAmount = $this->get_results($query10);
     return $varAmount;

	}
	//save enquiry data
	function enquiryIdlistFn()
	{
	 	$query10="SELECT  enquiry_id,customer_status FROM enquiries where enquiry_status = 0";
	 	$enquiryId = $this->get_results($query10);
    return $enquiryId;

	}
	//save enquiry data
	function re_enquiryIdlistFn()
	{

	 $query10="SELECT  enquiry_id,customer_status FROM enquiries where is_closed = 1";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId;

	}


	function verifiedEnquiryIdlistFn()
	{

	 $query10="SELECT  enquiry_id,customer_status FROM enquiries where enquiry_status = 1";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId;

	}



	function enquiryDataFn($id,$status)
	{
		if($status == '0')
		{
	 		$query10="SELECT a.enquiry_id, a.customer_id, a.enquiry_date, a.attended_by, a.assigned_to, b.customer_name, a.total_security_amount, a.total_processing_fee, a.t_installation_fee, a.total_amount, a.amount_received_from_customer, a.customer_status, a.mail_status, a.is_modified  FROM enquiries as a INNER JOIN customer_general_detail as b ON a.customer_id = b.customer_id where ((a.customer_status =0 and a.enquiry_id='$id') and (a.enquiry_status=0 and a.is_closed=0))and a.is_terminate=0;";
			$stat='Waiting For Approval';
		}
		else
		{
			 $query10="SELECT a.enquiry_id,a.customer_id,a.enquiry_date,a.attended_by,a.assigned_to,b.customer_name,a.total_security_amount,a.total_processing_fee,a.t_installation_fee,a.total_amount,a.amount_received_from_customer,a.customer_status,a.mail_status,a.is_modified FROM enquiries as a INNER JOIN customer_general_detail as b ON a.enquiry_id = b.enquiry_id where ((a.customer_status =1 and a.enquiry_id='$id') and (a.enquiry_status=0 and a.is_closed=0))and a.is_terminate=0;";
			 $stat='<span style="color:red">Non Customer</span>';
		}
		$enquiryData = $this->get_results_excoustomer($query10,$status,$stat);
    return $enquiryData;
	}

	function verifiedEnquiryDataFn($id,$status)
	{
	 	$query10="SELECT a.enquiry_id, a.customer_id, a.enquiry_date, a.attended_by, a.assigned_to, b.customer_name, a.total_security_amount, a.total_processing_fee, a.t_installation_fee, a.total_amount, a.amount_received_from_customer, a.customer_status, a.is_mapped  FROM enquiries as a INNER JOIN customer_general_detail as b ON a.customer_id = b.customer_id where ((a.customer_status =0 and a.enquiry_id='$id') and (a.enquiry_status=1 and a.is_closed=0))and a.is_terminate=0;";

		$stat='Waiting For Mapping';
		$enquiryData = $this->get_results_for_verified($query10,$status,$stat);
    return $enquiryData;
	}

	function rejectedEnquiryDataFn($id,$status)
	{

		if($status == '0')
		{
	 $query10="SELECT a.enquiry_id,a.customer_id,a.enquiry_date,a.attended_by,a.assigned_to,b.customer_name,a.total_security_amount,a.total_processing_fee,a.t_installation_fee,a.total_amount,a.amount_received_from_customer,a.customer_status,a.is_mapped  FROM enquiries as a INNER JOIN customer_general_detail as b ON a.customer_id = b.customer_id where a.is_closed=1 and a.enquiry_id='$id' and a.is_terminate=0;";
	    }
		else
		{
			$query10="SELECT a.enquiry_id,a.customer_id,a.enquiry_date,a.attended_by,a.assigned_to,b.customer_name,a.total_security_amount,a.total_processing_fee,a.t_installation_fee,a.total_amount,a.amount_received_from_customer,a.customer_status,a.is_mapped  FROM enquiries as a INNER JOIN customer_general_detail as b ON a.enquiry_id = b.enquiry_id where a.is_closed=1 and a.enquiry_id='$id' and a.is_terminate=0;";
		}
		$stat='Rejected';


		 $enquiryData = $this->get_results_for_rejected($query10,$status,$stat);

         return $enquiryData;


	}

	function mapedStatusList($id)
	{
	 $query10   = "SELECT  enquiry_id FROM mapping_table where mapped_status = 0 and enquiry_id='$id'";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId;
	}

	//quote genral
	function quotationGenralDetail($id)
	{
	 $query10   = "SELECT enquiry_id,enquiry_date,total_amount as total,amount_received_from_customer as received  FROM enquiries  where enquiry_id='$id'";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId [0];
	}

	//quote product list
	function quotationProductDetail($id)
	{
	 $query10   = "SELECT  j.quantity,j.security_deposit_amount,j.processing_fee,j.ins_fee,c.pr_sub_name,r.name,j.rent_per_month FROM enquiry_products j  left outer join product_variant r on j.ptdvar_id=r.ptdvar_id left outer join product_sub_category c
                   on r.ptd_sub_catgry_id=c.pr_sub_id where j.enquiry_id='$id'";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId;
	}



	function empNameFn($id)
	{
	 	$query10="SELECT  name FROM payrentz_employees where id='$id'";
	 	$empName = $this->get_results($query10);
		if(sizeof($empName)>0){
			$res=$empName[0];
		}
		else{
			$res["name"]="";
		}
		return $res;
	}

	//enquiry general detail function

	function singleEnquiryGenDataFn ($e_id)
	{
	 $query10="SELECT  enquiry_date,attended_by,assigned_to,customer_status,customer_id,followup_remarks,followup_date FROM enquiries where enquiry_id='$e_id'";
	 $eData = $this->get_results($query10);
     return $eData[0];

	}

	function getEnqCusDetailFn($c_id,$customerType)
	{

		if($customerType==1)
		{
	 $query10="SELECT customer_name,email FROM `customer_general_detail` where enquiry_id='$c_id'";

		}
		else
		{
	$query10="SELECT customer_name,email FROM `customer_general_detail` where customer_id='$c_id'";
		}
		$eCusData = $this->get_results($query10);
     return $eCusData[0];

	}

	function getEnqCusConDetailFn($c_id,$customerType)
	{

		if($customerType==1)
		{
	 $query10="SELECT DISTINCT mobile FROM `customer_contact` where enquiry_id='$c_id'";

		}
		else
		{
	$query10="SELECT DISTINCT mobile FROM `customer_contact` where customer_id='$c_id'";
		}
		$eCusData = $this->get_results($query10);
        return $eCusData[0];

	}

		function getProductDetailsfn($e_id)
	{


	 $query10="SELECT a.enquiry_id,a.customer_id,a.ptdvar_id,a.tenure,a.rent_months_count,a.quantity,a.expecting_delivery_date,a.rent_per_month,a.security_deposit_amount,a.processing_fee,a.ins_fee,b.ptd_sub_catgry_id FROM enquiry_products as a INNER JOIN product_variant as b ON a.ptdvar_id = b.ptdvar_id where enquiry_id='$e_id'";


		$eCusData = $this->get_results($query10);
        return $eCusData;

	}

		function rentHistoryFn($p_id)
	{
	    $query10="SELECT * FROM `rent_history` WHERE product_id='$p_id'";
	 	$eCusData = $this->get_results($query10);
        return $eCusData;
	}
   function serviceHistoryFn($p_id)
   {
	    $query10="SELECT customer_id,DATE_FORMAT(service_applied_date,'%d-%m-%Y') as date,service_amount as amount FROM `service_table` WHERE product_id='$p_id' and is_serviced='1'";
		$eCusData = $this->get_results($query10);
        return $eCusData;

   }
   function generalHistoryFn($p_id)
   {
	 $query10="SELECT customer_id,DATE_FORMAT(g_e__date,'%d-%m-%Y') as date,amount_spent as amount FROM `general_expenses` WHERE product_id='$p_id'";
	 $eCusData = $this->get_results($query10);
     return $eCusData;
    }
   function tranportHistoryFn($p_id)
    {
	 $query10="SELECT customer_id,DATE_FORMAT(transfer_date,'%d-%m-%Y') as date,amount_spent as amount FROM `transport_expenses` WHERE product_id='$p_id'";
	 $eCusData = $this->get_results($query10);
     return $eCusData;
    }


	function deleteEquiryProduct($id)
	{
		$delete = array('enquiry_id' => $id);
		$deleted = $this->delete( 'enquiry_products', $delete);
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	function getNewCustomerDetail($c)
	{
		$query2="SELECT customer_id,customer_name,email,extra_amount FROM `customer_general_detail` WHERE `city_id`='$c' and customer_status='0'";
		$invoicelist=$this->get_results_dt_new_customer( $query2 );
		return $invoicelist;
	}


	/*** Resourse 2 ***/
// Got Customer Name
	function getcustomername($value)
	{
	    $getnameofcustomer="SELECT customer_name FROM `customer_general_detail` WHERE `customer_id`='$value'";
		$name_data=$this->get_results( $getnameofcustomer );
		return $name_data;
	}

	//Add Vendor
	function addvendorname($name,$vendordescription,$statusvendor)
	{
		$names = array('name' => $name, 'description' => $vendordescription, 'status' => $statusvendor);
		$add_query = $this->insert( 'vendor', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	// Vendor Name list
	function getvendorlist()
	{
	    $getvendor="SELECT * from vendor";
		$vendorname_data=$this->get_results( $getvendor );
		return $vendorname_data;
	}

	//Delete Vendor List
	function deletevendorlist($id)
	{
		$delete = array('vendor_id' => $id);
		$deleted = $this->delete( 'vendor', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular VEndor details for edit
	function particularvendorlist($id)
	{
		$getParvendor="SELECT * from vendor where vendor_id = $id";
		$vendor_data=$this->get_results( $getParvendor );
		return $vendor_data;
	}

	// Edit Vendor
	function  editvendorlist($id,$vendorname,$editvendordescription,$editstatusvendor)
	{
		$update = array('name' => $vendorname, 'description' => $editvendordescription , 'status' => $editstatusvendor );
		$where_clause = array(
				'vendor_id'=> $id
		);
		$updated = $this->update('vendor', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	//Nativity Add
	function addnativityname($name,$nativitydescription,$statusnativity )
	{
		$names = array('name' => $name, 'description' => $nativitydescription ,'status' => $statusnativity);
		$add_query = $this->insert( 'nativity', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	// Nativity Name list
	function getnativitylist()
	{
	    $getnativity="SELECT * from nativity";
		$nativityname_data=$this->get_results( $getnativity );
		return $nativityname_data;
	}

	//Delete Nativity List
	function deletenativitylist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'nativity', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular VEndor details for edit
	function particularnativitylist($id)
	{
		$getparnativity="SELECT * from nativity where id = $id";
		$nativity_data=$this->get_results( $getparnativity );
		return $nativity_data;
	}

	// Edit Nativity
	function  editnativitylist($id,$nativity,$editnativitydescription ,$editstatusnativity)
	{
		$update = array('name' => $nativity, 'description' => $editnativitydescription , 'status' => $editstatusnativity );
		$where_clause = array(
				'id'=> $id
		);
		$updated = $this->update('nativity', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	//zone State list
	function getstatelist()
	{
	    $getstate="SELECT * from states";
		$statename_data=$this->get_results( $getstate );
		return $statename_data;
	}

	//zone State list
	function getcitylist($stateid)
	{
	    $getcity="SELECT * from cities where state_id = $stateid";
		$cityname_data=$this->get_results( $getcity );
		return $cityname_data;
	}

	//zone State list
	function geteditzonecitylist()
	{
	    $getzonecity="SELECT * from cities";
		$citynamedata=$this->get_results( $getzonecity );
		return $citynamedata	;
	}

	//Zone Add
	function addzonename($zonecity,$zoneid,$zonedescription,$statuszone)
	{
		$names = array('name' => $zoneid, 'city_id' => $zonecity, 'description' => $zonedescription, 'status' => $statuszone);
		$add_query = $this->insert( 'zone', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//zone State list
	function getzonelist()
	{
	    $getzone="SELECT * from zone";
		$zonename_data=$this->get_results( $getzone );
		return $zonename_data;
	}

	//Delete Zone
	function deletezonelist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'zone', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular VEndor details for edit
	function particularzonelist($id)
	{
		$getParzone="SELECT * from zone where id = $id";
		$zone_data=$this->get_results( $getParzone );
		return $zone_data;
	}

	// Edit zone
	function  editzonelist($id,$zoneeditid,$zoneeditcity,$editzonedescription,$editstatuszone)
	{
		$update = array('name' => $zoneeditid,'city_id' => $zoneeditcity, 'description' => $editzonedescription ,'status' => $editstatuszone);
		$where_clause = array(
				'id'=> $id
		);
		$updated = $this->update('zone', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add Product
	function addproductname($name,$productdescription,$statusproduct)
	{
		$names = array('name' => $name, 'description' => $productdescription ,'status' => $statusproduct);
		$add_query = $this->insert( 'product_category', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//product list
	function productcatlist()
	{
	    $getproducts="SELECT * from product_category";
		$getproductdetails=$this->get_results( $getproducts );
		return $getproductdetails;
	}

	//Delete Product
	function deleteproductlist($id)
	{
		$delete = array('ptdcatgry_id' => $id);
		$deleted = $this->delete( 'product_category', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular Product details for edit
	function particularproductlist($id)
	{
		$getParproduct="SELECT * from product_category where ptdcatgry_id = $id";
		$product_data=$this->get_results( $getParproduct );
		return $product_data;
	}

	// Edit zone
	function  editprodcutlist($editpid,$editpcategory,$editproductdescription,$editstatusproduct)
	{
		$update = array('name' => $editpcategory, 'description' => $editproductdescription ,'status' => $editstatusproduct);
		$where_clause = array(
				'ptdcatgry_id'=> $editpid
		);
		$updated = $this->update('product_category', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add Sub Product

	function addsubproduct($maincategorylist,$subcategoryname ,$subcatdescription,$subcatstatus,$cgst,$sgst,$igst,$ugst,$cess)
	{
		$names = array('pr_cat_id' => $maincategorylist ,'pr_sub_name' => $subcategoryname, 'description' => $subcatdescription ,'status' => $subcatstatus,'CGST'=>$cgst,'SGST'=>$sgst,'IGST'=>$igst,'UGST'=>$ugst,'CESS'=>$cess);
		$add_query = $this->insert( 'product_sub_category', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//Main Category list
	function getmaincatlist()
	{
	    $getmaincatlist="SELECT ptdcatgry_id,name from product_category";
		$getmaincatlistdetails=$this->get_results( $getmaincatlist );
		return $getmaincatlistdetails;
	}

	//Subcategory product list
	function productsubcatlist()
	{
	    $productsubcatlist="SELECT * from product_sub_category";
		$getproductsubcatlist=$this->get_results( $productsubcatlist );
		return $getproductsubcatlist;
	}

	//Delete subcategories
	function deletesubcatproductlist($id)
	{
		$delete = array('pr_sub_id' => $id);
		$deleted = $this->delete( 'product_sub_category', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular subcategories details for edit
	function particularsubcatlist($id)
	{
		$getParsubproduct="SELECT * from product_sub_category where pr_sub_id = $id";
		$subproduct_data=$this->get_results( $getParsubproduct );
		return $subproduct_data;
	}

	// Edit subcategories
	function  editsubcatprodcutlist($editcatid,$editsubcategoryname,$editsubcatdescription,$editsubcatstatus,$cgst,$sgst,$igst,$ugst,$cess)
	{
		$update = array('pr_sub_name' => $editsubcategoryname, 'description' => $editsubcatdescription ,'status' => $editsubcatstatus,'CGST'=>$cgst,'SGST'=>$sgst,'IGST'=>$igst,'UGST'=>$ugst,'CESS'=>$cess);
		$where_clause = array(
				'pr_sub_id'=> $editcatid
		);
		$updated = $this->update('product_sub_category', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add Brand of Product
	function addbrandname($brand,$addbranddescr,$addbrandstatus)
	{
		$names = array('name' => $brand ,'description' => $addbranddescr, 'status' => $addbrandstatus);
		$add_query = $this->insert( 'brand', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//Brand list
	function brandlist()
	{
	    $brandlist="SELECT * from brand";
		$getbrandlist=$this->get_results( $brandlist );
		return $getbrandlist;
	}

	//Delete Brand
	function deletebrandlist($id)
	{
		$delete = array('brand_id' => $id);
		$deleted = $this->delete( 'brand', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular Brand details for edit
	function particularbranch($id)
	{
		$getParsubbrand="SELECT * from brand where brand_id = $id";
		$subbrand_data=$this->get_results( $getParsubbrand );
		return $subbrand_data;
	}

	// Edit editbrandlist
	function  editbrandlist($editidbrand,$editbrand,$editaddbranddescr,$editaddbrandstatus)
	{
		$update = array('name' => $editbrand, 'description' => $editaddbranddescr ,'status' => $editaddbrandstatus);
		$where_clause = array(
				'brand_id'=> $editidbrand
		);
		$updated = $this->update('brand', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add state of Product
	function addstates($stateid,$statedescription,$statusstate)
	{
		$names = array('name' => $stateid ,'description' => $statedescription, 'status' => $statusstate);
		$add_query = $this->insert( 'states', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//Delete state
	function deletestatelist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'states', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular Brand details for edit
	function particularstatelist($id)
	{
		$getParstates="SELECT * from states where id = $id";
		$getParstatesdata = $this->get_results( $getParstates );
		return $getParstatesdata;
	}

	// Edit editbrandlist
	function  editstatelist($editstateid,$editstatename,$editstatedescription,$editstatusstate)
	{
		$update = array('name' => $editstatename, 'description' => $editstatedescription ,'status' => $editstatusstate);
		$where_clause = array(
				'id'=> $editstateid
		);
		$updated = $this->update('states', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add City of Product
	function addcities($cityname,$statename,$citydescription,$statuscity)
	{
		$names = array('name' => $cityname ,'state_id' =>$statename,'description' => $citydescription, 'status' => $statuscity);
		$add_query = $this->insert( 'cities', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//Delete city
	function deletecitylist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'cities', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}


	// Particular city details for edit
	function particularcity($id)
	{
		$getParcity="SELECT * from cities where id = $id";
		$getParcitydata = $this->get_results( $getParcity );
		return $getParcitydata;
	}

	// Edit city
	function  editcitylist($editcityid,$editcityname,$editcitydescription,$editcitystate)
	{
		$update = array('name' => $editcityname, 'description' => $editcitydescription ,'status' => $editcitystate);
		$where_clause = array(
				'id'=> $editcityid
		);
		$updated = $this->update('cities', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add City of Product
	function addemployee($empyname,$empymbl,$empemail,$empdesignation)
	{
		$names = array('name' => $empyname ,'mobile' =>$empymbl,'	email' => $empemail, 'designation' => $empdesignation);
		$add_query = $this->insert( 'payrentz_employees', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//employee list
	function gotemployeedetails()
	{
	    $employeedetails="SELECT * from payrentz_employees";
		$getemployeedetails=$this->get_results( $employeedetails );
		return $getemployeedetails;
	}

	//Delete employee
	function deleteemployeelist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'payrentz_employees', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular employee details for edit
	function particularemployee($id)
	{
		$getParemp="SELECT * from payrentz_employees where id = $id";
		$getParempdata = $this->get_results( $getParemp );
		return $getParempdata;
	}

	// Edit employee
	function  editemployeelist($editempyid,$editempyname,$editempymbl,$editempemail,$editempdesignation)
	{
		$update = array('name' => $editempyname, 'mobile' => $editempymbl ,'email' => $editempemail, 'designation'=>$editempdesignation);
		$where_clause = array(
				'id'=> $editempyid
		);
		$updated = $this->update('payrentz_employees', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// Add City of Product
	function copylist()
	{
		$companydetails="SELECT * from company";
		$getcompanydetails=$this->get_results( $companydetails );
		return $getcompanydetails;
	}

	// Add Company
	function addcompany($companyname,$cmpydesc,$companystatus)
	{
		$names = array('name' => $companyname ,'status' =>$companystatus,'description' => $cmpydesc);
		$add_query = $this->insert( 'company', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	//Delete employee
	function deletecompanylist($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'company', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}

	// Particular employee details for edit
	function particularcompany($id)
	{
		$getParcmpy="SELECT * from company where id = $id";
		$getParcmpydata = $this->get_results( $getParcmpy );
		return $getParcmpydata;
	}

	// Edit company
	function  editcompnylist($editcompanyid,$editcompanyname,$editcmpydesc,$editcompanystatus)
	{
		$update = array('name' => $editcompanyname, 'status' => $editcompanystatus ,'description' => $editcmpydesc);
		$where_clause = array(
				'id'=> $editcompanyid
		);
		$updated = $this->update('company', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}


	// Add Company
	function addvariant($subcategoryproduct,$variantname,$verantdesct,$rendcost,$depositeamnt,$processingfees,$inscost,$otherfee,$statusvariant,$tenure)
	{
		$names = array('ptd_sub_catgry_id' =>$subcategoryproduct,'name'=>$variantname,'description'=>$verantdesct,'status' =>$statusvariant);
		$add_query = $this->insert( 'product_variant', $names );
		$id= $this->lastid();

		$names1 = array('ptdvar_id' =>$id,'rent_cost'=>$rendcost,'security_deposit_price'=>$depositeamnt,'processing_fee'=>$processingfees,'ins_fee'=> $inscost,'other_fee'=>$otherfee,'tenure' =>$tenure);
		$add_query1 = $this->insert( 'product_variant_cost', $names1 );


		if( $add_query1 )
		{
			return true;
		}
		else
			return false;
	}

	//Sub Category
	function subcategorylist($mainid)
	{
		$getSubCategoryList="SELECT * from  product_sub_category where pr_cat_id = $mainid";
		$getSubCategoryListdata = $this->get_results( $getSubCategoryList );
		return $getSubCategoryListdata;
	}

	//variantlist
	function variantlist()
	{
		$getvariantList="SELECT p.*, q.pr_sub_name as par_name from  product_variant as p LEFT JOIN product_sub_category as q on p.ptd_sub_catgry_id=q.pr_sub_id";
		$getvariantListdata = $this->get_results( $getvariantList );
		return $getvariantListdata;
	}


	//Delete variant
	function deletevariant($id)
	{			{
		$delete = array('ptdvar_id' => $id);				$delete = array('ptdvar_id' => $id);
		$deleted = $this->delete( 'product_variant', $delete, 1 );				$deleted = $this->delete( 'product_variant', $delete, 1 );

		$query6="SELECT * FROM product_variant_cost where ptdvar_id='$id'";
		$numofclr = $this->num_rows( $query6 );

		for($i=0;$i<$numofclr;$i++)
		{
			$delete1 = array('ptdvar_id' => $id);
			$deleted1 = $this->delete( 'product_variant_cost', $delete1, 1 );
		}

		if( $deleted )				if( $deleted )
		{				{
			return true;					return true;
		}				}
		return false;					return false;
	}			}

	// Particular employee details for edit
	// Particular employee details for edit
	function particularvariant($id)
	{
		$getvariant="SELECT * from product_variant where ptdvar_id = $id";
		$getvariantdata = $this->get_results( $getvariant );

		$getvariant1="SELECT * from product_variant_cost where ptdvar_id = $id";
		$getvariantdata1 = $this->get_results( $getvariant1 );

		$c = array('variant' => $getvariantdata,'variantcost' => $getvariantdata1);
		return $c;

	}


	// Edit variant
	function  editvariantlist($editvariantid,$editvariantname,$editverantdesct,$editstatusvariant,$editrendcost,$editdepositeamnt,$editprocessingfees,$editinscost,$editotherfee)
	{
		$update = array('name' => $editvariantname, 'status' => $editstatusvariant , 'description' => $editverantdesct, 'rent_cost'=> $editrendcost, 'security_deposit_price' =>$editdepositeamnt, 'processing_fee' =>$editprocessingfees, 'ins_fee' =>$editinscost, 'other_fee' =>$editotherfee);
		$where_clause = array(
				'ptdvar_id'=> $editvariantid
		);
		$updated = $this->update('product_variant', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	// areazonelist details for edit
	function areazonelist($id)
	{
		$areazonelist="SELECT * from zone where city_id = $id";
		$areazonelistdata = $this->get_results( $areazonelist );
		return $areazonelistdata;
	}


	// Add area
	function addarea($areazone,$area,$areadescription,$statusarea)
	{
		$names = array('name' => $area ,'status' =>$statusarea,'description' => $areadescription, 'zone_id'=>$areazone);
		$add_query = $this->insert( 'area', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	// Are list
	function arealist()
	{
		$arealist="SELECT * from area";
		$getarealist=$this->get_results( $arealist );
		return $getarealist;
	}


	//Delete variant
	function deletearea($id)
	{
		$delete = array('id' => $id);
		$deleted = $this->delete( 'area', $delete, 1 );
		if( $deleted )
		{
			return true;
		}
		return false;
	}


	// Particular employee details for edit
	function particulararea($id)
	{
		$getarea="SELECT * from area where id = $id";
		$ggetareadata = $this->get_results( $getarea );
		return $ggetareadata;
	}

	// Edit area
	function  editareadetls($areaid,$editarea,$editareadescription,$editstatusarea)
	{
		$update = array('name' => $editarea, 'status' => $editstatusarea ,'description' => $editareadescription);
		$where_clause = array(
				'id'=> $areaid
		);
		$updated = $this->update('area', $update, $where_clause);
		if( $updated )
		{
			return true;
		}
		else
			{
			return false;
		}
	}


	// Got category Description
	function checkserialnum($id)
	{
		$checkserialnum="SELECT sl_no from product where sl_no = $id";
		if( $this->num_rows( $checkserialnum ) > 0 )
		{
			return  1;
		}
		else
		{
			return 0;
		}

	}

       function ismaped($id)
	{
	 $query10   = "SELECT  enquiry_id FROM mapping_table where enquiry_id='$id'";
	 $enquiryId = $this->get_results($query10);
     return $enquiryId;
	}



	function prdvariantlistdetails($productvar)
	{
		$prdvariantlist="SELECT rent_cost,security_deposit_price,processing_fee from product_variant where ptdvar_id = $productvar";
		$prdvariantlistdata = $this->get_results( $prdvariantlist );
		return $prdvariantlistdata;
	}

	// Particular employee details for edit
	function addproductvariantgot($id)
	{
		$variantaddproduct="SELECT * from product_variant where 	ptd_sub_catgry_id = $id";
		$variantaddproductdata = $this->get_results( $variantaddproduct );
		return $variantaddproductdata;
	}

	// Vendor Name list
	function getrentvendorlist()
	{
	    $getrentvendor="SELECT * from rent_vendor";
		$vendorname_data=$this->get_results( $getrentvendor );
		return $vendorname_data;
	}
        // Vendor Name list
	function getsms()
	{
	    $getrentvendor="SELECT * from sms_content";
            $vendorname_data=$this->get_results($getrentvendor);
	    return $vendorname_data;
	}



	// Product Name list
	function getproductList()
	{
	    $productList="SELECT product_id,purchase_date,purchase_cost,prtd_location,warranty_end_date from product   ORDER BY id DESC";
		$productListdata=$this->get_results_dt_product($productList);
		return $productListdata;
	}

	function re_list()
	{
	    $productList="SELECT product_id, customer_id, return_date FROM mapping_table WHERE is_returned = '1' and is_closure='0' and refund_status='0' ORDER BY return_date DESC";
		$productListdata=$this->return_list_db($productList);
		return $productListdata;
	}

	// Transport product list
	function transporttableid()
	{
		$curdate  = date('Y-m-d', strtotime("+0 days"));
        $curdate1 = date('Y-m-d', strtotime("+1 days"));
        $curdate2 = date('Y-m-d', strtotime("+2 days"));
	    $productList="SELECT customer_id,product_id,delivery_status,delivery_date,DATE_FORMAT(return_date, '%d-%M-%y') as return_date from  mapping_table where ((delivery_date='".$curdate."' or delivery_date='".$curdate1."' or delivery_date='".$curdate2."') and (delivered_at='' and delivery_status='0')) or ((return_date='".$curdate."' or return_date='".$curdate1."' or return_date='".$curdate2."') and ( is_returned='1'))";
		$productListdata=$this->get_results($productList);
		return $productListdata;
	}

	// Transport product list
	function servicerequest()
	{
	    $productList="SELECT customer_id,product_id,delivery_status,delivery_date from  mapping_table where service_status=1";
		$productListdata=$this->get_results($productList);
		return $productListdata;
	}



	// Product Name list
	function productGeneralDetailFn($p_id)
	{
	    $productList="SELECT product_id,ptdvar_id,brand,prtd_location,warranty_end_date,bill_no,purchase_date,purchase_cost from product where product_id='$p_id'";
		$productListdata=$this->get_results($productList);
		return $productListdata;
	}
	// Product Name list
	function productCountFn($p_id)
	{
	    $productList="SELECT COUNT(customer_id),sum(actual_security_deposit_amount),sum(actual_processing_fee),sum(actual_installation_fee) from mapping_table where product_id='$p_id' GROUP BY customer_id";
		$productListdata=$this->get_results($productList);
		return $productListdata;
	}

	function MappedHistoryFn($p_id)
	{
	    $productList="select o.customer_id, o.product_id, o.is_returned,o.delivery_date, o.installation_date, o.rent_on_date, o.return_date, o.delivered_by, o.delivered_at, (o.rent_per_month + o.tax) as rent_per_month , o.rent_cost,o.received_total_rent_cost,o.actual_security_deposit_amount, o.actual_processing_fee,o.actual_installation_fee,o.actual_other_fee, o.service_status, o.mapped_status, o.is_closure, o.closure_date, o.refund_status, o.removed_status, o.refund_amount,o.pending_minus,r.name,c.pr_sub_name from mapping_table o left outer join product j on o.product_id=j.product_id left outer join product_variant r on j.ptdvar_id=r.ptdvar_id left outer join product_sub_category c on r.ptd_sub_catgry_id=c.pr_sub_id where  o.product_id='$p_id'";
			$productListdata=$this->get_results_product_report($productList);
			return $productListdata;
	}



	// Product View list
	function gotparticularproductview($id)
	{
	    $gotproductdetails="SELECT * from product where product_id = '".$id."'";
		$gotproductdetailsdata=$this->get_results($gotproductdetails);

		$product_image="SELECT * from product_image where productkey = '".$id."'";
		$product_imagedata=$this->get_results($product_image);

		$product_id= $gotproductdetailsdata[0]["product_id"];
		$ptdvar_id = $gotproductdetailsdata[0]["ptdvar_id"];
		$brand = $gotproductdetailsdata[0]["brand"];
		$vendor = $gotproductdetailsdata[0]["vendor"];
		$ptdvarq="SELECT * from product_variant where ptdvar_id = '".$ptdvar_id."'";
		$ptdvarid=$this->get_results($ptdvarq);
		$variantname= $ptdvarid[0]["name"];
		$variantrent_cost= $ptdvarid[0]["rent_cost"];
		$security_deposit_price= $ptdvarid[0]["security_deposit_price"];
		$processing_fee= $ptdvarid[0]["processing_fee"];
		$ptd_sub_catgry_id= $ptdvarid[0]["ptd_sub_catgry_id"];

		$subcat="SELECT * from product_sub_category where pr_sub_id = '".$ptd_sub_catgry_id."'";
		$subcatrid=$this->get_results($subcat);
		$pr_sub_name= $subcatrid[0]["pr_sub_name"];

		$vendorq="SELECT name from vendor where vendor_id = '".$vendor."'";
		$vendorqid=$this->get_results($vendorq);
		$vendorname= $vendorqid[0]["name"];

		$brandq="SELECT name from brand where brand_id = '".$brand."'";
		$brandid=$this->get_results($brandq);
		$brandname= $brandid[0]["name"];

 		$c = array('subcategory' => $pr_sub_name,'productid' => $product_id, 'variantname' => $variantname, 'brandname' => $brandname, 'vendorname' => $vendorname,
 			'variantrent_cost' => $variantrent_cost, 'security_deposit_price' => $security_deposit_price, 'processing_fee' => $processing_fee,'productary'=>$gotproductdetailsdata,'productimgs' => $product_imagedata);
		return $c;
	}

	// Particular employee details for edit
	function gotparticularproductedit($id)
	{
		$gotproductdetails="SELECT * from product where product_id = '".$id."'";
		$gotproductdetailsdata=$this->get_results($gotproductdetails);
		$ptdvar_id = $gotproductdetailsdata[0]["ptdvar_id"];
		$product_id= $gotproductdetailsdata[0]["product_id"];

		$product_image="SELECT * from product_image where productkey = '".$id."'";
		$product_imagedata=$this->get_results($product_image);

		$ptdvarq="SELECT * from product_variant where ptdvar_id = '".$ptdvar_id."'";
		$ptdvarid=$this->get_results($ptdvarq);
		$variantrent_cost= $ptdvarid[0]["rent_cost"];
		$security_deposit_price= $ptdvarid[0]["security_deposit_price"];
		$processing_fee= $ptdvarid[0]["processing_fee"];
		$ptd_sub_catgry_id= $ptdvarid[0]["ptd_sub_catgry_id"];

		$maincate="SELECT * from product_sub_category where pr_sub_id = '".$ptd_sub_catgry_id."'";
		$maincatesdata=$this->get_results($maincate);
		$pr_cat_id = $maincatesdata[0]["pr_cat_id"];

		$datafill = array('maincategory' => $pr_cat_id,'subcategory' => $ptd_sub_catgry_id,'productid' => $product_id,'variantrent_cost' => $variantrent_cost, 'security_deposit_price' => $security_deposit_price, 'processing_fee' => $processing_fee,'productary'=>$gotproductdetailsdata,'productimgs' => $product_imagedata);

		return $datafill;

	}

	// Particular employee details for edit
	function trgetcustomerid($productid)
	{
		$customerid="SELECT customer_id from  mapping_table where product_id = '".$productid."'";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	// Particular employee details for edit
	function getreportYearfn($year)
	{
		$customerid="SELECT count(customer_id) as cou,month from  customer_general_detail where year = '$year' GROUP BY month";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getopenreportfn($year)
	{
		$customerid="SELECT count(customer_id) as cou,month(doj) as month from  customer_general_detail where ( year(doj) = '$year' and customer_status ='1' and (month(doj)-1) )  GROUP BY month(doj) ";
		//print_r($customerid);
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getaddreportfn($year)
	{
		$customerid="SELECT count(customer_id) as cou,month from  customer_general_detail where (year = '$year' and customer_status ='1' ) GROUP BY month ";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getcloreportfn($year)
	{
		$customerid="SELECT count(customer_id) as cou,month from  customer_general_detail where (year = '$year' and customer_status ='1' and remove_type='1') GROUP BY month ";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getproreportfn($year)
	{
		$customerid="SELECT count(product_id) as cou,month(purchase_date) as month,sum(purchase_cost) as pc from  product where (year(purchase_date) = '$year') GROUP BY month(purchase_date) ";
		//print_r("SELECT count(product_id) as cou,month(purchase_date) as month,sum(purchase_cost) as pc from  product where (year(purchase_date) = '$year') GROUP BY month(purchase_date) ");
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getmapreportfn($year)
	{

		$customerid="SELECT count(product_id) as cou,month(delivery_date) as month from  mapping_table where (year(delivery_date) = '$year') GROUP BY month(delivery_date) ";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getclosedreportfn($year)
	{
		$customerid="SELECT count(product_id) as cou,month(closure_date) as month from  mapping_table where year(closure_date) = '$year' and is_closure=1 GROUP BY month(closure_date) ";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}

	function getreturnReportFn($year)
	{
		$customerid="SELECT count(product_id) as cou,month from  mapping_table where r_year = '$year' and is_closure=1 GROUP BY month ";
		$customeriddata = $this->get_results($customerid);
		return $customeriddata;
	}




	// Particular employee details for edit
	function gotprodtforcusts1($mobilenum)
	{
		$customerid="SELECT customer_id from customer_contact where mobile = '".$mobilenum."'";
		$customeriddata = $this->get_results($customerid);
		$custid = $customeriddata[0]["customer_id"];

		$productlist="SELECT * from  mapping_table where customer_id = '".$custid."'";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}

	function gotprodtforcusts2($customerid)
	{
		$productlist="SELECT * from  mapping_table where customer_id = '".$customerid."' and is_closure='0'";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}

	function serviceListFn()
	{
		$productlist="SELECT id,customer_id,product_id,service_status from  mapping_table where  service_status='0' group by product_id";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}

	function curserviceListFn()
	{
		$productlist="SELECT id,customer_id,product_id,service_status from  mapping_table where    service_status='1'";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}

	function getserFn($p_id,$c_id)
	{
		$productlist="SELECT  DATE_FORMAT(service_applied_date,'%d/%m/%Y') as service_applied_date,issue_type from  service_table where is_serviced='0' and customer_id='".$c_id."' and product_id='".$p_id."'";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}





	function gotprodtforcusts3($productid)
	{
		$productlist="SELECT * from  mapping_table where product_id = '".$productid."'";
		$productlistdata = $this->get_results($productlist);
		return $productlistdata;
	}
	function gotprodtforcusts4()
	{
		$productlist="SELECT * from  mapping_table";
		$productlistdata = $this->get_serviceproductlist($productlist);
		return $productlistdata;
	}

 	// Add area
	function serviceadd($serviceinitiativdate,$serviceproductid,$serviceissue,$serviceremarks,$servicecustid)
	{
		$names = array('service_applied_date' => $serviceinitiativdate ,'issue_type' =>$serviceissue,'remarks' => $serviceremarks, 'product_id'=>$serviceproductid,'customer_id' =>$servicecustid);
		$add_query = $this->insert( 'service_table', $names );

		$update = array('service_status' => 1);
		$where_clause = array(
				'product_id'=> $serviceproductid
		);
		$updated = $this->update('mapping_table', $update, $where_clause);
		if( $updated)
		{
			return true;
		}
		else
			{
			return false;
		}
	}

	function employeelist()
	{
		$employeelist="SELECT id,name from  payrentz_employees";
		$employeelistdata = $this->get_results($employeelist);
		return $employeelistdata;
	}

	function getProductParVariantFn ($id)
	{
		$employeelist="SELECT product_id from  product where ptdvar_id ='$id'";
		$employeelistdata = $this->get_results($employeelist);
		return $employeelistdata;
	}




	function getPenExt($cost_type,$c_id)
	{
		$employeelist="SELECT  $cost_type FROM `customer_general_detail` WHERE `customer_id` ='$c_id'";
		$employeelistdata = $this->get_results($employeelist);
		print_r ($employeelistdata[0][$cost_type]);
		return $employeelistdata[0][$cost_type];
	}

	function payHistoryFn($e_id)
	{
		$employeelist="SELECT  id,`reiceved_amount`, `amount_reiceved_on`, `payment_mode`, `collected_on`, `collected_by`, `deposit_by`, `deposit_on`,reciept_status FROM `deposit_money_transaction` WHERE enquiry_id='$e_id'";
		$employeelistdata = $this->get_results($employeelist);
		return $employeelistdata;
	}


	// Edit serviceclose
	function  serviceclose($serviced_by,$serviceproductidclose,$service_amount,$servicefrom_date,$serviceto_date,$iswaiver,$servicewaiver_from_date,$waiver_to_date,$customerfeetback,$ispaid,$received_ammout,$paymentmode,$colected_on,$collectedby,$deposit_on,$deposit_by)
	{
		$update = array('is_serviced' => 1,'serviced_by' => $serviced_by,'service_amount' => $service_amount,'from_date'=>$servicefrom_date, 'to_date'=>$serviceto_date, 'is_waiver'=>$iswaiver,'waiver_from_date'=>$servicewaiver_from_date,
			'waiver_to_date' =>$waiver_to_date,'customer_fd_back'=>$customerfeetback, 'is_paid'=>$ispaid, 'received_ammout'=>$received_ammout,'payment_mode'=>$paymentmode,'colected_on'=>$colected_on, 'colected_by'=>$collectedby,'deposit_by'=>$deposit_on,'deposit_on'=>$deposit_on);
				$where_clause = array('product_id'=> $serviceproductidclose);
				$updated = $this->update('service_table', $update, $where_clause);


		$update1 = array('in_service' => 0);
		$where_clause1 = array('product_id'=> $serviceproductidclose);
		$updated1 = $this->update('product', $update1, $where_clause1);

			if( $updated1)
			{
				//return true;
			}
			else
				{
				//return false;
			}

        $update2 = array('service_status' => 0);
		$where_clause2 = array('product_id'=> $serviceproductidclose);
		$updated2 = $this->update('mapping_table', $update2, $where_clause2);

			if( $updated1)
			{
				//return true;
			}
			else
				{
				//return false;
			}
	}

	function gettotalamountforad($id)
	{
		$advtotal_amount="SELECT total_amount FROM enquiries where customer_id= '$id'";
	    $dataadvtotamount=$this->get_results( $advtotal_amount );
		return $dataadvtotamount;
	}

	// general expense
	function generalexpense($expensedate,$expenseid,$expenseproduct,$expensereason,$expenseamount,$expenseperson,$expensepay,$expense_remark)
	{
		$names = array('customer_id' => $expenseid ,'product_id' =>$expenseproduct,'g_e__date' => $expensedate, 'person'=>$expenseperson,'amount_spent' =>$expenseamount, 'pay'=>$expensepay,'remarks' =>$expense_remark);
		$add_query = $this->insert( 'general_expenses', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;
	}

	// Service expense
	function serviceexpense($service_product,$warranty_service,$issuetype,$service_amount,$service_remark,$servicestartfrom,$serviceendto,$serivceexpwaiver)
	{
		$names = array('product_id' => $service_product,'warranty' => $warranty_service,
			'amount_spent'=>$service_amount,'issuetype' =>$issuetype,'from_date'=>$servicestartfrom,'to_date' =>$serviceendto,'	waiver'=>$serivceexpwaiver,'remarks' =>$service_remark);
		$add_query = $this->insert( 'service_expense', $names );
		if( $add_query )
		{
			return true;
		}
		else
			return false;

	}

	function trapdateprodct($id)
	{
		$trapdateprodct="SELECT product_id,customer_id,id,delivery_date,return_date FROM mapping_table where (delivery_date= '$id' and
		(delivered_at='' and delivery_status='0')) or (return_date= '$id' and
		(is_returned='1'))";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}
	function get_extra($id)
	{
		$trapdateprodct="$id";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}
	function getcatReport($year)
	{
		$trapdateprodct="SELECT a.pr_sub_id,month(d.rent_on_date) as month,d.actual_security_deposit_amount,d.actual_processing_fee FROM mapping_table as d INNER JOIN product as c ON d.`product_id` = c.product_id INNER JOIN product_variant as b ON b.`ptdvar_id` = c.ptdvar_id INNER JOIN product_sub_category as a ON a.`pr_sub_id` = b.ptd_sub_catgry_id where year(d.rent_on_date)='$year'";
		//print_r($trapdateprodct);
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}

	function getcatReportF($yea,$r_ven,$r_bd)
	{
	if($r_ven == 0)
		 {
			 $venQuery ="";
		 }
         else
		 {
			 $venQuery ="AND c.vendor='$r_ven'";
		 }
		 if($r_bd == 0)
		 {
			 $bdQuery ="";
		 }
         else
		 {
			 $bdQuery ="AND c.brand='$r_bd'";
		 }

		$trapdateprodct="SELECT a.pr_sub_id,month(d.delivery_date) as month,d.actual_security_deposit_amount,d.actual_processing_fee FROM mapping_table as d INNER JOIN product as c ON d.`product_id` = c.product_id INNER JOIN product_variant as b ON b.`ptdvar_id` = c.ptdvar_id INNER JOIN product_sub_category as a ON a.`pr_sub_id` = b.ptd_sub_catgry_id where year(d.delivery_date)='$yea'".$venQuery."".$bdQuery."";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}

	function getrenReport($year)
	{
		$trapdateprodct="SELECT a.pr_sub_id,d.re_month,d.rent_cost FROM mapping_table as d INNER JOIN product as c ON d.`product_id` = c.product_id INNER JOIN product_variant as b ON b.`ptdvar_id` = c.ptdvar_id INNER JOIN product_sub_category as a ON a.`pr_sub_id` = b.ptd_sub_catgry_id where d.re_year='$year'";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}
	function getrenReportF($yea,$r_ven,$r_bd)
	{
         if($r_ven == 0)
		 {
			 $venQuery ="";
		 }
         else
		 {
			 $venQuery ="AND c.vendor='$r_ven'";
		 }
		 if($r_bd == 0)
		 {
			 $bdQuery ="";
		 }
         else
		 {
			 $bdQuery ="AND c.brand='$r_bd'";
		 }


		$trapdateprodct="SELECT a.pr_sub_id,d.month as re_month,d.recived_rent_cost as rent_cost FROM rent_history as d INNER JOIN product as c ON d.`product_id` = c.product_id INNER JOIN product_variant as b ON b.`ptdvar_id` = c.ptdvar_id INNER JOIN product_sub_category as a ON a.`pr_sub_id` = b.ptd_sub_catgry_id where d.year='$yea'".$venQuery."".$bdQuery."";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;
	}
    function getCliRep($sta,$cit,$zon,$are,$age,$gen,$mar,$yea,$r_vint)
	{
		if($sta == 0)
		{
			$staQury="";
		}
		else
		{
			$staQury="AND state_id='$sta'";
		}
		if($cit == 0)
		{
			$citQury="";
		}
		else
		{
			$citQury="AND city_id='$cit'";
		}
		if($zon == 0)
		{
			$zonQury="";
		}
		else
		{
			$zonQury="AND zone_id='$zon'";
		}
		if($are == 0)
		{
			$areQury="";
		}
		else
		{
			$areQury="AND area_id='$are'";
		}
	    if(strlen($age) == 1)
		{

			$ageQury="";
		}
		else
		{
			$ageQury="AND age $age ";
		}
		 if($gen == 5)
		{

			$genQury="";
		}
		else
		{
			$genQury="AND gender= '$gen' ";
		}
		 if($mar == 3)
		{

			$marQury="";
		}
		else
		{
			$marQury="AND marital_status= '$mar' ";
		}

		if($r_vint == 0 )
		{
			$r_vint ="";
		}
		else {
			$r_vint = " AND  TIMESTAMPDIFF(
MONTH ,  `closed_on` ,  `doj` )   $r_vint ";
		}
		$trapdateprodct="SELECT count(customer_id) as cou,month from  customer_general_detail where year ='$yea'".$staQury."".$citQury." ".$zonQury."".$areQury."".$ageQury."".$genQury."".$marQury." ".$r_vint." GROUP BY month";
	    $dtrapdateprodct=$this->get_results( $trapdateprodct );
		return $dtrapdateprodct;

    }

	function deleteInvoice()
	{
		$delete = array('pending_security_amount' => 0);
		$deleted = $this->delete( 'invoice',$delete);
		if( $deleted )
		{
			return true;
		}
		return false;
	}
	function updteInvoiceSatus()
	{


  $closure_status=0;

		$update = array('invoice_status' =>'0');
				//Add the WHERE clauses
				$where_clause = array(
					'is_closure'     => $closure_status

				);
				$updated = $this->update_column('mapping_table', $update, $where_clause);
				if( $updated )
				{
					return true;
				}
				else
				{
					return false;
				}


	   }

	   function liveproductFn ($id)
	{
		$employeelist="SELECT product_id from  mapping_table where product_id ='$id' and is_closure=0";
		$employeelistdata = $this->get_results($employeelist);
		return $employeelistdata;
	}
	function isHaveMappedProductFn ($id)
{
 $employeelist="SELECT product_id from  mapping_table where customer_id='$id' and is_closure=0";
 $employeelistdata = $this->get_results($employeelist);
 return $employeelistdata;
}

   function getPendingCost ($id)
   {
    $employeelist="SELECT `received_total_rent_cost`  FROM `invoice` WHERE `customer_id`='$id'";
    $employeelistdata = $this->get_results($employeelist);
    return $employeelistdata;
  }

function getRentHistoryFn($customerid,$curMonth,$curYear)
{
	$employeelist="SELECT `id` FROM `rent_history` WHERE  `customer_id`='$customerid' and `month`='$curMonth' and `year`='$curYear'";
	$employeelistdata = $this->get_results($employeelist);
	return $employeelistdata;
}

function getMapProduct($customerid)
{


	$employeelist="SELECT  `product_id`,(rent_cost+tax) as total  FROM `mapping_table` WHERE `customer_id`='$customerid' and `mapped_status`=1 and `is_closure`=0";

	$employeelistdata = $this->get_results($employeelist);
	return $employeelistdata;
}

function getrenthistorydetailFn($customerid)
{
	$employeelist="SELECT `id`, `customer_id`, `product_id`, `month`, `year`, `rent_cost`, `recived_rent_cost` FROM `rent_history`  WHERE  `customer_id`='$customerid' and  rent_cost > recived_rent_cost" ;
	$employeelistdata = $this->get_results($employeelist);
	return $employeelistdata;
}

function mappedProductRent($serviceproductidclose)
{


	$employeelist="SELECT  `product_id`,(rent_cost+tax) as total,customer_id  FROM `mapping_table` WHERE `product_id`='$serviceproductidclose' and `is_closure`=0";

	$employeelistdata = $this->get_results($employeelist);
	return $employeelistdata;
}

}



?>
