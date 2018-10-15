<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="">  
  <div class="w3-agile-banner1">
  <!-- Trigger the modal with a button -->
  <button type="button" id="alertworng" data-toggle="modal" data-target="#alertworngModal" style="display:none;">Open Modal</button>  <!-- Modal -->

  <div class="modal fade" id="alertworngModal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm" style="width: 25%;margin: auto;top: 10em;">   
      <!-- Modal content-->
      <div class="modal-content" style="    border-radius: 0;">
        <div class="modal-header">
          <a type="button" onclick="thu();" class="close" data-dismiss="modal">&times;</a>
          <h4 class="modal-title text-center">Login Failed !</h4>
        </div>
        <div class="modal-body">
          <p class="text-center"><b>Username or Password is Incorrect.</b></p>
        </div>
        <div class="modal-footer">
          <a onclick="thu();" class="wrgpwdclose" data-dismiss="modal">Close</a>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  
</div>
<style>
.modal-backdrop {
   background-color: transparent;
}
.wrgpwdclose
{
	    color: #ff4003;
    text-transform: uppercase;
    font-weight: bold;
	cursor:pointer
}
.wrgpwdclose:hover	{
	text-decoration:none;
}
 .w3-agile-banner1   
	{
	background: url(login_payrentz/images/1.jpg)no-repeat 0px 0px;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    min-height: 700px;
	}

</style>
<script>
function thu()
{	
	window.location.href = 'login_payrentz/login.php';
}
</script>

</body>
</html>
<?php
   require_once('config/config.php'); 
   @$usr_name = $_POST['usr_name'];
   @$pass = $_POST['pass'];
   $checkLogin = $functs->fnCheckLogin($usr_name,$pass);
   session_start();
   if (!empty($checkLogin)) 
   {
	   
       $_SESSION['username'] =  $checkLogin[0]["user_name"];
	   $_SESSION['city'] =  $checkLogin[0]["city"];
	        $url = 'index.php';
			header("Location:  $url");  
   }
    	else
		{
			echo '<script language="javascript">';
			echo 'document.getElementById("alertworng").click();';
			echo '</script>';			
			$_SESSION['username'] =  'no';			  
		}
	

   
 ?>