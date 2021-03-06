<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs">
		<ul id="myTab" class="nav nav-tabs">
			<?php $i=0; foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $i==0?'active':false ?> <?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php $i++; endforeach; ?>
		</ul>
        <div id="myTabContent" class="tab-content">
            <?php $i=0; foreach ( $tabs as $key => $tab ) : ?>

                <div class="tab-pane fade entry-content <?php echo $i==0?'active in':false ?>" id="tab-<?php echo $key ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>

            <?php $i++; endforeach; ?>
        </div>
	</div>

<?php endif; ?>