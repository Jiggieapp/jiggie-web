<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce,$st_textdomain,$st_checkout_step;

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );

$st_checkout_step++;
?>



<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title" data-toggle="collapse" data-target="#couponStep">
            <i class="icon ion-arrow-down-b"></i>  <?php echo __('Step '.$st_checkout_step.' - Input Your Coupon Code',$st_textdomain)?>
        </h4>
    </div>
    <div class="panel-collapse collapse" id="couponStep">
        <div class="panel-body">
            <form class="checkout_coupon" method="post" style="">
                <p class="form-row form-row-first">
                    <input type="text" name="coupon_code" class="form-control input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
                </p>

                <p class="form-row form-row-last">
                    <input type="submit" class="btn btn-primary" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
                </p>

                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>
