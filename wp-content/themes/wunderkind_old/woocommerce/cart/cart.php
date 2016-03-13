<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce,$st_textdomain;

?>
    <h3 class="cart-title"><span><i class="fa fa-shopping-cart"></i> <?php echo __('Your Cart',$st_textdomain) ?></span></h3>
<?php

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="cart-table shop_table cart" cellspacing="0">
	<thead>
		<tr>

			<th class="product-name" colspan="2"><?php _e( 'Item', 'woocommerce' ); ?></th>
            <th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
            <th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
            <th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class=" <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">



					<td class="image">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
						?>
					</td>

					<td class="title">
						<?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						?>
					</td>



					<td class="price">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>
                    <td class="qty">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        ?>
                    </td>

					<td class="total">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
                    <td class="remove">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                        ?>
                    </td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>


		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>
    <div class="clearfix">

        <p class="cart-total"><span><?php echo __('Total',$st_textdomain)?>:</span> <?php wc_cart_totals_order_total_html(); ?></p>
    </div>
    <p class="cart-buttons">
        <?php wp_nonce_field( 'woocommerce-cart' ); ?>
        <a class="btn btn-default btn-md cart-btn" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );  ?>"><?php echo __('Continue Shopping',$st_textdomain) ?></a>
        <input type="submit" class="btn btn-default btn-md cart-btn" name="clear-cart" value="<?php _e('Empty Cart', 'woocommerce'); ?>" />
        <input type="submit" class="btn btn-default btn-md cart-btn" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
         <input type="submit" class="btn btn-primary btn-lg pull-right alt wc-forward" name="proceed" value="<?php _e( 'Checkout', $st_textdomain ); ?>" />

    </p>
</form>
<div class="row" style="margin-top: 30px">

    <div class="col-lg-6">
        <div class="cart-collaterals">

            <?php do_action( 'woocommerce_cart_collaterals' ); ?>

            <?php woocommerce_cart_totals(); ?>

        </div>
    </div>
    <div class="col-lg-6">
        <?php woocommerce_shipping_calculator(); ?>
    </div>

</div>



<?php do_action( 'woocommerce_after_cart' ); ?>