<?php
// remove the action 
// remove_action( 'woocommerce_account_content', 'woocommerce_account_content' );
// add_filter( 'woocommerce_show_page_title', 'mos_hide_shop_page_title' ); 
function mos_hide_shop_page_title( $title ) {
   if ( is_shop() ) $title = false;
   return $title;
}


// add_filter( 'woocommerce_show_page_title', 'mos_hide_cat_page_title' ); 
function mos_hide_cat_page_title( $title ) {
   if ( is_product_category() ) $title = false;
   return $title;
}

add_filter( 'woocommerce_show_page_title', '__return_null' );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 30 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 29 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 31 );

add_action( 'woocommerce_before_single_product_summary', 'back_to_shop_func', 11 );
function back_to_shop_func(){
    echo '<div class="back-to-shop"><a href="'.get_the_permalink(get_option( 'woocommerce_shop_page_id' )).'"><i class="fa fa-angle-left"></i> Back</a></div>';
}

add_action( 'woocommerce_single_product_summary', 'custom_hot_wishlist_func', 1 );
function custom_hot_wishlist_func(){
    global $product;
    echo '<div class="hot-wishlist row"><div class="col"><div class="badge-con"><span class="badge badge-pill badge-warning badge-product">HOT</span></div></div><div class="col text-right"><a rel="nofollow" href="?add_to_wishlist='.$product->get_id().'" data-quantity="1" data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" class="wishlist-button"><i class="fa fa-heart-o"></i></a></div></div>';
}

add_action( 'woocommerce_single_product_summary', 'custom_add_to_cart_func', 30 );
function custom_add_to_cart_func(){
    global $product;
    echo '<div class="cart-wishlist"><a rel="nofollow" href="?add-to-cart='.$product->get_id().'" data-quantity="1" data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" class="btn btn-primary text-white rounded-0 mr-1 cart-button">Add to Cart</a><a rel="nofollow" href="?add_to_wishlist='.$product->get_id().'" data-quantity="1" data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" class="btn btn-outline-primary rounded-0 wishlist-button">Add to Wishlist</a></div>';
    echo '<div class="contact-info">Need more information about this Product? <a href="#">Contact With Us</a></div>';
}

add_action( 'woocommerce_single_product_summary', 'product_off_func' );
function product_off_func(){    
    global $product;
    echo '<div class="product-off">';
    if ($product->get_sale_price()){
        $sell_price = $product->get_sale_price();
        $price = $product->get_regular_price();
        echo '<span class="number">';
        // echo number_format((100 * ($price-$sale_price))/$price, 2);
        echo number_format((100 * ($price - $sell_price)/$price),2);
        echo ' % Off';
        echo '</span>';
    }
    echo ' ( Additional tax may apply, charged at checkout )';
    echo '</div>';
}

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_shop_loop_item_title_func', 1 );
function woocommerce_shop_loop_item_title_func(){
	global $product;
	echo '<div class="loop-title-wrapper position-relative">';

    echo '<div class="custom-button-wrapper smooth">';
    echo '<a rel="nofollow" href="?add-to-cart='.$product->get_id().'" data-quantity="1" data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" class="btn btn-primary text-white cart-button">Add to Cart</a>';
    echo '<a rel="nofollow" href="?add_to_wishlist='.$product->get_id().'" data-quantity="1" data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" class="btn btn-outline-primary wishlist-button">Add to Wishlist</a>';
    echo '</div><!--custom-button-wrapper-->';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_func', 999 );
function woocommerce_after_shop_loop_item_title_func(){
	echo '</div><!--loop-title-wrapper-->';
}
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 2 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );


add_action( 'action_avobe_page_titile', 'category_banner_image_func', 10);
function category_banner_image_func(){
	if ( is_product_category() ){
		$term_id = get_queried_object_id();
		$image = get_term_meta($term_id, 'mos_poduct_cat_img', true);
        if ($image) echo '<img class="img-fluid w-100" src="'.$image.'" alt="'.single_term_title(false,false).'">';
	}
}

/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;
}
/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Remove the breadcrumbs 
 */
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'BDT': $currency_symbol = 'Tk. '; break;
     }
     return $currency_symbol;
}

// add_action( 'init', 'add_to_wishlist_func' );
function add_to_wishlist_func(){
    if (@$_GET['add_to_wishlist']){
        $product_id = $_GET['add_to_wishlist'];        
        $cookie_name = 'wishlist_products';
        $cookie_value = $_COOKIE[$cookie_name];
        if(!isset($_COOKIE[$cookie_name])) {
            $cookie_value = $product_id;
        } else {
            $prev = explode(',', $_COOKIE[$cookie_name]);
            if (!in_array($product_id, $prev))
            $cookie_value = $_COOKIE[$cookie_name] . ',' . $product_id;
        }
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");       
    }
}
// add_action( 'init', 'remove_from_wishlist_func' );
function remove_from_wishlist_func(){
    if (@$_GET['remove-from-wishlist']){
        $product_id = $_GET['remove-from-wishlist'];    
        $cookie_name = 'wishlist_products';
        $cookie_value = $_COOKIE[$cookie_name]; 
        if(isset($_COOKIE[$cookie_name])) {
            $prev = explode(',', $_COOKIE[$cookie_name]);
            if (in_array($product_id, $prev)){
                $new = array_diff( $prev, [$product_id] );
                $cookie_value = implode(',', $new);
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
            }
        }       
    }
}

// Add Category Field
//Product Cat Create page
function wh_taxonomy_add_new_meta_field() {
    ?>

    <div class="form-field">
        <label for="mos_poduct_cat_img"><?php _e('Banner Image', 'wh'); ?></label>
        <input type="text" class="mos_poduct_cat_img" name="mos_poduct_cat_img" id="mos_poduct_cat_img">
        <button type="button" class="button button-primary add-category-banner">Add Banner Image</button>
        <!-- <p class="description"><?php // _e('Enter a meta title, <= 60 character', 'wh'); ?></p> -->
    </div>
    <!-- <div class="form-field">
        <label for="wh_meta_desc"><?php // _e('Meta Description', 'wh'); ?></label>
        <textarea name="wh_meta_desc" id="wh_meta_desc"></textarea>
        <p class="description"><?php // _e('Enter a meta description, <= 160 character', 'wh'); ?></p>
    </div> -->
    <?php
}

//Product Cat Edit page
function wh_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $mos_poduct_cat_img = get_term_meta($term_id, 'mos_poduct_cat_img', true);
    $wh_meta_desc = get_term_meta($term_id, 'wh_meta_desc', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="mos_poduct_cat_img"><?php _e('Banner Image', 'wh'); ?></label></th>
        <td>
            <input type="text" class="mos_poduct_cat_img" name="mos_poduct_cat_img" id="mos_poduct_cat_img" value="<?php echo esc_attr($mos_poduct_cat_img) ? esc_attr($mos_poduct_cat_img) : ''; ?>">
            <button type="button" class="button button-primary add-category-banner">Add Banner Image</button>
            <!-- <p class="description"><?php // _e('Enter a meta title, <= 60 character', 'wh'); ?></p> -->
        </td>
    </tr>
    <!-- <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_desc"><?php // _e('Meta Description', 'wh'); ?></label></th>
        <td>
            <textarea name="wh_meta_desc" id="wh_meta_desc"><?php // echo esc_attr($wh_meta_desc) ? esc_attr($wh_meta_desc) : ''; ?></textarea>
            <p class="description"><?php // _e('Enter a meta description', 'wh'); ?></p>
        </td>
    </tr> -->
    <?php
}

add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);

// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id) {

    $mos_poduct_cat_img = filter_input(INPUT_POST, 'mos_poduct_cat_img');
    // $wh_meta_desc = filter_input(INPUT_POST, 'wh_meta_desc');

    update_term_meta($term_id, 'mos_poduct_cat_img', $mos_poduct_cat_img);
    // update_term_meta($term_id, 'wh_meta_desc', $wh_meta_desc);
}

add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);






  
// ------------------
// 1. Register new endpoint to use for My Account page
// Note: Resave Permalinks or it will give 404 error
  
function forclient_add_change_password_endpoint() {
    add_rewrite_endpoint( 'change-password', EP_ROOT | EP_PAGES );
}
  
add_action( 'init', 'forclient_add_change_password_endpoint' );
  
  
// ------------------
// 2. Add new query var
  
function forclient_change_password_query_vars( $vars ) {
    $vars[] = 'change-password';
    return $vars;
}
  
add_filter( 'query_vars', 'forclient_change_password_query_vars', 0 );
  
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function forclient_add_change_password_link_my_account( $items ) {
    $items['change-password'] = 'Change Password';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'forclient_add_change_password_link_my_account' );
  
  
// ------------------
// 4. Add content to the new endpoint
  
function forclient_change_password_content() {
    $current_user = wp_get_current_user();
    echo '<div class="text-center"><h4 class="account-title">Change Password</h4></div>';
    echo '<form class="mos-change-password-form" action="" method="post">';
    echo '<div class="form-group"><input type="password" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="password_current" id="password_current" placeholder="Current Password"></div>';
    echo '<div class="form-group"><input type="password" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="password_1" id="password_1" placeholder="New Password"></div>';
    echo '<div class="form-group"><input type="password" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="password_2" id="password_2" placeholder="Retype New Password"></div>';

    echo '<div class="form-row">      
        <div class="col"><button type="button" class="btn btn-block btn-primary rounded-0" name="change_account_password" id="change_account_password" value="Save changes">Save</button></div><div class="col"><button type="reset" class="btn btn-block btn-secondary rounded-0">Cancel</button></div></div>';
    echo '</form>';
	// echo do_shortcode( ' /* your shortcode here */ ' );
}
  
add_action( 'woocommerce_account_change-password_endpoint', 'forclient_change_password_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format



/*Remove and reorder*/
function misha_remove_my_account_links( $menu_links ){
 
	unset( $menu_links['edit-address'] ); // Addresses 
	// unset( $menu_links['dashboard'] ); // Remove Dashboard
	unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	// unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	// unset( $menu_links['edit-account'] ); // Remove Account details tab
	unset( $menu_links['customer-logout'] ); // Remove Logout link
 
	return $menu_links;
 
}
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );




add_filter ( 'woocommerce_account_menu_items', 'forclient_logout_link' );
function forclient_logout_link( $menu_links ){
 
	// we will hook "custom-logout" later
	$new = array( 'custom-logout' => 'Logout' );
 
	// or in case you need 2 links
	// $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );
 
	// array_slice() is good when you want to add an element between the other ones
	$menu_links = array_slice( $menu_links, 0, 1, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );
 
 
	return $menu_links;
 
 
}
 
add_filter( 'woocommerce_get_endpoint_url', 'forclient_logout_endpoint', 10, 4 );
function forclient_logout_endpoint( $url, $endpoint, $value, $permalink ){ 
	if( $endpoint === 'custom-logout' ) {
		$url = wp_logout_url( home_url('log-in') ); 
	}
	return $url;
 
}


function custom_my_account_menu_items( $items ) {
    $items = array(
        'dashboard'         => __( 'Account Information', 'woocommerce' ),
        'edit-address'      => __( 'Address Book', 'woocommerce' ),
        'orders'            => __( 'Orders History', 'woocommerce' ),
        'change-password'            => __( 'Change Password', 'woocommerce' ),
        // 'edit-account'      => __( 'Account Edit', 'woocommerce' ),
        // 'downloads'       => __( 'Downloads', 'woocommerce' ),
        // 'payment-methods'   => __( 'Payment Methods', 'woocommerce' ),
        'custom-logout'   => __( 'Logout', 'woocommerce' ),
    );

    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );


// Add the custom field "phone"
add_action( 'woocommerce_edit_account_form', 'add_phone_edit_account_form' );
function add_phone_edit_account_form() {
    $user = wp_get_current_user();
    ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_phone"><?php _e( 'Favorite color', 'woocommerce' ); ?></label>
        <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="account_phone" id="account_phone" value="<?php echo esc_attr( $user->phone ); ?>" />
    </p>
    <?php
}

// Save the custom field 'favorite_color' 
add_action( 'woocommerce_save_account_details', 'save_phone_account_details', 12, 1 );
function save_phone_account_details( $user_id ) {
    // For Favorite color
    if( isset( $_POST['account_phone'] ) )
        update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST['account_phone'] ) );
}

// Add the custom field "image"
add_action( 'woocommerce_edit_account_form', 'add_image_edit_account_form' );
function add_image_edit_account_form() {
    $user = wp_get_current_user();
    ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_image"><?php _e( 'Favorite color', 'woocommerce' ); ?></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_image" id="account_image" value="<?php echo esc_attr( $user->image ); ?>" />
    </p>
    <?php
}

// Save the custom field 'favorite_color' 
add_action( 'woocommerce_save_account_details', 'save_image_account_details', 12, 1 );
function save_image_account_details( $user_id ) {
    // For Favorite color
    if( isset( $_POST['account_image'] ) )
        update_user_meta( $user_id, 'image', sanitize_text_field( $_POST['account_image'] ) );
    if ($_POST['action'] == 'save_account_details' AND $_FILES){
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $attachment_id = media_handle_upload( 'account_image', 0 );
        if ( !is_wp_error( $attachment_id ) ) {
            //var_dump($attachment_id);
            $img = aq_resize(wp_get_attachment_url( $attachment_id ),80,80,true);
            update_user_meta( $user_id, 'image', $img );
        }
    }
}

add_filter( 'manage_edit-shop_order_columns', 'add_payment_method_column', 20 );
function add_payment_method_column( $columns ) {
   $new_columns = array();
   foreach ( $columns as $column_name => $column_info ) {
       $new_columns[ $column_name ] = $column_info;
       if ( 'order_total' === $column_name ) {
           $new_columns['order_payment'] = __( 'Payment Method', 'my-textdomain' );
       }
   }
   return $new_columns;
}
add_action( 'manage_shop_order_posts_custom_column', 'add_payment_method_column_content' );
function add_payment_method_column_content( $column ) {
   global $post;
   if ( 'order_payment' === $column ) {
       $order = wc_get_order( $post->ID );
       echo $order->payment_method_title;
   }
}

/**
*  Add custom handling fee to an order 
*/
function pt_add_handling_fee() {
    global $woocommerce;
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    if ($woocommerce->cart->subtotal>=300){
        $fee = 0.00;
    } else {
        $fee = 30.00;
    }
    $title = 'Delivery Charge';
    $woocommerce->cart->add_fee( $title, $fee, TRUE, 'standard' );
}
 
// Action -> Add custom handling fee to an order
add_action( 'woocommerce_cart_calculate_fees', 'pt_add_handling_fee' );


/* WooCommerce: The Code Below Removes Checkout Fields */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    $fields['billing_first_name']['label'] = 'Full name';
    // unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    // unset($fields['billing']['billing_address_1']);
    // unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    // unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    // unset($fields['billing']['billing_state']);
    // unset($fields['billing']['billing_phone']);
    // unset($fields['order']['order_comments']);
    // unset($fields['billing']['billing_email']);
    // unset($fields['account']['account_username']);
    // unset($fields['account']['account_password']);
    // unset($fields['account']['account_password-2']);
    return $fields;
}

add_action('woocommerce_checkout_order_processed', 'action_checkout_order_processed', 10, 1);
function action_checkout_order_processed( $order_id ) {
    // get an instance of the order object
    // $order = wc_get_order( $order_id );
    $order = new WC_Order($order_id);
    $billing_phone = $order->billing_phone;

    $user = "purnava";
    $pass = "purnava@123";
    $sid = "ePurnava"; 
    $url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
    $param="user=$user&pass=$pass&sms[0][0]= 880XXXXXXXXXX &sms[0][1]=".urlencode("Test SMS 1")."&sms[0][2]=123456789&sms[1][0]= 8801670058131 &sms[1][1]=".urlencode("Your submitted order (ID#100006552) is now in Pending status. Thank You. @PURNAVA")."&sms[1][2]=123456790&sid=$sid";
    $crl = curl_init();
    curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
    curl_setopt($crl,CURLOPT_URL,$url);
    curl_setopt($crl,CURLOPT_HEADER,0);
    curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($crl,CURLOPT_POST,1);
    curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
    $response = curl_exec($crl);
    curl_close($crl);
}

add_action('woocommerce_checkout_order_processed', 'action_checkout_admin_mailing', 11, 1);
function action_checkout_admin_mailing($order_id){
    $order = new WC_Order($order_id);
    // $to = 'mostak.apu@gmail.com';
    $to = 'sales@purnava.com';
    $subject = 'New order has been placed.';
    $body = '#'.$order_id .' has been placed.';
    $headers = array('Content-Type: text/html; charset=UTF-8');
     
    wp_mail( $to, $subject, $body, $headers );
}
