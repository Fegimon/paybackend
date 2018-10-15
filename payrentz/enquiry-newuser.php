<?php
require_once('header.php');


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Customer        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Enquiry</li>
      </ol>
    </section>

    <!-- Main content -->
  
	<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">
        
		<form id='enquiryForm' class="enqform" action="config/save_customer_detail.php" method="post" enctype="multipart/form-data">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Personal Details</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="form-horizontal">
					  <div class="box-body">
					  
						  <div class="row">
							<div class="col-lg-2">
								<div class="form-group">
									<label for="" class="col-sm-12 control-label">Customer photo</label>
									<div class="col-sm-12">
										<img src=".jpg" width="100px" height="100px" id="user" style="background: url(assets/images/placeholder-img.png);"><br/><br/>
									 
										<input type="file" id="file" class="inputfile" name="userfile[]" onchange="uploadOnChange()" onload="uploadOnChange()"  vale=""> 
										<label for="file" class="btnupload" id="up"><i class="fa fa-upload" aria-hidden="true"></i></label> 
										<div id="imgfileerror" class="error"></div>
										<!-- <input id="upfile" type="text"> -->
									   <br/>
									</div>
								</div>
							</div>
							<div class="col-lg-10">
							
								<div class="row">
								
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_type" class="col-sm-12 control-label">Customer Type</label>

									  <div class="col-sm-12">
										<select name='c_type' id='c_type' class="form-control">
										<option value='1'>Individual</option>
										<option value='2'>Corporate</option>
										<option value='3'>Event</option> 
									  </select>
									  </div>
									  </div>
									
									
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="applicantname" class="col-sm-12 control-label">Applicant Name *</label>

									 <div class="col-sm-12">
										<input type="text" class="form-control text_special" id="applicantname" placeholder="Name" name='c_name' >
										<div id="anameerror" class="error"></div>
									 </div>
									 
									</div>
									
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
						
									  <label for="datepicker2" class="col-sm-12 control-label">Date of Birth</label>

									  <div class="col-sm-12 input-append date">
										<input type="date" class="form-control pull-right  " id="datepicker2" placeholder="dd/mm/yyyy" name='c_dob'>
										<!--<span class="add-on" style="cursor:pointer; position: relative; bottom: 22px; left: 179px;"><i class="fa fa-th" ></i></span>-->
									  </div>
									</div>
									</div>
									
								  
								  <div class="col-lg-3">
									<div class="form-group">
									  <label for="c_nativity" class="col-sm-12 control-label">Nativity</label>
									  <div class="col-sm-12">
										<select class="form-control" name='c_nativity' id='c_nativity'>
										
									  </select>
									  </div>
									</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputPassword3" class="col-sm-12 control-label">Gender</label>
										<div class="radio">
										<label>
										  <input type="radio" name="c_gender" id="optionsRadios1" value="0" checked="">
										  Male
										</label>
										 <label>
										  <input type="radio" name="c_gender" id="optionsRadios2" value="1">
										  Female
										</label>
<label>
										  <input type="radio" name="c_gender" id="optionsRadios3" value="2">
										  Corporate
										</label>
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="inputPassword3" class="col-sm-12 control-label">Marital Status</label>
										<div class="radio">
										<label>
										  <input type="radio" name="c_mart_status" id="optionsRadios1" value="0" checked="">
										  Single
										</label>
										 <label>
										  <input type="radio" name="c_mart_status" id="optionsRadios2" value="1">
										  Married
										</label>
									  </div>
									</div>
									</div>
									
									<div class="col-lg-3">	
									<div class="form-group">
									  <label for="c_res_status" class="col-sm-12 control-label">Residential Status</label>
									  <div class="col-sm-12">
										<select class="form-control" name='c_res_status' id='c_res_status'>
										<option value='1'>Permanent</option>
										<option value='2'>Rented</option>
									  </select>
									  </div>
									</div>
									</div>
						
									<div class="col-lg-3">	
									<div class="form-group">
									  <label for="enquiryemail" class="col-sm-12 control-label">Email *</label>
									 <div class="col-sm-12">
										<input type="text" class="form-control" id="enquiryemail" placeholder="Email" name='c_email' onchange="existingCheck(this.value,'email')" >
										<div id="amailerror" class="error"></div>	
									  </div>
																		  
									</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_state" class="col-sm-12 control-label">State</label>

									  <div class="col-sm-12">
										<select class="form-control"  name='c_state' id='c_state' onchange="getCity(this.value)" >
																		
									  </select>
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_city" class="col-sm-12 control-label">City</label>

									  <div class="col-sm-12">
										<select class="form-control"  name='c_city' id='c_city' onchange="getZone(this.value)">
															
									  </select>
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_zone" class="col-sm-12 control-label ">Zone</label>

									  <div class="col-sm-12">
										<select class="form-control selectpicker " name='c_zone' id="c_zone"  onchange="getArea(this.value)"  data-live-search="true">
									   
									  </select>
									  </div>
									</div>
									</div>
									
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_area" class="col-sm-12 control-label">Area</label>

									  <div class="col-sm-12">
										<select class="form-control" name='c_area' id='c_area'>
										
									  </select>
									  </div>
									</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_state" class="col-sm-12 control-label">Pincode</label>

									  <div class="col-sm-12">
										<input type="number" class="form-control " id="Pincode" placeholder="Pincode" name='c_pincode' >
																		
									  </select>
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="c_city" class="col-sm-12 control-label">Floor</label>

									  <div class="col-sm-12">
										<input type="number" class="form-control " id="floor" placeholder="Floor" name='c_floor' >
															
									  </select>
									  </div>
									</div>
									</div>
								
								</div>
							</div>
						  </div>
					  
						<div class="row">	
							<div class="col-lg-6">
								<div class="box-body">
									<div class="box-header with-border">
									  <h3 class="box-title">Add Phone Number</h3>
									</div>
								<div class="pull-right"><a onclick="add_mobile();" style="cursor:pointer">+</a></div>	
								<div class="table-responsive">

									<table id='mobile_table' class="table no-margin">
									<thead>
										<tr>
											<th>Mobile Type</th>
											<th>Number *</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><select class="form-control" name='c_mobile_type[]'>
												<option>Primary</option>
												<option>Secondary</option>
												</select>
											</td>
											<td>
												<div class="form-group">                  
												 <div class="col-sm-10">
													<input type="text" class="form-control" id="mobile" placeholder="Mobile" name="c_mobile_no[]"  onchange="existingCheck(this.value,'mobile')">
													<div id="tmobileerror" class="error"></div>	
												  </div>
												</div>	
											</td>
											<td class="action-link"> <a class='m_remove' style="cursor:pointer"> <i class="fa fa-trash-o"  aria-hidden="true"></i></a>
											</td>
										</tr>    
									</tbody>
									</table>
								</div>
								</div>
							</div>
							<div class="col-lg-6" style="border-left:1px solid #ccc;">
								<div class="box-body">
									<div class="box-header with-border">
									  <h3 class="box-title">Add Address</h3>
									</div>
									<div class="pull-right"><a onclick='add_address()' style="cursor:pointer">+</a></div>	
									<div class="table-responsive">

										<table class="table no-margin" id='address_table'>
										<thead>
										  <tr>
											<th>Address Type</th>
											<th>Address</th>
											<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<select class="form-control" name='c_address_type[]'>
													<option>Permanent</option>
													<option>Communication</option>
													<option>Company</option>
												</select>
											</td>
											<td>
												<div class="form-group">                  
												<div class="col-sm-10">
													<textarea  rows="3" cols="30" id="permanent_address" placeholder="Enter. . ." name="c_address[]"></textarea>	
													<div id="tadreserror" class="error"></div>	
												</div>
												</div>	
											</td>
											<td class="action-link">
												<a class="a_remove"> <i class="fa fa-trash-o"  aria-hidden="true"></i></a>
											</td>
										</tr>              
										</tbody>
										</table>
									</div>
								</div>
							
							</div>
						</div>
			</div>
			  <!-- /.box-body -->
				<!-- /.box-footer -->
			</div>
		</div>

			<div class="box box-primary">
				<div class="box-header with-border">
				    <h3 class="box-title">Professional Details</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<div class="form-horizontal">
				<div class="box-body">
					<div class="row"> 
						<div class="col-lg-3">	
							<div class="form-group">
							  <label for="cname" class="col-sm-12 control-label">Company Name</label>
							 <div class="col-sm-12">
								<input type="text" class="form-control" id="cname" placeholder="Company Name" name="c_company_name">
								<div id="cnameerror" class="error"></div>	
							  </div>				
							</div>
						</div>
							
						<div class="col-lg-3">	
							<div class="form-group">
							 <label for="designation" class="col-sm-12 control-label">Designation</label>
							<div class="col-sm-12">
							<input type="text" class="form-control" id="designation" placeholder="Designation" name='c_company_designation'>
							<div id="designationerror" class="error"></div>	
							 </div>				
							</div>
						</div>
							
						<div class="col-lg-3">		
							<div class="form-group">
							  <label for="department" class="col-sm-12 control-label">Department</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="department" placeholder="Department" name='c_depart'>
								<div id="departmenterror" class="error"></div>	
							 </div>				
							</div>
						</div>
							
						<div class="col-lg-3">
							<div class="form-group">
								 <label for="alternateemail" class="col-sm-12 control-label">Alternate Email</label>
								 <div class="col-sm-12">
									<input type="text" class="form-control" id="alternateemail" placeholder="Alternate Email" name='c_alter_email' onchange="existingCheck(this.value,'email')">
									<div id="altemailerror" class="error"></div>	
								 </div>				
							</div>
						</div>
					</div>		
				</div>
					
				</div>
			</div>
		
					 
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Reference 1</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="form-horizontal">
					  <div class="box-body">
					  
						<div class="row">	
							<div class="col-lg-3">
							<div class="form-group">
							  <label for="ename" class="col-sm-12 control-label">Name</label>

							  <div class="col-sm-12">
								<input type="text" class="form-control pull-right" id="ename" placeholder="Name" name='c_ref_name[]'>
								<div id="enameerror" class="error"></div>	
							  </div>
							</div>
							</div>

							<div class="col-lg-3">
							<div class="form-group">
							  <label for="enquiryemails" class="col-sm-12 control-label">Email</label>

							  <div class="col-sm-12">
								<input type="text" class="form-control pull-right" id="enquiryemails" placeholder="Email" name='c_ref_email[]'>
								<div id="emailserror" class="error"></div>	
							  </div>
							</div>
							</div>
						
							<div class="col-lg-3">
							<div class="form-group">
							  <label for="emobile" class="col-sm-12 control-label">Mobile</label>

							  <div class="col-sm-12">
								<input type="text" class="form-control pull-right" id="emobile" placeholder="Mobile" name='c_ref_mobile[]'>
								<div id="emobileerror" class="error"></div>	
							  </div>
							</div>
							</div>
				
							
							<div class="col-lg-3">
							<div class="form-group">
							  <label for="eaddress" class="col-sm-12 control-label">Address</label>

							  <div class="col-sm-12">
								<textarea  rows="3"  cols="33" id="eaddress" placeholder="Enter ..." name='c_ref_add[]'></textarea>
								<div id="eaddresserror" class="error"></div>									
							  </div>
							</div>		
							</div>		
               
						</div>
				  <!-- /.box-body -->

				  <!-- /.box-footer -->
					</div>
			  </div>
			  </div>
			  
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Reference 2</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="form-horizontal">
					  <div class="box-body">
					  
					<div class="row">	
						<div class="col-lg-3">
						<div class="form-group">
						  <label for="rname" class="col-sm-12 control-label">Name</label>

						  <div class="col-sm-12">
							<input type="text" class="form-control pull-right" id="rname" placeholder="Name" name='c_ref_name[]'>
							<div id="rnameerror" class="error"></div>	
						  </div>
						</div>
						</div>

						<div class="col-lg-3">
						<div class="form-group">
						  <label for="remail" class="col-sm-12 control-label">Email</label>

						  <div class="col-sm-12">
							<input type="text" class="form-control pull-right" id="remail" placeholder="Email" name='c_ref_email[]'>
							<div id="remailerror" class="error"></div>	
						  </div>
						</div>
						</div>
						
						<div class="col-lg-3">
						<div class="form-group">
						  <label for="rmobile" class="col-sm-12 control-label">Mobile</label>

						  <div class="col-sm-12">
							<input type="text" class="form-control pull-right" id="rmobile" placeholder="Mobile" name='c_ref_mobile[]'>
							<div id="rmobileerror" class="error"></div>	
						  </div>
						</div>
						</div>
									
						<div class="col-lg-3">		
						<div class="form-group">
						  <label for="raddress" class="col-sm-12 control-label">Address</label>

						  <div class="col-sm-12">
							<textarea rows="3" cols="33" id="raddress" placeholder="Enter ..." name='c_ref_add[]'></textarea>	
							<div id="raddresserror" class="error"></div>	
						  </div>
						</div>		
						</div>		
						
						
					   
					  </div>
					  <!-- /.box-body -->

					  <!-- /.box-footer -->
					</div>
				  </div>
				</div>
		 
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">KYC Details</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="form-horizontal">
						<div class="box-body">
						
						<div class="row">
							<div class="col-lg-3">
							<div class="form-group">
									<label for="" class="col-sm-12 control-label">Company ID</label>
									<div class="col-sm-12">
									<iframe  src="" alt="Preview" width="50%" height="50%"   id="companyid" style="background: url(assets/images/placeholder2.png);"></iframe><br/><br/>
										<input type="file" name="userfile[]"  id="cidfile" class="companyinput" onchange="companyOnChange()" vale=""/> 
										<label for="cidfile"><i class="fa fa-upload" aria-hidden="true"></i></label>
										<div id="cidfileerror" class="error"></div>										
									</div>
							</div>
							</div>
							
							<div class="col-lg-3">
							<div class="form-group">
									<label for="" class="col-sm-12 control-label">Cancelled Cheque</label>
									<div class="col-sm-12">
									<iframe src="" alt="Preview" width="50%" height="50%"  id="cancelcheque" style="background: url(assets/images/placeholder2.png);"></iframe><br/><br/>
										<input type="file" name="userfile[]"  id="cancelfile" class="cancelinput" onchange="cancelOnChange()" vale=""/> 
										<label for="cancelfile"><i class="fa fa-upload" aria-hidden="true"></i></label> 
										<div id="cancelfileerror" class="error"></div>	
									</div>
							</div>
							</div>
							
							<div class="col-lg-3">
							<div class="form-group">
									<label for="" class="col-sm-12 control-label">ID Proof</label>
									<div class="col-sm-12">
									<iframe src="" alt="Preview" width="50%" height="50%"  id="idproof" style="background: url(assets/images/placeholder2.png);"></iframe><br/><br/>
										<input type="file" name="userfile[]"  id="idfile" class="idproofinput" onchange="idproofOnChange()"  vale=""/> 
										<label for="idfile"><i class="fa fa-upload" aria-hidden="true"></i></label> 
										<div id="idfileerror" class="error"></div>	
									</div>
							</div>
							</div>
							
							<div class="col-lg-3">
							<div class="form-group">
									<label for="" class="col-sm-12 control-label">Address Proof</label>
									<div class="col-sm-12">
									<iframe src="" alt="Preview" width="50%" height="50%" style="background: url(assets/images/placeholder2.png);" id="addressproof"></iframe><br/><br/>
										<input type="file" name="userfile[]"  id="addressfile" class="adresprofinput" onchange="addressOnChange()" vale=""/>
										<label for="addressfile"><i class="fa fa-upload" aria-hidden="true"></i></label>
										<div id="addressfileerror" class="error"></div>	 										
									</div>
							</div>
							</div>
				
						</div>
					
					  <div class="box-body">
						<div class="row">
							<div class="col-lg-3">
							<div class="form-group">
							  <label for="c_kycstatus" class="col-sm-12 control-label">KYC Status</label>
							  <div class="col-sm-12">
								<select class="form-control" name='c_kyc_status' id="c_kycstatus">
								<option>KYC Onboard</option>
								<option>Document Collection</option>
							  </select>
							  </div>
							</div>
							</div>
							
							<div class="col-lg-3">
							<div class="form-group">
							  <label for="remark5" class="col-sm-12 control-label">Remarks</label>

							  <div class="col-sm-12">
								<textarea  rows="3" cols="37" id="remark5" placeholder="Enter ..." name='c_remarks'></textarea>	
								<div id="remarkerror" class="error"></div>	
							  </div>
							</div>	
							</div>
							
							<div class="col-lg-3">
							<div class="form-group">
							<br/>
							  <div class="col-sm-12">
								    <label><input type="checkbox" name="customer_status" class="check" id='direct_customer' value='0'  > 
								
								  Create  Customer Id Directly
								  </label>
								</div>
							</div>
							</div>
									
								
				
              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </div>
			   <div class="box-body">
			
				<div class="pull-right row"><a class="tplus" onclick="addVariant()">+</a></div>	
              <div class="table-responsive ourtableblg">

				<table class="table no-margin" id='c_e_product'>
                  <thead>
                  <tr>
                    <th class="headcol" >Category</th>
					<th class="headcol1">Variant</th>
					<th class="headcol2">Quantity</th>
					<th>Delivery</th>
					<th>Rent Duration</th>
					<th>Tenure</th>
					<th>Rent Cost </th>
					<th>Security Deposit </th>
					<th>Processing Fee</th>
					<th>Ins. Fee</th>
				
					<th>Action</th>
					</tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td class="headcol midtd"><select id="e_cat1" class="form-control" onchange="getVariant(this.value,'1')" name="e_cat[]" >
                 
                  </select></td>
				  <td class="headcol1 bigtd"><select id="e_var1" class="form-control" onchange="getVariantCost(this.value,'1')" name="e_var[]">
                   
                  </select></td>
<td  class="headcol2 smalltd quantytb" >
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_quan1" placeholder="Quantity" name="e_quan[]">
                  </div>
                </div>	
</td>
<td class="midtd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="date" class="form-control" id="e_delivery1"  name="e_delivery[]">
                  </div>
                </div>	
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_rent1" placeholder="In Months" name="e_rent[]" onchange="getTenureCost(this.value,'1')">
                  </div>
                </div>	
				
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_tenure1" placeholder="In Months" name="e_tenure[]" readonly>
                  </div>
                </div>	
				
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_rent_cost1" placeholder="" name="e_rent_cost[]">
                  </div>
                </div>	
				
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_security1" placeholder="" name="e_security[]">
                  </div>
                </div>	
				
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_pro_fee1" placeholder="" name="e_pro_fee[]">
                  </div>
                </div>	
				
</td>
<td class="smalltd">
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="e_ins_fee1" placeholder="" name="e_ins_fee[]">
                  </div>
                </div>	
				
</td>

<td class="action-link"><a  class="e_v_remove"> <i class="fa fa-trash-o" title="" aria-hidden="true"></i></a></td>
  </tr>              
                  </tbody>
                </table>
              </div>
	         
            </div> 
          </div>
          </div>
			<div class="box-footer">
					<a onclick="reset_page()" class="btn btn-default">Cancel</a>
					<button type="submit" class="btn btn-info pull-right ebutton submit" id="csubmit">Submit</button>
			</div>
		
	   
		</form>
		</section>
		      <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
		
	
      <!-- /.row (main row) -->

    </section>
	
	
	
	
	
	
	
	
	
	
	
    <!-- /.content -->
  </div>
  
  <?php
  require_once('footer.php');
  ?>
  
  
  
  <script>/*** add customer validation ***/
$( "#enquiryForm" ).submit(function( event ) {



var letters = /^[A-Za-z\.\s]+$/;  
var cus_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var r1_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var r2_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var mbl = /^\d{10}$/;
var mbl1 = /^\d{10}$/;
var mbl2 = /^\d{10}$/;

var name = $('#applicantname'); 
var email = $('#enquiryemail'); 
var cname = $('#cname'); 
var designation = $('#designation'); 
var department = $('#department'); 
var alternateemail = $('#alternateemail'); 
var ename = $('#ename'); 
var enquiryemails = $('#enquiryemails'); 
var emobile = $('#emobile'); 
var eaddress = $('#eaddress'); 
var rname = $('#rname'); 
var remail = $('#remail'); 
var rmobile = $('#rmobile'); 
var raddress = $('#raddress'); 
var remark5 = $('#remark5'); 
var mobile = $('#mobile'); 
var permanent_address = $('#permanent_address'); 


/*** Applicant Name ***/
if($("#direct_customer").prop('checked') == true)
{
	
    //do something
	



if (name.val()==""){
$('#anameerror').html('<span>Please enter your Name</span>');
event.preventDefault();
}
else if(!letters.test(name.val()))
{
$('#anameerror').html('<span>Please enter character only(with dot)</span>');
event.preventDefault();
}
else
{
$('#anameerror').html('');
}

/*** Email ***/
if (email.val()==""){
$('#amailerror').html('<span>Please enter your Email</span>');
 event.preventDefault();
}
else if(!cus_mail.test(email.val()))
{
$('#amailerror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#amailerror').html('');
}


if (cname.val()==""){
//$('#cnameerror').html('<span>Please enter your company name</span>');
//event.preventDefault();
}
else
{
$('#cnameerror').html('');
}

if (designation.val()==""){
//$('#designationerror').html('<span>Please enter your designation</span>');
//event.preventDefault();
}
else
{
$('#designationerror').html('');
}

if (department.val()==""){
//$('#departmenterror').html('<span>Please enter your department</span>');
//event.preventDefault();
}
else
{
$('#departmenterror').html('');
}


// if (alternateemail.val()==""){
// $('#altemailerror').html('<span>Please enter your alternateemail</span>');
// event.preventDefault();
// }
// else
// {
// $('#altemailerror').html('');
// }

if (ename.val()==""){
//$('#enameerror').html('<span>Please enter your reference name</span>');
//event.preventDefault();
}
else
{
$('#enameerror').html('');
}


if (enquiryemails.val()==""){
//$('#emailserror').html('<span>Please enter your reference mail</span>');
//event.preventDefault();
}
else if(!r1_mail.test(enquiryemails.val()))
{
//$('#emailserror').html('<span>Please enter your correct email id</span>');
//event.preventDefault();
}
else
{
$('#emailserror').html('');
}

if (emobile.val()==""){
//$('#emobileerror').html('<span>Please enter your mobile number</span>');
//event.preventDefault();
}
else if(!mbl1.test(emobile.val()))
{
//$('#emobileerror').html('<span>Please enter mobile number only</span>');
//event.preventDefault();
}
else
{
$('#emobileerror').html('');
}

if (eaddress.val()==""){
//$('#eaddresserror').html('<span>Please enter your address</span>');
//event.preventDefault();
}
else
{
$('#eaddresserror').html('');
}


if (rname.val()==""){
//$('#rnameerror').html('<span>Please enter your reference name</span>');
//event.preventDefault();
}
else
{
$('#rnameerror').html('');
}

if (remail.val()==""){
//$('#remailerror').html('<span>Please enter your reference mail</span>');
//event.preventDefault();
}
else if(!r2_mail.test(remail.val()))
{
//$('#remailerror').html('<span>Please enter your correct email id</span>');
//event.preventDefault();
}
else
{
$('#remailerror').html('');
}



if (rmobile.val()==""){
//$('#rmobileerror').html('<span>Please enter your mobile</span>');
//event.preventDefault();
}
else if(!mbl2.test(rmobile.val()))
{
//$('#rmobileerror').html('<span>Please enter mobile number only</span>');
//event.preventDefault();
}
else
{
$('#rmobileerror').html('');
}

if (raddress.val()==""){
//$('#raddresserror').html('<span>Please enter your address</span>');
//event.preventDefault();
}
else
{
$('#raddresserror').html('');
}

if (remark5.val()==""){
//$('#remarkerror').html('<span>Please enter your description</span>');
//event.preventDefault();
}
else
{
$('#remarkerror').html('');
}

if(mobile.val()=="")
{
$('#tmobileerror').html('<span>Please enter your mobile number</span>');
event.preventDefault();
}
else if(!mbl.test(mobile.val()))
{
$('#tmobileerror').html('<span>Please enter mobile number only</span>');
event.preventDefault();
}
else
{
$('#tmobileerror').html('');
}

if (permanent_address.val()==""){
$('#tadreserror').html('<span>Please enter your permanent address</span>');
event.preventDefault();
}
else
{
$('#tadreserror').html('');
}


	
var x = $("#file").attr("vale").length;
if(x==0)
{
	
	
	//$('#imgfileerror').html('<span>Please upload your photo</span>');
	//event.preventDefault();
}

var y = $("#cidfile").attr("vale").length;
if(y==0)
{
	
	//$('#cidfileerror').html('<span>Please upload your photo</span>');
	//event.preventDefault();
}

var z = $("#cancelfile").attr("vale").length;
if(z==0)
{
	
	//$('#cancelfileerror').html('<span>Please upload your photo</span>');
	//event.preventDefault();
}

var s = $("#idfile").attr("vale").length;
if(s==0)
{
	
	//$('#idfileerror').html('<span>Please upload your photo</span>');
	//event.preventDefault();
}

var r = $("#addressfile").attr("vale").length;
if(r==0)
{
	
	//$('#addressfileerror').html('<span>Please upload your photo</span>');
	//event.preventDefault();
}



	



} //Check box validation end

else if($('#direct_customer').prop('checked')== false)
{
	if (name.val()==""){
$('#anameerror').html('<span>Please enter your Name</span>');
event.preventDefault();
}
else if(!letters.test(name.val()))
{
$('#anameerror').html('<span>Please enter character only(with dot)</span>');
event.preventDefault();
}
else
{
$('#anameerror').html('');
}

/*** Email ***/
if (email.val()==""){
$('#amailerror').html('<span>Please enter your Email</span>');
event.preventDefault();
}
else if(!cus_mail.test(email.val()))
{
$('#amailerror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#amailerror').html('');
}
if (mobile.val()==""){
$('#tmobileerror').html('<span>Please enter your mobile number</span>');
event.preventDefault();
}
else if(!mbl.test(mobile.val()))
{
$('#tmobileerror').html('<span>Please enter mobile number only</span>');
event.preventDefault();
}
else
{
$('#tmobileerror').html('');
}

if (permanent_address.val()==""){
$('#tadreserror').html('<span>Please enter your permanent address</span>');
event.preventDefault();
}
else
{
$('#tadreserror').html('');
}

}



	
}); //main function end


/*** add customer validation ***/
$( "#editCustomerform" ).submit(function( event ) {



var letters = /^[A-Za-z\.]+$/;  
var cus_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var r1_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var r2_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var mbl = /^\d{10}$/;
var mbl1 = /^\d{10}$/;
var mbl2 = /^\d{10}$/;

var name = $('#applicantname'); 
var email = $('#enquiryemail'); 
var cname = $('#cname'); 
var designation = $('#designation'); 
var department = $('#department'); 
var alternateemail = $('#alternateemail'); 
var ename = $('#ename'); 
var enquiryemails = $('#enquiryemails'); 
var emobile = $('#emobile'); 
var eaddress = $('#eaddress'); 
var rname = $('#rname'); 
var remail = $('#remail'); 
var rmobile = $('#rmobile'); 
var raddress = $('#raddress'); 
var remark5 = $('#remark5'); 
var mobile = $('#mobile'); 
var permanent_address = $('#permanent_address'); 


/*** Applicant Name ***/
if($("#direct_customer").prop('checked') == true)
{
	
    //do something
	



if (name.val()==""){
$('#anameerror').html('<span>Please enter your Name</span>');
event.preventDefault();
}
else if(!letters.test(name.val()))
{
$('#anameerror').html('<span>Please enter character only(with dot)</span>');
event.preventDefault();
}
else
{
$('#anameerror').html('');
}

/*** Email ***/
if (email.val()==""){
$('#amailerror').html('<span>Please enter your Email</span>');
 event.preventDefault();
}
else if(!cus_mail.test(email.val()))
{
$('#amailerror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#amailerror').html('');
}


if (cname.val()==""){
$('#cnameerror').html('<span>Please enter your company name</span>');
event.preventDefault();
}
else
{
$('#cnameerror').html('');
}

if (designation.val()==""){
$('#designationerror').html('<span>Please enter your designation</span>');
event.preventDefault();
}
else
{
$('#designationerror').html('');
}

if (department.val()==""){
$('#departmenterror').html('<span>Please enter your department</span>');
event.preventDefault();
}
else
{
$('#departmenterror').html('');
}


// if (alternateemail.val()==""){
// $('#altemailerror').html('<span>Please enter your alternateemail</span>');
// event.preventDefault();
// }
// else
// {
// $('#altemailerror').html('');
// }

if (ename.val()==""){
$('#enameerror').html('<span>Please enter your reference name</span>');
event.preventDefault();
}
else
{
$('#enameerror').html('');
}


if (enquiryemails.val()==""){
$('#emailserror').html('<span>Please enter your reference mail</span>');
event.preventDefault();
}
else if(!r1_mail.test(enquiryemails.val()))
{
$('#emailserror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#emailserror').html('');
}

if (emobile.val()==""){
$('#emobileerror').html('<span>Please enter your mobile number</span>');
event.preventDefault();
}
else if(!mbl1.test(emobile.val()))
{
$('#emobileerror').html('<span>Please enter mobile number only</span>');
event.preventDefault();
}
else
{
$('#emobileerror').html('');
}

if (eaddress.val()==""){
$('#eaddresserror').html('<span>Please enter your address</span>');
event.preventDefault();
}
else
{
$('#eaddresserror').html('');
}


if (rname.val()==""){
$('#rnameerror').html('<span>Please enter your reference name</span>');
event.preventDefault();
}
else
{
$('#rnameerror').html('');
}

if (remail.val()==""){
$('#remailerror').html('<span>Please enter your reference mail</span>');
event.preventDefault();
}
else if(!r2_mail.test(remail.val()))
{
$('#remailerror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#remailerror').html('');
}



if (rmobile.val()==""){
$('#rmobileerror').html('<span>Please enter your mobile</span>');
event.preventDefault();
}
else if(!mbl2.test(rmobile.val()))
{
$('#rmobileerror').html('<span>Please enter mobile number only</span>');
event.preventDefault();
}
else
{
$('#rmobileerror').html('');
}

if (raddress.val()==""){
$('#raddresserror').html('<span>Please enter your address</span>');
event.preventDefault();
}
else
{
$('#raddresserror').html('');
}

if (remark5.val()==""){
$('#remarkerror').html('<span>Please enter your description</span>');
event.preventDefault();
}
else
{
$('#remarkerror').html('');
}




	
var x = $("#file").attr("vale").length;
if(x==0)
{
	
	
	$('#imgfileerror').html('<span>Please upload your photo</span>');
	event.preventDefault();
}

var y = $("#cidfile").attr("vale").length;
if(y==0)
{
	
	$('#cidfileerror').html('<span>Please upload your photo</span>');
	event.preventDefault();
}

var z = $("#cancelfile").attr("vale").length;
if(z==0)
{
	
	$('#cancelfileerror').html('<span>Please upload your photo</span>');
	event.preventDefault();
}

var s = $("#idfile").attr("vale").length;
if(s==0)
{
	
	$('#idfileerror').html('<span>Please upload your photo</span>');
	event.preventDefault();
}

var r = $("#addressfile").attr("vale").length;
if(r==0)
{
	
	$('#addressfileerror').html('<span>Please upload your photo</span>');
	event.preventDefault();
}



	



} //Check box validation end

else if($('#direct_customer').prop('checked')== false)
{
	if (name.val()==""){
$('#anameerror').html('<span>Please enter your Name</span>');
event.preventDefault();
}
else if(!letters.test(name.val()))
{
$('#anameerror').html('<span>Please enter character only(with dot)</span>');
event.preventDefault();
}
else
{
$('#anameerror').html('');
}

/*** Email ***/
if (email.val()==""){
$('#amailerror').html('<span>Please enter your Email</span>');
event.preventDefault();
}
else if(!cus_mail.test(email.val()))
{
$('#amailerror').html('<span>Please enter your correct email id</span>');
event.preventDefault();
}
else
{
$('#amailerror').html('');
}


}



	
}); //main function end

function readURL(input,a) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) 
            {
           if(a==1)
            {
                $('#user').attr('src', e.target.result);
            }
            if(a==2)
            {
                $('#companyid').attr('src', e.target.result);
            }
			if(a==3)
            {
                $('#cancelcheque').attr('src', e.target.result);
            }
			if(a==4)
            {
                $('#idproof').attr('src', e.target.result);
            }
			if(a==5)
            {
                $('#addressproof').attr('src', e.target.result);
            }
            }
           
            
            reader.readAsDataURL(input.files[0]);
          }   
        }
    $("#file").change(function(){
        readURL(this,'1');
    });
	$("#cidfile").change(function(){
        readURL(this,'2');
    });
	$("#cancelfile").change(function(){
        readURL(this,'3');
    });
	$("#idfile").change(function(){
        readURL(this,'4');
    });
	$("#addressfile").change(function(){
        readURL(this,'5');
    });


/*** Preview image in customer section ***/
function uploadOnChange() {

		var allowedFiles = [".jpg" , ".jpeg", ".png", ".bmp", ".gif"];
        var fileUpload = $("#file");
		$("#file").attr('vale',fileUpload.val());
        var lblError = $("#imgfileerror");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.attr("vale").toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
        lblError.html('');
		var id ="#user";
		readURL(fileUpload,id);
        return false;
}

function companyOnChange() {

		var allowFiles = [".jpg" , ".jpeg", ".png", ".bmp", ".gif", ".pdf"];
        var uploadfile = $("#cidfile");
		$("#cidfile").attr('vale',uploadfile.val());
        var lblError = $("#cidfileerror");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowFiles.join('|') + ")$");
        if (!regex.test(uploadfile.attr("vale").toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowFiles.join(', ') + "</b> only.");
            return false;
        }
		lblError.html('');
		var id ="#companyid";
		readURL(uploadfile,id);      
        return true;
}
 

function cancelOnChange() {

		var allowedFiles = [".jpg" , ".jpeg", ".png", ".bmp", ".gif", ".pdf"];
        var uploadfile2 = $("#cancelfile");
		$("#cancelfile").attr('vale',uploadfile2.val());
        var lblError = $("#cancelfileerror");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(uploadfile2.attr("vale").toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
		lblError.html('');
		var id ="#cancelcheque";
		readURL(uploadfile2,id);
		return true;
}

function idproofOnChange() {

		var allowedFiles = [".jpg" , ".jpeg", ".png", ".bmp", ".gif", ".pdf"];
        var uploadfile3 = $("#idfile");
		$("#idfile").attr('vale',uploadfile3.val());
        var lblError = $("#idfileerror");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(uploadfile3.attr("vale").toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
		lblError.html('');
		var id ="#idproof";
		readURL(uploadfile3,id);
		return true;
}

function addressOnChange() {

		var allowedFiles = [".jpg" , ".jpeg", ".png", ".bmp", ".gif", ".pdf"];
        var uploadfile4 = $("#addressfile");
		$("#addressfile").attr('vale',uploadfile4.val());
        var lblError = $("#addressfileerror");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(uploadfile4.attr("vale").toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
		lblError.html('');
		var id ="#addressproof";
		readURL(uploadfile4,id);
		return true;
}
</script>
