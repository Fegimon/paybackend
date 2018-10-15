<?php

   require_once('config/config.php');
   session_start();
   $url = 'login_payrentz/login.php';

   if(isset($_SESSION['username']))
   {
	if($_SESSION['username']=='no'){
       header("Location:  $url"); /* Redirect browser */
   $error_msg='Your Username or password is wrong';
   }
   }
   else
   {
	  header("Location:  $url");
   }

   $admin = $_SESSION['username'];
   $city  = $_SESSION['city'];
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>PayRentz</title>
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.6 -->
			  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
			  <!-- Ionicons -->
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
			  <!-- Theme style -->
			  <link rel="stylesheet" href="assets/css/css/AdminLTE.min.css">
			  <link rel="stylesheet" href="assets/css/_all-skins.min.css">
			  <!-- iCheck -->
			  <link rel="stylesheet" href="assets/css/blue.css">
			  <!-- Morris chart -->
			  <link rel="stylesheet" href="assets/css/morris.css">

			  <!-- jvectormap -->
			  <link rel="stylesheet" href="assets/css/jquery-jvectormap-1.2.2.css">
			  <!-- Date Picker -->
			  <link rel="stylesheet" href="assets/css/datepicker3.css">
			  <!-- Daterange picker -->
			  <link rel="stylesheet" href="assets/css/daterangepicker.css">
			  <!-- bootstrap wysihtml5 - text editor -->
			  <link rel="stylesheet" href="assets/css/bootstrap3-wysihtml5.min.css">
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
			  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
			  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">
			  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.4/css/dataTables.checkboxes.css" rel="stylesheet" />



			  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
			  <link rel="stylesheet" href="assets/css/custom.css">



	</head>
	<body class="hold-transition skin-blue sidebar-mini loading">

		<div class="preloader js-preloader flex-center">
			<div class="dots">
				<div class="dot"></div>
				<div class="dot"></div>
				<div class="dot"></div>
			</div>
		</div>


		<div class="wrapper">
			<header class="main-header">
				<a href="index.php" class="logo">
					<span class="logo-mini"><img src="assets/images/pay-logo.png" style="width: 45px;"></span>
					<img src="assets/images/pay-logo.png" />
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav" id="logouthead">
						<li class="qwerty">
							  <a href="javascript:;" id="adminname"  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding-bottom: 9px;">
								 <img src="assets/images/user.png" class="user-image" alt="User Image" style="    width: 25px;">  <span class=" fa fa-angle-down"></span>
							  </a>
						  <ul class="dropdown-menu dropdown-usermenu pull-right popup1">
							<li><a href="logout.php" ><i class="fa fa-sign-out"></i> Sign out</a></li>
                                                        <li><a href="passChange.php" ><i class="fa fa-sign-out"></i> Change Password</a></li>
						  </ul>
                </li>

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/images/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>

            <ul class="dropdown-menu">
              <!-- User image
              <li class="user-header">
                <img src="assets/images/user.png"" class="img-circle" alt="User Image">
				<button type="button" class="close" data-dismiss="modal">×</button>
                <p>
                 <? $admin ?> </small>
                </p>
              </li>

              <!-- Menu Footer
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>-->
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="index.php">
           <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="pull-right"></i>
            </span>
          </a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
            <span>Enquiry</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
<!--            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
			-->
          </a>
          <ul class="treeview-menu">
            <li><a href="enquiry.php"><i class="fa fa-circle-o"></i> Create</a></li>
            <li><a href="enquiry-view.php"><i class="fa fa-circle-o"></i> View & Payment Approve </a></li>
		 <!--- <li>  <a   href="verifiedenquiry-view.php"><i class="fa fa-circle-o"></i> Verified Enquiries </a></li>-->
            <li><a href="rejectedenquiry-view.php"><i class="fa fa-circle-o"></i> Rejected Enquiries </a></li>
          </ul>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-user" aria-hidden="true"></i>
			<span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li><a href="enquiry-newuser.php"><i class="fa fa-circle-o"></i> Create</a></li>
            <li><a href="customer-view.php"><i class="fa fa-circle-o"></i> View </a></li>
			 <li><a href="enquiry-view.php"><i class="fa fa-circle-o"></i> Enquiries </a></li>
			<li><a href="Noncustomer-view.php"><i class="fa fa-circle-o"></i> Non customer </a></li>
			<li><a href="close_list.php"><i class="fa fa-circle-o"></i> Closed</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes" aria-hidden="true"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="products.php"><i class="fa fa-circle-o">   </i> Create</a></li>
            <li><a href="product-view.php"><i class="fa fa-circle-o"></i> View</a></li>
			<li><a href="returnlist-view.php"><i class="fa fa-circle-o"></i> Return</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="invoice.php">
            <i class="fa fa-file-text" aria-hidden="true"></i>
			<span>Generate Invoice</span>
          </a>
        </li>
        <li class="treeview">
          <a href="verifiedenquiry-view.php">
            <i class="fa fa-link" aria-hidden="true"></i>
			<span>Product Mapping</span>
          </a>
        </li>
        <li class="treeview">
          <a href="service-request.php">
            <i class="fa fa-wrench" aria-hidden="true"></i>
			<span>Service Request</span>
          </a>
        </li>

		<li  class="treeview"><a href="transport-expense.php"><i class="fa fa-truck"></i> Transport</a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-inr" aria-hidden="true"></i>
			<span>Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="rent-receipt.php"><i class="fa fa-circle-o"></i> Rent Receipt</a></li>-->
           <!-- <li><a href="advance-receipt.php"><i class="fa fa-circle-o"></i> Advance Received</a></li>-->
                <li><a href="general-expense.php"><i class="fa fa-circle-o"></i> General Expenses</a></li>
            <!--<li><a href="service-expense.php"><i class="fa fa-circle-o"></i> Service Expenses</a></li>-->

            <li><a href="refund.php"><i class="fa fa-circle-o"></i>Refund</a></li>
       <li><a href="refundList.php"><i class="fa fa-circle-o"></i>Refunded List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>
			<span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  <li><a href="product-trend.php"><i class="fa fa-circle-o"></i> Product Trend</a></li>
		  <li><a href="product-cat-summary.php"><i class="fa fa-circle-o"></i>  Category Wise Summary </a></li>
          <li><a href="product-cat-adavacecol.php"><i class="fa fa-circle-o"></i>  Advance  </a></li>
		  <li><a href="product-cat-profee.php"><i class="fa fa-circle-o"></i>  Processing Fee  </a></li>
		  <li><a href="product-cat-rent.php"><i class="fa fa-circle-o"></i>  Rent Cost  </a></li>
          <li><a href="client-summary.php"><i class="fa fa-circle-o"></i> Client Summary</a></li>
          <!--<li><a href="client-detailed.php"><i class="fa fa-circle-o"></i> Client Detailed</a></li>-->
          <li><a href="client-trend.php"><i class="fa fa-circle-o"></i> Client Trend</a></li>
          <!---<li><a href="product-summary.php"><i class="fa fa-circle-o"></i> Product Summary</a></li>
          <li><a href="product-detailed.php"><i class="fa fa-circle-o"></i> Product Detailed</a></li>
          <li><a href="product-trend.php"><i class="fa fa-circle-o"></i> Product Trend</a></li>-->
          <!--<li><a href="return-summary.php"><i class="fa fa-circle-o"></i> Return Summary</a></li>-->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>System Parameters</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

		    <ul class="treeview-menu system-parameter">
				<li>General</li>
				<li><a href="sp-state.php"><i class="fa fa-circle-o"></i> State</a></li>
				<li><a href="sp-city.php"><i class="fa fa-circle-o"></i> City</a></li>
				<li><a href="sp-zone.php"><i class="fa fa-circle-o"></i> Zone</a></li>
				<li><a href="sp-area.php"><i class="fa fa-circle-o"></i> Area</a></li>
				<li><a href="sp-nativity.php"><i class="fa fa-circle-o"></i> Nativity</a></li>
				<li><a href="sp-employee.php"><i class="fa fa-circle-o"></i> Employee</a></li>
				<li><a href="sp-company.php"><i class="fa fa-circle-o"></i> Company</a></li>
				<li>Product</li>
				<li><a href="sp-product.php"><i class="fa fa-circle-o"></i>Product Category</a></li>
				<li><a href="sp-subcategory.php"><i class="fa fa-circle-o"></i> Subcategory</a></li>
				<li><a href="sp-variant.php"><i class="fa fa-circle-o"></i> Variant</a></li>
				<li><a href="sp-brand.php"><i class="fa fa-circle-o"></i> Brand</a></li>
				<li><a href="sp-vendor.php"><i class="fa fa-circle-o"></i> Vendor</a></li>
				<li>Content</li>
				<li><a href="sms.php"><i class="fa fa-circle-o"></i>SMS CONTANT</a></li>
          </ul>

        </li>
        <li><a onclick="backup()"><i class="fa fa-book"></i> <span>Backup</span></a></li>
		<li><a onclick="exportAll()"><i class="fa fa-book"></i> <span>Export All</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
