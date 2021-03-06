<?php

function purnava_enqueue_scripts() {
	global $purnava_options;
	wp_enqueue_script( 'jquery' );	
	wp_register_style( 'google-font', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Nunito+Sans:200,300,400,600,700,800,900&display=swap' );
	wp_enqueue_style( 'google-font' );
	wp_register_style( 'font-awesome.min', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome.min' );

	wp_register_style( 'bootstrap.min', get_template_directory_uri() .  '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap.min' );
	wp_register_script('bootstrap.min', get_template_directory_uri() .  '/js/bootstrap.min.js', 'jquery');
	wp_enqueue_script( 'bootstrap.min' );

	wp_register_style( 'animate.min', get_template_directory_uri() .  '/plugins/wow/animate.min.css' );
	wp_enqueue_style( 'animate.min' );
	wp_register_script('wow.min', get_template_directory_uri() . '/plugins/wow/wow.min.js', 'jquery');
	wp_enqueue_script( 'wow.min' );
	
	wp_register_style( 'owl.carousel.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.css' );
	wp_register_style( 'owl.theme.default.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.theme.default.min.css' );
	wp_enqueue_style( 'owl.carousel.min' );
	wp_enqueue_style( 'owl.theme.default.min' );
	wp_register_script('owl.carousel.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.js', 'jquery');
	wp_enqueue_script( 'owl.carousel.min' );	

	wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css' );
	wp_register_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css' );
	wp_enqueue_style( 'slick' );
	wp_enqueue_style( 'slick-theme' );
	// wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js', 'jquery');
	wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js', 'jquery');
	wp_enqueue_script( 'slick' );		
	
	wp_register_style( 'jquery.fancybox.min', get_template_directory_uri() . '/plugins/fancybox/jquery.fancybox.min.css' );
	wp_enqueue_style( 'jquery.fancybox.min' );
	wp_register_script('jquery.fancybox.min', get_template_directory_uri() . '/plugins/fancybox/jquery.fancybox.min.js', 'jquery');
	wp_enqueue_script( 'jquery.fancybox.min' );

	wp_register_script('jquery.lazy.min', get_template_directory_uri() . '/plugins/jquery.lazy-master/jquery.lazy.min.js', 'jquery');
	wp_enqueue_script( 'jquery.lazy.min' );

	wp_register_script('jPages.min', get_template_directory_uri() . '/plugins/jPages/jPages.min.js', 'jquery');
	wp_enqueue_script( 'jPages.min' );

	// wp_register_script('InputSpinner', get_template_directory_uri() . '/plugins/InputSpinner.js', 'jquery');
	// wp_enqueue_script( 'InputSpinner' );
	


	

	// wp_register_style( 'theme-style', get_stylesheet_uri() );
	// wp_enqueue_style( 'theme-style' );

	// wp_register_style( 'hover', get_template_directory_uri() .  '/css/hover.css');
	// wp_enqueue_style( 'hover' );

	wp_register_style( 'main.min', get_template_directory_uri() .  '/css/main.css', array('bootstrap.min', 'animate.min', 'owl.carousel.min', 'owl.theme.default.min', 'jquery.fancybox.min'));
	wp_enqueue_style( 'main.min' );
		
	wp_register_script('main.min', get_template_directory_uri() . '/js/main.js', 'jquery');
	wp_enqueue_script( 'main.min' );
	if ($purnava_options['basic-styling-stylesheet']) {
		wp_register_style( $purnava_options['basic-styling-stylesheet'], get_template_directory_uri() .  '/css/'.$purnava_options['basic-styling-stylesheet'].'.css', array('main.min'));
		wp_enqueue_style( $purnava_options['basic-styling-stylesheet'] );		
	}

}
add_action( 'wp_enqueue_scripts', 'purnava_enqueue_scripts' );
function purnava_admin_enqueue_scripts(){
	wp_register_style( 'font-awesome.min', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css' );
	wp_register_style( 'custom-admin', get_template_directory_uri() . '/css/custom-admin.css' );
	wp_enqueue_style( 'font-awesome.min' );
	wp_enqueue_style( 'custom-admin' );

	wp_enqueue_media();
	wp_register_script('custom-admin', get_template_directory_uri() . '/js/custom-admin.js', 'jquery');
	wp_enqueue_script('custom-admin');
}
add_action( 'admin_enqueue_scripts', 'purnava_admin_enqueue_scripts' );

function purnava_ajax_enqueue_scripts(){	
	wp_register_script('ajax', get_template_directory_uri() . '/js/ajax.js', 'jquery');
	wp_enqueue_script('ajax');
	$ajax_params = array(
		'ajax_url' => admin_url('admin-ajax.php'),
	);
	wp_localize_script( 'ajax', 'ajax_obj', $ajax_params );
}
add_action( 'admin_enqueue_scripts', 'purnava_ajax_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'purnava_ajax_enqueue_scripts' );
