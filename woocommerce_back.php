<?php 
global $purnava_options;
$from_theme_option = $purnava_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_purnava_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
?><?php get_header() ?>
<section id="page" class="page-content <?php if(is_product()) echo 'single-product-page'; else echo 'shop-archive-page' ?> <?php if(@$purnava_options['sections-content-background-type'] == 1) echo @$purnava_options['sections-content-background'] . ' ';?><?php if(@$purnava_options['sections-content-color-type'] == 1) echo @$purnava_options['sections-content-color'];?>">
	<div class="content-wrap">
		<div class="container">
					<?php if ( have_posts() ) :?>
						
						<?php woocommerce_content(); ?>
							
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
		</div>	
	</div>
</section>
<?php // if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>