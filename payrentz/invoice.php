<?php
require_once('header.php');

?>



<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">



		<section class="content-header">



			<h1>Invoice</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Invoice</li>
			</ol>
		</section>

			<div class="row">
<div class="col-md-4">
	<div class="checkbox">
                     <label>
                        <input type="button" class="btn btn-primary sndnoti" sndtype="sms" value="Send SMS" />
                      </label>
                      <label>
                        <input type="button" class="btn btn-primary sndnoti" sndtype="email" value="Send Email" />
                      </label>
<!---<button type="button" class="btn btns btn-labeled btn-default btn-defaults pull-right sndnotit"  style="margin-right: 5px;margin-bottom: 10px;" sndtype="sms" >
                 <span class="btn-label-default"> <i class="fa fa-mobile" aria-hidden="true"></i></span> Send SMS
			   </button>
  <button type="button" class="btn btns btn-labeled btn-default btn-defaults pull-right sndnotit"  style="margin-right: 5px;margin-bottom: 10px;" sndtype="email" >
               <span class="btn-label-default"> <i class="fa fa-envelope" aria-hidden="true"></i></span>   Send Email
			   </button>-->
                    </div>
</div>
<div class="col-md-8 checkbox">
				<button type="button" class="btn btns btn-labeled btn-default btn-defaults pull-right"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','current')">
                 <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Mapped Details
			   </button>
  <button type="button" class="btn btns btn-labeled btn-default btn-defaults pull-right"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','invoice')" >
               <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>   Invoice Details
			   </button>
				 
				 <?php

				 if($_SESSION['username'] == "ananth")
				 {


				 ?>
                <button type="button" class="btn btns btn-labeled btn-default btn-defaults pull-right" style="margin-right: 5px;margin-bottom: 10px;"  onclick="genrateInvoice();"><span class="btn-label-default"> <i class="fa fa-file-text-o" aria-hidden="true"></i></span>  Generate Invoice</button>
               <?php
						 }
							 ?>

</div>
</div>


    <!-- Main content -->
	<section class="content">
		<div class="row">
        	<section class="col-lg-12">



			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Invoice List</h3>

              <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div> -->
            </div>
            <!-- /.box-header -->


            <div class="box-body">


              <div class="table-responsive">


               <!---- <table class="table no-margin">
                  <thead>
                  <tr>
				    <th>Select</th>
                    <th>Date</th>
					<th>Bill No.</th>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Status</th>
					<th>Rent</th>
					<th>Other Charges</th>
					<th>Followup</th>
					<th>Action</th>
                  </tr>
                  </thead>
                  <tbody>


<tr>
<td><input type="checkbox" /></td>
<td>18/10/2016</td>
<td>343123</td>
<td>Cust123</td>
<td>Venkat</td>
<td>waiting for approval</td>
<td>3000</td>
<td>1500</td>
<td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Click</button></td>
<td><a href="#">Edit</a> | <a data-toggle="modal" data-target="#invoiceview" href="#">View</a></td>
</tr>


<tr>
<td><input type="checkbox" /></td>
<td>18/10/2016</td>
<td>343123</td>
<td>Cust123</td>
<td>Venkat</td>
<td>waiting for approval</td>
<td>3000</td>
<td>1500</td>
<td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Click</button></td>
<td><a href="#">Edit</a> | <a data-toggle="modal" data-target="#invoiceview" href="#">View</a></td>
</tr>


<tr>
<td><input type="checkbox" /></td>
<td>18/10/2016</td>
<td>343123</td>
<td>Cust123</td>
<td>Venkat</td>
<td>waiting for approval</td>
<td>3000</td>
<td>1500</td>
<td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Click</button></td>
<td><a href="#">Edit</a> | <a data-toggle="modal" data-target="#invoiceview" href="#">View</a></td>
</tr>
</tbody>
</table>-->

			<form id="frm-example">
				<table id="example" class="display" cellspacing="0" width="100%">
				 <thead>
					  <tr>
						 <th><input name="select_all" value="1" type="checkbox"></th>
						 <th>Customer ID</th>
						 <th>Customer Name</th>
						 <th>Total</th>
						 <th>Received</th>
						 <th>Balance</th>
						 <th>Sms</th>
						 <th>Email</th>
						 <th>Action</th>
					  </tr>
				  </thead>
				  <tfoot>
					  <tr>
						 <th></th>
						 <th>Customer ID</th>
						 <th>Customer Name</th>
						 <th>Total</th>
						 <th>Received </th>
						 <th>Balance</th>
						 <th>Sms</th>
						 <th>Email</th>
						 <th>Action</th>
					  </tr>
				  </tfoot>

			    </table>

			    <p><button type="submit">Submit</button></p>
			</form>
    </div>
	  <!-- /.table-responsive -->
  </div>

</div>





			</section>


		 <!-- Service Initiative-->
		 <div id="amountChange" class="modal fade" role="dialog">
  			<div class="modal-dialog">
			   <div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h4 class="modal-title">Invoice Cost</h4>
      				</div>
      				<div class="modal-body">
      				<form id="serviceinitiaprocess">
        				<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
								  <label for="t_rent_cost" class="col-sm-12 control-label">Total Rent Cost</label>
								  <div class="col-sm-12">
								  <input class="form-control"  type="text" name="t_rent_cost" id="t_rent_cost">
								  </div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="l_pay_charge" class="col-sm-12 control-label">Late Payment Charge</label>
									 <div class="col-sm-12">
									<input class="form-control"  type="text" name="l_pay_charge" id="l_pay_charge">
									<div id="serviceissueerror" class="error"></div>
									</div>
							  </div>
							  </div>

							  <div class="col-lg-4">
								<div class="form-group">
									<label for="tax" class="col-sm-12 control-label">Tax</label>
									 <div class="col-sm-12">
									<input class="form-control"  type="text" name="tax" id="tax">
									<div id="serviceremarkserror" class="error"></div>
									</div>
							  </div>
							  </div>
							   <div class="col-lg-4">
								<div class="form-group">
									<label for="p_amonunt" class="col-sm-12 control-label">Pending Amount</label>
									 <div class="col-sm-12">
									<input class="form-control"  type="text" name="p_amonunt" id="p_amonunt">
									<div id="serviceremarkserror" class="error"></div>
									</div>
							  </div>
							  </div>
							   <div class="col-lg-4">
								<div class="form-group">
									<label for="e_cost" class="col-sm-12 control-label">Extra Cost</label>
									 <div class="col-sm-12">
									<input class="form-control"  type="text" name="e_cost" id="e_cost">
									<div id="serviceremarkserror" class="error"></div>
									</div>
							  </div>
							  </div>
					  </div>
					  <br/>
					  <button type="button" class="btn btn-default pull-right" onclick="editInvoiceCost()">Save</button>

					  <br/>
					 </form>
      				</div>
      				<div class="modal-footer">

        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      				</div>
    			</div>
    		</div>
		</div>





<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rent Follow-up</h4>
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

<div class="modal fade" id="rentfollowup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style='width:100%'>
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rent Follow-up</h4>
      </div>
      <div class="modal-body" >



				            <div class="box-body">

			<div class="row">
        <!-- Left col -->
        <section class="col-lg-12">


		<div class="">

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
                  <label for="balance" class="col-sm-3 control-label">Balance Amount</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="balance" placeholder="Balance Amount">
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
                  <label for="paymenttype" class="col-sm-3 control-label">Mode</label>
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
                  <label for="rentcolon" class="col-sm-3 control-label">Collected On</label>

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

                  </select>
                  </div>
                </div>
                </div>
				<div class="col-lg-6">

                <div class="form-group">
                  <label for="rendepcolon" class="col-sm-3 control-label">Deposited On</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" id="rendepcolon" placeholder="dd/mm/yyyy">
					<div id="collectedonerror" class="error"></div>
                  </div>
                </div>
               </div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="rentdepositedby" class="col-sm-3 control-label">Deposited By</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="rentdepositedby">

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
	<div class="col-lg-6">
				<div class="form-group">
                  <label for="rent_rpt" class="col-sm-3 control-label">Send Receipt</label>

                  <div class="col-sm-9">
                   <input   id="rent_rpt" type="checkbox">
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
                <button data-dismiss="modal" class="btn btn-default">Cancel</button>
                <button  class="btn btn-info pull-right" id="rentFollowBtn" onClick="rentreceipt()">Update</button>
              </div>




        </section>









        <!-- right col -->
      </div>




              </div>
              <!-- /.table-responsive -->
		             </div>


     </div>

    </div>
  </div>
</div>


        <!-- right col -->

      <!-- /.row (main row) -->




    </section>
    <!-- /.content -->




  </div>
  <!-- /.content-wrapper -->
  <?php
  require_once('footer.php');
?>
