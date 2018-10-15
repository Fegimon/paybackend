<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!-- jQuery 2.1.4 --> 
<script src="<?php echo ADMIN_URL; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<!-- Bootstrap 3.3.2 JS --> 
<script src="<?php echo ADMIN_URL; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- FastClick --> 
<script src='<?php echo ADMIN_URL; ?>plugins/fastclick/fastclick.min.js'></script> 
<!-- Admin App --> 
<script src="<?php echo ADMIN_URL; ?>js/app.min.js" type="text/javascript"></script> 

<script src="<?php echo ADMIN_URL; ?>plugins/moment/moment.min.js" type="text/javascript"></script><?php /*?><!-- SlimScroll 1.3.0 --> 
<script src="<?php echo ADMIN_URL; ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<!-- ChartJS 1.0.1 --> 
<script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script><?php */?>

<!-- VALIDATION ENGINE -->
<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>plugins/jq-val/css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo ADMIN_URL; ?>plugins/jq-val/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo ADMIN_URL; ?>plugins/jq-val/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo ADMIN_URL; ?>plugins/jQueryUI/jquery-ui-1.10.3.js"></script> 
<script src="<?php echo ADMIN_URL; ?>plugins/jQueryUI/jquery-ui.js"></script>
<?php /*?>
<!-- Sparkline --><script src="<?php echo ADMIN_URL; ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script> 
<!-- jvectormap --> 
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script> 
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script> <?php */?>
<script type="text/javascript">

var myVar=setInterval(function(){myTimer()},1000);
//alert(moment().format('MMMM Do YYYY, h:mm:ss a'));
function myTimer()
{
	$("#time").html(moment().format('h:mm:ss a'));
}

//JS COOKIE
function createCookie(name, value, days)
{
    var expires;
    if (days)
	{
		var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }else
	{
		expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name)
{
	var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++)
	{
		var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name)
{
    createCookie(name, "", -1);
}

$('#navslide').click( function(){
	 var slidevalue=readCookie('menuslide');
	 if(slidevalue==null)
	 {
		 createCookie('menuslide', '1', 1);
	 }else
	 {
		 eraseCookie('menuslide');
	 }
 });

/*var slidevalue=readCookie('menuslide');
if(slidevalue=='1')
{
	$('.sidebar-mini').addClass('sidebar-collapse');
}else
{
	$('.sidebar-mini').removeClass('sidebar-collapse');
}
*/

//SLUG FUNCTION
function string_to_slug(str)
{
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
}

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function slug(valstr,id)
{
	if(valstr!='')
	{ 
		var str=trim(valstr);
		document.getElementById(id).value = string_to_slug(str);
	}
}
function adminpagechange()
{
	$('#adminpage').submit();
}

</script>