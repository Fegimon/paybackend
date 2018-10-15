<?php
  require_once('config.php');
  session_start();
  $city = $_SESSION['city'] ;
  $enquiryIdList = $functs->re_enquiryIdlistFn();
  $total_length =count($enquiryIdList);
  $output = array('data' => array());
  for ($x = 0; $x < $total_length; $x++)
  {
	  $id= $enquiryIdList [$x]["enquiry_id"];
	  $type= $enquiryIdList[$x] ["customer_status"];
	  $enquiryData = $functs->rejectedEnquiryDataFn($id,$type);
	  if(count($enquiryData)>0)
	  {
	     $assignedBy = $functs->empNameFn($enquiryData [4]);
	     $assignedTo = $functs->empNameFn($enquiryData [5]);
	     $enquiryData [3]= date("d-m-Y", strtotime($enquiryData [3]));
		   $output['data'][] = array($enquiryData [0], $enquiryData [1], $enquiryData [2],$enquiryData [3],is_array($assignedTo?$assignedTo["name"]:""),is_array($assignedBy?$assignedBy["name"]:""),$enquiryData [6],$enquiryData [7]);
     }
	   else
	    {

      }
    }
    echo json_encode($output);
?>
