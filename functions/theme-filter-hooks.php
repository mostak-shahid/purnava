<?php
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) AND $post->post_type == 'page' ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }/* else {
        $classes[] = $post->post_type . '-archive';
    }*/
    if (get_current_user_id()){
        $classes[] = 'logged-in-user';
    } else {
        $classes[] = 'guest-user';        
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

add_action( 'action_below_footer', 'back_to_top_fnc', 10, 1 );
function back_to_top_fnc () {
    global $purnava_options;
    if ($purnava_options['misc-back-top']) :
    ?>
    <a href="javascript:void(0)" class="scrollup" style="display: none;"><img width="40" height="40" src="<?php echo get_template_directory_uri() ?>/images/icon_top.png" alt="Back To Top"></a>
    <?php 
    endif;
}
function custom_admin_script(){
    $frontpage_id = get_option( 'page_on_front' );
    if (@$_GET['post'] == $frontpage_id){ 
        ?>
        <script>
        jQuery(document).ready(function($){
            $('#_purnava_banner_details').hide();
        });
        </script>
        <?php 
    }
        
}
add_action('admin_head', 'custom_admin_script');

/*Additional fields*/
function mosacademy_additional_fields( $user_contact ) {

    // Add user contact methods
    $user_contact['phone']   = __( 'Phone' );

    // Remove user contact methods
    // unset( $user_contact['aim']    );
    // unset( $user_contact['jabber'] );

    return $user_contact;
}
add_filter( 'user_contactmethods', 'mosacademy_additional_fields' );


/*Login Page*/
function mos_loging_logo() { 
?> 
    <style type="text/css"> 
    body.login{background: #036cb7;}
    body.login #backtoblog a, body.login #nav a{color: #ffffff}
    body.login div#login h1 a {
        background-image: url(<?php echo get_template_directory_uri() . '/images/login-logo.png' ?>); 
        padding-bottom: 30px;
        background-size: unset; 
        width: 100%;
        height: 30px;
        margin-top: 0;
        margin-bottom: 0;
    } 
    </style>
 <?php 
}
add_action( 'login_enqueue_scripts', 'mos_loging_logo' );

function mos_login_url($url) {
    return home_url();
}
add_filter( 'login_headerurl', 'mos_login_url' );