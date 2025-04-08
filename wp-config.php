<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'culinary_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'hB+6aUYm~cz^]gN6l,fMj#jG1UNgL?IejrWc@x9Je-rZ)v$iad{zqlg-uvpi7(XM' );
define( 'SECURE_AUTH_KEY',  'xbd@QN#t~a`>@&oFG}-!TA3dQXU!JaZMIQc]z*e7l%Y9+T.f-kCZt/L?KTeqeXQ&' );
define( 'LOGGED_IN_KEY',    '.-*+U?7W{o@vz9obPQE=n_Vu%ZS2&=wyoz2x5Ltba*0N<-THQxFpEct3|[)cs/T.' );
define( 'NONCE_KEY',        'lWu)?<P4q3:HM|VQhtxXsK1,~#0][Akh!~lu<=gm^cMMtZ<JVm%j8Z6/g[dK&2:Z' );
define( 'AUTH_SALT',        'JE/yc}GRXz2[7CnF8Lmu(N=gAH`Ax6oULQIOE^kwOjef?Z9)y@4n4O3A_P^an0*F' );
define( 'SECURE_AUTH_SALT', 'G<q)el?<2$x/c#.-x@]wzYf>euVQq48iVnmFH?sM:_ylve|wAuy[0a>fdvcTS>>n' );
define( 'LOGGED_IN_SALT',   'p^:!>`O7y}I!I^?|,@0kI8[m,![cK-;wwiFdsB$X OO `4g^6t|#GAE9Xb+Z!O>6' );
define( 'NONCE_SALT',       '`SauJ1RxC_#V=f1)wp`|a+ara>LStGc]N5!yeW@o Qc8^m@<Y@)~d1x^B,HI|B-[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
