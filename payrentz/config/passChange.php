<?php
 require_once('config.php'); 
 
   
 $pass = $_POST['pass'];
 $username = $_POST['user'];
 
         $update_data = array('password' =>$pass);
		 $where_con = array('user_name' =>$username);
         $table_name='admin_account';
         $functs->updateTableFn($update_data,$where_con,$table_name);
 
 
?>