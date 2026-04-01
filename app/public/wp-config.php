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
define( 'AUTH_KEY',          'Pze_@YA=UnZZHk*@*OI.*!|Q0dE+vH&)>D{@k5RL;4.mrRN-9-ryeDkG)m3(+Ucu' );
define( 'SECURE_AUTH_KEY',   '%| Is% ;&/DPF SrB*|9MYfN6PAHXJHV&3SE.NO #0k3Y?w2AEP^(Y+sV#%e&CH9' );
define( 'LOGGED_IN_KEY',     'OES6:Onvvv(II 7/1tW}9w;^IQ@ t|-PJ~xdNAG<ub`>sS$BCK*16{` ?,p +Iwi' );
define( 'NONCE_KEY',         'Q*( u#MKsap+:~S#ZVI;u!h+wZ^ S8}mG|T#V~x!{^Z[)DKeov%M-`5GvC|dRzi6' );
define( 'AUTH_SALT',         '+$<(i0`Sl;@gf;8^?,roR,q~:eUcE+cxKQCrD|a)`rbD%f@ DB|-%zmN|7wuDpwK' );
define( 'SECURE_AUTH_SALT',  '*|obgcM.B8l)B8V11X}y1s:4bx;(3Pnl0q/J5d17lG{~JtD|g!F/`=PXe86=s8`@' );
define( 'LOGGED_IN_SALT',    'YvD!k&s7biUOk4W&DkzTLF502OvZ57-!gxcu$)H~S@b#Jux|A4qKBB,m$se!&A[e' );
define( 'NONCE_SALT',        ',!BLz CKcKPNr4(T~XM53|by069--G?AL%AA5.#k+?^z,nV/WS(LQ`}H17.%j#!o' );
define( 'WP_CACHE_KEY_SALT', 'w393wNL+l1Zjq1vg1QyR+sf}S3!Z*Bm,f3)3gQ!,]w+H8*<l}wwv@~/3zK>Y=/px' );


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
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
