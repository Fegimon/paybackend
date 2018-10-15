<?php
require_once('header.php');
?>
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header">
			<h1>View Customer Enquiry </h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">View Customer Enquiry</li>
			</ol>
		</section>

			

			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
        	<section class="col-lg-12">
	<div class="row searchspace">
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;" onclick="exporte('1','customer','enq')">
                <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Enquiry List  
			   </button>
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;" onclick="exporte('1','customer','enq_produt')">
               <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>   Enquiry Details 
			   </button>
			 </div>
				<div class="box box-info" id='e_table_list'>
						<div class="box-header with-border">
						</div>
						
					
					
					<div class="box-body">
					
							
							<div class="table-responsive" style="    min-height: 240px;">

							
							 <form id="frm-example">
								<table id="enquiry" class="display" cellspacing="0" width="100%">
								 <thead>
									  <tr>
										 <th><input name="select_all" value="1" type="checkbox"></th>
										 <th>Enquiry ID</th>
										 <th>Customer Name</th>
										 <th>Enquiry Date</th>
										 <th>Assigned To</th>
										 <th>Assigned By</th>
										 <th>Status</th>
										 <th>Action</th>
									  </tr>
								  </thead>
								  <tfoot>
									  <tr>
										 <th></th>
										 <th>Enquiry ID</th>
										 <th>Customer Name</th>
										 <th>Enquiry Date</th>
										 <th>Assigned To</th>
										 <th>Assigned By</th>
										 <th>Status</th>
										 <th>Action</th>
									  </tr>
								  </tfoot>
								
								</table>
							 
								
							</form>
						</div>
					  <!-- /.table-responsive -->
					</div>

				</div>
		  <div class="row">
        <!-- Left col -->
		
		            <div class="form-group" style="display:none;">
                  <div class="col-sm-12">
                    <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" onclick='userChange()' >
                      Existing User
                    </label>
					 <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick='userChange()'>
                      New User
                    </label>
                  </div>
                  </div>
                </div>
				
				
        <section class="col-lg-12">
        
				
		<div class="box box-primary" id="equiry_view" >
            <div class="box-header with-border">
              <h3 class="box-title">Enquiry View</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal enqform" method="post" action="config/save_enquiry.php">
			
              <div class="box-body">
			  
			<div class="row">
				<div class="col-lg-3">
			<div class="form-group">
                  <label for="e_id" class="col-sm-12 control-label">Enquiry ID</label>

                  <div class="col-sm-12">
                    <input type="" class="form-control" id="e_id" name="e_id"  disabled="disabled">
                  </div>
                </div>
                </div>
				<div class="col-lg-3">
                <div class="form-group">
                  <label for="cus_id" class="col-sm-12 control-label">Customer ID</label>

                  <div class="col-sm-12">
                    <input type="" class="form-control" id="cus_id" name="e_cus_id" placeholder="Customer ID / Mobile"  disabled="disabled">
                  </div>
                </div>
                </div>
				<div class="col-lg-3">
				
							<div class="form-group">
							  <label for="e_cus_name" class="col-sm-12 control-label">Customer Name</label>

							  <div class="col-sm-12">
								<input type="text" class="form-control" name='e_cus_name' id='e_cus_name' placeholder="Customer Name" disabled="disabled">								
							  </select>
							  </div>
							</div>
							</div>
							<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_mobile" class="col-sm-12 control-label">Mobile No.</label>
					  <div class="col-sm-12">
						<input class="form-control" id="e_mobile" name="e_mail" readonly>
						
					  
					  </div>
					</div>
                </div>
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_email" class="col-sm-12 control-label">Email</label>
					  <div class="col-sm-12">
						<input class="form-control" id="e_email" name="e_email" readonly>
						
					  
					  </div>
					</div>
                </div>
							
				
	<div class="col-lg-3">
                <div class="form-group">
                  <label for="e_date" class="col-sm-12 control-label">Date of Enquiry</label>

                  <div class="col-sm-12">
                    <input type="date" class="form-control pull-right"  name="e_date" id='e_date' placeholder="dd/mm/yyyy" disabled="disabled">
                  </div>
                </div>
                </div>
				<div class="col-lg-3">
				<div class="form-group">
                  <label for="e_attend" class="col-sm-12 control-label">Attended By</label>
                  <div class="col-sm-12">
                    <select class="form-control" id="e_attend" name="e_attend" disabled="disabled">
                    </select>
                  </div>
                </div>
                </div>
				<div class="col-lg-3">
				<div class="form-group">
                  <label for="e_assign" class="col-sm-12 control-label">Assigned To</label>
                  <div class="col-sm-12">
                    <select class="form-control" id="e_assign" name="e_assign" disabled="disabled">
                    
                  </select>
                  </div>
                </div>
                </div>
            </div>
			  <div class="row">
				
				<div class="col-lg-3">
				<div class="form-group">
                  <label for="e_f_date" class="col-sm-12 control-label">Follow-up On</label>

                  <div class="col-sm-12">
                    <input type="date" class="form-control pull-right" id="e_f_date" name="e_f_date" placeholder="dd/mm/yyyy" disabled="disabled">
                  </div>
                </div>
                </div>
				
				<div class="col-lg-3">		
				<div class="form-group">
                  <label for="remark" class="col-sm-12 control-label">Remarks</label>

                  <div class="col-sm-12">
                    <textarea  rows="3" cols="34" id="remark" name="e_remark" placeholder="Enter ..." disabled="disabled"></textarea>	
                  </div>
                </div>						
                </div>						
                </div>						
						
					 <!-- /.box-header -->
            <div class="box-body">
			
				<!--<div class="pull-right"><a  onclick="addVariant()">+</a></div>-->	
              <div class="table-responsive ">

				<table class="table no-margin" id='v_c_e_product'>
                  <thead>
                  <tr>
                    <th class="">Category</th>
					<th class="">Variant</th>
					<th class=" smalltd quantytb">Quantity</th>
					<th>Delivery</th>
					<th>Rent Duration</th>
					<th>Tenure</th>
					<th>Rent Cost</th>
					<th>Security Deposit</th>
					<th>Processing Fee</th>
					<th>Ins. Fee</th>
					
					</tr>
                  </thead>
                  <tbody>
				  
				  
          
                  </tbody>
                </table>
              </div>
	         
            </div>

			

               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                 <a onclick="showEnqTable()" class="btn btn-default">Cancel</a>
             
              </div>
              <!-- /.box-footer -->
            </form>
			
          </div>
		
			

		

        </section>
		
		<section class="col-lg-12">
        
				
		<div class="box box-primary" id="equiry_edit" >
            <div class="box-header with-border">
              <h3 class="box-title">Enquiry Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="config/save_edit_enquiry.php">
			
              <div class="box-body">
			  
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_id" class="col-sm-12 control-label">Enquiry ID</label>

					  <div class="col-sm-12">
						<input type="" class="form-control" id="e_e_id" name="e_id"  readonly>
					  </div>
					</div>
                </div>
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_cus_id" class="col-sm-12 control-label">Customer ID</label>

					  <div class="col-sm-12">
						<input type="" class="form-control" id="e_cus_id" name="e_cus_id" placeholder="Customer ID / Mobile"  readonly>
					  </div>
					</div>
                </div>
					<div class="col-lg-3">
						<div class="form-group">
								  <label for="e_e_cus_name" class="col-sm-12 control-label">Customer Name</label>

								  <div class="col-sm-12">
									<input type="text" class="form-control" name='e_cus_name' id='e_e_cus_name' placeholder="Customer Name" readonly>								
							
								  </div>
						</div>
					</div>
					<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_mobile" class="col-sm-12 control-label">Mobile No.</label>
					  <div class="col-sm-12">
						<input class="form-control" id="e_e_mobile" name="e_mail" readonly>
						
					  
					  </div>
					</div>
                </div>
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_email" class="col-sm-12 control-label">Email</label>
					  <div class="col-sm-12">
						<input class="form-control" id="e_e_email" name="e_email" readonly>
						
					  
					  </div>
					</div>
                </div>
					<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_date" class="col-sm-12 control-label">Date of Enquiry</label>

					  <div class="col-sm-12">
						<input type="date" class="form-control pull-right"  name="e_date" id='e_e_date' placeholder="dd/mm/yyyy" readonly>
					  </div>
					</div>
                </div>
					<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_attend" class="col-sm-12 control-label">Attended By</label>
					  <div class="col-sm-12">
						<select class="form-control" id="e_e_attend" name="e_attend" readonly>
						</select>
					  </div>
					</div>
                </div>
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_assign" class="col-sm-12 control-label">Assigned To</label>
					  <div class="col-sm-12">
						<select class="form-control" id="e_e_assign" name="e_assign" readonly>
						
					  </select>
					  </div>
					</div>
                </div>
				</div>
			<div class="row">
			
				
				<div class="col-lg-3">
					<div class="form-group">
					  <label for="e_e_f_date" class="col-sm-12 control-label">Follow-up On</label>

					  <div class="col-sm-12">
						<input type="date" class="form-control pull-right" id="e_e_f_date" name="e_f_date" placeholder="dd/mm/yyyy" readonly>
					  </div>
					</div>
                </div>
				
				<div class="col-lg-3">		
					<div class="form-group">
					  <label for="e_remark" class="col-sm-12 control-label">Remarks</label>

					  <div class="col-sm-12">
						<textarea class="form-control" rows="3" id="e_remark" name="e_remark" placeholder="Enter ..." readonly></textarea>	
					  </div>
					</div>		
			</div>
								
          	</div>				
						
					 <!-- /.box-header -->
            <div class="box-body">
				<div class="pull-right row"><a  class="tplus" onclick="addVariant()">+</a></div>	
              <div class="table-responsive ourtableblg">

				<table class="table no-margin" id='c_e_product'>
                  <thead>
                  <tr>
                    <th class="headcol">Category</th>
					<th class="headcol1">Variant</th>
					<th class="headcol2 smalltd quantytb">Quantity</th>
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
				  
				  
          
                  </tbody>
                </table>
              </div>
	         
            </div>

			

               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a onclick="showEnqTable()" class="btn btn-default">Cancel</a>
				<button type="submit" class="btn btn-info pull-right">Submit</button>
             
              </div>
              <!-- /.box-footer -->
            </form>
			
          </div>
		
			

		

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
		
		<section class="col-lg-12">
        
				
		<div class="box box-primary" id="equiry_payment" >
            <div class="box-header with-border">
              <h3 class="box-title">Payment Detail And Approval</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
			
              <div class="box-body">
			  <div class="col-lg-12">
			
			<div class="form-group col-sm-3">
                  <label for="p_e_id" class="col-lg-12 control-label">Enquiry ID</label>

                  <div class="col-lg-12">
                    <input type="" class="form-control" id="p_e_id" name="p_e_id"  readonly>
                  </div>
                </div>
			
				
				
                <div class="form-group col-sm-3">
                  <label for="p_cus_id" class="col-lg-12 control-label">Customer ID</label>

                  <div class="col-lg-12">
                    <input type="" class="form-control" id="p_cus_id" name="p_cus_id" placeholder="Customer ID / Mobile"  readonly>
                  </div>
                </div>
				
				           
							<div class="form-group col-sm-3">
							  <label for="p_cus_name" class="col-lg-12 control-label">Customer Name</label>

							  <div class="col-lg-12">
								<input type="text" class="form-control" name='p_cus_name' id='p_cus_name' placeholder="Customer Name" readonly>								
							  </select>
							  </div>
							</div>
			</div>
					 <!-- /.box-header -->
            <div class="box-body">
			<h3>Payment Detail</h3>
				<div class="pull-right"></div>	
              <div class="table-responsive">

				<table class="table no-margin" id='p_detail'>
                  <thead>
                    <tr>
                    <th>Enquiry Date</th>
					<th>Security Deposit Amount</th>
					<th>Processing Fee</th>
					<th>Insurence Fee</th>
					<th>Total Amt</th>
					<th>Received Amt</th>
					<th>Payment Status</th>
					<th>invoice Status</th>
					<th>invoice </th>
					</tr>
					 
                  </thead>
                  <tbody>
				  <tr>
				  <td><span id='p_e_date'></span>  </td>
				  <td><span id='p_s_amo'></span>  </td>
				  <td><span id='p_p_fee'></span>  </td>
				  <td><span id='p_i_fee'></span>  </td>
				  <td><span id='p_total_amount'></span>  </td>
				  <td><span id='p_r_amount'></span></td>
				  <td><span id='p_staus'></span></td>
				  <td><span id='p_m_status'></span></td>
				  <td><button  class="btn btn-info" onclick="quot_email()">Send</button></td>
				  </tr>
				  
          
                  </tbody>
                </table>
              </div>
	         
            </div>

			<div class="box-body">
			<h3>Payment History</h3>
				<div class="pull-right"></div>	
              <div class="table-responsive">

				<table class="table no-margin" id='p_history'>
                  <thead>
                    <tr>
                    <th>Received Amount</th>
					<th>Received On</th>
					<th>Payment Mode</th>
					<th>Collected On</th>
					<th>Collected By</th>
					<th>Deposit On</th>
					<th>Deposit By</th>
					</tr>
					 
                  </thead>
                  <tbody>
				
				  
          
                  </tbody>
                </table>
              </div>
	         
            </div>
			
			<div class="box-body">
			<h3>Payment Update</h3>
				<div class="pull-right"></div>	
              <div class="table-responsive">

				<table class="table no-margin" id='p_history'>
                  <thead>
                    <tr>
                    <th>Received Amount</th>
					<th>Received On</th>
					<th>Payment Mode</th>
					<th>Collected On</th>
					<th id="colby">Collected By</th>
					<th >Deposit On</th>
					<th id="depby">Deposit By</th>
					</tr>
					 
                  </thead>
                  <tbody>
				  <tr>
				  <td><input type="number" class="form-control" id="p_rec_amount" name="pay_rec_amount"   > 
				  <div id="receivederror" class="error"></div>	
				  </td>
				  <td><input type="date" class="form-control" id="pay_rec_on" name="pay_rec_on"  >
					<div id="paymenterror" class="error"></div>	
				  </td>
				  <td>
				  <select class="form-control" id="pay_mode" name="pay_mode" >
				   <option value='1'>Cash</option>
                    <option value='2'>Cheque</option>
                    <option value='3'>Online Transfer</option>
                    </select> 
					</td>
				  <td><input type="date" class="form-control" id="p_collect_on" name="p_collect_on"> 
					<div id="collectederror" class="error"></div>	
				  </td>
				  <td ><select class="form-control" id="p_collect_by" name="p_collect_by" >
                    </select></td>
				  <td><input type="date" class="form-control" id="p_deposit_on" name="p_deposit_on" >
				  <div id="depositerror" class="error"></div>	
				  </td>
				  <td ><select class="form-control" id="p_deposit_by" name="p_deposit_by" >
                    </select></td>
				  </tr>
				  
          
                  </tbody>
                </table>
				<button  class="btn btn-info pull-right" onclick="saveDepositAmount()">Update Cost</button>
              </div>
	         
            </div>

                                  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a onclick="showEnqTable()" class="btn btn-default">Cancel</a>
				
                <button  class="btn btn-info pull-right" data-toggle="modal" data-target="#approveProductModal">Approve enquiry</button>
              </div>
              <!-- /.box-footer -->
            
			
          </div>
		
			

		

        </section>
      
      </div>
		  	  
			  
			
			
			</section>
			
			<div class="modal fade" tabindex="-1" role="dialog" id="approveProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Approve Enquiry</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Do you really want to Approve ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..." onclick="enquiryFinalaze('approve')"> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->

	<div class="modal fade" tabindex="-1" role="dialog" id="blockenquiry">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Customer Status</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Sorry,This enquiry can't remove.</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<div class="modal fade" tabindex="-1" role="dialog" id="removeEnquiryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Close Customer</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Do you really want to close?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..." onclick="removeEnquiryStatus()"> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->	

<div class="modal fade" tabindex="-1" role="dialog" id="sucessclose" backdrop='false' keyboard='false'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reloadfn()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i>Enquiry Remove Status</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>The enquiry removed sucessfully.</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadfn()"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->

          <div class="modal fade" id="cmodalview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body remark">
	  
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="inputPassword3" rows="3" placeholder="Enter ..."></textarea>	
                  </div>
                </div>	
				
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cmodalterminate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body remark">
	  
				<div class="form-group">
                  <label for="cmodalterminateinputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="cmodalterminateinputPassword3" rows="3" placeholder="Enter ..."></textarea>	
                  </div>
                </div>	
				
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="advView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Customer Enquiry View</h4>
      </div>
      <div class="modal-body">
	   		<section class="content">
			<div class="row">
				<section class="col-lg-12">
					<div class="">
						
            
					<form class="form-horizontal" id="arentreceiptform">
						
									<input type="text" class="form-control" id="d_id" style='display:none'>
														
							<div class="col-lg-6">
							<div class="form-group">
								<label for="cutomerreceipt" class="col-sm-3 control-label">Customer ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="cutomerreceipt" placeholder="Customer ID / Mobile" readonly>
									<div id="arerror" class="error"></div>
								</div>
							</div>				  
							</div>
							<div class="col-lg-6">
				
							<div class="form-group">
								<label for="receiptname" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="receiptname" placeholder="Name" readonly>
									<div id="anameerror" class="error"></div>
								</div>
							</div>	
                            </div>
							<div class="col-lg-6">							
						
							<div class="form-group">
								<label for="amount" class="col-sm-3 control-label">Total Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" placeholder="Amount" readonly>
									<div id="tamounterror" class="error"></div>
								</div>
							</div>	
							</div>
							<div class="col-lg-6">
							
							<div class="form-group">
								<label for="recvamount" class="col-sm-3 control-label">Received Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="recvamount" placeholder="Received Amount" readonly>
									<div id="receivederror" class="error"></div>
								</div>
							</div>
			
			</div>
							<div class="col-lg-6">
							<div class="form-group">
								<label for="voucherno" class="col-sm-3 control-label">Voucher No.</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="voucherno" placeholder="Voucher No">
									<div id="vouchererror" class="error"></div>
								</div>
							</div>
</div>
							<div class="col-lg-6">							

							<div class="form-group">
								<label for="datepicker9" class="col-sm-3 control-label">Date of Purchase</label>
									<div class="col-sm-9">
										<input type="date" class="form-control pull-right" id="datepicker9" readonly>
										<div id="purchaseerror" class="error"></div>
									</div>
							</div>
							
							</div>
							<div class="col-lg-6">
							<div class="form-group">
							  <label for="paytypeadvance" class="col-sm-3 control-label">Payment Type</label>
							  <div class="col-sm-9">
									<select class="form-control" name="paytypeadvance" id="paytypeadvance" readonly>
										<option value="1">Cash</option>
										<option value="2">Cheque</option>
										<option value="3">Online</option>
									</select>
							  </div>				
							</div>
							</div>
							<div class="col-lg-6">						
							<div class="form-group">
								<label for="receipt_remark" class="col-sm-3 control-label">Remarks</label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" id="receipt_remark" placeholder="Enter ..."></textarea>	
									<div id="aremarkerror" class="error"></div>
								</div>
							</div>					
							</div>
			
						<div class="box-footer">
							
							<a id="downloadview" style="display:none">Cancel</a>
							<button type="submit" class="btn btn-info pull-right" onClick="advancereceipt();">Submit</button>
						</div> 
					</form>
				</div>

		
        </section>
		
		
		
		
		

			  
			  
		
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>     
				
     </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		   </div>
    </div>
  </div>
</div>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
	  </section>

     <!-- /.content -->
  </div>  
  
  
  <!-- /.content-wrapper -->
  <?php
  require_once('footer.php');
?>


<script>

$('#pay_mode').on('change', function() {
 if(this.value == '3')
 {
	 $("#p_collect_by").parent("td").hide();
	 $("#p_deposit_by").parent("td").hide();
         $("#colby").hide();
	 $("#depby").hide();
	 
 }
 else
 {
	  $("#p_collect_by").parent("td").show();
	  $("#p_deposit_by").parent("td").show();
          $("#colby").show();
	  $("#depby").show();
       
 }
})

</script>