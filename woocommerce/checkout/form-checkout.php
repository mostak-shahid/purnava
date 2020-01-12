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
global $districts;
$customer_id = get_current_user_id();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if( isset( $_POST['address_nonce_form_field'] ) && wp_verify_nonce( $_POST['address_nonce_form_field'], 'address_nonce_form') ) {
		$address = get_user_meta( $customer_id, 'mos_user_address', true ); 
		$newindex = sizeof($address);
		$index = ($_POST['id'] == 'new')?$newindex:$_POST['id'];
		$address[$index] = array(
			'id' => $index,
			'type' => $_POST['type'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'phone' => $_POST['phone'],
			'fax' => $_POST['fax'],
			'address' => $_POST['address'],
			'district' => $_POST['district'],
			'post' => $_POST['post'],			
		);
		update_user_meta( $customer_id, 'mos_user_address', $address );
	}
}
$delete = @$_GET['delete'];
if ($delete >-1 ){
	$addresss = get_user_meta( $customer_id, 'mos_user_address', true ); 
	unset($addresss[$delete]);
	update_user_meta( $customer_id, 'mos_user_address', $addresss );
}
?>
<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content rounded-0">
			<div class="modal-body">
				<form action="" method="post">
					<?php wp_nonce_field( 'address_nonce_form', 'address_nonce_form_field' ); ?>
					<div class="form-row">
						<div class="form-group col">
							<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="first_name" id="first_name" placeholder="First Name" required>
						</div>
						<div class="form-group col">
							<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="last_name" id="last_name" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-group">
						<input type="tel" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="phone" id="phone" placeholder="Mobile Number" required>
					</div>
					<div class="form-group">
						<input type="tel" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="fax" id="fax" placeholder="Fax (Optional)">
					</div>
					<div class="form-group">
						<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="address" id="address" placeholder="Address" required>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<select class="form-control rounded-0 mos-border-bottom pl0 pr0" name="district" id="district" required>
								<option value="">District</option>
							<?php foreach ($districts as $code => $district) : ?>
								<option value="<?php echo $code ?>"><?php echo $district ?></option>
							<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col">
							<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="post" id="post" placeholder="Post Code">
							<input type="hidden" name="id" id="id" value="new">
							<input type="hidden" name="type" id="type" value="other">
						</div>
					</div>
					<div class="form-row">
						<div class="col"><button type="button" class="btn btn-block btn-light rounded-0 border" data-dismiss="modal">Cancel</button></div>
						<div class="col"><button type="submit" class="btn btn-block btn-secondary rounded-0" name="submit" id="submit" value="create">Create</button></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-7">
			<div class="wrapper h-100 border-right-dashed">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<div class="address-con">
				<?php if (is_user_logged_in()) : ?>
					<div class="row">
					<?php 
					$addresses = get_user_meta( $customer_id, 'mos_user_address', true );
					// var_dump($addresses);
					$n = 1;
					foreach ($addresses as $key => $address) : ?>
						<div class="col-lg-6">

							<div class="address-unit old-unit d-flex <?php if ($address['type'] == 'default') echo 'active' ?>" data-fname="<?php echo $address['first_name'] ?>" data-lname="<?php echo $address['last_name'] ?>" data-phone="<?php echo $address['phone'] ?>" data-address="<?php echo $address['address'] ?>" data-city="<?php echo $districts[$address['district']] ?>" data-district="<?php echo $address['district'] ?>" data-post="<?php echo $address['post'] ?>">
								<div class="wrap p15">
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadioInline-<?php echo $n ?>" name="customRadioInline1" class="custom-control-input" <?php if ($address['type'] == 'default') echo 'checked' ?>>
										<label class="custom-control-label" for="customRadioInline-<?php echo $n ?>"><?php echo $address["first_name"] ?> <?php echo $address["last_name"] ?></label>
									</div>
									<p class="living"><?php echo $address["address"] ?></p>
									<p class="mobile">Mobile: <?php echo $address["phone"] ?></p>									
								</div>
							</div>
							<div class="address-action"><a href="javascript:void(0)" class="text-info edit-modal" data-id="<?php echo $key ?>">Edit</a><?php if ($address['type'] != 'default') : ?> | <a href="<?php echo home_url( '/checkout/' ); ?>?delete=<?php echo $key ?>" class="text-danger" data-id="1">Delete</a><?php endif; ?></div>
						</div>
						<?php $n++; ?>
					<?php endforeach; ?>
						<div class="col-lg-6">
							<div class="address-unit add-new d-flex justify-content-center align-items-center add-address edit-modal" data-id="new">
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
			<div class="col2-set d-none" id="customer_details">
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
		</div>
		<div class="col-lg-5">
			<div class="wrapper">
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
		<h3 id="order_review_heading"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

