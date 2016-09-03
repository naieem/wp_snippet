<?php
/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by Nsstheme
 */
//class define
class nt_handle_ajax {

    //construct
    public function __construct() {
        add_action('wp_ajax_upload_logo', array($this, 'logo_upload'));
        add_action('wp_ajax_nopriv_upload_logo', array($this, 'logo_upload'));

        add_action('wp_ajax_banner_update', array($this, 'update_banner_part'));
        add_action('wp_ajax_nopriv_banner_update', array($this, 'update_banner_part'));

        add_action('wp_ajax_why_update', array($this, 'update_why'));
        add_action('wp_ajax_nopriv_why_update', array($this, 'update_why'));
    }

    //start method chaining
    public function logo_upload() {

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
        //wp_get_attachment_url($newupload);
        update_post_meta($_POST['id'], 'logo_img', wp_get_attachment_url($newupload));
        ob_start();
        ?>
        <img src="<?php echo wp_get_attachment_url($newupload); ?>" height="200" width="200">
        <?php
        echo ob_get_clean();
        die();
    }

    public function update_banner_part() {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        $newupload = media_handle_upload('banner_file', $_POST['id']);
        update_post_meta($_POST['id'], 'banner_title', $_POST['banner_title']);
        update_post_meta($_POST['id'], 'banner_sub_title', $_POST['banner_sub_title']);
        update_post_meta($_POST['id'], 'banner_bg', wp_get_attachment_url($newupload));
        echo $_POST['banner_title'] . "<br>";
        echo $_POST['banner_sub_title'] . "<br>";
        echo wp_get_attachment_url($newupload);
        die();
    }

    public function update_why() {
//        require_once( ABSPATH . 'wp-admin/includes/image.php' );
//        require_once( ABSPATH . 'wp-admin/includes/file.php' );
//        require_once( ABSPATH . 'wp-admin/includes/media.php' );
//        $newupload = media_handle_upload('banner_file', $_POST['id']);
//        update_post_meta($_POST['id'], 'banner_title', $_POST['banner_title']);
//        update_post_meta($_POST['id'], 'banner_sub_title', $_POST['banner_sub_title']);
//        update_post_meta($_POST['id'], 'banner_bg', wp_get_attachment_url($newupload));
//        echo $_POST['banner_title'] . "<br>";
//        echo $_POST['banner_sub_title'] . "<br>";
//        echo wp_get_attachment_url($newupload);
        if (isset($_POST['why_title'])) {
            $why_title = $_POST['why_title'];
            update_post_meta($post_id, 'why_title', $why_title);
        }

        if (isset($_POST['why_points'])){
            $why_points = $_POST['why_points'];
            update_post_meta($post_id, 'why_points', $why_points);
        }
        die();
    }

}

//end class
