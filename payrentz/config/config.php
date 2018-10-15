<?php

/**
 * config.php
 * Displays some examples of class.db.php usage
 **/

define('DB_HOST', 'localhost');


//local
//define('DB_USER', 'root');
//define('DB_PASS', '');
//define('DB_NAME', 'payrentz');

//live
define('DB_USER', 'payadmin159');
define('DB_PASS', 'payadmin159');
define('DB_NAME', 'paytrentz1');


define('SEND_ERRORS_TO', 'silambarasandp12@gmail.com');
define('DISPLAY_DEBUG', true);

$homepath="";

require_once('class.db.php');
$database = new DB();
require_once('functs.php');
$functs = new Functions();

?>