<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the

 * installation. You don't have to use the web site, you can

 * copy this file to "wp-config.php" and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://codex.wordpress.org/Editing_wp-config.php

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('DB_NAME', 'payrentz');



/** MySQL database username */

define('DB_USER', 'prentz');



/** MySQL database password */

define('DB_PASSWORD', 'pay@#$2018');



/** MySQL hostname */

define('DB_HOST', 'localhost');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8mb4');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');

define('FS_METHOD','direct');

/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',         '{4fW5v2@O4~B~L&H&7mV*:<Z]XSi2! hIF~B0SY=mzU)g=+SnaikW4!:i M-wWXx');

define('SECURE_AUTH_KEY',  'UHh4rAM@g[.x/+pVP?oA>ZC2c #fiU_]0}Gyn7z=9+g1i$W0:]xig{s@m}[)sBlA');

define('LOGGED_IN_KEY',    'o4>BkU?dy|[y_v=S%RsH4,rN]bN`t*$3C3#P!K#92f R]U.9*HS>)N)MsCpBx4!#');

define('NONCE_KEY',        '2D$SQe#~20Ic+?cKsW}MO0hj@Tjtwz^N=PbkJkS!qV%:;QS:|S3]vyDMRdJ9=(MN');

define('AUTH_SALT',        'x&5GQb^+F/{Xz0SF.1X $O>WV{SBatnF?0t>AH{DM@NXq+PXi7.H`dDtuk/&5Rw[');

define('SECURE_AUTH_SALT', 'SQN-/b%d8?f3seI(mO67yC0),bukTh$Xo}2?u@=h0iFJ4!L +k]3_c$g;Cp=u<PV');

define('LOGGED_IN_SALT',   'd^#Hlvp!0RI7kRB1A<7[IWef$3>rUK=-wBZMI5z79x0aO1;Pq87H&ckQbMf:d((|');

define('NONCE_SALT',       '.`(%((kA+v;bD+7OJj6GSTaU$nCH]&a!`G YQ$:(e;]h=a@cB*YJ@P0Jo)PI+BPc');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'blog_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define('WP_DEBUG', false);



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

