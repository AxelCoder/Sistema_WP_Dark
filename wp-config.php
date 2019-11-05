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
define( 'DB_NAME', 'dark' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LY>c`_hB+I8hUF|NCa M8X&}xt4P.Jsn4bbz~%,(5eY8k3_hJ4x@CIKQ7j>%{q6)' );
define( 'SECURE_AUTH_KEY',  'DJ^2#DAI8a`u+bxRlx7V,/306m$BMKT=t9m!>V/DsW}qs7EK|E%e$)^F!PfK^K?I' );
define( 'LOGGED_IN_KEY',    'h0u@mq}Ie8}4{QNC6v B7mj6`< hm4ABH4GC-^JLZC:ZJo>V@GSwo(!dQ_*yuvd[' );
define( 'NONCE_KEY',        'S7>ZDnc|95:;=w#73B8pkHmcUUuQVm;#@jndeI)aVnTn=uqIjR0N:#Cv(/{6I_gu' );
define( 'AUTH_SALT',        '0k1sAO|>fV|G*Pp8Bc.Bt~:/67g!>jBmC8jz|m>M<4 O0fO}OA^,pssXS2(;5C/-' );
define( 'SECURE_AUTH_SALT', 'RcV S:}ze}^niiRN:L?~fV4oD~luI_mJ{s&$ujknUN>/zFn{QxTK@ETGTHmv<Q)7' );
define( 'LOGGED_IN_SALT',   'giig_xJkiDcQ>Dy/FcLny82z;l{T^!%o5x778<@X*4p~4}]C-p~aRs{B,<9`lS$S' );
define( 'NONCE_SALT',       'Mb~#)A&9[Zjf2 )8d91^xIh07@QFvAr1woZbj*FH}qIasY#9j1oM2j$ijb0uxUM)' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
