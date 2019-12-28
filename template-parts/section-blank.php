<?php 
global $purnava_options;
$title = $purnava_options['sections-blank-title'];
$content = $purnava_options['sections-blank-content'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blank', $page_details ); 
?>
<section id="section-blank" class="<?php if(@$purnava_options['sections-blank-background-type'] == 1) echo @$purnava_options['sections-blank-background'] . ' ';?><?php if(@$purnava_options['sections-blank-color-type'] == 1) echo @$purnava_options['sections-blank-color'];?>">
	<div class="content-wrap">
		<div class="container-fluid">
		<?php do_action( 'action_before_blank', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
		<?php do_action( 'action_after_blank', $page_details ); ?>
		</div>
	</div>
</section>
<?php do_action( 'action_below_blank', $page_details  ); ?>