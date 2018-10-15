<?php
require_once('header.php');
?>


			  
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
			<section class="content-header">
		
			<h1>Product Summary</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Product Summary</li>
			</ol>
		</section>
		
				  
    <!-- Main content -->				
	<section class="content">
		<div class="row">
		
		<form class="form-horizontal">
			<div class="box-body">
				<div class="col-lg-7">
				<fieldset class="fields">
				<div class="radio">                    <label>                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">                      Rent Collection                    </label>					 <label>                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">                      Deposit                    </label>					<label>                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">                      Processing Fee                    </label>					 <label>                      <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">                      Summary (Count)                    </label>                  </div>									</fieldset>	
				</div>
				<div class="col-lg-5">
				<fieldset class="fields">						<div class="radio">                    <label>                      <input type="radio" name="optionsRadios1" id="optionsRadios5" value="option5" checked="">                      All Existing Products                    </label>					 <label>                      <input type="radio" name="optionsRadios1" id="optionsRadios2" value="option6">                    New Products                    </label>                  </div>
				</fieldset>	
				</div>
			</div>
		</form>
		
		
		
			<form class="form-horizontal">
				  <div class="box-body">
				  <fieldset>
				 <legend></legend>
				  	<div class="col-lg-4">
						<div class="form-group">
						   <div class="col-sm-12">
							<select class="form-control" id="ptrend">
							<option>Variant</option>
							<option>Variant</option>
							<option>Variant</option>
						  </select>
						  </div>				
						</div>
						<div class="form-group">
						   <div class="col-sm-12">
							<select class="form-control" id="vintage">
							<option>Vintage</option>
							<option>Vintage</option>
							<option>Vintage</option>
						  </select>
						  </div>				
						</div>
					</div>	
					<div class="col-lg-4">
						<div class="form-group">
						   <div class="col-sm-12">
							<select class="form-control" id="ptrend">
							<option>Brand</option>
							<option>Brand</option>
							<option>Brand</option>
						  </select>
						  </div>				
						</div>
						<button type="submit" class="btn btn-info">Go</button>	
					</div>	
					<div class="col-lg-4">
						<div class="form-group">
						   <div class="col-sm-12">
							<select class="form-control" id="ptrend">
							<option>Vendor</option>
							<option>Vendor</option>
							<option>Vendor</option>
						  </select>
						  </div>				
						</div>
					</div>	
				 </fieldset>	
			 </div>
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
					<select class="form-control" id="csvintage">
							<option>2016</option>
							<option>2017</option>
							<option>2018</option>
							<option>2019</option>
							<option>2020</option>
							</select>
                </div>
                <!-- /.col-lg-6 -->
              </div>
			  
		
				
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
                    <th>Month</th>
					<th>Category</th>
					<th>Cost</th>
				  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>January</td>
<td>TV</td>
<td>30000</td>
</tr>

				  
<tr>
<td>February</td>
<td>Fridge</td>
<td>20000</td>
</tr>


<tr>
<td>March</td>
<td>Fridge</td>
<td>40000</td>
</tr>

<tr>
<td>April</td>
<td>Washing Machine</td>
<td>40000</td>
</tr>

<tr>
<td>May</td>
<td>TV</td>
<td>40000</td>
</tr>

<tr>
<td>June</td>
<td>TV</td>
<td>30000</td>
</tr>


<tr>
<td>Jully</td>
<td>TV</td>
<td>20000</td>
</tr>

<tr>
<td>August</td>
<td>AC</td>
<td>50000</td>
</tr>

<tr>
<td>September</td>
<td>TV</td>
<td>10000</td>
</tr>

<tr>
<td>October</td>
<td>Fridge</td>
<td>20000</td>
</tr>

<tr>
<td>November</td>
<td>Washing Machine</td>
<td>30000</td>
</tr>

<tr>
<td>December</td>
<td>AC</td>
<td>10000</td>
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