<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Area</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Area</li>
			</ol>
		</section>

			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addareaform">
			<form class="form-horizontal" id="areaaddform">
				<div class="box-body">
				  
				<div class="col-lg-10">
				<div class="col-lg-2">
					<div class="form-group">
						<label for="" class="col-sm-12 control-label">State</label>
						<div class="col-sm-12">
							<select class="form-control" id="areastates" onchange="gotcity()"> </select>
						</div>
					</div>
				</div>
				
				<div class="col-lg-2">
					<div class="form-group">				
					   <label for="" class="col-sm-12 control-label">City</label>
					  <div class="col-sm-12">
						<select class="form-control" id="areacity" onchange="gotzone()"> </select>
					  </div>
					</div>
				</div>
					  
				<div class="col-lg-2">
					<div class="form-group">	  
					   <label for="" class="col-sm-12 control-label">Zone</label>
					  <div class="col-sm-12">
						<select class="form-control" id="areazone"> </select>
					  </div>				
					</div>
				</div>
				
				<div class="col-lg-2"> 
					<div class="form-group">
					  <label for="area" class="col-sm-12 control-label">Area</label>
					 <div class="col-sm-12">
						<input type="text" class="form-control" id="area">
						<div id="areaerror" class="error"></div>	
					  </div>
					</div>
				</div>

				<div class="col-lg-1">
					<div class="form-group">
					<label for="statusarea" class="col-sm-12 control-label">Status</label>
					<div class="col-sm-12">
						<input type="checkbox" name="statusarea" id="statusarea" value="Active">
					</div>
					</div>
				</div>
					
				<div class="col-lg-2">
					<div class="form-group">				
					<label for="area" class="col-sm-12 control-label">Description</label>
					<div class="col-sm-12">
						<textarea rows="1" cols="30"  id="areadescription"></textarea>
						<div id="areadescerror" class="error"></div>	
					</div>
					</div>
				</div>
			</div>
	
				<div class="col-lg-2">
					<div class="col-sm-2  status-button">
					<button type="submit" class="btn btn-info pull-right" onclick="addarea()">Add</button>	
					</div>				  
				</div>				  
			</div>
			</form>	
		</div>		
		
		<div class="col-lg-12 editarea" hidden>
			<form class="form-horizontal">
				  <div class="box-body">
				<div class="col-lg-10"> 
				<div class="col-lg-4">
					<div class="form-group">
					  <label for="area" class="col-sm-12 control-label">Area</label>
					<div class="col-sm-12">
						<input type="text" class="form-control" id="editarea">
						<div id="editareaerror" class="error"></div>	
						<input type="hidden" class="form-control" id="areaid">
					</div>
					</div>
				</div>

				<div class="col-lg-1">
					<div class="form-group">
					<label for="editstatusarea" class="col-sm-12 control-label">Status</label>
						<div class="col-sm-12">
							<input type="checkbox" name="editstatusarea" id="editstatusarea" value="Active">
						</div>
					</div>
				</div>
							
							
				<div class="col-lg-4">
					<div class="form-group">			
						<label for="editareadescription" class="col-sm-12 control-label">Description</label>
						<div class="col-sm-12">
							<textarea rows="1" cols="35"  id="editareadescription"></textarea>
							<div id="editareadescerror" class="error"></div>	
						</div>
					</div>
				</div>
				</div>
				<div class="col-lg-2">
					<div class="col-lg-2 status-button">
						<button type="submit" class="btn btn-info pull-right" onclick="editareadetails()"  style="margin-right:10px;">Save</button>	
						<button type="submit" class="btn btn-info pull-right" onclick="noteditarea()">Back</button>				
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
            </div>-->
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive">

					
                <table class="table no-margin" id="arealisttable">
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

<script type="text/javascript">
	function areastates(){		 	
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "statelist"				
			},
			type:"post",
			success:function(data){
				var sel = $("#areastates");
				data = JSON.parse(data);				 
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }		
				     gotcity();
			}
		});				
	 }

	 $( window ).load(function() { 	
		areastates();arealist();
	});


	  function gotcity(){		 	
	 	var areastates =  $("#areastates").val();
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "citylist",
				"stateid" : areastates
			},
			type:"post",
			success:function(data){
				var sel = $("#areacity");
				data = JSON.parse(data);				 
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }
				    gotzone();		
			}
		});				
	 }


	   function gotzone(){		 	
	 	var areacity =  $("#areacity").val();
	 	console.log(areacity);
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "areazonelist",
				"cityid" : areacity
			},
			type:"post",
			success:function(data){
				var sel = $("#areazone");
				data = JSON.parse(data);				 
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }		
			}
		});				
	 }


	 function arealist(){
		$('#arealisttable tbody').empty();	 	
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "arealist"				
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
				var status;		
				for (var i=0; i<data.length; i++) {
					var vendorid = data[i].id;
					if( data[i].status ==1)
						status ='<i class="fa fa-check" aria-hidden="true"></i>';
					else
						status ='<i class="fa fa-ban" aria-hidden="true"></i>';
           		    var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + status + '</td><td><a onClick="editarea('+vendorid+')" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletearea('+vendorid+')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
           		 $('#arealisttable').append(row);
        		}
			}
		  });				
	 }

</script>