<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Brand</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Brand</li>
			</ol>
		</section>

			  
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addbrand">
			<form class="form-horizontal" id="brandform">
				  <div class="box-body">
					
					<div class="col-lg-10">
						<div class="col-lg-3">
							<div class="form-group">
								<label for="maincategorylist" class="col-sm-12 control-label">Product Category</label>														
								<div class="col-sm-12">
									<select class="form-control" id="maincategorylist"></select>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="form-group">						
							<label for="brand" class="col-sm-12 control-label">Brand</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="brand">	
									<div id="branderror" class="error"></div>										
								</div>
							</div>
						</div>
								
						<div class="col-lg-1">
							<div class="form-group">
							<label for="addbrandstatus" class="col-sm-12 control-label">Status</label>
								<div class="col-sm-12">
									 <input type="checkbox" name="addbrandstatus" id="addbrandstatus" value="Active">
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="form-group">	
								<label for="addbranddescr" class="col-sm-12 control-label">Description</label>
								<div class="col-sm-12">
									<textarea rows="1" cols="35" id="addbranddescr"></textarea>
									<div id="branddescerror" class="error"></div>	
								</div>
							</div>
						</div>
					</div>
								
					<div class="col-lg-2 status-button">				
						<button type="submit" class="btn btn-info" onclick="addbrand()">Add</button>
					</div>				
				 </div>
			</form>	
		</div>		
		
		
		<div class="col-lg-12 editbrand" hidden>
			<form class="form-horizontal">
				  <div class="box-body">
				  
					<div class="col-lg-10">
				  	<div class="col-lg-3">
						<div class="form-group">							
							<label for="editbrand" class="col-sm-12 control-label">Brand</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="editbrand">
									<div id="ebranderror" class="error"></div>									
									<input type="hidden" class="form-control" id="editidbrand">						
								</div>
						</div>
					</div>
								
						<div class="col-lg-1">
							<div class="form-group">							
								<label for="editaddbrandstatus" class="col-sm-12 control-label">Status</label>
								<div class="col-sm-12">
									 <input type="checkbox" name="addbrandstatus" id="editaddbrandstatus" value="Active"> 
								</div>
							</div>
						</div>
								
							<div class="col-lg-3">
								<div class="form-group">	
									<label for="editaddbranddescr" class="col-sm-12 control-label">Description</label>
									<div class="col-sm-12">
										<textarea rows="1" cols="35" id="editaddbranddescr"></textarea>
										<div id="ebranddescerror" class="error"></div>	
									</div>
								</div>
							</div>
						</div>
							
							<div class="col-lg-2">
								<div class="col-sm-2 status-button">	
									<button type="submit" class="btn btn-info pull-right" onclick="editbranddetails()" style="margin-right:10px;">Save</button>
									<button type="submit" class="btn btn-info pull-right" onclick="notbrandedit()">Back</button>
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
			
					
              <div class="table-responsive">

					
                <table class="table no-margin" id="brandtable">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Category</th>
					<th>Description</th>
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
function selectmaincategory()
	{
		event.preventDefault();
		var obj=document.getElementById("maincategorylist"); 
		$("#maincategorylist").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "selectmaincategory"				
			},
			type:"post",
			success: function(data)
				{
					console.log(JSON.parse(data));
					selectValues = JSON.parse(data);					        
					for (var i = 0; i <= selectValues.length; i++)     {                
						opt = document.createElement("option");
						opt.value =selectValues[i].id ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}				   
				}
			});
	}
	window.onload = function() {
			selectmaincategory();gotbrandlist();
		
		}


//Got the zone
	 function gotbrandlist()
	 {	
		$('#brandtable tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "brandlist"				
			},
			type:"post",
			success: function(data)
				{
				  console.log(JSON.parse(data));
				  var data = JSON.parse(data);
				  for (var i=0; i<data.length; i++) {
						var prsubid = data[i].brand_id;
						if(data[i].status == 1)
							statusdetails = '<i class="fa fa-check" aria-hidden="true"></i>';
						else
							statusdetails = '<i class="fa fa-ban" aria-hidden="true"></i>';
						var row = $('<tr><td>' + data[i].brand_id+ '</td><td>' + data[i].name + '</td><td>' + data[i].description + '</td><td>' + statusdetails+ '</td><td><a onClick="editbrand('+prsubid+');" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletebrand('+prsubid+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td></td></tr>');
						$('#brandtable').append(row);
					}			  
				}
			});
	}
		
		
		
</script>
