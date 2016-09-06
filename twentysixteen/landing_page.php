<?php
/**
 * Template Name: Custom Landing
 * @package WordPress
 * @subpackage Twenty_sixteen
 * @since 2016
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Landig Page</title>

        <!-- Bootstrap -->
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/css/bootstrap.min.css" rel="stylesheet">
        <!-- Owl Carousel -->
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/css/theme_default.css" rel="stylesheet">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/css/owl.theme.css" rel="stylesheet">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/css/owl.carousel.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/css/font-awesome.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/style.css">
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/themes/default.min.css"/>
        <style>
            .why_img, .overlay_hover {
                width: 200px;
                height: 200px;
                position: relative;
            }
            .overlay {
                position: absolute;
                top: 0;
                right: 10px;
                cursor: pointer;
                opacity: 0;
                -webkit-transition: opacity .50s ease;
                transition: opacity .50s ease;
                padding: 0 5px 7px 7px;
                font-size: 50px;
                line-height: 16px;
                color: red;
                background: black;
            }
            .overlay_hover:hover .overlay {
                opacity: 1;
            }
            .slide_container {
                display: none;
                border: 1px solid green;
                padding: 50px;
                float: left;
                width: 100%;
            }
            .loggedout_doc h1 {
                cursor: pointer;
                text-align: center;
                border: 1px solid #000;
                padding: 10px;
                font-size: 20px
            }
            .form-control {
                margin-bottom: 20px;
            }
            .btn-default {
                margin-bottom: 20px;
            }
            .loggedout_doc{
                display:none;
            }
            .icons_form{
                float: left;
                border: 1px solid bisque;
                padding: 30px;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
    </head>
    <body>
        <?php
        global $post;
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $page_id = get_the_id($post->ID);
            $author_page_id = get_the_author_meta('page_link', $user_id);
            /*
             * ##############
             * retrieves the attachment ID from the file URL
             * ############## 
             */

            function naieem_get_image_id($image_url) {
                global $wpdb;
                $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
                if ($attachment) {
                    return $attachment[0];
                }
            }

            /*
             * ##############
             * Get image name from url
             * ############## 
             */

            function get_image_name($url) {
                $url_arr = explode('/', $url);
                $ct = count($url_arr);
                $name = $url_arr[$ct - 1];
                $name_div = explode('.', $name);
                $ct_dot = count($name_div);
                $img_name = $name_div[$ct_dot - $ct_dot];
                return $img_name;
            }

            if ($page_id == $author_page_id) {
                ob_start();
                
                /* ##########
                 * Front end editing part start
                 * ############
                 */
                ?>
                <div class="container loggedout_doc" style="padding:50px 0">
                    <?php
                    /*
                     * ##############
                     * Start Logo Part
                     * ############## 
                     */
                    $logo = get_post_meta($page_id, "logo_img", true);
                    if ($logo != '') {
                        $logo_image_id = naieem_get_image_id($logo);
                    } else {
                        $logo_image_id = '';
                    }
                    ?>
                    <h1>Logo Part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal profile_logo_uploader" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Logo Upload:</label>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <input type="file" name="logo_img" id="logo_img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Logo Image:</label>
                                    <div class="col-md-10">
                                        <div class="why_img overlay_hover"> <img src="<?php echo $logo; ?>" class="logo_img" height="200" width="200"> <span class="overlay" data-update-field='logo_img' id="<?php echo $logo_image_id; ?>" data-post-id="<?php echo $post->ID; ?>">-</span> </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start Banner Part
                     * ############## 
                     */
                    $banner_title = get_post_meta($post->ID, "banner_title", true);
                    $banner_sub_title = get_post_meta($post->ID, "banner_sub_title", true);
                    $banner_bg = get_post_meta($post->ID, "banner_bg", true);
                    if ($banner_bg != '') {
                        $banner_image_id = naieem_get_image_id($banner_bg);
                    } else {
                        $banner_image_id = '';
                    }
                    $banner_show = get_post_meta($post->ID, "banner_show", true);
                    $bannershow = ($banner_show === '1') ? "checked" : "";
                    ?>
                    <h1>Banner part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal banner_logo_uploader" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">banner title:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id=""  name="banner_title" placeholder="Enter title" value="<?php echo $banner_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Banner sub title:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pwd" name="banner_sub_title" placeholder="Enter sub title" value="<?php echo $banner_sub_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Banner Background Image:</label>
                                <div class="col-md-10">
                                    <div class="overlay_hover"> <img src="<?php echo $banner_bg; ?>" id="banner_img" height="200" width="200"> <span class="overlay" data-update-field='banner_bg' id="<?php echo $banner_image_id; ?>" data-post-id="<?php echo $post->ID; ?>">-</span> </div>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Banner background:</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="banner_file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Want to hide?Check the checkbox.</label>
                                <br>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="banner_show" <?php echo $bannershow; ?> value="1">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="banner_submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start Why Choose us  Part
                     * ############## 
                     */
                    $why_title = get_post_meta($post->ID, "why_title", true);
                    $why_points = get_post_meta($post->ID, "why_points", true);
                    $why_bg = get_post_meta($post->ID, "why_bg", true);
                    if ($why_bg != '') {
                        $why_image_id = naieem_get_image_id($why_bg);
                    } else {
                        $why_image_id = '';
                    }
                    $why_show = get_post_meta($post->ID, "why_show", true);
                    $whyshow = ($why_show === '1') ? "checked" : "";
                    ?>
                    <h1>Why choose us part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal why_part_editor" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">why title:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id=""  name="why_title" placeholder="Enter title" value="<?php echo $why_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">why points:</label>
                                <div class="col-sm-10 why_points">
                                    <?php
                                    if (is_array($why_points)) {
                                        if (count($why_points) > 0) {
                                            foreach ($why_points as $p) {
                                                ob_start();
                                                ?>
                                                <input type="text" class="form-control" id=""  name="why_points[]" placeholder="Enter title" value="<?php echo $p; ?>">
                                                <span class="remove_why btn btn-default">remove</span>
                                                <?php
                                                echo ob_get_clean();
                                            }
                                        }
                                    } else {
                                        echo ' <input type="text" class="form-control" id=""  name="why_points[]" placeholder="Enter title" value=""><span class="remove_why btn btn-default">remove</span>';
                                    }
                                    ?>
                                </div>
                                <center>
                                    <a href="#" class="add_why btn btn-default">Add</a>
                                </center>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Why Image:</label>
                                <br>
                                <div class="col-sm-10">
                                    <div class="why_img overlay_hover"> <img src="<?php echo $why_bg; ?>" height="200" width="200"> <span class="overlay" data-update-field='why_bg' id="<?php echo $why_image_id; ?>" data-post-id="<?php echo $post->ID; ?>">-</span> </div>
                                    <br>
                                    <input type="file" class="form-control" name="why_file">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Want to hide?Check the checkbox.</label>
                                <br>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="why_show" <?php echo $whyshow; ?> value="1">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start Our Department Part
                     * ############## 
                     */
                    $department_title = get_post_meta($post->ID, "dept_title", true);
                    $dept_single = get_post_meta($post->ID, "dept_single", true);
                    $department_bg = get_post_meta($post->ID, "dept_bg", true);
                    if ($department_bg != '') {
                        $department_image_id = naieem_get_image_id($department_bg);
                    } else {
                        $department_image_id = '';
                    }
                    $dept_icons = get_post_meta($post->ID, "dept_icons", true);
                    $icon_list = '';
                    if (is_array($dept_icons)) {
                        if (count($dept_icons) > 0) {
                            foreach ($dept_icons as $d_icons) {
                                $icon_name = get_image_name($d_icons);
                                $icon_list.="<option value='" . $d_icons . "'>" . $icon_name . "</option>";
                            }
                        }
                    }
                    $dept_show = get_post_meta($post->ID, "dept_show", true);
                    $deptshow = ($dept_show === '1') ? "checked" : "";
                    ?>
                    <h1>Department us part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal department_part_editor" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">department title:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id=""  name="dept_title" placeholder="Enter title" value="<?php echo $department_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Single Department:</label>
                                <div class="col-sm-10 why_points">
                                    <?php
                                    $dept_c = 0;
                                    echo '<ul id="dept_single">';
                                    if (is_array($dept_single)) {
                                        if (count($dept_single) > 0) {

                                            foreach ($dept_single as $depts) {
                                                echo '<li><hr><label class="control-label">Title:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' . $dept_c . '][title]" value="' . $depts['title'] . '"/>';
                                                echo '<label class="control-label">SubTitle:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' . $dept_c . '][subtitle]" value="' . $depts['subtitle'] . '"/>';
                                                echo "<br><label class='control-label'>Image:</label><select class='form-control' name='dept_single[" . $dept_c . "][img]'>";
                                                if (is_array($dept_icons)) {
                                                    if (count($dept_icons) > 0) {

                                                        foreach ($dept_icons as $d_icons) {
                                                            $icon_name = get_image_name($d_icons);
                                                            if ($d_icons == $depts['img']) {
                                                                $select = "selected='selected'";
                                                            } else {
                                                                $select = "";
                                                            }
                                                            echo "<option value='" . $d_icons . "' " . $select . ">" . $icon_name . "</option>";
                                                        }
                                                    }
                                                }
                                                echo "</select>";
                                                //echo '<label>Image:</label><input type="text" style="width:100%;" name="dept_single[' . $dept_c . '][img]" value="' . $depts['img'] . '"/>';
                                                echo "<br><span class='remove_dept btn btn-default'>Remove</span><hr></li>";
                                                $dept_c = $dept_c + 1;
                                            }
                                        }
                                    } else {
                                        echo '<li><hr><label class="control-label">Title:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' . $dept_c . '][title]" value=""/>';
                                        echo '<label class="control-label">SubTitle:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' . $dept_c . '][subtitle]" value=""/>';
                                        echo "<br><label class='control-label'>Image:</label><select class='form-control' name='dept_single[" . $dept_c . "][img]'>";
                                        if (is_array($dept_icons)) {
                                            if (count($dept_icons) > 0) {

                                                foreach ($dept_icons as $d_icons) {
                                                    $icon_name = get_image_name($d_icons);
                                                    echo "<option value='" . $d_icons . "'>" . $icon_name . "</option>";
                                                }
                                            }
                                        }
                                        echo "</select>";
                                        echo "<br><span class='remove_dept btn btn-default'>Remove</span><hr></li>";
                                        $dept_c = $dept_c + 1;
                                    }
                                    echo "</ul>";
                                    ?>
                                </div>
                                <center>
                                    <a href="#" class="add_dept btn btn-default">Add</a>
                                </center>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Department Background Image:</label>
                                <br>
                                <div class="col-sm-10">
                                    <div class="dept_img overlay_hover"> <img src="<?php echo $department_bg; ?>"  class="dept_bg_image"height="200" width="200"> <span class="overlay" data-update-field='dept_bg' id="<?php echo $department_image_id; ?>" data-post-id="<?php echo $post->ID; ?>">-</span> </div>
                                    <br>
                                    <input type="file" class="form-control" name="department_file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Want to hide?Check the checkbox.</label>
                                <br>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="dept_show" <?php echo $deptshow; ?> value="1">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="department_submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!--
                                            Icon uploading form goes here
                        -->
                        <form action="" method="post" enctype="multipart/form-data" class="icons_form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Icon list:</label>
                                <br>
                                <div class="col-sm-10">
                                    <div class="icon_container">
                                        <?php
                                        if (is_array($dept_icons)) {
                                            if (count($dept_icons) > 0) {
                                                foreach ($dept_icons as $p) {
                                                    ob_start();
                                                    ?>
                                                    <div style="width:200px;float: left;overflow: hidden;">
                                                        <input type="hidden" name="dept_icons[]" value="<?php echo $p; ?>">
                                                        <img src="<?php echo $p; ?>" height="120" width="120"><span><br>
                                                            name:<?php echo get_image_name($p); ?></span><br>
                                                        <span class="remove_icon btn btn-default" style="margin-right:20px;">remove</span> </div>
                                                    <?php
                                                    echo ob_get_clean();
                                                }
                                            }
                                        } else {
                                            echo '<img src="" height="120" width="120">';
                                        }
                                        ?>
                                    </div>
                                    <br>
                                    <input type="file" class="form-control" name="department_icon">
                                    <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                                    <button type="submit" class="btn btn-default">Save Icon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start founder Part
                     * ############## 
                     */
                    $founder_title = get_post_meta($post->ID, "founder_title", true);
                    $founder_name = get_post_meta($post->ID, "founder_name", true);
                    $founder_desc = get_post_meta($post->ID, "founder_desc", true);
                    $founder_img = get_post_meta($post->ID, "founder_img", true);
                    if ($founder_img != '') {
                        $founder_image_id = naieem_get_image_id($founder_img);
                    } else {
                        $founder_image_id = '';
                    }
                    $founder_show = get_post_meta($post->ID, "founder_show", true);
                    $foundershow = ($founder_show === '1') ? "checked" : "";
                    ?>
                    <h1>Founder part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal founder_update" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Founder title:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id=""  name="founder_title" placeholder="Enter title" value="<?php echo $founder_title; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Founder Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pwd" name="founder_name" placeholder="Enter founder name" value="<?php echo $founder_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Founder Description:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="pwd" name="founder_desc"><?php echo $founder_desc; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Founder Image:</label>
                                <div class="col-md-10">
                                    <div class="why_img overlay_hover"> <img src="<?php echo $founder_img; ?>" class="founder_img" height="200" width="200"> <span class="overlay" data-update-field='founder_img' id="<?php echo $founder_image_id; ?>" data-post-id="<?php echo $post->ID; ?>">-</span> </div>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Founder image Upload:</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="founder_img">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Want to hide?Check the checkbox.</label>
                                <br>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="founder_show" <?php echo $foundershow; ?> value="1">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update_founder" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start Menu Part
                     * ############## 
                     */
                    $menu = get_post_meta($post->ID, "menu", true);
                    ?>
                    <h1>Menu part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal menu_update" action="" method="POST"enctype="multipart/form-data">
                            <?php
                            echo '<ul id="menu_items">';
                            $menu_c = 0;
                            //var_dump($data);
                            //echo $data[0]['a'];
                            if (is_array($menu)) {
                                if (count($menu) > 0) {
                                    foreach ($menu as $p) {
                                        //echo $value;
                                        echo '<li><hr><label class="control-label">Title:</label><input class="form-control" type="text" style="width:100%;" name="menu[' . $menu_c . '][title]" size="10" value="' . $p['title'] . '"/>';
                                        echo '<label class="control-label">Link:</label><input class="form-control" type="text" style="width:100%;" name="menu[' . $menu_c . '][link]" size="10" value="' . $p['link'] . '"/><span class="remove_menu btn btn-default">Remove</span><hr></li>';
                                        $menu_c = $menu_c + 1;
                                    }
                                }
                            } else {
                                echo '<li><hr><label class="control-label">Title:</label><input class="form-control" type="text" style="width:100%;" name="menu[' . $menu_c . '][title]" size="10" value=""/>';
                                echo '<label class="control-label">Link:</label><input type="text" class="form-control" style="width:100%;" name="menu[' . $menu_c . '][link]" size="10" value=""/><span class="remove_menu btn btn-default">Remove</span><hr></li>';
                            }
                            echo '</ul>';
                            ?>
                            <span class="add_menu btn btn-default"><?php echo __('Add Menu'); ?></span>
                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="update_menu" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    /*
                     * ##############
                     * Start Footer Part
                     * ############## 
                     */
                    $about_text = get_post_meta($post->ID, "about_text", true);
                    $footer_text = get_post_meta($post->ID, "footer_text", true);
                    ?>
                    <h1>Footer part</h1>
                    <div class="slide_container">
                        <form class="form-horizontal footer_update" action="" method="POST"enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">About Text:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id=""  name="about_text" placeholder="Enter title" value="<?php echo $about_text; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Footer Text:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pwd" name="footer_text" placeholder="Enter sub title" value="<?php echo $footer_text; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $post->ID; ?>">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                /* ##########
                 * Front end editing part end
                 * ############
                 */
                ?>
                <?php
                /* ##########
                 * Front end showing part start
                 * ############
                 */
                global $post;
                $logo = get_post_meta($post->ID, "logo_img", true);
                $menu = get_post_meta($post->ID, "menu", true);
                $banner_title = get_post_meta($post->ID, "banner_title", true);
                $banner_sub_title = get_post_meta($post->ID, "banner_sub_title", true);
                $banner_bg = get_post_meta($post->ID, "banner_bg", true);
                $why_title = get_post_meta($post->ID, "why_title", true);
                $why_points = get_post_meta($post->ID, "why_points", true);
                $why_bg = get_post_meta($post->ID, "why_bg", true);
                $dept_title = get_post_meta($post->ID, "dept_title", true);
                $dept_bg = get_post_meta($post->ID, "dept_bg", true);
                $dept_single = get_post_meta($post->ID, "dept_single", true);
                $dept_icons = get_post_meta($post->ID, "dept_icons", true);
                $founder_title = get_post_meta($post->ID, "founder_title", true);
                $founder_name = get_post_meta($post->ID, "founder_name", true);
                $founder_desc = get_post_meta($post->ID, "founder_desc", true);
                $founder_img = get_post_meta($post->ID, "founder_img", true);
                $about_text = get_post_meta($post->ID, "about_text", true);
                $footer_text = get_post_meta($post->ID, "footer_text", true); 
                
                /* ###########
                 * Show/Hide logic goes here
                 * ##########
                 */
                
                $banner_show = get_post_meta($post->ID, "banner_show", true);
                $why_show = get_post_meta($post->ID, "why_show", true);
                $dept_show = get_post_meta($post->ID, "dept_show", true);
                $founder_show = get_post_meta($post->ID, "founder_show", true);
                
                $banner_style= ($banner_show === '1') ? "display:none;" : "";
                $why_style= ($why_show === '1') ? "display:none;" : "";
                $dept_style= ($dept_show === '1') ? "display:none;" : "";
                $founder_style= ($founder_show === '1') ? "display:none;" : "";
                
                /* ###########
                 * Show/Hide logic ends here
                 * ##########
                 */
                ?>
                <div class="landingpage"> 
                    <!-- Header text -->
                    <div class="header_txt">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p class="hdtst"><a href="<?php echo wp_logout_url(); ?>">Logout</a>&nbsp;&nbsp;&nbsp;<a class="edit" href="#">Edit</a> Welcome to <span>Medical click !</span></p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Header text --> 

                    <!-- Menu area -->
                    <div class="menu_area">
                        <div class="container">
                            <div class="row">
                                <nav class="navbar">
                                    <div class="container-fluid">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle mnav" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                            <a class="navbar-brand logom" href="#"> <img src="<?php echo $logo; ?>" alt="Logo"> </a> </div>
                                        <div class="collapse navbar-collapse" id="myNavbar">
                                            <ul class="nav navbar-nav navbar-right mainvav">
                                                <?php
                                                if (is_array($menu)) {
                                                    if (count($menu) > 0) {
                                                        foreach ($menu as $p) {
                                                            echo '<li><a href="' . $p['link'] . '">' . $p['title'] . '</a></li>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Menu area --> 

                    <!-- Slider/Banner area -->
                    <div class="slider_area" style="background: rgba(0, 0, 0, 0) url('<?php echo $banner_bg; ?>') repeat scroll 0 0 / cover;<?php echo $banner_style;?>">
                        <h1><?php echo $banner_title; ?></h1>
                        <p><?php echo $banner_sub_title; ?></p>
                    </div>
                    <!-- Slider/Banner area --> 

                    <!-- Tab area -->
                    <div class="tab_area">
                        <div class="container">
                            <div class="row">
                                <div class="mtabarea">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#home">Make an Appointment</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Call Us Today</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            <div class="tabfrm">
                                                <form action="index.html">
                                                    <ul class="selctst">
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Full Name">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Phone Number">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Email">
                                                        </li>
                                                        <li>
                                                            <select class="selopt">
                                                                <option>Select Department</option>
                                                                <option>Department</option>
                                                                <option>Department</option>
                                                                <option>Department</option>
                                                            </select>
                                                        </li>
                                                    </ul>
                                                    <ul class="selctst2">
                                                        <li>
                                                            <input type="text" class="fild" placeholder="26 - 07 - 2016">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="firl" placeholder="Message">
                                                        </li>
                                                        <li>
                                                            <input type="submit" class="bokbtn" value="Book Now">
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                            <div class="tabfrm">
                                                <form action="index.html">
                                                    <ul class="selctst">
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Full Name">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Phone Number">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="fild" placeholder="Email">
                                                        </li>
                                                        <li>
                                                            <select class="selopt">
                                                                <option>Select Department</option>
                                                                <option>Department</option>
                                                                <option>Department</option>
                                                                <option>Department</option>
                                                            </select>
                                                        </li>
                                                    </ul>
                                                    <ul class="selctst2">
                                                        <li>
                                                            <input type="text" class="fild" placeholder="26 - 07 - 2016">
                                                        </li>
                                                        <li>
                                                            <input type="text" class="firl" placeholder="Message">
                                                        </li>
                                                        <li>
                                                            <input type="submit" class="bokbtn" value="Book Now">
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab area --> 

                    <!-- Why Choose -->
                    <div class="whychoose" style="<?php echo $why_style;?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="whyc">
                                        <h1 class="bord">Why <span>Choose</span> Us?</h1>
                                        <p><?php echo $why_title ?></p>
                                        <ul>
                                            <?php
                                            if (is_array($why_points)) {
                                                if (count($why_points) > 0) {
                                                    foreach ($why_points as $p) {
                                                        echo '<li><i class="fa fa-check-circle" aria-hidden="true"></i> <span>' . $p . '</span></li>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="donimg"> <img src="<?php echo $why_bg; ?>" alt="Doctor"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Why Choose --> 

                    <!-- Our Department -->
                    <div class="ourdept" style="background: url(<?php echo $dept_bg; ?>);background-size: cover;<?php echo $dept_style;?>">
                        <div class="container">
                            <div class="row">
                                <div class="deptt">
                                    <h1 class="bord">Our <span>Departments</span></h1>
                                    <p><?php echo $dept_title; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="icon">
                                    <?php
                                    if (is_array($dept_single)) {
                                        if (count($dept_single) > 0) {
                                            foreach ($dept_single as $depts) {
                                                ob_start();
                                                ?>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="sicon"> <img src="<?php echo $depts['img']; ?>" alt="icon">
                                                        <h2><?php echo $depts['title']; ?></h2>
                                                        <p><?php echo $depts['subtitle']; ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                                echo ob_get_clean();
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Our Department --> 

                    <!-- Our founder -->
                    <div class="ourfounder" style="<?php echo $founder_style;?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fondr"> <img src="<?php echo $founder_img; ?>" alt="doctr"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fond">
                                        <h1 class="bord">Our <span>founder</span></h1>
                                        <p class="fontit"><?php echo $founder_title; ?></p>
                                        <h2><?php echo $founder_name; ?></h2>
                                        <p class="fontit2"><?php echo $founder_desc; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Our founder --> 

                    <!-- Testimonial area -->
                    <div class="testimonial">
                        <div class="col-md-6 testi">
                            <div id="testim" class="owl-carousel">
                                <div class="stestim">
                                    <div class="mtdiv">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                    <div class="timg">
                                        <div class="imgr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/testi.png" alt="texti"> </div>
                                        <h3>Paul Simon</h3>
                                    </div>
                                </div>
                                <div class="stestim">
                                    <div class="mtdiv">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                    <div class="timg">
                                        <div class="imgr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/testi.png" alt="texti"> </div>
                                        <h3>Paul Simon</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 doctr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/doc3.png" alt="doc"> </div>
                    </div>
                    <!-- Testimonial area --> 

                    <!-- Blog part -->
                    <div class="blog_embeb">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="letsn">Latest News</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                        <div class="btxt">
                                            <h4>Lorem Ipsum is simply dummy text of the</h4>
                                            <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                            <a href="#">Read More</a> </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                        <div class="btxt">
                                            <h4>Lorem Ipsum is simply dummy text of the</h4>
                                            <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                            <a href="#">Read More</a> </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                        <div class="btxt">
                                            <h4>Lorem Ipsum is simply dummy text of the</h4>
                                            <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                            <a href="#">Read More</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Blog part --> 

                    <!-- Map area -->
                    <div class="maparea">
                        <div class="container">
                            <div class="mapi">
                                <h1>Would you like to find us</h1>
                                <a href="#">Goaogle Map</a> </div>
                        </div>
                    </div>
                    <!-- Map area --> 

                    <!-- News letter -->
                    <div class="newsletter">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="news">
                                        <h1><span>Sign up for our newsletter</span></h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore liqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris Ut enim ad minim veniam, quis nostrud</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="nfrm">
                                        <ul>
                                            <li>
                                                <input type="text" class="emal" placeholder="Email">
                                            </li>
                                            <li>
                                                <input type="submit" class="sbt" value="SIGN UP">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News letter --> 

                    <!-- Footer top area -->
                    <div class="footer_top">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="footermenu">
                                        <?php
                                        if (is_array($menu)) {
                                            if (count($menu) > 0) {
                                                foreach ($menu as $p) {
                                                    echo '<li><a href="' . $p['link'] . '">' . $p['title'] . '</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row footerabout">
                                <div class="col-md-8">
                                    <div class="aboutfo">
                                        <h4>About Us</h4>
                                        <img src="<?php echo $logo; ?>" alt="Footer logo">
                                        <p><?php echo $about_text; ?></p>
                                    </div>
                                    <div class="findlink">
                                        <div class="findlt">
                                            <h4>Find Us</h4>
                                            <ul class="socialfind">
                                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="linkrt">
                                            <h4>Find Us</h4>
                                            <ul>
                                                <li><a href="#">Healthcare</a></li>
                                                <li><a href="#">Caregiver Resources</a></li>
                                                <li><a href="#">Vancouver Island Resource Map</a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="#">About Community of Care</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="twitter">
                                        <h4>Twitter Widget</h4>
                                        <div class="allwidget">
                                            <div class="singltwit">
                                                <div class="twitw"> <i class="fa fa-twitter"></i> </div>
                                                <div class="twitwt">
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malenec eu libero sit ametus et netus et mal</p>
                                                    <h5>20 hours ago</h5>
                                                </div>
                                            </div>
                                            <div class="singltwit">
                                                <div class="twitw"> <i class="fa fa-twitter"></i> </div>
                                                <div class="twitwt">
                                                    <p>Pellentesque habitant morbi tristique senectus et netus et malenec eu libero sit ametus et netus et mal</p>
                                                    <h5>20 hours ago</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer top area --> 

                    <!-- Footer bottomm -->
                    <div class="footer_bottom">
                        <div class="container">
                            <p><?php echo $footer_text; ?></a> </p>
                        </div>
                    </div>
                    <!-- Footer bottomm --> 

                </div>
                <?php
                /* ##########
                 * Front end showing part end
                 * ############
                 */
                echo ob_get_clean();
            }
        } else {
            ob_start();
            global $post;
            $logo = get_post_meta($post->ID, "logo_img", true);
            $menu = get_post_meta($post->ID, "menu", true);
            $banner_title = get_post_meta($post->ID, "banner_title", true);
            $banner_sub_title = get_post_meta($post->ID, "banner_sub_title", true);
            $banner_bg = get_post_meta($post->ID, "banner_bg", true);
            $why_title = get_post_meta($post->ID, "why_title", true);
            $why_points = get_post_meta($post->ID, "why_points", true);
            $why_bg = get_post_meta($post->ID, "why_bg", true);
            $dept_title = get_post_meta($post->ID, "dept_title", true);
            $dept_bg = get_post_meta($post->ID, "dept_bg", true);
            $dept_single = get_post_meta($post->ID, "dept_single", true);
            $dept_icons = get_post_meta($post->ID, "dept_icons", true);
            $founder_title = get_post_meta($post->ID, "founder_title", true);
            $founder_name = get_post_meta($post->ID, "founder_name", true);
            $founder_desc = get_post_meta($post->ID, "founder_desc", true);
            $founder_img = get_post_meta($post->ID, "founder_img", true);
            $about_text = get_post_meta($post->ID, "about_text", true);
            $footer_text = get_post_meta($post->ID, "footer_text", true);
            ?>
            <div class="landingpage"> 
                <!-- Header text -->
                <div class="header_txt">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p class="hdtst">Welcome to <span>Medical click !</span></p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header text --> 

                <!-- Menu area -->
                <div class="menu_area">
                    <div class="container">
                        <div class="row">
                            <nav class="navbar">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle mnav" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                        <a class="navbar-brand logom" href="#"> <img src="<?php echo $logo; ?>" alt="Logo"> </a> </div>
                                    <div class="collapse navbar-collapse" id="myNavbar">
                                        <ul class="nav navbar-nav navbar-right mainvav">
                                            <?php
                                            if (is_array($menu)) {
                                                if (count($menu) > 0) {
                                                    foreach ($menu as $p) {
                                                        echo '<li><a href="' . $p['link'] . '">' . $p['title'] . '</a></li>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Menu area --> 

                <!-- Slider area -->
                <div class="slider_area" style="background: rgba(0, 0, 0, 0) url('<?php echo $banner_bg; ?>') repeat scroll 0 0 / cover;">
                    <h1><?php echo $banner_title; ?></h1>
                    <p><?php echo $banner_sub_title; ?></p>
                </div>
                <!-- Slider area --> 

                <!-- Tab area -->
                <div class="tab_area">
                    <div class="container">
                        <div class="row">
                            <div class="mtabarea">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Make an Appointment</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Call Us Today</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <div class="tabfrm">
                                            <form action="index.html">
                                                <ul class="selctst">
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Full Name">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Phone Number">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Email">
                                                    </li>
                                                    <li>
                                                        <select class="selopt">
                                                            <option>Select Department</option>
                                                            <option>Department</option>
                                                            <option>Department</option>
                                                            <option>Department</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                                <ul class="selctst2">
                                                    <li>
                                                        <input type="text" class="fild" placeholder="26 - 07 - 2016">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="firl" placeholder="Message">
                                                    </li>
                                                    <li>
                                                        <input type="submit" class="bokbtn" value="Book Now">
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div class="tabfrm">
                                            <form action="index.html">
                                                <ul class="selctst">
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Full Name">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Phone Number">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="fild" placeholder="Email">
                                                    </li>
                                                    <li>
                                                        <select class="selopt">
                                                            <option>Select Department</option>
                                                            <option>Department</option>
                                                            <option>Department</option>
                                                            <option>Department</option>
                                                        </select>
                                                    </li>
                                                </ul>
                                                <ul class="selctst2">
                                                    <li>
                                                        <input type="text" class="fild" placeholder="26 - 07 - 2016">
                                                    </li>
                                                    <li>
                                                        <input type="text" class="firl" placeholder="Message">
                                                    </li>
                                                    <li>
                                                        <input type="submit" class="bokbtn" value="Book Now">
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab area --> 

                <!-- Why Choose -->
                <div class="whychoose">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="whyc">
                                    <h1 class="bord">Why <span>Choose</span> Us?</h1>
                                    <p><?php echo $why_title ?></p>
                                    <ul>
                                        <?php
                                        if (is_array($why_points)) {
                                            if (count($why_points) > 0) {
                                                foreach ($why_points as $p) {
                                                    echo '<li><i class="fa fa-check-circle" aria-hidden="true"></i> <span>' . $p . '</span></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="donimg"> <img src="<?php echo $why_bg; ?>" alt="Doctor"> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Why Choose --> 

                <!-- Our Department -->
                <div class="ourdept" style="background: url(<?php echo $dept_bg; ?>);background-size: cover;">
                    <div class="container">
                        <div class="row">
                            <div class="deptt">
                                <h1 class="bord">Our <span>Departments</span></h1>
                                <p><?php echo $dept_title; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="icon">
                                <?php
                                if (is_array($dept_single)) {
                                    if (count($dept_single) > 0) {
                                        foreach ($dept_single as $depts) {
                                            ob_start();
                                            ?>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="sicon"> <img src="<?php echo $depts['img']; ?>" alt="icon">
                                                    <h2><?php echo $depts['title']; ?></h2>
                                                    <p><?php echo $depts['subtitle']; ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            echo ob_get_clean();
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our Department --> 

                <!-- Our founder -->
                <div class="ourfounder">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fondr"> <img src="<?php echo $founder_img; ?>" alt="doctr"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fond">
                                    <h1 class="bord">Our <span>founder</span></h1>
                                    <p class="fontit"><?php echo $founder_title; ?></p>
                                    <h2><?php echo $founder_name; ?></h2>
                                    <p class="fontit2"><?php echo $founder_desc; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our founder --> 

                <!-- Testimonial area -->
                <div class="testimonial">
                    <div class="col-md-6 testi">
                        <div id="testim" class="owl-carousel">
                            <div class="stestim">
                                <div class="mtdiv">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                <div class="timg">
                                    <div class="imgr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/testi.png" alt="texti"> </div>
                                    <h3>Paul Simon</h3>
                                </div>
                            </div>
                            <div class="stestim">
                                <div class="mtdiv">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                <div class="timg">
                                    <div class="imgr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/testi.png" alt="texti"> </div>
                                    <h3>Paul Simon</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 doctr"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/doc3.png" alt="doc"> </div>
                </div>
                <!-- Testimonial area --> 

                <!-- Blog part -->
                <div class="blog_embeb">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="letsn">Latest News</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                    <div class="btxt">
                                        <h4>Lorem Ipsum is simply dummy text of the</h4>
                                        <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                        <a href="#">Read More</a> </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                    <div class="btxt">
                                        <h4>Lorem Ipsum is simply dummy text of the</h4>
                                        <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                        <a href="#">Read More</a> </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sblog"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/images/bloh.png" alt="Blog">
                                    <div class="btxt">
                                        <h4>Lorem Ipsum is simply dummy text of the</h4>
                                        <p>Quisque vitae interdum ipsum. Nulla eget mper nulla. Proin lacinia urna quis tortorQuisque vitae interdum ipsum.</p>
                                        <a href="#">Read More</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog part --> 

                <!-- Map area -->
                <div class="maparea">
                    <div class="container">
                        <div class="mapi">
                            <h1>Would you like to find us</h1>
                            <a href="#">Goaogle Map</a> </div>
                    </div>
                </div>
                <!-- Map area --> 

                <!-- News letter -->
                <div class="newsletter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="news">
                                    <h1><span>Sign up for our newsletter</span></h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore liqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris Ut enim ad minim veniam, quis nostrud</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="nfrm">
                                    <ul>
                                        <li>
                                            <input type="text" class="emal" placeholder="Email">
                                        </li>
                                        <li>
                                            <input type="submit" class="sbt" value="SIGN UP">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- News letter --> 

                <!-- Footer top area -->
                <div class="footer_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="footermenu">
                                    <?php
                                    if (is_array($menu)) {
                                        if (count($menu) > 0) {
                                            foreach ($menu as $p) {
                                                echo '<li><a href="' . $p['link'] . '">' . $p['title'] . '</a></li>';
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row footerabout">
                            <div class="col-md-8">
                                <div class="aboutfo">
                                    <h4>About Us</h4>
                                    <img src="<?php echo $logo; ?>" alt="Footer logo">
                                    <p><?php echo $about_text; ?></p>
                                </div>
                                <div class="findlink">
                                    <div class="findlt">
                                        <h4>Find Us</h4>
                                        <ul class="socialfind">
                                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="linkrt">
                                        <h4>Find Us</h4>
                                        <ul>
                                            <li><a href="#">Healthcare</a></li>
                                            <li><a href="#">Caregiver Resources</a></li>
                                            <li><a href="#">Vancouver Island Resource Map</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#">About Community of Care</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="twitter">
                                    <h4>Twitter Widget</h4>
                                    <div class="allwidget">
                                        <div class="singltwit">
                                            <div class="twitw"> <i class="fa fa-twitter"></i> </div>
                                            <div class="twitwt">
                                                <p>Pellentesque habitant morbi tristique senectus et netus et malenec eu libero sit ametus et netus et mal</p>
                                                <h5>20 hours ago</h5>
                                            </div>
                                        </div>
                                        <div class="singltwit">
                                            <div class="twitw"> <i class="fa fa-twitter"></i> </div>
                                            <div class="twitwt">
                                                <p>Pellentesque habitant morbi tristique senectus et netus et malenec eu libero sit ametus et netus et mal</p>
                                                <h5>20 hours ago</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer top area --> 

                <!-- Footer bottomm -->
                <div class="footer_bottom">
                    <div class="container">
                        <p><?php echo $footer_text; ?></a> </p>
                    </div>
                </div>
                <!-- Footer bottomm --> 

            </div>
            <?php
            echo ob_get_clean();
        }
        ?>
        <script id="icon-template" type="text/x-handlebars-template">
            {{#each image}}
            <div style="width:200px;float: left;overflow: hidden;">
            <input type="hidden" name="dept_icons[]" value="{{this.url}}">
            <img src="{{this.url}}" height="120" width="120"><br>name:{{this.name}}</span><br>
            <span class="remove_icon btn btn-default" style="margin-right:20px;">remove</span>
            </div>
            {{/each}}
        </script> 

        <!-- jQuery--> 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/js/jquery_v1.11.3.js"></script> 
        <!-- Bootstrap --> 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/js/bootstrap.min.js"></script> 
        <!-- Owl carousel --> 
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/custom_theme/js/owl.carousel.min.js"></script> 
        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script> 
        <script>
            jQuery(document).ready(function () {
                var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                /* ##########
                 * Handle bar js code goes here 
                 * ##########
                 */
                var iconhtml = $("#icon-template").html();
                // Compile the template
                var icon_template = Handlebars.compile(iconhtml);
                /* ##########
                 * Handle bar js code ends  here 
                 * ##########
                 * */
                jQuery(".loggedout_doc h1").click(function () {
                    jQuery(this).next('.slide_container').slideToggle("fast");
                });
                jQuery('#testim').owlCarousel({
                    loop: true,
                    margin: 10,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        600: {
                            items: 1,
                            nav: true
                        },
                        1000: {
                            items: 1,
                            nav: true,
                            loop: false
                        }
                    }
                });

                /* ##########
                 * Logo upload
                 * ##########
                 * */
                jQuery('.profile_logo_uploader').on('submit', function (e) {
                    e.preventDefault();
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'upload_logo');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.image_upload == true) {
                                jQuery(".logo_img").attr('src', response.image_url);
                                jQuery(".logo_img").next(".overlay").attr("id", response.image_id);
                                jQuery("input[type='file']").val("");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                /* ##########
                 * Banner upload 
                 * ##########
                 * */
                jQuery('.banner_logo_uploader').on('submit', function (e) {
                    e.preventDefault();
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'banner_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.image_upload == true) {
                                jQuery("#banner_img").attr('src', response.image_url);
                                jQuery("#banner_img").next(".overlay").attr("id", response.image_id);
                                jQuery("input[type='file']").val("");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                /* ##########
                 * Why choose us updating part
                 * ##########
                 * */
                jQuery('.why_part_editor').on('submit', function (e) {
                    e.preventDefault();
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'why_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.image_upload == true) {
                                jQuery(".why_img").find("img").attr("src", response.image_url);
                                jQuery(".why_img").find(".overlay").attr("id", response.image_id);
                                jQuery("input[type='file']").val("");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });
                jQuery(".add_why").click(function (e) {
                    e.preventDefault();
                    jQuery(".why_points").append('<input type="text" class="form-control" id=""  name="why_points[]" placeholder="Enter title"><span class="remove_why btn btn-default">remove</span>');
                });
                jQuery(document).on('click', '.remove_why', function (e) {
                    e.preventDefault();
                    jQuery(this).prev("input").remove();
                    jQuery(this).remove();
                });

                /* ##########
                 * Attachment delete by click and update part
                 * ##########
                 * */
                jQuery(".overlay").click(function (e) {
                    e.preventDefault();
                    var obj = jQuery(this);
                    var attachment_id = jQuery(this).attr('id');
                    var post_id = jQuery(this).attr('data-post-id');
                    var field = jQuery(this).attr('data-update-field');
                    //alert(ajaxurl);
                    var dataf = new FormData();
                    dataf.append('action', 'delete_attachement');
                    dataf.append('id', attachment_id);
                    dataf.append('post_id', post_id);
                    dataf.append('field', field);
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.result === true) {
                                obj.prev("img").attr("src", "");
                                obj.attr("id", "");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                /* ##########
                 * Department update part
                 * ##########
                 * */
                jQuery('.department_part_editor').on('submit', function (e) {
                    e.preventDefault();
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'department_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.image_upload == true) {
                                jQuery(".dept_bg_image").attr('src', response.image_url);
                                jQuery(".dept_bg_image").next(".overlay").attr("id", response.image_id);
                                jQuery("input[type='file']").val("");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                var dept_c =<?php echo $dept_c; ?>;
                $(".add_dept").click(function (e) {
                    e.preventDefault();
                    var list = "<?php echo $icon_list; ?>";
                    $("#dept_single").append('<li><hr><label class="control-label">Title:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' + dept_c + '][title]" value=""/>' +
                            '<label class="control-label">SubTitle:</label><input class="form-control" type="text" style="width:100%;" name="dept_single[' + dept_c + '][subtitle]" value=""/>' +
                            '<br><label class="control-label">Image:</label><select class="form-control" name="dept_single[' + dept_c + '][img]">' + list +
                            '<select><br>' +
                            '<span class="remove_dept btn btn-default">Remove</span>' +
                            '<hr></li>');
                    dept_c = dept_c + 1;
                });
                jQuery(document).on('click', '.remove_dept', function (e) {
                    e.preventDefault();
                    $(this).parent().remove();
                });

                /* Department er icon list handler */
                jQuery('.icons_form').on('submit', function (e) {
                    e.preventDefault();
                    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'icon_upload');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);

                            // Define our data object
                            var context = {
                                "image": response,
                            };
                            // Pass our data to the template
                            var result = icon_template(context);
                            // Add the compiled html to the page
                            $('.icon_container').html(result);
                            alertify.success('Saved Changes');
                            location.reload();
                        }
                    });
                });
                jQuery(document).on('click', '.remove_icon', function (e) {
                    e.preventDefault();
                    $(this).parent().remove();
                    //$(this).remove();
                });

                /*
                 *##################
                 *Founder part update
                 *##################
                 **/
                jQuery('.founder_update').on('submit', function (e) {
                    e.preventDefault();
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'founder_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (response.image_upload == true) {
                                jQuery(".founder_img").attr('src', response.image_url);
                                jQuery(".founder_img").next(".overlay").attr("id", response.image_id);
                                jQuery("input[type='file']").val("");
                            }
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                /*
                 *##################
                 *Menu part update
                 *##################
                 **/
                var c =<?php echo $menu_c; ?>;
                jQuery('.menu_update').on('submit', function (e) {
                    e.preventDefault();
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'menu_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                        }
                    });
                });

                jQuery(".add_menu").click(function (e) {
                    e.preventDefault();
                    $("#menu_items").append('<li><hr><label class="control-label">Title:</label><input class="form-control"type="text" style="width:100%;" name="menu[' + c + '][title]" size="10" value=""/>' +
                            '<label class="control-label">Link:</label><input class="form-control" type="text" style="width:100%;" name="menu[' + c + '][link]" size="10" value=""/><span class="remove_menu btn btn-default">Remove</span><hr></li>');
                    c = c + 1;
                });

                jQuery(document).on('click', '.remove_menu', function (e) {
                    e.preventDefault();
                    $(this).parent().remove();
                });

                /*
                 *##################
                 *Footer part update
                 *##################
                 **/
                jQuery('.footer_update').on('submit', function (e) {
                    e.preventDefault();
                    //alert(ajaxurl);
                    var dataf = new FormData(jQuery(this)[0]);
                    dataf.append('action', 'footer_update');
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: dataf,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            alertify.success('Saved Changes');
                            jQuery(".landingpage").html(response.return_value);
                            //alert(response.return_value);
                        }
                    });
                });
                /*
                 *#### edit page
                 */
                jQuery(document).on('click', '.edit', function (e) {
                    e.preventDefault();
                    jQuery(".loggedout_doc").slideToggle("fast");
                });

            });
        </script>
    </body>
</html>