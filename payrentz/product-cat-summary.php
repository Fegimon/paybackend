<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	

			  
		<section class="content-header">
		
		
		
			<h1>Product Category Summary</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Product Trend</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		
			
				
		
			<div class="row searchspace">
                <div class="col-lg-6"><button type="button" class="btn btns btn-labeled btn-default btn-defaults" onclick="productexport()" style="margin-right: 5px;margin-bottom: 10px;">
             <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Export to Excel
          </button>
                <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','product')" >
                  <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Product Details
			   </button>
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','current')">
                 <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Mapped Details 
			   </button>
               
              
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
				<div class="col-lg-2 pull-right">
					<select class="form-control" id="csvintage" onchange="proCatSummarys(this.value)">
					        <option value="2016" style="display:none">Please Select</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							</select>
                </div>
                <!-- /.col-lg-6 -->
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

					
                <table class="table no-margin" id="pro_cat_sum">
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
				
				$("#pro_cat_sum").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "product category summary",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			}
			
		</script>