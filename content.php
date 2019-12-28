<div class="post-<?php echo get_the_ID();?>">
	<?php echo do_shortcode( '[feature-image height=560 width=555]'  ); ?>
	<h2 class="header"><?php echo get_the_title() ?></h2>
	<div class="content">
	<?php if (is_single()) : ?>
		<?php the_content()?>
	<?php else : ?>
		<?php the_excerpt(); ?>	
		<a href="btn btn-readmore" href="<?php echo get_the_permalink(); ?>">Read More</a>
	<?php endif; ?>						
	</div>						
</div>

