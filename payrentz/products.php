<?php
require_once('header.php');
?>
<script type="text/javascript">
	
	window.onload = function() {
			selectmaincategory();
					
			 gotbrandlist();	vendorlist();  rentvendorlist(); citylist();
		}
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
Add Products
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
				
	<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
        
				
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Product Details</h3>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form class="form-horizontal" id="productaddform">
              <div class="box-body">
				
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="" class="col-sm-12 control-label">Bill Upload</label>
						  	<div class="col-sm-6">						  		
								<div style="height:100px; border: 1px solid #ccc;overflow: auto;background: url(assets/images/placeholder-img.png);" id="billimages"></div><br/>					 
								<input type="file" class="inputfile" id="Uploadbillimg" name="billimages[]" multiple/> 
								<label for="file"><i class="fa fa-upload" aria-hidden="true"></i></label> 	
								<div id="billimgerror" class="error"></div>									
								<div id="filesizeberror" class="error"></div>									
								<div id="typebillimgerror" class="error"></div>
							</div>
							<div class="col-sm-6">
								<div style="height:100px; border: 1px solid #ccc;overflow: auto;background: url(assets/images/placeholder-img.png);" id="productimages"></div><br/>				 
								<input type="file" class="inputfile" name="productimages[]" id="uploadproductimages" multiple/> 
								<label for="file"><i class="fa fa-upload" aria-hidden="true"></i></label> 
								<div id="productimgerror" class="error"></div>
								<div id="filesizeperror" class="error"></div>									
								<div id="typeproductimgerror" class="error"></div>								
							</div>
						</div>				
					</div>		
					<div class="col-lg-9">
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="maincategorylist" class="col-sm-12 control-label">Product Category</label>
						  <div class="col-sm-12">
							<select class="form-control" name="categorylist" id="categorylist" onchange="getsubcategory(this.value);">  
							
							</select>
						  </div>				
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="variant" class="col-sm-12 control-label">Sub Category</label>					 	
							 <div class="col-sm-12">
							<select class="form-control" name="category" id="subcategoryproduct" onchange="variantlist(this.value)">
							<option disabled selected>Select Option</option>
							</select>
							<div id="subcategoryerror" class="error"></div>	
							</div>
					  </div>
					  </div>
				
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="productvariant" class="col-sm-12 control-label">Variant</label>
						  <div class="col-sm-12">
							<select class="form-control" name="variant" id="productvariant" onchange="prdvariantlistdetails(this.value)">
							<option disabled selected>Select Option</option>
							</select>
							<div id="varianterror" class="error"></div>	
						  </div>				
						</div>
					</div>

					<div class="col-lg-3">
						<div class="form-group">
						  <label for="productbrand" class="col-sm-12 control-label">Brand</label>
						  <div class="col-sm-12">
							<select class="form-control" name="productbrand" id="productbrand"> </select>
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
							  <input type="radio" name="ownedtype" id="optionsRadios1" class="ownedtype" value="1" checked="">
							  Owned
							</label>
							 <label>
							  <input type="radio" name="ownedtype" id="optionsRadios2" class="thirdtype" value="0">
							  Third Party
							</label>
						  </div>				
						</div>		
					</div>	
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="vendorbrand" class="col-sm-12 control-label">Vendor</label>
						  <div class="col-sm-12">
							<select class="form-control" name="vendor" id="vendorbrand"> </select>							
						  </div>				
						</div>	
					</div>	

					<div class="col-lg-3">
						<div class="form-group">
						  <label for="purchasedate" class="col-sm-12 control-label">Date of Purchase</label>

						  <div class="col-sm-12">
							<input type="date" class="form-control pull-right" name="purchasedate"  id="purchasedate" placeholder="dd/mm/yyyy">
							<div id="pdateerror" class="error"></div>	
						  </div>
						</div>
					</div>
			  
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="purchase_value" class="col-sm-12 control-label">Purchase Value</label>

						 <div class="col-sm-12">
							<input type="number" min="0" class="form-control" id="purchase_value" name="purchase_value" placeholder="Purchase Value">
							<div id="pvalueerror" class="error"></div>	
						  </div>
						</div>	
					</div>	
						

					
				</div>
					
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="other_charge" class="col-sm-12 control-label">Other Charges</label>

						 <div class="col-sm-12">
							<input type="number" min="0"  class="form-control" id="other_charge" name="other_charge" placeholder="Other Charges">
							<div id="otherchargeerror" class="error"></div>	
						  </div>
						</div>			  			  
					</div>	  
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="serialno" class="col-sm-12 control-label">Manufacturer's Serial No</label>

						 <div class="col-sm-12">
							<input type="text" name="serialno"  class="form-control" id="serialno" placeholder="Manufacturer's Serial No">
							<div id="msnerror" class="error"></div>	
						  </div>
						</div>			  			  
					</div>			  			  
			  
					<div class="col-lg-3">
						<div class="form-group">
						  <label for="warrantydate" class="col-sm-12 control-label">Warranty Period</label>

						  <div class="col-sm-12">
							<input type="date" name="warrantydate" class="form-control pull-right" id="warrantydate" placeholder="dd/mm/yyyy">
							<div id="wperioderror" class="error"></div>	
						  </div>
						</div>
					</div>

					<div class="col-lg-3">
						<div class="form-group">
						  <label for="billnumber" class="col-sm-12 control-label">Bill Number</label>

						 <div class="col-sm-12">
							<input type="text" name="billnumber" class="form-control" id="billnumber" placeholder="Bill Number">
							<div id="billnoerror" class="error"></div>	
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
							  <input type="radio" name="location" id="optionsRadios1" value="1" checked="">
							  Godown
							</label>
							 <label>
							  <input type="radio" name="location" id="optionsRadios2" value="0">
							  Customer's Place
							</label>
						  </div>
						</div>
					</div>

					<div class="col-lg-3"> 
						<div class="form-group">
						  <label for="cityproduct" class="col-sm-12 control-label">City</label>
						  <div class="col-sm-12">							
							<select class="form-control" name="cityproduct" id="cityproduct"> </select>
						  </div>				
						</div>	
					</div>	

					<div class="col-lg-3 rendpurchdate" hidden>
						<div class="form-group">
						  <label for="rentpurchasedate" class="col-sm-12 control-label">Date of Rent Purchase</label>

						  <div class="col-sm-12">
							<input type="date" class="form-control pull-right" name="rentpurchasedate"  id="rentpurchasedate" placeholder="dd/mm/yyyy">
							<div id="rentpurchaseerror" class="error"></div>	
						  </div>
						</div>
					</div>
			  
					<div class="col-lg-3 rentpurchvalue" hidden>
						<div class="form-group">
						  <label for="rendpurchase_value" class="col-sm-12 control-label">Rent Purchase Value</label>

						 <div class="col-sm-12">
							<input type="text" class="form-control" id="rendpurchase_value" name="rendpurchase_value" placeholder="Purchase Value">
							<div id="rentpurchasevalueerror" class="error"></div>	
						  </div>
						</div>	
					</div>

					<div class="col-lg-3 rentvendor" hidden> 
						<div class="form-group">
						  <label for="vendorthird" class="col-sm-12 control-label">Third Party Vendor</label>
						  <div class="col-sm-12">							
							<select class="form-control" name="vendorthird" id="vendorthird"> </select>
						  </div>				
						</div>	
					</div>	

						
						
				</div>
			  
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
				<div class="row">
					<!--<div class="col-lg-3">
					<div class="form-group">
						  <label for="tenure1" class="col-sm-12 control-label">Tenure</label>
						  <div class="col-sm-12">
							<select class="form-control" name="tenureproduct" id="tenure1">
							<option>3 Months</option>
							<option>2 Months</option>
							<option>3 Months</option>
						  </select>
						  </div>
					</div>
					</div>-->
				<div class="col-lg-3">
					<div class="form-group">
						  <label for="rent" class="col-sm-12 control-label">Rent</label>

						 <div class="col-sm-12">
							<input type="text" name="rent" class="form-control" id="rent" placeholder="Rent"  disabled>
						  </div>
					</div>			  				
				</div>			  				
			  
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="processing_fee" class="col-sm-12 control-label">Processing Fee</label>

					 <div class="col-sm-12">
						<input type="text" name="processing_fee" class="form-control" id="processing_fee" placeholder="Processing Fee" disabled>
					  </div>
					</div>			  			  
				</div>			  			  
			  
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="security_deposit" class="col-sm-12 control-label">Security Deposit</label>

					 <div class="col-sm-12">
						<input type="text"  name="security_deposit" class="form-control" id="security_deposit" placeholder="Security Deposit" disabled>
					  </div>
					</div>			  
				</div>			  
            
            </div>
            </div>

          </div>
				

              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            
          </div>
		
             <div class="box-footer">
                <a onclick="reset_page()" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" id="productupload">Submit</button>
              </div>
		</form>


		
        </section>
		
		
		
		
		

			  
	
                </div>
                <!-- ./col -->
              <!--</div>
              <!-- /.row -->
           <!-- </div>
            <!-- /.box-footer -->
        <!--  </div>
          <!-- /.box -->


       <!-- </section>
        <!-- right col -->
 <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php
  require_once('footer.php');
?>

