<?php
require_once('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       General Expense
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">General Expense</li>
      </ol>
    </section>

    <!-- Main content -->
    
	
	
	
			
				
	<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable ui-sortable">
          <div class=" searchspace" >
			
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','gen_expence')">
                 <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  General Expense Details 
			   </button>
			  
			 </div>
				
		<div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal enqform" id="generalexpenseform">
              <div class="box-body row">
			  
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="expensedate" class="col-sm-3 control-label">Date of Expense</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" id="expensedate" placeholder="dd/mm/yyyy">
					<div id="dexpenseerror" class="error"></div>
                  </div>
                </div>
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="expenseid" class="col-sm-3 control-label">Customer ID</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="expenseid" placeholder="Customer ID / Mobile">
					<div id="giderror" class="error"></div>
                  </div>
                </div>				  
                </div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="expenseproduct" class="col-sm-3 control-label">Product ID</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="expenseproduct" placeholder="Product ID">
					<div id="gpiderror" class="error"></div>
                  </div>
                </div>				  				
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="expensereason" class="col-sm-3 control-label">Reason</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="expensereason" placeholder="Reason">
					<div id="reasonerror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">

				
                <div class="form-group">
                  <label for="expenseamount" class="col-sm-3 control-label">Amount</label>

                 <div class="col-sm-9">
                    <input  type="number" min='0'  class="form-control" id="expenseamount" placeholder="Amount">
					<div id="amounterror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">
			
                <div class="form-group">
                  <label for="expenseperson" class="col-sm-3 control-label">Person</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="expenseperson" placeholder="Person">
					<div id="personerror" class="error"></div>
                  </div>
                </div>	 
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="expensepay" class="col-sm-3 control-label">Pay</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="expensepay" placeholder="Pay">
					<div id="payerror" class="error"></div>
                  </div>
                </div>					
</div>
				<div class="col-lg-6">

				<div class="form-group">
                  <label for="expense_remark" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea  rows="3" cols="60" id="expense_remark" placeholder="Enter ..."></textarea>	
					<div id="gremarkerror" class="error"></div>
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
                <button type="submit" class="btn btn-info pull-right" onclick="generalexpense();">Submit</button>
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


<script>
var dew = 0;
$(document).on('change',"input[type='date']",function(event) {
	var a = $(this).val();
    var arr = a.split("-");
	
	if(parseInt(arr[0]) > 2050)
	{
		$(this).val(dew);
	    	
	}
	else
	{
		dew = a;
		
	}
	 if(arr[0].length <= 4)
	{
		dew = a;
	}		
	else
	{
		$(this).val(dew);
	}
});

$(document).on('keypress',"input[placeholder='Phone ']",function(event) {
	if($(this).val().length > 9)
	{
		return false;
	}
	  var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});

$(document).on('keypress',"input[placeholder='Mobile']",function(event) {
	if($(this).val().length > 9)
	{
		return false;
	}
	  var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});

</script>