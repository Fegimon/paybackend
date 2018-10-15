<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>SMS CONTENT</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">SMS</li>
			</ol>
		</section>

		  
			  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		<div class="col-lg-12 addcompany">
			<form class="form-horizontal" id="companyform">
				  <div class="box-body">
				  	<div class="col-lg-10">	
					
					  
					
					
					<div class="col-lg-4">					
						<div class="form-group">
							<label for="cmpydesc" class="col-sm-12 control-label">Description</label>  		
							<div class="col-sm-12">
								<textarea  cols="35" id="cmpydesc"></textarea>
								<div id="companydescerror" class="error"></div>
							</div>
						</div>
					</div>
                                               <div class="col-lg-2">	
						<div class="col-sm-2 status-button">
						  <button type="button" class="btn btn-info pull-right" onclick="saveSms()">Save</button>	
						</div>				  
					</div>
					</div>
									  
					
				 </div>
			</form>	
		</div>	

					
		
        	
          
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
	 function listcompany()
	 {	
		
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "sms"				
			},
			type:"post",
			success: function(data)
				{
var data = JSON.parse(data);
				  $("#cmpydesc").val(data[0]["description"]);
                                  			  
				}
			});
	}

        function saveSms()
	 {	
		
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"sms" : $("#cmpydesc").val(),
                                "type" : "smsSave"				
			},
			type:"post",
			success: function(data)
				{
                                  alert("Content Changed Sucessfully");
                                  //location.reload();			  
				}
			});
	}

       
		
	
		window.onload = function() {
			listcompany();			
		}
		
</script>