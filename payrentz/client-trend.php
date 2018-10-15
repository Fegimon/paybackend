<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		  
		<section class="content-header">
		
			<h1>Client Trend</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Client Trend</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		
			
				
		
		<div class="row searchspace">
            <div class="col-lg-8">
            <button type="button" class="btn btns btn-labeled btn-default btn-defaults" onclick="productexport()" style="margin-right: 5px;margin-bottom: 10px;">
              <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Export to Excel
          </button>
               <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','general')" >
                   <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>   Existing Customer
			   </button>
               <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','egeneral')">
                   <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  New Customer 
			   </button>
                <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','cgeneral')">
                  <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Closed Customer 
			   </button>
                </div>  
				<div class="col-lg-2 pull-right">
					<select class="form-control " id="csvintage" onchange="reportCustmerTrendSummary(this.value)">
							<option>2016</option>
							<option>2017</option>
							<option>2018</option>
							<option>2019</option>
							<option>2020</option>
							</select>
                </div>
                <!-- /.col-lg-6 -->
              </div>
			  
				
        	<section class="col-lg-12">
			
			
			
			<div class="box box-info">
              <!--   <div class="box-header with-border">
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

					
                <table class="table no-margin" id="client_summarry">
                  <thead>
                  <tr>
                    <th>Month</th>
					<th>Opening</th>
					<th>Additions</th>
					<th>Closing</th>
				  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>January</td>
<td><span id="c_opn1"></span></td>
<td><span id="c_add1"></span></td>
<td><span id="c_clo1"></span></td>
</tr>

				  
<tr>
<td>February</td>
<td><span id="c_opn2"></span></td>
<td><span id="c_add2"></span></td>
<td><span id="c_clo2"></span></td>
</tr>


<tr>
<td>March</td>
<td><span id="c_opn3"></span></td>
<td><span id="c_add3"></span></td>
<td><span id="c_clo3"></span></td>
</tr>

<tr>
<td>April</td>
<td><span id="c_opn4"></span></td>
<td><span id="c_add4"></span></td>
<td><span id="c_clo4"></span></td>
</tr>

<tr>
<td>May</td>
<td><span id="c_opn5"></span></td>
<td><span id="c_add5"></span></td>
<td><span id="c_clo5"></span></td>
</tr>

<tr>
<td>June</td>
<td><span id="c_opn6"></span></td>
<td><span id="c_add6"></span></td>
<td><span id="c_clo6"></span></td>
</tr>


<tr>
<td>July</td>
<td><span id="c_opn7"></span></td>
<td><span id="c_add7"></span></td>
<td><span id="c_clo7"></span></td>
</tr>

<tr>
<td>August</td>
<td><span id="c_opn8"></span></td>
<td><span id="c_add8"></span></td>
<td><span id="c_clo8"></span></td>
</tr>

<tr>
<td>September</td>
<td><span id="c_opn9"></span></td>
<td><span id="c_add9"></span></td>
<td><span id="c_clo9"></span></td>
</tr>

<tr>
<td>October</td>
<td><span id="c_opn10"></span></td>
<td><span id="c_add10"></span></td>
<td><span id="c_clo10"></span></td>
</tr>

<tr>
<td>November</td>
<td><span id="c_opn11"></span></td>
<td><span id="c_add11"></span></td>
<td><span id="c_clo11"></span></td>
</tr>

<tr>
<td>December</td>
<td><span id="c_opn12"></span></td>
<td><span id="c_add12"></span></td>
<td><span id="c_clo12"></span></td>
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
  require_once('footer.php');
?>
    <script src="http://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
 <script>

			function productexport() {
				
				$("#client_summarry").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "client trend",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			}
			
		</script>