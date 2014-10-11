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
define('DB_NAME', 'engsocwp');

/** MySQL database username */
define('DB_USER', 'engsocwp');

/** MySQL database password */
define('DB_PASSWORD', 'E#nhgtSWo9cdW@P)');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'y/LkuEb(|K?R4%x-JSnMS1Ww]TC*Eg+;Zt].wo^[uSEz/FBh7JSu$:&-z]VWe*qf');
define('SECURE_AUTH_KEY',  'y6dtaE#c*iN%vylF@?.~]S`54s:9+-nr(Cl`DT2Qt2TZ=-*&xNaj2+8*.1}#I@G/');
define('LOGGED_IN_KEY',    'gA1ILX^CB<4=rr&GGHtf4#juUp|e06FS5G)WaoUef||AL9Gn9W}CHu`O1 l)HQF4');
define('NONCE_KEY',        'F5)s^cIzC[Aui!W:Z^.76H;+(,%*=EY]OLWGj3~1W@pcd#5{wKki7<G:|utU~/a,');
define('AUTH_SALT',        '/UqIz,n[1/A$e-P7m)~d_x83lAB`+Z~hrDE9tsthYGA+|n+4h0Orx83[0S|R@XQF');
define('SECURE_AUTH_SALT', 'G 7YFS>pJ5w8i|s=W-tyB|9Od8n8Ttr24}ka7J+=Au;O-Vi~tuHYq8+*%mTzDHu2');
define('LOGGED_IN_SALT',   'EYSO{zS`A|d_a`9..[+D-s$MNKDM6$_r-#31#,.Y^~P6/yJBx%O02h#Fz^CMp1<6');
define('NONCE_SALT',       'K&l|WF!p9OL>|cEo>X3C|ytw&&805B0C[GF,SNaFdW~~dWi-xC3DXc7W!D6.t@o ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
