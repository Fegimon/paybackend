<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	
		  
		<section class="content-header">
		
		
			<h1>City</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">City</li>
			</ol>
		</section>
			  
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addcity">
			<form class="form-horizontal" id="addcityform">
				  <div class="box-body">
				  <div class="col-lg-10">
					<div class="col-lg-3">
						<div class="form-group">
							<label for="zonestate" class="col-sm-12 control-label">State</label>
							<div class="col-sm-12">
								<select class="form-control" id="zonestate" >
								</select>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="cityname" class="col-sm-12 control-label">City</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="cityname">
								<div id="cityerror" class="error"></div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-1">
						<div class="form-group">
						<label for="statuscity" class="col-sm-12 control-label">Status</label>
							<div class="col-sm-12">
								<input type="checkbox" name="statuscity" id="statuscity" value="Active"> 
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="citydescription" class="col-sm-12 control-label">Description</label>
							<div class="col-sm-12">
								<textarea rows="1" cols="35" id="citydescription"></textarea>
								<div id="citydescerror" class="error"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2">				
					<div class="col-lg-2 status-button">
							<button type="submit" class="btn btn-info pull-right" onclick="addcities()">Add</button>	
					</div>				  
				</div>
			 </div>
			</form>	
		</div>	

		<div class="col-lg-12 editcity" hidden>
			<form class="form-horizontal">
				  <div class="box-body">
				  <div class="col-lg-10">
					<div class="col-lg-4">
						<div class="form-group">
						  <label for="editcityname" class="col-sm-12 control-label">City</label>
							<div class="col-sm-12">
							<input type="text" class="form-control" id="editcityname">
							<div id="ecityerror" class="error"></div>
							<input type="hidden" class="form-control" id="editcityid">
						  </div>
						</div>
					</div>
					
					<div class="col-lg-1">
						<div class="form-group">  
						<label for="editcitystate" class="col-sm-12 control-label">Status</label>
							<div class="col-sm-12">
								<input type="checkbox" name="statusstate" id="editcitystate" value="Active">
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="form-group">
						<label for="editcitydescription" class="col-sm-12 control-label">Description</label>
							<div class="col-sm-12">
								<textarea rows="1" cols="35" id="editcitydescription"></textarea>
								<div id="ecitydescerror" class="error"></div>
							</div>
						</div>
					</div>
					</div>
					
					<div class="col-lg-2">
						  <div class="col-lg-2 status-button">
							<button type="submit" class="btn btn-info pull-right" onclick="editcities()" style="margin-right:10px;">Save</button>	
							<button type="submit" class="btn btn-info pull-right" onclick="noteditcities()">Back</button>				
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
            </div>-->
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive" >

					
                <table class="table no-margin" id="cityid">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th>
										<th>Status</th>
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
	 function cityid()
	 {	
		$('#cityid tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "editzonecitylist"				
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
							statusdetails =  '<i class="fa fa-ban" aria-hidden="true"></i>';
						var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + statusdetails+ '</td><td><a onClick="editcity('+vendorid+');" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletecity('+vendorid+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
						$('#cityid').append(row);
					}			  
				}
			});
	}
		
	
		window.onload = function() {
			cityid();
			statelists();
		}
		
</script>