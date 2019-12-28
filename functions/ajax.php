<?php
/*// AJAX action callback 
add_action( 'wp_ajax_reset_prl', 'reset_prl_ajax_callback' );
add_action( 'wp_ajax_nopriv_reset_prl', 'reset_prl_ajax_callback' );
// Ajax Callback 
function reset_prl_ajax_callback () {
    $post_id = $_GET['post_id'];
    delete_post_meta($post_id, '_purnava_page_section_layout');
    //http://tippproperty.belocal.today/wp-admin/post.php?post=16&action=edit
    $location = admin_url('/') . 'post.php?post=' . $post_id . '&action=edit';
    wp_redirect( $location, $status = 302 );
    exit; // required. to end AJAX request.
}*/
/*
$user_id = username_exists( $user_name );
 
if ( ! $user_id && false == email_exists( $user_email ) ) {
    $random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
    $user_id = wp_create_user( $user_name, $random_password, $user_email );
} else {
    $random_password = __( 'User already exists.  Password inherited.', 'textdomain' );
}


add_action('init', 'add_user');
function add_user() {
    $username = 'username123';
    $password = 'pasword123';
    $email = 'drew@example.com';

    // Create the new user
    $user_id = wp_create_user( $username, $password, $email );

    // Get current user object
    $user = get_user_by( 'id', $user_id );

    // Remove role
    $user->remove_role( 'subscriber' );

    // Add role
    $user->add_role( 'administrator' );
}
*/

// AJAX action callback 
add_action( 'wp_ajax_register_check', 'register_check_ajax_callback' );
add_action( 'wp_ajax_nopriv_register_check', 'register_check_ajax_callback' );
// Ajax Callback 
function register_check_ajax_callback () {
    $data = array();
    // $data['login'] = $_POST['login'];
    if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        if (email_exists( $_POST['user_email'] )){
            $data['error']['email'] = 'Email address already registered';          
        }
    } else {
        $data['error']['email'] = 'Please enter a valid email address'; 
    }

    if (username_exists( $_POST['user_login'] )){
        $data['error']['phone'] = 'Phone already registered';
    } 
    if (!@$data['error']){
        $user_email = sanitize_text_field( $_POST['user_email'] );
        $user_login = sanitize_text_field( $_POST['user_login'] );
        $password = $_POST['user_pass'];

        if ( false == username_exists( $user_login ) && false == email_exists( $user_email ) ) {
            // $random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
            // $user_id = wp_create_user( $user_name, $random_password, $user_email );
            $user_id = wp_create_user( $user_login, $password, $user_email );
            wp_update_user([
                'ID' => $user_id, // this is the ID of the user you want to update.
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
            ]);
            update_user_meta( $user_id, 'phone', $user_login );
            $data['success'] = 'yes';
        }
        
    }       
    
    header("Content-type: text/x-json");
    echo json_encode($data);
    exit;
}
// AJAX action callback 
add_action( 'wp_ajax_login_check', 'login_check_ajax_callback' );
add_action( 'wp_ajax_nopriv_login_check', 'login_check_ajax_callback' );
// Ajax Callback 
function login_check_ajax_callback () {
    $data = array();
    if (filter_var($_POST['user_login'], FILTER_VALIDATE_EMAIL)) {
        if (email_exists( $_POST['user_login'] )){
            $check = wp_authenticate_email_password( NULL, $_POST['user_login'], $_POST['user_pass'] );
            if (is_wp_error( $check )) $data['error'] = 'Please enter a valid password';            
        } else {
           $data['error'] = 'Please enter a valid email address'; 
        }
    } else {
        if (username_exists( $_POST['user_login'] )){
            $check = wp_authenticate_username_password( NULL, $_POST['user_login'], $_POST['user_pass'] );
            if (is_wp_error( $check )) $data['error'] = 'Please enter a valid password';
        } else {
            $data['error'] = 'Please enter a valid login info';
        }        
    }
    header("Content-type: text/x-json");
    echo json_encode($data);
    exit;
}
add_action( 'wp_ajax_load_posts', 'load_posts_ajax_callback' );
add_action( 'wp_ajax_nopriv_load_posts', 'load_posts_ajax_callback' );
// Ajax Callback 
function load_posts_ajax_callback () {
	$post_type = $_POST['post_type'];
	$post_loaded = $_POST['post_loaded'];
    $data = array();
    $html = '';
    $data['count'] = $_POST['post_loaded'] + 2;
    $data['all_loaded'] = 0;
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );
    $data['total_post'] = $query->post_count;
    if ($data['total_post'] <= $data['count']) $data['all_loaded'] = 1;
    $n = 0;
    if ( $query->have_posts() ){
        while ( $query->have_posts() ) { 
            $query->the_post();
            $html .= '<div class="col-lg-6 mb-3">';
            	$html .= '<div class="position-relative post-'.get_the_ID().'">';
            		$html .= do_shortcode('[feature-image height=560 width=555]');
            		$html .= '<div class="con">';
            			$html .= '<div class="meta">';
            				$categories = get_the_category();
            				$x = 0;
            				if (@$categories) {
            					$html .= '<span class="category">';
            					foreach($categories as $category){
            						if ($x) $html .= ',';
            						$html .= $category->name;
            						$x++;
            					}
            					$html .= '</span> <i class="fa fa-circle"></i> ';
            				}
            				$html .= '<span class="date">'.get_the_time('d M Y').'</span>';
            			$html .= '</div>';
            			$html .= '<h3 class="header">'.get_the_title().'</h3>';
            		$html .= '</div>';
            		$html .= '<a href="'.get_the_permalink().'" class="hidden-link">Read More</a>';
            	$html .= '</div>';
            $html .= '</div>';
            $n++;
            if ($n >= $data['count']) break;
        }
    }
    header("Content-type: text/x-json");
    $data['html'] = $html;
    echo json_encode($data);
    exit; // required. to end AJAX request.
}



function load_events_callback(){
    $data = array();
    $html = '';
    $count = $_POST['loadedpost'] + 3;
    $data['count'] = $count;
    $data['all_loaded'] = 0;
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );
    $total_post = $query->post_count;
    $data['total_post'] = $total_post;

    if ($total_post <= $count) $data['all_loaded'] = 1;
    $n = 0;
    if ( $query->have_posts() ){
        while ( $query->have_posts() ) { 
            $query->the_post();
            $html .= '<div class="col-md-4 mb-3">';
                $html .= '<div class="event-unit h-100">';
                    $html .= do_shortcode( '[feature-image width=350 height=230]' );
                    $html .= '<div class="wrapper">';
                        $html .= '<h6 class="unit-title">'.get_the_title().'</h6>';
                        $html .= '<div class="time"><i class="fa fa-clock-o"></i> '. get_post_meta( get_the_ID(), '_purnava_event_date', true ).' at '. get_post_meta( get_the_ID(), '_purnava_event_time', true ).'</div>';
                        $html .= '<div class="location"><i class="fa fa-map-marker"></i> '.get_post_meta( get_the_ID(), '_purnava_event_location', true ).'</div>';
                        $html .= '<a href="'.get_the_permalink().'" class="event-link">View Details <i class="fa fa-long-arrow-right"></i></a>';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
            $n++;
            if ($n >= $count) break;
        }        
    }
    header("Content-type: text/x-json");
    $data['html'] = $html;
    echo json_encode($data);
    // echo $html;

    die();
}
add_action( 'wp_ajax_load_events','load_events_callback' );
add_action( 'wp_ajax_nopriv_load_events','load_events_callback' );

function load_address_callback(){
    //echo 'Done';
    $id = $_POST['id'];
    $customer_id = get_current_user_id();
    $address = get_user_meta( $customer_id, 'mos_user_address', true );
    header("Content-type: text/x-json");
    echo json_encode($address[$id]);
    die();
}
add_action( 'wp_ajax_load_address','load_address_callback' );
add_action( 'wp_ajax_nopriv_load_address','load_address_callback' );

function check_password_callback(){
    $data = array();
    $pass = $_POST['password_current'];
    $pass_1 = $_POST['password_1'];
    $pass_2 = $_POST['password_2'];
    $user = wp_get_current_user();
    if (!wp_check_password( $pass, $user->data->user_pass, $user->ID )){
        $data['type'] = 'danger';
        $data['msg'] = 'Please check your current Password.';
    } else if (!$pass_1 OR $pass_1 != $pass_2) {
        $data['type'] = 'danger';
        $data['msg'] = 'Passwords dosen\'t matched.';
    } else {
        wp_set_password( $pass_1, $user->ID );
        $data['type'] = 'success';
        $data['msg'] = 'Password has been changed.';
    }
    header("Content-type: text/x-json");
    echo json_encode($data);
    die();
}
add_action( 'wp_ajax_check_password','check_password_callback' );
add_action( 'wp_ajax_nopriv_check_password','check_password_callback' );

