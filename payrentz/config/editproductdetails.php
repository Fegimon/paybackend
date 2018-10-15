<?php
 
 require_once('config.php'); 
	 //print_r($_POST);
		print_r($_FILES);
 
			@$category = $_POST['editprosubcategoryproduct'];   			 
			@$variant = $_POST['editproproductvariant'];
			@$brand = $_POST['editproproductbrand'];   			 
			@$vendor = $_POST['editprovendorbrand'];			
			@$purchasedate = $_POST['editpropurchasedate'];   			 
			@$purchase_value = $_POST['editpropurchase_value'];
			@$other_charge = $_POST['editproother_charge'];   			 
			@$serialno = $_POST['editproserialno'];
			@$warrantydate = $_POST['editprowarrantydate'];   			 
			@$billnumber = $_POST['editprobillnumber'];
			@$ownedtype = $_POST['editproownedtype'];   			 
			@$location = $_POST['editprolocation'];  
			@$vendorthird = $_POST['editprovendorthird'];
			@$rentpurchasedate = $_POST['editprorentpurchasedate'];   			 
			@$rentpurchase_value = $_POST['editprorendpurchase_value'];			
			@$cityproduct = $_POST['editprocityproduct'];
			@$editproductid = $_POST['editproductid'];
   

		$categorydes="SELECT description from product_sub_category where pr_sub_id = $category";		
		$categorydesdata = $functs->get_results($categorydes);
		$prductcategorydes = $categorydesdata[0]["description"];
		
		$variantdes="SELECT variant_code from product_variant where ptdvar_id = $variant";		
		$variantdesdata = $functs->get_results($variantdes);
		$prductvariantdes = $variantdesdata[0]["variant_code"];
				
		$branddes="SELECT description from brand where brand_id = $brand";		
		$branddesdata = $functs->get_results($branddes);
		$prductbranddes = $branddesdata[0]["description"];
		
		$vendordes="SELECT description from vendor where vendor_id = $vendor";		
		$vendordesdata = $functs->get_results($vendordes);
		$prductvendordes = $vendordesdata[0]["description"];
		

		$serialno = substr($serialno, -4);
		$lastproductid = substr($editproductid, -4);

		$purchasedate = explode('-', $purchasedate);
		$year = $purchasedate[0];
		$month   = $purchasedate[1];
		$date  = $purchasedate[2];
		$year = (int)$year;
		$month = (int)$month;
		$year = substr($year, -2);
	

		if($month == 12)
		{
			$month = 'D';
		}
		else if($month == 11)
		{
			$month = 'N';
		}
		else if($month == 10)
		{
			$month = 'O';
		}
		
		$productid = $cityproduct.$prductcategorydes.$serialno.$prductvariantdes.$prductbranddes.$prductvendordes.$date.$month.$year.$lastproductid ;
		
		echo $productid;
		
		
		
		
		if ($_FILES['editbillimages']['name'][0] != '') 
		{
			$billtotal = count($_FILES['editbillimages']['name']);
			if($billtotal > 0)
			{
				$fileToDelete = glob(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/others/*');
					foreach($fileToDelete as $file){ 
					if(is_file($file))
					unlink($file); 
					}
				rmdir(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/others/');			
				mkdir(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/others/', 0777, true);				
				$deleteothers = array('productkey' => $editproductid,'file_type'=>'others');
				$deletedothers = $functs->delete( 'product_image', $deleteothers, 1 );					
				for($i=0; $i<$billtotal; $i++) {		  
					$billtmpFilePath = $_FILES['editbillimages']['tmp_name'][$i];		  
					if ($billtmpFilePath != ""){			
						$billnewFilePath ='../Documents/product/' . $editproductid . '/others/' . $_FILES['editbillimages']['name'][$i];			
						move_uploaded_file($billtmpFilePath, $billnewFilePath);			
					}
				}	
			}	
		}		
        
		if ($_FILES['editproductimages']['name'][0] != '') 
		{			
			$total = count($_FILES['editproductimages']['name']);			
			if($total > 0)
			{
					$fileToDelete = glob(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/productimages/*');
					foreach($fileToDelete as $file){ 
					if(is_file($file))
					unlink($file); 
					}
				
				rmdir(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/productimages/');
				mkdir(dirname(__FILE__) . '/../Documents/product/' . $editproductid . '/productimages/', 0777, true);
				$deleteproductimg = array('productkey' => $editproductid,'file_type'=>'productimg');
				$deletedproductimg = $functs->delete( 'product_image', $deleteproductimg, 1 );
				
				for($i=0; $i<$total; $i++) {		  
				$tmpFilePath = $_FILES['editproductimages']['tmp_name'][$i];		  
				if ($tmpFilePath != ""){			
				$newFilePath ='../Documents/product/' . $editproductid . '/productimages/' . $_FILES['editproductimages']['name'][$i];			
				move_uploaded_file($tmpFilePath, $newFilePath);
				}
				}
			}
		}
		
		rename(dirname(__FILE__) . '/../Documents/product/'.$editproductid.'/',dirname(__FILE__) . '/../Documents/product/'.$productid.'/');
		
		if ($_FILES['editbillimages']['name'][0] != '') 
		{	
			$billtotal = count($_FILES['editbillimages']['name']);
			for($i=0; $i<$billtotal; $i++) {					
					$productuploadpath = '/others/'. $_FILES['editbillimages']['name'][$i];	
					$productuploadimg = $_FILES['editbillimages']['name'][$i];
					$productimgdata = array('image_name' => $productuploadimg,'image_path' => $productuploadpath,'status' =>0,'productkey' =>$productid,
					'file_type' => 'others');
					$table_name='product_image';
					$productimg_data = $functs->insertFn($table_name,$productimgdata);					
				}
		}
		else
		{
			
			$update = array('productkey' => $productid);				
			$where_clause = array(
				'productkey'=> $editproductid
			);	
			$billupdated = $functs->update('product_image', $update, $where_clause);
			
			
		}
		
		
		if ($_FILES['editproductimages']['name'][0] != '') 
		{			
			$total = count($_FILES['editproductimages']['name']);
			for($i=0; $i<$total; $i++) {		  		  
				$productuploadpath = '/productimages/'. $_FILES['editproductimages']['name'][$i];	
				$productuploadimg = $_FILES['editproductimages']['name'][$i];
				$productimgdata = array('image_name' => $productuploadimg,'image_path' => $productuploadpath,'status' =>0,'productkey' =>$productid,
				'file_type' => 'productimg');
				$table_name='product_image';
				$productimg_data = $functs->insertFn($table_name,$productimgdata);							
			}
		}
		else
		{
			
			$update = array('productkey' => $productid);				
			$where_clause = array(
				'productkey'=> $editproductid
			);	
			$billupdated = $functs->update('product_image', $update, $where_clause);
			
			
		}
		
		
		
		if($ownedtype == 0)
		{			
			$vendorthird = $vendorthird;
			$rentpurchasedate = $rentpurchasedate;
			$rentpurchase_value = $rentpurchase_value;
		}
		else
		{			
			$vendorthird = 0;
			$rentpurchasedate = 0000-00-00;
			$rentpurchase_value = 0;
		}
		
		//Update product details		
		$update = array('product_id' => $productid, 'ptdvar_id' => $variant,'brand' => $brand,'purchase_type' => $ownedtype,
		'prtd_location' =>$location,'vendor'=>$vendor, 'sl_no' => $_POST['editproserialno'], 'purchase_date' => $_POST['editpropurchasedate'],
		'purchase_cost'=>$purchase_value,'expenses'=>$other_charge,'rent_vendor'=>$vendorthird,'rent_purchase_date'=>$rentpurchasedate,
		'rent_to_vendor_cost'=>$rentpurchase_value,'bill_no'=> $billnumber, 'warranty_end_date'=> $warrantydate,
		'warranty_status'=>0);				
		$where_clause = array(
				'product_id'=> $editproductid
		);
		$updated = $functs->update('product', $update, $where_clause);
			
	
?>