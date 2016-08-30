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
        add_meta_box("bg_img_meta_id", "Backgimd :", array($this, 'bg_image'), "page", "normal", "low");
    }

    public function bg_image() {
        global $post;
        $data = get_post_meta($post->ID, "bg_img", true);
        echo '<label>Nr :</label><input type="text" name="bg_img" size="10" value="'.$data.'"/>';
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
                        echo '<li><label>Nr :</label><input type="text" name="price_data[' . $c . '][a]" size="10" value="' . $value . '"/><span class="remove button button-primary button-large">Remove</span></li>';
                        $c = $c + 1;
                    }
                }
            }
        } else {
            echo '<li><label>Nr :</label><input type="text" name="price_data[0][a]" size="10" value=""/><span class="remove button button-primary button-large">Remove</span></li>';
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
            $data = $_POST['bg_img'];
            update_post_meta($post_id, 'bg_img', $data);
        }
        
        if (isset($_POST['price_data'])) {
            $data = $_POST['price_data'];
            update_post_meta($post_id, 'price_data', $data);
        }
    }

}

//end class
