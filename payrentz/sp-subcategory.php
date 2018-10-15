<?php
require_once('header.php');
?>
<div class="content-wrapper">		  
	<section class="content-header">
		<h1>Product Category</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Product Category</li>
			</ol>
	</section>			  
			  
    <section class="content">
		<div class="row addsubproduct">
			<form class="form-horizontal" id="addsubcategoryform">
				<div class="box-body">
						<div class="col-lg-3">
							<div class="form-group">
							<label for="maincategorylist" class="col-sm-12 control-label">Category</label>
								<div class="col-sm-12">
									<select class="form-control" id="maincategorylist">
									</select>
								</div>
							</div>
						</div>
								
								
						<div class="col-lg-3">
							<div class="form-group">
								<label for="subcategoryname" class="col-sm-12 control-label">Name</label>							
								<div class="col-sm-12">
									<input type="text" class="form-control" id="subcategoryname">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
					
						<div class="col-lg-3">
							<div class="form-group">
							<label for="cgst" class="col-sm-12 control-label">CGST</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="cgst" value="0">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
								
						<div class="col-lg-3">
							<div class="form-group">
								<label for="sgst" class="col-sm-12 control-label">SGST</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="sgst" value="0">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
								
						<div class="col-lg-2">
							<div class="form-group">
							<label for="igst" class="col-sm-12 control-label">IGST</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="igst" value="0">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
								
								
						<div class="col-lg-2">
							<div class="form-group">
							<label for="ugst" class="col-sm-12 control-label">UGST</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="ugst" value="0">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
						
						<div class="col-lg-2">
							<div class="form-group">
							<label for="cess" class="col-sm-12 control-label">CESS</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="cess" value="0">
									<div id="subcatgryerror" class="error"></div>	
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="form-group">
							<label for="subcatdescription" class="col-sm-12 control-label">Description</label><br>
								<div class="col-sm-12">
									<textarea rows="1" cols="35" id="subcatdescription"></textarea>
									<div id="subcatgrydescerror" class="error"></div>	
								</div>
							</div>
						</div>
						
						<div class="col-lg-1">	
							<div class="form-group">
							<label  for="subcatstatus" class="col-sm-12 control-label"> Status</label>
								<div class="col-sm-12">
									<input type="checkbox" name="subcatstatus" id="subcatstatus" value="Active">
								</div>
							</div>
						</div>
							
						<div class="col-sm-3 pull-right status-buuton">
							<button type="submit" class="btn btn-info pull-right" onClick="addsubcatproduct()">Add</button>
						</div>
					</div>
										
			</form>	
		</div>

		<div class="row editsubproduct" hidden>
			<form class="form-horizontal">
				<div class="box-body">
					<div class="col-lg-3">
						<div class="form-group">
						<label for="editsubcategoryname" class="col-sm-12 control-label">Category</label>	
							<div class="col-sm-12">
								<input type="hidden" class="form-control" id="editsubcategorylist">
								<input type="text" class="form-control" id="editsubcategoryname">
								<div id="esubcatgryerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">	
							<label for="ecgst" class="col-sm-12 control-label">CGST</label>						
							<div class="col-sm-12">
									<input type="text" class="form-control" id="ecgst">
									<div id="subcatgryerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="esgst" class="col-sm-12 control-label">SGST</label>						
							<div class="col-sm-12">
								<input type="text" class="form-control" id="esgst">
								<div id="subcatgryerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="eigst" class="col-sm-12 control-label">IGST</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" id="eigst">
									<div id="subcatgryerror" class="error"></div>	
								</div>
						</div>
					</div>
								
					<div class="col-lg-3">
						<div class="form-group">
							<label for="eugst" class="col-sm-12 control-label">UGST</label>						
							<div class="col-sm-12">
								<input type="text" class="form-control" id="eugst">
								<div id="subcatgryerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="ecess" class="col-sm-12 control-label">CESS</label>						
								<div class="col-sm-12">
									<input type="text" class="form-control" id="ecess">
									<div id="subcatgryerror" class="error"></div>	
								</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
							<label for="editsubcatdescription" class="col-sm-12 control-label">Description</label>							
							<div class="col-sm-12">
								<input type="text" class="form-control" id="editsubcatdescription">
								<div id="esubcatgrydescerror" class="error"></div>	
							</div>
						</div>
					</div>
					
					<div class="col-lg-3">
						<div class="form-group">
						<label for="editsubcatstatus" class="col-sm-12 control-label">Status</label>
								<div class="col-sm-12">
									<input type="checkbox" name="editsubcatstatus" id="editsubcatstatus" value="Active"> 
								</div>
						</div>
					</div>
								
								<div class="pull-right status-button">
									<button type="submit" class="btn btn-info" onClick="editsubproductdetails()" style="margin-right:10px;">Save</button>
									<button type="submit" class="btn btn-info pull-right" onClick="noteditsubcat()">Back</button>
								</div>
						</div>						
				</form>	
		</div>
		
		<section class="col-lg-12">
					<div class="box box-info">
            <div class="box-body">
			
					
              <div class="table-responsive">

					
                <table class="table no-margin" id="productsubcattable">
                  <thead>
                  <tr>
                    <th>Category ID</th>
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
              <!-- /.table-responsive -->
            </div>

          </div>
		  
		  	  
			  
			
			
			</section>
          
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

      <!-- /.content-wrapper -->
  <?php
  require_once('footer.php');
?>

<script>
//Got the zone
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
						opt.value = selectValues[i].ptdcatgry_id;
						opt.text= selectValues[i].name;
						obj.appendChild(opt);
					}				   
				}
			});
	}
	
	//Got the zone
	 function gotproductsubcatlist()
	 {	
		$('#productsubcattable tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "productsubcatlist"				
			},
			type:"post",
			success: function(data)
				{
				  console.log(JSON.parse(data));
				  var data = JSON.parse(data);
				  for (var i=0; i<data.length; i++) {
						var prsubid = data[i].pr_sub_id;
						if(data[i].status == 1)
							statusdetails =  '<i class="fa fa-check" aria-hidden="true"></i>';
						else
							statusdetails = '<i class="fa fa-ban" aria-hidden="true"></i>';
						var row = $('<tr><td>' + data[i].pr_sub_id+ '</td><td>' + data[i].pr_sub_name + '</td><td>' + data[i].description + '</td><td>' + statusdetails+ '</td><td><a onClick="editsubcatproduct('+prsubid+');" class="scrollup"><i class="fa fa-pencil" aria-hidden="true"></i></a><a onClick="deletesubproductcat('+prsubid+');"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td></td></tr>');
						$('#productsubcattable').append(row);
					}			  
				}
			});
	}
		
		window.onload = function() {
			selectmaincategory();
			gotproductsubcatlist();
		}
		
</script>