<?php
/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by NTthemes
 */
//class define
class nt_meta_box {

    //construct
    public function __construct() {
        add_action("add_meta_boxes", array($this, 'custom_meta_box'));
        add_action('save_post', array($this, 'save_details'));
    }

    public function custom_meta_box() {
        add_meta_box("price_meta_id", "Price fields :", array($this, 'price_meta'), "page", "normal", "low");
        //add_meta_box("logo_img_meta_id", "Backgimd :", array($this, 'bg_image'), "page", "normal", "low");
        add_meta_box("bg_img_meta_id", "Logo images for the page:", array($this, 'logo_image'), "page", "normal", "low");
        add_meta_box("banner_meta", "Banner part:", array($this, 'banner_part'), "page", "normal", "low");
        add_meta_box("why_meta", "Why choose part:", array($this, 'why_part'), "page", "normal", "low");
        add_meta_box("department_meta", "Department part:", array($this, 'department_part'), "page", "normal", "low");
    }

    /* Why part */

    public function why_part() {
        global $post;
        $why_title = get_post_meta($post->ID, "why_title", true);
        $why_points = get_post_meta($post->ID, "why_points", true);
        $why_bg = get_post_meta($post->ID, "why_bg", true);
        //print_r($why_points);
        echo '<label>Title :</label><input type="text" style="width:100%;" name="why_title" size="10" value="' . $why_title . '"/>';
        echo '<div class="point"><label>Points :</label><br>';
        if (is_array($why_points)) {
            if (count($why_points) > 0) {
                foreach ($why_points as $p) {
                    echo '<input type="text" style="width:80%;" name="why_points[]" value="' . $p . '"/><span class="remove_why button button-primary button-large">Remove</span></li>';
                }
            }
        } else {
            echo '<input type="text" style="width:80%;" name="why_points[]" value=""/><span class="remove_why button button-primary button-large">Remove</span></li>';
        }
        echo "</div>";
        echo '<br><span class="add_why button button-primary button-large">' . __('Add why') . '</span><br>';
        echo '<br><label>Banner Background:</label><input type="text" style="width:100%;" name="why_bg" value="' . $why_bg . '"/>';
        ?>
        <script>
            $ = jQuery.noConflict();
            $(document).ready(function () {
                $(".add_why").click(function (e) {
                    e.preventDefault();
                    $(".point").append('<input type="text" ' +
                            'name="why_points[]" style="width:80%;" value=""/>' +
                            '<span class="remove_why button button-primary button-large">Remove</span>');
                });
                $(".remove_why").live('click', function () {
                    $(this).prev("input").remove();
                    $(this).remove();
                });
            });
        </script>
        <?php
    }

    /* Department part */

    public function department_part() {
        global $post;
        $dept_title = get_post_meta($post->ID, "dept_title", true);
        $dept_bg = get_post_meta($post->ID, "dept_bg", true);
        $dept_single = get_post_meta($post->ID, "dept_single", true);
        $dept_icons = get_post_meta($post->ID, "dept_icons", true);
        /* Single department adding */
        echo '<label>Title :</label><input type="text" style="width:100%;" name="dept_title" size="10" value="' . $dept_title . '"/>';
        echo '<div class="department_container"><br><b>Single Department :</b><br>';
        echo '<ul id="dept_single">';
        $c = 0;
        if (is_array($dept_single)) {
            if (count($dept_single) > 0) {
                foreach ($dept_single as $depts) {
                    //echo $value;
                    echo '<li><hr><label>Title:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][title]" value="' . $depts['title'] . '"/>';
                    echo '<label>SubTitle:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][subtitle]" value="' . $depts['subtitle'] . '"/>';
                    echo '<label>Image:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][img]" value="' . $depts['img'] . '"/>';
                    echo "<span class='remove_dept button button-primary button-large'>Remove</span><hr></li>";
                    $c = $c + 1;
                }
            }
        } else {
            echo '<li><hr><label>Title:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][title]" value="" />';
            echo '<label>SubTitle:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][subtitle]" value="" />';
            echo '<label>Image:</label><input type="text" style="width:100%;" name="dept_single[' . $c . '][img]" value="" />';
            echo "<span class='remove_dept button button-primary button-large'>Remove</span><hr></li>";
            $c = $c + 1;
        }
        echo '</ul>';

        echo "</div>";
        echo '<br><span class="add_dept button button-primary button-large">' . __('Add new Department') . '</span><br>';
        echo '<br><label>Department Background:</label><input type="text" style="width:100%;" name="dept_bg" value="' . $dept_bg . '"/>';
        echo "<br><b>Icon list</b></br>";
        /* Adding new icons in the department */
        echo "<ul class='dept_icon'>";
        if (is_array($dept_icons)) {
            if (count($dept_icons) > 0) {
                foreach ($dept_icons as $icons) {
                    echo '<li><input type="hidden" style="width:100%;" name="dept_icons[]" value="' . $icons . '" />';
                    echo "<img src='".$icons."' height='200' width='200'><br>";
                    echo "<span class='remove_icon button button-primary button-large'>Remove</span></li>";
                }
            }
        } else {
            echo '<li><label>Icons Url:</label><input type="text" style="width:100%;" name="dept_icons[]" value="" /><br>';
            echo "<span class='remove_icon button button-primary button-large'>Remove</span></li>";
        }
        echo "</ul>";

        echo '<br><span class="add_icon button button-primary button-large">' . __('Add new icon') . '</span><br>';
        ?>
        <script>
            $ = jQuery.noConflict();
            $(document).ready(function () {
                /* Addign single department information */
                var c =<?php echo $c; ?>;
                $(".add_dept").click(function (e) {
                    e.preventDefault();
                    $("#dept_single").append('<li><hr><label>Title:</label><input type="text" style="width:100%;" name="dept_single[' + c + '][title]" value=""/>' +
                            '<label>SubTitle:</label><input type="text" style="width:100%;" name="dept_single[' + c + '][subtitle]" value=""/>' +
                            '<label>Image:</label><input type="text" style="width:100%;" name="dept_single[' + c + '][img]" value=""/>' +
                            '<span class="remove_dept button button-primary button-large">Remove</span>' +
                            '<hr></li>');
                    c = c + 1;
                });
                $(".remove_dept").live('click', function () {
                    $(this).parent().remove();
                });


                /* Adding new icons url */
                $(".add_icon").click(function (e) {
                    e.preventDefault();
                    $(".dept_icon").append('<li><label>Icons Url:</label><input type="text" style="width:100%;" name="dept_icons[]" value="" /><br>' +
                            '<span class="remove_icon button button-primary button-large">Remove</span></li>');
                });
                $(".remove_icon").live('click', function () {
                    $(this).parent().remove();
                });
            });
        </script>
        <?php
    }

    /* Banner part */

    public function banner_part() {
        global $post;
        $banner_title = get_post_meta($post->ID, "banner_title", true);
        $banner_sub_title = get_post_meta($post->ID, "banner_sub_title", true);
        $banner_bg = get_post_meta($post->ID, "banner_bg", true);
        echo '<label>Title :</label><input type="text" style="width:100%;" name="banner_title" size="10" value="' . $banner_title . '"/>';
        echo '<label>Subtitle :</label><input type="text" style="width:100%;" name="banner_sub_title" size="10" value="' . $banner_sub_title . '"/>';
        echo '<label>Banner Background:</label><input type="text" style="width:100%;" name="banner_bg" size="10" value="' . $banner_bg . '"/>';
    }

    /* Logo part */

    public function logo_image() {
        global $post;
        $data = get_post_meta($post->ID, "logo_img", true);
        echo '<label>Logo :</label><input type="text" style="width:100%;" name="logo_img" size="10" value="' . $data . '"/>';
    }

    public function price_meta() {
        global $post;
        $data = get_post_meta($post->ID, "price_data", true);
        echo '<div>';
        echo '<ul id="price_items">';
        $c = 0;
        //var_dump($data);
        //echo $data[0]['a'];
        if (is_array($data)) {
            if (count($data) > 0) {
                foreach ($data as $p) {
                    foreach ($p as $value) {
                        //echo $value;
                        echo '<li><label>Nr :</label><input type="text" style="width:100%;" name="price_data[' . $c . '][a]" size="10" value="' . $value . '"/><span class="remove button button-primary button-large">Remove</span></li>';
                        $c = $c + 1;
                    }
                }
            }
        } else {
            echo '<li><label>Nr :</label><input type="text" style="width:100%;" name="price_data[0][a]" size="10" value=""/><span class="remove button button-primary button-large">Remove</span></li>';
        }
        echo '</ul>';
        ?>
        <span id="here"></span>
        <span class="add button button-primary button-large"><?php echo __('Add Price Data'); ?></span>
        <script>
            $ = jQuery.noConflict();
            $(document).ready(function () {
                var c =<?php echo $c; ?>;
                $(".add").click(function (event) {
                    $("#price_items").append('<li><label>Nr :</label><input type="text" ' +
                            'name="price_data[' + c + '][a]" size="10" value=""/>' +
                            '<span class="remove button button-primary button-large">Remove</span></li>');
                    c = c + 1;
                });
                $(".remove").live('click', function () {
                    $(this).parent().remove();
                });
            });
        </script>
        <style>#price_items {list-style: none;}</style>
        <?php
        echo '</div>';
    }

    public function save_details($post_id) {
        global $post;
        // to prevent metadata or custom fields from disappearing...
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // OK, we're authenticated: we need to find and save the data
        if (isset($_POST['bg_img'])) {
            $bg_img = $_POST['bg_img'];
            update_post_meta($post_id, 'bg_img', $bg_img);
        }

        if (isset($_POST['price_data'])) {
            $price_data = $_POST['price_data'];
            update_post_meta($post_id, 'price_data', $price_data);
        }
        /* Banner meta update */
        if (isset($_POST['banner_title'])) {
            $banner_title = $_POST['banner_title'];
            update_post_meta($post_id, 'banner_title', $banner_title);
        }

        if (isset($_POST['banner_sub_title'])) {
            $banner_sub_title = $_POST['banner_sub_title'];
            update_post_meta($post_id, 'banner_sub_title', $banner_sub_title);
        }
        if (isset($_POST['banner_bg'])) {
            $banner_bg = $_POST['banner_bg'];
            update_post_meta($post_id, 'banner_bg', $banner_bg);
        }

        /* Why meta update */
        if (isset($_POST['why_title'])) {
            $why_title = $_POST['why_title'];
            update_post_meta($post_id, 'why_title', $why_title);
        }

        if (isset($_POST['why_points'])) {
            $why_points = $_POST['why_points'];
            update_post_meta($post_id, 'why_points', $why_points);
        }
        if (isset($_POST['why_bg'])) {
            $why_bg = $_POST['why_bg'];
            update_post_meta($post_id, 'why_bg', $why_bg);
        }

        /* Department meta update */
        if (isset($_POST['dept_title'])) {
            $dept_title = $_POST['dept_title'];
            update_post_meta($post_id, 'dept_title', $dept_title);
        }

        if (isset($_POST['dept_bg'])) {
            $dept_bg = $_POST['dept_bg'];
            update_post_meta($post_id, 'dept_bg', $dept_bg);
        }
        if (isset($_POST['dept_single'])) {
            $dept_single = $_POST['dept_single'];
            update_post_meta($post_id, 'dept_single', $dept_single);
        }
        if (isset($_POST['dept_icons'])) {
            $dept_icons = $_POST['dept_icons'];
            update_post_meta($post_id, 'dept_icons', $dept_icons);
        }
    }

}

//end class
