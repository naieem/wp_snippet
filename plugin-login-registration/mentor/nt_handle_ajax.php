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
        // logo uploading ajax
        add_action('wp_ajax_upload_logo', array($this, 'logo_upload'));
        add_action('wp_ajax_nopriv_upload_logo', array($this, 'logo_upload'));
        // Banner Update ajax
        add_action('wp_ajax_banner_update', array($this, 'update_banner_part'));
        add_action('wp_ajax_nopriv_banner_update', array($this, 'update_banner_part'));
        // Why update ajax
        add_action('wp_ajax_why_update', array($this, 'update_why'));
        add_action('wp_ajax_nopriv_why_update', array($this, 'update_why'));
        // attachment delete ajax
        add_action('wp_ajax_delete_attachement', array($this, 'attachment_delete'));
        add_action('wp_ajax_nopriv_delete_attachement', array($this, 'attachment_delete'));
        /* icon upload */
        add_action('wp_ajax_icon_upload', array($this, 'upload_icon'));
        add_action('wp_ajax_nopriv_icon_upload', array($this, 'upload_icon'));
    }

    // logo uploading ajax
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

    // Banner Update ajax    
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

    // Why update ajax
    public function update_why() {
        $data = array();
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        $newupload = media_handle_upload('why_file', $_POST['id']);
//        update_post_meta($_POST['id'], 'banner_title', $_POST['banner_title']);
//        update_post_meta($_POST['id'], 'banner_sub_title', $_POST['banner_sub_title']);
//        update_post_meta($_POST['id'], 'banner_bg', wp_get_attachment_url($newupload));
//        echo $_POST['banner_title'] . "<br>";
//        echo $_POST['banner_sub_title'] . "<br>";

        if (isset($_POST['why_title'])) {
            $why_title = $_POST['why_title'];
            update_post_meta($_POST['id'], 'why_title', $why_title);
        }

        if (isset($_POST['why_points'])) {
            $why_points = $_POST['why_points'];
            update_post_meta($_POST['id'], 'why_points', $why_points);
        }

        if (isset($newupload)) {
            update_post_meta($_POST['id'], 'why_bg', wp_get_attachment_url($newupload));
        }
        $data['image_id'] = $newupload;
        $data['image_url'] = wp_get_attachment_url($newupload);
        echo json_encode($data);
        die();
    }

    // attachment_delete ajax    
    public function attachment_delete() {
        $data = array();
        if (false === wp_delete_attachment($_POST['id']) || $_POST['id'] == '') {
            $data['message'] = "Attachment Not deleted";
            $data['result'] = false;
        } else {
            $data['message'] = "Attachment deleted succesfully";
            $data['result'] = true;
            update_post_meta($_POST['post_id'], 'why_bg', "");
        }
        echo json_encode($data);
        die();
    }

    /* #######
     * Getting image name from image url
      ####### */

    public function get_image_name($url) {
        $url_arr = explode('/', $url);
        $ct = count($url_arr);
        $name = $url_arr[$ct - 1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_name = $name_div[$ct_dot - $ct_dot];
        return $img_name;
    }

    // attachment_delete ajax    
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
        //var_dump($_FILES);

        die();
    }

}

//end class
