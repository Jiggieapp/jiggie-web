<?php
global $st_textdomain;

if(class_exists('Vc_Manager')){
    function st_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
        if($tag=='vc_row' || $tag=='vc_row_inner') {
            $class_string = str_replace('vc_row-fluid', '', $class_string);
        }

        if(defined ('WPB_VC_VERSION'))
        {
            if(version_compare(WPB_VC_VERSION,'4.2.3','>'))
            {
                if($tag=='vc_column' || $tag=='vc_column_inner') {
                    //$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-lg-$1', $class_string);
                    $class_string=str_replace('vc_col', 'col', $class_string);
                }
            }else
            {
                if($tag=='vc_column' || $tag=='vc_column_inner') {
                    $class_string = preg_replace('/vc_span(\d{1,2})/', 'col-lg-$1', $class_string);
                }
            }
        }
        
        return $class_string;
    }
// Filter to Replace default css class for vc_row shortcode and vc_column
    add_filter('vc_shortcodes_css_class', 'st_css_classes_for_vc_row_and_vc_column', 10, 2);
// Add new Param in Row
    if(function_exists('vc_add_param')){


        vc_add_param('vc_row',array(
                "type" => "dropdown",
                "heading" => __('Turn off parallax effect', $st_textdomain),
                "param_name" => "turn_off_parallax",
                "value" => array(
                    __('No', $st_textdomain) => 'no',
                    __('Yes', $st_textdomain) => 'yes',
                ),
                "description" => __("If you want to turn off parallax effect. Please choose YES", $st_textdomain),
            )
        );
        vc_add_param('vc_row',array(
                "type" => "textfield",
                "heading" => __('Row ID', $st_textdomain),
                "param_name" => "row_id",
                "value" => '',
                "description" => __("Row ID", $st_textdomain),
            )
        );
        vc_add_param('vc_row',array(
                "type" => "dropdown",
                "heading" => __('Overlay', $st_textdomain),
                "param_name" => "overlay",
                "value" => array(
                    __('No', $st_textdomain) => 'no',
                    __('Yes', $st_textdomain) => 'yes',
                ),
                "description" => __("Section Overlay", $st_textdomain),
            )
        );

        vc_add_param('vc_row',array(
                "type" => "attach_image",
                "heading" => __('Custom Overlay', $st_textdomain),
                "param_name" => "custom_overlay",
                "description" => __("Custom Overlay", $st_textdomain),
            )
        );
        vc_add_param('vc_row',array(
                "type" => "dropdown",
                "heading" => __('Fullwidth', $st_textdomain),
                "param_name" => "fullwidth",
                "value" => array(

                    __('No', $st_textdomain) => 'no',
                    __('Yes', $st_textdomain) => 'yes',
                ),
                "description" => __("Use for some elements like Google Map", $st_textdomain),
            )
        );

        vc_add_param('vc_row',array(
                "type" => "textfield",
                "heading" => __('Data effect', $st_textdomain),
                "param_name" => "effect",
                "value" =>'',
                "description" => __("<a href='http://daneden.github.io/animate.css/' target='_blank'>Get effect name here</a>",$st_textdomain),
            )
        );

        vc_add_param('vc_row_inner',array(
                "type" => "textfield",
                "heading" => __('Data effect', $st_textdomain),
                "param_name" => "effect",
                "value" =>'',
                "description" => __("<a href='http://daneden.github.io/animate.css/' target='_blank'>Get effect name here</a>",$st_textdomain),
            )
        );

// Add effect param in vc_column_inner
        vc_add_param('vc_column_inner',array(
                "type" => "textfield",
                "heading" => __('Data effect', $st_textdomain),
                "param_name" => "effect",
                "value" => "",                              
                "description" => __("<a href='http://daneden.github.io/animate.css/' target='_blank'>Get effect name here</a>",$st_textdomain),
            )
        );

        vc_add_param('vc_column',array(
                "type" => "textfield",
                "heading" => __('Data effect', $st_textdomain),
                "param_name" => "effect",
                "value" => "",                              
                "description" => __("<a href='http://daneden.github.io/animate.css/' target='_blank'>Get effect name here</a>",$st_textdomain),
            )
        );
        vc_add_param('vc_column_inner',array(
                "type" => "textfield",
                "heading" => __('Title', $st_textdomain),
                "param_name" => "title",
                "value" => "",
                "description" => __("Add data Tilte", $st_textdomain),
            )
        );
        vc_add_param('vc_column',array(
                "type" => "textfield",
                "heading" => __('Container Class', $st_textdomain),
                "param_name" => "wap_class",
                "value" => "",
                "description" => __("Container Class", $st_textdomain),
            )
        );
        vc_add_param('vc_column',array(
                "type" => "textfield",
                "heading" => __('Column ID', $st_textdomain),
                "param_name" => "col_id",
                "value" => '',
                "description" => __("Column ID", $st_textdomain),
            )
        );
        vc_add_param('vc_column',array(
                "type" => "dropdown",
                "heading" => __('Use Liquid slider', $st_textdomain),
                "param_name" => "is_slider",
                "value" => array(
                    __('No',$st_textdomain)=>0,
                    __('Yes',$st_textdomain)=>1
                ),
                "description" => __("Column ID", $st_textdomain),
            )
        );

        vc_add_param('vc_column',array(
                "type" => "textfield",
                "heading" => __('Liquid slider speed', $st_textdomain),
                "param_name" => "slide_speed",
                "value" =>4500,
                "description" => __("Millisecond", $st_textdomain),
            )
        );
        vc_add_param('vc_column',array(
                "type" => "textfield",
                "heading" => __('Column Title', $st_textdomain),
                "param_name" => "title",
                "value" => "",
                "description" => __("Title of column", $st_textdomain),
            )
        );
        vc_add_param('vc_accordion_tab',array(
                "type" => "textfield",
                "heading" => __('Icon', $st_textdomain),
                "param_name" => "icon",
                "value" => "",
                "description" => __("icon", $st_textdomain),
            )
        );
        vc_add_param('vc_tab',array(
                "type" => "textfield",
                "heading" => __('Icon', $st_textdomain),
                "param_name" => "icon",
                "value" => "",
                "description" => __("icon", $st_textdomain),
            )
        );
        vc_add_param('vc_button',array(
                "type" => "textfield",
                "heading" => __('Other icon', $st_textdomain),
                "param_name" => "el_icon",
                "value" => "",
                "description" => __("Other icon(fa-info, fa-laptop...)", $st_textdomain),
            )
        );
    }
    if(function_exists('vc_remove_param')){
        //vc_remove_param('vc_row','font_color');
        vc_remove_param('vc_row','bg_color');
        vc_remove_param('vc_row','padding');
        vc_remove_param('vc_button','color');
        vc_remove_param('vc_row','margin_bottom');
        vc_remove_param('vc_button','icon');
    }
}