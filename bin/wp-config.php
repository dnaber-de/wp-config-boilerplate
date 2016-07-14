<?php
/**
 * WordPress config file template
 *
 * @link http://wpengineer.com/2382/wordpress-constants-overview/
 */

/**
 * MySQL credentials
 */
const DB_NAME     = '%DB_NAME%';
const DB_USER     = '%DB_USER%';
const DB_PASSWORD = '%DB_PASS%';
const DB_HOST     = 'localhost';
const DB_CHARSET  = 'utf8';
const DB_COLLATE  = 'utf8_general_ci';

$GLOBALS[ 'table_prefix' ] = 'wp_';
/**
 * WP-CLI requires the variable $table_prefix declared explicitly in 
 * the global namespace
 */
global $table_prefix;

/**
 * multisite
 *
 */
const WP_ALLOW_MULTISITE   = FALSE;
const MULTISITE            = FALSE;
#const DOMAIN_CURRENT_SITE  = '';
#const PATH_CURRENT_SITE    = '/';
#const SITE_ID_CURRENT_SITE = 1;
#const BLOG_ID_CURRENT_SITE = 1;
#const SUBDOMAIN_INSTALL    = TRUE;
#const COOKIE_DOMAIN        = '';


/**
 * debugging
 */
const WP_DEBUG         = FALSE;
const WP_DEBUG_DISPLAY = FALSE;
const WP_DEBUG_LOG     = FALSE;
const SCRIPT_DEBUG     = FALSE;

/**
 * security keys
 *
 * @link https://api.wordpress.org/secret-key/1.1/salt/
 */
const AUTH_KEY           = 'JOO!@@|_kyW4b6-yzG.fdYqmVXKbOOD/Q>6gq35d-.er]0)MM*e?$}6L+/YS/NWT';
const SECURE_AUTH_KEY    = 'B#W*Zwj]KrXG7Xkh-Rgby0-&R*GqbWZ;D1|v3huj(Q|mNoZ~N?Uaoa>vz:~9[_Cl';
const LOGGED_IN_KEY      = 'V-M6Zf  |<|nJ|Z]Sru-tu5=|73c+.YwG?05HU_b|6Ltaj vm-pbl+7Ye&s~Z9Hk';
const NONCE_KEY          = 'e>iNYAj(<oy!t[P9pUaN0VH1p$Z!|9#aT^>JTI;pcf$a?c2OJ7Ho7QCAa)1X#s7n';
const AUTH_SALT          = '1B;WZK]/=-AcG(T]<XNL@{vve`q`drvfG.A+#fI_vEXqpk[DW6nLD3zy[tZr}?M|';
const SECURE_AUTH_SALT   = 'W$i|gK@U%~1-,_fb3KD%>7)tCxjS1zcX;**E0O&|sjT^Vh+nyEbKu`ij+g/|BtIk';
const LOGGED_IN_SALT     = '~gh$f|(d`$/x3d+{e-z{XK{C:Bm{22C?vP<;4,SsF9&h_^qOOZ#`[9Oz A1,a[)+';
const NONCE_SALT         = 'wEO+=G!NbOp58yht>lG?vi:C_]i4s&`klmaTVthokC<V)-UHZU5u.9,HmY3%tiM/';




if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', __DIR__ . '/' );

require_once ABSPATH . 'wp-settings.php';
