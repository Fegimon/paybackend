<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Product Advance Collection Report</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Product Trend</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		
			
				
		
		<form class="form-horizontal">
				  <div class="box-body">
				  <fieldset class="clientsum">
				 <legend></legend>
				 	<div class="row">
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="repbrand" class="col-sm-12 control-label">Brand</label>

									  <div class="col-sm-12">
										<select class="form-control" name="productbrand" id="repbrand"> </select>
																		
									  </select>
									  </div>
									</div>
									</div>
									
									
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="repvendor" class="col-sm-12 control-label">Vendor</label>

									  <div class="col-sm-12">
										<select class="form-control" name="vendor" id="repvendor"> </select>
															
									  </select>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">
									<div class="form-group">
									  <label for="r_year" class="col-sm-12 control-label">Year</label>

									  <div class="col-sm-12">
										 <select class="form-control " id="r_year" >
									 <option style="display:none">Please Select</option>
							         <option>2016</option>
							         <option>2017</option>
							         <option>2018</option>
							         <option>2019</option>
							         <option>2020</option>
							         </select>
									  </div>
									</div>
					                
                                     </div>
							
										<div class="col-lg-3">	
									<div class="form-group">
									
									 <div class="col-sm-12">
											<a  class="btn btn-info" style="margin-top:21px;" onclick="advRent()">Search</a>
										<div id="amailerror" class="error"></div>	
									  </div>
																		  
									</div>
									</div>
									
														
				
				
					
					 </fieldset>	
			 </div>
			</form>	
			 
            <div class="row searchspace">
                <div class="col-lg-6"><button type="button" class="btn btns btn-labeled btn-default btn-defaults" onclick="productexport()" style="margin-right: 5px;">
           <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Export to Excel
          </button>
                </div>  
				
                <!-- /.col-lg-6 -->
              </div>
                <!-- /.col-lg-6 -->
               <!--  <div class="col-lg-4">
			<div class="input-group">
				  <input type="text" name="q" class="form-control" placeholder="Search...">
					  <span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					  </span>
			</div>
                </div> -->
				
			  
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

					
                <table class="table no-margin" id="pro_cat_adv">
                  <thead>
                  <tr>
                    <th>Category</th>
					<th>Jan</th>
				    <th>Feb</th>
					<th>Mar</th>
					<th>Apr</th>
				    <th>May</th>
					<th>Jun</th>
					<th>Jul</th>
					<th>Aug</th>
					<th>Sep</th>
					<th>Oct</th>
					<th>Nov</th>
					<th>Dec</th>
					<th>Total</th>
				  </tr>
                  </thead>
                  <tbody>
				  <tr>
                    <td><span id=""></span></td>
					<td><span id=""></span></td>
				    <td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
				    <td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
					<td><span id=""></span></td>
                  </tr>           
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
  require_once('footer.php');?>
      <script src="http://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
 <script>

			function productexport() {
				
				$("#pro_cat_adv").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "product category advance coloection",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			}
			
		</script>