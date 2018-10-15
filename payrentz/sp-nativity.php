<?php
require_once('header.php');
?>		  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header">	
			<h1>Nativity</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Nativity</li>
			</ol>
		</section>		  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
			<div class="col-lg-12 addnativity">
				<form class="form-horizontal" id="nativityform">
					<div class="box-body">
					
						<div class="col-lg-10">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="nativity" class="col-sm-12 control-label">Nativity</label>
									<div class="col-sm-12">
										<input type="text" class="form-control" id="nativity">
										<div id="nativityerror" class="error"></div>	
									</div>
								</div>
							</div>
							<div class="col-lg-1">
								<div class="form-group">
								<label for="statusnativity" class="control-label col-sm-12"> Status</label>
									<div class="col-sm-12">
										<input type="checkbox" name="statusnativity" id="statusnativity" value="Active"> 
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
								<label for="nativitydescription" class="col-sm-12 control-label">Description</label>
									<div class="col-sm-12">
										<textarea rows="1" cols="35" id="nativitydescription"></textarea>
										<div id="nativitydescerror" class="error"></div>	
									</div>
								</div>
							</div>	
						</div>
						<div class="col-lg-2">
							<div class="col-lg-2 status-button">
									<button type="submit" class="btn btn-info pull-right " onClick="nativityadd()">Add</button>	
							</div>				  
						</div>	
					</div>				  					
				</form>	
			</div>

			
			<div class="col-lg-12 editnativity" hidden>
					<form class="form-horizontal">
						<div class="box-body">
							<div class="col-lg-10">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="nativityname" class="col-sm-12 control-label">Vendor Name</label>
										<div class="col-sm-12">
											<input type="hidden" class="form-control" id="nativityid">
											<input type="text" class="form-control" id="nativityname">
											<div id="enativityerror" class="error"></div>	
										</div>
									</div>
								</div>
								<div class="col-lg-1">
									<div class="form-group">
										<label for="editstatusnativity" class="control-label col-sm-12"> Status</label>
										<div class="col-sm-12">
											<input type="checkbox" name="editstatusnativity" id="editstatusnativity" value="Active">
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="editnativitydescription" class="col-sm-12 control-label">Description</label>
										<div class="col-sm-12">
											<textarea rows="1" cols="35" id="editnativitydescription"></textarea>
											<div id="enativitydescerror" class="error"></div>	
										</div>
									</div>
								</div>
							</div>
								
							<div class="col-lg-2">
								<div class="col-lg-2 status-button">	
									<button type="submit" class="btn btn-info pull-right" onClick="editnativitydata()" style="margin-right:10px;">Save</button>
									<button type="submit" class="btn btn-info pull-right" onClick="noteditnativity()">Back</button>
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
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div> 
					</div> -->
					<div class="box-body">
			            <div class="table-responsive">
							<table class="table no-margin" id="nativitytable">
								<thead>
								  <tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
										<th>Status</th>
										<th colspan="2">Action</th>
								  </tr>
								</thead>
								<tbody>                  
								</tbody>
							</table>
						</div>              
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
	function nativitylist(){
		$('#nativitytable tbody').empty();	 	
		$.ajax({ 
			url:'config/systemparamaters.php',
			data:{
				"type" : "nativitylist"				
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
						status ='<i class="fa fa-ban" aria-hidden="true"></i>';
           		    var row = $('<tr><td>' + data[i].id+ '</td><td>' + data[i].name + '</td><td>' + data[i].description + '</td><td>' + status + '</td><td><a onClick="editnativity('+vendorid+')" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletenativity('+vendorid+')"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td></td></tr>');
           		 $('#nativitytable').append(row);
        		}
			}
		  });				
	 }

	$( window ).load(function() { 	
		nativitylist();
	});

</script>