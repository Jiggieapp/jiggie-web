<?php
define('ST_CORE_DIR_NAME','inc');
define('ST_CORE_DIR',get_template_directory().'/inc');
define('ST_CORE_URI',get_template_directory_uri().'/inc');

class STSetup
{
    static $detect;
    static function  init()
    {
        //Add require_once('BFI_Thumb.php');
        require_once('plugins/BFI_Thumb.php');

        //Mobile Detect
        require_once('plugins/Mobile_Detect.php');
        self::$detect = new Mobile_Detect();

        //add required plugin
        self::add_required_plugins();
        //add Scripts
        self::add_scripts();
        //add Post thumb size
        self::add_thumb_size();
        //add Short Code
        require_once get_template_directory().'/inc/st.shortcodev2.php';
        STShortcode::init();
        //add Menu Custom Field
        require_once get_template_directory() . '/inc/st.custommenu.php';
        STCustomMenu::init();
        //add Ajax Action
        require_once get_template_directory() . '/inc/st.ajax.php';
        STAjax::init();



        //Add Importer
        require_once get_template_directory().'/inc/st.importer.php';

        //STImporter::init();
        //Add widgets
        $dirs = array_filter(glob(get_template_directory().'/inc/widgets/*'), 'is_dir');
        if(!empty($dirs))
        {
            foreach($dirs as $key=>$value)
            {
                $dirname=basename($value);
                if(is_file($value.'/'.$dirname.'.php')){
                    //echo get_template_directory().'/inc/widgets/'.$value.'/'.$value.'.php';
                    require_once $value.'/'.$dirname.'.php';
                }
            }
        }
        //show One Click Install
        //self::oneClickButton();
    }

    static function load_libs($files=array())
    {
        if(!empty($files))
        {
            foreach ($files as  $value) {
                # code...
                $file=get_template_directory().'/inc/'.$value.'.php';

                if(file_exists($file))
                {
                    require_once $file;
                }
                
                
            }
        }
    }
    static function update_dismis_oneclick_button(){
             if(isset($_REQUEST['dismis_oneclick_button']) and is_admin())
             {
                update_option('dismis_oneclick_button',$_REQUEST['dismis_oneclick_button']);
             } 
        }
    static function add_admin_notice(){
             global $st_textdomain;
            $dismiss=get_option('dismis_oneclick_button',0);
            if(!$dismiss and is_admin())
            {
                ?>
                <div class="updated">
                    <p><strong><?php _e( 'Install demo content with a Button!', $st_textdomain); ?></strong>
                    <br>
                    <br>
                    <a href="<?php echo admin_url()?>?start_one_click_install=1" class="button button-primary"><?php echo __('Intall demo content now',$st_textdomain) ?></a>
                    <br>
                    <br>
                    <a href="<?php echo admin_url() ?>?dismis_oneclick_button=1"><?php echo __('Never show this again',$st_textdomain) ?></a>
                    <br>
                    </p>
                </div>
                <?php
            }
            if(isset($_REQUEST['import_success']) and $_REQUEST['import_success'])
            {
                ?>
                <div class="updated">
                    <p><strong><?php _e( 'Demo content has been imported successfully!', $st_textdomain); ?></strong>
                    <br>
                    <br>
                    
                    <br>
                    </p>
                </div>
                <?php
            }   
        }
    static function oneClickButton()
    {   
        add_action('admin_init',array('STSetup','update_dismis_oneclick_button'));
        add_action( 'admin_notices',array('STSetup','add_admin_notice'));
    }
    static function add_thumb_size()
    {
        add_image_size( 'portfolio-thumb', 362, 272 );
    }
    static function add_required_plugins()
    {
        require_once  get_template_directory().'/inc/plugins/class-tgm-plugin-activation.php';
        add_action( 'tgmpa_register',array('STSetup','st_register_required_plugins') );
    }
    static function st_register_required_plugins()
    {
        $plugins = array(
            array(
                'name'               => 'WPBakery Visual Composer', // The plugin name.
                'slug'               => 'js_composer', // The plugin slug (typically the folder name).
                'source'             => get_template_directory_uri() . '/inc/files/js_composer.zip', // The plugin source.
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'               => 'Redux Framework', // The plugin name.
                'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            ),
//
            // This is an example of how to include a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'WooCommerce',
                'slug'      => 'woocommerce',
                'required'  => false,
            ),
            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => true,
            ),
        );
        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
                'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
                'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
                'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
                'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );
        tgmpa( $plugins, $config );
    }
    static function add_wp_head()
    {
        echo '
                <!-- SCRIPTS -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
            ';
    }
    static function add_scripts()
    {
        add_action( 'wp_enqueue_scripts', array('STSetup','wunderkind_theme_scripts_styles') );
        //For IE
        add_action( 'wp_head',array('STSetup','add_wp_head'));
    }
    static function  wunderkind_theme_scripts_styles()
    {
        //self::$detect;
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );
        wp_enqueue_script("jquery");
  //       //Javascript
        wp_enqueue_script("bootstrap", get_template_directory_uri()."/assets/js/bootstrap.min.js",array('jquery'),false,true);
		wp_enqueue_script("jquery.liquid-slider.js", get_template_directory_uri()."/js/jquery.liquid-slider.js",array('jquery'),false,true);
        wp_enqueue_script("modernizr.custom.js", get_template_directory_uri()."/js/modernizr.custom.js",array(),false,true);        
		wp_enqueue_script("jquery.sticky.js", get_template_directory_uri()."/js/jquery.sticky.js",array('jquery'),false,true);
        wp_enqueue_script('carousel1',get_template_directory_uri().'/js/owl.carousel.min.js',array(),false,true);

        if(self::$detect->isMobile()==false){
            //Only for PC
    		wp_enqueue_script("waypoints.min.js", get_template_directory_uri()."/js/waypoints.min.js",array(),false,true);
    		wp_enqueue_script("wow.min.js", get_template_directory_uri()."/js/wow.min.js",array(),false,true);
            wp_enqueue_script("jquery.easing.1.3.min.js", get_template_directory_uri()."/js/jquery.easing.1.3.min.js",array('jquery'),false,true);
            
        }

        wp_enqueue_script("jquery.touchSwipe.min.js", get_template_directory_uri()."/js/jquery.touchSwipe.min.js",array('jquery'),false,true);

        wp_enqueue_script("gmap-api", "https://maps.googleapis.com/maps/api/js?sensor=false",array(),false,true);
        wp_enqueue_script("gmap-custom", get_template_directory_uri()."/js/gmap3.min.js",array(),false,true);
        wp_enqueue_script("jquery.flexslider-min.js", get_template_directory_uri()."/js/jquery.flexslider-min.js",array('jquery'),false,true);
        wp_enqueue_script("jquery.backstretch.min.js", get_template_directory_uri()."/js/jquery.backstretch.min.js",array('jquery'),false,true);
        
		if(is_page_template('template-home.php') or is_page_template('demo/template-home2.php'))
        {
            if(self::$detect->isMobile()==false){
                //js Only for PC, not for tablet and phone
                // wp_enqueue_script("jquery.stellar", get_template_directory_uri()."/js/jquery.stellar.js",array('jquery'),false,true);
                wp_enqueue_script("jquery.mb.YTPlayer", get_template_directory_uri()."/js/jquery.mb.YTPlayer.js",array('jquery'),false,true);  
                wp_enqueue_script("jquery.st.youtube.js", get_template_directory_uri()."/js/jquery.st.youtube.js",array('jquery'),false,true);  

                wp_enqueue_script("jquery.counterup.min.js", get_template_directory_uri()."/js/jquery.counterup.min.js",array('jquery'),false,true);
                // wp_enqueue_script("jquery.fitvids.js", get_template_directory_uri()."/js/jquery.fitvids.js",array('jquery'),false,true);
                
            }
            wp_enqueue_script("toucheffects.js", get_template_directory_uri()."/js/toucheffects.js",array(),false,true);
			
            
            // wp_enqueue_script("jquery.mb.YTPlayer", get_template_directory_uri()."/js/jquery.mb.YTPlayer.js",array('jquery'),false,true);            
            // wp_enqueue_script("jquery.counterup.min.js", get_template_directory_uri()."/js/jquery.counterup.min.js",array('jquery'),false,true);
            // wp_enqueue_script("jquery.fitvids.js", get_template_directory_uri()."/js/jquery.fitvids.js",array('jquery'),false,true);
            // wp_enqueue_script("toucheffects.js", get_template_directory_uri()."/js/toucheffects.js",array(),false,true);
        }

        wp_enqueue_script("jquery.cubeportfolio", get_template_directory_uri()."/js/jquery.cubeportfolio.min.js",array('jquery'),false,true);

        if(st_get_option('enable_smooth_scroll'))
        {
            wp_enqueue_script('SmoothScroll.min',get_template_directory_uri().'/js/SmoothScroll.min.js',array(),null,true );
        }

        wp_enqueue_script('retinajs',get_template_directory_uri().'/js/retina.min.js',array(),false,true);
        wp_enqueue_script('theme-panel',get_template_directory_uri().'/js/theme_panel.js',array(),false,true);

        wp_enqueue_script('st-parallax',get_template_directory_uri().'/js/jquery.parallax.min.js',array(),false,true);

        wp_register_script("themescript", get_template_directory_uri()."/js/custom.js",array('jquery'),false,true);

        wp_localize_script('jquery','st_params',array(
            'theme_url'=>get_template_directory_uri(),
            'site_url'=>site_url(),
            'header_disable_fixed'=>st_get_option('header_disable_fixed')
        ));
        wp_enqueue_script('themescript');
        //CSS
        //Webfont
        wp_enqueue_style( 'raleway-font', get_template_directory_uri().'/fonts/raleway/stylesheet.css');
        wp_enqueue_style( 'montserrat-font"', get_template_directory_uri().'/fonts/montserrat/stylesheet.css');
        wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css');
        wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.css');
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
        wp_enqueue_style( 'ionicons', get_template_directory_uri().'/css/ionicons.min.css');
        wp_enqueue_style( 'liquid-slider', get_template_directory_uri().'/css/liquid-slider.css');
        wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
        wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
        wp_enqueue_style( 'YTPlayer', get_template_directory_uri().'/css/YTPlayer.css');
        //Remove Flexslider of js composer
        wp_deregister_style('flexslider');
        wp_enqueue_style( 'flexslider', get_template_directory_uri().'/css/flexslider.css');
        wp_enqueue_style( 'cubeportfolio', get_template_directory_uri().'/css/cubeportfolio.css');
        wp_register_style( 'custom-woo', get_template_directory_uri().'/css/custom-woo.css',array('js_composer_front'));
        // Owl-carousel
        wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl-carousel/owl.carousel.css');
        wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl-carousel/owl.theme.css');
        
        //Add slider parttent image
        if(is_page())
        {
            $image_parten=get_post_meta(get_the_ID(),'_cmb_banner_image_parttern',true);
            if($image_parten)
            {
                wp_add_inline_style('custom-woo',"
                    #home-pattern>.parallax-overlay{
                        background-image:url($image_parten);
                    }
                ");
            }
        }

        //CSS for shop banner
        $shop_banner_pattern=st_get_option('shop_banner_pattern');
        $shop_banner_image=st_get_option('shop_banner_image');
        if(isset($shop_banner_pattern['url']) and $shop_banner_pattern['url'])
        {
            $shop_banner_pattern_css="
                .parallax-overlay.shop_banner_pattern
                {
                    background-image:url('{$shop_banner_pattern['url']}');
                }
            ";
            wp_add_inline_style('custom-woo',$shop_banner_pattern_css);
        }

        if(isset($shop_banner_image['url']) and $shop_banner_image['url'])
        {
            $shop_banner_image_css="
                #separator-shop{
                                background-image:url('{$shop_banner_image['url']}');
                            }
                ";
            wp_add_inline_style('custom-woo',$shop_banner_image_css);
        }

        wp_enqueue_style('custom-woo');
        wp_enqueue_style( 'theme-panel', get_template_directory_uri().'/css/theme_panel.css');
        if($main_color=st_get_option('theme_style'))
        {

            //wp_enqueue_style( 'color-skin', get_template_directory_uri().'/css/colors/'.st_get_option('theme_style'));
            wp_enqueue_style( 'color-skin', get_template_directory_uri().'/css/color.php?main_color='.$main_color);
        }else
        {
            wp_enqueue_style( 'color-skin', get_template_directory_uri().'/css/color.php');
        }
        if(st_get_option('rtl')==1){
            wp_enqueue_style( 'rtl', get_template_directory_uri().'/rtl.css');
        }
    }
}

