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
        add_action('wp_ajax_nopriv_login_response', array($this, 'login_response'));
        add_action('wp_ajax_login_response', array($this, 'login_response'));
    }

    //start method chaining
    public function login_response() {
//        $d = $_REQUEST['data'];
        //echo $d;
//        $formdata=array();
//        parse_str($_POST['data'], $formdata);
//        print_r($formdata);
        //echo $formdata['pippin_user_login'];
        //var_dump($_POST);
        //echo "<br.";
        //var_dump($_FILES);
        //echo $_FILES['upload_file']['type'];
        echo $_POST['id'];
//        $t = wp_check_filetype(basename($_FILES['upload_file']['name']));
//        //var_dump($t);
//        echo $t['type'];
//        $upload = wp_upload_bits($_FILES['upload_file']['name'], null, file_get_contents($_FILES['upload_file']['tmp_name']));
//        if (isset($upload['error']) && $upload['error'] != 0) {
//            wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
//        } else {
//            //add_post_meta($id, 'wp_custom_attachment', $upload);
//            update_post_meta($_POST['id'], 'bg_img', $upload);
//        } // end if/else.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $files = $_FILES['upload_file'];
        //echo $files['name']['0'];
        foreach ($files['name'] as $key => $value) {
            echo $files['name'][$key];
            if ($files['name'][$key]) {
                $file = array(
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                );
                $_FILES = array("my_file_upload" => $file);
                foreach ($_FILES as $file => $array) {
                    $newupload = media_handle_upload($file, $_POST['id']);
                }
                echo $newupload;
            }
        }

        //These files need to be included as dependencies when on the front end.
//
//        // Let WordPress handle the upload.
//        // Remember, 'my_image_upload' is the name of our file input in our form above.
//        $attachment_id = media_handle_upload('upload_file', $_POST['id']);
//        
//        $att_url= wp_get_attachment_url($attachment_id);
//        update_post_meta($_POST['id'], 'bg_img', $att_url);
//        echo $att_url;
        die();
    }

}

//end class
