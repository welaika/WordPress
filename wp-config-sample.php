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
define('DB_NAME', 'database_name_here');

/** MySQL database username */
define('DB_USER', 'username_here');

/** MySQL database password */
define('DB_PASSWORD', 'password_here');

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
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'welaikawp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'it_IT');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ( isset($_GET['debug']) && ($_GET['debug'] == 'debug') ){
  @ini_set('log_errors','On');
  @ini_set('error_log', dirname(__FILE__) .'/error.log');
  @ini_set('display_errors','On');
  @ini_set('error_reporting', E_ALL );
  define('WP_DEBUG', true);
  define('WP_DEBUG_DISPLAY', true);
} else {
  @ini_set('log_errors','Off');
  @ini_set('display_errors','Off');
  @ini_set('error_reporting', 0 );
  define('WP_DEBUG', false);
  define('WP_DEBUG_DISPLAY', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** weLaika Hacks */

/** 1. Disallow direct file edition. */
define('DISALLOW_FILE_EDIT', TRUE);

/** 2. Automatically empty trash. Solution to empty spam comments. */
define('EMPTY_TRASH_DAYS', 1);

/** 3. Automatic database repair. */
define('WP_ALLOW_REPAIR', true);

/** 4. Define max number of revisions. */
define('WP_POST_REVISIONS', 5 );

/** 5. Change wp-content dir. */
define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-laika' );

/** 6. Debug mode via $_GET. */
/** In line 81.*/

/** 7. Change uploads dir. */
define( 'UPLOADS', '/wp-laika/uploads' );

/** 8. Disable wp-cron by default */
define('DISABLE_WP_CRON', true);

/** 9. Make WP use 'direct' dowload method for install/update **/
define('FS_METHOD', 'direct');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
