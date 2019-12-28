<?php 
global $purnava_options;
$from_theme_option = $purnava_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_purnava_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
?><?php get_header() ?>
<section id="archive" class="page-content <?php if(@$purnava_options['sections-content-background-type'] == 1) echo @$purnava_options['sections-content-background'] . ' ';?><?php if(@$purnava_options['sections-content-color-type'] == 1) echo @$purnava_options['sections-content-color'];?>">
	<div class="content-wrap">
		<div class="container">
			<?php if ( have_posts() ) :?>
				<div class="position-relative">
				<div id="blogs" class="row">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-lg-6 mb-3">							
							<div class="position-relative post-<?php echo get_the_ID();?>">
								<?php echo do_shortcode( '[feature-image height=560 width=555]'  ); ?>
								<div class="con">
									<div class="meta">										
											<?php 
											$categories = get_the_category();
											$n = 0;
											if (@$categories) {
												echo '<span class="category">';
												foreach($categories as $category){
													if ($n) echo ',';
													echo $category->name;
													$n++;
												}
												echo '</span> <i class="fa fa-circle"></i> ';
											}
											?>										
										<span class="date"><?php echo get_the_time('d M Y') ?></span>
									</div>
									<h3 class="header"><?php echo get_the_title() ?></h3>						
								</div>
								<a href="<?php echo get_the_permalink(); ?>" class="hidden-link">Read More</a>
							</div>
						</div>
					<?php endwhile;?>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-4">
						<button type="button" class="btn btn-block btn-primary rounded-0 load-posts">Load More</button>
					</div>
				</div>
				<input type="hidden" id="post_type" value="<?php echo get_post_type(); ?>">
				<input type="hidden" id="post_loaded" value="<?php echo get_option( 'posts_per_page' ); ?>">
				</div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
		</div>	
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>