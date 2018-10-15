<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  
		<section class="content-header">

			<h1>Client Detailed</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Client Detailed</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
				
					<div class="col-lg-7">
			<form class="form-horizontal">
				  <div class="box-body">
				  		  
					<div class="form-group">
					  <label for="cid" class="col-sm-5 control-label">Client ID/ Name/ Mobile</label>

					 <div class="col-sm-6">
						<input type="text" class="form-control" id="cid">
					  </div>
					  <button type="submit" class="btn btn-info pull-right">Go</button>	
					</div>				  
					
				 </div>
			</form>	
		</div>		
				
			   <!-- <div class="row searchspace">
                <div class="col-lg-12"><button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
             Export to Excel
          </button>
                </div>
				
              <!--   /.col-lg-6 -->
               
                <!-- /.col-lg-6 
              </div> -->
				
        	<section class="col-lg-12 connectedSortable ui-sortable">
		
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
			
			
            <div class="box-body">
					
              <div class="table-responsive">

					
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Date</th>
					<th>Particulars</th>
					<th>Amount (Dr)</th>
					<th>Amount (Cr)</th>
				  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>01/04/2016</td>
<td>Advance (AC)</td>
<td>1000</td>
<td></td>
</tr>

				  
<tr>
<td>05/05/2016</td>
<td>Rent</td>
<td>1500</td>
<td></td>
</tr>


<tr>
<td>05/06/2016</td>
<td>Rent</td>
<td>1500</td>
<td></td>
</tr>

<tr>
<td>10/06/2016</td>
<td>Service Expense</td>
<td></td>
<td>200</td>
</tr>
 
<tr>
<td>12/06/2016</td>
<td>Installation Charges</td>
<td></td>
<td>400</td>
</tr> 

<tr>
<td></td>
<td></td>
<td>Total : 4000</td>
<td>Total : 600</td>
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