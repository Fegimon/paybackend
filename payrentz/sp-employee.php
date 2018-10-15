<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Employee</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Employee</li>
			</ol>
		</section>
			  
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addemployee">
			<form class="form-horizontal" id="employeeform">
				  <div class="box-body">
					<div class="col-lg-10">
					<div class="col-lg-3">
						<div class="form-group">						
						  <label for="empyname" class="col-sm-12 control-label">Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="empyname">
								<div id="empynameerror" class="error"></div>
							</div>
						</div>
					</div>
						
					<div class="col-lg-3">
						<div class="form-group">						
						  <label for="empymbl" class="col-sm-12 control-label">Mobile Number</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="empymbl">
								<div id="empymblerror" class="error"></div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">						
						  <label for="empemail" class="col-sm-12 control-label">Email ID</label>
							<div class="col-sm-12">
								<input type="email" class="form-control" id="empemail">
								<div id="empemailerror" class="error"></div>
							</div>
						</div>
					</div>
						
					<!-- <div class="col-lg-1">
						<div class="form-group">
						<label for="editstatuszone" class="col-sm-12 control-label">Status</label>
						<div class="col-sm-12">
							<input type="checkbox" name="editstatuszone" id="editstatuszone" value="Active"> 
						</div>
						</div>
					</div> -->
					
					<div class="col-lg-3">
						<div class="form-group">						
							<label for="empdesignation" class="col-sm-12 control-label">Designation</label>
							<div class="col-sm-12">
								<textarea rows="1" cols="30" id="empdesignation"></textarea>
								<div id="empdescerror" class="error"></div>
							</div>
						</div>
					</div>
				</div>
					
					<div class="col-lg-2">					
						<div class="col-sm-2 status-button">
							<button type="submit" class="btn btn-info pull-right" onclick="addemployee()">Add</button>	
						</div>				  
					</div>				  
				 </div>
			</form>	
		</div>	

		<div class="col-lg-12 editemployee" hidden>
			<form class="form-horizontal">
				  <div class="box-body">
				
				<div class="col-lg-10">				
				<div class="col-lg-3">	
					<div class="form-group">						
						<label for="editempyname" class="col-sm-12 control-label">Name</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="editempyname">
							<div id="editempynameerror" class="error"></div>
							<input type="hidden" class="form-control" id="editempyid">
						</div>
					</div>
				</div>
						
				<div class="col-lg-3">	
					<div class="form-group">
						<label for="editempymbl" class="col-sm-12 control-label">Mobile Number</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="editempymbl">
							<div id="editempymblerror" class="error"></div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">	
					<div class="form-group">
					<label for="editempemail" class="col-sm-12 control-label">Email ID</label>
						<div class="col-sm-12">
							<input type="email" class="form-control" id="editempemail">
							<div id="editempemailerror" class="error"></div>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">	
					<div class="form-group">
					<label for="editempdesignation" class="col-sm-12 control-label">Designation</label>
						<div class="col-sm-12">
							<textarea rows="1" cols="30" id="editempdesignation"></textarea>
							<div id="editempdescerror" class="error"></div>
						</div>
					</div>
				</div>
				</div>
						
				<div class="col-lg-2">	
					<div class="col-sm-2 status-button">
						<button type="submit" class="btn btn-info pull-right" onclick="editemployeedetails()" style="margin-right:10px;">Save</button>	
						<button type="submit" class="btn btn-info pull-right" onclick="noteditemployeedetails()">Back</button>	
						</div>				  
					</div>					  
				 </div>
			</form>	
		</div>			
		
        	<section class="col-lg-12">
			
			
			
			<div class="box box-info">
             <!-- <div class="box-header with-border">
              <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> 
            </div> -->
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive" >

					
                <table class="table no-margin" id="employeetable">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th><th>Mobile</th><th>Email</th>
										<th>Designation</th>
										<th colspan="2">Action</th>
				  </tr>
                  </thead>
                  <tbody>
				  
				  
  
				  
				  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
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
<script>
//Got the zone
	 function employeetable()
	 {	
		$('#employeetable tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "gotemployeedetails"				
			},
			type:"post",
			success: function(data)
				{
				  console.log(JSON.parse(data));
				  var data = JSON.parse(data);
				  for (var i=0; i<data.length; i++) {
						var vendorid = data[i].id;
						if(data[i].status == 1)
							statusdetails = '<i class="fa fa-check" aria-hidden="true"></i>';
						else
							statusdetails = '<i class="fa fa-ban" aria-hidden="true"></i>';
						var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + data[i].mobile + '</td><td>' + data[i].email + '</td><td>' + data[i].designation + '</td><td><a onClick="editemployee('+vendorid+');" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deleteemployee('+vendorid+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td></td></tr>');
						$('#employeetable').append(row);
					}			  
				}
			});
	}
		
	
		window.onload = function() {
			employeetable();
		}
		
</script>