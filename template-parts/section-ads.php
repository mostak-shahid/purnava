<?php 
global $purnava_options;
$title = $purnava_options['sections-ads-title'];
$content = $purnava_options['sections-ads-content'];
$slides = $purnava_options['sections-ads-slides'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_ads', $page_details ); 
?>
<section id="section-ads" class="<?php if(@$purnava_options['sections-ads-background-type'] == 1) echo @$purnava_options['sections-ads-background'] . ' ';?><?php if(@$purnava_options['sections-ads-color-type'] == 1) echo @$purnava_options['sections-ads-color'];?>">
	<div class="content-wrap">
		<div class="container-fluid">
		<?php do_action( 'action_before_ads', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php if (@$slides) : ?>
					<div class="ads-slick-slider">
					<?php foreach($slides as $slide) : ?>
						<div class="unit position-relative">
						<?php if ($slide['attachment_id']) : ?>
							<img class="img-fluid img-ads" src="<?php echo $slide['image'] ?>" alt="<?php echo strip_tags(do_shortcode($slide['title'])) ?>" >
						<?php endif; ?>
						<div class="unit-desc text-white text-center">							
							<?php if ($slide['title']) : ?>
								<h5 class="unit-title mt-1"><?php echo do_shortcode($slide['title']) ?></h5>
							<?php endif; ?>					
							<?php if ($slide['description']) : ?>
								<div class="unit-description mt-1"><?php echo do_shortcode($slide['description']) ?></div>
							<?php endif; ?>				
							<?php if ($slide['link_title']) : ?>
								<sapn class="unit-link_title mt-1"><?php echo do_shortcode($slide['link_title']) ?></sapn>
							<?php endif; ?>
						</div>
						<?php if ($slide['link_url']) : ?>
							<a class="hidden-link" href="<?php echo esc_url(do_shortcode( $slide['link_url'])); ?>"></a>
						<?php endif; ?>
						</div>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
		<?php do_action( 'action_after_ads', $page_details ); ?>	
		</div>
	</div>
</section>
<?php do_action( 'action_below_ads', $page_details  ); ?>