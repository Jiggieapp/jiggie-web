<?php global $product; ?>
<li>
    <div class="col-md-12">
        <div class="img-thumbnail">
            <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
                <?php echo $product->get_image(); ?>

            </a>
        </div>
        <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
            <p>
                <?php echo $product->get_title(); ?>
                <?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
                <div class="price_on_widget">
                    <?php echo '<br>'.$product->get_price_html(); ?>
                </div>
            </p>
        </a>

    </div>
</li>