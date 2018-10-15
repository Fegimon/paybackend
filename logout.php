<?php
require(dirname(__FILE__).'/appcore/app-register.php');

session_regenerate_id();
$session_id = session_id();
session_unset();
session_destroy();
header("Location:".SITE_URL);

?>
