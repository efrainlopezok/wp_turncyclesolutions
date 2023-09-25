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
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$current_user = get_userdata( get_current_user_id() );
?>
<div class="custom-content-account">
	<ul class="my-account-tabs desktop-show">
		<li><a href="<?php echo get_site_url();?>/my-account/" class="active">MY PROFILE</a></li>
		<li><a href="<?php echo get_site_url();?>/my-account/orders">MY ORDERS</a></li>
		<li><a href="<?php echo get_site_url();?>/my-account/edit-address/billing/">MY ADDRESS</a></li>
	</ul>
	<div class="my-tabs mobile-show">
		<div class="current-tab">MY PROFILE</div>
		<div class="dropdown-tabs">
			<div><a href="<?php echo get_site_url();?>/my-account/" class="active">MY PROFILE</a></div>
			<div><a href="<?php echo get_site_url();?>/my-account/orders">MY ORDERS</a></div>
			<div><a href="<?php echo get_site_url();?>/my-account/edit-address/billing/">MY ADDRESS</a></div>
		</div>
	</div>
	<div class="my-account-content-t" style="clear:both;">
		<div id="my-profile-content" class="my-ac-tab active top-m">
			<div class="container">
				<div class="row">
					<div class="col-md-12"><h2>Membership & Billing</h2></div>
				</div>
				<div class="row smb member-type-row">
					<div class="one-half first">
						<?php
						$membership_types = wc_memberships_get_membership_plans();
						if ($membership_types) {
							foreach ($membership_types as $membership_type) {
								if (wc_memberships_is_user_active_member(get_current_user_id(),$membership_type->slug)) {
									echo '<strong>Membership type:</strong> <span>'.$membership_type->name.'</span>';
									$my_membership = $membership_type->id;
								}
							}
						}
						?>
					</div>
					<!-- <div class="col-md-6 text-right col-sm-6"><?php echo do_shortcode('[add_to_cart id="224"]');?></div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('.add_to_cart_inline a.add_to_cart_button').text('Pay Membership');
						});
					</script> -->
					<div class="one-half text-right"><a href="<?php echo get_the_permalink(764); ?>" class="base-button color-red">Pay Membership</a></div>
				</div>
				<div class="row smb">
					<div class="one-half first">Member since: <?php
					if ($my_membership) {
						$args = array(
						    'plan_id' => $my_membership
						);
						$user_membership = wc_memberships_get_user_membership( get_current_user_id(), $args['plan_id'] );
						echo date("d/m/Y", strtotime($user_membership->get_start_date()));
					}
					?></div>
				</div>
				<div class="row smb">
					<div class="one-half first">Membership expires: <?php
					if($my_membership){
						$args = array(
						    'plan_id' => $my_membership
						);
						$user_membership = wc_memberships_get_user_membership( get_current_user_id(), $args['plan_id'] );
						echo '<span class="expire-membership">'.date("d/m/Y", strtotime($user_membership->get_end_date())).'</span>';
					}
					?></div>
				</div>
				<!--<div class="row smb">
					<div class="one-half first">Payment info</div>
					<div class="one-half text-right"><a href="payment-methods/">Update payment info</a></div>
				</div>-->
				<div class="row mb">
					<div class="one-half first">Billing Address</div>
					<div class="one-half text-right"><a href="edit-address/billing/">Update billing details</a></div>
				</div>
			</div>
			<!--<div class="container secured-by">
				<div class="row">
					<div class="col-md-10">
						<p><strong>Secured By</strong><br>All funds secured by this bank and processed by lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua quis nostrud exercitation.</p>
					</div>
				</div>
			</div>-->
			<div class="container last-c">
				<div class="row">
					<div class="one-half first"><h2>Edit Profile</h2></div>
				</div>
				<?php
				if ($current_user->user_firstname && $current_user->user_lastname) {
					?>
					<div class="row smb">
						<div class="one-half first"><?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></div>
						<div class="one-half text-right"><a href="edit-account">Edit Profile</a></div>
					</div>
					<?php
				}else{
					?>
					<div class="row smb">
						<div class="one-half first"><?php echo $current_user->display_name; ?></div>
						<div class="one-half text-right"><a href="edit-account">Edit Profile</a></div>
					</div>
					<?php
				}
				?>
				<div class="row smb">
					<div class="one-half first"><?php echo $current_user->user_email; ?></div>
					<div class="one-half text-right"><a href="edit-account">Change email</a></div>
				</div>
				<div class="row smb">
					<div class="one-half first">Password</div>
					<div class="one-half text-right"><a href="edit-account">Change Password</a></div>
				</div>
				<div><a href="<?php echo wp_logout_url(); ?>"><strong>LOGOUT</strong></a></div>
			</div>
		</div>
	</div>
</div>

<!--<p><?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>-->

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
