<?php	
require_once('config.php'); 
 if($_POST["imagestype"] == 1)
 {	
		$type ="others";
		
		for($i=0; $i<$_POST["lengthofbill"]; $i++) {	
			move_uploaded_file($_FILES['file_'.$i]['tmp_name'], 'tempbillimages/' . $_FILES['file_'.$i]['name']);			
			$productimgdata = array('imagename'=>$_FILES['file_'.$i]['name'],'imagetype'=>$type);		
				$table_name='tempbill_images';
				$productimg_data = $functs->insertFn($table_name,$productimgdata);
				
		}			
}
 
 if($_POST["imagestype"] == 0)
 {	
		
		$type ="productimg";
		for($i=0; $i<$_POST["lengthofbill"]; $i++) {	
			move_uploaded_file($_FILES['file_'.$i]['tmp_name'], 'tempproductimages/' . $_FILES['file_'.$i]['name']);
			$productimgdata = array('imagename'=>$_FILES['file_'.$i]['name'],'imagetype'=>$type);		
				$table_name='tempbill_images';
				$productimg_data = $functs->insertFn($table_name,$productimgdata);
		}		
 }
 
 
 
?>