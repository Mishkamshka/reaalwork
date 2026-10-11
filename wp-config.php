<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'py= x><lxDU3r+>$CrMFxI(Q+:!<(2zvR3_$g_wSOS*{V4qET/za2v,2vc]AFLre' );
define( 'SECURE_AUTH_KEY',   '8uxGYCH;*mE|%]<FoRYV%i/zsj1$a`Qq;:nSLsD0}G[f#*&SF9No3vepbu)t&1q9' );
define( 'LOGGED_IN_KEY',     '6 10nS[?<2%g700VgZk]eI_QSH4M0*P5Us`M4mHu.4YIu%FpZIfs64e;SvM.JX]^' );
define( 'NONCE_KEY',         'V,Ro 89fd*dW6,nv&n1|j*u1*R|sLp=(t}/D:+bo07?G]FW+EWFlCf<#JW9CJ(L.' );
define( 'AUTH_SALT',         ':_y>{|DMbUt.uT>I,8|If?uVc!$MZoW6FQH`g_4rr+XiTPG#&`|6(^jUV`{rlVGN' );
define( 'SECURE_AUTH_SALT',  'PlSS-qSAsnQ6L1!mb1N}zH/f$^i&cfWZAUl^5|~WZ2{;TJY2CmYbTjb8%m1OSx5b' );
define( 'LOGGED_IN_SALT',    'eao-{$mD?xA~?{4%qAK+#q4U@g{`yOjpU&$o8bsbP%TVVLmE$xu|gwlw9 =<YRh7' );
define( 'NONCE_SALT',        'hS|mX?b]tRw9T!IA}wBDKL;1)D8.eEI[,Ol5!uz)e2gsudd:G2G$oo%<*W58] ;#' );
define( 'WP_CACHE_KEY_SALT', 'FK3b7q7/ADKo9zI]MjA^uCu.86Khe$L(!?o~jo)n`kpWCbzNLsiI8ozaNF)aXt7J' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true  );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
