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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testsite' );

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
define( 'AUTH_KEY',         '*EY-vM}@_$y+9${jl4SHet%~L%LDh`bl}j1h}hL?>zbhfWi-~{ED]^+2UiLg[u)r' );
define( 'SECURE_AUTH_KEY',  '(-?erUp1@vXQD@NXU=w iq,8h,OnhS8[)&ag[.1JnAU&89biAk!*8rZcGJ}s]w6b' );
define( 'LOGGED_IN_KEY',    'UcLg b+~g8qP&M#$FJ?*P*,nHlv:pTn^ARc706/|{l%(!h)y11ydb&VGpt[uu1H|' );
define( 'NONCE_KEY',        'w2CBc|x@w3H(:0J,rcM=/+Ofrzx>AboR/&[P<V1o5=JB&uaD&tM.XI@enxN%m6th' );
define( 'AUTH_SALT',        ' Kh;OwD/L(s3cC,miZ`4*J1E_s/d/)}TbLi~xg0og%1wCNvt:+l#%[ GRy)y;mWe' );
define( 'SECURE_AUTH_SALT', ']afp^!kP#Z2Hu(z#W:WUg1 -2QEVZ3Y;_-b<Dg~4Q|SG]%z1AryAweRME[oKvMyG' );
define( 'LOGGED_IN_SALT',   '=Q<dBb3e~bgLA_I90>lG~{U`$q!Nbk(3H&H~_PrD$[2PS87q>(iLOoy4F%Nd}a;_' );
define( 'NONCE_SALT',       ')>3n!+XSx~^l6JiSo1yexN&.c%x8j^vmEYfxO=59{CbA*f0![!bzOud;fp6qG%kt' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
