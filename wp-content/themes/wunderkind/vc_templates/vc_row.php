<?php
global $st_remove_container,$st_use_container;
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
extract(shortcode_atts(array(
    'el_class'        => 'section-whitebg',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'overlay'=>'no',
    'custom_overlay'=>'',
    'wrap_class'=>'',
    'ses_title'=>'',
    'ses_sub_title'=>'',
    'ses_extra_text'=>'',
    'css'=>'',
    'row_id'=>'single_row_no_id',
    'turn_off_parallax'=>'no',
    'fullwidth'=>'no',
    'effect'=>''
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

if($row_id=='single_row_no_id')
{
    $row_id.=rand();
}

$overlay_str='';

//For overlay and custom overlay
if($overlay=='yes')
{
    $overlay_bg='';
    if($custom_overlay)
    {
        $overlay_bg='style="background-image:url('.wp_get_attachment_url($custom_overlay).')"';
    }

    $overlay_str='<div '.$overlay_bg.' class="parallax-overlay"></div>';
}

if($turn_off_parallax=='no' and strpos($css, 'background-image: url(')!==false){
    $css_class.=' st_parallax';
}

if($effect){

    $css_class.=' wow '.$effect;
}


$output .= '<section id="'.$row_id.'" class="'.$css_class.'"'.$style.'>';
$output.= $overlay_str;
    
    if($this->settings['base']=="vc_row")
    {

        if($fullwidth=='yes')
        {
            $output.='<div class="container-fluid">';
            
        }else
        {
            $output.='<div class="container">';
        }

    }


        $output.='<div class="row">';

        $output .= wpb_js_remove_wpautop($content);


        $output.='</div><!--End row-->';


    if($this->settings['base']=="vc_row")
    {
        $output.='</div><!--End container-->';
    }
    


$output .= '</section>'.$this->endBlockComment('row');

$st_use_container='yes';

echo $output;




// wp_enqueue_style( 'js_composer_front' );
// wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

// $el_class = $this->getExtraClass($el_class);


// //$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section_row '.get_row_css_class().$el_class, $this->settings['base']);
// $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// if($row_id=='single_row_no_id')
// {
//     $row_id.=rand();
// }

// if($turn_off_parallax=='no'){
//     $css_class.=' st_parallax';
// }

// $style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
// $output .='<section id="'.$row_id.'" class=" '.$css_class.'" '.$style.'>';


// if($fullwidth=='yes')
// {
//     $output.='<div class=fullwidth>';
//     $output .= wpb_js_remove_wpautop($content);
//     $output .='
//         </div>
//         </section>
//             '.$this->endBlockComment('row');


//     echo $output;
//     return;
// }




// if($overlay == 'yes'){
//     $output .='<div class="parallax-overlay"></div>';
// }
// $container='';
// $container_closed='';

// //$container='<div class="container">';



// if(!$st_remove_container)
// {
//     $container='<div class="container"><div class="row">';
//     $container_closed='</div></div>';
// }

// $output.=$container;


// $output .= wpb_js_remove_wpautop($content);

// $output.=$container_closed;

// $output .='

// </section>'.$this->endBlockComment('row');

// echo $output;