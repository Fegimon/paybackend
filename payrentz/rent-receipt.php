<?php
require_once('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
Rent Receipt
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rent Receipt</li>
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
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal enqform" id="rentreceiptform">
              <div class="box-body row">
			  
			  <div class="col-lg-6">
                <div class="form-group">
                  <label for="cutomerreceipt" class="col-sm-3 control-label">Customer ID</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="cutomerreceipt" placeholder="Customer ID / Mobile">
					<div id="crerror" class="error"></div>
                  </div>
                </div>				  
				</div>
				<div class="col-lg-6">
				
                <div class="form-group">
                  <label for="receiptname" class="col-sm-3 control-label">Name</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="receiptname" placeholder="Name">
					<div id="rnameerror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">
				 <div class="form-group">
                  <label for="totalamt" class="col-sm-3 control-label">Total Amount</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="totalamt" placeholder="Total Amount">
					<div id="ramounterror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">
				 <div class="form-group">
                  <label for="receivedamt" class="col-sm-3 control-label">Received Amount</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="receivedamt" placeholder="Received Amount">
					<div id="receivederror" class="error"></div>
                  </div>
                </div>	
				
</div>
				<div class="col-lg-6">
				
                <div class="form-group">
                  <label for="mode" class="col-sm-3 control-label">Mode</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="paymenttype">
                    <option>Cash</option>
                    <option>Cheque</option>
                    <option>Online Transfer</option>
                  </select>
                  </div>				
                </div>
				</div>
				<div class="col-lg-6">
			
                <div class="form-group">
                  <label for="datepicker8" class="col-sm-3 control-label">Collected On</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" id="rentcolon" placeholder="dd/mm/yyyy">
					<div id="collectedonerror" class="error"></div>
                  </div>
                </div>
</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="rentcollectedby" class="col-sm-3 control-label">Collected By</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="rentcollectedby">
                    <option>Ananth</option>
                    <option>Jayakrishnan</option>
                  </select>
                  </div>				
                </div>

</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="rentdepositedby" class="col-sm-3 control-label">Deposited By</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="rentdepositedby">
                    <option>Ananth</option>
                    <option>Jayakrishnan</option>
                  </select>
                  </div>				
                </div>

				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="follow_status" class="col-sm-3 control-label">Follow-up Status</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="follow_status" placeholder="Follow-up Status">
					<div id="rstatuserror" class="error"></div>
                  </div>
                </div>		
</div>
				<div class="col-lg-6">
				<div class="form-group">
                  <label for="rent_remark" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea  rows="3" cols="60" id="rent_remark" placeholder="Enter ..."></textarea>
					<div id="rentremarkerror" class="error"></div>					
                  </div>
                </div>					
</div>
				

				

              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>
          </div>
		

		  
		 
		  
		
		              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right"  onClick="rentreceipt();">Send Receipt to Customer</button>
              </div>
		


		
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