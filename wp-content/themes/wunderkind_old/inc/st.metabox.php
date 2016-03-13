<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
add_filter( 'cmb_meta_boxes', 'st_metabox_register' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function st_metabox_register( array $meta_boxes ) {
    global $st_textdomain;
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';


	$meta_boxes[] = array(
		'id'         => 'post_options',
		'title'      => __('Post Options',$st_textdomain),
		'pages'      => array('post'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           array(
                'name' => __('oEmbed for Post Format',$st_textdomain),
                'desc' => __('Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',$st_textdomain),
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
            array(
                'name' => __('Sidebar Position',$st_textdomain),
                'desc' => __('Select Sidebar position',$st_textdomain),
                'id'   => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array( 'name' =>__('No sidebar',$st_textdomain), 'value' => 'no', ),
                    array( 'name' =>__('Right',$st_textdomain), 'value' => 'right', ),
                    array( 'name' =>__('Left',$st_textdomain), 'value' => 'left', ),
                )
            ),
		),
	);
    $meta_boxes[]=array(
            'id'         => 'nav_menu_option',
            'title'      => __('Nav Menu Options',$st_textdomain),
            'pages'      => array('nav_menu_item'), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
               array(
                    'name' => __('Hightlight Menu',$st_textdomain),
                    'id'   => 'st_hightlight',
                    'type' => 'checkbox',
                ),
                
            ),

        );
    $meta_boxes[] = array(
        'id'         => 'product_options',
        'title'      => __('Product Options',$st_textdomain),
        'pages'      => array('product'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
           // array(
           //      'name' => __('oEmbed for Post Format',$st_textdomain),
           //      'desc' => __('Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',$st_textdomain),
           //      'id'   => $prefix . 'embed_video',
           //      'type' => 'oembed',
           //  ),
            array(
                'name' => __('Sidebar Position',$st_textdomain),
                'desc' => __('Select Sidebar position',$st_textdomain),
                'id'   => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array( 'name' =>__('No sidebar',$st_textdomain), 'value' => 'no', ),
                    array( 'name' =>__('Right',$st_textdomain), 'value' => 'right', ),
                    array( 'name' =>__('Left',$st_textdomain), 'value' => 'left', ),
                )
            ),
        ),
    );
    $meta_boxes[] = array(
        'id'         => 'project_fields',
        'title'      => __('Project Fields',$st_textdomain),
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
             array(
                'name' => __('Content Position',$st_textdomain),
                'desc' => __('Postion of the content',$st_textdomain),
                'id'   => $prefix . 'content_position',
                'type'    => 'select',
                'options' => array(
                    array('name'=>__('Fullwidth',$st_textdomain),'value'=>'fullwidth'),
                    array( 'name' => __('Left',$st_textdomain), 'value' => 'left', ),
                    array( 'name' => __('Right',$st_textdomain), 'value' => 'right', ),
                    )
            ),
            array(
                'name' => __('Sub title',$st_textdomain),
                'desc' => __('Project Sub Title',$st_textdomain),
                'id'   => $prefix . 'project_sub_title',
                'type' => 'text',
            ),
            
            array(
                'name' => __('Client',$st_textdomain),
                'desc' => __('Client name',$st_textdomain),
                'id'   => $prefix . 'project_client',
                'type' => 'text',
            ),
            array(
                'name' => __('Project URL',$st_textdomain),
                'desc' => __('Enter your project detai URL',$st_textdomain),
                'id'   => $prefix . 'project_url',
                'type' => 'text',
            ),
            array(
                'name' => __('Final Date',$st_textdomain),
                'desc' => __('Time Final project',$st_textdomain),
                'id'   => $prefix . 'project_date',
                'type' => 'text',
            ),
           array(
                'name' => __('Project Description',$st_textdomain),
                'desc' => '',
                'id'   => $prefix . 'desc',
                'type' => 'textarea',
            ),
            array(
                'name' => __('oEmbed for Post Format',$st_textdomain),
                'desc' => __('Enter a youtube, twitter, or instagram URL. Supports services listed at ',$st_textdomain).'<a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>. ('.__('Only for Video Post Format',$st_textdomain).')',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
        )
    );
    $meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => __('Page Setting',$st_textdomain),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(



            array(
                'name' => __('Hide Page Title',$st_textdomain),
                'desc' => __('Hide Page Title',$st_textdomain),
                'id'   => $prefix . 'hide_page_title',
                'type'    => 'checkbox',
            ),
            array(
                'name' => __('Page Sub Title',$st_textdomain),
                'desc' => __('Set Page Sub Title',$st_textdomain),
                'id'   => $prefix . 'page_sub_title',
                'type'    => 'text',
            ),
            
            array(
                'name' => __('Sidebar Position',$st_textdomain),
                'desc' => __('Select Sidebar position',$st_textdomain),
                'id'   => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array( 'name' =>__('No sidebar',$st_textdomain), 'value' => 'no', ),
                    array( 'name' =>__('Right',$st_textdomain), 'value' => 'right', ),
                    array( 'name' =>__('Left',$st_textdomain), 'value' => 'left', ),
                    )
            ),
            array(
                'name' => __('Fullwidth Page',$st_textdomain),
                'desc' => __('Fullwidth or Boxed',$st_textdomain),
                'id'   => $prefix . 'fullwidth',
                'type'    => 'select',
                'options' => array(
                    array( 'name' =>__('Fullwidth',$st_textdomain), 'value' => 'fullwidth', ),
                    array( 'name' =>__('Boxed',$st_textdomain), 'value' => 'boxed', ),
                    )
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'seo_setting',
        'title'      => __('SEO Settings',$st_textdomain),
        'pages'      => array('page','post','portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(



            array(
                'name' => __('SEO Title',$st_textdomain),
                'desc' => __('SEO Title',$st_textdomain),
                'id'   => $prefix . 'seo_title',
                'type'    => 'text',
            ),
            array(
                'name' => __('SEO Description',$st_textdomain),
                'desc' => __('SEO Description',$st_textdomain),
                'id'   => $prefix . 'seo_description',
                'type'    => 'text',
            ),
            array(
                'name' => __('SEO Keywords',$st_textdomain),
                'desc' => __('SEO Keywords',$st_textdomain),
                'id'   => $prefix . 'seo_keywords',
                'type'    => 'text',
            ),
            
            
        )
    );

    //Banner Settings
    $meta_boxes[] = array(
        'id'         => 'banner_settings',
        'title'      => __('Banner Setting',$st_textdomain),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => __('Enable Banner',$st_textdomain),
                'desc' => __('Enable Banner',$st_textdomain),
                'id'   => $prefix . 'enable_banner',
                'type'    => 'checkbox'
            ),
            array(
                'name' => __('Disable Slider Text',$st_textdomain),
                'desc' => __('Allow you to disable Slider Text',$st_textdomain),
                'id'   => $prefix . 'banner_disable_slider_text',
                'type'    => 'checkbox'
            ),
            array(
                'name' => __('Banner Fade',$st_textdomain),
                'desc' => __('Fade is value that determines how quickly the next image will fade in',$st_textdomain),
                'id'   => $prefix . 'banner_fade',
                'type'    => 'text',
                'default'=>500
            ),
            array(
                'name' => __('Banner Duration',$st_textdomain),
                'desc' => __('Duration is the amount of time in between slides',$st_textdomain),
                'id'   => $prefix . 'banner_duration',
                'type'    => 'text',
                'default'=>4000
            ),
            array(
                'name' => __('Video Url',$st_textdomain),
                'desc' => __('Show a Video on Banner',$st_textdomain),
                'id'   => $prefix . 'video_url',
                'type'    => 'oembed',
            ),
            array(
                'name' => __('Images',$st_textdomain),
                'desc' => __('<em>Select 1 image for parallax version. Select multi image for slides version</em>',$st_textdomain),
                'id'   => $prefix . 'banner_images',
                'type'    => 'file_list',
            ),
            array(
                'name' => __('Texts',$st_textdomain),
                'desc' => __('<em>You can use "align" attribute to control alignment of banner</em>',$st_textdomain),
                'id'   => $prefix . 'banner_texts',
                'type'    => 'textarea'
            ),
            array(
                'name' => __('Image Pattern',$st_textdomain),
                'desc' => __('Banner Image Pattern',$st_textdomain),
                'id'   => $prefix . 'banner_image_parttern',
                'type'    => 'file',
            ),
            array(
                'name' => __('Menu Style',$st_textdomain),
                'desc' => __('Menu Style',$st_textdomain),
                'id'   => $prefix . 'menu_style',
                'type'    => 'select',
                'options'=>array(
                    array( 'name' =>__('Normal Menu',$st_textdomain), 'value' => 1, ),
                    array( 'name' =>__('Appearing Menu',$st_textdomain), 'value' => 2, ),
                    array( 'name' =>__('Bottom Menu',$st_textdomain), 'value' => 3, ),
                )
            ),
        )
    );
    
    
	// Add other metaboxes as needed
	return $meta_boxes;
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once get_template_directory().'/inc/plugins/metabox1.2/init.php';
}
