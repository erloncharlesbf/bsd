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
define( 'DB_NAME', 'bsd' );

/** MySQL database username */
define( 'DB_USER', 'logaroo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'logd@dev2011' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY', '89!}1EfEZM>{*|u2)U?qO2:PCwc3UWlfzgF5.WDxD4vagw,JPeb@2 .F!suhcOgR' );
define( 'SECURE_AUTH_KEY', 'YfMg=2.r3-8{p%D:QV_F:Y^|%=JZ5~$LG*85tE4EY7O35#u&_*)@nn^30`{[d^y$' );
define( 'LOGGED_IN_KEY', '}|.At,6 f/6PPDO5Df5?Ux0}V8|79T-rqUJ,5(i&LF-54ixUZmZv4r}ieNd@Nj1o' );
define( 'NONCE_KEY', '1P}w9I:`;IDGKPdS*?)a*>Ncn~braL(KEU^+PpJ1`2:`:+fLqIY#e)8pqqh&jiVf' );
define( 'AUTH_SALT', 'iG-iLc=VsUqF uIQ[DKF+9}li+SNfGbgOpqJ05pyGx|l<Bm3WV_[yEyK|W,KT|wu' );
define( 'SECURE_AUTH_SALT', '}X 4y@V~(DfvJV7Qy[yt3(SgV~AQ<CDU$ZC*,k[maB4yL;kKF?|;qBnQAqVKS^)h' );
define( 'LOGGED_IN_SALT', 'l81l>e s!%A~dp:xg9=zv^O<sNn?0AvzFNv#L*DDN!v<QAsnqwdW?+m~wH VzC.s' );
define( 'NONCE_SALT', 'c.@:@3KuF7vY$T?y,oKp^gAJo% q^k{h; Ab}]]q%O@Ll]DzEx(18M{QGbXp*n_u' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bsd_';

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
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
