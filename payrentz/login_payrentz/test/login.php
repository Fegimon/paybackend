<!DOCTYPE html>
<html lang="en">
    
	<head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>PayRentz</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<style>
			body{background:#ddd;}
			.main {width: 90%;margin: 200px auto;position: relative;}
			.log_form .field{position: relative;}
			.log_form{
						width: 300px;
						margin: 60px auto 30px;
						padding: 10px;
						position: relative;
						box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 3px 7px rgba(0, 0, 0, 0.3), inset 0 1px rgba(255,255,255,1), inset 0 -3px 2px rgba(0,0,0,0.25);
						border-radius: 5px;
						background: white;
						background: -moz-linear-gradient(#eeefef, #ffffff 10%);
						background: -ms-linear-gradient(#eeefef, #ffffff 10%);
						background: -o-linear-gradient(#eeefef, #ffffff 10%);
						background: -webkit-gradient(linear, 0 0, 0 100%, from(#eeefef), color-stop(0.1, #ffffff));
						background: -webkit-linear-gradient(#eeefef, #ffffff 10%);
						background: linear-gradient(#eeefef, #ffffff 10%);
				}
				.log_form input[type=text], .log_form input[type=password]{
					font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
					font-size: 13px;
					font-weight: 400;
					text-shadow: 0 1px 0 rgba(255,255,255,0.8);
					width: 100%;
					padding: 10px 18px 10px 45px;
					border: none;
					box-shadow: inset 0 0 5px rgba(0,0,0,0.1), inset 0 3px 2px rgba(0,0,0,0.1);
					border-radius: 3px;
					background: #f9f9f9;
					color: #777;
					-webkit-transition: color 0.3s ease-out;
					-moz-transition: color 0.3s ease-out;
					-ms-transition: color 0.3s ease-out;
					-o-transition: color 0.3s ease-out;
					transition: color 0.3s ease-out;
				}
				.log_form button{
					width: 100%;
					height: 100%;
					margin-top: -1px;
					font-size: 1.4em;
					line-height: 1.75;
					color: white;
					border: none;
					border-radius: inherit;
					background: #3c8dbc;
					background: -moz-linear-gradient(#3c8dbc, #42A2BC);
					background: -ms-linear-gradient(#3c8dbc, #42A2BC);
					background: -o-linear-gradient(#3c8dbc, #42A2BC);
					background: -webkit-gradient(linear, 0 0, 0 100%, from(#3c8dbc), to(#42A2BC));
					background: -webkit-linear-gradient(#3c8dbc, #42A2BC);
					background: linear-gradient(#3c8dbc, #42A2BC);
					box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), 0 1px 2px rgba(0,0,0,0.35), inset 0 3px 2px rgba(255,255,255,0.2), inset 0 -3px 2px rgba(0,0,0,0.1);
					cursor: pointer;
				}
				.log_form .submit{
					width: 65px;
					height: 65px;
					position: absolute;
					top: 22px;
					right: -25px;
					padding: 10px;
					z-index: 2;
					background: #ffffff;
					border-radius: 50%;
					box-shadow: 0 0 2px rgba(0,0,0,0.1), 0 3px 2px rgba(0,0,0,0.1), inset 0 -3px 2px rgba(0,0,0,0.2);
				}	
				.log_form .field i{
					left: 0px;
					top: 0px;
					position: absolute;
					height: 36px;
					width: 36px;
					border-right: 1px solid rgba(0, 0, 0, 0.1);
					box-shadow: 1px 0 0 rgba(255, 255, 255, 0.7);
					color: #777777;
					text-align: center;
					line-height: 42px;
					-webkit-transition: all 0.3s ease-out;
					-moz-transition: all 0.3s ease-out;
					-ms-transition: all 0.3s ease-out;
					-o-transition: all 0.3s ease-out;
					transition: all 0.3s ease-out;
					pointer-events: none;
				}
				.main img{margin-left:440px;}
		</style>
	</head>
    
	<body>
        <div class="container">
		  <section class="main">
				<a href=""><img src="pay-logo.png" class="img-responsive" alt="payrentz-logo"></a>
				<form class="log_form" action="../login_check.php" method="POST">
					<p class="field">
						<input type="text" name="usr_name" placeholder="Username or email" required >
						<i class="fa fa-user" aria-hidden="true"></i> <!-- <i class="icon-user icon-large"></i> -->
					</p>
					<p class="field">
							<input type="password" name="pass"  placeholder="Password" required>
							<i class="fa fa-unlock-alt" aria-hidden="true"></i><!-- <i class="icon-lock icon-large"></i> -->
					</p>
					<p class="submit">
						<button type="submit" name="submit"><i class="fa fa-sign-in" aria-hidden="true"></i><!-- <i class="icon-arrow-right icon-large"></i> --></button>
					</p>
				</form>
				
				
			</section>
        </div>
    </body>
</html>