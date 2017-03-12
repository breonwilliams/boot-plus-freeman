<?php


function clean_shortcodes($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']',
        '<p><span>[' => '[', 
        ']</span></p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'clean_shortcodes');



/* Full Width Color Section */

function color_section( $atts, $content = null ) {

   $atts = shortcode_atts(
        array(
            'bgcolor' => '',
            'class' => '',
            'id' => '',
            'flex' => '',
        ), $atts, 'color_section' );


    $bgcolor = $atts['bgcolor'];
    $class = $atts['class'];
    $id = $atts['id'];
    $flex = $atts['flex'];

   return '<section id="'.$id.'" class="'.$class.' '.$flex.'" style="background-color: '.$bgcolor.';"><div class="container">' . do_shortcode($content) . '</div></section>';

}

add_shortcode('color_section', 'color_section');

/* Full Width Image Section */
function img_section( $atts, $content = null ) {

   $atts = shortcode_atts(
        array(
            'bgimg' => '',
            'overlay' => '',
            'class' => '',
            'id' => '',
            'flex' => '',
        ), $atts, 'img_section' );


    $bgimg = $atts['bgimg'];
    $overlay = $atts['overlay'];
    $class = $atts['class'];
    $id = $atts['id'];
    $flex = $atts['flex'];

   return '

   <section id="'.$id.'" class="bg-img '.$flex.'" style="background-image: url('.$bgimg.');">
        <div class="'.$class.'" style="background:'.$overlay.';">
            <div class="container">
                ' . do_shortcode($content) . '
            </div>
        </div>
    </section>

    ';

}

add_shortcode('img_section', 'img_section');


/* Full Width Parallax Section */
function parallax_section( $atts, $content = null ) {
    wp_enqueue_script( 'parallax' );
    $atts = shortcode_atts(
        array(
            'bgimg' => '',
            'overlay' => '',
            'class' => '',
            'id' => '',
            'flex' => '',
        ), $atts, 'img_section' );


    $bgimg = $atts['bgimg'];
    $overlay = $atts['overlay'];
    $class = $atts['class'];
    $id = $atts['id'];
    $flex = $atts['flex'];

    return '

   <section id="'.$id.'" class="parallax '.$flex.'" style="background-image:url('.$bgimg.');">
        <div class="'.$class.'" style="background:'.$overlay.';">
            <div class="container">
                ' . do_shortcode($content) . '
            </div>
        </div>
    </section>

    ';

}

add_shortcode('parallax_section', 'parallax_section');


/* Custom Div */

function custom_div( $atts, $content = null ) {

   $atts = shortcode_atts(
        array(
            'class' => '',
            'id' => '',
        ), $atts, 'custom_div' );

    $class = $atts['class'];
    $id = $atts['id'];
   
   return '<div id="'.$id.'" class="'.$class.'" >' . do_shortcode($content) . '</div>';

}

add_shortcode('custom_div', 'custom_div');

/* Custom Div */

/* Percentage Circle */

function perc_circle( $atts, $content = null ) {
    wp_enqueue_style( 'circle-css' );
    $atts = shortcode_atts(
        array(
            'size' => '',
            'percent' => '',
            'class' => '',
        ), $atts, 'perc_circle' );

    $size = $atts['size'];
    $percent = $atts['percent'];
    $class = $atts['class'];

    return '

    <div class="c100 p'.$percent.' '.$size.' '.$class.'">
                    <span>'.$percent.'%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
    ';

}

add_shortcode('perc_circle', 'perc_circle');

function orderedlist_wrap( $atts, $content = null ) {

    $atts = shortcode_atts(
        array(
            'class' => '',
            'id' => '',
        ), $atts, 'custom_div' );

    $class = $atts['class'];
    $id = $atts['id'];

    return '<dl id="'.$id.'" class="orderedList '.$class.'" >' . do_shortcode($content) . '</dl>';

}

add_shortcode('orderedlist_wrap', 'orderedlist_wrap');

function orderedlist_item( $atts, $content = null ) {

    $atts = shortcode_atts(
        array(
            'label' => '',
            'class' => '',
        ), $atts, 'custom_div' );

    $label = $atts['label'];
    $class = $atts['class'];

    return '<div class="orderedList-wrap '.$class.'" ><dt>'.$label.'</dt><dd>' . do_shortcode($content) . '</dd></div>';

}

add_shortcode('orderedlist_item', 'orderedlist_item');

/* Search Overlay */

function search_overlay( $form ) {
    wp_enqueue_style( 'search-css' );
    wp_enqueue_script( 'search-overlay' );
    $form = '

    <a class="mk-search-trigger mk-fullscreen-trigger" href="#" id="search-button-listener">
    <div id="search-button"><i class="fa fa-search"></i></div>
  </a>
  <div class="mk-fullscreen-search-overlay" id="mk-search-overlay">
    <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i class="fa fa-times"></i></a>
    <div id="mk-fullscreen-search-wrapper">
      <form role="search" method="get" id="mk-fullscreen-searchform" action="' . home_url( '/' ) . '" >
        <input type="text" value="' . get_search_query() . '" name="s" placeholder="Search..." id="mk-fullscreen-search-input">
        <i class="fa fa-search fullscreen-search-icon"><input value="'. esc_attr__('') .'" type="submit"></i>
      </form>
    </div>
  </div>


    ';

    return $form;
}

add_shortcode('search_overlay', 'search_overlay');

/*full width background color end*/



/* Background Video */

function background_vid( $atts, $content = null ) {
    wp_enqueue_script( 'bgvid' );  
    wp_enqueue_script( 'bgvid-js' );
    wp_enqueue_style( 'bgvid-css' );

    $atts = shortcode_atts(
        array(
            'poster' => '',
            'mp4' => '',
            'padding' => '',
            'class' => '',
            'id' => '',
            'overlay' => '',
        ), $atts, 'background_vid' );


    $poster = $atts['poster'];
    $mp4 = $atts['mp4'];
    $padding = $atts['padding'];
    $class = $atts['class'];
    $id = $atts['id'];
    $overlay = $atts['overlay'];
    return '

<div id="'.$id.'" class="video-hero jquery-background-video-wrapper demo-video-wrapper '.$class.'">
        <video class="jquery-background-video" autoplay muted loop poster="'.$poster.'">
            <source src="'.$mp4.'" type="video/mp4">
        </video>
        <div class="video-overlay" style="background:'.$overlay.';"></div>
        <div class="'.$padding.'">
            <div class="video-hero--content">
                <div class="container">
                    ' . do_shortcode($content) . '
                </div>
            </div>
        </div>
    </div>'



        ;

}

add_shortcode('background_vid', 'background_vid');

/* Modal */

function boot_modal( $atts, $content = null ) {
    wp_enqueue_script( 'modal' );

    $atts = shortcode_atts(
        array(
            'button' => '',
            'title' => '',
            'class' => '',
            'target' => '',
            'closeclass' => '',
            'modalsize' => '',
        ), $atts, 'boot_modal' );


    $button = $atts['button'];
    $title = $atts['title'];
    $class = $atts['class'];
    $target = $atts['target'];
    $closeclass = $atts['closeclass'];
    $modalsize = $atts['modalsize'];

    return '

        <a href="#" class="'.$class.'" data-toggle="modal" data-target="#'.$target.'">'.$button.'</a>

        <div class="modal fade" id="'.$target.'" tabindex="-1" role="modal" aria-labelledby="modal-label-3" aria-hidden="true" style="display: none;">
            <div class="modal-dialog '.$modalsize.'">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="modal-label-3">'.$title.'</h4>
                    </div>
                    <div class="modal-body">
                        ' . do_shortcode($content) . '
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="'.$closeclass.'" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>'

        ;

}

add_shortcode('boot_modal', 'boot_modal');

/* Popup Video */

function popup_video( $atts, $content = null ) {
    wp_enqueue_script( 'lity-js' );
    wp_enqueue_style( 'lity-css' );

    $atts = shortcode_atts(
        array(
            'class' => '',
            'url' => '',
        ), $atts, 'popup_video' );

    $class = $atts['class'];
    $url = $atts['url'];

    return '

        <a href="'.$url.'" class="'.$class.'" data-lity>' . do_shortcode($content) . '</a>
        '

        ;

}

add_shortcode('popup_video', 'popup_video');

/*carousel custom start*/
function carousel_wrap( $atts, $content = null ) {
    wp_enqueue_script( 'slick-js' );
    wp_enqueue_script( 'slick-init' );
    $atts = shortcode_atts(
        array(
            'class' => '',

        ), $atts, 'carousel_wrap' );


    $class = $atts['class'];

    return '

        <div class="'.$class.'">
            ' . do_shortcode($content) . '
        </div>'

        ;

}

add_shortcode('carousel_wrap', 'carousel_wrap');

function carousel_item( $atts, $content = null ) {

    $atts = shortcode_atts(
        array(
            'class' => '',
        ), $atts, 'carousel_item' );

    $class = $atts['class'];

    return '<div class="'.$class.'" >' . do_shortcode($content) . '</div>';

}

add_shortcode('carousel_item', 'carousel_item');

/*rcarousel custom end*/


/* Logged In */
function check_user_li ($params, $content = null){
    //check tha the user is logged in
    if ( is_user_logged_in() ){

        //user is logged in so show the content
        return '' . do_shortcode($content) . '' ;

    }

    else{

        //user is not logged in so hide the content
        return '' ;

    }

}

//add a shortcode which calls the above function
add_shortcode('boot_logged_in', 'check_user_li' );

/* Logged Out */
function check_user_lo ($params, $content = null){
    //check tha the user is logged in
    if ( is_user_logged_in() ){

        //user is logged in so show the content
        return '' ;

    }

    else{

        //user is not logged in so hide the content
        return '' . do_shortcode($content) . '' ;

    }

}

//add a shortcode which calls the above function
add_shortcode('boot_logged_out', 'check_user_lo' );


function wpfa_login_form( $args ) {

    $defaults = shortcode_atts( array(
        'echo'              => false,
        'redirect'          => site_url( '/wp-admin/' ),
        'form_id'           => 'loginform',
        'label_username'    => __( 'Username', 'wpfa-textdomain' ),
        'label_password'    => __( 'Password', 'wpfa-textdomain' ),
        'label_remember'    => __( 'Remember Me', 'wpfa-textdomain' ),
        'label_log_in'      => __( 'Log In', 'wpfa-textdomain' ),
        'id_username'       => 'user_login',
        'id_password'       => 'user_pass',
        'id_remember'       => 'rememberme',
        'id_submit'         => 'wp-submit',
        'remember'          => true,
        'value_username'    => NULL,
        'value_remember'    => false
    ), $args, 'wpfa_login' );

    $login_args = wp_parse_args( $args, $defaults );

    return wp_login_form( $login_args );

} /** End function - WPFA login form */
add_shortcode( 'boot_login_form', 'wpfa_login_form' );


//Logout Shortcode
function logout_func ($atts, $content = null) {
    extract(shortcode_atts(array(
        'linktext' => 'Log Out',
        'class' => '',
    ), $atts));
    $class = $atts['class'];
    $logoutlink = wp_logout_url( home_url() );
    return '<a class="'.$class.'" href="' . $logoutlink . '" title="Logout">'. $linktext .'</a>';
}
add_shortcode( 'boot_logoutbtn', 'logout_func' );


// password reset

function pippin_change_password_form() {
    global $post;

    if (is_singular()) :
        $current_url = get_permalink($post->ID);
    else :
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $current_url = $pageURL;
    endif;
    $redirect = $current_url;

    ob_start();

    // show any error messages after form submission
    pippin_show_error_messages(); ?>

    <?php if(isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
        <div class="pippin_message success">
            <span><?php _e('Password changed successfully', 'rcp'); ?></span>
        </div>
    <?php } ?>
    <form id="pippin_password_form" method="POST" action="<?php echo $current_url; ?>">
        <fieldset>
            <p>
                <label for="pippin_user_pass"><?php _e('New Password', 'rcp'); ?></label>
                <input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
            </p>
            <p>
                <label for="pippin_user_pass_confirm"><?php _e('Password Confirm', 'rcp'); ?></label>
                <input name="pippin_user_pass_confirm" id="pippin_user_pass_confirm" class="required" type="password"/>
            </p>
            <p>
                <input type="hidden" name="pippin_action" value="reset-password"/>
                <input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
                <input type="hidden" name="pippin_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
                <input id="pippin_password_submit" type="submit" value="<?php _e('Change Password', 'pippin'); ?>"/>
            </p>
        </fieldset>
    </form>
    <?php
    return ob_get_clean();
}

// password reset form
function pippin_reset_password_form() {
    if(is_user_logged_in()) {
        return pippin_change_password_form();
    }
}
add_shortcode('password_form', 'pippin_reset_password_form');


function pippin_reset_password() {
    // reset a users password
    if(isset($_POST['pippin_action']) && $_POST['pippin_action'] == 'reset-password') {

        global $user_ID;

        if(!is_user_logged_in())
            return;

        if(wp_verify_nonce($_POST['pippin_password_nonce'], 'rcp-password-nonce')) {

            if($_POST['pippin_user_pass'] == '' || $_POST['pippin_user_pass_confirm'] == '') {
                // password(s) field empty
                pippin_errors()->add('password_empty', __('Please enter a password, and confirm it', 'pippin'));
            }
            if($_POST['pippin_user_pass'] != $_POST['pippin_user_pass_confirm']) {
                // passwords do not match
                pippin_errors()->add('password_mismatch', __('Passwords do not match', 'pippin'));
            }

            // retrieve all error messages, if any
            $errors = pippin_errors()->get_error_messages();

            if(empty($errors)) {
                // change the password here
                $user_data = array(
                    'ID' => $user_ID,
                    'user_pass' => $_POST['pippin_user_pass']
                );
                wp_update_user($user_data);
                // send password change email here (if WP doesn't)
                wp_redirect(add_query_arg('password-reset', 'true', $_POST['pippin_redirect']));
                exit;
            }
        }
    }
}
add_action('init', 'pippin_reset_password');

if(!function_exists('pippin_show_error_messages')) {
    // displays error messages from form submissions
    function pippin_show_error_messages() {
        if($codes = pippin_errors()->get_error_codes()) {
            echo '<div class="pippin_message error">';
            // Loop error codes and display errors
            foreach($codes as $code){
                $message = pippin_errors()->get_error_message($code);
                echo '<span class="pippin_error"><strong>' . __('Error', 'rcp') . '</strong>: ' . $message . '</span><br/>';
            }
            echo '</div>';
        }
    }
}

if(!function_exists('pippin_errors')) {
    // used for tracking error messages
    function pippin_errors(){
        static $wp_error; // Will hold global variable safely
        return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
    }
}