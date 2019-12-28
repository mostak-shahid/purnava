<?php 
global $purnava_options;
$title = $purnava_options['sections-topselling-title'];
$content = $purnava_options['sections-topselling-content'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_topselling', $page_details ); 
?>
<section id="section-topselling" class="<?php if(@$purnava_options['sections-topselling-background-type'] == 1) echo @$purnava_options['sections-topselling-background'] . ' ';?><?php if(@$purnava_options['sections-topselling-color-type'] == 1) echo @$purnava_options['sections-topselling-color'];?>">
	<div class="content-wrap">
		<div class="container-fluid">
		<?php do_action( 'action_before_topselling', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
		<?php do_action( 'action_after_topselling', $page_details ); ?>
		</div>
	</div>
</section>
<?php do_action( 'action_below_topselling', $page_details  ); ?>