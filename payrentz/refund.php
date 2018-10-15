<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">

			<h1>Refund</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Refund</li>
			</ol>
		</section>

			 <!-- <div class="row searchspace">
                
                /.col-lg-6 -->
                <!-- <div class="col-lg-4 pull-right">
<div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
                </div> -->
                <!-- /.col-lg-6
              </div>  -->
			    
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
        	<section class="col-lg-12 ">
				<section class="col-lg-12 " id="Customer_tab_view">
			<div class=" searchspace" >
			
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','refund')">
               <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>    Refund Product
			   </button>
			  
			 </div>
			
			
			<div class="box box-info">
            <div class="box-header with-border">
              
 
            <!--  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <!-- /.box-header -->
			
			
            <div class="box-body" id="listofproductable">
			
					
              <div class="table-responsive">

					
               

    
             
       <table id="mappedList" class="display" cellspacing="0" width="100%">
				 <thead>
					  <tr>
						 <th><input name="select_all" value="1" type="checkbox"></th>
						 <th>Product ID</th>
						 <th>Customer ID</th>
<th>Mobile</th>
						 <th>Closure Date</th>
						
						 <th>Action</th>
					  </tr>
				  </thead>
				  <tfoot>
					  <tr>
						 <th></th>
						 <th>Product ID</th>
						 <th>Customer ID</th>
<th>Mobile</th>
						 <th>Closure Date</th>
						
						
						 <th>Action</th>
					  </tr>
				  </tfoot>
				
			    </table>
       
           










              </div>
              <!-- /.table-responsive -->
            </div>

             <div class="box-body" id="viewdetailsshow" hidden>
              <form class="form-horizontal" id="productviewform">
              <div class="box-body">
              
        <div class="row">
        <div class="col-lg-12 ">
           <div class="form-group">
              <div class="col-sm-12 pull-right" id="imagediv">                
              </div>
            </div>
        
          </div>
        </div>

        <div class="form-group">
                  <label for="product_category" class="col-sm-4 control-label">Product Category</label>
                  <div class="col-sm-7">
           <input type="text" class="form-control" id="product_category" value="" disabled>
                   </div>       
                </div>
        
        
                <div class="form-group">
                  <label for="variant" class="col-sm-4 control-label">Variant</label>
                  <div class="col-sm-7">
          <input type="text" class="form-control" id="viewvariant" value="" disabled>
                  </div>        
                </div>


                <div class="form-group">
                  <label for="brand" class="col-sm-4 control-label">Brand</label>
                  <div class="col-sm-7">
          <input type="text" class="form-control" id="viewbrand" value="" disabled>
                  </div>        
                </div>    
        
        <div class="form-group">
                  <label for="" class="col-sm-4 control-label">Type</label>
                 <div class="col-sm-7">
                   <input type="text" class="form-control" id="viewowned" value="" disabled>
                  </div>        
                </div>    
        
                <div class="form-group">
                  <label for="vendor" class="col-sm-4 control-label">Vendor</label>
                  <div class="col-sm-7">
          <input type="text" class="form-control" id="viewvendor" value="" disabled>
                   </div>       
                </div>  
 
        
                <div class="form-group">
                  <label for="datepicker6" class="col-sm-4 control-label">Date of Purchase</label>

                  <div class="col-sm-7">
                    <input type="text" class="form-control pull-right" id="viewpurchasedate" value="" disabled >
                  </div>
                </div>
        
        
                <div class="form-group">
                  <label for="purchase_value" class="col-sm-4 control-label">Purchase Value</label>

                 <div class="col-sm-7">
                    <input type="text" class="form-control" id="viewpurchase_value" value="" disabled>
                  </div>
                </div>  

  
                <div class="form-group">
                  <label for="other_charge" class="col-sm-4 control-label">Other Charges</label>

                 <div class="col-sm-7">
                    <input type="text" class="form-control" id="viewother_charge" value="" disabled>
                  </div>
                </div>                
        
        
                <div class="form-group">
                  <label for="serialno" class="col-sm-4 control-label">Manufacturer's Serial No</label>

                 <div class="col-sm-7">
                    <input type="text" class="form-control" id="viewserialno" value="" disabled>
                  </div>
                </div>                
        

                <div class="form-group">
                  <label for="datepicker7" class="col-sm-4 control-label">Warranty Period</label>

                  <div class="col-sm-7">
                    <input type="date" class="form-control pull-right" id="viewwarranty" value="" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label for="billnumber" class="col-sm-4 control-label">Bill Number</label>

                 <div class="col-sm-7">
                    <input type="text" class="form-control" id="viewbillnumber" value="" disabled>
                  </div>
                </div>  

        <div class="form-group">
                  <label for="" class="col-sm-4 control-label">Location</label>
                    <div class="col-sm-7">
            <input type="text" class="form-control" id="viewlocation" value="" disabled>
                  </div>
                </div>
        
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

             <!--  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
      
      <div class="form-group">
                  <label for="tenure1" class="col-sm-3 control-label">Tenure</label>
                  <div class="col-sm-9">
          <input type="text" class="form-control" id="viewtenure" value="" disabled>
                  </div>
                </div>
      
      <div class="form-group">
                  <label for="rent" class="col-sm-3 control-label">Rent</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="viewrent"  value="" disabled>
                  </div>
                </div>                
        
        
                <div class="form-group">
                  <label for="processing_fee" class="col-sm-3 control-label">Processing Fee</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="viewprocessing_fee"  value="" disabled>
                  </div>
                </div>                
        
        
                <div class="form-group">
                  <label for="security_deposit" class="col-sm-3 control-label">Security Deposit</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="viewsecurity_deposit"  value="" disabled>
                  </div>
                </div>        
                <div class="col-lg-12">
                         <button type="submit" class="btn btn-info" onclick="showtablehideview()">Back</button> 
                 </div>
            
            </div>

          </div>
        
 
        
           </div> 
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>
            </div>
 

          <!--Edit-->
          <div class="box-body" id="editdetailsshow" hidden>

          <div class="col-sm-12 pull-right" id="editimagediv">                
              </div>

              <form class="form-horizontal" id="editproductupdateform">
              <div class="box-body">
                 <div class="row">           
                 <div class="col-lg-3">
            <div class="form-group">
              <label for="" class="col-sm-12 control-label">Bill Upload</label>
                <div class="col-sm-6">                  
                <div style="height:100px; border: 1px solid #ccc;overflow: auto;" id="imageothers"></div><br/>          
                <input type="file" class="inputfile" id="uploadeditbillimages" name="editbillimages[]" multiple/> 
                <label for="file"><i class="fa fa-upload" aria-hidden="true"></i></label> 
				<div id="ebillimgerror" class="error"></div>													
              </div>
              <div class="col-sm-6">
                <div style="height:100px; border: 1px solid #ccc;overflow: auto;" id="dispyproductimages"></div><br/>         
                <input type="file" class="inputfile" name="editproductimages[]" id="uploadeditproductimages" multiple/> 
                <label for="file"><i class="fa fa-upload" aria-hidden="true"></i></label> 
				<div id="eproductimgerror" class="error"></div>													
              </div>
            </div>        
          </div>  
        <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="maincategorylist" class="col-sm-12 control-label">Product Category</label>
              <div class="col-sm-12">
              <select class="form-control" name="editprocategorylist" id="editprocategorylist" onchange="editproductgetsubcategory(this.value);">  </select>
              </div>        
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="variant" class="col-sm-12 control-label">Sub Category</label>           
               <div class="col-sm-12">
              <select class="form-control" name="editprosubcategoryproduct" id="editprosubcategoryproduct" onchange="editproductvariantlist(this.value)"></select>
			  <div id="esubcategoryerror" class="error"></div>	
              </div>
            </div>
            </div>
        
          <div class="col-lg-3">
            <div class="form-group">
              <label for="productvariant" class="col-sm-12 control-label">Variant</label>
              <div class="col-sm-12">
              <select class="form-control" name="editproproductvariant" id="editproproductvariant" onchange="editproductprdvariantlistdetails(this.value)">  </select>
              <input type="hidden" name="editproductid" id="editproductid">
			  <div id="evarianterror" class="error"></div>	
              </div>        
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="productbrand" class="col-sm-12 control-label">Brand</label>
              <div class="col-sm-12">
              <select class="form-control" name="editproproductbrand" id="editproproductbrand"> </select>
              </div>        
            </div>    
          </div>    
          
            
        </div>  
        
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="" class="col-sm-12 control-label">Type</label>
             <div class="radio">
              <label>
                <input type="radio" name="editproownedtype" id="optionsRadios1" class="editproownedtype" value="1 own" checked>
                Owned
              </label>
               <label>
                <input type="radio" name="editproownedtype" id="optionsRadios2" class="editproownedtype" value="0 third">
                Third Party
              </label>
              </div>        
            </div>    
          </div>  
          <div class="col-lg-3">
            <div class="form-group">
              <label for="editprovendorbrand" class="col-sm-12 control-label">Vendor</label>
              <div class="col-sm-12">
              <select class="form-control" name="editprovendorbrand" id="editprovendorbrand"> </select>              
              </div>        
            </div>  
          </div>  

          <div class="col-lg-3">
            <div class="form-group">
              <label for="editpropurchasedate" class="col-sm-12 control-label">Date of Purchase</label>

              <div class="col-sm-12">
              <input type="date" class="form-control pull-right" name="editpropurchasedate"  id="editpropurchasedate" placeholder="dd/mm/yyyy">
			  <div id="epdateerror" class="error"></div>									
              </div>
            </div>
          </div>
        
          <div class="col-lg-3">
            <div class="form-group">
              <label for="editpropurchase_value" class="col-sm-12 control-label">Purchase Value</label>

             <div class="col-sm-12">
              <input type="text" class="form-control" id="editpropurchase_value" name="editpropurchase_value" placeholder="Purchase Value">
			  <div id="epvalueerror" class="error"></div>									
              </div>
            </div>  
          </div>  
            

          
        </div>
          
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="editproother_charge" class="col-sm-12 control-label">Other Charges</label>

             <div class="col-sm-12">
              <input type="text" class="form-control" id="editproother_charge" name="editproother_charge" placeholder="Other Charges">
			  <div id="eotherchargeerror" class="error"></div>									
              </div>
            </div>                
          </div>    
          <div class="col-lg-3">
            <div class="form-group">
              <label for="editproserialno" class="col-sm-12 control-label">Manufacturer's Serial No</label>

             <div class="col-sm-12">
              <input type="text" name="editproserialno" class="form-control" id="editproserialno" placeholder="Manufacturer's Serial No">
			  <div id="emsnerror" class="error"></div>									
              </div>
            </div>                
          </div>                
        
          <div class="col-lg-3">
            <div class="form-group">
              <label for="editprowarrantydate" class="col-sm-12 control-label">Warranty Period</label>

              <div class="col-sm-12">
              <input type="date" name="editprowarrantydate" class="form-control pull-right" id="editprowarrantydate" placeholder="dd/mm/yyyy">
			  <div id="ewperioderror" class="error"></div>									
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-group">
              <label for="editprobillnumber" class="col-sm-12 control-label">Bill Number</label>

             <div class="col-sm-12">
              <input type="text" name="editprobillnumber" class="form-control" id="editprobillnumber" placeholder="Bill Number">
			  <div id="ebillnoerror" class="error"></div>									
              </div>
            </div>  
          </div>  
           
          
              
        </div>
        <div class="row">       
          <div class="col-lg-3">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-12 control-label">Location</label>
              <div class="radio">
              <label>
                <input type="radio" name="editprolocation" id="optionsRadios1" value="1" checked="">
                Godown
              </label>
               <label>
                <input type="radio" name="editprolocation" id="optionsRadios2" value="0">
                Customer's Place
              </label>
              </div>
            </div>
          </div>

          <div class="col-lg-3"> 
            <div class="form-group">
              <label for="editprocityproduct" class="col-sm-12 control-label">City</label>
              <div class="col-sm-12">             
              <select class="form-control" name="editprocityproduct" id="editprocityproduct"> </select>
              </div>        
            </div>  
          </div> 

          <div class="col-lg-3 erendpurchdate" hidden>
            <div class="form-group">
              <label for="editprorentpurchasedate" class="col-sm-12 control-label">Date of Rent Purchase</label>

              <div class="col-sm-12">
              <input type="date" class="form-control pull-right" name="editprorentpurchasedate"  id="editprorentpurchasedate" placeholder="dd/mm/yyyy">
			  <div id="erentpurchaseerror" class="error"></div>	
              </div>
            </div>
          </div>
        
          <div class="col-lg-3 erentpurchvalue" hidden>
            <div class="form-group">
              <label for="editprorendpurchase_value" class="col-sm-12 control-label">Rent Purchase Value</label>

             <div class="col-sm-12">
              <input type="text" class="form-control" id="editprorendpurchase_value" name="editprorendpurchase_value" placeholder="Purchase Value">
			  <div id="erentpurchasevalueerror" class="error"></div>	
              </div>
            </div>  
          </div>

          <div class="col-lg-3 erentvendor" hidden> 
            <div class="form-group">
              <label for="editprovendorthird" class="col-sm-12 control-label">Third party Vendor</label>
              <div class="col-sm-12">             
              <select class="form-control" name="editprovendorthird" id="editprovendorthird"> </select>
              </div>        
            </div>  
          </div>  

 
        </div>
        
        </div>
        </div>
        
        
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

             <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <div class="row">
          <div class="col-lg-3">
          <div class="form-group">
              <label for="tenure1" class="col-sm-12 control-label">Tenure</label>
              <div class="col-sm-12">
              <select class="form-control" name="tenureproduct">
              <option>3 Months</option>
              <option>2 Months</option>
              <option>3 Months</option>
              </select>
              </div>
          </div>
          </div>
        <div class="col-lg-3">
          <div class="form-group">
              <label for="rent" class="col-sm-12 control-label">Rent</label>

             <div class="col-sm-12">
              <input type="text" name="editprorent" class="form-control" id="editprorent" disabled placeholder="Rent">
              </div>
          </div>                
        </div>                
        
        <div class="col-lg-3">
          <div class="form-group">
            <label for="processing_fee" class="col-sm-12 control-label">Processing Fee</label>

           <div class="col-sm-12">
            <input type="text" name="editproprocessing_fee" disabled class="form-control" id="editproprocessing_fee" placeholder="Processing Fee">
            </div>
          </div>                
        </div>                
        
        <div class="col-lg-3">
          <div class="form-group">
            <label for="editprosecurity_deposit" class="col-sm-12 control-label">Security Deposit</label>

           <div class="col-sm-12">
            <input type="text"  name="editprosecurity_deposit" disabled class="form-control" id="editprosecurity_deposit" placeholder="Security Deposit">
            </div>
          </div>        
        </div>        
            
            </div>
            </div>

          </div>
        

              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" id="editproductupdate" onclick="editproductdetailsupdate()">Save</button>
              </div>
              </form>
          </div>
		  
		  <div id="proReport">
		      <div class="box-body">
			
				<!--<div class="pull-right"><a  onclick="addVariant()">+</a></div>-->	
              <div class="table-responsive">
                 <h3>General Detail</h3>  
				<table class="table no-margin" id='Product Report'>
                  <thead>
                  <tr>
                    <th>Puchase  Date</th>
					<th>Purchase Cost</th>
					<th>Bill No.</th>
					<th>Waranty Preiod</th>
					
					</tr>
                  </thead>
                  <tbody>
				  <tr>
                    <th><span id="pur_date"></span></th>
					<th><span id="pur_cost"></span></th>
					<th><span id="bill_no"></span></th>
					<th><span id="waranty_prieod"></span></th>
					</tr>
				  
          
                  </tbody>
                </table>
              </div>
			  
	         
            </div>

       
	        <div class="box-body">
			
				<!--<div class="pull-right"><a  onclick="addVariant()">+</a></div>-->	
              <div class="table-responsive">
                 <h3>Overall Report Details</h3>  
				<table class="table no-margin" id=' '>
                  <thead>
                  <tr>
                    <th>Customer Count</th>
					<th>Security Amount</th>
					<th>Processing Fee</th>
					<th>Installation Fee</th>
					<th>Rent Days</th>
					<th>Rent Cost</th>
					
					</tr>
                  </thead>
                  <tbody>
				  <tr>
                    <th><span id="c_count"></span></th>
					<th><span id="r_se_amount"></span></th>
					<th><span id="r_pr_amount"></span></th>
					<th><span id="r_in_amount"></span></th>
					<th><span id="o_day"></span></th>
					<th><span id="o_rent"></span></th>
					</tr>
				  
          
                  </tbody>
                </table>
              </div>
			  
			  
	         
            </div>

			<div class="" id="">
            <div class="box-header ">
              <h3 >Mapped Product</h3>

            
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
          

					
            <div class="table-responsive">
                 
				<table class="table no-margin" id="mappedData" >
                  <thead>
                  <tr>
                    <th colspan="1">Sr.no.</th>
					<th colspan="1">Product Id</th>
					<th colspan="1">Category</th>
					<th colspan="1">Variant</th>
					<th colspan="1">Status</th>
					<th colspan="2" style="text-align:center">Process</th>
				    <th colspan="2" style="text-align:center">Cost</th>
					
				  </tr>
					 <tr>
                    <th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align:center">Type</th>
					<th style="text-align:center">Date</th>
				    <th style="text-align:center">Type</th>
					<th style="text-align:center">Cost</th>
					
					</tr>
                  </thead>
                 
                </table>
				</div>
				
				 
				
				<div class="box-footer">
					<button type="button" class="btn btn-default ebutton" onclick="backProduct();">Back</button>
				
			   </div>
              </div>
			  
			  <div class="box-body">
			
					
          

					
       <div class="table-responsive">
                 
				<table class="table no-margin" id="refundData" >
                
                 
                </table>
				</div>
				
				 
				
				<div class="box-footer">
					<button type="button" class="btn btn-default ebutton" onclick="backProduct();">Back</button>
				
			   </div>
              </div>
			  
			   <div class="box-body">
			
					
          

					
       <div class="table-responsive">
                 
				<table class="table no-margin" id="usedData" >
                
                 
                </table>
				</div>
				
				 
				
				<div class="box-footer">
					<button type="button" class="btn btn-default ebutton" onclick="backProduct();">Back</button>
				
			   </div>
              </div>
			  
			   
              <!-- /.table-responsive -->
            </div>



          </div>	  
		  	  
			</div>  
			
				<div class="modal fade" id="closuremodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  
				<form class="form-horizontal">
				 <div class="box-body">
			
					<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Product Id</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="proId"  disabled >
						  </div>				
						</div>	
					</div>	
					<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Customer Id</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="cusId"  disabled >
						  </div>				
						</div>	
					</div>	
						<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Closure Date</label>
						  <div class="col-sm-12">
							<input type="date" class="form-control" id="closuredate"   >
						  </div>				
						</div>	
					</div>	
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-12 control-label">Remarks</label>

                  <div class="col-sm-12">
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>	
                  </div>
                </div>	
				</div>
			</form>	
				
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" id="closurepro1">Closure</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  
				<form class="form-horizontal">
				 <div class="box-body">
			
					<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Product Id</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_proId"  disabled >
						  </div>				
						</div>	
					</div>	
					<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Customer Id</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_cId"  disabled >
						  </div>				
						</div>	
					</div>	
						<div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Closure Date</label>
						  <div class="col-sm-12">
							<input type="date" class="form-control" id="r_closuredate"  disabled >
						  </div>				
						</div>	
					</div>	
 
       
 <div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Pennding Amount</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_pend"  disabled >
						  </div>				
						</div>	
					</div>	
              <div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Rent Cost</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_rent"  disabled >
						  </div>				
						</div>	
					</div>	
                     <div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label"> Advance Amount</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_advance"  disabled >
						  </div>				
						</div>	
					</div>	
					 <div class="col-lg-12">	  
						
					
						<div class="form-group">
						  <label for="closuredate" class="col-sm-5 control-label">Refund Amount</label>
						  <div class="col-sm-12">
							<input type="text" class="form-control" id="r_refund"  disabled >
						  </div>				
						</div>	
					</div>	
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-12 control-label">Remarks</label>

                  <div class="col-sm-12">
                    <textarea class="form-control" rows="3" id="r_remark" placeholder="Enter ..."></textarea>	
                  </div>
                </div>	
				</div>
			</form>	
				
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" id="refundProduct1">Refund </button>
      </div>
    </div>
  </div>
</div>
			</section>
	          
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    
    <!-- /.content -->
  </div> 
</section>  
  <!-- /.content-wrapper -->
  <?php
  require_once('footer.php');
?>
<script type="text/javascript">
  
  //product edit
 function editbillfileselect(evt) {   
    var files = evt.target.files; 
  for (var i = 0, f; f = files[i]; i++) {
       if (!f.type.match('image.*')) {
          continue;
        }
      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
        var span = document.createElement('span');
        span.innerHTML = ['<img width="100px" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        document.getElementById('imageothers').insertBefore(span, null);
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('uploadeditbillimages').addEventListener('change', editbillfileselect, false);

 function editproductimagesfileselect(evt) {  
    var files = evt.target.files; 
  for (var i = 0, f; f = files[i]; i++) {
       if (!f.type.match('image.*')) {
          continue;
        }
      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
        var span = document.createElement('span');
        span.innerHTML = ['<img width="100px" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        document.getElementById('dispyproductimages').insertBefore(span, null);
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('uploadeditproductimages').addEventListener('change',editproductimagesfileselect, false);

  
  
  function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

   // Handle click on checkbox
   $('#productlist  tbody').on('click', 'input[type="checkbox"]', function(e){ 
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#productlist ').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('#productlist thead input[name="select_all"]', table.table().container()).on('click', function(e){
        alert("thu 2222");
      if(this.checked){
         $('#productlist tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#productlist tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });
 // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
  

</script>


<?php
  require_once('footer.php');
?>