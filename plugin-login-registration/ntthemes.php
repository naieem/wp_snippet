<?php
/*
  Plugin Name: Custom Login registration plugin
  Plugin URI:  https://wordpress.org/plugins/custom-login
  Description: Custom post mixItup, if you use it. you can easily create a custom post, taxonomics and put your required title content and images
  Version:     1.1
  Author:      ntthemes
  Author URI:  https://naieesupto.wordpress.com/about
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

/* class declerations */
new nt_login_registration();
new nt_handle_ajax();
new nt_meta_box();
