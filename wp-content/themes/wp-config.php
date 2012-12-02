<?php
// ** MySQL settings ** //
define('DB_NAME', 'natduffy');    // The name of the database
define('DB_USER', 'natduffy');     // Your MySQL username
define('DB_PASSWORD', 'Linds4y'); // ...and password
define('DB_HOST', 'p50mysql243.secureserver.net');    // 99% chance you won't need to change this value
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Change each KEY to a different unique phrase.  You won't have to remember the phrases later,
// so make them long and complicated.  You can visit http://api.wordpress.org/secret-key/1.1/
// to get keys generated for you, or just make something up.  Each key should have a different phrase.
define('AUTH_KEY', '0X}kfg ]FDYaV:p<J=Z#(w(&O mM3E,0AtWs:5#ju)mQ{;uxHjV/;$W`>>`]Yi8G');
define('SECURE_AUTH_KEY', 'g>&YU5C .7\'UiC7ND=^Qt-Z@,/+zf[?Meeec<`s*H98Ea@YJ8&QT?|a=ZB*U1Gnb');
define('LOGGED_IN_KEY', 'K;}k3;`t\\Z9G!UJL@ZkIS:lNk\"RXs/hYvFxLDY|~hPu+B}OrJis(x:3\\Th9V|Xa@');


// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = 'wp_';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-content/languages.
// For example, install de.mo to wp-content/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
?>
