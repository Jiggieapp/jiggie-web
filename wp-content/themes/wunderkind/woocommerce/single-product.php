<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar_position=get_post_meta(get_the_ID(),'_cmb_sidebar_position',true);

if(!$sidebar_position)
{
    $sidebar_position='no';
}

get_header( 'shop' ); ?>
<section class="section_row  section-whitebg">
    <div class="container">
        <div class="row">
        <?php if($sidebar_position=='no'){
            $class='col-lg-12';

        } else{
            $class='col-lg-9';
        }
        if($sidebar_position=='left')
        {
            $class.=' pull-right';
        }
        ?>
        <div class="<?php echo $class?>">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
        </div>

        <?php if($sidebar_position!='no'){?>

            <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                //Wunderkind dose not have sidebar in single product
                do_action( 'woocommerce_sidebar' );
            ?>
        <?php } ?>
        </div>
    </div>
</section>
<?php get_footer( 'shop' ); ?>