<?php
/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by Nsstheme
 */
//class define
class nt_user_field {

    //construct
    public function __construct() {
        add_action('show_user_profile', array($this, 'extra_profile_field'));
        add_action('edit_user_profile', array($this, 'extra_profile_field'));

        add_action('personal_options_update', array($this,'save_extra_profile_field'));
        add_action('edit_user_profile_update', array($this,'save_extra_profile_field'));
    }

    public function extra_profile_field($user) {
        ?>
        <h3>Custom data for user Profile</h3>

        <table class="form-table">

            <tr>
                <th><label for="twitter">Page link</label></th>

                <td>
                    <input type="text" style="width: 50%;" name="page_link" id="twitter" value="<?php echo esc_attr(get_the_author_meta('page_link', $user->ID)); ?>" class="" /><br />
                    <span class="description">Page link for the user</span>
                </td>
            </tr>

        </table>
        <?php
    }

    public function save_extra_profile_fields($user_id) {

        if (!current_user_can('edit_user', $user_id))
            return false;
        update_usermeta($user_id, 'page_link', $_POST['page_link']);
    }

}

//end class
