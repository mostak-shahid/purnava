<?php 
global $purnava_options;
$title = $purnava_options['sections-pcategory-title'];
$content = $purnava_options['sections-pcategory-content'];
$select = $purnava_options['sections-pcategory-select'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_pcategory', $page_details ); 
?>
<section id="section-pcategory" class="<?php if(@$purnava_options['sections-pcategory-background-type'] == 1) echo @$purnava_options['sections-pcategory-background'] . ' ';?><?php if(@$purnava_options['sections-pcategory-color-type'] == 1) echo @$purnava_options['sections-pcategory-color'];?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_pcategory', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php if (@$select) : ?>
					<div class="row">
					<?php foreach ($select as $cat):?>
						<div class="col-4 col-lg-2 mb-2 mb-lg-0">
							<div class="unit h-100 position-relative text-center">
								<?php 
								$thumbnail_id = get_woocommerce_term_meta( $cat, 'thumbnail_id', true );
								$image = wp_get_attachment_url( $thumbnail_id );
								?>
								<img src="<?php echo $image ?>" alt="">
								<div class="cat-name">
								<?php 
									$term = get_term_by('id', $cat, 'product_cat');
									// var_dump($term);
									echo $term->name;
								?>
								</div>
								<a href="<?php echo get_term_link($term->slug, 'product_cat') ?>" class="hidden-link">Read more</a>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
		<?php do_action( 'action_after_pcategory', $page_details ); ?>
		</div>
	</div>
</section>
<?php do_action( 'action_below_pcategory', $page_details  ); ?>