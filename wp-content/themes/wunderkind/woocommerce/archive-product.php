<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $st_is_fullwidth;
global $st_remove_header;

$is_fullwidth=st_get_option('shop_layout');


global $st_orgin_page;
if(isset($st_orgin_page->ID))
{
    if(get_post_meta($st_orgin_page->ID,'_cmb_sidebar_position',true)=='no')
    {
        $st_is_fullwidth=true;
    }else{
        $st_is_fullwidth=false;
    }

}

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!$st_remove_header)
{
    get_header( 'shop' );
}
 ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
        <?php if($st_is_fullwidth){
               $wrap_title_class='col-lg-12';
            }else{
               $wrap_title_class='col-lg-9';
            }?>

        <div class="col-lg-12 shop-title">

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h3 class="page-title"><?php woocommerce_page_title(); ?></h3>

            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>
        </div><!--End row-->

		<?php if ( have_posts() ) : ?>

            <div class="<?php echo $wrap_title_class?> ">
            <div class="clearfix wrap_order">
                <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>


			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
            </div><!--End $$wrap_title_class-->
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
            <div class="<?php $wrap_title_class?>">
			    <?php wc_get_template( 'loop/no-products-found.php' ); ?>
            </div>

		<?php

            endif; ?>


        <?php
        /**
         * woocommerce_sidebar hook
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        if($st_is_fullwidth==false)
        {
            do_action( 'woocommerce_sidebar' );
        }

        ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>




<?php
if(!$st_remove_header)
{
    get_footer( 'shop' );
}

?>