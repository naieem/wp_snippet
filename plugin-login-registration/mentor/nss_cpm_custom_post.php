<?php
/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by Nsstheme
 */

//class define 
class nss_cpm_custom_post {

    //visibility
    public $cpt = 'modal_image';

    //contruct
    public function __construct() {
        add_action('init', array($this, 'register_nsscpm'));
        add_action('admin_menu', array($this, 'nsscpm_custom_submenu_page'));
    }

    //method
    public function nsscpm_custom_submenu_page() {
        add_submenu_page('edit.php?post_type=modal_image', __('ShortCode Settings', 'nsstheme'), __('ShortCode Settings', 'nsstheme'), 'manage_options', 'nsstheme_shortcode', array($this, 'nsscmp_shortcode_settings_page'));
    }

    public function nsscmp_shortcode_settings_page() {
        echo '<h1>Just use this Shortcode in your page or create a new template in your theme</h1>';
        echo '<b>[showing_mixup]</b>';
    }

    public function register_nsscpm() {
        // register code here
        register_post_type($this->cpt, array(
            'labels' => array(
                'name' => __('Modal Images', 'nsstheme'),
                'singular_name' => __('Modal Image', 'nsstheme'),
                'add_new' => __('Add New Modal Image', 'nsstheme'),
                'add_new_item' => __('Add New Modal Image', 'nsstheme'),
                'edit_item' => __('Edit Modal Image', 'nsstheme'),
                'new_item' => __('New Modal Image', 'nsstheme'),
                'view_item' => __('View Modal Image', 'nsstheme'),
                'search_items' => __('Search Modal Images', 'nsstheme'),
                'not_found' => __('No Modal Images found', 'nsstheme'),
                'not_found_in_trash' => __('No Modal Images found in Trash', 'nsstheme'),
                'parent_item_colon' => __('Parent Modal Image:', 'nsstheme'),
                'menu_name' => __('Modal Images', 'nsstheme'),
            ),
            'description' => 'Manipulating with our Modal Images',
            'public' => true,
            'show_in_nav_menus' => true,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            ),
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 35,
            'has_archive' => true,
            'menu_icon' => 'dashicons-vault',
            'query_var' => true,
            'rewrite' => array('slug' => $this->cpt),
            'capability_type' => 'post',
            'map_meta_cap' => true
        )); // end register_post_type

        register_taxonomy('image_location', $this->cpt, array(
            'hierarchical' => true,
            'labels' => array(
                'name' => __('Locations', 'nsstheme'),
                'singular_name' => __('Location', 'nsstheme'),
                'search_items' => __('Search Locations', 'nsstheme'),
                'popular_items' => __('Popular Locations', 'nsstheme'),
                'all_items' => __('All Locations', 'nsstheme'),
                'parent_item' => __('Parent Location', 'nsstheme'),
                'parent_item_colon' => __('Parent Location', 'nsstheme'),
                'edit_item' => __('Edit Location', 'nsstheme'),
                'update_item' => __('Update Location', 'nsstheme'),
                'add_new_item' => __('Add New Location', 'nsstheme'),
                'new_item_name' => __('New Location Name', 'nsstheme'),
                'add_or_remove_items' => __('Add or remove Locations', 'nsstheme'),
                'choose_from_most_used' => __('Choose from most used nsstheme', 'nsstheme'),
                'menu_name' => __('Location', 'nsstheme'),
            ),
            'rewrite' => array(
                'slug' => 'image_location',
                'with_front' => false,
                'hierarchical' => true
            ),
            'show_admin_column' => true,
        )); // end register_taxonomy
        flush_rewrite_rules(false);
    }

// end method
}

// END class