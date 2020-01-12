<?php
function admin_shortcodes_page(){
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
    add_menu_page( 
        __( 'Theme Short Codes', 'textdomain' ),
        'Short Codes',
        'manage_options',
        'shortcodes',
        'shortcodes_page',
        'dashicons-book-alt',
        3
    ); 
}
add_action( 'admin_menu', 'admin_shortcodes_page' );
function shortcodes_page(){
	?>
	<div class="wrap">
		<h1>Theme Short Codes</h1>
		<ol>
			<li>[site-identity class='' container_class=''] <span class="sdetagils">displays site identity according to theme option</span></li>
			<li>[site-name link='0'] <span class="sdetagils">displays site name with/without site url</span></li>
			<li>[copyright-symbol] <span class="sdetagils">displays copyright symbol</span></li>
			<li>[this-year] <span class="sdetagils">displays 4 digit current year</span></li>
			<li>[email offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays email from theme option</span></li>
			<li>[phone offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays phone from theme option</span></li>
			<li>[fax offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays fax from theme option</span></li>
			<li>[address offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays address from theme option</span></li>
			<li>[business-hours] <span class="sdetagils">displays business hours from theme option</span></li>
			<li>[social-menu display='inline/block' title='0/1'] <span class="sdetagils">displays social media from theme option</span></li>		
			<li>[theme-credit name='' url='0/1'] <span class="sdetagils">displays theme credit</span></li>		
			<li>[home-url slug=''] <span class="sdetagils">displays home url</span></li>	
			<li>[company-icon width='' height='' name=''] <span class="sdetagils">Company Icon</span></li>
			<li>[feature-image height='' width=''] <span class="sdetagils">displays feature image of post</span></li>		
			<li>[product-search] <span class="sdetagils">displays product search form</span></li>
			<li>[address-form] <span class="sdetagils">displays adddress form search form</span></li>
		</ol>
	</div>
	<?php
}
function site_identity_func( $atts = array(), $content = null ) {
	global $purnava_options;
	$logo_url = ($purnava_options['logo']['url']) ? $purnava_options['logo']['url'] : get_template_directory_uri(). '/images/logo.png';
	$logo_option = $purnava_options['logo-option'];
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'container_class' => ''
	), $atts, 'site-identity' ); 
	
	
	$html .= '<div class="logo-wrapper '.$atts['container_class'].'">';
		if($logo_option == 'logo') :
			$html .= '<a class="logo '.$atts['class'].'" href="'.home_url().'">';
			list($width, $height) = getimagesize($logo_url);
			$html .= '<img class="img-responsive img-fluid" src="'.$logo_url.'" alt="'.get_bloginfo('name').' - Logo" width="'.$width.'" height="'.$height.'">';
			$html .= '</a>';
		else :
			$html .= '<div class="text-center '.$atts['class'].'">';
				$html .= '<h1 class="site-title"><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>';
				$html .= '<p class="site-description">'.get_bloginfo( 'description' ).'</p>';
			$html .= '</div>'; 
		endif;
	$html .= '</div>'; 
		
	return $html;
}
add_shortcode( 'site-identity', 'site_identity_func' );

function site_name_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'link' => 0,
	), $atts, 'site-name' );
	if ($atts['link']) $html .=	'<a href="'.esc_url( home_url( '/' ) ).'">';
	$html .= get_bloginfo('name');
	if ($atts['link']) $html .=	'</a>';
	return $html;
}
add_shortcode( 'site-name', 'site_name_func' );
function copyright_symbol_func() {
	return '&copy;';
}
add_shortcode( 'copyright-symbol', 'copyright_symbol_func' );
function this_year_func() {
	return date('Y');
}
add_shortcode( 'this-year', 'this_year_func' );
function email_func( $atts = array(), $content = '' ) {	
	global $purnava_options;
	$contact_email = $purnava_options['contact-email'];
	$html = '';	
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', ',
	), $atts, 'email' );
	$n = 1;

	$html .= '<span class="email-wrap">';
	if ($atts['index']) :
		$i = $atts['index'] - 1;
		$html .= '<span class="email">';
			$html .= '<a class="mailToShow" href="mailto:'.$contact_email[$i].'">'.$contact_email[$i].'</a>';
		$html .= '</span>';	
	else :
		foreach ($contact_email as $email) :
			if ($n > $atts['offset']) :
				$html .= '<span class="email">';
					$html .= '<a class="mailToShow" href="mailto:'.$email.'">'.$email.'</a>';
				$html .= '</span>';
				$html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;
}
add_shortcode( 'email', 'email_func' );

function phone_func( $atts = array(), $content = '' ) {
    global $purnava_options;
    $html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', '
	), $atts, 'phone' );
	$n = 1; 
	$html .= '<span class="phone-number-wrap">';
	if ($atts['index']) :
		$i = $atts['index'] - 1;
	    $html .= '<span class="phone-number">';
	    $html .= '<a class="phoneToShow" href="tel:';
	    $html .= preg_replace('/[^0-9]/', '', $purnava_options['contact-phone'][$i]);
	    $html .= '" >';
	    $html .= $purnava_options['contact-phone'][$i];  
	    $html .= '</a>';
	    $html .= '</span>';		
	else :
		foreach ($purnava_options['contact-phone'] as $phone) :
			if ($n > $atts['offset']) :
			    $html .= '<span class="phone-number">';
			    $html .= '<a class="phoneToShow" href="tel:';
			    $html .= preg_replace('/[^0-9]/', '', $phone);
			    $html .= '" >';
			    $html .= $phone;  
			    $html .= '</a>';
			    $html .= '</span>';
			    $html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;
}
add_shortcode( 'phone', 'phone_func' );

function fax_func( $atts = array(), $content = '' ) {
    global $purnava_options;
    $html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', '
	), $atts, 'fax' );
	$n = 1; 
	$html .= '<span class="fax-number-wrap">';
	if ($atts['index']) :
		$i = $atts['index'] - 1;
	    $html .= '<span class="fax-number">';
	    $html .= '<a class="faxToShow" href="tel:';
	    $html .= preg_replace('/[^0-9]/', '', $purnava_options['contact-fax'][$i]);
	    $html .= '" >';
	    $html .= $purnava_options['contact-fax'][$i];  
	    $html .= '</a>';
	    $html .= '</span>';		
	else :
		foreach ($purnava_options['contact-fax'] as $fax) :
			if ($n > $atts['offset']) :
			    $html .= '<span class="fax-number">';
			    $html .= '<a class="faxToShow" href="tel:';
			    $html .= preg_replace('/[^0-9]/', '', $fax);
			    $html .= '" >';
			    $html .= $fax;  
			    $html .= '</a>';
			    $html .= '</span>';
			    $html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;
}
add_shortcode( 'fax', 'fax_func' );
function address_func( $atts = array(), $content = '' ) {
    global $purnava_options;
    $html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', '
	), $atts, 'address' );
	$n = 1; 
	$html .= '<span class="address-wrap">';	
	if ($atts['index']) :
		$i = $atts['index'] - 1;
	    $html .= '<span class="address address-'.$n.'">';
	    $html .= '<span class="address-title">'.$purnava_options['contact-address'][$i]['title'].'</span>';
		if ($purnava_options['contact-address'][$i]['map_link']) :
			$html .= '<a class="address-details" href="'.$purnava_options['contact-address'][$i]['map_link'].'" target="_blank">'.$purnava_options['contact-address'][$i]['description'].'</a>';
		else :
			$html .= '<span  class="address-details">'.$purnava_options['contact-address'][$i]['description'].'</span>';
		endif;
	    $html .= '</span>';
	else :
		foreach ($purnava_options['contact-address'] as $address) :
			if ($n > $atts['offset']) :
			    $html .= '<span class="address address-'.$n.'">';
				$html .= '<span class="address-title">'.$address['title'].'</span>';
				if ($address['map_link']) :
					$html .= '<a class="address-details" href="'.$address['map_link'].'" target="_blank">'.$address['description'].'</a>';
				else :
					$html .= '<span  class="address-details">'.$address['description'].'</span>';
				endif;
			    $html .= '</span>';
			    $html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;	    
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;

	// do shortcode actions here
}
add_shortcode( 'address', 'address_func' );
function business_hours_func( $atts = array(), $content = '' ) {
    global $purnava_options;
    $html = '';
    $html .= '<div class="business-hour-wrapper">'; 
    $html .= '<ul class="business-hour">'; 
	foreach ($purnava_options['contact-hour'] as $hour) :
    $html .= '<li>' . $hour . '</li>';
	endforeach;
    $html .= '</ul>'; 
    $html .= '</div>'; 

    return $html;
}
add_shortcode( 'business-hours', 'business_hours_func' );
function social_menu_fnc( $atts = array(), $content = '' ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
		$alt_tag = mos_alt_generator(get_the_ID());
	} 
	global $purnava_options;
	$html = '';
	$contact_social = $purnava_options['contact-social'];
	$contact_address = $purnava_options['contact-address'];
	$atts = shortcode_atts( array(
		'display' => 'inline',
		'title' => 0,
	), $atts, 'social-menu' );
	if ($atts['display'] == 'inline') $display = 'list-inline';
	else  $display = 'list-unstyled';
	$html .= '<ul class="'.$display.' social-menu">';
	foreach ($contact_social as $social) :	
		if ($social['link_url'] AND $social['basic_icon']) :
			$str = '';
			$basic_icon = do_shortcode(mos_home_url_replace($social['basic_icon']));
			if ($social['svg_icon']) {
				$str = '<span class="social-svg">'.$social['svg_icon'].'</span>';
			}
			else if (filter_var($basic_icon, FILTER_VALIDATE_URL)) {
				//$basic_icon = do_shortcode();
				list($width, $height) = getimagesize($basic_icon);
				$str = '<span class="social-img"><img src="'.$basic_icon.'" alt="'.$alt_tag['social'] . $social['title'].'" width="'.$width.'" height="'.$height.'"></span>';
				if ($social['hover_icon']) {
					//$hover_icon = do_shortcode(str_replace('{{home_url}}', home_url(), $social['hover_icon']));
					$hover_icon = do_shortcode(mos_home_url_replace($social['hover_icon']));
					list($hwidth, $hheight) = getimagesize($hover_icon);
					$str .= '<span class="social-img-hover"><img src="'.$hover_icon.'" alt="'.$alt_tag['social'] . $social['title'].'" width="'.$hwidth.'" height="'.$hheight.'"></span>'; //hover_icon
				}
			}
			else { 
				$str = '<span class="social-icon"><i class="'.$social['basic_icon'].'"></i></span>';
				if ($social['hover_icon'])
					$str .= '<span class="social-icon-hover"><i class="'.$social['hover_icon'].'"></i></span>';
			}
			$html .= '<li class="social-list '.strtolower(preg_replace('/\s+/', '_', $social['title']));
			if ($atts['display'] == 'inline') $html .= ' list-inline-item';
			$html .= '"><a href="'.esc_url( $social['link_url'] ).'"';
			if ($social['target'])
				$html .= ' target="_blank"';
			$html .= '>' . $str;
			if ($atts['title']) $html .= '<span class="social-title">' . $social['title'] .'</span>';
			$html .= '</a></li>';
		endif;	
	endforeach;

	$html .= '</ul>';
	return $html;
}
add_shortcode( 'social-menu', 'social_menu_fnc' );
function theme_credit_func( $atts = array(), $content = '' ) {
	$html = "";
	$atts = shortcode_atts( array(
		'name' => 'Md. Mostak Shahid',
		'url' => 'http://mostak.belocal.oday',
	), $atts, 'theme-credit' );

	return $html = '<a href="'.$atts["url"].'" target="_blank" class="theme-credit">'.$atts["name"].'</a>';
}
add_shortcode( 'theme-credit', 'theme_credit_func' );

function home_url_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'slug' => '',
	), $atts, 'home-url' );
	if ($atts['slug'])
		return home_url("/".$atts['slug']."/");
	else 
		return home_url();
}
add_shortcode( 'home-url', 'home_url_func' );
function feature_image_func( $atts = array(), $content = '' ) {
	global $mosacademy_options;
	$html = '';
	$img = '';
	$atts = shortcode_atts( array(
		'height' => '',
		'width' => '',
	), $atts, 'feature-image' );

	if (has_post_thumbnail()) $img = get_the_post_thumbnail_url();	
	elseif(@$mosacademy_options['blog-archive-default']['id']) $img = wp_get_attachment_url( $mosacademy_options['blog-archive-default']['id'] ); 
	if ($img){
		if ($atts['wrapper_element']) $html .= '>';
		list($width, $height) = getimagesize($img);
		if ($atts['width'] AND $atts['height']) :
			if ($width > $atts['width'] AND $height > $atts['height']) $img_url = aq_resize($img, $atts['width'], $atts['height'], true);
			else $img_url = $img;
		elseif ($atts['width']) :
			if ($width > $atts['width']) $img_url = aq_resize($img, $atts['width']);
			else $img_url = $img;
		else : 
			$img_url = $img;
		endif;
		list($fwidth, $fheight) = getimagesize($img_url);
		$html .= '<img class="img-responsive img-fluid img-featured" src="'.$img_url.'" alt="'.get_the_title().'" width="'.$fwidth.'" height="'.$fheight.'" />';
		
	}
	return $html;
}
add_shortcode( 'feature-image', 'feature_image_func' );
function company_icon_func( $atts = array(), $content = '' ) {
	$output = '';
	$atts = shortcode_atts( array(
		'width' => '41.398px',
		'height' => '30px',
		'name' => '',
	), $atts, 'company-icon' );
	if ($atts['name'] = 'ai')
		$output = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="'.$atts['width'].'" height="'.$atts['height'].'" viewBox="0 0 41.398 30" enable-background="new 0 0 41.398 30" xml:space="preserve">
			<path fill="#4D4D4F" d="M29.528,11.25c-0.343-1.331-0.862-2.589-1.534-3.749c-0.064-0.11-0.13-0.221-0.194-0.329 c-0.457-0.742-0.975-1.443-1.55-2.093c-0.376-0.427-0.775-0.833-1.196-1.211c-0.688-0.622-1.432-1.179-2.226-1.666 c-0.108-0.067-0.219-0.134-0.328-0.197c-0.601-0.346-1.227-0.653-1.875-0.913c-1.184-0.48-2.439-0.813-3.75-0.977 C16.26,0.04,15.636,0,15,0h-0.004c-0.634,0-1.26,0.04-1.872,0.116c-2.03,0.254-3.932,0.912-5.625,1.892 C5.743,3.022,4.211,4.384,2.999,6c-0.36,0.479-0.691,0.979-0.992,1.5c-0.671,1.16-1.191,2.417-1.534,3.749 c-0.158,0.61-0.277,1.236-0.356,1.876C0.04,13.74,0,14.364,0,15c0,0.636,0.04,1.262,0.116,1.876 c0.081,0.638,0.199,1.264,0.356,1.874c0.342,1.331,0.864,2.591,1.536,3.75C2.308,23.021,2.64,23.521,2.999,24 c1.213,1.616,2.745,2.979,4.5,3.992c1.693,0.98,3.595,1.639,5.625,1.893C13.734,29.96,14.356,30,14.988,30h0.008H15h0.004h0.01 c0.63,0,1.252-0.04,1.861-0.116c1.311-0.164,2.567-0.497,3.75-0.977v-8.946c-0.979,1.108-2.276,1.924-3.75,2.304 C16.276,22.418,15.648,22.5,15,22.5c-0.647,0-1.276-0.082-1.876-0.235c-1.971-0.509-3.629-1.796-4.621-3.515 c-0.337-0.581-0.597-1.209-0.768-1.874C7.582,16.278,7.499,15.648,7.499,15c0-0.647,0.083-1.276,0.236-1.875 c0.171-0.665,0.431-1.295,0.768-1.876c0.994-1.719,2.652-3.004,4.621-3.512c0.6-0.153,1.229-0.236,1.876-0.236 c0.648,0,1.276,0.083,1.875,0.236c1.475,0.38,2.772,1.195,3.75,2.303c0.246,0.278,0.473,0.575,0.673,0.888 c0.069,0.104,0.134,0.212,0.199,0.321c0.334,0.581,0.594,1.211,0.766,1.876C22.417,13.724,22.5,14.353,22.5,15v7.502 c0,1.689,0.559,3.245,1.5,4.499c0.344,0.459,0.74,0.874,1.177,1.242c1.3,1.093,2.974,1.753,4.803,1.757h0.011h0.008H30v-0.073 V15.004V15c0-0.636-0.04-1.26-0.116-1.875C29.805,12.486,29.685,11.86,29.528,11.25"/>
			<path fill="#034EA2" d="M37.649,7.5c2.07,0,3.749-1.679,3.749-3.75V0.075V0h-7.499v0.075V3.75C33.899,5.821,35.578,7.5,37.649,7.5z"/>
			<path fill="#034EA2" d="M33.899,11.25v11.104v0.002h0.002c-0.002,0.048-0.002,0.097-0.002,0.144v0.002 c0,1.688,0.558,3.245,1.501,4.497c0.342,0.459,0.737,0.876,1.177,1.244c1.3,1.093,2.971,1.753,4.8,1.757h0.012h0.008h0.002v-0.073 V11.25H33.899z"/>
		</svg>';
	return $output;
}
add_shortcode( 'company-icon', 'company_icon_func' );

function product_search_fnc( $atts = array(), $content = '' ) {
	$form = '';
	$form .= '<form role="search" method="get" class="woocommerce-product-search" action="'.esc_url( home_url() ).'">';
	$form .= '<div class="input-group">';
	//$form .= '<label class="screen-reader-text" for="s">Search for:</label>';
	$form .= '<input type="search" placeholder="Search Products" value="'.get_search_query().'" name="s" class="form-control" required>';
	$form .= '<span class="input-group-btn">';
	$form .= '<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>';
	$form .= '</span>';
	$form .= '</div>';
	$form .= '<input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;
}
add_shortcode( 'product-search', 'product_search_fnc' );

function wishlist_products_func( $atts = array(), $content = '' ) {
	$html = '';
	if(isset($_COOKIE['wishlist_products'])) {
		$ids = explode(',', $_COOKIE['wishlist_products']);
		if (@$ids){
			$html .= '<div class="row mos-wishlist-product">';
			foreach($ids as $post_id){				
        		$sale_price =  get_post_meta( $post_id, '_sale_price', true ); 
        		$dsale_price = wc_price($sale_price);
        		$price =  get_post_meta( $post_id, '_regular_price', true ); 
        		$dprice = wc_price($price);
				$html .= '<div class="col-md-4 mb-3 wishlist-wrapper">';
					$html .= '<div class="unit position-relative h-100">';
					if (has_post_thumbnail($post_id)){
						$html .= '<div class="product-image"><img class="img-fluid img-related-product w-100" src="'.get_the_post_thumbnail_url($post_id).'" alt="<'.get_the_title($post_id).'"></div>';
					}
						$html .= '<div class="product-info d-table w-100"><div class="product-title float-left">'.get_the_title($post_id).'</div><div class="product-remove float-right"><a class="remove-from-wishlist" href="?remove-from-wishlist='.$post_id.'" data-product_id="'.$post_id.'">Delete</a></div></div>';
						$html .= '<div class="product-price">';
						if ($sale_price){
							$html .= '<span class="price"><del>'.$dprice.'</del><ins>'.$dsale_price.'</ins></span>';
						} else {
							$html .= '<span class="price"><ins>'.$dprice.'</ins></span>';
						}
						$html .= '</div>';
						$html .= '<div class="add-to-cart-wrapper"><a rel="nofollow" href="?add-to-cart='.$post_id.'" class="btn btn-block btn-primary text-white rounded-0 wishlist-to-cart-button" data-product_id="'.$post_id.'">Add to Cart</a></div>';
					$html .= '</div>';
				$html .= '</div>';
			}
			$html .= '</div>';
		}
	}
	return $html;
}
add_shortcode( 'wishlist-products', 'wishlist_products_func' );

