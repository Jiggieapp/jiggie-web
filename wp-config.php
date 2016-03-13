<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// define('DB_NAME', 'jiggieapp_www');
define('DB_NAME', 'jiggieapp_www');

/** MySQL database username */
// define('DB_USER', 'jiggieappuser');
define('DB_USER', 'root');

/** MySQL database password */
// define('DB_PASSWORD', 'HyB6gA3m)a');
define('DB_PASSWORD', 'airf0rce1');

/** MySQL hostname */
// define('DB_HOST', '10.128.92.88');
define('DB_HOST', 'jiggieadmin-prod.ckt3zid9pi59.ap-southeast-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|z_7MnY/]K#&#.ssl-SK~`5|GIXv[6q1xO{pu/~R)x*O}bcdy=IwzQ3Y|`(L#yh`');
define('SECURE_AUTH_KEY',  '&nKcvS%~9N`8osy%o= -=>dC^{YdZRW0w]]1gpri&1;QzrYOE$>`V*l7kc5~}8UZ');
define('LOGGED_IN_KEY',    '%)j0W`ge/pw;<i>!<%]+)9|u5L:V_B^%uVk(7i,Dr-0SnR]ZMS>rot},<!{)<+qU');
define('NONCE_KEY',        '1{tK@4A1/f1+A[z6fdbrvU4W)cXFuSV,$-aN@5v0`;|tf/hSVco/{,R3+ l5*?tV');
define('AUTH_SALT',        'AD$o,+N#J!t7m^PJ`fd=ys+*9;$Zr)35B-bT5+&`~H7UWCOoEAQ/;KI77Qj-d`Gg');
define('SECURE_AUTH_SALT', 'T(1B-lGIg5v2M{*Vk|%/w:!z2{|9mrRh}/v)evqnpq0p+_0~4Sffs9q{MwO-f+@1');
define('LOGGED_IN_SALT',   'CPqQSSQ&wW1/*A0rvYzAZd:ImC9%v-)r?|z*[,2s+.j0SJ,#A(T+T#@kgs+e!Hs~');
define('NONCE_SALT',       'eCf-yq~%[o)QCqd]v8O5!.4d0b>Hc^TOU*aoJs?d+-ti~SE]{l.mTo7D^`!@E4`v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
