<?php 
if (get_post_type() == 'page') :
global $purnava_options;
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blank', $page_details ); 
?>
<section id="page" class="page-content <?php if(@$purnava_options['sections-content-background-type'] == 1) echo @$purnava_options['sections-content-background'] . ' ';?><?php if(@$purnava_options['sections-content-color-type'] == 1) echo @$purnava_options['sections-content-color'];?>">
	<div class="content-wrap">
		<div class="container">
					<?php if ( have_posts() ) :?>
						<?php get_template_part( 'content', 'page' ) ?>							
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_blank', $page_details  ); ?>
<?php endif; ?>