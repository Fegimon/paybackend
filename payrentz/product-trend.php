<?php
require_once('header.php');
?>



<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">



		<section class="content-header">



			<h1>Product Trend</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Product Trend</li>
			</ol>
		</section>


    <!-- Main content -->
	<section class="content">
		<div class="row">




		      <div class="row searchspace">
                <div class="col-lg-8"><button type="button" class="btn btns btn-labeled btn-default btn-defaults" onclick="productexport()" style="margin-right: 5px;margin-bottom: 10px;">
                <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Export to Excel
                </button>
                <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','product')" >
                  <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Product Details
			   </button>
			   <button type="button" class="btn btns btn-labeled btn-default btn-defaults"  style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','current')">
                 <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span>  Mapped Details
			   </button>
               <button type="button" class="btn btns btn-labeled btn-default btn-defaults" style="margin-right: 5px;margin-bottom: 10px;" onclick="exporte('1','customer','closed')">
                  <span class="btn-label-default"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Closed Products
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
					<select class="form-control" id="csvintage" onchange="reportProductTrendSummary(this.value)" >
							<option>please Select</option>
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



            <div class="box-body">


              <div class="table-responsive">


                <table class="table no-margin" id="pro_trend">
                  <thead>
                  <tr>
                    <th>Month</th>
					<th>New Products</th>
				    <th>Purchase Cost</th>
					<th>Mapped </th>
					<th>Closed </th>

				  </tr>
                  </thead>
                  <tbody>


<tr>
<td>Jan</td>
<td><span id="n_p1"></span></td>
<td><span id="p_c1"></span></td>
<td><span id="m1"></span></td>
<td><span id="c1"></span></td>
</tr>


<tr>
<td>Feb</td>
<td><span id="n_p2"></span></td>
<td><span id="p_c2"></span></td>
<td><span id="m2"></span></td>
<td><span id="c2"></span></td>
</tr>


<tr>
<td>Mar</td>
<td><span id="n_p3"></span></td>
<td><span id="p_c3"></span></td>
<td><span id="m3"></span></td>
<td><span id="c3"></span></td>
</tr>



<tr>
<td>Apr</td>
<td><span id="n_p4"></span></td>
<td><span id="p_c4"></span></td>
<td><span id="m4"></span></td>
<td><span id="c4"></span></td>
</tr>

<tr>
<td>May</td>
<td><span id="n_p5"></span></td>
<td><span id="p_c5"></span></td>
<td><span id="m5"></span></td>
<td><span id="c5"></span></td>
</tr>


<tr>
<td>Jun</td>
<td><span id="n_p6"></span></td>
<td><span id="p_c6"></span></td>
<td><span id="m6"></span></td>
<td><span id="c6"></span></td>
</tr>

<tr>
<td>Jul</td>
<td><span id="n_p7"></span></td>
<td><span id="p_c7"></span></td>
<td><span id="m7"></span></td>
<td><span id="c7"></span></td>
</tr>

<tr>
<td>Aug</td>
<td><span id="n_p8"></span></td>
<td><span id="p_c8"></span></td>
<td><span id="m8"></span></td>
<td><span id="c8"></span></td>
</tr>

<tr>
<td>Sep</td>
<td><span id="n_p9"></span></td>
<td><span id="p_c9"></span></td>
<td><span id="m9"></span></td>
<td><span id="c9"></span></td>
</tr>

<tr>
<td>Oct</td>
<td><span id="n_p10"></span></td>
<td><span id="p_c10"></span></td>
<td><span id="m10"></span></td>
<td><span id="c10"></span></td>
</tr>

<tr>
<td>Nov</td>
<td><span id="n_p11"></span></td>
<td><span id="p_c11"></span></td>
<td><span id="m11"></span></td>
<td><span id="c11"></span></td>
</tr>
<td>Dec</td>
<td><span id="n_p12"></span></td>
<td><span id="p_c12"></span></td>
<td><span id="m12"></span></td>
<td><span id="c12"></span></td>
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

				$("#pro_trend").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "product trend",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			}

		</script>
