<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>State</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">State</li>
			</ol>
		</section>
			  
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addstate">
			<form class="form-horizontal" id="statesform">
				  <div class="box-body">
				  <div class="col-lg-10">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="stateid" class="col-sm-12 control-label">State</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="stateid">
								<div id="stateerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-1">
					<div class="form-group">
						<label for="statusstate" class="col-sm-12 control-label">Status</label>
							<div class="col-sm-12">
								<input type="checkbox" name="statusstate" id="statusstate" value="Active">
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="form-group">
							<label for="statedescription" class="col-sm-12 control-label">Description</label>
							<div class="col-sm-12">
								<textarea rows="1"  cols="35" id="statedescription"></textarea>
								<div id="statedescerror" class="error"></div>	
							</div>
						</div>
					</div>
				</div>
					<div class="col-lg-2">
						<div class="col-lg-2 status-button">
							  <button type="submit" class="btn btn-info pull-right" onclick="addstates()">Add</button>	
						</div>				  
					</div>				  
				
				 </div>
			</form>	
		</div>	

		<div class="col-lg-12 editstate" hidden>
			<form class="form-horizontal">
				  <div class="box-body">
				  <div class="col-lg-10">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="editstatename" class="col-sm-12 control-label">State</label>
							 <div class="col-sm-12">
								<input type="text" class="form-control" id="editstatename">
								<div id="estateerror" class="error"></div>	
								<input type="hidden" class="form-control" id="editstateid">
							  </div>
						</div>
					</div>
					
					<div class="col-lg-1">
						<div class="form-group">
						<label for="editstatusstate" class="col-sm-12 control-label">Status</label>
							<div class="col-sm-12">
								<input type="checkbox" name="statusstate" id="editstatusstate" value="Active"> 
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="form-group">
							<label for="editstatedescription" class="col-sm-12 control-label">Description</label>
							<div class="col-sm-12">
								<textarea rows="1"  cols="35" id="editstatedescription"></textarea>
								<div id="estatedescerror" class="error"></div>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2">				
					<div class="col-lg-2 status-button">
					    <button type="submit" class="btn btn-info pull-right" onclick="editstates()" style="margin-right:10px;">Save</button>	
						<button type="submit" class="btn btn-info pull-right" onclick="noteditstates()">Back</button>	
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

					
                <table class="table no-margin" id="statelist">
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
	 function statelist()
	 {	
		$('#statelist tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "statelist"				
			},
			type:"post",
			success: function(data)
				{
				  console.log(JSON.parse(data));
				  var data = JSON.parse(data);
				  for (var i=0; i<data.length; i++) {
						var vendorid = data[i].id;
						if(data[i].status == 1)
							statusdetails =  '<i class="fa fa-check" aria-hidden="true"></i>';
						else
							statusdetails = '<i class="fa fa-ban" aria-hidden="true"></i>';
						var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + statusdetails+ '</td><td><a onClick="editstate('+vendorid+');" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletestate('+vendorid+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
						$('#statelist').append(row);
					}			  
				}
			});
	}
		
		window.onload = function() {
			statelist();
		}
		
</script>