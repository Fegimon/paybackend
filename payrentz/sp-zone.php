<?php
require_once('header.php');
?>		  
<div class="content-wrapper">		  
		<section class="content-header">		
			<h1>Zone</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Zone</li>
			</ol>
		</section>			  
			<!-- Main content -->				
		<section class="content">
			<div class="row">
			<div class="col-lg-12 addzone">
				<form class="form-horizontal" id="zoneform">
					<div class="box-body">
						<div class="col-lg-10">
								<div class="col-lg-2">
									<div class="form-group">
										<label for="zonestate" class="col-sm-12 control-label">State</label>
										<div class="col-sm-12">
											<select class="form-control" id="zonestate" onchange="getzonecity()" >
											</select>										
										</div>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label for="zonecity" class="col-sm-12 control-label">City</label>
										<div class="col-sm-12">
											<select class="form-control" id="zonecity">
											</select>										
										</div>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label for="zoneid" class="col-sm-12 control-label">Zone</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="zoneid">
											<div id="zoneerror" class="error"></div>	
										</div>
									</div>
								</div>
								
								<div class="col-lg-1">
									<div class="form-group">
										<label for="statuszone" class="col-sm-12 control-label">Status</label>
										<div class="col-sm-12">
											<input type="checkbox" name="statuszone" id="statuszone" value="Active"> 
										</div>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label for="zonedescription" class="col-sm-12 control-label">Description</label>
										<div class="col-sm-12">
											<textarea rows="1" cols="35" id="zonedescription"></textarea>
											<div id="zonedescerror" class="error"></div>	
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="col-lg-2 status-button">
									<button type="submit" class="btn btn-info pull-right" onClick="addzone()">Add</button>	
								</div>
							</div>
						</div>					
				</form>	
			</div>


			<div class="col-lg-12 editzone" hidden >
				<form class="form-horizontal">
					<div class="box-body">
					
					<div class="col-lg-10">
					
						<div class="col-lg-3">
							<div class="form-group">
								<label for="zoneeditcity" class="col-sm-12 control-label">State</label>
								<div class="col-sm-12">		
									<select class="form-control" id="zoneeditcity"></select>							
								</div>
							</div>
						</div>
						
							<div class="col-lg-3">
								<div class="form-group">
								<label for="zoneeditid" class="col-sm-12 control-label">City</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" id="zoneeditid">
										<div id="ezoneerror" class="error"></div>	
										<input type="hidden" class="form-control" id="editzoneid">
									</div>	
								</div>	
							</div>	
							
							<div class="col-lg-1">
								<div class="form-group">
								<label for="editstatuszone" class="col-sm-12 control-label">Status</label>
									<div class="col-sm-12">
										<input type="checkbox" name="editstatuszone" id="editstatuszone" value="Active"> 
									</div>
								</div>
							</div>
							
							<div class="col-lg-3">
								<div class="form-group">
								<label for="editzonedescription" class="col-sm-12 control-label">Description</label>
									<div class="col-sm-12">
										<textarea rows="1" cols="35" id="editzonedescription"></textarea>
										<div id="ezonedescerror" class="error"></div>
									</div>
								</div>
							</div>
					</div>
						<div class="col-lg-2">
								<div class="col-lg-2 status-button">
									<button type="submit" class="btn btn-info pull-right" onClick="editzonedata()" style="margin-right:10px;">Save</button>
									<button type="submit" class="btn btn-info pull-right" onClick="noteditzone()">Back</button>
								</div>
						</div>					
					</div>
				</form>	
			</div>	
			
			
			
		
			<section class="col-lg-12">
			
			<div class="box box-info">
             <!--  <div class="box-header with-border">
              <h3 class="box-title"></h3>

             <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> 
            </div> -->
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive">

					
                <table class="table no-margin" id="zonetableid">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th>
					<th>Status</th>
					<th>Action</th>
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


	function zonelist(){
		$('#zonetableid tbody').empty();	 	
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "zonelist"				
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
				var status;		
				for (var i=0; i<data.length; i++) {
					var vendorid = data[i].id;
					if( data[i].status ==1)
						status = '<i class="fa fa-check" aria-hidden="true"></i>';
					else
						status ='<i class="fa fa-check" aria-hidden="true"></i>';
           		    var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + status + '</td><td><a onClick="editzone('+vendorid+')" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletezone('+vendorid+')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
           		 $('#zonetableid').append(row);
        		}
			}
		  });				
	 }


function zoneeditcity(){		 		 	
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "editzonecitylist"				
			},
			type:"post",
			success:function(data){
				var sel = $("#zoneeditcity");
				data = JSON.parse(data);				 
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }		
			}
		});				
	 }
	
	$( window ).load(function() { 	
		zonestates(); zonelist(); zoneeditcity();		
	});
		
</script>