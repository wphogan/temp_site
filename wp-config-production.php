<?php
/** SEIU custom WP configurator. */
/** DB Settings */
define('DB_NAME', 'seiu503dac');
define('DB_USER', 'seiu503dac');
define('DB_PASSWORD', 'xvYvPyHUeaFm');
define('DB_HOST', 'mysql02.seiuaws.org');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
/**#@ * Authentication Unique Keys and Salts. */
define('AUTH_KEY',         'z WrP>K>CY{(BSJtZ^Fr]-4b]`~`$+r,/VO(K+zPHeurl|@LV-i=mZDrH RM&5{s');
define('SECURE_AUTH_KEY',  'Qj;f!;`BcV#zE|h1`9A4%N(LZ(DMji%?QVIlj?7O>YzO#;;Z]$&V,3Jf:N?>GuI/');
define('LOGGED_IN_KEY',    '>>^-+r,P3$CobMsR$t0|2=y7amD#KrT= M&i`Ry(wVbw3szXXC}?+e70KM8]D+w|');
define('NONCE_KEY',        '2 X:30mF>0MN(2i*p0V*[y;edjJjDS7ly]v>-)]^{)nZ?gmmE]>@,OAfuL8GQp5x');
define('AUTH_SALT',        '4uj9l$uK.5R~G|Z47@@ziSPLvtiaW_$;J-XlwP{TT$#.+*`33;1oXQKWSwo>q7f`');
define('SECURE_AUTH_SALT', '+6a4[_TK0|X8=SC(PZ~@}IR&2}&6:3+9 v0vwFU+M%dmr,/_Z/cJl+BZSl9}Is&`');
define('LOGGED_IN_SALT',   'JXyS` Gj*;yI5)n`t}wpF<jd]PrPLCW}2im$+]15^mayf*^VQ)C{%o3V#BFQ7`?!');
define('NONCE_SALT',       '<aIwze1SkEQ_ntGqf31VB_UnF*Xi:>l3Xr%f4MQv-AAUDo&>=^JZ|+w_R}rOP7.Z');
$table_prefix  = 'oZQOK1_';
define('WP_POST_REVISIONS', 5 );
define('AUTOSAVE_INTERVAL', 300 ); // value in seconds
define('WP_CACHE', true);
$memcached_servers = array('default' => array('seiu-memcached.zp6hdh.cfg.use1.cache.amazonaws.com:11211'));
global $memcached_servers;
define ('WPLANG', '');
define('WP_DEBUG', false);
/* --- */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');