<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		  
		<section class="content-header">
		
			<h1>Return Summary (Count)</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Return Summary</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		
			<form class="form-horizontal">
		
			</form>	
				
		
		<div class="row searchspace">
                <!-- <div class="col-lg-6"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
             Export to Excel
          </button>
                </div> -->
                <!-- /.col-lg-6 -->
                <!-- <div class="col-lg-4">
			<div class="input-group">
				  <input type="text" name="q" class="form-control" placeholder="Search...">
					  <span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					  </span>
			</div>
                </div> -->
				<div class="col-lg-2 pull-right">
					<select class="form-control" id="csvintage" onchange="reportReturnList(this.value)">
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

					
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Month</th>
					<th>Count</th>
			
				  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>January</td>
<td><span id="r_ret1"></span></td>

</tr>

				  
<tr>
<td>February</td>
<td><span id="r_ret2"></span></td>

</tr>


<tr>
<td>March</td>
<td><span id="r_ret3"></span></td>

</tr>

<tr>
<td>April</td>
<td><span id="r_ret4"></span></td>

</tr>

<tr>
<td>May</td>
<td><span id="r_ret5"></span></td>

</tr>

<tr>
<td>June</td>
<td><span id="r_ret6"></span></td>

</tr>


<tr>
<td>Jully</td>
<td><span id="r_ret7"></span></td>

</tr>

<tr>
<td>August</td>
<td><span id="r_ret8"></span></td>

</tr>

<tr>
<td>September</td>
<td><span id="r_ret9"></span></td>

</tr>

<tr>
<td>October</td>
<td><span id="r_ret10"></span></td>

</tr>

<tr>
<td>November</td>
<td><span id="r_ret11"></span></td>

</tr>

<tr>
<td>December</td>
<td><span id="r_ret12"></span></td>

</tr>
  
				  
				  
				  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
		  
		  	 		
			</section>
			
			<div class="modal fade" id="returnview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				  </div>
				  <div class="modal-body">
				  
							
							
				 </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Submit</button>
				  </div>
				</div>
			  </div>
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