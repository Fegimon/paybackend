<?php
 
 require_once('config.php'); 
 
 @$type = $_POST['type'];
 @$sms = $_POST['sms']; 
 
 switch ($type) {
    case "vendoradd":
			@$vendor = $_POST['vendor'];   
			@$vendordescription = $_POST['vendordescription']; 
			@$statusvendor = $_POST['statusvendor']; 
			$getcustomername = $functs->addvendorname($vendor,$vendordescription,$statusvendor);
			echo json_encode($getcustomername);
			break;
			
    case "vendorlist":			
			$getvendorlist = $functs->getvendorlist();
			print json_encode($getvendorlist);
			break;
			
    case "deletevendorlist":
			@$vendorid = $_POST['vendorid'];   
			$deletevendor = $functs->deletevendorlist($vendorid);
			break;
			
	case "gotvendordetail":
			@$vendorid = $_POST['vendorid'];   
			$particularvendorlist = $functs->particularvendorlist($vendorid);
			echo json_encode($particularvendorlist);
			break;
			
	case "editvendordetail":
			@$vendorid = $_POST['vendorid'];   
			@$vendorname = $_POST['vendorname'];   
			@$editvendordescription = $_POST['editvendordescription'];
			@$editstatusvendor = $_POST['editstatusvendor'];
			$editvendorlist = $functs->editvendorlist($vendorid,$vendorname,$editvendordescription,$editstatusvendor);			
			break;
			
	//Nativity Add
	
	case "nativityadd":
			@$nativity = $_POST['nativity'];   
			@$nativitydescription = $_POST['nativitydescription']; 
			@$statusnativity = $_POST['statusnativity']; 
			$getnativityname = $functs->addnativityname($nativity,$nativitydescription,$statusnativity );			
			echo json_encode($getnativityname);
			break;
	
	case "nativitylist":			
			$gotnativitylist = $functs->getnativitylist();
			print json_encode($gotnativitylist);
			break;
	
	case "deletenativitylist":
			@$nativityid = $_POST['nativityid'];   
			$deletenativity = $functs->deletenativitylist($nativityid);
			break;
	
	case "gotnativitydetail":
			@$nativityid = $_POST['nativityid'];   
			$particularnativitylist = $functs->particularnativitylist($nativityid);
			echo json_encode($particularnativitylist);
			break;
		
	case "editnativitydetail":
			@$nativityid = $_POST['nativityid'];   
			@$nativityname = $_POST['nativityname'];   
			@$editnativitydescription = $_POST['editnativitydescription'];   
			@$editstatusnativity = $_POST['editstatusnativity'];
			$editnativitylist = $functs->editnativitylist($nativityid,$nativityname,$editnativitydescription ,$editstatusnativity);			
			break;
		
	case "statelist":			
			$statelist = $functs->getstatelist();
			print json_encode($statelist);
			break;
	
	case "citylist":	
			@$stateid = $_POST['stateid'];
			$citylist = $functs->getcitylist($stateid);
			print json_encode($citylist);
			break;
			
	case "zoneadd":
			@$zonecity = $_POST['zonecity'];   
			@$zoneid = $_POST['zoneid']; 
			@$zonedescription = $_POST['zonedescription'];   
			@$statuszone = $_POST['statuszone']; 			
			$getaddzonename = $functs->addzonename($zonecity,$zoneid,$zonedescription,$statuszone);
			echo json_encode($getaddzonename);
			break;
	
	case "editzonecitylist":				
			$editcitylist = $functs->geteditzonecitylist();
			print json_encode($editcitylist);
			break;
		
	 case "zonelist":			
			$getzonelist = $functs->getzonelist();
			print json_encode($getzonelist);
			break;
	
	case "deletezonelist":
			@$zoneid = $_POST['zoneid'];   
			$deletezone = $functs->deletezonelist($zoneid);
			break;
	
	case "gotzonedetail":
			@$zoneid = $_POST['zoneid'];   
			$particularzonelist = $functs->particularzonelist($zoneid);
			echo json_encode($particularzonelist);
			break;
	
	case "editzonedetail":
			@$editzoneid = $_POST['editzoneid'];   
			@$zoneeditid = $_POST['zoneeditid'];   
			@$zoneeditcity = $_POST['zoneeditcity']; 
			@$editzonedescription = $_POST['editzonedescription'];   
			@$editstatuszone = $_POST['editstatuszone'];			
			$editzonelist = $functs->editzonelist($editzoneid,$zoneeditid,$zoneeditcity,$editzonedescription,$editstatuszone );			
			break;
			
	case "productadd":
			@$pcategory = $_POST['pcategory'];   
			@$productdescription = $_POST['productdescription'];  
			@$statusproduct = $_POST['statusproduct'];  
			$addproductname = $functs->addproductname($pcategory,$productdescription,$statusproduct);
			echo json_encode($addproductname);
			break;
	
	case "productcatlist":			  
			$productcatlist = $functs->productcatlist();
			echo json_encode($productcatlist);
			break;
	
	case "deleteproductlist":
			@$productid = $_POST['productid'];   
			$deleteproduct = $functs->deleteproductlist($productid);
			break;
	
	case "gotproductdetail":
			@$productid = $_POST['productid'];   
			$particularproductlist = $functs->particularproductlist($productid);
			echo json_encode($particularproductlist);
			break;
	
	case "editproddetail":
			@$editpid = $_POST['editpid'];   
			@$editpcategory = $_POST['editpcategory'];   
			@$editstatusproduct = $_POST['editstatusproduct']; 
			@$editproductdescription = $_POST['editproductdescription'];   			
			$editzonelist = $functs->editprodcutlist($editpid,$editpcategory,$editproductdescription,$editstatusproduct);			
			break;
	
	case "subcatgdd":
			@$maincategorylist = $_POST['maincategorylist'];   
			@$subcategoryname = $_POST['subcategoryname'];  
			@$subcatdescription = $_POST['subcatdescription'];  
			@$subcatstatus = $_POST['subcatstatus'];  
			@$cgst = $_POST['cgst']; 
			@$sgst = $_POST['sgst']; 
			@$igst = $_POST['igst']; 
			@$ugst = $_POST['ugst']; 
			@$cess = $_POST['cess']; 
			$addproductname = $functs->addsubproduct($maincategorylist,$subcategoryname ,$subcatdescription,$subcatstatus,$cgst,$sgst,$igst,$ugst,$cess);
			echo json_encode($addproductname);
			break;
	
	case "selectmaincategory":			
			$categrylist = $functs->getmaincatlist();
			print json_encode($categrylist);
			break;
	
	case "productsubcatlist":			  
			$productsubcatlist = $functs->productsubcatlist();
			echo json_encode($productsubcatlist);
			break;
	
	case "deletesubcatproductlist":
			@$subproductid = $_POST['subproductid'];   
			$deletesubproduct = $functs->deletesubcatproductlist($subproductid);
			break;
			
	case "gotsubproductdetail":
			@$subproductid = $_POST['subproductid'];   
			$particularsubcatlist = $functs->particularsubcatlist($subproductid);
			echo json_encode($particularsubcatlist);
			break;
	
	case "editsubcatproddetail":
			@$editcatid = $_POST['editcatid'];   
			@$editsubcategoryname = $_POST['editsubcategoryname'];   
			@$editsubcatdescription = $_POST['editsubcatdescription']; 
			@$editsubcatstatus = $_POST['editsubcatstatus'];   	
            @$cgst = $_POST['cgst']; 
			@$sgst = $_POST['sgst']; 
			@$igst = $_POST['igst']; 
			@$ugst = $_POST['ugst']; 
			@$cess = $_POST['cess']; 		
			$editzonelist = $functs->editsubcatprodcutlist($editcatid,$editsubcategoryname,$editsubcatdescription,$editsubcatstatus,$cgst,$sgst,$igst,$ugst,$cess);			
			break;
			
	case "brandadd":			  
			@$brand = $_POST['brand'];  
			@$addbranddescr = $_POST['addbranddescr'];  
			@$addbrandstatus = $_POST['addbrandstatus'];  
			$addproductname = $functs->addbrandname($brand,$addbranddescr,$addbrandstatus);
			echo json_encode($addproductname);
			break;
			
	case "brandlist":			  
			$brandlist = $functs->brandlist();
			echo json_encode($brandlist);
			break;
	
	case "deletebrandlist":
			@$brandid = $_POST['brandid'];   
			$deletebranda = $functs->deletebrandlist($brandid);
			break;
	
	case "editbrand":
			@$brandid = $_POST['brandid'];   
			$particularbranch = $functs->particularbranch($brandid);
			echo json_encode($particularbranch);
			break;
	
	case "editbranddetails":
			@$editidbrand = $_POST['editidbrand'];   
			@$editbrand = $_POST['editbrand'];   
			@$editaddbranddescr = $_POST['editaddbranddescr']; 
			@$editaddbrandstatus = $_POST['editaddbrandstatus'];   			
			$editbranch = $functs->editbrandlist($editidbrand,$editbrand,$editaddbranddescr,$editaddbrandstatus);			
			break;
	
	case "addstates":
			@$stateid = $_POST['stateid'];   
			@$statedescription = $_POST['statedescription'];  
			@$statusstate = $_POST['statusstate'];  
			$addstates = $functs->addstates($stateid,$statedescription,$statusstate);
			echo json_encode($addstates);
			break;
	
	case "deletestate":
			@$id = $_POST['id'];   
			$deletestate = $functs->deletestatelist($id);
			break;
	
	case "editstate":
			@$id = $_POST['id'];   
			$particularstatelist = $functs->particularstatelist($id);
			echo json_encode($particularstatelist);
			break;
	
	case "editstatedetails":
			@$editstateid = $_POST['editstateid'];   
			@$editstatename = $_POST['editstatename'];   
			@$editstatedescription = $_POST['editstatedescription']; 
			@$editstatusstate = $_POST['editstatusstate'];   			
			$editbranch = $functs->editstatelist($editstateid,$editstatename,$editstatedescription,$editstatusstate);			
			break;
	
	case "addcities":
			@$cityname = $_POST['cityname'];   
			@$statename = $_POST['statename'];
			@$citydescription = $_POST['citydescription'];  
			@$statuscity = $_POST['statuscity'];  
			$addcities = $functs->addcities($cityname,$statename,$citydescription,$statuscity);
			echo json_encode($addcities);
			break;
	
	case "deletecities":
			@$id = $_POST['id'];   
			$deletecity = $functs->deletecitylist($id);
			break;
			
	case "editcity":
			@$cityid = $_POST['id'];   
			$particularcity = $functs->particularcity($cityid);
			echo json_encode($particularcity);
			break;
	
	case "editcitydetails":
			@$editcityid = $_POST['editcityid'];   
			@$editcityname = $_POST['editcityname'];   
			@$editcitydescription = $_POST['editcitydescription']; 
			@$editcitystate = $_POST['editcitystate'];   			
			$editbranch = $functs->editcitylist($editcityid,$editcityname,$editcitydescription,$editcitystate);			
			break;
	
	case "addemployee":
			@$empyname = $_POST['empyname'];   
			@$empymbl = $_POST['empymbl'];  
			@$empemail = $_POST['empemail'];  
			@$empdesignation = $_POST['empdesignation'];
			$addemployee = $functs->addemployee($empyname,$empymbl,$empemail,$empdesignation);
			echo json_encode($addemployee);
			break;
	
	case "gotemployeedetails":			  
			$gotemployeedetails = $functs->gotemployeedetails();
			echo json_encode($gotemployeedetails);
			break;
		
	case "deleteemployee":
			@$id = $_POST['id'];   
			$deleteemployeelist = $functs->deleteemployeelist($id);
			break;
		
	case "editemployee":
			@$id = $_POST['id'];   
			$particularemployee = $functs->particularemployee($id);
			echo json_encode($particularemployee);
			break;
		
	case "editemployeedetails":
			@$editempyname = $_POST['editempyname'];   
			@$editempymbl = $_POST['editempymbl'];   
			@$editempyid = $_POST['editempyid']; 
			@$editempemail = $_POST['editempemail'];
			@$editempdesignation = $_POST['editempdesignation'];   			
			$editbranch = $functs->editemployeelist($editempyid,$editempyname,$editempymbl,$editempemail,$editempdesignation);			
			break;
	
	case "companyadd":
			@$companyname = $_POST['companyname'];   
			@$cmpydesc = $_POST['cmpydesc'];  
			@$companystatus = $_POST['companystatus'];  			
			$addaddcompany = $functs->addcompany($companyname,$cmpydesc,$companystatus);
			echo json_encode($addaddcompany);
			break;
	
	case "companylist":			  
			$copylist = $functs->copylist();
			echo json_encode($copylist);
			break;	
	
	case "deletecompany":
			@$id = $_POST['id'];   
			$deleteemployeelist = $functs->deletecompanylist($id);
			break;
			
	case "editcompany":
			@$id = $_POST['id'];   
			$particularemployee = $functs->particularcompany($id);
			echo json_encode($particularemployee);
			break;
	
	case "editcompanydetails":
			@$editcompanyid = $_POST['editcompanyid'];   
			@$editcompanyname = $_POST['editcompanyname'];   
			@$editcmpydesc = $_POST['editcmpydesc']; 
			@$editcompanystatus = $_POST['editcompanystatus'];			
			$editcompnylist = $functs->editcompnylist($editcompanyid,$editcompanyname,$editcmpydesc,$editcompanystatus);			
			break;
			
	case "addvariant":
			@$subcategoryproduct = $_POST['subcategoryproduct'];   
			@$variantname = $_POST['variantname'];  
			@$verantdesct = $_POST['verantdesct'];  			
			@$rendcost = $_POST['rendcost'];
			@$depositeamnt = $_POST['depositeamnt'];  
			@$processingfees = $_POST['processingfees'];  
			@$inscost = $_POST['inscost'];
			@$otherfee = $_POST['otherfee'];
			@$statusvariant = $_POST['statusvariant'];
			$addvariant = $functs->addvariant($subcategoryproduct,$variantname,$verantdesct,$rendcost,$depositeamnt,$processingfees,$inscost,$otherfee,$statusvariant);
			echo json_encode($addvariant);
			break;
	
	case "gotsubcategory":	
			@$mainid = $_POST['mainid'];
			$subcategorylist = $functs->subcategorylist($mainid);
			print json_encode($subcategorylist);
			break;
	
	case "variantlist":			  
			$variantlist = $functs->variantlist();
			echo json_encode($variantlist);
			break;
			
	case "deletevariant":
			@$id = $_POST['id'];   
			$deletevariant = $functs->deletevariant($id);
			break;
		
	case "editvariant":
			@$id = $_POST['id'];   
			$particularvariant = $functs->particularvariant($id);
			echo json_encode($particularvariant);
			break;
	
	case "editvariantdetails":
			@$editvariantid = $_POST['editvariantid'];   
			@$editvariantname = $_POST['editvariantname'];   
			@$editverantdesct = $_POST['editverantdesct']; 
			@$editstatusvariant = $_POST['editstatusvariant'];			
			@$editrendcost = $_POST['editrendcost'];   
			@$editdepositeamnt = $_POST['editdepositeamnt'];   
			@$editprocessingfees = $_POST['editprocessingfees']; 
			@$editinscost = $_POST['editinscost'];	
			@$editotherfee = $_POST['editotherfee'];			
			$editcompnylist = $functs->editvariantlist($editvariantid,$editvariantname,$editverantdesct,$editstatusvariant,
			$editrendcost,$editdepositeamnt,$editprocessingfees,$editinscost,$editotherfee);
			echo json_encode($editcompnylist);			
			break;
	
	case "areazonelist":	
			@$cityid = $_POST['cityid'];
			$areazonelist = $functs->areazonelist($cityid);
			print json_encode($areazonelist);
			break;
			
	case "addarea":
			@$areazone = $_POST['areazone'];   
			@$area = $_POST['area'];  
			@$areadescription = $_POST['areadescription'];  			
			@$statusarea = $_POST['statusarea'];  			
			$addarea = $functs->addarea($areazone,$area,$areadescription,$statusarea);
			echo json_encode($addarea);
			break;
			
	case "arealist":			  
			$arealist = $functs->arealist();
			echo json_encode($arealist);
			break;	
	
	case "deletearea":
			@$id = $_POST['id'];   
			$deletearea = $functs->deletearea($id);
			break;
			
	case "editarea":
			@$id = $_POST['id'];   
			$particulararea = $functs->particulararea($id);
			echo json_encode($particulararea);
			break;
			
	case "editareadetails":
			@$areaid = $_POST['areaid'];   
			@$editarea = $_POST['editarea'];   
			@$editareadescription = $_POST['editareadescription']; 
			@$editstatusarea = $_POST['editstatusarea'];			
			$editareadetls = $functs->editareadetls($areaid,$editarea,$editareadescription,$editstatusarea);			
			break;

	case "rendvendorlist":			
			$getrentvendorlist = $functs->getrentvendorlist();
			print json_encode($getrentvendorlist);
			break;
                        case "sms":			
			$sms= $functs->getsms();
			print json_encode($sms);
			break;

                        case "smsSave":			
			$update_data = array("description"=>$sms);
                        $where_con = array( "id"=> 1);
                        $table_name='sms_content';
                        $functs->updateTableFn($update_data,$where_con,$table_name);  
			print("smsSave");
			break;

	
	
    default:
			echo "Your favorite color is neither red, blue, nor green!";
}
 



?>