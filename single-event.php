<?php 
global $purnava_options;
$from_theme_option = $purnava_options['archive-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_purnava_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
?><?php get_header() ?>
<section id="events" class="page-content single-event-post <?php if(@$purnava_options['sections-content-background-type'] == 1) echo @$purnava_options['sections-content-background'];?>">
	<div class="content-wrap">
		<div class="container">

			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $current_post = get_the_ID() ?>
					<div class="desc">	
						<div class="enent-info">				
							<h1 class="event-title text-center"><?php echo get_the_title() ?></h1>
							<div class="row event-meta">
								<div class="col-6 col-md-3"><i class="fa fa-calendar"></i> <?php echo get_post_meta( get_the_ID(), '_purnava_event_date', true ); ?></div>
								<div class="col-6 col-md-3"><i class="fa fa-clock-o"></i> <?php echo get_post_meta( get_the_ID(), '_purnava_event_time', true ); ?></div>
								<div class="col-12 col-md-6"><i class="fa fa-map-marker"></i> <?php echo get_post_meta( get_the_ID(), '_purnava_event_location', true ); ?></div>
							</div>
						</div>
						<div class="content">
							<?php echo do_shortcode( '[feature-image width=1110]' ); ?>
							<?php the_content(); ?>
						</div>	
					</div>					
				<?php endwhile;?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>
			<?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>			

		</div>	
	</div>
</section>
<section id="related-events" class="related-events">
	<div class="content-wrap">
		<div class="container">
			<h5 class="related-event-title">You May Like</h5>
			<?php
			$args = array(
				'post_type' => 'event',
				'posts_per_page' => 3,
				'post__not_in' => array( $current_post ),
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : ?>
				<div class="row event-posts">
			    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
			        <div class="col-md-4 mb-3">
			        	<div class="event-unit h-100">
			        		<?php echo do_shortcode( '[feature-image width=350 height=230]' ); ?>
			        		<div class="wrapper">
				        		<h6 class="unit-title"><?php echo get_the_title() ?></h6>
				        		<div class="time"><i class="fa fa-clock-o"></i> <?php echo get_post_meta( get_the_ID(), '_purnava_event_date', true ); ?> at <?php echo get_post_meta( get_the_ID(), '_purnava_event_time', true ); ?></div>
				        		<div class="location"><i class="fa fa-map-marker"></i> <?php echo get_post_meta( get_the_ID(), '_purnava_event_location', true ); ?></div>
				        		<a href="<?php echo get_the_permalink(); ?>" class="event-link">View Details <i class="fa fa-long-arrow-right"></i></a>
			        		</div>
			        	</div>
			        </div>
			    <?php endwhile;?>
			    </div>
			<?php endif; ?>
			<?php wp_reset_postdata();?>
		</div>
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>