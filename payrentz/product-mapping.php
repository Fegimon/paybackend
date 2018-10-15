<?php
require_once('header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
Product Mapping
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Mapping</li>
      </ol>
    </section>

    <!-- Main content -->
    
	
	
	
			
				
	<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable ui-sortable">
        
				
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Product Mapping</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
			  
			  
			  
<div class="box-footer">
                  <form action="#" method="post">
                    <div class="input-group col-lg-5 pull-right">
                      <input type="text" name="message" placeholder="Customer ID / Mobile" class="form-control">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">Go</button>
                          </span>
                    </div>
                  </form>
                </div>
				  
				  
				
				
               <div class="box-body">
			
				<div class="pull-right"><a href="">+</a></div>
              <div class="table-responsive">

					
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Category</th>
					<th>Variant</th>
					<th>Product ID</th>
					<th>Delivery Date</th>
					<th>Installation Date</th>
					<th>Rent on Date</th>
					<th>Return Date</th>
					<th></th>
					<th></th>
                  </tr>
				  
				  <tr>
                    <td>
					<div class="">
                      <label>
                        <select class="form-control">
							<option>AC</option>
							<option>Washing Machine</option>
							<option>TV</option>
						</select>
                      </label>
                    </div>					
					</td>
					<td>
					<select class="form-control" id="variant">

						<option>Window - 1 Ton</option>						

						<option>Window - 1.5 Ton</option>

						<option>Split - 1 Ton</option>

						<option>Split - 1.5 Ton</option>						

						 </select>
					</td>
					<td>
					<div class="form-group ">
					<div class="col-sm-11">
						<input type="text" class="form-control" id="exampleInputEmail1" >
					</div>
					</div>
					</td>
					<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>

<td>
                <div class="form-group">                  
                 <div class="col-sm-11">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
					<td><button type="button" class="btn btn-info pull-right"  data-toggle="modal" data-target="#myModal">Choose </button></td>
					<td>In Stock</td>					
                  </tr>
				  
				  <tr>
                    <td>
					<div class="">
                      <label>
                        <select class="form-control">
							<option>AC</option>
							<option>Washing Machine</option>
							<option>TV</option>
						</select>
                      </label>
                    </div>					
					</td>
					<td>
					<select class="form-control" id="variant">

						<option>Window - 1 Ton</option>						

						<option>Window - 1.5 Ton</option>

						<option>Split - 1 Ton</option>

						<option>Split - 1.5 Ton</option>						

						 </select>
					</td>
					<td>
					<div class="form-group">
						<div class="col-sm-11">
							<input type="email" class="form-control" id="exampleInputEmail1" >
						</div>
					</div>
					</td>
					<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
<td>
                <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="inputEmail3">
                  </div>
                </div>	
</td>

<td>
                <div class="form-group">                  
                 <div class="col-sm-11">
                    <input type="text" class="form-control" id="inputEmail3" >
                  </div>
                </div>	
</td>
					<td><button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Choose </button></td>
					<td>O Stock</td>					
                  </tr>
				  
				  
				  
				  
                  </thead>
                  <tbody>
				 
                  
                  </tbody>
                </table>
				 <button type="submit" class="btn btn-info pull-right">Submit</button>
				 <button type="submit" class="btn btn-info " >Cancel</button>
              </div>
              <!-- /.table-responsive -->
            </div>
			
			
			<div class="box box-info enquiry-list">
            <div class="box-header with-border">
              <h3 class="box-title">Enquiry List</h3>

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
                    <th>Customer</th>
					<th>Enquiry Date</th>
					<th>Product</th>
					<th>Tenure</th>
					<th>Mode</th>
					<th>Assigned To</th>
					<th>Status</th>
					<th>Followup Status</th>
					<th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
<td>Ramesh</td>
<td>13/03/2017</td>
<td>Fridge</td>
<td>4 Months</td>
<td>Referral</td>
<td>Ananth</td>
<td>KYC Initated</td>
<td>Followup on 13th April 2017</td>
<td><a data-toggle="modal" data-target="#mappingview" href="#">View</a> | <a href="#">Edit</a> </td>
                  </tr>

				  
				                    <tr>
<td>Ramesh</td>
<td>13/03/2017</td>
<td>Fridge</td>
<td>4 Months</td>
<td>Referral</td>
<td>Ananth</td>
<td>KYC Initated</td>
<td>Followup on 13th April 2017</td>
<td><a data-toggle="modal" data-target="#mappingview" href="#">View</a> | <a href="#">Edit</a> </td>
                  </tr>
				  
				  
				                    <tr>
<td>Ramesh</td>
<td>13/03/2017</td>
<td>Fridge</td>
<td>4 Months</td>
<td>Referral</td>
<td>Ananth</td>
<td>KYC Initated</td>
<td>Followup on 13th April 2017</td>
<td><a data-toggle="modal" data-target="#mappingview" href="#">View</a> | <a href="#">Edit</a> </td>
                  </tr>
				  
				                    <tr>
<td>Ramesh</td>
<td>13/03/2017</td>
<td>Fridge</td>
<td>4 Months</td>
<td>Referral</td>
<td>Ananth</td>
<td>KYC Initated</td>
<td>Followup on 13th April 2017</td>
<td><a data-toggle="modal" data-target="#mappingview" href="#">View</a> | <a href="#">Edit</a> </td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
		  
			
				

              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>
          </div>
		
<div class="box-footer">
                               
              </div>

		
        </section>
		
		
		
		
		

			  
			  
			  
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)
       <section class="col-lg-3 connectedSortable ui-sortable">-->


          <!-- solid sales graph 
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="250" version="1.1" width="416" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.75px; top: -0.59375px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="43.8125" y="211" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,211H391" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.8125" y="164.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">5,000</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,164.5H391" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.8125" y="118.00000000000001" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.500000000000014" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">10,000</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,118.00000000000001H391" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.8125" y="71.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,71.5H391" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.8125" y="25.00000000000003" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal"><tspan dy="3.5000000000000284" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20,000</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,25.00000000000003H391" stroke-width="0.4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="329.59318043742405" y="223.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="180.7528098420413" y="223.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 10px; line-height: normal; font-family: &quot;Open Sans&quot;;" font-size="10px" font-family="Open Sans" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><path fill="none" stroke="#efefef" d="M56.3125,186.2062C65.66585662211422,185.9458,84.37256986634266,187.775575,93.72592648845688,185.1646C103.0792831105711,182.553625,121.78599635479954,166.4743950819672,131.13935297691376,165.3184C140.39104267922238,164.17497008196722,158.89442208383963,178.173325,168.14611178614825,175.9669C177.39780148845688,173.760475,195.90118089307413,149.8671487704918,205.15287059538275,147.667C214.50622721749698,145.4426737704918,233.2129404617254,155.955625,242.56629708383963,158.269C251.91965370595386,160.582375,270.6263669501823,177.16471967213116,279.9797235722965,166.174C289.23141327460513,155.30274467213115,307.7347926792224,77.67916919889502,316.986482381531,70.8211C326.136505164034,64.03839419889502,344.43655072904016,103.97557445054946,353.5865735115432,111.61090000000002C362.9399301336574,119.41589945054946,381.64664337788577,127.33952500000001,391,132.5824" stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="56.3125" cy="186.2062" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="93.72592648845688" cy="185.1646" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="131.13935297691376" cy="165.3184" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="168.14611178614825" cy="175.9669" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="205.15287059538275" cy="147.667" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="242.56629708383963" cy="158.269" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="279.9797235722965" cy="166.174" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="316.986482381531" cy="70.8211" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="353.5865735115432" cy="111.61090000000002" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="391" cy="132.5824" r="4" fill="#efefef" stroke="#efefef" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
            </div>-->
            <!-- /.box-body 
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                  <div class="knob-label">Mail-Orders</div>
                </div>-->
                <!-- ./col 
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                  <div class="knob-label">Online</div>
                </div>-->
                <!-- ./col 
                <div class="col-xs-4 text-center">
                  <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; -webkit-appearance: none;"></div>

                  <div class="knob-label">In-Store</div>
                </div>-->
                <!-- ./col 
              </div>-->
              <!-- /.row 
            </div>-->
            <!-- /.box-footer 
          </div>-->
          <!-- /.box 


        </section>-->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
	
	
	
	
	
	

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog product-enquiry" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Product Mapping</h4>
      </div>
      <div class="modal-body">
<section class="col-lg-12 connectedSortable ui-sortable">
			


<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">GoDown</a></li>
              <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Client's Place</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="box box-info">
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive">

					
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Product ID</th>
					<th>Product</th>
					<th>Variant</th>
					<th>Brand</th>
					<th>Date of Purchase</th>
					<th>Security Amount</th>
					<th>Processing Fee</th>
					<th>Installation Fee</th>
					<th>Other Fee</th>
					<th>Rent Cost</th>
					<th>Select</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td><input type="checkbox"></td>
</tr>

				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td><input type="checkbox"></td>
</tr>
				  
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td><input type="checkbox"></td>
</tr>
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td> <div class="form-group">                  
                 <div class="col-sm-12">
                    <input type="text" class="form-control" id="" name="" value="2000">
                  </div>
                </div></td>
<td><input type="checkbox"></td>
</tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
<div class="box box-info">
            <!-- /.box-header -->
			
			
            <div class="box-body">
			
					
              <div class="table-responsive">

					
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Product ID</th>
					<th>Product</th>
					<th>Variant</th>
					<th>Brand</th>
					<th>Date of Return</th>
					<th>No. of Days Left</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td>5</td>
</tr>

				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td>5</td>
</tr>
				  
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td>5</td>
</tr>
				  
<tr>
<td>Prod123</td>
<td>AC</td>
<td>Split 1.5</td>
<td>LG</td>
<td>18.10.2016</td>
<td>5</td>
</tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

 
			
			
		  </section>
			
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Assign</button>
      </div>
    </div>
  </div>
</div>
      
<div class="modal fade" id="mappingview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Product Enquiry View</h4>
      </div>
      <div class="modal-body">
	   <form class="form-horizontal">
              <div class="box-body">
			  
			
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Customer ID</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputEmail3" value="C123" disabled>
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Customer Type</label>

                  <div class="col-sm-9">
				   <input type="email" class="form-control" id=""  value="Individual" disabled>
                  </div>
                </div>
				
				
                <div class="form-group">
                  <label for="datepicker" class="col-sm-3 control-label">Date of Enquiry</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" id="datepicker" value="10/04/2017" disabled>
                  </div>
                </div>
	
				<div class="form-group">
                  <label for="enquiry1" class="col-sm-3 control-label">Mode of Enquiry</label>
				  <div class="col-sm-9">
				   <input type="email" class="form-control" id=""  value="Newspaper" disabled>
                  </div>
                </div>
				
			
				<div class="form-group">
                  <label for="attendby" class="col-sm-3 control-label">Attended By</label>
				  <div class="col-sm-9">
				   <input type="email" class="form-control" id=""  value="Ananth" disabled>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="assignby" class="col-sm-3 control-label">Assigned To</label>
				   <div class="col-sm-9">
				   <input type="email" class="form-control" id=""  value="Ananth" disabled>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="datepicker1" class="col-sm-3 control-label">Follow-up On</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control pull-right" id="datepicker1" value="10/04/2017" disabled>
                  </div>
                </div>
				
						
				<div class="form-group">
                  <label for="remark1" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3" id="remark1" placeholder="Enter ..." disabled></textarea>	
                  </div>
                </div>						
						
					 <!-- /.box-header -->
            <div class="box-body">
			
				
              <div class="table-responsive">

				<table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Select Category</th>
					<th>Quantity</th>
					<th></th>
					
				</tr>
                  </thead>
                  <tbody>
				  
				  
<tr>
<td><div class="col-sm-9">
                    <input type="text" class="form-control pull-right" id="datepicker1"  value="AC" disabled>
                  </div></td>
<td>
                <div class="form-group">                  
                 <div class="col-sm-9">
                    <input type="text" class="form-control" id="" value="2" disabled>
                  </div>
                </div>	
</td>

                
                  </tbody>
                </table>
              </div>
	         
            </div>

			

               
              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
            </form>
				
				
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	  
	
	
	
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php
  require_once('footer.php');
?>