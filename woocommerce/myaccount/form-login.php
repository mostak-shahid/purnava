<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="row justify-content-md-center" id="customer_login">

	<!-- <div class="u-column1 col-1"> -->
	<div class="col-md-5">

<?php endif; ?>
<div class="row justify-content-md-center">
	<div class="col-md-5">
		<div class="auth-form-wrapper">
			<h1><?php esc_html_e( 'Login', 'woocommerce' ); ?></h1>

			<form class="mb30" id="mos-loginform" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<div class="form-group"><label for="username"><?php esc_html_e( 'Email/Phone Number', 'woocommerce' ); ?></label><input type="text" class="form-control mos-border-bottom rounded-0"  name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"></div>

				<div class="form-group"><label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?></label><div class="input-group"><input type="password" class="form-control mos-border-bottom rounded-0" name="password" id="password" autocomplete="current-password"><div class="input-group-append"><span class="input-group-text"><i class="fa fa-eye"></i></span></div></div></div>


				<?php do_action( 'woocommerce_login_form' ); ?>
				<div class="form-row mb30"><div class="col"><input class="mr-1" type="checkbox" name="rememberme" id="rememberme" value="forever"><label class="form-check-label" for="rememberme"> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label></div><div class="col text-right"><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot Your Password?', 'woocommerce' ); ?></a></div></div>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="btn btn-block btn-primary rounded-0" name="login" id="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
			<div class="text-center">
				<div class="or">
					<span>OR</span>
				</div>
				<div class="ligin-with">Login With</div>
				<?php echo do_shortcode('[miniorange_social_login theme="default"]'); ?>
			</div>
			<div class="text-center">New to Purnava? <a class="mos-auth-link" href="<?php echo home_url()?>/register/">Create a New Account</a></div>
		</div>
	</div>
</div>
<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
