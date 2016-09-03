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
        add_meta_box("bg_img_meta_id", "Images for the page:", array($this, 'bg_image'), "page", "normal", "low");
        add_meta_box("banner_meta", "Banner part:", array($this, 'banner_part'), "page", "normal", "low");
        add_meta_box("why_meta", "Why choose part:", array($this, 'why_part'), "page", "normal", "low");
    }

    public function why_part() {
        global $post;
        $why_title = get_post_meta($post->ID, "why_title", true);
        $why_points = get_post_meta($post->ID, "why_points", true);
        $why_bg = get_post_meta($post->ID, "why_bg", true);
        print_r($why_points);
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
        echo '</div><br><label>Banner Background:</label><input type="text" style="width:100%;" name="why_bg" value="' . $why_bg . '"/>';

        echo '<span class="add_why button button-primary button-large">' . __('Add why') . '</span>';
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

    public function banner_part() {
        global $post;
        $banner_title = get_post_meta($post->ID, "banner_title", true);
        $banner_sub_title = get_post_meta($post->ID, "banner_sub_title", true);
        $banner_bg = get_post_meta($post->ID, "banner_bg", true);
        echo '<label>Title :</label><input type="text" style="width:100%;" name="banner_title" size="10" value="' . $banner_title . '"/>';
        echo '<label>Subtitle :</label><input type="text" style="width:100%;" name="banner_sub_title" size="10" value="' . $banner_sub_title . '"/>';
        echo '<label>Banner Background:</label><input type="text" style="width:100%;" name="banner_bg" size="10" value="' . $banner_bg . '"/>';
    }

    public function bg_image() {
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
    }

}

//end class
