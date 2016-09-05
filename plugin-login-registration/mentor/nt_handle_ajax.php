<?php

/* protected */
if (!defined('ABSPATH'))
    exit;

/**
  @copyRight by Naieem Mahmud Supto
 */
//class define
class nt_handle_ajax {

    //construct
    public function __construct() {
        /*
         * ################
         * Logo upload
         * ################
         */
        add_action('wp_ajax_upload_logo', array($this, 'logo_upload'));
        add_action('wp_ajax_nopriv_upload_logo', array($this, 'logo_upload'));
        /*
         * ################
         * Banner Upadate
         * ################
         */
        add_action('wp_ajax_banner_update', array($this, 'update_banner_part'));
        add_action('wp_ajax_nopriv_banner_update', array($this, 'update_banner_part'));
        /*
         * ################
         * Why part Upadate
         * ################
         */
        add_action('wp_ajax_why_update', array($this, 'update_why'));
        add_action('wp_ajax_nopriv_why_update', array($this, 'update_why'));
        /*
         * ################
         * Attachment delete Upadate
         * ################
         */
        add_action('wp_ajax_delete_attachement', array($this, 'attachment_delete'));
        add_action('wp_ajax_nopriv_delete_attachement', array($this, 'attachment_delete'));
        /*
         * ################
         * Icon Upadate
         * ################
         */
        add_action('wp_ajax_icon_upload', array($this, 'upload_icon'));
        add_action('wp_ajax_nopriv_icon_upload', array($this, 'upload_icon'));

        /*
         * ################
         * Department Upadate
         * ################
         */
        add_action('wp_ajax_department_update', array($this, 'department_update'));
        add_action('wp_ajax_nopriv_department_update', array($this, 'department_update'));

        /*
         * ################
         * Founder Upadate
         * ################
         */
        add_action('wp_ajax_founder_update', array($this, 'founder_update'));
        add_action('wp_ajax_nopriv_founder_update', array($this, 'founder_update'));

        /*
         * ################
         * Menu Upadate
         * ################
         */
        add_action('wp_ajax_menu_update', array($this, 'menu_update'));
        add_action('wp_ajax_nopriv_menu_update', array($this, 'menu_update'));

        /*
         * ################
         * Footer Upadate
         * ################
         */
        add_action('wp_ajax_footer_update', array($this, 'footer_update'));
        add_action('wp_ajax_nopriv_footer_update', array($this, 'footer_update'));
    }
	
	/*
     * ##########
     * Return live result
     * ########## 
     */
	 public function get_live_result($id){
		 ob_start();
		  $logo = get_post_meta($id, "logo_img", true);
                $menu = get_post_meta($id, "menu", true);
                $banner_title = get_post_meta($id, "banner_title", true);
                $banner_sub_title = get_post_meta($id, "banner_sub_title", true);
                $banner_bg = get_post_meta($id, "banner_bg", true);
                $why_title = get_post_meta($id, "why_title", true);
                $why_points = get_post_meta($id, "why_points", true);
                $why_bg = get_post_meta($id, "why_bg", true);
                $dept_title = get_post_meta($id, "dept_title", true);
                $dept_bg = get_post_meta($id, "dept_bg", true);
                $dept_single = get_post_meta($id, "dept_single", true);
                $dept_icons = get_post_meta($id, "dept_icons", true);
                $founder_title = get_post_meta($id, "founder_title", true);
                $founder_name = get_post_meta($id, "founder_name", true);
                $founder_desc = get_post_meta($id, "founder_desc", true);
                $founder_img = get_post_meta($id, "founder_img", true);
                $about_text = get_post_meta($id, "about_text", true);
                $footer_text = get_post_meta($id, "footer_text", true);
				?>
                      
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
  <div class="ourdept" style="background: url(<?php echo $dept_bg;?>);background-size: cover;">
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
          <div class="fondr"> <img src="<?php echo $founder_img;?>" alt="doctr"> </div>
        </div>
        <div class="col-md-6">
          <div class="fond">
            <h1 class="bord">Our <span>founder</span></h1>
            <p class="fontit"><?php echo $founder_title;?></p>
            <h2><?php echo $founder_name;?></h2>
            <p class="fontit2"><?php echo $founder_desc;?></p>
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
            <img src="<?php echo $logo;?>" alt="Footer logo">
            <p><?php echo $about_text;?></p>
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
      <p><?php echo $footer_text;?></a> </p>
    </div>
  </div>
  <!-- Footer bottomm --> 
	 <?php
	 return ob_get_clean();
     }

    /*
     * ##########
     * Footer update part is here
     * ########## 
     */

    public function footer_update() {
        $data = array();
        if (isset($_POST['about_text'])) {
            $about_text = $_POST['about_text'];
            update_post_meta($_POST['id'], 'about_text', $about_text);
        }

        if (isset($_POST['footer_text'])) {
            $footer_text = $_POST['footer_text'];
            update_post_meta($_POST['id'], 'footer_text', $footer_text);
        }
        $data['result'] = array($about_text, $footer_text);
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Menu update part is here
     * ########## 
     */

    public function menu_update() {
        $data = array();
        update_post_meta($_POST['id'], 'menu', $_POST['menu']);
        $data['menu'] = $_POST['menu'];
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Founder update part is here
     * ########## 
     */

    public function founder_update() {
        $data = array();
        if (isset($_POST['update_founder'])) {
            if (!empty($_FILES['founder_img']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('founder_img', $_POST['id']);
                update_post_meta($_POST['id'], 'founder_img', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
            } else {
                $data['image_upload'] = false;
            }
            if (isset($_POST['founder_title'])) {
                $founder_title = $_POST['founder_title'];
                update_post_meta($_POST['id'], 'founder_title', $founder_title);
            }
            if (isset($_POST['founder_name'])) {
                $founder_name = $_POST['founder_name'];
                update_post_meta($_POST['id'], 'founder_name', $founder_name);
            }
            if (isset($_POST['founder_desc'])) {
                $founder_desc = $_POST['founder_desc'];
                update_post_meta($_POST['id'], 'founder_desc', $founder_desc);
            }
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['result'] = false;
        }
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Department update part is here
     * ########## 
     */

    public function department_update() {
        $data = array();
        if (isset($_POST['department_submit'])) {
            if (!empty($_FILES['department_file']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('department_file', $_POST['id']);
                update_post_meta($_POST['id'], 'dept_bg', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
            } else {
                $data['image_upload'] = false;
            }
            if (isset($_POST['dept_title'])) {
                $dept_title = $_POST['dept_title'];
                update_post_meta($_POST['id'], 'dept_title', $dept_title);
            }


            update_post_meta($_POST['id'], 'dept_single', $_POST['dept_single']);

            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['result'] = false;
        }
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Logo update part is here
     * ########## 
     */

    public function logo_upload() {
        $data = array();
        if (!empty($_FILES['logo_img']['name'])) {
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
            update_post_meta($_POST['id'], 'logo_img', wp_get_attachment_url($newupload));
            $data['image_upload'] = true;
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['image_upload'] = false;
        }
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Banner update part is here
     * ########## 
     */

    public function update_banner_part() {
        $data = array();
        if (isset($_POST['banner_submit'])) {
            if (!empty($_FILES['banner_file']['name'])) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $newupload = media_handle_upload('banner_file', $_POST['id']);
                update_post_meta($_POST['id'], 'banner_bg', wp_get_attachment_url($newupload));
                $data['image_upload'] = true;
                $data['image_url'] = wp_get_attachment_url($newupload);
                $data['image_id'] = $newupload;
                $data['result'] = true;
            } else {
                $data['image_upload'] = false;
            }
            update_post_meta($_POST['id'], 'banner_title', $_POST['banner_title']);
            update_post_meta($_POST['id'], 'banner_sub_title', $_POST['banner_sub_title']);
        }
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Why update part is here
     * ########## 
     */

    public function update_why() {
        $data = array();
        if (!empty($_FILES['why_file']['name'])) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            $newupload = media_handle_upload('why_file', $_POST['id']);
            update_post_meta($_POST['id'], 'why_bg', wp_get_attachment_url($newupload));
            $data['image_upload'] = true;
            $data['image_url'] = wp_get_attachment_url($newupload);
            $data['image_id'] = $newupload;
            $data['result'] = true;
        } else {
            $data['image_upload'] = false;
        }
        if (isset($_POST['why_title'])) {
            $why_title = $_POST['why_title'];
            update_post_meta($_POST['id'], 'why_title', $why_title);
        }
        update_post_meta($_POST['id'], 'why_points', $_POST['why_points']);
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * ##########
     * Attachment delete part is here
     * ########## 
     */

    public function attachment_delete() {
        $data = array();
        if (false === wp_delete_attachment($_POST['id']) || $_POST['id'] == '') {
            $data['message'] = "Attachment Not deleted";
            $data['result'] = false;
        } else {
            $data['message'] = "Attachment deleted succesfully";
            $data['result'] = true;
            update_post_meta($_POST['post_id'], $_POST['field'], "");
        }
		$data['return_value']=$this->get_live_result($_POST['id']);
        echo json_encode($data);
        die();
    }

    /*
     * #########
     * Getting image name from image url
     * #########
     */

    public function get_image_name($url) {
        $url_arr = explode('/', $url);
        $ct = count($url_arr);
        $name = $url_arr[$ct - 1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_name = $name_div[$ct_dot - $ct_dot];
        return $img_name;
    }

    /*
     * #########
     * Upload icon to post
     * #########
     */

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
        die();
    }

}

//end class
