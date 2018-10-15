<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Change Password</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Change Password</li>
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
							<label for="pass" class="col-sm-12 control-label">Password</label>
							<div class="col-sm-12">
                                              <input type="text" class="form-control" value="<?php echo $admin; ?>" id="user" style="display:none">
								<input type="password" class="form-control" id="pass">
								<div id="stateerror" class="error"></div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="c_pass" class="col-sm-12 control-label">Confrim Password</label>
							<div class="col-sm-12">
								<input type="password" class="form-control" id="c_pass">
								<div id="stateerror" class="error"></div>	
							</div>
						</div>
					</div>
					<div class="col-lg-2 status-button">
							  <button type="submit" class="btn btn-info pull-right" onclick="passChange()">Change</button>	
						</div>	
					
					
				</div>
					<div class="col-lg-2">
									  
					</div>				  
				
				 </div>
			</form>	
		</div>	

					
		
        	
    <!-- /.content -->
    </div> 
  </div>  
  <!-- /.content-wrapper -->
  <?php
  require_once('footer.php');
?>
<script>
//Got the zone
	 function passChange()
	 {
	 event.preventDefault();	
	 
	   var pass = $("#pass").val();
	   var c_pass = $("#c_pass").val();
             var user = $("#user").val();
	   if(pass.length < 6)
	   {
	   alert("password length minimum 6 letters");
	   }
	   else if(pass != c_pass)
	   {
	   alert("password mismatched");
	   }
	   else
	   {
	   $.ajax({ url: "config/passChangeApi.php",
			data:{
				"pass" : pass,"user": user				
			},
			type:"post",
			success: function(data)
				{
				 alert("password changed");
window.location.href = "index.php";
					}			  
				
			});
	   }
	   
		
		
		
	} 
		
		
		
</script>