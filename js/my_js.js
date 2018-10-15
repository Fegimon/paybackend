//function to validate empty field for contact form
function check_empty(){
if(document.getElementById('name').value == "" 
|| document.getElementById('email').value == "" 
||document.getElementById('msg').value == "" ){
alert ("Fill All Fields !");
}
	else {  
	document.getElementById('form').submit();  
	alert ("Form submitted successfully...");
	}
}

//function to validate empty field for login form
function check_empty_login(){
if(document.getElementById('usern').value == "" || document.getElementById('pass').value == ""){
alert ("Invalid UserName and Password");
}
	else {  
	document.getElementById('form2').submit();  
	alert ("Login successfully...");
	}
}

//function to display Popup
function div_show(){ 
document.getElementById('abc').style.display = "block";
document.getElementById('form1').style.display = "block";
document.getElementById('form').style.display = "none";
document.getElementById('form2').style.display = "none";
}

//function to hide Popup
function div_hide(){ 
document.getElementById('abc').style.display = "none";
}

function form_show(){ 
document.getElementById('form1').style.display = "none";
document.getElementById('form').style.display = "block";
}

function login_form_show(){ 
document.getElementById('form1').style.display = "none";
document.getElementById('form2').style.display = "block";
}