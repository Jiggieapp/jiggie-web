<?php
add_action('init', 'st_removeDemoModeLink');
add_filter('widget_text', 'do_shortcode');
add_action( 'after_setup_theme', 'st_theme_setup' );
add_action( 'widgets_init', 'st_wpsites_widgets_init' );
add_filter( 'wp_title', 'st_wp_title', 10, 2 );

add_action( 'show_user_profile', 'st_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'st_my_show_extra_profile_fields' );

add_action( 'personal_options_update', 'st_my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'st_my_save_extra_profile_fields' );

add_action('init', 'st_woocommerce_clear_cart_url');

//Remove Add to cart button after title
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart');
//Remove Relate then add Relate to other position
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//Remove Up sell and ralte to other position
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);

//Hide breadcumb Woo
add_filter('woocommerce_breadcumb','st_hide_breadcumd' );


add_filter('body_class','st_add_body_class');

add_action('admin_footer', 'st_add_vc_element_icon');

add_action('wp_head','st_add_seo_meta_tags' );