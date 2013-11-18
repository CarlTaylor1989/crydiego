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
define('DB_NAME', 'crydiego_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_MEMORY_LIMIT', '64M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U^/,J8aT2w*1(1<{.i)2]O+iLF-x4`G~T-@9vRe<LKNmJfoF&E#O!/)}e88{JRJ*');
define('SECURE_AUTH_KEY',  '*,hq_VD.@Sj<s!xjKn/^cRI_bC+[@HPg)R;vchfN eU!fa7*lfR _Is/)$amr+Jc');
define('LOGGED_IN_KEY',    'Y51A40o?^O{e) /Wj$:c-dI7WKlJD00_)S3^6ty 8`FU>6L{7?U;4b^RM58.p*hW');
define('NONCE_KEY',        '<9]!cEp?cWDfkiKzvOT=L4GWH(=?X|,1 @:<*[AVF~$*aSi|onAy!`0k[6XBQ)yb');
define('AUTH_SALT',        '@;}!R-QSKM]P}GAa+{Qj-)NUK7wAxVWpQ OT}yVd7S@k3MLFKS*Ww2$tW.pYdWxi');
define('SECURE_AUTH_SALT', '^c7gnG+Ebi] D%NI|2XcJsvGExb`-X!/7F-w?Pt7OaBSuC8>G_n:6bq]ZHk@ *gn');
define('LOGGED_IN_SALT',   ';?Gj|Ec-Wd&(KU!p>/>hzy[?ecydu#yo]iVaw0d~06AKTXb~hq-8aJ_@1+qtGp%V');
define('NONCE_SALT',       ',Sk-=uN$2:yl$)qlF+[wEy8<C%06HVlOl!td{lAs*d8)09TiCm.cb0bkKJ%Fs];Z');

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
