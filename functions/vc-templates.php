<?php
/*for more details
https://kb.wpbakery.com/docs/inner-api/vc_map/
https://github.com/proteusthemes/visual-composer-elements
*/
/*function bartag_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'foo' => 'something',
		'color' => '#FFF'
	), $atts, 'bartag' );	
	return '<div style="color:'.$atts['color'].'" data-foo="'.$atts['foo'].'">'.$content.'</div>';
}
add_shortcode( 'bartag', 'bartag_func' );
add_action( 'vc_before_init', 'your_name_integrateWithVC' );
function your_name_integrateWithVC() {
	vc_map( array(
		"name" => __( "Bar tag test", "my-text-domain" ),
		"base" => 'bartag',
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"admin_label" => false,
				"heading" => __( "Text", "my-text-domain" ),
				"param_name" => "foo",
				"value" => __( "Default param value", "my-text-domain" ),
				"description" => __( "Description for foo param.", "my-text-domain" )
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __( "Text color", "my-text-domain" ),
				"param_name" => "color",
				"value" => '#FF0000', //Default Red color
				"description" => __( "Choose text color", "my-text-domain" )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Content", "my-text-domain" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "my-text-domain" ),
				"description" => __( "Enter your content.", "my-text-domain" )
			)
		)
	));
}*/
function mos_modal_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'embeded' => '',
		'embed-class' => 'embed-responsive-21by9',
		'btn-text' => 'Launch modal',
		'btn-class' => '',
		'icon_name' => '',
		'enable-header' => '',
		'header-title' => '',
		'id' => 'exampleModal',
		'extraclass' => '',
		'css' => '',
	), $atts, 'mos-modal' );
	$data = explode('{', $atts['css']);	
	$css_class = str_replace(".", "", $data[0]);
	$html .= '<div class="'.$css_class.'">';
		$html .= '<button type="button" class="'.$atts['btn-class'].'" data-toggle="modal" data-target="#'.$atts['id'].'">';
		if ($atts['icon_name']) $html .= '<i class="'.$atts['icon_name'].'"></i>';
			$html .=$atts['btn-text'].'</button>';
		$html .= '<div class="modal fade '.$atts['extraclass'].'" id="'.$atts['id'].'" tabindex="-1" role="dialog" aria-labelledby="'.$atts['id'].'Label" aria-hidden="true">';
			$html .= '<div class="modal-dialog modal-dialog-centered" role="document">';
				$html .= '<div class="modal-content">';
				
					if ($atts['enable-header']) :
						$html .= '<div class="modal-header">';
							$html .= '<h5 class="modal-title" id="exampleModalLabel">'.$atts['header-title'].$atts['enable-header'].'</h5>';
							$html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>';
						$html .= '</div>';
					endif;
					if ($atts['embeded']) :
						$html .= '<div class="embed-responsive '.$atts['embed-class'].'">';
							$html .= '<iframe class="embed-responsive-item" src="'.$atts['embeded'].'"></iframe>';
						$html .= '</div>';
					endif;
					if ($content) :
						$html .= '<div class="modal-body">';
							$html .= $content;
						$html .= '</div>';
					endif;
					// $html .= '<div class="modal-footer">
					// 	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					// 	<button type="button" class="btn btn-primary">Save changes</button>
					// </div>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'mos-modal', 'mos_modal_func' );
add_action( 'vc_before_init', 'mos_modal_vc' );
function mos_modal_vc() {
	vc_map( array(
		"name" => __( "Mos Modal", "my-text-domain" ),
		"base" => 'mos-modal',
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "textfield",
				"admin_label" => false,
				"heading" => __( "Enter the Url", "my-text-domain" ),
				"param_name" => "embeded",
                "description" => __("Please Enter the You-Tube or Vimeo Url.", "my-text-domain"),
			), 
			array(
				"type" => "dropdown",
				"admin_label" => false,
				"heading" => __( "Embeded Ratio", "my-text-domain" ),
				"param_name" => "embed-class",
				"value" => array(
					'21:9' => 'embed-responsive-21by9',
					'16:9' => 'embed-responsive-16by9',
					'4:3' => 'embed-responsive-4by3',
					'1:1' => 'embed-responsive-1by1',
				),
				// "std"			=> 'embed-responsive-16by9',
			),
	        array(
	            "type"			=> "textarea_html",
	            "admin_label" 	=> false,
	            "heading"		=> "Block content",
	            "param_name"	=> "content",
	            "std"			=> '',
            ),                                      
            array(
                "type" => "textfield",
	            "admin_label" 	=> true,
                "heading" => __("Trigger Text", "asvc"),
                "param_name" => "btn-text",
                "value" => "Launch modal",
                "description" => __("Enter the trigger text.", "my-text-domain"),
            ),                                   
            array(
                "type" => "textfield",
	            "admin_label" 	=> false,
                "heading" => __("Trigger Class", "asvc"),
                "param_name" => "btn-class",
                "value" => "",
                "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "my-text-domain"),
            ),
            array(
            	'type' => 'iconpicker',
            	'heading' => __( 'Icon', 'js_composer' ),
            	'param_name' => 'icon_name',
                // 'value' => 'fa fa-camera', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 100, // default 100, how many icons per/page to display, we use (big prime_slider) to display all icons in single page
                ),
                'description' => __( 'Select icon from library.', 'js_composer' ),
            ),
            array(
	            'type' => 'checkbox',
	            'heading' => __( 'Enable Header?', 'js_composer' ),
	            'param_name' => 'enable-header',
	            'description' => __( 'Enable to show modal header.', 'js_composer' ),
            ),
			array(
				"type" => "textfield",
				"admin_label" => false,
				"heading" => __( "Header Text", "my-text-domain" ),
				"param_name" => "header-title",
                "description" => __("Header Text.", "my-text-domain"),                
				'dependency' => array(
					'element' => 'enable-header',
					'value' => 'true',
				),
			), 
			array(
				"type" => "textfield",
				"admin_label" => true,
				"heading" => __( "Modal ID", "my-text-domain" ),
				"param_name" => "id",
				"value" => __( "exampleModal", "my-text-domain" ),
                "description" => __("Enter element ID (Note: make sure it is unique and valid according to <a href='https://www.w3schools.com/tags/att_global_id.asp' target='_blank'>w3c specification</a>).", "my-text-domain"),
			),                                        
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "asvc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "my-text-domain"),
            ), 
            // Design Options
            array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css' ),
	            'param_name' => 'css',
	            'group' => __( 'Design Options' ),
            )
		)
	));
}
function mos_embeded_carousel_shortcode($atts){
	$list = '';
	$atts = shortcode_atts( array(
		'data' => '',
	), $atts, 'mos-embedeb-carousel' );	
	$values = vc_param_group_parse_atts($atts['data']);

	$new_data_value = array();
	foreach($values as $data){
		$new_line = $data;
		$new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
		$new_line['url'] = isset($new_line['url']) ? $new_line['url'] : '';

		$new_data_value[] = $new_line;

	}

	$idd = 0;
	if ($new_data_value) :
		$list .= '<div class="slick-slider mos-embeded-slider">';
		foreach($new_data_value as $data):
			$idd++;
			$video = $data['url'];
			$list .=
			'<div class="position-relative unit unit-'.$idd.'">
				<img class="img-fluid img-embeded-banner w-100" src="'.aq_resize(wp_get_attachment_url($data['image']), 200, 150, true).'">
				<span class="videoicon"></span>
				<a class="hidden-link" href="'.$video.'" target="_blank">Read More</a> 
			</div>';
		endforeach;
		$list .= '</div>';
	endif;
	return $list;
	wp_reset_query();
}
add_shortcode('mos-embedeb-carousel', 'mos_embeded_carousel_shortcode');

add_action( 'vc_before_init', 'mos_embeded_carousel_vc' );
function mos_embeded_carousel_vc() {
	vc_map(array(
		'name' => 'Mos Embeded Carousel',
		'base' => 'mos-embedeb-carousel',
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
		'params' => array(
			array(
				'type' => 'param_group',
				'param_name' => 'data',
				'params' => array(
					array(
						'type' => 'attach_image',
						// 'name' => 'image',
						'heading' => __('Cover Image', 'rrf-mos'),
						'param_name' => 'image',
					),
					array(
						'type' => 'textfield',
						// 'name' => 'Content',
						'heading' => __('Embeded URL', 'rrf-mos'),
						'param_name' => 'url',
					)
				)

			),
		),

	));
}


function mos_accordion_shortcode($atts){
	$atts = shortcode_atts( array(
		'title' => '',
		'values' => '',
	), $atts, 'mos-accordion' );	

	$list = '<h4>'.$atts['title'].'</h4>';
	$values = vc_param_group_parse_atts($atts['values']);

	$new_accordion_value = array();
	foreach($values as $data){
		$new_line = $data;
		$new_line['label'] = isset($new_line['label']) ? $new_line['label'] : '';
		$new_line['excerpt'] = isset($new_line['excerpt']) ? $new_line['excerpt'] : '';
		$new_accordion_value[] = $new_line;
	}

	$idd = 0;
	foreach($new_accordion_value as $accordion):
		$idd++;
		$list .=
		'<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$idd.'">
						'.$accordion['label'].'
						<span class="fa fa-plus"></span>
					</a>
				</h4>
			</div>
			<div id="collapse'.$idd.'" class="panel-collapse collapse">
				<div class="panel-body">
					<p>'.$accordion['excerpt'].'</p>
				</div>
			</div>
		</div>';
	endforeach;
	return $list;
	wp_reset_query();
}
add_shortcode('mos-accordion', 'mos_accordion_shortcode');

add_action( 'vc_before_init', 'mos_accordion_vc' );
function mos_accordion_vc() {
	vc_map(array(
		'name' => 'Mos Accordions',
		'base' => 'mos-accordion',
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
		'params' => array(
			array(
				'type' => 'textfield',
				'name' => __('Title', 'rrf-mos'),
				'holder' => 'div',
				'heading' => __('Title', 'rrf-mos'),
				'param_name' => 'title',
			),
			array(
				'type' => 'param_group',
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'textfield',
						'name' => 'label',
						'heading' => __('Heading', 'rrf-mos'),
						'param_name' => 'label',
					),
					array(
						'type' => 'textarea',
						'name' => 'Content',
						'heading' => __('Content', 'rrf-mos'),
						'param_name' => 'excerpt',
					)
				)

			),
		),

	));
}

function custom_auth_func( $atts = array(), $content = '' ) {
	// $redirect_to = @$_GET['redirect_to'];
	$html = '';
	$atts = shortcode_atts( array(
		'form' => 'login',
		'login' => '#',
		'register' => '#',
		'forgot' => '#',
		'redirect' => admin_url(),
	), $atts, 'mos-auth' );	
	$login = $atts['login'];
	if (is_array(vc_build_link($login)))
		$login = vc_build_link($atts['login'])["url"];
	$register = $atts['register'];
	if (is_array(vc_build_link($register)))
		$register = vc_build_link($atts['register'])["url"];
	$forgot = $atts['forgot'];
	if (is_array(vc_build_link($forgot)))
		$forgot = vc_build_link($atts['forgot'])["url"];
	$redirect = $atts['redirect'];
	if (is_array(vc_build_link($redirect)))
		$redirect = vc_build_link($atts['redirect'])["url"];
	if (@$_GET['redirect_to'])
		$redirect = $_GET['redirect_to'];
	// $html .= $atts['form'];
	$html .= '<div class="row justify-content-md-center">';
		$html .= '<div class="col-md-5">';
			$html .= '<div class="auth-form-wrapper">';
			if ($atts['form'] == 'login'){
				$html .= '<h1>Log In</h1>';
				$html .= '<form class="mb30" name="loginform" id="mos-loginform" action="'.home_url().'/wp-login.php" method="post">';
					$html .= '<div class="form-group">';
				    	$html .= '<label for="user_login">Email/Phone Number</label>';
				    	$html .= '<input type="text" class="form-control mos-border-bottom rounded-0" name="log" id="user_login">';    
					$html .= '</div>';

					$html .= '<div class="form-group">';
					    $html .= '<label for="user_pass">Password</label>';
				    	$html .= '<div class="input-group">';
					    	$html .= '<input type="password" class="form-control mos-border-bottom rounded-0" name="pwd" id="user_pass">';   
					    	$html .= '<div class="input-group-append"><span class="input-group-text"><i class="fa fa-eye"></i></span></div>';    
				    	$html .= '</div>';
					$html .= '</div>';

					$html .= '<div class="form-row mb30">';
				    	$html .= '<div class="col">';
				    		$html .= '<input class="mr-1" type="checkbox" name="rememberme" id="rememberme" value="forever">';
							$html .= '<label class="form-check-label" for="rememberme"> Remember Me</label>';
				    	$html .= '</div>';
				    	$html .= '<div class="col text-right">';
				    		$html .= '<a href="'.$forgot.'">Forgot Your Password?</a>';
				    	$html .= '</div>';
				 	$html .= '</div>';
				 	$html .= '<button type="button" class="btn btn-block btn-primary rounded-0" name="wp-submit" id="wp-submit" value="Log In">Log In</button>';
				 	$html .= '<input type="hidden" name="redirect_to" value="'.$redirect.'">';
				 	$html .= '<input type="hidden" name="testcookie" value="1">';
				$html .= '</form>';
			}
			if ($atts['form'] == 'registration'){
				$html .= '<h1>Sign Up</h1>';
				$html .= '<form name="registerform" id="registerform" action="'.home_url().'/wp-login.php?action=register" method="post" novalidate="novalidate">';
					$html .= '<div class="form-group">';
				    	$html .= '<label for="first_name">First Name</label>';
				    	$html .= '<input type="text" class="form-control mos-border-bottom rounded-0" name="first_name" id="first_name">';    
					$html .= '</div>';
					$html .= '<div class="form-group">';
				    	$html .= '<label for="last_name">Last Name</label>';
				    	$html .= '<input type="text" class="form-control mos-border-bottom rounded-0" name="last_name" id="last_name">';    
					$html .= '</div>';
					$html .= '<div class="form-group">';
				    	$html .= '<label for="phone">Phone</label>';
				    	$html .= '<input type="tel" class="form-control mos-border-bottom rounded-0" name="phone" id="phone">';    
					$html .= '</div>';
					$html .= '<div class="form-group">';
				    	$html .= '<label for="email">Email</label>';
				    	$html .= '<input type="email" class="form-control mos-border-bottom rounded-0" name="email" id="email">';    
					$html .= '</div>';
					$html .= '<div class="form-group">';
					    $html .= '<label for="password">Password</label>';
				    	$html .= '<div class="input-group">';
					    	$html .= '<input type="password" class="form-control mos-border-bottom rounded-0" name="password" id="password">';    
					    	$html .= '<div class="input-group-append"><span class="input-group-text"><i class="fa fa-eye"></i></span></div>';    
				    	$html .= '</div>';
					$html .= '</div>';
					$html .= '<div class="form-group">';
					    $html .= '<label for="conpassword">Confirm Password</label>';
				    	$html .= '<div class="input-group">';
					    	$html .= '<input type="password" class="form-control mos-border-bottom rounded-0" name="conpassword" id="conpassword">';   
					    	$html .= '<div class="input-group-append"><span class="input-group-text"><i class="fa fa-eye"></i></span></div>';    
				    	$html .= '</div>';
					$html .= '</div>';
					$html .= '<button type="button" class="btn btn-block btn-primary rounded-0 mb30" name="wp-reg-submit" id="wp-reg-submit" value="Continue">Continue</button>';
			    	$html .= '<div class="form-group">';
			    		$html .= '<input class="mr-1" type="checkbox" name="tc_accepted" id="tc_accepted" value="forever">';
						$html .= '<label class="form-check-label" for="tc_accepted"> By Signing Up, you\'re confirming that you\'ve read our</label> <a href="#">Terms & Conditions and Privacy Policy</a>';
			    	$html .= '</div>';
				$html .= '</form>';

			}
			if ($atts['form'] == 'login' OR $atts['form'] == 'registration'){
				$html .= '<div class="text-center">';
					$html .= '<div class="or"><span>OR</span></div><div class="ligin-with">Login With</div>';
					$html .= do_shortcode('[miniorange_social_login theme="default"]');					
				$html .= '</div>';
			}
			if ($atts['form'] == 'login'){
				$html .= '<div class="text-center">New to Purnava? <a class="mos-auth-link" href="'.$register.'">Create a New Account</a></div>';
			}
			if ($atts['form'] == 'registration'){
				$html .= '<div class="text-center">Already Have An Account Purnava? <a class="mos-auth-link" href="'.$login.'">Login Now</a></div>';
			}
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'mos-auth', 'custom_auth_func' );

add_action( 'vc_before_init', 'custom_auth_vc' );
function custom_auth_vc() {
	vc_map( array(
		"name" => __( "Mos Authentication", "my-text-domain" ),
		"base" => "mos-auth",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "dropdown",
				"admin_label" => true,
				"heading" => __( "Form Type", "my-text-domain" ),
				"param_name" => "form",
				"value" => array(
					'Login Form' => 'login',
					'Registration Form' => 'registration',
					'Forgot Password Form' => 'forgot',
				),
			),
			array(
				"type" => "vc_link",
				"heading" => __( "Login Page", "my-text-domain" ),
				"param_name" => "login",
			),
			array(
				"type" => "vc_link",
				"heading" => __( "Register Page", "my-text-domain" ),
				"param_name" => "register",
			),
			array(
				"type" => "vc_link",
				"heading" => __( "Forgot Password Page", "my-text-domain" ),
				"param_name" => "forgot",
			),
			array(
				"type" => "vc_link",
				"heading" => __( "Login Redirect Page", "my-text-domain" ),
				"param_name" => "redirect",
			),
		)
	));
}

function mos_post_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'loadmore' => 'no',
		'carousel' => 'no',
	), $atts, 'mos-post' );	
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
	);
	$query = new WP_Query( $args );
	$total_post = $query->post_count;
	if ($atts['carousel'] == 'yes'){
		$wrapper_cls = 'slick-slider mos-post-slider';
		$container_cls = 'slick-slider-container';
	} else {
		$wrapper_cls = 'row';
		$container_cls = 'col-lg-6';		
	}
	$x = 0;
	if ( $query->have_posts() ){
		$html .= '<div  id="blogs" class="'.$wrapper_cls.'">';
		while ( $query->have_posts() ) { 
			$query->the_post();
			$html .= '<div class="'.$container_cls.' mb-3">';
				$html .= '<div class="position-relative post-'.get_the_ID().'">';
					$html .= do_shortcode( '[feature-image height=560 width=555]'  );
					$html .= '<div class="con">';
						$html .= '<div class="meta">';
							$categories = get_the_category();
							$n = 0;
							if (@$categories) {
								$html .= '<span class="category">';
								foreach($categories as $category){
									if ($n) echo ',';
									$html .= $category->name;
									$n++;
								}
								$html .= '</span> <i class="fa fa-circle"></i> ';
							}
							$html .= '<span class="date">'.get_the_time('d M Y').'</span>';
						$html .= '</div>';
						$html .= '<h3 class="header">'.get_the_title().$n.'</h3>';
					$html .= '</div>';
					$html .= '<a href="'.get_the_permalink().'" class="hidden-link">Read More</a>';
				$html .= '</div>';
			$html .= '</div>';
			$x++;
			if ($atts['carousel'] == 'no' AND $x>=2) break;
		}
		$html .= '</div>';

		if ($atts['loadmore'] == 'yes'){			
			$html .= '<input type="hidden" id="post_type" value="'.get_post_type().'">';
			$html .= '<input type="hidden" id="post_loaded" value="2">';
			$html .= '<div class="row justify-content-center"><div class="col-md-4"><button type="button" class="btn btn-block btn-primary rounded-0 load-posts">Load More</button></div></div>';
		}
	}
	return $html;
}
add_shortcode( 'mos-post', 'mos_post_func' );
add_action( 'vc_before_init', 'mos_post_vc' );
function mos_post_vc() {
	vc_map( array(
		"name" => __( "Mos Posts", "my-text-domain" ),
		"base" => "mos-post",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',				
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Show Load More", "my-text-domain" ),
				"param_name" => "loadmore",
				"value" => array(
					'Disable' => 'no',
					'Enable' => 'yes',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Like to enable Slider", "my-text-domain" ),
				"param_name" => "carousel",
				"value" => array(
					'Disable' => 'no',
					'Enable' => 'yes',
				),
			),
		)
	));
}

function mos_event_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'loadmore' => 'no',
		'carousel' => 'no',
		'posts_per_page'=>-1,
	), $atts, 'mos-event' );	
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => ($atts['posts_per_page'])?$atts['posts_per_page']:-1,
	);
	$query = new WP_Query( $args );
	$total_post = $query->post_count;
	if ($atts['carousel'] == 'yes'){
		$wrapper_cls = 'slick-slider mos-event-slider';
		$container_cls = 'slick-slider-container';
	} else {
		$wrapper_cls = 'row event-posts';
		$container_cls = 'col-md-4';		
	}
	$n = 0;
	if ( $query->have_posts() ){
		$html .= '<div class="'.$wrapper_cls.'">';
		while ( $query->have_posts() ) { 
			$query->the_post();
			$html .= '<div class="'.$container_cls.' mb-3">';
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
			if ($atts['loadmore'] == 'yes' AND $n>=3) break;
		}
		$html .= '</div>';

		if ($atts['loadmore'] == 'yes'){			
			$html .= '<input type="hidden" id="loadedpost" value="3">';
			$html .= '<div class="row justify-content-center"><div class="col-md-4"><button type="button" class="btn btn-block btn-primary rounded-0 load-event">Load More</button></div></div>';
		}
	}
	return $html;
}
add_shortcode( 'mos-event', 'mos_event_func' );
add_action( 'vc_before_init', 'mos_event_vc' );
function mos_event_vc() {
	vc_map( array(
		"name" => __( "Mos Events", "my-text-domain" ),
		"base" => "mos-event",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',				
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Event to Show", "my-text-domain" ),
				"param_name" => "posts_per_page",
				"value" => __( -1, "my-text-domain" ),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Show Load More", "my-text-domain" ),
				"param_name" => "loadmore",
				"value" => array(
					'Disable' => 'no',
					'Enable' => 'yes',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Like to enable Slider", "my-text-domain" ),
				"param_name" => "carousel",
				"value" => array(
					'Disable' => 'no',
					'Enable' => 'yes',
				),
			),
		)
	));
}

function mos_image_carousel_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'images' => '',
		'show' => 3,
		'scroll' => 1,
		'speed' => 2000,		
		'dots' => false,
		'arrows' => false,
		'breakpoint-1024' => 3,
		'breakpoint-600' => 2,
		'breakpoint-480' => 1,
	), $atts, 'mos_image_carousel' );	
	$arr = explode(',', $atts['images']);
	if (sizeof($arr)){
		$id = rand(1000,9999).strtotime("now");
		$html .= '<div class="slick-slider slick-slider-shortcode" id="'.$id.'">';
		foreach ($arr as $attachment_id) {
			$html .= '<img class="img-fluid img-slick-carousel" src="'.wp_get_attachment_url( $attachment_id ).'">';
		}
		$html .= '</div>';
	}
	$dots = ($atts['dots'])? 'true' : 'false';
	$arrows = ($atts['arrows'])? 'true' : 'false';
	$html .= '<script>jQuery(document).ready(function($){$("#'.$id.'").slick({slidesToShow:'.$atts['show'].',slidesToScroll:'.$atts['scroll'].',autoplay:true,autoplaySpeed:'.$atts['speed'].',focusOnSelect:true,dots:'.$dots.',arrows:'.$arrows.',responsive:[{breakpoint:1024,settings:{slidesToShow:'.$atts['breakpoint-1024'].',}},{breakpoint:600,settings:{slidesToShow:'.$atts['breakpoint-600'].',centerMode:true,centerPadding: "60px 0px 0px",}},{breakpoint:480,settings:{slidesToShow:'.$atts['breakpoint-480'].',centerMode:true,centerPadding: "60px 0px 0px",}}]})})</script>'; 
	
	return $html;
}
add_shortcode( 'mos_image_carousel', 'mos_image_carousel_func' );
add_action( 'vc_before_init', 'mos_image_carousel_vc' );
function mos_image_carousel_vc() {
	vc_map( array(
		"name" => __( "Mos Image Carousel", "my-text-domain" ),
		"base" => "mos_image_carousel",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "attach_images",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Images", "my-text-domain" ),
				"param_name" => "images",
				// "admin_label" => false,
				// "value" => __( "Default param value", "my-text-domain" ),
				"description" => __( "Images for slider.", "my-text-domain" )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Show", "my-text-domain" ),
				"param_name" => "show",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Scroll", "my-text-domain" ),
				"param_name" => "scroll",
				"value" => __( 1, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides Speed", "my-text-domain" ),
				"param_name" => "speed",
				"value" => __( 2000, "my-text-domain" ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Dots", "my-text-domain" ),
				"param_name" => "dots",
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Arrows", "my-text-domain" ),
				"param_name" => "arrows",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 1024", "my-text-domain" ),
				"param_name" => "breakpoint-1024",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 600", "my-text-domain" ),
				"param_name" => "breakpoint-600",
				"value" => __( 2, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 400", "my-text-domain" ),
				"param_name" => "breakpoint-400",
				"value" => __( 1, "my-text-domain" ),
			),
		)
	));
}
function mos_image_carousel_link_shortcode($atts){
	$atts = shortcode_atts( array(
		'values' => '',
		'show' => 3,
		'scroll' => 1,
		'speed' => 2000,		
		'dots' => false,
		'breakpoint-1024' => 3,
		'breakpoint-600' => 2,
		'breakpoint-480' => 1,
	), $atts, 'mos-image-carousel-link' );	

	$list = '';
	//$list = '<h4>'.$atts['title'].'</h4>';
	$values = vc_param_group_parse_atts($atts['values']);

	$new_accordion_value = array();
	foreach($values as $data){
		$new_line = $data;
		$new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
		$new_line['link'] = isset($new_line['link']) ? $new_line['link'] : '';
		$new_accordion_value[] = $new_line;
	}

	$idd = 0;
	$id = rand(1000,9999).strtotime("now");
	$list .= '<div class="slick-slider slick-slider-shortcode" id="'.$id.'">';
	foreach($new_accordion_value as $accordion):
		if($accordion['image']):
			$idd++;		
			if($accordion['link']) $list .= '<a href="'.$accordion['link'].'">';
			$list .= '<img class="img-fluid img-slick-carousel" src="'.aq_resize(wp_get_attachment_url($accordion['image']),435,300,true).'">';
			if($accordion['link']) $list .= '</a>';
		endif;
	endforeach;
	$list .= '</div>';
	$dots = ($atts['dots'])? 'true' : 'false';
	$list .= '<script>jQuery(document).ready(function($){$("#'.$id.'").slick({slidesToShow:'.$atts['show'].',slidesToScroll:'.$atts['scroll'].',autoplay:true,autoplaySpeed:'.$atts['speed'].',focusOnSelect:true,dots:'.$dots.',responsive:[{breakpoint:1024,settings:{slidesToShow:'.$atts['breakpoint-1024'].',}},{breakpoint:600,settings:{slidesToShow:'.$atts['breakpoint-600'].',centerMode:true,centerPadding: "60px 0px 0px",}},{breakpoint:480,settings:{slidesToShow:'.$atts['breakpoint-480'].',centerMode:true,centerPadding: "60px 0px 0px",}}]})})</script>'; 
	return $list;
	wp_reset_query();
}
add_shortcode('mos-image-carousel-link', 'mos_image_carousel_link_shortcode');

add_action( 'vc_before_init', 'mos_image_carousel_link_vc' );
function mos_image_carousel_link_vc() {
	vc_map(array(
		'name' => 'Mos Image Carousel with link',
		'base' => 'mos-image-carousel-link',
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
		'params' => array(
			array(
				'type' => 'param_group',
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'attach_image',
						'name' => 'Image',
						'heading' => __('Image', 'rrf-mos'),
						'param_name' => 'image',
					),
					array(
						'type' => 'textfield',
						'name' => 'Link',
						'heading' => __('Link', 'rrf-mos'),
						'param_name' => 'link',
					)
				)

			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Show", "my-text-domain" ),
				"param_name" => "show",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Scroll", "my-text-domain" ),
				"param_name" => "scroll",
				"value" => __( 1, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides Speed", "my-text-domain" ),
				"param_name" => "speed",
				"value" => __( 2000, "my-text-domain" ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Dots", "my-text-domain" ),
				"param_name" => "dots",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 1024", "my-text-domain" ),
				"param_name" => "breakpoint-1024",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 600", "my-text-domain" ),
				"param_name" => "breakpoint-600",
				"value" => __( 2, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 400", "my-text-domain" ),
				"param_name" => "breakpoint-400",
				"value" => __( 1, "my-text-domain" ),
			),
		),

	));
}

function mos_product_carousel_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'products' => '',
		'show' => 3,
		'scroll' => 1,
		'speed' => 2000,		
		'dots' => false,
		'arrows' => false,
		'breakpoint-1024' => 3,
		'breakpoint-600' => 2,
		'breakpoint-480' => 1,
	), $atts, 'mos_product_carousel' );	
	$arr = explode(',', $atts['products']);
	if (sizeof($arr)){
		$id = rand(1000,9999).strtotime("now");
		$html .= '<div class="slick-slider mos-product-slider slick-slider-shortcode mos-products" id="'.$id.'">';
		foreach ($arr as $product_id) {
			$product = wc_get_product( $product_id );
			// $product->get_regular_price();
			// $product->get_sale_price();
			// $product->get_price();
			$html .= '<div class="position-relative text-center product-'.$product_id.'">';
			$html .= '<div class="badge-con mb-1">';
			if(get_post_meta( $product_id, '_purnava_product_hot', true )){
	        	$html .= '<span class="badge badge-pill badge-warning badge-product">HOT</span>';
			}
			$html .= '</div>';
			$attachment_id = get_post_thumbnail_id( $product_id );
			$html .= '<div class="product-image"><img class="img-fluid img-product w-100" src="'.aq_resize(wp_get_attachment_url( $attachment_id ), 364,275,true).'" alt="'.get_the_title($product_id).'"></div>';
			$html .= '<div class="product-title">'.get_the_title($product_id).'</div>';
			$html .= '<div class="product-price">';
			$html .= '<span class="price">';
			if ($product->get_sale_price()){
				$html .= '<del>'.wc_price($product->get_regular_price()).'</del>';
				$html .= '<ins>'.wc_price($product->get_sale_price()).'</ins>';
			} else {
				$html .= '<ins>'.wc_price($product->get_regular_price()).'</ins>';				
			}
			$html .= '</span>';
			
			$html .= '</div>';
			if ($product->get_sale_price()) {
				$html .= '<div class="product-off">'.number_format((100 * ($product->get_regular_price()-$product->get_sale_price()))/$product->get_regular_price(), 2) .'%</div>';
			}
			$html .= '<a href="'.get_permalink($product_id).'" class="hidden-link">Read More</a>';
			$html .= '</div>';
		}
		$html .= '</div>';
	}
	$dots = ($atts['dots'])? 'true' : 'false';
	$arrows = ($atts['arrows'])? 'true' : 'false';
	$html .= '<script>jQuery(document).ready(function($){$("#'.$id.'").slick({slidesToShow:'.$atts['show'].',slidesToScroll:'.$atts['scroll'].',autoplay:true,autoplaySpeed:'.$atts['speed'].',focusOnSelect:true,dots:'.$dots.',arrows:'.$arrows.',responsive:[{breakpoint:1024,settings:{slidesToShow:'.$atts['breakpoint-1024'].',}},{breakpoint:600,settings:{slidesToShow:'.$atts['breakpoint-600'].',centerMode:true,}},{breakpoint:480,settings:{slidesToShow:'.$atts['breakpoint-480'].',centerMode:true}}]})})</script>'; 
	
	return $html;
}
add_shortcode( 'mos_product_carousel', 'mos_product_carousel_func' );
add_action( 'vc_before_init', 'mos_product_carousel_vc' );
function mos_product_carousel_vc() {
	$products = mos_get_posts('product');
	$option = array();
	foreach ($products as $id => $name) {
		$option[$name] = $id;
	}
	vc_map( array(
		"name" => __( "Mos Product Carousel", "my-text-domain" ),
		"base" => "mos_product_carousel",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "dropdown_multi",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Products", "my-text-domain" ),
				"param_name" => "products",
				// "admin_label" => false,
				"value" => $option,
				"description" => __( "Products for slider.", "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Show", "my-text-domain" ),
				"param_name" => "show",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Scroll", "my-text-domain" ),
				"param_name" => "scroll",
				"value" => __( 1, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides Speed", "my-text-domain" ),
				"param_name" => "speed",
				"value" => __( 2000, "my-text-domain" ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Dots", "my-text-domain" ),
				"param_name" => "dots",
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Arrows", "my-text-domain" ),
				"param_name" => "arrows",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 1024", "my-text-domain" ),
				"param_name" => "breakpoint-1024",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 600", "my-text-domain" ),
				"param_name" => "breakpoint-600",
				"value" => __( 2, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 400", "my-text-domain" ),
				"param_name" => "breakpoint-400",
				"value" => __( 1, "my-text-domain" ),
			),
		)
	));
}

function mos_poduct_categories_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'p-categories' => '',
		'large' => 'col-lg-2',
		'small' => 'col-4',
	), $atts, 'owl_carousel' );	
	$arr = explode(',', $atts['p-categories']);	
	if ($arr) {
		$html .= '<div class="row mos-product-categories">';
		foreach ($arr as $cat){
			$html .= '<div class="'.$atts['small'].' '.$atts['large'].' mb-2 mb-lg-0">';
			$html .= '<div class="mos-category-unit h-100 position-relative text-center">';
			$thumbnail_id = get_term_meta( $cat, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			$term = get_term_by('id', $cat, 'product_cat');
				$html .= '<img class="img-fluid img-product-category" src="'.$image.'" alt="' . $term->name .'">';
				$html .= '<div class="cat-name">' . $term->name .'</div>';
				$html .= '<a href="'.get_term_link($term->slug, 'product_cat').'" class="hidden-link">Read more</a>';
			$html .= '</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
	}
	return $html;
}
add_shortcode( 'mos_poduct_categories', 'mos_poduct_categories_func' );
add_action( 'vc_before_init', 'mos_poduct_categories_vc' );
function mos_poduct_categories_vc() {
	$product_cats = mos_get_terms('product_cat');
	$option = array();
	foreach ($product_cats as $product_cat) {
		$option[$product_cat['name']] = $product_cat['term_id'];
	}
	vc_map( array(
		"name" => __( "Mos Product Category", "my-text-domain" ),
		"base" => "mos_poduct_categories",
		"class" => "",
		"category" => __( "Mos Elements", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"holder" => "div",
				"heading" => __( "Select Categories", "my-text-domain" ),
				"param_name" => "p-categories",
				"value" => $option,
				"description" => __( "You can use CTRL or ALT key for select multiple options.", "my-text-domain" )
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Large Device Grid", "my-text-domain" ),
				"param_name" => "large",
				"value" => array(
					'2 Grids View' => 'col-md-6',
					'3 Grids View' => 'col-md-4',
					'4 Grids View' => 'col-md-3',
					'6 Grids View' => 'col-md-2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Small Device Grid", "my-text-domain" ),
				"param_name" => "small",
				"value" => array(
					'2 Grids View' => 'col-6',
					'3 Grids View' => 'col-4',
					'4 Grids View' => 'col-3',
					'6 Grids View' => 'col-2',
				),
			),
		)
	));
}

	// $product_cats = mos_get_terms('product_cat');
	// $option = array();
	// foreach ($product_cats as $product_cat) {
	// 	$option[$product_cat['term_id']] = $product_cat['name'];
	// }
	// var_dump($option);
/*Custom components*/
// Create multi dropdown param type
vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
function dropdown_multi_settings_field( $param, $value ) {
   $param_line = '';
   $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="select2 wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
   foreach ( $param['value'] as $text_val => $val ) {
       if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                    $text_val = $val;
                }
                $text_val = __($text_val, "js_composer");
                $selected = '';

                if(!is_array($value)) {
                    $param_value_arr = explode(',',$value);
                } else {
                    $param_value_arr = $value;
                }

                if ($value!=='' && in_array($val, $param_value_arr)) {
                    $selected = ' selected="selected"';
                }
                $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
            }
   $param_line .= '</select>';

   return  $param_line;
}
/*Custom components*/
?>