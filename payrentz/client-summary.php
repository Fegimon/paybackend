<?php
require_once('header.php');
?>



<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<section class="content-header">

			<h1>Client Summary (Count)</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Client Summary</li>
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
									  <label for="states" class="col-sm-12 control-label">State</label>

									  <div class="col-sm-12">
										<select class="form-control"  name='c_state' id='c_state2' onchange="getCity(this.value);" >

									  </select>
									  </div>
									</div>
									</div>


									<div class="col-lg-3">
									<div class="form-group">
									  <label for="cities" class="col-sm-12 control-label">City</label>

									  <div class="col-sm-12">
										<select class="form-control"  name='c_city' id='c_city2' onchange="getZone(this.value)">

									  </select>
									  </div>
									</div>
									</div>


									<div class="col-lg-3">
									<div class="form-group">
									  <label for="zones" class="col-sm-12 control-label">Zone</label>

									  <div class="col-sm-12">
										<select class="form-control" name='c_zone' id="c_zone2"  onchange="getArea(this.value)">

									  </select>
									  </div>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="form-group">
									  <label for="areas" class="col-sm-12 control-label">Area</label>

									  <div class="col-sm-12">
										<select class="form-control" name='c_area' id='c_area2'>

									  </select>
									  </div>
									</div>
									</div>
								</div>
                               <div class="row">

									<div class="col-lg-3">

									<div class="form-group">
									  <label for="areas" class="col-sm-12 control-label">Age</label>

									  <div class="col-sm-12">
										<select class="form-control" name='r_age' id='r_age'>
										<option value="0">All</option>
										<option value="< 20"> < 20</option>
										<option value="BETWEEN 20 AND 25">20-25</option>
										<option value="BETWEEN 25 AND 30">25-30</option>
										<option value="BETWEEN 30 AND 35">30-35</option>
										<option value="BETWEEN 35 AND 40">35-40</option>
										<option value="BETWEEN 40 AND 50">40-50</option>
										<option value="> 50">> 50</option>
									  </select>
									  </div>
									</div>
									</div>
									<div class="col-lg-3">

									<div class="form-group">
										<label for="areas" class="col-sm-12 control-label">Vintage</label>

										<div class="col-sm-12">
										<select class="form-control" name='r_vint' id='r_vint'>
										<option value="0">All</option>
										<option value="< 3"> < 3</option>
										<option value="BETWEEN 3 AND 6">3-6</option>
										<option value="BETWEEN 6 AND 12">6-12</option>
										<option value="BETWEEN 12 AND 24">12-24</option>
										<option value=" > 24">24 < </option>

										</select>
										</div>
									</div>
									</div>

									<div class="col-lg-3" >
									<div class="form-group">
									  <label for="areas" class="col-sm-12 control-label">Gender</label>

									  <div class="col-sm-12">
										<select class="form-control" name='r_gen' id='r_gen'>
										<option value="5">All</option>
										<option value="0">Male</option>
										<option value="1">Female</option>
										<option value="2">Company</option>
									  </select>
									  </div>
									</div>
									</div>
										<div class="col-lg-3" >
									<div class="form-group">
									  <label for="areas" class="col-sm-12 control-label">Maritial Status</label>

									  <div class="col-sm-12">
										<select class="form-control" name='r_mar' id='r_mar'>
										<option value="3">All</option>
										<option value="0">Married</option>
										<option value="1">Single</option>

									  </select>
									  </div>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="form-group">
									  <label for="areas" class="col-sm-12 control-label">Year</label>

									  <div class="col-sm-12">
										 <select class="form-control " id="r_year" >

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
											<a  class="btn btn-info" style="margin-top:15px;" onclick="reportClient()">Search</a>
										<div id="amailerror" class="error"></div>
									  </div>

									</div>
									</div>

								</div>



					 </fieldset>
			 </div>
			</form>


		 <div class="row searchspace">
                <div class="col-lg-6"><button type="button" class="btn btns btn-labeled btn-default btn-defaults" onclick="productexport()" style="margin-right: 5px;margin-bottom: 10px;">
        <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>     Export to Excel
          </button>
  <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','general')" >
           <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>       Client Details
			   </button>
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


                <table class="table no-margin" id="client_summarry">
                  <thead>
                  <tr>
                    <th>Month</th>
					<th>Count</th>
				  </tr>
                  </thead>
                  <tbody>


<tr>
<td>January</td>
<td><span id="c_mon1"></span></td>
</tr>


<tr>
<td>February</td>
<td><span id="c_mon2"></span></td>
</tr>


<tr>
<td>March</td>
<td><span id="c_mon3"></span></td>
</tr>

<tr>
<td>April</td>
<td><span id="c_mon4"></span></td>
</tr>

<tr>
<td>May</td>
<td><span id="c_mon5"></span></td>
</tr>

<tr>
<td>June</td>
<td><span id="c_mon6"></span></td>
</tr>


<tr>
<td>July</td>
<td><span id="c_mon7"></span></td>
</tr>

<tr>
<td>August</td>
<td><span id="c_mon8"></span></td>
</tr>

<tr>
<td>September</td>
<td><span id="c_mon9"></span></td>
</tr>

<tr>
<td>October</td>
<td><span id="c_mon10"></span></td>
</tr>

<tr>
<td>November</td>
<td><span id="c_mon11"></span></td>
</tr>

<tr>
<td>December</td>
<td><span id="c_mon12"></span></td>
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
					filename: "client summary",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			}

		</script>
