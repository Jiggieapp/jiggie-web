<?php
if(!function_exists('st_removeDemoModeLink'))
{
    function st_removeDemoModeLink() { // Be sure to rename this function to something more unique
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
        }
    }
}


if(!function_exists('st_theme_setup'))
{
    function st_theme_setup() {
        global $st_textdomain;
        /*
         * This theme uses a custom image size for featured images, displayed on
         * "standard" posts and pages.
         */
        add_theme_support( 'post-thumbnails' );
        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );
        // Switches default core markup for search form, comment form, and comments
        // to output valid HTML5.
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
        add_theme_support( 'woocommerce' );
        
        //Post formats
        add_theme_support( 'post-formats', array(
           'gallery', 'image','video','audio'
        ) );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Main Navigation Menu', $st_textdomain ) );
        register_nav_menu( 'footer', __( 'Footer Navigation Menu', $st_textdomain ) );
        // This theme uses its own gallery styles.
        add_filter( 'use_default_gallery_style', '__return_false' );
    }
}

if(!function_exists('st_wpsites_widgets_init'))
{
    function st_wpsites_widgets_init() {
        register_sidebar( array(
            'name' => 'Blog Sidebar',
            'id' => 'single-post',
            'before_widget' => '<div class="blog-widget-container">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );
        register_sidebar( array(
            'name' => 'Shop Sidebar',
            'id' => 'shop',
            'before_widget' => '<div id="%1$s"  class="widget woocommerce shop-widget-container blog-widget-container %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );
    }
}
if(!function_exists('st_wp_title'))
{
    function st_wp_title( $title, $sep ) {
        global $paged, $page;
        if ( is_feed() )
            return $title;
        // Add the site name.
        $title .= get_bloginfo( 'name' );
        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";
        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );
        return $title;
    }
}



if(!function_exists('st_my_show_extra_profile_fields'))
{
function st_my_show_extra_profile_fields( $user ) {
    global $st_textdomain;
    ?>
    <h3><?php echo __('Extra profile information',$st_textdomain) ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="twitter"><?php echo __('Job',$st_textdomain) ?></label></th>
            <td>
                <input type="text" name="job" id="job" value="<?php echo esc_attr( get_the_author_meta( 'job', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo __('Job will be show under your post',$st_textdomain) ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php echo __('Facebook Url',$st_textdomain) ?></label></th>
            <td>
                <input type="text" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo __('Facebook url with show under your description',$st_textdomain) ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php echo __('Twitter Url',$st_textdomain) ?></label></th>
            <td>
                <input type="text" name="twitter_url" id="twitter_url" value="<?php echo esc_attr( get_the_author_meta( 'twitter_url', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo __('Twitter url will be show under your post',$st_textdomain) ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php echo __('Google Plus url',$st_textdomain) ?></label></th>
            <td>
                <input type="text" name="google_plus_url" id="google_plus_url" value="<?php echo esc_attr( get_the_author_meta( 'google_plus_url', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo __('Google Plus url will be show under your post',$st_textdomain) ?></span>
            </td>
        </tr>
    </table>
<?php }
}


if(!function_exists('st_my_save_extra_profile_fields'))
{
    function st_my_save_extra_profile_fields( $user_id ) {
        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;
        /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
        update_user_meta($user_id, 'job', $_POST['job']);
        update_user_meta($user_id, 'google_plus_url', $_POST['google_plus_url']);
        update_user_meta($user_id, 'twitter_url', $_POST['twitter_url']);
        update_user_meta($user_id, 'facebook_url', $_POST['facebook_url']);
    }
}



if(!function_exists('st_woocommerce_clear_cart_url')){
    function st_woocommerce_clear_cart_url() {
        global $woocommerce;
        if( isset($_REQUEST['clear-cart']) ) {
            $woocommerce->cart->empty_cart();
        }
    }
}


if(!function_exists('st_add_body_class'))
{
    function st_add_body_class($class)
    {
        if(is_page() and get_post_meta(get_the_ID(),'_cmb_fullwidth',true) == 'boxed')
        {
            $class[]='page_boxed';
        }else
        {
            $class[]='page_fullwidth';
        }
        return $class;
    }
}

if(!function_exists('st_add_vc_element_icon'))
{
    function st_add_vc_element_icon(){
        ?>
        <style>
            .vc-element-icon.icon-st,
            .vc_element-icon.icon-st
            {
                background-image: url('<?php echo get_template_directory_uri().'/img/logo80x80.png' ?>')!important;
                background-size: 100% 100%;
            }
            .vc_shortcodes_container > .wpb_element_wrapper > .wpb_element_title .vc_element-icon.icon-st
            {
                background-position: 0px;
            }

        </style>
        <?php
    }
}


if(!function_exists('st_add_seo_meta_tags'))
{
    function st_add_seo_meta_tags(){
        if(st_get_option('disable_builtin_seo')) return false;
        
        global $wp_query;
        
        $seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
        $seo_description = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_description", true);
        $seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_keywords", true);

        if(!$seo_title) $seo_title=st_get_option('st_seo_title');
        if(!$seo_description) $seo_description=st_get_option('st_seo_description');
        if(!$seo_keywords) $seo_keywords=st_get_option('st_seo_keywords');

        ?>
        <?php if($seo_title!="") { ?>
        <meta name="title" content="<?php echo $seo_title; ?>"/>
        <?php }  ?>

        <?php if($seo_description!="") { ?>
        <meta name="description" content="<?php echo $seo_description; ?>"/>
        <?php }  ?>

        <?php if($seo_keywords!="") { ?>
        <meta name="keywords" content="<?php echo $seo_keywords; ?>"/>
        <?php  }?>


        <?php
    }
}

if(!function_exists('st_hide_breadcumd'))
{
    function st_hide_breadcumd()
    {
        return false;
    }
}