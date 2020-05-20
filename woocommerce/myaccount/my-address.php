<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

global $districts;
$customer_id = get_current_user_id();
defined( 'ABSPATH' ) || exit;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// var_dump($_POST);
	if( isset( $_POST['address_nonce_form_field'] ) && wp_verify_nonce( $_POST['address_nonce_form_field'], 'address_nonce_form') ) {	
		$address = get_user_meta( $customer_id, 'mos_user_address', true ); 
		if(!@$address) $address = array();
		if (@$address && $_POST['id'] == 'new') $newindex = sizeof($address);
		elseif($_POST['id'] == 'new') $newindex = 0;
		else  $newindex = $_POST['id'];
		$address[$newindex] = array(
			'id' => $newindex,
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
/*
array(12) {
  ["address_nonce_form_field"]=>
  string(10) "c977f7b2b7"
  ["_wp_http_referer"]=>
  string(34) "/ePurnava/my-account/edit-address/"
  ["first_name"]=>
  string(6) "Mostak"
  ["last_name"]=>
  string(6) "Shahid"
  ["phone"]=>
  string(11) "01710702212"
  ["fax"]=>
  string(11) "01670058131"
  ["address"]=>
  string(46) "House-75(3rd Floor), Road-4(B), Niketon, Dhaka"
  ["district"]=>
  string(5) "BD-13"
  ["post"]=>
  string(4) "1213"
  ["id"]=>
  string(3) "new"
  ["type"]=>
  string(5) "other"
  ["submit"]=>
  string(6) "create"
}
*/

}
$setdefault = @$_GET['setdefault'];
$delete = @$_GET['delete'];
if ($setdefault >-1 ){
	$addresss = get_user_meta( $customer_id, 'mos_user_address', true );
	foreach ($addresss as $key => $address){
		if ($address['type'] == 'default'){
			$addresss[$key]['type'] = 'other';
		}
	}
	$addresss[$setdefault]['type'] = 'default';
	update_user_meta( $customer_id, 'mos_user_address', $addresss );

	update_user_meta( $customer_id, 'billing_first_name', $addresss[$setdefault]["first_name"] );
	update_user_meta( $customer_id, 'billing_last_name', $addresss[$setdefault]["last_name"] );
	update_user_meta( $customer_id, 'billing_address_1', $addresss[$setdefault]["address"] );
	update_user_meta( $customer_id, 'billing_city', $districts[$addresss[$setdefault]["district"]] );
	update_user_meta( $customer_id, 'billing_state', $addresss[$setdefault]["district"] );
	update_user_meta( $customer_id, 'billing_phone', $addresss[$setdefault]["phone"] );
	update_user_meta( $customer_id, 'billing_postcode', $addresss[$setdefault]["post"] );

}
if ($delete >-1 ){
	$addresss = get_user_meta( $customer_id, 'mos_user_address', true ); 
	unset($addresss[$delete]);
	update_user_meta( $customer_id, 'mos_user_address', $addresss );
}

$addresss = get_user_meta( $customer_id, 'mos_user_address', true );
// var_dump($addresss);
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
					<!-- <div class="form-row">
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input name="type" type="checkbox" class="custom-control-input" id="type" value="default">
								<label class="custom-control-label" for="type">Save it as a default shipping address</label>
							</div>
						</div>
					</div> -->
					<div class="form-row">
						<div class="col"><button type="button" class="btn btn-block btn-light rounded-0 border" data-dismiss="modal">Cancel</button></div>
						<div class="col"><button type="submit" class="btn btn-block btn-secondary rounded-0" name="submit" id="submit" value="create">Create</button></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="text-center"><h4 class="account-title">Address Book</h4></div>
<?php if ($addresss) : ?>
	<div class="address mb30">
		<div class="address-title default">Default Address</div>
		<?php foreach ($addresss as $key => $address) : ?>
			<?php if ($address['type'] == 'default') : ?>
		<div class="address-wrapper">
			<div class="float-right address-action"><a href="javascript:void(0)" class="text-info edit-modal" data-id="<?php echo $key ?>">Edit</a></div>
			<div class="address-unit">
				<div class="label">Name :</div>
				<?php echo $address['first_name'] ?> <?php echo $address['last_name'] ?>
			</div>
			<div class="address-unit">
				<div class="label">Address :</div>
				<?php echo $address['address'] ?>
			</div>
			<div class="address-unit">
				<div class="label">Mobile No :</div>
				<?php echo $address['phone'] ?>
			</div>
		</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="address">
		<div class="address-title">Other Address</div>
		<?php foreach ($addresss as $key => $address) : ?>
			<?php if ($address['type'] != 'default') : ?>
		<div class="address-wrapper">
			<div class="float-right address-action"><a href="javascript:void(0)" class="text-info edit-modal" data-id="<?php echo $key ?>">Edit</a> | <a href="<?php echo home_url( '/my-account/edit-address/' ); ?>?delete=<?php echo $key ?>" class="text-danger" data-id="<?php echo $key ?>">Delete</a> | <a href="<?php echo home_url( '/my-account/edit-address/' ); ?>?setdefault=<?php echo $key ?>"  data-id="<?php echo $key ?>">Set as Default</a></div>
			<div class="address-unit">
				<div class="label">Name :</div>
				<?php echo $address['first_name'] ?> <?php echo $address['last_name'] ?>
			</div>
			<div class="address-unit">
				<div class="label">Address :</div>
				<?php echo $address['address'] ?>
			</div>
			<div class="address-unit">
				<div class="label">Mobile No :</div>
				<?php echo $address['phone'] ?>
			</div>
		</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
<div class="text-center"><button type="button" class="btn btn-primary rounded-0 add-address edit-modal" data-id="new">Add New Address</button></div>
<?php
/*$address = array(
	array(
		'id' => 0,
		'type' => 'default',
		'first_name' => 'Md. Mostak',
		'last_name' => 'Shahid',
		'address' => '34/A, Road No: 5, Sector: 9, Gulshan-2 , Dhaka North, Dhaka- 1201.',
		'phone' => '01670058131'
	),
	array(
		'id' => 1,
		'type' => 'other',
		'first_name' => 'Md. Mostak',
		'last_name' => 'Apu',
		'address' => 'Address 2.',
		'phone' => '01710702212'
	),
	array(
		'id' => 2,
		'type' => 'other',
		'first_name' => 'Md. Mostak',
		'last_name' => 'Apu',
		'address' => 'Address 3.',
		'phone' => ''
	), 
);
update_user_meta( $customer_id, 'mos_user_address', $address );*/
?>