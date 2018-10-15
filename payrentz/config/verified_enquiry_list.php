<?php
  require_once('config.php');
  session_start();
  $city = $_SESSION['city'] ;
  $enquiryIdList = $functs->verifiedEnquiryIdlistFn();
  $total_length =count($enquiryIdList);
  $output = array('data' => array());
  for ($x = 0; $x < $total_length; $x++)
  {
	  $id= $enquiryIdList [$x]["enquiry_id"];
    $type= $enquiryIdList[$x] ["customer_status"];
	  $enquiryData = $functs->verifiedEnquiryDataFn($id,$type);
    $mapedstatus = $functs->mapedStatusList($id);
	  if(count($mapedstatus)>0)
	  {
	   $assignedBy = $functs->empNameFn($enquiryData [4]);
	   $assignedTo = $functs->empNameFn($enquiryData [5]);
	   $enquiryData [6] ="Waiting For Mapping";
	   $enquiryData [3]= date("d-m-Y", strtotime($enquiryData [3]));
	   $output['data'][] = array($enquiryData [0], $enquiryData [1], $enquiryData [2],$enquiryData [3],is_array($assignedTo?$assignedTo["name"]:""),is_array($assignedBy?$assignedBy["name"]:""),$enquiryData [6],$enquiryData [7]);
	  }
  }
  for ($x = 0; $x < $total_length; $x++)
  {
	  $id= $enquiryIdList [$x]["enquiry_id"];
	  $type= $enquiryIdList[$x] ["customer_status"];
	  $enquiryData = $functs->verifiedEnquiryDataFn($id,$type);

    $mapedstatus = $functs->mapedStatusList($id);
	  $ismapeddata = $functs->ismaped($id);
	  $enquiryData[3]= (is_array($enquiryData)&&sizeof($enquiryData)>0)?date("d-m-Y", strtotime($enquiryData [3])):"";
	  if(count($mapedstatus) == 0 && is_array($enquiryData)&& sizeof($enquiryData)>5)
	  {
		  if(count($ismapeddata) == 0)
	    {
	      $assignedBy = $functs->empNameFn($enquiryData [4]);
	      $assignedTo = $functs->empNameFn($enquiryData [5]);

	      $enquiryData [6] ="Waiting For Mapping";
	      $output['data'][] = array($enquiryData [0], $enquiryData [1], $enquiryData [2],$enquiryData [3],$assignedTo["name"],$assignedBy["name"],$enquiryData [6],$enquiryData [7]);
      }
      else
      {
	      $assignedBy = $functs->empNameFn($enquiryData [4]);
	      $assignedTo = $functs->empNameFn($enquiryData [5]);
	      $enquiryData [6] ="Mapped";
	      $enquiryData [3]= date("d-m-Y", strtotime($enquiryData [3]));
	      $output['data'][] = array($enquiryData [0], $enquiryData [1], $enquiryData [2],$enquiryData [3],$assignedTo["name"],$assignedBy["name"],$enquiryData [6],$enquiryData [7]);
      }
	  }
  }
  echo json_encode($output);
?>
