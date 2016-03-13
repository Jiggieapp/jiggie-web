<?php
$text=st_get_option('shop_banner_text');
$shop_banner_pattern=st_get_option('shop_banner_pattern');
$shop_banner_image=st_get_option('shop_banner_image');
if($text)
{

?>
    <!-- Start Separator-Shop -->
    <section id="separator-shop" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="">
        <div class="row text-center" style="position:relative;">
            <?php if($shop_banner_pattern){
                    echo '<div class="parallax-overlay shop_banner_pattern"></div>';

                }
                ?>

            <div class="shop-slider liquid-slider" id="shop-banner">

                <?php
                    echo wpb_js_remove_wpautop($text);
                ?>

            </div>
        </div>
    </section>
<?php
}