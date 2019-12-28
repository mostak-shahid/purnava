<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="text-center"><h4 class="account-title">Account Information</h4></div>
<form class="woocommerce-EditAccountForm edit-account mos-account-edit-form" action="" method="post" enctype="multipart/form-data" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
	<div class="d-flex align-items-center mb20">
		<?php
		$user_img = (get_user_meta( $current_user->ID, 'image', true ))?get_user_meta( $current_user->ID, 'image', true ):get_template_directory_uri().'/images/avatar.jpg';
		// echo $current_user->ID;
		// echo $user_img;
		?>
		<div class="img-part">
			<img id="account_image_preview" class="img-fluid rounded-circle img-avater" src="<?php echo $user_img?>" alt="Avater" width="80" height="80">
		</div>
		<div class="form-part position-relative">
			<input type="file" name="account_image" id="account_image" accept="image/*">
		</div>
	</div>
	<div class="form-group">
		<label for="account_first_name"><?php esc_html_e( 'First Name', 'woocommerce' ); ?></label>
		<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="account_first_name" id="account_first_name" placeholder="<?php esc_html_e( 'First Name', 'woocommerce' ); ?>" value="<?php echo esc_attr( $current_user->first_name ); ?>">
	</div>
	<div class="form-group">
		<label for="account_last_name"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?></label>
		<input type="text" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="account_last_name" id="account_last_name" placeholder="<?php esc_html_e( 'Last Name', 'woocommerce' ); ?>" value="<?php echo esc_attr( $current_user->last_name ); ?>">
	</div>	
	<div class="form-group">
		<label for="account_email"><?php esc_html_e( 'Email', 'woocommerce' ); ?></label>
		<input type="email" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="account_email" id="account_email" placeholder="<?php esc_html_e( 'Email', 'woocommerce' ); ?>" value="<?php echo esc_attr( $current_user->user_email ); ?>">
	</div>
	<div class="form-group">
		<label for="account_phone"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?></label>
		<input type="tel" class="form-control rounded-0 mos-border-bottom pl0 pr0" name="account_phone" id="account_phone" placeholder="<?php esc_html_e( 'Phone Number', 'woocommerce' ); ?>" value="<?php echo esc_attr( $current_user->phone ); ?>">
	</div>

	<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
	<div class="form-row">		
		<div class="col"><button type="submit" class="btn btn-block btn-primary rounded-0" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button></div>
		<div class="col"><button type="reset" class="btn btn-block btn-secondary rounded-0"><?php esc_html_e( 'Cancel', 'woocommerce' ); ?></button></div>
		
	</div>
		<input type="hidden" name="action" value="save_account_details" />
		<input type="hidden" name="account_display_name" value="<?php echo esc_attr( $current_user->display_name ); ?>">
</form>
<p><?php
	/* translators: 1: user display name 2: logout url */
	/*printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);*/
?></p>

<p><?php
	/*printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);*/
?></p>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
