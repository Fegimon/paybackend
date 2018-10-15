<?php

require_once('config.php'); 
 session_start();
 @$type_name = $_POST['type_name'];
 if($type_name == '1'){
   $nativity = $functs->getNativity();
   echo json_encode($nativity);
   exit;
      }
 if($type_name == '2'){
   $state = $functs->getState();
   echo json_encode($state);
   exit;
      }
  if($type_name == '3'){
   @$state_id = $_POST['state_id'];
   $city = $functs->getCity($state_id);
   echo json_encode($city );
   exit;
      }
   if($type_name == '4'){
   @$city_id = $_POST['city_id'];
   $zone = $functs->getZone($city_id);   
   echo json_encode($zone);   
   exit;   
   }   
   if($type_name == '5'){
   @$zone_id = $_POST['zone_id'];
   $area = $functs->getArea($zone_id);   
   echo json_encode($area);   
   exit;   
   }   
?>