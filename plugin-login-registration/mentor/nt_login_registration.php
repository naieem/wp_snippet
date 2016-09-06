<?php
/* protected */
if (!defined('ABSPATH'))
    exit;

/**
copyRight by Naieem Mahmud supto
 */
//class define
class nt_login_registration {

    //construct
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'nt_add_custom_script'));
        add_shortcode('register_form', array($this, 'pippin_registration_form'));
        add_shortcode('login_form', array($this, 'pippin_login_form'));
        add_action('init', array($this, 'pippin_login_member'));
        add_action('init', array($this, 'pippin_add_new_member'));
        add_action('init', array($this, 'pippin_register_css'));
        add_action('wp_footer', array($this, 'pippin_print_css'));
        add_action('wp_logout', array($this, 'redirect_url'));
    }
    
    /* redirect WP Logout page to Homepage */
    public function redirect_url() {
        wp_redirect(home_url());
        exit();
    }

    public function nt_add_custom_script() {
//        wp_register_style('plugin-style', NT_CPM_PLUGIN_URL . 'assets/css/plugin-style.css');
//        wp_enqueue_style('plugin-style');

        wp_enqueue_script('jquery');

        wp_register_script('nt_custom', NT_CPM_PLUGIN_URL . 'assets/js/nt_custom.js', array('jquery'), '', TRUE);
        wp_enqueue_script('nt_custom');
        wp_localize_script('nt_custom', 'admin_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }

// user registration login form
    public function pippin_registration_form() {

        // only show the registration form to non-logged-in members
        if (!is_user_logged_in()) {


            global $pippin_load_css;

            // set this to true so the CSS is loaded
            $pippin_load_css = true;

            // check to make sure user registration is enabled
            $registration_enabled = get_option('users_can_register');

            // only show the registration form if allowed
            if ($registration_enabled) {
                $output = $this->pippin_registration_form_fields();
            } else {
                $output = __('User registration is not enabled');
            }
            return $output;
        }
    }

// user login form
    public function pippin_login_form() {

        if (!is_user_logged_in()) {

            global $pippin_load_css;

            // set this to true so the CSS is loaded
            $pippin_load_css = true;

            $output = $this->pippin_login_form_fields();
            return $output;
        } else {
            // could show some logged in user info here
            // $output = 'user info here';
        }
    }

// registration form fields
    public function pippin_registration_form_fields() {

        ob_start();
        ?>	
        <h3 class="pippin_header"><?php _e('Register New Account'); ?></h3>

        <?php
        // show any error messages after form submission
        $this->pippin_show_error_messages();
        $id = get_the_ID();
        ?>
        <form id="pippin_registration_form" class="pippin_form" action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <p>
                    <label for="pippin_user_Login"><?php _e('Username'); ?></label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </p>
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <p>
                    <label for="pippin_user_email"><?php _e('Email'); ?></label>
                    <input name="pippin_user_email" id="pippin_user_email" class="required" type="email"/>
                </p>
                <p>
                    <label for="pippin_user_first"><?php _e('First Name'); ?></label>
                    <input name="pippin_user_first" id="pippin_user_first" type="text"/>
                </p>
                <p>
                    <label for="pippin_user_last"><?php _e('Last Name'); ?></label>
                    <input name="pippin_user_last" id="pippin_user_last" type="text"/>
                </p>
                <p>
                    <label for="password"><?php _e('Password'); ?></label>
                    <input name="pippin_user_pass" id="password" class="required" type="password"/>
                </p>
                <p>
                    <label for="password_again"><?php _e('Password Again'); ?></label>
                    <input name="pippin_user_pass_confirm" id="password_again" class="required" type="password"/>
                </p>
                <p>
                    <label for="page-title">Page Title</label>
                    <input type="text" name="page_title" value="" required="">
                </p>

                    <!--                <p>
                        <label for="upload files"><?php _e('Upload Files'); ?></label>
                        <input name="upload_file[]" type="file" />
                    </p>

                    <p>
                        <label for="upload files"><?php _e('Upload Files'); ?></label>
                        <input name="upload_file[]" type="file" />
                    </p>-->

                <p>
                    <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
                    <input type="submit" value="<?php _e('Register Your Account'); ?>"  id="submit_form"/>
                </p>
            </fieldset>
        </form>
        <?php
        return ob_get_clean();
    }

// login form fields
    public function pippin_login_form_fields() {

        ob_start();
        ?>
        <h3 class="pippin_header"><?php _e('Login'); ?></h3>

        <?php
        // show any error messages after form submission
        $this->pippin_show_error_messages();
        ?>

        <form id="pippin_login_form"  class="pippin_form" action="" method="post">
            <fieldset>
                <p>
                    <label for="pippin_user_Login">Username</label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </p>
                <p>
                    <label for="pippin_user_pass">Password</label>
                    <input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
                </p>
                <p>
                    <input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
                    <input id="pippin_login_submit" type="submit" value="Login"/>
                </p>
            </fieldset>
        </form>
        <?php
        return ob_get_clean();
    }

// logs a member in after submitting a form
    public function pippin_login_member() {
        if (isset($_POST['pippin_user_login']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {

            // this returns the user ID and other info from the user name
            $user = get_user_by('login', $_POST['pippin_user_login']);

            if (!$user) {
                // if the user name doesn't exist
                $this->pippin_errors()->add('empty_username', __('Invalid username'));
            }

            if (!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
                // if no password was entered
                $this->pippin_errors()->add('empty_password', __('Please enter a password'));
            }

            // check the user's login with their password
            if (!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
                // if the password is incorrect for the specified user
                $this->pippin_errors()->add('empty_password', __('Incorrect password'));
            }

            // retrieve all error messages
            $errors = $this->pippin_errors()->get_error_messages();

            // only log the user in if there are no errors
            if (empty($errors)) {
                wp_set_auth_cookie($user->ID, true);
                wp_set_current_user($user->ID, $_POST['pippin_user_login']);
                do_action('wp_login', $_POST['pippin_user_login']);
                $page_id = esc_attr(get_the_author_meta('page_link', $user->ID));
                $page_url = get_the_permalink($page_id);
                //echo $page_id;
                wp_redirect($page_url);
                exit;
            }
        }
    }

// register a new user
    public function pippin_add_new_member() {
        if (isset($_POST["pippin_user_login"]) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
            $user_login = $_POST["pippin_user_login"];
            $user_email = $_POST["pippin_user_email"];
            $user_first = $_POST["pippin_user_first"];
            $user_last = $_POST["pippin_user_last"];
            $user_pass = $_POST["pippin_user_pass"];
            $pass_confirm = $_POST["pippin_user_pass_confirm"];
            $pass_title = $_POST["page_title"];

            // this is required for username checks
            require_once(ABSPATH . WPINC . '/registration.php');

            if (username_exists($user_login)) {
                // Username already registered
                $this->pippin_errors()->add('username_unavailable', __('Username already taken'));
            }
            if (!validate_username($user_login)) {
                // invalid username
                $this->pippin_errors()->add('username_invalid', __('Invalid username'));
            }
            if ($user_login == '') {
                // empty username
                $this->pippin_errors()->add('username_empty', __('Please enter a username'));
            }
            if (!is_email($user_email)) {
                //invalid email
                $this->pippin_errors()->add('email_invalid', __('Invalid email'));
            }
            if (email_exists($user_email)) {
                //Email address already registered
                $this->pippin_errors()->add('email_used', __('Email already registered'));
            }
            if ($user_pass == '') {
                // passwords do not match
                $this->pippin_errors()->add('password_empty', __('Please enter a password'));
            }
            if ($pass_title == '') {
                // passwords do not match
                $this->pippin_errors()->add('title_empty', __('Title field should not be empty'));
            }
            if ($user_pass != $pass_confirm) {
                // passwords do not match
                $this->pippin_errors()->add('password_mismatch', __('Passwords do not match'));
            }

            $errors = $this->pippin_errors()->get_error_messages();

            // only create the user in if there are no errors
            if (empty($errors)) {

                $new_user_id = wp_insert_user(array(
                    'user_login' => $user_login,
                    'user_pass' => $user_pass,
                    'user_email' => $user_email,
                    'first_name' => $user_first,
                    'last_name' => $user_last,
                    'user_registered' => date('Y-m-d H:i:s'),
                    'role' => 'subscriber'
                        )
                );

                if ($new_user_id) {
                    // send an email to the admin alerting them of the registration
                    wp_new_user_notification($new_user_id);
                    $new_page_id = wp_insert_post(array(
                        'post_title' => $pass_title,
                        'post_type' => 'page',
                        'post_name' => "$pass_title",
                        'comment_status' => 'closed',
                        'ping_status' => 'closed',
                        'post_content' => '',
                        'post_status' => 'draft',
                        'menu_order' => 0,
                        // Assign page template
                        'page_template' => 'landing_page.php'
                    ));
                    update_usermeta($new_user_id, 'page_link', $new_page_id);
                    // log the new user in
                    //wp_setcookie($user_login, $user_pass, true);
                    ////($new_user_id, $user_login);	
                    //do_action('wp_login', $user_login);
                    // send the newly created user to the home page after logging them in
                    wp_redirect(home_url());
                    exit;
                }
            }
        }
    }

// used for tracking error messages
    public function pippin_errors() {
        static $wp_error; // Will hold global variable safely
        return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
    }

// displays error messages from form submissions
    public function pippin_show_error_messages() {
        if ($codes = $this->pippin_errors()->get_error_codes()) {
            echo '<div class="pippin_errors">';
            // Loop error codes and display errors
            foreach ($codes as $code) {
                $message = $this->pippin_errors()->get_error_message($code);
                echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
            }
            echo '</div>';
        }
    }

// register our form css
    public function pippin_register_css() {
        wp_register_style('pippin-form-css', plugin_dir_url(__FILE__) . '/css/forms.css');
    }

// load our form css
    public function pippin_print_css() {
        global $pippin_load_css;

        // this variable is set to TRUE if the short code is used on a page/post
        if (!$pippin_load_css)
            return; // this means that neither short code is present, so we get out of here

        wp_print_styles('pippin-form-css');
    }

}

//end class
