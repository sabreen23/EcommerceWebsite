<?php
define( 'WP_CACHE', true );


/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

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

define( 'DB_NAME', "u481628193_swiddlyMart" );


/** MySQL database username */

 define( 'DB_USER', "u481628193_admin" );




/** MySQL database password */

 define( 'DB_PASSWORD', "Ms.ScroogesMysql911" );

/** MySQL hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         'D@}`YLQL$BvU=opGkYz75))y{o|ZwSCTI+#=D`r4oj2-#y&a4<O:7YU]k[0l}x{2' );

define( 'SECURE_AUTH_KEY',  '%$7 JX/dnmo]G^@Ov~D$C.?7pF(Pbe2l9h$V.hS 7|=g6=,T+wOE6*-WR6LZ=MbB' );

define( 'LOGGED_IN_KEY',    'h$w!LB.IG:)egQJ[;gI~t^8tN*c`0](C(77RcGuh*84^4~jNKmvW~G&;~WJ/F tm' );

define( 'NONCE_KEY',        'j?,`.f .!Ce^{8i9L4jZW,Ae>?uA3<RhDa86USgNN/87$4~ q3r=;.:}[BtF,Lex' );

define( 'AUTH_SALT',        '1x:Yb.jjch-`:<+tFf!`G17j_lm^zhYb *VtLG@)^]`qOF%Y1+t6j}@xQn7%FVj]' );

define( 'SECURE_AUTH_SALT', 'QRz/$#L-PuBfoPLyJ@IF+FEM<~AC5_Y%jUK?m[k.+bkqA(DQTh>|@k=Hg]~S51>U' );

define( 'LOGGED_IN_SALT',   '7O]`}K$AVCL~+b-{.#Z^MTf4,-N<~YfFy~ETs9F@xKYSwkDAK=9.eqH8S/A[Rc~4' );

define( 'NONCE_SALT',       ']mAKl(kb=Wq%tVK8vF]8N_,UsqF|/7VKtn27<_l$O%Rq-%Nuwp%#G<`kMf.s,GBH' );


/**#@-*/


/**

 * WordPress database table prefix.

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


/* Add any custom values between this line and the "stop editing" line. */


define( 'WP_DEBUG', true );


define( 'WP_DEBUG_DISPLAY', false );


define( 'WP_DEBUG_LOG', true );



/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

