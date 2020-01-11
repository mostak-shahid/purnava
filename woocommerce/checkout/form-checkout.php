<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-7">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<div class="address-con">
				<?php if (is_user_logged_in()) : ?>
					<?php $customer_id = get_current_user_id() ?>
					<div class="row">
					<?php 
					$addresses = get_user_meta( $customer_id, 'mos_user_address', true );
					// var_dump($addresses);
					$n = 1;
					foreach ($addresses as $address) : ?>
						<div class="col-lg-6">
							<?php if ($address['type'] == 'default') ?>
							<div class="address-unit old-unit d-flex <?php if ($address['type'] == 'default') echo 'active' ?>">
								<div class="wrap p15">
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadioInline-<?php echo $n ?>" name="customRadioInline1" class="custom-control-input" <?php if ($address['type'] == 'default') echo 'checked' ?>>
										<label class="custom-control-label" for="customRadioInline-<?php echo $n ?>"><?php echo $address["first_name"] ?> <?php echo $address["last_name"] ?></label>
									</div>
									<p class="living"><?php echo $address["address"] ?></p>
									<p class="mobile">Mobile: <?php echo $address["phone"] ?></p>
								</div>
							</div>
						</div>
						<?php $n++; ?>
					<?php endforeach; ?>
						<div class="col-lg-6">
							<div class="address-unit add-new d-flex justify-content-center align-items-center">
								<div class="wrap text-center">
									<i class="fa fa-plus"></i>
									<div class="text">Add New</div>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					If you haven't registered yet please <a href="<?php echo home_url( '/register/' )?>?redirect_to=<?php echo home_url( '/checkout/' );?>">create an account
					</a> from here, or <a href="<?php echo home_url( '/log-in/' )?>?redirect_to=<?php echo home_url( '/checkout/' );?>">login</a> from here
				<?php endif; ?>
			</div>
			<div class="col2-set d-none d-lg-block" id="customer_details">
				<div class="billing_details">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="shipping_details">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		</div>
		<div class="col-lg-5">
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
		<h3 id="order_review_heading"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
