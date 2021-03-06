<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>PayRentz | Registration Page</title>	 
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">	  
	  <link rel="stylesheet" href="css/bootstrap.min.css">	  
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">	  
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">	  
	  <link rel="stylesheet" href="css/AdminLTE.css">	  
	  <link rel="stylesheet" href="css/blue.css">
	</head>
	<body class="hold-transition register-page">
		<div class="register-box">
			<div class="register-logo">
				<img src="images/pay-logo-big.png" />
			</div>
			<div class="register-box-body">
				<p class="login-box-msg">Register a new membership</p>
			
				<form action="index.html" method="post">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Full name">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Mobile">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Retype password">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox"> I agree to the <a href="#">terms</a>
								</label>
							</div>
						</div>
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
						</div>					
					</div>
				</form>
				<a href="login.php" class="text-center">I already have a membership</a>
			</div>
  		</div>
	
		<!-- Script Inlcude Section -->
	
		<script src="js/jquery-2.2.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/icheck.min.js"></script>
		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
	</body>
</html>
