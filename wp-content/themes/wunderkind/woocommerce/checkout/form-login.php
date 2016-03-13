<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $st_textdomain,$st_checkout_step;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) return;

$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );

$st_checkout_step++;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title" data-toggle="collapse" data-target="#loginStep">
            <i class="icon ion-arrow-down-b"></i>  <?php echo __('Step '.$st_checkout_step.' - Login or Register Information',$st_textdomain)?>
        </h4>
    </div>
    <div class="panel-collapse collapse in" id="loginStep">
        <div class="panel-body">
            <?php
            woocommerce_login_form(
                array(
                    'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
                    'redirect' => get_permalink( wc_get_page_id( 'checkout' ) ),
                    'hidden'   => false
                )
            );
            ?>
        </div>
    </div>
</div>