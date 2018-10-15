<?php
require_once('header.php');
?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Advance Receipt</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Advance Receipt</li>
				</ol>
		</section>
		
		<section class="content">
			<div class="row">
				<section class="col-lg-12">
					<div class="box box-primary">
						
            
					<form class="form-horizontal enqform" id="arentreceiptform">
						<div class="box-body row">	
							<div class="col-lg-6">
							<div class="form-group">
								<label for="cutomerreceipt" class="col-sm-3 control-label">Customer ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="cutomerreceipt" placeholder="Customer ID / Mobile">
									<div id="arerror" class="error"></div>
								</div>
							</div>				  
							</div>
							<div class="col-lg-6">
				
							<div class="form-group">
								<label for="receiptname" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="receiptname" placeholder="Name">
									<div id="anameerror" class="error"></div>
								</div>
							</div>	
</div>
							<div class="col-lg-6">							
						
							<div class="form-group">
								<label for="amount" class="col-sm-3 control-label">Total Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" placeholder="Amount">
									<div id="tamounterror" class="error"></div>
								</div>
							</div>	
							</div>
							<div class="col-lg-6">
							
							<div class="form-group">
								<label for="amount" class="col-sm-3 control-label">Received Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="recvamount" placeholder="Received Amount">
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
										<input type="date" class="form-control pull-right" id="datepicker9">
										<div id="purchaseerror" class="error"></div>
									</div>
							</div>
							
							</div>
							<div class="col-lg-6">
							<div class="form-group">
							  <label for="maincategorylist" class="col-sm-3 control-label">Payment Type</label>
							  <div class="col-sm-9">
									<select class="form-control" name="paytypeadvance" id="paytypeadvance">
										<option value="cash">Cash</option>
										<option value="cheque">Cheque</option>
										<option value="online">Online</option>
									</select>
							  </div>				
							</div>
								</div>
							<div class="col-lg-6">						
							<div class="form-group">
								<label for="receipt_remark" class="col-sm-3 control-label">Remarks</label>
								<div class="col-sm-9">
									<textarea rows="3" cols="60" id="receipt_remark" placeholder="Enter ..."></textarea>	
									<div id="aremarkerror" class="error"></div>
								</div>
							</div>					
</div>
							
						</div>
					</div>
              
						<div class="box-footer">
							<button type="submit" class="btn btn-default">Cancel</button>
							<a id="downloadview" style="display:none">Cancel</a>
							<button type="submit" class="btn btn-info pull-right" onClick="advancereceipt();">Submit</button>
						</div> 
					</form>
		


		
        </section>
		
		
		
		
		

			  
			  
		
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