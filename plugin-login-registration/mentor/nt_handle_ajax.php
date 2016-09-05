<?php

/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by Naieem Mahmud Supto
 */
//class define
class nt_handle_ajax {

    //construct
    public function __construct() {
        /*
         * ################
         * Logo upload
         * ################
         */
        add_action('wp_ajax_upload_logo', array($this, 'logo_upload'));
        add_action('wp_ajax_nopriv_upload_logo', array($this, 'logo_upload'));
        /*
         * ################
         * Banner Upadate
         * ################
         */
        add_action('wp_ajax_banner_update', array($this, 'update_banner_part'));
        add_action('wp_ajax_nopriv_banner_update', array($this, 'update_banner_part'));
        /*
         * ################
         * Why part Upadate
         * ################
         */
        add_action('wp_ajax_why_update', array($this, 'update_why'));
        add_action('wp_ajax_nopriv_why_update', array($this, 'update_why'));
        /*
         * ################
         * Attachment delete Upadate
         * ################
         */
        add_action('wp_ajax_delete_attachement', array($this, 'attachment_delete'));
        add_action('wp_ajax_nopriv_delete_attachement', array($this, 'attachment_delete'));
        /*
         * ################
         * Icon Upadate
         * ################
         */
        add_action('wp_ajax_icon_upload', array($this, 'upload_icon'));
        add_action('wp_ajax_nopriv_icon_upload', array($this, 'upload_icon'));

        /*
         * ################
         * Department Upadate
         * ################
         */
        add_action('wp_ajax_department_update', array($this, 'department_update'));
        add_action('wp_ajax_nopriv_department_update', array($this, 'department_update'));

        /*
         * ################
         * Founder Upadate
         * ################
         */
        add_action('wp_ajax_founder_update', array($this, 'founder_update'));
        add_action('wp_ajax_nopriv_founder_update', array($this, 'founder_update'));

        /*
         * ################
         * Menu Upadate
         * ################
         */
        add_action('wp_ajax_menu_update', array($this, 'menu_update'));
        add_action('wp_ajax_nopriv_menu_update', array($this, 'menu_update'));

        /*
         * ################
         * Footer Upadate
         * ################
         */
        add_action('wp_ajax_footer_update', array($this, 'footer_update'));
        add_action('wp_ajax_nopriv_footer_update', array($this, 'footer_update'));
    }

    /*
     * ##########
     * Footer update part is here
     * ########## 
     */

    public function footer_update() {
        $data = array();
        if (isset($_POST['about_text'])) {
            $about_text = $_POST['about_text'];
            update_post_meta($_POST['id'], 'about_text', $about_text);
        }

        if (isset($_POST['footer_text'])) {
            $footer_text = $_POST['footer_text'];
            update_post_meta($_POST['id'], 'footer_text', $footer_text);
        }
        $data['result'] = array($about_text, $footer_text);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Menu update part is here
     * ########## 
     */

    public function menu_update() {
        $data = array();
        update_post_meta($_POST['id'], 'menu', $_POST['menu']);
        $data['menu'] = $_POST['menu'];
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Founder update part is here
     * ########## 
     */

    public function founder_update() {
        $data = array();
        if (isset($_POST['update_founder'])) {
            if (!empty($_FILES['founder_img']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('founder_img', $_POST['id']);
                update_post_meta($_POST['id'], 'founder_img', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
            } else {
                $data['image_upload'] = false;
            }
            if (isset($_POST['founder_title'])) {
                $founder_title = $_POST['founder_title'];
                update_post_meta($_POST['id'], 'founder_title', $founder_title);
            }
            if (isset($_POST['founder_name'])) {
                $founder_name = $_POST['founder_name'];
                update_post_meta($_POST['id'], 'founder_name', $founder_name);
            }
            if (isset($_POST['founder_desc'])) {
                $founder_desc = $_POST['founder_desc'];
                update_post_meta($_POST['id'], 'founder_desc', $founder_desc);
            }
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['result'] = false;
        }
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Department update part is here
     * ########## 
     */

    public function department_update() {
        $data = array();
        if (isset($_POST['department_submit'])) {
            if (!empty($_FILES['department_file']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('department_file', $_POST['id']);
                update_post_meta($_POST['id'], 'dept_bg', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
            } else {
                $data['image_upload'] = false;
            }
            if (isset($_POST['dept_title'])) {
                $dept_title = $_POST['dept_title'];
                update_post_meta($_POST['id'], 'dept_title', $dept_title);
            }


            update_post_meta($_POST['id'], 'dept_single', $_POST['dept_single']);

            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['result'] = false;
        }
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Logo update part is here
     * ########## 
     */

    public function logo_upload() {
        $data = array();
        if (!empty($_FILES['logo_img']['name'])) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            //var_dump($_POST);
            //$files = $_FILES['logo_img'];
            //var_dump($_FILES);
            //echo $files['name']['0'];
//        foreach ($files['name'] as $key => $value) {
//            echo $files['name'][$key];
//            if ($files['name'][$key]) {
//                $file = array(
//                    'name' => $files['name'][$key],
//                    'type' => $files['type'][$key],
//                    'tmp_name' => $files['tmp_name'][$key],
//                    'error' => $files['error'][$key],
//                    'size' => $files['size'][$key]
//                );
//                $_FILES = array("my_file_upload" => $file);
//                foreach ($_FILES as $file => $array) {
//                    $newupload = media_handle_upload($file, $_POST['id']);
//                }
//                echo $newupload;
//            }
//        }
            $newupload = media_handle_upload('logo_img', $_POST['id']);
            update_post_meta($_POST['id'], 'logo_img', wp_get_attachment_url($newupload));
            $data['image_upload'] = true;
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['image_upload'] = false;
        }
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Banner update part is here
     * ########## 
     */

    public function update_banner_part() {
        $data = array();
        if (isset($_POST['banner_submit'])) {
            if (!empty($_FILES['banner_file']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('banner_file', $_POST['id']);
                update_post_meta($_POST['id'], 'banner_bg', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
                $data['image_url'] = wp_get_attachment_url($newupload);
                $data['image_id'] = $newupload;
                $data['result'] = true;
            } else {
                $data['image_upload'] = false;
            }
            update_post_meta($_POST['id'], 'banner_title', $_POST['banner_title']);
            update_post_meta($_POST['id'], 'banner_sub_title', $_POST['banner_sub_title']);
        }
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Why update part is here
     * ########## 
     */

    public function update_why() {
        $data = array();
        if (!empty($_FILES['why_file']['name'])) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            $newupload = media_handle_upload('why_file', $_POST['id']);
            update_post_meta($_POST['id'], 'why_bg', wp_get_attachment_url($newupload));
            $data['image_upload'] = true;
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['image_upload'] = false;
        }
        if (isset($_POST['why_title'])) {
            $why_title = $_POST['why_title'];
            update_post_meta($_POST['id'], 'why_title', $why_title);
        }
        update_post_meta($_POST['id'], 'why_points', $_POST['why_points']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Attachment delete part is here
     * ########## 
     */

    public function attachment_delete() {
        $data = array();
        if (false === wp_delete_attachment($_POST['id']) || $_POST['id'] == '') {
            $data['message'] = "Attachment Not deleted";
            $data['result'] = false;
        } else {
            $data['message'] = "Attachment deleted succesfully";
            $data['result'] = true;
            update_post_meta($_POST['post_id'], $_POST['field'], "");
        }
        echo json_encode($data);
        die();
    }

    /*
     * #########
     * Getting image name from image url
     * #########
     */

    public function get_image_name($url) {
        $url_arr = explode('/', $url);
        $ct = count($url_arr);
        $name = $url_arr[$ct - 1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_name = $name_div[$ct_dot - $ct_dot];
        return $img_name;
    }

    /*
     * #########
     * Upload icon to post
     * #########
     */

    public function upload_icon() {
        $icons = array();
        $data = array();
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        if (!empty($_FILES['department_icon']['name'])) {
            $newupload = media_handle_upload('department_icon', $_POST['id']);
            /* ######## pushign to array */
            if (count($_POST['dept_icons']) <= 0) {
                array_push($icons, wp_get_attachment_url($newupload));
            } else {
                $icons = $_POST['dept_icons'];
                array_push($icons, wp_get_attachment_url($newupload));
            }
            /* loop for getting url and name */
            $c = 0;
            foreach ($icons as $icon) {
                $data[$c]['url'] = $icon;
                $data[$c]['name'] = $this->get_image_name($icon);
                $c = $c + 1;
            }
            /* end naming and url getting */
            update_post_meta($_POST['id'], 'dept_icons', $icons); //updating post meta
            echo json_encode($data); // returning json value to view
        } else {
            /* ######## pushign to array */
            if (count($_POST['dept_icons']) <= 0) {
                //array_push($icons, wp_get_attachment_url($newupload));
            } else {
                $icons = $_POST['dept_icons'];
                //array_push($icons, wp_get_attachment_url($newupload));
            }
            /* loop for getting url and name */
            $c = 0;
            foreach ($icons as $icon) {
                $data[$c]['url'] = $icon;
                $data[$c]['name'] = $this->get_image_name($icon);
                $c = $c + 1;
            }
            /* end naming and url getting */
            update_post_meta($_POST['id'], 'dept_icons', $icons); //updating post meta
            echo json_encode($data); // returning json value to view
        }
        die();
    }

}

//end class
