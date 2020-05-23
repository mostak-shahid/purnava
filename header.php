<?php
$current_user = wp_get_current_user();
$current_url = $_SERVER['REQUEST_URI'];	
if ( $current_user->ID ) {
	if (preg_match("/(log-in)|(register)|(forgot-password)/i", $current_url)) {
		wp_redirect(home_url('/my-account/'));
		exit;
	}
} else {
	if (preg_match("/my-account/i", $current_url)) {
		wp_redirect(home_url('/log-in/'));
		exit;
	}
}
?>
<?php global $purnava_options; ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="Md. Mostak Shahid">
	<?php if(is_single()) : ?>
		<?php 
		global $wp; 
		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		?>
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
		<meta property="og:url" content="<?php echo $current_url ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="SEO Title" />
		<meta property="og:description" content="SEO Description" />
		<meta property="og:image" content="https://imaginary.barta24.com/watermarkimage?image=https://barta24.com/watermark.png&path=/uploads/news/2020/May/23/1590209659780.jpg&width=600&height=315&top=271" />
		<meta property="og:image:width" content="600" />
		<meta property="og:image:height" content="315" />


		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@purnavalimited" />
		<meta name="twitter:creator" content="@purnavalimited" />
		<meta name="twitter:title" content="SEO Title">
		<meta property="twitter:url" content="<?php echo $current_url ?>" />
		<meta name="twitter:description" content="SEO Description">
		<meta name="twitter:image" content="https://imaginary.barta24.com/watermarkimage?image=https://barta24.com/watermark.png&path=/uploads/news/2020/May/23/1590209659780.jpg&width=600&height=315&top=271">
		<meta name="twitter:image:alt" content="SEO Title">
	<?php endif; ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<input id="loader-status" type="hidden" value="<?php echo $purnava_options['misc-page-loader'] ?>">
<?php if ($purnava_options['misc-page-loader']) : ?>
    <div class="se-pre-con">
    <?php if ($purnava_options['misc-page-loader-image']['url']) : ?>
        <img class="img-responsive animation <?php echo $purnava_options['misc-page-loader-image-animation'] ?>" src="<?php echo do_shortcode( $purnava_options['misc-page-loader-image']['url'] ); ?>">
    <?php else : ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <?php endif; ?>
    </div>
<?php endif; ?>
	<?php $page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() )); ?>
	<?php do_action( 'action_avobe_header', $page_details );  ?>
	<header id="main-header" class="<?php if(@$purnava_options['sections-header-background-type'] == 1) echo @$purnava_options['sections-header-background'] . ' ';?><?php if(@$purnava_options['sections-header-color-type'] == 1) echo @$purnava_options['sections-header-color'];?>">
	<div class="content-wrap">
			<div class="top-header">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-6 col-lg-3 text-left logo-wrapper">
							<a id="menu-toggle" class="d-lg-none" href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 7V5H2V7H22ZM22 11V13H2V11H22ZM22 17V19H2V17H22Z" fill="white"/></svg></a>
							<?php echo do_shortcode( '[site-identity]' ); ?>								
						</div>
						<div class="col-6 col-lg-3 order-lg-last text-right icon-wrapper">
							<ul class="list-inline mb-0">
								<?php
								$wishlist = YITH_WCWL()->count_products();
								global $woocommerce;
    							$items = $woocommerce->cart->get_cart();
								?>
								<li class="list-inline-item text-center position-relative"><a href="<?php echo home_url( '/wishlist/' ); ?>"><span class="icon_count"><?php echo @$wishlist ?></span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 25.25L14.5 24.875C14 24.625 3.75 17.75 3.75 11.625C3.75 7.25 6.875 5 9.875 5C11.875 5 13.75 5.875 15 7.5C16.25 5.875 18.125 5 20.125 5C23.125 5 26.25 7.25 26.25 11.625C26.25 17.75 16 24.5 15.5 24.875L15 25.25ZM9.875 6.875C7.875 6.875 5.625 8.375 5.625 11.625C5.625 15.625 12 20.75 15 22.875C18.25 20.75 24.375 15.625 24.375 11.625C24.375 8.375 22.125 6.875 20.125 6.875C18.5 6.875 16.875 7.75 16 9.375C16 9.5 15.875 9.5 15.875 9.5L15 11.25L14.125 9.625C14.125 9.5 14 9.5 14 9.5C13.125 7.875 11.625 6.875 9.875 6.875Z" fill="white"/></svg></a></li>
								<li class="list-inline-item text-center position-relative"><a href="<?php echo home_url( '/cart/' ); ?>"><span class="icon_count"><?php echo @sizeof($items)?></span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.875 8.625H20.125V8C20.125 5.125 17.75 2.875 15 2.875C12.25 2.875 9.875 5.125 9.875 8V8.625H6.125L4 27.125H26.125L23.875 8.625ZM9.875 10.875C9.5 11.125 9.375 11.5 9.375 11.875C9.375 12.625 10 13.25 10.75 13.25C11.5 13.25 12.125 12.625 12.125 11.875C12.125 11.5 12 11.125 11.625 10.875V10.375H18.5V10.875C18.25 11.125 18 11.5 18 11.875C18 12.625 18.625 13.25 19.375 13.25C20.125 13.25 20.75 12.625 20.75 11.875C20.75 11.5 20.625 11.125 20.25 10.875V10.375H22.5L24.25 25.5H5.875L7.625 10.375H9.875V10.875V10.875ZM11.5 8.625V8C11.5 6.125 13 4.5 15 4.5C16.875 4.5 18.5 6 18.5 8V8.625H11.5Z" fill="white"/></svg></a></li>
								<li class="list-inline-item"><a href="<?php echo home_url( '/my-account/' ); ?>"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.625 22.375C26.25 21.5 24.625 17.125 19.375 15.625C20.375 14.25 21 12.375 21 10.5C21 6.75 18.375 4 14.5 4C10.625 4 8 6.625 8 10.5C8.125 12.5 8.75 14.375 10 15.875C4.75 17.625 3.375 22 3.375 22.625V22.75C3.375 25.125 10.5 25.875 15 25.875C19.5 25.875 26.625 25 26.625 22.75V22.375ZM14.5 16.25C11.625 16.25 10 13.375 10 10.5C10 9.125 10.375 8 11.125 7.25C11.875 6.375 13.125 6 14.625 6C17.5 6 19.25 7.75 19.25 10.625C19.125 13.375 17.375 16.25 14.5 16.25ZM11.5 17.375C12.375 18 13.375 18.25 14.5 18.25C15.625 18.25 16.75 18 17.75 17.375C20.125 17.75 23.125 19 24.625 22.625C23.625 23.125 20 24.125 14.875 24.125C9.625 24.125 6.125 23.125 5.125 22.5C5.5 21.625 6.875 18.375 11.5 17.375Z" fill="white"/></svg></a></li>
							</ul>
						</div>
						<div class="col-lg-6 text-center search-wrapper"><?php echo do_shortcode( '[product-search]' ); ?></div>
					</div>
				</div>			
			</div>
	</div>
	</header>
			<div class="nav-part sticky-top">
				<div class="container text-center">
					<?php
					wp_nav_menu([
						'menu'            => 'mainmenu',
						'theme_location'  => 'mainmenu',
						'container'       => false,
						// 'container_id'    => 'collapsibleNavbar',
						// 'container_class' => 'collapse navbar-collapse',
						'menu_id'         => false,
						'menu_class'      => 'header-menu',
						'depth'           => 1,
						'fallback_cb'     => 'bs4navwalker::fallback',
						//'walker'          => new bs4navwalker()
						]);
					?>							
				</div>				
			</div>
	<?php if (!is_front_page() AND !is_product() AND get_post_type() != 'event') : ?>
		<?php do_action( 'action_avobe_page_titile', $page_details ); ?>
		<?php 
		$banner_img = get_post_meta( get_the_ID(), '_purnava_banner_cover', true ); 
		$banner_mp4 = get_post_meta( get_the_ID(), '_purnava_banner_mp4', true ); 
		$banner_webm = get_post_meta( get_the_ID(), '_purnava_banner_webm', true ); 
		$banner_shortcode = get_post_meta( get_the_ID(), '_purnava_banner_shortcode', true ); 
		?>
		<section id="page-title" class="<?php if(@$purnava_options['sections-title-background-type'] == 1) echo @$purnava_options['sections-title-background'] . ' ';?><?php if(@$purnava_options['sections-title-color-type'] == 1) echo @$purnava_options['sections-title-color'];?>" <?php if ($banner_img) echo 'style="background-image:url('.$banner_img.')"' ?>>
			<?php if ($banner_shortcode) : ?>
				<div class="shortcode-output"><?php echo do_shortcode( $banner_shortcode ); ?></div>
			<?php elseif ($banner_mp4 OR $banner_webm) : ?>
				<div class="video-output">
					<video id="banner-video" autoplay loop muted playsinline <?php if ($banner_img) : ?> style="background-image:url(<?php echo $banner_img ?>)" <?php endif; ?>>
					<?php if($banner_mp4) : ?>
						<source src="<?php echo $banner_mp4 ?>">
					<?php endif; ?>
					<?php if($banner_webm) : ?>
						<source src="<?php echo $banner_webm ?>">
					<?php endif; ?>
					</video>					
				</div>
			<?php endif; ?>
			<div class="content-wrap">
				<div class="container">
					<?php 
					if (is_home()) :
						$page_for_posts = get_option( 'page_for_posts' );
						$title = get_the_title($page_for_posts);
					elseif (is_404()) :
						$title = '404 Page';
					elseif ( is_shop() ) :
						$page_for_shop = get_option( 'woocommerce_shop_page_id' );
						$title = get_the_title($page_for_shop);
					elseif ( is_product_category() ) :
						$title = single_term_title(false,false);
					else :
						$title = get_the_title();
					endif; 
					?>
					<span class="heading"><?php echo $title ?></span>
				</div>
			</div>
		</section>

		<?php if (@$purnava_options['sections-breadcrumbs-option']) : ?>
			<?php do_action( 'action_avobe_breadcrumbs', $page_details );  ?>
		<section id="section-breadcrumbs" <?php if(@$purnava_options['sections-breadcrumbs-background-type'] == 1) echo 'class="'.@$purnava_options['sections-breadcrumbs-background'].'"';?>>
			<div class="content-wrap">
				<div class="container">
					<?php mos_breadcrumbs(); ?>
				</div>
			</div>
		</section>
		<?php endif; ?>
	<?php endif ?>