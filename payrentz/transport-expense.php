<?php
require_once('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
Transport Expense
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transport Expense</li>
      </ol>
    </section>

    <!-- Main content -->



	<section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable ">
         <div class=" searchspace" >

			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','tranport')">
                <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>   Transport Details
			   </button>

			 </div>

		<div class="box box-primary">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal enqform" id="trannsportprocess">
              <div class="box-body row">

			  <div class="col-lg-6">

                <div class="form-group">
                  <label for="datepicker13" class="col-sm-3 control-label">Date of Transport</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" name="transportdate" id="datepicker13" placeholder="dd/mm/yyyy" onblur="handler(event);">
					<div id="datepicker13error" class="error"></div>
                  </div>
                </div>
			</div>
			<div class="col-lg-6">

                <div class="form-group">
                  <label for="transport_amount" class="col-sm-3 control-label">Amount</label>

                 <div class="col-sm-9">
                    <input type="number" min='0' class="form-control" name="transport_amount" id="transport_amount" placeholder="Amount">
					<div id="transport_amounterror" class="error"></div>
                  </div>
                </div>
				</div>
			<div class="col-lg-6">

				<div class="form-group" style="margin-bottom:0px;">
                  <label for="transport_remark" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea  rows="3" cols="56" name="transport_remark" id="transport_remark" placeholder="Enter ..."></textarea>
					<div id="transport_remarkerror" class="error"></div>
                  </div>
                </div>

				</div>
			<div class="col-lg-6">


                <div class="form-group">
                  <label for="driverid" class="col-sm-3 control-label">Driver ID</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="driverid"  name="driverid" placeholder="Driver ID">
					<div id="driveriderror" class="error"></div>
                  </div>
                </div>
			</div>
			<div class="col-lg-6">

                <div class="form-group">
                  <label for="license" class="col-sm-3 control-label">License</label>

                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="license" name="license" placeholder="License">
					<div id="licenseerror" class="error"></div>
                  </div>
                </div>

				</div>
			<div class="col-lg-6">

                <div class="form-group">
                  <label for="validtill" class="col-sm-3 control-label">Valid Till</label>

                  <div class="col-sm-9">
                    <input type="date" class="form-control pull-right" name="validtill" id="validtill" placeholder="dd/mm/yyyy">
					<div id="validtillerror" class="error"></div>
                  </div>
                </div>
			</div>


              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->

			 <div class="box-body">

				<div class="pull-right"><a onclick="addtransportlist();" style="cursor:pointer" href="">+</a></div>
              <div class="table-responsive">

				<table class="table no-margin" id="transportlistadd">
                  <thead>
                  <tr>
                    <th>Customer ID</th>
					<th>Product ID</th>
					<th>Action</th>
					</tr>
                  </thead>
                  <tbody>


                  </tbody>
                </table>
              </div>

            </div>
			<div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" onclick="transadd()">Submit</button>
              </div>

  	</form>

	<div class="box-body">
		<div class="col-lg-12">
			<table id="transporttableid" class="display" cellspacing="0" width="100%">
			 <thead>
				<tr style="background:#ccc;">
          <th ></th>
				 <th style="padding:10px">Customer ID</th>
				 <th>Product ID</th>
				 <th>Delivery Date</th>
         <th>Return Date</th>
        <th>Process</th>
				</tr>
			  </thead>
			  <tbody>
			  </tbody>
          </table>
		</div>
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
<script type="text/javascript">
  var ctr = 0;
  function addtransportlist() {
    event.preventDefault();
    ctr++;
    var product = "transport_product" + ctr;
    var customer = "transport_id" + ctr;
    var newTr = '<tr><td><input type="text"  class="form-control" onblur="transport_product(this,'+ ctr +')" id=' + product + ' name="transport_product[]" placeholder="Customer ID"/></td><td><input name="transportcustome_id[]"  class="form-control" type="text" id=' + customer + ' placeholder="Product ID "/></td><td> <a class="trnsport_remove" href=""> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td></tr>';
    $('#transportlistadd').append(newTr);
};


$(document).on('click', '.trnsport_remove', function () {
     event.preventDefault();
     $(this).closest('tr').remove();
     return false;
  });


  function tranportlist() {
	   $.ajax({
		type:"post",
        url: "config/transporttableid.php",
		data :{
			type:"transportexpanse"
		},
        success: function (data) {
			console.log(data);
			data = JSON.parse(data);
				for (var i=0; i<data.length; i++) {

                   if(data[i].delivery_status == 0 )
				   {
					   var pro = 'Delivery';
				   }
                   else
			       {
					   var pro = 'Pickup' ;
                   }
           		    var row = $('<tr><td><input class="checkbox1" type="checkbox"></td><td style="padding:10px;text-transform: uppercase;">' + data[i].customer_id+ '</td><td>' + data[i].product_id + '</td><td>' +  data[i].delivery_date + '</td><td>' +  data[i].return_date + '</td><td>' + pro + '</td></tr>');
           		 $('#transporttableid').append(row);
        		}


        }
    });
};
tranportlist();
</script>
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

$(document).on('change',".checkbox1",function(event) {
  var product  =$(this).parents('tr').children('td').eq(2).text();
  var customer =$(this).parents('tr').children('td').eq(1).text();
  if($(this).is(":checked")){
  //  alert($(this).parents('tr').children('td').eq(2).text());

    var newTr = '<tr><td><input type="text"  class="form-control" onblur="transport_product(this,0)" id="' + product + '" value="' + product + '" name="transport_product[]" placeholder="Customer ID"/></td><td><input name="transportcustome_id[]"  class="form-control" type="text" id=' + customer + ' value="' + customer + '" placeholder="Product ID "/></td><td> <a class="trnsport_remove" href=""> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td></tr>';
    $('#transportlistadd').append(newTr);
      }
      else {
      $("#"+product+"").parents('tr').remove();
      }
    });

</script>
