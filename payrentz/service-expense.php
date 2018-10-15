<?php
require_once('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
Service Expense
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Service Expense</li>
      </ol>
    </section>

    <!-- Main content -->
    
	
	
	
			
				
	<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable ui-sortable">
        
				
		<div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal enqform" id="serviceexpenseform">
              <div class="box-body row">
			  <div class="col-lg-6">
                              
                <div class="form-group">
                  <label for="service_product" class="col-sm-3 control-label">Product ID</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="service_product" placeholder="Product ID">
					<div id="proiderror" class="error"></div>
                  </div>
                </div>				  				
				</div>
				<div class="col-lg-6">
				
                <div class="form-group">
                  <label for="warranty_service" class="col-sm-3 control-label">Warranty</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="warranty_service" placeholder="Warranty">
					<div id="warrantyerror" class="error"></div>
                  </div>
                </div>	
				
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="issuetype" class="col-sm-3 control-label">Issue Type</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="issuetype" placeholder="Issue Type">
					<div id="issueerror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">
				
				
                <div class="form-group">
                  <label for="service_amount" class="col-sm-3 control-label">Amount</label>

                 <div class="col-sm-9">
                    <input  type="number" min='0'  class="form-control" id="service_amount" placeholder="Amount">
					<div id="amounterror" class="error"></div>
                  </div>
                </div>	
				</div>
				<div class="col-lg-6">

				<div class="form-group" style="margin-bottom:0px;">
                  <label for="service_remark" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea rows="3" cols="60"id="service_remark" placeholder="Enter ..."></textarea>	
					<div id="servicereamrkerror" class="error"></div>
                  </div>
                </div>					
</div>
				<div class="col-lg-6">
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Waiver</label>
                    <div class="radio">
                    <label>
                      <input type="checkbox" name="optionsRadios" id="serivceexpwaiver" value="option1" checked="">
                      Yes
                    </label>
                  </div>
                </div>
				</div>
				<div class="col-lg-6">
				
                <div class="form-group">
                  <label for="servicestartfrom" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" id="servicestartfrom" placeholder="dd/mm/yyyy">
					<div id="frdateerror" class="error"></div>
                  </div>
                </div>
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                  <label for="serviceendto" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" id="serviceendto" placeholder="dd/mm/yyyy">
					<div id="todateerror" class="error"></div>
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
                <button type="submit" class="btn btn-info pull-right" onclick="serviceexpense()">Submit</button>
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