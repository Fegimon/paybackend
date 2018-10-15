<?php
require_once('header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Enquiry
      </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Enquiry</li>
    </ol>
  </section>

  <!-- Main content -->

  <section class="content">
    <!-- Small boxes (Stat box) -->

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->

      <div class="form-group">
        <div class="col-sm-12">
          <div class="radio">
            <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" onclick='userChange()'>
                      Existing User
                    </label>
            <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" onclick='userChange()'>
                      New User
                    </label>
          </div>
        </div>
      </div>


      <section class="col-lg-12 ">


        <div class="box box-primary" id="exist_user">
          <!-- <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div> -->
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal enqform" method="post" action="config/save_enquiry.php">
            <input type="text" name='e_type' hidden value='0'>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="cus_id" class="col-sm-12 control-label">Customer ID</label>

                    <div class="col-sm-12">
                      <input type="" class="form-control" style="  text-transform: uppercase;" id="cus_id" name="e_cus_id" placeholder="Customer ID / Mobile">
                      <div class="error" id="cusiderror"></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="cus_name" class="col-sm-12 control-label">Customer Name</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name='e_cus_name' id='cus_name' placeholder="Customer Name" disabled="disabled">
                      <div class="error" id="cusnameerror"></div>
                    </div>
                  </div>

                </div>


                <div class="col-lg-2">



                  <div class="form-group">
                    <label for="datepicker" class="col-sm-12 control-label">Date of Enquiry</label>

                    <div class="col-sm-12">
                      <input type="date" class="form-control pull-right dat" id="datepicker" name="e_date" placeholder="dd/mm/yyyy">
                      <div class="error" id="doeerror"></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="e_attend" class="col-sm-12 control-label">Attended By</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="e_attend" name="e_attend">
                    </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="e_assign" class="col-sm-12 control-label">Assigned To</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="e_assign" name="e_assign">
                  </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-lg-2">

                  <div class="form-group">
                    <label for="datepicker1" class="col-sm-12 control-label">Follow-up On</label>

                    <div class="col-sm-12">
                      <input type="date" class="form-control pull-right" id="datepicker1" name="e_f_date" placeholder="dd/mm/yyyy">
                      <div class="error" id="doeferror"></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label for="remark1" class="col-sm-12 control-label">Remarks</label>

                    <div class="col-sm-12">
                      <textarea rows="3" cols="49" id="remark1" name="e_remark" placeholder="Enter ..."></textarea>
                      <div class="error" id="rmarkerror"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.box-header -->
              <div class="box-body">

                <div class="pull-right row"><a class="tplus" onclick="addVariant()">+</a></div>
                <div class="table-responsive ourtableblg">

                  <table class="table no-margin" id='c_e_product'>
                    <thead>
                      <tr>
                        <th class="headcol">Category</th>
                        <th class="headcol1">Variant</th>
                        <th class="headcol2">Quantity</th>
                        <th>Delivery</th>
                        <th>Duration</th>
                        <th>Tenure</th>
                        <th>Cost </th>
                        <th>Security Deposit </th>
                        <th>Processing Fee</th>
                        <th>Ins. Fee</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>


                      <tr>
                        <td class="headcol"><select id="e_cat1" class="form-control" onchange="getVariant(this.value,'1')" name="e_cat[]">

                  </select></td>
                        <td class="headcol1 bigtd"><select id="e_var1" class="form-control" onchange="getVariantCost(this.value,'1')" name="e_var[]">

                  </select></td>
                        <td class="headcol2 smalltd quantytb">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='1' class="form-control" id="e_quan1" placeholder="Quantity" name="e_quan[]">
                            </div>
                          </div>
                        </td>
                        <td class="midtd">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="date" class="form-control" id="e_delivery1" name="e_delivery[]">
                            </div>
                          </div>
                        </td>
                        <td class="smalltd1">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='1' class="form-control" id="e_rent1" placeholder="In Months" name="e_rent[]" onchange="getTenureCost(this.value,'1')">
                            </div>
                          </div>

                        </td>
                        <td class="smalltd1">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='1' class="form-control" id="e_tenure1" placeholder="In Months" name="e_tenure[]" readonly>
                            </div>
                          </div>

                        </td>
                        <td class="smalltd">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='0' class="form-control" id="e_rent_cost1" placeholder="" name="e_rent_cost[]">
                            </div>
                          </div>

                        </td>
                        <td class="smalltd">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='0' type="number" min='0' class="form-control" id="e_security1" placeholder="" name="e_security[]">
                            </div>
                          </div>

                        </td>
                        <td class="smalltd">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='0' class="form-control" id="e_pro_fee1" placeholder="" name="e_pro_fee[]">
                            </div>
                          </div>

                        </td>
                        <td class="smalltd">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="number" min='0' class="form-control" id="e_ins_fee1" placeholder="" name="e_ins_fee[]">
                            </div>
                          </div>

                        </td>

                        <td class="action-link"><a class="e_v_remove"> <i class="fa fa-trash-o" title="" aria-hidden="true"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>




            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a onclick="reset_page()" class="btn btn-default">Cancel</a>
              <button type="submit" class="btn btn-info pull-right" onClick="enquirycform();">Submit</button>
            </div>
            <!-- /.box-footer -->
          </form>

        </div>

        <div class="box box-primary" id="new_user">
          <!-- <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div> -->
          <!-- /.box-header -->


          <!-- form start -->
          <form class="form-horizontal enqform" method="post" action="config/save_enquiry.php">
            <input type="text" name='e_type' hidden value='1'>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="cus_name1" class="col-sm-12 control-label">Customer Name</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name='e_cus_name' id='cus_name1' placeholder="Customer Name">
                      <div class="error" id="cusname1error"></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="c_state" class="col-sm-12 control-label">State</label>

                    <div class="col-sm-12">
                      <select class="form-control" name='c_state' id='c_state' onchange="getCity(this.value)">

							  </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">


                  <div class="form-group">
                    <label for="c_city" class="col-sm-12 control-label">City</label>

                    <div class="col-sm-12">
                      <select class="form-control" name='c_city' id='c_city' onchange="getZone(this.value)">

							  </select>
                    </div>
                  </div>

                </div>
                <div class="col-lg-3">

                  <div class="form-group">
                    <label for="c_zone" class="col-sm-12 control-label">Zone</label>

                    <div class="col-sm-12">
                      <select class="form-control" name='c_zone' id="c_zone" onchange="getArea(this.value)">

							  </select>
                    </div>
                  </div>

                </div>

              </div>
              <div class="row">

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="c_area" class="col-sm-12 control-label">Area</label>

                    <div class="col-sm-12">
                      <select class="form-control" name='c_area' id='c_area'>

							  </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="cus_phone1" class="col-sm-12 control-label">Phone</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name='e_cus_phone' id='cus_phone1' placeholder="Phone " onchange="existingCheck(this.value,'mobile')">
                      <div class="error" id="newphoneerror"></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="cus_email1" class="col-sm-12 control-label">Email</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name='e_cus_email' id='cus_email1' placeholder="Email ">
                      <div class="error" id="newemailerror"></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="com_name1" class="col-sm-12 control-label">Company Name</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" name='e_com_name' id='com_name1' placeholder="Company Name">
                      <div class="error" id="comnameerror"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="e_customer_type" class="col-sm-12 control-label">Customer Type</label>

                    <div class="col-sm-12">
                      <select class="form-control" name='e_customer_type' id='e_customer_type'>
						   <option value="1">Individual</option>
						   <option value="2">Corporate</option>
						   <option value="3">Event</option>
						   </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">

                  <div class="form-group">
                    <label for="newdatepicker" class="col-sm-12 control-label">Date of Enquiry</label>

                    <div class="col-sm-12">
                      <input type="date" class="form-control pull-right" id="newdatepicker" name="e_date" placeholder="dd/mm/yyyy">
                      <div class="error" id="newdoeerror"></div>
                    </div>
                  </div>

                </div>
                <div class="col-lg-3">




                  <div class="form-group">
                    <label for="e_mode" class="col-sm-12 control-label">Mode of Enquiry</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="e_mode" name="e_mode">
                    <option value='1'>Newspaper</option>
                    <option value='2'>Internet</option>
                    <option value='3'>Referral</option>
                  </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">


                  <div class="form-group">
                    <label for="e_attend1" class="col-sm-12 control-label">Attended By</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="e_attend1" name="e_attend">
                    </select>
                    </div>
                  </div>

                </div>
              </div>
              <div class="row">
               


                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="e_Address" class="col-sm-12 control-label">Address</label>

                    <div class="col-sm-12">
                      <textarea rows="3" cols="52" id="e_Address" name="e_Address" placeholder="Enter ..."></textarea>
                      <div class="error" id="rmarkerror"></div>
                    </div>
                  </div>
                </div>
                


              </div>
              <div class="row">
                <div class="col-lg-3">

                  <div class="form-group">
                    <label for="e_assign1" class="col-sm-12 control-label">Assigned To</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="e_assign1" name="e_assign">

                  </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">

                  <div class="form-group">
                    <label for="newdatepicker1" class="col-sm-12 control-label">Follow-up On</label>

                    <div class="col-sm-12">
                      <input type="date" class="form-control pull-right" id="newdatepicker1" placeholder="dd/mm/yyyy" name="e_f_date">
                      <div class="error" id="newdoe1error"></div>
                    </div>
                  </div>
                </div>

  <div class="col-lg-3">
                  <div class="form-group">
<div class="radio">
                    <label>
										  <input type="radio" name="c_gender" id="optionsRadios1" value="0" checked="">
										  Male
										</label>
										 <label>
										  <input type="radio" name="c_gender" id="optionsRadios2" value="1">
										  Female
										</label>
<label>
										  <input type="radio" name="c_gender" id="optionsRadios3" value="2">
										  Corporate
										</label>
</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">

                  <div class="form-group">
                    <label for="newremark1" class="col-sm-12 control-label">Remarks</label>

                    <div class="col-sm-12">
                      <textarea rows="3" cols="37" id="newremark1" placeholder="Enter ..." name="e_remark"></textarea>
                      <div class="error" id="newremarkerror"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

              <div class="pull-right"><a class="tplus" onclick="addVariantNew()">+</a></div>
              <div class="table-responsive">

                <table class="table no-margin" id='n_c_e_product'>
                  <thead>
                    <tr>
                      <th style="min-width: 110px;">Category</th>
                      <th style="min-width: 135px;">Variant</th>
                      <th style="min-width: 78px;">Quantity</th>
                      <th style="min-width: 138px;">Delivery</th>
                      <th style="min-width: 65px;">Duration</th>
                      <th style="min-width: 65px;">Tenure</th>
                      <th style="min-width: 86px;">Cost </th>
                      <th style="min-width: 86px;">Security Deposit </th>
                      <th style="min-width: 65px;">Processing Fee</th>
                      <th style="min-width: 65px;">Ins. Fee</th>
                      <th style="min-width: 65px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr>

                      <td class="midtd"><select id="n_e_cat1" class="form-control" onchange="getVariantNew(this.value,'1')" name="e_cat[]">

                  </select></td>
                      <td class="bigtd"><select id="n_e_var1" class="form-control" name="e_var[]" onchange="getVariantNewcost(this.value,'1')">

                  </select></td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='1' class="form-control" id="n_e_quan1" placeholder="Quantity" name="e_quan[]">
                          </div>
                        </div>
                      </td>
                      <td class="midtd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="date" class="form-control" id="n_e_delivery1" name="e_delivery[]">
                          </div>
                        </div>
                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='1' class="form-control" id="n_e_rent1" placeholder="In Months" name="e_rent[]" onchange="getTenureCostNew(this.value,'1')">
                          </div>
                        </div>
                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='1' class="form-control" id="n_e_tenure1" placeholder="In Months" name="e_tenure[]" readonly>
                          </div>
                        </div>

                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='0' class="form-control" id="n_e_rent_cost1" placeholder="" name="e_rent_cost[]">
                          </div>
                        </div>

                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='0' class="form-control" id="n_e_security1" placeholder="" name="e_security[]">
                          </div>
                        </div>

                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='0' class="form-control" id="n_e_pro_fee1" placeholder="" name="e_pro_fee[]">
                          </div>
                        </div>

                      </td>
                      <td class="smalltd">
                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="number" min='0' class="form-control" id="n_e_ins_fee1" placeholder="" name="e_ins_fee[]">
                          </div>
                        </div>

                      </td>

                      <td class="action-link"><a class="e_v_remove"> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

            <div class="box-footer">
              <a onclick="reset_page()" class="btn btn-default">Cancel</a>
              <button type="submit" class="btn btn-info pull-right" onclick="newenqform();">Submit</button>
            </div>


        </div>

        <!-- /.box-footer -->
        </form>

    </div>



    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->

    <!-- /.row (main row) -->

  </section>










  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
  require_once('footer.php');
?>
