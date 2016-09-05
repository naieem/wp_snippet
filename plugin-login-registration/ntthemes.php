<?php
/*
  Plugin Name: Custom Login registration plugin
  Plugin URI:  https://wordpress.org/plugins/custom-login
  Description: Custom user login registration and landing page creating is very easy with this.
  Version:     1.1
  Author:      Naieem Mahmud Supto
  Author URI:  https://facebook.com/naieemmahmudsupto
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain: nsstheme-mix
 */

/**
  copyRight by Naieem Supto
 */
/* protected */
if (!defined('ABSPATH'))
    exit;

//define
define('NT_CPM_PLUGIN_URL', plugin_dir_url(__FILE__));

/* required */
require_once 'mentor/nt_login_registration.php';
require_once 'mentor/nt_handle_ajax.php';
require_once 'mentor/nt_meta_box.php';
require_once 'mentor/nt_user_field.php';

/* class declerations */
new nt_login_registration();
new nt_handle_ajax();
new nt_meta_box();
new nt_user_field();