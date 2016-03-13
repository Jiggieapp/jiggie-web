<?php
/**
*ReduxFramework Sample Config File
*For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */
if(!class_exists('ReduxFramework')) return;
if (!class_exists("Redux_Framework_sample_config")) {
    class Redux_Framework_sample_config {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            // This is needed. Bah WordPress bugs.  ;)
            if ( strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( get_template_directory() ) ) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
        * This is a test function that will let you see when the compiler hook occurs.
        * It only runs if a field   set with compiler=>true is changed.
        */
        function compiler_action($options, $css) {
            
        }
        /**
        *Custom function for filtering the sections array. Good for child themes to override or add to the sections.
        *Simply include this function in the child themes functions.php file.
        *NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
        *so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
        /**
        *Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;
            return $args;
        }
        /**
        *Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";
            return $defaults;
        }
        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }
        public function setSections() {
            /**
            *Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();
            if (is_dir($sample_patterns_path)) :
                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();
                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {
                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;
            ob_start();
            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>
                <h4>
                    <?php echo $this->theme->display('Name'); ?>
                </h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                    <?php
                    if ($this->theme->parent()) {
                        printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
                    }
                    ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
            // ACTUAL DECLARATION OF SECTIONS
            global $st_textdomain;
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', $st_textdomain),
                'fields' => array(
                    array(
                        'id'=>'disable_repload',
                        'type'=>'checkbox',
                        'title'=>__('Disable Preload',$st_textdomain),
                        'desc'=>__('<em>If you click here the Preload Icon will not showup when you load page</em>',$st_textdomain)
                    ),
                    array(
                        'id'=>'enable_smooth_scroll',
                        'type'=>'checkbox',
                        'title'=>__('Enable Smooth Scroll',$st_textdomain),
                        'desc'=>__('<em>Check this if you want enable Smooth Scroll effect</em>',$st_textdomain)
                    ),

                    array(
                        'id'=>'disable_builtin_seo',
                        'type'=>'checkbox',
                        'title'=>__('Disable Buitl-in SEO',$st_textdomain),
                        'desc'=>__('<em>Check this if you use another SEO Plugins</em>',$st_textdomain)
                    ),
                    
                    array(
                        'id'=>'loading_text',
                        'type'=>'text',
                        'title'=>__('Loading text',$st_textdomain),
                        'default'=>'Wunderkind.'
                    ),
                    array(
                        'id' => 'loading_icon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Loading Image', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Loading Image.</em>', $st_textdomain),
                        'default' => array('url' => get_template_directory_uri().'/img/preload.gif'),
                    ),
                    array(
                        'id' => 'favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Custom Favicon', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Favicon.</em>', $st_textdomain),
                        'default' => array('url' => get_template_directory_uri().'/img/favicon.ico'),
                    ),
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Logo', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your logo.</em>', $st_textdomain),
                        'default' => array('url' => get_template_directory_uri().'/img/logo.png'),
                    ),array(
                        'id' => 'logo_retina',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Logo Retina', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your retina logo and please make name like this - logo@2x.png if your logo name : logo.png.</em>', $st_textdomain),
                        
                    ),
                    array(
                        'id' => 'apple_icon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Apple Touch Icon', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Apple touch icon 57x57.</em>', $st_textdomain),
                    ),
                    array(
                        'id' => 'apple_icon_57',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Apple Touch Icon 57x57', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Apple touch icon 57x57.</em>', $st_textdomain),
                    ),
                    array(
                        'id' => 'apple_icon_72',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Apple Touch Icon 72x72', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Apple touch icon 72x72.</em>', $st_textdomain),
                    ),
                    array(
                        'id' => 'apple_icon_114',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Apple Touch Icon 114x114', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Apple touch icon 114x114.</em>', $st_textdomain)                        ,
                    ),
                    array(
                        'id' => 'apple_icon_144',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Apple Touch Icon 144x144', $st_textdomain),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('<em>Upload your Apple touch icon 144x144.</em>', $st_textdomain)                        ,
                    ),
                    
                    
                    array(
                        'id' => 'st_seo_title',
                        'type' => 'text',
                        'title' => __('SEO Title', $st_textdomain),
                        'subtitle' => __('SEO Title', $st_textdomain),
                    ),
                    array(
                        'id' => 'st_seo_description',
                        'type' => 'textarea',
                        'title' => __('SEO Description', $st_textdomain),
                        'subtitle' => __('SEO Description', $st_textdomain),
                    ),
                    array(
                        'id' => 'st_seo_keywords',
                        'type' => 'text',
                        'title' => __('SEO Keywords', $st_textdomain),
                        'subtitle' => __('SEO Keywords', $st_textdomain),
                    ),
                )
            );
            //
            $this->sections[] = array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Styling Options', $st_textdomain),
                'fields' => array(
                    array(
                        'id' => 'rtl',
                        'type' => 'checkbox',
                        'title' => __('Support RTL language', $st_textdomain),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id' => 'theme_style',
                        'type' => 'select',
                        'title' => __('Theme Stylesheet', $st_textdomain),
                        'subtitle' => __('Select your themes alternative color scheme.', $st_textdomain),
                        'default' => 'blue.css',
                        'options' => array(
                            ''=>__('Use Custom Color Under',$st_textdomain),
                            'blue.css'=>__("Blue",$st_textdomain),
                            'blue-2.css'=>__("Blue 2",$st_textdomain),
                            'purple.css'=>__("Purple",$st_textdomain),
                            'yellow.css'=>__("Yellow",$st_textdomain),
                            'orange.css'=>__("Orange",$st_textdomain),
                            'red.css'=>__("Red",$st_textdomain),
                            'red-2.css'=>__("Red 2",$st_textdomain),
                            'red-3.css'=>__("Red 3",$st_textdomain),
                            'pink.css'=>__("Pink",$st_textdomain),
                            'pink-2.css'=>__("Pink 2",$st_textdomain),
                            'midnight.css'=>__("Midnight",$st_textdomain),
                            'green.css'=>__("Green",$st_textdomain),
                            'green-2.css'=>__("Green 2",$st_textdomain),
                            'beige.css'=>__("Beige",$st_textdomain),
                            'black.css'=>__("Black",$st_textdomain),
                        ),
                    )
                ,array(
                        'id' => 'main-color',
                        'type' => 'color',
                        'title' => __('Theme Main Color', $st_textdomain),
                        'subtitle' => __('Pick the main color for the theme (default: #2ac5ee).', $st_textdomain),
                        'default' => '#2ac5ee',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'body-font2',
                        'type' => 'typography',
                        'output' => array('body'),
                        'title' => __('Body Font', $st_textdomain),
                        'subtitle' => __('Specify the body font properties.', $st_textdomain),
                        'google' => true,
                        'default' => array(
                            'color' => '#0000',
                            'font-size' => '13px',
                            'line-height' => '20px',
                            'font-family' => "Raleway",
                            'font-weight' => 'Normal',
                            'google'=>true
                        ),
                    ),
                    array(
                        'id' => 'body-bg',
                        'type' => 'background',
                        'output' => array('body'),
                        'title' => __('Body Background ', $st_textdomain),
                        'subtitle' => __('Specify the body background', $st_textdomain)
                    ),

                    array(
                        'id' => 'menu-font',
                        'type' => 'typography',
                        'output' => array('.navbar-right'),
                        'title' => __('Menu Font', $st_textdomain),
                        'subtitle' => __('Specify the Menu font properties.', $st_textdomain),
                        'google' => true,
                        'default' => array(
                            'color' => '#0000',
                            'font-size' => '13px',
                            'line-height' => '20px',
                            'font-family' => "Raleway",
                            'font-weight' => 'Normal',
                        ),
                    ),

                    array(
                        'id' => 'menu-bg',
                        'type' => 'background',
                        'output' => array('.navbar.navbar-default'),
                        'title' => __('Menu Background ', $st_textdomain),
                        'subtitle' => __('Specify the body background', $st_textdomain)
                    ),

                    array(
                        'id' => 'headingfont',
                        'type' => 'typography',
                        'output'=>'h1,h2,h3,h4,h5,h6',
                        'title' => __('Heading Font', $st_textdomain),
                        'subtitle' => __('Heading font', $st_textdomain),
                        'google' => true,
                        'font-size'=>false,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'default' => array(
                            'font-family' => "Montserrat",
                            'font-weight' => 'normal',
                            'google'=>true
                        ),
                    ),
                    array(
                        'id' => 'heading_small_font',
                        'type' => 'typography',
                        'output'=>'h1 small,h2 small,h3 small,h4 small,h5 small,h6 small',
                        'title' => __('Heading > Small Font', $st_textdomain),
                        'subtitle' => __('Heading > Small Font', $st_textdomain),
                        'google' => true,
                        'font-size'=>false,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'default' => array(
                            'font-family' => "Raleway",
                            'font-weight' => '200',
                            'google'=>true
                        ),
                    ),


                    array(
                        'id' => 'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', $st_textdomain),
                        'subtitle' => __('Paste your CSS code here.', $st_textdomain),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => __('Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',$st_textdomain),
                        'default' => ""
                    ),
                )
            );
            //Header settings
            $this->sections[]=array(
                'icon'=>'el-icon-qrcode',
                'title'=>__("Header Settings",$st_textdomain),
                'fields'=>array(
                    array(
                        'id'=>'header_disable_fixed',
                        'type'=>'checkbox',
                        'title'=>__('Disable Fixed Menu',$st_textdomain),
                        'desc'=>__('Check this if you want to disable fixed menu',$st_textdomain)
                        
                    ),
                    array(
                        'id'=>'header_position',
                        'type'=>'select',
                        'title'=>__('Header Position',$st_textdomain),
                        'options'=>array(
                            '1'=>__('Normal Header',$st_textdomain),
                            '2'=>__('Appearing Header',$st_textdomain),
                            '3'=>__('Bottom Header',$st_textdomain),
                        ),
                        'default'=>1
                    )
                )
            );

            //Home settings
            $this->sections[]=array(
                'icon'=>'el-icon-home',
                'title'=>__('Home settings',$st_textdomain),
                'fields'=>array(
                    array(
                        'id'=>'home_sidebar_position',
                        'type'=>'image_select',
                        'title'=>__('Sidebar Position',$st_textdomain),
                        'subtitle'=>__('Select your position of the sidebar in Home page',$st_textdomain),
                        'desc'=>'',
                        'options'=>array(
                                            'no'=>array(
                                                    'alt'=>__('No sidebar',$st_textdomain),
                                                    'img'=>ReduxFramework::$_url.'assets/img/1col.png'
                                                ),    
                                            'right' => array(
                                                        'alt'=>__('Right',$st_textdomain),
                                                         'img'=>ReduxFramework::$_url.'assets/img/2cr.png'
                                                         ),    
                                            'left' =>array(
                                                        'alt'=>__('Left',$st_textdomain),
                                                        'img'=>ReduxFramework::$_url.'assets/img/2cl.png'
                                                         ) 
                        ),
                        'default'=>'no'
                    ),
                )
            );
            //Shop Settings
            $this->sections[]=array(
                'icon'=>'el-icon-shopping-cart',
                'title'=>__('Shop Settings',$st_textdomain),
                'fields'=>array(
                    array(
                        'id'=>'shop_layout',
                        'type'=>'select',
                        'title'=>__('Shop layout',$st_textdomain),
                        'subtitle'=>__('Select your Shop layout',$st_textdomain),
                        'desc'=>'',
                        'options'=>array(
                            1=>__('Fullwidth',$st_textdomain),
                            0=>__('Has sidebar',$st_textdomain)
                        ),
                        'default'=>1
                    ),
                    array(
                        'id'=>'shop_sidebar',
                        'type'=>'image_select',
                        'title'=>__("Sidebar position",$st_textdomain),
                        'desc' => '',
                        'options' => array('right' => array(
                                                        'alt'=>__('Right',$st_textdomain),
                                                         'img'=>ReduxFramework::$_url.'assets/img/2cr.png'
                                                         ),    
                                             'left' =>array(
                                                        'alt'=>__('Left',$st_textdomain),
                                                        'img'=>ReduxFramework::$_url.'assets/img/2cl.png'
                                                         ) 
                                             ),
                        'default' => 'right'
                    ),

                    array(
                            'id'=>'shop_sidebar_id',
                            'type'=>'select',
                            'title'=>__('Widget Area',$st_textdomain),
                            'desc'=>__('Choose your own Widet Area',$st_textdomain),
                            'options'=>st_get_widget_area(),
                            'default'=>'shop'
                        ),

                    array(
                        'id'=>'shop_banner_image',
                        'type'=>'media',
                        'title'=>__("Shop Banner Image",$st_textdomain),
                        'desc' => '',
                    )
                    ,
                    array(
                        'id'=>'shop_banner_pattern',
                        'type'=>'media',
                        'title'=>__("Shop Banner Pattern",$st_textdomain),
                        'desc' => '',
                    )
                    ,
                    array(
                        'id'=>'shop_banner_text',
                        'type'=>'textarea',
                        'title'=>__("Shop Banner Texts",$st_textdomain),
                        'desc' => '',
                    )
                )
            );
            //Blog Settings
            $this->sections[]=array(
                'icon'=>'el-icon-bold',
                'title'=>__('Blog Settings',$st_textdomain),
                'fields'=>array(
                    array(
                        'id'=>'sidebar_position',
                        'type'=>'image_select',
                        'title'=>__('Sidebar Position',$st_textdomain),
                        'subtitle'=>__('Select your position of the sidebar',$st_textdomain),
                        'desc'=>'',
                        
                        'options' => array(
                                            'no'=>array(
                                                    'alt'=>__('No sidebar',$st_textdomain),
                                                    'img'=>ReduxFramework::$_url.'assets/img/1col.png'
                                                ),    
                                            'right' => array(
                                                        'alt'=>__('Right',$st_textdomain),
                                                         'img'=>ReduxFramework::$_url.'assets/img/2cr.png'
                                                         ),    
                                            'left' =>array(
                                                        'alt'=>__('Left',$st_textdomain),
                                                        'img'=>ReduxFramework::$_url.'assets/img/2cl.png'
                                                         ) 
                                             ),
                        'default'=>'no'
                    ),
                    array(
                            'id'=>'blog_sidebar_id',
                            'type'=>'select',
                            'title'=>__('Choose Sidebar',$st_textdomain),
                            'default'=>'single-post',
                            'options'=>st_get_widget_area()

                        ),
                )
            );
            //Footer Settings
            $this->sections[]=array(
                'icon'=>'el-icon-website',
                'title'=>__('Footer Settings',$st_textdomain),
                'fields'=>array(
                    array(
                        'id'=>'footer_typography',
                        'type'=>'typography',
                        'title'=>__('Footer Typography',$st_textdomain),
                        'desc'=>'',
                        'output'=>'#footer'
                    ),
                    array(
                        'id'=>'footer_background',
                        'type'=>'background',
                        'title'=>__('Footer Background',$st_textdomain),
                        'desc'=>'',
                        'output'=>'#footer'
                    ),
                    array(
                        'id'=>'footer_style',
                        'type'=>'image_select',
                        'title'=>__('Footer Style',$st_textdomain),
                        'desc'=>'',
                        'options'  => array(
                                    '0'      => array(
                                        'alt'   => __('Simple',$st_textdomain), 
                                        'img'   => get_template_directory_uri().'/images/footer3.gif'
                                    ),

                                    '2'      => array(
                                        'alt'   => __('Style 2',$st_textdomain), 
                                        'img'   => get_template_directory_uri().'/images/footer.gif'
                                    )
                                ),
                        'default'=>0
                    ),
                    array(
                        'id' => 'footer-text',
                        'type' => 'editor',
                        'title' => __('Footer Text', $st_textdomain),
                        'subtitle' => __('Copyright Text', $st_textdomain),
                        'default' => __('<p>Copyright &copy; 2014 Develop by : ShineTheme Team. All Rights Reserved.</p>',$st_textdomain),
                    ),
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => __('Facebook URL', $st_textdomain),
                        'subtitle' => __('Your Facebook URL', $st_textdomain),
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => __('Instagram URL', $st_textdomain),
                        'subtitle' => __('Your Instagram URL', $st_textdomain),
                    ),
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => __('Twitter URL', $st_textdomain),
                        'subtitle' => __('Your Twitter URL', $st_textdomain),
                    ),
                    array(
                        'id' => 'custom_social',
                        'type' => 'textarea',
                        'title' => __('Custom Social URL', $st_textdomain),
                        'subtitle' => __('Your Social URL', $st_textdomain),
                        'description'=>__('Ex: &lt;li class=&quot;connected-icon&quot;&gt;&lt;a target=&quot;_blank&quot; href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-facebook fa-2-5x&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/li&gt;<br> <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Click to get icon</a>',$st_textdomain)
                    ),
                )
            );
            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', $st_textdomain) . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', $st_textdomain) . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', $st_textdomain) . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', $st_textdomain) . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';
            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon' => 'el-icon-list-alt',
                    'title' => __('Documentation', $st_textdomain),
                    'fields' => array(
                        array(
                            'id' => '17',
                            'type' => 'raw',
                            'markdown' => true,
                            'content' => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }//if
            $this->sections[] = array(
                'type' => 'divide',
            );
            $this->sections[] = array(
                'icon' => 'el-icon-info-sign',
                'title' => __('Theme Information', $st_textdomain),
                'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', $st_textdomain),
                'fields' => array(
                    array(
                        'id' => 'raw_new_info',
                        'type' => 'raw',
                        'content' => $item_info,
                    )
                ),
            );
            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon' => 'el-icon-book',
                    'title' => __('Documentation', $st_textdomain),
                    'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }
        public function setHelpTabs() {
            global $st_textdomain;
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', $st_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $st_textdomain)
            );
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', $st_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $st_textdomain)
            );
            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', $st_textdomain);
        }
        /**
        *All the possible arguments for Redux.
        *For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            global $st_textdomain;
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'theme_option', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', $st_textdomain),
                'page' => __('Theme Options', $st_textdomain),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBM9vxebWLN3bq4Urobnr6tEtn7zM06rEw', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => 'st_theme_option', // Set a different name for your global variable other than the opt_name
                'dev_mode' => true, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.     
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => __('Visit us on GitHub',$st_textdomain),
                'icon' => 'el-icon-github'
                // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => __('Like us on Facebook',$st_textdomain),
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => __('Follow us on Twitter',$st_textdomain),
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => __('Find us on LinkedIn',$st_textdomain),
                'icon' => 'el-icon-linkedin'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p></p>', $st_textdomain), $v);
            } else {
                $this->args['intro_text'] = __('<p></p>', $st_textdomain);
            }
            // Add content after the form.
            $this->args['footer_text'] = __('<p></p>', $st_textdomain);
        }
    }
    
}

add_action('init','init_redux_framework');

function init_redux_framework()
{
    new Redux_Framework_sample_config();
}


/**
*Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }
endif;
/**
*Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation
          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */
        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
