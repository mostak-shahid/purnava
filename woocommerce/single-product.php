<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<section id="page" class="page-content single-product-page">
	<div class="content-wrap">
		<div class="container">

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );?>
		</div>
	</div>
</section>
<?php global $product ?>
<section id="product-details">
	<div class="content-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h4 class="details-title">Product Details :</h4>
					<div class="details-desc">
						<?php echo wpautop($product->get_description()); ?>
					</div>
				</div>
				<div class="col-lg-6">
					<h4 class="details-title">Additional Information :</h4>
					<div class="row">
						<div class="col-6">
							<div class="details-desc h-100 border-bottom">
								<div class="info-title">Generic Name</div>
								<h5><?php echo get_post_meta( $product->get_id(), '_purnava_product_generic_name', true ); ?></h5>
							</div>
						</div>
						<div class="col-6">
							<div class="details-desc h-100 border-bottom">
								<div class="info-title">Formulation of the product</div>
								<h5><?php echo get_post_meta( $product->get_id(), '_purnava_product_formulation', true ); ?></h5>
							</div>
						</div>
						<div class="col-12">
							<div class="details-desc h-100 border-bottom">
								<div class="info-title">Strength</div>
								<h5><?php echo get_post_meta( $product->get_id(), '_purnava_product_strength', true ); ?></h5>
							</div>
						</div>
						<div class="col-6">
							<div class="details-desc h-100 border-bottom">
								<div class="info-title">Package Size</div>
								<h5><?php echo get_post_meta( $product->get_id(), '_purnava_product_package_size', true ); ?></h5>
							</div>
						</div>
						<div class="col-6">
							<div class="details-desc h-100 border-bottom">
								<div class="info-title">Feature Product</div>
								<h5><?php if (get_post_meta( $product->get_id(), '_purnava_product_feature', true )) echo 'Yes'; ?></h5>
							</div>
						</div>
					</div>
					<div class="details-desc">
						<h5>Special Notes</h5>
						<div><?php echo get_post_meta( $product->get_id(), '_purnava_product_notes', true ); ?></div>	
					</div>
				</div>
			</div>
			<hr class="details-seperator">
			<div class="row">
				<div class="col-md-6">
					<h4 class="details-title">Product Benifits :</h4>
					<div class="details-desc">
					<?php $benifits = get_post_meta( $product->get_id(), '_purnava_product_benifits', true ); ?>
					<?php if (@$benifits) : ?>
						<div class="table-responsive">
							<table class="table table-borderless">
							<?php foreach ($benifits as $benifit) : ?>
								<tr>
									<th><?php echo @$benifit['title'] ?></th>
									<th>:</th>
									<td><?php echo @$benifit['details'] ?></td>
								</tr>
							<?php endforeach; ?>
							</table>
						</div>
					<?php endif; ?>
					</div>
				</div>
				<div class="col-md-6">
					<h4 class="details-title">Delivery :</h4>
					<div class="details-desc">
					<?php $delivery = get_post_meta( $product->get_id(), '_purnava_product_delivery', true ); ?>
					<?php if (@$delivery) : ?>
						<div class="table-responsive">
							<table class="table table-borderless">
							<?php foreach ($delivery as $rule) : ?>
								<tr>
									<td><?php echo $rule['title'] ?></td>
									<th>:</th>
									<th><?php echo $rule['details'] ?></th>
								</tr>
							<?php endforeach; ?>
							</table>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="related-product">
	<div class="content-wrap">
		<div class="container">
			<h4 class="heading">You May Also Like</h4>
			<div class="desc">
				<?php // echo get_post_type() ?>
				<?php // var_dump(get_the_terms( $product->get_id(), 'product_cat' )); ?>
				<?php // var_dump($product) ?>
				<?php // var_dump($product->get_category_ids()) ?>
				<?php 
				$args = array(
					'post_type' => get_post_type(),
					'posts_per_page' => -1,
					'post__not_in' => array($product->get_id()),
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_taxonomy_id',
							// 'terms'    => $product->get_category_ids(),
							'terms'    => array(31),
						),
					),
				);
				$query = new WP_Query( $args );
				// $total_post = $query->post_count;
				if ( $query->have_posts() ) :
	        		$sale_price =  get_post_meta( get_the_ID(), '_sale_price', true ); 
	        		$dsale_price = wc_price($sale_price);
	        		$price =  get_post_meta( get_the_ID(), '_regular_price', true ); 
	        		$dprice = wc_price($price);
	        		?>
					<div class="related-products mos-products">
				    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
				        <div class="position-relative text-center product-<?php echo get_the_ID() ?>">
				        <div class="badge-con">
				        <?php if(get_post_meta( get_the_ID(), '_purnava_product_hot', $single )) : ?>
				        	<span class="badge badge-pill badge-warning badge-product">HOT</span>
				        <?php endif; ?>
				        </div>
				        <?php if (has_post_thumbnail()) : ?>
				        	<div class="product-image"><img class="img-fluid img-related-product w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title() ?>"></div>
				        <?php endif; ?>
				        	<div class="product-title"><?php echo get_the_title() ?></div>
				        	<div class="product-price">
				        		<?php if ($sale_price) : ?>
				        			<span class="price"><del><?php echo $dprice ?></del><ins><?php echo $dsale_price ?></ins></span>
				        		<?php else : ?>
				        			<span class="price"><ins><?php echo $dprice ?></ins></span>
				        		<?php endif; ?>
				        	</div>
				        <?php if ($sale_price) : ?>
				        	<div class="product-off"><?php echo number_format((100 * ($price-$sale_price))/$price, 2) ?>%</div>
				        <?php endif; ?>
				        	<a class="hidden-link" href="<?php echo get_the_permalink()?>">Read More</a>
				        </div>
				    <?php endwhile;?>
				    </div>
				<?php endif;?>
				<?php wp_reset_postdata();?>
				
			</div>
		</div>
	</div>	
</section>
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
