<div class="post-<?php echo get_the_ID();?>">
	<?php if (is_single()) : ?>
		<?php echo do_shortcode( '[feature-image height=600 width=1110]'  ); ?>
		<div class="mb-3"></div>
	<?php else : ?>
		<?php echo do_shortcode( '[feature-image height=560 width=555]' ); ?>
	<?php endif; ?>						
	
	<div class="content">
	<?php if (is_single()) : ?>
		<?php the_content()?>
	<?php else : ?>
		<h2 class="header"><?php echo get_the_title() ?></h2>
		<?php the_excerpt(); ?>	
		<a href="btn btn-readmore" href="<?php echo get_the_permalink(); ?>">Read More</a>
	<?php endif; ?>						
	</div>						
</div>

