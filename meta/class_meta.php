<?php
function Print_price_fileds($cnt, $p = null)
{
    if ($p === null) {
        $a = $b = $c = '';
    } else {
        $a = $p['n'];
        $b = $p['d'];
        $c = $p['p'];
    }
    return <<<HTML
<li>
    <label>Nr :</label>
    <input type="text" name="price_data[$cnt][n]" size="10" value="$a"/>

    <label>Description :</label>
    <input type="text" name="price_data[$cnt][d]" size="50" value="$b"/>

    <label>Price :</label>
    <input type="text" name="price_data[$cnt][p]" size="20" value="$c"/>
    <span class="remove">Remove</span>
</li>
HTML
    ;
}

//add custom field - price
add_action("add_meta_boxes", "object_init");

function object_init()
{
    add_meta_box("price_meta_id", "Price fields :", "price_meta", "page", "normal", "low");

}

function price_meta()
{
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
                    echo '<li><label>Nr :</label><input type="text" name="price_data[' . $c . '][a]" size="10" value="' . $value. '"/><span class="remove button button-primary button-large">Remove</span></li>';
                    $c=$c+1;
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
            $ =jQuery.noConflict();
                $(document).ready(function() {
                    var c=<?php echo $c;?>;
                $(".add").click(function(event) {
                    $("#price_items").append('<li><label>Nr :</label><input type="text" '+
                        'name="price_data['+c+'][a]" size="10" value=""/>'+
                        '<span class="remove button button-primary button-large">Remove</span></li>');
                    c=c+1;
                });
                $(".remove").live('click', function() {
                    $(this).parent().remove();
                });
            });
        </script>
        <style>#price_items {list-style: none;}</style>
    <?php
echo '</div>';
}

//Save product price
add_action('save_post', 'save_detailss');

function save_detailss($post_id)
{
    global $post;

    // to prevent metadata or custom fields from disappearing...
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // OK, we're authenticated: we need to find and save the data
    if (isset($_POST['price_data'])) {
        $data = $_POST['price_data'];
        update_post_meta($post_id, 'price_data', $data);
    } else {
        delete_post_meta($post_id, 'price_data');
    }
}

//add_action('admin_head', 'add_custom_scripts');
// function add_custom_scripts()
// {
//     wp_enqueue_script('jquery');
// }